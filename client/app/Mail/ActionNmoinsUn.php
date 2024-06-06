<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActionNmoinsUn extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.   
     *
     * @return void
     */  
    public $sub;
    public $mes;
    public function __construct($subject, $mesage)
    {
        //
        $this->sub = $subject;
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
        return $this->subject("$e_subject")->view('mail.ActionNmoinsUn', compact("e_message"));
    }
}
