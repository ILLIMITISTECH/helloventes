<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyFacilitateur extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($users, $fl, $entreprise, $sf)
    {
        $this->users = $users;
        $this->fl = $fl;
        $this->entreprise = $entreprise;
        $this->sf = $sf;
    }
   

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         $count = count($this->users) ; 
       $text = 'vos';
       $text2 = 'participants peuvent commencer les feedbacks !';
      $path2 = "- " ;
        return $this->subject($this->fl->prenom. ', '. ' '.$text. ' '.$count. ' '.$text2 )->view('mail.notifyfacilitateur', ['users'=> $this->users, 'fl'=> $this->fl, 'entreprise'=> $this->entreprise, 'sf'=> $this->sf]);
    }
}
