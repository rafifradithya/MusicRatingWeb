<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Music;

class DashboardController extends Controller
{
    public function index()
    {
        $musics = Music::with('ratings.user')->get();
        return view('user.dashboard', compact('musics'));
    }
}
