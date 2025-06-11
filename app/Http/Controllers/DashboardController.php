<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\JadwalBySiswa;
use App\Models\Kamar;
use App\Models\Pendaftaran;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\Tagihan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard_admin()
    {
        $title = 'Dashboard';

        $pendaftar_belum_confirm = $this->total_pendaftar(0);
        $pendaftar_confirm = $this->total_pendaftar(1);
        $total_kamar = $this->total_kamar();
        $total_siswa = $this->total_siswa();
        $tagihan_belum_terbayar = $this->total_tagihan(0);
        $tagihan_terbayar = $this->total_tagihan(1);
        $sisa_kamar = $this->sisa_kamar();

        $data_tagihan = [];
        $data_tagihan[] = $tagihan_terbayar ?? 0;
        $data_tagihan[] = $tagihan_belum_terbayar ?? 0;
        $data_nama_tagihan = ['Tagihan Terbayar', 'Tagihan Belum Terbayar'];
        $get_tagihan = DB::table('tagihan_keringanans')
            ->join('tagihans', 'tagihan_keringanans.tagihan_id', '=', 'tagihans.id') // pastikan tagihan ada
            ->join('keringanans', 'tagihan_keringanans.keringanan_id', '=', 'keringanans.id')
            ->select('keringanans.nama', DB::raw('COUNT(*) as total'))
            ->groupBy('keringanans.nama')
            ->get();
        foreach ($get_tagihan as $key => $value) {
            $data_tagihan[] = $value->total ?? 0;
            $data_nama_tagihan[] = $value->nama;
        }

        $tanggal_hari_ini = Carbon::today();
        $data_jadwal = Jadwal::whereDate('tanggal', $tanggal_hari_ini)->get();
        $absensi_absen = [];
        $absensi_izin = [];
        $absensi_masuk = [];
        $belum_diabsen = [];
        $jadwal_label = [];
        foreach ($data_jadwal as $key => $value) {
            $jadwal_label[] = $value->nama;
            $absensi_absen[] = $this->jadwal($value->id, 0, 1);
            $absensi_izin[] = $this->jadwal($value->id, 0, 0, 1);
            $absensi_masuk[] = $this->jadwal($value->id, 0, 0, 0, 1);
            $belum_diabsen[] = $this->jadwal($value->id, 1);
        }

        $get_data_kamar = $this->sisa_kamar(false);
        $data_jenis_kamar = [];
        $data_nama_kamar = [];
        $data_sisa_kamar = [];
        foreach ($get_data_kamar as $key => $value) {
            $data_nama_kamar[] = $value->nama;
            $data_jenis_kamar[] = $value->jenis;
            $data_sisa_kamar[] = $value->jumlah_penghuni - $value->penghunis_count;
        }

        $get_sekolah = Sekolah::all();
        $data_sekolah = [];
        $total_pendaftar = [];
        $total_pendaftar_confirm = [];
        $total_pendaftar_not_confirm = [];
        foreach ($get_sekolah as $key => $value) {
            $data_sekolah[] = $value->nama_sekolah;
            $confirm = $this->total_pendaftar(1, $value->id);
            $not_confirm = $this->total_pendaftar(0, $value->id);
            $total_pendaftar[] = $confirm + $not_confirm;
            $total_pendaftar_confirm[] = $confirm;
            $total_pendaftar_not_confirm[] = $not_confirm;
        }

        return view('admin.dashboard.index', compact('title', 'pendaftar_belum_confirm', 'pendaftar_confirm', 'total_kamar', 'total_siswa', 'tagihan_belum_terbayar', 'tagihan_terbayar', 'sisa_kamar', 'data_nama_kamar', 'data_jenis_kamar', 'data_sisa_kamar', 'total_pendaftar', 'total_pendaftar_confirm', 'total_pendaftar_not_confirm', 'data_sekolah', 'data_tagihan', 'data_nama_tagihan', 'absensi_absen', 'absensi_izin', 'absensi_masuk', 'belum_diabsen', 'jadwal_label', 'tanggal_hari_ini'));
    }

    public function dashboard_pengurus()
    {
        $title = 'Dashboard';

        $pendaftar_belum_confirm = $this->total_pendaftar(0);
        $pendaftar_confirm = $this->total_pendaftar(1);
        $total_kamar = $this->total_kamar();
        $total_siswa = $this->total_siswa();
        $tagihan_belum_terbayar = $this->total_tagihan(0);
        $tagihan_terbayar = $this->total_tagihan(1);
        $sisa_kamar = $this->sisa_kamar();

        $get_data_kamar = $this->sisa_kamar(false);
        $data_jenis_kamar = [];
        $data_nama_kamar = [];
        $data_sisa_kamar = [];
        foreach ($get_data_kamar as $key => $value) {
            $data_nama_kamar[] = $value->nama;
            $data_jenis_kamar[] = $value->jenis;
            $data_sisa_kamar[] = $value->jumlah_penghuni - $value->penghunis_count;
        }

        $tanggal_hari_ini = Carbon::today();
        $data_jadwal = Jadwal::whereDate('tanggal', $tanggal_hari_ini)->get();
        $absensi_absen = [];
        $absensi_izin = [];
        $absensi_masuk = [];
        $belum_diabsen = [];
        $jadwal_label = [];
        foreach ($data_jadwal as $key => $value) {
            $jadwal_label[] = $value->nama;
            $absensi_absen[] = $this->jadwal($value->id, 0, 1);
            $absensi_izin[] = $this->jadwal($value->id, 0, 0, 1);
            $absensi_masuk[] = $this->jadwal($value->id, 0, 0, 0, 1);
            $belum_diabsen[] = $this->jadwal($value->id, 1);
        }

        $get_sekolah = Sekolah::all();
        $data_sekolah = [];
        $total_pendaftar = [];
        $total_pendaftar_confirm = [];
        $total_pendaftar_not_confirm = [];
        foreach ($get_sekolah as $key => $value) {
            $data_sekolah[] = $value->nama_sekolah;
            $confirm = $this->total_pendaftar(1, $value->id);
            $not_confirm = $this->total_pendaftar(0, $value->id);
            $total_pendaftar[] = $confirm + $not_confirm;
            $total_pendaftar_confirm[] = $confirm;
            $total_pendaftar_not_confirm[] = $not_confirm;
        }

        return view('pengurus.dashboard.index', compact('title', 'pendaftar_belum_confirm', 'pendaftar_confirm', 'total_kamar', 'total_siswa', 'tagihan_belum_terbayar', 'tagihan_terbayar', 'sisa_kamar', 'data_nama_kamar', 'data_jenis_kamar', 'data_sisa_kamar', 'total_pendaftar', 'total_pendaftar_confirm', 'total_pendaftar_not_confirm', 'data_sekolah', 'absensi_absen', 'absensi_izin', 'absensi_masuk', 'belum_diabsen', 'jadwal_label', 'tanggal_hari_ini'));
    }

    public function dashboard_walmur()
    {
        $title = 'Dashboard';

        $total_siswa = $this->total_siswa();
        $tagihan_belum_terbayar = $this->total_tagihan(0);
        $tagihan_terbayar = $this->total_tagihan(1);

        return view('walmur.dashboard.index', compact('title', 'total_siswa', 'tagihan_belum_terbayar', 'tagihan_terbayar'));
    }

    private function jadwal($jadwal_id, $belum_absen = 0, $absen = 0, $izin = 0, $masuk = 0)
    {
        $total = 0;
        if ($belum_absen) {
            // Belum absen = tidak punya relasi absensi
            $total = JadwalBySiswa::where('jadwal_id', $jadwal_id)
                ->whereDoesntHave('absensi')
                ->count();
        } else {
            // Sudah absen dan cocok dengan filter
            $total = JadwalBySiswa::where('jadwal_id', $jadwal_id)
                ->whereHas('absensi', function ($q) use ($absen, $izin, $masuk) {
                    $q->where('absen', $absen)
                        ->where('izin', $izin)
                        ->where('masuk', $masuk);
                })
                ->count();
        }

        return $total;
    }

    private function total_pendaftar($status, $sekolah = '')
    {
        if ($sekolah) {
            $data_pendaftar = Pendaftaran::where('status', $status)->where('sekolah_id', $sekolah)->count();
        } else {
            $data_pendaftar = Pendaftaran::where('status', $status)->count();
        }

        return $data_pendaftar ?? 0;
    }

    private function total_kamar()
    {
        $data_kamar = Kamar::count();

        return $data_kamar;
    }

    private function total_siswa()
    {
        $walmur_id = auth()->user()->wali_murid_id;
        if ($walmur_id) {
            $data_siswa = Siswa::where('wali_murid_id', $walmur_id)->count();
        } else {
            $data_siswa = Siswa::count();
        }

        return $data_siswa;
    }

    private function total_tagihan($status)
    {
        $walmur_id = auth()->user()->wali_murid_id;
        if ($walmur_id) {
            $data_tagihan = Tagihan::with('siswa')->whereHas('siswa', function ($query) use ($walmur_id) {
                $query->where('wali_murid_id', $walmur_id);
            })->where('status', $status)->count();
        } else {
            if ($status == 1) {
                $data_tagihan = Tagihan::where('status', '>=', 1)->count();
            } else {
                $data_tagihan = Tagihan::where('status', $status)->count();
            }
        }


        return $data_tagihan;
    }

    private function sisa_kamar($is_limit = true)
    {
        if ($is_limit) {
            $data = Kamar::withCount('penghunis')->orderBy('penghunis_count', 'desc')->limit(5)->get();
        } else {
            $data = Kamar::withCount('penghunis')->orderBy('jenis', 'ASC')->get();
        }

        return $data;
    }
}
