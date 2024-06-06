<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use DB;

use Auth;

class MailBackupAtionM extends Mailable

{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($commercial, $opportunite, $commercialMe, $updateActionCommercial)
    {
         
        $this->commercial = $commercial;
        $this->opportunite = $opportunite;
        $this->commercialMe = $commercialMe;
        $this->updateActionCommercial = $updateActionCommercial;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $text = 'votre collaborateur :'." ".$this->updateActionCommercial->prenom." "."a modifié l'action :"." ".$this->commercialMe->libelle;
       
        return $this->subject($this->commercial->prenom. ', '." ".$text )->view('mail.mail_action_modif', ['updateActionCommercial' => $this->updateActionCommercial , 'commercial' => $this->commercial , 'opportunite' => $this->opportunite, 'commercialMe' => $this->commercialMe]);
    }
}
