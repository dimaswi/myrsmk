<?php

namespace App\Http\Livewire\Permintaan;

use App\Models\Stok;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Carbon\Carbon;
use App\Models\Permintaan as ModelPermintaans;
use App\Models\Unit;

class Permintaan extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $search = '';
    public $perPage = 10;
    public $pageSetuju = false;
    public $pageProses = false;
    public $pageTolak = false;
    public $pageTambah = true;
    public $jenis_barang;
    public $nama;
    public $harga;
    public $jumlah;
    public $max_jumlah;
    public $isOpen = false;
    public $result = array();
    public $inputs = [];
    public $i = 1;

    public function render()
    {
        $nama_unit = Unit::where('id', auth()->user()->unit)->first();
        return view('livewire.permintaan.permintaan',[
            'jenisbarangs' => Stok::where('jenis_barang', $this->jenis_barang)->get(),
            'prosesTotals' => ModelPermintaans::where('status', 0)->groupBy('nomor_permintaan')->get(),
            'setujuiTotals' => ModelPermintaans::where('status', 1)->groupBy('nomor_permintaan')->get(),
            'tolaksTotals' => ModelPermintaans::where('status', 99)->groupBy('nomor_permintaan')->get(),
            'prosesTotals_logistik' => ModelPermintaans::where('status', 0)->where('unit', $nama_unit->nama)->groupBy('nomor_permintaan')->get(),
            'setujuiTotals_logistik' => ModelPermintaans::where('status', 1)->where('unit', $nama_unit->nama)->groupBy('nomor_permintaan')->get(),
            'tolaksTotals_logistik' => ModelPermintaans::where('status', 99)->where('unit', $nama_unit->nama)->groupBy('nomor_permintaan')->get(),
        ]);
    }

    public function updatedNama()
    {
        if($this->nama != '') {
            $this->result = Stok::where('jenis_barang', $this->jenis_barang)->where('nama_barang', 'LIKE', '%'.$this->nama.'%')->get();
        }else {
            $this->result = [];
        }
    }

    public function pilihBarang($nama)
    {
        $data = Stok::where('nama_barang', $nama)->first();
        $this->nama = $nama;
        $this->harga = $data->harga;
        $this->max_jumlah = $data->total_stok;
        $this->result = [];
    }

    public function setTambah()
    {
        $this->pageTambah = true;
        $this->pageSetuju = false;
        $this->pageProses = false;
        $this->pageTolak = false;
    }

    public function setSetuju()
    {
        $this->pageTambah = false;
        $this->pageSetuju = true;
        $this->pageProses = false;
        $this->pageTolak = false;
    }

    public function setProses()
    {
        $this->pageTambah = false;
        $this->pageSetuju = false;
        $this->pageProses = true;
        $this->pageTolak = false;
    }

    public function setTolak()
    {
        $this->pageTambah = false;
        $this->pageSetuju = false;
        $this->pageProses = false;
        $this->pageTolak = true;
    }

    public function save()
    {
        $unit = Unit::where('id', auth()->user()->unit)->first();
        $today = ModelPermintaans::whereDate('created_at', Carbon::today())->where('unit', $unit->nama)->first();
        try {
            $data = ModelPermintaans::orderBy('id', 'desc')->first();

            if( empty($data) ) {
                $nomor = 1;
                $nomor_permintaan = $nomor.'/S.P/'.Carbon::now('Asia/Jakarta')->format('m').'/'.Carbon::now('Asia/Jakarta')->format('Y');
            } else if( $today == null ){
                $nomor = $data->nomor + 1;
                $nomor_permintaan = $nomor.'/S.P/'.Carbon::now('Asia/Jakarta')->format('m').'/'.Carbon::now('Asia/Jakarta')->format('Y');
            } else if($today != null) {
                $nomor = $today->nomor;
                $nomor_permintaan = $today->nomor_permintaan;
            } else {
                $nomor = $data->nomor;
                $nomor_permintaan = $nomor.'/S.P/'.Carbon::now('Asia/Jakarta')->format('m').'/'.Carbon::now('Asia/Jakarta')->format('Y');
            }

            $unit = Unit::where('id', auth()->user()->unit)->first();
            $stok = Stok::where('nama_barang', $this->nama)->first();

            ModelPermintaans::create([
                'nomor' => $nomor,
                'nomor_permintaan' => $nomor_permintaan,
                'jenis_barang' => $this->jenis_barang,
                'unit' => $unit->nama,
                'nama_barang' => $this->nama,
                'id_barang' => $stok->id,
                'harga' => $this->harga,
                'jumlah' => $this->jumlah,
                'tanggal' => Carbon::now('Asia/Jakarta')->format('Y-m-d'),
            ]);

            $this->reset();
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
