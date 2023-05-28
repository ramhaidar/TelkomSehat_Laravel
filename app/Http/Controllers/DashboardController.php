<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Paramedis;
use App\Models\Reservasi;
use App\Models\Konsultasi;
use App\Models\Penjemputan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function dashboard_pasien(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $pasien = $user->pasien()->first();
            $myReservasi = Reservasi::where("pasien_id", $pasien->id)->count();
            $countReservasi = Reservasi::count();

            return view("dashboard.pasien.dashboard", [
                "user" => $user,
                "pasien" => $pasien,
                "title" => "Dashboard Pasien",
                "myReservasi" => $myReservasi,
                "countReservasi" => $countReservasi,
            ]);
        }
        return redirect()->route("login");
    }

    public function dashboard_pasien_reservasi(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $pasien = $user->pasien()->first();
            $dataReservasi = Reservasi::where("pasien_id", $pasien->id)->get();

            return view("dashboard.pasien.reservasi", [
                "user" => $user,
                "pasien" => $pasien,
                "title" => "Dashboard Reservasi",
                "dataReservasi" => $dataReservasi,
            ]);
        }
        return redirect()->route("login");
    }

    public function dashboard_pasien_reservasi_action(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            if (isset($request->hapusID)) {
                Reservasi::destroy($request->hapusID);
                return redirect()->route("dashboard-pasien-reservasi");
            } elseif (
                isset($request->buatReservasi) and !isset($request->dokter)
            ) {
                $pasien = $user->pasien()->first();
                $hariIni = date("d");
                $jamSekarang = date("H");

                return view("dashboard.pasien.reservasi", [
                    "user" => $user,
                    "pasien" => $pasien,
                    "title" => "Dashboard Reservasi",
                    "buatReservasi" => $request->buatReservasi,
                    "jamSekarang" => $jamSekarang,
                    "hariIni" => $hariIni,
                ]);
            } else {
                $pasien = $user->pasien()->first();
                $validator = Validator::make($request->all(), [
                    "dokter" => [
                        "required",
                        Rule::in(['Dokter Gigi', 'Dokter Umum', 'Dokter Kulit', 'Psikiater', 'Dokter THT']),
                    ],
                    "tanggal" => ["required", "date_format:d-m-Y"],
                    "waktu" => ["required", Rule::in([8, 9, 10, 11, 12, 13, 14, 15])],
                    "keluhan" => ["required"],
                ]);

                if ($validator->fails()) {
                    return view("dashboard.pasien.reservasi", [
                        "user" => $user,
                        "pasien" => $pasien,
                        "title" => "Dashboard Reservasi",
                        "buatReservasi" => $request->buatReservasi,
                    ])->withErrors($validator);
                }

                $formattedDate = Carbon::createFromFormat('d-m-Y', $request->tanggal)->format('Y-m-d');

                Reservasi::create([
                    "pasien_id" => $user->pasien_id,
                    "spesialis" => $request->dokter,
                    "tanggal" => $formattedDate,
                    "waktu" => $request->waktu,
                    "keluhan" => $request->keluhan,
                ]);

                return redirect()
                    ->route("dashboard-pasien-reservasi")
                    ->with("success", "Sukses Membuat Reservasi");
            }
        }
        return redirect()->route("login");
    }

    public function dashboard_pasien_konsultasi(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $pasien = $user->pasien()->first();
            $dataKonsultasi = Konsultasi::where("pasien_id", $pasien->id)->get();
            return view("dashboard.pasien.konsultasi", compact("user", "pasien", "dataKonsultasi"))->with("title", "Dashboard Konsultasi");
        }
        return redirect()->route("login");
    }

    public function dashboard_pasien_konsultasi_action(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route("login");
        }

        $pasien = $user->pasien()->first();

        if (isset($request->buatKonsultasi) && !isset($request->keluhan)) {
            return view("dashboard.pasien.konsultasi", [
                "user" => $user,
                "pasien" => $pasien,
                "title" => "Dashboard Konsultasi",
                "buatKonsultasi" => $request->buatKonsultasi,
            ]);
        }

        $request->validate([
            "keluhan" => ["required", "max:84"],
            "keterangan" => "required",
        ]);

        Konsultasi::create([
            "pasien_id" => strval($user->pasien_id),
            "keluhan" => $request->keluhan,
            "keterangan" => $request->keterangan,
        ]);

        return redirect()
            ->route("dashboard-pasien-konsultasi")
            ->with("success", "Sukses Mengirimkan Konsultasi");
    }

    public function dashboard_pasien_test(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $pasien = $user->pasien()->first();
            return view("dashboard.pasien.test", compact('user', 'pasien'));
        }
        return redirect()->route("login");
    }

    public function dashboard_pasien_penjemputan(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $pasien = $user->pasien()->first();
            $dataPenjemputan = Penjemputan::where("pasien_id", $pasien->id)
                ->where("selesai", false)
                ->latest()
                ->first();

            $paramedis = isset($dataPenjemputan) ? Paramedis::find($dataPenjemputan->paramedis_id) : null;

            return view("dashboard.pasien.penjemputan", [
                "user" => $user,
                "pasien" => $pasien,
                "title" => "Dashboard Penjemputan",
                "dataPenjemputan" => $dataPenjemputan,
                "paramedis" => $paramedis,
            ]);
        }
        return redirect()->route("login");
    }

    public function dashboard_pasien_penjemputan_action(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $pasien = $user->pasien()->first();

            Penjemputan::create([
                "pasien_id" => $pasien->id,
                "paramedis_id" => null,
                "lintang" => $request->lintang,
                "bujur" => $request->bujur,
            ]);

            return redirect()->route("dashboard-pasien-penjemputan");
        }
        return redirect()->route("login");
    }

    public function dashboard_dokter(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $dokter = $user->dokter()->first();
            $dataReservasi = Reservasi::where("dokter_id", $dokter->id)
                ->orderBy("id")
                ->get();
            $dataKonsultasi = Konsultasi::where("dokter_id", $dokter->id)
                ->orderBy("id")
                ->get();
            $Reservasi = Reservasi::all();

            $spesialisSuffixes = [
                "Dokter Gigi" => ", drg.",
                "Dokter Umum" => ", dr.",
                "Dokter Kulit" => ", SpKK.",
                "Psikiater" => ", SpKJ.",
                "Dokter THT" => ", SpTHT."
            ];

            if ($dokter->spesialis == "Dokter Gigi") {
                $namaDokter = $user->name . ", drg.";
            } elseif ($dokter->spesialis == "Dokter Umum") {
                $namaDokter = $user->name . ", dr.";
            } elseif ($dokter->spesialis == "Dokter Kulit") {
                $namaDokter = $user->name . ", SpKK.";
            } elseif ($dokter->spesialis == "Psikiater") {
                $namaDokter = $user->name . ", SpKJ.";
            } elseif ($dokter->spesialis == "Dokter THT") {
                $namaDokter = $user->name . ", SpTHT.";
            }

            return view("dashboard.dokter.dashboard", [
                "user" => $user,
                "dokter" => $dokter,
                "title" => "Dashboard Dokter",
                "dataReservasi" => $dataReservasi,
                "dataKonsultasi" => $dataKonsultasi,
                "myReservasi" => $Reservasi->where("dokter_id", $dokter->id)->count(),
                "countReservasi" => $Reservasi->count(),
            ]);
        }
        return redirect()->route("login");
    }


    public function dashboard_dokter_reservasi(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $dokter = $user->dokter()->first();
            $jam_sekarang = intval(date("H"));
            $JamTidakKosong = Reservasi::where("dokter_id", $dokter->id)
                ->pluck("waktu")
                ->all();

            $dataReservasi1 = Reservasi::where(
                "tanggal",
                ">",
                now()->toDateString()
            )
                ->where([
                    "dokter_id" => null,
                    "spesialis" => $dokter->spesialis,
                ])
                ->whereNotIn("waktu", $JamTidakKosong);

            $dataReservasi = Reservasi::where(
                "tanggal",
                "=",
                now()->toDateString()
            )
                ->where("waktu", ">", $jam_sekarang - 1)
                ->where([
                    "dokter_id" => null,
                    "spesialis" => $dokter->spesialis,
                ])
                ->whereNotIn("waktu", $JamTidakKosong)
                ->orderBy("tanggal")
                ->union($dataReservasi1)
                ->orderBy("tanggal")
                ->get()
                ->all();

            return view("dashboard.dokter.reservasi", [
                "user" => $user,
                "dokter" => $dokter,
                "title" => "Dashboard Reservasi",
                "dataReservasi" => $dataReservasi,
            ]);
        }
        return redirect()->route("login");
    }

    public function dashboard_dokter_reservasi_action(Request $request)
    {
        if (Auth::check()) {
            $dokter = Auth::user()->dokter()->first();
            Reservasi::where("id", $request->reservasiID)->update([
                "dokter_id" => $dokter->id,
            ]);

            return redirect(route("dashboard-dokter-reservasi"));
        }
        return redirect()->route("login");
    }


    public function dashboard_dokter_konsultasi(Request $request)
    {
        if (Auth::check()) {
            $dokter = Auth::user()->dokter()->first();
            $dataKonsultasi = Konsultasi::whereNull("jawaban")->get();
            return view("dashboard.dokter.konsultasi", [
                "user" => Auth::user(),
                "dokter" => $dokter,
                "title" => "Dashboard Konsultasi",
                "dataKonsultasi" => $dataKonsultasi,
            ]);
        }
        return redirect()->route("login");
    }

    public function dashboard_dokter_konsultasi_action(Request $request)
    {
        if (Auth::check()) {
            $dokter = Auth::user()->dokter()->first();
            $check = Konsultasi::find($request->konsultasiID);

            if ($check && is_null($check->jawaban) && is_null($check->dokter_id)) {
                $check->update([
                    "jawaban" => $request->jawaban,
                    "dokter_id" => $dokter->id,
                ]);
            }
        }
        return redirect()->route("dashboard-dokter-konsultasi");
    }

    public function dashboard_paramedis(Request $request)
    {
        if (Auth::check()) {
            $paramedis = Auth::user()->paramedis()->first();
            return view("dashboard.paramedis.dashboard", [
                "user" => Auth::user(),
                "paramedis" => $paramedis,
                "title" => "Dashboard Paramedis",
            ]);
        }
        return redirect()->route("login");
    }

    public function dashboard_paramedis_penjemputan(Request $request)
    {
        if (Auth::check()) {
            $paramedis = Auth::user()->paramedis()->first();
            $dataPenjemputan = Penjemputan::where(["selesai" => false])->get();

            $berlangsungPenjemputan = Penjemputan::where([
                "paramedis_id" => $paramedis->id,
                "selesai" => false,
            ])->latest()->first();

            return view("dashboard.paramedis.penjemputan", [
                "user" => Auth::user(),
                "paramedis" => $paramedis,
                "title" => "Dashboard Penjemputan",
                "dataPenjemputan" => $dataPenjemputan,
                "berlangsungPenjemputan" => $berlangsungPenjemputan,
            ]);
        }
        return redirect()->route("login");
    }

    public function dashboard_paramedis_penjemputan_action(Request $request)
    {
        if (Auth::check()) {
            $check = Penjemputan::find($request->jemputID);
            if ($check && !$check->paramedis_id) {
                $check->update([
                    "paramedis_id" => Auth::user()->paramedis->id,
                ]);
            }

            if ($request->selesai == "done") {
                $check->update([
                    "selesai" => true,
                ]);
            }
            return redirect()->route("dashboard-paramedis-penjemputan");
        }
        return redirect()->route("login");
    }
}