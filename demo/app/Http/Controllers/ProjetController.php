<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Action;
use App\Agent;
use App\Projet;
use App\Reunion;
use App\Suivi_action;
use App\Direction;
use App\Agent_projet;
use DB;
use Auth;
use Mail;
use App\User;
use Session;
use App\Notifications\VousAvezUnNouveauProjet;
  
class ProjetController extends Controller
{
      public function lesbakup($id)
    {
       $projets= Projet::find($id);
        $agentbackups = DB::table('agent_projets')->where('projet_id', $projets->id)->get(); 

        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('projet.listebakup', compact('projets', 'agentbackups', 'headers'));
    }
     public function status_cloturer($id)
    {
        //    
        $cloture = "Projet clôturé avec succès";
        $action = Projet::findOrFail($id);
        $action->visibilite = 1; //Approved
        $action->save();
        return redirect()->back()->with(['cloture' => $cloture]); 
    }
    
    public function action_projet_cloturer($id)
    {
        //    
        $cloture = "Projet clôturé avec succès";
        $action = Action::findOrFail($id);
        $action->visibilite = 1; //Approved
        $action->save();
        return redirect()->back()->with(['cloture' => $cloture]); 
    }
    
      public function mes_projets_user()
    {
        
         $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
        foreach($users as $user){
        //  $projets = DB::table('projets')->where('responsable', $user->id)->get();
                    $projets = DB::table('projets')->select('projets.id', 'projets.deadline', 'projets.responsable', 'projets.libelle', 'projets.note',
                    'projets.priorite','projets.pourcentage', 'projets.note', 'projets.visibilite', 'projets.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id', 'agent_projets.agent_id', 'agent_projets.projet_id'
                    )
                    ->join('agent_projets', 'agent_projets.projet_id', 'projets.id')
                    ->join('agents', 'agents.id', 'projets.responsable')
                    
                    ->where('agent_projets.agent_id','=', $user->id)
                    // ->orWhere('projets.bakup','=', $user->full_name)
                    ->get();
                    
        $action_respons = DB::table('projets')->select('projets.id', 'projets.deadline', 'projets.responsable', 'projets.libelle', 'projets.note',
                     'projets.visibilite', 'projets.priorite', 'projets.pourcentage', 'projets.note','projets.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id','directions.nom_direction'
                    )
                    ->join('agents', 'agents.id', 'projets.responsable')
                    ->leftjoin('directions', 'directions.id', 'agents.direction_id')
                    ->where('projets.responsable','=', $user->id)
                    //->orWhere('projets.bakup','=', $user->full_name)
                    ->orderBy('projets.pourcentage', 'ASC')
                    ->get();
                    
                    $action_bakups = DB::table('projets')->select('projets.id', 'projets.deadline', 'projets.responsable', 'projets.libelle', 'projets.note',
                      'projets.visibilite', 'projets.priorite','projets.pourcentage', 'projets.note','projets.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id', 'agents.niveau_hieracie','directions.nom_direction'
                    )
                    ->join('agents', 'agents.id', 'projets.responsable')
                    ->leftjoin('directions', 'directions.id', 'agents.direction_id')
                    //->where('projets.agent_id','=', $user->id)
                    ->where('projets.responsable','=', $user->full_name)
                    ->orderBy('projets.pourcentage', 'ASC')
                    ->get();
                    
                    $sum_projets = DB::table('projets')->select('projets.id', 'projets.deadline', 'projets.responsable', 'projets.libelle', 'projets.note',
                      'projets.visibilite',  'projets.priorite', 'projets.pourcentage', 'projets.note','projets.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id'
                    )
                    ->join('agents', 'agents.id', 'projets.responsable')
                    //->join('reunions', 'reunions.id', 'projets.reunion_id')
                    //->leftjoin('suivi_projets', 'suivi_projets.action_id', 'projets.id')
                    ->where('projets.responsable','=', $user->id)
                    // ->orWhere('projets.bakup','=', $user->full_name)
                    ->sum('projets.pourcentage');
        
                  $action_users = DB::table('projets')->select('projets.id', 'projets.deadline', 'projets.libelle', 'projets.note','projets.responsable',
                    'projets.visibilite',  'projets.priorite', 'projets.created_at',
                   'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id')
                   ->join('agents', 'agents.id', 'projets.responsable')
                   //->join('reunions', 'reunions.id', 'projets.reunion_id')
                   ->where('agents.id','=', $user->id)
                   ->get();   
                  
         
           
        }
        $date1 = date('Y/m/d'); 
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
     return view('projet.mes_projets_user', compact('projets','action_users','headers','sum_projets','action_respons','action_bakups','date1'));
    }
    
    public function lister_mes_projets()
    {
        
         $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
        foreach($users as $user){
        //  $projets = DB::table('projets')->where('responsable', $user->id)->get();
                 $projets = DB::table('projets')->select('projets.id', 'projets.deadline', 'projets.responsable', 'projets.libelle',
                    'projets.priorite','projets.pourcentage', 'projets.note', 'projets.visibilite', 'projets.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id', 'agent_projets.agent_id', 'agent_projets.projet_id',
                    'agent_projets.libelle_action', 'agent_projets.projet_id', 'agent_projets.priorites', 'agent_projets.deadlines', 'agent_projets.pourcentages'
                    )
                     ->join('agent_projets', 'agent_projets.projet_id', 'projets.id')
                    ->join('agents', 'agents.id', 'projets.responsable')
                    
                    ->where('projets.responsable','=', $user->id)
                    // ->orWhere('projets.bakup','=', $user->full_name)
                     ->get();
                    // dd($projets);
        $action_respons = DB::table('projets')->select('projets.id', 'projets.deadline', 'projets.responsable', 'projets.libelle', 'projets.note',
                     'projets.visibilite',  'projets.priorite', 'projets.pourcentage', 'projets.note','projets.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id','directions.nom_direction'
                    )
                    ->join('agents', 'agents.id', 'projets.responsable')
                    ->leftjoin('directions', 'directions.id', 'agents.direction_id')
                    ->where('projets.responsable','=', $user->id)
                    //->orWhere('projets.bakup','=', $user->full_name)
                    ->orderBy('projets.pourcentage', 'ASC')
                    ->get();
                    
                    $action_bakups = DB::table('projets')->select('projets.id', 'projets.deadline', 'projets.responsable', 'projets.libelle', 'projets.note',
                      'projets.visibilite',  'projets.priorite', 'projets.pourcentage', 'projets.note','projets.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id', 'agents.niveau_hieracie','directions.nom_direction'
                    )
                    ->join('agents', 'agents.id', 'projets.responsable')
                    ->leftjoin('directions', 'directions.id', 'agents.direction_id')
                    //->where('projets.agent_id','=', $user->id)
                    ->where('projets.responsable','=', $user->full_name)
                    ->orderBy('projets.pourcentage', 'ASC')
                    ->get();
                    
                    $sum_projets = DB::table('projets')->select('projets.id', 'projets.deadline', 'projets.responsable', 'projets.libelle', 'projets.note',
                      'projets.visibilite',  'projets.priorite','projets.pourcentage', 'projets.note','projets.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id'
                    )
                    ->join('agents', 'agents.id', 'projets.responsable')
                    //->join('reunions', 'reunions.id', 'projets.reunion_id')
                    //->leftjoin('suivi_projets', 'suivi_projets.action_id', 'projets.id')
                    ->where('projets.responsable','=', $user->id)
                    // ->orWhere('projets.bakup','=', $user->full_name)
                    ->sum('projets.pourcentage');
        
                  $action_users = DB::table('projets')->select('projets.id', 'projets.deadline', 'projets.libelle', 'projets.note','projets.responsable',
                    'projets.visibilite',  'projets.priorite', 'projets.created_at',
                   'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id')
                   ->join('agents', 'agents.id', 'projets.responsable')
                   //->join('reunions', 'reunions.id', 'projets.reunion_id')
                   ->where('agents.id','=', $user->id)
                   ->get();   
                  
         
           
        }
        $date1 = date('Y/m/d'); 
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
     return view('projet.lister_mes_projets', compact('projets','action_users','headers','sum_projets','action_respons','action_bakups','date1'));
    }
    
       public function create_projet()
    {
        //
        $agents = Agent::orderBy('prenom')
        ->get();
        $projet = Projet::all();
        $res_agents = DB::table('agents')
        ->select('agents.prenom', 'agents.nom', 'agents.photo', 'agents.service_id', 'agents.date_naiss', 'agents.id',
        'services.nom_service','services.direction')
        ->join('services', 'services.id', 'agents.service_id')
        ->whereIn('agents.niveau_hieracie', array('Directeur' ,'Chef de Service'))
        
        ->get();
        $reunions = Reunion::all();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('projet.ajouter', compact('agents', 'projet' ,'reunions','res_agents','headers'));

    }
   public function store_projet(Request $request)
    {
        request()->validate([
            'libelle' => 'required|string|max:255',
            'deadline' => 'required|string|max:255',

    ]);
            $message = "Projet ajouté avec succès";
            $projet = new Projet;
            $projet->libelle = $request->get('libelle');
            $projet->deadline = $request->get('deadline'); 
            $projet->priorite = $request->get('priorite'); 
            $projet->deadline = $request->get('deadline'); 
            $projet->responsable = $request->get('responsable');
            $projet->bakup = $request->get('bakup');
            $projet->pourcentage = $request->get('pourcentage');
            // $projet->agent_id = $request->get('agent_id'); 
            $projet->save();
            
             $agent_id = $request->get('agent_id');
            //  $backup = $request->get('bakup');
             $projet_id = $request->get('projet_id');
            //  $deadlines = $request->get('deadlines');
            // // $pourcentages = $request->get('pourcentages');
            //  $priorites = $request->get('priorites');
            //  $libelle_action = $request->get('libelle_action');
             
             for($i=0; $i < count($agent_id); $i++){
             $personnes = [
                
                'agent_id' => $agent_id[$i],
                //  'backup' => $backup[$i],
                //  'deadlines' => $deadlines[$i],
                //  'pourcentages' => $projet->pourcentage,
                //  'priorites' => $priorites[$i],
                //  'libelle_action' => $libelle_action[$i],
                 'projet_id' =>$projet->id,
                     ];
                 
                 DB::table('agent_projets')->insert($personnes);
                //  DB::table('actions')->insert($personnes);
                }
            $agent = DB::table('agents')->where('id', $projet->responsable)->first();
            $user = User::where('id', $agent->user_id)->first();
            $user->notify(new VousAvezUnNouveauProjet());
            
            $agentbackups = DB::table('agent_projets')->where('projet_id', $projet->id)->get();
            foreach($agentbackups as $agentbackup){
                $agent = DB::table('agents')->where('id', $agentbackup->agent_id)->first();
                
                Mail::send('mail.bakup_projet', ['agent' => $agent], function ($m) use ($agent) {
                    $m->from('notifycollaboratis@gmail.com', 'Notifications-Collaboratis');
        
                    $m->to($agent->email, $agent->prenom)->subject('Nouveau Projet');
                }); 
            }
            // dd($agent);
                                      //->where('id', $projet->bakup)
           
            //dd($projet);
           
             
            return back()->with(['message' => $message]);

    
}


   public function create_projet_action()
    {
        //
        $agents = Agent::orderBy('prenom')
        ->get();
        $projet = Projet::all();
        $res_agents = DB::table('agents')
        ->select('agents.prenom', 'agents.nom', 'agents.photo', 'agents.service_id', 'agents.date_naiss', 'agents.id',
        'services.nom_service','services.direction')
        ->join('services', 'services.id', 'agents.service_id')
        ->whereIn('agents.niveau_hieracie', array('Directeur' ,'Chef de Service'))
        
        ->get();
        $reunions = Reunion::all();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('projet.ajouter_action', compact('agents', 'projet' ,'reunions','res_agents','headers'));

    }
   public function store_projet_action(Request $request)
    {
       
            $message = "Action ajoutée avec succès";
            $projet = new Agent_projet;
            $projet->libelle_action = $request->get('libelle_action');
            $projet->deadlines = $request->get('deadlines');
            $projet->priorites = $request->get('priorites');
            $projet->projet_id = $request->get('projet_id');
            $projet->agent_id = $request->get('agent_id');
            $projet->backup = $request->get('backup');
            $projet->pourcentages = 00;
            $projet->save();
            
            $action = new Action;
            $action->libelle = $projet->libelle_action;
            $action->deadline = $projet->deadlines;
            $action->risque = $projet->priorites;
            $action->projet_id = $projet->projet_id;
            $action->agent_id = $projet->agent_id;
            $action->bakup = $projet->backup;
            $action->pourcentage = $projet->pourcentages;
            $action->save();
           
            $agent = DB::table('agents')->where('id', $projet->agent_id)->first();
            $user = User::where('id', $agent->user_id)->first();
            $user->notify(new VousAvezUnNouveauProjet());
            
            $agentbackups = DB::table('agent_projets')->where('projet_id', $projet->id)->get();
            foreach($agentbackups as $agentbackup){
                $agent = DB::table('agents')->where('id', $agentbackup->agent_id)->first();
                
                Mail::send('mail.bakup_projet', ['agent' => $agent], function ($m) use ($agent) {
                    $m->from('notifycollaboratis@gmail.com', 'Notifications-Collaboratis');
        
                    $m->to($agent->email, $agent->prenom)->subject('Nouveau Projet');
                }); 
            }
           
           
             
            return back()->with(['message' => $message]);

    
}

       //Toute mes projets 
     public function edit_projet($id)
    {
        //


        /* $suivi_action = Suivi_action::find($id);
        $projets = Action::all();
        return view('suivi_action.editer_d', compact('projets', 'suivi_action'));
 */
        $projet= Projet::find($id);
        $projets = Projet::all();
        $agents = Agent::all();
        $reunions = Reunion::all();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('projet.edit_mes_projets', compact('projets', 'projet','agents','reunions','headers'));
    }
    public function update_projet(Request $request, $id)
    {
        //

        
        $message = "Projet mise à jour avec succès !";
       
            $projet = Projet::find($id);
            $projet->libelle = $request->get('libelle');
            $projet->deadline = $request->get('deadline'); 
            $projet->note = $request->get('note');
            $projet->priorite = $request->get('priorite');   
            $projet->responsable = $request->get('responsable');
            // $projet->bakup = $request->get('bakup');
            $projet->pourcentage = $request->get('pourcentage'); 
            // $projet->agent_id = $request->get('agent_id'); 
            $projet->update();

        return redirect('/mes_projets')->with(['message' => $message]);
    }
    
     public function lister_tous_projets()
    {
        
         $directions = Direction::all();
        /*$projets = DB::table('projets')->select('projets.id', 'projets.deadline', 'projets.responsable', 'projets.bakup', 'projets.libelle', 'projets.note',
         'projets.agent_id','projets.reunion_id',  'projets.visibilite',  'projets.priorite', 'projets.delais',
          'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id')
          ->join('agents', 'agents.id', 'projets.agent_id')
          ->join('reunions', 'reunions.id', 'projets.reunion_id')
          ->get();*/
           $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
        foreach($users as $user){
           $projets = DB::table('directions')
          ->join('agents', 'agents.direction_id', 'directions.id')
          ->join('projets', 'projets.responsable', 'agents.id')
          //->leftjoin('suivi_projets', 'suivi_projets.action_id', 'projets.id')
          ->select('projets.id',
                  'projets.libelle', 'projets.responsable', 'projets.deadline',
                  'projets.priorite', 'projets.visibilite','projets.created_at', 'projets.pourcentage', 'projets.note',
                  'agents.prenom', 'agents.nom', 'agents.photo','agents.niveau_hieracie', 'agents.direction_id', 'agents.date_naiss', 'agents.id as Id',
                  'directions.nom_direction','directions.id as ID')
                  ->orderBY('projets.priorite','ASC')
                  ->get();
                    
                    $action_respons = DB::table('projets')->select('projets.id', 'projets.deadline', 'projets.responsable', 'projets.libelle', 'projets.note',
                      'projets.priorite','projets.pourcentage', 'projets.visibilite', 'projets.note','projets.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id','directions.nom_direction'
                    )
                    ->join('agents', 'agents.id', 'projets.responsable')
                    ->leftjoin('directions', 'directions.id', 'agents.direction_id')
                    ->where('projets.responsable','=', $user->id)
                    //->orWhere('projets.bakup','=', $user->full_name)
                    ->orderBy('projets.pourcentage', 'ASC')
                    ->get();
                    
                    $action_bakups = DB::table('projets')->select('projets.id', 'projets.deadline', 'projets.responsable', 'projets.libelle', 'projets.note',
                    'projets.priorite','projets.pourcentage', 'projets.visibilite', 'projets.note','projets.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id', 'agents.niveau_hieracie','directions.nom_direction'
                    )
                    ->join('agents', 'agents.id', 'projets.responsable')
                    ->leftjoin('directions', 'directions.id', 'agents.direction_id')
                    //->where('projets.agent_id','=', $user->id)
                    // ->where('projets.bakup','=', $user->full_name)
                    ->orderBy('projets.pourcentage', 'ASC')
                    ->get();
                    
                    $sum_projets = DB::table('projets')->select('projets.id', 'projets.deadline', 'projets.responsable', 'projets.libelle', 'projets.note',
                     'projets.priorite','projets.pourcentage', 'projets.note', 'projets.visibilite','projets.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id'
                    )
                    ->join('agents', 'agents.id', 'projets.responsable')
                    //->join('reunions', 'reunions.id', 'projets.reunion_id')
                    //->leftjoin('suivi_projets', 'suivi_projets.action_id', 'projets.id')
                    ->where('projets.responsable','=', $user->id)
                    // ->orWhere('projets.bakup','=', $user->full_name)
                    ->sum('projets.pourcentage');
        
                  $action_users = DB::table('projets')->select('projets.id', 'projets.deadline', 'projets.visibilite', 'projets.libelle', 'projets.note','projets.responsable',
                  'projets.priorite','projets.created_at',
                  'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id')
                  ->join('agents', 'agents.id', 'projets.responsable')
                  //->join('reunions', 'reunions.id', 'projets.reunion_id')
                  ->where('agents.id','=', $user->id)
                  ->get();   
                  
         
           }
        
        $date1 = date('Y/m/d'); 
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
     return view('projet.lister_tous_projets', compact('projets','headers','date1', 'directions', 'action_users','action_respons', 'sum_projets','action_bakups'));
    }

public function projets_ma_team()
    {
        
           $user = DB::table('agents')->where('user_id', Auth::user()->id)->first();
         
                    $projets = DB::table('projets')->select('projets.id', 'projets.deadline', 'projets.responsable','projets.libelle', 'projets.note',
                    'projets.visibilite',  'projets.priorite', 'projets.pourcentage', 'projets.note','projets.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id'
                    )
                    ->join('agents', 'agents.id', 'projets.responsable')
                    
                    ->where('projets.responsable','=', $user->id)
                    //->orWhere('projets.bakup','=', $user->full_name)
                    ->get();
                   
                    $action_mois = date('m');
                    $action_respons = array();
                    $action_respons_sum = array();
                    $sum = 0;
                    //dd($action_mois);
                    $agent_mateams = DB::table('agents')->where('direction_id', $user->direction_id)->get();
                   foreach($agent_mateams as $agent_mateam)
                    {
                    $action_responsf = DB::table('agent_projets')->select('projets.id', 'projets.deadline', 'projets.responsable', 
                    'projets.libelle', 'projets.note', 'projets.visibilite',
                    'projets.priorite', 'projets.pourcentage', 'projets.note','projets.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id','directions.nom_direction',
                    'agent_projets.agent_id', 'agent_projets.projet_id'
                    )
                    ->join('agents', 'agents.id', 'agent_projets.agent_id')
                    ->leftjoin('directions', 'directions.id', 'agents.direction_id')
                    ->rightjoin('projets', 'projets.id', 'agent_projets.projet_id')
                    ->where('agent_projets.agent_id','=', $agent_mateam->id)
                    //->orWhere('projets.bakup','=', $user->full_name)
                    ->orderBy('projets.pourcentage', 'ASC')
                    ->get();
dd($action_responsf);
                    // foreach($action_responsf as $action_respf)
                    // {
                    //     if(($action_respf->deadline < now()) && $action_respf->pourcentage < 100)
                    //     {
                    //         array_push($action_respons, $action_respf);
                    //         $sum += $action_respf->pourcentage;
                    //          array_push($action_respons_sum, $sum);
                    //         //dd($action_respons);
                    //         //$count = count($action_responsf);
                           
                    //     }
                    // }
                    
                    }
                    $action_respons = DB::table('projets')->select('projets.id', 'projets.deadline', 'projets.responsable', 'projets.libelle', 'projets.note',
                      'projets.priorite','projets.pourcentage', 'projets.visibilite', 'projets.note','projets.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id','directions.nom_direction'
                    )
                    ->join('agents', 'agents.id', 'projets.responsable')
                    ->leftjoin('directions', 'directions.id', 'agents.direction_id')
                    ->where('projets.responsable','=', $user->id)
                    //->orWhere('projets.bakup','=', $user->full_name)
                    ->orderBy('projets.pourcentage', 'ASC')
                    ->get();
                    
                    $action_bakups = DB::table('projets')->select('projets.id', 'projets.deadline', 'projets.responsable', 'projets.libelle', 'projets.note',
                    'projets.priorite','projets.pourcentage', 'projets.visibilite', 'projets.note','projets.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id', 'agents.niveau_hieracie','directions.nom_direction'
                    )
                    ->join('agents', 'agents.id', 'projets.responsable')
                    ->leftjoin('directions', 'directions.id', 'agents.direction_id')
                    //->where('projets.agent_id','=', $user->id)
                    // ->where('projets.bakup','=', $user->full_name)
                    ->orderBy('projets.pourcentage', 'ASC')
                    ->get();
                    
                    $sum_projets = DB::table('projets')->select('projets.id', 'projets.deadline', 'projets.responsable', 'projets.libelle', 'projets.note',
                     'projets.priorite','projets.pourcentage', 'projets.note', 'projets.visibilite','projets.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id'
                    )
                    ->join('agents', 'agents.id', 'projets.responsable')
                    //->join('reunions', 'reunions.id', 'projets.reunion_id')
                    //->leftjoin('suivi_projets', 'suivi_projets.action_id', 'projets.id')
                    ->where('projets.responsable','=', $user->id)
                    // ->orWhere('projets.bakup','=', $user->full_name)
                    ->sum('projets.pourcentage');
        
                  $action_users = DB::table('projets')->select('projets.id', 'projets.deadline', 'projets.visibilite', 'projets.libelle', 'projets.note','projets.responsable',
                  'projets.priorite','projets.created_at',
                  'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id')
                  ->join('agents', 'agents.id', 'projets.responsable')
                  //->join('reunions', 'reunions.id', 'projets.reunion_id')
                  ->where('agents.id','=', $user->id)
                  ->get();   
                  
         
           
        
        $date1 = date('Y/m/d'); 
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
     return view('projet.projets_ma_team', compact('projets','headers','date1', 'action_responsf',  'action_users','action_respons', 'sum_projets','action_bakups'));
    }
    
      public function edit_action_projet($id)
    {
        $action = Action::find($id);
        $actions = Action::all();
        $agents = Agent::all();
        $reunions = Reunion::all();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('projet.action_projet_edit1', compact('actions', 'action','agents','reunions','headers'));
   
    }
  
   public function update_action_projet(Request $request, $id)
    {
    
        $message = "Action modifiée avec succès !";
    
         
             $action = Action::find($id);
            $action->libelle = $request->get('libelle');
            $action->deadline = $request->get('deadline'); 
            $action->visibilite = $request->get('visibilite');
            $action->note = $request->get('note');
            $action->risque = $request->get('risque');   
            $action->delais = $request->get('delais'); 
            $action->reunion = $request->get('reunion');
            $action->responsable = $request->get('responsable');
            $action->bakup = $request->get('bakup');
            $action->agent = $request->get('agent');
            $action->pourcentage = $request->get('pourcentage'); 
            $action->agent_id = $request->get('agent_id'); 
            $action->reunion_id = $request->get('reunion_id');
            $action->projet_id = $request->get('projet_id');
            $action->raison = $request->get('raison');
            $action->update();

   
        return redirect('/user_toute_action')->with(['message' => $message]);
    }
     public function edit_action_proj($id)
    {
        $action = Action::find($id);
        $actions = Action::all();
        $agents = Agent::all();
        $reunions = Reunion::all();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('projet.edit_action_proj', compact('actions', 'action','agents','reunions','headers'));
   
    }
  
   public function update_action_proj(Request $request, $id)
    {
    
       $message = "Action modifiée avec succès !";
    
            $action = Action::find($id);
            $action->libelle = $request->get('libelle');
            $action->deadline = $request->get('deadline'); 
            $action->visibilite = $request->get('visibilite');
            $action->note = $request->get('note');
            $action->risque = $request->get('risque');   
            $action->delais = $request->get('delais'); 
            $action->reunion = $request->get('reunion');
            $action->bakup = $request->get('bakup');
            $action->agent = $request->get('agent');
            $action->pourcentage = $request->get('pourcentage'); 
            $action->projet_id = $request->get('projet_id'); 
            $action->agent_id = $request->get('agent_id'); 
            $action->reunion_id = $request->get('reunion_id');
            $action->raison = $request->get('raison');
            $action->update();

   
        return redirect('/action_projet')->with(['message' => $message]);
    }
 public function edit_action_projet_dash($id)
    {
        $action = Action::find($id);
        $actions = Action::all();
        $agents = Agent::all();
        $reunions = Reunion::all();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('projet.action_projet_edit_dash', compact('actions', 'action','agents','reunions','headers'));
   
    }
  
   public function update_action_projet_dash(Request $request, $id)
    {
    
        $message = "Action modifiée avec succès !";
    
         
             $action = Action::find($id);
            $action->libelle = $request->get('libelle');
            $action->deadline = $request->get('deadline'); 
            $action->visibilite = $request->get('visibilite');
            $action->note = $request->get('note');
            $action->risque = $request->get('risque');   
            $action->delais = $request->get('delais'); 
            $action->reunion = $request->get('reunion');
            $action->responsable = $request->get('responsable');
            $action->bakup = $request->get('bakup');
            $action->agent = $request->get('agent');
            $action->pourcentage = $request->get('pourcentage'); 
            $action->agent_id = $request->get('agent_id'); 
            $action->reunion_id = $request->get('reunion_id');
            $action->projet_id = $request->get('projet_id');
            $action->raison = $request->get('raison');
            $action->update();

   
        return redirect('/action_projet')->with(['message' => $message]);
    }
     public function edit_action_projet_mois($id)
    {
        $action = Action::find($id);
        $actions = Action::all();
        $agents = Agent::all();
        $reunions = Reunion::all();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('projet.action_projet_edit_mois', compact('actions', 'action','agents','reunions','headers'));
   
    }
  
   public function update_action_projet_mois(Request $request, $id)
    {
    
        $message = "Action modifiée avec succès !";
    
         
             $action = Action::find($id);
            $action->libelle = $request->get('libelle');
            $action->deadline = $request->get('deadline'); 
            $action->visibilite = $request->get('visibilite');
            $action->note = $request->get('note');
            $action->risque = $request->get('risque');   
            $action->delais = $request->get('delais'); 
            $action->reunion = $request->get('reunion');
            $action->responsable = $request->get('responsable');
            $action->bakup = $request->get('bakup');
            $action->agent = $request->get('agent');
            $action->pourcentage = $request->get('pourcentage'); 
            $action->agent_id = $request->get('agent_id'); 
            $action->reunion_id = $request->get('reunion_id');
            $action->projet_id = $request->get('projet_id');
            $action->raison = $request->get('raison');
            $action->update();

   
        return redirect('/user_action_mois')->with(['message' => $message]);
    }
    public function action_projet()  
    {
        //
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
        foreach($users as $user){
             $actions = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.responsable', 'actions.libelle', 'actions.note',
                    'actions.agent_id','actions.reunion_id','actions.raison',  'actions.visibilite','actions.bakup',  'actions.risque', 'actions.delais','actions.pourcentage','actions.action_respon', 'actions.note','actions.updated_at','actions.created_at',
                    'agents.prenom', 'agents.nom', 'agents.niveau_hieracie', 'agents.photo', 'agents.id as Id'
                    )
                    ->join('agents', 'agents.id', 'actions.agent_id')
                    ->where('actions.agent_id','=', $user->id)
                    ->orWhere('actions.bakup','=', $user->full_name)
                    ->get();
                  $projets = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.responsable', 'actions.projet_id', 'actions.libelle', 'actions.note',
                    'actions.agent_id','actions.reunion_id','agents.niveau_hieracie','actions.raison',  'actions.visibilite','actions.bakup', 
                    'actions.risque', 'actions.delais','actions.pourcentage','actions.action_respon', 'actions.note','actions.created_at','actions.updated_at', 
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id','directions.nom_direction'
                    )
                    ->join('agents', 'agents.id', 'actions.agent_id')
                    ->leftjoin('directions', 'directions.id', 'agents.direction_id')
                    ->where('actions.agent_id','=', $user->id)
                    ->orderBy('actions.updated_at', 'DESC')
                    ->get();
                    
                     $pro = DB::table('projets')->get();
                    //  dd($projets);
                    $action_respons = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.responsable', 'actions.libelle', 'actions.note',
                    'actions.agent_id','actions.reunion_id','agents.niveau_hieracie','actions.raison',  'actions.visibilite','actions.bakup', 
                    'actions.risque', 'actions.delais','actions.pourcentage','actions.action_respon', 'actions.note','actions.created_at','actions.updated_at', 
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id','directions.nom_direction'
                    )
                    ->join('agents', 'agents.id', 'actions.agent_id')
                    ->leftjoin('directions', 'directions.id', 'agents.direction_id')
                    ->where('actions.agent_id','=', $user->id)
                    ->orderBy('actions.updated_at', 'DESC')
                    ->get();
                    
                     $action_escalades = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.responsable', 'actions.libelle', 'actions.note',
                    'actions.agent_id','actions.reunion_id','agents.niveau_hieracie','actions.raison',  'actions.visibilite','actions.bakup',  'actions.risque', 'actions.delais','actions.pourcentage','actions.action_respon', 'actions.note','actions.updated_at','actions.created_at', 'actions.updated_at', 
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id','directions.nom_direction'
                    )
                    ->join('agents', 'agents.id', 'actions.agent_id')
                    ->leftjoin('directions', 'directions.id', 'agents.direction_id')
                    ->where('actions.agent_id','=', Auth::user()->id)
                    ->where('actions.action_respon', '!=' , '')
                   ->orderBy('actions.updated_at', 'DESC')
                    ->get();
                    
                    $action_bakups = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.responsable', 'actions.libelle', 'actions.note',
                    'actions.agent_id','actions.reunion_id','agents.niveau_hieracie','actions.raison',  'actions.visibilite','actions.bakup',  'actions.risque', 'actions.delais','actions.pourcentage','actions.action_respon', 'actions.note','actions.updated_at','actions.created_at','actions.updated_at', 
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id','agents.niveau_hieracie','directions.nom_direction'
                    )
                    ->join('agents', 'agents.id', 'actions.agent_id')
                    ->leftjoin('directions', 'directions.id', 'agents.direction_id')
                    ->where('actions.bakup','=', $user->full_name)
                    ->orderBy('actions.pourcentage', 'ASC')
                    ->get();
                    
                    $sum_actions = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.responsable', 'actions.libelle', 'actions.note',
                    'actions.agent_id','actions.reunion_id','actions.raison',  'actions.visibilite','actions.bakup',  'actions.risque','actions.updated_at', 'actions.delais','actions.pourcentage', 'actions.note','actions.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id'
                    )
                    ->join('agents', 'agents.id', 'actions.agent_id')
                    ->where('actions.agent_id','=', $user->id)
                    ->orWhere('actions.bakup','=', $user->full_name)
                    ->sum('actions.pourcentage'); 

                    $action_users = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.libelle', 'actions.pourcentage', 'actions.note','actions.responsable',
                              'actions.agent_id','actions.reunion_id','actions.raison', 'actions.bakup',  'actions.visibilite','actions.updated_at','actions.created_at',  'actions.risque', 'actions.delais',
                               'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id')
                               ->join('agents', 'agents.id', 'actions.agent_id')
                              ->where('agents.id','=', $user->id)
                               ->get();          
                    }
                    $date1 = date('Y/m/d');
                    $user_actions = Agent::where('user_id', Auth::user()->id)->get();
                     foreach($user_actions as $user)
                    {
                    
            
                        $action_directions = DB::table('directions')
                      ->join('agents', 'agents.direction_id', 'directions.id')
                      ->join('actions', 'actions.agent_id', 'agents.id')
                      ->select('actions.id',
                              'actions.libelle', 'actions.responsable', 'actions.bakup','actions.deadline',
                              'actions.risque','actions.delais','actions.raison', 'actions.updated_at','actions.visibilite','actions.created_at','actions.pourcentage', 'actions.note',
                              'agents.prenom', 'agents.nom', 'agents.photo', 'agents.direction_id', 'agents.date_naiss', 'agents.id as Id',
                              'directions.nom_direction','directions.id as ID')
                              ->where('agents.direction_id' ,'=', $user->direction_id)
                              ->orWhere('actions.agent_id','=', $user->id)
                              ->orderBy('actions.pourcentage', 'ASC')
                              ->get();
                        $sum_directions = DB::table('directions')
                          ->join('agents', 'agents.direction_id', 'directions.id')
                          ->join('actions', 'actions.agent_id', 'agents.id')
                          ->select('actions.id',
                                  'actions.libelle', 'actions.responsable','actions.deadline',
                                  'actions.risque','actions.delais','actions.raison', 'actions.updated_at','actions.visibilite', 'actions.bakup','actions.created_at', 'actions.pourcentage', 'actions.note',
                                  'agents.prenom', 'agents.nom', 'agents.photo', 'agents.direction_id', 'agents.date_naiss', 'agents.id as Id',
                                  'directions.nom_direction','directions.id as idDI')
                                  ->where('agents.direction_id' ,'=', $user->direction_id)
                                  ->orWhere('actions.agent_id','=', $user->id)
                                   ->orderBY('actions.risque','ASC')
                                  ->sum('actions.pourcentage'); 
                        }   
                        $suivi_indicateurs = DB::table('suivi_indicateurs')->select('suivi_indicateurs.id', 'suivi_indicateurs.date', 'suivi_indicateurs.pourcentage', 'suivi_indicateurs.note',
                                        'suivi_indicateurs.indicateur_id',
                                         'indicateurs.id', 'indicateurs.libelle', 'indicateurs.cible', 'indicateurs.date_cible')
                                         ->join('indicateurs', 'indicateurs.id', 'suivi_indicateurs.indicateur_id')
                                         ->get(); 
                        $suivi_actions = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.libelle', 'actions.pourcentage', 'actions.note','actions.responsable',
                                  'actions.agent_id','actions.reunion_id','actions.raison', 'actions.updated_at','actions.bakup',  'actions.visibilite','actions.created_at',  'actions.risque', 'actions.delais',
                                   'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id')
                                   ->join('agents', 'agents.id', 'actions.agent_id')
                                  
                                   ->get();  
                        
                         $sum_suivi_actions = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.libelle', 'actions.pourcentage', 'actions.note','actions.responsable',
                                  'actions.agent_id','actions.reunion_id','actions.raison','actions.updated_at', 'actions.bakup',  'actions.visibilite','actions.created_at',  'actions.risque', 'actions.delais',
                                   'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id')
                                   ->join('agents', 'agents.id', 'actions.agent_id')
                                    ->sum('actions.pourcentage');  
                
                                        $sum_actionss = Agent::where('user_id', Auth::user()->id)->get();
                                        foreach($sum_actionss as $user)
                                       {
                                       $sum_directionss = DB::table('directions')
                                         ->join('agents', 'agents.direction_id', 'directions.id')
                                         ->join('actions', 'actions.agent_id', 'agents.id')
                                         ->leftjoin('suivi_actions', 'suivi_actions.action_id', 'actions.id')
                                         ->select('actions.id',
                                 'actions.libelle', 'actions.responsable','actions.deadline','actions.bakup',
                                 'actions.risque','actions.raison','actions.delais as duree', 'actions.visibilite','suivi_actions.deadline as date','actions.created_at', 'actions.pourcentage', 'actions.note','suivi_actions.delais',
                                 'agents.prenom', 'agents.nom','actions.updated_at', 'agents.photo', 'agents.service_id', 'agents.date_naiss', 'agents.id as Id',
                                 'directions.nom_direction','directions.id as ID')
                                 ->where('agents.direction_id' ,'=', $user->direction_id)
                                 ->orderBY('actions.risque','ASC')
                                 ->sum('actions.pourcentage');
                                 //->get();
                       }   
        //dd($actions);
                         $directions = DB::table('directions')->get();
                         $agents = DB::table('agents')->get();
                         $users = User::where('id', Auth::user()->id)->get();
                         $my_agents = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->get();
                         
                            $direction_id = DB::table('directions')
                            ->select('directions.id')
                            ->get();
                            
                          $indi_array_dir = array();
                          $sum_array_dir = array();
                          $count_array_dir = array();
                          
                          foreach($direction_id as $dir)
                          {
                           
                            
                            $indicateurs_sum_dir = DB::table('modeles')
                            ->select('modeles.*','agents.prenom','agents.nom','agents.direction_id')
                            ->join('agents', 'agents.id','=', 'modeles.res_dir')
                            ->where('agents.direction_id', '=', $dir->id)
                            ->orWhereNull('agents.direction_id')
                            ->sum('modeles.pourcentage');
                            $indicateurs_global_dir = DB::table('modeles')
                            ->select('modeles.*','agents.prenom','agents.nom','agents.direction_id')
                            ->join('agents', 'agents.id','=', 'modeles.res_dir')
                            ->where('agents.direction_id', '=', $dir->id)
                            ->orWhereNull('agents.direction_id')
                
                            ->get();
                            
                            $count_dir = count($indicateurs_global_dir); 
                            array_push($indi_array_dir, $indicateurs_global_dir);
                            
                              $sum_dir = $count_dir == 0 ? 0 : $indicateurs_sum_dir / $count_dir;
                             array_push($sum_array_dir,$sum_dir);
                             
                             //dd(array_sum($sum_array_dir));
                             $sum_total_dir = array_sum($sum_array_dir);
                             $counts_dir = count($sum_array_dir);
                
                          }
                         $taux_exe = $sum_total_dir / $counts_dir;
                         
                        $count_actions = 9;
                        $sum = $count_actions == 0 ? 0 : $sum_actions / $count_actions;
                         
                        $count_actions_dir = count($action_directions);
                        $sum_dir = $count_actions_dir == 0 ? 0 : $sum_directions / $count_actions_dir;
                         
                         $userAgents = User::all();
                         $taches = DB::table('taches')->get();
                         $activites = DB::table('activites')->where('statut', '=', 0)->orderBy('deadline', 'DESC')->get();
                         $activi = DB::table('activites')->where('statut', '=', 0)->get();
                         $tache_modeles = DB::table('tache_modeles')->get();
                         $agen = DB::table('agents')->where('user_id', Auth::user()->id)->first();
                         $modeles = DB::table('modeles')->where('res_dir',$agen->id)->orderBy('deadline', 'DESC')->get();
                         $activim = DB::table('modeles')->get();
                         $modeles_intervients = DB::table('modeles')
                                                ->select('modeles.*','tache_modeles.libelle as libel','tache_modeles.res_dir as res')
                                                ->join('tache_modeles', 'tache_modeles.modele_id', 'modeles.id')
                                                ->orderBy('deadline', 'DESC')->get();
                         $strategiques = DB::table('strategiques')->get();
                         
                         $ag = DB::table('agents')->where('user_id', Auth::user()->id)->first();
                         $strategiquess = DB::table('strategiques')->where('direction_id', $ag->direction_id)->get();
                         
                         $results_id = DB::table('strategiques')
                            ->select('strategiques.id')
                            ->get();
                            
                          $indi_array = array();
                          $sum_array = array();
                          $count_array = array();
                          
                          foreach($results_id as $resul)
                          {
                            $indicateurs_sum = DB::table('modeles')
                            ->select('modeles.*')
                            ->where('modeles.strategique_id', '=', $resul->id)
                             ->orWhereNull('modeles.strategique_id')
                            ->sum('modeles.pourcentage');
                            $indicateurs_global = DB::table('modeles')
                            ->select('modeles.*')
                            ->where('modeles.strategique_id', '=', $resul->id)
                             ->orWhereNull('modeles.strategique_id')
                            ->get();
                            $count = count($indicateurs_global); 
                            array_push($indi_array, $indicateurs_global);
                            
                             //$sum = $indicateurs_sum / $count;
                             $sum = $count == 0 ? 0 : $indicateurs_sum / $count;
                             array_push($sum_array,$sum);
                          }
                          
                           $results_ids = DB::table('strategiques')
                            ->select('id')->where('direction_id', $ag->direction_id)
                            ->get();
                            
                          $indi_arrays = array();
                          $sum_arrays = array();
                          $count_arrays = array();
                          $sums = array();
                          
                          $agen = DB::table('agents')->where('user_id', Auth::user()->id)->first();
                          
                          foreach($results_ids as $resuls)
                          {
                          
                          $age = DB::table('agents')->where('direction_id', $agen->direction_id)->get();
                              foreach($age as $ag)
                              {
                                $indicateurs_sums = DB::table('modeles')
                                ->select('modeles.*')
                                ->where('modeles.strategique_id', '=', $resuls->id)
                                ->where('modeles.res_dir', '=', $ag->id)
                                 ->orWhereNull('modeles.strategique_id')
                                ->sum('modeles.pourcentage');
                                $indicateurs_globals = DB::table('modeles')
                                ->select('modeles.*')
                                ->where('modeles.strategique_id', '=', $resuls->id)
                                ->where('modeles.res_dir', '=', $ag->id)
                                 ->orWhereNull('modeles.strategique_id')
                                ->get();
                                $counts = count($indicateurs_globals); 
                                array_push($indi_arrays, $indicateurs_globals);
                                
                                 //$sum = $indicateurs_sum / $count;
                                 $sums = $counts == 0 ? 0 : $indicateurs_sums / $counts;
                                 array_push($sum_arrays,$sums);
                              }
                          }
                          
                          $call_array = array();
                          $count_array = array();
                          $calpourcen_array = array();
                          $calculs = DB::table('strategiques')->get();
                          foreach($calculs as $calcul)
                          {
                            $calpourcen = DB::table('modeles')->where('strategique_id', '=', $calcul->id)
                            ->sum('modeles.pourcentage');
                            array_push($calpourcen_array,$calpourcen);
                            $compter = DB::table('modeles')->where('strategique_id', '=', $calcul->id)
                            ->count();
                             array_push($count_array,$compter);

                            $total = $compter == 0 ? 0 : $calpourcen / $compter ;
                            
                            array_push($call_array,$total);

                          }
                         $ageAction = DB::table('agents')->where('user_id',Auth::user()->id)->first();
                         $agent_id = DB::table('agents')
                            //->select('agents.id')
                           ->where('direction_id', $ageAction->direction_id)
                            ->get();
                            
                         $indi_array_agent = array();
                         $sum_array_agent = array();
                         $count_array_agent = array();
                         $actMoisagent = date('m');
                         foreach ($agent_id as $agentes){
                             
                             $action_count = DB::table('performances')
                            ->select('performances.*','agents.prenom','agents.nom','agents.direction_id')
                            ->join('agents', 'agents.id','=', 'performances.agent_id')
                            ->where('performances.agent_id', '=', $agentes->id)
                             ->where(DB::raw("(DATE_FORMAT(performances.created_at,'%m'))"), $actMoisagent)
                             ->count();
                             
                              $action_sum =  DB::table('performances')
                            ->select('performances.*','agents.prenom','agents.nom','agents.direction_id')
                            ->join('agents', 'agents.id','=', 'performances.agent_id')
                            ->where('performances.agent_id', '=', $agentes->id)
                             ->where(DB::raw("(DATE_FORMAT(performances.created_at,'%m'))"), $actMoisagent)
                             ->sum('performances.sommes');
                             
                             

                              $sum_agent = $action_count == 0 ? 0 : $action_sum / $action_count;
                             array_push($sum_array_agent,$sum_agent);
                             
                             
                         }
                         
                        
                         $date_today = now();
                         $decembre = date('Y-m');
                         $perfo_decembre_count = array();
                         $perfo_decembre_sum = array();
                         $perfo_decembre_total = array();
                         
                         $agent_mois = DB::table('agents')->where('user_id', Auth::user()->id)->first();
                         
                         
                           $action_agents_mois_sum = DB::table('actions')->select('actions.*')
                             ->where('actions.agent_id', $agent_mois->id)
                             
                             ->sum('actions.pourcentage');
                              $action_agents_mois_countss = DB::table('actions')->select('actions.*')
                             ->where('actions.agent_id', $agent_mois->id)->count();
                             
                             $total_pourcentage = $action_agents_mois_countss == 0 ? 0 : $action_agents_mois_sum / $action_agents_mois_countss;
                           // DB::table('performances')->insert(['agent_id' => $agent_mois->id, 'sommes' => $total_pourcentage,  'created_at' => $date_today, 'updated_at' => $date_today]);
                             
                             //dd($action_agents_mois_sum);
                             
                            //Ma Performance / mois / semaine / semaine passer 
                             
                             $semaine_passe = (date('d') - 7);
                             $semaineM = (date('d') - 7);
                             $semaineP = (date('d') + 7);
                             $mois = date('m');
                             
                             $somme_mois = 0;
                             $total_mois = array();
                             $total_semaine = array();
                             $total_semaine_passe = array();
                             $perfNows = DB::table('actions')->where('agent_id', $agent_mois->id)->get();
                             //dd($perfNows);
                             $var = array();
                             $vari = array();
                             
                             foreach($perfNows as $perfNow)
                             {
                                 if($semaine_passe == date('d', strtotime($perfNow->deadline)))
                                 {
                                     $somme_semaine_passe = $perfNow->pourcentage;
                                      //dd($somme_semaine_passe);
                                       array_push($vari,$perfNow);
                                      //dd($vari);
                                    array_push($total_semaine_passe, $somme_semaine_passe);
  
                                 }
                                  
                                 elseif((date('d', strtotime($perfNow->deadline)) > $semaineM) && ( date('d', strtotime($perfNow->deadline)) < $semaineP))
                                 {
                                      $somme_semaine = $perfNow->pourcentage;
                                      //$var += $perfNow;
                                      array_push($var,$perfNow);
                                      $semaine_count = count($perfNows);
                                      //dd($semaine_count);
                                     array_push($total_semaine, $somme_semaine);

                                 }
                                
                                 if($mois == date('m', strtotime($perfNow->deadline)))
                                 {
                                     
                                      $somme_mois = $perfNow->pourcentage;
                                      
                                      array_push($total_mois, $somme_mois);
                                     
                                  
                                     
                                 }
                                 
                                 
                               
                             }
                             
                             $semaine_passer = array_sum($total_semaine_passe);
                             $semaines = array_sum($total_semaine);
                             $perfoMe = count($var);
                             $perfoPastMe = count($total_semaine_passe);
                             $ma_semaine_total = $perfoMe == 0 ? 0 : $semaines / $perfoMe;
                             $ma_semaine_passe = $perfoPastMe == 0 ? 0 : $semaine_passer / $perfoPastMe;
                             $count_mois = count($total_mois);
                             //$omme = array_sum($total_semaine_passe);
                             
                             //dd(array_sum($total_mois));
                             $somme_total_mois = $count_mois == 0 ? 0 : (array_sum($total_mois) / $count_mois);
                         
                          //dd($somme_total_mois);
                          
                          // Performance de ma direction / mois / semaine / semaine passer
                          
                             $semaine_passe_dir = (date('d') - 7);
                             $semaine_dir = date('d');
                             $semaine_dirM = (date('d') - 5);
                             $semaine_dirP = (date('d') + 7);
                             $mois_dir = date('m');
                             
                             $somme_mois_dir = 0;
                             $total_mois_dir = array();
                             $total_semaine_dir = array();
                             $total_semaine_passe_dir = array();
                             
                             $agent_dirs = DB::table('agents')->where('direction_id', $agent_mois->direction_id)->get();
                             foreach($agent_dirs as $agent_dir)
                             {
                             $perfNows_dir = DB::table('actions')->where('agent_id', $agent_dir->id)->get();
                             foreach($perfNows_dir as $perfNow_dir)
                             {
                                 if($semaine_passe_dir == date('d', strtotime($perfNow_dir->deadline)))
                                 {
                                     $somme_semaine_passe_dir = $perfNow_dir->pourcentage;
                                      //dd($somme_semaine_passe);
                                    array_push($total_semaine_passe_dir, $somme_semaine_passe_dir);
  
                                 }
                                 
                                 elseif((date('d', strtotime($perfNow_dir->deadline)) > $semaine_dirM) && ( date('d', strtotime($perfNow_dir->deadline)) < $semaine_dirP))
                                 {
                                      $somme_semaine_dir = $perfNow_dir->pourcentage;
                                      //dd($somme_semaine);
                                     array_push($total_semaine_dir, $somme_semaine_dir);
                                     //dd($total_semaine_dir);

                                 }
                                
                                 if($mois_dir == date('m', strtotime($perfNow_dir->deadline)))
                                 {
                                     
                                      $somme_mois_dir = $perfNow_dir->pourcentage;
                                      
                                      array_push($total_mois_dir, $somme_mois_dir);
                                     
                                  
                                     
                                 }
                                 
                                 
                               
                             }
                             
                             }
                             $semaine_passer_dir = array_sum($total_semaine_passe_dir);
                             $semaines_dir = array_sum($total_semaine_dir);
                             $perfo_counts = count($total_semaine_dir);
                            //dd($perfo_counts);
                             $somme_total_semaine_dir = $perfo_counts == 0 ? 0 : $semaines_dir / $perfo_counts;
                             $count_mois_dir = count($total_mois_dir);
                             
                             //$omme = array_sum($total_semaine_passe);
                             
                             //dd(array_sum($total_mois));
                             $somme_total_mois_dir = $count_mois_dir == 0 ? 0 : (array_sum($total_mois_dir) / $count_mois_dir);

                              $direction_id = DB::table('directions')
                            ->select('directions.id')
                            ->get();
                             
                          $action_indi_array_dir = array();
                          $action_sum_array_dir = array();
                          $action_count_array_dir = array();
                         
                          foreach($direction_id as $dir)
                          {
                           
                            
                            $action_indicateurs_sum_dir = DB::table('actions')
                            ->select('actions.*','agents.prenom','agents.nom','agents.direction_id')
                            ->join('agents', 'agents.id','=', 'actions.agent_id')
                            ->where('agents.direction_id', '=', $dir->id)
                            //->orWhereNull('agents.direction_id')
                            //->where((DB::raw("DATE_FORMAT(performances.created_at, 'm') as formatted_dob")), $mois_dir)
                            ->where(DB::raw("(DATE_FORMAT(actions.deadline,'%m'))"), $mois_dir)
                            ->sum('actions.pourcentage');
                            //dd($action_indicateurs_sum_dir);
                            $action_indicateurs_global_dir = DB::table('actions')
                           ->select('actions.*','agents.prenom','agents.nom','agents.direction_id')
                            ->join('agents', 'agents.id','=', 'actions.agent_id')
                            ->where('agents.direction_id', '=', $dir->id)
                            //->orWhereNull('agents.direction_id')
                            //->where((DB::raw("DATE_FORMAT(performances.created_at, 'm') as formatted_dob")), $mois_dir)
                            ->where(DB::raw("(DATE_FORMAT(actions.deadline,'%m'))"), $mois_dir)
                
                            ->get();
                            $action_count_dir = count($action_indicateurs_global_dir); 
                            $action_sum_dir = $action_count_dir == 0 ? 0 : $action_indicateurs_sum_dir / $action_count_dir;
                        
                            array_push($action_sum_array_dir,$action_sum_dir);
                            
                           // dd($action_sum_array_dir);
                            
                           
                           
                          }

                         //dd($action_sum_array_dir);
                          
                        return view('projet.action_projet', compact('agent_id', 'pro', 'user', 'projets', 'semaines', 'semaine_passer', 'somme_total_mois','semaines_dir', 'semaine_passer_dir', 'somme_total_mois_dir','action_sum_array_dir', 'actions','action_escalades','my_agents','users','action_directions','headers',
                        'action_respons','action_bakups', 'sum_directions', 'action_users','strategiques','strategiquess',
                        'suivi_indicateurs','suivi_actions','date1','sum_directionss','sum_suivi_actions','sum_actions','directions','agents',
                        'sum_array_dir','taux_exe','sum','ma_semaine_total','sums','ma_semaine_passe','sum_dir','call_array','userAgents','total', 'activites','taches','activi','tache_modeles','modeles','activim','modeles_intervients','sum_array','sum_arrays','sum_array_agent','count_array_agent','somme_total_semaine_dir'));

    }


}
