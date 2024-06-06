<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notifications\Messages\MailMessage;

use App\Notifications\BonDebutDeSemaine;
use Notification;
use App\Mail\RappelStatut5;
use App\Mail\RecapOpportunite;

use App\User;
use App\Commerciau;
use DB;
use Auth;
use Mail;


class Recap extends Command
{

    use Queueable;  
    /**
     * The name and signature of the console command.
     *
     * @var string  
     */
    //protected $signature = 'command:name';
    protected $signature = 'recap:day';

    /**
     * The console command description.  
     *
     * @var string
     */
    //protected $description = 'Command description';
    protected $description = 'Envoyer un e-mail quotidien à tous les utilisateurs pour un rappel de leurs actions en instance';

    /**
     * Create a new command instance.
     *
     * @return void  
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];  
    }  

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    

    public function handle()
    {
        $dates = date('Y-m-d');

        $users = DB::table('commerciaus')
        ->select('commerciaus.id', 'commerciaus.prenom', 'commerciaus.nom', 'commerciaus.email', 'commerciaus.objectif_mois')
       
        ->get();
    
          
                $person = Auth::user();
             foreach($users as $user){
                // $opportunites = DB::table('opportunites')->select('opportunites.*', 'prospects.id', 'prospects.nom_entreprise')
                // ->join('prospects', 'prospects.id', 'opportunites.prospect_id')
                // ->where('opportunites.deadline', '>=', $dates)
                // ->where('opportunites.commercial_id', $user->id)
                // ->where('opportunites.archiver', 0)
                // ->get();
               
                \Mail::to($user->email)->send(new RecapOpportunite($user));
               
                    
   
        }
         
        $this->info('Mail de rappel hebdomadaire envoyé');
    }

}