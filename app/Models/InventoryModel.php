<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryModel extends Model
{
    use HasFactory;
    protected $table = 'inventory';
    protected $fillable = [
        'mapel_id',
        'jumlah_soal',
        'tingkat_kesulitan',
        'semester',
    ];
}
