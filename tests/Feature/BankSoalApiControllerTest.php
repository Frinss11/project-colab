<?php

use App\Models\InventoryModel;
use App\Models\PackageModel;
use App\Models\SoalModel;
use App\Models\Tambah_mapelModel;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

it('accepts and stores an uploaded mapel image', function () {
    Storage::fake('public');

    $teacher = User::factory()->create(['role' => 'guru']);
    $token = $teacher->createToken('test')->plainTextToken;

    $response = $this->withToken($token)
        ->withHeader('Accept', 'application/json')
        ->post('/api/admin/mapels', [
            'nama_mapel' => 'Matematika',
            'kode_mapel' => 'MAT-01',
            'fase_class' => 'Kelas X',
            'keterangan' => 'Pelajaran matematika',
            'gambar' => UploadedFile::fake()->image('matematika.png'),
        ]);

    $response->assertCreated()
        ->assertJsonPath('success', true);

    $mapel = Tambah_mapelModel::firstOrFail();

    expect($mapel->gambar)->toStartWith('mapel/');
    Storage::disk('public')->assertExists($mapel->gambar);
});

it('updates mapel inventory when a question is added to a package', function () {
    $teacher = User::factory()->create(['role' => 'guru']);
    $token = $teacher->createToken('test')->plainTextToken;

    $mapel = Tambah_mapelModel::create([
        'nama_mapel' => 'Fisika',
        'kode_mapel' => 'FIS-01',
        'fase_class' => 'Kelas XI',
        'keterangan' => 'Pelajaran fisika',
    ]);

    $existingPackage = PackageModel::create([
        'mapel_id' => $mapel->id,
        'nama_package' => 'Paket lama',
    ]);
    $targetPackage = PackageModel::create([
        'mapel_id' => $mapel->id,
        'nama_package' => 'Paket baru',
    ]);

    SoalModel::create([
        'package_id' => $existingPackage->id,
        'pertanyaan' => 'Soal lama?',
        'pilihan_a' => 'A',
        'pilihan_b' => 'B',
        'pilihan_c' => 'C',
        'pilihan_d' => 'D',
        'pilihan_e' => 'E',
        'jawaban' => 'A',
    ]);

    InventoryModel::create([
        'mapel_id' => $mapel->id,
        'jumlah_soal' => 0,
        'tingkat_kesulitan' => 'Sedang',
        'semester' => 'Ganjil',
    ]);

    $response = $this->withToken($token)
        ->withHeader('Accept', 'application/json')
        ->postJson('/api/admin/questions', [
            'package_id' => $targetPackage->id,
            'pertanyaan' => 'Soal baru?',
            'pilihan_a' => 'A',
            'pilihan_b' => 'B',
            'pilihan_c' => 'C',
            'pilihan_d' => 'D',
            'pilihan_e' => 'E',
            'jawaban' => 'B',
        ]);

    $response->assertCreated()
        ->assertJsonPath('success', true);

    $targetPackage->refresh();
    $inventory = InventoryModel::where('mapel_id', $mapel->id)->firstOrFail();

    expect($targetPackage->jumlah_butir)->toBe(1)
        ->and($inventory->jumlah_soal)->toBe(2)
        ->and($inventory->tingkat_kesulitan)->toBe('Sedang')
        ->and($inventory->semester)->toBe('Ganjil');
});
