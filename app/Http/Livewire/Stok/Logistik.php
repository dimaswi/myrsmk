<?php

namespace App\Http\Livewire\Stok;

use App\Models\Stok;
use App\Models\StokUnit;
use App\Models\Unit;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Gate;

class Logistik extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $search = '';
    public $perPage = 10;
    public $tersedia = false;
    public $kurang = false;
    public $kosong = false;
    public $buat = true;
    public $nama_barang, $jenis_barang, $harga, $stok_awal, $tanggal;
    public $nama_barang_edit, $harga_edit, $stok_masuk_edit, $stok_sisa_edit;
    public $editedStockIndex = null;

    public function render()
    {
        $unit = Unit::where('id', auth()->user()->unit)->first();
        if(auth()->user()->hasRole('Logistik')){
            return view('livewire.stok.logistik', [
                'stoks' => Stok::search($this->search)->paginate($this->perPage),
                'tersedias' => Stok::where('persentase', '>', 50)->get(),
                'kurangs' => Stok::where('persentase', '<=', 50)->where('persentase', '>=', 1)->get(),
                'kosongs' => Stok::where('persentase', 0)->get(),
            ]);
        }else {
            return view('livewire.stok.logistik', [
                'stoks' => StokUnit::where('unit', $unit->nama)->search($this->search)->paginate($this->perPage),
            ]);
        }
    }

    public function pageTersedia()
    {
        $this->tersedia = true;
        $this->kurang = false;
        $this->kosong = false;
        $this->buat = false;
    }

    public function pageKurang()
    {
        $this->tersedia = false;
        $this->kurang = true;
        $this->kosong = false;
        $this->buat = false;
    }

    public function pageKosong()
    {
        $this->tersedia = false;
        $this->kurang = false;
        $this->kosong = true;
        $this->buat = false;
    }

    public function pageCreate()
    {
        $this->tersedia = false;
        $this->kurang = false;
        $this->kosong = false;
        $this->buat = true;
    }

    public function store()
    {
        try {
            Stok::create([
                'nama_barang' => $this->nama_barang,
                'jenis_barang' => $this->jenis_barang,
                'harga' => $this->harga,
                'tanggal' => $this->tanggal,
                'stok_awal' => $this->stok_awal,
                'total_stok' => $this->stok_awal,
                'persentase' => ($this->stok_awal / $this->stok_awal) * 100,
            ]);

            $this->reset();
            $this->sendAlert('success', 'Berhasil dihapus!!', 'top-end');
        } catch (\Throwable $th) {
            $this->sendAlert('error', $th->getMessage(), 'top-end');
        }
    }

    public function editedStock($stockIndex, $id)
    {
        $this->editedStockIndex = $stockIndex;
        $stokUnit = StokUnit::where('id', $id)->first();
        $this->nama_barang_edit = $stokUnit->nama_barang;
        $this->harga_edit = $stokUnit->harga;
        $this->stok_masuk_edit = $stokUnit->stok_masuk;

    }

    public function updateStok($id)
    {
        $data = StokUnit::where('id', $id)->first();

        try {

            StokUnit::where('id', $id)->update([
                'nama_barang' => $this->nama_barang_edit,
                'harga' => $this->harga_edit,
                'stok_masuk' => $this->stok_masuk_edit,
                'stok_sisa' => $this->stok_sisa_edit,
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
