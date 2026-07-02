<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataFasyankes;
use App\Models\DataLimbahMasuk;
use App\Models\DataHasilInsinerasi;

class RekapitulasiController extends Controller
{
    /* REKAPITULASI DATA */
    public function index(Request $request)
    {
        $fasyankesList = DataFasyankes::select('fasyankes')
            ->groupBy('fasyankes')
            ->orderBy('fasyankes', 'asc')
            ->get();

        $rekapitulasi = collect();

        if ($request->fasyankes && $request->jenis_data) {

            /* SEMUA DATA */
            if ($request->jenis_data == 'semua_data') {

                $rekapitulasi = DataLimbahMasuk::with('fasyankes')
                    ->whereHas('fasyankes', function ($q) use ($request) {
                        $q->where('fasyankes', $request->fasyankes);
                    })
                    ->orderBy('tanggal_penerimaan', 'asc')
                    ->get();
            }

            /* HASIL INSINERASI */
            if ($request->jenis_data == 'hasil_insinerasi') {

                $rekapitulasi = DataHasilInsinerasi::with([
                    'fasyankes',
                    'limbahMasuk'
                ])
                ->whereHas('fasyankes', function ($q) use ($request) {
                    $q->where('fasyankes', $request->fasyankes);
                })
                ->orderBy('tanggal_pemusnahan', 'asc')
                ->get();
            }
        }

        return view('manager.rekapitulasi', compact('fasyankesList','rekapitulasi'));
    }
}