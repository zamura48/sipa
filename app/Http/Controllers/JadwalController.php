<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\JadwalBySiswa;
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
        $title = 'Tambah Siswa ke Jadwal';
        $jadwal_siswa = JadwalBySiswa::with('siswa.kamar')->where('jadwal_id', $jadwal->id)->get();

        $siswa_id = [];
        foreach ($jadwal_siswa as $key => $value) {
            $siswa_id[] = $value->siswa_id;
        }
        $siswas = Siswa::with('kamar')->whereNotIn('id', $siswa_id)->get();

        return view('admin.jadwal.siswa', compact('title', 'jadwal_siswa', 'siswas', 'jadwal'));
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
    public function store_siswa_jadwal(Request $request, Jadwal $jadwal)
    {
        $explode = explode(',', $request->post('data_siswa_selected'));
        foreach ($explode as $key => $value) {
            JadwalBySiswa::create([
                'jadwal_id' => $jadwal->id,
                'siswa_id' => $value,
            ]);
        }

        return redirect()->route('admin.jadwal.siswa', $jadwal->id)->with('success', 'Data berhasil ditambahkan!');
    }

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
        $jadwal->load('jadwalDetails');
        $title = 'Detail Jadwal';
        $weekday = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $kegiatan = Kegiatan::with('pilihan')->get();

        return view('admin.jadwal.show', compact('title', 'jadwal', 'weekday', 'kegiatan'));
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
        $this->validation($request);

        $jadwal->update([
            'nama' => $request->post('nama'),
            'hari' => $request->post('hari'),
            'jam' => $request->post('jam')
        ]);

        JadwalDetail::where('jadwal_id', $jadwal->id)->delete();
        foreach ($request->kegiatan as $key => $value) {
            JadwalDetail::create([
                'jadwal_id' => $jadwal->id,
                'kegiatan_id' => $value,
            ]);
        }

        return redirect()->route('admin.jadwal.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Data berhasil dihapus!');
    }

    public function delete_siswa_jadwal(Jadwal $jadwal, Request $request)
    {
        $explode = explode(',', $request->post('data_siswa_deleted'));

        $id_jadwal_by_siswa = [];
        foreach ($explode as $key => $value) {
            $id_jadwal_by_siswa[] = $value;
        }
        JadwalBySiswa::whereIn('id', $id_jadwal_by_siswa)->delete();

        return redirect()->route('admin.jadwal.siswa', $jadwal->id)->with('success', 'Data berhasil dihapus!');
    }
}
