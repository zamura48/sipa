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

        if ($request->post('status') == 1) {
            Periode::where('status', 1)->update([
                'status' => 0
            ]);
        }
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
        $kapasitas = $request->input('kapasitas');
        $request->merge(['tgl_mulai' => $tgl_mulai, 'tgl_akhir' => $tgl_akhir]);

        $data = $request->except('status');
        $data['nama'] = $request->post('nama');
        $data['tgl_mulai'] = $tgl_mulai;
        $data['tgl_akhir'] = $tgl_akhir;
        $data['kapasitas'] = $kapasitas;

        if ($request->post('status') == 1) {
            // Reset semua status ke 0
            Periode::query()->update(['status' => 0]);

            // REFRESH MODEL AGAR TIDAK PAKAI CACHE
            $periode->refresh();

            // Pastikan status record ini adalah 1
            $data['status'] = 1;
        }

        $periode->update($data);

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
