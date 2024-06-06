<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;

use Illuminate\Support\Facades\Mail;
use Session;

use App\Action;

use Auth;

use App\User;
use App\Agent;
use DB;

use App\Notifications\EscalationAction;
use App\Notifications\EscalationActionResponsable;
use App\Notifications\AlerteEscalation;
use Notification;

class Stra extends Command
    {
    /**
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = "stra:update";
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mise a jour de  l activitée';
    
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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    { 
    
        $date_today = now();
        $this_week = (date('d') - 8);
        $today = date('Y-m-d');
        $agent_moiss = DB::table('agents')->get();                                                     
            $cumul_delay=0;

                           
            foreach($agent_moiss as $agent_mois)
            {           
            $action_agents_mois_sum = DB::table('actions')->select('actions.*')->where('actions.agent_id', $agent_mois->id)
                                                                                ->where('actions.deadline','>=',$this_week)->orWhere('actions.deadline','<=',$today)
                                                                                ->sum('actions.pourcentage');
                                                                                
            $action_agents_mois_countss = DB::table('actions')->select('actions.*')->where('actions.agent_id', $agent_mois->id)
                                                                                   ->where('actions.deadline','>=',$this_week)->orWhere('actions.deadline','<=',$today)
                                                                                   ->count();
                             
            $total_pourcentage = $action_agents_mois_countss == 0 ? 0 : $action_agents_mois_sum / $action_agents_mois_countss;

            $actionsJourRetard = DB::table('actions')->where('agent_id', $agent_mois->id)->where('pourcentage', '!=', 100)
                                                     ->where('actions.deadline','>=',$this_week)->orWhere('actions.deadline','<=',$today)
                                                     ->get();
            foreach ($actionsJourRetard as $actionsRetard)
            {
                $cumul_delay += intval(abs(strtotime("now") - strtotime($actionsRetard->deadline))/ 86400);
            }
            
            $actionsClot = DB::table('actions')->where('agent_id', $agent_mois->id)->where('pourcentage', 100)->where('deadline','>=',$this_week)->count();
            $actionsOuvert = DB::table('actions')->where('agent_id', $agent_mois->id)->where('pourcentage','!=', 100)->where('deadline','>=',$this_week)->count();
            
            DB::table('performances')->insert(['agent_id' => $agent_mois->id, 'sommes' => $total_pourcentage, 'retard'=>$cumul_delay,'action_cloturer'=>$actionsClot,'action_ouvert'=> $actionsOuvert,'semaine' => 1,  'created_at' => $date_today, 'updated_at' => $date_today]);
                             
            }
    
        $this->info('L\'escalation a été faite');
    }
    
}
