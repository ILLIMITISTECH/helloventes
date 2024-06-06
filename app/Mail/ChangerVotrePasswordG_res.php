<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangerVotrePasswordG_res extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $text = 'veuiller modifier votre mot de passe';
      $path2 = "- " ;
        return $this->subject($this->user->prenom. ",". " " . $text )->view('mail.modifier_password', ['user'=> $this->user]);
    }
}
