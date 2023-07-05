<?php

namespace App\Http\Controllers\admin\data;

use App\Models\User;
use App\Models\UserRoles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\pendaftar\form_pendaftaran\AfiliasiModel;
use App\Models\pendaftar\form_pendaftaran\PendaftaranSiswaModel;

class AffiliasiController extends Controller
{
    public function index(Request $req)
    {
        $role_search = $req->role_search;
        $user_search = $req->user_search;

        $roles = UserRoles::whereIn('id', [1, 2])
            ->get();

        $data_affiliasi = AfiliasiModel::select(
            'dt_pendaftar.nama_lengkap',
            'dt_afiliasi.created_at',
            'dt_afiliasi.sosmed_options',
            'dt_afiliasi.user_id_affiliate',
            'dt_afiliasi.nama_afiliate',
            'user_roles.role_name',
            'users.user_role_id',

        )
            ->leftjoin('dt_pendaftar', 'dt_afiliasi.id_pendaftar', 'dt_pendaftar.id')
            ->leftjoin('users', 'dt_afiliasi.user_id_affiliate', 'users.id')
            ->leftjoin('user_roles', 'users.user_role_id', 'user_roles.id')
            ->when($role_search, function ($query, $role_search) {
                $query->where('users.user_role_id', $role_search);
            })
            ->when($user_search, function ($query, $user_search) {
                $query->where('dt_afiliasi.nama_afiliate', 'LIKE', '%' . $user_search . '%');
            })
            ->orderBy('dt_afiliasi.created_at', 'DESC')
            ->paginate(10);


        return view('admin.data.affiliasi.index', compact('data_affiliasi', 'role_search', 'user_search', 'roles'));
    }
    public function excel($role_search)
    {
        if ($role_search == 'null') {
            $role_search = null;
        }

        $spreadsheet = new Spreadsheet();
        $writer = new Xlsx($spreadsheet);

        $spreadsheet->setActiveSheetIndex(0);
        $activeSheet = $spreadsheet->getActiveSheet();

        $activeSheet->setCellValue('A1', 'No');
        $activeSheet->setCellValue('B1', 'Nama Pendaftar');
        $activeSheet->setCellValue('C1', 'Tanggal Daftar');
        $activeSheet->setCellValue('D1', 'Nama Affiliasi');
        $activeSheet->setCellValue('E1', 'Role Affiliasi');
        $activeSheet->setCellValue('F1', 'Harga Affiliasi');


        $data_affiliasi = AfiliasiModel::select(
            'dt_pendaftar.nama_lengkap',
            'dt_afiliasi.created_at',
            'dt_afiliasi.sosmed_options',
            'dt_afiliasi.user_id_affiliate',
            'dt_afiliasi.nama_afiliate',
            'user_roles.role_name',
            'users.user_role_id',

        )
            ->leftjoin('dt_pendaftar', 'dt_afiliasi.id_pendaftar', 'dt_pendaftar.id')
            ->leftjoin('users', 'dt_afiliasi.user_id_affiliate', 'users.id')
            ->leftjoin('user_roles', 'users.user_role_id', 'user_roles.id')
            ->when($role_search, function ($query, $role_search) {
                $query->where('users.user_role_id', $role_search);
            })
            // ->when($user_search, function ($query, $user_search) {
            //     $query->where('dt_afiliasi.nama_afiliate', 'LIKE', '%' . $user_search . '%');
            // })
            ->orderBy('dt_afiliasi.created_at', 'DESC')
            ->get();


        $count = 1;
        $harga_affiliasi = 25000;
        if (count($data_affiliasi) > 0) {
            foreach ($data_affiliasi as $key => $value) {
                $new_key = $key + 2;


                $role_lainnya = 'Lainnya';


                $activeSheet->setCellValue('A' . $new_key, $count++);
                $activeSheet->setCellValue('B' . $new_key, $value->nama_lengkap);
                $activeSheet->setCellValue('C' . $new_key, date('d-M-Y', strtotime($value->created_at)));
                $activeSheet->setCellValue('D' . $new_key, $value->nama_afiliate ?? $value->sosmed_options);
                $activeSheet->setCellValue('E' . $new_key, $value->role_name ?? $role_lainnya);
                $activeSheet->setCellValue('F' . $new_key, $harga_affiliasi);
            }

            $filename = 'data_affiliasi_' . date('d-M-Y', strtotime($value->created_at)) . '.xlsx';

            header('Content-Type: text/xlsx');
            header('Content-Disposition: attachment;filename=' . $filename);
            header('Cache-Control: max-age-0');

            Toastr::success('Data Telah di Eksport', 'Berhasil');
            $writer->save('php://output');
        }
        // dd($status, $data_affiliasi);
    }
}
