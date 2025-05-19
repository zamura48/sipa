<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Pendaftaran;
use App\Models\Siswa;
use App\Models\Tagihan;
use Illuminate\Http\Request;

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

        return view('admin.dashboard.index', compact('title', 'pendaftar_belum_confirm', 'pendaftar_confirm', 'total_kamar', 'total_siswa', 'tagihan_belum_terbayar', 'tagihan_terbayar', 'sisa_kamar'));
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

        return view('pengurus.dashboard.index', compact('title', 'pendaftar_belum_confirm', 'pendaftar_confirm', 'total_kamar', 'total_siswa', 'tagihan_belum_terbayar', 'tagihan_terbayar', 'sisa_kamar'));
    }

    public function dashboard_walmur()
    {
        $title = 'Dashboard';

        $total_siswa = $this->total_siswa();
        $tagihan_belum_terbayar = $this->total_tagihan(0);
        $tagihan_terbayar = $this->total_tagihan(1);

        return view('walmur.dashboard.index', compact('title', 'total_siswa', 'tagihan_belum_terbayar', 'tagihan_terbayar'));
    }

    private function total_pendaftar($status)
    {
        $data_pendaftar = Pendaftaran::where('status', $status)->count();

        return $data_pendaftar;
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
            $data_tagihan = Tagihan::where('status', $status)->count();
        }


        return $data_tagihan;
    }

    private function sisa_kamar()
    {
        $data = Kamar::withCount('penghunis')->orderBy('penghunis_count', 'desc')->limit(5)->get();

        return $data;
    }
}
