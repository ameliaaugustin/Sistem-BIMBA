<?php

namespace App\Http\Controllers\admin\master_data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\admin\master_data\MasterHariModel;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\admin\master_data\MasterJamPelajaranModel;
use App\Models\admin\master_data\MasterPaketModel;

class MasterJamPelajaranController extends Controller
{
    public function index()
    {
        $master_jam_pel = MasterJamPelajaranModel::select(
            'dt_jam_pelajaran.id_hari',
            'dt_jam_pelajaran.id',
            'dt_jam_pelajaran.jam_mulai',
            'dt_jam_pelajaran.jam_selesai',
            'dt_jam_pelajaran.status_penuh',
            'm_paket.jenis_paket',
            'm_paket.id as id_paket',

        )

            ->leftjoin('m_paket', 'dt_jam_pelajaran.id_paket', 'm_paket.id')
            ->get();


        $jadwals = [];
        if (isset($master_jam_pel)) {
            foreach ($master_jam_pel as $key => $value) {

                $decode_hari = json_decode($value->id_hari);
                $hari = MasterHariModel::whereIn('m_hari.id', $decode_hari)->get()->toArray();
                $jadwals[$value->id] = [
                    'hari' => $hari,
                    'sesi_jam' => $value->jam_mulai . ' - ' . $value->jam_selesai,
                    'jenis_paket' => $value->jenis_paket,
                    'status_penuh' => $value->status_penuh,
                    'id' => $value->id,

                ];
            }
            $master = [
                'jadwals' => $jadwals,
                'master_jam_pel' => $master_jam_pel,

            ];
        }




        return view('admin.master-data.master-jam-pelajaran.index', $master);
    }

    public function create()
    {
        $data_paket = MasterPaketModel::all();
        $data_hari = MasterHariModel::all();
        $data_jam_pel = MasterJamPelajaranModel::all();
        $data_m = [
            'data_hari' => $data_hari,
            'data_jam_pel' => $data_jam_pel,
            'data_paket' => $data_paket
        ];


        return view('admin.master-data.master-jam-pelajaran.create', $data_m);
    }

    public function save(Request $req)
    {
        $req->validate([
            'paket' => ['required'],
            'hari' => ['required'],
            'jam_mulai' => ['required'],
            'jam_selesai' => ['required'],
        ]);

        $json_hari = json_encode($req->hari);


        MasterJamPelajaranModel::create([
            'id_paket' => $req->paket,
            'id_hari' => $json_hari,
            'jam_mulai' => $req->jam_mulai,
            'jam_selesai' => $req->jam_selesai,
        ]);

        Toastr::success(' Berhasil ', 'Tambah Jadwal');
        return redirect('/master-jam-pelajaran');
    }
    public function edit($id)
    {
        $jam_pel_edit = MasterJamPelajaranModel::firstwhere('id', $id);


        $data_paket = MasterPaketModel::all();
        $data_hari = MasterHariModel::get();
        $decode_hari = json_decode($jam_pel_edit->id_hari);

        $data_edit = [
            'jam_pel_edit' => $jam_pel_edit,
            'data_hari' => $data_hari,
            'decode_hari' => $decode_hari,
            'data_paket' => $data_paket,
        ];

        return view('admin.master-data.master-jam-pelajaran.edit', $data_edit);
    }

    public function update(Request $req, $id)
    {
        $req->validate([
            'paket' => ['required'],
            'hari' => ['required'],
            'jam_mulai' => ['required'],
            'jam_selesai' => ['required'],
        ]);

        $json_hari = json_encode($req->hari);

        $update_jadwal = MasterJamPelajaranModel::where('dt_jam_pelajaran.id', $id)->update([
            'id_paket' => $req->paket,
            'id_hari' => $json_hari,
            'jam_mulai' => $req->jam_mulai,
            'jam_selesai' => $req->jam_selesai,
        ]);

        if ($update_jadwal) {
            Toastr::success(' Berhasil ', 'Update Jadwal');
            return redirect('/master-jam-pelajaran');
        } else {
            Toastr::error(' Gagal ', 'Update Jadwal');
            return back();
        }
    }

    // public function destroy($id)
    // {
    //     MasterJamPelajaranModel::where('id', $id)->delete();
    //     Toastr::success(' Berhasil ', 'Hapus Jadwal');
    //     return redirect('/master-jam-pelajaran');
    // }
    public function status($id, $status)
    {

        MasterJamPelajaranModel::where('id', $id)->update([
            'status_penuh' => $status,
        ]);

        Toastr::success(' Berhasil ', 'Update Status');
        return redirect('/master-jam-pelajaran');
    }
}
