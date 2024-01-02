<?php

namespace App\Http\Livewire\Master;

use App\Models\JamKerja as ModelsJamKerja;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;

class JamKerja extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $jam_kerja;
    public $shift;
    public $search = '';
    public $perPage = 10;
    public $idData;

    public function render()
    {
        if (! Gate::allows('manage_users')) {
            return abort(401);
        }

        return view('livewire.master.jam-kerja', [
            'jam_kerjas' => ModelsJamKerja::search($this->search)->orderBy('id', 'desc')->paginate($this->perPage),
        ]);
    }

    public function save()
    {
        try {
            $role = ModelsJamKerja::create([
                'shift' => $this->shift,
                'jam_kerja' => $this->jam_kerja
            ]);
            $this->sendAlert('success', 'Berhasil disimpan!!', 'top-end');
        } catch (\Throwable $th) {
            $this->sendAlert('error', $th->getMessage() , 'top-end');
        }

        $this->reset();
    }

    public function edit($id)
    {
        $data = ModelsJamKerja::find($id);

        $this->idData = $data->id;
        $this->shift = $data->shift;
        $this->jam_kerja = $data->jam_kerja;
    }

    public function close()
    {
        $this->reset();
    }

    public function update()
    {
        try {
            ModelsJamKerja::where('id', $this->idData)->update([
                'shift' => $this->shift,
                'jam_kerja' => $this->jam_kerja
            ]);

            $this->sendAlert('success', 'Berhasil diupdate!!', 'top-end');
            $this->reset();
        } catch (\Throwable $th) {
            $this->sendAlert('error', $th->getMessage() , 'top-end');
        }
    }

    public function remove($id)
    {
        try {
            ModelsJamKerja::where('id', $id)->delete();

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
