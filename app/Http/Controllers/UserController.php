<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Manajemen User';
        $data = Pengguna::with('user.role')->whereHas('user', function ($query) {
            $query->where('role_id', [1, 2]);
        })->get();

        return view('admin.user.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah User';
        $role = Role::all();

        return view('admin.user.create', compact('title', 'role'));
    }

    private function validation(Request $request)
    {
        $request->validate([[
            'username' => 'required',
            'password' => 'required|min:6|confirmed',
        ], [
            'password.confirmed' => 'Password dan konfirmasi password tidak cocok.',
        ]]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'telepon' => 'required',
        ]);

        $data_insert_pengguna = [
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat ?? '',
        ];

        $pengguna = Pengguna::create($data_insert_pengguna);
        $lasId = $pengguna->id;

        $explode_nama = explode(' ', $request->nama);
        $username = strtolower($explode_nama[0]) . rand(000, 999);
        User::create([
            'role_id' => $request->role_id,
            'pengguna_id' => $lasId,
            'name' => $request->nama,
            'email' => $username.'@gmail.com',
            'username' => $username,
            'password' => Hash::make($username),
        ]);
        return redirect()->route('admin.user.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $title = 'Detail Data User';

        return view('admin.user.show', compact('title', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $title = 'Ubah Data User';

        return view('admin.user.edit', compact('title', $user));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->validation($request);

        $data_update = $request->all();
        unset($data_update['password_confirmation']);
        $data_update['password'] = Hash::make($data_update['password']);

        $user->update($data_update);

        return redirect()->route('admin.user.index')->with('success', 'Data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->pengguna()->delete();
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'Data berhasil dihapus!');
    }
}
