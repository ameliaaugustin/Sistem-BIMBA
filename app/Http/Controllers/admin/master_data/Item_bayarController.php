<?php

namespace App\Http\Controllers\admin\master_data;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\admin\master_data\ItemBayarModel;

class Item_bayarController extends Controller
{
    public function index()
    {
        $item_bayar = ItemBayarModel::get();
        return view('admin.master-data.master-item-bayar.index', compact('item_bayar'));
    }
    public function create()
    {
        return view('admin.master-data.master-item-bayar.create');
    }

    public function save(Request $req)
    {
        $item_bayar = $req->validate([
            'nama_item' => ['required'],
            'biaya_item' => ['required'],
        ]);
        $save = ItemBayarModel::create($item_bayar);

        if ($save) {
            Toastr::success(' Berhasil ', 'Tambah Item Bayar');
            return redirect('/master-item-bayar');
        } else {
            Toastr::error(' Gagal ', 'Tambah Item Bayar');
            return back();
        }
    }
    public function edit($id)
    {
        $item_edit = ItemBayarModel::find($id);
        return view('admin.master-data.master-item-bayar.edit', compact('item_edit'));
    }
    public function update(Request $req, $id)
    {
        $item = $req->validate([
            'nama_item' => ['required'],
            'biaya_item' => ['required']
        ]);
        $update_item = ItemBayarModel::where('id', $id)->update($item);

        if ($update_item) {
            Toastr::success(' Berhasil ', 'Edit Item Bayar');
            return redirect('/master-item-bayar');
        } else {
            Toastr::error(' Gagal ', 'Edit Item Bayar');
            return back();
        }
    }
    public function destroy($id)
    {
        $item_destroy = ItemBayarModel::where('id', $id)->delete();
        if ($item_destroy) {
            Toastr::success(' Berhasil ', 'Hapus Item Bayar');
            return redirect('/master-item-bayar');
        } else {
            Toastr::error(' Gagal ', 'Hapus Item Bayar');
            return back();
        }
    }
}
