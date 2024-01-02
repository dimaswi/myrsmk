<?php

namespace App\Http\Livewire\Master;

use App\Models\Bagian;
use Livewire\Component;
use App\Models\Unit;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;

class KepalaUnit extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $search = '';
    public $perPage = 5;
    public $nama;
    public $kepala;
    public $kode;
    public $bagian;
    public $idData;
    public function render()
    {
        if (! Gate::allows('manage_users')) {
            return abort(401);
        }


        return view('livewire.master.kepala-unit', [
            'unit'=> Unit::search($this->search)->paginate($this->perPage),
            'listbagian' => Bagian::all(),
        ]);
    }
    public function save()
    {
        try {
            $validate = $this->validate([
                'nama' => 'required',
                'kepala' => 'required',
                'kode' => 'required',
                'bagian' => 'required',
            ]);
    
            Unit::create(
                $this->only(['nama', 'kepala','kode', 'bagian'])
            ); 
    
            $this->reset();
            $this->sendAlert('success', 'Berhasil disimpan!!', 'top-end');
        } catch (\Throwable $th) {
            
            $validate = $this->validate([
                'nama' => 'required',
                'kepala' => 'required',
                'kode' => 'required',
                'bagian' => 'required',
            ]);

            $this->sendAlert('error', $th->getMessage() , 'top-end');
        }
    }
    public function edit($id)
    {
        $unit = Unit::find($id);

        $this->idData = $unit->id;
        $this->nama = $unit->nama;
        $this->kepala = $unit->kepala;
        $this->kode = $unit->kode;
        $this->bagian = $unit->bagian;
    }

    public function close()
    {
        $this->reset();
    }

    public function update()
    {
        try {
            $validate = $this->validate([
                'nama' => 'required',
                'kepala' => 'required',
                'kode' => 'required',
                'bagian' => 'required',
            ]);
    
            Unit::where('id', $this->idData)->update([
                'nama' => $this->nama,
                'kepala' => $this->kepala,
                'kode' => $this->kode,
                'bagian' => $this->bagian,
            ]);
            $this->sendAlert('success', 'Berhasil diupdate!!', 'top-end');
        } catch (\Throwable $th) {
            $this->sendAlert('error', $th->getMessage() , 'top-end');
        }
    }

    public function remove($id)
    {
        try {
            Unit::where('id', $id)->delete();
            $this->sendAlert('success', 'Berhasil dihapus!!', 'top-end');
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
