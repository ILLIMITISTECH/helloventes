<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notifications\Messages\MailMessage;

use App\Notifications\BonDebutDeSemaine;
use Notification;
use App\Mail\RappelStatut5;

use App\User;
use DB;
use Auth;


class RappelStatut extends Command
{

    use Queueable;  
    /**
     * The name and signature of the console command.
     *
     * @var string  
     */
    //protected $signature = 'command:name';
    protected $signature = 'RappelStatut:day';

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
                $dates = date('Y/m/d');

        $users = User::all();
    
           
                $person = Auth::user();
               
                $op = DB::table('opportunites')->where('archiver', 0)->get();
                foreach($op as $opp){
                    $historique = DB::table('historiques')->where('opportunite_id', $opp->id)->orderBy('id', 'desc')->first();
                        $toD1 = now();
                        if($historique){
                        $toDurer = intval(abs(strtotime($toD1) - strtotime($historique->date_ajouter))/ 86400);
                        $duree = intval(abs(strtotime($historique->date_modifier) - strtotime($historique->date_ajouter))/ 86400);
                        
                        if($duree == 0){
                            if ($toDurer > 5){
                                $com = DB::table('commerciaus')->where('id', $opp->commercial_id )->first();
                                 $user = DB::table('users')->where('id', $com->user_id )->first();
                            session(['com' => $com, 'historique' => $historique ]);
                   
                            \Mail::to($user->email)->send(new RappelStatut5($user, $historique));
                            }
                        }
                        else{
                            if ($duree > 5){
                                $com = DB::table('commerciaus')->where('id', $opp->commercial_id )->first();
                                 $user = DB::table('users')->where('id', $com->user_id )->first();
                            session(['com' => $com, 'historique' => $historique]);
                   
                            \Mail::to($user->email)->send(new RappelStatut5($user, $historique));
                            }
                        }
                        }

               
               
                // $historiques = DB::table('historiques')->get();
                // foreach($historiques as $historique){
                //     $toD1 = now();
                //     $toDurer = intval(abs(strtotime($toD1) - strtotime($historique->date_ajouter))/ 86400);
                //     $duree = intval(abs(strtotime($historique->date_modifier) - strtotime($historique->date_ajouter))/ 86400);
                    
                //     $op = DB::table('opportunites')->where('id', $historique->opportunite_id)->first(); 
                //     if($duree == 0){
                //         if ($toDurer > 5){
                //         session(['user' => $user, 'historique' => $historique , 'op' => $op ]);
               
                //         \Mail::to($user->email)->send(new RappelStatut5($user, $historique, $op));
                //         }
                //     }
                //     else{
                        
                //         if ($duree > 5){
                //         session(['user' => $user, 'historique' => $historique , 'op' => $op ]);
               
                //         \Mail::to($user->email)->send(new RappelStatut5($user, $historique, $op));
                //         }
                //     }
                // }
                    
   
        }
         
        $this->info('Mail de rappel hebdomadaire envoyé');
    }

}