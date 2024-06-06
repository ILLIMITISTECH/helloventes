<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Commerciau;
use App\ActionCommercial;
use App\Opportunite;
use App\Vente;
use App\Contact;
use App\Objectif_commission ;
use App\Demo;
use App\Update_opp;
use App\Prospect;
use App\Mail\MailBackupOp;
use App\Mail\MailResOp;
use App\Mail\MailMaj;
use App\Mail\MailObjectif;
use App\Mail\MailBizdev;
use App\Mail\MailVente;
use App\Mail\MailCommercialAcionOp;
use App\User;
use Auth;
use DB;
use Mail;

use Session;
use Mailjet\LaravelMailjet\Facades\Mailjet;

class OpportuniteController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
      public function ventes_sn_all_tri()
    {
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::where('pays_id', 1)->get();
         foreach($commercials as $commercial)
         {
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->orderBy('ventes.position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
            foreach($vente as $vente_mois)
                {
                    
                        array_push($ventess, $vente_mois);
                        
                    
                }
         }
       
        return view('suiviSortieTerrain.ventes_sn_all_tri', compact('ventess', 'mois', 'commercials','venteMontants'));
    }
    
    
     public function ventes_bf_all_tri()
    {
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::where('pays_id', 5)->get();
         foreach($commercials as $commercial)
         {
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->orderBy('ventes.position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
            foreach($vente as $vente_mois)
                {
                    
                        array_push($ventess, $vente_mois);
                        
                    
                }
         }
       
        return view('suiviSortieTerrain.ventes_bf_all_tri', compact('ventess', 'mois', 'commercials','venteMontants'));
    }
    
    
      public function ventes_formation_tri_dernier()
     {
         $mois = date('m');
        $annee = date('Y'); 
        //$ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::where('pays_id', 5)->get();
        
        $ventess = DB::table('ventes')->where('domaine_id', 1)->whereYear('created_at', $annee)->OrderBy('montant', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('domaine_id', 1)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
       
       
        return view('suiviSortieTerrain.ventes_formation_tri_dernier', compact('ventess', 'mois', 'commercials','venteMontants'));
    }
     
     
     public function ventes_technologies_tri_dernier()
    {
         $mois = date('m');
        $annee = date('Y'); 
        //$ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::where('pays_id', 5)->get();
        
        $ventess = DB::table('ventes')->where('domaine_id', 2)->whereYear('created_at', $annee)->orderBy('ventes.position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('domaine_id', 2)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
       
        return view('suiviSortieTerrain.ventes_technologies_tri_dernier', compact('ventess', 'mois', 'commercials','venteMontants'));
    }
    
     public function ventes_formation_tri()
     {
         $mois = date('m');
        $annee = date('Y'); 
        //$ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::where('pays_id', 5)->get();
        
        $ventess = DB::table('ventes')->where('domaine_id', 1)->whereYear('created_at', $annee)->orderBy('ventes.position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('domaine_id', 1)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
         
       
       
        return view('suiviSortieTerrain.ventes_formation_tri', compact('ventess', 'mois', 'commercials','venteMontants'));
    }
     
     
     public function ventes_technologies_tri()
    {
         $mois = date('m');
        $annee = date('Y'); 
        //$ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::where('pays_id', 5)->get();
        
        $ventess = DB::table('ventes')->where('domaine_id', 2)->whereYear('created_at', $annee)->orderBy('ventes.position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('domaine_id', 2)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
       
        return view('suiviSortieTerrain.ventes_technologies_tri', compact('ventess', 'mois', 'commercials','venteMontants'));
    }
    
     public function ventes_formation()
     {
         $mois = date('m');
        $annee = date('Y'); 
        //$ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::where('pays_id', 5)->get();
        
        $ventess = DB::table('ventes')->where('domaine_id', 1)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->orderBy('ventes.position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('domaine_id', 1)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
       
       
        return view('suiviSortieTerrain.ventes_formation', compact('ventess', 'mois', 'commercials','venteMontants'));
    }
     
     
     public function ventes_technologies()
    {
         $mois = date('m');
        $annee = date('Y'); 
        //$ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::where('pays_id', 5)->get();
        
        $ventess = DB::table('ventes')->where('domaine_id', 2)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->orderBy('ventes.position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('domaine_id', 2)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
       
        return view('suiviSortieTerrain.ventes_technologies', compact('ventess', 'mois', 'commercials','venteMontants'));
    }
     
     public function ventes_formationFiltre(Request $request)
     {
         $searchMois = $request->get('searchMois');
         $mois = date('m');
        $annee = date('Y'); 
        //$ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::where('pays_id', 5)->get();
        
        $ventess = DB::table('ventes')->where('domaine_id', 1)->whereMonth('created_at','like', '%'.$searchMois.'%')->whereYear('created_at', $annee)->orderBy('ventes.position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('domaine_id', 1)->whereMonth('created_at', $mois)->whereMonth('created_at','like', '%'.$searchMois.'%')->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
       
       
        return view('suiviSortieTerrain.ventes_formation', compact('ventess', 'mois', 'commercials','venteMontants'));
    }
     
     
     public function ventes_technologiesFiltre(Request $request)
    {
        $searchMois = $request->get('searchMois');
         $mois = date('m');
        $annee = date('Y'); 
        //$ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::where('pays_id', 5)->get();
        
        $ventess = DB::table('ventes')->where('domaine_id', 2)->whereYear('created_at', $annee)->whereMonth('created_at','like', '%'.$searchMois.'%')->OrderBy('created_at', 'desc')->orderBy('ventes.position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('domaine_id', 2)->whereMonth('created_at', $mois)->whereMonth('created_at','like', '%'.$searchMois.'%')->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
       
        return view('suiviSortieTerrain.ventes_technologies', compact('ventess', 'mois', 'commercials','venteMontants'));
    }
    
      public function top_commerciaux_detail()
    {
        $mois = date('m');
    
        $moisT = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $vente = DB::table('ventes')->select('ventes.*', 'commerciaus.id as ID', 'commerciaus.prenom', 'commerciaus.nom', 'commerciaus.pays_id', DB::raw('sum(ventes.montant) as `total`'))
        ->join('commerciaus','commerciaus.id', 'ventes.commercial_id')
        ->whereYear('ventes.created_at', $annee)
        //->whereMonth('ventes.created_at', '>=', 07)
        //->whereMonth('ventes.created_at', '<=', 9)
        ->whereMonth('ventes.created_at', $moisT)
        ->groupBy('ventes.commercial_id')->orderBy('total','DESC')
        ->OrderBy('total', 'desc')
        ->get();
        
      
       
        // dd($vente);
            
        return view('suiviSortieTerrain.top_commerciaux_detail', compact('vente'));
    }
    
      public function filtre_top_commerciaux_detail(Request $request)
    {
        $serachCom = $request->get('serachCom');
        $serachPays = $request->get('serachPays');
        $mois = date('m');
    
        $moisT = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
       
        // $vente = DB::table('ventes')->select('ventes.*', 'commerciaus.id as ID', 'commerciaus.prenom', 'commerciaus.nom', 'commerciaus.pays_id')
        // ->join('commerciaus','commerciaus.id', 'ventes.commercial_id')->OrderBy('ventes.montant', 'desc')
        // ->where('commerciaus.pays_id','like', '%'.$serachPays.'%')
        // ->whereIn('commerciaus.pays_id', [$serachPays])->get();
        
        $vente = DB::table('ventes')->select('ventes.*', 'commerciaus.id as ID', 'commerciaus.prenom', 'commerciaus.nom', 'commerciaus.pays_id', DB::raw('sum(ventes.montant) as `total`'))
        ->join('commerciaus','commerciaus.id', 'ventes.commercial_id')
        ->whereYear('ventes.created_at', $annee)
        //->whereMonth('ventes.created_at', '>=', 07)
        //->whereMonth('ventes.created_at', '<=', 9)
        ->whereMonth('ventes.created_at', $moisT)
        ->where('commerciaus.pays_id','like', '%'.$serachPays.'%')
        ->whereIn('commerciaus.pays_id', [$serachPays])
        ->groupBy('ventes.commercial_id')->orderBy('total','DESC')
        ->OrderBy('total', 'desc')
        ->get();
            
        return view('suiviSortieTerrain.top_commerciaux_detail', compact('vente'));
    }
    
      public function statistique_oppSN_70()
    {
        $mois = date('m');
        $opportunite = DB::table('opportunites')->where('archiver', 0)->where('pays_id', 1)->where('probabilite', '>=', 70)->orderBy('probabilite', 'desc')->get();
        return view('suiviSortieTerrain.statistique_oppSN_70', compact('opportunite'));
    }
     public function filtrer_oppSN_70(Request $request)
    {
        $search = $request->get('search');
        $searchOr = $request->get('searchOr');
        $searchProb = $request->get('searchProb');
        $serachCom = $request->get('serachCom');
        $serachpays = $request->get('serachpays');
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('archiver', 0)->where('pays_id', 1)->where('probabilite', '>=', 70)
        ->where('commercial_id','like', '%'.$serachCom.'%')->where('pays_id','like', '%'.$serachpays.'%')->where('statut','like', '%'.$search.'%')->where('origine_id','like', '%'.$searchOr.'%')
        ->whereIn('commercial_id', [$serachCom])->orWhereIn('pays_id', [$serachpays])->orWhereIn('statut', [$search])->orWhereIn('origine_id', [$searchOr])
        ->orderBy('probabilite', 'desc')
        ->get();
        return view('suiviSortieTerrain.statistique_oppSN_70', compact('opportunite'));
    }
    
      public function statistique_oppSN_50()
    {
        $mois = date('m');
        $opportunite = DB::table('opportunites')->where('archiver', 0)->where('pays_id', 1)->where('probabilite', '<', 70)->orderBy('probabilite', 'desc')->get();
        return view('suiviSortieTerrain.statistique_oppSN_50', compact('opportunite'));
    }
     public function filtrer_oppSN_50(Request $request)
    {
        $search = $request->get('search');
        $searchOr = $request->get('searchOr');
        $searchProb = $request->get('searchProb');
        $serachCom = $request->get('serachCom');
        $serachpays = $request->get('serachpays');
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('archiver', 0)->where('pays_id', 1)->where('probabilite', '<', 70)
        ->where('commercial_id','like', '%'.$serachCom.'%')->where('pays_id','like', '%'.$serachpays.'%')->where('statut','like', '%'.$search.'%')->where('origine_id','like', '%'.$searchOr.'%')
        ->whereIn('commercial_id', [$serachCom])->orWhereIn('pays_id', [$serachpays])->orWhereIn('statut', [$search])->orWhereIn('origine_id', [$searchOr])
        ->orderBy('probabilite', 'desc')
        ->get();
        return view('suiviSortieTerrain.statistique_oppSN_50', compact('opportunite'));
    }
    
      public function statistique_oppBF_70()
    {
        $mois = date('m');
        $opportunite = DB::table('opportunites')->where('archiver', 0)->where('pays_id', 5)->where('probabilite', '>=', 70)->orderBy('probabilite', 'desc')->get();
        return view('suiviSortieTerrain.statistique_oppBF_70', compact('opportunite'));
    }
     public function filtrer_oppBF_70(Request $request)
    {
        $search = $request->get('search');
        $searchOr = $request->get('searchOr');
        $searchProb = $request->get('searchProb');
        $serachCom = $request->get('serachCom');
        $serachpays = $request->get('serachpays');
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('archiver', 0)->where('pays_id', 5)->where('probabilite', '>=', 70)
        ->where('commercial_id','like', '%'.$serachCom.'%')->where('pays_id','like', '%'.$serachpays.'%')->where('statut','like', '%'.$search.'%')->where('origine_id','like', '%'.$searchOr.'%')
        ->whereIn('commercial_id', [$serachCom])->orWhereIn('pays_id', [$serachpays])->orWhereIn('statut', [$search])->orWhereIn('origine_id', [$searchOr])
        ->orderBy('probabilite', 'desc')
        ->get();
        return view('suiviSortieTerrain.statistique_oppBF_70', compact('opportunite'));
    }
    
      public function statistique_oppBF_50()
    {
        $mois = date('m');
        $opportunite = DB::table('opportunites')->where('archiver', 0)->where('pays_id', 5)->where('probabilite', '<', 70)->orderBy('probabilite', 'desc')->get();
        return view('suiviSortieTerrain.statistique_oppBF_50', compact('opportunite'));
    }
     public function filtrer_oppBF_50(Request $request)
    {
        $search = $request->get('search');
        $searchOr = $request->get('searchOr');
        $searchProb = $request->get('searchProb');
        $serachCom = $request->get('serachCom');
        $serachpays = $request->get('serachpays');
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('archiver', 0)->where('pays_id', 5)->where('probabilite', '<', 70)
        ->where('commercial_id','like', '%'.$serachCom.'%')->where('pays_id','like', '%'.$serachpays.'%')->where('statut','like', '%'.$search.'%')->where('origine_id','like', '%'.$searchOr.'%')
        ->whereIn('commercial_id', [$serachCom])->orWhereIn('pays_id', [$serachpays])->orWhereIn('statut', [$search])->orWhereIn('origine_id', [$searchOr])
        ->orderBy('probabilite', 'desc')
        ->get();
        return view('suiviSortieTerrain.statistique_oppBF_50', compact('opportunite'));
    }
      public function statistique_hot_deals()
    {
        $mois = date('m');
        $opportunite = DB::table('opportunites')->where('archiver', 0)->where('statut', 15)->orWhere('statut', 13)->get();
        
        $opportunite_tri = DB::table('opportunites')->where('archiver', 0)->where('probabilite', '>=', 60)->orderBy('probabilite', 'desc')->get();
         
        return view('suiviSortieTerrain.statistique_hot_deals', compact('opportunite_tri','opportunite'));
    }
    
      public function statistique_hot_deals_sn()
    {
        $mois = date('m');
        $opportunite = DB::table('opportunites')->where('archiver', 0)->where('statut', 15)->orWhere('statut', 13)->get();
        
        // $opportunite_tri = DB::table('opportunites')->where('archiver', 0)->where('probabilite', '>=', 60)->orderBy('probabilite', 'asc')->get();
        $opportunite_tri = DB::table('opportunites')->select('opportunites.*', 'commerciaus..prenom','commerciaus.nom','commerciaus.pays_id')
                                        ->join('commerciaus', 'commerciaus.id', 'opportunites.commercial_id')
                                        ->where('opportunites.archiver', 0)
                                        ->where('opportunites.probabilite', '>=', 60)
                                        ->where('commerciaus.pays_id', 1)
                                        ->whereMonth('opportunites.deadline', $mois)
                                        ->orderBy('probabilite', 'desc')
                                        ->get();
         
        return view('suiviSortieTerrain.statistique_hot_deals_sn', compact('opportunite_tri','opportunite'));
    }
    
      public function filtre_hot_deals_sn(Request $request)
    {
        $mois = date('m');
        $opportunite = DB::table('opportunites')->where('archiver', 0)->where('statut', 15)->orWhere('statut', 13)->get();
        
        $serachCom = $request->get('serachCom');
        $serachPays = $request->get('serachPays');
        $opportunite_tri = DB::table('opportunites')->where('archiver', 0)->where('probabilite', '>=', 60)
        // ->where('commercial_id','like', '%'.$serachCom.'%')
        ->where('pays_id','like', '%'.$serachPays.'%')
        // ->whereIn('commercial_id', [$serachCom])
        ->whereIn('pays_id', [$serachPays])
        ->orderBy('probabilite', 'desc')
        ->get();
        
        return view('suiviSortieTerrain.statistique_hot_deals_sn', compact('opportunite_tri','opportunite'));
    }
      public function statistique_hot_deals_bf()
    {
        $mois = date('m');
        $opportunite = DB::table('opportunites')->where('archiver', 0)->where('statut', 15)->orWhere('statut', 13)->get();
        
        // $opportunite_tri = DB::table('opportunites')->where('archiver', 0)->where('probabilite', '>=', 60)->orderBy('probabilite', 'asc')->get();
        
         $opportunite_tri = DB::table('opportunites')->select('opportunites.*', 'commerciaus..prenom','commerciaus.nom','commerciaus.pays_id')
                                        ->join('commerciaus', 'commerciaus.id', 'opportunites.commercial_id')
                                        ->where('opportunites.archiver', 0)
                                        ->where('opportunites.probabilite', '>=', 60)
                                        ->where('commerciaus.pays_id', 5)
                                        ->whereMonth('opportunites.deadline', $mois)
                                        ->orderBy('probabilite', 'desc')
                                        ->get();
         
        return view('suiviSortieTerrain.statistique_hot_deals_bf', compact('opportunite_tri','opportunite'));
    }
    
      public function filtre_hot_deals_bf(Request $request)
    {
        $mois = date('m');
        $opportunite = DB::table('opportunites')->where('archiver', 0)->where('statut', 15)->orWhere('statut', 13)->get();
        
        $serachCom = $request->get('serachCom');
        $serachPays = $request->get('serachPays');
        $opportunite_tri = DB::table('opportunites')->where('archiver', 0)->where('probabilite', '>=', 60)
        // ->where('commercial_id','like', '%'.$serachCom.'%')
        ->where('pays_id','like', '%'.$serachPays.'%')
        // ->whereIn('commercial_id', [$serachCom])
        ->whereIn('pays_id', [$serachPays])
        ->orderBy('probabilite', 'desc')
        ->get();
        
        return view('suiviSortieTerrain.statistique_hot_deals_bf', compact('opportunite_tri','opportunite'));
    }
    
      public function tous_hot_deals()
    {
        $mois = date('m');

        $opportunite = DB::table('opportunites')->where('archiver', 0)->where('probabilite', '>=', 60)->orderBy('probabilite', 'desc')->get();
         
        return view('suiviSortieTerrain.tous_hot_deals', compact('opportunite'));
    }
    
      public function filtre_tous_hot_deals(Request $request)
    {
        $mois = date('m');
        $serachCom = $request->get('serachCom');
        $serachPays = $request->get('serachPays');
        $opportunite = DB::table('opportunites')->where('archiver', 0)->where('probabilite', '>=', 60)
        ->where('pays_id','like', '%'.$serachPays.'%')
        ->whereIn('pays_id', [$serachPays])
        ->orderBy('probabilite', 'desc')
        ->get();
         
        return view('suiviSortieTerrain.tous_hot_deals', compact('opportunite'));
    }
    
      public function filtre_hot_deals(Request $request)
    {
        $mois = date('m');
        $opportunite = DB::table('opportunites')->where('archiver', 0)->where('statut', 15)->orWhere('statut', 13)->get();
        
        $serachCom = $request->get('serachCom');
        $serachPays = $request->get('serachPays');
        $opportunite_tri = DB::table('opportunites')->where('archiver', 0)->where('probabilite', '>=', 60)
        // ->where('commercial_id','like', '%'.$serachCom.'%')
        ->where('pays_id','like', '%'.$serachPays.'%')
        // ->whereIn('commercial_id', [$serachCom])
        ->whereIn('pays_id', [$serachPays])
        ->orderBy('probabilite', 'asc')
        ->get();
        
        return view('suiviSortieTerrain.statistique_hot_deals', compact('opportunite_tri','opportunite'));
    }
    
     public function filtrer_hot_deals(Request $request)
    {
        $search = $request->get('search');
        $searchOr = $request->get('searchOr');
        $searchProb = $request->get('searchProb');
        $serachCom = $request->get('serachCom');
        $serachpays = $request->get('serachpays');
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('archiver', 0)->whereIn('statut', [15, 13])
        ->where('commercial_id','like', '%'.$serachCom.'%')->where('pays_id','like', '%'.$serachpays.'%')->where('statut','like', '%'.$search.'%')->where('origine_id','like', '%'.$searchOr.'%')
        ->whereIn('commercial_id', [$serachCom])->whereIn('pays_id', [$serachpays])->whereIn('statut', [$search])->whereIn('origine_id', [$searchOr])->get();
        return view('suiviSortieTerrain.statistique_hot_deals', compact('opportunite'));
    }
      public function statistique_opportunites()
    {
        $mois = date('m');
        $opportunites = DB::table('opportunites')->OrderBy('created_at', 'desc')->get();
        return view('suiviSortieTerrain.statistique_opportunites', compact('opportunites'));
    }
     
     
     
     
       public function ajout_objectif()
    {
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        $com = DB::table('commerciaus')->where('entreprise_client_id', $moi->entreprise_client_id)->orderby('prenom')->get();
        $commission_p = DB::table('parametres')->get();
        return view('suiviSortieTerrain.ajout_objectif',compact('com','commission_p'));

    }
    
    
    public function opportunite_prevus()
    {
        
        $dates = date('Y-m-d');

       
                $opportunites = DB::table('opportunites')->select('opportunites.*', 'prospects.id', 'prospects.nom_entreprise', 'commerciaus.prenom','commerciaus.nom')
                ->join('prospects', 'prospects.id', 'opportunites.prospect_id')
                ->join('commerciaus', 'commerciaus.id', 'opportunites.commercial_id')
                ->where('opportunites.probabilite', '>=', 50)
                ->where('opportunites.deadline', '>=', $dates)
                ->where('opportunites.archiver', 0)
                ->get();
               
                return view('suiviSortieTerrain.opportunite_prevus',compact('opportunites'));
               
                    
   
        
    }
    
    public function opportunite_deuxieme_tri()
    {
        
        $dates = date('Y-m-d');

       
                $opportunites = DB::table('opportunites')->select('opportunites.*', 'prospects.id', 'prospects.nom_entreprise', 'commerciaus.prenom','commerciaus.nom')
                ->join('prospects', 'prospects.id', 'opportunites.prospect_id')
                ->join('commerciaus', 'commerciaus.id', 'opportunites.commercial_id')
                ->where('opportunites.archiver', 0)
                ->orderBy('opportunites.probabilite', 'desc')
                ->get();
               
                return view('suiviSortieTerrain.opportunite_deuxieme_tri',compact('opportunites'));
               
                    
   
        
    }
    
    
    
       public function store_objectif(Request $request)
    {
        //
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
                $message = "Objectif ajouté avec succès";
                // $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                
                $com =  new Objectif_commission ;
                $com->objectif_mois = $request->get('objectif_mois');
                $com->objectif_visite = $request->get('objectif_visite');
                $com->commission_p = $request->get('commission_p');
                $com->nbre_contact = $request->get('nbre_contact');
                $com->nbre_demo = $request->get('nbre_demo');
                 $com->nbre_appel_quotidien = $request->get('nbre_appel_quotidien');
                $com->commercial_id = $request->get('commercial_id');
                $com->entreprise_client_id = $moi->entreprise_client_id;
                $com->save();
                
                DB::table('commerciaus')->where('id', $com->commercial_id)->update(['objectif_visite' => $com->objectif_visite, 'nbre_appel_quotidien' => $com->nbre_appel_quotidien, 'nbre_demo' => $com->nbre_demo,'nbre_contact' => $com->nbre_contact, 'objectif_mois' => $com->objectif_mois, 'commission_p' => $com->commission_p,  'created_at' => $com->created_at,  'updated_at' => $com->updated_at]);

                return back()->with(['message' => $message]);
    }
    
        public function ajout_objectif_res()
    {
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        $com = DB::table('commerciaus')->where('entreprise_client_id', $moi->entreprise_client_id)->where('superieur_id', $moi->id)->orderby('prenom')->get();
        $commission_p = DB::table('parametres')->get();
        return view('suiviSortieTerrain.ajout_objectif_res',compact('com','commission_p'));

    }
       public function store_objectif_res(Request $request)
    {
        //   
            $moi = Commerciau::where('user_id', Auth::user()->id)->first();
                $message = "Objectif ajouté avec succès";
                // $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                
                $com =  new Objectif_commission ;
                $com->objectif_mois = $request->get('objectif_mois');
                $com->objectif_visite = $request->get('objectif_visite');
                $com->commission_p = $request->get('commission_p');
                $com->nbre_contact = $request->get('nbre_contact');
                $com->nbre_demo = $request->get('nbre_demo');
                $com->nbre_appel_quotidien = $request->get('nbre_appel_quotidien');
                $com->commercial_id = $request->get('commercial_id');
                $com->entreprise_client_id = $moi->entreprise_client_id;
                $com->date = $request->get('date');
                $com->save();
                
                $comm_mail= DB::table('commerciaus')->where('id', $com->commercial_id)->first();
                $user = DB::table('users')->where('id', $comm_mail->user_id)->first();
                Mail::to($user->email)->send(new MailObjectif($user, $com));
                
                DB::table('commerciaus')->where('id', $com->commercial_id)->update(['nbre_appel_quotidien' => $com->nbre_appel_quotidien,'objectif_visite' => $com->objectif_visite,'nbre_demo' => $com->nbre_demo,'nbre_contact' => $com->nbre_contact, 'objectif_mois' => $com->objectif_mois, 'commission_p' => $com->commission_p, 'created_at' => $com->created_at,  'updated_at' => $com->updated_at]);

                return back()->with(['message' => $message]);
    }
    
     public function liste_demos()
    {
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        $mois = date('m');
        $demos = DB::table('demos')->whereMonth('created_at', $mois)->OrderBy('created_at', 'desc')->paginate();
        return view('suiviSortieTerrain.liste_demos', compact('demos'));
    }
    
     public function liste_demos_res()
    {
        $mois = date('m');
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        $demos = DB::table('demos')->where('superieur_id', $moi->superieur_id)->whereMonth('created_at', $mois)->OrderBy('created_at', 'desc')->paginate(1000);
        
        $demos_pole = DB::table('demos')->select('demos.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'demos.commercial_id')
            ->where('commerciaus.domaine_id', $moi->domaine_id)
            // ->where('entreprise_client_id', $moi->entreprise_client_id)
            ->whereMonth('demos.created_at', $mois)->OrderBy('demos.created_at', 'desc')->paginate(1000);
        return view('suiviSortieTerrain.liste_demos_res', compact('demos','moi','demos_pole'));
    }
    
     public function liste_updates()
    {
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        $mois = date('m');
        $updates = DB::table('update_opps')->whereMonth('created_at', $mois)->OrderBy('created_at', 'desc')->paginate();
       
        return view('suiviSortieTerrain.liste_updates', compact('updates'));
    }
    
    public function liste_updates_res()
    {   $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        $mois = date('m');
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        $updates = DB::table('update_opps')->where('superieur_id', $moi->superieur_id)->whereMonth('created_at', $mois)->OrderBy('created_at', 'desc')->paginate();
        
        $updates_pole = DB::table('update_opps')->select('update_opps.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'update_opps.commercial_id')
            ->where('commerciaus.domaine_id', $moi->domaine_id)
            // ->where('entreprise_client_id', $moi->entreprise_client_id)
            ->whereMonth('update_opps.created_at', $mois)->OrderBy('update_opps.created_at', 'desc')->paginate(1000);
        return view('suiviSortieTerrain.liste_updates_res', compact('updates', 'moi','updates_pole'));
    }
    
     public function opportunite_maTeam()
    {
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('entreprise_client_id', $moi->entreprise_client_id)->where('archiver', 0)->OrderBy('probabilite', 'desc')->get();
        return view('suiviSortieTerrain.opportunite_maTeam', compact('opportunite'));
    }
    
     public function filtrer_statut_maTeam(Request $request)
    {
        $search = $request->get('search');
        $searchOr = $request->get('searchOr');
        $searchProb = $request->get('searchProb');
        $serachCom = $request->get('serachCom');
        $serachpays = $request->get('serachpays');
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('entreprise_client_id', $commercial->entreprise_client_id)->where('commercial_id','like', '%'.$serachCom.'%')->where('pays_id','like', '%'.$serachpays.'%')->where('statut','like', '%'.$search.'%')->where('origine_id','like', '%'.$searchOr.'%')->whereIn('commercial_id', [$serachCom])->orWhereIn('pays_id', [$serachpays])->orWhereIn('statut', [$search])->orWhereIn('origine_id', [$searchOr])->paginate(10000);
        return view('suiviSortieTerrain.opportunite_maTeam', compact('opportunite'));
    }
    
    
     public function opportunite_maTeam_res()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->OrderBy('probabilite', 'desc')->get();
        
        $opportunite_pole = DB::table('opportunites')->select('opportunites.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'opportunites.commercial_id')
            ->where('commerciaus.domaine_id', $commercial->domaine_id)
            ->OrderBy('opportunites.probabilite', 'desc')->get();
        
        return view('suiviSortieTerrain.opportunite_maTeam_res', compact('opportunite', 'commercial','opportunite_pole'));
    }
    
     public function op_maTeamFiltreRes(Request $request)
    {
        $serachCom = $request->get('serachCom');
        
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        
        $opportunite_pole = DB::table('opportunites')->select('opportunites.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'opportunites.commercial_id')
            ->where('commerciaus.domaine_id', $commercial->domaine_id)
            ->where('opportunites.commercial_id','like', '%'.$serachCom.'%')->whereIn('opportunites.commercial_id', [$serachCom])
            ->OrderBy('opportunites.probabilite', 'desc')->get();
            
        $opportunite = DB::table('opportunites')->where('commercial_id','like', '%'.$serachCom.'%')->whereIn('commercial_id', [$serachCom])->OrderBy('probabilite', 'desc')->get();
          return view('suiviSortieTerrain.opportunite_maTeam_res', compact('opportunite', 'commercial','opportunite_pole'));
    }
    
     public function op_maTeamFiltre(Request $request)
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $serachCom = $request->get('serachCom');
        $serachpays = $request->get('serachpays');
        
        
        $opportunite = DB::table('opportunites')->where('commercial_id','like', '%'.$serachCom.'%')->where('pays_id','like', '%'.$serachpays.'%')->whereIn('commercial_id', [$serachCom])->orWhereIn('pays_id', [$serachpays])->OrderBy('probabilite', 'desc')->where('archiver', 0)->get();
          return view('suiviSortieTerrain.opportunite_maTeam', compact('opportunite', 'commercial'));
    }
    
     public function filtrer_statut_maTeam_res(Request $request)
    {
        $search = $request->get('search');
        $searchOr = $request->get('searchOr');
        $searchProb = $request->get('searchProb');
         $serachCom = $request->get('serachCom');
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('statut','like', '%'.$search.'%')->where('origine_id','like', '%'.$searchOr.'%')
        ->where('opportunites.commercial_id','like', '%'.$serachCom.'%')
            ->whereIn('opportunites.commercial_id', [$serachCom])
            ->orWhereIn('opportunites.statut', [$search])->orWhereIn('opportunites.origine_id', [$searchOr])
            ->OrderBy('opportunites.probabilite', 'desc')->paginate(10000);
        
        $opportunite_pole = DB::table('opportunites')->select('opportunites.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'opportunites.commercial_id')
            ->where('commerciaus.domaine_id', $commercial->domaine_id)
            ->where('opportunites.statut','like', '%'.$search.'%')->where('opportunites.origine_id','like', '%'.$searchOr.'%')
            ->where('opportunites.commercial_id','like', '%'.$serachCom.'%')
            ->whereIn('opportunites.commercial_id', [$serachCom])
            ->orWhereIn('opportunites.statut', [$search])->orWhereIn('opportunites.origine_id', [$searchOr])
            ->OrderBy('opportunites.probabilite', 'desc')->get();
        return view('suiviSortieTerrain.opportunite_maTeam_res', compact('opportunite', 'commercial','opportunite_pole'));
    }
    
     public function filtrer_com_maTeam_res(Request $request)
    {
       
         $serachCom = $request->get('serachCom');
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('statut','like', '%'.$search.'%')->where('origine_id','like', '%'.$searchOr.'%')->paginate(10000);
        
        $opportunite_pole = DB::table('opportunites')->select('opportunites.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'opportunites.commercial_id')
            ->where('commerciaus.domaine_id', $commercial->domaine_id)
            ->where('opportunites.commercial_id','like', '%'.$serachCom.'%')
            ->whereIn('opportunites.commercial_id', [$serachCom])
            ->OrderBy('opportunites.probabilite', 'desc')->get();
        return view('suiviSortieTerrain.opportunite_maTeam_res', compact('opportunite', 'commercial','opportunite_pole'));
    }
    
          public function op_maTeam_edit($id)
    {
        $opportunite = Opportunite::find($id);
        $commercial = DB::table('commerciaus')->orderBy('prenom')->get();
        return view('suiviSortieTerrain.edit_opportunite_maTeam',compact('opportunite','commercial'));

    }
    public function op_maTeam_update(Request $request, $id)
    {
        //
                $message = "Opportunité mise à jour avec succès";
                $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                
                $opportunite = Opportunite::find($id);
                $opportunite->commercial_id = $request->get('commercial_id');
                $opportunite->commercial_backup = $request->get('commercial_backup');
                $opportunite->update();
                
                return redirect('/commerciaux_maTeam')->with(['message' => $message]);
    }
     
     
          public function commerciaux_edit($id)
    {
        $com = Objectif_commission::find($id);
        $commission_p = DB::table('parametres')->get();
        return view('suiviSortieTerrain.edit_com_maTeam',compact('com','commission_p'));

    }
     
      public function commerciaux_update(Request $request, $id)
    {
        //
                $message = "Commercial mise à jour avec succès";
                //$commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                $now = now();
                $com = Objectif_commission::findOrFail($id);
                $com->objectif_visite = $request->get('objectif_visite');
                $com->Objectif_mois = $request->get('objectif_mois');
                $com->commission_p = $request->get('commission_p');
                $com->nbre_contact = $request->get('nbre_contact');
                $com->nbre_demo = $request->get('nbre_demo');
                $com->nbre_appel_quotidien = $request->get('nbre_appel_quotidien');
                $com->commercial_id = $request->get('commercial_id');
                $com->created_at = $now;
                $com->updated_at = $now;
                $com->save();
                
                
                //DB::table('commerciaus')->update(['nbre_demo' => $com->nbre_demo,'nbre_contact' => $com->nbre_contact, 'objectif_mois' => $com->Objectif_mois, 'commission_p' => $com->commission_p, 'commercial_id' => $com->id,  'created_at' => $com->updated_at,  'updated_at' => $com->updated_at]);
                DB::table('commerciaus')->where('id', $com->commercial_id)->update(['nbre_appel_quotidien' => $com->nbre_appel_quotidien,'objectif_visite' => $com->objectif_visite,'nbre_demo' => $com->nbre_demo,'nbre_contact' => $com->nbre_contact, 'objectif_mois' => $com->Objectif_mois, 'commission_p' => $com->commission_p, 'created_at' => $com->created_at,  'updated_at' => $com->updated_at]);

                return redirect('/parametres')->with(['message' => $message]);
    }
    
    
          public function listcommerciaux_edit($id)
    {
        $com = Commerciau::find($id);
        $commission_p = DB::table('parametres')->get();
        return view('suiviSortieTerrain.listedit_com_maTeam',compact('com','commission_p'));

    }
     
      public function listcommerciaux_update(Request $request, $id)
    {
        //
                $message = "Commercial mise à jour avec succès";
                // $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                
                $com = Commerciau::findOrFail($id);
                $com->objectif_mois = $request->get('objectif_mois');
                $com->commission_p = $request->get('commission_p');
                $com->nbre_contact = $request->get('nbre_contact');
                $com->nbre_demo = $request->get('nbre_demo');
                $com->objectif_visite = $request->get('objectif_visite');
                $com->save();
                
                DB::table('objectif_commissions')->insert(['objectif_visite' => $com->objectif_visite,'nbre_demo' => $com->nbre_demo, 'nbre_contact' => $com->nbre_contact, 'objectif_mois' => $com->objectif_mois, 'commission_p' => $com->commission_p, 'commercial_id' => $com->id,  'created_at' => $com->updated_at,  'updated_at' => $com->updated_at]);

                return redirect('/commerciaux_maTeam')->with(['message' => $message]);
    }
    
    
          public function listcommerciaul_edit_res($id)
    {
        $com = Commerciau::find($id);
        $commission_p = DB::table('parametres')->get();
        return view('suiviSortieTerrain.listedit_com_maTeam_res',compact('com','commission_p'));

    }
     
      public function listcommerciaul_update_res(Request $request, $id)
    {
        //
                $message = "Commercial mise à jour avec succès";
                // $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                
                $com = Commerciau::findOrFail($id);
                $com->objectif_mois = $request->get('objectif_mois');
                $com->objectif_visite = $request->get('objectif_visite');
                $com->commission_p = $request->get('commission_p');
                $com->nbre_contact = $request->get('nbre_contact');
                $com->nbre_demo = $request->get('nbre_demo');
                $com->save();
                
                DB::table('objectif_commissions')->insert(['objectif_visite' => $com->objectif_visite, 'nbre_demo' => $com->nbre_demo, 'nbre_contact' => $com->nbre_contact, 'objectif_mois' => $com->objectif_mois, 'commission_p' => $com->commission_p, 'commercial_id' => $com->id,  'created_at' => $com->updated_at,  'updated_at' => $com->updated_at]);

                return redirect('/commerciaux_maTeam_res')->with(['message' => $message]);
    }
    
    
    
      public function commerciaul_edit($id)
    {
        $com = Objectif_commission::find($id);
               
      
        $commission_p = DB::table('parametres')->get();
        return view('suiviSortieTerrain.edit_commercial',compact('com','commission_p'));

    }
       public function commerciaul_update(Request $request, $id)
    {
        //
                $message = "Commercial mise à jour avec succès";
                // $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                $now = now();
                $com = Objectif_commission::findOrFail($id);
                $com->Objectif_mois = $request->get('objectif_mois');
                $com->objectif_visite = $request->get('objectif_visite');
                $com->commission_p = $request->get('commission_p');
                $com->nbre_contact = $request->get('nbre_contact');
                $com->nbre_demo = $request->get('nbre_demo');
                $com->nbre_appel_quotidien = $request->get('nbre_appel_quotidien');
                $com->commercial_id = $request->get('commercial_id');
                $com->created_at = $now;
                $com->updated_at = $now;
                $com->save();
                
                //DB::table('commerciaus')->update(['nbre_demo' => $com->nbre_demo,'nbre_contact' => $com->nbre_contact, 'objectif_mois' => $com->Objectif_mois, 'commission_p' => $com->commission_p, 'commercial_id' => $com->id,  'created_at' => $com->updated_at,  'updated_at' => $com->updated_at]);
                DB::table('commerciaus')->where('id', $com->commercial_id)->update(['nbre_appel_quotidien' => $com->nbre_appel_quotidien,'objectif_visite' => $com->objectif_visite, 'nbre_demo' => $com->nbre_demo,'nbre_contact' => $com->nbre_contact, 'objectif_mois' => $com->Objectif_mois, 'commission_p' => $com->commission_p, 'created_at' => $com->updated_at,  'updated_at' => $com->updated_at]);

                return redirect('/parametres_res')->with(['message' => $message]);
    }
    
           public function contact_edit($id)
    {
        $contact = Contact::find($id);
        return view('suiviSortieTerrain.edit_contact',compact('contact'));

    }
     
      public function contact_update(Request $request, $id)
    {
        //
                $message = "Contact mise à jour avec succès";
                // $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                
                $contact = Contact::findOrFail($id);
                $contact->prenom = $request->get('prenom');
                $contact->nom = $request->get('nom');
                $contact->email = $request->get('email');
                $contact->phone = $request->get('phone');
                $contact->responsabilite = $request->get('responsabilite');
                $contact->save();
                

                return redirect('/liste_contacts')->with(['message' => $message]);
    }
    
    
     
     
      public function mescommisions_dumois()
    {
        $mois = date('m');
        $annee = date('Y'); 
        $commission_mois = array();
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $commission = DB::table('commissions')->where('commercial_id', $commercial->id)->OrderBy('created_at', 'desc')->get();
            foreach($commission as $commission)
                {
                    if( $mois == date('m', strtotime($commission->created_at)) && $annee == date('Y', strtotime($commission->created_at)) )
                    {
                        array_push($commission_mois, $commission );
                        
                    }
                }
        return view('suiviSortieTerrain.mescommisions_dumois', compact('commission_mois', 'commercial'));
    }
    
    
      public function tous_commisions_dumois()
    {
        $mois = date('m');
        $annee = date('Y'); 
        $commissions = array();
        $commercial = Commerciau::all();
        $commission_mois = DB::table('commissions')->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->OrderBy('created_at', 'desc')->get();
            // foreach($commissions as $commission)
            //     {
            //         if( $mois == date('m', strtotime($commission->created_at)) && $annee == date('Y', strtotime($commission->created_at)) )
            //         {
            //             array_push($commission_mois, $commission );
                        
            //         }
            //     }
        return view('suiviSortieTerrain.tous_commisions_dumois', compact('commission_mois', 'commercial'));
    }
    
      public function tous_commisions_dumoisFiltre(Request $request)
    {
        $searchMois = $request->get('searchMois');
        $mois = date('m');
        $annee = date('Y'); 
        $commissions = array();
        $commercial = Commerciau::all();
        $commission_mois = DB::table('commissions')->whereMonth('created_at','like', '%'.$searchMois.'%')->whereYear('created_at', $annee)->OrderBy('created_at', 'desc')->get();
            // foreach($commissions as $commission)
            //     {
            //         if( $mois == date('m', strtotime($commission->created_at)) && $annee == date('Y', strtotime($commission->created_at)) )
            //         {
            //             array_push($commission_mois, $commission );
                        
            //         }
            //     }
        return view('suiviSortieTerrain.tous_commisions_dumois', compact('commission_mois', 'commercial'));
    }
    
      public function tous_commisions_dumois_res()
    {
        $mois = date('m');
        $annee = date('Y'); 
        $commission_mois = array();
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        $commercialss = DB::table('commerciaus')->where('superieur_id', $moi->id)->get();
        foreach($commercialss as $commercial){
        $commissions = DB::table('commissions')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->OrderBy('created_at', 'desc')->get();
            foreach($commissions as $commission)
                {
                    // if( $mois == date('m', strtotime($commission->created_at)) && $annee == date('Y', strtotime($commission->created_at)) )
                    // {
                        array_push($commission_mois, $commission );
                        
                    // }
                }
        }
        
         $commission_mois_pole = DB::table('commissions')->select('commissions.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'commissions.commercial_id')
            ->where('commerciaus.domaine_id', $moi->domaine_id)
            ->whereMonth('commissions.created_at', $mois)->whereYear('commissions.created_at', $annee)->orderBy('commissions.created_at', 'desc')
            ->get();
        return view('suiviSortieTerrain.tous_commisions_dumois_res', compact('commission_mois_pole','commission_mois'));
    }
    
     public function tous_commisions_dumois_resFiltre(Request $request)
    {
        $searchMois = $request->get('searchMois');
        $mois = date('m');
        $annee = date('Y'); 
        $commission_mois = array();
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        $commercialss = DB::table('commerciaus')->where('superieur_id', $moi->id)->get();
        foreach($commercialss as $commercial){
        $commissions = DB::table('commissions')->where('commercial_id', $commercial->id)->whereMonth('created_at','like', '%'.$searchMois.'%')->whereYear('created_at', $annee)->OrderBy('created_at', 'desc')->get();
            foreach($commissions as $commission)
                {
                    // if( $mois == date('m', strtotime($commission->created_at)) && $annee == date('Y', strtotime($commission->created_at)) )
                    // {
                        array_push($commission_mois, $commission );
                        
                    // }
                }
        }
       $commission_mois_pole = DB::table('commissions')->select('commissions.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'commissions.commercial_id')
            ->where('commerciaus.domaine_id', $moi->domaine_id)
            ->whereMonth('commissions.created_at', $mois)->whereYear('commissions.created_at', $annee)->whereMonth('commissions.created_at','like', '%'.$searchMois.'%')->orderBy('commissions.created_at', 'desc')
            ->get();
        return view('suiviSortieTerrain.tous_commisions_dumois_res', compact('commission_mois_pole','commission_mois'));
    }
    
     public function mes_vente_deumois()
    {
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->OrderBy('created_at', 'desc')->get();
            foreach($vente as $vente_mois)
                {
                    if( $mois == date('m', strtotime($vente_mois->created_at)) && $annee == date('Y', strtotime($vente_mois->created_at)) )
                    {
                        array_push($ventess, $vente_mois );
                        
                    }
                }
        return view('suiviSortieTerrain.mes_vente_deumois', compact('ventess', 'mois', 'commercial'));
    }
    
     public function mes_vente_deumois_tri()
    {
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $ventess = DB::table('ventes')->where('commercial_id', $commercial->id)->OrderBy('created_at', 'desc')->get();
           
        return view('suiviSortieTerrain.mes_vente_deumois_tri', compact('ventess', 'mois', 'commercial'));
    }
    
     public function voir_sesVente_dumois($id)
    {
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $commercial = Commerciau::find($id);
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->OrderBy('created_at', 'desc')->get();
            foreach($vente as $vente_mois)
                {
                    if( $mois == date('m', strtotime($vente_mois->created_at)) && $annee == date('Y', strtotime($vente_mois->created_at)) )
                    {
                        array_push($ventess, $vente_mois );
                        
                    }
                }
        return view('suiviSortieTerrain.voir_sesVente_dumois', compact('ventess', 'mois', 'commercial'));
    }
    
    public function voir_sesVente_dumoispasse($id)
    {
        $mois = (date('m') - 1);
        $annee = date('Y'); 
        $ventess = array();
        $commercial = Commerciau::find($id);
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->OrderBy('created_at', 'desc')->get();
            foreach($vente as $vente_mois)
                {
                    if( $mois == date('m', strtotime($vente_mois->created_at)) && $annee == date('Y', strtotime($vente_mois->created_at)) )
                    {
                        array_push($ventess, $vente_mois );
                        
                    }
                }
        return view('suiviSortieTerrain.voir_sesVente_dumoispasse', compact('ventess', 'mois', 'commercial'));
    }
    
    
    public function les_ventes_me()
    {
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::all();
         foreach($commercials as $commercial)
         {
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->orderBy('ventes.position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
            foreach($vente as $vente_mois)
                {
                    
                        array_push($ventess, $vente_mois);
                        
                    
                }
         }
         
         $moi = Commerciau::where('user_id', Auth::user()->id)->first();
         $les_vente = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle', 
                        'pays.libelle as nom_pays', 'prospects.nom_entreprise')
                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                        ->join('pays', 'commerciaus.pays_id', 'pays.id')
                        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
                        ->where('ventes.commercial_id', $moi->id)
                        ->whereYear('ventes.created_at', $annee)
                        ->orderBy('ventes.montant', 'desc')->get();
       
        $les_vente_sum = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle',
                        'pays.libelle as nom_pays', 'prospects.nom_entreprise')
                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                        ->join('pays', 'commerciaus.pays_id', 'pays.id')
                        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
                        ->where('ventes.commercial_id', $moi->id)
                        ->whereYear('ventes.created_at', $annee)
                        
                        ->orderBy('ventes.montant', 'desc')->sum('ventes.montant');
         
       
        return view('suiviSortieTerrain.les_ventes_me', compact('ventess', 'mois', 'commercials','venteMontants', 'les_vente', 'les_vente_sum'));
    }
    
    
     public function les_ventes()
    {
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::all();
         foreach($commercials as $commercial)
         {
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->orderBy('montant', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
            foreach($vente as $vente_mois)
                {
                    
                        array_push($ventess, $vente_mois);
                        
                    
                }
         } 
         
        $les_vente = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle'
        , 'pays.libelle as nom_pays', 'prospects.nom_entreprise')
        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
        ->join('pays', 'commerciaus.pays_id', 'pays.id')
        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
        //->where('commercial_id', $commercial->id)
        ->whereYear('ventes.created_at', $annee)
        ->orderBy('ventes.montant', 'desc')->get();

        $les_vente_sum = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle'
        , 'pays.libelle as nom_pays', 'prospects.nom_entreprise')
        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
        ->join('pays', 'commerciaus.pays_id', 'pays.id')
        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
        //->where('commercial_id', $commercial->id)
        ->whereYear('ventes.created_at', $annee)
        ->orderBy('ventes.montant', 'desc')->sum('ventes.montant');
       
        return view('suiviSortieTerrain.les_ventes', compact('ventess', 'mois', 'commercials','venteMontants', 'les_vente', 'les_vente_sum'));
    }
    
    
    public function les_ventesFiltre(Request $request)
    {
        $searchMois = $request->get('searchMois');
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::all();
        foreach($commercials as $commercial)
         {
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at','like', '%'.$searchMois.'%')->OrderBy('position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at','like', '%'.$searchMois.'%')->sum('montant');
        $venteMontants += $venteMontantss;
         
            foreach($vente as $vente_mois)
                {
                    
                        array_push($ventess, $vente_mois);
                        
                    
                }
         }
         
         
        $les_vente = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle', 
        'pays.libelle as nom_pays', 'prospects.nom_entreprise')
        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
        ->join('pays', 'commerciaus.pays_id', 'pays.id')
        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
        //->where('commercial_id', $commercial->id)
        ->whereYear('ventes.created_at', $annee)
        //->whereMonth('ventes.created_at','like', '%'.$searchMois.'%')
        
        ->when(request()->has('searchMois'), function($q){
            $q->whereMonth('ventes.created_at', request('searchMois'));
        })
        ->when(request()->has('searchCommerciau'), function($q){
            $q->where('ventes.commercial_id', request('searchCommerciau'));
        })
        ->when(request()->has('searchPays'), function($q){
            $q->where('pays.libelle', request('searchPays'));
        })
        ->orderBy('ventes.montant', 'desc')->get();
        
        $les_vente_sum = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle',
        'pays.libelle as nom_pays', 'prospects.nom_entreprise')
        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
        ->join('pays', 'commerciaus.pays_id', 'pays.id')
        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
        //->where('commercial_id', $commercial->id)
        ->whereYear('ventes.created_at', $annee)
        //->whereMonth('ventes.created_at','like', '%'.$searchMois.'%')
        ->when(request()->has('searchMois'), function($q){
            $q->whereMonth('ventes.created_at', request('searchMois'));
        })
        ->when(request()->has('searchCommerciau'), function($q){
            $q->where('ventes.commercial_id', request('searchCommerciau'));
        })
        ->when(request()->has('searchPays'), function($q){
            $q->where('pays.libelle', request('searchPays'));
        })
        ->orderBy('ventes.montant', 'desc')->sum('ventes.montant');
         
       
        return view('suiviSortieTerrain.les_ventes', compact('ventess', 'mois', 'commercials','venteMontants', 'les_vente', 'les_vente_sum'));
    }
    
    
    public function les_ventes_mois_me()
    {
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::all();
         foreach($commercials as $commercial)
         {
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->orderBy('ventes.position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
            foreach($vente as $vente_mois)
                {
                    
                        array_push($ventess, $vente_mois);
                        
                    
                }
         }
         
         $moi = Commerciau::where('user_id', Auth::user()->id)->first();
         $les_vente_mois = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle', 
                        'pays.libelle as nom_pays', 'prospects.nom_entreprise')
                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                        ->join('pays', 'commerciaus.pays_id', 'pays.id')
                        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
                        ->where('ventes.commercial_id', $moi->id)
                        ->whereYear('ventes.created_at', $annee)
                        ->whereMonth('ventes.created_at', $mois)
                        ->orderBy('ventes.montant', 'desc')->get();
        
        $les_vente_sum_mois = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle',
                        'pays.libelle as nom_pays', 'prospects.nom_entreprise')
                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                        ->join('pays', 'commerciaus.pays_id', 'pays.id')
                        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
                        ->where('ventes.commercial_id', $moi->id)
                        ->whereMonth('ventes.created_at', $mois)
                        ->whereYear('ventes.created_at', $annee)
                        
                        ->orderBy('ventes.montant', 'desc')->sum('ventes.montant');
         
       
        return view('suiviSortieTerrain.les_ventes_mois_me', compact('ventess', 'mois', 'commercials','venteMontants', 'les_vente_mois', 'les_vente_sum_mois'));
    }
    
     public function les_ventes_mois()
    {
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::all();
         foreach($commercials as $commercial)
         {
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->orderBy('ventes.position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
            foreach($vente as $vente_mois)
                {
                    
                        array_push($ventess, $vente_mois);
                        
                    
                }
         } 
         
        $les_vente_mois = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle',
                                        'pays.libelle as nom_pays', 'prospects.nom_entreprise')
                                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                                        ->join('pays', 'commerciaus.pays_id', 'pays.id')
                                        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
                                        //->where('commercial_id', $commercial->id)
                                        ->whereYear('ventes.created_at', $annee)
                                        ->whereMonth('ventes.created_at', $mois)
                                        ->orderBy('ventes.montant', 'desc')->get();
         
        $les_vente_sum_mois = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle', 
                                       'pays.libelle as nom_pays', 'prospects.nom_entreprise')
                                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                                        ->join('pays', 'commerciaus.pays_id', 'pays.id')
                                        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
                                        //->where('commercial_id', $commercial->id)
                                        ->whereYear('ventes.created_at', $annee)
                                        ->whereMonth('ventes.created_at', $mois)
                                        ->orderBy('ventes.montant', 'desc')->sum('ventes.montant');
       
        return view('suiviSortieTerrain.les_ventes_mois', compact('ventess', 'mois', 'commercials','venteMontants', 'les_vente_mois', 'les_vente_sum_mois'));
    }
    
    
    public function les_ventes_moisFiltre(Request $request)
    {
        $searchMois = $request->get('searchMois');
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::all();
        foreach($commercials as $commercial)
         {
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at','like', '%'.$searchMois.'%')->OrderBy('position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at','like', '%'.$searchMois.'%')->sum('montant');
        $venteMontants += $venteMontantss;
         
            foreach($vente as $vente_mois)
                {
                    
                        array_push($ventess, $vente_mois);
                        
                    
                }
         }
         
        $les_vente_mois = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle',
                                        'pays.libelle as nom_pays', 'prospects.nom_entreprise')
                                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                                        ->join('pays', 'commerciaus.pays_id', 'pays.id')
                                        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
                                        //->where('commercial_id', $commercial->id)
                                        ->whereYear('ventes.created_at', $annee)
                                        ->whereMonth('ventes.created_at', $mois)
                                        ->when(request()->has('searchMois'), function($q){
                                                $q->whereMonth('ventes.created_at', request('searchMois'));
                                            })
                                            ->when(request()->has('searchCommerciau'), function($q){
                                                $q->where('ventes.commercial_id', request('searchCommerciau'));
                                            })
                                            ->when(request()->has('searchPays'), function($q){
                                                $q->where('pays.libelle', request('searchPays'));
                                            })
                                        ->orderBy('ventes.montant', 'desc')->get();
         
        $les_vente_sum_mois = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle',
                                        'pays.libelle as nom_pays', 'prospects.nom_entreprise')
                                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                                        ->join('pays', 'commerciaus.pays_id', 'pays.id')
                                        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
                                        //->where('commercial_id', $commercial->id)
                                        ->whereYear('ventes.created_at', $annee)
                                        ->whereMonth('ventes.created_at', $mois)
                                         ->when(request()->has('searchMois'), function($q){
                                                $q->whereMonth('ventes.created_at', request('searchMois'));
                                            })
                                            ->when(request()->has('searchCommerciau'), function($q){
                                                $q->where('ventes.commercial_id', request('searchCommerciau'));
                                            })
                                            ->when(request()->has('searchPays'), function($q){
                                                $q->where('pays.libelle', request('searchPays'));
                                            })
                                        ->orderBy('ventes.montant', 'desc')->sum('ventes.montant');
       
        return view('suiviSortieTerrain.les_ventes_mois', compact('ventess', 'mois', 'commercials','venteMontants', 'les_vente_mois', 'les_vente_sum_mois'));
    }
    
     public function les_ventes_mois_pass()
    {
        $moispass = (date('m') - 1);
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::all();
         foreach($commercials as $commercial)
         {
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $moispass)->whereYear('created_at', $annee)->orderBy('ventes.position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $moispass)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
            foreach($vente as $vente_mois)
                {
                    
                        array_push($ventess, $vente_mois);
                        
                    
                }
         }
         
         
        $les_vente_mois_pass = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle',
                                        'pays.libelle as nom_pays', 'prospects.nom_entreprise')
                                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                                        ->join('pays', 'commerciaus.pays_id', 'pays.id')
                                        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
                                        //->where('commercial_id', $commercial->id)
                                        ->whereYear('ventes.created_at', $annee)
                                        ->whereMonth('ventes.created_at', $moispass)
                                        ->orderBy('ventes.montant', 'desc')->get();
         
        $les_vente_sum_mois_pass = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle',
                                        'pays.libelle as nom_pays', 'prospects.nom_entreprise')
                                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                                        ->join('pays', 'commerciaus.pays_id', 'pays.id')
                                        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
                                        //->where('commercial_id', $commercial->id)
                                        ->whereYear('ventes.created_at', $annee)
                                        ->whereMonth('ventes.created_at', $moispass)
                                        ->orderBy('ventes.montant', 'desc')->sum('ventes.montant');
       
        return view('suiviSortieTerrain.les_ventes_mois_pass', compact('ventess', 'mois', 'commercials','venteMontants', 'les_vente_mois_pass', 'les_vente_sum_mois_pass'));
    }
    
    
    public function les_ventes_mois_passFiltre(Request $request)
    {
        $searchMois = $request->get('searchMois');
        $moispass = (date('m') - 1);
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::all();
        foreach($commercials as $commercial)
         {
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at','like', '%'.$searchMois.'%')->OrderBy('position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at','like', '%'.$searchMois.'%')->sum('montant');
        $venteMontants += $venteMontantss;
         
            foreach($vente as $vente_mois)
                {
                    
                        array_push($ventess, $vente_mois);
                        
                    
                }
         }
         
        $les_vente_mois_pass = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle',
                                        'pays.libelle as nom_pays', 'prospects.nom_entreprise')
                                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                                        ->join('pays', 'commerciaus.pays_id', 'pays.id')
                                        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
                                        //->where('commercial_id', $commercial->id)
                                        ->whereYear('ventes.created_at', $annee)
                                         ->whereMonth('ventes.created_at', $moispass)
                                        ->when(request()->has('searchMois'), function($q){
                                                $q->whereMonth('ventes.created_at', request('searchMois'));
                                            })
                                            ->when(request()->has('searchCommerciau'), function($q){
                                                $q->where('ventes.commercial_id', request('searchCommerciau'));
                                            })
                                            ->when(request()->has('searchPays'), function($q){
                                                $q->where('pays.libelle', request('searchPays'));
                                            })
                                        ->orderBy('ventes.montant', 'desc')->get();
         
        $les_vente_sum_mois_pass = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle',
                                        'pays.libelle as nom_pays', 'prospects.nom_entreprise')
                                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                                        ->join('pays', 'commerciaus.pays_id', 'pays.id')
                                        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
                                        //->where('commercial_id', $commercial->id)
                                        ->whereYear('ventes.created_at', $annee)
                                         ->whereMonth('ventes.created_at', $moispass)
                                        ->when(request()->has('searchMois'), function($q){
                                                $q->whereMonth('ventes.created_at', request('searchMois'));
                                            })
                                            ->when(request()->has('searchCommerciau'), function($q){
                                                $q->where('ventes.commercial_id', request('searchCommerciau'));
                                            })
                                            ->when(request()->has('searchPays'), function($q){
                                                $q->where('pays.libelle', request('searchPays'));
                                            })
                                        ->orderBy('ventes.montant', 'desc')->sum('ventes.montant');
         
       
        return view('suiviSortieTerrain.les_ventes_mois_pass', compact('ventess', 'mois', 'commercials','venteMontants', 'les_vente_mois_pass', 'les_vente_sum_mois_pass'));
    }
    
    
    
     public function les_ventes_mois_tri_me()
    {
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::all();
         foreach($commercials as $commercial)
         {
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->orderBy('ventes.position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
            foreach($vente as $vente_mois)
                {
                    
                        array_push($ventess, $vente_mois);
                        
                    
                }
         }
         
         $moi = Commerciau::where('user_id', Auth::user()->id)->first();
         $les_ventes_mois_tri = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle', 
                        'pays.libelle as nom_pays', 'prospects.nom_entreprise')
                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                        ->join('pays', 'commerciaus.pays_id', 'pays.id')
                        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
                        ->where('ventes.commercial_id', $moi->id)
                        ->whereYear('ventes.created_at', $annee)
                        ->orderBy('ventes.montant', 'desc')->get();
        
        $les_vente_sum_mois_tri = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle',
                        'pays.libelle as nom_pays', 'prospects.nom_entreprise')
                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                        ->join('pays', 'commerciaus.pays_id', 'pays.id')
                        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
                        ->where('ventes.commercial_id', $moi->id)
                        ->whereYear('ventes.created_at', $annee)
                        
                        ->orderBy('ventes.montant', 'desc')->sum('ventes.montant');
         
       
        return view('suiviSortieTerrain.les_ventes_mois_tri_me', compact('ventess', 'mois', 'commercials','venteMontants', 'les_ventes_mois_tri', 'les_vente_sum_mois_tri'));
    }
    
     public function les_ventes_mois_tri()
    {
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::all();
         foreach($commercials as $commercial)
         {
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->orderBy('ventes.position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
            foreach($vente as $vente_mois)
                {
                    
                        array_push($ventess, $vente_mois);
                        
                    
                }
         }
         
         $les_ventes_mois_tri = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle', 
                        'pays.libelle as nom_pays', 'prospects.nom_entreprise')
                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                        ->join('pays', 'commerciaus.pays_id', 'pays.id')
                        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
                        //->where('commercial_id', $commercial->id)
                        ->whereYear('ventes.created_at', $annee)
                        ->orderBy('ventes.montant', 'desc')->get();
        
        $les_vente_sum_mois_tri = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle',
                        'pays.libelle as nom_pays', 'prospects.nom_entreprise')
                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                        ->join('pays', 'commerciaus.pays_id', 'pays.id')
                        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
                        //->where('commercial_id', $commercial->id)
                        ->whereYear('ventes.created_at', $annee)
                        
                        ->orderBy('ventes.montant', 'desc')->sum('ventes.montant');
         
       
        return view('suiviSortieTerrain.les_ventes_mois_tri', compact('ventess', 'mois', 'commercials','venteMontants', 'les_ventes_mois_tri', 'les_vente_sum_mois_tri'));
    }
    
     public function les_ventes_mois_triFiltre()
    {
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::all();
         foreach($commercials as $commercial)
         {
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->orderBy('ventes.position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
            foreach($vente as $vente_mois)
                {
                    
                        array_push($ventess, $vente_mois);
                        
                    
                }
         }
         
         $les_ventes_mois_tri = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle', 
                        'pays.libelle as nom_pays', 'prospects.nom_entreprise')
                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                        ->join('pays', 'commerciaus.pays_id', 'pays.id')
                        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
                        //->where('commercial_id', $commercial->id)
                        ->whereYear('ventes.created_at', $annee)
                        //->whereMonth('ventes.created_at','like', '%'.$searchMois.'%')
                        
                        ->when(request()->has('searchMois'), function($q){
                            $q->whereMonth('ventes.created_at', request('searchMois'));
                        })
                        ->when(request()->has('searchCommerciau'), function($q){
                            $q->where('ventes.commercial_id', request('searchCommerciau'));
                        })
                        ->when(request()->has('searchPays'), function($q){
                            $q->where('pays.libelle', request('searchPays'));
                        })
                        ->orderBy('ventes.montant', 'desc')->get();
        
        $les_vente_sum_mois_tri = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle',
                        'pays.libelle as nom_pays', 'prospects.nom_entreprise')
                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                        ->join('pays', 'commerciaus.pays_id', 'pays.id')
                        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
                        //->where('commercial_id', $commercial->id)
                        ->whereYear('ventes.created_at', $annee)
                        //->whereMonth('ventes.created_at','like', '%'.$searchMois.'%')
                        ->when(request()->has('searchMois'), function($q){
                            $q->whereMonth('ventes.created_at', request('searchMois'));
                        })
                        ->when(request()->has('searchCommerciau'), function($q){
                            $q->where('ventes.commercial_id', request('searchCommerciau'));
                        })
                        ->when(request()->has('searchPays'), function($q){
                            $q->where('pays.libelle', request('searchPays'));
                        })
                        ->orderBy('ventes.montant', 'desc')->sum('ventes.montant');

       
        return view('suiviSortieTerrain.les_ventes_mois_tri', compact('ventess', 'mois', 'commercials','venteMontants', 'les_ventes_mois_tri', 'les_vente_sum_mois_tri'));
    }
    
      public function les_ventes_mois_tri_dernier()
    {
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::all();
         foreach($commercials as $commercial)
         {
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->orderBy('position', 'asc')->get();
        $venteMontantss = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
            foreach($vente as $vente_mois)
                {
                    
                        array_push($ventess, $vente_mois);
                        
                    
                }
         }
         
        $les_ventes_mois_tri_dernier = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle', 
                        'pays.libelle as nom_pays', 'prospects.nom_entreprise')
                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                        ->join('pays', 'commerciaus.pays_id', 'pays.id')
                        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
                        //->where('commercial_id', $commercial->id)
                        ->whereYear('ventes.created_at', $annee)
                        ->orderBy('ventes.montant', 'desc')->get();
        
        $les_vente_sum_mois_tri_dernier = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle',
                        'pays.libelle as nom_pays', 'prospects.nom_entreprise')
                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                        ->join('pays', 'commerciaus.pays_id', 'pays.id')
                        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
                        //->where('commercial_id', $commercial->id)
                        ->whereYear('ventes.created_at', $annee)
                        
                        ->orderBy('ventes.montant', 'desc')->sum('ventes.montant');
       
        return view('suiviSortieTerrain.les_ventes_mois_tri_dernier', compact('ventess', 'mois', 'commercials','venteMontants', 'les_ventes_mois_tri_dernier', 'les_vente_sum_mois_tri_dernier'));
    }
    
      public function les_ventes_mois_tri_dernierFiltre()
    {
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::all();
         foreach($commercials as $commercial)
         {
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->orderBy('position', 'asc')->get();
        $venteMontantss = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
            foreach($vente as $vente_mois)
                {
                    
                        array_push($ventess, $vente_mois);
                        
                    
                }
         }
         
        $les_ventes_mois_tri_dernier = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle', 
                        'pays.libelle as nom_pays', 'prospects.nom_entreprise')
                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                        ->join('pays', 'commerciaus.pays_id', 'pays.id')
                        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
                        //->where('commercial_id', $commercial->id)
                        ->whereYear('ventes.created_at', $annee)
                        //->whereMonth('ventes.created_at','like', '%'.$searchMois.'%')
                        
                        ->when(request()->has('searchMois'), function($q){
                            $q->whereMonth('ventes.created_at', request('searchMois'));
                        })
                        ->when(request()->has('searchCommerciau'), function($q){
                            $q->where('ventes.commercial_id', request('searchCommerciau'));
                        })
                        ->when(request()->has('searchPays'), function($q){
                            $q->where('pays.libelle', request('searchPays'));
                        })
                        ->orderBy('ventes.montant', 'desc')->get();
        
        $les_vente_sum_mois_tri_dernier = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle',
                        'pays.libelle as nom_pays', 'prospects.nom_entreprise')
                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                        ->join('pays', 'commerciaus.pays_id', 'pays.id')
                        ->join('prospects', 'opportunites.prospect_id', 'prospects.id')
                        //->where('commercial_id', $commercial->id)
                        ->whereYear('ventes.created_at', $annee)
                        //->whereMonth('ventes.created_at','like', '%'.$searchMois.'%')
                        ->when(request()->has('searchMois'), function($q){
                            $q->whereMonth('ventes.created_at', request('searchMois'));
                        })
                        ->when(request()->has('searchCommerciau'), function($q){
                            $q->where('ventes.commercial_id', request('searchCommerciau'));
                        })
                        ->when(request()->has('searchPays'), function($q){
                            $q->where('pays.libelle', request('searchPays'));
                        })
                        ->orderBy('ventes.montant', 'desc')->sum('ventes.montant');

        return view('suiviSortieTerrain.les_ventes_mois_tri_dernier', compact('ventess', 'mois', 'commercials','venteMontants', 'les_ventes_mois_tri_dernier', 'les_vente_sum_mois_tri_dernier'));
    }
     
     public function ventes_sn_tri()
    {
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::where('pays_id', 1)->get();
         foreach($commercials as $commercial)
         {
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->orderBy('ventes.position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
            foreach($vente as $vente_mois)
                {
                    
                        array_push($ventess, $vente_mois);
                        
                    
                }
         }
       
        return view('suiviSortieTerrain.ventes_sn_tri', compact('ventess', 'mois', 'commercials','venteMontants'));
    }
    
      public function ventes_sn_tri_dernier()
    {
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::where('pays_id', 1)->get();
         foreach($commercials as $commercial)
         {
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->orderBy('position', 'asc')->get();
        $venteMontantss = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
            foreach($vente as $vente_mois)
                {
                    
                        array_push($ventess, $vente_mois);
                        
                    
                }
         }
       
        return view('suiviSortieTerrain.ventes_sn_tri_dernier', compact('ventess', 'mois', 'commercials','venteMontants'));
    }
     
     public function ventes_sn()
    {
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::where('pays_id', 1)->get();
         foreach($commercials as $commercial)
         {
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->orderBy('ventes.position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
            foreach($vente as $vente_mois)
                {
                    
                        array_push($ventess, $vente_mois);
                        
                    
                }
         }
       
        return view('suiviSortieTerrain.ventes_sn', compact('ventess', 'mois', 'commercials','venteMontants'));
    }
    
      public function tous_ventes()
    {
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;

        $ventess = DB::table('ventes')->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->get();
$venteMontantss = DB::table('ventes')->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
        return view('suiviSortieTerrain.tous_ventes', compact('ventess', 'mois', 'venteMontants'));
    }

   public function mesventes_tri()
    {
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        
         $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $ventess = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->orderBy('ventes.position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
       
        return view('suiviSortieTerrain.mesventes_tri', compact('ventess', 'mois','venteMontants'));
    }
      public function ventes_tri()
    {
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        
        
        $ventess = DB::table('ventes')->whereYear('created_at', $annee)->orderBy('ventes.position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
       
        return view('suiviSortieTerrain.ventes_tri', compact('ventess', 'mois','venteMontants'));
    }
    
    public function ventes_snFiltre(Request $request)
    {
        $searchMois = $request->get('searchMois');
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::where('pays_id', 1)->get();
         foreach($commercials as $commercial)
         {
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at','like', '%'.$searchMois.'%')->OrderBy('position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at','like', '%'.$searchMois.'%')->sum('montant');
        $venteMontants += $venteMontantss;
         
            foreach($vente as $vente_mois)
                {
                    
                        array_push($ventess, $vente_mois);
                        
                    
                }
         }
       
        return view('suiviSortieTerrain.ventes_sn', compact('ventess', 'mois', 'commercials','venteMontants'));
    }
     
     public function ventes_bfFiltre(Request $request)
    {
        $searchMois = $request->get('searchMois');
        $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::where('pays_id', 5)->get();
         foreach($commercials as $commercial)
         {
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at','like', '%'.$searchMois.'%')->OrderBy('position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at','like', '%'.$searchMois.'%')->sum('montant');
        $venteMontants += $venteMontantss;
         
            foreach($vente as $vente_mois)
                {
                    
                        array_push($ventess, $vente_mois);
                        
                    
                }
         }
       
        return view('suiviSortieTerrain.ventes_bf', compact('ventess', 'mois', 'commercials','venteMontants'));
    }
     
     public function ventes_bf()
    {
         $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::where('pays_id', 5)->get();
         foreach($commercials as $commercial)
         {
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->OrderBy('position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
            foreach($vente as $vente_mois)
                {
                    
                        array_push($ventess, $vente_mois);
                        
                    
                }
         }
       
        return view('suiviSortieTerrain.ventes_bf', compact('ventess', 'mois', 'commercials','venteMontants'));
    }
     
      public function ventes_bf_tri()
    {
         $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::where('pays_id', 5)->get();
         foreach($commercials as $commercial)
         {
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->OrderBy('position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
            foreach($vente as $vente_mois)
                {
                    
                        array_push($ventess, $vente_mois);
                        
                    
                }
         }
       
        return view('suiviSortieTerrain.ventes_bf_tri', compact('ventess', 'mois', 'commercials','venteMontants'));
    }
    
       public function ventes_bf_tri_dernier()
    {
         $mois = date('m');
        $annee = date('Y'); 
        $ventess = array();
        $venteMontants = 0;
        $commercials = Commerciau::where('pays_id', 5)->get();
         foreach($commercials as $commercial)
         {
        $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->OrderBy('position', 'desc')->get();
        $venteMontantss = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->sum('montant');
        $venteMontants += $venteMontantss;
         
            foreach($vente as $vente_mois)
                {
                    
                        array_push($ventess, $vente_mois);
                        
                    
                }
         }
       
        return view('suiviSortieTerrain.ventes_bf_tri_dernier', compact('ventess', 'mois', 'commercials','venteMontants'));
    }
     
     
     
     
         public function op_edit($id)
    {
        $commerciale = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
        $opportunite = Opportunite::find($id);
        $commercial = DB::table('commerciaus')->orderBy('prenom')->get();
        $prospect = DB::table('prospects')->where('commercial_id', $commerciale->id)->orderBy('nom_entreprise')->get();
        $origines = DB::table('origines')->orderBy('libelle')->get();
        return view('suiviSortieTerrain.edit_opportunite',compact('opportunite','commercial', 'prospect', 'origines'));

    }

  public function appel_offre_edit($id)
    {
        $commerciale = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
        $opportunite = Opportunite::find($id);
        $commercial = DB::table('commerciaus')->orderBy('prenom')->get();
        $prospect = DB::table('prospects')->where('commercial_id', $commerciale->id)->orderBy('nom_entreprise')->get();
        $origines = DB::table('origines')->orderBy('libelle')->get();
        return view('suiviSortieTerrain.edit_appel_offre',compact('opportunite','commercial', 'prospect', 'origines'));

    }
    
      public function opportunite_prospectCreate($id)
    {
        $commercial = DB::table('commerciaus')->orderBy('prenom')->get();
        $opportunites = Opportunite::find($id);
        return view('suiviSortieTerrain.ajout_action_op',compact('opportunites','commercial'));

    }
    
    public function opportunite_prospectStore(Request $request)
    {
        //
                $message = "Action ajoutée avec succès";
                $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                
                $action = new ActionCommercial ;
                $action->libelle = $request->get('libelle'); 
                $action->opportunite_id = $request->get('opportunite_id');
                // $action->commercial_backup = $request->get('commercial_backup');
                $action->commercial_id = $request->get('commercial_id');
                $action->deadline = $request->get('deadline');
                $action->priorite = $request->get('priorite');
                $action->save();
                
                $comm = DB::table('commerciaus')->where('id', $action->commercial_id)->first();
                DB::table('action_commerciales')->where('id', $action->id)->update(['superieur_id' => $comm->superieur_id] );
                
                $action_op = DB::table('action_commerciales')->orderBy('id', 'desc')->first();
                $commer = DB::table('commerciaus')->where('id', $action_op->commercial_id)->where('id','!=', $commercial->id)->orderBy('id', 'desc')->first();
                if($action_op->commercial_id != $commercial->id)
                {
                 Mail::to($commer->email)->send(new MailCommercialAcionOp($commer, $action_op, $commercial));
                }
                
                return back()->with(['message' => $message]);
    }
    
    public function appelO_VenteCreate($id)
    {
        $opportunite = Opportunite::find($id);
        return view('suiviSortieTerrain.ajout_vente_appelO',compact('opportunite'));

    }
    
     public function appelO_update_archiver(Request $request, $id)
    {
        //
            $fini = "Opportunité cloturée avec succès";
            $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();

            $opportunite = Opportunite::findOrFail($id);
            $opportunite->archiver = $request->get('archiver');
            $opportunite->raison_archive = $request->get('raison_archive');
            $opportunite->deadline_desarchiver = $request->get('deadline_desarchiver');
            $opportunite->raison_annuler = $request->get('raison_annuler');
            $opportunite->update();
                
                $pourCent = " ";
                
                 $messageBravo = " ";
                $messageAttention = " ";
                $msBra = " ";
            if($opportunite->archiver == 2){
                        $vente = new Vente;
                        $vente->montant = $request->get('montant'); 
                        $vente->montant_debut = $request->get('montant_debut'); 
                        $vente->opportunite_id = $opportunite->id;
                        $vente->commercial_id = $opportunite->commercial_id;
                        $vente->save();
                        
                        DB::table('opportunites')->where('id', $opportunite->id)->update(['statut' => 16]);
                        
                        $ce_mois = date('m');
                        $som_vente_mois = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $ce_mois)->sum('montant');
                        
                        $stock = DB::table('stock_journalieres')->where('commercial_id', $commercial->id)->get();
                        
                    DB::table('stock_journalieres')->whereNotIn('commercial_id', [$commercial->id])->insert(['montant_vente' => $vente->montant, 'commercial_id' => $vente->commercial_id,  'created_at' => $vente->created_at,  'updated_at' => $vente->updated_at]);
                    DB::table('stock_journalieres')->where('commercial_id', $commercial->id)->whereMonth('created_at', $ce_mois)->update(['montant_vente' => $som_vente_mois]);

                        $stockDer = DB::table('stock_journalieres')->where('commercial_id', $commercial->id)->orderBy('id', 'desc')->first();
                                $stockDerMois = date('m', strtotime($stockDer->created_at));
                                
                                if($stockDerMois != $ce_mois)
                                {
                                    DB::table('stock_journalieres')->where('commercial_id', $commercial->id)->insert(['montant_vente' => $vente->montant, 'commercial_id' => $vente->commercial_id,  'created_at' => $vente->created_at,  'updated_at' => $vente->updated_at]);
                                
                                }
                            
                
                        
                
                        if($vente->montant > $vente->montant_debut)
                        {
                        $messageBravo = "bravo.gif";
                       
                        
                        }
                       else{
                            
                            $messageAttention = "Attention";
                        }
                 
                $com = $commercial->commission_p;
                $commission = ($vente->montant) * ($com);
                
                $objectif = $commercial->objectif_mois;


                DB::table('commissions')->insert(['commission' => $commission, 'opportunite_id' => $vente->opportunite_id, 'commercial_id' => $vente->commercial_id,  'created_at' => $vente->created_at,  'updated_at' => $vente->updated_at]);

            }
            else{
                $mess = 'bloquer';
            }
            
                      
                return redirect('/opportunites')->with(['fini' => $fini, 'messageBravo' => $messageBravo, 'messageAttention' => $messageAttention, 'msBra' => $msBra]);
    }
    public function opportunite_prospect_VenteCreate($id)
    {
        $opportunite = Opportunite::find($id);
        return view('suiviSortieTerrain.ajout_vente_op_prospect',compact('opportunite'));

    }
    
     public function opp_prospect_update_archiver(Request $request, $id)
    {
        //
            $fini = "Opportunité cloturée avec succès";
            $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();

            $opportunite = Opportunite::findOrFail($id);
            $opportunite->archiver = $request->get('archiver');
            $opportunite->raison_archive = $request->get('raison_archive');
            $opportunite->deadline_desarchiver = $request->get('deadline_desarchiver');
            $opportunite->raison_annuler = $request->get('raison_annuler');
            $opportunite->update();
                
                $pourCent = " ";
                
                 $messageBravo = " ";
                $messageAttention = " ";
                $msBra = " ";
            if($opportunite->archiver == 2){
                        $vente = new Vente;
                        $vente->montant = $request->get('montant'); 
                        $vente->montant_debut = $request->get('montant_debut'); 
                        $vente->opportunite_id = $opportunite->id;
                        $vente->commercial_id = $opportunite->commercial_id;
                        $vente->save();
                        
                        DB::table('opportunites')->where('id', $opportunite->id)->update(['statut' => 16]);
                        
                        $ce_mois = date('m');
                        $som_vente_mois = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $ce_mois)->sum('montant');
                        
                        $stock = DB::table('stock_journalieres')->where('commercial_id', $commercial->id)->get();
                
                    DB::table('stock_journalieres')->whereNotIn('commercial_id', [$commercial->id])->insert(['montant_vente' => $vente->montant, 'commercial_id' => $vente->commercial_id,  'created_at' => $vente->created_at,  'updated_at' => $vente->updated_at]);
                    DB::table('stock_journalieres')->where('commercial_id', $commercial->id)->whereMonth('created_at', $ce_mois)->update(['montant_vente' => $som_vente_mois]);

                        $stockDer = DB::table('stock_journalieres')->where('commercial_id', $commercial->id)->orderBy('id', 'desc')->first();
                                $stockDerMois = date('m', strtotime($stockDer->created_at));
                                
                                if($stockDerMois != $ce_mois)
                                {
                                    DB::table('stock_journalieres')->where('commercial_id', $commercial->id)->insert(['montant_vente' => $vente->montant, 'commercial_id' => $vente->commercial_id,  'created_at' => $vente->created_at,  'updated_at' => $vente->updated_at]);
                                
                                }
                        if($vente->montant > $vente->montant_debut)
                        {
                        $messageBravo = "bravo.gif";
                       
                        
                        }
                       else{
                            
                            $messageAttention = "Attention";
                        }
                 
                $com = $commercial->commission_p;
                $commission = ($vente->montant) * ($com);
                
                $objectif = $commercial->objectif_mois;


                DB::table('commissions')->insert(['commission' => $commission, 'opportunite_id' => $vente->opportunite_id, 'commercial_id' => $vente->commercial_id,  'created_at' => $vente->created_at,  'updated_at' => $vente->updated_at]);

            }
            else{
                $mess = 'bloquer';
            }
              
                return redirect()->route('opportunite_prospect.lister', $opportunite->prospect_id)->with(['fini' => $fini, 'messageBravo' => $messageBravo, 'messageAttention' => $messageAttention, 'msBra' => $msBra]);
    }
    
     public function opportunite_ajoutDemo($id)
    {
        $opportunite = Opportunite::find($id);
        return view('suiviSortieTerrain.ajout_demo',compact('opportunite'));

    }
    
    public function opportunite_ajoutDemoStore(Request $request)
    {
        //
                $message = "Démo ajoutée avec succès";
                $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                
                $demo = new Demo ;
                $demo->libelle = $request->get('libelle');
                $demo->prospect_id = $request->get('prospect_id'); 
                $demo->opportunite_id = $request->get('opportunite_id'); 
                $demo->commercial_id = $commercial->id;
                $demo->superieur_id = $commercial->superieur_id;
                $demo->commentaire = $request->get('commentaire');
                $demo->personne = $request->get('personne');
                $demo->date = $request->get('date');
                $demo->save();
                
                $action = new ActionCommercial;
                $action->libelle = $demo->libelle;
                $action->opportunite_id = $demo->opportunite_id;
                $action->prospect_id = $demo->prospect_id;
                $action->commercial_id = $demo->commercial_id;
                $action->superieur_id = $demo->superieur_id;
                $action->priorite = 1;
                $action->deadline = $demo->date;
                $action->type = $request->type;
                $action->save();
                
                return redirect('/suivi_opportunites')->with(['message' => $message]);
    }
    
    
     public function opportunite_ajoutUpdate($id)
    {
        $opportunite = Opportunite::find($id);
        return view('suiviSortieTerrain.ajout_update',compact('opportunite'));

    }
    
    public function opportunite_ajoutUpdateStore(Request $request)
    {
        //
                $message = "Update ajoutée avec succès";
                $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                
                $update_opp = new Update_opp ;
                $update_opp->prospect_id = $request->get('prospect_id'); 
                $update_opp->opportunite_id = $request->get('opportunite_id'); 
                $update_opp->commercial_id = $commercial->id;
                $update_opp->superieur_id = $commercial->superieur_id;
                $update_opp->libelle = $request->get('libelle');
                $update_opp->commentaire = $request->get('commentaire');
                $update_opp->personne = $request->get('personne');
                $update_opp->date = $request->get('date');
                $update_opp->save();
                
                $action = new ActionCommercial;
                $action->libelle = $update_opp->libelle;
                $action->opportunite_id = $update_opp->opportunite_id;
                $action->prospect_id = $update_opp->prospect_id;
                $action->commercial_id = $update_opp->commercial_id;
                 $action->superieur_id = $update_opp->superieur_id;
                $action->priorite = 1;
                $action->deadline = $update_opp->date;
                $action->type = $request->type;
                $action->update_id = $update_opp->id;
                $action->save();
                
                return redirect('/suivi_opportunites')->with(['message' => $message]);
    }
    
    
    public function opportunite_VenteCreate($id)
    {
        $opportunite = Opportunite::find($id);
        return view('suiviSortieTerrain.ajout_vente',compact('opportunite'));

    }
    
    public function opportunite_VenteStore(Request $request)
    {
        //
                $fini = "Vente ajoutée avec succès";
                $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                
                $vente = new Vente ;
                $vente->montant = $request->get('montant'); 
                $vente->opportunite_id = $request->get('opportunite_id'); 
                // $vente->commercial_id = $commercial->id;
                $vente->save();
                
                $commission = ($vente->montant) * (0.03);
                
                DB::table('commissions')->insert(['commission' => $commission, 'opportunite_id' => $vente->opportunite_id, 'commercial_id' => $vente->commercial_id,  'created_at' => $vente->created_at,  'updated_at' => $vente->updated_at]);
                
                return back()->with(['message' => $message]);
    }
    
  
    
    public function update_archiver(Request $request, $id)
    {
        //
            $fini = "Opportunité cloturée avec succès";
            $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();

            $opportunite = Opportunite::findOrFail($id);
            $opportunite->archiver = $request->get('archiver');
            $opportunite->raison_archive = $request->get('raison_archive');
            $opportunite->raison_abandonner = $request->get('raison_abandonner');
            $opportunite->deadline_desarchiver = $request->get('deadline_desarchiver');
            $opportunite->raison_annuler = $request->get('raison_annuler');
            $opportunite->update();
                
                $pourCent = " ";
                $msBra = " ";
                $msAten = " ";
                 $messageBravo = " ";
                $messageAttention = " ";
                $msBra = " ";
            if($opportunite->archiver == 2){
                
                
                        $vente = new Vente;
                        $vente->montant = $request->get('montant'); 
                        $vente->montant_debut = $request->get('montant_debut'); 
                        $vente->domaine_id = $request->get('domaine_id'); 
                        $vente->opportunite_id = $opportunite->id;
                        $vente->commercial_id = $opportunite->commercial_id;
                        $vente->save();
                        
                        DB::table('opportunites')->where('id', $opportunite->id)->update(['statut' => 16]);
                        
                        $ce_mois = date('m');
                        $som_vente_mois = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $ce_mois)->sum('montant');
                        
                        //$mois_creer = date('m', strtotime($vente->created_at));
                        $stock = DB::table('stock_journalieres')->where('commercial_id', $commercial->id)->get();
                        
                Mail::to('ventes@illimitis.com')->send(new MailVente($opportunite,$commercial,$vente));
                       /* if(count($stock) > 0){
                            foreach($stock as $stock_p)
                            {
                                $mois_creerVente = date('m', strtotime($stock_p->created_at));
                                    if($mois_creerVente = $ce_mois)
                                    {
                                        DB::table('stock_journalieres')->where('commercial_id', $commercial->id)->whereMonth('created_at', $ce_mois)->update(['montant_vente' => $som_vente_mois]);
                                    }
                                    
                            }
                }*/
                
                        
                        if($vente->montant > $vente->montant_debut)
                        {
                          $pourCent = ($vente->montant*100)/$vente->montant_debut;
                          $msBra = "Bravo! Le CA final est de"." ".intval($pourCent).'%'." "."par rapport à l’objectif de vente";  
                        }
                        
                        if($vente->montant < $vente->montant_debut)
                        {
                          $pourCenta = ($vente->montant*100)/$vente->montant_debut;
                          $msAten = "Attention! Le CA final est de"." ".intval($pourCenta).'%'." "."par rapport à l’objectif de vente";  
                        }
                
                    DB::table('stock_journalieres')->whereNotIn('commercial_id', [$commercial->id])->insert(['montant_vente' => $vente->montant, 'commercial_id' => $vente->commercial_id,  'created_at' => $vente->created_at,  'updated_at' => $vente->updated_at]);
                    DB::table('stock_journalieres')->where('commercial_id', $commercial->id)->whereMonth('created_at', $ce_mois)->update(['montant_vente' => $som_vente_mois]);

                        $stockDer = DB::table('stock_journalieres')->where('commercial_id', $commercial->id)->orderBy('id', 'desc')->first();
                                $stockDerMois = date('m', strtotime($stockDer->created_at));
                                
                                if($stockDerMois != $ce_mois)
                                {
                                    DB::table('stock_journalieres')->where('commercial_id', $commercial->id)->insert(['montant_vente' => $vente->montant, 'commercial_id' => $vente->commercial_id,  'created_at' => $vente->created_at,  'updated_at' => $vente->updated_at]);
                                
                                }
                            
                
                        
                
                        //$pourCent = ($vente->montant*100)/$vente->montant_debut;
                        if($vente->montant > $vente->montant_debut)
                        {
                        $messageBravo = "bravo.gif";
                       
                        
                        }
                       else{
                            
                            $messageAttention = "Attention";
                        }
                 
                // $type = DB::table('parametres')->where('commission', $commercial->commission_p)->first();
                $com = $commercial->commission_p;
                $commission = ($vente->montant) * ($com);
                
                $objectif = $commercial->objectif_mois;
                // $pourcentage = ($vente->montant) * (100) / ($objectif);
                

                DB::table('commissions')->insert(['commission' => $commission, 'opportunite_id' => $vente->opportunite_id, 'commercial_id' => $vente->commercial_id,  'created_at' => $vente->created_at,  'updated_at' => $vente->updated_at]);
                // DB::table('performance_commerciales')->insert(['pourcentage' => $pourcentage, 'commission_id' => $commission, 'opportunite_id' => $vente->opportunite_id, 'commercial_id' => $vente->commercial_id,  'created_at' => $vente->created_at,  'updated_at' => $vente->updated_at]);

            }
            else{
                $mess = 'bloquer';
            }
              
               
                  
                
                      
                return redirect('/suivi_opportunites')->with(['fini' => $fini, 'messageBravo' => $messageBravo, 'messageAttention' => $messageAttention, 'msBra' => $msBra, 'msAten' => $msAten]);
    }
     
              public function op_prospect_edit($id)
    {
        $commerciale = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
        $opportunite = Opportunite::find($id);
        $commercial = DB::table('commerciaus')->orderBy('prenom')->get();
        $prospect = DB::table('prospects')->where('commercial_id', $commerciale->id)->orderBy('nom_entreprise')->get();
        $origines = DB::table('origines')->orderBy('libelle')->get();
        return view('suiviSortieTerrain.edit_op_prospect',compact('opportunite','commercial', 'prospect', 'origines'));

    }
    public function op_prospect_update(Request $request, $id)
    {
        //
                $messages = "Opportunité mise à jour avec succès";
                $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                
                $opportunite = Opportunite::find($id);
                // $opportunite->probabilite = $request->get('probabilite');
                $opportunite->objectif_de_vente = $request->get('objectif_de_vente');
                $opportunite->prospect_id = $request->get('prospect_id');
                $opportunite->libelle = $request->get('libelle');
                $opportunite->origine_id = $request->get('origine_id');
                $opportunite->deadline = $request->get('deadline');
                $opportunite->notes = $request->get('notes');
                $opportunite->concurrence = $request->get('concurrence');
                $opportunite->commercial_id = $request->get('commercial_id');
                $opportunite->commercial_backup = $request->get('commercial_backup');
                $opportunite->update();
                
                return redirect('/lister_entreprises')->with(['messages' => $messages]);
    }
    
    
     public function appel_offre_update(Request $request, $id)
    {
        //
                $messages = "Opportunité mise à jour avec succès";
                $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                
                $opportunite = Opportunite::find($id);
                // $opportunite->probabilite = $request->get('probabilite');
                $opportunite->objectif_de_vente = $request->get('objectif_de_vente');
                $opportunite->prospect_id = $request->get('prospect_id');
                $opportunite->libelle = $request->get('libelle');
                $opportunite->origine_id = $request->get('origine_id');
                $opportunite->deadline = $request->get('deadline');
                $opportunite->notes = $request->get('notes');
                $opportunite->concurrence = $request->get('concurrence');
                $opportunite->commercial_id = $request->get('commercial_id');
                $opportunite->commercial_backup = $request->get('commercial_backup');
                $opportunite->update();
                
                $proba = DB::table('statut_opportunites')->where('id', $opportunite->statut)->first();
                
                DB::table('opportunites')->where('id', $opportunite->id)->update(['probabilite' => $proba->probabilite] );
                
                return redirect('/opportunites')->with(['messages' => $messages]);
    }
     
    public function op_update(Request $request, $id)
    {
        //
                $messages = "Opportunité mise à jour avec succès";
                $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                
                $opportunite = Opportunite::find($id);
                // $opportunite->probabilite = $request->get('probabilite');
                $opportunite->objectif_de_vente = $request->get('objectif_de_vente');
                $opportunite->prospect_id = $request->get('prospect_id');
                $opportunite->libelle = $request->get('libelle');
                $opportunite->origine_id = $request->get('origine_id');
                $opportunite->deadline = $request->get('deadline');
                $opportunite->notes = $request->get('notes');
                $opportunite->concurrence = $request->get('concurrence');
                $opportunite->commercial_id = $request->get('commercial_id');
                $opportunite->commercial_backup = $request->get('commercial_backup');
                $opportunite->update();
                
                return redirect('/suivi_opportunites')->with(['messages' => $messages]);
    }
     
      public function liste_contact()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $contacts = DB::table('contacts')->where('commercial_id', $commercial->id)->orderBy('prenom')->paginate(10);
        $opportunite = DB::table('opportunites')->where('commercial_id', $commercial->id)->get();
        $prospect = DB::table('prospects')->where('commercial_id', $commercial->id)->get();
        return view('suiviSortieTerrain.liste_contact', compact('contacts', 'opportunite', 'prospect', 'commercial'));
    }
    
       public function rapport_contact()
    {
        $commerciaux = Commerciau::all();
        $contacts = DB::table('contacts')->orderBy('prenom')->get();
        $stock_mensuelles = DB::table('stock_mensuelles')->get();
        return view('suiviSortieTerrain.rapport_contact', compact('stock_mensuelles','contacts', 'commerciaux'));
    }
    
      public function rapport_contacts_res()
    {
        $moi = Commerciau::where('user_id', Auth::user()->id)->first();
        $contacts = DB::table('contacts')->orderBy('prenom')->get();
        $stock_mensuelles = DB::table('stock_mensuelles')->where('superieur_id', $moi->id)->get();
        $stock_mensuelles_pole = DB::table('stock_mensuelles')->select('stock_mensuelles.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'stock_mensuelles.commercial_id')
            ->where('commerciaus.domaine_id', $moi->domaine_id)->get();
        return view('suiviSortieTerrain.rapport_contact_res', compact('stock_mensuelles_pole','stock_mensuelles','contacts','moi'));
    }
     
       public function tous_liste_contacts()
    {
        $contacts = DB::table('contacts')->orderby('id', 'desc')->get();
        return view('suiviSortieTerrain.tous_liste_contacts', compact('contacts'));
    }
    
       public function liste_contact_maTeam($id)
    {
        $commercial = Commerciau::find($id);
        $contacts = DB::table('contacts')->where('commercial_id', $commercial->id)->get();
        return view('suiviSortieTerrain.liste_contact_maTeam', compact('contacts', 'commercial'));
    }
     
     
        public function statut_appel_offre_edit($id)
    {
        $opportunite = Opportunite::find($id);
        $statut = DB::table('statut_opportunites')->get();
        $commercial = DB::table('commerciaus')->get();
        return view('suiviSortieTerrain.mettre_a_jour_statut_appelO',compact('opportunite','commercial', 'statut'));

    }
    
    public function statut_appel_offre_update(Request $request, $id)
    {
        
                $message = "Statut mise à jour avec succès";
                $now = now();
                $opportunite = Opportunite::findOrFail($id);

                $opportunite->statut = $request->get('statut');
                $opportunite->date_history = $now;
                $opportunite->save();
                
                $historiques = DB::table('historiques')->where('opportunite_id', $opportunite->id)->orderBy('id', 'desc')->first();
                DB::table('historiques')->where('id', $historiques->id)->update(['date_modifier' => $now] );
                DB::table('historiques')->insert(['statut' => $opportunite->statut, 'opportunite_id' => $opportunite->id, 'date_creer_op' => $now, 'date_ajouter' => $opportunite->updated_at, 'date_modifier' => $now] );

                return redirect('/opportunites')->with(['message' => $message]);
    }
    
        public function statut_op_prospect_edit($id)
    {
        $opportunite = Opportunite::find($id);
        $statut = DB::table('statut_opportunites')->get();
        $commercial = DB::table('commerciaus')->get();
        return view('suiviSortieTerrain.mettre_a_jour_statut_OpProspect',compact('opportunite','commercial', 'statut'));

    }
    
    public function statut_op_prospect_update(Request $request, $id)
    {
        
                $message = "Statut mise à jour avec succès";
                $now = now();
                $opportunite = Opportunite::findOrFail($id);

                $opportunite->statut = $request->get('statut');
                $opportunite->date_history = $now;
                $opportunite->save();
                
                $proba = DB::table('statut_opportunites')->where('id', $opportunite->statut)->first();
                
                DB::table('opportunites')->where('id', $opportunite->id)->update(['probabilite' => $proba->probabilite] );
                
                
                $historiques = DB::table('historiques')->where('opportunite_id', $opportunite->id)->orderBy('id', 'desc')->first();
                DB::table('historiques')->where('id', $historiques->id)->update(['date_modifier' => $now] );
                DB::table('historiques')->insert(['statut' => $opportunite->statut, 'opportunite_id' => $opportunite->id, 'date_creer_op' => $now, 'date_ajouter' => $opportunite->updated_at, 'date_modifier' => $now] );

                return redirect()->route('opportunite_prospect.lister', $opportunite->prospect_id)->with(['message' => $message]);
    }
    
    
       public function mettre_a_jour_statut_edit($id)
    {
        $opportunite = Opportunite::find($id);
        $statut = DB::table('statut_opportunites')->get();
        $commercial = DB::table('commerciaus')->get();
        return view('suiviSortieTerrain.mettre_a_jour_statut',compact('opportunite','commercial', 'statut'));

    }
    
    public function mettre_a_jour_statut_update(Request $request, $id)
    {

                $commercialMe = Commerciau::where('user_id', Auth::user()->id)->first();
                $message = "Statut mise à jour avec succès";
                // $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                $now = now();
                $opportunite = Opportunite::findOrFail($id);
                //DB::table('historiques')->insert(['statut' => $opportunite->statut, 'opportunite_id' => $opportunite->id, 'date_creer_op' => $now, 'date_ajouter' => $opportunite->date_history] );
                
                $opportunite->statut = $request->get('statut');
                $opportunite->date_history = $now;
                //$opportunite->probabilite = $request->get('probabilite');
                //$opportunite->objectif_de_vente = $request->get('objectif_de_vente');
                //$opportunite->commercial_id = $request->get('commercial_id');
                $opportunite->save();
                
                $proba = DB::table('statut_opportunites')->where('id', $opportunite->statut)->first();
                
                DB::table('opportunites')->where('id', $opportunite->id)->update(['probabilite' => $proba->probabilite] );
                
                
                $historiques = DB::table('historiques')->where('opportunite_id', $opportunite->id)->orderBy('id', 'desc')->first();
                DB::table('historiques')->where('id', $historiques->id)->update(['date_modifier' => $now] );
                DB::table('historiques')->insert(['statut' => $opportunite->statut, 'opportunite_id' => $opportunite->id, 'date_creer_op' => $now, 'date_ajouter' => $opportunite->updated_at, 'date_modifier' => $now] );

                //$historiques = DB::table('historiques')->where('opportunite_id', $opportunite->id)->orderBy('id', 'desc')->first();
                    //DB::table('historiques')->where('id', $historiques->id)->update(['date_modifier' => $opportunite->date_history] );
                    //$historiques = DB::table('historiques')->where('opportunite_id', $opportunite->id)->orderBy('id', 'desc')->first();
                    //DB::table('opportunites')->where('id', $opportunite->id)->update(['date_ajouter' => $historiques->created_at] );
            
            $commercial_res = DB::table('commerciaus')->where('id', $opportunite->superieur_id)->first();
            if($commercial_res->id != $opportunite->commercial_id){
                Mail::to($commercial_res->email)->send(new MailMaj($commercial_res, $opportunite, $commercialMe));
            }
                return redirect('/suivi_opportunites')->with(['message' => $message]);
    }
    
    
    public function mettre_a_jour_proba_edit($id)
    {
        $opportunite = Opportunite::find($id);
        $statut = DB::table('statut_opportunites')->get();
        $commercial = DB::table('commerciaus')->get();
        return view('suiviSortieTerrain.mettre_a_jour_proba',compact('opportunite','commercial', 'statut'));

    }
    
    public function mettre_a_jour_proba_update(Request $request, $id)
    {
        //
                $message = "Statut mise à jour avec succès";
                $now = now();
                $opportunite = Opportunite::findOrFail($id);

                $opportunite->probabilite = $request->get('probabilite');
                $opportunite->date_history_proba = $now;
                $opportunite->save();
                $historiques = DB::table('historiques_probas')->where('opportunite_id', $opportunite->id)->orderBy('id', 'desc')->first();
                if($historiques){
                DB::table('historiques_probas')->where('id', $historiques->id)->update(['date_modifier' => $now] );
                }
                else{
                DB::table('historiques_probas')->insert(['statut' => $opportunite->statut, 'opportunite_id' => $opportunite->id, 'date_creer_op' => $now, 'date_ajouter' => $opportunite->updated_at, 'date_modifier' => $now] );
                }
                return redirect('/suivi_opportunites')->with(['message' => $message]);
    }
     
     
        public function edit_action_critique($id)
    {
        $actions = ActionCommercial::find($id);
        return view('suiviSortieTerrain.edit_action_critique',compact('actions'));

    }
    
    public function update_action_critique(Request $request, $id)
    {
        //
                $message = "Action mise à jour avec succès";
                
                $actions = ActionCommercial::find($id);
                $actions->libelle = $request->get('libelle');
                $actions->deadline = $request->get('deadline');
                $actions->priorite = $request->get('priorite');
                $actions->opportunite_id = $request->get('opportunite_id');
                $actions->prospect_id = $request->get('prospect_id');
                $actions->save();

                return redirect('/action_critiques')->with(['message' => $message]);
    }
     
     
       public function detail_op($id)
    {
        //
        $op = Opportunite::find($id);
        return view('suiviSortieTerrain.detail_opportunite', compact('op'));

    }
    
        public function historiques_op($id)
    {
        //
        $opportunites = Opportunite::find($id);
        return view('suiviSortieTerrain.historiques_op', compact('opportunites'));

    }
    
      public function historiques_proba($id)
    {
        //
        $opportunites = Opportunite::find($id);
        return view('suiviSortieTerrain.historiques_proba', compact('opportunites'));

    }
    
        public function toutes_lesactions_op($id)
    {
        //
        $opportunites = Opportunite::find($id);
        $actions = DB::table('action_commerciales')->where('opportunite_id', $opportunites->id)->OrderBy('libelle')->paginate();
        return view('suiviSortieTerrain.toutes_lesactions_op', compact('actions', 'opportunites'));

    }
    
    
        public function opportunite_archiver_maTeam_res()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('archiver', 1 )->OrderBy('created_at', 'desc')->paginate(1000);
        
        $opportunite_pole = DB::table('opportunites')->select('opportunites.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'opportunites.commercial_id')
            ->where('commerciaus.domaine_id', $commercial->domaine_id)
            ->where('opportunites.archiver', 1 )
            ->OrderBy('opportunites.probabilite', 'desc')->paginate(1000);
        return view('suiviSortieTerrain.liste_opportunite_archiver_maTeam_res', compact('opportunite','opportunite_pole'));

    }
    
        public function opportunite_gagner_maTeam_res()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('superieur_id', $commercial->id)->where('archiver', 2 )->OrderBy('created_at', 'desc')->paginate(1000);
        $opportunite_tri = DB::table('opportunites')->where('superieur_id', $commercial->id)->where('archiver', 2 )
        ->whereMonth('created_at', 01)->whereMonth('created_at', 02)->whereMonth('created_at', 03)->OrderBy('created_at', 'desc')->paginate(1000);
        $check_opportunite_tri = DB::table('opportunites')->where('superieur_id', $commercial->id)->where('archiver', 2 )->OrderBy('created_at', 'desc')->paginate(1000);
        $opportunite_pole = DB::table('opportunites')->select('opportunites.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'opportunites.commercial_id')
            ->where('commerciaus.domaine_id', $commercial->domaine_id)
            ->where('opportunites.archiver', 2 )
            ->OrderBy('opportunites.probabilite', 'desc')->paginate(1000);
        return view('suiviSortieTerrain.liste_opportunite_gagner_maTeam_res', compact('check_opportunite_tri','opportunite','opportunite_pole','opportunite_tri'));

    }
    
        public function opportunite_abandonner_maTeam_res()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('superieur_id', $commercial->id)->where('archiver', 4)->OrderBy('created_at', 'desc')->paginate(1000);
       
        $opportunite_pole = DB::table('opportunites')->select('opportunites.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'opportunites.commercial_id')
            ->where('commerciaus.domaine_id', $commercial->domaine_id)
            ->where('opportunites.archiver', 4)
            ->OrderBy('opportunites.probabilite', 'desc')->paginate(1000);
        return view('suiviSortieTerrain.liste_opportunite_abandonner_maTeam_res', compact('opportunite','opportunite_pole'));

    }
    
        public function opportunite_perdu_maTeam_res()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('superieur_id', $commercial->id)->where('archiver', 3)->OrderBy('created_at', 'desc')->paginate();
        $opportunite_tri = DB::table('opportunites')->where('superieur_id', $commercial->id)->where('archiver', 3)
        ->whereMonth('created_at', 01)->where('superieur_id', $commercial->id)->whereMonth('created_at', 02)->whereMonth('created_at', 03)->OrderBy('created_at', 'desc')->paginate(1000);
        $check_opportunite_tri = DB::table('opportunites')->where('archiver', 3 )->OrderBy('created_at', 'desc')->paginate(1000);
        
        $opportunite_pole = DB::table('opportunites')->select('opportunites.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'opportunites.commercial_id')
            ->where('commerciaus.domaine_id', $commercial->domaine_id)
            ->where('opportunites.archiver', 3)
            ->OrderBy('opportunites.probabilite', 'desc')->paginate(1000);
        return view('suiviSortieTerrain.liste_opportunite_perdu_maTeam_res', compact('check_opportunite_tri','opportunite_tri','opportunite','opportunite_pole'));

    }
    
        public function opportunite_archiver_maTeam()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('archiver', 1 )->OrderBy('created_at', 'desc')->paginate();
        return view('suiviSortieTerrain.liste_opportunite_archiver_maTeam', compact('opportunite'));

    }
    
        public function opportunite_gagner_maTeam()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('archiver', 2 )->OrderBy('created_at', 'desc')->paginate(1000);
        $opportunite_tri = DB::table('opportunites')->where('archiver', 2 )->whereMonth('created_at', 01)->whereMonth('created_at', 02)->whereMonth('created_at', 03)->OrderBy('created_at', 'desc')->paginate(1000);
        $check_opportunite_tri = DB::table('opportunites')->where('archiver', 2 )->OrderBy('created_at', 'desc')->paginate(1000);
        return view('suiviSortieTerrain.liste_opportunite_gagner_maTeam', compact('check_opportunite_tri','opportunite', 'opportunite_tri'));

    }
         public function opportunite_abandonner_maTeam()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('archiver', 4)->OrderBy('created_at', 'desc')->paginate();
        // $opportunite_tri = DB::table('opportunites')->whereMonth('created_at', 01)->whereMonth('created_at', 02)->whereMonth('created_at', 03)->OrderBy('created_at', 'desc')->where('archiver', 3)->paginate(1000);
        return view('suiviSortieTerrain.liste_opportunite_abandonner_maTeam', compact('opportunite'));

    }
    
         public function opportunite_perdu_maTeam()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('archiver', 3)->OrderBy('created_at', 'desc')->paginate();
        $check_opportunite_tri = DB::table('opportunites')->where('archiver', 3 )->OrderBy('created_at', 'desc')->paginate(1000);
        $opportunite_tri = DB::table('opportunites')->whereMonth('created_at', 01)->whereMonth('created_at', 02)->whereMonth('created_at', 03)->OrderBy('created_at', 'desc')->where('archiver', 3)->paginate(1000);
        return view('suiviSortieTerrain.liste_opportunite_perdu_maTeam', compact('check_opportunite_tri','opportunite','opportunite_tri'));

    }
    
        public function opportunite_archiver()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('commercial_id', $commercial->id)->where('archiver', 1 )->OrderBy('created_at', 'desc')->paginate(10);
        return view('suiviSortieTerrain.liste_opportunite_archiver', compact('opportunite'));

    }
    
        public function opportunite_gagner()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('commercial_id', $commercial->id)->where('archiver', 2 )->OrderBy('created_at', 'desc')->paginate(10);
        $check_opportunite_tri = DB::table('opportunites')->where('commercial_id', $commercial->id)->where('archiver', 2 )->OrderBy('created_at', 'desc')->paginate(1000);
        return view('suiviSortieTerrain.liste_opportunite_gagner', compact('check_opportunite_tri','opportunite'));

    }
    
        public function opportunite_perdu()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('commercial_id', $commercial->id)->where('archiver', 3 )->OrderBy('created_at', 'desc')->paginate(10);
        $check_opportunite_tri = DB::table('opportunites')->where('commercial_id', $commercial->id)->where('archiver', 3 )->OrderBy('created_at', 'desc')->paginate(1000);
        return view('suiviSortieTerrain.liste_opportunite_perdu', compact('check_opportunite_tri','opportunite'));

    }
    
        public function opportunite_abandonner()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('commercial_id', $commercial->id)->where('archiver', 4)->OrderBy('created_at', 'desc')->paginate(10);
        return view('suiviSortieTerrain.liste_opportunite_abandonner', compact('opportunite'));

    }
     
     
    public function index()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->select('opportunites.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'opportunites.commercial_id')
        ->whereIn('opportunites.origine_id', [1,2] )
        ->where('opportunites.archiver', 0 )
        ->where('opportunites.statut', '!=', 18 )
        ->OrderBy('opportunites.deadline', 'asc')->paginate(1000);
       
        $prospects = DB::table('prospects')->where('commercial_id', $commercial->id)->where('strategique', 1)->paginate(1000);
        return view('suiviSortieTerrain.lister_opportunite', compact('opportunite', 'prospects', 'commercial'));
    }
    
    public function appelOffre_Filtre(Request $request)
    {
        $serachCom = $request->get('serachCom');
        $serachPays = $request->get('serachPays');
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->select('opportunites.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'opportunites.commercial_id')
        ->whereIn('opportunites.origine_id', [1,2] )
        ->where('opportunites.archiver', 0 )
        ->where('opportunites.commercial_id','like', '%'.$serachCom.'%')
        ->where('commerciaus.pays_id','like', '%'.$serachPays.'%')
        ->whereIn('opportunites.commercial_id', [$serachCom])
        ->orwhereIn('commerciaus.pays_id', [$serachPays])
        ->OrderBy('opportunites.deadline', 'asc')
        ->where('opportunites.statut', '!=', 18 )
        ->paginate(1000);
       
        $prospects = DB::table('prospects')->where('commercial_id', $commercial->id)->where('strategique', 1)->paginate();
        return view('suiviSortieTerrain.lister_opportunite', compact('opportunite', 'prospects', 'commercial'));
    }
    
    
    public function lister_opportunites_res()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->select('opportunites.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'opportunites.commercial_id')
        ->where('opportunites.superieur_id', $commercial->id)
        ->OrderBy('opportunites.deadline', 'asc')->paginate(10000);
     
        $prospects = DB::table('prospects')->where('commercial_id', $commercial->id)->where('strategique', 1)->paginate(1000);
        return view('suiviSortieTerrain.lister_opportunites_res', compact('opportunite', 'prospects', 'commercial'));
    }
    
     public function lister_opportunites_resFiltre(Request $request)
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $serachCom = $request->get('serachCom');
        $serachPays = $request->get('serachPays');
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->select('opportunites.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'opportunites.commercial_id')->where('opportunites.superieur_id', $commercial->id)
        ->where('opportunites.commercial_id','like', '%'.$serachCom.'%')
        ->where('commerciaus.pays_id','like', '%'.$serachPays.'%')
        ->whereIn('opportunites.commercial_id', [$serachCom])
        ->orwhereIn('commerciaus.pays_id', [$serachPays])
        ->OrderBy('opportunites.deadline', 'asc')
        ->paginate(10000);
       
        $prospects = DB::table('prospects')->where('commercial_id', $commercial->id)->where('strategique', 1)->paginate();
        return view('suiviSortieTerrain.lister_opportunites_res', compact('opportunite', 'prospects', 'commercial'));
    }
    
    public function tous_appel_offre()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->select('opportunites.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'opportunites.commercial_id')
        ->where('opportunites.archiver', 0 )->whereIn('opportunites.origine_id', [1,2] )->OrderBy('opportunites.deadline', 'asc')->paginate(1000);
        
              
        $prospects = DB::table('prospects')->where('commercial_id', $commercial->id)->where('strategique', 1)->get();
        return view('suiviSortieTerrain.tous_appel_offre', compact('opportunite', 'prospects', 'commercial'));
    }
    
    public function filtrer_opportunite_appelO(Request $request)
    {
        $search = $request->get('search');
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->select('opportunites.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'opportunites.commercial_id')
        ->where('opportunites.archiver', 0 )->whereIn('opportunites.origine_id', [1,2] )->OrderBy('opportunites.deadline', 'asc')
        ->where('statut','like', '%'.$search.'%')->paginate(1000);
              
        $prospects = DB::table('prospects')->where('commercial_id', $commercial->id)->where('strategique', 1)->get();
        return view('suiviSortieTerrain.tous_appel_offre', compact('opportunite', 'prospects', 'commercial'));
    }
    
    public function filtrer_opportunite_appelO_tous(Request $request)
    {
        $serachCom = $request->get('serachCom');
        $serachPays = $request->get('serachPays');
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->select('opportunites.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
        ->join('commerciaus', 'commerciaus.id', 'opportunites.commercial_id')
        ->where('opportunites.archiver', 0 )->whereIn('opportunites.origine_id', [1,2] )->OrderBy('opportunites.deadline', 'asc')
        ->where('opportunites.commercial_id','like', '%'.$serachCom.'%')
        ->where('commerciaus.pays_id','like', '%'.$serachPays.'%')
        ->whereIn('opportunites.commercial_id', [$serachCom])
        ->orwhereIn('commerciaus.pays_id', [$serachPays])->paginate(1000);
              
        $prospects = DB::table('prospects')->where('commercial_id', $commercial->id)->where('strategique', 1)->get();
        return view('suiviSortieTerrain.tous_appel_offre', compact('opportunite', 'prospects', 'commercial'));
    }
    
    public function action_stra()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('commercial_id', $commercial->id)->where('archiver', 0 )->OrderBy('created_at', 'desc')->paginate();
       
        $prospects = DB::table('prospects')->where('commercial_id', $commercial->id)->where('strategique', 1)->paginate();
        return view('suiviSortieTerrain.action_stra', compact('opportunite', 'prospects', 'commercial'));
    }
    
    
     public function filtrer_prospect(Request $request)
    {
        $searchPros = $request->get('searchPros');
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('commercial_id', $commercial->id)->where('archiver', 0 )->whereIn('origine_id', [1,2] )->OrderBy('created_at', 'desc')->paginate(10000);
        $prospects = DB::table('prospects')->where('commercial_id', $commercial->id)->where('strategique', 1)->where('pays_id','like', '%'.$searchPros.'%')->paginate(10000);
        return view('suiviSortieTerrain.lister_opportunite', compact('opportunite', 'prospects', 'commercial'));
    }
    
    
    public function toutes_les_opportunite()
    {
        $opportunite = DB::table('opportunites')->where('archiver', 0 )->whereIn('origine_id', [1,2] )->OrderBy('created_at', 'desc')->paginate(10);
        return view('suiviSortieTerrain.lister_toutes-opportunites', compact('opportunite'));
    }
    
      public function action_critiques()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $actions = DB::table('action_commerciales')->where('commercial_id', $commercial->id)->where('priorite', 1)->OrderBy('cloture', 'asc')->OrderBy('deadline', 'desc')->paginate(1000);
        return view('suiviSortieTerrain.action_critiques', compact('actions'));
    }
    
    
      public function action_echeances_critiques()
    {
        return view('suiviSortieTerrain.action_echeances_critiques');
    }
    
   

    
     public function suivi_opportunites()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('commercial_id', $commercial->id)->OrderBy('probabilite', 'desc')->paginate(22);
        $opportunite_backup = DB::table('opportunites')->where('commercial_backup', $commercial->id)->OrderBy('probabilite', 'desc')->paginate(22);
        return view('suiviSortieTerrain.suivi_opportunite', compact('opportunite', 'opportunite_backup'));
    }
    
    public function filtrer_opportunite(Request $request)
    {
        $search = $request->get('search');
        $searchOr = $request->get('searchOr');
        $searchProb = $request->get('searchProb');
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $opportunite = DB::table('opportunites')->where('commercial_id', $commercial->id)->where('statut','like', '%'.$search.'%')->where('origine_id','like', '%'.$searchOr.'%')->paginate(10000);
        $opportunite_backup = DB::table('opportunites')->where('commercial_backup', $commercial->id)->where('statut','like', '%'.$search.'%')->where('origine_id','like', '%'.$searchOr.'%')->OrderBy('probabilite', 'desc')->paginate(10000);
        return view('suiviSortieTerrain.suivi_opportunite', compact('opportunite', 'opportunite_backup'));
    }
    
    
    
    public function filtrer_commercial(Request $request)
    {
        $searchC = $request->get('searchC');
        $opportunite = DB::table('opportunites')->where('commercial_id','like', '%'.$searchC.'%')->paginate(10000);
        return view('suiviSortieTerrain.lister_toutes-opportunites', compact('opportunite'));
    }
    
   
    
     public function archiver_opportunite($id)
    {
        //    
        $archive = "Opportunité archivée avec succès";
        $archiver = Opportunite::findOrFail($id);
        $archiver->archiver = 1; //Approved
        $archiver->save();
        return redirect()->back()->with(['archive' => $archive]); 
    }
    
     public function desarchiver_opportunite($id)
    {
        //    
        $archive = "Opportunité désarchivée avec succès";
        $archiver = Opportunite::findOrFail($id);
        $archiver->archiver = 0; //Approved
        $archiver->save();
        
        // $now = date('Y-m-d');
        // $op = DB::table('opportunites')->where('archiver', 1)->get();
        // foreach($op as $opp){
        //     if($opp->deadline_desarchiver = $now){
        //         DB::table('opportunites')->where('id', $opp->id)->update(['archiver' => 0]);

        //     }
        // }
        
        return redirect()->back()->with(['archive' => $archive]); 
    }
    
    public function ajout_action_op($id)
    {
        $opportunite = Opportunite::find($id);
         $commercial = DB::table('commerciaus')->orderBy('prenom')->get();
        //
        $pgTitle = "Ajouter les actions de l'opportunité";
        $commercialValue = Commerciau::where('user_id', Auth::user()->id)->first();
        $commercialId = $commercialValue->id;
        
        $commercialOpportunites = Opportunite::where('commercial_id', $commercialValue->id)->get();
        
        foreach ($commercialOpportunites as $comOpport) {
             $prospectId = $comOpport->prospect_id;
        }
        
        $prospects = Prospect::where('commercial_id', $commercialValue->id)->get();
        
        return view('suiviSortieTerrain.ajout_action_opp', ['commercial' =>$commercial, 'commercialOpportunites' =>$commercialOpportunites, 'prospects' =>$prospects, 'pgTitle' =>$pgTitle, 'commercialId' =>$commercialId, 'opportunite' => $opportunite ]);


    }
    
    public function ajout_rv_op($id)
    {
        $opportunite = Opportunite::find($id);
         $commercial = DB::table('commerciaus')->orderBy('prenom')->get();
        //
        $pgTitle = "Ajouter un rendez-vous pour cette l'opportunité";
        $commercialValue = Commerciau::where('user_id', Auth::user()->id)->first();
        $commercialId = $commercialValue->id;
        
        $commercialOpportunites = Opportunite::where('commercial_id', $commercialValue->id)->get();
        
        foreach ($commercialOpportunites as $comOpport) {
             $prospectId = $comOpport->prospect_id;
        }
        
        $prospects = Prospect::where('commercial_id', $commercialValue->id)->get();
        
        return view('suiviSortieTerrain.ajout_rv_opp', ['commercial' =>$commercial, 'commercialOpportunites' =>$commercialOpportunites, 'prospects' =>$prospects, 'pgTitle' =>$pgTitle, 'commercialId' =>$commercialId, 'opportunite' => $opportunite ]);


    }
    
    public function create()
    {
        //
        // $pays = DB::table('pays')->get();
        $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
        $prospect = DB::table('prospects')->where('commercial_id', $commercial->id)->orderBy('nom_entreprise')->get();
        $statut = DB::table('statut_opportunites')->orderBy('libelle')->get();
        $backup = DB::table('commerciaus')->where('entreprise_client_id', $commercial->entreprise_client_id)->orderBy('prenom')->get();
        $origine = DB::table('origines')->orderBy('libelle')->get();
        return view('suiviSortieTerrain.ajouter_opportunite',compact('prospect','backup', 'statut', 'origine'));

    }
    
     public function insert_paysop()
    {
        $commerciaux = DB::table('commerciaus')->get();
        $jour = array();
        foreach($commerciaux as $commerciau)
        {
            DB::table('opportunites')
                ->whereIn('commercial_id', [$commerciau->id])
                ->update(['pays_id' => $commerciau->pays_id]);
        }
    }
    public function store(Request $request)
    {
        //
                $message = "Opportunité ajoutée avec succès";
                $commercialMe = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                $today = now();
                $strotime_deadline = strtotime($today .'+' . 30 . ' days');
                $date_deadline = date('Y-m-d', $strotime_deadline);
                $now = now();
                    
                $opportunite = new Opportunite;
                $opportunite->libelle = $request->get('libelle'); 
                $opportunite->prospect_id = $request->get('prospect_id'); 
                $opportunite->commercial_id = $commercialMe->id;
                $opportunite->superieur_id = $commercialMe->superieur_id;
                $opportunite->commercial_backup = $request->get('commercial_backup');
                $opportunite->origine_id = $request->get('origine_id');
                $opportunite->deadline = $request->get('deadline');
                $opportunite->pays_id = $commercialMe->pays_id;
                $opportunite->concurrence = $request->get('concurrence');
                $opportunite->contact_principal_id = $request->get('contact_principal_id');
                $opportunite->contact_secondaire_id = $request->get('contact_secondaire_id');
                $opportunite->notes = $request->get('notes');
                // $opportunite->probabilite = $request->get('probabilite');
                $opportunite->objectif_de_vente = $request->get('objectif_de_vente');
                $opportunite->contact = $request->get('contact');
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
                            //$contactGNs = DB::table('contacts')->where('prospect_id', $opportunite->prospect_id)->get();
                           // dd($contactGNs);
                            //foreach($contactGNs as $contac)
                            //  {
                               // DB::table('contacts')->update(['prenom'  => $contac->prenom, 'nom' => $contac->nom  => 'email'  =>
                                //$contac->email, 'phone'  => $contac->phone, 'responsabilite'  => $contac->responsabilite,
                                //'opportunite_id'  => $opportunite->id, 'commercial_id' => $opportunite->commercial_id]);
                              //}
                        }
                    
                    // $strotime_deadline = strtotime($opportunite->created_at .'+' . 30 . ' days');
                    // $date_deadline = date('Y-m-d', $strotime_deadline);
                    // DB::table('opportunites')->where('id', $opportunite->id)->update(['deadline' => $date_deadline] );
                    
                    $prenom = $request->get('prenom'); 
                    $nom = $request->get('nom'); 
                    $email = $request->get('email'); 
                    $phones = $request->get('phones');
                    $responsabilite = $request->get('responsabilite'); 
                    $prospect_id = $opportunite->prospect_id;
                    $opportunite_id = $opportunite->id;
                    $commercial_id = $opportunite->commercial_id;
                    $superieur_id = $opportunite->superieur_id;
                    
                    for($i=0; $i < count($prenom); $i++){
                    $contacts = [
                        
                        'prenom' => $prenom[$i],
                        'nom' => $nom[$i],
                        'email' => $email[$i],
                        'phone' => $phones[$i],
                        'responsabilite' => $responsabilite[$i],
                        'opportunite_id' =>$opportunite->id,
                        'prospect_id' =>$opportunite->prospect_id,
                        'commercial_id' =>$opportunite->commercial_id,
                        'superieur_id' =>$opportunite->superieur_id
                         ];
                     if($prenom[$i] !== null){
                            DB::table('contacts')->insert($contacts);
                            
                        }
                    }  
                    
                $ajout_action = $opportunite->id;
                $ajout_rv = $opportunite->id;
                
                if($opportunite->commercial_id != $commercialMe->id){
                    
                    $commercial_res = DB::table('commerciaus')->where('id', $opportunite->commercial_id)->where('id','!=', $commercialMe->id)->first();
         
                    Mail::to($commercial_res->email)->send(new MailResOp($commercial_res, $opportunite, $commercialMe));
                }
                
                if($opportunite->commercial_backup){
                    
                    $commercial = DB::table('commerciaus')->where('id', $opportunite->commercial_backup)->where('id','!=', $commercialMe->id)->first();
         
                    Mail::to($commercial->email)->send(new MailBackupOp($commercial, $opportunite, $commercialMe));
                }
                
                $commercial_id = DB::table('commerciaus')->where('id', $opportunite->commercial_id)->first();
                
                Mail::to('sales@illimitis.com')->send(new MailBizdev($opportunite,$commercial_id));
                
                return redirect('/suivi_opportunites')->with(['message' => $message, 'ajout_action' => $ajout_action, 'ajout_rv' => $ajout_rv]);
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
        $opportunite = Opportunite::find($id);
        $pays = DB::table('pays')->get();
        $role = DB::table('roles')->get();
        return view('suiviSortieTerrain.edit_opportunite', compact('role','pays', 'opportunite'));

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
           request()->validate([
                    //'photo.*' => 'mimes:doc,pdf,docx,zip,png,jpeg,odt,jpg,svc,csv,mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts',
                   
        
            ]);
            $image = $request->file('photo');
            if($image){
            $imageName = $image->getClientOriginalName();
            $image->move(public_path().'/images/', $imageName);
                } 
                $message = "Opportunité modifié avec succès";

                
                $opportunite = Opportunite::find($id);
                $opportunite->libelle = $request->get('libelle'); 
                $opportunite->prospect_id = $request->get('prospect_id'); 
                $opportunite->commercial_id = $commercial->id;
                $opportunite->contact_principal = $request->get('contact_principal');
                $opportunite->contact_secondaire = $request->get('contact_secondaire');
                $opportunite->marge = $request->get('marge');
                // $opportunite->probabilite = $request->get('probabilite');
                $opportunite->valeur_actuelle = $request->get('valeur_actuelle');
                $opportunite->objectif_de_vente = $request->get('objectif_de_vente');
                $opportunite->target_vente = $request->get('target_vente');
                $opportunite->statut = $request->get('statut');
                $opportunite->date_debut = $request->get('date_debut');
                $opportunite->update();
                DB::table('prospects')->where('id', $opportunite->prospect_id)->update(['commercial_id' => $opportunite->commercial_id]);

                   /*  //$opportunitexs->save();
                    if($opportunitex->update())
                    {
                        Auth::login($user);
                        return back()->with(['message' => $message]);

                    }
                    else
                    {
                        flash('user not saved')->error();

                    }

                }     */

        return redirect('/opportunitex')->with(['message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
       public function destroy_entreprise($id)
    {
        //
        $message = "Opportunite supprimée avec succès";
        $opportunite = Opportunite::find($id);
        $opportunite->delete();

        return back()->with(['message' => $message]);
    }
    
    public function destroy($id)
    {
        //
        $opportunitex = opportunite::find($id);
        $opportunitex->delete();

        return back();
    }
    
     
    
    
}
