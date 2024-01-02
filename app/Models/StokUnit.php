<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokUnit extends Model
{
    use HasFactory;
    protected $table = 'tb_stok_unit';
    protected $fillable = [
        'unit',
        'nama_barang',
        'jenis_barang',
        'harga',
        'tanggal',
        'stok_masuk',
        'stok_sisa',
        'total_stok',
        'total_harga_stok',
        'total_harga_masuk',
        'total_harga_keluar',
    ];

    public function scopeSearch( $query, $value)
    {
        $query->where('nama_barang','LIKE', "%{$value}%")
        ->orWhere('tanggal','LIKE', "%{$value}%")
        ->orWhere('jenis_barang','LIKE', "%{$value}%");
    }
}
