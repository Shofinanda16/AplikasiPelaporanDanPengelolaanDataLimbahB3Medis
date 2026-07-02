<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataFasyankes;
use Illuminate\Support\Facades\Auth;

class DataFasyankesController extends Controller
{
    /* TAMPILKAN DATA FASYANKES */
    public function index()
    {
        $fasyankes = DataFasyankes::all();
        return view('staf.fasyankes', compact('fasyankes'));
    }

    /* HALAMAN TAMBAH FASYANKES */
    public function create()
    {
        return view('staf.add-fasyankes');
    }

    /* SIMPAN DATA FASYANKES */
    public function store(Request $request)
    {
        $request->validate([
            'fasyankes'    => 'required',
            'kode_limbah'  => 'required',
            'jenis_limbah' => 'required',
            'manifest'     => 'required'
        ]);

        DataFasyankes::create([
            'id_user'      => Auth::user()->id_user,
            'fasyankes'    => $request->fasyankes,
            'kode_limbah'  => $request->kode_limbah,
            'jenis_limbah' => $request->jenis_limbah,
            'manifest'     => $request->manifest
        ]);

        return redirect('/fasyankes')->with('success', 'Data fasyankes berhasil ditambahkan');
    }

    /* HALAMAN EDIT FASYANKES */
    public function edit($id)
    {
        $fasyankes = DataFasyankes::findOrFail($id);

        return view('staf.edit-fasyankes', compact('fasyankes'));
    }

    /* UPDATE DATA FASYANKES */
    public function update(Request $request, $id_data_fasyankes)
    {
        $request->validate([
            'fasyankes'    => 'required',
            'kode_limbah'  => 'required',
            'jenis_limbah' => 'required',
            'manifest'     => 'required'
        ]);

        $fasyankes = DataFasyankes::findOrFail($id_data_fasyankes);

        $fasyankes->update([
            'fasyankes'    => $request->fasyankes,
            'kode_limbah'  => $request->kode_limbah,
            'jenis_limbah' => $request->jenis_limbah,
            'manifest'     => $request->manifest
        ]);

        return redirect('/fasyankes')->with('success', 'Data fasyankes berhasil diupdate');
    }

    /* HAPUS DATA FASYANKES */
    public function destroy($id)
    {
        $fasyankes = DataFasyankes::findOrFail($id);
        $fasyankes->delete();
        return redirect('/fasyankes')->with('success', 'Data fasyankes berhasil dihapus');
    }
}