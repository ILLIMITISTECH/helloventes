<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $password, $fl)
    {
        $this->user = $user;
        $this->password =  $password;
        $this->fl = $fl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $text = 'osez le feedback 360° !';
      $path2 = "- " ;
        return $this->subject($this->user->prenom. ', '. ' '.$text )->view('mail.sendpassword', ['user'=> $this->user, 'password'=> $this->password, 'fl'=> $this->fl]);
    }
}
