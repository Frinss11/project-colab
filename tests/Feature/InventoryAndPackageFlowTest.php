<?php

use App\Models\PackageModel;
use App\Models\SoalModel;
use App\Models\Tambah_mapelModel;

it('menyimpan mapel tanpa field jumlah soal yang wajib diisi', function () {
    $response = $this->post(route('mapel.store'), [
        'nama_mapel' => 'Biologi',
        'kode_mapel' => 'BIO-01',
        'fase_class' => 'Kelas X (Fase E)',
        'tingkat_kesulitan' => 'Sedang',
        'semester' => 'Ganjil',
        'keterangan' => 'Mata pelajaran biologi dasar',
    ]);

    $response->assertRedirect(route('inventory'));
    $this->assertDatabaseHas('mapel', [
        'nama_mapel' => 'Biologi',
        'kode_mapel' => 'BIO-01',
    ]);
    $this->assertDatabaseHas('inventory', [
        'mapel_id' => Tambah_mapelModel::first()->id,
        'jumlah_soal' => 0,
    ]);
});

it('membuat package tanpa input jumlah butir dan menyesuaikan jumlah soal dari soal yang ditambahkan', function () {
    $mapel = Tambah_mapelModel::create([
        'nama_mapel' => 'Fisika',
        'kode_mapel' => 'FIS-01',
        'fase_class' => 'Kelas XI (Fase F)',
        'keterangan' => 'Mata pelajaran fisika',
    ]);

    $response = $this->post(route('package.store'), [
        'mapel_id' => $mapel->id,
        'nama_package' => 'Paket Ujian Fisika',
        'durasi' => 60,
        'keterangan_package' => 'Paket untuk ulangan harian',
    ]);

    $response->assertRedirect(route('mapel.show', $mapel->id));
    $this->assertDatabaseHas('packages', [
        'mapel_id' => $mapel->id,
        'nama_package' => 'Paket Ujian Fisika',
        'jumlah_butir' => 0,
    ]);

    $package = PackageModel::first();

    $this->post(route('soal.store'), [
        'package_id' => $package->id,
        'pertanyaan' => 'Satuan SI untuk gaya adalah?',
        'pilihan_a' => 'Meter',
        'pilihan_b' => 'Newton',
        'pilihan_c' => 'Joule',
        'pilihan_d' => 'Pascal',
        'pilihan_e' => 'Watt',
        'jawaban' => 'B',
    ])->assertRedirect(route('package.show', $package->id));

    $package->refresh();
    expect($package->jumlah_butir)->toBe(1);
    expect($package->soal()->count())->toBe(1);
});
