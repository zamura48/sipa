<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pilihans')->insert([
            [
                'nama' => 'gender',
                'parameter' => '1',
                'isi' => 'Laki-laki',
            ],
            [
                'nama' => 'gender',
                'parameter' => '2',
                'isi' => 'Perempuan',
            ],
            [
                'nama' => 'agama',
                'parameter' => '1',
                'isi' => 'Islam',
            ],
            [
                'nama' => 'agama',
                'parameter' => '2',
                'isi' => 'Kristen Protestan',
            ],
            [
                'nama' => 'agama',
                'parameter' => '3',
                'isi' => 'Kristen Katolik',
            ],
            [
                'nama' => 'agama',
                'parameter' => '4',
                'isi' => 'Hindu',
            ],
            [
                'nama' => 'agama',
                'parameter' => '5',
                'isi' => 'Buddha',
            ],
            [
                'nama' => 'sts_kamar',
                'parameter' => '1',
                'isi' => 'Kosong',
            ],
            [
                'nama' => 'sts_kamar',
                'parameter' => '2',
                'isi' => 'Dipakai',
            ],
            [
                'nama' => 'kegiatan',
                'parameter' => '1',
                'isi' => 'Asrama',
            ],
            [
                'nama' => 'kegiatan',
                'parameter' => '2',
                'isi' => 'Keagamaan',
            ],
            [
                'nama' => 'keringanan',
                'parameter' => '1',
                'isi' => 'Pusat',
            ],
            [
                'nama' => 'keringanan',
                'parameter' => '2',
                'isi' => 'Yayasan',
            ],
        ]);

        DB::table('roles')->insert([
            [
                'nama' => 'Admin',
            ],
            [
                'nama' => 'Pengurus',
            ],
            [
                'nama' => 'Wali Murid',
            ],
        ]);

        DB::table('penguruses')->insert([
            'nama' => 'admin',
            'alamat' => 'Jln. Bintang',
            'telepon' => '0888888888',
            'jenis_kelamin' => 'L',
        ]);

        DB::table('users')->insert([
            'role_id' => 1,
            'pengurus_id' => 1,
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'password' => Hash::make('admin'),
        ]);
    }
}
