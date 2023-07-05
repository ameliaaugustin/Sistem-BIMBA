<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\pendaftar\form_pendaftaran\PendaftaranSiswaModel;

class DataPendaftarExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $req = Request::all();
        return view('admin.data.pendaftar.cetakdata-pendaftar',);
    }
}
