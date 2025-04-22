<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Penghuni;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PenghuniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Penghuni Kamar';
        $data = Kamar::withCount('penghunis')->get();

        return view('admin.penghuni.index', compact('title', 'data'));
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

    public function tambah_penghuni(Kamar $kamar, Request $request)
    {
        $explode = explode(',', $request->post('data_siswa_selected'));

        foreach ($explode as $key => $value) {
            Penghuni::create([
                'kamar_id' => $kamar->id,
                'siswa_id' => $value,
            ]);
        }

        return redirect()->route('admin.penghuni.show', $kamar->id)->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($kamar)
    {
        $title = 'Penghuni Kamar';
        $kamar = Kamar::where('id', $kamar)->first();
        $penghuni = Penghuni::with('siswa')->where('kamar_id', $kamar->id)->get();
        $sisa_kuota_kamar = $kamar->jumlah_penghuni - $penghuni->count();

        $siswas = Siswa::whereDoesntHave('penghuni')->get();

        return view('admin.penghuni.show', compact('title', 'kamar', 'sisa_kuota_kamar', 'siswas', 'penghuni'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penghuni $penghuni)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penghuni $penghuni)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penghuni $penghuni)
    {
        //
    }

    public function delete_penghuni(Kamar $kamar, Request $request)
    {
        $explode = explode(',', $request->post('data_siswa_deleted'));

        $id_jadwal_by_siswa = [];
        foreach ($explode as $key => $value) {
            $id_jadwal_by_siswa[] = $value;
        }
        Penghuni::whereIn('id', $id_jadwal_by_siswa)->delete();

        return redirect()->route('admin.penghuni.show', $kamar->id)->with('success', 'Data berhasil dihapus!');
    }
}
