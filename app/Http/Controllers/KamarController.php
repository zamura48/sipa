<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    protected $title;

    public function __construct()
    {
        $this->title = 'Master Kamar';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = Kamar::all();

        return view('admin.kamar.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        return view('admin.kamar.create', compact('title'));
    }

    private function validation(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'jumlah_penghuni' => 'required|numeric',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        Kamar::create($request->all());

        return redirect()->route('admin.kamar.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kamar $kamar)
    {
        $title = $this->title;
        return view('admin.kamar.show', compact('title', 'kamar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kamar $kamar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kamar $kamar)
    {
        $this->validation($request);

        $kamar->update($request->all());

        return redirect()->route('admin.kamar.index')->with('success', 'Data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kamar $kamar)
    {
        $kamar->delete();

        return redirect()->route('admin.kamar.index')->with('success', 'Data berhasil diihapus!');
    }
}
