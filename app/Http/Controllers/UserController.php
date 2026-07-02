<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /* TAMPILKAN DATA USER */
    public function index()
    {
        $users = User::all();

        return view('admin.kelola-user', compact('users'));
    }

    /* HALAMAN TAMBAH USER */
    public function create()
    {
        return view('admin.add-user');
    }

    /* SIMPAN DATA USER */
    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'role'     => 'required'
        ]);

        User::create([
            'nama'     => $request->nama,
            'username' => $request->username,
            'password' => $request->password,
            'role'     => $request->role
        ]);

        return redirect('/kelolauser')->with('success', 'User berhasil ditambahkan');
    }

    /* HALAMAN EDIT USER */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.edit-user', compact('user'));
    }

    /* EDIT DATA USER */
    public function update(Request $request, $id)
    {
        $user = User::where('id_user', $id)->firstOrFail();

        $user->update([
            'nama'     => $request->nama,
            'username' => $request->username,
            'password' => $request->password,
            'role'     => $request->role
        ]);

        return redirect('/kelolauser')->with('success', 'User berhasil diupdate');
    }

    /* HAPUS DATA USER */

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect('/kelolauser')->with('success', 'User berhasil dihapus');
    }
}