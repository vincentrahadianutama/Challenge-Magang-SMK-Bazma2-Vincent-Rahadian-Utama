<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use Illuminate\Http\Request;

class SendEmailController extends Controller
{
    public function index()
    {
        return view('kirim-email');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $emails = explode(',', $data['email']); // Memisahkan email berdasarkan koma
        $emails = array_map('trim', $emails); // Membersihkan spasi berlebih

        foreach ($emails as $email) {
            $data['email'] = $email; // Menyesuaikan email tujuan
            dispatch(new SendMailJob($data)); // Mengirimkan job untuk setiap email
        }

        return redirect()->route('kirim-email')->with('status', 'Email berhasil dikirim ke semua tujuan.');
    }

}