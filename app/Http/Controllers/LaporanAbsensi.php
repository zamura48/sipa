<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\JadwalBySiswa;
use Illuminate\Http\Request;

class LaporanAbsensi extends Controller
{
    public function index(Request $request) {
        $tanggal = $request->get('tanggal');
        
        $title = 'Laporan Absensi';
        $tanggalHariIni = date('Y-m-d');
        $hari = date('l', strtotime($tanggalHariIni));
        $hariIndo = nama_hari_indo($hari);
        $data = [];
        if ($tanggal) {
            $tanggalHariIni = $tanggal;
            $data = JadwalBySiswa::with([
                'absensi' => function ($query) use ($tanggalHariIni) {
                    $query->where('tanggal', $tanggalHariIni);
                },
                'jadwal',
                'siswa'
            ])->whereHas('jadwal', function ($q) use ($hariIndo) {
                $q->where('hari', $hariIndo);
            })->get();
        }
        $weekday = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        return view('admin.laporan.absensi', compact('title', 'data', 'weekday', 'tanggal'));
    }
}
