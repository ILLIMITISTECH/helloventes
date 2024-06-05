<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activite;
use App\Agent;
use App\Strategique;
use App\Tache;
use App\Tache_modele;
use App\Modele;
use App\Suivi_action;   
use App\Action;
use App\Service;
use App\Annonce;
use App\Reunion;
use App\Decission;
use App\Direction;
use App\Categorie;
use App\User;
use App\Role;
use DB;
use Auth;
use Mail;


class ActiviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $activites = DB::table('activites')->get();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('activite/v2.lister', compact('activites','headers'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function modeles_activites()
    {
        //
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
                        $annonces = Annonce::all();   
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
                           
                            
                            $indicateurs_sum_dir = DB::table('actions')
                            ->select('actions.*','agents.prenom','agents.nom','agents.direction_id')
                            ->join('agents', 'agents.id','=', 'actions.agent_id')
                            ->where('agents.direction_id', '=', $dir->id)
                            ->orWhereNull('agents.direction_id')
                            ->sum('actions.pourcentage');
                            $indicateurs_global_dir = DB::table('actions')
                            ->select('actions.*','agents.prenom','agents.nom','agents.direction_id')
                            ->join('agents', 'agents.id','=', 'actions.agent_id')
                            ->where('agents.direction_id', '=', $dir->id)
                            ->orWhereNull('agents.direction_id')
                
                            ->get();
                            
                            $count_dir = count($indicateurs_global_dir); 
                            array_push($indi_array_dir, $indicateurs_global_dir);
                            
                              $sum_dir = $count_dir == 0 ? 0 : $indicateurs_sum_dir / $count_dir;
                             array_push($sum_array_dir,$sum_dir);
                             
                             $sum_total_dir = array_sum($sum_array_dir);
                             $counts_dir = count($sum_array_dir);
                
                          }
                         $taux_exe = $sum_total_dir / $counts_dir;
                         
                         $count_actions = count($actions);
                         $sum = $count_actions == 0 ? 0 : $sum_actions / $count_actions;
                         
                         $count_actions_dir = count($action_directions);
                         $sum_dir = $count_actions_dir == 0 ? 0 : $sum_directions / $count_actions_dir;
                         
                         $userAgents = User::all();
                         $taches = DB::table('taches')->get();
                         $activites = DB::table('activites')->orderBy('deadline', 'DESC')->get();
                         $activi = DB::table('activites')->get();
                         $strategiques = DB::table('strategiques')->get();
                         
                        return view('activite/v2.modeles_activites', compact('actions','action_escalades','my_agents','users','action_directions','headers',
                        'action_respons','action_bakups', 'sum_directions','annonces', 'action_users',
                        'suivi_indicateurs','suivi_actions','date1','sum_directionss','sum_suivi_actions','sum_actions','directions','agents',
                        'sum_array_dir','taux_exe','sum','sum_dir','userAgents','activites','taches','activi','strategiques'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $agents = Agent::all();
        $strategiques = Strategique::all();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('activite/v2.create', compact('agents','strategiques','headers'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
            $messagea = "Activitée a été ajouté avec succès !";
            $messagem = "Le modèle a été enregistré avec succès !";
            
            $activite = new Activite;
            $activite->libelle = $request->get('libelle_act');
            $activite->res_dir = $request->get('res_dirs');
            $activite->backup = $request->get('backup');
            $activite->deadline = $request->get('deadlines');
            $activite->strategique_id = $request->get('strategique_id');
            $activite->categorie_id = $request->get('categorie_id');
            $activite->createur_id = Auth::user()->id;
            $activite->statut = $request->get('statut');
            $activite->date_debut = $request->get('date_debut');
            $activite->save();
            
            $libelle = $request->libelle;
            $res_dir = $request->res_dir;
            $deadline = $request->deadline;
            for($i=0; $i < count($libelle); $i++){
            
            $taches = [
                'libelle' => $libelle[$i],
                'res_dir' => $res_dir[$i],
                'deadline' => $deadline[$i],
                'activite_id' => $activite->id,
                'created_at' => $activite->created_at,
                'updated_at' => $activite->updated_at
                ];
            DB::table('taches')->insert($taches);
            }
            
            if($activite->statut = 1)
            {
            $modele = new Modele;
            $modele->libelle = $request->get('libelle_act');
            $modele->res_dir = $request->get('res_dirs');
            $modele->backup = $request->get('backup');
            $modele->deadline = $request->get('deadlines');
            $modele->strategique_id = $request->get('strategique_id');
            $modele->categorie_id = $request->get('categorie_id');
            $modele->createur_id = Auth::user()->id;
            //$modele->statut = $request->get('statut');
            $modele->date_debut = $request->get('date_debut');
            $modele->save();
            
            $libelle = $request->libelle;
            $res_dir = $request->res_dir;
            $deadline = $request->deadline;
            for($i=0; $i < count($libelle); $i++){
            
            $tache_modeles = [
                'libelle' => $libelle[$i],
                'res_dir' => $res_dir[$i],
                'deadline' => $deadline[$i],
                'modele_id' => $modele->id,
                'created_at' => $modele->created_at,
                'updated_at' => $modele->updated_at
                ];
            DB::table('tache_modeles')->insert($tache_modeles);
            }
            }
            
            //$modele = new Modele;
            //$modele->activite_id = $activite->id;
            //$modele->createur_id = Auth::user()->id;
            //$modele->save();
           
            if($activite->statut = 1)
            {
            return redirect('/v3/admin/dashboard')->with(['messagem' => $messagem]);
            }
            else{
               return redirect('/v3/admin/dashboard')->with(['messagea' => $messagea]); 
            }

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
    public function edit($id)
    {
        //
        $activite = Activite::find($id);
        $agents = Agent::all();
        $strategiques = Strategique::all();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('activite/v2.edite', compact('activite','agents','strategiques','headers'));

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

            $message = "activite modifée avec succée";
            $activite = Activite::find($id);
            $activite->libelle = $request->get('libelle');
            $activite->res_dir = $request->get('res_dir');
            $activite->backup = $request->get('backup');
            $activite->nbr_jour = $request->get('nbr_jour');
            $activite->deadline = $request->get('deadline');
            $activite->pourcentage = $request->get('pourcentage');
            $activite->strategique_id = $request->get('strategique_id');
            $activite->date_debut = $request->get('date_debut');
            $activite->update();

        return redirect('/activites')->with(['message' => $message]);
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
        $activite = Activite::find($id);
        $activite->delete();

        return back();
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_dg()
    {
        //
        $agents = Agent::all();
        $strategiques = Strategique::all();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('activite/v2.dg_create', compact('agents','strategiques','headers'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_dg(Request $request)
    {
            $messagea = "Activitée a été ajoutée avec succès !";
            $messagem = "Le modèle a été enregistré avec succès !";
            $date = date('y-m-d h:i:s');
            
            $activite = new Activite;
            $activite->libelle = $request->get('libelle_act');
            $activite->res_dir = $request->get('res_dirs');
            $activite->backup = $request->get('backup');
            $activite->deadline = $request->get('deadlines');
            $activite->strategique_id = $request->get('strategique_id');
            $activite->categorie_id = $request->get('categorie_id');
            $activite->createur_id = Auth::user()->id;
            $activite->statut = $request->get('statut');
            $activite->date_debut = $request->get('date_debut');
            $activite->save();
            
            
            
            $libelle = $request->libelle;
            $res_dir = $request->res_dir;
            $deadline = $request->deadline;
            for($i=0; $i < count($libelle); $i++){
            
            $taches = [
                'libelle' => $libelle[$i],
                'res_dir' => $res_dir[$i],
                'deadline' => $deadline[$i],
                'activite_id' => $activite->id,
                'created_at' => $date,
                'updated_at' => $activite->updated_at
                ];
            DB::table('taches')->insert($taches);
            }
            
            if($activite->statut = 1)
            {
            $modele = new Modele;
            $modele->libelle = $request->get('libelle_act');
            $modele->res_dir = $request->get('res_dirs');
            $modele->backup = $request->get('backup');
            $modele->deadline = $request->get('deadlines');
            $modele->strategique_id = $request->get('strategique_id');
            $modele->categorie_id = $request->get('categorie_id');
            $modele->createur_id = Auth::user()->id;
            //$modele->statut = $request->get('statut');
            $modele->date_debut = $request->get('date_debut');
            $modele->save();
            
            $libelle = $request->libelle;
            $res_dir = $request->res_dir;
            $deadline = $request->deadline;
            for($i=0; $i < count($libelle); $i++){
            
            $tache_modeles = [
                'libelle' => $libelle[$i],
                'res_dir' => $res_dir[$i],
                'deadline' => $deadline[$i],
                'modele_id' => $modele->id,
                'created_at' => $date,
                'updated_at' => $modele->updated_at
                ];
            DB::table('tache_modeles')->insert($tache_modeles);
            }
            }
            $agen = DB::table('agents')->where('id',$modele->res_dir)->first();
            $agenb = DB::table('agents')->where('id',$modele->backup)->first();
            $taces = DB::table('tache_modeles')->where('modele_id',$modele->id)->get();
            $tacess = DB::table('tache_modeles')->select('res_dir')->where('modele_id',$modele->id)->get();

            $lib = $modele->libelle;
            $pre = substr($agen->prenom, 0, 1);
            $nm = substr($agen->nom, 0, 1);
            $pour = $modele->pourcentage;
            $dte = strftime("%d/%m/%Y", strtotime($modele->deadline));
            
             //$users = User::all();
        //foreach($users as $user){
            //Auth::login($user);
            //$user->notify(new BonDebutDeSemaine());
                $person = Auth::user();
                    
                //$prenom = $user->prenom;
                foreach($tacess as $ta)
                {
                $agensss = DB::table('agents')->select('email')->where('agents.id',$ta->res_dir)->get();
                foreach($agensss as $ag)
                {
                 $to = "$ag->email,$agenb->email,$agen->email,fallougueye197@gmail.com";  
                }
                }
                
                $subject = "Une activité sur laquelle tu interviens vient d'être ajoutée  !";
                           
                            $body = "
                            <!doctype html>

<html
    xmlns='http://www.w3.org/1999/xhtml'
    xmlns:v='urn:schemas-microsoft-com:vml'
    xmlns:o='urn:schemas-microsoft-com:office:office'>
    <head>
        <title>Alerte échéance</title><!--[if !mso]><!-- --><meta http-equiv='X-UA-Compatible' content='IE=edge'><!--<![endif]--><meta http-equiv='Content-Type' content='text/html; charset=UTF-8'><meta name='viewport' content='width=device-width,initial-scale=1'>
        <style type='text/css'>
            #outlook a {
                padding: 0;
            }
            body {
                margin: 0;
                padding: 0;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
            }
            table,
            td {
                border-collapse: collapse;
                mso-table-lspace: 0;
                mso-table-rspace: 0;
            }
            img {
                border: 0;
                height: auto;
                line-height: 100%;
                outline: none;
                text-decoration: none;
                -ms-interpolation-mode: bicubic;
            }
            p {
                display: block;
                margin: 13px 0;
            }
        </style><!--[if mso]> <xml> <o:OfficeDocumentSettings> <o:AllowPNG/>
        <o:PixelsPerInch>96</o:PixelsPerInch> </o:OfficeDocumentSettings> </xml>
        <![endif]--><!--[if
            lte mso 11]> <style type='text/css'> .mj-outlook-group-fix { width:100%
            !important; } </style> <![endif]--><!--[if !mso]><!--><link
            href='https://fonts.googleapis.com/css?family=Poppins'
            rel='stylesheet'
            type='text/css'>
        <style type='text/css'>
            @import url(https://fonts.googleapis.com/css?family=Poppins);
            </style > <!--<![endif]-- > <style type='text/css' > @media only screen and (min-width:480px) {
                .mj-column-per-100 {
                    width: 100% !important;
                    max-width: 100%;
                }
            }
        </style>
        <style type='text/css'>
            [owa] .mj-column-per-100 {
                width: 100% !important;
                max-width: 100%;
            }
        </style>
        <style type='text/css'></style>
    </head>
    <body style='background-color:#F4F4F4;'>
        <div style='background-color:#F4F4F4;'>
            <!--[if mso | IE]><table align='center' border='0' cellpadding='0'
            cellspacing='0' class='' style='width:600px;' width='600' ><tr><td
            style='line-height:0px;font-size:0px;mso-line-height-rule:exactly;'><![endif]-->
            <div
                style='background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;'>
                
                   
                    <div class='mj-column-per-100 mj-outlook-group-fix' style='font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;'>
                                   
                                                align='left'
                                                style='font-size:0px;padding:0px 25px 0px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;'>
                                                <div
                                                    style='font-family:Arial, sans-serif;font-size:18px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;'>
                                                    <p
                                                        class='text-build-content'
                                                        data-testid='nu8exbGuE2'
                                                        style='margin: 10px 0; margin-top: 10px;'>
                                                        <span style='font-family:Poppins;font-size:18px;'>
                                                            <b>Hello !</b></span></p>
                                                    <p
                                                        class='text-build-content'
                                                        data-testid='nu8exbGuE2'
                                                        style='margin: 10px 0; margin-bottom: 10px;'>
                                                        <span style='font-family:Poppins;font-size:16px;'>Une
                                                        </span>
                                                        <span style='color:#113ef3;font-family:Poppins;font-size:16px;'>
                                                            <b>activité sur laquelle tu interviens</b>
                                                        </span>
                                                        <span style='font-family:Poppins;font-size:16px;'>
                                                            vient d'être ajoutée, jette un coup d'oeil aux tâches qui te sont assignées
                                                            : </span></p>
                                                </div>
                                      
                              
                                                <p
                                                    style='border-top:solid 2px #000000;font-size:1px;margin:0px auto;width:100%;'></p>
                                                <!--[if mso | IE]><table align='center' border='0' cellpadding='0'
                                                cellspacing='0' style='border-top:solid 2px #000000;font-size:1px;margin:0px
                                                auto;width:550px;' role='presentation' width='550px' ><tr><td
                                                style='height:0;line-height:0;'>  ; </td></tr></table><![endif]-->
           
            </div>
            <!--[if mso | IE]></td></tr></table><table align='center' border='0'
            cellpadding='0' cellspacing='0' class='' style='width:600px;' width='600'
            ><tr><td
            style='line-height:0px;font-size:0px;mso-line-height-rule:exactly;'><![endif]-->
            <div  style='background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;'></div>
               
                
                                <div
                                    class='mj-column-per-100 mj-outlook-group-fix'
                                    style='font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;'>
                                    
                                                <div
                                                    style='font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;color:#000000;'><link
                                                    href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css'
                                                    rel='stylesheet'
                                                    integrity='sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x'
                                                    crossorigin='anonymous'><link
                                                    rel='stylesheet'
                                                    href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css'>
                                                    <table width='90%' style='margin: 3%'>
                                                        <tr>
                                                            <td class='text-nice'>$lib</td>
                                                            <td class='text-nice'></td>
                                                            <td class='red'>$dte</td>
                                                        </tr>
                                                    </table>
                                                    <style>
                                                        .text-nice {
                                                            font-family: 'poppins', sans-serif;
                                                            font-size: 12px;
                                                        }
                                                        .red {
                                                            color: red;
                                                        }

                                                        tr {
                                                            border: 1px solid black;

                                                        }

                                                        .pourcentage {
                                                            margin-left: 2%;
                                                            padding: 10px;
                                                        }
                                                    </style>
                                                </div>
                                        
                                                <div
                                                    style='font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;color:#000000;'><link
                                                    href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css'
                                                    rel='stylesheet'
                                                    integrity='sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x'
                                                    crossorigin='anonymous'><link
                                                    rel='stylesheet'
                                                    href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css'>
                                                    
                                                    <table width='90%' style='margin: 3%'>";

                                                            foreach($taces as $tace)
                                                                {
                                                                
                                                                $body .=" 
                                                                    <tr>
                                                                      <td class='text-nice'>".$tace->libelle."</td>
                
                                                                      <td>
                                                                            <p>     </p>
                                                                        </td>
                                                                        <td><span class='badge bg-danger'>Pas Fait</span></td>
                                                                      <td class='text-nice'>" .strftime("%d/%m/%Y", strtotime($tace->deadline)). "</td>
                                                                      <td><i class='bi bi-chevron-compact-right'></i></td>
                                                                    </tr>
                                                                 ";
                                                                }
                                                            
                                                                   
                                                                $body .= "
                                                        
                                                        
                                                       
                                                    </table>
                                                    
                                                    
                                                    <style>
                                                        .text-nice {
                                                            font-family: 'poppins', sans-serif;
                                                            font-size: 12px;
                                                        }

                                                        tr {
                                                            border: 1px solid black;

                                                        }
                                                        .owner {
                                                            height: 10px;
                                                            width: 20px;
                                                            text-align: center;
                                                            border: 1px solid #f7b924;
                                                            border-radius: 40px;
                                                            background: black;
                                                            color: white;
                                                            font-size: 12px;
                                                            padding: 10%;
                                                            text-shadow: 1px 1px 2px black;
                                                        }

                                                        .pourcentage {
                                                            margin-left: 2%;
                                                            padding: 10px;
                                                        }
                                                    </style>
                                                </div>
                                   
                                </div>
                                <!--[if mso | IE]></td></tr></table><![endif]-->
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!--[if mso | IE]></td></tr></table><table align='center' border='0'
            cellpadding='0' cellspacing='0' class='' style='width:600px;' width='600'
            ><tr><td
            style='line-height:0px;font-size:0px;mso-line-height-rule:exactly;'><![endif]-->
            <div
                style='background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;'>
                
                                <div
                                    class='mj-column-per-100 mj-outlook-group-fix'
                                    style='font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;'>
                                    
                                                <table
                                                    border='0'
                                                    cellpadding='0'
                                                    cellspacing='0'
                                                    role='presentation'
                                                    style='border-collapse:separate;line-height:100%;'>
                                                    <tr>
                                                        <td
                                                            align='center'
                                                            bgcolor='#000000'
                                                            role='presentation'
                                                            style='border:0px solid #ffffff;border-radius:3px;cursor:auto;mso-padding-alt:10px 25px 10px 25px;background:#000000;'
                                                            valign='middle'>
                                                            <p
                                                                style='display:inline-block;background:#000000;color:#ffffff;font-family:Arial, sans-serif;font-size:13px;font-weight:normal;line-height:120%;margin:0;text-decoration:none;text-transform:none;padding:10px 25px 10px 25px;mso-padding-alt:0px;border-radius:3px;'>
                                                                <span
                                                                    style='font-family:Poppins;font-size:14px;text-align:left;background-color:#414141;color:#ffffff;'>
                                                                    <b>Aller sur Collaboratis</b></span></p>
                                                        </td>
                                                    </tr>
                                                </table>
                                   
                                </div>
                                <!--[if mso | IE]></td></tr></table><![endif]-->
                  
            </div>
            <!--[if mso | IE]></td></tr></table><table align='center' border='0'
            cellpadding='0' cellspacing='0' class='' style='width:600px;' width='600'
            ><tr><td
            style='line-height:0px;font-size:0px;mso-line-height-rule:exactly;'><![endif]-->
            <div
                style='background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;'>
           
                                <div
                                    class='mj-column-per-100 mj-outlook-group-fix'
                                    style=' margin-top : 2%; font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;'>
                                    <table
                                        border='0'
                                        cellpadding='0'
                                        cellspacing='0'
                                        role='presentation'
                                        style='vertical-align:top;'
                                        width='100%'>
                                        <tr>
                                            <td
                                                align='left'
                                                style='background:#000000;font-size:0px;padding:0px 25px 0px 25px;padding-top:0px;padding-right:25px;padding-bottom:0px;padding-left:25px;word-break:break-word;'>
                                                <div
                                                    style='font-family:Arial, sans-serif;font-size:14px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;'>
                                                    <p
                                                        class='text-build-content'
                                                        data-testid='FiGIsnfuR'
                                                        style='margin: 10px 0; margin-top: 10px;'>
                                                        <span style='color:#ffffff;font-family:Poppins;font-size:28px;'>
                                                            <b>Collaboratis .</b></span></p>
                                                    <p class='text-build-content' data-testid='FiGIsnfuR' style='margin: 10px 0;'>
                                                        <span style='color:#ffffff;font-family:Poppins;font-size:14px;'>Made with ❤️ by ILLIMITIS</span></p>
                                                    <p
                                                        class='text-build-content'
                                                        data-testid='FiGIsnfuR'
                                                        style='margin: 10px 0; margin-bottom: 10px;'>
                                                        <span style='color:#ffffff;font-family:Poppins;font-size:14px;'>Tous droits réservés ;</span></p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                
                  
            </div>
            
        </div>
    </body>
</html>";
                           $headers = "From: notification.collaboratis@gmail.com" . "\r\n" 
                                            ."CC: fallougueye197@gmail.com /n"
                                            ."Reply-To:notification.collaboratis@gmail.com\n"
                                            ."Content-Type:text/html;charset=\"utf-8\"";
                                            
                           mail($to,$subject,$body,$headers);
                           
                      
                        
                        
                            echo '<br><br><br> <span class="alert alert-success" role="alert" style ="margin-top : 100px; margin-left : 150px; width : 350px;"> Les Mails ont été envoyés avec succès </span>';
                       
            
                     //}       
        //}
            
            
            if($activite->statut = 1)
            {
            return redirect('/v3/admin/dashboard')->with(['messagem' => $messagem]);
            }
            else{
               return redirect('/v3/admin/dashboard')->with(['messagea' => $messagea]); 
            }
    }
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_cat($id)
    {
        //
        $categorie = Categorie::find($id);
        $categorie->delete();

        return back();
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_cat($id)
    {
        //
        $categorie = Categorie::find($id);
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('activite/v2.edit_categorie', compact('categorie','headers'));

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_cat(Request $request, $id)
    {
        //

            $message = "Categorie modifée avec succée";
            $categorie = Categorie::find($id);
            $categorie->libelle = $request->get('libelle');
            $categorie->update();

        return redirect('/modeles_activites')->with(['message' => $message]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ajout_cat()
    {
        //
        //$categorie = Categorie::find($id);
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('activite/v2.ajout_categorie', compact('headers'));

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add_cat(Request $request)
    {
        //

            $message = "Categorie ajoutée avec succée";
            $categorie = Categorie::find($id);
            $categorie->libelle = $request->get('libelle');
            $categorie->save();

        return redirect('/modeles_activites')->with(['message' => $message]);
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function modele_ajout($id)
    {
        //
        $activite = Activite::find($id);
        $agents = Agent::all();
        $strategiques = Strategique::all();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('activite/v2.ajout_modele', compact('activite','agents','strategiques','headers'));

    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function modele_add(Request $request)
    {
        //
            $date = date('y-m-d h:i:s');
            $message = "Modele ajoutée avec succée";
            $modele = new Modele;
            $modele->libelle = $request->get('libelle_act');
            $modele->res_dir = $request->get('res_dirs');
            $modele->backup = $request->get('backup');
            $modele->deadline = $request->get('deadlines');
            $modele->strategique_id = $request->get('strategique_id');
            $modele->categorie_id = $request->get('categorie_id');
            $modele->createur_id = Auth::user()->id;
            //$modele->statut = $request->get('statut');
            $modele->date_debut = $request->get('date_debut');
            $modele->save();
            
            $libelle = $request->libelle;
            $res_dir = $request->res_dir;
            $deadline = $request->deadline;
            for($i=0; $i < count($libelle); $i++){
            
            $tache_modeles = [
                'libelle' => $libelle[$i],
                'res_dir' => $res_dir[$i],
                'deadline' => $deadline[$i],
                'modele_id' => $modele->id,
                'created_at' => $date,
                'updated_at' => $modele->updated_at
                ];
            //DB::table('tache_modeles')->insert($tache_modeles);
            
            DB::table('tache_modeles')->where('modele_id',$modele->id)->where('created_at','!=',$date)->delete();
   
            DB::table('tache_modeles')->insert($tache_modeles);
            }
            
            
            $agen = DB::table('agents')->where('id',$modele->res_dir)->first();
            $agenb = DB::table('agents')->where('id',$modele->backup)->first();
            $taces = DB::table('tache_modeles')->where('modele_id',$modele->id)->get();
            $tacess = DB::table('tache_modeles')->select('res_dir')->where('modele_id',$modele->id)->get();

            $lib = $modele->libelle;
            $pre = substr($agen->prenom, 0, 1);
            $nm = substr($agen->nom, 0, 1);
            $pour = $modele->pourcentage;
            $dte = strftime("%d/%m/%Y", strtotime($modele->deadline));
            
             //$users = User::all();
        //foreach($users as $user){
            //Auth::login($user);
            //$user->notify(new BonDebutDeSemaine());
                $person = Auth::user();
                    
                //$prenom = $user->prenom;
                foreach($tacess as $ta)
                {
                $agensss = DB::table('agents')->select('email')->where('agents.id',$ta->res_dir)->get();
                foreach($agensss as $ag)
                {
                 $to = "$ag->email,$agenb->email,$agen->email,fallougueye197@gmail.com";  
                }
                }
                
                $subject = "Une activité sur laquelle tu interviens vient d'être ajoutée  !";
                           
                            $body = "
                            <!doctype html>

<html
    xmlns='http://www.w3.org/1999/xhtml'
    xmlns:v='urn:schemas-microsoft-com:vml'
    xmlns:o='urn:schemas-microsoft-com:office:office'>
    <head>
        <title>Alerte échéance</title><!--[if !mso]><!-- --><meta http-equiv='X-UA-Compatible' content='IE=edge'><!--<![endif]--><meta http-equiv='Content-Type' content='text/html; charset=UTF-8'><meta name='viewport' content='width=device-width,initial-scale=1'>
        <style type='text/css'>
            #outlook a {
                padding: 0;
            }
            body {
                margin: 0;
                padding: 0;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
            }
            table,
            td {
                border-collapse: collapse;
                mso-table-lspace: 0;
                mso-table-rspace: 0;
            }
            img {
                border: 0;
                height: auto;
                line-height: 100%;
                outline: none;
                text-decoration: none;
                -ms-interpolation-mode: bicubic;
            }
            p {
                display: block;
                margin: 13px 0;
            }
        </style><!--[if mso]> <xml> <o:OfficeDocumentSettings> <o:AllowPNG/>
        <o:PixelsPerInch>96</o:PixelsPerInch> </o:OfficeDocumentSettings> </xml>
        <![endif]--><!--[if
            lte mso 11]> <style type='text/css'> .mj-outlook-group-fix { width:100%
            !important; } </style> <![endif]--><!--[if !mso]><!--><link
            href='https://fonts.googleapis.com/css?family=Poppins'
            rel='stylesheet'
            type='text/css'>
        <style type='text/css'>
            @import url(https://fonts.googleapis.com/css?family=Poppins);
            </style > <!--<![endif]-- > <style type='text/css' > @media only screen and (min-width:480px) {
                .mj-column-per-100 {
                    width: 100% !important;
                    max-width: 100%;
                }
            }
        </style>
        <style type='text/css'>
            [owa] .mj-column-per-100 {
                width: 100% !important;
                max-width: 100%;
            }
        </style>
        <style type='text/css'></style>
    </head>
    <body style='background-color:#F4F4F4;'>
        <div style='background-color:#F4F4F4;'>
            <!--[if mso | IE]><table align='center' border='0' cellpadding='0'
            cellspacing='0' class='' style='width:600px;' width='600' ><tr><td
            style='line-height:0px;font-size:0px;mso-line-height-rule:exactly;'><![endif]-->
            <div
                style='background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;'>
                
                   
                    <div class='mj-column-per-100 mj-outlook-group-fix' style='font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;'>
                                   
                                                align='left'
                                                style='font-size:0px;padding:0px 25px 0px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;'>
                                                <div
                                                    style='font-family:Arial, sans-serif;font-size:18px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;'>
                                                    <p
                                                        class='text-build-content'
                                                        data-testid='nu8exbGuE2'
                                                        style='margin: 10px 0; margin-top: 10px;'>
                                                        <span style='font-family:Poppins;font-size:18px;'>
                                                            <b>Hello !</b></span></p>
                                                    <p
                                                        class='text-build-content'
                                                        data-testid='nu8exbGuE2'
                                                        style='margin: 10px 0; margin-bottom: 10px;'>
                                                        <span style='font-family:Poppins;font-size:16px;'>Une
                                                        </span>
                                                        <span style='color:#113ef3;font-family:Poppins;font-size:16px;'>
                                                            <b>activité sur laquelle tu interviens</b>
                                                        </span>
                                                        <span style='font-family:Poppins;font-size:16px;'>
                                                            vient d'être ajouté, jette un coup d'oeil aux tâches qui te sont assignées
                                                            : </span></p>
                                                </div>
                                      
                              
                                                <p
                                                    style='border-top:solid 2px #000000;font-size:1px;margin:0px auto;width:100%;'></p>
                                                <!--[if mso | IE]><table align='center' border='0' cellpadding='0'
                                                cellspacing='0' style='border-top:solid 2px #000000;font-size:1px;margin:0px
                                                auto;width:550px;' role='presentation' width='550px' ><tr><td
                                                style='height:0;line-height:0;'>  ; </td></tr></table><![endif]-->
           
            </div>
            <!--[if mso | IE]></td></tr></table><table align='center' border='0'
            cellpadding='0' cellspacing='0' class='' style='width:600px;' width='600'
            ><tr><td
            style='line-height:0px;font-size:0px;mso-line-height-rule:exactly;'><![endif]-->
            <div  style='background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;'></div>
               
                
                                <div
                                    class='mj-column-per-100 mj-outlook-group-fix'
                                    style='font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;'>
                                    
                                                <div
                                                    style='font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;color:#000000;'><link
                                                    href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css'
                                                    rel='stylesheet'
                                                    integrity='sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x'
                                                    crossorigin='anonymous'><link
                                                    rel='stylesheet'
                                                    href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css'>
                                                    <table width='90%' style='margin: 3%'>
                                                        <tr>
                                                            <td class='text-nice'>$lib</td>
                                                            <td class='text-nice'></td>
                                                            <td class='red'>$dte</td>
                                                        </tr>
                                                    </table>
                                                    <style>
                                                        .text-nice {
                                                            font-family: 'poppins', sans-serif;
                                                            font-size: 12px;
                                                        }
                                                        .red {
                                                            color: red;
                                                        }

                                                        tr {
                                                            border: 1px solid black;

                                                        }

                                                        .pourcentage {
                                                            margin-left: 2%;
                                                            padding: 10px;
                                                        }
                                                    </style>
                                                </div>
                                        
                                                <div
                                                    style='font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;color:#000000;'><link
                                                    href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css'
                                                    rel='stylesheet'
                                                    integrity='sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x'
                                                    crossorigin='anonymous'><link
                                                    rel='stylesheet'
                                                    href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css'>
                                                    
                                                    <table width='90%' style='margin: 3%'>";

                                                            foreach($taces as $tace)
                                                                {
                                                                
                                                                $body .=" 
                                                                    <tr>
                                                                      <td class='text-nice'>".$tace->libelle."</td>
                
                                                                      <td>
                                                                            <p>     </p>
                                                                        </td>
                                                                        <td><span class='badge bg-danger'>Pas Fait</span></td>
                                                                      <td class='text-nice'>" .strftime("%d/%m/%Y", strtotime($tace->deadline)). "</td>
                                                                      <td><i class='bi bi-chevron-compact-right'></i></td>
                                                                    </tr>
                                                                 ";
                                                                }
                                                            
                                                                   
                                                                $body .= "
                                                        
                                                        
                                                       
                                                    </table>
                                                    
                                                    
                                                    <style>
                                                        .text-nice {
                                                            font-family: 'poppins', sans-serif;
                                                            font-size: 12px;
                                                        }

                                                        tr {
                                                            border: 1px solid black;

                                                        }
                                                        .owner {
                                                            height: 10px;
                                                            width: 20px;
                                                            text-align: center;
                                                            border: 1px solid #f7b924;
                                                            border-radius: 40px;
                                                            background: black;
                                                            color: white;
                                                            font-size: 12px;
                                                            padding: 10%;
                                                            text-shadow: 1px 1px 2px black;
                                                        }

                                                        .pourcentage {
                                                            margin-left: 2%;
                                                            padding: 10px;
                                                        }
                                                    </style>
                                                </div>
                                   
                                </div>
                                <!--[if mso | IE]></td></tr></table><![endif]-->
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!--[if mso | IE]></td></tr></table><table align='center' border='0'
            cellpadding='0' cellspacing='0' class='' style='width:600px;' width='600'
            ><tr><td
            style='line-height:0px;font-size:0px;mso-line-height-rule:exactly;'><![endif]-->
            <div
                style='background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;'>
                
                                <div
                                    class='mj-column-per-100 mj-outlook-group-fix'
                                    style='font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;'>
                                    
                                                <table
                                                    border='0'
                                                    cellpadding='0'
                                                    cellspacing='0'
                                                    role='presentation'
                                                    style='border-collapse:separate;line-height:100%;'>
                                                    <tr>
                                                        <td
                                                            align='center'
                                                            bgcolor='#000000'
                                                            role='presentation'
                                                            style='border:0px solid #ffffff;border-radius:3px;cursor:auto;mso-padding-alt:10px 25px 10px 25px;background:#000000;'
                                                            valign='middle'>
                                                            <p
                                                                style='display:inline-block;background:#000000;color:#ffffff;font-family:Arial, sans-serif;font-size:13px;font-weight:normal;line-height:120%;margin:0;text-decoration:none;text-transform:none;padding:10px 25px 10px 25px;mso-padding-alt:0px;border-radius:3px;'>
                                                                <span
                                                                    style='font-family:Poppins;font-size:14px;text-align:left;background-color:#414141;color:#ffffff;'>
                                                                    <b>Aller sur Collaboratis</b></span></p>
                                                        </td>
                                                    </tr>
                                                </table>
                                   
                                </div>
                                <!--[if mso | IE]></td></tr></table><![endif]-->
                  
            </div>
            <!--[if mso | IE]></td></tr></table><table align='center' border='0'
            cellpadding='0' cellspacing='0' class='' style='width:600px;' width='600'
            ><tr><td
            style='line-height:0px;font-size:0px;mso-line-height-rule:exactly;'><![endif]-->
            <div
                style='background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;'>
           
                                <div
                                    class='mj-column-per-100 mj-outlook-group-fix'
                                    style=' margin-top : 2%; font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;'>
                                    <table
                                        border='0'
                                        cellpadding='0'
                                        cellspacing='0'
                                        role='presentation'
                                        style='vertical-align:top;'
                                        width='100%'>
                                        <tr>
                                            <td
                                                align='left'
                                                style='background:#000000;font-size:0px;padding:0px 25px 0px 25px;padding-top:0px;padding-right:25px;padding-bottom:0px;padding-left:25px;word-break:break-word;'>
                                                <div
                                                    style='font-family:Arial, sans-serif;font-size:14px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;'>
                                                    <p
                                                        class='text-build-content'
                                                        data-testid='FiGIsnfuR'
                                                        style='margin: 10px 0; margin-top: 10px;'>
                                                        <span style='color:#ffffff;font-family:Poppins;font-size:28px;'>
                                                            <b>Collaboratis .</b></span></p>
                                                    <p class='text-build-content' data-testid='FiGIsnfuR' style='margin: 10px 0;'>
                                                        <span style='color:#ffffff;font-family:Poppins;font-size:14px;'>Made with ❤️ by ILLIMITIS</span></p>
                                                    <p
                                                        class='text-build-content'
                                                        data-testid='FiGIsnfuR'
                                                        style='margin: 10px 0; margin-bottom: 10px;'>
                                                        <span style='color:#ffffff;font-family:Poppins;font-size:14px;'>Tous droits réservés ;</span></p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                
                  
            </div>
            
        </div>
    </body>
</html>";
                           $headers = "From: notification.collaboratis@gmail.com" . "\r\n" 
                                            ."CC: fallougueye197@gmail.com /n"
                                            ."Reply-To:notification.collaboratis@gmail.com\n"
                                            ."Content-Type:text/html;charset=\"utf-8\"";
                                            
                           mail($to,$subject,$body,$headers);
                           
                      
                        
                        
                            echo '<br><br><br> <span class="alert alert-success" role="alert" style ="margin-top : 100px; margin-left : 150px; width : 350px;"> Les Mails ont été envoyés avec succès </span>';
                       

            return redirect('/v3/admin/dashboard')->with(['message' => $message]);
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function all_activites()
    {
        //
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        
        $activites = DB::table('activites')->where('statut','=',0)->get();
        $modeles = DB::table('modeles')->get();
        
       
        $directions = Direction::all();
        
        return view('activite/v2.all_activites', compact('headers','modeles','activites','directions'));

    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function all_activites_filter(Request $request)
    {
        //
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        
        $activites = DB::table('activites')->where('statut','=',0)->get();
        $modeles = DB::table('modeles')->get();
        
        $search_dirac = $request->get('search_dirac');
        $directions = Direction::all();
          
          $modeless = DB::table('directions')
          ->join('agents', 'agents.direction_id', 'directions.id')
          ->join('activites', 'activites.res_dir', 'agents.id')
          ->join('modeles', 'modeles.res_dir', 'agents.id')
          ->select('activites.id',
                  'activites.libelle', 'activites.res_dir', 'activites.backup',
                  'activites.created_at', 'modeles.libelle', 'modeles.res_dir', 'modeles.backup',
                  'modeles.created_at',
                  'agents.prenom', 'agents.nom', 'agents.direction_id','agents.id as Id',
                  'directions.nom_direction','directions.id as ID')
                  ->where('directions.nom_direction', 'like', '%'.$search_dirac.'%')
                  ->orderBY('activites.id','DESC')
                  ->get();
        
        return view('activite/v2.all_activites', compact('headers','modeles','activites','modeless','directions'));

    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function voir_modele($id)
    {
        //
        $modele = Modele::find($id);
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('activite/v2.voir_modele', compact('modele','headers'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function voir_activite($id)
    {
        //
        $activite = Activite::find($id);
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('activite/v2.voir_activite', compact('activite','headers'));
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function strategiques()
    {
        //
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        
        $activites = DB::table('activites')->where('statut','=',0)->get();
        $modeles = DB::table('modeles')->get();
        $strategiques = DB::table('strategiques')->get();
       
        $directions = Direction::all();
        
        return view('activite/v2.strategique', compact('headers','modeles','activites','directions','strategiques'));

    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active_edi($id)
    {
        //
        $activite = Modele::find($id);
        $agents = Agent::all();
        $strategiques = Strategique::all();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('activite/v2.activite_modifier', compact('activite','agents','strategiques','headers'));

    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active_up(Request $request,$id)
    {
        //
            $date = date('y-m-d h:i:s');
            
            $message = "Activité modifiée avec succès ";
            $activiter = Modele::find($id);
            $activiter->libelle = $request->get('libelle_act');
            $activiter->res_dir = $request->get('res_dirs');
            $activiter->backup = $request->get('backup');
            $activiter->deadline = $request->get('deadlines');
            $activiter->strategique_id = $request->get('strategique_id');
            $activiter->categorie_id = $request->get('categorie_id');
            $activiter->createur_id = Auth::user()->id;
            //$modele->statut = $request->get('statut');
            $activiter->date_debut = $request->get('date_debut');
            $activiter->update();
            
            $libelle = $request->libelle;
            $res_dir = $request->res_dir;
            $deadline = $request->deadline;
            $created_at = $request->created_at;
            for($i=0; $i < count($libelle); $i++){
            
            $tache_modeles = [
                'libelle' => $libelle[$i],
                'res_dir' => $res_dir[$i],
                'deadline' => $deadline[$i],
                'modele_id' => $activiter->id,
                'created_at' => $date,
                'updated_at' => $activiter->updated_at
                
                ];
            //$as = DB::table('modeles')->where('updated_at','<>',$activiter->updated_at)->first(); 
            
            DB::table('tache_modeles')->where('modele_id',$activiter->id)->where('created_at','!=',$date)->delete();
   
            DB::table('tache_modeles')->insert($tache_modeles);
            //DB::table('tache_modeles')->where('modele_id',$activiter->id)->where('updated_at','!=',$activiter->updated_at)->delete();
            //DB::table('tache_modeles')->where('modele_id',$activiter->id)->where('created_at','!=','updated_at')->delete();
            //$tache = DB::table('tache_modeles')->where('modele_id',$activiter->id)->get();
            //foreach($tache as $ta)
            //{
             
            //}

            }
            return redirect('/v3/admin/dashboard')->with(['message' => $message]);
    }
    
    public function destroyac($id)
    
    {
        $message = "Activité supprimée avec succès ";
        $activite = Modele::find($id);
        $activite->delete();
        DB::table('tache_modeles')->where('modele_id',$activite->id)->delete();
        
        return redirect('/v3/admin/dashboard')->with(['message' => $message]);
    }
    
    public function destroyta($id)
    
    {
        $message = "Tache supprimée avec succès ";
        $tac = Tache_modele::find($id);
        $tac->delete();
        //DB::table('tache_modeles')->where('modele_id',$activite->id)->delete();
         //Tache_modele::find($id)->delete($id);
  
            //return response()->json([
                //'success' => 'Record deleted successfully!'
            //]);
        return redirect()->back()->with(['message' => $message]);
    }

   
}
