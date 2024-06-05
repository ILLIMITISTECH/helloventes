<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RapportResponsable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($responsables)
    {
        $this->responsables = $responsables;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $text = 'le rapport global de votre équipe est disponible !';
       
        return $this->subject($this->responsables->prenom. ', '. ' '.$text )->view('mail.RapportResponsable', ['responsables'=> $this->responsables]);
    }
}
