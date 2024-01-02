<?php

namespace App\Http\Livewire\Logbook;

use App\Models\Logbook;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Gate;

class LogbookDetail extends Component
{
    use LivewireAlert;
    public $uid;
    public $nilai;
    public $nilaiTugas;
    public $nilaiTugasTambahan;
    public $nilaiBukanTugas;
    
    public function mount($uid)
    {
        $this->uid = $uid;
    }
    
    public function render()
    {
        if (! Gate::allows('manage_logbook_veifikator')) {
            return abort(401);
        }

        return view('livewire.logbook.logbook-detail', [
            'datas' => Logbook::where('uid', $this->uid)->get(),
            'data' => Logbook::where('uid', $this->uid)->first(),
            'tugas' => Logbook::where('uid', $this->uid)->where('tugas', 1)->get(),
            'tugas_tambahan' => Logbook::where('uid', $this->uid)->where('tugas_tambahan', 1)->get(),
            'bukan_tugas' => Logbook::where('uid', $this->uid)->where('bukan_tugas', 1)->get(),
        ]);
    }

    public function set($value, $id)
    {
        try {
            if ($value == 'tugas') 
        {
            Logbook::where('id', $id)->update([
                'tugas' => 1,
                'bukan_tugas' => 0,
                'tugas_tambahan' => 0,
            ]);
        } else if ($value == 'bukan')
        {
            Logbook::where('id', $id)->update([
                'tugas' => 0,
                'bukan_tugas' => 1,
                'tugas_tambahan' => 0,
            ]);
        } else if ($value == 'tambahan')
        {
            Logbook::where('id', $id)->update([
                'tugas' => 0,
                'bukan_tugas' => 0,
                'tugas_tambahan' => 1,
            ]);
        }
            $this->sendAlert('success', 'Berhasil diUpdate!!', 'top-end');
        } catch (\Throwable $th) {
            $this->sendAlert('error', $th->getMessage() , 'top-end');
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
