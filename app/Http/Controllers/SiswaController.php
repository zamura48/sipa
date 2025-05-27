<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Siswa;
use App\Models\WaliMurid;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Siswa';
        $data = Siswa::all()->load(['penghuni.kamar', 'periode', 'ortu', 'sekolah']);
        $data = Siswa::with(['penghuni.kamar', 'periode', 'ortu', 'sekolah'])->get();

        // jika user yang login rolenya adalah 3(wali murid) maka data yang ditampilkan hanya siswa dengan pengguna_id saja
        if (auth()->user()->role_id == 3) {
            $data = Siswa::where('wali_murid_id', '=', auth()->user()->wali_murid_id)->get();

            return view('walmur.siswa.index', compact('title', 'data'));
        }

        return view('admin.siswa.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Siswa';
        $ortu = Pengguna::with('user.role')->whereHas('user', function ($query) {
            $query->where('role_id', 3);
        })->get();
        return view('admin.siswa.create', compact('title', 'ortu'));
    }

    private function validation(Request $request, $id = '')
    {
        $id_except = $id ? ',id,' . $id : ',nis';

        $request->validate([
            'nis' => 'required|integer|unique:siswas' . $id_except,
            'nama' => 'required',
            'jenis_kelamin' => 'required',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        Pilihan::create($request->all());

        return redirect()->route('admin.pilihan.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        $title = 'Detail Siswa';
        $ortu = WaliMurid::with('user.role')->whereHas('user', function ($query) {
            $query->where('role_id', 3);
        })->get();
        return view('admin.siswa.show', compact('title', 'siswa', 'ortu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $this->validation($request, $siswa->id);

        $siswa->update($request->all());

        return redirect()->route('admin.siswa.index')->with('success', 'Data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Data berhasil diihapus!');
    }
}
