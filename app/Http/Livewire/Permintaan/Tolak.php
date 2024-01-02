<?php

namespace App\Http\Livewire\Permintaan;

use App\Models\Permintaan;
use App\Models\Unit;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Tolak extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = 10;
    public $surat;
    public $nomor_permintaan;
    public $unit;
    public $tanggal;
    public $total_harga;
    public $openModal = true;
    public $openDetail = false;
    public $permintaan = [];

    public function render()
    {
        $nama_unit = Unit::where('id', auth()->user()->unit)->first();
        return view('livewire.permintaan.tolak', [
            'tolaks' => Permintaan::where('unit', $nama_unit->nama)->where('status', 99)->select([DB::raw("SUM(jumlah * harga) as total"), 'nomor_permintaan', 'tanggal', 'unit','surat'])->groupBy('nomor_permintaan')->search($this->search)->paginate($this->perPage),
            'tolaks_logistiks' => Permintaan::where('status', 99)->select([DB::raw("SUM(jumlah * harga) as total"), 'nomor_permintaan', 'tanggal', 'unit', 'surat', 'tanda_terima'])->groupBy('nomor_permintaan')->search($this->search)->paginate($this->perPage),
        ]);
    }

    public function isDetailOpen($nomor)
    {
        $this->openDetail = true;
        $this->nomor_permintaan = $nomor;

        $permintaan = Permintaan::where('nomor_permintaan', $nomor)->select([DB::raw("SUM(jumlah * harga) as total"), 'unit', 'tanggal', 'surat'])->first();
        $data_permintaan = Permintaan::where('nomor_permintaan', $nomor)->get();
        $this->unit = $permintaan->unit;
        $this->tanggal = $permintaan->tanggal;
        $this->permintaan = $data_permintaan;
        $this->total_harga = $permintaan->total;
    }

    public function downloadSurat($nomor_permintaan)
    {
        $data = Permintaan::where('nomor_permintaan', $nomor_permintaan)->first();

        if ($data->surat == null) {
            $this->sendAlert('error', 'Surat tidak ditemukan!!', 'top-end');
        } else {
            $this->sendAlert('success', 'Berhasil didownload!!', 'top-end');
            return response()->download(public_path($data->surat));
        }

    }

    public function isDetailClose($nomor)
    {
        $this->openDetail = false;
    }
}
