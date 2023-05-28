<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Paramedis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login_action(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        if (request()->segment(1) == 'api') {
            $pasien_id = Pasien::when($request->username, function ($query, $username) {
                $query->where('username', $username);
            })->value('id');

            $dokter_id = Dokter::when($request->username, function ($query, $username) {
                $query->where('username', $username);
            })->value('id');

            $paramedis_id = Paramedis::when($request->username, function ($query, $username) {
                $query->where('username', $username);
            })->value('id');

            $user = User::when($pasien_id, function ($query, $pasien_id) {
                $query->where('pasien_id', $pasien_id);
            })->when($dokter_id, function ($query, $dokter_id) {
                $query->where('dokter_id', $dokter_id);
            })->when($paramedis_id, function ($query, $paramedis_id) {
                $query->where('paramedis_id', $paramedis_id);
            })->first();

            if ($user && Hash::check($request->password, $user->password)) {
                $role = optional($user->pasien)->id ? 'Pasien' : (optional($user->dokter)->id ? 'Dokter' : 'Paramedis');
                $generatedToken = hash('sha512', $user->{$role}->username . ' — ' . $user->password . ' — ' . Carbon::now()->format('d-m-Y'));
                $user->update(['mobile_app_token' => $generatedToken]);
                $token = $user->createToken('authToken')->accessToken;

                return json_encode(['token' => $token, 'role' => $role, 'stayloggedintoken' => $generatedToken]);
                // return response()->json(['token' => $token, 'role' => $role, 'stayloggedintoken' => $generatedToken], 200);
            }
            return response()->json(['error' => 'Unauthorized'], 401);
        } else {
            $pasien_id = Pasien::when($request->username, function ($query, $username) {
                $query->where('username', $username);
            })->value('id');

            $dokter_id = Dokter::when($request->username, function ($query, $username) {
                $query->where('username', $username);
            })->value('id');

            $paramedis_id = Paramedis::when($request->username, function ($query, $username) {
                $query->where('username', $username);
            })->value('id');

            $user = User::when($pasien_id, function ($query, $pasien_id) {
                $query->where('pasien_id', $pasien_id);
            })->when($dokter_id, function ($query, $dokter_id) {
                $query->where('dokter_id', $dokter_id);
            })->when($paramedis_id, function ($query, $paramedis_id) {
                $query->where('paramedis_id', $paramedis_id);
            })->first();

            if ($user && Hash::check($request->password, $user->password)) {
                $request->session()->regenerate();
                Auth::attempt(['name' => $user->name, 'password' => $request->password]);
                if (optional($user->pasien)->id) {
                    return redirect()->route('dashboard-pasien');
                } elseif (optional($user->dokter)->id) {
                    return redirect()->route('dashboard-dokter');
                } elseif (optional($user->paramedis)->id) {
                    return redirect()->route('dashboard-paramedis');
                }
                return redirect()->route('login')->with('gagal', 'Username dan/atau Password Salah.');
            }
            return redirect()->route('login')->with('gagal', 'Username dan/atau Password Salah.');
        }
    }

    public function login(Request $request)
    {
        if (Auth::user()) {
            if (Auth::user()->pasien_id) {
                return redirect()->route('dashboard-pasien');
            } elseif (Auth::user()->dokter_id) {
                return redirect()->route('dashboard-dokter');
            } elseif (Auth::user()->paramedis_id) {
                return redirect()->route('dashboard-paramedis');
            }
            return redirect()->route('beranda');
        }
        return view('login');
    }


    public function registrasi_pasien_action(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'username' => 'required|string|unique:pasien,username|max:255',
            'no_hp' => [
                'required',
                'unique:pasien,nomortelepon',
                'regex:/^(\+62|0)[0-9]{8,15}$/'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:255',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
            ],
        ]);

        $User = User::create([
            'name' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $Pasien = Pasien::create([
            'username' => $validatedData['username'],
            'nomortelepon' => $validatedData['no_hp'],
        ]);

        $User->update(['pasien_id' => $Pasien->id]);
        $Pasien->update(['user_id' => $User->id]);

        return redirect()->route("login")->with("success", "Registrasi Berhasil!");
    }

    public function registrasi_pasien(Request $request)
    {
        return view('registrasi');
    }

    public function logout_action(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('beranda'));
    }

    public function mobile_app_token_check(Request $request)
    {
        if ($request->segment(1) !== 'api') {
            return response()->json(['tokenCheck' => false], 401);
        }

        $request->validate([
            'username' => 'required',
            'stayloggedintoken' => 'required',
            'role' => 'required',
        ]);

        $model = ucfirst($request->role);
        $ID = $model::where('username', $request->username)->value('userid');
        $User = User::find($ID);

        if (!$User) {
            return response()->json(['tokenCheck' => false], 401);
        }

        $databaseToken = $User->mobile_app_token;
        $checkToken = hash('sha512', $request->username . " — " . $User->password . " — " . Carbon::now()->format('d-m-Y'));
        $generatedToken = hash('sha512', $User->{$request->role}->username . " — " . $User->password . " — " . Carbon::now()->format('d-m-Y'));

        if ($databaseToken === $checkToken && $checkToken === $generatedToken) {
            return response()->json(['tokenCheck' => true], 200);
        }

        $User->mobile_app_token = null;
        $User->save();

        return response()->json(['tokenCheck' => false], 401);
    }
}