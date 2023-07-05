<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }
    public function auth(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            Toastr::success('Anda masuk sebagai' . ' ' . $user->fullname, 'Login Berhasil');
            return redirect()->intended('/');
        } else {
            Toastr::error('Terjadi Kesalahan pada login', 'Maaf!');
            return back();
        }
    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
