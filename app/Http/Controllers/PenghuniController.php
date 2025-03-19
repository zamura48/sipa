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

    /**
     * Display the specified resource.
     */
    public function show(Kamar $kamar)
    {
        $title = 'Penghuni Kamar';
        $kamar = $kamar->withCount('penghunis')->first();
        $penghuni = Penghuni::with('siswa')->get();

        $siswa_id = [];
        foreach ($penghuni as $key => $value) {
            $siswa_id[] = $value->siswa_id;
        }
        $siswas = Siswa::with('kamar')->whereNotIn('id', $siswa_id)->get();

        return view('admin.penghuni.show', compact('title', 'kamar', 'siswas', 'penghuni'));
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
}
