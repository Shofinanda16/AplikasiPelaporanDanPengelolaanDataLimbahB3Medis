<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginProcess(Request $request)
    {
        /* VALIDASI LOGIN */

        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role'     => 'required'
        ]);

        /* CEK USERNAME */

        $usernameExists = User::whereRaw(
            'BINARY username = ?',
            [$request->username]
        )->exists();

        /* CEK PASSWORD */

        $passwordExists = User::whereRaw(
            'BINARY password = ?',
            [$request->password]
        )->exists();

        /* USERNAME + PASSWORD SALAH */

        if (!$usernameExists && !$passwordExists) {

            return back()
                ->withInput()
                ->with('login_error', 'Username dan password salah');
        }

        /* USERNAME SALAH */

        if (!$usernameExists) {

            return back()
                ->withInput()
                ->with('login_error', 'Username salah');
        }

        /* PASSWORD SALAH */

        if (!$passwordExists) {

            return back()
                ->withInput()
                ->with('login_error', 'Password salah');
        }

        /* LOGIN USER */

        $user = User::whereRaw(
            'BINARY username = ? AND BINARY password = ?',
            [
                $request->username,
                $request->password
            ]
        )->first();

        if (!$user) {

            return back()
                ->withInput()
                ->with('login_error', 'Data login tidak sesuai');
        }

        /* CEK ROLE */

        if ($user->role != $request->role) {

            return back()
                ->withInput()
                ->with('login_error', 'Role tidak sesuai');
        }

        /* AUTH LOGIN */

        Auth::login($user);

        $request->session()->regenerate();

        /* REDIRECT BERDASARKAN ROLE */

        if ($user->role == 'staf') {
            return redirect('/dashboard-staf');
        }

        if ($user->role == 'petugas') {
            return redirect('/dashboard-petugas');
        }

        if ($user->role == 'manager') {
            return redirect('/dashboard-manager');
        }

        if ($user->role == 'admin') {
            return redirect('/dashboard-admin');
        }

        return redirect('/login');
    }
}