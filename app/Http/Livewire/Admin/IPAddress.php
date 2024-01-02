<?php

namespace App\Http\Livewire\Admin;

use App\Models\Stat;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;

class IPAddress extends Component
{
    use WithPagination;
    public $perPage = 5;

    public function render()
    {
        if (! Gate::allows('manage_users')) {
            return abort(401);
        }

        return view('livewire.admin.i-p-address',[
            'stats' => Stat::paginate($this->perPage),
        ]);
    }
}
