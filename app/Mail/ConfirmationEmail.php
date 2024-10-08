<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $link;

    public function __construct($name, $link)
    {
        $this->name = $name;
        $this->link = $link;
    }

    public function build()
    {
        return $this->view('emails.confirmation')
            ->subject('Confirmacion de correo')
            ->with(['name' => $this->name, 'link' => $this->link]);
    }
}
