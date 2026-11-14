<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class C_AuthController extends Controller
{
    public function tampilRegis()
    {
        return view('backend.auth.regis');
    }

    public function registrasi(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'peran' => 'required|in:relawan,mitra',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'peran' => $data['peran'],
            'status_akun' => 'menunggu',
        ]);

        Auth::login($user);

        return $this->arahkanDashboard();
    }

    public function tampilLogin()
    {
        return view('backend.auth.login');
    }

    public function Login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($data)) {
            $request->session()->regenerate();

            return $this->arahkanDashboard();
        }

        return back()
            ->withErrors(['email' => 'Email atau password tidak sesuai.'])
            ->onlyInput('email');
    }

    public function Logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function arahkanDashboard()
    {
        $peran = Auth::user()->peran;

        return match ($peran) {
            'admin' => redirect()->route('admin.dashboard'),
            'relawan' => redirect()->route('relawan.dashboard'),
            'mitra' => redirect()->route('mitra.dashboard'),
            default => abort(403),
        };
    }
}
