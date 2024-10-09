<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BuyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $date;
    public $numbers;

    public function __construct($numbers, $date)
    {
        $this->numbers = $numbers;
        $this->date = $date;
    }

    public function build()
    {
        return $this->view('emails.buy')
            ->subject("Numero comprados")
            ->with(['date' => $this->date, 'numbers' => $this->numbers]);
    }
}
