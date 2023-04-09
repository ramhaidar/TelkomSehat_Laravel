<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dokter;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserController extends Controller
{
    public function login_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $MahasiswaID = Mahasiswa::where('username', $request->username)->get('id')->pluck('id')->first();
        $User = User::where('mahasiswaid', $MahasiswaID)->get()->first();

        if ($User != null) {
            if (Hash::check($request->password, $User->password)) {
                // if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                $request->session()->regenerate();
                Auth::attempt(['name' => $User->name, 'password' => $request->password]);
                // $user = Auth::user();
                // $mahasiswa = User::find($user->id)->mahasiswa;
                if ($User->mahasiswaid) {
                    // dd("Login Sukses Sebagai Mahasiswa");
                    return redirect()->route('dashboard-mahasiswa');
                } elseif ($User->dokterid) {
                    // dd("Login Sukses Sebagai Dokter");
                    return redirect(route('dashboard-dokter'));
                }

                return redirect(route('login'));
            }
            return redirect(route('login'));
        }
        return redirect(route('login'));
    }

    public function logout_action(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('beranda'));
    }
}