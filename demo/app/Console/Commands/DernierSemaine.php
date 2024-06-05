<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notifications\Messages\MailMessage;

use App\Notifications\BonDebutDeSemaine;
use App\Notifications\FinDeSemaine;
use App\Mail\PostSemaine2Action;

use Notification;


use Illuminate\Support\Facades\Mail;

use App\User;
use DB;
use session;
use Auth;


class DernierSemaine extends Command
{

    use Queueable;  
    /**
     * The name and signature of the console command.
     *
     * @var string  
     */
    //protected $signature = 'command:name';
    protected $signature = 'DernierWeek:day';

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
        $sources = DB::table('source_feedbacks')->where('statut', 1)->where('phase', 2)->get();
        foreach($sources as $source){
            $entreprises = DB::table('client_facilitateurs')->where('entreprise_id', $source->entreprise_id)->get();
        foreach($entreprises as $entreprise){
            $users = DB::table('users')->where('entreprise', $entreprise->entreprise_id)->get();
                
        foreach($users as $user){
            
           
             
            session(['user' => $user, 'entreprise' => $entreprise ]);
           
            \Mail::to($user->email)->send(new Semaine3Aide($user, $entreprise));
        }
        }
        }
           
        
        $this->info('Mail post-formation envoyé');
    }

}