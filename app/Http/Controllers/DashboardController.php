<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Paramedis;
use App\Models\Reservasi;
use App\Models\Konsultasi;
use App\Models\Penjemputan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function dashboard_mahasiswa(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $mahasiswa = User::find($user->id)
                ->mahasiswa()
                ->first();
            $Reservasi = Reservasi::all();

            return view("dashboard.mahasiswa.dashboard", [
                "user" => $user,
                "mahasiswa" => $mahasiswa,
                "title" => "Dashboard Mahasiswa",
                "myReservasi" => $Reservasi
                    ->where("mahasiswaid", $mahasiswa->id)
                    ->count(),
                "countReservasi" => $Reservasi->count(),
            ]);
        }
        return redirect()->route("login");
    }

    public function dashboard_mahasiswa_reservasi(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $mahasiswa = User::find($user->id)
                ->mahasiswa()
                ->first();
            $dataReservasi = Reservasi::where(
                "mahasiswaid",
                $mahasiswa->id
            )->get();

            return view("dashboard.mahasiswa.reservasi", [
                "user" => $user,
                "mahasiswa" => $mahasiswa,
                "title" => "Dashboard Reservasi",
                "dataReservasi" => $dataReservasi,
            ]);
        }
        return redirect()->route("login");
    }

    public function dashboard_mahasiswa_reservasi_action(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            if (isset($request->hapusID)) {
                Reservasi::destroy($request->hapusID);
                return redirect()->route("dashboard-mahasiswa-reservasi");
            } elseif (
                isset($request->buatReservasi) and !isset($request->dokter)
            ) {
                $mahasiswa = User::find($user->id)
                    ->mahasiswa()
                    ->first();
                $hariIni = date("d");
                $jamSekarang = date("H");

                return view("dashboard.mahasiswa.reservasi", [
                    "user" => $user,
                    "mahasiswa" => $mahasiswa,
                    "title" => "Dashboard Reservasi",
                    "buatReservasi" => $request->buatReservasi,
                    "jamSekarang" => $jamSekarang,
                    "hariIni" => $hariIni,
                ]);
            } else {
                $mahasiswa = User::find($user->id)
                    ->mahasiswa()
                    ->first();
                $validator = Validator::make($request->all(), [
                    "dokter" => [
                        "required",
                        "in:Dokter Gigi,Dokter Umum,Dokter Kulit,Psikiater,Dokter THT",
                    ],
                    "tanggal" => ["required", "date_format:d-m-Y"],
                    "waktu" => ["required", "in:8,9,10,11,12,13,14,15"],
                    "keluhan" => ["required"],
                ]);

                if ($validator->fails()) {
                    return view("dashboard.mahasiswa.reservasi", [
                        "user" => $user,
                        "mahasiswa" => $mahasiswa,
                        "title" => "Dashboard Reservasi",
                        "buatReservasi" => $request->buatReservasi,
                    ])->withErrors($validator);
                }

                $tempDate = strtotime($request->tanggal);
                $formattedDate = date("Y-m-d", $tempDate);

                Reservasi::create([
                    "mahasiswaid" => strval($user->mahasiswaid),
                    "spesialis" => $request->dokter,
                    "tanggal" => $formattedDate,
                    "waktu" => $request->waktu,
                    "keluhan" => $request->keluhan,
                ]);

                return redirect()
                    ->route("dashboard-mahasiswa-reservasi")
                    ->with("success", "Sukses Membuat Reservasi");
            }
        }
        return redirect()->route("login");
    }

    public function dashboard_mahasiswa_konsultasi(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $mahasiswa = User::find($user->id)
                ->mahasiswa()
                ->first();
            $dataKonsultasi = Konsultasi::where(
                "mahasiswaid",
                $mahasiswa->id
            )->get();
            return view("dashboard.mahasiswa.konsultasi", [
                "user" => $user,
                "mahasiswa" => $mahasiswa,
                "title" => "Dashboard Konsultasi",
                "dataKonsultasi" => $dataKonsultasi,
            ]);
        }
        return redirect()->route("login");
    }

    public function dashboard_mahasiswa_konsultasi_action(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            if (isset($request->buatKonsultasi) and !isset($request->keluhan)) {
                $mahasiswa = User::find($user->id)
                    ->mahasiswa()
                    ->first();
                return view("dashboard.mahasiswa.konsultasi", [
                    "user" => $user,
                    "mahasiswa" => $mahasiswa,
                    "title" => "Dashboard Konsultasi",
                    "buatKonsultasi" => $request->buatKonsultasi,
                ]);
            } else {
                $mahasiswa = User::find($user->id)
                    ->mahasiswa()
                    ->first();
                $request->validate([
                    "keluhan" => ["required", "max:84"],
                    "keterangan" => "required",
                ]);

                Konsultasi::create([
                    "mahasiswaid" => strval($user->mahasiswaid),
                    "keluhan" => $request->keluhan,
                    "keterangan" => $request->keterangan,
                ]);

                return redirect()
                    ->route("dashboard-mahasiswa-konsultasi")
                    ->with("success", "Sukses Mengirimkan Konsultasi");
            }
        }
        return redirect()->route("login");
    }

    public function dashboard_mahasiswa_test(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $mahasiswa = User::find($user->id)
                ->mahasiswa()
                ->first();
            return view("dashboard.mahasiswa.test", [
                "user" => $user,
                "mahasiswa" => $mahasiswa,
            ]);
        }
        return redirect()->route("login");
    }

    public function dashboard_mahasiswa_penjemputan(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $mahasiswa = User::find($user->id)
                ->mahasiswa()
                ->first();
            $dataPenjemputan = Penjemputan::where("mahasiswaid", $mahasiswa->id)
                ->where("selesai", false)
                ->orderByDesc("id")
                ->get()
                ->first();

            if (isset($dataPenjemputan)) {
                $paramedis = Paramedis::where(
                    "id",
                    $dataPenjemputan->paramedisid
                )
                    ->orderByDesc("id")
                    ->get()
                    ->first();
            } else {
                $paramedis = null;
            }

            return view("dashboard.mahasiswa.penjemputan", [
                "user" => $user,
                "mahasiswa" => $mahasiswa,
                "title" => "Dashboard Penjemputan",
                "dataPenjemputan" => $dataPenjemputan,
                "paramedis" => $paramedis,
            ]);
        }
        return redirect()->route("login");
    }

    public function dashboard_mahasiswa_penjemputan_action(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $mahasiswa = User::find($user->id)
                ->mahasiswa()
                ->first();

            Penjemputan::create([
                "mahasiswaid" => $mahasiswa->id,
                "paramedisid" => null,
                "lintang" => $request->lintang,
                "bujur" => $request->bujur,
            ]);

            return redirect()->route("dashboard-mahasiswa-penjemputan");
        }
        return redirect()->route("login");
    }

    public function dashboard_dokter(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $dokter = User::find($user->id)
                ->dokter()
                ->first();
            $dataReservasi = Reservasi::where("dokterid", $user->dokter->id)
                ->orderBy("id")
                ->get();
            $dataKonsultasi = Konsultasi::where("dokterid", $user->dokter->id)
                ->orderBy("id")
                ->get();
            $Reservasi = Reservasi::all();

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
                "myReservasi" => $Reservasi
                    ->where("dokterid", $dokter->id)
                    ->count(),
                "countReservasi" => $Reservasi->count(),
            ]);
        }
        return redirect()->route("login");
    }

    public function dashboard_dokter_reservasi(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $dokter = User::find($user->id)
                ->dokter()
                ->first();
            $jam_sekarang = intval(date("H"));
            $JamTidakKosong = Reservasi::where("dokterid", $dokter->id)
                ->pluck("waktu")
                ->all();

            $dataReservasi1 = Reservasi::where(
                "tanggal",
                ">",
                now()->toDateString()
            )
                ->where([
                    "dokterid" => null,
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
                    "dokterid" => null,
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
        $user = Auth::user();
        if ($user) {
            $dokter = User::find($user->id)
                ->dokter()
                ->first();
            Reservasi::where("id", $request->reservasiID)->update([
                "dokterid" => $dokter->id,
            ]);

            return redirect(route("dashboard-dokter-reservasi"));
        }
        return redirect()->route("login");
    }

    public function dashboard_dokter_konsultasi(Request $request)
    {
        $user = Auth::user();
        $dataKonsultasi = Konsultasi::where("jawaban", null)->get();
        if ($user) {
            $dokter = User::find($user->id)
                ->dokter()
                ->first();
            return view("dashboard.dokter.konsultasi", [
                "user" => $user,
                "dokter" => $dokter,
                "title" => "Dashboard Konsultasi",
                "dataKonsultasi" => $dataKonsultasi,
            ]);
        }
        return redirect()->route("login");
    }

    public function dashboard_dokter_konsultasi_action(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $dokter = User::find($user->id)
                ->dokter()
                ->first();
            $check = Konsultasi::where("id", $request->konsultasiID)
                ->get()
                ->first();

            if ($check->jawaban == null and $check->dokterid == null) {
                Konsultasi::find($request->konsultasiID)->update([
                    "jawaban" => $request->jawaban,
                    "dokterid" => $dokter->id,
                ]);
            }
        }
        return redirect()->route("dashboard-dokter-konsultasi");
    }

    public function dashboard_paramedis(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $paramedis = User::find($user->id)
                ->paramedis()
                ->first();
            return view("dashboard.paramedis.dashboard", [
                "user" => $user,
                "paramedis" => $paramedis,
                "title" => "Dashboard Paramedis",
            ]);
        }
        return redirect()->route("login");
    }

    public function dashboard_paramedis_penjemputan(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $paramedis = User::find($user->id)
                ->paramedis()
                ->first();
            $dataPenjemputan = Penjemputan::where(["selesai" => false])->get();

            $berlangsungPenjemputan = Penjemputan::where([
                "paramedisid" => $paramedis->id,
                "selesai" => false,
            ])->get();

            if ($berlangsungPenjemputan->isEmpty()) {
                $berlangsungPenjemputan = null;
            } else {
                $berlangsungPenjemputan = Penjemputan::where(
                    "paramedisid",
                    $paramedis->id
                )
                    ->get()
                    ->last();
            }

            return view("dashboard.paramedis.penjemputan", [
                "user" => $user,
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
        $user = Auth::user();
        if ($user) {
            $check = Penjemputan::where("id", $request->jemputID)
                ->get()
                ->first();
            if (!$check->paramedisid) {
                Penjemputan::where("id", $request->jemputID)->update([
                    "paramedisid" => $user->paramedis->id,
                ]);
            }

            if ($request->selesai == "done") {
                Penjemputan::where("id", $request->jemputID)->update([
                    "selesai" => true,
                ]);
            }
            return redirect()->route("dashboard-paramedis-penjemputan");
        }
        return redirect()->route("login");
    }
}