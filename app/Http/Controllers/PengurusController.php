<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pengurus::with('user.role')->get();
        $title = 'Pengurus';

        return view('admin.pengurus.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Pengurus';
        $roles = Role::whereNotIn('id', [3])->get();

        return view('admin.pengurus.create', compact('title', 'roles'));
    }

    private function validation($request)
    {
        $request->validate([
            'role_id' => 'required',
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

        $pengurus = Pengurus::create($data_insert);
        $lasId = $pengurus->id;

        $explode_nama = explode(' ', $request->nama);
        $username = strtolower($explode_nama[0]) . rand(000, 999);
        User::create([
            'role_id' => $request->role_id,
            'pengurus_id' => $lasId,
            'name' => $request->nama,
            'email' => $username . '@gmail.com',
            'username' => $username,
            'password' => Hash::make($username),
        ]);

        return redirect()->route('admin.pengurus.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($pengurus)
    {
        $title = 'Detail Data Pengurus';
        $pengurus = Pengurus::where('id', $pengurus)->first()->load('user');
        $roles = Role::whereNotIn('id', [3])->get();

        return view('admin.pengurus.show', compact('title', 'pengurus', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengurus $pengurus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $pengurus)
    {
        $this->validation($request);

        $data_update = [
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat ?? '',
        ];

        Pengurus::where('id', $pengurus)->update($data_update);

        $pengurus = Pengurus::where('id', $pengurus)->first()->load('user');

        if ($pengurus->user->role_id != $request->role_id) {
            User::where('pengurus_id', $pengurus->id)->update([
                'role_id' => $request->role_id
            ]);
        }

        return redirect()->route('admin.pengurus.index')->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($pengurus)
    {
        Pengurus::where('id', $pengurus)->delete();
        User::where('pengurus_id', $pengurus)->delete();

        return redirect()->route('admin.pengurus.index')->with('success', 'Data berhasil dihapus!');
    }
}
