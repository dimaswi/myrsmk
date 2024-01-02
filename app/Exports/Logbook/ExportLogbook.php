<?php

namespace App\Exports\Logbook;

use App\Models\Logbook;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportLogbook implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $tanggal;
    protected $nama;
    public function __construct($tanggal, $nama)
    {
        $this->tanggal = $tanggal;
        $this->nama = $nama;
    }

    public function view(): View
    {
        // dd($this->tanggal);
        return view('export.excel.logbook', [
            'data' => Logbook::where('nama', $this->nama)->whereDate('created_at', $this->tanggal)->get(),
            'nama' => Logbook::where('nama', $this->nama)->whereDate('created_at', $this->tanggal)->first(),
        ]);
    }
}
