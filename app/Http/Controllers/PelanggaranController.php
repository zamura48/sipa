<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Pelanggaran';
        $siswas = Siswa::whereHas('penghuni')->get();

        $data = Pelanggaran::with('siswa')->get();

        if (auth()->user()->role_id == 2) {
            return view('pengurus.pelanggaran.index', compact('title', 'data', 'siswas'));
        } else if (auth()->user()->role_id == 3) {
            $data = Pelanggaran::with('siswa')->whereHas('siswa', function ($q) {
                $q->where('wali_murid_id', auth()->user()->wali_murid_id);
            })->get();
            return view('walmur.pelanggaran.index', compact('title', 'data'));
        } else {
            return view('admin.pelanggaran.index', compact('title', 'data', 'siswas'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    private function validation($request)
    {
        $request->validate([
            'siswa' => 'required',
            'kategori' => 'required',
            'catatan' => 'required',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $id = $request->post('id');
        $siswa = $request->post('siswa');
        $kategori = $request->post('kategori');
        $catatan = $request->post('catatan');

        $data_array = [
            'siswa_id' => $siswa,
            'kategori' => $kategori,
            'catatan' => $request->post('catatan'),
        ];

        if ($id) {
            Pelanggaran::where('id', $id)->update($data_array);
        } else {
            Pelanggaran::create($data_array);
        }

        $get_data = Siswa::with('ortu')->where('id', $siswa)->first();

        $text_wa = "Siswa dengan nama {$get_data->nama} telah mendapatkan pelanggaran $kategori dengan alasan sebagai berikut:
            \n$catatan
            \n\nTerimakasih";
        send_wa($get_data->ortu->telepon, $text_wa);

        $role = 'admin';
        if (auth()->user()->role_id == 2) {
            $role = 'pengurus';
        }
        return redirect()->route($role . '.pelanggaran.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggaran $pelanggaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggaran $pelanggaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelanggaran $pelanggaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggaran $pelanggaran)
    {
        $pelanggaran->delete();

        $role = 'admin';
        if (auth()->user()->role_id == 2) {
            $role = 'pengurus';
        }
        return redirect()->route($role.'.pelanggaran.index')->with('success', 'Data berhasil diihapus!');
    }
}
