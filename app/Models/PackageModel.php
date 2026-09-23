<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageModel extends Model
{
    protected $table = 'packages';

    protected $fillable = [
        'mapel_id',
        'nama_package',
        'jumlah_butir',
        'durasi',
        'keterangan_package',
    ];

    public function getJumlahButirAttribute($value): int
    {
        if ($this->relationLoaded('soal')) {
            return (int) $this->soal->count();
        }

        return (int) $this->soal()->count();
    }

    public function mapel()
    {
        return $this->belongsTo(Tambah_mapelModel::class, 'mapel_id');
    }

    public function soal()
    {
        return $this->hasMany(SoalModel::class, 'package_id');
    }

    public function nilai()
    {
        return $this->hasMany(RekapNilaiModel::class, 'package_id');
    }
}
