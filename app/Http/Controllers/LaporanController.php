<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLimbahMasuk;
use App\Models\DataHasilInsinerasi;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    /* LAPORAN STAF */
    public function laporanStaf(Request $request)
    {
        $bulan = $request->bulan;
        $jenisData = $request->jenis_limbah;
        $laporan = collect();

        if ($bulan && $jenisData) {
            $laporan = $jenisData == 'limbah_masuk'
                ? $this->getLimbahMasuk($bulan)
                : $this->getLimbahKeluar($bulan);
        }

        return view('staf.laporan-staf',compact('laporan', 'bulan', 'jenisData'));
    }

    /* DOWNLOAD LAPORAN STAF */
    public function downloadLaporanStaf(Request $request)
    {
        $bulan = $request->bulan;
        $jenisData = $request->jenis_limbah;

        $laporan = $jenisData == 'limbah_masuk'
            ? $this->getLimbahMasuk($bulan)
            : $this->getLimbahKeluar($bulan);

        $pdf = Pdf::loadView(
            'staf.download-laporan-staf',
            compact('laporan', 'bulan', 'jenisData')
        )->setPaper('A4', 'landscape');

        return $pdf->download($this->buatNamaFileLaporan($jenisData, $bulan));
    }

    /* LAPORAN MANAGER */
    public function laporanManager(Request $request)
    {
        $bulan = $request->bulan;
        $jenisData = $request->jenis_limbah;
        $laporan = collect();

        if ($bulan && $jenisData) {
            $laporan = $jenisData == 'limbah_masuk'
                ? $this->getLimbahMasuk($bulan)
                : $this->getLimbahKeluar($bulan);
        }

        return view('manager.laporan',compact('laporan', 'bulan', 'jenisData'));
    }

    /* DOWNLOAD LAPORAN MANAGER */
    public function downloadLaporanManager(Request $request)
    {
        $bulan = $request->bulan;
        $jenisData = $request->jenis_limbah;

        $laporan = $jenisData == 'limbah_masuk'
            ? $this->getLimbahMasuk($bulan)
            : $this->getLimbahKeluar($bulan);

        $pdf = Pdf::loadView(
            'manager.download-laporan-manager',
            compact('laporan', 'bulan', 'jenisData')
        )->setPaper('A4', 'landscape');

        return $pdf->download($this->buatNamaFileLaporan($jenisData, $bulan));
    }

    /* DATA LIMBAH MASUK */
    private function getLimbahMasuk($bulan)
    {
        return DataLimbahMasuk::whereMonth(
                'tanggal_penerimaan',
                date('m', strtotime($bulan))
            )
            ->whereYear(
                'tanggal_penerimaan',
                date('Y', strtotime($bulan))
            )
            ->get();
    }

    /* DATA HASIL INSINERASI */
    private function getLimbahKeluar($bulan)
    {
        return DataHasilInsinerasi::with([
                'fasyankes',
                'limbahMasuk'
            ])
            ->whereMonth(
                'tanggal_pemusnahan',
                date('m', strtotime($bulan))
            )
            ->whereYear(
                'tanggal_pemusnahan',
                date('Y', strtotime($bulan))
            )
            ->get();
    }

    /* NAMA FILE PDF */
    private function buatNamaFileLaporan($jenisData, $bulan)
    {
        $namaJenis = $jenisData == 'limbah_masuk'
            ? 'limbah masuk'
            : 'hasil insinerasi';

        return 'laporan '
            . $namaJenis
            . ' bulan '
            . date('F Y', strtotime($bulan))
            . '.pdf';
    }
}