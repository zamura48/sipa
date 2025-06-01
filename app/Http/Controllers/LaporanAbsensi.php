<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\JadwalBySiswa;
use Illuminate\Http\Request;

class LaporanAbsensi extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->get('tanggal');

        $title = 'Laporan Absensi';
        $tanggalHariIni =  $tanggal ? $tanggal : date('Y-m-d');
        $hari = date('l', strtotime($tanggalHariIni));
        $hariIndo = nama_hari_indo($hari);
        $data = [];
        $wali_murid = auth()->user()->wali_murid_id;

        if ($tanggal) {
            $data = JadwalBySiswa::with([
                'absensi',
                'jadwal',
                'siswa',
            ])->whereHas('jadwal', function ($q) use ($tanggalHariIni) {
                $q->whereRaw('DATE(tanggal) = ?', $tanggalHariIni);
            })->whereHas('siswa', function ($query) use ($wali_murid) {
                if ($wali_murid) {
                    $query->where('wali_murid_id', $wali_murid);
                }
            })->orderBy('siswa_id', 'ASC')->get();
        }
        $weekday = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        if (auth()->user()->role_id != 3) {
            return view('admin.laporan.absensi', compact('title', 'data', 'weekday', 'tanggal'));
        } else {
            return view('walmur.laporan.absensi', compact('title', 'data', 'weekday', 'tanggal'));
        }
    }
}
