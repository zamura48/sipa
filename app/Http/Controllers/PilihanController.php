<?php

namespace App\Http\Controllers;

use App\Models\Pilihan;
use Illuminate\Http\Request;

class PilihanController extends Controller
{
    protected $title;

    public function __construct()
    {
        $this->title = 'Master Opsi';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = Pilihan::all();

        return view('admin.pilihan.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        return view('admin.pilihan.create', compact('title'));
    }

    private function validation(Request $request)
    {
        $request->validate([
            'parameter' => 'required',
            'nama' => 'required',
            'isi' => 'required',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        Pilihan::create($request->all());

        return redirect()->route('admin.pilihan.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pilihan $pilihan)
    {
        $title = $this->title;
        return view('admin.pilihan.show', compact('title', 'pilihan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pilihan $pilihan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pilihan $pilihan)
    {
        $this->validation($request);

        $pilihan->update($request->all());

        return redirect()->route('admin.pilihan.index')->with('success', 'Data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pilihan $pilihan)
    {
        $pilihan->delete();

        return redirect()->route('admin.pilihan.index')->with('success', 'Data berhasil diihapus!');
    }
}
