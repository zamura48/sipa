<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Tagihan;
use App\Models\User;
use App\Models\WaliMurid;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Tagihan';
        $data = Tagihan::all()->load('iuran', 'siswa');

        if (auth()->user()->role_id == 3) {
            $data = Tagihan::with('iuran', 'siswa')->whereHas('siswa', function ($query) {
                $query->where('wali_murid_id', auth()->user()->wali_murid_id);
            })->get();

            return view('walmur.tagihan.index', compact('title', 'data'));
        }

        return view('admin.tagihan.index', compact('title', 'data'));
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
    public function show(Tagihan $tagihan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tagihan $tagihan)
    {
        //
    }

    public function bayar(Tagihan $tagihan)
    {
        $title = 'Bayar Tagihan';

        $data = $tagihan->load('iuran', 'siswa');

        return view('walmur.tagihan.bayar', compact('title', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tagihan $tagihan)
    {
        //
    }

    public function konfirmasi_pembayaran(Tagihan $tagihan)
    {
        $tagihan->update([
            'status' => 2
        ]);

        $get_walmur = WaliMurid::with('siswa')->whereHas('siswa', function ($query) use ($tagihan) {
            $query->where('id', $tagihan->siswa_id);
        })->first();

        $text_wa = "Selamat tagihan anda sudah dikonfirmasi oleh admin.
            \nSiswa dengan nama {$get_walmur->siswa->nama} akan segera di tempatkan ke kamar yang masih kosong.
            \n\nTerimakasih";
        send_wa($get_walmur->telepon, $text_wa);

        return redirect()->route('admin.tagihan.index')->with('success', 'Data berhasil simpan!');
    }

    public function upload_bayar(Request $request, Tagihan $tagihan)
    {
        $request->validate([
            'foto' => 'required|file|mimes:jpeg,png,jpg|mimetypes:image/jpeg,image/png'
        ], [
            'foto' => 'Bukti bayar wajib diisi.'
        ]);

        $file = $request->file('foto');
        $file_name =  'Bukti_bayar' . time() . '.' . $file->getClientOriginalExtension();
        $file_save = 'bukti_bayar';
        $file->move($file_save, $file_name);

        $tagihan->update([
            'bukti_bayar' => $file_name,
            'status' => 1
        ]);

        $get_walmur = WaliMurid::with('siswa')->whereHas('siswa', function ($query) use ($tagihan) {
            $query->where('id', $tagihan->siswa_id);
        })->first();
        $get_admin = User::with('pengurus')->where('role_id', 1)->first();

        $text_wa = "Wali Murid atas nama {$get_walmur->nama} sudah mengupload bukti bayar.
            \nSilakan cek bukti bayar dan Konfirmasi.
            \n\nTerimakasih";
        if ($get_admin->telepon) {
            send_wa($get_admin->telepon, $text_wa);
        }

        return redirect()->route('walmur.tagihan.index')->with('success', 'Data berhasil simpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tagihan $tagihan)
    {
        //
    }
}
