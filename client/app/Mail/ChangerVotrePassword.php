<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangerVotrePassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.   
     *
     * @return void
     */  
    public $sub;
    public $mes;
    public $prenoms;
    public function __construct($subject, $message, $name )
    {
        //
        $this->sub = $subject;
        $this->mes = $message;
        $this->prenoms = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $e_message = $this->mes;
        $first_name = $this->prenoms;
        return $this->subject("veuiller modifier votre mot de passe")->view('mail.Relancer_password', compact("e_message", "first_name" ));
    }
}
