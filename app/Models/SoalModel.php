<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoalModel extends Model
{
    protected $table = 'soal';

    protected $fillable = [
        'package_id',
        'pertanyaan',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'pilihan_e',
        'jawaban',
    ];

    public function package()
    {
        return $this->belongsTo(PackageModel::class, 'package_id');
    }
}
