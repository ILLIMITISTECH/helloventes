<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use DB;

use Auth;

class MailMaj extends Mailable

{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($commercial_res, $opportunite, $commercialMe)
    {
         
        $this->commercial_res = $commercial_res;
        $this->opportunite = $opportunite;
        $this->commercialMe = $commercialMe;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $text = 'votre collaborateur :'." ".$this->commercialMe->prenom." ".'vient de mettre a jour une opportunité sur HelloVentes';
       
        return $this->subject($this->commercial_res->prenom. ', '." ".$text )->view('mail.mail_maj', ['commercial_res' => $this->commercial_res , 'opportunite' => $this->opportunite, 'commercialMe' => $this->commercialMe]);
    }
}
