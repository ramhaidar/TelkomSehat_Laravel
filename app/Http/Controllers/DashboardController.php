<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Paramedic;
use App\Models\Evacuation;
use App\Models\Reservation;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function dashboard_patient ( Request $request )
    {
        $user = Auth::user ();
        if ( $user )
        {
            $patient          = $user->patient ()->first ();
            $myReservation    = Reservation::where ( "patient_id", $patient->id )->count ();
            $countReservation = Reservation::count ();

            return view ( "dashboard.patient.dashboard", [ 
                "user"             => $user,
                "patient"          => $patient,
                "title"            => "Dashboard Pasien",
                "myReservation"    => $myReservation,
                "countReservation" => $countReservation,
            ] );
        }
        return redirect ()->route ( "login" );
    }

    public function dashboard_patient_reservation ( Request $request )
    {
        $user = Auth::user ();
        if ( $user )
        {
            $patient         = $user->patient ()->first ();
            $dataReservation = Reservation::where ( "patient_id", $patient->id )->get ();

            return view ( "dashboard.patient.reservation", [ 
                "user"            => $user,
                "patient"         => $patient,
                "title"           => "Dashboard Reservasi",
                "dataReservation" => $dataReservation,
            ] );
        }
        return redirect ()->route ( "login" );
    }

    public function dashboard_patient_reservation_action ( Request $request )
    {
        $user = Auth::user ();
        if ( $user )
        {
            if ( isset( $request->hapusID ) )
            {
                Reservation::destroy ( $request->hapusID );
                return redirect ()->route ( "dashboard-patient-reservation" );
            }
            elseif (
                isset( $request->makeReservation ) and ! isset( $request->doctor )
            )
            {
                $patient     = $user->patient ()->first ();
                $hariIni     = date ( "d" );
                $jamSekarang = date ( "H" );

                return view ( "dashboard.patient.reservation", [ 
                    "user"            => $user,
                    "patient"         => $patient,
                    "title"           => "Dashboard Reservasi",
                    "makeReservation" => $request->makeReservation,
                    "jamSekarang"     => $jamSekarang,
                    "hariIni"         => $hariIni,
                ] );
            }
            else
            {
                $patient   = $user->patient ()->first ();
                $validator = Validator::make ( $request->all (), [ 
                    "doctor"  => [ 
                        "required",
                        Rule::in ( [ 'Dokter Gigi', 'Dokter Umum', 'Dokter Kulit', 'Psikiater', 'Dokter THT' ] ),
                    ],
                    "tanggal" => [ "required", "date_format:d-m-Y" ],
                    "waktu"   => [ "required", Rule::in ( [ 8, 9, 10, 11, 12, 13, 14, 15 ] ) ],
                    "keluhan" => [ "required" ],
                ] );

                if ( $validator->fails () )
                {
                    return view ( "dashboard.patient.reservation", [ 
                        "user"            => $user,
                        "patient"         => $patient,
                        "title"           => "Dashboard Reservasi",
                        "makeReservation" => $request->makeReservation,
                    ] )->withErrors ( $validator );
                }

                $formattedDate = Carbon::createFromFormat ( 'd-m-Y', $request->tanggal )->format ( 'Y-m-d' );

                Reservation::create ( [ 
                    "patient_id" => $user->patient_id,
                    "spesialis"  => $request->doctor,
                    "tanggal"    => $formattedDate,
                    "waktu"      => $request->waktu,
                    "keluhan"    => $request->keluhan,
                ] );

                return redirect ()
                    ->route ( "dashboard-patient-reservation" )
                    ->with ( "success", "Sukses Membuat Reservation" );
            }
        }
        return redirect ()->route ( "login" );
    }

    public function dashboard_patient_consultation ( Request $request )
    {
        $user = Auth::user ();
        if ( $user )
        {
            $patient          = $user->patient ()->first ();
            $dataConsultation = Consultation::where ( "patient_id", $patient->id )->get ();
            return view ( "dashboard.patient.consultation", compact (
                "user",
                "patient",
                "dataConsultation"
            ) )->with ( "title", "Dashboard Konsultasi" );
        }
        return redirect ()->route ( "login" );
    }

    public function dashboard_patient_consultation_action ( Request $request )
    {
        $user = Auth::user ();
        if ( ! $user )
        {
            return redirect ()->route ( "login" );
        }

        $patient = $user->patient ()->first ();

        if ( isset( $request->buatConsultation ) && ! isset( $request->keluhan ) )
        {
            return view ( "dashboard.patient.consultation", [ 
                "user"             => $user,
                "patient"          => $patient,
                "title"            => "Dashboard Konsultasi",
                "buatConsultation" => $request->buatConsultation,
            ] );
        }

        $request->validate ( [ 
            "keluhan"    => [ "required", "max:84" ],
            "keterangan" => "required",
        ] );

        Consultation::create ( [ 
            "patient_id" => strval ( $user->patient_id ),
            "keluhan"    => $request->keluhan,
            "keterangan" => $request->keterangan,
        ] );

        return redirect ()
            ->route ( "dashboard-patient-consultation" )
            ->with ( "success", "Sukses Mengirimkan Consultation" );
    }

    public function dashboard_patient_test ( Request $request )
    {
        $user = Auth::user ();
        if ( $user )
        {
            $patient = $user->patient ()->first ();
            return view ( "dashboard.patient.test", compact ( 'user', 'patient' ) );
        }
        return redirect ()->route ( "login" );
    }

    public function dashboard_patient_evacuation ( Request $request )
    {
        $user = Auth::user ();
        if ( $user )
        {
            $patient        = $user->patient ()->first ();
            $dataEvacuation = Evacuation::where ( "patient_id", $patient->id )
                ->where ( "is_done", false )
                ->latest ()
                ->first ();

            $paramedic = isset( $dataEvacuation ) ? Paramedic::find ( $dataEvacuation->paramedic_id ) : null;

            return view ( "dashboard.patient.evacuation", [ 
                "user"           => $user,
                "patient"        => $patient,
                "title"          => "Dashboard Penjemputan",
                "dataEvacuation" => $dataEvacuation,
                "paramedic"      => $paramedic,
            ] );
        }
        return redirect ()->route ( "login" );
    }

    public function dashboard_patient_evacuation_action ( Request $request )
    {
        $user = Auth::user ();
        if ( $user )
        {
            $patient = $user->patient ()->first ();

            Evacuation::create ( [ 
                "patient_id"   => $patient->id,
                "paramedic_id" => null,
                "lintang"      => $request->lintang,
                "bujur"        => $request->bujur,
            ] );

            return redirect ()->route ( "dashboard-patient-evacuation" );
        }
        return redirect ()->route ( "login" );
    }

    public function dashboard_doctor ( Request $request )
    {
        $user = Auth::user ();
        if ( $user )
        {
            $doctor           = $user->doctor ()->first ();
            $dataReservation  = Reservation::where ( "doctor_id", $doctor->id )
                ->orderBy ( "id" )
                ->get ();
            $dataConsultation = Consultation::where ( "doctor_id", $doctor->id )
                ->orderBy ( "id" )
                ->get ();
            $Reservation      = Reservation::all ();

            $spesialisSuffixes = [ 
                "Dokter Gigi"  => ", drg.",
                "Dokter Umum"  => ", dr.",
                "Dokter Kulit" => ", SpKK.",
                "Psikiater"    => ", SpKJ.",
                "Dokter THT"   => ", SpTHT.",
            ];

            if ( "Dokter Gigi" == $doctor->spesialis )
            {
                $namaDokter = $user->name . ", drg.";
            }
            elseif ( "Dokter Umum" == $doctor->spesialis )
            {
                $namaDokter = $user->name . ", dr.";
            }
            elseif ( "Dokter Kulit" == $doctor->spesialis )
            {
                $namaDokter = $user->name . ", SpKK.";
            }
            elseif ( "Psikiater" == $doctor->spesialis )
            {
                $namaDokter = $user->name . ", SpKJ.";
            }
            elseif ( "Dokter THT" == $doctor->spesialis )
            {
                $namaDokter = $user->name . ", SpTHT.";
            }

            return view ( "dashboard.doctor.dashboard", [ 
                "user"             => $user,
                "doctor"           => $doctor,
                "title"            => "Dashboard Dokter",
                "dataReservation"  => $dataReservation,
                "dataConsultation" => $dataConsultation,
                "myReservation"    => $Reservation->where ( "doctor_id", $doctor->id )->count (),
                "countReservation" => $Reservation->count (),
            ] );
        }
        return redirect ()->route ( "login" );
    }

    public function dashboard_doctor_reservation ( Request $request )
    {
        $user = Auth::user ();
        if ( $user )
        {
            $doctor         = $user->doctor ()->first ();
            $jam_sekarang   = intval ( date ( "H" ) );
            $JamTidakKosong = Reservation::where ( "doctor_id", $doctor->id )
                ->pluck ( "waktu" )
                ->all ();

            $dataReservation1 = Reservation::where (
                "tanggal",
                ">",
                now ()->toDateString ()
            )
                ->where ( [ 
                    "doctor_id" => null,
                    "spesialis" => $doctor->spesialis,
                ] )
                ->whereNotIn ( "waktu", $JamTidakKosong );

            $dataReservation = Reservation::where (
                "tanggal",
                "=",
                now ()->toDateString ()
            )
                ->where ( "waktu", ">", $jam_sekarang - 1 )
                ->where ( [ 
                    "doctor_id" => null,
                    "spesialis" => $doctor->spesialis,
                ] )
                ->whereNotIn ( "waktu", $JamTidakKosong )
                ->orderBy ( "tanggal" )
                ->union ( $dataReservation1 )
                ->orderBy ( "tanggal" )
                ->get ()
                ->all ();

            return view ( "dashboard.doctor.reservation", [ 
                "user"            => $user,
                "doctor"          => $doctor,
                "title"           => "Dashboard Reservasi",
                "dataReservation" => $dataReservation,
            ] );
        }
        return redirect ()->route ( "login" );
    }

    public function dashboard_doctor_reservation_action ( Request $request )
    {
        if ( Auth::check () )
        {
            $doctor = Auth::user ()->doctor ()->first ();
            Reservation::where ( "id", $request->reservationID )->update ( [ 
                "doctor_id" => $doctor->id,
            ] );

            return redirect ( route ( "dashboard-doctor-reservation" ) );
        }
        return redirect ()->route ( "login" );
    }

    public function dashboard_doctor_consultation ( Request $request )
    {
        if ( Auth::check () )
        {
            $doctor           = Auth::user ()->doctor ()->first ();
            $dataConsultation = Consultation::whereNull ( "jawaban" )->get ();
            return view ( "dashboard.doctor.consultation", [ 
                "user"             => Auth::user (),
                "doctor"           => $doctor,
                "title"            => "Dashboard Konsultasi",
                "dataConsultation" => $dataConsultation,
            ] );
        }
        return redirect ()->route ( "login" );
    }

    public function dashboard_doctor_consultation_action ( Request $request )
    {
        if ( Auth::check () )
        {
            $doctor = Auth::user ()->doctor ()->first ();
            $check  = Consultation::find ( $request->consultationID );

            if ( $check && is_null ( $check->jawaban ) && is_null ( $check->doctor_id ) )
            {
                $check->update ( [ 
                    "jawaban"   => $request->jawaban,
                    "doctor_id" => $doctor->id,
                ] );
            }
        }
        return redirect ()->route ( "dashboard-doctor-consultation" );
    }

    public function dashboard_paramedic ( Request $request )
    {
        if ( Auth::check () )
        {
            $paramedic = Auth::user ()->paramedic ()->first ();
            return view ( "dashboard.paramedic.dashboard", [ 
                "user"      => Auth::user (),
                "paramedic" => $paramedic,
                "title"     => "Dashboard Paramedis",
            ] );
        }
        return redirect ()->route ( "login" );
    }

    public function dashboard_paramedic_evacuation ( Request $request )
    {
        if ( Auth::check () )
        {
            $paramedic      = Auth::user ()->paramedic ()->first ();
            $dataEvacuation = Evacuation::where ( [ "selesai" => false ] )->get ();

            $berlangsungEvacuation = Evacuation::where ( [ 
                "paramedic_id" => $paramedic->id,
                "selesai"      => false,
            ] )->latest ()->first ();

            return view ( "dashboard.paramedic.evacuation", [ 
                "user"                  => Auth::user (),
                "paramedic"             => $paramedic,
                "title"                 => "Dashboard Penjemputan",
                "dataEvacuation"        => $dataEvacuation,
                "berlangsungEvacuation" => $berlangsungEvacuation,
            ] );
        }
        return redirect ()->route ( "login" );
    }

    public function dashboard_paramedic_evacuation_action ( Request $request )
    {
        if ( Auth::check () )
        {
            $check = Evacuation::find ( $request->jemputID );
            if ( $check && ! $check->paramedic_id )
            {
                $check->update ( [ 
                    "paramedic_id" => Auth::user ()->paramedic->id,
                ] );
            }

            if ( "done" == $request->selesai )
            {
                $check->update ( [ 
                    "selesai" => true,
                ] );
            }
            return redirect ()->route ( "dashboard-paramedic-evacuation" );
        }
        return redirect ()->route ( "login" );
    }

    public function get_available_doctor ( Request $request )
    {
        if ( request ()->segment ( 1 ) == 'api' )
        {
            $tanggal              = $request->input ( 'tanggal' );
            $waktu                = $request->input ( 'waktu' );
            $tanggalFormatted     = date ( 'Y-m-d', strtotime ( $tanggal ) );
            $doctorIdNotAvailable = Reservation::whereNotNull ( 'doctor_id' )
                ->whereNotNull ( 'patient_id' )
                ->where ( 'time', $waktu )
                ->where ( 'date', $tanggalFormatted )
                ->get ( 'doctor_id' )
                ->pluck ( 'doctor_id' )
                ->toArray ();
            $availableDoctor      = Doctor::whereNotIn ( 'id', $doctorIdNotAvailable )->orderBy ( 'speciality' )->with ( 'users' )->get ();
            return response ()->json ( [ 
                "data" => $availableDoctor,
            ] );
        }
    }

}