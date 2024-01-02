<?php

namespace App\Http\Livewire\Master;

use App\Models\Admin;
use App\Models\Bagian;
use App\Models\Unit;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class Users extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $search = '';
    public $perPage = 5;
    public $name;
    public $username;
    public $phone;
    public $password = '12345678';
    public $bagian;
    public $unit;
    public $role;
    public $idData;
    public $status;
    public function render()
    {
        if (! Gate::allows('manage_users')) {
            return abort(401);
        }

        return view('livewire.master.users', [
            'user' => User::search($this->search)->paginate($this->perPage),
            'units' => Unit::all(),
            'roles' => Role::all(),
            'bagians' => Bagian::all(),
        ]);
    }

    public function save()
    {
        try {

            $validate = $this->validate([
                'name' => 'required',
                'username' => 'required',
                'password' => 'required',
            ]);

            $user = User::create([
                'name' => $this->name,
                'username' => $this->username,
                'password' => Hash::make($this->password),
                'bagian' => $this->bagian,
                'unit' => $this->unit,
            ]);

            Admin::create([
                'user_id' => $user->id
            ]);

            $user->assignRole($this->role);

            $this->reset();
            $this->sendAlert('success', 'Berhasil disimpan!!', 'top-end');
        } catch (\Throwable $th) {

            $validate = $this->validate([
                'name' => 'required',
                'username' => 'required',
                'password' => 'required',
            ]);

            $this->sendAlert('error', $th->getMessage(), 'top-end');
        }
    }

    public function edit($id)
    {
        $user = User::find($id);

        $this->idData = $user->id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->phone = $user->phone;
        $this->status = $user->status;
        $this->bagian = $user->bagian;
        $this->unit = $user->unit;
        $this->role = $user->getRoleNames();
    }

    public function close()
    {
        $this->reset();
    }

    public function update()
    {
        try {
            $validate = $this->validate([
                'name' => 'required',
                'username' => 'required',
            ]);

            $user = User::find($this->idData);

            DB::table('model_has_roles')->where('model_id', $this->idData)->delete();

            User::where('id', $this->idData)->update([
                'name' => $this->name,
                'username' => $this->username,
                'phone' => $this->phone,
                'status' => $this->status,
                'bagian' => $this->bagian,
                'unit' => $this->unit,
            ]);

            $user->assignRole($this->role);
            $this->sendAlert('success', 'Berhasil diupdate!!', 'top-end');
        } catch (\Throwable $th) {
            $this->sendAlert('error', $th->getMessage(), 'top-end');
        }
    }

    public function remove($id)
    {
        try {
            User::where('id', $id)->delete();
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
