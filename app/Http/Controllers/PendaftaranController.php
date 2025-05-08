<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\Keringanan;
use App\Models\Pendaftaran;
use App\Models\PendaftaranKeringanan;
use App\Models\Pengguna;
use App\Models\Periode;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\TagihanKeringanan;
use App\Models\User;
use App\Models\WaliMurid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Pendaftaran Siswa';
        $data_pendaftaran = Pendaftaran::orderBy('id', 'DESC')->get()->load('periode', 'pendaftaran_keringanan.keringanan', 'sekolah');

        // jika user yang login rolenya adalah 3(wali murid) maka data yang ditampilkan hanya siswa dengan pengguna_id saja
        if (auth()->user()->role_id == 3) {
            $ortu_name = auth()->user()->name;
            $data_pendaftaran = Pendaftaran::where([
                ['nama_ortu', 'like', "%$ortu_name%"],
            ])->orderBy('id', 'DESC')->get()->load('periode', 'pendaftaran_keringanan.keringanan');

            return view('walmur.pendaftaran.index', compact('title', 'data_pendaftaran'));
        }

        return view('admin.pendaftaran.index', compact('title', 'data_pendaftaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Siswa Baru';
        $tipe_keringanan = Keringanan::all();
        $sekolah = Sekolah::all();

        return view('walmur.pendaftaran.create', compact('title', 'tipe_keringanan', 'sekolah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sekolah' => 'required',
            'nis' => 'required|integer|min_digits:8|unique:pendaftarans,nis',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
        ], [
            'nis.required' => 'NIS wajib diisi.',
            'nis.min_digits' => 'NIS harus terdiri dari 8 digit angka.',
            'nis.unique' => 'NIS ini sudah terdaftar.',
            'sekolah.required' => 'Nama sekolah tidak boleh kosong.',
            'nama.required' => 'Nama siswa wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin siswa wajib dipilih.',
        ]);

        if ($request->tipe_keringanan[0] != '' && empty($request->dokumen_pelengkap)) {
            $request->validate([
                'dokumen_pelengkap' => 'required|file'
            ]);
        }

        $periode = Periode::where('status', 1)->first();
        $ortu = WaliMurid::where('id', auth()->user()->wali_murid_id)->first();

        $data_insert_siswa = [
            'sekolah_id' => $request->sekolah,
            'nama_ortu' => $ortu->nama,
            'alamat' => $ortu->alamat,
            'telepon_ortu' => $ortu->telepon,
            'jenis_kelamin_ortu' => $ortu->jenis_kelamin,
            'agama' => $ortu->agama,
            'nis' => $request->nis,
            'nama_siswa' => $request->nama,
            'jenis_kelamin_siswa' => $request->jenis_kelamin,
            'periode_id' => $periode ? $periode->id : '',
        ];

        $file = $request->file('foto_siswa');
        if ($file) {
            $request->validate([
                'foto_siswa' => 'file|mimes:jpeg,png,jpg|mimetypes:image/jpeg,image/png'
            ]);
            $file_name = $request->nis . time() . str_replace(' ', '_', $request->siswa_name) . '.' . $file->getClientOriginalExtension();
            $file_save = 'foto_siswa';
            $file->move($file_save, $file_name);
            $data_insert_siswa['foto_siswa'] = $file_name;
        }

        DB::beginTransaction();
        try {
            $pendaftaran = Pendaftaran::create($data_insert_siswa);


            if ($request->tipe_keringanan && $request->dokumen_pelengkap) {
                foreach ($request->tipe_keringanan as $key => $value) {

                    $dokumen = $request->file('dokumen_pelengkap')[$key];
                    $dokumen_name = $request->nis . str_replace(' ', '_', $request->siswa_name) . '.' . $dokumen->getClientOriginalExtension();
                    $file_save = 'pendaftaran_keringanan';
                    $dokumen->move($file_save, $dokumen_name);

                    PendaftaranKeringanan::create([
                        'pendaftaran_id' => $pendaftaran->id,
                        'keringanan_id' => $value,
                        'dokumen_pendukung' => $dokumen_name,
                        'status_pengajuan' => 0
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('walmur.pendaftaran.index')->with('success', 'Berhasil simpan pendaftaran siswa baru!');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('walmur.pendaftaran.create')->with('error', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function konfirmasi_keringanan(Request $request)
    {
        $id = $request->id;
        PendaftaranKeringanan::where('id', '=', $id)->update([
            'status_pengajuan' => 1
        ]);

        return redirect()->back()->with('success', 'Pengajuan keringanan berhasil dikonfirmasi!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        DB::beginTransaction();

        try {
            $data_wali_murid = WaliMurid::where([
                ['nama', 'like', "%{$pendaftaran->nama_ortu}%"],
                ['telepon', '=', $pendaftaran->telepon_ortu]
            ])->first();

            $explode = explode(' ', $pendaftaran->nama_ortu);
            $username = $explode[0] . rand(00000, 99999);
            $text_username = "";
            if ($data_wali_murid) {
                $wali_murid = $data_wali_murid;
            } else {
                $wali_murid = WaliMurid::create([
                    'nama' => $pendaftaran->nama_ortu,
                    'alamat' => $pendaftaran->alamat,
                    'telepon' => $pendaftaran->telepon_ortu,
                    'jenis_kelamin' => $pendaftaran->jenis_kelamin_ortu,
                ]);

                User::create([
                    'role_id' => 3,
                    'wali_murid_id' => $wali_murid->id,
                    'name' => $pendaftaran->nama_ortu,
                    'email' => $pendaftaran->nis . '@gmail.com',
                    'username' => $username,
                    'password' => Hash::make($username),
                ]);

                $text_username = "\n " . url('walli_murid/login') . "
            \n Anda dapat login dengan menggunakan akun dibawah ini:
            \nUsername: $username
            \nPassword: $username
            \n";
            }

            $siswa = Siswa::create([
                'wali_murid_id' => $wali_murid->id,
                'sekolah_id' => $pendaftaran->sekolah_id,
                'kamar_id' => 0,
                'periode_id' => $pendaftaran->periode_id,
                'nis' => $pendaftaran->nis,
                'nama' => $pendaftaran->nama_siswa,
                'jenis_kelamin' => $pendaftaran->jenis_kelamin_siswa,
                'foto' => $pendaftaran->foto_siswa,
            ]);

            $iuran = Iuran::where('is_pendaftaran', 1)->first();

            if (empty($iuran)) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Iuran Belum Ditambahkan.');
            }

            $tagihan = Tagihan::create([
                'siswa_id' => $siswa->id,
                'iuran_id' => $iuran->id,
                'jatuh_tempo' => date('Y-m-d', strtotime('+1 day')),
                'total_tagihan' => $iuran->total,
                'status' => 0
            ]);

            $get_pendaftaran_keringanan = PendaftaranKeringanan::where([
                ['pendaftaran_id', '=', $pendaftaran->id],
                ['status_pengajuan', '=', 1],
            ])->get()->load('keringanan');
            $total_keringanan = 0;
            foreach ($get_pendaftaran_keringanan as $key => $value) {
                TagihanKeringanan::create([
                    'tagihan_id' => $tagihan->id,
                    'keringanan_id' => $value->keringanan_id,
                    'total_keringanan' => $value->keringanan->total
                ]);

                $total_keringanan += $value->keringanan->total;
            }

            $subtotal = (int) $iuran->total - (int) $total_keringanan;
            Tagihan::where('id', '=', $tagihan->id)->update([
                'total_semua_keringanan' => $total_keringanan,
                'total_semua' => $subtotal < 0 ? 0 : $subtotal
            ]);

            $pendaftaran->update(['status' => 1]);

            $nominal_pembayaran = format_currency($subtotal);
            $text_wa = "Selamat siswa dengan nama {$pendaftaran->nama_siswa} telah terdaftar ke asrama.
            \nAnda dapat memantau kegiatan siswa dengan login ke halaman wali murid.
            $text_username
            \n Silakan melakukan pembayaran dengan nominal Rp.{$nominal_pembayaran}.
            \n Jika sudah anda dapat mengupload bukti bayar pada halaman wali murid pada menu Tagihan.
            \n\nTerimakasih";
            send_wa($pendaftaran->telepon_ortu, $text_wa);

            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil dikonfirmasi!');
        } catch (\Exception $ex) {
            DB::rollBack();

            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        //
    }
}
