<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard_mahasiswa(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $mahasiswa = User::find($user->id)->mahasiswa()->first();
            return view('dashboard.mahasiswa.dashboard', ['user' => $user, 'mahasiswa' => $mahasiswa], );
        }
        return redirect()->route('beranda');
    }

    public function dashboard_mahasiswa_reservasi(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $mahasiswa = User::find($user->id)->mahasiswa()->first();
            return view('dashboard.mahasiswa.reservasi', ['user' => $user, 'mahasiswa' => $mahasiswa], );
        }
        return redirect()->route('beranda');
    }

    public function dashboard_mahasiswa_konsultasi(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $mahasiswa = User::find($user->id)->mahasiswa()->first();
            return view('dashboard.mahasiswa.konsultasi', ['user' => $user, 'mahasiswa' => $mahasiswa], );
        }
        return redirect()->route('beranda');
    }
}