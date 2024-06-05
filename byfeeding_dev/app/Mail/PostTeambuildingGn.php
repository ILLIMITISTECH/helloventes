<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use DB;

use Auth;

class PostTeambuildingGn extends Mailable

{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $entreprise, $source)
    {
         
        $this->user = $user;
        $this->entreprise = $entreprise;
        $this->source = $source;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $text = 'Nourrissez-vous de vos feedbacks';
       
        return $this->subject($text )->view('mail.semaine1', ['user' => $this->user , 'entreprise' => $this->entreprise, 'source' => $this->source]);
    }
}
