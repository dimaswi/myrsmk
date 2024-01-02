<?php

namespace App\Http\Livewire\Permintaan;

use App\Models\Stok;
use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;

class NamaBarangSelect extends LivewireSelect
{
    public function options($searchTerm = null): Collection
    {
        return Stok::where('nama_barang', 'LIKE', '%' . $searchTerm . '%')->get(['nama_barang'])->mapWithKeys(function ($item, $key) {
            return [$key => [
                'value' => $item->nama_barang,
                'description' => $item->nama_barang
            ]];
        });
    }
    public function selectedOption($value)
    {

        return [
            'value' => $value,
            'description' => $value
        ];
    }
}
