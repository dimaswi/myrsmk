<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    use HasFactory;
    protected $table = 'tb_bagian';
    protected $fillable = [
        'nama',
        'kepala',
        'kode'
    ];

    public function scopeSearch( $query, $value)
    {
        $query->where('nama','LIKE', "%{$value}%")->orWhere('kepala','LIKE', "%{$value}%")->orWhere('kode','LIKE', "%{$value}%");
    }
}
