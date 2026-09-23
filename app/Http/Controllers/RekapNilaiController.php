<?php

namespace App\Http\Controllers;

use App\Models\PackageModel;
use App\Models\RekapNilaiModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpWord\IOFactory as WordIOFactory;
use PhpOffice\PhpWord\PhpWord;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\View\View;

class RekapNilaiController extends Controller
{
    public function index(): View
    {
        $packages = PackageModel::with(['mapel', 'soal'])
            ->withCount('soal')
            ->with(['nilai' => fn ($query) => $query->with('user')->latest()])
            ->orderByDesc('updated_at')
            ->orderByDesc('id')
            ->get();

        return view('content.rekap_nilai', [
            'packages' => $packages,
            'legacyResults' => RekapNilaiModel::with('user')
                ->whereNull('package_id')
                ->latest()
                ->get(),
        ]);
    }

    public function exportExcel(PackageModel $package): StreamedResponse
    {
        $package->load(['mapel', 'nilai.user']);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray([
            ['Package', $package->nama_package],
            ['Mata Pelajaran', $package->mapel?->nama_mapel ?? '-'],
            [],
            ['No', 'Nama Siswa', 'Email', 'Nilai', 'Keterangan', 'Waktu'],
        ], null, 'A1');

        $row = 5;
        foreach ($package->nilai as $index => $result) {
            $sheet->fromArray([[$index + 1, $result->user?->name ?? 'Siswa #' . $result->users_id, $result->user?->email ?? '-', $result->nilai, $result->keterangan ?: ($result->nilai >= 75 ? 'Lulus' : 'Remedial'), $result->created_at?->format('d M Y H:i')]], null, 'A' . $row++);
        }

        return response()->streamDownload(function () use ($spreadsheet) {
            (new Xlsx($spreadsheet))->save('php://output');
        }, 'rekap-' . str($package->nama_package)->slug() . '.xlsx', ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']);
    }

    public function exportWord(PackageModel $package): BinaryFileResponse
    {
        $package->load(['mapel', 'nilai.user']);
        $document = new PhpWord();
        $section = $document->addSection();
        $section->addTitle('Rekap Nilai Package: ' . $package->nama_package, 1);
        $section->addText('Mata Pelajaran: ' . ($package->mapel?->nama_mapel ?? '-'));
        $table = $section->addTable(['borderSize' => 6, 'borderColor' => 'D9E2F3', 'cellMargin' => 80]);
        $table->addRow();
        foreach (['No', 'Nama Siswa', 'Email', 'Nilai', 'Keterangan', 'Waktu'] as $heading) $table->addCell(1500)->addText($heading);
        foreach ($package->nilai as $index => $result) {
            $table->addRow();
            foreach ([$index + 1, $result->user?->name ?? 'Siswa #' . $result->users_id, $result->user?->email ?? '-', $result->nilai, $result->keterangan ?: ($result->nilai >= 75 ? 'Lulus' : 'Remedial'), $result->created_at?->format('d M Y H:i')] as $value) $table->addCell(1500)->addText((string) $value);
        }
        $path = storage_path('app/rekap-' . str($package->nama_package)->slug() . '-' . uniqid() . '.docx');
        WordIOFactory::createWriter($document, 'Word2007')->save($path);
        return response()->download($path, 'rekap-' . str($package->nama_package)->slug() . '.docx')->deleteFileAfterSend(true);
    }
}
