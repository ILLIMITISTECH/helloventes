<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use DB;

use Auth;

class MailCommercial extends Mailable

{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($commercial, $action, $commercialMe)
    {
         
        $this->commercial = $commercial;
        $this->action = $action;
        $this->commercialMe = $commercialMe;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $text = 'votre collaborateur :'." ".$this->commercialMe->prenom." ".'vous a assigné une action sur HelloVente';
       
        return $this->subject($this->commercial->prenom. ', '." ".$text )->view('mail.mail_commercial', ['commercial' => $this->commercial , 'action' => $this->action, 'commercialMe' => $this->commercialMe]);
    }
}
