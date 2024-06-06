<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Commerciau;
use App\Prospection;
use App\Opportunite;
use App\Prospect;
use App\Contact;
use App\Stock_mensuelle;

use App\Mail\MailBackupOp;
use App\Mail\MailProspect;
use App\Mail\MailResOp;
use App\User;
use App\Multinational;
use App\Secteur_activite;
use App\ActionCommercial;
use Auth;
use DB;
use Mail;

use Session;
use Mailjet\LaravelMailjet\Facades\Mailjet;

class ProspectionController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    } 
    
    
    
       public function rapport_tri_sn()
    {
        $mois = date('m');
        $commerciaux = DB::table('commerciaus')->orderBy('prenom')->get();
        $performances12V = DB::table('performance_sn_globales')->whereMonth('created_at', 12)->sum('objectif_vente');
        $performances12R = DB::table('performance_sn_globales')->whereMonth('created_at', 12)->sum('realisation_vente');
        $performances12P = DB::table('performance_sn_globales')->whereMonth('created_at', 12)->sum('perfo_vente');

        $performances11V = DB::table('performance_sn_globales')->whereMonth('created_at', 11)->sum('objectif_vente');
        $performances11R = DB::table('performance_sn_globales')->whereMonth('created_at', 11)->sum('realisation_vente');
        $performances11P = DB::table('performance_sn_globales')->whereMonth('created_at', 11)->sum('perfo_vente');
        
        $performances10V = DB::table('performance_sn_globales')->whereMonth('created_at', 10)->sum('objectif_vente');
        $performances10R = DB::table('performance_sn_globales')->whereMonth('created_at', 10)->sum('realisation_vente');
        $performances10P = DB::table('performance_sn_globales')->whereMonth('created_at', 10)->sum('perfo_vente');
        
        $performances = DB::table('performance_sn_globales')->whereMonth('created_at', $mois)->get();
        return view('suiviSortieTerrain.rapport_tri_sn', compact('commerciaux', 'performances', 'performances12V', 'performances12R', 'performances12P'
        , 'performances11V', 'performances11R', 'performances11P', 'performances10V', 'performances10R', 'performances10P'));
    }
    
     public function rapport_tri_bf()
    {
        $mois = date('m');
        $commerciaux = DB::table('commerciaus')->orderBy('prenom')->get();
        $performances12V = DB::table('performance_bf_globales')->whereMonth('created_at', 12)->sum('objectif_vente');
        $performances12R = DB::table('performance_bf_globales')->whereMonth('created_at', 12)->sum('realisation_vente');
        $performances12P = DB::table('performance_bf_globales')->whereMonth('created_at', 12)->sum('perfo_vente');

        $performances11V = DB::table('performance_bf_globales')->whereMonth('created_at', 11)->sum('objectif_vente');
        $performances11R = DB::table('performance_bf_globales')->whereMonth('created_at', 11)->sum('realisation_vente');
        $performances11P = DB::table('performance_bf_globales')->whereMonth('created_at', 11)->sum('perfo_vente');
        
        $performances10V = DB::table('performance_bf_globales')->whereMonth('created_at', 10)->sum('objectif_vente');
        $performances10R = DB::table('performance_bf_globales')->whereMonth('created_at', 10)->sum('realisation_vente');
        $performances10P = DB::table('performance_bf_globales')->whereMonth('created_at', 10)->sum('perfo_vente');
        
        $performances = DB::table('performance_bf_globales')->whereMonth('created_at', $mois)->get();
        return view('suiviSortieTerrain.rapport_tri_bf', compact('commerciaux', 'performances', 'performances12V', 'performances12R', 'performances12P'
        , 'performances11V', 'performances11R', 'performances11P', 'performances10V', 'performances10R', 'performances10P'));
    }
    
     public function rapport_tri_glo()
    {
        $mois = date('m');
        $commerciaux = DB::table('commerciaus')->orderBy('prenom')->get();
        
        $performances12V = DB::table('performance_globales')->whereMonth('created_at', 12)->sum('objectif_vente');
        $performances12R = DB::table('performance_globales')->whereMonth('created_at', 12)->sum('realisation_vente');
        $performances12P = DB::table('performance_globales')->whereMonth('created_at', 12)->sum('perfo_vente');

        $performances11V = DB::table('performance_globales')->whereMonth('created_at', 11)->sum('objectif_vente');
        $performances11R = DB::table('performance_globales')->whereMonth('created_at', 11)->sum('realisation_vente');
        $performances11P = DB::table('performance_globales')->whereMonth('created_at', 11)->sum('perfo_vente');
        
        $performances10V = DB::table('performance_globales')->whereMonth('created_at', 10)->sum('objectif_vente');
        $performances10R = DB::table('performance_globales')->whereMonth('created_at', 10)->sum('realisation_vente');
        $performances10P = DB::table('performance_globales')->whereMonth('created_at', 10)->sum('perfo_vente');
        
        $performances = DB::table('performance_globales')->whereMonth('created_at', $mois)->get();
        return view('suiviSortieTerrain.rapport_tri_glo', compact('commerciaux', 'performances', 'performances12V', 'performances12R', 'performances12P'
        , 'performances11V', 'performances11R', 'performances11P', 'performances10V', 'performances10R', 'performances10P'));
    }
    
    
     public function mailing()
    {
        
        return view('suiviSortieTerrain.mailing');

    }
    
        public function mail_prospect(Request $request)
    {
        $message = "Le mail a été bien envoyé avec succès";
        $contacts = DB::table('contacts')->where('email', '!=', null)->get();
        foreach($contacts as $contact)
        {
            if($contact->email)
            {
             Mail::to($contact->email)->send(new MailProspect($contact));
            }
        }
        return back()->with(['message' => $message]);
    }
    
       public function rapport_commercial($id)
    {
        $mois = date('m');
        $commerciaux = DB::table('commerciaus')->orderBy('prenom')->get();
        $commerciau = Commerciau::find($id);
        $commerciauMe = Commerciau::find($id);
        $performances = DB::table('performances')->where('commercial_id', $commerciau->id)->whereMonth('created_at', $mois)->get();
        
        
        return view('suiviSortieTerrain.rapport_commercial', compact( 'commerciaux', 'commerciau', 'performances', 'id'));
    }
    
       public function rapport_commercialFiltre(Request $request)
    {
      
        $mois = date('m');
        $id = "";
        $searchMois = $request->get('searchMois');
        $commerciaux = DB::table('commerciaus')->orderBy('prenom')->get();
        $commerciau = Commerciau::find(1);
        $performances = DB::table('performances')
        ->whereMonth('created_at','like', '%'.$searchMois.'%')
        ->get();
        return view('suiviSortieTerrain.rapport_commercial', compact( 'commerciaux', 'commerciau', 'performances', 'id'));
    }
    
       public function rapport_team()
    {
        // $performances = array();
        // $commerciaux = DB::table('commerciaus')->orderBy('prenom')->get();
        // foreach($commerciaux as $commerciau){
        //     $performancess = DB::table('performances')->where('commercial_id', $commerciau->id)->whereMonth('created_at', $m)->get();
        //     foreach($performancess as $performanc){
        //         array_push($performances,$performanc);
        //     }
        // }
        $mois = date('m');
        $commerciaux = DB::table('commerciaus')->orderBy('prenom')->get();
        $performances = DB::table('performance_globales')->whereMonth('created_at', $mois)->get();
        return view('suiviSortieTerrain.rapport_team', compact('commerciaux', 'performances'));
    }
    
      public function rapport_teamFiltre(Request $request)
    {
        $mois = date('m');
        $searchMois = $request->get('searchMois');
        $commerciaux = DB::table('commerciaus')->orderBy('prenom')->get();
        $performances = DB::table('performance_globales')
        ->whereMonth('created_at','like', '%'.$searchMois.'%')
        ->get();
        return view('suiviSortieTerrain.rapport_team', compact('commerciaux', 'performances'));
    }
    
      public function rapport_teamBF()
    {
        // $performances = array();
        // $commerciaux = DB::table('commerciaus')->orderBy('prenom')->get();
        // foreach($commerciaux as $commerciau){
        //     $performancess = DB::table('performances')->where('commercial_id', $commerciau->id)->whereMonth('created_at', $m)->get();
        //     foreach($performancess as $performanc){
        //         array_push($performances,$performanc);
        //     }
        // }
        $mois = date('m');
        $commerciaux = DB::table('commerciaus')->orderBy('prenom')->get();
        $performances = DB::table('performance_bf_globales')->whereMonth('created_at', $mois)->get();
        return view('suiviSortieTerrain.rapport_teamBF', compact('commerciaux', 'performances'));
    }
    
      public function rapport_teamSN()
    {
        // $performances = array();
        // $commerciaux = DB::table('commerciaus')->orderBy('prenom')->get();
        // foreach($commerciaux as $commerciau){
        //     $performancess = DB::table('performances')->where('commercial_id', $commerciau->id)->whereMonth('created_at', $m)->get();
        //     foreach($performancess as $performanc){
        //         array_push($performances,$performanc);
        //     }
        // }
        $mois = date('m');
        $commerciaux = DB::table('commerciaus')->orderBy('prenom')->get();
        $performances = DB::table('performance_sn_globales')->whereMonth('created_at', $mois)->get();
        return view('suiviSortieTerrain.rapport_teamSN', compact('commerciaux', 'performances'));
    }
    
      public function rapport_teamSNFiltre(Request $request)
    {
        $mois = date('m');
        $searchMois = $request->get('searchMois');
        $commerciaux = DB::table('commerciaus')->orderBy('prenom')->get();
        $performances = DB::table('performance_sn_globales')
        ->whereMonth('created_at','like', '%'.$searchMois.'%')
        ->get();
        return view('suiviSortieTerrain.rapport_teamSN', compact('commerciaux', 'performances'));
    }
    
      public function rapport_teamBFFiltre(Request $request)
    {
        $mois = date('m');
        $searchMois = $request->get('searchMois');
        $commerciaux = DB::table('commerciaus')->orderBy('prenom')->get();
        $performances = DB::table('performance_sn_globales')
        ->whereMonth('created_at','like', '%'.$searchMois.'%')
        ->get();
        return view('suiviSortieTerrain.rapport_teamBF', compact('commerciaux', 'performances'));
    }
    
      public function cloturer_mon_planning_edit($id)
    {
        //
        $planning = Prospection::find($id);
        
        $commercial = DB::table('commerciaus')->orderby('prenom')->get();
        
        return view('suiviSortieTerrain.cloturer_mon_planning_edit', compact('planning', 'commercial'));

    }
   
   public function cloturer_mon_planning(Request $request, $id)
    {
        //
        $message = "Planning clôturer  avec succès";
        $planning = Prospection::find($id);
        $planning->statut = 1;
        $planning->resultat_rv = $request->get('resultat_rv');
        $planning->save();
        
        if($planning->suivi_prospect != null){
        DB::table('suivi_prospects')->where('id', $planning->suivi_prospect)->update(['resultat_rv' => $planning->resultat_rv, 'statut_rv' => 1]);
        }
        
        $messages = "Action ajoutée avec succès";
            
                 $libelle = $request->get('libelle');
                 $deadline = $request->get('deadline');
                 $commercial_id = $request->get('commercial_id');
                 $prospect_id = $request->get('prospect_id');
                 $superieur_id = $request->get('superieur_id');
                 $suivi_prospect = $request->get('suivi_prospect');
                 
                 for($i=0; $i < count($libelle); $i++){
                 $personnes = [
                    
                     'libelle' => $libelle[$i],
                     'deadline' => $deadline[$i],
                     'prospect_id' => $planning->prospect_id,
                     'commercial_id' => $commercial_id[$i],
                     'suivi_prospect' => $planning->suivi_prospect,

                         ];
                     
                     DB::table('action_commerciales')->insert($personnes);
                     
                 }
                 
                 $commerciaux = DB::table('commerciaus')->get();
                 foreach($commerciaux as $commerciau)
                 {
                     DB::table('action_commerciales')->where('commercial_id', $commerciau->id)->update(['superieur_id' => $commerciau->superieur_id]);
                 }
        return redirect('/tous_mon_plannings')->with(['message' => $message]);
    }
    
    public function edit_mon_planning($id)
    {
        //
        $planning = Prospection::find($id);
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $prospect = DB::table('prospects')->where('commercial_id', $commercial->id)->get();
        return view('suiviSortieTerrain.edit_mon_planning', compact('planning', 'prospect'));

    }
  
    public function update_mon_planning(Request $request, $id)
    {
            $message = "Planning modifié avec succès";
            
                $planning = Prospection::findOrFail($id);
                $planning->prospect_id = $request->get('prospect_id');
                $planning->date = $request->get('date');
                $planning->heure_debut = $request->get('heure_debut');
                // $planning->statut = $request->get('statut');
                $planning->save();
                

        return redirect('/mon_plannings')->with(['message' => $message]);
    }

       public function planning_commercial($id)
    {
        $mois = date('m');
        $commerciau = Commerciau::find($id);
        $planning = DB::table('prospections')->where('commercial_id', $commerciau->id)->get();
        return view('suiviSortieTerrain.planning_commercial', compact('commerciau', 'planning'));
    }
    
   
      public function mon_plannings()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $week = [];
        $planning = array();
         $saturday = strtotime('monday this week');
        foreach (range(0, 6) as $day) {
                    $week[] = date("Y-m-d", (($day * 86400) + $saturday));
                }
                $planning = array();
                foreach($week as $weeks)
                 { 
            $planningfg = DB::table('prospections')->where('commercial_id', $commercial->id)->where('statut',0)
            ->whereDay('date', '=',date('d', strtotime($weeks)))
            ->whereMonth('date', '=',date('m', strtotime($weeks)))
            ->whereYear('date', '=',date('Y', strtotime($weeks)))
            ->orderBy('date', 'desc')
            ->get();
            
            foreach($planningfg as $planningf){
                    array_push($planning, $planningf);
                    }
                 }
        // $planning = DB::table('prospections')->where('commercial_id', $commercial->id)->where('statut',0)->get();
     
        return view('suiviSortieTerrain.mon_planning', compact('planning'));
    }
    
      public function tous_mon_plannings()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $planning = DB::table('prospections')->where('commercial_id', $commercial->id)->where('statut',0)->orderby('date', 'desc')->get();
     
        return view('suiviSortieTerrain.tous_mon_plannings', compact('planning'));
    }
    
      public function plannings_res()
    {
        $semaineM7 = (date('d') -7);
                    $action_semaineP7 = (date('d') +7);
                    $action_mois = date('m');
                    $annee = date('Y');
                    $today=  date('d');
        //$planning = array();
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        
        $commercial = DB::table('commerciaus')->where('superieur_id', $moi->id)->get(); 
        //foreach($commercial as $commercials){
        $week = [];
         $saturday = strtotime('monday this week');
        foreach (range(0, 6) as $day) {
                    $week[] = date("Y-m-d", (($day * 86400) + $saturday));
                }
                $planning = array();
                // $planning_avenir = array();
                foreach($week as $weeks)
                 { 
            $planningfg = DB::table('prospections')->where('superieur_id', $moi->id)
            ->whereDay('date', '=',date('d', strtotime($weeks)))
            ->whereMonth('date', '=',date('m', strtotime($weeks)))
            ->whereYear('date', '=',date('Y', strtotime($weeks)))
            ->orderby('date', 'desc')
            ->get();
            
            foreach($planningfg as $planningf){
                    array_push($planning, $planningf);
                    }
                    
                   
                 }
        $planning_avenir = DB::table('prospections')->where('superieur_id', $moi->id)
            ->whereDay('date', '>',$today)
            ->whereMonth('date', '>=',$action_mois)
            ->whereYear('date', '>=',$annee)
            ->orderby('date', 'desc')
            ->get();
            
        
        
        foreach (range(0, 6) as $day) {
                    $week[] = date("Y-m-d", (($day * 86400) + $saturday));
                }
                $planning_pole = array();
                // $planning_avenir = array();
                foreach($week as $weeks)
                 { 
            $planningfg_pole = DB::table('prospections')->select('prospections.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'prospections.commercial_id')
            ->where('commerciaus.domaine_id', $moi->domaine_id)
            ->whereDay('prospections.date', '=',date('d', strtotime($weeks)))
            ->whereMonth('prospections.date', '=',date('m', strtotime($weeks)))
            ->whereYear('prospections.date', '=',date('Y', strtotime($weeks)))
            ->orderby('prospections.date', 'asc')
            ->get();
            
            foreach($planningfg_pole as $planningf_pole){
                    array_push($planning_pole, $planningf_pole);
                    }
                }  
                
            
            $planning_avenir_pole = DB::table('prospections')->select('prospections.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'prospections.commercial_id')
            ->where('commerciaus.domaine_id', $moi->domaine_id)
            ->whereDay('prospections.date', '>',$today)
            ->whereMonth('prospections.date', '>=',$action_mois)
            ->whereYear('prospections.date', '>=',$annee)
            ->orderby('prospections.date', 'asc')
            ->get();
        return view('suiviSortieTerrain.plannings_res', compact('planning','moi','planning_avenir','planning_pole','planning_avenir_pole'));
    }
    
      public function plannings()
    {
                    $semaineM7 = (date('d') -7);
                    $action_semaineP7 = (date('d') +7);
                    $action_mois = date('m');
                    $annee = date('Y');
                    $today = date('d');
                    
                   $week = [];
         $saturday = strtotime('monday this week');
        foreach (range(0, 6) as $day) {
                    $week[] = date("Y-m-d", (($day * 86400) + $saturday));
                }
                $planning = array();
                // $planning_avenir = array();
                foreach($week as $weeks)
                 { 
            $planningfg = DB::table('prospections')
            ->whereDay('date', '=',date('d', strtotime($weeks)))
            ->whereMonth('date', '=',date('m', strtotime($weeks)))
            ->whereYear('date', '=',date('Y', strtotime($weeks)))
            ->orderby('date', 'desc')
            ->get();
            
                foreach($planningfg as $planningf){
                        array_push($planning, $planningf);
                        }
                    
            
                 }
                  $planning_avenir = DB::table('prospections')
            ->whereDay('date', '>',$today)
            ->whereMonth('date', '>=',$action_mois)
            ->whereYear('date', '>=',$annee)
            ->orderby('date', 'desc')
            ->get();

        return view('suiviSortieTerrain.plannings', compact('planning','planning_avenir'));
    }
    
    
     public function planningsFiltre(Request $request)
    {
                    $semaineM7 = (date('d') -7);
                    $action_semaineP7 = (date('d') +7);
                    $action_mois = date('m');
                    $annee = date('Y');
                    $today = date('d');
          $commercialFiltre =  $request->get('commercialFiltre');         
                   $week = [];
         $saturday = strtotime('monday this week');
        foreach (range(0, 6) as $day) {
                    $week[] = date("Y-m-d", (($day * 86400) + $saturday));
                }
                $planning = array();
                // $planning_avenir = array();
                foreach($week as $weeks)
                 { 
            $planningfg = DB::table('prospections')
            ->whereDay('date', '=',date('d', strtotime($weeks)))
            ->whereMonth('date', '=',date('m', strtotime($weeks)))
            ->whereYear('date', '=',date('Y', strtotime($weeks)))
            ->where('commercial_id','like', '%'.$commercialFiltre.'%')
            ->whereIn('commercial_id',[$commercialFiltre])
            ->orderby('date', 'desc')
            ->get();
            
                foreach($planningfg as $planningf){
                        array_push($planning, $planningf);
                        }
                   
                 }
                 $planning_avenir = DB::table('prospections')
            ->whereDay('date', '>',$today)
            ->whereMonth('date', '>=',$action_mois)
            ->whereYear('date', '>=',$annee)
             ->where('commercial_id','like', '%'.$commercialFiltre.'%')
            ->whereIn('commercial_id',[$commercialFiltre])
            ->orderby('date', 'desc')
            ->get();
            

        return view('suiviSortieTerrain.plannings', compact('planning','planning_avenir'));
    }
    
      public function plannings_resFiltre(Request $request)
    {
        $semaineM7 = (date('d') -7);
                    $action_semaineP7 = (date('d') +7);
                    $action_mois = date('m');
                    $annee = date('Y');
                    $today=  date('d');
        $commercialFiltre =  $request->get('commercialFiltre');
        //$planning = array();
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        
        $commercial = DB::table('commerciaus')->where('superieur_id', $moi->id)->get(); 
        //foreach($commercial as $commercials){
        $week = [];
         $saturday = strtotime('monday this week');
        foreach (range(0, 6) as $day) {
                    $week[] = date("Y-m-d", (($day * 86400) + $saturday));
                }
                // $planning_avenir = array();
                $planning = array();
                foreach($week as $weeks)
                 { 
            $planningfg = DB::table('prospections')->where('superieur_id', $moi->id)
            ->whereDay('date', '=',date('d', strtotime($weeks)))
            ->whereMonth('date', '=',date('m', strtotime($weeks)))
            ->whereYear('date', '=',date('Y', strtotime($weeks)))
            ->where('commercial_id','like', '%'.$commercialFiltre.'%')
            ->whereIn('commercial_id',[$commercialFiltre])
            ->orderby('date', 'desc')
            ->get();
            
            foreach($planningfg as $planningf){
                    array_push($planning, $planningf);
                    }
                    
       
                 }
        $planning_avenir = DB::table('prospections')->where('superieur_id', $moi->id)
            ->whereDay('date', '>',$today)
            ->whereMonth('date', '>=',$action_mois)
            ->whereYear('date', '>=',$annee)
            ->where('commercial_id','like', '%'.$commercialFiltre.'%')
            ->whereIn('commercial_id',[$commercialFiltre])
            ->orderby('date', 'desc')
            ->get();
            
            
        foreach (range(0, 6) as $day) {
                    $week[] = date("Y-m-d", (($day * 86400) + $saturday));
                }
                $planning_pole = array();
                // $planning_avenir = array();
                foreach($week as $weeks)
                 { 
            $planningfg_pole = DB::table('prospections')->select('prospections.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'prospections.commercial_id')
            ->where('commerciaus.domaine_id', $moi->domaine_id)
            ->whereDay('prospections.date', '=',date('d', strtotime($weeks)))
            ->whereMonth('prospections.date', '=',date('m', strtotime($weeks)))
            ->whereYear('prospections.date', '=',date('Y', strtotime($weeks)))
            ->where('prospections.commercial_id','like', '%'.$commercialFiltre.'%')
            ->whereIn('prospections.commercial_id',[$commercialFiltre])
            ->orderby('prospections.date', 'asc')
            ->get();
            
            foreach($planningfg_pole as $planningf_pole){
                    array_push($planning_pole, $planningf_pole);
                    }
                }  
                
            
            $planning_avenir_pole = DB::table('prospections')->select('prospections.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'prospections.commercial_id')
            ->where('commerciaus.domaine_id', $moi->domaine_id)
            ->whereDay('prospections.date', '>',$today)
            ->whereMonth('prospections.date', '>=',$action_mois)
            ->whereYear('prospections.date', '>=',$annee)
            ->where('prospections.commercial_id','like', '%'.$commercialFiltre.'%')
            ->whereIn('prospections.commercial_id',[$commercialFiltre])
            ->orderby('prospections.date', 'asc')
            ->get();
                
        return view('suiviSortieTerrain.plannings_res', compact('planning_pole','planning_avenir_pole','planning','moi','planning_avenir'));
    }
   
   public function ajout_prospection()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $entreprise = DB::table('prospects')->where('commercial_id', $commercial->id)->orderBy('nom_entreprise')->get();
        $opportunite = DB::table('opportunites')->where('commercial_id', $commercial->id)->orderBy('libelle')->get();
        $produit = DB::table('produits')->get();
        $commercial = DB::table('commerciaus')->orderBy('prenom')->get();
        return view('suiviSortieTerrain.ajouter_visite', compact('entreprise','opportunite','produit','commercial' ));

    }
    
    public function store_prospection(Request $request)
    {
                $message = "Prospection ajoutée avec succès";
                $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
                 
                $prospection = new Prospection;
                $prospection->libelle = $request->get('libelle');
                $prospection->prospect_id = $request->get('prospect_id');
                $prospection->commercial_id = $commercial->id;
                $prospection->superieur_id = $commercial->superieur_id;
                // $prospection->commercial_backup = $request->get('commercial_backup');
                // $prospection->contact_id = $request->get('contact_id');
                // $prospection->produit_id = $request->get('produit_id');
                $prospection->opportunite_id = $request->get('opportunite_id');
                $prospection->heure_fin = $request->get('heure_fin');
                $prospection->heure_debut = $request->get('heure_debut');
                $prospection->date = $request->get('date');
                $prospection->statut = 0;
                $prospection->save();
                
                $action = new ActionCommercial;
                $action->libelle = $prospection->libelle;
                $action->opportunite_id = $prospection->opportunite_id;
                $action->prospect_id = $prospection->prospect_id;
                $action->commercial_id = $prospection->commercial_id;
                $action->priorite = 1;
                $action->deadline = $prospection->date;
                $action->type = $request->type;
                $action->save();
                
                // ActionCommercial::create([
                //     'libelle'              => $request->libelle,
                //     'opportunite_id'       => $prospection->opportunite_id,
                //     'prospect_id'          => $prospection->prospect_id,
                //     'commercial_id'        => $prospection->commercial_id,
                //     'priorite'             => 1,
                //     'deadline'             => $prospection->date,
                //     'type'             => $request->type,
                // ]);
                
                
                    // if($entreprise->save())
                    // {
                    //     Auth::login($user);
                    //     $user->notify(new BienvenueACollaboratis());
                    //     return back()->with(['message' => $message]);

                    // }
                    // else
                    // {
                    //     flash('user not saved')->error();

                    // }

                  
                return back()->with(['message' => $message]);
    }
   
    public function tous_les_pospects_stra()
    {

        $prospects = DB::table('prospects')->where('strategique', 1)->orderBy('created_at', 'desc')->paginate(1000);
        
        return view('suiviSortieTerrain.tous_les_pospects_stra', compact('prospects'));
    }
    public function prospect_stra()
    {
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();

        $prospects = DB::table('prospects')->where('strategique', 1)->orderBy('created_at', 'desc')->paginate(1000);
        
        $prospects_pole = DB::table('prospects')->select('prospects.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'prospects.commercial_id')
            ->where('commerciaus.domaine_id', $moi->domaine_id)
            ->where('prospects.strategique', 1)
            ->orderBy('prospects.created_at', 'desc')->paginate(10000);
        
        return view('suiviSortieTerrain.prospect_stra', compact('prospects', 'prospects_pole', 'moi'));
    }
   
   
     public function pros_rapport_sannsOp_liste($id)
    {
        $com = Commerciau::find($id);
        
        $pros_op = DB::table('opportunites')->where('commercial_id', $com->id)->where('archiver', 0)->pluck('prospect_id')->toArray(); 
        $prospecte = DB::table('prospects')->where('commercial_id', $com->id)->pluck('id')->toArray();
        $results = array_diff($prospecte, $pros_op);
        
        $prospect = array();
        foreach($results as $resulte){
            $prospectes = DB::table('prospects')->where('id', $resulte)->get();
            array_push($prospect,$prospectes );
        }
        return view('suiviSortieTerrain.pros_rapport_sannsOp_liste', compact('com', 'prospect'));
    }
    
      public function pros_rapport_liste($id)
    {
        $com = Commerciau::find($id);
        $prospect = DB::table('prospects')->where('commercial_id', $com->id)->paginate();
        
        return view('suiviSortieTerrain.pros_rapport_liste', compact('com', 'prospect'));
    }
    
       public function rapport_prospect()
    {
        $commerciau = DB::table('commerciaus')->orderBy('prenom')->get();
        return view('suiviSortieTerrain.rapport_prospect', compact( 'commerciau'));
    }
       public function filtre_rapport_prospect(Request $request)
    {
        $searchCommerciau = $request->get('searchCommerciau');
        $commerciau = DB::table('commerciaus')->orderBy('prenom')->where('id','like', '%'.$searchCommerciau.'%')->whereIn('id',[$searchCommerciau])->get();
        return view('suiviSortieTerrain.rapport_prospect', compact( 'commerciau'));
    }
        public function rapport_prospects_res()
    {
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
            $commerciau = DB::table('commerciaus')->where('superieur_id', $moi->id)->orderBy('prenom')->get();
        return view('suiviSortieTerrain.rapport_prospects_res', compact( 'commerciau'));
    }
    
     public function prospects_a_appeler()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $entreprise = DB::table('prospect_a_appellers')->where('commercial_id', $commercial->id)->orderby('id', 'desc')->paginate();
        return view('suiviSortieTerrain.prospects_a_appeler', compact('entreprise'));
    }
    
     public function lister_entreprise()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $entreprise = DB::table('prospects')->where('commercial_id', $commercial->id)->orderby('id', 'desc')->paginate();
        return view('suiviSortieTerrain.lister_entreprise', compact('entreprise'));
    }
    
     public function MyprospectFiltre(Request $request)
    {
        $serachPaysP = $request->get('serachPaysP');
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $entreprise = DB::table('prospects')->where('commercial_id', $commercial->id)->where('pays_id','like', '%'.$serachPaysP.'%')->whereIn('pays_id',[$serachPaysP])->orderBy('created_at', 'desc')->paginate(10000);
        return view('suiviSortieTerrain.lister_entreprise', compact('entreprise'));
    }
    public function prospect_stra_filtre(Request $request)
    {
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        $serachPaysStra = $request->get('serachPaysStra');
        $prospects = DB::table('prospects')->where('strategique', 1)->where('pays_id','like', '%'.$serachPaysStra.'%')->whereIn('pays_id',[$serachPaysStra])->orderBy('created_at', 'desc')->paginate(10000);
        
        $prospects_pole = DB::table('prospects')->select('prospects.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'prospects.commercial_id')
            ->where('commerciaus.domaine_id', $moi->domaine_id)
            ->where('prospects.strategique', 1)
            ->where('prospects.pays_id','like', '%'.$serachPaysStra.'%')->whereIn('prospects.pays_id',[$serachPaysStra])
            ->orderBy('prospects.created_at', 'desc')->paginate(10000);
        return view('suiviSortieTerrain.prospect_stra', compact('prospects','prospects_pole','moi'));
    }
    public function tous_prospect_stra_filtre(Request $request)
    {
        $serachPaysStra = $request->get('serachPaysStra');
        $prospects = DB::table('prospects')->where('strategique', 1)->where('pays_id','like', '%'.$serachPaysStra.'%')->whereIn('pays_id',[$serachPaysStra])->orderBy('created_at', 'desc')->paginate(10000);
        
        return view('suiviSortieTerrain.tous_les_pospects_stra', compact('prospects'));
    }
    
    // pour dg
    
     public function prospect_maTeam()
    {
        $entreprise = DB::table('prospects')->orderBy('strategique', 'desc')->paginate();
        return view('suiviSortieTerrain.prospect_maTeam', compact('entreprise'));
    }
    public function tous_les_pospects()
    {
        $entreprise = DB::table('prospects')->orderBy('strategique', 'desc')->paginate();
        return view('suiviSortieTerrain.tous_les_pospects', compact('entreprise'));
    }
    
   
    
     public function tous_prospect_maTeamFiltre(Request $request)
    {
        $serachCom = $request->get('serachCom');
        $serachPays = $request->get('serachPays');
        $entreprise = DB::table('prospects')->where('commercial_id','like', '%'.$serachCom.'%')->where('pays_id','like', '%'.$serachPays.'%')->whereIn('pays_id',[$serachPays])->orwhereIn('commercial_id',[$serachCom])->orderBy('created_at', 'desc')->paginate(10000);
        return view('suiviSortieTerrain.tous_les_pospects', compact('entreprise'));
    }
     public function prospect_maTeamFiltre(Request $request)
    {
        $serachCom = $request->get('serachCom');
        $serachPays = $request->get('serachPays');
        $entreprise = DB::table('prospects')->where('commercial_id','like', '%'.$serachCom.'%')->where('pays_id','like', '%'.$serachPays.'%')->whereIn('pays_id',[$serachPays])->orwhereIn('commercial_id',[$serachCom])->orderBy('created_at', 'desc')->paginate(10000);
        return view('suiviSortieTerrain.prospect_maTeam', compact('entreprise'));
    }
    
    
    
    public function filtre_onboarding(Request $request)
    {
        $serachOn = $request->get('serachOn');
        $commerciaux = DB::table('commerciaus')->orderby('prenom')->get();
            $commerciaux_onlines= array();
            foreach($commerciaux as $commerciau){
                $commerciaux_online = DB::table('users')->where('id', $commerciau->user_id)->where('id','like', '%'.$serachOn.'%')->whereIn('id',[$serachOn])->orderby('last_online_at', 'desc')->orderby('prenom')->get();       
                array_push($commerciaux_onlines, $commerciaux_online);
             }   
         
     $users = DB::table('users')->where('email', '!=', 'admin@gmail.com')->where('id','like', '%'.$serachOn.'%')->whereIn('id',[$serachOn])->orderby('last_online_at', 'desc')->get();
        return view('v2.onboarding', compact('commerciaux_onlines', 'users'));

    }
    
    public function filtre_password(Request $request)
    {
        $serachP = $request->get('serachP');
         $commerciaux = DB::table('commerciaus')->orderby('prenom')->get();
            $commerciaux_password= array();
            foreach($commerciaux as $commerciau){
                $commerciaux_user = DB::table('users')->where('id', $commerciau->user_id)->where('change_password', 0)->where('id','like', '%'.$serachP.'%')->whereIn('id',[$serachP])->orderby('last_online_at', 'desc')->orderby('prenom')->get();       
                array_push($commerciaux_password, $commerciaux_user);
             }   
         
     
        return view('v2.password_changer', compact('commerciaux_password'));

    }
    
      public function opportunite_prospect_maTeam($id)
    {
        $prospect = Prospect::find($id);
        
        return view('suiviSortieTerrain.opportunite_prospect_maTeam', compact('prospect'));
    }
    
       public function opportunite_com_maTeam($id)
    {
        $commerciaux = Commerciau::find($id);
                $opportunite = DB::table('opportunites')->where('commercial_id', $commerciaux->id)->orderBy('probabilite', 'desc')->where('archiver', 0)->paginate();
        return view('suiviSortieTerrain.opportunite_com_maTeam', compact('commerciaux', 'opportunite'));
    }
    
       public function opportunite_comIndividuel_maTeam($id)
    {
         $action_mois = date('m');
                    $annee = date('Y');
        $commerciaux = Commerciau::find($id);
                $opportunite = DB::table('opportunites')->where('commercial_id', $commerciaux->id)->orderBy('probabilite', 'desc')->where('archiver', 0)
                ->whereMonth('created_at', $action_mois)
                ->whereYear('created_at', $annee)->paginate();
        return view('suiviSortieTerrain.opportunite_comIndividuel_maTeam', compact('commerciaux', 'opportunite'));
    }
    
    
    
       public function prospect_com_maTeam($id)
    {
        $commerciaux = Commerciau::find($id);
                $prospect = DB::table('prospects')->where('commercial_id', $commerciaux->id)->orderBy('created_at', 'desc')->paginate();
        return view('suiviSortieTerrain.prospect_com_maTeam', compact('commerciaux', 'prospect'));
    }
    
    public function prospect_comIndivuduel_maTeam($id)
    {
         $action_mois = date('m');
                    $annee = date('Y');
        $commerciaux = Commerciau::find($id);
                $prospect = DB::table('prospects')->where('commercial_id', $commerciaux->id)->whereMonth('created_at', $action_mois)
                                    ->whereYear('created_at', $annee)->orderBy('created_at', 'desc')->paginate();
        return view('suiviSortieTerrain.prospect_comIndivuduel_maTeam', compact('commerciaux', 'prospect'));
    }
    
       public function filtrer_opportunite_maTam(Request $request, $id)
    {
        $search = $request->get('search');
        $searchOr = $request->get('searchOr');
        $commerciaux = Commerciau::find($id);
        $opportunite = DB::table('opportunites')->where('commercial_id', $commerciaux->id)->where('archiver', 0)->where('statut','like', '%'.$search.'%')->where('origine_id','like', '%'.$searchOr.'%')->paginate(1000);
        return view('suiviSortieTerrain.opportunite_com_maTeam', compact('opportunite', 'commerciaux'));
    }


   public function filtrer_opportuniteIndividuel_maTam(Request $request, $id)
    {
          $action_mois = date('m');
                    $annee = date('Y');
        $search = $request->get('search');
        $searchOr = $request->get('searchOr');
        $commerciaux = Commerciau::find($id);
        $opportunite = DB::table('opportunites')->where('commercial_id', $commerciaux->id)->where('archiver', 0)->where('statut','like', '%'.$search.'%')->where('origine_id','like', '%'.$searchOr.'%')
        ->whereMonth('created_at', $action_mois)
                ->whereYear('created_at', $annee)->paginate(1000);
        return view('suiviSortieTerrain.opportunite_comIndividuel_maTeam', compact('opportunite', 'commerciaux'));
    }
    
      public function commerciaux_maTeam()
    {
        $commerciaux = DB::table('commerciaus')->orderBy('prenom')->paginate();
        return view('suiviSortieTerrain.commerciaux_maTeam', compact('commerciaux'));
    }
    
     public function commerciaux_maTeamIndividuel()
    {
        $commerciaux = DB::table('commerciaus')->orderBy('prenom')->paginate();
        return view('suiviSortieTerrain.commerciaux_maTeamIndividuel', compact('commerciaux'));
    }
    
     public function commerciaux_maTeamIndividuel_moi()
    {
        $commerciau = Commerciau::where('user_id', Auth::user()->id)->first();
        return view('suiviSortieTerrain.commerciaux_maTeamIndividuel_moi', compact('commerciau'));
    }
    
     public function commerciaux_maTeamIndividuel_res()
    {
        $commerciaux = DB::table('commerciaus')->orderBy('prenom')->paginate(1000);
        return view('suiviSortieTerrain.commerciaux_maTeamIndividuel_res', compact('commerciaux'));
    }
    
    
     public function commerciaux_maTeamIndividuelFiltre(Request $request)
    {
        $searchCommerciau = $request->get('searchCommerciau');
        $commerciaux = DB::table('commerciaus')->where('id','like', '%'.$searchCommerciau.'%')->whereIn('id',[$searchCommerciau])->paginate(10000);
        return view('suiviSortieTerrain.commerciaux_maTeamIndividuel', compact('commerciaux'));
    }
    
     public function commerciaux_maTeamIndividuel_resFiltre(Request $request)
    {
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        $searchCommerciau = $request->get('searchCommerciau');
        $commerciaux = DB::table('commerciaus')->where('id','like', '%'.$searchCommerciau.'%')->whereIn('id',[$searchCommerciau])->paginate(10000);
        
        $commerciaux_pole = DB::table('commerciaus')->where('domaine_id', $moi->domaine_id)->where('id','like', '%'.$searchCommerciau.'%')->whereIn('id',[$searchCommerciau])->orderBy('prenom')->paginate(1000);
        return view('suiviSortieTerrain.commerciaux_maTeamIndividuel_res', compact('commerciaux','commerciaux_pole'));
    }
    
      public function parametres_res()
    {
        $commerciaux = array();
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        $com_team = DB::table('commerciaus')->where('superieur_id', $moi->id)->orderBy('prenom')->get();
        foreach($com_team as $com_teams){
            $commerciauxss = DB::table('objectif_commissions')->where('commercial_id', $com_teams->id)->get();
            foreach($commerciauxss as $commerci){
                array_push($commerciaux,$commerci);
        }
        }
        
        return view('suiviSortieTerrain.parametres_res', compact('commerciaux'));
    }
    
      public function parametres()
    {
        $commerciaux = DB::table('objectif_commissions')->paginate(1000);
        
        return view('suiviSortieTerrain.parametres', compact('commerciaux'));
    }
    
      public function filtrer_commerciaux_para(Request $request)
    {
        $searchCommerciau = $request->get('searchCommerciau');
        $commerciaux = DB::table('objectif_commissions')->where('commercial_id','like', '%'.$searchCommerciau.'%')->whereIn('commercial_id',[$searchCommerciau])->paginate(10000);
        return view('suiviSortieTerrain.parametres', compact('commerciaux'));
    }
    
      public function tous_les_commerciaux()
    {
        $commerciaux = DB::table('commerciaus')->orderBy('prenom')->paginate();
        return view('suiviSortieTerrain.tous_les_commerciaux', compact('commerciaux'));
    }
    
     public function insert_superieur()
    {
        $commerciaux = DB::table('commerciaus')->get();
        foreach($commerciaux as $commerciau)
        {
            DB::table('prospects')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('opportunites')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('action_commerciales')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('prospections')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('contacts')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('demos')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('update_opps')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('stock_mensuelles')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
             DB::table('stock_journalieres')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            
            DB::table('prospects')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
            DB::table('opportunites')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
            DB::table('action_commerciales')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
            DB::table('prospections')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
            DB::table('contacts')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
            DB::table('demos')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
            DB::table('update_opps')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
            DB::table('stock_mensuelles')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
             DB::table('stock_journalieres')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
              
            DB::table('performances')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
            //  DB::table('users')
            //  ->whereIn('commercial_id', [$commerciau->id])
            // ->update(['entreprise_client_id' => 1]);
            
        }
        
        echo 'yes is okay';
    }
    
      public function commerciaux_maTeam_res()
    {
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        $commerciaux = DB::table('commerciaus')->where('superieur_id', $moi->id)->orderBy('prenom')->paginate(1000);
        $commerciaux_pole = DB::table('commerciaus')->where('domaine_id', $moi->domaine_id)->orderBy('prenom')->paginate(1000);
        return view('suiviSortieTerrain.commerciaux_maTeam_res', compact('commerciaux_pole','commerciaux'));
    }
     public function prospect_maTeam_res()
    {
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
            $entreprise = DB::table('prospects')
            ->where('superieur_id', $moi->id)
            ->orderBy('created_at', 'desc')->paginate(10000);
        
        $entreprise_pole = DB::table('prospects')->select('prospects.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'prospects.commercial_id')
            ->where('commerciaus.domaine_id', $moi->domaine_id)
            ->orderBy('prospects.created_at', 'desc')->paginate(10000);
        
        return view('suiviSortieTerrain.prospect_maTeam_res', compact('entreprise','entreprise_pole'));
    }
    
     public function prospect_maTeamFiltreRes(Request $request)
    {
        $serachCom = $request->get('serachCom');
        $serachPays = $request->get('serachPays');
        
         $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        $commerciaux = DB::table('commerciaus')->where('superieur_id', $moi->id)->orderBy('prenom')->get();
      
            $entreprise = DB::table('prospects')->where('superieur_id', $moi->id)
            ->where('commercial_id','like', '%'.$serachCom.'%')
            ->where('pays_id','like', '%'.$serachPays.'%')
            ->whereIn('commercial_id', [$serachCom])
            ->orWhereIn('pays_id', [$serachPays])
            ->orderBy('created_at', 'desc')->paginate(10000);
        
        $entreprise_pole = DB::table('prospects')->select('prospects.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'prospects.commercial_id')
            ->where('commerciaus.domaine_id', $moi->domaine_id)
            ->where('prospects.commercial_id','like', '%'.$serachCom.'%')
            ->where('prospects.pays_id','like', '%'.$serachPays.'%')
            ->whereIn('prospects.commercial_id', [$serachCom])
            ->orWhereIn('prospects.pays_id', [$serachPays])
            ->orderBy('prospects.created_at', 'desc')->paginate(10000);
       
        
        return view('suiviSortieTerrain.prospect_maTeam_res', compact('entreprise','entreprise_pole'));
    }
    
    public function filtrer_commerciaux(Request $request)
    {
        $searchCommerciau = $request->get('searchCommerciau');
        $commerciaux = DB::table('commerciaus')->where('id','like', '%'.$searchCommerciau.'%')->whereIn('id',[$searchCommerciau])->paginate(10000);
        return view('suiviSortieTerrain.commerciaux_maTeam', compact('commerciaux'));
    }
     public function tous_search_commerciau(Request $request)
    {
        $searchCommerciau = $request->get('searchCommerciau');
        $commerciaux = DB::table('commerciaus')->where('id','like', '%'.$searchCommerciau.'%')->whereIn('id',[$searchCommerciau])->paginate();
        return view('suiviSortieTerrain.tous_les_commerciaux', compact('commerciaux'));
    }
    
     public function filtrer_commerciauxRes(Request $request)
    {
        $searchCommerciau = $request->get('searchCommerciau');
        //$commerciaux = DB::table('commerciaus')->where('id','like', '%'.$searchCommerciau.'%')->paginate();
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        $commerciaux = DB::table('commerciaus')->where('superieur_id', $moi->id)->where('id','like', '%'.$searchCommerciau.'%')->whereIn('id',[$searchCommerciau])->orderBy('prenom')->paginate(10000);
        return view('suiviSortieTerrain.commerciaux_maTeam_res', compact('commerciaux'));
    }
    
      public function objectif_ventes()
    {
        $stock_mensuell = DB::table('stock_mensuelles')->paginate(22);
        $stock_mensuelles = DB::table('stock_mensuelles')->orderBy('created_at', 'desc')->paginate(10000);
        $commerciaux = DB::table('commerciaus')->orderBy('prenom')->paginate();
        return view('suiviSortieTerrain.objectif_vente', compact('stock_mensuell', 'commerciaux', 'stock_mensuelles'));
    }
      public function objectif_ventes_res()
    {
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        $stock_mensuell = DB::table('stock_mensuelles')->where('superieur_id', $moi->id)->paginate();
        $stock_mensuelles = DB::table('stock_mensuelles')->where('superieur_id', $moi->id)->orderBy('created_at', 'desc')->paginate(100000);
        
         $stock_mensuelles_pole = DB::table('stock_mensuelles')->select('stock_mensuelles.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'stock_mensuelles.commercial_id')
            ->where('commerciaus.domaine_id', $moi->domaine_id)
            ->orderBy('stock_mensuelles.created_at', 'desc')->paginate(10000);
        $commerciaux = DB::table('commerciaus')->where('superieur_id', $moi->id)->orderBy('prenom')->paginate();
        return view('suiviSortieTerrain.objectif_vente_res', compact('stock_mensuelles_pole','stock_mensuell', 'commerciaux', 'stock_mensuelles'));
    }
      public function search_par_com_res(Request $request)
    {
        $searchCommerciau = $request->get('searchCommerciau');
        $searchCommerciauMois = $request->get('searchCommerciauMois');
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        $stock_mensuell = DB::table('stock_mensuelles')->paginate();
        //     $stock_mensuelles = DB::table('stock_mensuelles')->where('superieur_id', $moi->id)
    //     ->where('commercial_id','like', '%'.$searchCommerciau.'%')
    //     ->where('created_at','like', '%'.$searchCommerciauMois.'%')
    //     ->whereIn('commercial_id',[$searchCommerciau])
    //     ->orwhereIn('created_at', [$searchCommerciauMois])
    //     ->orderBy('created_at', 'desc')
    //   ->paginate(10000);
    $stock_mensuelles = Stock_mensuelle::where('superieur_id', $moi->id)->when(request()->has('searchCommerciauMois'), function($q){
            $q->whereMonth('created_at', request('searchCommerciauMois'));
        })
        ->when(request()->has('searchCommerciau'), function($q){
            $q->where('commercial_id', request('searchCommerciau'));
        })
        // ->whereMonth(['created_at','like', '%'.$searchCommerciauMois.'%'])
        // ->whereIn('commercial_id',[$searchCommerciau])
        // ->orWhere(['commercial_id','like', '%'.$searchCommerciau.'%'])
        // ->whereIn('created_at', [$searchCommerciauMois])
        ->orderBy('created_at', 'desc')
        ->paginate(10000);
       
       $stock_mensuelles_pole = DB::table('stock_mensuelles')->select('stock_mensuelles.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'stock_mensuelles.commercial_id')
            ->where('commerciaus.domaine_id', $moi->domaine_id)
            ->where('stock_mensuelles.commercial_id','like', '%'.$searchCommerciau.'%')
        ->where('stock_mensuelles.created_at','like', '%'.$searchCommerciauMois.'%')
        ->whereIn('stock_mensuelles.commercial_id',[$searchCommerciau])
        ->orwhereIn('stock_mensuelles.created_at', [$searchCommerciauMois])
            ->orderBy('stock_mensuelles.created_at', 'desc')->paginate(10000);
        $commerciaux = DB::table('commerciaus')->where('superieur_id', $moi->id)->where('id','like', '%'.$searchCommerciau.'%')->whereIn('id',[$searchCommerciau])->orderBy('prenom')->paginate();
        return view('suiviSortieTerrain.objectif_vente_res', compact('stock_mensuelles_pole','stock_mensuell', 'commerciaux', 'stock_mensuelles'));
    }
    
      public function filtrer_par_com(Request $request)
    {
        $searchCommerciau = $request->get('searchCommerciau');
        $searchCommerciauMois = $request->get('searchCommerciauMois');
        $stock_mensuell = DB::table('stock_mensuelles')->paginate(22);
        //  $stock_mensuelles =  Stock_mensuelle::query()
         $stock_mensuelles = Stock_mensuelle::when(request()->has('searchCommerciauMois'), function($q){
            $q->whereMonth('created_at', request('searchCommerciauMois'));
        })
        ->when(request()->has('searchCommerciau'), function($q){
            $q->where('commercial_id', request('searchCommerciau'));
        })
        // ->whereMonth(['created_at','like', '%'.$searchCommerciauMois.'%'])
        // ->whereIn('commercial_id',[$searchCommerciau])
        // ->orWhere(['commercial_id','like', '%'.$searchCommerciau.'%'])
        // ->whereIn('created_at', [$searchCommerciauMois])
        ->orderBy('created_at', 'desc')
        ->paginate(10000);
        //  $stock_mensuelles = DB::table('stock_mensuelles')
        // ->where('commercial_id','like', '%'.$searchCommerciau.'%')
        // ->where('created_at','like', '%'.$searchCommerciauMois.'%')
        // ->whereIn('commercial_id',[$searchCommerciau])
        // ->orwhereIn('created_at', [$searchCommerciauMois])
        // ->orderBy('created_at', 'desc')
        // ->paginate(10000);
        $commerciaux = DB::table('commerciaus')->where('id','like', '%'.$searchCommerciau.'%')->whereIn('id',[$searchCommerciau])->orderBy('prenom')->get();
        return view('suiviSortieTerrain.objectif_vente', compact('stock_mensuell', 'commerciaux', 'stock_mensuelles'));
    }
    
      public function filtrer_par_com_Rcontact(Request $request)
    {
        $searchCommerciaucf = $request->get('searchCommerciaucf');
        $searchCommerciauMois = $request->get('searchCommerciauMois');
        $commerciaux = Commerciau::all();
        $contacts = DB::table('contacts')->orderBy('prenom')->get();
        $stock_mensuelles = DB::table('stock_mensuelles')
        ->when(request()->has('searchCommerciauMois'), function($q){
            $q->whereMonth('created_at', request('searchCommerciauMois'));
        })
        ->when(request()->has('searchCommerciaucf'), function($q){
            $q->where('commercial_id', request('searchCommerciaucf'));
        })
        // ->where('commercial_id','like', '%'.$searchCommerciaucf.'%')
        // ->where('created_at','like', '%'.$searchCommerciauMois.'%')
        // ->whereIn('commercial_id',[$searchCommerciaucf])
        // ->orwhereIn('created_at', [$searchCommerciauMois])
        ->get();
        return view('suiviSortieTerrain.rapport_contact', compact('stock_mensuelles','contacts', 'commerciaux'));
    }
    
      public function filtrer_par_com_Rcontact_res(Request $request)
    {
        $searchCommerciaucf = $request->get('searchCommerciaucf');
        $searchCommerciauMois = $request->get('searchCommerciauMois');
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        $commerciaux = Commerciau::all();
        $contacts = DB::table('contacts')->orderBy('prenom')->get();
        $stock_mensuelles = DB::table('stock_mensuelles')->where('superieur_id', $moi->id)
         ->when(request()->has('searchCommerciauMois'), function($q){
            $q->whereMonth('created_at', request('searchCommerciauMois'));
        })
        ->when(request()->has('searchCommerciaucf'), function($q){
            $q->where('commercial_id', request('searchCommerciaucf'));
        })
        // ->where('commercial_id','like', '%'.$searchCommerciaucf.'%')
        // ->where('created_at','like', '%'.$searchCommerciauMois.'%')
        // ->whereIn('commercial_id',[$searchCommerciaucf])
        // ->orwhereIn('created_at', [$searchCommerciauMois])
        ->get();
        
        $stock_mensuelles_pole = DB::table('stock_mensuelles')->select('stock_mensuelles.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'stock_mensuelles.commercial_id')
            ->where('commerciaus.domaine_id', $moi->domaine_id)
            ->where('stock_mensuelles.commercial_id','like', '%'.$searchCommerciaucf.'%')
        ->where('stock_mensuelles.created_at','like', '%'.$searchCommerciauMois.'%')
        ->whereIn('stock_mensuelles.commercial_id',[$searchCommerciaucf])
        ->orwhereIn('stock_mensuelles.created_at', [$searchCommerciauMois])->get();
        return view('suiviSortieTerrain.rapport_contact_res', compact('stock_mensuelles_pole','stock_mensuelles','contacts', 'commerciaux', 'moi'));
    }
    
     public function filtrer_liste_updates(Request $request)
    {
        $searchCommerciaucf = $request->get('searchCommerciaucf');
        $mois = date('m');
        $updates = DB::table('update_opps')->whereMonth('created_at', $mois)->where('commercial_id','like', '%'.$searchCommerciaucf.'%')->whereIn('commercial_id',[$searchCommerciaucf])->OrderBy('created_at', 'desc')->paginate();
        return view('suiviSortieTerrain.liste_updates', compact('updates'));
    }
    
    public function filtrer_liste_updates_res(Request $request)
    {
        $searchCommerciaucf = $request->get('searchCommerciaucf');
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        $mois = date('m');
        $updates = DB::table('update_opps')->where('superieur_id', $moi->id)->where('commercial_id','like', '%'.$searchCommerciaucf.'%')->whereIn('commercial_id',[$searchCommerciaucf])->whereMonth('created_at', $mois)->OrderBy('created_at', 'desc')->paginate();
       $updates_pole = DB::table('update_opps')->select('update_opps.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'update_opps.commercial_id')
            ->where('commerciaus.domaine_id', $moi->domaine_id)->whereMonth('update_opps.created_at', $mois)
            // ->where('entreprise_client_id', $moi->entreprise_client_id)
            ->where('update_opps.commercial_id','like', '%'.$searchCommerciaucf.'%')->whereIn('update_opps.commercial_id',[$searchCommerciaucf])->paginate(1000);

        return view('suiviSortieTerrain.liste_updates_res', compact('updates', 'moi','updates_pole'));
    }
    
    
     public function filtrer_liste_demos(Request $request)
    {
        $searchCommerciaucf = $request->get('searchCommerciaucf');
        $mois = date('m');
        
        
        $demos = DB::table('demos')->whereMonth('created_at', $mois)->where('commercial_id','like', '%'.$searchCommerciaucf.'%')->whereIn('commercial_id',[$searchCommerciaucf])->OrderBy('created_at', 'desc')->paginate();
        return view('suiviSortieTerrain.liste_demos', compact('demos'));
    }
    
     public function filtrer_liste_demos_res(Request $request)
    {
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        $searchCommerciaucf = $request->get('searchCommerciaucf');
        $mois = date('m');
        $demos_pole = DB::table('demos')->select('demos.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'demos.commercial_id')
            ->where('commerciaus.domaine_id', $moi->domaine_id)
            // ->where('entreprise_client_id', $moi->entreprise_client_id)
            ->whereMonth('demos.created_at', $mois)->OrderBy('demos.created_at', 'desc')
            ->where('demos.commercial_id','like', '%'.$searchCommerciaucf.'%')->whereIn('demos.commercial_id',[$searchCommerciaucf])->paginate(1000);
            
        $demos = DB::table('demos')->whereMonth('created_at', $mois)->where('superieur_id', $moi->id)->where('commercial_id','like', '%'.$searchCommerciaucf.'%')->whereIn('commercial_id',[$searchCommerciaucf])->OrderBy('created_at', 'desc')->paginate();
        return view('suiviSortieTerrain.liste_demos_res', compact('demos','moi','demos_pole'));
    }
    
       public function top_commercial($id)
    {
        $commerciau = Commerciau::find($id);
        return view('suiviSortieTerrain.top_commercial', compact('commerciau'));
    }
    
    // end dg
    
    public function historiques_statuts()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('commercial_id', $commercial->id)->get();
        
        return view('suiviSortieTerrain.historiques_statuts', compact('opportunite'));
    }
    
   public function create_entreprise()
    {
        $pays = DB::table('pays')->orderBy('libelle')->get();
        $multinational = DB::table('multinationals')->orderBy('libelle')->get();
        $secteur_activite = DB::table('secteur_activites')->orderBy('libelle')->get();
        
       
        
        return view('suiviSortieTerrain.ajouter_entreprise', compact('pays','secteur_activite','multinational'));

    }
    
    public function autocomplete(Request $request)
    {
         // if($request->has('term')){
        //             return Prospect::where('nom_entreprise','like','%'.$request->input('term').'%')->get();
        //         }
        $data = Prospect::select("nom_entreprise")
                ->where("nom_entreprise","LIKE","%{$request->query}%")
                ->get();
   
        return response()->json($data);
    }
    
    public function store_entreprise(Request $request)
    {
                $message = "Prospect ajouté avec succès";
                
                if($request->has('term')){
                    return Prospect::where('nom_entreprise','like','%'.$request->input('term').'%')->get();
                }
                        
                //$validator = $this->validate($request, [
                    //  'nom_entreprise' => 'required|exists:prospects,created_at'
                   //]);
            
            //if($validator) {
           
                $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
                 
                $entreprise = new Prospect;
                $entreprise->nom_entreprise = $request->get('nom_entreprise'); 
                $entreprise->pays_id = $request->get('pays_id');
                $entreprise->date = $request->get('date');
                $entreprise->groupe = $request->get('groupe');
                $entreprise->multinational = $request->get('multinational');
                $entreprise->commercial_id = $commercial->id;
                $entreprise->superieur_id = $commercial->superieur_id;
                $entreprise->contact = $request->get('contact');
                $entreprise->strategique = $request->get('strategique');
                $entreprise->phone = $request->get('phone');
                $entreprise->secteur_activite = $request->get('secteur_activite');
                $entreprise->autres = $request->get('autres');
                $entreprise->autres_multis = $request->get('autres_multis');
                $entreprise->save();
                    if($entreprise->groupe == 1){
                    DB::table('prospects')->where('id',$entreprise->id)->update(['strategique' => 1]);
                    }
                  
                    $prenom = $request->get('prenom'); 
                    $nom = $request->get('nom'); 
                    $email = $request->get('email'); 
                    $phones = $request->get('phones');
                    $responsabilite = $request->get('responsabilite'); 
                    $prospect_id = $entreprise->id;
                    $commercial_id = $entreprise->commercial_id;
                    $superieur_id = $entreprise->superieur_id;
                    
                    for($i=0; $i < count($prenom); $i++){
                    $contacts = [
                        
                        'prenom' => $prenom[$i],
                        'nom' => $nom[$i],
                        'email' => $email[$i],
                        'phone' => $phones[$i],
                        'responsabilite' => $responsabilite[$i],
                        'commercial_id' =>$entreprise->commercial_id,
                        'superieur_id' =>$entreprise->superieur_id,
                        'prospect_id' =>$entreprise->id
                         ];
                 
                        if($prenom[$i] !== null){
                        DB::table('contacts')->insert($contacts);
                        
                    }
                        
                    }
                
                 $ajout_prospect = $entreprise->id;
                 
                 if($entreprise->multinational == 8){
                 $multis = new Multinational;
                 $multis->libelle = $request->get('autres_multis');
                 $multis->save();
                 }
                 
                 if($entreprise->secteur_activite == 15){
                 $multis = new Secteur_activite;
                 $multis->libelle = $request->get('autres');
                 $multis->save();
                 }
                 
          
                 
               
          
                 
                return back()->with(['message' => $message, 'ajout_prospect' => $ajout_prospect]);
                
    }
    
    
    
    public function ajout_pros_op($id)
    {
        $prospect = Prospect::find($id);
        $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
        $prospects = DB::table('prospects')->where('commercial_id', $commercial->id)->get();
        $statut = DB::table('statut_opportunites')->orderBy('libelle')->get();
        $origine = DB::table('origines')->get();
        $backup = DB::table('commerciaus')->where('entreprise_client_id', $commercial->entreprise_client_id)->orderBy('prenom')->get();
        return view('suiviSortieTerrain.ajout_pros_op', compact('backup','prospect', 'commercial', 'prospects', 'statut', 'origine'));

    }
    
     public function ajouter_contact()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $op = DB::table('opportunites')->where('commercial_id', $commercial->id)->orderBy('id', 'desc')->get();
        $prospect = DB::table('prospects')->where('commercial_id', $commercial->id)->orderBy('id', 'desc')->get();
        return view('suiviSortieTerrain.ajouter_contact', compact('op', 'prospect'));

    }
    
    public function store_contact(Request $request)
    {
                $message = "Contact ajouté avec succès";
                
                $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
                $contact = new Contact;
                $contact->prenom = $request->get('prenom'); 
                $contact->nom = $request->get('nom'); 
                $contact->email = $request->get('email'); 
                $contact->phone = $request->get('phone'); 
                $contact->responsabilite = $request->get('responsabilite'); 
                $contact->opportunite_id = $request->get('opportunite_id'); 
                $contact->prospect_id = $request->get('prospect_id'); 
                $contact->commercial_id = $commercial->id; 
                $contact->superieur_id = $commercial->superieur_id; 
                $contact->save();
                
                return back()->with(['message' => $message]);
    }
    
      public function opportunite_prospect_create($id)
    {
        $prospect = Prospect::find($id);
        $statut = DB::table('statut_opportunites')->orderBy('libelle')->get();
        $origine = DB::table('origines')->get();
        $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
        $backup = DB::table('commerciaus')->where('entreprise_client_id', $commercial->entreprise_client_id)->orderBy('prenom')->get();
        return view('suiviSortieTerrain.opportunite_prospect_ajout',compact('prospect','backup', 'statut', 'origine'));

    }
    
    public function opportunite_prospect_store(Request $request, $id)
    {
        //
                $message = "Opportunité ajoutée avec succès";
                $commercialMe = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                
                $now = now();
                
                $opportunite = new Opportunite;
                $opportunite->libelle = $request->get('libelle'); 
                $opportunite->prospect_id = $request->get('prospect_id'); 
                $opportunite->commercial_id = $commercialMe->id;
                $opportunite->superieur_id = $commercialMe->superieur_id;
                $opportunite->commercial_backup = $request->get('commercial_backup');
                $opportunite->origine_id = $request->get('origine_id');
                // $opportunite->probabilite = $request->get('probabilite');
                $opportunite->deadline = $request->get('deadline');
                $opportunite->multinational = $request->get('multinational');
                $opportunite->pays_id = $commercialMe->pays_id;
                // $opportunite->valeur_actuelle = $request->get('valeur_actuelle');
                $opportunite->objectif_de_vente = $request->get('objectif_de_vente');
                $opportunite->contact = $request->get('contact');
                // $opportunite->target_vente = $request->get('target_vente');
                $opportunite->statut = $request->get('statut');
                $opportunite->date_debut = $request->get('date_debut');
                $opportunite->save();
                
                $proba = DB::table('statut_opportunites')->where('id', $opportunite->statut)->first();
                
                DB::table('opportunites')->where('id', $opportunite->id)->update(['probabilite' => $proba->probabilite] );
                
                
                DB::table('historiques')->insert(['statut' => $opportunite->statut, 'opportunite_id' => $opportunite->id, 'date_creer_op' => $now, 'date_ajouter' => $opportunite->created_at, 'date_modifier' => $opportunite->created_at] );
                DB::table('historiques_probas')->insert(['statut' => $opportunite->statut, 'opportunite_id' => $opportunite->id, 'date_creer_op' => $now, 'date_ajouter' => $opportunite->created_at, 'date_modifier' => $opportunite->created_at] );

                   if($opportunite->contact == 1)
                    
                        {
                            
                            DB::table('contacts')->where('prospect_id', $opportunite->prospect_id)->update(['opportunite_id' => $opportunite->id]);
                        }
                    
                if($opportunite->contact == 0){
                   $prenom = $request->get('prenom'); 
                    $nom = $request->get('nom'); 
                    $email = $request->get('email'); 
                    $phones = $request->get('phones');
                    $responsabilite = $request->get('responsabilite'); 
                    $opportunite_id = $opportunite->id;
                    
                    for($i=0; $i < count($prenom); $i++){
                    $contacts = [
                        
                        'prenom' => $prenom[$i],
                        'nom' => $nom[$i],
                        'email' => $email[$i],
                        'phone' => $phones[$i],
                        'responsabilite' => $responsabilite[$i],
                        'opportunite_id' =>$opportunite->id
                        
                         ];
                   
                        DB::table('contacts')->insert($contacts);
                    } 
                    // }
                }   
                
                
                if($opportunite->commercial_id != $commercialMe->id){
                    $commercial_res = DB::table('commerciaus')->where('id', $opportunite->commercial_id)->where('id','!=', $commercialMe->id)->first();
                    Mail::to($commercial_res->email)->send(new MailResOp($commercial_res, $opportunite, $commercialMe));
                }
                if($opportunite->commercial_backup){
                    $commercial = DB::table('commerciaus')->where('id', $opportunite->commercial_backup)->where('id','!=', $commercialMe->id)->first();
                    Mail::to($commercial->email)->send(new MailBackupOp($commercial, $opportunite, $commercialMe));
                }
                return back()->with(['message' => $message]);
    }

     public function opportunite_prospect_lister($id)
    {
        $prospect = Prospect::find($id);
        
        return view('suiviSortieTerrain.opportunite_prospect_lister', compact('prospect'));
    }
    
   
    
    public function detail_prospect($id)
    {
        //
        $prospect = Prospect::find($id);
        return view('suiviSortieTerrain.detail_prospect', compact('prospect'));

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
    public function edit_entreprise($id)
    {
        //
        $entreprise = Prospect::find($id);
        $secteur = DB::table('secteur_activites')->orderBy('libelle')->get();
        $pay = DB::table('pays')->orderBy('libelle')->get();
        $commercial = DB::table('commerciaus')->get();
        return view('suiviSortieTerrain.edit_entreprise', compact('entreprise', 'secteur', 'commercial', 'pay'));

    }
  
    public function update_entreprise(Request $request, $id)
    {
            $message = "Prospect modifié avec succès";
            
            if($request->file('logo')){
           $logo = $request->file('logo');
           $file_name = $logo->getClientOriginalName();
           $logo->move(public_path().'/imgs/', $file_name);
        }
            
            
                $entreprise = Prospect::findOrFail($id);
                $entreprise->nom_entreprise = $request->get('nom_entreprise');
                $entreprise->strategique = $request->get('strategique');
                $entreprise->commercial_id = $request->get('commercial_id');
                $entreprise->phone = $request->get('phone');
                $entreprise->secteur_activite = $request->get('secteur_activite');
                $entreprise->pays_id = $request->get('pays_id');
                $entreprise->logo  = (isset($file_name)) ? $file_name : $entreprise->logo;   
                $entreprise->save();
                

        return redirect('lister_entreprises')->with(['message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_contact($id)
    {
        //
        $message = "Contact supprimé avec succès";
        $entreprise = Contact::find($id);
        $entreprise->delete();

        return back()->with(['message' => $message]);
    }
    
    public function delete_mon_planning($id)
    {
        //
        $message = "Planning supprimé avec succès";
        $entreprise = Prospection::find($id);
        $entreprise->delete();

        return back()->with(['message' => $message]);
    }
    
     public function destroy_entreprise($id)
    {
        //
        $message = "Prospect supprimé avec succès";
        $entreprise = Prospect::find($id);
        $entreprise->delete();

        return back()->with(['message' => $message]);
    }
    
     
        // Prospections
      public function lister_prospections()
    {
        $prospection = DB::table('prospections')->get();
        return view('suiviSortieTerrain.lister_prospections', compact('prospection'));
    }
    public function create_prospections()
    {
        $entreprise = DB::table('prospects')->where('commercial_id', $commercial->id)->get();
        $produit = DB::table('produits')->get();
        $commercial = DB::table('commerciaus')->get();
        return view('suiviSortieTerrain.ajouter_prospections', compact('entreprise','produit','commercial' ));

    }
    
    public function store_prospections(Request $request)
    {
                $message = "Prospection ajoutée avec succès";
                $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
                 
                $prospection = new Prospection;
                $prospection->prospect_id = $request->get('prospect_id');
                $prospection->commercial_id = $commercial->id;
                // $prospection->commercial_backup = $request->get('commercial_backup');
                // $prospection->contact_id = $request->get('contact_id');
                $prospection->produit_id = $request->get('produit_id');
                $prospection->heure_fin = $request->get('heure_fin');
                $prospection->heure_debut = $request->get('heure_debut');
                $prospection->date = $request->get('date');
                $prospection->statut = $request->get('statut');
                $prospection->save();
                    // if($entreprise->save())
                    // {
                    //     Auth::login($user);
                    //     $user->notify(new BienvenueACollaboratis());
                    //     return back()->with(['message' => $message]);

                    // }
                    // else
                    // {
                    //     flash('user not saved')->error();

                    // }

                  
                return back()->with(['message' => $message]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
}
