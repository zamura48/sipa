<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WaliMurid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WaliMuridController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = WaliMurid::with('user.role')->get();
        $title = 'Wali Murid';

        return view('admin.wali_murid.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Wali Murid';

        return view('admin.wali_murid.create', compact('title'));
    }

    private function validation($request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'telepon' => 'required',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $data_insert = [
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat ?? '',
        ];

        $wali_murid = WaliMurid::create($data_insert);
        $lasId = $wali_murid->id;

        $explode_nama = explode(' ', $request->nama);
        $username = strtolower($explode_nama[0]) . rand(000, 999);
        User::create([
            'role_id' => 3,
            'wali_murid_id' => $lasId,
            'name' => $request->nama,
            'email' => $username.'@gmail.com',
            'username' => $username,
            'password' => Hash::make($username),
        ]);

        return redirect()->route('admin.wali_murid.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(WaliMurid $waliMurid)
    {
        $title = 'Detail Data Wali Murid';

        return view('admin.wali_murid.show', compact('title', 'waliMurid'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WaliMurid $waliMurid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WaliMurid $waliMurid)
    {
        $this->validation($request);

        $data_update = [
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat ?? '',
        ];

        $waliMurid->update($data_update);

        return redirect()->route('admin.wali_murid.index')->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WaliMurid $waliMurid)
    {
        $waliMurid->user()->delete();
        $waliMurid->delete();

        return redirect()->route('admin.wali_murid.index')->with('success', 'Data berhasil dihapus!');
    }
}
