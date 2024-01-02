<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $table = 'tb_unit';
    protected $fillable = [
        'bagian',
        'nama',
        'kepala',
        'kode'
    ];

    public function scopeSearch( $query, $value)
    {
        $query->where('nama','LIKE', "%{$value}%")->orWhere('kepala','LIKE', "%{$value}%")->orWhere('kode','LIKE', "%{$value}%");
    }
}
