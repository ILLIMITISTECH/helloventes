<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Phase2 extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $password, $sf)
    {
        $this->user = $user;
        $this->sf = $sf;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    
    public function build()
    {
       $text = 'votre rapport de feedback 360° est disponible !';
       return $this->subject($this->user->prenom. ', '. ' '.$text )->view('mail.phase2', ['user'=> $this->user, 'password'=> $this->password, 'sf'=> $this->sf]);
    }
}
