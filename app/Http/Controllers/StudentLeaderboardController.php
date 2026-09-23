<?php

namespace App\Http\Controllers;

use App\Models\RekapNilaiModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StudentLeaderboardController extends Controller
{
    public function index(): View
    {
        abort_unless(in_array(Auth::user()?->role, ['siswa', 'student'], true), 403);

        $results = RekapNilaiModel::with(['user', 'package.mapel'])
            ->whereNotNull('package_id')
            ->latest()
            ->get();

        $ranking = $results->groupBy('users_id')->map(function ($items) {
            $latest = $items->sortByDesc('created_at')->first();
            return (object) [
                'user' => $latest->user,
                'total' => $items->count(),
                'average' => round($items->avg('nilai'), 1),
                'best' => $items->max('nilai'),
            ];
        })->sortByDesc('average')->values();

        $myRank = $ranking->search(fn ($row) => $row->user?->id === Auth::id());

        return view('content.student_leaderboard', [
            'ranking' => $ranking,
            'myRank' => $myRank === false ? null : $myRank + 1,
            'myResults' => $results->where('users_id', Auth::id()),
        ]);
    }
}
