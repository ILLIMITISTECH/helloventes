<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Notification;
use App\Commerciau;
use App\Opportunite;
use App\ActionCommercial;
use App\Prospect;
use App\User;
use Auth;
use DB;
use Mail;
use App\Mail\MailCommercial;
use App\Mail\MailBackupAtionM;

use Session;
use Mailjet\LaravelMailjet\Facades\Mailjet;

class ActionController extends Controller
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
    
    
     public function toutes_actions_aVenir_res()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        
                  $semaineM7 = date('d');
                    $action_semaineP7 = (date('d') +8);
                    $action_mois = date('m');
                    $mois = date('m');
                      $annee = date('Y'); 
                    
$actions_semaine = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom',
'commerciaus.pays_id','opportunites.prospect_id','opportunites.libelle as libopportunite')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
        ->join('opportunites', 'opportunites.id', 'action_commerciales.opportunite_id')
        ->where('action_commerciales.superieur_id', $commercial->id)
        ->whereYear('action_commerciales.deadline', '>=', $annee)
        ->whereMonth('action_commerciales.deadline', '>=', $mois)
        ->whereDay('action_commerciales.deadline', '>=', $semaineM7)
        ->orderBy('action_commerciales.deadline', 'desc')
                //   ->where('action_commerciales.superieur_id', $commercial->id)
                //   ->orderBy('action_commerciales.deadline', 'desc')
                  ->get();
                  
$actions_semaine_pole = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.id as ID', 'commerciaus.domaine_id',
                                                                 'opportunites.id as IDO', 'opportunites.libelle as LIBELLEs', 'opportunites.prospect_id', 'prospects.id as IDP', 'prospects.nom_entreprise')
            ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
             ->join('opportunites', 'opportunites.id', 'action_commerciales.opportunite_id')
              ->join('prospects', 'prospects.id', 'action_commerciales.prospect_id')
            ->where('commerciaus.domaine_id', $commercial->domaine_id)
        ->whereDay('action_commerciales.deadline', '>=', $semaineM7)->whereDay('action_commerciales.deadline', '<=', $action_semaineP7)
                  ->where('action_commerciales.cloture', 0)
                //   ->where('action_commerciales.entreprise_client_id', $commercial->entreprise_client_id)
                  ->orderBy('action_commerciales.deadline', 'desc')->get();
                 
        return view('action.toutes_lesactions_aVenir_res', ['actions_semaine_pole' => $actions_semaine_pole,'actions_semaine' => $actions_semaine]);
        
    }
    
    public function toutes_actionsFiltre_aVenir_res(Request $request)
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
         $searchAction = $request->get('searchAction');
         $serachPays = $request->get('serachPays');
         $serachCom = $request->get('serachCom');
            
                    $semaineM7 = date('d');
                    $action_semaineP7 = (date('d') +8);
                    $action_mois = date('m');
                    $mois = date('m');
                      $annee = date('Y'); 
            
            $actions_semaine = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom',
            'commerciaus.pays_id','opportunites.prospect_id','opportunites.libelle as libopportunite')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
        ->join('opportunites', 'opportunites.id', 'action_commerciales.opportunite_id')                  
        ->where('action_commerciales.superieur_id', $commercial->id)
        ->when(request()->has('searchAction'), function($q){
            $q->where('action_commerciales.opportunite_id', request('searchAction'));
        })
        ->when(request()->has('serachCom'), function($q){
            $q->where('action_commerciales.commercial_id', request('serachCom'));
        })
        ->when(request()->has('serachPays'), function($q){
            $q->where('commerciaus.pays_id', request('serachPays'));
        })
        ->whereYear('action_commerciales.deadline', '>=', $annee)
        ->whereMonth('action_commerciales.deadline', '>=', $mois)
        ->whereDay('action_commerciales.deadline', '>=', $semaineM7)
        ->orderBy('action_commerciales.deadline', 'desc')
        ->get();
                  
      
              
        
        
        $actions_semaine_pole = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
            ->where('commerciaus.domaine_id', $commercial->domaine_id)
            ->whereDay('action_commerciales.deadline', '>=', $semaineM7)->whereDay('action_commerciales.deadline', '<=', $action_semaineP7)
            ->where('action_commerciales.cloture', 0)
                //   ->where('action_commerciales.entreprise_client_id', $commercial->entreprise_client_id)
            ->where('opportunite_id', 'like', '%'.$searchAction.'%')->where('commercial_id','like', '%'.$serachCom.'%')->where('commerciaus.pays_id','like', '%'.$serachPays.'%')
            ->whereIn('action_commerciales.commercial_id', [$serachCom])->orwhereIn('commerciaus.pays_id', [$serachPays])->orwhereIn('action_commerciales.opportunite_id', [$searchAction])
            ->orderBy('action_commerciales.deadline', 'desc')->get();
                 
        return view('action.toutes_lesactions_aVenir_res', ['actions_semaine_pole' => $actions_semaine_pole,'actions_semaine' => $actions_semaine]);
        
    }
    
    
     public function toutes_actions_fait_res()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        
     
                    $semaineM7 = (date('d') -7);
                    $action_semaineP7 = (date('d') +7);
                    $action_mois = date('m');
                    $mois = date('m');
                      $annee = date('Y'); 
                      
             $week = [];
                $saturday = strtotime('monday this week');
                foreach (range(0, 6) as $day) {
                    $week[] = date("Y-m-d", (($day * 86400) + $saturday));
                }
                    
          $actions = DB::table('action_commerciales')->where('superieur_id', $commercial->id)->where('cloture', 1)->orderBy('deadline', 'desc')->get();
          $actions_mois = DB::table('action_commerciales')->where('superieur_id', $commercial->id)->whereMonth('created_at', $action_mois)->whereYear('created_at', $annee)->where('cloture', 1)->orderBy('deadline', 'desc')->get();
          
          $actions_semaine = array();
          foreach($week as $weeks){
          $actions_semaines = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
        ->whereDay('action_commerciales.deadline', '=', date('d', strtotime($weeks)))
        //->WhereDay('action_commerciales.deadline', '>=', $semaineM7)
        ->whereMonth('action_commerciales.deadline', '=', date('m', strtotime($weeks)))
        ->whereYear('action_commerciales.deadline', '=', date('Y', strtotime($weeks)))
       
        ->where('action_commerciales.superieur_id', $commercial->id)->where('action_commerciales.cloture', 1)
        ->where('action_commerciales.entreprise_client_id', $commercial->entreprise_client_id)
        ->orderBy('action_commerciales.deadline', 'desc')->get();
        
        foreach($actions_semaines as $actions_semaineg)
        
             array_push($actions_semaine, $actions_semaineg);
           }
           
           
           
           
           $actions_pole = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
            ->where('commerciaus.domaine_id', $commercial->domaine_id)
            ->where('action_commerciales.cloture', 1)->orderBy('action_commerciales.deadline', 'desc')->get();
          $actions_mois_pole = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
            ->where('commerciaus.domaine_id', $commercial->domaine_id)
            ->whereMonth('action_commerciales.created_at', $action_mois)->whereYear('action_commerciales.created_at', $annee)->where('action_commerciales.cloture', 1)->orderBy('action_commerciales.deadline', 'desc')->get();
          
          $actions_semaine_pole = array();
          foreach($week as $weeks){
          $actions_semaines_pole = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
            ->where('commerciaus.domaine_id', $commercial->domaine_id)
        ->whereDay('action_commerciales.deadline', '=', date('d', strtotime($weeks)))
        //->WhereDay('action_commerciales.deadline', '>=', $semaineM7)
        ->whereMonth('action_commerciales.deadline', '=', date('m', strtotime($weeks)))
        ->whereYear('action_commerciales.deadline', '=', date('Y', strtotime($weeks)))
        ->where('action_commerciales.cloture', 1)
        // ->where('action_commerciales.entreprise_client_id', $commercial->entreprise_client_id)
        ->orderBy('action_commerciales.deadline', 'desc')->get();
        
        foreach($actions_semaines_pole as $actions_semaineg_pole)
        
             array_push($actions_semaine_pole, $actions_semaineg_pole);
           }
           
        return view('action.toutes_actions_fait_res', [ 'commercial' => $commercial,'actions_pole' => $actions_pole, 'actions_mois_pole' => $actions_mois_pole, 'actions_semaine_pole' => $actions_semaine_pole, 'actions' => $actions, 'actions_mois' => $actions_mois, 'actions_semaine' => $actions_semaine]);
        
    }
    
    public function toutes_actionsFiltre_fait_res(Request $request)
    {
        
         $week = [];
                $saturday = strtotime('monday this week');
                foreach (range(0, 6) as $day) {
                    $week[] = date("Y-m-d", (($day * 86400) + $saturday));
                }
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
         $searchAction = $request->get('searchAction');
         $serachPays = $request->get('serachPays');
         $serachCom = $request->get('serachCom');
       
            
                    $semaineM7 = (date('d') -7);
                    $action_semaineP7 = (date('d') +7);
                    $action_mois = date('m');
                    $mois = date('m');
                      $annee = date('Y'); 
                    
          $actions = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
          ->where('action_commerciales.opportunite_id', 'like', '%'.$searchAction.'%')->where('action_commerciales.commercial_id','like', '%'.$serachCom.'%')->where('commerciaus.pays_id','like', '%'.$serachPays.'%')
                    ->where('action_commerciales.cloture', 1)
                    ->where('action_commerciales.superieur_id', $commercial->id)
                    ->where('action_commerciales.entreprise_client_id', $commercial->entreprise_client_id)
                    ->whereIn('action_commerciales.commercial_id', [$serachCom])->orwhereIn('commerciaus.pays_id', [$serachPays])->orwhereIn('action_commerciales.opportunite_id', [$searchAction])
                    ->orderBy('action_commerciales.created_at', 'desc')->get();
          
          $actions_mois = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
          ->where('opportunite_id', 'like', '%'.$searchAction.'%')->where('commercial_id','like', '%'.$serachCom.'%')->where('commerciaus.pays_id','like', '%'.$serachPays.'%')
          ->whereMonth('action_commerciales.created_at', $action_mois)->whereYear('action_commerciales.created_at', $annee)
          ->whereIn('action_commerciales.commercial_id', [$serachCom])->orwhereIn('commerciaus.pays_id', [$serachPays])->orwhereIn('action_commerciales.opportunite_id', [$searchAction])->where('action_commerciales.cloture', 1)
          ->where('action_commerciales.superieur_id', $commercial->id)
          ->where('action_commerciales.entreprise_client_id', $commercial->entreprise_client_id)
          ->orderBy('action_commerciales.created_at', 'desc')->get();
          
          $actions_semaine = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
        ->where('action_commerciales.superieur_id', $commercial->id)
        ->where('opportunite_id', 'like', '%'.$searchAction.'%')->where('commercial_id','like', '%'.$serachCom.'%')->where('commerciaus.pays_id','like', '%'.$serachPays.'%')
->whereDay('action_commerciales.deadline', '<=', $action_semaineP7)->WhereDay('action_commerciales.deadline', '>=', $semaineM7)->whereMonth('action_commerciales.deadline', $action_mois)->whereYear('action_commerciales.deadline', $annee)
->whereIn('action_commerciales.commercial_id', [$serachCom])->orwhereIn('commerciaus.pays_id', [$serachPays])->orwhereIn('action_commerciales.opportunite_id', [$searchAction])->where('action_commerciales.cloture', 1)
->where('action_commerciales.entreprise_client_id', $commercial->entreprise_client_id)
->orderBy('action_commerciales.created_at', 'desc')->get();



$actions_pole = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
            ->where('commerciaus.domaine_id', $commercial->domaine_id)
            ->where('action_commerciales.cloture', 1)->orderBy('action_commerciales.deadline', 'desc')->where('action_commerciales.opportunite_id', 'like', '%'.$searchAction.'%')->where('action_commerciales.commercial_id','like', '%'.$serachCom.'%')->where('commerciaus.pays_id','like', '%'.$serachPays.'%')
                    ->whereIn('action_commerciales.commercial_id', [$serachCom])->orwhereIn('commerciaus.pays_id', [$serachPays])->orwhereIn('action_commerciales.opportunite_id', [$searchAction])->get();
          $actions_mois_pole = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
            ->where('commerciaus.domaine_id', $commercial->domaine_id)
            ->where('action_commerciales.opportunite_id', 'like', '%'.$searchAction.'%')->where('action_commerciales.commercial_id','like', '%'.$serachCom.'%')->where('commerciaus.pays_id','like', '%'.$serachPays.'%')
                    ->whereIn('action_commerciales.commercial_id', [$serachCom])->orwhereIn('commerciaus.pays_id', [$serachPays])->orwhereIn('action_commerciales.opportunite_id', [$searchAction])
            ->whereMonth('action_commerciales.created_at', $action_mois)->whereYear('action_commerciales.created_at', $annee)->where('action_commerciales.cloture', 1)->orderBy('action_commerciales.deadline', 'desc')->get();
          
          $actions_semaine_pole = array();
          foreach($week as $weeks){
          $actions_semaines_pole = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
            ->where('commerciaus.domaine_id', $commercial->domaine_id)
        ->whereDay('action_commerciales.deadline', '=', date('d', strtotime($weeks)))
        //->WhereDay('action_commerciales.deadline', '>=', $semaineM7)
        ->whereMonth('action_commerciales.deadline', '=', date('m', strtotime($weeks)))
        ->whereYear('action_commerciales.deadline', '=', date('Y', strtotime($weeks)))
        ->where('action_commerciales.cloture', 1)
        ->where('action_commerciales.opportunite_id', 'like', '%'.$searchAction.'%')->where('action_commerciales.commercial_id','like', '%'.$serachCom.'%')->where('commerciaus.pays_id','like', '%'.$serachPays.'%')
                    ->whereIn('action_commerciales.commercial_id', [$serachCom])->orwhereIn('commerciaus.pays_id', [$serachPays])->orwhereIn('action_commerciales.opportunite_id', [$searchAction])
        // ->where('action_commerciales.entreprise_client_id', $commercial->entreprise_client_id)
        ->orderBy('action_commerciales.deadline', 'desc')->get();
        
        foreach($actions_semaines_pole as $actions_semaineg_pole)
        
             array_push($actions_semaine_pole, $actions_semaineg_pole);
           }
        return view('action.toutes_actions_fait_res', [ 'commercial' => $commercial,'actions_pole' => $actions_pole, 'actions_mois_pole' => $actions_mois_pole, 'actions_semaine_pole' => $actions_semaine_pole, 'actions' => $actions, 'actions_mois' => $actions_mois, 'actions_semaine' => $actions_semaine]);
        
        
    }
   
   public function mesactions_a_venir()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        
                  $semaineM7 = date('d');
                    $action_semaineP7 = (date('d') +8);
                    $action_mois = date('m');
                    $mois = date('m');
                      $annee = date('Y'); 
                    
$actions_semaine = DB::table('action_commerciales')->where('commercial_id', $commercial->id)
                  ->where('cloture', 0)
                  ->orderBy('deadline', 'desc')->get();
                 
        return view('action.mesactions_a_venir', ['actions_semaine' => $actions_semaine]);
        
    }
    
    public function mesactions_a_venirFiltre(Request $request)
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
         $searchAction = $request->get('searchAction');
         $serachPays = $request->get('serachPays');
         $serachCom = $request->get('serachCom');
            
                    $semaineM7 = date('d');
                    $action_semaineP7 = (date('d') +8);
                    $action_mois = date('m');
                    $mois = date('m');
                      $annee = date('Y'); 
                    $actions_semaine = DB::table('action_commerciales')
                  ->where('cloture', 0)->where('opportunite_id', 'like', '%'.$searchAction.'%')
                  ->orderBy('deadline', 'desc')->get();
                  
  

        return view('action.mesactions_a_venir', ['actions_semaine' => $actions_semaine]);
        
        
    }
    
     public function toutes_actions_aVenir()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        
                  $semaineM7 = date('d');
                    $action_semaineP7 = (date('d') + 8);
                    $action_mois = date('m');
                    $mois = date('m');
                      $annee = date('Y'); 
                    
$actions_semaine = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom',
'commerciaus.pays_id','opportunites.prospect_id','opportunites.libelle as libopportunite')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
        ->join('opportunites', 'opportunites.id', 'action_commerciales.opportunite_id')
        ->whereYear('action_commerciales.deadline', '>=', $annee)
        ->whereMonth('action_commerciales.deadline', '>=', $mois)
        ->whereDay('action_commerciales.deadline', '>=', $semaineM7)
        ->orderBy('action_commerciales.deadline', 'desc')
        ->get();
                  
                //   dd($actions_semaine);
                 
        return view('action.toutes_lesactions_aVenir', ['actions_semaine' => $actions_semaine]);
        
    }
    
    public function toutes_actionsFiltre_aVenir(Request $request)
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
         $searchAction = $request->get('searchAction');
         $serachPays = $request->get('serachPays');
         $serachCom = $request->get('serachCom');
            
                    $semaineM7 = date('d');
                    $action_semaineP7 = (date('d') +8);
                    $action_mois = date('m');
                    $mois = date('m');
                      $annee = date('Y'); 
                    
          $actions_semaine = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom',
          'commerciaus.pays_id','opportunites.prospect_id','opportunites.libelle as libopportunite')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
        ->join('opportunites', 'opportunites.id', 'action_commerciales.opportunite_id')
        ->when(request()->has('searchAction'), function($q){
            $q->where('action_commerciales.opportunite_id', request('searchAction'));
        })
        ->when(request()->has('serachCom'), function($q){
            $q->where('action_commerciales.commercial_id', request('serachCom'));
        })
        ->when(request()->has('serachPays'), function($q){
            $q->where('commerciaus.pays_id', request('serachPays'));
        })
        ->whereYear('action_commerciales.deadline', '>=', $annee)
        ->whereMonth('action_commerciales.deadline', '>=', $mois)
        ->whereDay('action_commerciales.deadline', '>=', $semaineM7)
        ->orderBy('action_commerciales.deadline', 'desc')
        ->get();

        return view('action.toutes_lesactions_aVenir', ['actions_semaine' => $actions_semaine]);
        
        
    }
    
    
     public function toutes_actions_res()
    {
         $semaineM7 = (date('d') -7);
                    $action_semaineP7 = (date('d') +7);
                    $action_mois = date('m');
                    $mois = date('m');
                      $annee = date('Y'); 
        $actions = array();
        $actions_mois = array();
        $actions_semaine = array();
        $moi = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
       
        $commercials = DB::table('commerciaus')->where('superieur_id', $moi->id)->get();
        //foreach($commercials as $com){
            // $actions = DB::table('action_commerciales')->where('superieur_id', $moi->id)->where('cloture', 0)->get();
            // $actions_mois = DB::table('action_commerciales')->where('superieur_id', $moi->id)->whereMonth('created_at', $action_mois)->whereYear('created_at', $annee)->where('cloture', 0)->get();
            // $actions_semaine = DB::table('action_commerciales')->where('superieur_id', $moi->id)->whereDay('created_at', '<=', $action_semaineP7)->WhereDay('created_at', '>=', $semaineM7)->whereMonth('created_at', $action_mois)->whereYear('created_at', $annee)->where('cloture', 0)->get();                      
           
            $actions = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
        ->where('action_commerciales.superieur_id', $moi->id)
            ->where('action_commerciales.cloture', 0)
            ->where('action_commerciales.entreprise_client_id', $moi->entreprise_client_id)
            ->orderBy('action_commerciales.cloture', 'asc')->orderBy('action_commerciales.deadline', 'desc')->get();
          
          $actions_mois = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
        ->where('action_commerciales.superieur_id', $moi->id)
          ->whereMonth('action_commerciales.created_at', $action_mois)->whereYear('action_commerciales.created_at', $annee)
          ->where('action_commerciales.cloture', 0)
          ->where('action_commerciales.entreprise_client_id', $moi->entreprise_client_id)
          ->orderBy('action_commerciales.cloture', 'asc')->orderBy('action_commerciales.deadline', 'desc')->get();
         
         $week = [];
         $saturday = strtotime('monday this week');
        foreach (range(0, 6) as $day) {
                    $week[] = date("Y-m-d", (($day * 86400) + $saturday));
                }
                $actions_semaine = array();
                foreach($week as $weeks)
                 { 
          
          $actions_semainefg = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
        ->whereDay('action_commerciales.deadline', '=',date('d', strtotime($weeks)))
            ->whereMonth('action_commerciales.deadline', '=',date('m', strtotime($weeks)))
            ->whereYear('action_commerciales.deadline', '=',date('Y', strtotime($weeks)))
        
                 ->where('action_commerciales.cloture', 0)
                 ->where('action_commerciales.superieur_id',  $moi->id)
                 //->where('action_commerciales.entreprise_client_id', $moi->entreprise_client_id)
                 ->orderBy('action_commerciales.cloture', 'asc')->orderBy('action_commerciales.deadline', 'desc')
                 ->get();
                 
                 foreach($actions_semainefg as $actions_semainef){
                    array_push($actions_semaine, $actions_semainef);
                    }
                    
                 }
$actions_pole = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
        ->where('commerciaus.domaine_id', $moi->domaine_id)
            ->where('action_commerciales.cloture', 0)
            ->where('action_commerciales.entreprise_client_id', $moi->entreprise_client_id)
            ->orderBy('action_commerciales.deadline', 'desc')->get();
$actions_mois_pole = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
        ->where('commerciaus.domaine_id', $moi->domaine_id)
          ->whereMonth('action_commerciales.created_at', $action_mois)->whereYear('action_commerciales.created_at', $annee)
          ->where('action_commerciales.cloture', 0)
          ->where('action_commerciales.entreprise_client_id', $moi->entreprise_client_id)
          ->orderBy('action_commerciales.deadline', 'desc')->get();
foreach (range(0, 6) as $day) {
                    $week[] = date("Y-m-d", (($day * 86400) + $saturday));
                }
                $actions_semaine_pole = array();
                foreach($week as $weeks)
                 { 
          
          $actions_semainefg_pole = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
        ->whereDay('action_commerciales.deadline', '=',date('d', strtotime($weeks)))
            ->whereMonth('action_commerciales.deadline', '=',date('m', strtotime($weeks)))
            ->whereYear('action_commerciales.deadline', '=',date('Y', strtotime($weeks)))
        
                 ->where('action_commerciales.cloture', 0)
                 ->where('commerciaus.domaine_id',  $moi->domaine_id)
                 //->where('action_commerciales.entreprise_client_id', $moi->entreprise_client_id)
                 ->orderBy('action_commerciales.deadline', 'desc')
                 ->get();
                 
                 foreach($actions_semainefg_pole as $actions_semainef_pole){
                    array_push($actions_semaine_pole, $actions_semainef_pole);
                    }
                    
                 }
        return view('action.toutes_actions_res', ['moi' => $moi, 'actions' => $actions , 'actions_mois' => $actions_mois, 'actions_semaine' => $actions_semaine, 'actions_pole' => $actions_pole , 'actions_mois_pole' => $actions_mois_pole, 'actions_semaine_pole' => $actions_semaine_pole]);
        
    }
    
    public function toutes_actionsFiltre_res(Request $request)
    {
         $week = [];
         $saturday = strtotime('monday this week');
        // $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $commercialMi = Commerciau::where('user_id', Auth::user()->id)->first();
         $searchAction = $request->get('searchAction');
       $serachPays = $request->get('serachPays');
         $serachCom = $request->get('serachCom');
         
         $semaineM7 = (date('d') -7);
                    $action_semaineP7 = (date('d') +7);
                    $action_mois = date('m');
                    $mois = date('m');
                      $annee = date('Y'); 
        $actions = array();
        $actions_mois = array();
        $actions_semaine = array();
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        $commercials = DB::table('commerciaus')->where('superieur_id', $moi->id)->get();
        //foreach($commercials as $com){
            $actions = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
        ->where('action_commerciales.superieur_id', $moi->id)
          ->where('action_commerciales.opportunite_id', 'like', '%'.$searchAction.'%')
          ->where('action_commerciales.commercial_id','like', '%'.$serachCom.'%')
          ->where('commerciaus.pays_id','like', '%'.$serachPays.'%')
                    ->whereIn('action_commerciales.commercial_id', [$serachCom])
                    ->orwhereIn('commerciaus.pays_id', [$serachPays])
                    ->orwhereIn('action_commerciales.opportunite_id', [$searchAction])->where('action_commerciales.cloture', 0)
                    ->where('action_commerciales.entreprise_client_id', $moi->entreprise_client_id)
                    ->orderBy('action_commerciales.cloture', 'asc')->orderBy('action_commerciales.deadline', 'desc')->get();
          
          $actions_mois = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
        ->where('action_commerciales.superieur_id', $moi->id)
          ->where('opportunite_id', 'like', '%'.$searchAction.'%')->where('commercial_id','like', '%'.$serachCom.'%')->where('commerciaus.pays_id','like', '%'.$serachPays.'%')
          ->whereMonth('action_commerciales.created_at', $action_mois)->whereYear('action_commerciales.created_at', $annee)
          ->whereIn('action_commerciales.commercial_id', [$serachCom])->orwhereIn('commerciaus.pays_id', [$serachPays])->orwhereIn('action_commerciales.opportunite_id', [$searchAction])->where('action_commerciales.cloture', 0)
          ->where('action_commerciales.entreprise_client_id', $moi->entreprise_client_id)
          ->orderBy('action_commerciales.cloture', 'asc')->orderBy('action_commerciales.deadline', 'desc')->get();
          
          $actions_semaine = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
        ->where('action_commerciales.superieur_id', $moi->id)
        ->where('opportunite_id', 'like', '%'.$searchAction.'%')->where('commercial_id','like', '%'.$serachCom.'%')->where('commerciaus.pays_id','like', '%'.$serachPays.'%')
        ->whereDay('action_commerciales.created_at', '<=', $action_semaineP7)->WhereDay('action_commerciales.created_at', '>=', $semaineM7)->whereMonth('action_commerciales.created_at', $action_mois)->whereYear('action_commerciales.created_at', $annee)
                  ->whereIn('action_commerciales.commercial_id', [$serachCom])->orwhereIn('commerciaus.pays_id', [$serachPays])->orwhereIn('action_commerciales.opportunite_id', [$searchAction])->where('action_commerciales.cloture', 0)
                  ->where('action_commerciales.entreprise_client_id', $moi->entreprise_client_id)
                  ->orderBy('action_commerciales.cloture', 'asc')->orderBy('action_commerciales.deadline', 'desc')->get();

            $actions_pole = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
        ->where('commerciaus.domaine_id', $moi->domaine_id)
            ->where('action_commerciales.cloture', 0)
            // ->where('action_commerciales.entreprise_client_id', $moi->entreprise_client_id)
            ->where('action_commerciales.opportunite_id', 'like', '%'.$searchAction.'%')
          ->where('action_commerciales.commercial_id','like', '%'.$serachCom.'%')
          ->where('commerciaus.pays_id','like', '%'.$serachPays.'%')
                    ->whereIn('action_commerciales.commercial_id', [$serachCom])
                    ->orwhereIn('commerciaus.pays_id', [$serachPays])
                    ->orwhereIn('action_commerciales.opportunite_id', [$searchAction])
            ->orderBy('action_commerciales.deadline', 'desc')->get();
$actions_mois_pole = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
        ->where('commerciaus.domaine_id', $moi->domaine_id)
          ->whereMonth('action_commerciales.created_at', $action_mois)->whereYear('action_commerciales.created_at', $annee)
          ->where('action_commerciales.cloture', 0)
        //   ->where('action_commerciales.entreprise_client_id', $moi->entreprise_client_id)
          ->where('action_commerciales.opportunite_id', 'like', '%'.$searchAction.'%')
          ->where('action_commerciales.commercial_id','like', '%'.$serachCom.'%')
          ->where('commerciaus.pays_id','like', '%'.$serachPays.'%')
                    ->whereIn('action_commerciales.commercial_id', [$serachCom])
                    ->orwhereIn('commerciaus.pays_id', [$serachPays])
                    ->orwhereIn('action_commerciales.opportunite_id', [$searchAction])
          ->orderBy('action_commerciales.deadline', 'desc')->get();
foreach (range(0, 6) as $day) {
                    $week[] = date("Y-m-d", (($day * 86400) + $saturday));
                }
                $actions_semaine_pole = array();
                foreach($week as $weeks)
                 { 
          
          $actions_semainefg_pole = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
        ->whereDay('action_commerciales.deadline', '=',date('d', strtotime($weeks)))
            ->whereMonth('action_commerciales.deadline', '=',date('m', strtotime($weeks)))
            ->whereYear('action_commerciales.deadline', '=',date('Y', strtotime($weeks)))
                 ->where('action_commerciales.cloture', 0)
                 ->where('commerciaus.domaine_id',  $moi->domaine_id)
                 ->where('action_commerciales.opportunite_id', 'like', '%'.$searchAction.'%')
          ->where('action_commerciales.commercial_id','like', '%'.$serachCom.'%')
          ->where('commerciaus.pays_id','like', '%'.$serachPays.'%')
                    ->whereIn('action_commerciales.commercial_id', [$serachCom])
                    ->orwhereIn('commerciaus.pays_id', [$serachPays])
                    ->orwhereIn('action_commerciales.opportunite_id', [$searchAction])
                 //->where('action_commerciales.entreprise_client_id', $moi->entreprise_client_id)
                 ->orderBy('action_commerciales.deadline', 'desc')
                 ->get();
                 
                 foreach($actions_semainefg_pole as $actions_semainef_pole){
                    array_push($actions_semaine_pole, $actions_semainef_pole);
                    }
                    
                 }
        
        $serachComMois = $request->get('serachComMois');
        
        
        return view('action.toutes_actions_res', ['moi' => $moi, 'actions' => $actions , 'actions_mois' => $actions_mois, 'actions_semaine' => $actions_semaine, 'actions_pole' => $actions_pole , 'actions_mois_pole' => $actions_mois_pole, 'actions_semaine_pole' => $actions_semaine_pole]);
        
    }
    
     public function toutes_actions_fait()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        
     
                    $semaineM7 = (date('d') -7);
                    $action_semaineP7 = (date('d') +7);
                    $action_mois = date('m');
                    $mois = date('m');
                      $annee = date('Y'); 
                    
          $actions = DB::table('action_commerciales')->where('cloture', 1)->orderBy('deadline', 'desc')->get();
          $actions_mois = DB::table('action_commerciales')->whereMonth('created_at', $action_mois)->whereYear('created_at', $annee)->orderBy('deadline', 'desc')->where('cloture', 1)->get();
  $actions_semaine = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
        ->whereDay('action_commerciales.deadline', '<=', $action_semaineP7)->WhereDay('action_commerciales.deadline', '>=', $semaineM7)->whereMonth('action_commerciales.deadline', $action_mois)->whereYear('action_commerciales.deadline', $annee)
        ->where('action_commerciales.cloture', 1)
        ->where('action_commerciales.entreprise_client_id', $commercial->entreprise_client_id)
        ->orderBy('action_commerciales.deadline', 'desc')->get();
        return view('action.toutes_actions_fait', [ 'actions' => $actions, 'actions_mois' => $actions_mois, 'actions_semaine' => $actions_semaine]);
        
    }
    
    public function toutes_actionsFiltre_fait(Request $request)
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
         $searchAction = $request->get('searchAction');
         $serachPays = $request->get('serachPays');
         $serachCom = $request->get('serachCom');
       
            
                    $semaineM7 = (date('d') -7);
                    $action_semaineP7 = (date('d') +7);
                    $action_mois = date('m');
                    $mois = date('m');
                      $annee = date('Y'); 
                    
          $actions = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
          ->where('action_commerciales.opportunite_id', 'like', '%'.$searchAction.'%')->where('action_commerciales.commercial_id','like', '%'.$serachCom.'%')->where('commerciaus.pays_id','like', '%'.$serachPays.'%')
                    ->whereIn('action_commerciales.commercial_id', [$serachCom])->orwhereIn('commerciaus.pays_id', [$serachPays])->orwhereIn('action_commerciales.opportunite_id', [$searchAction])->where('action_commerciales.cloture', 1)
                    ->where('action_commerciales.entreprise_client_id', $commercial->entreprise_client_id)
                    ->orderBy('action_commerciales.deadline', 'desc')->get();
          
          $actions_mois = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
          ->where('opportunite_id', 'like', '%'.$searchAction.'%')->where('commercial_id','like', '%'.$serachCom.'%')->where('commerciaus.pays_id','like', '%'.$serachPays.'%')
          ->whereMonth('action_commerciales.created_at', $action_mois)->whereYear('action_commerciales.created_at', $annee)
          ->whereIn('action_commerciales.commercial_id', [$serachCom])->orwhereIn('commerciaus.pays_id', [$serachPays])->orwhereIn('action_commerciales.opportunite_id', [$searchAction])->where('action_commerciales.cloture', 1)
          ->where('action_commerciales.entreprise_client_id', $commercial->entreprise_client_id)
          ->orderBy('action_commerciales.deadline', 'desc')->get();
          
          $actions_semaine = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
        ->where('opportunite_id', 'like', '%'.$searchAction.'%')->where('commercial_id','like', '%'.$serachCom.'%')->where('commerciaus.pays_id','like', '%'.$serachPays.'%')
->whereDay('action_commerciales.deadline', '<=', $action_semaineP7)->WhereDay('action_commerciales.deadline', '>=', $semaineM7)->whereMonth('action_commerciales.deadline', $action_mois)->whereYear('action_commerciales.deadline', $annee)
->whereIn('action_commerciales.commercial_id', [$serachCom])->orwhereIn('commerciaus.pays_id', [$serachPays])->orwhereIn('action_commerciales.opportunite_id', [$searchAction])->where('action_commerciales.cloture', 1)
->where('action_commerciales.entreprise_client_id', $commercial->entreprise_client_id)
->orderBy('action_commerciales.deadline', 'desc')->get();

        return view('action.toutes_actions_fait', [ 'actions' => $actions, 'actions_mois' => $actions_mois, 'actions_semaine' => $actions_semaine]);
        
        
    }
   
   
   
     public function toutes_actions()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        
        $actionCommercials = ActionCommercial::join('opportunites', 'action_commerciales.opportunite_id', '=', 'opportunites.id')
            ->join('prospects', 'opportunites.prospect_id', '=', 'prospects.id')
            ->select('action_commerciales.id','action_commerciales.libelle','action_commerciales.resume','action_commerciales.deadline', 'opportunites.libelle as opportLibelle', 'prospects.nom_entreprise')
            ->where(['action_commerciales.commercial_id' => $commercial->id, 'action_commerciales.cloture' => '0'])
            ->where('action_commerciales.entreprise_client_id', $commercial->entreprise_client_id)
            ->orderBy('action_commerciales.deadline', 'desc')
            ->paginate(10);
            
                    $semaineM7 = (date('d') -7);
                    $action_semaineP7 = (date('d') +7);
                    $action_mois = date('m');
                    $mois = date('m');
                      $annee = date('Y'); 
                    
          $actions = DB::table('action_commerciales')->orderBy('cloture', 'asc')->orderBy('deadline', 'desc')->get();
          $actions_mois = DB::table('action_commerciales')->whereMonth('created_at', $action_mois)->whereYear('created_at', $annee)->orderBy('cloture', 'asc')->orderBy('deadline', 'desc')->get();
          
          $week = [];
         $saturday = strtotime('monday this week');
        foreach (range(0, 6) as $day) {
                    $week[] = date("Y-m-d", (($day * 86400) + $saturday));
                }
                $actions_semaine = array();
                foreach($week as $weeks)
                 { 
          
          $actions_semainefg = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')

        ->whereDay('action_commerciales.deadline', '=',date('d', strtotime($weeks)))
            ->whereMonth('action_commerciales.deadline', '=',date('m', strtotime($weeks)))
            ->whereYear('action_commerciales.deadline', '=',date('Y', strtotime($weeks)))
        
                 ->where('action_commerciales.cloture', 0)
                 //->where('action_commerciales.entreprise_client_id', $moi->entreprise_client_id)
                 ->orderBy('action_commerciales.cloture', 'asc')->orderBy('action_commerciales.deadline', 'desc')
                 ->get();
                 
                 foreach($actions_semainefg as $actions_semainef){
                    array_push($actions_semaine, $actions_semainef);
                    }
                    
                 }
          
        return view('action.toutes_actions', ['actionCommercials' => $actionCommercials, 'actions' => $actions, 'actions_mois' => $actions_mois, 'actions_semaine' => $actions_semaine]);
        
    }
    
    public function toutes_actionsFiltre(Request $request)
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
         $searchAction = $request->get('searchAction');
         $serachPays = $request->get('serachPays');
         $serachCom = $request->get('serachCom');
        $actionCommercials = ActionCommercial::join('opportunites', 'action_commerciales.opportunite_id', '=', 'opportunites.id')
            ->join('prospects', 'opportunites.prospect_id', '=', 'prospects.id')
            ->select('action_commerciales.id','action_commerciales.entreprise_client_id','action_commerciales.libelle','action_commerciales.resume','action_commerciales.deadline', 'opportunites.libelle as opportLibelle', 'prospects.nom_entreprise')
            ->where(['action_commerciales.commercial_id' => $commercial->id, 'cloture' => '0'])
            ->where('action_commerciales.entreprise_client_id', $commercial->entreprise_client_id)
            ->orderBy('action_commerciales.deadline', 'desc')
            ->paginate(10);
            
                    $semaineM7 = (date('d') -7);
                    $action_semaineP7 = (date('d') +7);
                    $action_mois = date('m');
                    $mois = date('m');
                      $annee = date('Y'); 
                    
          $actions = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
          ->where('action_commerciales.opportunite_id', 'like', '%'.$searchAction.'%')->where('action_commerciales.commercial_id','like', '%'.$serachCom.'%')->where('commerciaus.pays_id','like', '%'.$serachPays.'%')
                    ->whereIn('action_commerciales.commercial_id', [$serachCom])->orwhereIn('commerciaus.pays_id', [$serachPays])->orwhereIn('action_commerciales.opportunite_id', [$searchAction])
                    ->where('action_commerciales.entreprise_client_id', $commercial->entreprise_client_id)
                    ->orderBy('action_commerciales.cloture', 'asc')->orderBy('action_commerciales.deadline', 'desc')->get();
          
          $actions_mois = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
          ->where('opportunite_id', 'like', '%'.$searchAction.'%')->where('commercial_id','like', '%'.$serachCom.'%')->where('commerciaus.pays_id','like', '%'.$serachPays.'%')
          ->whereMonth('action_commerciales.created_at', $action_mois)->whereYear('action_commerciales.created_at', $annee)
          ->whereIn('action_commerciales.commercial_id', [$serachCom])->orwhereIn('commerciaus.pays_id', [$serachPays])->orwhereIn('action_commerciales.opportunite_id', [$searchAction])
          ->where('action_commerciales.entreprise_client_id', $commercial->entreprise_client_id)
          ->orderBy('action_commerciales.cloture', 'asc')->orderBy('action_commerciales.deadline', 'desc')->get();
          
          $actions_semaine = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
        ->where('opportunite_id', 'like', '%'.$searchAction.'%')->where('commercial_id','like', '%'.$serachCom.'%')->where('commerciaus.pays_id','like', '%'.$serachPays.'%')
        ->whereDay('action_commerciales.created_at', '<=', $action_semaineP7)->WhereDay('action_commerciales.created_at', '>=', $semaineM7)->whereMonth('action_commerciales.created_at', $action_mois)->whereYear('action_commerciales.created_at', $annee)
                  ->whereIn('action_commerciales.commercial_id', [$serachCom])->orwhereIn('commerciaus.pays_id', [$serachPays])->orwhereIn('action_commerciales.opportunite_id', [$searchAction])
                  ->where('action_commerciales.entreprise_client_id', $commercial->entreprise_client_id)
                  ->orderBy('action_commerciales.cloture', 'asc')->orderBy('action_commerciales.deadline', 'desc')->get();

        return view('action.toutes_actions', ['actionCommercials' => $actionCommercials, 'actions' => $actions, 'actions_mois' => $actions_mois, 'actions_semaine' => $actions_semaine]);
        
        
    }
   
   public function opportunite_action()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $actions_com = DB::table('action_commerciales')->where('entreprise_client_id', $commercial->entreprise_client_id)->where('commercial_id', $commercial->id)->orderBy('deadline', 'desc')->paginate();
        $opportunite_actions = DB::table('opportunites')->where('entreprise_client_id', $commercial->entreprise_client_id)->where('commercial_id', $commercial->id)->paginate();
                                
        return view('action.opportunite_actionCom', compact('actions_com','opportunite_actions'));
        
    }
    
    
     public function modifier_action_Ecritik($id)
    {
        //
        $actionComercial = ActionCommercial::find($id);
        return view('action.actionModif_Ecritik', compact('actionComercial'));
        
    }
  
    public function update_action_Ecritik(Request $request, $id)
    {
        // dd($request->all());
        
        
        $message = "Action modifiée avec succès";
         
        $updateActionCommercial = ActionCommercial::findOrFail($id);
        
        $updateActionCommercial->libelle = $request->libelle;
        $updateActionCommercial->deadline = $request->date;
        $updateActionCommercial->priorite  = $request->priorite;
        $updateActionCommercial->commercial_id  = $request->commercial_id;
        $updateActionCommercial->save();
        
        DB::table('update_opps')->where('id',$updateActionCommercial->update_id)->update(['date' => $updateActionCommercial->deadline]);
       
        return back('/action_echeances_critiques')->with(['message' => $message]);
    }
    
    
    
     public function modifier_action($id)
    {
        //
        $actionComercial = ActionCommercial::find($id);
        return view('action.actionModif', compact('actionComercial'));
        
    }
  
    public function update_action(Request $request, $id)
    {
        // dd($request->all());
        
        $commercialMe = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();

        $message = "Action modifiée avec succès";
         
        $updateActionCommercial = ActionCommercial::findOrFail($id);
        
        $updateActionCommercial->libelle = $request->libelle;
        $updateActionCommercial->deadline = $request->date;
        $updateActionCommercial->priorite  = $request->priorite;
        $updateActionCommercial->commercial_id  = $request->commercial_id;
        $updateActionCommercial->opportunite_id  = $request->opportunite_id;
        $updateActionCommercial->prospect_id  = $request->prospect_id;
        $updateActionCommercial->save();
        
        DB::table('update_opps')->where('id',$updateActionCommercial->update_id)->update(['date' => $updateActionCommercial->deadline]);
        
        $opportunite = DB::table('opportunites')->where('id', $updateActionCommercial->opportunite_id)->first();
        
        if($opportunite){
        if($opportunite->commercial_backup){
           
            $commercial = DB::table('commerciaus')->where('id', $opportunite->commercial_backup)->where('id','!=', $commercialMe->id)->first();
             if($commercial){
            Mail::to($commercial->email)->send(new MailBackupAtionM($commercial, $updateActionCommercial, $opportunite, $commercialMe));
        }
        }
        }
       
        return back()->with(['message' => $message]);
    }
    
    
    
      public function modifier_action_stra($id)
    {
        //
        $actionComercial = ActionCommercial::find($id);
        return view('action.actionModif_stra', compact('actionComercial'));
        
    }
  
    public function update_action_stra(Request $request, $id)
    {
        // dd($request->all());
        
        
        $message = "Action modifiée avec succès";
         
        $updateActionCommercial = ActionCommercial::findOrFail($id);
        
        $updateActionCommercial->libelle = $request->libelle;
        $updateActionCommercial->deadline = $request->deadline;
        $updateActionCommercial->priorite  = $request->priorite;
        $updateActionCommercial->commercial_id  = $request->commercial_id;
        $updateActionCommercial->save();
        
       DB::table('update_opps')->where('id',$updateActionCommercial->update_id)->update(['date' => $updateActionCommercial->deadline]);
        return redirect('/action_stra')->with(['message' => $message]);
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

  public function action_cettesemaine()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $week = [];
        $actions = array();
         $saturday = strtotime('monday this week');
        foreach (range(0, 6) as $day) {
                    $week[] = date("Y-m-d", (($day * 86400) + $saturday));
                }
                
                $planning = array();
                foreach($week as $weeks)
                 { 
            $actiong = DB::table('action_commerciales')->where('commercial_id', $commercial->id)->where('cloture', 0)
            ->whereDay('deadline', '=',date('d', strtotime($weeks)))
            ->whereMonth('deadline', '=',date('m', strtotime($weeks)))
            ->whereYear('deadline', '=',date('Y', strtotime($weeks)))
            ->orderBy('deadline', 'desc')
            ->get();
           
            foreach($actiong as $planningf){
                    array_push($actions, $planningf);
                    }
                 }
        // $planning = DB::table('prospections')->where('commercial_id', $commercial->id)->where('statut',0)->get();
     
        return view('action.action_cettesemaine', compact('actions'));
    }
    
    public function index()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        
        $actionCommercials = ActionCommercial::join('opportunites', 'action_commerciales.opportunite_id', '=', 'opportunites.id')
            ->join('prospects', 'opportunites.prospect_id', '=', 'prospects.id')
            ->select('action_commerciales.id','action_commerciales.entreprise_client_id','action_commerciales.libelle','action_commerciales.resume','action_commerciales.deadline', 'opportunites.libelle as opportLibelle', 'prospects.nom_entreprise')
            ->where(['action_commerciales.commercial_id' => $commercial->id, 'cloture' => '0'])
            ->where('action_commerciales.entreprise_client_id', $commercial->entreprise_client_id)
            ->orderBy('action_commerciales.deadline', 'desc')
            ->paginate();
          $actions = DB::table('action_commerciales')->where('commercial_id', $commercial->id)->where('cloture', 0)->orderBy('deadline', 'desc')->get();                      
        return view('action.listerAction', ['actionCommercials' => $actionCommercials, 'actions' => $actions]);
        
    }
     public function search_op_action(Request $request)
    {
        $searchAction = $request->get('searchAction');
       $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $actions = DB::table('action_commerciales')->where('commercial_id', $commercial->id)->where('cloture', 0)->where('opportunite_id', 'like', '%'.$searchAction.'%')->orderBy('created_at', 'desc')->get();
        $actionCommercials = ActionCommercial::join('opportunites', 'action_commerciales.opportunite_id', '=', 'opportunites.id')
            ->join('prospects', 'opportunites.prospect_id', '=', 'prospects.id')
            ->select('action_commerciales.id','action_commerciales.entreprise_client_id','action_commerciales.libelle','action_commerciales.resume','action_commerciales.deadline', 'opportunites.libelle as opportLibelle', 'prospects.nom_entreprise')
            ->where(['action_commerciales.commercial_id' => $commercial->id, 'cloture' => '0'])
            ->where('action_commerciales.opportunite_id', 'like', '%'.$searchAction.'%')
            ->where('action_commerciales.entreprise_client_id', $commercial->entreprise_client_id)
            ->orderBy('action_commerciales.deadline', 'desc')
            ->paginate(10000);
                                
        return view('action.listerAction', ['actionCommercials' => $actionCommercials, 'actions' => $actions]);
    }
    
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $commercial = DB::table('commerciaus')->orderBy('prenom')->get();
        //
        $pgTitle = "Ajouter les actions de l'opportunité";
        $commercialValue = Commerciau::where('user_id', Auth::user()->id)->first();
        $commercialId = $commercialValue->id;
        
        $commercialOpportunites = Opportunite::where('commercial_id', $commercialValue->id)->orderBy('libelle')->get();
        
        foreach ($commercialOpportunites as $comOpport) {
             $prospectId = $comOpport->prospect_id;
        }
        
        $prospects = Prospect::where('commercial_id', $commercialValue->id)->orderBy('nom_entreprise')->get();
        
        return view('action.ajouterAction', ['commercial' =>$commercial, 'commercialOpportunites' =>$commercialOpportunites, 'prospects' =>$prospects, 'pgTitle' =>$pgTitle, 'commercialId' =>$commercialId ]);

    }
    
    public function store(Request $request)
    {
        //
        $commercialMe = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
        $btnBlock = true;
        
        ActionCommercial::create([
            'libelle'              => $request->libelle,
            'opportunite_id'       => $request->opportuniteId,
            'prospect_id'          => $request->prospectId,
            'commercial_id'        => $request->commercial_id,
            'priorite'             => $request->priorite,
            'entreprise_client_id' => $commercialMe->entreprise_client_id,
            'deadline'             => $request->date,
            'type'             => $request->type,
        ]);
        
        $action = DB::table('action_commerciales')->orderBy('id', 'desc')->first();
        $commercial = DB::table('commerciaus')->where('id', $action->commercial_id)->where('id','!=', $commercialMe->id)->orderBy('id', 'desc')->first();
        if($action->commercial_id != $commercialMe->id)
        {
         Mail::to($commercial->email)->send(new MailCommercial($commercial, $action, $commercialMe));
        }
        // $actionCommercials = ActionCommercial::join('opportunites', 'action_commerciales.opportunite_id', '=', 'opportunites.id')
        //     ->join('prospects', 'opportunites.prospect_id', '=', 'prospects.id')
        //     ->select('action_commerciales.id','action_commerciales.libelle','action_commerciales.resume','action_commerciales.deadline', 'opportunites.libelle as opportLibelle', 'prospects.nom_entreprise')
        //     ->orderBy('action_commerciales.created_at', 'desc')->limit(1)->get();
            
         $message = "Action ajoutée avec succès";
         $comm = DB::table('commerciaus')->where('id', $action->commercial_id)->first();
                DB::table('action_commerciales')->where('id', $action->id)->update(['superieur_id' => $comm->superieur_id] );
         return back()->with(['message' => $message]);
        //  return view('action.listerAction', ['actionCommercials' => $actionCommercials, 'btnBlock' =>$btnBlock])->with(['message' => $message]);
        
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
        $pgTitle = "Modifier l'action de l'opportunuité";
          
        $showAction = ActionCommercial::join('opportunites', 'action_commerciales.opportunite_id', '=', 'opportunites.id')
            ->select('action_commerciales.id','action_commerciales.libelle','action_commerciales.priorite','action_commerciales.deadline', 'opportunites.libelle as opportLibelle')
            ->where('action_commerciales.id', $id)
            ->firstOrFail();    
        return view('action.editAction', ['showAction' =>$showAction, 'pgTitle' =>$pgTitle ]);
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
        // dd($request->all());
        $btnBlock = true;
        
        $message = "Action modifiée avec succès";
         
        $updateActionCommercial = ActionCommercial::where('id', $id)->firstOrFail();
        
        $updateActionCommercial->libelle        = $request->libelle;
        $updateActionCommercial->deadline       = $request->date;
        $updateActionCommercial->priorite       = $request->priorite;
        $updateActionCommercial->save();
        
        DB::table('update_opps')->where('id',$updateActionCommercial->update_id)->update(['date' => $updateActionCommercial->deadline]);
        // $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        
        // $actionCommercials = ActionCommercial::join('opportunites', 'action_commerciales.opportunite_id', '=', 'opportunites.id')
        //     ->join('prospects', 'opportunites.prospect_id', '=', 'prospects.id')
        //     ->select('action_commerciales.id','action_commerciales.libelle','action_commerciales.resume','action_commerciales.deadline', 'opportunites.libelle as opportLibelle', 'prospects.nom_entreprise')
        //      ->where(['action_commerciales.commercial_id' => $commercial->id, 'action_commerciales.id' => $id, 'cloture' => '0'])
        //     ->get();
           
         
        //  return view('action.listerAction', ['actionCommercials' => $actionCommercials, 'btnBlock' =>$btnBlock])->with(['message' => $message]);
        return redirect()->route('action.index')->with(['message' => $message]);
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
        
    }
    
    public function cloturerAction($id)
    {
        // dd($id);
        $message = "Action clôturée avec succès";
        
        $clotureActionCommercial = ActionCommercial::where('id', $id)->firstOrFail();
        $clotureActionCommercial->cloture = 1;
        $clotureActionCommercial->save();
        
        return back()->with(['message' => $message]);
        
    }
    
     
    
    
}
