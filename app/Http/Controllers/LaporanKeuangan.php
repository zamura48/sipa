<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;

class LaporanKeuangan extends Controller
{
    public function index(Request $request)
    {
        $tanggal_awal = $request->get('tanggal_awal');
        $tanggal_akhir = $request->get('tanggal_akhir');

        $title = 'Laporan Keuangan';

        $data = [];
        if ($tanggal_awal && $tanggal_akhir) {
            $data = Tagihan::with('iuran', 'siswa')->where('status', 2)->whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->get();
        }

        return view('admin.laporan.keuangan', compact('title', 'data', 'tanggal_awal', 'tanggal_akhir'));
    }
}
