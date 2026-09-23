<?php

namespace App\Http\Controllers;

use App\Models\PackageModel;
use App\Models\SoalModel;
use App\Models\Tambah_mapelModel;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $packages = PackageModel::with('mapel')
            ->withCount('soal')
            ->orderByDesc('updated_at')
            ->orderByDesc('id')
            ->limit(8)
            ->get();

        return view('content.dashboard', [
            'packages' => $packages,
            'totalSoal' => SoalModel::count(),
            'totalPackages' => PackageModel::count(),
            'totalMapel' => Tambah_mapelModel::count(),
            'totalSiswa' => User::whereIn('role', ['siswa', 'student'])->count(),
        ]);
    }
}
