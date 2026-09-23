<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tambah_mapelModel extends Model
{
    protected $table = 'mapel';
    protected $fillable = [
        'nama_mapel',
        'kode_mapel',
        'gambar',
        'keterangan',
        'fase_class'
    ];
    public function inventory()
    {
        return $this->hasOne(InventoryModel::class, 'mapel_id');
    }

    public function packages()
    {
        return $this->hasMany(PackageModel::class, 'mapel_id');
    }
}
