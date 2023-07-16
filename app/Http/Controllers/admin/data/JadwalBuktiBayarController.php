<?php

namespace App\Http\Controllers\admin\data;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Style;
use App\Models\admin\master_data\MasterHariModel;
use PhpOffice\PhpSpreadsheet\Style\Alignment\PHPExcel;
use App\Models\pendaftar\form_pendaftaran\FormJadwalSiswaModel;


class JadwalBuktiBayarController extends Controller
{
    public function index(Request $req)
    {
        $search = $req->search;
        $status_bayar = $req->status_bayar;

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

            ->when($status_bayar, function ($query, $status_bayar) {
                $query->where('status_bayar', $status_bayar);
            })
            ->when($search, function ($query, $search) {
                $query->where('nama_lengkap', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(5);

        $item_bayar = DB::table('m_item_bayar')->get()->pluck('biaya_item');

        $arr_item = [];

        foreach ($item_bayar as $value) {
            $arr_item[] = $value;
        }

        $jml_total_item = array_sum($arr_item);

        $jadwals = [];
        foreach ($data_pendaftar as $key => $value) {
            $decode_hari = json_decode($value->id_hari);

            $hari = MasterHariModel::whereIn('m_hari.id', $decode_hari)->get()->toArray();
            $jadwals[$value->id_jadwal] = [
                'id_jadwal' => $value->id_jadwal,
                'id_jam_pel' => $value->id_jam_pel,
                'nama_lengkap' => $value->nama_lengkap,
                'id_hari' => $value->id_hari,
                'hari' => $hari,
                'sesi_jam' => $value->jam_mulai . ' - ' . $value->jam_selesai,
                'id_paket' => $value->id_paket,
                'jenis_paket' => $value->jenis_paket,
                'status_bayar' => $value->status_bayar,
                'total_biaya' => $jml_total_item + $value->biaya_paket

            ];
        }

        // dd($data_pendaftar, $jadwals);

        return view('admin.data.jadwal-buktibayar.index', compact('data_pendaftar', 'jadwals', 'search', 'status_bayar'));
    }

    public function excel($status_bayar)
    {
        if ($status_bayar == 'null') {
            $status_bayar = null;
        }

        $spreadsheet = new Spreadsheet();
        $writer = new Xlsx($spreadsheet);

        $spreadsheet->setActiveSheetIndex(0);
        $activeSheet = $spreadsheet->getActiveSheet();

        $activeSheet->setCellValue('A1', 'No');
        $activeSheet->setCellValue('B1', 'Nama Siswa');
        $activeSheet->setCellValue('C1', 'Status Bayar');
        $activeSheet->setCellValue('D1', 'Paket');
        $activeSheet->setCellValue('E1', 'Hari');


        $dt_jadwalsiswa = FormJadwalSiswaModel::leftjoin('dt_pendaftar', 'dt_jadwal_siswa.id_pendaftar', 'dt_pendaftar.id')
            ->leftjoin('dt_jam_pelajaran', 'dt_jadwal_siswa.id_jam_pelajaran', 'dt_jam_pelajaran.id')
            ->leftjoin('m_paket', 'dt_jam_pelajaran.id_paket', 'm_paket.id')
            ->when($status_bayar, function ($query, $status_bayar) {
                $query->where('status_bayar', $status_bayar);
            })->get();
        // dd($dt_jadwalsiswa);
        $item_bayar = DB::table('m_item_bayar')->get()->pluck('biaya_item');

        $arr_item = [];

        foreach ($item_bayar as $value) {
            $arr_item[] = $value;
        }

        $jml_total_item = array_sum($arr_item);

        $jadwals = [];
        foreach ($dt_jadwalsiswa as $key => $value) {
            $decode_hari = json_decode($value->id_hari);

            $hari = MasterHariModel::whereIn('m_hari.id', $decode_hari)->get()->toArray();
            $jadwals[$value->id] =
                [
                    'id_jadwal' => $value->id,
                    'id_jam_pel' => $value->id_jam_pelajaran,
                    'nama_lengkap' => $value->nama_lengkap,
                    'id_hari' => $value->id_hari,
                    'hari' => $hari,
                    'sesi_jam' => $value->jam_mulai . ' - ' . $value->jam_selesai,
                    'id_paket' => $value->id_paket,
                    'jenis_paket' => $value->jenis_paket,
                    'status_bayar' => $value->status_bayar,
                    'total_biaya' => $jml_total_item + $value->biaya_paket

                ];
            // dd($hari);
        }
        // dd($jadwals);
        $count = 1;
        if (count($jadwals) > 0) {
            foreach ($jadwals as $key => $values) {
                $new_key = $key + 2;

                $value_hari = [];
                foreach ($values['hari'] as $hari) {
                    $value_hari[] = $hari['nama_hari'];
                }

                if ($values['status_bayar'] == 'Y') {
                    $status_excel = 'Pembayaran Berhasil';
                } elseif ($values['status_bayar'] == 'N') {
                    $status_excel = 'Pembayaran Gagal';
                } else {
                    $status_excel = 'Menunggu Validasi';
                }
                // $activeSheet->mergeCells('E' . $new_key . ':J' . $new_key)->fromArray($value_hari, NULL, 'E' . $new_key);

                $activeSheet->setCellValue('A' . $new_key, $count++);
                $activeSheet->setCellValue('B' . $new_key, $values['nama_lengkap']);
                $activeSheet->setCellValue('C' . $new_key, $status_excel);
                $activeSheet->setCellValue('D' . $new_key, $values['jenis_paket']);
                $activeSheet->fromArray($value_hari, NULL, 'E' . $new_key);
            }

            $filename = 'data_jadwal_buktibayar_' . $status_bayar . '.xlsx';

            header('Content-Type: text/xlsx');
            header('Content-Disposition: attachment;filename=' . $filename);
            header('Cache-Control: max-age-0');

            Toastr::success('Data Telah di Eksport', 'Berhasil');
            $writer->save('php://output');
        }
    }

    public function detail($id)
    {
        $detail = FormJadwalSiswaModel::select(
            'dt_jadwal_siswa.id as id_jadwal',
            'dt_jadwal_siswa.id_jam_pelajaran',
            'dt_pendaftar.nama_lengkap',
            'm_paket.id as id_paket',
            'm_paket.jenis_paket',
            'm_paket.biaya_paket',
            'dt_jam_pelajaran.id_hari',
            // 'm_hari.id as id_hari',
            // 'm_hari.id as nama_hari',
            'dt_jam_pelajaran.jam_mulai',
            'dt_jam_pelajaran.jam_selesai',
            'dt_jadwal_siswa.bukti_bayar',
            'dt_jadwal_siswa.status_bayar',
            'dt_jadwal_siswa.keterangan',
            'dt_jadwal_siswa.metode_bayar',


        )
            ->leftjoin('dt_pendaftar', 'dt_jadwal_siswa.id_pendaftar', 'dt_pendaftar.id')
            ->leftjoin('dt_jam_pelajaran', 'dt_jadwal_siswa.id_jam_pelajaran', 'dt_jam_pelajaran.id')
            ->leftjoin('m_paket', 'dt_jam_pelajaran.id_paket', 'm_paket.id')

            ->firstWhere('dt_jadwal_siswa.id', $id);

        $decode_hari = json_decode($detail->id_hari);

        $master_hari = MasterHariModel::select(
            'nama_hari'
        )
            ->whereIn('id', $decode_hari)->get();

        $arr_hari = [];
        foreach ($master_hari as $value) {
            $arr_hari[] = $value->nama_hari;
        }

        $item_bayar = DB::table('m_item_bayar')->get()->pluck('biaya_item');

        $arr_item = [];

        foreach ($item_bayar as $value) {
            $arr_item[] = $value;
        }

        $jml_total_item = array_sum($arr_item);
        $total_bayar = $jml_total_item + $detail->biaya_paket;

        return view('admin.data.jadwal-buktibayar.detail', compact('detail', 'total_bayar', 'decode_hari', 'arr_hari'));
    }

    public function update(Request $req, $id)
    {

        $jadwal_siswa = FormJadwalSiswaModel::where('id', $id)

            ->update([
                'dt_jadwal_siswa.status_bayar' => $req->status_bayar,
                'dt_jadwal_siswa.keterangan'  => $req->keterangan,
            ]);




        if ($jadwal_siswa) {
            Toastr::success(' Berhasil ', 'Submit');
            return redirect('/data-jadwal-bukti-bayar');
        } else {
            Toastr::error(' Gagal ', ' Submit');
            return back();
        }
    }
}
