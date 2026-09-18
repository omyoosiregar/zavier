<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses login user.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Proses autentikasi
        $request->authenticate();

        // Regenerasi session untuk keamanan
        $request->session()->regenerate();

        // Ambil user yang berhasil login
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | REDIRECT BERDASARKAN ROLE
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'super_admin') {

            return redirect()->route('admin.dashboard');

        }

        if ($user->role === 'murid') {

            return redirect()->route('murid.dashboard');

        }

        if ($user->role === 'mentor') {

            // Sementara kita arahkan ke dashboard default
            return redirect()->route('dashboard');

        }

        /*
        |--------------------------------------------------------------------------
        | JIKA ROLE TIDAK DIKENAL
        |--------------------------------------------------------------------------
        */

        return redirect()->route('dashboard');
    }

    /**
     * Logout.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}