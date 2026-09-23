<?php

use App\Http\Controllers\Api\AdminApiController;
use App\Http\Controllers\Api\ApiIndexController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\StudentApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [ApiIndexController::class, 'index'])->name('api.index');

Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/teacher/login', [AuthApiController::class, 'loginTeacher']);
Route::post('/student/login', [AuthApiController::class, 'loginStudent']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/me', [AuthApiController::class, 'me']);
    Route::post('/logout', [AuthApiController::class, 'logout']);

    Route::get('/admin/dashboard', [AdminApiController::class, 'dashboard']);
    Route::get('/admin/mapels', [AdminApiController::class, 'mapels']);
    Route::post('/admin/mapels', [AdminApiController::class, 'storeMapel']);
    Route::get('/admin/mapels/{mapel}', [AdminApiController::class, 'showMapel']);
    Route::get('/admin/packages', [AdminApiController::class, 'packages']);
    Route::post('/admin/packages', [AdminApiController::class, 'storePackage']);
    Route::get('/admin/packages/{package}', [AdminApiController::class, 'showPackage']);
    Route::post('/admin/questions', [AdminApiController::class, 'storeQuestion']);
    Route::get('/admin/rekap', [AdminApiController::class, 'rekapNilai']);
    Route::get('/admin/users', [AdminApiController::class, 'users']);
    Route::post('/admin/users', [AdminApiController::class, 'createUser']);

    Route::get('/student/dashboard', [StudentApiController::class, 'dashboard']);
    Route::get('/student/package/{package}', [StudentApiController::class, 'showExam']);
    Route::post('/student/package/{package}/submit', [StudentApiController::class, 'submitExam']);
    Route::get('/student/leaderboard', [StudentApiController::class, 'leaderboard']);
});
