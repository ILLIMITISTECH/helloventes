<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notifications\Messages\MailMessage;

use App\Notifications\BonDebutDeSemaine;
use Notification;

use App\User;
use DB;
use Auth;


class WordOfTheDay extends Command
{

    use Queueable;  
    /**
     * The name and signature of the console command.
     *
     * @var string  
     */
    //protected $signature = 'command:name';
    protected $signature = 'word:day';

    /**
     * The console command description.  
     *
     * @var string
     */
    //protected $description = 'Command description';
    protected $description = 'Envoyer un e-mail quotidien à tous les utilisateurs pour un rappel de leurs modeles en instance';

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
        $nowme = now();
         foreach($users as $user){
            Auth::login($user);
            //$user->notify(new BonDebutDeSemaine());
                $person = Auth::user();
                $action_semaineM7 = (date('d') -7);
                $action_semaineP7 = (date('d') +7);
                $action_mois = date('m');
                $action_responss = array();
               
               $actions = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.agent_id', 'actions.libelle',
                  'actions.bakup', 'actions.pourcentage','actions.created_at',
                  'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id'
                    )
                    ->join('agents', 'agents.id', 'actions.agent_id')
                    ->where('actions.agent_id','=', $person->id)
                    //->orWhere('actions.backup','=', $person->id)
                    ->get();
                $action_responsf = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.responsable',
                                'actions.libelle', 'actions.note',
                                'actions.agent_id','actions.reunion_id','actions.raison',  'actions.visibilite','actions.bakup',
                                'actions.risque', 'actions.delais','actions.pourcentage', 'actions.note','actions.created_at',
                                'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id','directions.nom_direction'
                                )
                                ->join('agents', 'agents.id', 'actions.agent_id')
                                ->leftjoin('directions', 'directions.id', 'agents.direction_id')
                                ->where('actions.agent_id','=', $user->id)
                               // ->where('actions.bakup','=', $users->full_name)
                                 ->orderBy('actions.deadline', 'ASC')
                                ->get();
                                foreach($action_responsf as $action_respf)
                                {
                                    if(($action_semaineP7 >= date('d', strtotime($action_respf->deadline))) && ($action_semaineM7 <= date('d', strtotime($action_respf->deadline))) && ($action_mois == date('m', strtotime($action_respf->deadline))))
                                    {
                                        array_push($action_responss, $action_respf);
                                    }
                                }
                    
                //$taches = DB::table('tache_actions')->select('tache_actions.id', 'tache_actions.deadline', 'tache_actions.res_dir', 'tache_actions.libelle',
                // 'tache_actions.created_at','tache_actions.statut'
                   // )
                    //->join('agents', 'agents.id', 'tache_actions.res_dir')
                    //->where('tache_actions.res_dir','=', $person->id)
                    //->orWhere('actions.backup','=', $person->id)
                    //->get();
                    //$params = ["user" => $person, "indicateurs" => $indicateurs];
                 //foreach($indicateurs as $indicateur){   
                         
                   //$libelle = $indicateur->libelle;
                   //$cible = $indicateur->cible;
                   //$valeur = $indicateur->valeur_prec;
                   
                // }
                $prenom = $user->prenom;
                $to = "$user->email";
                $subject = "Bon début de semaine";
                           
                            $body = "
<!doctype html>

<html>
  <Head></Head>
  <Body>
    <div style='  background: white;   box-sizing: border-box;   color: black;      font-family: Roboto,Arial,sans-serif;   margin: 0 auto;   min-width: 320px;   max-width: 458px;   text-align: center; '>
      <div style=' border: 1px solid #dadce0;   border-radius: 8px;   margin-bottom: 8px;'>
        <div style=' padding: 24px 8px;'>
       <img src='https://illimitis.collaboratis.com/v2/assets/images/logocollaboratis.png' alt='homepage' class='dark-logo' style='max-width: 80%;'><br><br>
          <div style='  font-size: 20px;   font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   font-weight: 500;   line-height: 28px;   padding: 0 8px 20px; color:black;'>Bon début de la semaine $prenom ! <br>“Le boost de votre performance individuelle et collective”</div>
          
          <br>
      
        <div style=' padding: 24px 16px 32px;'>
          
          <div style='font-size:16px;   font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   line-height: 28px;   padding: 0 8px;color:black'>“Il n’y a pas de vent favorable pour celui qui ne sait pas où il va”. Voici le récapitulatif des actions sur lesquelles tu interviens cette semaine :  </div>
         <br><br><br>
         
         
          
          <div style='border: 1px solid #dadce0;   border-radius: 8px;   box-sizing: border-box;   margin: 0 auto 28px;   max-width: 578px;   padding: 16px;'>
            <div style='color: black;   display: flex;   font-size: 12px;   letter-spacing: 0.3px;   line-height: 16px;'>
              <div style=' margin-right: auto;'><b>Libellé</b></div>
              <div style='max-width:100x; '><b>Retard </b></div>
            </div>
            <div style=' padding-top: 12px; display: flex;text-align:left;color:black;'>";
        
                                                         foreach($action_responss as $action)
                                                        {
                                                       
                                                            if($action->pourcentage < 100) {
                                                             $cql = intval(abs(strtotime($nowme) - strtotime($action->deadline))/ 86400); 
                                                            $body .=" 
                                                                 <tr>
                                                                <td>".$action->libelle."</td> 
                                                                
                                                                <td>
                                                                <div style='border-radius: 8px;   color: black;   height: 56px;   line-height: 56px;   margin: auto 0;   min-width: 56px;    background: #8ab4f8; '>&emsp;".$cql." jrs</div>
                                                                </td>
                                                                
                                                                </tr>
                                                                
                                                            ";
                                                            }
                                                        
                                                        }
                                                        
                                                        $body .= "
             
              
           
         
         
    
     
       </div></div></div> 
         
            <div>
              <a href='https://illimitis.collaboratis.com' style=' background: #1a73e8;   border-radius: 4px;   color: #ffffff;   display: inline-block;   font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   font-weight: 500;   letter-spacing: 0.25px;   line-height: 16px;   margin-bottom: 12px;   padding: 10px 24px;   text-decoration: none;' target=_blank>Allez sur collabratis</a>
            </div>
           
    <img height=1 src=https://www.google.com/appserve/mkt/img/AFnwnKUwncdGojxpaQzytvL82kkIIInVwWfgEX7RFtep8KfDcA8.gif width=3>
  </Body>
</html> ";
                                
                           $headers = "From: notification.collaboratis@gmail.com" . "\r\n" 
                                            ."Content-Type:text/html;charset=\"utf-8\"";
                                            
                           mail($to,$subject,$body,$headers);
                           
                      
                        
                        
                            echo '<br><br><br> <span class="alert alert-success" role="alert" style ="margin-top : 100px; margin-left : 150px; width : 350px;"> Les Mails ont été envoyés avec succès </span>';
                       
            
                     //}       
        }
         
        $this->info('Mail de rappel hebdomadaire envoyé');
    }

}