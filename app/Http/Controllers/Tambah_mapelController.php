<?php

namespace App\Http\Controllers;


use App\Models\InventoryModel;
use App\Models\Tambah_mapelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Tambah_mapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mapel = Tambah_mapelModel::with('inventory')->latest()->get();
        return view('content.inventory', compact('mapel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content.tambah_mapel');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi input form
        $request->validate([
            'nama_mapel'        => 'required|string|max:100',
            'kode_mapel'        => 'required|unique:mapel,kode_mapel|max:20',
            'gambar'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'fase_class'        => 'nullable|string|max:50',
            'tingkat_kesulitan' => 'nullable|string|max:50',
            'semester'          => 'nullable|string|max:20',
            'keterangan'        => 'nullable|string',
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
                'fase_class' => $request->fase_class,
                'keterangan' => $request->keterangan,
            ]);

            // 3. Simpan data detail soal ke tabel inventory
            InventoryModel::create([
                'mapel_id'          => $mapel->id,
                'jumlah_soal'       => 0,
                'tingkat_kesulitan' => $request->tingkat_kesulitan,
                'semester'          => $request->semester,
            ]);

            DB::commit();

            return redirect()->route('inventory')->with('success', 'Mata pelajaran dan inventory soal berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $mapel = Tambah_mapelModel::with(['inventory', 'packages'])->findOrFail($id);

        return view('content.detail_mapel', compact('mapel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tambah_mapelModel $tambah_mapelModel)
    {
        return view('content.edit_mapel', compact('tambah_mapelModel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tambah_mapelModel $tambah_mapelModel) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tambah_mapelModel $tambah_mapelModel)
    {
        //
    }
}
