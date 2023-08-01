<?php

namespace App\Http\Controllers\pendaftar\form_pendaftaran;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\admin\master_data\MasterDokumenModel;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use App\Models\admin\master_data\MasterHariModel;
use App\Models\admin\master_data\MasterPaketModel;
use App\Models\admin\master_data\MasterJamPelajaranModel;
use App\Models\pendaftar\form_pendaftaran\FormDokumenModel;
use App\Models\pendaftar\form_pendaftaran\FormJadwalSiswaModel;
use App\Models\pendaftar\form_pendaftaran\PendaftaranSiswaModel;

class PilihKBMController extends Controller
{
    public function index()
    {
        $user = auth()->user()->id;
        $pendaftar = PendaftaranSiswaModel::firstWhere('user_id', $user);


        if ($pendaftar == null) {
            Toastr::warning('Silahkan isi FORMULIR PENDAFTARAN terlebih dahulu', 'Maaf');
            return redirect('/form-pendaftaran');
        }

        $m_dokumen = MasterDokumenModel::count();
        $dt_dokumen = FormDokumenModel::where('id_pendaftar', $pendaftar->id)->count();
        // dd($dt_dokumen, $m_dokumen);
        $going_jadwal = $dt_dokumen == $m_dokumen;

        if ($going_jadwal != true) {
            Toastr::warning('Silahkan isi FORMULIR DOKUMEN terlebih dahulu', 'Maaf');
            return redirect('/');
        }

        if ($pendaftar->status != 'Y') {
            Toastr::warning('Status pendaftaran anda sedang menunggu validasi', 'Silahkan Menunggu');
            return redirect('/');
        }

        $has_daftar = FormJadwalSiswaModel::firstWhere('id_pendaftar', $pendaftar->id);

        if ($has_daftar) {
            if ($has_daftar->status_bayar == 'Y') {
                Toastr::warning('Anda Sudah Mengisi Jadwal KBM dan Melakukan Pembayaran', 'Silahkan Hubungi Admin!');
                return redirect('/');
            }
        }

        $item_bayar = DB::table('m_item_bayar')->get();
        $m_paket = MasterPaketModel::get();
        $jam_pel = MasterJamPelajaranModel::get();

        $jadwals = [];
        foreach ($jam_pel as $key => $value) {
            $decode_hari = json_decode($value->id_hari);

            $data_hari = MasterHariModel::whereIn('id', $decode_hari)->get()->toArray();

            $jadwals[$value->id] = [
                'hari' => $data_hari,
                'sesi_jam' => $value->jam_mulai . ' - ' . $value->jam_selesai
            ];
        }

        $data = [
            'jadwals' => $jadwals,
            'item_bayar' => $item_bayar,
            'm_paket' => $m_paket,

        ];
        return view('customer.pendaftaran.pilihkbm', $data);
    }

    public function getPrice(Request $req)
    {
        $paket = MasterPaketModel::find($req->paket);

        $item_bayar = DB::table('m_item_bayar')->get()->pluck('biaya_item');

        $arr_item = [];

        foreach ($item_bayar as $value) {
            $arr_item[] = $value;
        }

        $jml_total_item = array_sum($arr_item);

        $total_bayar = $jml_total_item + $paket->biaya_paket;

        return response()->json([
            'message' => "Total Biaya Sudah Didapatkan",
            'biaya_paket' => $paket->biaya_paket,
            'total_bayar' => $total_bayar
        ]);
    }

    public function getJadwal(Request $req)
    {
        $dt_jadwal = MasterJamPelajaranModel::where('id_paket', $req->paket)
            ->where('status_penuh', 'N')
            ->get();

        $jadwals = [];
        $data_hari = [];
        foreach ($dt_jadwal as $key => $value) {
            $decode_hari = json_decode($value->id_hari);

            $data_hari = MasterHariModel::whereIn('id', $decode_hari)
                ->get()->toArray();

            $jadwals[$value->id] = [
                'sesi_jam' => $value->jam_mulai . ' - ' . $value->jam_selesai,
                'id_jadwal' => $value->id
            ];
        }

        $hari = [];
        foreach ($data_hari as $values) {
            $hari[] = $values['nama_hari'];
        }

        return response()->json([
            'jadwals' => $jadwals,
            'hari' => $hari,
            'count_jadwal' => count($jadwals)
        ]);
    }
    public function saveFormJadwal(Request $req)
    {
        $req->validate([
            'paket' => ['required'],
            'jadwal' => ['required'],
            'metode_bayar' => ['required'],
        ]);

        if ($req->metode_bayar == 'TRANSFER') {
            $req->validate([
                'bukti_bayar' => ['required',  "max:1028", "mimes:jpg,jpeg,png,pdf"]
            ]);
        }

        $user = auth()->user()->id;

        $dt_pendaftar = PendaftaranSiswaModel::firstWhere('user_id', $user);

        $path_bukti_storage = 'dokumen/' . $user . '/bukti_bayar';

        try {
            $save = FormJadwalSiswaModel::updateOrCreate(
                [
                    'id_pendaftar' => $dt_pendaftar->id,
                ],
                [
                    'id_jam_pelajaran' => $req->jadwal,
                    'metode_bayar' => $req->metode_bayar,
                ]
            );

            if ($req->metode_bayar == 'TRANSFER') {
                FormJadwalSiswaModel::where('id', $save->id)->update([
                    'bukti_bayar' => $req->file('bukti_bayar')->store($path_bukti_storage, 'public')
                ]);
            }
            Toastr::success('Pendaftaran Jadwal Siswa Sudah Tersimpan', 'Berhasil');
            return redirect('/');
        } catch (\Exception $th) {
            Toastr::error('Terjadi kesalahan pada saat menyimpan data', 'Gagal');
            return back();
        }
    }
}
