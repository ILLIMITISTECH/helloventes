<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Action;
use App\Agent;
use App\Projet;
use App\Reunion;
use App\Suivi_action;
use App\Direction;
use DB;
use Auth;
use App\User;
use Session;
use App\Notifications\VousEtesLeLeadDeCetteAction;
use App\Notifications\AidezVotreCollegue;
class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        //
        //$actions = Action::all();
        $directions = Direction::all();
        /*$actions = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.responsable', 'actions.bakup', 'actions.libelle', 'actions.note',
         'actions.agent_id','actions.reunion_id',  'actions.visibilite',  'actions.risque', 'actions.delais',
          'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id')
          ->join('agents', 'agents.id', 'actions.agent_id')
          ->join('reunions', 'reunions.id', 'actions.reunion_id')
          ->get();*/
           $actions = DB::table('directions')
          ->join('agents', 'agents.direction_id', 'directions.id')
          ->join('actions', 'actions.agent_id', 'agents.id')
          //->leftjoin('suivi_actions', 'suivi_actions.action_id', 'actions.id')
          ->select('actions.id',
                  'actions.libelle', 'actions.responsable', 'actions.bakup', 'actions.raison','actions.deadline',
                  'actions.risque','actions.delais', 'actions.visibilite','actions.created_at', 'actions.pourcentage', 'actions.note',
                  'agents.prenom', 'agents.nom', 'agents.photo','agents.niveau_hieracie', 'agents.direction_id', 'agents.date_naiss', 'agents.id as Id',
                  'directions.nom_direction','directions.id as ID')
                  ->orderBY('actions.risque','ASC')
                  ->get();
                  $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('action/v2.lister', compact('actions','directions','headers'));
    } 
    
          public function edit_action_assignee($id)
    {
        //


        /* $suivi_action = Suivi_action::find($id);
        $actions = Action::all();
        return view('suivi_action.editer_d', compact('actions', 'suivi_action'));
 */
        $action = Action::find($id);
        $actions = Action::all();
        $agents = Agent::all();
        $reunions = Reunion::all();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('action/v2.action_assignee_edit', compact('actions', 'action','agents','reunions','headers'));
   
    }
  
   public function update_action_assignee(Request $request, $id)
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
            $action->agent_id = $request->get('agent_id'); 
            $action->reunion_id = $request->get('reunion_id');
            $action->raison = $request->get('raison');
            $action->update();

   
        return redirect('/action_assignee')->with(['message' => $message]);
    }
    
    public function action_cloture()
    {
        
         $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
        foreach($users as $user){
         
                    $actions = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.responsable','actions.bakup', 'actions.libelle', 'actions.note',
                    'actions.agent_id','actions.reunion_id','actions.raison',  'actions.visibilite',  'actions.risque', 'actions.delais','actions.pourcentage', 'actions.note','actions.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id'
                    )
                    ->join('agents', 'agents.id', 'actions.agent_id')
                    
                    ->where('actions.agent_id','=', $user->id)
                    ->orWhere('actions.bakup','=', $user->full_name)
                    ->get();
                    $action_mois = date('m');
                    $action_respons = array();
                    //dd($action_mois);
                    $action_responsf = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.responsable', 
                    'actions.libelle', 'actions.note',
                    'actions.agent_id','actions.reunion_id','actions.raison',  'actions.visibilite','actions.bakup', 
                    'actions.risque', 'actions.delais','actions.pourcentage', 'actions.note','actions.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id','directions.nom_direction'
                    )
                    ->join('agents', 'agents.id', 'actions.agent_id')
                    ->leftjoin('directions', 'directions.id', 'agents.direction_id')
                    ->where('actions.agent_id','=', $user->id)
                    //->orWhere('actions.bakup','=', $user->full_name)
                    ->orderBy('actions.pourcentage', 'ASC')
                    ->get();
                    
                    foreach($action_responsf as $action_respf)
                    {
                        if($action_mois == date('m', strtotime($action_respf->deadline)))
                        {
                            array_push($action_respons, $action_respf);
                            
                            //dd($action_respons);
                        }
                    }
                    
                    $action_bakups = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.responsable', 'actions.libelle', 'actions.note',
                    'actions.agent_id','actions.reunion_id','actions.raison',  'actions.visibilite','actions.bakup',  'actions.risque', 'actions.delais','actions.pourcentage', 'actions.note','actions.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id', 'agents.niveau_hieracie','directions.nom_direction'
                    )
                    ->join('agents', 'agents.id', 'actions.agent_id')
                    ->leftjoin('directions', 'directions.id', 'agents.direction_id')
                    //->where('actions.agent_id','=', $user->id)
                    ->where('actions.bakup','=', $user->full_name)
                    ->orderBy('actions.pourcentage', 'ASC')
                    ->get();
                    
                    $sum_actions = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.responsable','actions.bakup', 'actions.libelle', 'actions.note',
                    'actions.agent_id','actions.reunion_id','actions.raison',  'actions.visibilite',  'actions.risque', 'actions.delais','actions.pourcentage', 'actions.note','actions.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id'
                    )
                    ->join('agents', 'agents.id', 'actions.agent_id')
                    //->join('reunions', 'reunions.id', 'actions.reunion_id')
                    //->leftjoin('suivi_actions', 'suivi_actions.action_id', 'actions.id')
                    ->where('actions.agent_id','=', $user->id)
                    ->orWhere('actions.bakup','=', $user->full_name)
                    ->sum('actions.pourcentage');
        
                  $action_users = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.libelle', 'actions.note','actions.responsable',
                  'actions.agent_id','actions.reunion_id','actions.raison',  'actions.visibilite',  'actions.risque', 'actions.delais','actions.created_at',
                   'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id')
                   ->join('agents', 'agents.id', 'actions.agent_id')
                   //->join('reunions', 'reunions.id', 'actions.reunion_id')
                   ->where('agents.id','=', $user->id)
                   ->get();   
                  
         
           
        }
        $date1 = date('Y/m/d'); 
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        $act = DB::table('actions')->where('agent_id', $user->id)->where('visibilite', 1)->get();
                 
     return view('action/v2.user_action_cloture', compact('actions','action_users','headers','sum_actions','action_respons','action_bakups','date1', 'act'));
    }
     
    public function action_assignee()
    {
        
         $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
        foreach($users as $user){
                    
                    $actions = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.responsable','actions.bakup', 'actions.libelle', 'actions.note',
                    'actions.agent_id','actions.reunion_id','actions.raison',  'actions.visibilite',  'actions.risque', 'actions.delais','actions.pourcentage', 'actions.note','actions.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id'
                    )
                    ->join('agents', 'agents.id', 'actions.agent_id')
                    
                    ->where('actions.agent_auth_id','=', $user->id)
                    ->orderBy('actions.deadline', 'ASC')
                    //->orWhere('actions.bakup','=', $user->full_name)
                    ->get();
                    $action_mois = date('m');
                    $action_respons = array();
                    //dd($action_mois);
                    $action_responsf = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.responsable', 
                    'actions.libelle', 'actions.note',
                    'actions.agent_id','actions.reunion_id','actions.raison',  'actions.visibilite','actions.bakup', 
                    'actions.risque', 'actions.delais','actions.pourcentage', 'actions.note','actions.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id','directions.nom_direction'
                    )
                    ->join('agents', 'agents.id', 'actions.agent_id')
                    ->leftjoin('directions', 'directions.id', 'agents.direction_id')
                    ->where('actions.agent_id','=', $user->id)
                    //->orWhere('actions.bakup','=', $user->full_name)
                    ->orderBy('actions.pourcentage', 'ASC')
                    ->get();
                    
                    foreach($action_responsf as $action_respf)
                    {
                        if($action_mois == date('m', strtotime($action_respf->deadline)))
                        {
                            array_push($action_respons, $action_respf);
                            
                            //dd($action_respons);
                        }
                    }
                    
                    $action_bakups = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.responsable', 'actions.libelle', 'actions.note',
                    'actions.agent_id','actions.reunion_id','actions.raison',  'actions.visibilite','actions.bakup',  'actions.risque', 'actions.delais','actions.pourcentage', 'actions.note','actions.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id', 'agents.niveau_hieracie','directions.nom_direction'
                    )
                    ->join('agents', 'agents.id', 'actions.agent_id')
                    ->leftjoin('directions', 'directions.id', 'agents.direction_id')
                    //->where('actions.agent_id','=', $user->id)
                    ->where('actions.bakup','=', $user->full_name)
                    ->orderBy('actions.pourcentage', 'ASC')
                    ->get();
                    
                    $sum_actions = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.responsable','actions.bakup', 'actions.libelle', 'actions.note',
                    'actions.agent_id','actions.reunion_id','actions.raison',  'actions.visibilite',  'actions.risque', 'actions.delais','actions.pourcentage', 'actions.note','actions.created_at',
                    'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id'
                    )
                    ->join('agents', 'agents.id', 'actions.agent_id')
                    //->join('reunions', 'reunions.id', 'actions.reunion_id')
                    //->leftjoin('suivi_actions', 'suivi_actions.action_id', 'actions.id')
                    ->where('actions.agent_id','=', $user->id)
                    ->orWhere('actions.bakup','=', $user->full_name)
                    ->sum('actions.pourcentage');
        
                  $action_users = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.libelle', 'actions.note','actions.responsable',
                  'actions.agent_id','actions.reunion_id','actions.raison',  'actions.visibilite',  'actions.risque', 'actions.delais','actions.created_at',
                   'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id')
                   ->join('agents', 'agents.id', 'actions.agent_id')
                   //->join('reunions', 'reunions.id', 'actions.reunion_id')
                   ->where('agents.id','=', $user->id)
                   ->get();   
                  
         
           
        }
        $date1 = date('Y/m/d'); 
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        $act = DB::table('actions')->where('agent_id', $user->id)->where('visibilite', 1)->get();
                 
     return view('action/v2.user_action_assignee', compact('actions','action_users','headers','sum_actions','action_respons','action_bakups','date1', 'act'));
    }
     
    
     public function filter(Request $request){
        $search = $request->get('search');
        $directions = Direction::all();
        
      /*$actions = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.responsable', 'actions.bakup', 'actions.libelle', 'actions.note',
         'actions.agent_id','actions.reunion_id',  'actions.visibilite',  'actions.risque', 'actions.delais',
          'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id')
          ->join('agents', 'agents.id', 'actions.agent_id')
           ->where('actions.libelle', 'like', '%'.$search_a.'%')
           ->orderBy('actions.id')
          ->get();*/
          
          $actions = DB::table('directions')
          ->join('agents', 'agents.direction_id', 'directions.id')
          ->join('actions', 'actions.agent_id', 'agents.id')
          //->leftjoin('suivi_actions', 'suivi_actions.action_id', 'actions.id')
          ->select('actions.id',
                  'actions.libelle', 'actions.responsable', 'actions.bakup', 'actions.raison','actions.deadline',
                  'actions.risque','actions.delais', 'actions.visibilite','actions.created_at', 'actions.pourcentage', 'actions.note',
                  'agents.prenom', 'agents.nom', 'agents.photo','agents.niveau_hieracie', 'agents.direction_id', 'agents.date_naiss', 'agents.id as Id',
                  'directions.nom_direction','directions.id as ID')
                  ->where('directions.nom_direction', 'like', '%'.$search.'%')
                  ->orderBY('actions.risque','ASC')
                  ->get();
                  $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
                  ->where('user_id', Auth::user()->id)
                  ->join('directions', 'directions.id', 'agents.direction_id')
                  ->paginate(1);
        return view('action/v2.lister', compact('actions','action_directions','directions','headers'));
      }    

   public function voir_action_dg()
    {  
        //
        //$actions = Action::all();
        $directions = Direction::all();
        /*$actions = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.responsable', 'actions.bakup', 'actions.libelle', 'actions.note',
         'actions.agent_id','actions.reunion_id',  'actions.visibilite',  'actions.risque', 'actions.delais',
          'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id')
          ->join('agents', 'agents.id', 'actions.agent_id')
          ->join('reunions', 'reunions.id', 'actions.reunion_id')
          ->get();*/
           $actions = DB::table('directions')
          ->join('agents', 'agents.direction_id', 'directions.id')
          ->join('actions', 'actions.agent_id', 'agents.id')
          //->leftjoin('suivi_actions', 'suivi_actions.action_id', 'actions.id')
          ->select('actions.id',
                  'actions.libelle', 'actions.responsable', 'actions.bakup', 'actions.raison','actions.deadline',
                  'actions.risque','actions.delais', 'actions.visibilite','actions.created_at', 'actions.updated_at', 'actions.pourcentage', 'actions.note',
                  'agents.prenom', 'agents.nom', 'agents.photo','agents.niveau_hieracie', 'agents.direction_id', 'agents.date_naiss', 'agents.id as Id',
                  'directions.nom_direction','directions.id as ID')
                  ->orderBY('actions.risque','ASC')
                  ->get();
                  $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('action/v2.voir_action_dg', compact('actions','directions','headers'));
    } 

    public function filter_action_dg(Request $request){
        $search_action = $request->get('search_action');
        $directions = Direction::all();
          
          $actions = DB::table('directions')
          ->join('agents', 'agents.direction_id', 'directions.id')
          ->join('actions', 'actions.agent_id', 'agents.id')
          ->select('actions.id',
                  'actions.libelle', 'actions.responsable', 'actions.bakup', 'actions.raison','actions.deadline',
                  'actions.risque','actions.delais', 'actions.visibilite','actions.created_at', 'actions.updated_at', 'actions.pourcentage', 'actions.note',
                  'agents.prenom', 'agents.nom', 'agents.photo','agents.niveau_hieracie', 'agents.direction_id', 'agents.date_naiss', 'agents.id as Id',
                  'directions.nom_direction','directions.id as ID')
                  ->where('directions.nom_direction', 'like', '%'.$search_action.'%')
                  ->orderBY('actions.risque','ASC')
                  ->get();
                  $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
                  ->where('user_id', Auth::user()->id)
                  ->join('directions', 'directions.id', 'agents.direction_id')
                  ->paginate(1);
        return view('action/v2.voir_action_dg', compact('actions','directions','headers'));
      }  

      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajout_action_dg()
    {
        //
        $agents = Agent::all();
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
        return view('action/v2.ajout_action_dg', compact('agents','reunions','res_agents','headers'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajout_actionDG(Request $request)
    {
        request()->validate([
            'libelle' => 'required|string|max:255',
            'deadline' => 'required|string|max:255',

    ]);
            $message = "Action ajoutée avec succès";
            $action = new Action;
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
            $action->raison = $request->get('raison');
            
            if($action->save()){
                error_log('la création a réussi');
                $suivi_action = new Suivi_action;
                $suivi_action->deadline = $request->get('deadline');
                $suivi_action->pourcentage = $request->get('pourcentage'); 
                $suivi_action->note = $request->get('note');
                $suivi_action->delais = $request->get('delais');
                $suivi_action->action = $request->get('action');
                $suivi_action->action_id = $request->get('action_id');  
                $suivi_action->action_id = $action->id;
                $suivi_action->save();
            }
            return back()->with(['message' => $message]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $projet = Projet::all();
        $agents = Agent::orderBy('prenom')
        ->get();
        $res_agents = DB::table('agents')
        ->select('agents.prenom', 'agents.nom', 'agents.photo', 'agents.service_id', 'agents.date_naiss', 'agents.id',
        'services.nom_service','services.direction')
        ->join('services', 'services.id', 'agents.service_id')
        ->whereIn('agents.niveau_hieracie', array('Directeur' ,'Chef de Service'))
        
        // ->orWhere(function($query)
            //{
                //$query->where('services.nom_service', '=', 'Directeur Génerale')
                      //->where('services.nom_service', '=','Responsable Marketing')
                      //->where('services.nom_service',  '=','Responsable Stratégique');
            //})
        //->orwhere('services.nom_service', 'Directeur Génerale')
        //->orwhere('services.nom_service', 'Responsable Marketing')
        //->orwhere('services.nom_service', 'Responsable Stratégique')
        
        ->get();
        $reunions = Reunion::all();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('action/v2.create', compact('agents','reunions', 'projet', 'res_agents','headers'));

    }


public function showDirection(Request $request,$id)
    {
  //
        //$agents = Agent::all();
        $res_agents = DB::table('agents')
        ->select('agents.prenom', 'agents.nom', 'agents.photo', 'agents.service_id', 'agents.date_naiss', 'agents.id',
        'services.nom_service','services.direction')
        ->join('services', 'services.id', 'agents.service_id')
        ->get();
        $agents = DB::table('agents')
        ->select('agents.prenom', 'agents.nom', 'agents.photo', 'agents.service_id', 'agents.direction_id', 'agents.date_naiss', 'agents.id',
        'services.nom_service','services.direction','directions.nom_direction')
        ->join('services', 'services.id', 'agents.service_id')
        ->join('directions', 'directions.id', 'agents.direction_id')
        //->whereIn('directions.nom_direction', array('Direction Technique' ,'Direction Génerale','Direction Marketing','Direction Stratégique'))
        
              ->get();
        $reunions = Reunion::all();
        $directions = Direction::all();
        $direction = Direction::find($id);
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('action.ajouter', compact('agents','direction','reunions','res_agents','directions','headers'));
  
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'libelle' => 'required|string|max:255',
            'deadline' => 'required|string|max:255',

    ]);
    
            $agents = DB::table('agents')->where('user_id', Auth::user()->id)->first();
            $message = "Action ajoutée avec succès";
            $action = new Action;
            $action->libelle = $request->get('libelle');
            $action->deadline = $request->get('deadline'); 
            $action->visibilite = $request->get('visibilite');
            $action->note = $request->get('note');
            $action->risque = $request->get('risque'); 
            $action->delais = $request->get('delais'); 
             $action->projet_id = $request->get('projet_id');
             $action->kel_action = $request->get('kel_action');
            $action->reunion = $request->get('reunion');
            $action->responsable = $request->get('responsable');
            $action->bakup = $request->get('bakup');
            $action->agent = $request->get('agent');
            $action->pourcentage = $request->get('pourcentage');
            $action->agent_id = $request->get('agent_id');
             $action->agent_auth_id = $agents->id;
            // $action->projet_id = $request->get('projet_id');
            $action->reunion_id = $request->get('reunion_id');
            $action->raison = $request->get('raison');
            
            if($action->save()){
                error_log('la création a réussi');
                $suivi_action = new Suivi_action;
                $suivi_action->deadline = $request->get('deadline');
                $suivi_action->pourcentage = $request->get('pourcentage'); 
                $suivi_action->note = $request->get('note');
                $suivi_action->delais = $request->get('delais');
                $suivi_action->action = $request->get('action');
                $suivi_action->action_id = $request->get('action_id');  
                $suivi_action->action_id = $action->id;
                $suivi_action->save();
            }
             if ($action->agent_id != $action->agent_auth_id)
            {
                $agent = DB::table('agents')->where('id', $action->agent_id)->first();
               
                
                $user = User::where('id', $agent->user_id)->first();
                
                $user->notify(new VousEtesLeLeadDeCetteAction());
               
                //dd($action);
            }
             if ($action->bakup != $action->agent_auth_id)
            {
                $agent = DB::table('agents')->where('id', $action->bakup)->first();
                    if ($agent){
                $user = User::where('id', $agent->user_id)->first();
                
                $user->notify(new AidezVotreCollegue());
                    }
                //dd($action);
            }
           
            return back()->with(['message' => $message]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
         public function edit_action_user2($id)
    {
        //


        /* $suivi_action = Suivi_action::find($id);
        $actions = Action::all();
        return view('suivi_action.editer_d', compact('actions', 'suivi_action'));
 */
        $action = Action::find($id);
        $actions = Action::all();
        $agents = Agent::all();
        $reunions = Reunion::all();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('action/v2.actionuser_edit2', compact('actions', 'action','agents','reunions','headers'));
   
    }
  
   public function update_action_user2(Request $request, $id)
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
            $action->agent_id = $request->get('agent_id'); 
            $action->reunion_id = $request->get('reunion_id');
            $action->raison = $request->get('raison');
            $action->update();

   
        return redirect('/user_toute_action')->with(['message' => $message]);
    }
    
    public function edit($id)
    {
        //
        $action = Action::find($id);
        $agents = Agent::all();
        $res_agents = DB::table('agents')
        ->select('agents.prenom', 'agents.nom', 'agents.photo', 'agents.service_id', 'agents.date_naiss', 'agents.id',
        'services.nom_service','services.direction')
        ->join('services', 'services.id', 'agents.service_id')
        ->whereIn('agents.niveau_hieracie', array('Directeur' ,'Chef de Service'))
        
        // ->orWhere(function($query)
            //{
                //$query->where('services.nom_service', '=', 'Directeur Génerale')
                      //->where('services.nom_service', '=','Responsable Marketing')
                      //->where('services.nom_service',  '=','Responsable Stratégique');
            //})
        //->orwhere('services.nom_service', 'Directeur Génerale')
        //->orwhere('services.nom_service', 'Responsable Marketing')
        //->orwhere('services.nom_service', 'Responsable Stratégique')
        
        ->get();
        $reunions = Reunion::all();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('action/v2.edite', compact('agents','reunions', 'action','res_agents','headers'));

    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request  
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $message = "Action mise à jour avec succès ! ";
         $message = "Action mise à jour avec succès ! ";
       /*  $action = Action::find($id);
        $actionUpdate = $request->all();
        $action->update($actionUpdate); */

            $action = Action::find($id);
            $action->libelle = $request->get('libelle');
            $action->deadline = $request->get('deadline'); 
            $action->visibilite = $request->get('visibilite');
            $action->note = $request->get('note');
            $action->risque = $request->get('risque');   
            $action->delais = $request->get('delais'); 
            $action->reunion = $request->get('reunion');
            $action->responsable = $request->get('responsable');
            $action->agent = $request->get('agent');
            $action->pourcentage = $request->get('pourcentage'); 
            // $action->agent_id = $request->get('agent_id'); 
            $action->reunion_id = $request->get('reunion_id');
            $action->raison = $request->get('raison');
            $action->update();

        return redirect('/actions')->with(['message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $action = Action::find($id);
        $action->delete();

        return back();
    }
    
      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajout_action_asigneRES()
    {
        //
         $asignes = DB::table('agents')->where('user_id', Auth::user()->id)->get();
         //->select('agents.id','agents.prenom', 'agents.nom','directions.nom_direction')
        //->where('user_id', Auth::user()->id)
        //->join('directions', 'directions.id', 'agents.direction_id')
        //->get();
        foreach($asignes as $asigne)
        {
        $agents = DB::table('agents')->where('agents.direction_id', '=', $asigne->direction_id)->get();
        $res_agents = DB::table('agents')
        ->select('agents.prenom', 'agents.nom', 'agents.photo', 'agents.service_id', 'agents.date_naiss', 'agents.id',
        'services.nom_service','services.direction')
        ->join('services', 'services.id', 'agents.service_id')
        ->whereIn('agents.niveau_hieracie', array('Directeur' ,'Chef de Service'))        
        ->get();
        }
        $reunions = Reunion::all();
        
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('action/v2.ajout_action_asigneRES', compact('agents','reunions','res_agents','headers','asignes'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajout_actionAsigneRES(Request $request)
    {
        request()->validate([
            'libelle' => 'required|string|max:255',
            'deadline' => 'required|string|max:255',

    ]);
            $message = "Action ajoutée avec succès";
            $action = new Action;
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
            $action->raison = $request->get('raison');
            
            if($action->save()){
                error_log('la création a réussi');
                $suivi_action = new Suivi_action;
                $suivi_action->deadline = $request->get('deadline');
                $suivi_action->pourcentage = $request->get('pourcentage'); 
                $suivi_action->note = $request->get('note');
                $suivi_action->delais = $request->get('delais');
                $suivi_action->action = $request->get('action');
                $suivi_action->action_id = $request->get('action_id');  
                $suivi_action->action_id = $action->id;
                $suivi_action->save();
            }
            return back()->with(['message' => $message]);

    }
    
      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajout_action_asigneRAP()
    {
        $asignes = DB::table('agents')->where('user_id', Auth::user()->id)->get();
         //->select('agents.id','agents.prenom', 'agents.nom','directions.nom_direction')
        //->where('user_id', Auth::user()->id)
        //->join('directions', 'directions.id', 'agents.direction_id')
        //->get();
        foreach($asignes as $asigne)
        {
        $agents = DB::table('agents')->where('agents.direction_id', '=', $asigne->direction_id)->get();
        $res_agents = DB::table('agents')
        ->select('agents.prenom', 'agents.nom', 'agents.photo', 'agents.service_id', 'agents.date_naiss', 'agents.id',
        'services.nom_service','services.direction')
        ->join('services', 'services.id', 'agents.service_id')
        ->whereIn('agents.niveau_hieracie', array('Directeur' ,'Chef de Service'))        
        ->get();
        }
        $reunions = Reunion::all();
        
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('action/v2.ajout_action_asigneRAP', compact('agents','reunions','res_agents','headers','asignes'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajout_actionAsigneRAP(Request $request)
    {
        request()->validate([
            'libelle' => 'required|string|max:255',
            'deadline' => 'required|string|max:255',

    ]);
            $message = "Action ajoutée avec succès";
            $action = new Action;
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
            $action->raison = $request->get('raison');
            
            if($action->save()){
                error_log('la création a réussi');
                $suivi_action = new Suivi_action;
                $suivi_action->deadline = $request->get('deadline');
                $suivi_action->pourcentage = $request->get('pourcentage'); 
                $suivi_action->note = $request->get('note');
                $suivi_action->delais = $request->get('delais');
                $suivi_action->action = $request->get('action');
                $suivi_action->action_id = $request->get('action_id');  
                $suivi_action->action_id = $action->id;
                $suivi_action->save();
            }
            return back()->with(['message' => $message]);

    }
    
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajout_action_asignerespon()
    {
        //
         $asignes = DB::table('agents')->where('user_id', Auth::user()->id)->get();
         //->select('agents.id','agents.prenom', 'agents.nom','directions.nom_direction')
        //->where('user_id', Auth::user()->id)
        //->join('directions', 'directions.id', 'agents.direction_id')
        //->get();
        foreach($asignes as $asigne)
        {
        $agents = DB::table('agents')->get();
        $res_agents = DB::table('agents')
        ->select('agents.prenom', 'agents.nom', 'agents.photo', 'agents.service_id', 'agents.date_naiss', 'agents.id',
        'services.nom_service','services.direction')
        ->join('services', 'services.id', 'agents.service_id')
        ->whereIn('agents.niveau_hieracie', array('Directeur' ,'Chef de Service'))        
        ->get();
        }
        $reunions = Reunion::all();
        
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('action/v2.ajout_action_asignerespon', compact('agents','reunions','res_agents','headers','asignes'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajout_actionAsignerespon(Request $request)
    {
        request()->validate([
            'libelle' => 'required|string|max:255',
            'deadline' => 'required|string|max:255',

    ]);
            $message = "Action ajoutée avec succès";
            $action = new Action;
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
            $action->raison = $request->get('raison');
            
            if($action->save()){
                error_log('la création a réussi');
                $suivi_action = new Suivi_action;
                $suivi_action->deadline = $request->get('deadline');
                $suivi_action->pourcentage = $request->get('pourcentage'); 
                $suivi_action->note = $request->get('note');
                $suivi_action->delais = $request->get('delais');
                $suivi_action->action = $request->get('action');
                $suivi_action->action_id = $request->get('action_id');  
                $suivi_action->action_id = $action->id;
                $suivi_action->save();
            }
            return back()->with(['message' => $message]);

    }
    
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajout_action_asigneresponRAP()
    {
        $asignes = DB::table('agents')->where('user_id', Auth::user()->id)->get();
         //->select('agents.id','agents.prenom', 'agents.nom','directions.nom_direction')
        //->where('user_id', Auth::user()->id)
        //->join('directions', 'directions.id', 'agents.direction_id')
        //->get();
        foreach($asignes as $asigne)
        {
        $agents = DB::table('agents')->get();
        $res_agents = DB::table('agents')
        ->select('agents.prenom', 'agents.nom', 'agents.photo', 'agents.service_id', 'agents.date_naiss', 'agents.id',
        'services.nom_service','services.direction')
        ->join('services', 'services.id', 'agents.service_id')
        ->whereIn('agents.niveau_hieracie', array('Directeur' ,'Chef de Service'))        
        ->get();
        }
        $reunions = Reunion::all();
        
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('action/v2.ajout_action_asigneresponRAP', compact('agents','reunions','res_agents','headers','asignes'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajout_actionAsigneresponRAP(Request $request)
    {
        request()->validate([
            'libelle' => 'required|string|max:255',
            'deadline' => 'required|string|max:255',

    ]);
            $message = "Action ajoutée avec succès";
            $action = new Action;
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
            $action->raison = $request->get('raison');
            
            if($action->save()){
                error_log('la création a réussi');
                $suivi_action = new Suivi_action;
                $suivi_action->deadline = $request->get('deadline');
                $suivi_action->pourcentage = $request->get('pourcentage'); 
                $suivi_action->note = $request->get('note');
                $suivi_action->delais = $request->get('delais');
                $suivi_action->action = $request->get('action');
                $suivi_action->action_id = $request->get('action_id');  
                $suivi_action->action_id = $action->id;
                $suivi_action->save();
            }
            return back()->with(['message' => $message]);

    }
    
    
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajout_action_user_moi()
    {
        $asignes = DB::table('agents')->where('user_id', Auth::user()->id)->get();
         //->select('agents.id','agents.prenom', 'agents.nom','directions.nom_direction')
        //->where('user_id', Auth::user()->id)
        //->join('directions', 'directions.id', 'agents.direction_id')
        //->get();
        // foreach($asignes as $asigne)
        // {
        $agents = DB::table('agents')->get();
        $res_agents = DB::table('agents')
        ->select('agents.prenom', 'agents.nom', 'agents.photo', 'agents.service_id','agents.direction_id', 'agents.date_naiss', 'agents.id',
        'services.nom_service','services.direction')
        ->join('services', 'services.id', 'agents.service_id')
        ->whereIn('agents.niveau_hieracie', array('Directeur' ,'Chef de Service'))        
        ->get();
        // }
        $reunions = Reunion::all();
        
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('action/v2.ajout_user_moi', compact('agents','reunions','res_agents','headers','asignes'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajout_actionAuser_moi(Request $request)
    {
        request()->validate([
            'libelle' => 'required|string|max:255',
            'deadline' => 'required|string|max:255',

    ]);
            $message = "Action ajoutée avec succès";
            $action = new Action;
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
            $action->raison = $request->get('raison');
            
            if($action->save()){
                error_log('la création a réussi');
                $suivi_action = new Suivi_action;
                $suivi_action->deadline = $request->get('deadline');
                $suivi_action->pourcentage = $request->get('pourcentage'); 
                $suivi_action->note = $request->get('note');
                $suivi_action->delais = $request->get('delais');
                $suivi_action->action = $request->get('action');
                $suivi_action->action_id = $request->get('action_id');  
                $suivi_action->action_id = $action->id;
                $suivi_action->save();
            }
            return redirect('admin/dashboard/user')->with(['message' => $message]);

    }
    
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajout_action_rap_moi()
    {
        $asignes = DB::table('agents')->where('user_id', Auth::user()->id)->get();
         //->select('agents.id','agents.prenom', 'agents.nom','directions.nom_direction')
        //->where('user_id', Auth::user()->id)
        //->join('directions', 'directions.id', 'agents.direction_id')
        //->get();
        foreach($asignes as $asigne)
        {
        $agents = DB::table('agents')->get();
        $res_agents = DB::table('agents')
        ->select('agents.prenom', 'agents.nom', 'agents.photo', 'agents.service_id', 'agents.date_naiss', 'agents.id',
        'services.nom_service','services.direction')
        ->join('services', 'services.id', 'agents.service_id')
        ->whereIn('agents.niveau_hieracie', array('Directeur' ,'Chef de Service'))        
        ->get();
        }
        $reunions = Reunion::all();
        
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('action/v2.ajout_rap_moi', compact('agents','reunions','res_agents','headers','asignes'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajout_actionArap_moi(Request $request)
    {
        request()->validate([
            'libelle' => 'required|string|max:255',
            'deadline' => 'required|string|max:255',

    ]);
            $message = "Action ajoutée avec succès";
            $action = new Action;
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
            $action->raison = $request->get('raison');
            
            if($action->save()){
                error_log('la création a réussi');
                $suivi_action = new Suivi_action;
                $suivi_action->deadline = $request->get('deadline');
                $suivi_action->pourcentage = $request->get('pourcentage'); 
                $suivi_action->note = $request->get('note');
                $suivi_action->delais = $request->get('delais');
                $suivi_action->action = $request->get('action');
                $suivi_action->action_id = $request->get('action_id');  
                $suivi_action->action_id = $action->id;
                $suivi_action->save();
            }
            return back()->with(['message' => $message]);

    }
    
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajout_action_responsable_moi()
    {
        $asignes = DB::table('agents')->where('user_id', Auth::user()->id)->get();
         //->select('agents.id','agents.prenom', 'agents.nom','directions.nom_direction')
        //->where('user_id', Auth::user()->id)
        //->join('directions', 'directions.id', 'agents.direction_id')
        //->get();
        foreach($asignes as $asigne)
        {
        $agents = DB::table('agents')->get();
        $res_agents = DB::table('agents')
        ->select('agents.prenom', 'agents.nom', 'agents.photo', 'agents.service_id', 'agents.date_naiss', 'agents.id',
        'services.nom_service','services.direction')
        ->join('services', 'services.id', 'agents.service_id')
        ->whereIn('agents.niveau_hieracie', array('Directeur' ,'Chef de Service'))        
        ->get();
        }
        $reunions = Reunion::all();
        
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('action/v2.ajout_responsable_moi', compact('agents','reunions','res_agents','headers','asignes'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajout_actionAresponsable_moi(Request $request)
    {
        request()->validate([
            'libelle' => 'required|string|max:255',
            'deadline' => 'required|string|max:255',

    ]);
            $message = "Action ajoutée avec succès";
            $action = new Action;
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
            $action->raison = $request->get('raison');
            
            if($action->save()){
                error_log('la création a réussi');
                $suivi_action = new Suivi_action;
                $suivi_action->deadline = $request->get('deadline');
                $suivi_action->pourcentage = $request->get('pourcentage'); 
                $suivi_action->note = $request->get('note');
                $suivi_action->delais = $request->get('delais');
                $suivi_action->action = $request->get('action');
                $suivi_action->action_id = $request->get('action_id');  
                $suivi_action->action_id = $action->id;
                $suivi_action->save();
            }
            return back()->with(['message' => $message]);

    }
    
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajout_action_dg_moi()
    {
        $asignes = DB::table('agents')->where('user_id', Auth::user()->id)->get();
         //->select('agents.id','agents.prenom', 'agents.nom','directions.nom_direction')
        //->where('user_id', Auth::user()->id)
        //->join('directions', 'directions.id', 'agents.direction_id')
        //->get();
        foreach($asignes as $asigne)
        {
        $agents = DB::table('agents')->get();
        $res_agents = DB::table('agents')
        ->select('agents.prenom', 'agents.nom', 'agents.photo', 'agents.service_id', 'agents.date_naiss', 'agents.id',
        'services.nom_service','services.direction')
        ->join('services', 'services.id', 'agents.service_id')
        ->whereIn('agents.niveau_hieracie', array('Directeur' ,'Chef de Service'))        
        ->get();
        }
        $reunions = Reunion::all();
        
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('action/v2.ajout_dg_moi', compact('agents','reunions','res_agents','headers','asignes'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajout_actionAdg_moi(Request $request)
    {
        request()->validate([
            'libelle' => 'required|string|max:255',
            'deadline' => 'required|string|max:255',

    ]);
            $message = "Action ajoutée avec succès";
            $action = new Action;
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
            $action->raison = $request->get('raison');
            
            if($action->save()){
                error_log('la création a réussi');
                $suivi_action = new Suivi_action;
                $suivi_action->deadline = $request->get('deadline');
                $suivi_action->pourcentage = $request->get('pourcentage'); 
                $suivi_action->note = $request->get('note');
                $suivi_action->delais = $request->get('delais');
                $suivi_action->action = $request->get('action');
                $suivi_action->action_id = $request->get('action_id');  
                $suivi_action->action_id = $action->id;
                $suivi_action->save();
            }
            return back()->with(['message' => $message]);

    }

}
