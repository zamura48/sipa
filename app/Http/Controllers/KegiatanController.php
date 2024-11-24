<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Pilihan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    protected $title;

    public function __construct()
    {
        $this->title = 'Master Kegiatan';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = Kegiatan::with('pilihan')->get();

        return view('admin.kegiatan.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        $option_kegiatan = Pilihan::where('nama', 'kegiatan')->get();
        return view('admin.kegiatan.create', compact('title', 'option_kegiatan'));
    }

    private function validation(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tipe' => 'required',
            'keterangan' => 'required',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        Kegiatan::create($request->all());

        return redirect()->route('admin.kegiatan.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kegiatan $kegiatan)
    {
        $title = $this->title;
        $kegiatan->load('pilihan');
        $option_kegiatan = Pilihan::where('nama', 'kegiatan')->get();
        return view('admin.kegiatan.show', compact('title', 'kegiatan', 'option_kegiatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kegiatan $kegiatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $this->validation($request);

        $kegiatan->update($request->all());

        return redirect()->route('admin.kegiatan.index')->with('success', 'Data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')->with('success', 'Data berhasil diihapus!');
    }
}
