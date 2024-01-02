<?php

namespace App\Http\Livewire\Logbook;

use App\Models\JamKerja;
use App\Models\Logbook;
use App\Models\Unit;
use Carbon\Carbon;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;


class LogbookCreate extends Component
{
    use LivewireAlert;
    public $judul;
    public $uid;
    public $jenis_shift;
    public $shift;
    public $jam_kerja;
    public $nama;
    public $kegiatan;
    public $unit;
    public $lokasi;
    public $bersama;
    public $jadwal = [];

    public function render()
    {
        $jadwal_terpakai = Logbook::where('uid', $this->uid)->where('nama', auth()->user()->name)->pluck('jam_kerja');
        if ($this->jenis_shift == "CS JAGA" || $this->jenis_shift == "Malam" || $this->jenis_shift == "SECURITY MALAM") 
        {
            $this->uid = Carbon::now('Asia/Jakarta')->subHour(7)->format('Ymd').auth()->user()->id;
            $this->jadwal = JamKerja::where('shift', $this->jenis_shift)
            ->whereNotIn('jam_kerja', $jadwal_terpakai)
            ->get();
        } else {
            $this->uid = Carbon::now('Asia/Jakarta')->format('Ymd').auth()->user()->id;
            $this->jadwal = JamKerja::where('shift', $this->jenis_shift)
            ->whereNotIn('jam_kerja', $jadwal_terpakai)
            ->get();
        }
        $logsbooks = Logbook::where('nama', auth()->user()->name)->where('uid', $this->uid)->get();
        // $jam_awal = JamKerja::where('shift', 'Manajemen')->first();
        // $jam_akhir = JamKerja::where('shift', 'Manajemen')->latest()->first();
        // $from = substr($jam_awal->jam_kerja,0,5);
        // $to = substr($jam_akhir->jam_kerja,-5);

        return view('livewire.logbook.logbook-create', [
            'jadwals' => $this->jadwal,
            'shifts' => JamKerja::groupBy('shift')->get(),
            'logbooks' => $logsbooks,
        ]);
    }

    public function set($value)
    {
        $this->jenis_shift = $value;
        $this->judul = $value;
    }

    public function store()
    {
        
        $cek_jam = Logbook::where('jam_kerja', $this->jam_kerja)->where('nama', auth()->user()->name)->whereDate('created_at', Carbon::today())->first();
        if ($cek_jam === null) {
            try {
                $validate = $this->validate([
                    'shift' => 'required',
                    'jam_kerja' => 'required',
                    'lokasi' => 'required',
                    'bersama' => 'required',
                    'kegiatan' => 'required',
                ]);

                $unit = Unit::where('id', auth()->user()->unit)->first();
                
                if($unit === null) {
                    $nama_unit = 'Kepala Bagian';
                } else {
                    $nama_unit = $unit->nama;
                }

                Logbook::create([
                    'uid' => $this->uid,
                    'shift' => $this->shift,
                    'jam_kerja' => $this->jam_kerja,
                    'lokasi' => $this->lokasi,
                    'bersama' => $this->bersama,
                    'kegiatan' => $this->kegiatan,
                    'nama' => auth()->user()->name,
                    'unit' => $nama_unit,
                ]);

                $this->reset(['jam_kerja', 'lokasi', 'bersama', 'kegiatan']);
                $this->sendAlert('success', 'Berhasil disimpan!!', 'top-end');
            } catch (\Throwable $th) {
                $this->sendAlert('error', $th->getMessage(), 'top-end');
            }
            
        } else {
            $this->sendAlert('error', 'Jam kerja sudah ada!!', 'top-end');
        }
    }

    public function remove($id)
    {
        try {
            Logbook::where('id', $id)->delete();
            $this->sendAlert('success', 'Berhasil dihapus!!', 'top-end');
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
