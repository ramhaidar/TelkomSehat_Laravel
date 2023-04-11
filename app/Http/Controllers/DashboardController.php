<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reservasi;
use App\Models\Konsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function dashboard_mahasiswa(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $mahasiswa = User::find($user->id)->mahasiswa()->first();
            $Reservasi = Reservasi::all();
            return view(
                'dashboard.mahasiswa.dashboard',
                [
                    'user' => $user,
                    'mahasiswa' => $mahasiswa,
                    'title' => 'Dashboard Mahasiswa',
                    'myReservasi' => $Reservasi->where('mahasiswaid', $mahasiswa->id)->count(),
                    'countReservasi' => $Reservasi->count(),
                ],
            );
        }
        return redirect()->route('beranda');
    }

    public function dashboard_mahasiswa_reservasi(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $mahasiswa = User::find($user->id)->mahasiswa()->first();
            $dataReservasi = Reservasi::where('mahasiswaid', $mahasiswa->id)->get();
            return view(
                'dashboard.mahasiswa.reservasi',
                [
                    'user' => $user,
                    'mahasiswa' => $mahasiswa,
                    'title' => 'Dashboard Reservasi',
                    'dataReservasi' => $dataReservasi,
                ],
            );
        }
        return redirect()->route('beranda');
    }

    public function dashboard_mahasiswa_reservasi_action(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            if (isset($request->buatReservasi) and !isset($request->dokter)) {
                $mahasiswa = User::find($user->id)->mahasiswa()->first();
                return view(
                    'dashboard.mahasiswa.reservasi',
                    [
                        'user' => $user,
                        'mahasiswa' => $mahasiswa,
                        'title' => 'Dashboard Reservasi',
                        'buatReservasi' => $request->buatReservasi
                    ],
                );
            } else {
                $mahasiswa = User::find($user->id)->mahasiswa()->first();
                $validator = Validator::make($request->all(), [
                    'dokter' => ['required', 'in:Dokter Gigi,Dokter Umum,Dokter Kulit,Dokter Psikiater,Dokter THT'],
                    'tanggal' => ['required', 'date_format:d-m-Y'],
                    'waktu' => ['required', 'in:8,9,10,11,12,13,14,15'],
                    'keluhan' => ['required'],
                ]);

                if ($validator->fails()) {
                    return view(
                        'dashboard.mahasiswa.reservasi',
                        [
                            'user' => $user,
                            'mahasiswa' => $mahasiswa,
                            'title' => 'Dashboard Reservasi',
                            'buatReservasi' => $request->buatReservasi
                        ],
                    )->withErrors($validator);
                }

                $tempDate = strtotime($request->tanggal);
                $formattedDate = date('Y-m-d', $tempDate);

                $berobat = False;
                if (isset($request->berobat)) {
                    $berobat = True;
                }

                $konsultasi = False;
                if (isset($request->konsultasi)) {
                    $konsultasi = True;
                }

                Reservasi::create([
                    'mahasiswaid' => strval($user->mahasiswaid),
                    'spesialis' => $request->dokter,
                    'tanggal' => $formattedDate,
                    'waktu' => $request->waktu,
                    'keluhan' => $request->keluhan,
                    'berobat' => $berobat,
                    'konsultasi' => $konsultasi,
                ]);

                $dataReservasi = Reservasi::where('mahasiswaid', $mahasiswa->id)->get();
                return view(
                    'dashboard.mahasiswa.reservasi',
                    [
                        'user' => $user,
                        'mahasiswa' => $mahasiswa,
                        'title' => 'Dashboard Reservasi',
                        'dataReservasi' => $dataReservasi,
                    ],
                )->with("succes", "Sukses Membuat Reservasi");
            }
        }
        return redirect()->route('beranda');
    }

    public function dashboard_mahasiswa_konsultasi(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $mahasiswa = User::find($user->id)->mahasiswa()->first();
            $dataKonsultasi = Konsultasi::where('mahasiswaid', $mahasiswa->id)->get();
            return view(
                'dashboard.mahasiswa.konsultasi',
                [
                    'user' => $user,
                    'mahasiswa' => $mahasiswa,
                    'title' => 'Dashboard Konsultasi',
                    'dataKonsultasi' => $dataKonsultasi,
                ],
            );
        }
        return redirect()->route('beranda');
    }

    public function dashboard_mahasiswa_konsultasi_action(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            if (isset($request->buatKonsultasi) and !isset($request->keluhan)) {

                $mahasiswa = User::find($user->id)->mahasiswa()->first();
                return view(
                    'dashboard.mahasiswa.konsultasi',
                    [
                        'user' => $user,
                        'mahasiswa' => $mahasiswa,
                        'title' => 'Dashboard Konsultasi',
                        'buatKonsultasi' => $request->buatKonsultasi
                    ],
                );
            } else {
                $mahasiswa = User::find($user->id)->mahasiswa()->first();
                $request->validate([
                    'keluhan' => 'required',
                ]);

                Konsultasi::create([
                    'mahasiswaid' => strval($user->mahasiswaid),
                    'keluhan' => $request->keluhan,
                ]);

                $dataKonsultasi = Konsultasi::where('mahasiswaid', $mahasiswa->id)->get();
                return view(
                    'dashboard.mahasiswa.konsultasi',
                    [
                        'user' => $user,
                        'mahasiswa' => $mahasiswa,
                        'title' => 'Dashboard Reservasi',
                        'dataKonsultasi' => $dataKonsultasi,
                    ],
                )->with("succes", "Sukses Mengirimkan Konsultasi");
            }
        }
        return redirect()->route('beranda');
    }

    public function dashboard_mahasiswa_test(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $mahasiswa = User::find($user->id)->mahasiswa()->first();
            return view(
                'dashboard.mahasiswa.test',
                [
                    'user' => $user,
                    'mahasiswa' => $mahasiswa
                ],
            );
        }
        return redirect()->route('beranda');
    }

    public function dashboard_dokter(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $dokter = User::find($user->id)->dokter()->first();
            $dataReservasi = Reservasi::where('dokterid', $user->dokter->id)->get();
            $Reservasi = Reservasi::all();
            return view(
                'dashboard.dokter.dashboard',
                [
                    'user' => $user,
                    'dokter' => $dokter,
                    'title' => 'Dashboard Dokter',
                    'dataReservasi' => $dataReservasi,
                    'myReservasi' => $Reservasi->where('dokterid', $dokter->id)->count(),
                    'countReservasi' => $Reservasi->count(),
                ],
            );
        }
        return redirect()->route('beranda');
    }

    public function dashboard_dokter_reservasi(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $dokter = User::find($user->id)->dokter()->first();
            $dataReservasi = Reservasi::where(
                [
                    'dokterid' => null,
                    'spesialis' => $dokter->spesialis
                ]
            )->get();

            return view(
                'dashboard.dokter.reservasi',
                [
                    'user' => $user,
                    'dokter' => $dokter,
                    'title' => 'Dashboard Reservasi',
                    'dataReservasi' => $dataReservasi,
                ],
            );
        }
        return redirect()->route('beranda');
    }

    public function dashboard_dokter_reservasi_action(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $dokter = User::find($user->id)->dokter()->first();
            Reservasi::where('id', $request->reservasiID)->update(['dokterid' => $dokter->id]);
            $dataReservasi = Reservasi::where('dokterid', null)->get();
            return view(
                'dashboard.dokter.reservasi',
                [
                    'user' => $user,
                    'dokter' => $dokter,
                    'title' => 'Dashboard Reservasi',
                    'dataReservasi' => $dataReservasi,
                ],
            );
        }
        return redirect()->route('beranda');
    }

    public function dashboard_dokter_konsultasi(Request $request)
    {
        $user = Auth::user();
        $dataKonsultasi = Konsultasi::where('jawaban', null)->get();
        if ($user) {
            $dokter = User::find($user->id)->dokter()->first();
            return view(
                'dashboard.dokter.konsultasi',
                [
                    'user' => $user,
                    'dokter' => $dokter,
                    'title' => 'Dashboard Konsultasi',
                    'dataKonsultasi' => $dataKonsultasi,
                ],
            );
        }
        return redirect()->route('beranda');
    }

    public function dashboard_dokter_konsultasi_action(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $dokter = User::find($user->id)->dokter()->first();
            Konsultasi::find($request->konsultasiID)->update(['jawaban' => $request->jawaban]);
        }
        return redirect()->route('dashboard-dokter-konsultasi');
    }
}