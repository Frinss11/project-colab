<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InventoryModel;
use App\Models\PackageModel;
use App\Models\RekapNilaiModel;
use App\Models\SoalModel;
use App\Models\Tambah_mapelModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class BankSoalApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'API Bank Soal index',
            'data' => [
                'app_name' => 'Bank Soal',
                'version' => '1.0.0',
                'base_url' => url('/api'),
                'endpoints' => [
                    'POST /api/login' => 'Login umum (admin/guru/siswa)',
                    'POST /api/register' => 'Register publik untuk siswa',
                    'POST /api/auth/login' => 'Alias login umum',
                    'POST /api/teacher/login' => 'Login khusus guru/admin',
                    'POST /api/student/login' => 'Login khusus siswa',
                    'GET /api/me' => 'Ambil data user yang sedang login',
                    'POST /api/logout' => 'Logout token Sanctum',
                    'GET /api/admin/dashboard' => 'Dashboard admin/guru',
                    'GET /api/admin/inventory' => 'Daftar inventory mapel',
                    'GET /api/admin/inventory/{mapel}' => 'Detail inventory mapel',
                    'POST /api/admin/inventory' => 'Simpan atau update inventory mapel',
                    'GET /api/admin/mapels' => 'Daftar mata pelajaran',
                    'POST /api/admin/mapels' => 'Tambah mapel',
                    'GET /api/admin/packages' => 'Daftar package',
                    'POST /api/admin/packages' => 'Tambah package',
                    'POST /api/admin/questions' => 'Tambah soal',
                    'GET /api/admin/rekap' => 'Rekap nilai',
                    'GET /api/admin/users' => 'Daftar user',
                    'POST /api/admin/users' => 'Tambah user',
                    'GET /api/student/dashboard' => 'Dashboard siswa',
                    'GET /api/student/package/{package}' => 'Detail package dan soal',
                    'POST /api/student/package/{package}/submit' => 'Submit jawaban',
                    'GET /api/student/leaderboard' => 'Leaderboard siswa',
                    'GET /api' => 'Index endpoint API',
                ],
            ],
        ], 200);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['nullable', Rule::in(['siswa', 'student'])],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'] ?? 'siswa',
        ]);

        $token = $user->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registrasi siswa berhasil.',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                ],
                'token' => $token,
            ],
        ], 201);
    }

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

        return $this->buildLoginResponse($user);
    }

    public function loginTeacher(Request $request)
    {
        return $this->loginByRole($request, ['admin', 'guru']);
    }

    public function loginStudent(Request $request)
    {
        return $this->loginByRole($request, ['siswa', 'student']);
    }

    public function me()
    {
        return response()->json([
            'success' => true,
            'data' => Auth::user(),
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $user->tokens()->delete();
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil.',
        ]);
    }

    public function adminDashboard()
    {
        $this->ensureTeacher();

        return response()->json([
            'success' => true,
            'data' => [
                'total_mapel' => Tambah_mapelModel::count(),
                'total_package' => PackageModel::count(),
                'total_soal' => SoalModel::count(),
                'total_siswa' => User::whereIn('role', ['siswa', 'student'])->count(),
                'total_guru' => User::whereIn('role', ['admin', 'guru'])->count(),
                'recent_packages' => PackageModel::with(['mapel'])->withCount('soal')->latest()->limit(8)->get(),
            ],
        ], 200);
    }

    public function inventory()
    {
        $this->ensureTeacher();

        $inventory = Tambah_mapelModel::with('inventory')->get()->map(function ($mapel) {
            return [
                'mapel_id' => $mapel->id,
                'nama_mapel' => $mapel->nama_mapel,
                'kode_mapel' => $mapel->kode_mapel,
                'jumlah_soal' => $mapel->inventory?->jumlah_soal ?? 0,
                'tingkat_kesulitan' => $mapel->inventory?->tingkat_kesulitan,
                'semester' => $mapel->inventory?->semester,
                'inventory' => $mapel->inventory,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $inventory,
        ], 200);
    }

    public function showInventory(Tambah_mapelModel $mapel)
    {
        $this->ensureTeacher();

        $mapel->load('inventory');

        return response()->json([
            'success' => true,
            'data' => [
                'mapel_id' => $mapel->id,
                'nama_mapel' => $mapel->nama_mapel,
                'kode_mapel' => $mapel->kode_mapel,
                'jumlah_soal' => $mapel->inventory?->jumlah_soal ?? 0,
                'tingkat_kesulitan' => $mapel->inventory?->tingkat_kesulitan,
                'semester' => $mapel->inventory?->semester,
                'inventory' => $mapel->inventory,
            ],
        ], 200);
    }

    public function storeInventory(Request $request)
    {
        $this->ensureTeacher();

        $validated = $request->validate([
            'mapel_id' => ['required', 'exists:mapel,id'],
            'jumlah_soal' => ['nullable', 'integer', 'min:0'],
            'tingkat_kesulitan' => ['nullable', 'string', 'max:50'],
            'semester' => ['nullable', 'string', 'max:20'],
        ]);

        $realCount = $validated['jumlah_soal'] ?? PackageModel::where('mapel_id', $validated['mapel_id'])
            ->withCount('soal')
            ->get()
            ->sum('soal_count');

        $inventory = InventoryModel::updateOrCreate(
            ['mapel_id' => $validated['mapel_id']],
            [
                'jumlah_soal' => (int) $realCount,
                'tingkat_kesulitan' => $validated['tingkat_kesulitan'] ?? null,
                'semester' => $validated['semester'] ?? null,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Inventory mapel berhasil disimpan.',
            'data' => $inventory,
        ], 200);
    }

    public function mapels()
    {
        $this->ensureTeacher();

        $mapels = Tambah_mapelModel::with(['inventory', 'packages' => function ($query) {
            $query->withCount('soal');
        }])->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $mapels,
        ], 200);
    }

    public function storeMapel(Request $request)
    {
        $this->ensureTeacher();

        $validated = $request->validate([
            'nama_mapel' => ['required', 'string', 'max:100'],
            'kode_mapel' => ['required', 'string', 'max:20', 'unique:mapel,kode_mapel'],
            'gambar' => ['nullable', 'string'],
            'fase_class' => ['nullable', 'string', 'max:50'],
            'tingkat_kesulitan' => ['nullable', 'string', 'max:50'],
            'semester' => ['nullable', 'string', 'max:20'],
            'keterangan' => ['nullable', 'string'],
        ]);

        DB::beginTransaction();

        try {
            $gambarPath = null;

            if ($request->hasFile('gambar')) {
                $gambarPath = $request->file('gambar')->store('mapel', 'public');
            } elseif (! empty($validated['gambar'])) {
                $gambarPath = $validated['gambar'];
            }

            $mapel = Tambah_mapelModel::create([
                'nama_mapel' => $validated['nama_mapel'],
                'kode_mapel' => $validated['kode_mapel'],
                'gambar' => $gambarPath,
                'fase_class' => $validated['fase_class'] ?? null,
                'keterangan' => $validated['keterangan'] ?? null,
            ]);

            InventoryModel::create([
                'mapel_id' => $mapel->id,
                'jumlah_soal' => 0,
                'tingkat_kesulitan' => $validated['tingkat_kesulitan'] ?? null,
                'semester' => $validated['semester'] ?? null,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Mata pelajaran berhasil ditambahkan.',
                'data' => $mapel->load('inventory'),
            ], 201);
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan mata pelajaran.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function showMapel(Tambah_mapelModel $mapel)
    {
        $this->ensureTeacher();

        $mapel->load(['inventory', 'packages' => function ($query) {
            $query->withCount('soal')->latest();
        }]);

        return response()->json([
            'success' => true,
            'data' => $mapel,
        ], 200);
    }

    public function packages()
    {
        $this->ensureTeacher();

        $packages = PackageModel::with(['mapel', 'soal'])->withCount('soal')->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $packages,
        ], 200);
    }

    public function storePackage(Request $request)
    {
        $this->ensureTeacher();

        $validated = $request->validate([
            'mapel_id' => ['required', 'exists:mapel,id'],
            'nama_package' => ['required', 'string', 'max:150'],
            'durasi' => ['nullable', 'integer', 'min:1'],
            'keterangan_package' => ['nullable', 'string'],
        ]);

        $validated['jumlah_butir'] = 0;

        $package = PackageModel::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Package berhasil ditambahkan.',
            'data' => $package,
        ], 201);
    }

    public function showPackage(PackageModel $package)
    {
        $this->ensureTeacher();

        $package->load(['mapel', 'soal']);

        return response()->json([
            'success' => true,
            'data' => $package,
        ], 200);
    }

    public function storeQuestion(Request $request)
    {
        $this->ensureTeacher();

        $validated = $request->validate([
            'package_id' => ['required', 'exists:packages,id'],
            'pertanyaan' => ['required', 'string'],
            'pilihan_a' => ['required', 'string', 'max:255'],
            'pilihan_b' => ['required', 'string', 'max:255'],
            'pilihan_c' => ['required', 'string', 'max:255'],
            'pilihan_d' => ['required', 'string', 'max:255'],
            'pilihan_e' => ['required', 'string', 'max:255'],
            'jawaban' => ['required', 'in:A,B,C,D,E'],
        ]);

        $question = SoalModel::create($validated);
        $package = PackageModel::withCount('soal')->findOrFail($validated['package_id']);
        $package->update(['jumlah_butir' => (int) $package->soal_count]);

        return response()->json([
            'success' => true,
            'message' => 'Soal berhasil ditambahkan.',
            'data' => $question,
        ], 201);
    }

    public function rekapNilai()
    {
        $this->ensureTeacher();

        $nilai = RekapNilaiModel::with(['user', 'package.mapel'])->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $nilai,
        ], 200);
    }

    public function users()
    {
        $this->ensureAdmin();

        return response()->json([
            'success' => true,
            'data' => User::select('id', 'name', 'email', 'role')->latest()->get(),
        ], 200);
    }

    public function createUser(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'role' => ['required', Rule::in(['admin', 'guru', 'siswa', 'student'])],
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dibuat.',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ],
        ], 201);
    }

    public function studentDashboard()
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

    public function studentLeaderboard()
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

    private function loginByRole(Request $request, array $allowedRoles)
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

        if (! in_array($user->role, $allowedRoles, true)) {
            return response()->json([
                'success' => false,
                'message' => 'Role akun tidak sesuai untuk endpoint ini.',
            ], 403);
        }

        return $this->buildLoginResponse($user);
    }

    private function buildLoginResponse(User $user)
    {
        $user->tokens()->delete();
        $token = $user->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil.',
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

    private function ensureTeacher(): void
    {
        abort_unless(in_array(Auth::user()?->role, ['admin', 'guru'], true), 403, 'Akses hanya untuk admin/guru.');
    }

    private function ensureAdmin(): void
    {
        abort_unless(Auth::user()?->role === 'admin', 403, 'Akses hanya untuk admin.');
    }

    private function ensureStudent(): void
    {
        abort_unless(in_array(Auth::user()?->role, ['siswa', 'student'], true), 403, 'Akses hanya untuk siswa.');
    }
}
