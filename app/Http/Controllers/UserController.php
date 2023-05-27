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
        if (request()->segment(1) == 'api') {
            $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);

            $pasien_id = null;
            $dokter_id = null;
            $paramedis_id = null;

            $pasien_id = Pasien::where('username', $request->username)->get('id')->pluck('id')->first();
            $dokter_id = Dokter::where('username', $request->username)->get('id')->pluck('id')->first();
            $paramedis_id = Paramedis::where('username', $request->username)->get('id')->pluck('id')->first();

            if (isset($pasien_id)) {
                $User = User::where('pasien_id', $pasien_id)->get()->first();
                $Role = "Pasien";
            } elseif (isset($dokter_id)) {
                $User = User::where('dokter_id', $dokter_id)->get()->first();
                $Role = "Dokter";
            } elseif (isset($paramedis_id)) {
                $User = User::where('paramedis_id', $paramedis_id)->get()->first();
                $Role = "Paramedis";
            }

            if (isset($User)) {
                if (Hash::check($request->password, $User->password)) {
                    if ($Role == "Pasien") {
                        $generatedToken = hash('sha512', $User->pasien->username . " — " . $User->get("password")->pluck('password')->first() . " — " . Carbon::now()->format('d-m-Y'));
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

            $pasien_id = Pasien::where('username', $request->username)->get('id')->pluck('id')->first();
            $dokter_id = Dokter::where('username', $request->username)->get('id')->pluck('id')->first();
            $paramedis_id = Paramedis::where('username', $request->username)->get('id')->pluck('id')->first();

            if (isset($pasien_id)) {
                $User = User::where('pasien_id', $pasien_id)->get()->first();
            } elseif (isset($dokter_id)) {
                $User = User::where('dokter_id', $dokter_id)->get()->first();
            } elseif (isset($paramedis_id)) {
                $User = User::where('paramedis_id', $paramedis_id)->get()->first();
            }

            if (isset($User)) {
                if (Hash::check($request->password, $User->password)) {
                    $request->session()->regenerate();
                    Auth::attempt(['name' => $User->name, 'password' => $request->password]);
                    if ($User->pasien_id) {
                        return redirect()->route('dashboard-pasien');
                    } elseif ($User->dokter_id) {
                        return redirect(route('dashboard-dokter'));
                    } elseif ($User->paramedis_id) {
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
        return view('registrasi');
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

    public function index()
    {
        $Pasien = Pasien::get()->all();

        if (request()->segment(1) == 'api') {
            return response()->json(
                [
                    "error" => false,
                    "pasien" => $Pasien,
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

            if ($request->role == "Pasien") {
                $ID = Pasien::where('username', $request->username)->get('userid')->pluck('userid')->first();
            } elseif ($request->role == "Dokter") {
                $ID = Dokter::where('username', $request->username)->get('userid')->pluck('userid')->first();
            } elseif ($request->role == "Paramedis") {
                $ID = Paramedis::where('username', $request->username)->get('userid')->pluck('userid')->first();
            }

            $User = User::where('id', $ID)->get()->first();

            $databaseToken = $User->mobile_app_token;
            $checkToken = hash('sha512', $request->username . " — " . $User->get("password")->pluck('password')->first() . " — " . Carbon::now()->format('d-m-Y'));
            if ($request->role == "Pasien") {
                $generatedToken = hash('sha512', $User->pasien->username . " — " . $User->get("password")->pluck('password')->first() . " — " . Carbon::now()->format('d-m-Y'));
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