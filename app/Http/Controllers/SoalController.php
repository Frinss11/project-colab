<?php

namespace App\Http\Controllers;

use App\Models\SoalModel;
use App\Models\PackageModel;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use PhpOffice\PhpSpreadsheet\IOFactory as SpreadsheetIOFactory;
use PhpOffice\PhpWord\IOFactory as WordIOFactory;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\Text;
use PhpOffice\PhpWord\Element\TextRun;
use Illuminate\View\View;

class SoalController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route('tambah_soal');
    }

    public function create(Request $request): View
    {
        $package = $request->filled('package_id')
            ? PackageModel::findOrFail($request->integer('package_id'))
            : null;

        return view('content.tambah_soal', compact('package'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'package_id' => 'nullable|exists:packages,id',
            'pertanyaan' => 'required|string',
            'pilihan_a' => 'required|string|max:255',
            'pilihan_b' => 'required|string|max:255',
            'pilihan_c' => 'required|string|max:255',
            'pilihan_d' => 'required|string|max:255',
            'pilihan_e' => 'required|string|max:255',
            'jawaban' => 'required|in:A,B,C,D,E',
        ]);

        SoalModel::create($validated);
        if ($request->filled('package_id')) {
            $this->syncPackageQuestionCount($validated['package_id']);
        }

        return $request->filled('package_id')
            ? redirect()->route('package.show', $validated['package_id'])->with('success', 'Soal berhasil ditambahkan ke package.')
            : back()->with('success', 'Soal berhasil disimpan.');
    }

    public function generateAi(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'package_id' => 'nullable|exists:packages,id',
            'topik_ai' => 'required|string|max:255',
            'jumlah_ai' => 'required|integer|min:1|max:10',
            'kesulitan_ai' => 'required|in:mudah,sedang,sulit',
        ]);

        $prompt = 'Buat tepat ' . $validated['jumlah_ai'] . ' soal pilihan ganda berbahasa Indonesia tentang "'
            . $validated['topik_ai'] . '" dengan tingkat kesulitan ' . $validated['kesulitan_ai'] . '. '
            . 'Balas HANYA JSON array tanpa markdown. Setiap objek wajib memiliki string: '
            . 'pertanyaan, pilihan_a, pilihan_b, pilihan_c, pilihan_d, pilihan_e, jawaban. '
            . 'jawaban harus salah satu dari A, B, C, D, E.';

        try {
            $response = $this->generateWithAi($prompt);

            $questions = json_decode($this->cleanJson($response), true, 512, JSON_THROW_ON_ERROR);
            if (isset($questions['soal'])) {
                $questions = $questions['soal'];
            }
            if (! is_array($questions) || count($questions) === 0) {
                throw new \RuntimeException('AI tidak mengembalikan daftar soal.');
            }

            $rows = collect($questions)->map(fn (array $question) => $this->normaliseQuestion($question, $validated['package_id'] ?? null))->all();
            DB::transaction(fn () => SoalModel::insert($rows));
            if (! empty($validated['package_id'])) {
                $this->syncPackageQuestionCount($validated['package_id']);
            }

            return $request->filled('package_id')
                ? redirect()->route('package.show', $validated['package_id'])->with('success', count($rows) . ' soal berhasil ditambahkan ke package.')
                : back()->with('success', count($rows) . ' soal berhasil dibuat oleh AI dan disimpan.');
        } catch (ConnectionException $exception) {
            return back()->with('error', 'Provider AI tidak dapat dihubungi. Periksa koneksi dan konfigurasi API.');
        } catch (RequestException $exception) {
            $status = $exception->response?->status();
            $message = match ($status) {
                401, 403 => 'API key Gemini tidak valid atau tidak memiliki akses. Buat API key baru di Google AI Studio.',
                404 => 'Model Gemini tidak tersedia. Periksa GEMINI_MODEL di file .env.',
                503 => 'Layanan Gemini sedang sibuk. Tunggu beberapa detik lalu coba lagi.',
                default => 'Gemini gagal memproses permintaan. Periksa konfigurasi API dan coba lagi.',
            };

            report($exception);
            return back()->with('error', $message);
        } catch (\Throwable $exception) {
            report($exception);
            return back()->with('error', 'Respons AI tidak valid atau gagal disimpan. Periksa model dan format prompt.');
        }
    }

    private function generateWithAi(string $prompt): string
    {
        if (env('AI_PROVIDER', 'gemini') === 'ollama') {
            return Http::timeout((int) env('AI_TIMEOUT', 120))
                ->post(rtrim(env('OLLAMA_URL', 'http://127.0.0.1:11434'), '/') . '/api/generate', [
                    'model' => env('OLLAMA_MODEL', 'llama3.2'),
                    'prompt' => $prompt,
                    'stream' => false,
                    'format' => 'json',
                ])
                ->throw()
                ->json('response');
        }

        $apiKey = env('GEMINI_API_KEY');
        if (! $apiKey) {
            throw new \RuntimeException('GEMINI_API_KEY belum diatur.');
        }

        $response = Http::retry(2, 1000)
            ->timeout((int) env('AI_TIMEOUT', 120))
            ->post(rtrim(env('GEMINI_URL', 'https://generativelanguage.googleapis.com/v1beta'), '/')
                . '/models/' . env('GEMINI_MODEL', 'gemini-flash-lite-latest') . ':generateContent?key=' . urlencode($apiKey), [
                    'contents' => [[
                        'parts' => [['text' => $prompt]],
                    ]],
                    'generationConfig' => [
                        'temperature' => 0.4,
                        'responseMimeType' => 'application/json',
                    ],
                ])
            ->throw();

        return (string) $response->json('candidates.0.content.parts.0.text', '');
    }

    public function import(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'package_id' => 'nullable|exists:packages,id',
            'file_soal' => 'required|file|mimes:xlsx,xls,docx|max:10240',
        ]);

        try {
            $extension = strtolower($validated['file_soal']->getClientOriginalExtension());
            $questions = $extension === 'docx'
                ? $this->readWord($validated['file_soal']->getRealPath())
                : $this->readSpreadsheet($validated['file_soal']->getRealPath());

            $rows = collect($questions)
                ->map(fn (array $question) => $this->normaliseQuestion($question, $validated['package_id'] ?? null))
                ->all();

            if ($rows === []) {
                return back()->with('error', 'File tidak berisi soal yang dapat dibaca.');
            }

            DB::transaction(fn () => SoalModel::insert($rows));
            if (! empty($validated['package_id'])) {
                $this->syncPackageQuestionCount($validated['package_id']);
            }

            return $request->filled('package_id')
                ? redirect()->route('package.show', $validated['package_id'])->with('success', count($rows) . ' soal berhasil ditambahkan ke package.')
                : back()->with('success', count($rows) . ' soal berhasil diimpor.');
        } catch (\Throwable $exception) {
            report($exception);
            return back()->with('error', 'File gagal diproses. Pastikan format dan header file sesuai template.');
        }
    }

    private function readSpreadsheet(string $path): array
    {
        $sheet = SpreadsheetIOFactory::load($path)->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true);
        $headers = array_map(fn ($header) => $this->normaliseHeader((string) $header), array_shift($rows));
        $questions = [];

        foreach ($rows as $row) {
            $question = [];
            foreach ($headers as $column => $header) {
                if ($header !== '') {
                    $question[$header] = trim((string) ($row[$column] ?? ''));
                }
            }
            if (trim((string) ($question['pertanyaan'] ?? '')) !== '') {
                $questions[] = $question;
            }
        }

        return $questions;
    }

    private function readWord(string $path): array
    {
        $document = WordIOFactory::load($path);
        $questions = [];
        foreach ($document->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if (! $element instanceof Table) {
                    continue;
                }
                foreach ($element->getRows() as $row) {
                    $cells = array_map(fn ($cell) => trim($this->wordText($cell->getElements())), $row->getCells());
                    if (count($cells) >= 7 && strtolower($cells[0]) !== 'pertanyaan') {
                        $questions[] = array_combine(
                            ['pertanyaan', 'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'pilihan_e', 'jawaban'],
                            array_slice($cells, 0, 7)
                        );
                    }
                }
            }
        }
        return $questions;
    }

    private function normaliseHeader(string $header): string
    {
        $header = strtolower(trim($header));
        $header = preg_replace('/\s+/', ' ', $header);

        return match ($header) {
            'soal', 'pertanyaan', 'question' => 'pertanyaan',
            'jawaban a', 'pilihan a', 'option a', 'a' => 'pilihan_a',
            'jawaban b', 'pilihan b', 'option b', 'b' => 'pilihan_b',
            'jawaban c', 'pilihan c', 'option c', 'c' => 'pilihan_c',
            'jawaban d', 'pilihan d', 'option d', 'd' => 'pilihan_d',
            'jawaban e', 'pilihan e', 'option e', 'e' => 'pilihan_e',
            'jawaban benar', 'kunci jawaban', 'jawaban', 'answer' => 'jawaban',
            default => str_replace(' ', '_', $header),
        };
    }

    private function wordText(array $elements): string
    {
        return collect($elements)->map(function ($element) {
            if ($element instanceof Text) {
                return $element->getText();
            }
            if ($element instanceof TextRun) {
                return $this->wordText($element->getElements());
            }
            return '';
        })->implode(' ');
    }

    private function syncPackageQuestionCount(int $packageId): void
    {
        $package = PackageModel::withCount('soal')->findOrFail($packageId);

        $package->update([
            'jumlah_butir' => (int) $package->soal_count,
            'updated_at' => now(),
        ]);
    }

    private function normaliseQuestion(array $question, ?int $packageId = null): array
    {
        $question = array_change_key_case($question, CASE_LOWER);
        $row = [
            'package_id' => $packageId,
            'pertanyaan' => trim((string) ($question['pertanyaan'] ?? '')),
            'pilihan_a' => trim((string) ($question['pilihan_a'] ?? '')),
            'pilihan_b' => trim((string) ($question['pilihan_b'] ?? '')),
            'pilihan_c' => trim((string) ($question['pilihan_c'] ?? '')),
            'pilihan_d' => trim((string) ($question['pilihan_d'] ?? '')),
            'pilihan_e' => trim((string) ($question['pilihan_e'] ?? '')),
            'jawaban' => strtoupper(trim((string) ($question['jawaban'] ?? ''))),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        validator($row, [
            'pertanyaan' => 'required|string',
            'pilihan_a' => 'required|string', 'pilihan_b' => 'required|string',
            'pilihan_c' => 'required|string', 'pilihan_d' => 'required|string',
            'pilihan_e' => 'required|string', 'jawaban' => 'required|in:A,B,C,D,E',
        ])->validate();

        return $row;
    }

    private function cleanJson(string $response): string
    {
        return trim(preg_replace('/^```(?:json)?\s*|\s*```$/i', '', trim($response)));
    }
}
