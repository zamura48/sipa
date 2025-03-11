<?php

namespace App\Http\Controllers;

use App\Models\Keringanan;
use App\Models\Pilihan;
use Illuminate\Http\Request;

class KeringananController extends Controller
{
    protected $title;

    public function __construct()
    {
        $this->title = 'Master Keringanan';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = Keringanan::with('pilihan')->get();

        return view('admin.keringanan.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        $option_keringanan = Pilihan::where('nama', 'keringanan')->get();
        return view('admin.keringanan.create', compact('title', 'option_keringanan'));
    }

    private function validation(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tipe' => 'required',
            'keterangan' => 'required',
            'total' => 'required',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $total = filter_var($request->input('total'), FILTER_SANITIZE_NUMBER_INT);
        $request->merge(['total' => (int) $total]);

        Keringanan::create($request->all());

        return redirect()->route('admin.keringanan.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Keringanan $keringanan)
    {
        $title = $this->title;
        $keringanan->load('pilihan');
        $option_keringanan = Pilihan::where('nama', 'keringanan')->get();
        return view('admin.keringanan.show', compact('title', 'keringanan', 'option_keringanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keringanan $keringanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Keringanan $keringanan)
    {
        $this->validation($request);

        $total = filter_var($request->input('total'), FILTER_SANITIZE_NUMBER_INT);
        $request->merge(['total' => (int) $total]);

        $keringanan->update($request->all());

        return redirect()->route('admin.keringanan.index')->with('success', 'Data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keringanan $keringanan)
    {
        $keringanan->delete();

        return redirect()->route('admin.keringanan.index')->with('success', 'Data berhasil diihapus!');
    }
}
