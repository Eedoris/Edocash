<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;
use App\Models\HomeArtisan;
use App\Models\HomeStats;
use App\Models\Partners;

class AboutController extends Controller
{
    public function index()
    {
        return view('about.index', [
            'about'     => HomeAbout::first(),
            'artisans'  => HomeArtisan::where('is_active', true)->orderBy('order')->get(),
            'stats'     => HomeStats::orderBy('order')->get(),
            'partners'  => Partners::where('is_active', true)->orderBy('order')->get(),
        ]);
    }
}