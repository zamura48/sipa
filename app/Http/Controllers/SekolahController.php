<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = sekolah::all();
        $title = 'Sekolah';

        return view('admin.sekolah.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Sekolah';

        return view('admin.sekolah.create', compact('title'));
    }

    private function validation($request)
    {
        $request->validate([
            'nama_sekolah' => 'required',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        Sekolah::create([
            'nama_sekolah' => $request->post('nama_sekolah')
        ]);

        return redirect()->route('admin.sekolah.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sekolah $sekolah)
    {
        $title = 'Detail Sekolah';

        return view('admin.sekolah.show', compact('title', 'sekolah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sekolah $sekolah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sekolah $sekolah)
    {
        $this->validation($request);

        $sekolah->update($request->all());

        return redirect()->route('admin.sekolah.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sekolah $sekolah)
    {
        $sekolah->delete();

        return redirect()->route('admin.sekolah.index')->with('success', 'Data berhasil dihapus!');
    }
}
