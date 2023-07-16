<?php

namespace App\Http\Controllers\admin\master_data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\admin\master_data\MasterPaketModel;

class MasterPaketController extends Controller
{
    public function index()
    {
        $master_paket = MasterPaketModel::get();

        return view('admin.master-data.master-paket.index', compact('master_paket'));
    }

    public function create()
    {
        return view('admin.master-data.master-paket.create');
    }

    public function save(Request $req)
    {
        $req->validate([
            'jenis_paket' => ['required'],
            'biaya_paket' => ['required'],
        ]);
        MasterPaketModel::create([
            'jenis_paket' => $req->jenis_paket,
            'biaya_paket' => $req->biaya_paket,
            'created_by' => auth()->user()->id
        ]);

        Toastr::success(' Berhasil ', 'Tambah Paket');
        return redirect('/master-paket');
    }

    public function edit($id)
    {
        $paket_edit = MasterPaketModel::find($id);

        return view('admin.master-data.master-paket.edit', compact('paket_edit'));
    }

    public function update(Request $req, $id)
    {

        $req->validate([
            'jenis_paket' => ['required'],
            'biaya_paket' => ['required'],
        ]);

        $update_paket = MasterPaketModel::where('id', $id)->update([
            'jenis_paket' => $req->jenis_paket,
            'biaya_paket' => $req->biaya_paket,
            'updated_by' => auth()->user()->id
        ]);

        if ($update_paket) {
            Toastr::success(' Berhasil ', 'Update Paket');
            return redirect('/master-paket');
        } else {
            Toastr::error(' Gagal ', 'Update Paket');
            return back();
        }
    }

    public function destroy($id)
    {

        MasterPaketModel::where('id', $id)->delete();
        Toastr::success(' Berhasil ', 'Hapus Paket');
        return redirect('/master-paket');
    }
}
