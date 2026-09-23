<?php

namespace App\Http\Controllers;

use App\Models\Tambah_mapelModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StudentDashboardController extends Controller
{
    public function index(): View
    {
        $this->ensureStudent();

        $mapels = Tambah_mapelModel::with(['packages' => function ($query) {
            $query->withCount('soal')->latest('updated_at');
        }])->get();

        return view('content.student_dashboard', compact('mapels'));
    }

    private function ensureStudent(): void
    {
        abort_unless(in_array(Auth::user()?->role, ['siswa', 'student'], true), 403);
    }
}
