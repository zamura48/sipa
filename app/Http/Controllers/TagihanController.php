<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Tagihan;
use App\Models\User;
use App\Models\WaliMurid;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

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

        $data = $tagihan->load('iuran', 'siswa.ortu');

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $first_name = '-';
        $last_name = '-';
        $phone_number = '08999999991';
        if ($data->siswa->ortu) {
            $ortu_name = $data->siswa->ortu->nama;
            $explode = explode(' ', $ortu_name);
            $phone_number = $data->siswa->ortu->telepon;

            if (count($explode) > 1) {
                $first_name = $explode[0];
                $last_name = implode(' ', array_slice($explode, 1));
            } else {
                $first_name = $explode[0];
                $last_name = $explode[0];
            }
        }

        $params = [
            'transaction_details' => [
                'order_id' => $data->id.format_tanggal($data->created_at),
                'gross_amount' => $tagihan->total_semua,
            ],
            'customer_details' => [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => 'testing@gamil.conm',
                'phone' => $phone_number,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('walmur.tagihan.bayar', compact('title', 'data', 'snapToken'));
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

        $text_wa = "Selamat tagihan untuk siswa dengan nama {$get_walmur->siswa->nama} sudah dikonfirmasi oleh admin.
            \n\nTerimakasih";
        send_wa($get_walmur->telepon, $text_wa);

        return redirect()->route('admin.tagihan.index')->with('success', 'Data berhasil simpan!');
    }

    public function tolak_pembayaran(Request $request, Tagihan $tagihan)
    {
        $alasan = $request->post('alasan');
        $tagihan->update([
            'status' => 3,
            'alasan' => $alasan
        ]);

        $get_walmur = WaliMurid::with('siswa')->whereHas('siswa', function ($query) use ($tagihan) {
            $query->where('id', $tagihan->siswa_id);
        })->first();

        $text_wa = "Pembayaran tagihan untuk siswa dengan nama {$get_walmur->siswa->nama} telah ditolak oleh admin.
            \nDengan alsan ditolak: {$alasan}
            \n\nTerimakasih";
        send_wa($get_walmur->telepon, $text_wa);

        return redirect()->route('admin.tagihan.index')->with('success', 'Data berhasil simpan!');
    }

    public function upload_bayar(Request $request, Tagihan $tagihan)
    {
        $file_name = '';
        if ($tagihan->total_semua != 0) {
            $request->validate([
                'foto' => 'required|file|mimes:jpeg,png,jpg|mimetypes:image/jpeg,image/png'
            ], [
                'foto' => 'Bukti bayar wajib diisi.'
            ]);

            $file = $request->file('foto');
            $file_name =  'Bukti_bayar' . time() . '.' . $file->getClientOriginalExtension();
            $file_save = 'bukti_bayar';
            $file->move($file_save, $file_name);
        }


        $tagihan->update([
            'bukti_bayar' => $file_name,
            'status' => $tagihan->status == 3 ? 4 : 1
        ]);

        $get_walmur = WaliMurid::with('siswa')->whereHas('siswa', function ($query) use ($tagihan) {
            $query->where('id', $tagihan->siswa_id);
        })->first();
        $get_admin = User::with('pengurus')->where('role_id', 1)->first();

        $text_wa = "Wali Murid atas nama {$get_walmur->nama} sudah mengupload bukti bayar.
            \nSilakan cek bukti bayar dan Konfirmasi.
            \n\nTerimakasih";

        if ($get_admin->pengurus->telepon) {
            send_wa($get_admin->pengurus->telepon, $text_wa);
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
