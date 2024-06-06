<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use DB;

use Auth;

class MailObjectif extends Mailable

{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $com)
    {
         
        $this->user = $user;
        $this->com = $com;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $text = 'Vos objectifs du mois';
       
        return $this->subject($text )->view('mail.mail_objectifs', ['user' => $this->user , 'com' => $this->com]);
    }
}
