<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActionEscalader extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.   
     *
     * @return void
     */  
    public $sub;
    public $mes;
    public function __construct($sujet, $mesage)
    {
        //
        $this->sub = $sujet;
        $this->mes = $mesage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $e_subject = $this->sub;
        $e_message = $this->mes;
        return $this->subject("$e_subject")->view('mail.ActionEscalader', compact("e_message"));
    }
}
