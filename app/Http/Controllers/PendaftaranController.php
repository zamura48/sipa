<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Pengguna;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Pendaftaran Siswa';
        $data_pendaftaran = Pendaftaran::where('status', 0)->get()->load('periode');

        return view('admin.pendaftaran.index', compact('title', 'data_pendaftaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        DB::beginTransaction();

        try {
            $siswa = Siswa::create([
                'kamar_id' => 0,
                'periode_id' => $pendaftaran->periode_id,
                'nis' => $pendaftaran->nis,
                'nama' => $pendaftaran->nama_siswa,
                'jenis_kelamin' => $pendaftaran->jenis_kelamin_siswa,
                'foto' => $pendaftaran->foto_siswa,
            ]);

            $data_pengguna = Pengguna::where('nama', 'like', "%{$pendaftaran->nama_ortu}%")->first();

            if ($data_pengguna) {
                $pengguna = $data_pengguna;
            } else {
                $pengguna = Pengguna::create([
                    'siswa_id' => $siswa->id,
                    'nama' => $pendaftaran->nama_ortu,
                    'alamat' => $pendaftaran->alamat,
                    'telepon' => $pendaftaran->telepon_ortu,
                    'jenis_kelamin' => $pendaftaran->jenis_kelamin_ortu,
                ]);
            }

            User::create([
                'role_id' => 3,
                'pengguna_id' => $pengguna->id,
                'name' => $pendaftaran->nama_ortu,
                'email' => '',
                'username' => $pendaftaran->nis,
                'password' => Hash::make($pendaftaran->nis),
            ]);

            $pendaftaran->update(['status' => 1]);

            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil dikonfirmasi!');
        } catch (\Exception $ex) {
            dd($ex->getMessage());
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        //
    }
}
