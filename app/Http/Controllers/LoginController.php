<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // login untuk admin
    public function admin_login()
    {
        $title = 'Login';

        return view('admin.login.index', compact('title'));
    }

    public function do_log_admin(Request $request)
    {
        $request->validate([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if (Auth::attempt(['email' => 'email@gmail.com', 'password' => '123456', 'role_id' => 1])) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard.index');
        }

        return back()->with([
            'error' => 'Username atau Password anda salah'
        ]);
    }

    // login untuk pengurus
    public function pengurus_login()
    {
        $title = 'Login';

        return view('pengurus.login.index', compact('title'));
    }

    public function do_log_pengurus(Request $request)
    {
        $request->validate([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if (Auth::attempt(['email' => 'email@gmail.com', 'password' => '123456', 'role_id' => 1])) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard.index');
        }

        return back()->with([
            'error' => 'Username atau Password anda salah'
        ]);
    }

    // login untuk wali_murid
    public function wali_murid_login()
    {
        $title = 'Login';

        return view('walmur.login.index', compact('title'));
    }

    public function do_log_wali_murid(Request $request)
    {
        $request->validate([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if (Auth::attempt(['email' => 'email@gmail.com', 'password' => '123456', 'role_id' => 1])) {
            $request->session()->regenerate();

            return redirect()->route('walmur.dashboard.index');
        }

        return back()->with([
            'error' => 'Username atau Password anda salah'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
