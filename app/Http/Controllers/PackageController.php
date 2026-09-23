<?php

namespace App\Http\Controllers;

use App\Models\PackageModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'mapel_id'           => 'required|exists:mapel,id',
            'nama_package'      => 'required|string|max:150',
            'durasi'            => 'nullable|integer|min:1',
            'keterangan_package' => 'nullable|string',
        ]);

        $validated['jumlah_butir'] = 0;

        PackageModel::create($validated);

        return redirect()
            ->route('mapel.show', $validated['mapel_id'])
            ->with('success', 'Package soal berhasil ditambahkan.');
    }

    public function show(PackageModel $package)
    {
        $package->load(['mapel', 'soal']);

        return view('content.detail_package', compact('package'));
    }
}
