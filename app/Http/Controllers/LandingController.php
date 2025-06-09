<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Siswa;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $title = 'SIPA';

        $total_siswa = Siswa::count();
        $total_pengurus = Pengurus::with('user')->whereHas('user', function ($q) {
            $q->where('role_id', 2);
        })->count();
        $total_admin = Pengurus::with('user')->whereHas('user', function ($q) {
            $q->where('role_id', 1);
        })->count();

        return view('landing_page.home.index', compact('title', 'total_siswa', 'total_pengurus', 'total_admin'));
    }

    public function login()
    {
        $title = 'Login';

        return view('landing_page.login.index', compact('title'));
    }
}
