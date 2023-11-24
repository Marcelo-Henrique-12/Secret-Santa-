<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SorteioEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $participante;
    public $amigoSecreto;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($participante, $amigoSecreto)
    {
        $this->participante = $participante;
        $this->amigoSecreto = $amigoSecreto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.sorteio-email');
    }
}
