<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $title = 'SIPA';

        return view('template.landing', compact('title'));
    }
}
