<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard_mahasiswa(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            return view('dashboard.dashboard-mahasiswa', ['user' => $user], );
        }
        return redirect()->route('beranda');
    }
}