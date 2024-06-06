<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Mail\Moins2Jours;

use Illuminate\Support\Facades\Mail;
use Notification;

use App\User;
use DB;
use Auth;


class MoinsDeuxDay extends Command
{

    use Queueable;  
    /**
     * The name and signature of the console command.
     *
     * @var string  
     */
    //protected $signature = 'command:name';
    protected $signature = 'Deux:Jours';

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
        

        $users = User::all();
        $dates = date('Y/m/d');
        $strotime_deadline = strtotime($dates .'+' . 2 . ' days');
        $date_plus2 = date('Y-m-d', $strotime_deadline);

        foreach($users as $user){
            Auth::login($user);
            //$user->notify(new BonDebutDeSemaine());
                $person = Auth::user();
               
                $actions = DB::table('action_commerciales')->select('action_commerciales.*','commerciaus.prenom', 'commerciaus.nom')
                    ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
                     ->where('action_commerciales.cloture', 0)
                    ->where('action_commerciales.deadline', $date_plus2)
                    ->where('commerciaus.user_id', $user->id)
                    ->orderBy('action_commerciales.deadline', 'ASC')
                    ->get();
                    
                    if ($actions->count() > 0){
                    session(['user' => $user, 'actions' => $actions ]);
           
                    \Mail::to($user->email)->send(new Moins2Jours($user, $actions));
                    }
         
        }
        $this->info('Mail de rappel hebdomadaire envoyé');
    }

}