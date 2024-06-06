<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use DB;

use Auth;

class DemanderEscalader extends Mailable

{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $action)
    {
         
        $this->user = $user;
        $this->action = $action;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $text = 'demande d’escalader l\'action : ';
        $who_escalade = DB::table('agents')->where('id', $this->action->who_escalade)->first(); 
        
        return $this->subject($who_escalade->prenom. ', '. ' '.$text.  ' '. $this->action->libelle )->view('mail.demande_escalader', ['user' => $this->user , 'action' => $this->action]);
    }
}
