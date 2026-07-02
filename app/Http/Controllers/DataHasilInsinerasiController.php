<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataHasilInsinerasi;

class DataHasilInsinerasiController extends Controller
{
    /* DATA HASIL INSINERASI PETUGAS */

    public function index()
    {
        $hasilInsinerasi = DataHasilInsinerasi::with(['fasyankes','limbahMasuk'])->orderBy('tanggal_pemusnahan', 'asc')->get();
        return view('petugas.hasil-insinerasi',compact('hasilInsinerasi'));
    }

    /* DATA HASIL INSINERASI STAF */
    public function indexStaf()
    {
        $hasilInsinerasi = DataHasilInsinerasi::with(['fasyankes','limbahMasuk'])->orderBy('tanggal_pemusnahan', 'asc')->get();
        return view('staf.hasil-insinerasi',compact('hasilInsinerasi'));
    }
}