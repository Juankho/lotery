<?php

namespace App\Services;

use App\Mail\BuyEmail;
use App\Mail\WinnerEmail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class BuyMailService
{
    public function index(string $email, array $numbers, string $date)
    {

        Mail::to($email)->send(new BuyEmail($numbers, $date));

        return 'Correo enviado con éxito';
    }
}
