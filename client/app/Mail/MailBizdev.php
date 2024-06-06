<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use DB;

use Auth;

class MailBizdev extends Mailable

{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($opportunite,$commercial_id)
    {
         
        $this->opportunite = $opportunite;
        $this->commercial_id = $commercial_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $prost = DB::table('prospects')->where('id', $this->opportunite->prospect_id)->first();
       $deadlline = $this->opportunite->deadline;
       $prenom = $this->commercial_id->prenom;
       $text = "Nouvelle opportunité de";
       $sub = $text." "." ".$prenom." "."|"." ".$prost->nom_entreprise." "."|"." ".$deadlline;
       
        return $this->subject($sub)->view('mail.mail_bizdev', ['commercial_id' => $this->commercial_id , 'opportunite' => $this->opportunite]);
    }
}
