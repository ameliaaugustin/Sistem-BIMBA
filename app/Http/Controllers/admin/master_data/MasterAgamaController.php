<?php

namespace App\Http\Controllers\admin\master_data;

use App\Http\Controllers\Controller;
use App\Models\admin\master_data\MasterAgamaModel;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

use function GuzzleHttp\Promise\all;

class MasterAgamaController extends Controller
{
    public function index()
    {
        $master_agama = MasterAgamaModel::get();

        return view('admin.master-data.master-agama.index', compact('master_agama'));
    }

    public function create()
    {
        return view('admin.master-data.master-agama.create');
    }

    public function save(Request $req)
    {
        $req->validate([
            'nama_agama' => ['required'],
        ]);
        MasterAgamaModel::create([
            'nama_agama' => $req->nama_agama,
            'created_by' => auth()->user()->id

        ]);

        Toastr::success(' Berhasil ', 'Tambah Agama');
        return redirect('/master-agama');
    }

    public function edit($id)
    {
        $agama_edit = MasterAgamaModel::find($id);

        return view('admin.master-data.master-agama.update', compact('agama_edit'));
    }

    public function update(Request $req, $id)
    {

        $req->validate([
            'nama_agama' => ['required']
        ]);

        $update_agama = MasterAgamaModel::where('id', $id)->update([
            'nama_agama'     => $req->nama_agama,
            'updated_by' => auth()->user()->id
        ]);

        if ($update_agama) {
            Toastr::success(' Berhasil ', 'Update Agama');
            return redirect('/master-agama');
        } else {
            Toastr::error(' Gagal ', 'Update Agama');
            return back();
        }
    }
    public function destroy($id)
    {
        $agama_destroy = MasterAgamaModel::where('id', $id)->delete();
        if ($agama_destroy) {
            Toastr::success(' Berhasil ', 'Hapus Agama');
            return redirect('/master-agama');
        } else {
            Toastr::error(' Gagal ', 'Hapus Agama');
            return back();
        }
    }
}
