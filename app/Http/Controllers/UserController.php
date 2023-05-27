<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dokter;
use App\Models\Mahasiswa;
use App\Models\Paramedis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login_action(Request $request)
    {
        if (request()->segment(1) == 'api') {
            $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);

            $MahasiswaID = null;
            $DokterID = null;
            $ParamedisID = null;

            $MahasiswaID = Mahasiswa::where('username', $request->username)->get('id')->pluck('id')->first();
            $DokterID = Dokter::where('username', $request->username)->get('id')->pluck('id')->first();
            $ParamedisID = Paramedis::where('username', $request->username)->get('id')->pluck('id')->first();

            if (isset($MahasiswaID)) {
                $User = User::where('mahasiswaid', $MahasiswaID)->get()->first();
                $Role = "Mahasiswa";
            } elseif (isset($DokterID)) {
                $User = User::where('dokterid', $DokterID)->get()->first();
                $Role = "Dokter";
            } elseif (isset($ParamedisID)) {
                $User = User::where('paramedisid', $ParamedisID)->get()->first();
                $Role = "Paramedis";
            }

            if (isset($User)) {
                if (Hash::check($request->password, $User->password)) {
                    if ($Role == "Mahasiswa") {
                        $generatedToken = hash('sha512', $User->mahasiswa->username . " — " . $User->get("password")->pluck('password')->first() . " — " . Carbon::now()->format('d-m-Y'));
                    } elseif ($Role == "Dokter") {
                        $generatedToken = hash('sha512', $User->dokter->username . " — " . $User->get("password")->pluck('password')->first() . " — " . Carbon::now()->format('d-m-Y'));
                    } elseif ($Role == "Paramedis") {
                        $generatedToken = hash('sha512', $User->paramedis->username . " — " . $User->get("password")->pluck('password')->first() . " — " . Carbon::now()->format('d-m-Y'));
                    }
                    User::where('id', $User->id)->update(['mobile_app_token' => $generatedToken]);

                    $token = $User->createToken('authToken')->accessToken;
                    return response()->json(['token' => $token, 'role' => $Role, 'stayloggedintoken' => $generatedToken], 200);
                }
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            return response()->json(['error' => 'Unauthorized'], 401);
        } else {
            $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);

            $MahasiswaID = Mahasiswa::where('username', $request->username)->get('id')->pluck('id')->first();
            $DokterID = Dokter::where('username', $request->username)->get('id')->pluck('id')->first();
            $ParamedisID = Paramedis::where('username', $request->username)->get('id')->pluck('id')->first();

            if (isset($MahasiswaID)) {
                $User = User::where('mahasiswaid', $MahasiswaID)->get()->first();
            } elseif (isset($DokterID)) {
                $User = User::where('dokterid', $DokterID)->get()->first();
            } elseif (isset($ParamedisID)) {
                $User = User::where('paramedisid', $ParamedisID)->get()->first();
            }

            if (isset($User)) {
                if (Hash::check($request->password, $User->password)) {
                    $request->session()->regenerate();
                    Auth::attempt(['name' => $User->name, 'password' => $request->password]);
                    if ($User->mahasiswaid) {
                        return redirect()->route('dashboard-mahasiswa');
                    } elseif ($User->dokterid) {
                        return redirect(route('dashboard-dokter'));
                    } elseif ($User->paramedisid) {
                        return redirect(route('dashboard-paramedis'));
                    }
                    return redirect()->route('login')->with("gagal", "Username dan/atau Password Salah.");
                }
                return redirect()->route('login')->with("gagal", "Username dan/atau Password Salah.");
            }
            return redirect()->route('login')->with("gagal", "Username dan/atau Password Salah.");
        }
    }

    public function login(Request $request)
    {
        if (Auth::user()) {
            if (Auth::user()->mahasiswaid) {
                return redirect()->route('dashboard-mahasiswa');
            } elseif (Auth::user()->dokterid) {
                return redirect()->route('dashboard-dokter');
            } elseif (Auth::user()->paramedisid) {
                return redirect()->route('dashboard-paramedis');
            }
            return redirect()->route('beranda');
        }
        return view('login');
    }

    public function logout_action(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('beranda'));
    }

    public function index()
    {
        $Mahasiswa = Mahasiswa::get()->all();

        if (request()->segment(1) == 'api') {
            return response()->json(
                [
                    "error" => false,
                    "mahasiswa" => $Mahasiswa,
                ]
            );
        }
    }

    public function mobile_app_token_check(Request $request)
    {
        if (request()->segment(1) == 'api') {
            $request->validate([
                'username' => 'required',
                'stayloggedintoken' => 'required',
                'role' => 'required',
            ]);

            if ($request->role == "Mahasiswa") {
                $ID = Mahasiswa::where('username', $request->username)->get('userid')->pluck('userid')->first();
            } elseif ($request->role == "Dokter") {
                $ID = Dokter::where('username', $request->username)->get('userid')->pluck('userid')->first();
            } elseif ($request->role == "Paramedis") {
                $ID = Paramedis::where('username', $request->username)->get('userid')->pluck('userid')->first();
            }

            $User = User::where('id', $ID)->get()->first();

            $databaseToken = $User->mobile_app_token;
            $checkToken = hash('sha512', $request->username . " — " . $User->get("password")->pluck('password')->first() . " — " . Carbon::now()->format('d-m-Y'));
            if ($request->role == "Mahasiswa") {
                $generatedToken = hash('sha512', $User->mahasiswa->username . " — " . $User->get("password")->pluck('password')->first() . " — " . Carbon::now()->format('d-m-Y'));
            } elseif ($request->role == "Dokter") {
                $generatedToken = hash('sha512', $User->dokter->username . " — " . $User->get("password")->pluck('password')->first() . " — " . Carbon::now()->format('d-m-Y'));
            } elseif ($request->role == "Paramedis") {
                $generatedToken = hash('sha512', $User->paramedis->username . " — " . $User->get("password")->pluck('password')->first() . " — " . Carbon::now()->format('d-m-Y'));
            }

            if ($databaseToken == $checkToken && $checkToken == $generatedToken) {
                return response()->json(['tokenCheck' => true], 200);
            } else {
                User::where('id', $User->id)->update(['mobile_app_token' => null]);

                return response()->json(['tokenCheck' => false], 401);
            }
        }
        return response()->json(['tokenCheck' => false], 401);
    }
}