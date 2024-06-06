<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use DB;

use Auth;

class ResponEscaladerAccepter extends Mailable

{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_respon, $action, $superieur)
    {
         
        $this->user_respon = $user_respon;
        $this->action = $action;
        $this->superieur = $superieur;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $text = 'a accepté votre demande d’escalader : ';
       $deadline = date('d/m', strtotime($this->action->deadline));
       
        return $this->subject("Action : ". $this->action->libelle . ' - ' . $deadline)->view('mail.respon_escalade_accepter', ['superieur' => $this->superieur ,'user_respon' => $this->user_respon , 'action' => $this->action]);
    }
}
