<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WinnerEmail extends Mailable
{
    use Queueable, SerializesModels;

    
    public $name;
    public $number;

    public function __construct($name, $number)
    {
        $this->name = $name;
        $this->number = $number;
    }

    public function build()
    {
        return $this->view('emails.winner')
            ->subject("Felicidades $this->name, eres el ganador")
            ->with(['name' => $this->name, 'number' => $this->number]);
    }
}
