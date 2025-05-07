<?php

namespace App\Http\Controllers;

use App\Models\Keringanan;
use App\Models\Pendaftaran;
use App\Models\PendaftaranKeringanan;
use App\Models\Periode;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

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
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password, 'role_id' => 2])) {
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
        $tipe_keringanan = Keringanan::all();
        $sekolah = Sekolah::all();

        return view('walmur.login.regis', compact('title', 'tipe_keringanan', 'sekolah'));
    }

    public function wali_murid_do_regis(Request $request)
    {
        $request->validate([
            'nis' => 'required|integer|min_digits:8|unique:pendaftarans,nis',
            'sekolah' => 'required',
            'siswa_name' => 'required',
            'jenis_kelamin_siswa' => 'required',
            'ortu_name' => 'required',
            'jenis_kelamin_ortu' => 'required',
            'alamat_ortu' => 'required',
            'nomor_hp' => 'required',
        ], [
            'nis.required' => 'NIS wajib diisi.',
            'nis.min_digits' => 'NIS harus terdiri dari 8 digit angka.',
            'nis.unique' => 'NIS ini sudah terdaftar.',
            'sekolah.required' => 'Nama sekolah tidak boleh kosong.',
            'siswa_name.required' => 'Nama siswa wajib diisi.',
            'jenis_kelamin_siswa.required' => 'Jenis kelamin siswa wajib dipilih.',
            'ortu_name.required' => 'Nama orang tua wajib diisi.',
            'jenis_kelamin_ortu.required' => 'Jenis kelamin orang tua wajib dipilih.',
            'alamat_ortu.required' => 'Alamat orang tua wajib diisi.',
            'nomor_hp.required' => 'Nomor HP wajib diisi.',
        ]);

        if ($request->tipe_keringanan[0] != '' && empty($request->dokumen_pelengkap)) {
            $request->validate([
                'dokumen_pelengkap' => 'required|file'
            ]);
        }

        $periode = Periode::where('status', 1)->first();

        if (empty($periode)) {
            return redirect()->route('walmur.regis')->with('error', 'Pendaftaran Belum Dibuka.');
        }

        $data_insert_siswa = [
            'sekolah_id' => $request->sekolah,
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
            $file_name = $request->nis . time() . str_replace(' ', '_', $request->siswa_name) . '.' . $file->getClientOriginalExtension();
            $file_save = 'foto_siswa';
            $file->move($file_save, $file_name);
            $data_insert_siswa['foto_siswa'] = $file_name;
        }

        DB::beginTransaction();
        try {
            $pendaftaran = Pendaftaran::create($data_insert_siswa);


            if ($request->tipe_keringanan && $request->dokumen_pelengkap) {
                foreach ($request->tipe_keringanan as $key => $value) {

                    $dokumen = $request->file('dokumen_pelengkap')[$key];
                    $dokumen_name = $request->nis . str_replace(' ', '_', $request->siswa_name) . '.' . $dokumen->getClientOriginalExtension();
                    $file_save = 'pendaftaran_keringanan';
                    $dokumen->move($file_save, $dokumen_name);

                    PendaftaranKeringanan::create([
                        'pendaftaran_id' => $pendaftaran->id,
                        'keringanan_id' => $value,
                        'dokumen_pendukung' => $dokumen_name
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('walmur.regis')->with('success', 'Berhasil melakukan pendaftaran!');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('walmur.regis')->with('error', $ex->getMessage());
        }
    }

    public function do_log_wali_murid(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password, 'role_id' => 3])) {
            $request->session()->regenerate();

            return redirect()->route('walmur.dashboard.index');
        }

        return back()->with([
            'error' => 'Username atau Password anda salah'
        ]);
    }

    public function logout(Request $request)
    {
        // Mendapatkan URI route saat ini
        $current_route = Route::current()->uri();

        // Memecah URI menjadi segment
        $segments = explode('/', $current_route);

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $modul = $segments[0];
        if ($modul == 'wali_murid') {
            $modul = 'walmur';
        }
        return redirect()->route($modul . '.login');
    }
}
