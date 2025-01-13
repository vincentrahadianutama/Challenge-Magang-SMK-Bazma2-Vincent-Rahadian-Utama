<?php

// app/Helpers/RecaptchaHelper.php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class RecaptchaHelper
{
    public static function validate($token)
    {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $token,
        ]);

        $responseBody = $response->json();
        return $responseBody['success'] ?? false;
    }
}
