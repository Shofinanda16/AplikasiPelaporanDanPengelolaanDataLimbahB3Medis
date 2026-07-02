<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLimbahMasuk;
use App\Models\DataFasyankes;
use App\Models\DataHasilInsinerasi;

class DataLimbahMasukController extends Controller
{
    /* TAMPILKAN DATA LIMBAH MASUK */
    public function index()
    {
        $limbahMasuk = DataLimbahMasuk::where('status', '!=', 'dimusnahkan')->get();

        return view('staf.limbah-masuk', compact('limbahMasuk'));
    }

    /* HALAMAN TAMBAH LIMBAH MASUK */
    public function create()
    {
        $fasyankes = DataFasyankes::all();

        return view('staf.add-limbah-masuk', compact('fasyankes'));
    }

    /* SIMPAN DATA LIMBAH MASUK */
    public function store(Request $request)
    {
        try {

            $request->validate([
                'tanggal_pengangkutan'      => 'required',
                'tanggal_penerimaan'        => 'required',
                'tanggal_batas_penyimpanan' => 'required',
                'id_data_fasyankes'         => 'required',
                'kode_cust'                 => 'required',
                'no_polisi'                 => 'required',
                'driver'                    => 'required',
                'kemasan'                   => 'required',
                'satuan'                    => 'required',
                'jumlah_limbah'             => 'required'
            ]);

            $jumlah = str_replace('.', '', $request->jumlah_limbah);
            $jumlah = str_replace(',', '.', $jumlah);

            DataLimbahMasuk::create([
                'id_data_fasyankes'         => $request->id_data_fasyankes,
                'tanggal_pengangkutan'      => $request->tanggal_pengangkutan,
                'tanggal_penerimaan'        => $request->tanggal_penerimaan,
                'tanggal_batas_penyimpanan' => $request->tanggal_batas_penyimpanan,
                'kode_cust'                 => $request->kode_cust,
                'no_polisi'                 => $request->no_polisi,
                'driver'                    => $request->driver,
                'kemasan'                   => $request->kemasan,
                'satuan'                    => $request->satuan,
                'jumlah_limbah'             => $jumlah,
                'status'                    => 'pending'
            ]);

            return redirect('/limbah-masuk')
                ->with('success', 'Data limbah masuk berhasil ditambahkan');

        } catch (\Exception $e) {

            dd($e->getMessage());
        }
    }

    /* HALAMAN EDIT LIMBAH MASUK */
    public function edit($id)
    {
        $limbah = DataLimbahMasuk::findOrFail($id);
        $fasyankes = DataFasyankes::all();

        return view('staf.edit-limbah-masuk', compact('limbah','fasyankes'));
    }

    /* UPDATE DATA LIMBAH MASUK */

    public function update(Request $request, $id)
    {
        $limbah = DataLimbahMasuk::findOrFail($id);
        $jumlah = str_replace('.', '', $request->jumlah_limbah);
        $jumlah = str_replace(',', '.', $jumlah);

        $limbah->update([
            'id_data_fasyankes'         => $request->id_data_fasyankes,
            'tanggal_pengangkutan'      => $request->tanggal_pengangkutan,
            'tanggal_penerimaan'        => $request->tanggal_penerimaan,
            'tanggal_batas_penyimpanan' => $request->tanggal_batas_penyimpanan,
            'kode_cust'                 => $request->kode_cust,
            'no_polisi'                 => $request->no_polisi,
            'driver'                    => $request->driver,
            'kemasan'                   => $request->kemasan,
            'satuan'                    => $request->satuan,
            'jumlah_limbah'             => $jumlah
        ]);

        return redirect('/limbah-masuk')->with('success', 'Data limbah masuk berhasil diupdate');
    }

    /* HAPUS DATA LIMBAH MASUK */
    public function destroy($id)
    {
        $limbah = DataLimbahMasuk::findOrFail($id);
        $limbah->delete();

        return redirect('/limbah-masuk')->with('success', 'Data limbah masuk berhasil dihapus');
    }

    /* UPDATE STATUS LIMBAH */
    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required']);
        $limbah = DataLimbahMasuk::findOrFail($id);
        $limbah->update(['status' => $request->status]);

        if ($request->status == 'dimusnahkan') {

            DataHasilInsinerasi::updateOrCreate(
                ['id_limbah_medis' => $limbah->id_limbah_medis],
                ['id_data_fasyankes' => $limbah->id_data_fasyankes,
                 'id_limbah_medis'   => $limbah->id_limbah_medis,
                 'tanggal_pemusnahan'=> now()
                ]
            );
        }

        return redirect('/petugas-limbah-masuk')->with('success', 'Status limbah berhasil diperbarui');
    }

    /* DATA LIMBAH MASUK PETUGAS */
    public function petugasIndex()
    {
        $limbahMasuk = DataLimbahMasuk::where('status', '!=', 'dimusnahkan')->get();

        return view('petugas.limbah-masuk', compact('limbahMasuk'));
    }
}