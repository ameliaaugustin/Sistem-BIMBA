<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\admin\master_data\MasterHariModel;
use App\Models\admin\master_data\MasterDokumenModel;
use App\Models\pendaftar\form_pendaftaran\AfiliasiModel;
use App\Models\pendaftar\form_pendaftaran\FormDokumenModel;
use App\Http\Controllers\admin\data\JadwalBuktiBayarController;
use App\Models\admin\master_data\ItemBayarModel;
use App\Models\pendaftar\form_pendaftaran\FormJadwalSiswaModel;
use App\Models\pendaftar\form_pendaftaran\PendaftaranSiswaModel;

class HomeController extends Controller
{
    public function home()
    {
        $user = auth()->user()->id;
        $user_role =  User::firstWhere('id', $user);
        $pendaftar = PendaftaranSiswaModel::firstWhere('user_id', $user);
        // $m_dokumen = MasterDokumenModel::count();
        // $dt_dokumen = FormDokumenModel::where('id_pendaftar', $pendaftar->id)->count();
        // $going_jadwal = $dt_dokumen == $m_dokumen;

        if ($user_role->user_role_id != 3) {
            $count_pendaftar = PendaftaranSiswaModel::count();
            $get_time_pendaftar = PendaftaranSiswaModel::orderBy('created_at', 'DESC')->first();

            $bukti_bayar = FormJadwalSiswaModel::where('status_bayar', 'Y')->count();
            $get_time_bayar = FormJadwalSiswaModel::orderBy('created_at', 'DESC')->first();

            $count_afiliasi = AfiliasiModel::count();
            $get_time_afiliasi = AfiliasiModel::orderBy('created_at', 'DESC')->first();

            $data = [
                'count_pendaftar' => $count_pendaftar,
                'get_time_pendaftar' => $get_time_pendaftar,
                'bukti_bayar' => $bukti_bayar,
                'get_time_bayar' => $get_time_bayar,
                'count_afiliasi' => $count_afiliasi,
                'get_time_afiliasi' => $get_time_afiliasi,
            ];
            // dd($data);
            return view('home', $data);
        }
        if ($pendaftar == null) {
            return view('customer.welcome-page', compact('user', 'pendaftar'));
        }
        // else {
        //     if ($going_jadwal != true) {
        //         Toastr::warning('Silahkan isi FORMULIR DOKUMEN terlebih dahulu', 'Maaf');
        //         return redirect('/');
        //     }
        // }

        $jadwal = FormJadwalSiswaModel::where('id_pendaftar', $pendaftar->id)->select(
            'dt_jadwal_siswa.id as id_jadwal',
            'dt_jadwal_siswa.id_jam_pelajaran',
            'dt_jadwal_siswa.keterangan',
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
            ->orderBy('created_at', 'DESC')
            ->first();
        // dd($user, $user_role, $pendaftar, $jadwal);
        if ($jadwal != null) {

            $item_bayar = ItemBayarModel::get()->pluck('biaya_item');

            $arr_item = [];

            foreach ($item_bayar as $value) {
                $arr_item[] = $value;
            }

            $jml_total_item = array_sum($arr_item);
            $total = $jml_total_item + $jadwal->biaya_paket;

            $decode_hari = json_decode($jadwal->id_hari);

            $hari = MasterHariModel::whereIn('m_hari.id', $decode_hari)->get()->toArray();



            return view('customer.validasi_pembayaran', compact('user', 'pendaftar', 'jadwal', 'total', 'hari'));
        }


        return view('customer.validasi_pendaftaran', compact('user', 'pendaftar', 'jadwal',));
    }
}
