<?php

namespace App\Http\Livewire\Logbook;

use App\Exports\Logbook\ExportLogbook;
use App\Models\Logbook;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class LogbookIndex extends Component
{
    use WithPagination;
    public $search = '';
    public $perpage = 5;
    public $tanggal;

    public function render()
    {
        if (! Gate::allows('manage_logbook_veifikator')) {
            return abort(401);
        }

        return view('livewire.logbook.logbook-index',[
            'logbooks' => Logbook::whereDate('created_at', $this->tanggal." 00:00:00")->search($this->search)->groupBy('uid')->paginate($this->perpage),
        ]);
    }

    public function showDetails($uid)
    {
        return redirect()->to("/logbook/detail/$uid");
    }

    public function exportExcel($uid) {
        $nama = Logbook::where('uid', $uid)->whereDate('created_at', $this->tanggal." 00:00:00")->first();
        return Excel::download(new ExportLogbook($this->tanggal, $nama->nama), "$nama->nama.-.$this->tanggal.xlsx");
    }
}
