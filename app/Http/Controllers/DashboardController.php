<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard_admin()
    {
        $title = 'Dashboard';

        return view('admin.dashboard.index', compact('title'));
    }

    public function dashboard_pengurus()
    {
        $title = 'Dashboard';

        return view('pengurus.dashboard.index', compact('title'));
    }

    public function dashboard_walmur()
    {
        $title = 'Dashboard';

        return view('walmur.dashboard.index', compact('title'));
    }
}
