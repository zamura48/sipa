<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\JadwalDetail;
use App\Models\Kegiatan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Jadwal';
        $data = Jadwal::with('jadwalDetails')->get();

        return view('admin.jadwal.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Jadwal';
        $kegiatan = Kegiatan::with('pilihan')->get();
        $weekday = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        return view('admin.jadwal.create', compact('title', 'kegiatan', 'weekday'));
    }

    public function siswa(Jadwal $jadwal)
    {
        $title = 'Siswa ke Jadwal';
        $siswas = Siswa::with('kamar')->get();

        return view('admin.jadwal.siswa', compact('title', 'siswas', 'jadwal'));
    }

    private function validation($request, $id = '')
    {
        $request->validate([
            'nama' => 'required',
            'hari' => 'required',
            'jam' => 'required',
            'kegiatan' => 'required',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $id_jadwal = Jadwal::create([
            'nama' => $request->post('nama'),
            'hari' => $request->post('hari'),
            'jam' => $request->post('jam')
        ]);

        foreach ($request->kegiatan as $key => $value) {
            JadwalDetail::create([
                'jadwal_id' => $id_jadwal->id,
                'kegiatan_id' => $value,
            ]);
        }

        return redirect()->route('admin.jadwal.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Data berhasil dihapus!');
    }
}
