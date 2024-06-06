<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use DB;

use Auth;

class Moins2Jours extends Mailable

{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $actions)
    {
         
        $this->user = $user;
        $this->actions = $actions;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $text = 'votre action arrivera à échéance dans 2 jours  !';
       
        return $this->subject($this->user->prenom. ', '. ' '.$text )->view('mail.Dmoins2jours', ['user' => $this->user , 'actions' => $this->actions]);
    }
}
