<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use DB;

use Auth;

class MailBackupOp extends Mailable

{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($commercial, $opportunite, $commercialMe)
    {
         
        $this->commercial = $commercial;
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
       $text = 'votre collaborateur :'." ".$this->commercialMe->prenom." ".'vous a assigné une opportunité en backup sur HelloVentes';
       
        return $this->subject($this->commercial->prenom. ', '." ".$text )->view('mail.mail_backup_op', ['commercial' => $this->commercial , 'opportunite' => $this->opportunite, 'commercialMe' => $this->commercialMe]);
    }
}
