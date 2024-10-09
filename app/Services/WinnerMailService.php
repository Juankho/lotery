<?php

namespace App\Services;

use App\Mail\WinnerEmail;
use Illuminate\Support\Facades\Mail;

class WinnerMailService
{
    public function index(string $email, string $userName, string $number)
    {

        Mail::to($email)->send(new WinnerEmail($userName, $number));

        return 'Correo enviado con éxito';
    }
}
