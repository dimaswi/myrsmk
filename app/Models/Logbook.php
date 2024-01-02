<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;
    protected $table = 'tb_logbook';
    protected $fillable = [
        'nama',
        'unit',
        'shift',
        'jam_kerja',
        'kegiatan',
        'lokasi',
        'bersama',
        'uid',
    ];

    public function scopeSearch( $query, $value)
    {
        $query->where('nama','LIKE', "%{$value}%")
        ->orWhere('kegiatan','LIKE', "%{$value}%")
        ->orWhere('lokasi','LIKE', "%{$value}%")
        ->orWhere('bersama','LIKE', "%{$value}%");
    }
}
