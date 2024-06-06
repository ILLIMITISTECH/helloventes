<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use DB;

use Auth;

class RappelStatut5 extends Mailable

{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $historique)
    {
         
        $this->user = $user;
        $this->historique = $historique;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $text = 'votre statut ne bouge pas !';
       
        return $this->subject($this->user->prenom. ', '. ' '.$text )->view('mail.rappelstatut', ['user' => $this->user , 'historique' => $this->historique]);
    }
}
