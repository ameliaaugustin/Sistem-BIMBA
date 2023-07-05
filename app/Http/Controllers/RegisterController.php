<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisRequest;
use App\Http\Controllers\Controller;
use App\Models\pendaftar\form_pendaftaran\AfiliasiModel;
use App\Models\pendaftar\form_pendaftaran\PendaftaranAyahModel;
use App\Models\pendaftar\form_pendaftaran\PendaftaranIbuModel;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use App\Models\pendaftar\form_pendaftaran\PendaftaranSiswaModel;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            "title" => "Register",
            "active" => 'register',
        ]);
    }

    public function saveregist(RegisRequest $req)
    {
        try {
            $role_murid = 3;
            $get_user_roles = UserRoles::find($role_murid);

            $user = User::create([
                'fullname' => $req->fullname,
                'username' => $req->username,
                'email' => $req->email,
                'password' => Hash::make($req->password),
                'user_role_id' => $get_user_roles->id,
                'remember_token' => $req->_token
            ]);

            // get last user id
            // $pendaftar = PendaftaranSiswaModel::create([
            //     'user_id' => $user->id
            // ]);


            // $dt_afiliasi = AfiliasiModel::create([
            //     'id_pendaftar' => $pendaftar->id
            // ]);

            // $dt_ayah = PendaftaranAyahModel::create([
            //     'id_pendaftar' => $pendaftar->id
            // ]);

            // $dt_ibu = PendaftaranIbuModel::create([
            //     'id_pendaftar' => $pendaftar->id
            // ]);

            Toastr::success('Silahkan Login', 'Registrasi Berhasil');
            return redirect('/login');
        } catch (\Exception $e) {
            Toastr::error('Terjadi Kesalahan, silahkan registrasi kembali', 'Registrasi Gagal');
            return back();
        }
    }
}
