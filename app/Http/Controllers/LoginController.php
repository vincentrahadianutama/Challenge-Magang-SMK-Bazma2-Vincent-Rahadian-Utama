<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Helpers\RecaptchaHelper;

class LoginController extends Controller
{
    /**
     * Handle the login request.
     */
    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'recaptcha_token' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Validasi ReCAPTCHA
        if (!RecaptchaHelper::validate($request->recaptcha_token)) {
            return back()->withErrors(['recaptcha' => 'ReCAPTCHA validation failed.'])->withInput();
        }

        // Coba login
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Regenerate session untuk menghindari session fixation
            $request->session()->regenerate();

            // Redirect ke dashboard atau halaman yang diinginkan
            return redirect()->intended('dashboard')->with('status', 'Login successful.');
        }

        // Jika login gagal
        return back()->withErrors(['email' => 'The provided credentials do not match our records.'])->withInput();
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        // Logout pengguna
        Auth::logout();

        // Regenerate session untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect('/login')->with('status', 'Logout successful.');
    }
}
