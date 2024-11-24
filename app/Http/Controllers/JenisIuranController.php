<?php

namespace App\Http\Controllers;

use App\Models\JenisIuran;
use Illuminate\Http\Request;

class JenisIuranController extends Controller
{
    protected $title;

    public function __construct()
    {
        $this->title = 'Master Jenis Iuran';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = JenisIuran::all();

        return view('admin.jenis_iuran.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        return view('admin.jenis_iuran.create', compact('title'));
    }

    private function validation(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        JenisIuran::create($request->all());

        return redirect()->route('admin.jenis_iuran.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisIuran $jenisIuran)
    {
        $title = $this->title;
        return view('admin.jenis_iuran.show', compact('title', 'jenisIuran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisIuran $jenisIuran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisIuran $jenisIuran)
    {
        $this->validation($request);

        $jenisIuran->update($request->all());

        return redirect()->route('admin.jenis_iuran.index')->with('success', 'Data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisIuran $jenisIuran)
    {
        $jenisIuran->delete();

        return redirect()->route('admin.jenis_iuran.index')->with('success', 'Data berhasil diihapus!');
    }
}
