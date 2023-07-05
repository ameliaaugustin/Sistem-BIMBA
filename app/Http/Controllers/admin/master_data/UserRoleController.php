<?php

namespace App\Http\Controllers\admin\master_data;

use App\Models\UserRoles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class UserRoleController extends Controller
{
    public function index()
    {
        $user_role = UserRoles::get();
        return view('admin.master-data.master-role.index', compact('user_role'));
    }
    public function create()
    {
        return view('admin.master-data.master-role.create');
    }

    public function save(Request $req)
    {
        $role = $req->validate([
            'role_name' => ['required']
        ]);
        $save_role = UserRoles::create($role);

        if ($save_role) {
            Toastr::success(' Berhasil ', 'Tambah Role');
            return redirect('/master-role');
        } else {
            Toastr::error(' Gagal ', 'Tambah Role');
            return back();
        }
    }
    public function edit($id)
    {
        $role_edit = UserRoles::find($id);
        return view('admin.master-data.master-role.edit', compact('role_edit'));
    }
    public function update(Request $req, $id)
    {
        $roles = $req->validate([
            'role_name' => ['required']
        ]);
        $update_role = UserRoles::where('id', $id)->update($roles);

        if ($update_role) {
            Toastr::success(' Berhasil ', 'Edit Role');
            return redirect('/master-role');
        } else {
            Toastr::error(' Gagal ', 'Edit Role');
            return back();
        }
    }
    public function destroy($id)
    {
        $role_destroy = UserRoles::where('id', $id)->delete();

        if ($role_destroy) {
            Toastr::success(' Berhasil ', 'Hapus Role');
            return redirect('/master-role');
        } else {
            Toastr::error(' Gagal ', 'Hapus Role');
            return back();
        }
    }
}
