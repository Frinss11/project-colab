<?php

use App\Http\Controllers\Api\BankSoalApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [BankSoalApiController::class, 'index'])->name('api.index');

Route::post('/login', [BankSoalApiController::class, 'login']);
Route::post('/register', [BankSoalApiController::class, 'register']);
Route::post('/auth/login', [BankSoalApiController::class, 'login']);
Route::post('/auth/register', [BankSoalApiController::class, 'register']);
Route::post('/teacher/login', [BankSoalApiController::class, 'loginTeacher']);
Route::post('/student/login', [BankSoalApiController::class, 'loginStudent']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/me', [BankSoalApiController::class, 'me']);
    Route::post('/logout', [BankSoalApiController::class, 'logout']);

    Route::get('/admin/dashboard', [BankSoalApiController::class, 'adminDashboard']);
    Route::get('/admin/mapels', [BankSoalApiController::class, 'mapels']);
    Route::post('/admin/mapels', [BankSoalApiController::class, 'storeMapel']);
    Route::get('/admin/mapels/{mapel}', [BankSoalApiController::class, 'showMapel']);
    Route::get('/admin/packages', [BankSoalApiController::class, 'packages']);
    Route::post('/admin/packages', [BankSoalApiController::class, 'storePackage']);
    Route::get('/admin/packages/{package}', [BankSoalApiController::class, 'showPackage']);
    Route::post('/admin/questions', [BankSoalApiController::class, 'storeQuestion']);
    Route::get('/admin/rekap', [BankSoalApiController::class, 'rekapNilai']);
    Route::get('/admin/users', [BankSoalApiController::class, 'users']);
    Route::post('/admin/users', [BankSoalApiController::class, 'createUser']);

    Route::get('/student/dashboard', [BankSoalApiController::class, 'studentDashboard']);
    Route::get('/student/package/{package}', [BankSoalApiController::class, 'showExam']);
    Route::post('/student/package/{package}/submit', [BankSoalApiController::class, 'submitExam']);
    Route::get('/student/leaderboard', [BankSoalApiController::class, 'studentLeaderboard']);
});
