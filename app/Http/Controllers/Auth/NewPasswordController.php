<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class NewPasswordController extends Controller
{
    public function create(Request $request)
    {
        return view('auth.reset-password', ['token' => $request->route('token')]);
    }

    public function store(Request $request)
    {
        // Validasi data
         $validator = Validator::make($request->all(), [
             'email' => ['required', 'email'],
             'password' => ['required', 'confirmed', 'min:8'],
             'token' => ['required'],
         ]);

         if ($validator->fails()) {
             return back()->withErrors($validator)->withInput();
         }

        $email = $request->input('email');
        $password = $request->input('password');
        $token = $request->input('token');
        
        // Update password user di tabel `users`
        DB::table('users')->where('email', $email)->update([
            'password' => Hash::make($password),
            'updated_at' => now(),
        ]);
        // Verifikasi token di tabel `password_reset_tokens`
        // $resetRecord = DB::table('password_reset_tokens')->where('email', $email)->where('token', $token)->first();

        // if (!$resetRecord) {
        //     return back()->withErrors(['email' => __('Invalid reset token or email.')]);
        // }

        // // Periksa waktu kedaluwarsa token (1 jam)
        // if (now()->diffInMinutes($resetRecord->created_at) > 60) {
        //     return back()->withErrors(['email' => __('The reset token has expired.')]);
        // }

        
       
        

        // Hapus token setelah reset berhasil
        
        //DB::table('password_reset_tokens')->where('email', $email)->delete();

        return redirect()->route('login');
    }
}
