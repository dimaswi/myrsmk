<?php

namespace App\Http\Livewire\Stok;

use App\Models\Stok;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Tersedia extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $search = '';
    public $perPage = 10;
    public $jenis_barang = '';
    public $jumlah = 0;
    public $editedStockIndex = null;
    public $nama_barang, $harga, $total_stok, $stok_keluar, $stok_awal;

    public function render()
    {
        return view('livewire.stok.tersedia', [
            'stoks' => Stok::where('persentase', '>', 50)->where('jenis_barang', $this->jenis_barang)->search($this->search)->paginate($this->perPage),
        ]);
    }

    public function editedStock($stockIndex, $id)
    {
        $data = Stok::where('id', $id)->first();
        $this->editedStockIndex = $stockIndex;
        $this->nama_barang = $data->nama_barang;
        $this->stok_awal = $data->stok_awal;
        $this->harga = $data->harga;
        $this->total_stok = $data->total_stok;
        $this->stok_keluar = $data->stok_keluar;
    }

    public function updateStok($id)
    {
        $data = Stok::where('id', $id)->first();

        try {
            Stok::where('id', $id)->update([
                'nama_barang' => $this->nama_barang,
                'harga' => $this->harga,
                'stok_masuk' => $this->jumlah,
                'stok_awal' => $this->stok_awal,
                'total_stok' => $this->total_stok,
                'persentase' => (($this->total_stok + $this->jumlah) / $this->stok_awal) * 100,
            ]);

            $this->editedStockIndex = null;
            $this->sendAlert('success', 'Berhasil disimpan!!', 'top-end');
        } catch (\Throwable $th) {
            $this->sendAlert('error', $th->getMessage(), 'top-end');
        }
    }

    public function sendAlert($tipo, $texto, $posicion)
    {
        $this->alert($tipo, $texto, [
            'position' =>  $posicion,
            'timer' =>  3000,
            'toast' =>  true,
            'text' =>  '',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);
    }
}
