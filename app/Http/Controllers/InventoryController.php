<?php

namespace App\Http\Controllers;

use App\Models\InventoryModel;
use App\Models\Tambah_mapelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi input form (disesuaikan dengan atribut soal/pelajaran)
        $request->validate([
            'nama_mapel'        => 'required|string|max:100',
            'kode_mapel'        => 'required|unique:mapel,kode_mapel|max:20',
            'gambar'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'keterangan'        => 'nullable|string',
            'fase_class'        => 'nullable|string|max:50',
            'tingkat_kesulitan' => 'nullable|string|max:50',
            'semester'          => 'nullable|string|max:20',
        ]);

        DB::beginTransaction();

        try {
            // Handle upload gambar jika ada
            $gambarPath = null;
            if ($request->hasFile('gambar')) {
                $gambarPath = $request->file('gambar')->store('mapel', 'public');
            }

            // 2. Simpan data ke tabel mapel
            $mapel = Tambah_mapelModel::create([
                'nama_mapel' => $request->nama_mapel,
                'kode_mapel' => $request->kode_mapel,
                'gambar'     => $gambarPath,
                'keterangan' => $request->keterangan,
                'fase_class' => $request->fase_class,
            ]);

            // 3. Simpan data detail soal/pelajaran ke tabel inventory
            InventoryModel::create([
                'mapel_id'          => $mapel->id,
                'jumlah_soal'       => 0,
                'tingkat_kesulitan' => $request->tingkat_kesulitan,
                'semester'          => $request->semester,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Mata pelajaran dan detail soal berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
