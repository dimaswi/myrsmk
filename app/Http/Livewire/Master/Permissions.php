<?php

namespace App\Http\Livewire\Master;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Permission as ModelPermission;
use Illuminate\Support\Facades\Gate;

class Permissions extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $search = '';
    public $perPage = 5;
    public $name;
    public $idData;
    public function render()
    {
        if (! Gate::allows('manage_users')) {
            return abort(401);
        }

        return view('livewire.master.permissions', [
            'permission' => ModelPermission::search($this->search)->paginate($this->perPage),
        ]);
    }

    public function save()
    {
        try {
            $role = Permission::create(['name' => $this->name]);
            $this->sendAlert('success', 'Berhasil disimpan!!', 'top-end');
        } catch (\Throwable $th) {
            $this->sendAlert('error', $th->getMessage() , 'top-end');
        }

        $this->reset();
    }

    public function edit($id)
    {
        $role = ModelPermission::find($id);

        $this->idData = $role->id;
        $this->name = $role->name;

    }

    public function close()
    {
        $this->reset();
    }

    public function update()
    {
        try {
        
            ModelPermission::where('id', $this->idData)->update([
                'name' => $this->name,
            ]);
            $this->sendAlert('success', 'Berhasil diupdate!!', 'top-end');
        } catch (\Throwable $th) {
            $this->sendAlert('error', $th->getMessage() , 'top-end');
        }
    }

    public function remove($id)
    {
        try {
            ModelPermission::where('id', $id)->delete();
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
