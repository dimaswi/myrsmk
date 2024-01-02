<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;
    protected $table = 'tb_stok';
    protected $fillable = [
        'nomor_barang',
        'nama_barang',
        'jenis_barang',
        'harga',
        'tanggal',
        'stok_awal',
        'stok_masuk',
        'stok_keluar',
        'total_stok',
        'stok_sisa',
        'total_harga_stok',
        'total_harga_masuk',
        'total_harga_keluar',
        'persentase',
    ];

    public function scopeSearch( $query, $value)
    {
        $query->where('nomor_barang','LIKE', "%{$value}%")
        ->orWhere('nama_barang','LIKE', "%{$value}%")
        ->orWhere('jenis_barang','LIKE', "%{$value}%");
    }
}
