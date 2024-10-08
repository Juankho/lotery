<?php

namespace App\Services;

use App\Mail\ConfirmationEmail;
use Illuminate\Support\Facades\Mail;

class ConfirmationMailService
{
    public function index(string $email, string $userName, string $link)
    {
        Mail::to($email)->send(new ConfirmationEmail($userName, $link));

        return 'Correo enviado con éxito';
    }
}
