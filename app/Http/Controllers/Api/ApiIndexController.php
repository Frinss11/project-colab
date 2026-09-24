<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiIndexController extends Controller
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
                    'POST /api/student/login' => 'Login siswa dan dapatkan token Sanctum',
                    'GET /api/student/dashboard' => 'Ambil daftar mapel dan package untuk siswa',
                    'GET /api/student/package/{package}' => 'Ambil detail soal package',
                    'POST /api/student/package/{package}/submit' => 'Submit jawaban dan hitung skor',
                    'GET /api/student/leaderboard' => 'Ambil leaderboard siswa',
                    'GET /api' => 'Index endpoint API',
                ],
            ],
        ], 200);
    }
}
