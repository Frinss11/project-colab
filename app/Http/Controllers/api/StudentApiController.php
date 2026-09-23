<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PackageModel;
use App\Models\RekapNilaiModel;
use App\Models\Tambah_mapelModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class StudentApiController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Kredensial tidak valid.'],
            ]);
        }

        if (! in_array($user->role, ['siswa', 'student'], true)) {
            return response()->json([
                'success' => false,
                'message' => 'Akses hanya untuk akun siswa.',
            ], 403);
        }

        $token = $user->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login siswa berhasil.',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                ],
                'token' => $token,
            ],
        ], 200);
    }

    public function dashboard()
    {
        $this->ensureStudent();

        $mapels = Tambah_mapelModel::with(['packages' => function ($query) {
            $query->withCount('soal')->latest('updated_at');
        }])->get()->map(function ($mapel) {
            return [
                'id' => $mapel->id,
                'nama_mapel' => $mapel->nama_mapel,
                'kode_mapel' => $mapel->kode_mapel,
                'keterangan' => $mapel->keterangan,
                'gambar' => $mapel->gambar,
                'packages' => $mapel->packages->map(function ($package) {
                    return [
                        'id' => $package->id,
                        'nama_package' => $package->nama_package,
                        'durasi' => $package->durasi,
                        'keterangan_package' => $package->keterangan_package,
                        'jumlah_soal' => $package->soal_count,
                    ];
                })->values(),
            ];
        })->values();

        return response()->json([
            'success' => true,
            'message' => 'Data dashboard siswa berhasil diambil.',
            'data' => $mapels,
        ], 200);
    }

    public function showExam(PackageModel $package)
    {
        $this->ensureStudent();
        $package->load(['mapel', 'soal']);

        if ($package->soal->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Package belum memiliki soal.',
                'data' => null,
            ], 404);
        }

        $payload = [
            'id' => $package->id,
            'nama_package' => $package->nama_package,
            'durasi' => $package->durasi,
            'keterangan_package' => $package->keterangan_package,
            'mapel' => [
                'id' => $package->mapel?->id,
                'nama_mapel' => $package->mapel?->nama_mapel,
                'kode_mapel' => $package->mapel?->kode_mapel,
            ],
            'questions' => $package->soal->map(function ($question) {
                return [
                    'id' => $question->id,
                    'pertanyaan' => $question->pertanyaan,
                    'pilihan_a' => $question->pilihan_a,
                    'pilihan_b' => $question->pilihan_b,
                    'pilihan_c' => $question->pilihan_c,
                    'pilihan_d' => $question->pilihan_d,
                    'pilihan_e' => $question->pilihan_e,
                ];
            })->values(),
        ];

        return response()->json([
            'success' => true,
            'message' => 'Data package berhasil diambil.',
            'data' => $payload,
        ], 200);
    }

    public function submitExam(Request $request, PackageModel $package)
    {
        $this->ensureStudent();
        $request->validate([
            'answers' => ['required', 'array'],
        ]);

        $package->load('soal', 'mapel');
        $answers = $request->input('answers', []);
        $total = $package->soal->count();

        $correct = $package->soal->filter(function ($question) use ($answers) {
            return strtoupper((string) ($answers[$question->id] ?? '')) === strtoupper((string) $question->jawaban);
        })->count();

        $wrong = max($total - $correct, 0);
        $score = $total > 0 ? (int) round(($correct / $total) * 100) : 0;

        RekapNilaiModel::updateOrCreate(
            ['package_id' => $package->id, 'users_id' => Auth::id()],
            [
                'mapel' => $package->mapel?->nama_mapel ?? '-',
                'nilai' => $score,
                'keterangan' => $score >= 75 ? 'Lulus' : 'Remedial',
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Jawaban berhasil dikirim.',
            'data' => [
                'package_id' => $package->id,
                'package_name' => $package->nama_package,
                'total_soal' => $total,
                'jawaban_benar' => $correct,
                'jawaban_salah' => $wrong,
                'score' => $score,
            ],
        ], 200);
    }

    public function leaderboard()
    {
        $this->ensureStudent();

        $leaderboard = RekapNilaiModel::with(['user', 'package'])
            ->orderByDesc('nilai')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama_siswa' => $item->user?->name,
                    'mapel' => $item->mapel,
                    'nilai' => $item->nilai,
                    'keterangan' => $item->keterangan,
                    'package_name' => $item->package?->nama_package,
                ];
            })->values();

        return response()->json([
            'success' => true,
            'message' => 'Data leaderboard berhasil diambil.',
            'data' => $leaderboard,
        ], 200);
    }

    private function ensureStudent(): void
    {
        abort_unless(in_array(Auth::user()?->role, ['siswa', 'student'], true), 403, 'Akses hanya untuk siswa.');
    }
}
