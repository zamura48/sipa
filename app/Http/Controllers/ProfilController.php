<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Role;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Profil';
        $pengurus = Pengurus::with('user')->where('id', auth()->user()->pengurus_id)->first();
        $roles = Role::where('id', auth()->user()->role_id)->get();

        return view('admin.profil.index', compact('title', 'pengurus', 'roles'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_pengurus(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'telepon' => 'required',
        ]);

        $data_update = [
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat ?? '',
        ];

        Pengurus::where('id', $id)->update($data_update);

        return redirect()->route('admin.pengurus.index')->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
