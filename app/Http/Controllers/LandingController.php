<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $title = 'SIPA';

        return view('landing_page.home.index', compact('title'));
    }
}
