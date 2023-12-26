<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        Log::info('Credentials: ' . json_encode($credentials));

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->withSuccess('Logged-in');
        } else {
            Log::info('Login attempt failed');
            return back()->withErrors([
                'password' => 'Wrong username or password',
            ]);
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
