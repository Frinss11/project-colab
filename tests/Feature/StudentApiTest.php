<?php

use App\Models\PackageModel;
use App\Models\SoalModel;
use App\Models\Tambah_mapelModel;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

it('student can login, view package list, and submit answers', function () {
    $user = User::factory()->create([
        'role' => 'siswa',
        'password' => Hash::make('password123'),
    ]);

    $mapel = Tambah_mapelModel::create([
        'nama_mapel' => 'Matematika',
        'kode_mapel' => 'MAT',
        'keterangan' => 'Ujian harian',
        'fase_class' => 'Fase D',
    ]);

    $package = PackageModel::create([
        'mapel_id' => $mapel->id,
        'nama_package' => 'UTS Matematika',
        'jumlah_butir' => 1,
        'durasi' => 15,
        'keterangan_package' => 'Ujian semester',
    ]);

    $question = SoalModel::create([
        'package_id' => $package->id,
        'pertanyaan' => '2 + 2 = ?',
        'pilihan_a' => '3',
        'pilihan_b' => '4',
        'pilihan_c' => '5',
        'pilihan_d' => '6',
        'pilihan_e' => '7',
        'jawaban' => 'B',
    ]);

    $loginResponse = $this->postJson('/api/student/login', [
        'email' => $user->email,
        'password' => 'password123',
    ]);

    $loginResponse->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.user.role', 'siswa');

    $token = $loginResponse->json('data.token');

    $dashboardResponse = $this->withHeader('Authorization', 'Bearer '.$token)
        ->getJson('/api/student/dashboard');

    $dashboardResponse->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.0.packages.0.nama_package', 'UTS Matematika');

    $examResponse = $this->withHeader('Authorization', 'Bearer '.$token)
        ->getJson('/api/student/package/'.$package->id);

    $examResponse->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.questions.0.id', $question->id);

    $submitResponse = $this->withHeader('Authorization', 'Bearer '.$token)
        ->postJson('/api/student/package/'.$package->id.'/submit', [
            'answers' => [
                $question->id => 'B',
            ],
        ]);

    $submitResponse->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.score', 100)
        ->assertJsonPath('data.jawaban_benar', 1);
});

it('student can register through public api endpoint without auto-login', function () {
    $response = $this->postJson('/api/register', [
        'name' => 'Siswa Baru',
        'email' => 'siswa.baru@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.user.role', 'siswa')
        ->assertJsonMissingPath('data.token')
        ->assertJsonPath('message', 'Registrasi berhasil. Silakan login untuk melanjutkan.');

    $this->assertDatabaseHas('users', [
        'email' => 'siswa.baru@example.com',
        'role' => 'siswa',
    ]);
});

it('api can send a password reset link to a registered user', function () {
    Notification::fake();

    $user = User::factory()->create([
        'email' => 'reset.user@example.com',
        'role' => 'siswa',
    ]);

    $response = $this->postJson('/api/forgot-password', [
        'email' => $user->email,
    ]);

    $response->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('message', 'Link reset password telah dikirim ke email Anda.');

    Notification::assertSentTo($user, ResetPassword::class);
});

it('web registration creates a student account and redirects to login without auto-login', function () {
    $response = $this->post('/register', [
        'name' => 'Siswa Web',
        'email' => 'siswa.web@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertRedirect('/login');

    $this->assertDatabaseHas('users', [
        'email' => 'siswa.web@example.com',
        'role' => 'siswa',
    ]);

    expect(auth()->check())->toBeFalse();
});

it('logout revokes all user tokens so stale sessions cannot stay active', function () {
    $user = User::factory()->create([
        'role' => 'siswa',
        'password' => Hash::make('password123'),
    ]);

    $firstToken = $user->createToken('mobile-app')->plainTextToken;
    $secondToken = $user->createToken('mobile-app')->plainTextToken;

    $this->withHeader('Authorization', 'Bearer '.$firstToken)
        ->postJson('/api/logout')
        ->assertOk()
        ->assertJsonPath('success', true);

    $user->refresh();

    expect($user->tokens()->count())->toBe(0)
        ->and($this->withHeader('Authorization', 'Bearer '.$firstToken)->getJson('/api/me')->status())->toBe(401)
        ->and($this->withHeader('Authorization', 'Bearer '.$secondToken)->getJson('/api/me')->status())->toBe(401);
});
