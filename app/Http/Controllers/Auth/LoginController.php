<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /* ================= ADMIN ================= */

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            return back()->with('error', 'Email atau password salah!');
        }

        $request->session()->regenerate();

        if (Auth::user()->role !== 'admin') {
            Auth::logout();
            return back()->with('error', 'Akses khusus admin!');
        }

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    /* ================= USER ================= */

    public function showUserLoginForm()
    {
        return view('user.auth.login');
    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->with('error', 'Email atau password salah!');
        }

        $request->session()->regenerate();

        if (Auth::user()->role !== 'user') {
            Auth::logout();
            return back()->with('error', 'Login khusus user!');
        }

        return redirect()->route('home');
    }

    public function userLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/user/login');
    }

    /* ================= PRODUSEN ================= */

    public function showProdusenLoginForm()
    {
        return view('produsen.auth.login');
    }

    public function produsenLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->with('error', 'Email atau password salah!');
        }

        $request->session()->regenerate();

        if (Auth::user()->role !== 'produsen') {
            Auth::logout();
            return back()->with('error', 'Login khusus produsen!');
        }

        return redirect()->route('produsen.dashboard');
    }

   public function produsenLogout(Request $request)
{
    Auth::logout();
    
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    
    return redirect()->route('produsen.login')->with('success', 'Logout berhasil!');
}
}
