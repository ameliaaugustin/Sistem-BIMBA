<?php

namespace App\Http\Controllers\admin\data;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Models\pendaftar\form_pendaftaran\FormDokumenModel;
use App\Models\pendaftar\form_pendaftaran\PendaftaranIbuModel;
use App\Models\pendaftar\form_pendaftaran\PendaftaranAyahModel;
use App\Models\pendaftar\form_pendaftaran\PendaftaranSiswaModel;

class PendaftarController extends Controller
{
    public function index(Request $req)
    {
        $search = $req->search;
        $status = $req->status;

        $dt_pendaftar = PendaftaranSiswaModel::when($status, function ($query, $status) {
            $query->where('status', $status);
        })
            ->when($search, function ($query, $search) {
                $query->where('nama_lengkap', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(5);

        return view('admin.data.pendaftar.index', compact('dt_pendaftar', 'search', 'status'));
    }

    public function excel($status)
    {
        if ($status == 'null') {
            $status = null;
        }

        $spreadsheet = new Spreadsheet();
        $writer = new Xlsx($spreadsheet);

        $spreadsheet->setActiveSheetIndex(0);
        $activeSheet = $spreadsheet->getActiveSheet();

        $activeSheet->setCellValue('A1', 'No');
        $activeSheet->setCellValue('B1', 'Nama Siswa');
        $activeSheet->setCellValue('C1', 'Nama Panggilan');
        $activeSheet->setCellValue('D1', 'Tempat, Tanggal Lahir');
        $activeSheet->setCellValue('E1', 'Jenis Kelamin');
        $activeSheet->setCellValue('F1', 'Agama');
        $activeSheet->setCellValue('G1', 'Status Pendaftaran');
        $activeSheet->setCellValue('H1', 'Nama Ayah');
        $activeSheet->setCellValue('I1', 'No. Telp Ayah');
        $activeSheet->setCellValue('J1', 'Nama Ibu');
        $activeSheet->setCellValue('K1', 'No. Telp Ibu');
        $activeSheet->setCellValue('L1', 'Alamat');


        $dt_pendaftar = PendaftaranSiswaModel::leftjoin('m_agama', 'dt_pendaftar.agama', 'm_agama.id')
            ->leftjoin('dt_ayah', 'dt_pendaftar.id', 'dt_ayah.id_pendaftar')
            ->leftjoin('dt_ibu', 'dt_pendaftar.id', 'dt_ibu.id_pendaftar')
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })->orderBy('dt_pendaftar.created_at', 'DESC')
            ->get();

        $count = 1;
        if (count($dt_pendaftar) > 0) {
            foreach ($dt_pendaftar as $key => $value) {
                $new_key = $key + 2;

                if ($value->jenis_kelamin == 'L') {
                    $jenis_kelamin = 'Laki-laki';
                } elseif ($value->jenis_kelamin == 'P') {
                    $jenis_kelamin = 'Perempuan';
                } else {
                    $jenis_kelamin = '';
                }

                if ($value->status == 'Y') {
                    $status_excel = 'Diterima';
                } elseif ($value->status == 'N') {
                    $status_excel = 'Dikembalikan';
                } else {
                    $status_excel = 'Menunggu Validasi';
                }



                $ttl =  $value->tempat_lahir . '-' . date('d-M-Y', strtotime($value->tanggal_lahir ?? ''));

                $activeSheet->setCellValue('A' . $new_key, $count++);
                $activeSheet->setCellValue('B' . $new_key, $value->nama_lengkap);
                $activeSheet->setCellValue('C' . $new_key, $value->nama_panggilan);
                $activeSheet->setCellValue('D' . $new_key, $ttl);
                $activeSheet->setCellValue('E' . $new_key, $jenis_kelamin);
                $activeSheet->setCellValue('F' . $new_key, $value->nama_agama);
                $activeSheet->setCellValue('G' . $new_key, $status_excel);
                $activeSheet->setCellValue('H' . $new_key, $value->nama_ayah);
                $activeSheet->setCellValue('I' . $new_key, $value->no_telp_ayah);
                $activeSheet->setCellValue('J' . $new_key, $value->nama_ibu);
                $activeSheet->setCellValue('K' . $new_key, $value->no_telp_ibu);
                $activeSheet->setCellValue('L' . $new_key, $value->alamat_ayah);
            }

            $filename = 'data_pendaftar_' . $status . '.xlsx';

            header('Content-Type: text/xlsx');
            header('Content-Disposition: attachment;filename=' . $filename);
            header('Cache-Control: max-age-0');

            Toastr::success('Data Telah di Eksport', 'Berhasil');
            $writer->save('php://output');
        }
    }

    public function detail($id)
    {
        $pendaftar = PendaftaranSiswaModel::select(
            'dt_pendaftar.id as id_pendaftar',
            'dt_pendaftar.nama_lengkap',
            'dt_pendaftar.nama_panggilan',
            'dt_pendaftar.tempat_lahir',
            'dt_pendaftar.tanggal_lahir',
            'dt_pendaftar.jenis_kelamin',
            'dt_pendaftar.asal_sekolah',
            'dt_pendaftar.anak_ke',
            'dt_pendaftar.hobi',
            'dt_pendaftar.status',
            'dt_pendaftar.agama',
            'm_agama.nama_agama',

            'dt_pendaftar.riwayat_sakit',
            'dt_pendaftar.konsumsi_obat',
            'dt_pendaftar.pernah_les',
            'dt_pendaftar.old_nama_lembaga',
            'dt_pendaftar.old_level_les',
            'dt_pendaftar.old_alasan_keluar',
            'dt_pendaftar.alasan_memilih',

            'dt_afiliasi.sosmed_options',

            'dt_afiliasi.nama_afiliate',
            'dt_afiliasi.user_id_affiliate',

            'users.fullname',

        )
            ->join('m_agama', 'dt_pendaftar.agama', 'm_agama.id')
            ->leftjoin('dt_afiliasi', 'dt_pendaftar.id', 'dt_afiliasi.id_pendaftar')
            ->leftjoin('users', 'dt_afiliasi.user_id_affiliate', 'users.id')
            ->where('dt_pendaftar.id', $id)
            ->first();

        $ayah = PendaftaranAyahModel::select(
            'dt_ayah.id as id_ayah',
            'dt_ayah.id_pendaftar',
            'dt_ayah.nama_ayah',
            'dt_ayah.tempat_lahir_ayah',
            'dt_ayah.tgl_lahir_ayah',
            'dt_ayah.pendidikan_ayah',
            'dt_ayah.pekerjaan_ayah',
            'dt_ayah.alamat_ayah',
            'dt_ayah.no_telp_ayah',
            'm_pekerjaan.id',
            'm_pekerjaan.jenis_pekerjaan',

        )
            ->leftjoin('m_pekerjaan', 'dt_ayah.pekerjaan_ayah', 'm_pekerjaan.id')
            ->where('id_pendaftar', $id)->first();

        $ibu = PendaftaranIbuModel::select(
            'dt_ibu.id as id_ibu',
            'dt_ibu.id_pendaftar',
            'dt_ibu.nama_ibu',
            'dt_ibu.tempat_lahir_ibu',
            'dt_ibu.tgl_lahir_ibu',
            'dt_ibu.pendidikan_ibu',
            'dt_ibu.pekerjaan_ibu',
            'dt_ibu.alamat_ibu',
            'dt_ibu.no_telp_ibu',
            'm_pekerjaan.id',
            'm_pekerjaan.jenis_pekerjaan',

        )
            ->leftjoin('m_pekerjaan', 'dt_ibu.pekerjaan_ibu', 'm_pekerjaan.id')
            ->where('id_pendaftar', $id)->first();



        $document = FormDokumenModel::join('m_dokumen', 'dt_dokumen.id_m_dokumen', 'm_dokumen.id')
            ->where('dt_dokumen.id_pendaftar', $id)
            ->get();


        $data = [
            'pendaftar' => $pendaftar,
            'ayah' => $ayah,
            'ibu' => $ibu,
            'id' => $id,
            'dokumen' => $document
        ];


        return view('admin.data.pendaftar.detail', $data);
    }
    public function update(Request $req, $id)
    {
        $req->validate([
            'status_select' => ['required'],
            'keterangan' => ['required'],
        ]);

        $pendaftar = PendaftaranSiswaModel::where('id', $id)

            ->update([
                'dt_pendaftar.status' => $req->status_select,
                'dt_pendaftar.keterangan'  => $req->keterangan,
            ]);

        if ($pendaftar) {
            Toastr::success(' Berhasil ', 'Submit');
            return redirect('/data-pendaftar/');
        } else {
            Toastr::error(' Gagal ', ' Submit');
            return back();
        }
    }
}
