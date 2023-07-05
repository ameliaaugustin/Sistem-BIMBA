<?php

namespace App\Exports;

use App\Models\pendaftar\form_pendaftaran\FormJadwalSiswaModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DataJadwalBuktiBayarExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $data_pendaftar = FormJadwalSiswaModel::select(
            'dt_jadwal_siswa.id as id_jadwal',
            'dt_jadwal_siswa.id_jam_pelajaran',
            'dt_pendaftar.nama_lengkap',
            'dt_jam_pelajaran.id_hari',
            'dt_jam_pelajaran.jam_mulai',
            'dt_jam_pelajaran.jam_selesai',
            'm_paket.id as id_paket',
            'm_paket.jenis_paket',
            'm_paket.biaya_paket',
            'dt_jadwal_siswa.status_bayar',
            'dt_jadwal_siswa.created_at',


        )
            ->leftjoin('dt_pendaftar', 'dt_jadwal_siswa.id_pendaftar', 'dt_pendaftar.id')
            ->leftjoin('dt_jam_pelajaran', 'dt_jadwal_siswa.id_jam_pelajaran', 'dt_jam_pelajaran.id')
            ->leftjoin('m_paket', 'dt_jam_pelajaran.id_paket', 'm_paket.id')
            ->get();
        return view('admin.data.jadwal-buktibayar.cetakdata-jadwal-buktibayar', compact('data_pendaftar'));
    }
}
