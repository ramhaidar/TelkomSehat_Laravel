<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function beranda(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            return view('index', ['users' => $user], );
        }
        return view('index');
    }
}