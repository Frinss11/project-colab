<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RekapNilaiController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\Tambah_mapelController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentExamController;
use App\Http\Controllers\StudentLeaderboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->role;

        if (in_array($role, ['siswa', 'student'], true)) {
            return redirect()->route('student.dashboard');
        }

        return redirect()->route('dashboard');
    }

    return view('auth.login');
});

Route::get('/view-index', function () {
    $views = collect(File::allFiles(resource_path('views')))
        ->filter(fn ($file) => str_ends_with($file->getFilename(), '.blade.php'))
        ->map(fn ($file) => str_replace('\\', '/', $file->getRelativePathname()))
        ->sort()
        ->values();

    return view('index', ['views' => $views]);
})->name('view.index');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
});

Route::middleware('guest')->group(function () {
    Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
    Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/rekap_nilai', [RekapNilaiController::class, 'index'])->name('rekap_nilai');
Route::get('/rekap_nilai/{package}/excel', [RekapNilaiController::class, 'exportExcel'])->name('rekap_nilai.excel');
Route::get('/rekap_nilai/{package}/word', [RekapNilaiController::class, 'exportWord'])->name('rekap_nilai.word');
Route::get('/inventory', [Tambah_mapelController::class, 'index'])->name('inventory');
Route::get('/inventory/tambah', [Tambah_mapelController::class, 'create'])->name('mapel.create');
Route::get('/inventory/{id}', [Tambah_mapelController::class, 'show'])->name('mapel.show');
Route::post('/inventory', [Tambah_mapelController::class, 'store'])->name('mapel.store');
Route::post('/packages', [PackageController::class, 'store'])->name('package.store');
Route::get('/packages/{package}', [PackageController::class, 'show'])->name('package.show');
Route::get('/tambah_soal', [SoalController::class, 'create'])->name('tambah_soal');
Route::get('/soal', [SoalController::class, 'index'])->name('soal.index');
Route::post('/soal', [SoalController::class, 'store'])->name('soal.store');
Route::post('/soal/generate-ai', [SoalController::class, 'generateAi'])->name('soal.generate-ai');
Route::post('/soal/import', [SoalController::class, 'import'])->name('soal.import');

Route::middleware('auth')->prefix('siswa')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/package/{package}', [StudentExamController::class, 'show'])->name('student.exam');
    Route::post('/package/{package}', [StudentExamController::class, 'submit'])->name('student.exam.submit');
    Route::get('/leaderboard', [StudentLeaderboardController::class, 'index'])->name('student.leaderboard');
});

require __DIR__.'/auth.php';
