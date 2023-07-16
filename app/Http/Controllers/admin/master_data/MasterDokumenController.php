<?php

namespace App\Http\Controllers\admin\master_data;

use App\Http\Controllers\Controller;
use App\Models\admin\master_data\MasterDokumenModel;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class MasterDokumenController extends Controller
{
    public function index()
    {
        $master_dokumen = MasterDokumenModel::get();
        return view('admin.master-data.master-dokumen.index', compact('master_dokumen'));
    }

    public function create()
    {
        return view('admin.master-data.master-dokumen.create');
    }

    public function save(Request $req)
    {
        $req->validate([
            'jenis_dokumen' => ['required'],
        ]);

        $convert_capital = strtolower($req->jenis_dokumen);

        $nama_request = str_replace(' ', '_', $convert_capital);

        $validasi = '["required", "max:1028", "mimes:jpg,jpeg,png,pdf"]';

        $save_data = MasterDokumenModel::create([
            'jenis_dokumen' => $req->jenis_dokumen,
            'nama_request' => $nama_request,
            'validasi' => $validasi,
            'created_by' => auth()->user()->id,
        ]);

        if ($save_data) {
            Toastr::success('Berhasil', 'Tambah Nama Dokumen');
            return redirect('/master-dokumen');
        } else {
            Toastr::error('Gagal', 'Tambah Nama Dokumen');
            return back();
        }
    }

    public function edit($id)
    {
        $dokumen_edit = MasterDokumenModel::find($id);
        return view('admin.master-data.master-dokumen.edit', compact('dokumen_edit'));
    }

    public function update(Request $req, $id)
    {
        $req->validate([
            'jenis_dokumen' => ['required'],

        ]);
        $convert_capital = strtolower($req->jenis_dokumen);
        $nama_request = str_replace(' ', '_', $convert_capital);
        $validasi = '["required", "max:1028", "mimes:jpg,jpeg,png,pdf,doc,docx"]';

        $update_dokumen = MasterDokumenModel::where('id', $id)->update([
            'jenis_dokumen' => $req->jenis_dokumen,
            'nama_request' => $nama_request,
            'validasi' => $validasi,
            'updated_by' => auth()->user()->id
        ]);
        if ($update_dokumen) {
            Toastr::success('Berhasil', 'Update Nama Dokumen');
            return redirect('/master-dokumen');
        } else {
            Toastr::error('Gagal', 'Update Nama Dokumen');
            return back();
        }
    }


    public function destroy($id)
    {
        $dokumen = MasterDokumenModel::where('id', $id)->delete();

        if ($dokumen) {
            Toastr::success('Berhasil', 'Delete Nama Dokumen');
            return redirect('/master-dokumen');
        } else {
            Toastr::error('Gagal', 'Delete Nama Dokumen');
            return back();
        }
    }
}
