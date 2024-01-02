<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamKerja extends Model
{
    use HasFactory;
    protected $table = 'tb_jam_kerja';
    protected $fillable = [
        'jam_kerja',
        'shift',
    ];

    public function scopeSearch( $query, $value)
    {
        $query->where('jam_kerja','LIKE', "%{$value}%")->orWhere('shift', 'LIKE', "%{$value}%");
    }
}
