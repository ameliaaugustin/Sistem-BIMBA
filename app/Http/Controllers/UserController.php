<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRoles;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user =  User::where('user_role_id', '!=', 3)
            ->get();
        return view('admin.master-user.index', compact('user'));
    }
    public function create()
    {
        $user_role = UserRoles::where('id', '!=', 3)->get();
        return view('admin.master-user.create', compact('user_role'));
    }

    public function save(Request $req)
    {
        $req->validate([
            'nama_user' => ['required'],
            'user_role_id' => ['required'],
            'username' => ['required', 'unique:users,username'],
            'email' => ['required', 'unique:users,email', 'email:dns'],
            'password' => ['required', 'min:6'],
        ]);
        User::create([
            'fullname' => $req->nama_user,
            'user_role_id' => $req->user_role_id,
            'username' => $req->username,
            'email' => $req->email,
            'password' => Hash::make($req->password),
        ]);

        Toastr::success(' Berhasil ', 'Tambah User');
        return redirect('/master-user');
    }

    public function edit($id)
    {
        $edit_user = User::find($id);
        $role_id = UserRoles::where('id', '!=', 3)->get();

        return view('admin.master-user.edit', compact('edit_user', 'role_id'));
    }

    public function update(Request $req, $id)
    {

        $req->validate([
            'nama_user' => ['required'],
            'user_role_id' => ['required'],
            'username' => ['required', 'unique:users,username'],
            'email' => ['required', 'unique:users,email', 'email:dns'],
            'password' => ['required', 'min:6'],
        ]);

        $update_user = User::where('id', $id)->update([
            'fullname' => $req->nama_user,
            'user_role_id' => $req->user_role_id,
            'username' => $req->username,
            'email' => $req->email,
            'password' => Hash::make($req->password),
        ]);

        if ($update_user) {
            Toastr::success(' Berhasil ', 'Update User');
            return redirect('/master-user');
        } else {
            Toastr::error(' Gagal ', 'Update User');
            return back();
        }
    }
    public function destroy($id)
    {
        $user = User::where('id', $id)->delete();
        if ($user) {
            Toastr::success('Berhasil', 'Delete Nama User');
            return redirect('/master-user');
        } else {
            Toastr::error('Gagal', 'Delete Nama User');
            return back();
        }
    }
}
