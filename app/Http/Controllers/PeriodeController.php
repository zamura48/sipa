<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    protected $title;

    public function __construct()
    {
        $this->title = 'Master Periode';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = Periode::all();

        return view('admin.periode.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        return view('admin.periode.create', compact('title'));
    }

    private function validation(Request $request)
    {
        $request->validate([
            'tgl_mulai' => 'required',
            'tgl_akhir' => 'required',
            'nama' => 'required',
            'status' => 'required',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $tgl_mulai = format_date($request->input('tgl_mulai'));
        $tgl_akhir = format_date($request->input('tgl_akhir'));
        $request->merge(['tgl_mulai' => $tgl_mulai, 'tgl_akhir' => $tgl_akhir]);

        Periode::create($request->all());

        return redirect()->route('admin.periode.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Periode $periode)
    {
        $title = $this->title;
        return view('admin.periode.show', compact('title', 'periode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Periode $periode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Periode $periode)
    {
        $this->validation($request);

        $tgl_mulai = format_date($request->input('tgl_mulai'));
        $tgl_akhir = format_date($request->input('tgl_akhir'));
        $request->merge(['tgl_mulai' => $tgl_mulai, 'tgl_akhir' => $tgl_akhir]);

        $periode->update($request->all());

        return redirect()->route('admin.periode.index')->with('success', 'Data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Periode $periode)
    {
        $periode->delete();

        return redirect()->route('admin.periode.index')->with('success', 'Data berhasil diihapus!');
    }
}
