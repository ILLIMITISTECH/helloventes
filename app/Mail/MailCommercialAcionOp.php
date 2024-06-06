<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use DB;

use Auth;

class MailCommercialAcionOp extends Mailable

{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($commer, $action_op, $commercial)
    {
         
        $this->commer = $commer;
        $this->action_op = $action_op;
        $this->commercial = $commercial;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $text = 'votre collaborateur :'." ".$this->commercial->prenom." ".'vous a assigné une action sur HelloVente';
       
        return $this->subject($this->commer->prenom. ', '." ".$text )->view('mail.mail_commercial_action_op', ['commer' => $this->commer , 'action_op' => $this->action_op, 'commercial' => $this->commercial]);
    }
}
