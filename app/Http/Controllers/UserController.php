<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Paramedic;
use Illuminate\Http\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\StreamOutput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;

class UserController extends Controller
{
    public function login_action ( Request $request )
    {
        $request->validate ( [ 
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ] );

        if ( request ()->segment ( 1 ) == 'api' )
        {
            $patient_id = Patient::when ( $request->username, function ($query, $username)
            {
                $query->where ( 'username', $username );
            } )->value ( 'id' );

            $doctor_id = Doctor::when ( $request->username, function ($query, $username)
            {
                $query->where ( 'username', $username );
            } )->value ( 'id' );

            $paramedic_id = Paramedic::when ( $request->username, function ($query, $username)
            {
                $query->where ( 'username', $username );
            } )->value ( 'id' );

            $user = User::when ( $patient_id, function ($query, $patient_id)
            {
                $query->where ( 'patient_id', $patient_id );
            } )->when ( $doctor_id, function ($query, $doctor_id)
            {
                $query->where ( 'doctor_id', $doctor_id );
            } )->when ( $paramedic_id, function ($query, $paramedic_id)
            {
                $query->where ( 'paramedic_id', $paramedic_id );
            } )->first ();

            if ( $user && Hash::check ( $request->password, $user->password ) )
            {
                $role = optional ( $user->patient )->id ? 'Pasien' : ( optional ( $user->doctor )->id ? 'Dokter' : 'Paramedis' );
                if ( $role == "Pasien" )
                {
                    $generatedToken = hash ( 'sha512', $user->patient->username . ' — ' . $user->password . ' — ' . Carbon::now ()->format ( 'd-m-Y' ) );
                }
                else if ( $role == "Dokter" )
                {
                    $generatedToken = hash ( 'sha512', $user->doctor->username . ' — ' . $user->password . ' — ' . Carbon::now ()->format ( 'd-m-Y' ) );
                }
                else if ( $role == "Paramedis" )
                {
                    $generatedToken = hash ( 'sha512', $user->paramedic->username . ' — ' . $user->password . ' — ' . Carbon::now ()->format ( 'd-m-Y' ) );
                }
                $user->update ( [ 'mobile_app_token' => $generatedToken ] );
                $token = $user->createToken ( 'authToken' )->accessToken;

                return json_encode ( [ 'token' => $token, 'role' => $role, 'stayloggedintoken' => $generatedToken ] );
                // return response()->json(['token' => $token, 'role' => $role, 'stayloggedintoken' => $generatedToken], 200);
            }
            return response ()->json ( [ 'error' => 'Unauthorized' ], 401 );
        }
        else
        {
            $patient_id = Patient::when ( $request->username, function ($query, $username)
            {
                $query->where ( 'username', $username );
            } )->value ( 'id' );

            $doctor_id = Doctor::when ( $request->username, function ($query, $username)
            {
                $query->where ( 'username', $username );
            } )->value ( 'id' );

            $paramedic_id = Paramedic::when ( $request->username, function ($query, $username)
            {
                $query->where ( 'username', $username );
            } )->value ( 'id' );

            $user = User::when ( $patient_id, function ($query, $patient_id)
            {
                $query->where ( 'patient_id', $patient_id );
            } )->when ( $doctor_id, function ($query, $doctor_id)
            {
                $query->where ( 'doctor_id', $doctor_id );
            } )->when ( $paramedic_id, function ($query, $paramedic_id)
            {
                $query->where ( 'paramedic_id', $paramedic_id );
            } )->first ();

            if ( $user && Hash::check ( $request->password, $user->password ) )
            {
                $request->session ()->regenerate ();
                Auth::attempt ( [ 'name' => $user->name, 'password' => $request->password ] );
                if ( optional ( $user->patient )->id )
                {
                    return redirect ()->route ( 'dashboard-patient' );
                }
                elseif ( optional ( $user->doctor )->id )
                {
                    return redirect ()->route ( 'dashboard-doctor' );
                }
                elseif ( optional ( $user->paramedic )->id )
                {
                    return redirect ()->route ( 'dashboard-paramedic' );
                }
                return redirect ()->route ( 'login' )->with ( 'gagal', 'Username dan/atau Password Salah.' );
            }
            return redirect ()->route ( 'login' )->with ( 'gagal', 'Username dan/atau Password Salah.' );
        }
    }


    public function login ( Request $request )
    {

        ( new ConsoleOutput () )->writeln ( "Login Page Accessed" );


        if ( Auth::user () )
        {
            if ( Auth::user ()->patient_id )
            {
                return redirect ()->route ( 'dashboard-patient' );
            }
            elseif ( Auth::user ()->doctor_id )
            {
                return redirect ()->route ( 'dashboard-doctor' );
            }
            elseif ( Auth::user ()->paramedic_id )
            {
                return redirect ()->route ( 'dashboard-paramedic' );
            }
            return redirect ()->route ( 'home' );
        }
        return view ( 'login' );
    }

    public function registration_patient_action ( Request $request )
    {
        $validatedData = $request->validate ( [ 
            'nama'     => [ 
                'required',
                'string',
                'max:255',
            ],
            'email'    => [ 
                'required',
                'email',
                'unique:users,email',
                'max:255',
            ],
            'username' => [ 
                'required',
                'string',
                'unique:patient,username',
                'max:255'
            ],
            'no_hp'    => [ 
                'required',
                'unique:patient,nomortelepon',
                'regex:/^(\+62|0)[0-9]{8,15}$/',
            ],
            'password' => [ 
                'required',
                'string',
                'min:8',
                'max:255',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
            ],
        ] );

        $User = User::create ( [ 
            'name'     => $validatedData[ 'nama' ],
            'email'    => $validatedData[ 'email' ],
            'password' => Hash::make ( $validatedData[ 'password' ] ),
        ] );

        $Patient = Patient::create ( [ 
            'username'     => $validatedData[ 'username' ],
            'nomortelepon' => $validatedData[ 'no_hp' ],
        ] );

        $User->update ( [ 'patient_id' => $Patient->id ] );
        $Patient->update ( [ 'user_id' => $User->id ] );

        return redirect ()->route ( "login" )->with ( "success", "Registrasi Berhasil!" );
    }

    public function registration_patient ( Request $request )
    {
        return view ( 'registration' );
    }

    public function logout_action ( Request $request )
    {
        Auth::logout ();
        $request->session ()->invalidate ();
        $request->session ()->regenerateToken ();
        return redirect ( route ( 'home' ) );
    }

    public function mobile_app_token_check ( Request $request )
    {
        if ( $request->segment ( 1 ) !== 'api' )
        {
            return response ()->json ( [ 'tokenCheck' => false ], 401 );
        }

        $request->validate ( [ 
            'username'          => 'required',
            'stayloggedintoken' => 'required',
            'role'              => 'required',
        ] );

        if ( $request->role == "Pasien" )
        {
            $ID = Patient::where ( 'username', $request->username )->value ( 'user_id' );

        }
        else if ( $request->role == "Dokter" )
        {
            $ID = Doctor::where ( 'username', $request->username )->value ( 'user_id' );

        }
        else if ( $request->role == "Paramedis" )
        {
            $ID = Paramedic::where ( 'username', $request->username )->value ( 'user_id' );

        }
        $User = User::find ( $ID );

        if ( ! $User )
        {
            return response ()->json ( [ 'tokenCheck' => false ], 401 );
        }

        $databaseToken = $User->mobile_app_token;
        $checkToken    = hash ( 'sha512', $request->username . " — " . $User->password . " — " . Carbon::now ()->format ( 'd-m-Y' ) );

        // $generatedToken = hash ( 'sha512', $User->{$request->role}->username . " — " . $User->password . " — " . Carbon::now ()->format ( 'd-m-Y' ) );

        if ( $request->role == "Pasien" )
        {
            $generatedToken = hash ( 'sha512', $User->patient->username . ' — ' . $User->password . ' — ' . Carbon::now ()->format ( 'd-m-Y' ) );
        }
        else if ( $request->role == "Dokter" )
        {
            $generatedToken = hash ( 'sha512', $User->doctor->username . ' — ' . $User->password . ' — ' . Carbon::now ()->format ( 'd-m-Y' ) );
        }
        else if ( $request->role == "Paramedis" )
        {
            $generatedToken = hash ( 'sha512', $User->paramedic->username . ' — ' . $User->password . ' — ' . Carbon::now ()->format ( 'd-m-Y' ) );
        }

        if ( $databaseToken === $checkToken && $checkToken === $generatedToken )
        {
            return response ()->json ( [ 'tokenCheck' => true ], 200 );
        }

        $User->mobile_app_token = null;
        $User->save ();

        return response ()->json ( [ 'tokenCheck' => false ], 401 );
    }
}