<?php

namespace App\Http\Controllers;

use App\Models\PackageModel;
use App\Models\RekapNilaiModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StudentExamController extends Controller
{
    public function show(PackageModel $package): View
    {
        $this->ensureStudent();
        $package->load(['mapel', 'soal']);

        abort_if($package->soal->isEmpty(), 404, 'Package belum memiliki soal.');

        return view('content.student_exam', [
            'package' => $package,
            'examResult' => session('exam_result'),
        ]);
    }

    public function submit(Request $request, PackageModel $package): RedirectResponse
    {
        $this->ensureStudent();
        $package->load('soal', 'mapel');

        $answers = $request->input('answers', []);
        $total = $package->soal->count();
        $correct = $package->soal->filter(fn ($question) => strtoupper((string) ($answers[$question->id] ?? '')) === strtoupper($question->jawaban))->count();
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

        return redirect()->route('student.exam', $package)
            ->with('exam_result', [
                'correct' => $correct,
                'wrong' => $wrong,
                'score' => $score,
                'total' => $total,
            ]);
    }

    private function ensureStudent(): void
    {
        abort_unless(in_array(Auth::user()?->role, ['siswa', 'student'], true), 403);
    }
}
