<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use DB;

use Auth;

class MailProsAffecter extends Mailable

{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($com,$me,$nbre_pros)
    {
        $this->me = $me;
        $this->com = $com;
        $this->nbre_pros = $nbre_pros;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $text = 'votre collaborateur :'." ".$this->me->prenom." ".'vous a affecté '." ".$this->nbre_pros." ".'prospects à appeler sur HelloVente';
       
        return $this->subject($this->com->prenom. ', '." ".$text )->view('mail.prospect_affecter', ['com' => $this->com , 'me' => $this->me, 'nbre_pros' => $this->nbre_pros]);
    }
}
