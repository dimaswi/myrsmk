<?php

namespace App\Http\Livewire\Permintaan;

use App\Models\Permintaan;
use App\Models\Stok;
use App\Models\StokUnit;
use App\Models\Unit;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


class Proses extends Component
{
    use WithFileUploads;
    use WithPagination;
    use LivewireAlert;
    public $search = '';
    public $perPage = 10;
    public $editedSuratIndex = null;
    public $original_name;
    public $filepath = "";
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
        return view('livewire.permintaan.proses', [
            'process' => Permintaan::where('unit', $nama_unit->nama)->where('status', 0)->select([DB::raw("SUM(jumlah * harga) as total"), 'nomor_permintaan', 'tanggal', 'unit','surat'])->groupBy('nomor_permintaan')->search($this->search)->paginate($this->perPage),
            'process_logistiks' => Permintaan::where('status', 0)->select([DB::raw("SUM(jumlah * harga) as total"), 'nomor_permintaan', 'tanggal', 'unit','surat'])->groupBy('nomor_permintaan')->search($this->search)->paginate($this->perPage),
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

    public function isDetailClose($nomor)
    {
        $this->openDetail = false;
    }

    public function isModalOpen($nomor)
    {
        $this->openModal = false;
        $this->nomor_permintaan = $nomor;
    }

    public function isModalClose()
    {
        $this->openModal = true;
    }

    public function save()
    {
        try {
            $this->original_name = $this->surat->getClientOriginalName();
            $filename = $this->surat->store('surat', 'public');
            $this->filepath = Storage::url($filename);
            Permintaan::where('nomor_permintaan', $this->nomor_permintaan)->update([
                'surat' => $filename,
            ]);

            $this->editedSuratIndex = null;
            $this->sendAlert('success', 'Berhasil disimpan!!', 'top-end');
        } catch (\Throwable $th) {
            $this->sendAlert('error', $th->getMessage(), 'top-end');
        }
    }

    public function setujui($nomor_permintaan)
    {
        $data = Permintaan::where('nomor_permintaan', $nomor_permintaan)->pluck('nama_barang')->toArray();
        $dataStok = Stok::whereIn('nama_barang', $data)->get();
        try {
            foreach ($dataStok as $key => $value) {
                $data_dalam = Permintaan::where('id_barang', $value->id)->first();
                Stok::where('nama_barang', $data_dalam->nama_barang)->update([
                    'stok_keluar' => $value->stok_keluar + $data_dalam->jumlah,
                    'total_stok' => $value->total_stok - $data_dalam->jumlah,
                    'persentase' => ($value->persentase) - (($data_dalam->jumlah) / $value->stok_awal ) * 100,
                ]);

                StokUnit::create([
                    'nama_barang' => $data_dalam->nama_barang,
                    'stok_masuk' => $data_dalam->jumlah,
                    'unit' => $data_dalam->unit,
                    'harga' => $data_dalam->harga,
                    'tanggal' => Carbon::now('Asia/Jakarta')->format('Y-m-d'),
                    'jenis_barang' => $value->jenis_barang,
                ]);
            }

            Permintaan::where('nomor_permintaan', $nomor_permintaan)->update([
                'status' => 1,
            ]);
            $this->sendAlert('success', 'Berhasil diupdate!!', 'top-end');
        } catch (\Throwable $th) {
            $this->sendAlert('error', $th->getMessage(), 'top-end');
        }
    }

    public function tolak($nomor_permintaan)
    {
        try {
            Permintaan::where('nomor_permintaan', $nomor_permintaan)->update([
                'status' => 99,
            ]);

            $this->sendAlert('success', 'Berhasil diupdate!!', 'top-end');
        } catch (\Throwable $th) {
            $this->sendAlert('error', $th->getMessage(), 'top-end');
        }
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
