<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function create(): View
    {
        // dd(Auth::user());
        return view('auth.login');
    }

    /**
     * Proses login user.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $login = $request->only('email', 'password');

        if (Auth::guard("web")->attempt($login)) {
            $request->session()->regenerate();

            // DEBUG: Pastikan login berhasil dan user terautentikasi
            //dd('Login berhasil', Auth::user());

            return redirect()->route('home')->with('success', 'Login berhasil! Selamat datang kembali!');
        } else {
            // DEBUG: Login gagal, tampilkan data input
            //dd('Login gagal', $login);

            return redirect()->route('login')->with('failed', 'Login gagal!');
        }
    }


    /**
     * Logout user.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Anda telah logout.');
    }
}

