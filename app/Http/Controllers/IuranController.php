<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\JenisIuran;
use Illuminate\Http\Request;

class IuranController extends Controller
{
    protected $title;

    public function __construct()
    {
        $this->title = 'Master Iuran';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = Iuran::with('jenisIuran')->get();

        return view('admin.iuran.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        $option_jenis = JenisIuran::all();
        return view('admin.iuran.create', compact('title', 'option_jenis'));
    }

    private function validation(Request $request)
    {
        $request->validate([
            'jenis_iuran_id' => 'required',
            'nama' => 'required',
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

        if ($request->post('is_pendaftaran') == 1) {
            Iuran::where('is_pendaftaran', 1)->update([
                'is_pendaftaran' => 0
            ]);
        }

        Iuran::create($request->all());

        return redirect()->route('admin.iuran.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Iuran $iuran)
    {
        $title = $this->title;
        $iuran->load('jenisIuran');
        $option_jenis = JenisIuran::all();
        return view('admin.iuran.show', compact('title', 'iuran', 'option_jenis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Iuran $iuran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Iuran $iuran)
    {
        $this->validation($request);

        $total = filter_var($request->input('total'), FILTER_SANITIZE_NUMBER_INT);
        $request->merge(['total' => (int) $total]);

        if ($request->post('is_pendaftaran') == 1) {
            Iuran::where('is_pendaftaran', 1)->update([
                'is_pendaftaran' => 0
            ]);
        }

        $iuran->update($request->all());

        return redirect()->route('admin.iuran.index')->with('success', 'Data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Iuran $iuran)
    {
        $iuran->delete();

        return redirect()->route('admin.iuran.index')->with('success', 'Data berhasil diihapus!');
    }
}
