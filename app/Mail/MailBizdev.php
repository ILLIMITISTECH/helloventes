<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use DB;

use Auth;

class MailBizdev extends Mailable

{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($opportunite,$commercial_id)
    {
         
        $this->opportunite = $opportunite;
        $this->commercial_id = $commercial_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $text = "vient d'ajouter une opportunité sur HelloVentes";
       
        return $this->subject($this->commercial_id->prenom." ".$text )->view('mail.mail_bizdev', ['commercial_id' => $this->commercial_id , 'opportunite' => $this->opportunite]);
    }
}
