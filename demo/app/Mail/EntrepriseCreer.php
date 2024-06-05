<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EntrepriseCreer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $client)
    {
        $this->user = $user;
        $this->client = $client;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $text = 'Votre session de feedbacks est configurée';
      $path2 = "- " ;
        return $this->subject($text )->view('mail.entreprise_creer', ['user'=> $this->user, 'client'=> $this->client]);
    }
}
