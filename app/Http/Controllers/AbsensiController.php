<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\JadwalBySiswa;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Absensi';
        $data = Jadwal::with('jadwalDetails')->get();

        return view('admin.absensi.index', compact('title', 'data'));
    }

    public function presensi(Jadwal $jadwal)
    {
        $title = 'Absensi Siswa ' . $jadwal->nama;
        $data = JadwalBySiswa::with('siswa.kamar', 'absensi')->where('jadwal_id', $jadwal->id)->get();

        return view('admin.absensi.presensi', compact('title', 'data', 'jadwal'));
    }

    public function presensi_save(Request $request, Jadwal $jadwal)
    {
        // Mengambil semua data dari request (misalnya form data atau JSON)
        $data_post = $request->all();

        // Mendekode data JSON yang ada dalam 'data_siswa_absen' menjadi array atau objek PHP
        $decode_data = json_decode($data_post['data_siswa_absen']);

        // Melakukan iterasi untuk setiap data absensi siswa
        foreach ($decode_data as $key => $value) {

            // Menggunakan updateOrCreate untuk mencari atau membuat record baru di tabel Absensi
            Absensi::updateOrCreate(
                // Kondisi pencarian, mencari berdasarkan jadwal_by_siswa_id dan tanggal saat ini
                ['jadwal_by_siswa_id' => $key, 'tanggal' => date('Y-m-d')],
                // Data yang akan diset atau diperbarui
                [
                    'absen' => $value == 1 ? 1 : 0,  // Jika absen, set 'absen' = 1, jika tidak = 0
                    'izin' => $value == 2 ? 1 : 0,    // Jika izin, set 'izin' = 1, jika tidak = 0
                    'masuk' => $value == 3 ? 1 : 0,   // Jika masuk, set 'masuk' = 1, jika tidak = 0
                ]
            );
        }

        // Mengarahkan kembali ke halaman presensi jadwal dengan pesan sukses
        return redirect()->route('admin.absensi.presensi', $jadwal->id)
            ->with('success', 'Data berhasil ditambahkan!');
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
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absensi $absensi)
    {
        //
    }
}
