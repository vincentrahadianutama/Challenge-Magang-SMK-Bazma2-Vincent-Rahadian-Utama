<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // Mendapatkan data pengguna dari Google
            $google_user = Socialite::driver('google')->stateless()->user();

            // Cari user berdasarkan email
            $user = User::where('email', $google_user->getEmail())->first();

            if ($user) {
                // Jika user ditemukan, perbarui google_id jika kosong
                if (!$user->google_id) {
                    $user->google_id = $google_user->getId();
                    $user->save();
                }
            } else {
                // Jika user tidak ditemukan, buat akun baru
                $user = User::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId(),
                    'password' => bcrypt('defaultpassword'), // Kata sandi default
                ]);
            }

            // Login user
            Auth::login($user);

            // Redirect ke dashboard
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            \Log::error('Google Login Error: ' . $e->getMessage());
            return redirect('/')->with('error', 'Terjadi kesalahan saat login menggunakan Google.');
        }
    }
}


