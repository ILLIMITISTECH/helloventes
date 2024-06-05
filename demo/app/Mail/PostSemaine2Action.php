<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use DB;

use Auth;

class PostSemaine2Action extends Mailable

{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $entreprise)
    {
         
        $this->user = $user;
        $this->entreprise = $entreprise;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $text = 'avez-vous clôturé vos actions';
       
        return $this->subject($this->user->prenom. ', '. ' '.$text )->view('mail.semaine2', ['user' => $this->user , 'entreprise' => $this->entreprise]);
    }
}
