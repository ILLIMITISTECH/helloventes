<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use DB;

use Auth;

class MailVente extends Mailable

{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($opportunite,$commercial, $vente)
    {
         
        $this->opportunite = $opportunite;
        $this->commercial = $commercial;
        $this->vente = $vente;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $bon = "Bonne nouvelle, ";
       $text = "vient de clôturer une opportunité sur HelloVentes";
       
        return $this->subject($bon. " ". $this->commercial->prenom." ".$text )->view('mail.mail_vente', ['commercial' => $this->commercial , 'opportunite' => $this->opportunite, 'vente' => $this->vente]);
    }
}
