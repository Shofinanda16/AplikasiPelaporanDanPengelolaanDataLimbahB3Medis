<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DataFasyankes;
use App\Models\DataLimbahMasuk;
use App\Models\DataHasilInsinerasi;

class DashboardController extends Controller
{
    /* DASHBOARD STAF */
    public function staf()
    {
        $totalFasyankes = DataFasyankes::count();
        $limbahMasuk = DataLimbahMasuk::where('status', '!=', 'dimusnahkan')->count();
        $hasilInsinerasi = DataLimbahMasuk::where('status', 'dimusnahkan')->count();
        $totalDataLimbah = $limbahMasuk + $hasilInsinerasi;

        return view('staf.dashboard-staf', compact('totalFasyankes','totalDataLimbah','limbahMasuk','hasilInsinerasi'));
    }

    public function fasyankes()
    {
        return view('staf.fasyankes');
    }

    public function add()
    {
        return view('staf.add-fasyankes');
    }

    public function limbahmasuk()
    {
        return view('staf.limbah-masuk');
    }

    public function addlimbahmasuk()
    {
        return view('staf.add-limbah-masuk');
    }


    public function limbahkeluar()
    {
        return view('staf.hasil-insinerasi');
    }

    public function laporanstaf()
    {
        return view('staf.laporan-staf');
    }

    /* DASHBOARD PETUGAS */
    public function petugas()
    {
        $limbahMasuk = DataLimbahMasuk::where('status', '!=', 'dimusnahkan')->count();
        $hasilInsinerasi = DataHasilInsinerasi::count();
        $limbahDisimpan = DataLimbahMasuk::where('status', 'disimpan')->count();

        return view('petugas.dashboard', compact('limbahMasuk','hasilInsinerasi','limbahDisimpan'));
    }

    public function petugasLimbahMasuk()
    {
        return view('petugas.limbah-masuk');
    }

    public function petugasLimbahKeluar()
    {
        return view('petugas.hasil-insinerasi');
    }

    /* DASHBOARD MANAGER */
    public function manager()
    {
        $totalLimbahMasuk = DataLimbahMasuk::where('status','!=','dimusnahkan')->sum('jumlah_limbah');
        $totalLimbahKeluar = DataHasilInsinerasi::with('limbahMasuk')->get()->sum(function ($item) {return $item->limbahMasuk->jumlah_limbah ?? 0;});

        return view('manager.dashboard', compact('totalLimbahMasuk','totalLimbahKeluar')
        );
    }

    public function rekapitulasiManager()
    {
        return view('manager.rekapitulasi');
    }

    public function laporanManager()
    {
        return view('manager.laporan');
    }

    /* DASHBOARD ADMIN */
    public function admin()
    {
        $totalUser = User::count();
        $totalStaf = User::where('role', 'staf')->count();
        $totalPetugas = User::where('role', 'petugas')->count();
        $totalManager = User::where('role', 'manager')->count();

        return view('admin.dashboard', compact('totalUser','totalStaf','totalPetugas','totalManager'));
    }

    public function kelolaUser()
    {
        return view('admin.kelola-user');
    }

    public function addUser()
    {
        return view('admin.add-user');
    }
}