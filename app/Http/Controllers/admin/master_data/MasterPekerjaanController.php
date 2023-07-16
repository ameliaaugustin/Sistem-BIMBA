<?php

namespace App\Http\Controllers\admin\master_data;

use App\Http\Controllers\Controller;
use App\Models\admin\master_data\MasterPekerjaanModel;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

use function GuzzleHttp\Promise\all;

class MasterPekerjaanController extends Controller
{
    public function index()
    {
        $master_pekerjaan = MasterPekerjaanModel::get();
        return view('admin.master-data.master-pekerjaan.index', compact('master_pekerjaan'));
    }

    public function create()
    {
        return view('admin.master-data.master-pekerjaan.create');
    }
    public function save(Request $req)
    {
        $data_pekerjaan = $req->validate([
            'jenis_pekerjaan' => ['required']
        ]);
        $savepekerjaan = MasterPekerjaanModel::create([
            'jenis_pekerjaan' => $req->jenis_pekerjaan,
            'created_by' => auth()->user()->id
        ]);

        if ($savepekerjaan) {
            Toastr::success(' Berhasil ', 'Tambah Pekerjaan');
            return redirect('/master-pekerjaan');
        } else {
            Toastr::error(' Gagal ', 'Create Pekerjaan');
            return back();
        }
    }

    public function edit($id)
    {
        $pekerjaan_edit = MasterPekerjaanModel::find($id);
        return view('admin.master-data.master-pekerjaan.edit', compact('pekerjaan_edit'));
    }

    public function update(Request $req, $id)
    {
        $update = $req->validate([
            'jenis_pekerjaan' => ['required']
        ]);
        $update_pekerjaan = MasterPekerjaanModel::where('id', $id)->update([
            'jenis_pekerjaan' => $req->jenis_pekerjaan,
            'updated_by' => auth()->user()->id
        ]);
        if ($update_pekerjaan) {
            Toastr::success(' Berhasil ', 'Update Pekerjaan');
            return redirect('/master-pekerjaan');
        } else {
            Toastr::error(' Gagal ', 'Update Pekerjaan');
            return back();
        }
    }

    public function destroy($id)
    {
        $delete_pekerjaan = MasterPekerjaanModel::where('id', $id)->delete(['jenis_pekerjaan']);
        if ($delete_pekerjaan) {
            Toastr::success(' Berhasil ', 'Delete Pekerjaan');
            return redirect('/master-pekerjaan');
        } else {
            Toastr::error(' Gagal ', 'Delete Pekerjaan');
            return back();
        }
    }
}
