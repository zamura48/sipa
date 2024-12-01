<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Periode;
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
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password, 'role_id' => 1])) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard.index');
        }

        return back()->with('error', 'Username atau Password anda salah');
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
            'email' => 'required',
            'password' => 'required',
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

    public function wali_murid_regis()
    {
        $title = 'Pendaftaran';

        return view('walmur.login.regis', compact('title'));
    }

    public function wali_murid_do_regis(Request $request)
    {
        $request->validate([
            'nis' => 'required|integer|unique:pendaftarans,nis',
            'siswa_name' => 'required',
            'jenis_kelamin_siswa' => 'required',
            'ortu_name' => 'required',
            'jenis_kelamin_ortu' => 'required',
            'alamat_ortu' => 'required',
            'nomor_hp' => 'required',
        ]);

        $periode = Periode::where('status', 1)->first();

        $data_insert_siswa = [
            'nama_ortu' => $request->ortu_name,
            'alamat' => $request->alamat_ortu,
            'telepon_ortu' => $request->nomor_hp,
            'jenis_kelamin_ortu' => $request->jenis_kelamin_ortu,
            'agama' => $request->agama,
            'nis' => $request->nis,
            'nama_siswa' => $request->siswa_name,
            'jenis_kelamin_siswa' => $request->jenis_kelamin_siswa,
            'periode_id' => $periode ? $periode->id : '',
        ];

        $file = $request->file('foto_siswa');
        if ($file) {
            $request->validate([
                'foto_siswa' => 'file|mimes:jpeg,png,jpg|mimetypes:image/jpeg,image/png'
            ]);
            $file_name = $request->nis . str_replace(' ', '_', $request->siswa_name) . '.' . $file->getClientOriginalExtension();
            $file_save = 'foto_siswa';
            $file->move($file_save, $file_name);
            $data_insert_siswa['foto_siswa'] = $file_name;
        }

        Pendaftaran::create($data_insert_siswa);

        return redirect()->route('walmur.regis')->with('success', 'Berhasil melakukan pendaftaran!');
    }

    public function do_log_wali_murid(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
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

        return redirect()->route('admin.login');
    }
}
