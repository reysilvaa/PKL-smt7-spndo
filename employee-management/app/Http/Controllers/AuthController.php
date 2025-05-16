<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('employees.index');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function dashboard()
    {
        if (Auth::user()->role === 'admin') {
            return view('dashboard.admin');
        } else {
            return view('dashboard.guest');
        }
    }
}
