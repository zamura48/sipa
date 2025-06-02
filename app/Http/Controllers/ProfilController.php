<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Role;
use App\Models\User;
use App\Models\WaliMurid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        $role = '';
        switch (auth()->user()->role_id) {
            case '1':
                $role = 'admin';
                $pengurus = Pengurus::with('user')->where('id', auth()->user()->pengurus_id)->first();
                break;
            case '2':
                $role = 'pengurus';
                $pengurus = Pengurus::with('user')->where('id', auth()->user()->pengurus_id)->first();
                break;
            default:
                $role = 'walmur';
                $pengurus = WaliMurid::with('user')->where('id', auth()->user()->wali_murid_id)->first();
                break;
        }
        return view($role . '.profil.index', compact('title', 'pengurus', 'roles'));
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
    public function update_data_diri(Request $request, string $id)
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

        $role = '';
        switch (auth()->user()->role_id) {
            case '1':
                $role = 'admin';
                Pengurus::where('id', auth()->user()->pengurus_id)->update($data_update);
                break;
            case '2':
                $role = 'pengurus';
                Pengurus::where('id', auth()->user()->pengurus_id)->update($data_update);
                break;
            default:
                $role = 'walmur';
                WaliMurid::where('id', auth()->user()->wali_murid_id)->update($data_update);
                break;
        }
        return redirect()->route($role . '.profil.index')->with('success', 'Data berhasil diupdate!');
    }

    public function update_akun(Request $request, string $id)
    {
        $request->validate([
            'username' => 'required',
        ]);

        $data_update = [
            'username' => $request->post('username'),
        ];

        if ($request->post('password')) {
            $data_update['password'] = Hash::make($request->post('password'));
        }

        User::where('id', auth()->user()->id)->update($data_update);

        $role = '';
        switch (auth()->user()->role_id) {
            case '1':
                $role = 'admin';
                break;
            case '2':
                $role = 'pengurus';
                break;
            default:
                $role = 'walmur';
                break;
        }
        return redirect()->route($role . '.profil.index')->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
