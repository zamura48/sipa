<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\JadwalBySiswa;
use App\Models\Siswa;
use Illuminate\Http\Request;

class LaporanAbsensi extends Controller
{
    public function index(Request $request)
    {
        $tanggal_awal = $request->get('tanggal_awal');
        $tanggal_akhir = $request->get('tanggal_akhir');
        $g_siswa = $request->get('siswa') ?? 0;

        $title = 'Laporan Absensi';
        $data = [];
        $wali_murid = auth()->user()->wali_murid_id;

        $siswas = Siswa::all();

        if (($tanggal_awal && $tanggal_akhir) || $g_siswa) {
            $data = JadwalBySiswa::with([
                'absensi',
                'jadwal',
                'siswa',
            ])->whereHas('jadwal', function ($q) use ($tanggal_awal, $tanggal_akhir) {
                if ($tanggal_awal) {
                    $q->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir]);
                }
            })->whereHas('siswa', function ($query) use ($wali_murid, $g_siswa) {
                if ($wali_murid) {
                    $query->where('wali_murid_id', $wali_murid);
                }
                if ($g_siswa) {
                    $query->where('id', $g_siswa);
                }
            })->orderBy('id', 'DESC')->get();
        }
        $weekday = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        if (auth()->user()->role_id != 3) {
            return view('admin.laporan.absensi', compact('title', 'data', 'weekday', 'tanggal_awal', 'tanggal_akhir', 'siswas', 'g_siswa'));
        } else {
            return view('walmur.laporan.absensi', compact('title', 'data', 'weekday', 'tanggal_awal', 'tanggal_akhir'));
        }
    }
}
