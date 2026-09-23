<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekapNilaiModel extends Model
{
    protected $table = 'rekap_nilai';

    protected $fillable = [
        'package_id',
        'users_id',
        'mapel',
        'nilai',
        'keterangan',
    ];

    public function package()
    {
        return $this->belongsTo(PackageModel::class, 'package_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
