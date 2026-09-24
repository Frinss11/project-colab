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

class AdminApiController extends Controller
{
    public function dashboard()
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

        $nilai = RekapNilaiModel::with(['user', 'package.mapel'])
            ->latest()
            ->get();

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

    private function ensureTeacher(): void
    {
        abort_unless(in_array(Auth::user()?->role, ['admin', 'guru'], true), 403, 'Akses hanya untuk admin/guru.');
    }

    private function ensureAdmin(): void
    {
        abort_unless(Auth::user()?->role === 'admin', 403, 'Akses hanya untuk admin.');
    }
}
