<?php

namespace App\Http\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Bagian;
use Illuminate\Support\Facades\Gate;

class KepalaBagian extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = 5;
    public $nama;
    public $kepala;
    public $kode;
    public $idData;
    public function render()
    {
        if (! Gate::allows('manage_users')) {
            return abort(401);
        }

        return view('livewire.master.kepala-bagian', [
            'bagian' => Bagian::search($this->search)->paginate($this->perPage),
        ]);
    }
    public function save()
    {
        try {
            $validate = $this->validate([
                'nama' => 'required',
                'kepala' => 'required',
                'kode' => 'required',
            ]);
    
            Bagian::create(
                $this->only(['nama', 'kepala','kode'])
            ); 
    
            $this->reset();
            $this->sendAlert('success', 'Berhasil disimpan!!', 'top-end');
        } catch (\Throwable $th) {
            $this->sendAlert('error', $th->getMessage() , 'top-end');
        }
    }

    public function edit($id)
    {
        $bagian = Bagian::find($id);

        $this->idData = $bagian->id;
        $this->nama = $bagian->nama;
        $this->kepala = $bagian->kepala;
        $this->kode = $bagian->kode;
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
            ]);
    
            Bagian::where('id', $this->idData)->update([
                'nama' => $this->nama,
                'kepala' => $this->kepala,
                'kode' => $this->kode,
            ]);
            $this->sendAlert('success', 'Berhasil diupdate!!', 'top-end');
        } catch (\Throwable $th) {
            $this->sendAlert('error', $th->getMessage() , 'top-end');
        }
    }

    public function remove($id)
    {
        try {
            Bagian::where('id', $id)->delete();
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
