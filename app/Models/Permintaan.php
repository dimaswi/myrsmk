<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;
    protected $table = 'tb_permintaan';
    protected $fillable = [
        'nomor_permintaan',
        'nomor',
        'unit',
        'tanggal',
        'nama_barang',
        'id_barang',
        'jumlah',
        'harga',
        'status',
        'tanda_terima',
        'surat',
    ];

    public function scopeSearch( $query, $value)
    {
        $query->where('nomor_permintaan','LIKE', "%{$value}%")
        ->orWhere('nama_barang','LIKE', "%{$value}%")
        ->orWhere('unit','LIKE', "%{$value}%");
    }
}
