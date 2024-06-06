<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Prospection;
use App\Entreprise;
use App\User;
use App\Raison;
use Auth;
use DB;
use Mail;

use Session;
use Mailjet\LaravelMailjet\Facades\Mailjet;

class RaisonController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
     
     public function dg_raison()
    {
        //
        $mois = date('m');
        $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
        $raisons = DB::table('raisons')->whereMonth('created_at', $mois)->orderBy('created_at', 'desc')->get();
        return view('suiviSortieTerrain.dg_raison', compact('raisons'));
    }
    
     public function dg_raison_filtre(Request $request)
    {
        //
        $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
        $searchraison = $request->get('searchraison');
        $mois = date('m');
        $raisons = DB::table('raisons')->whereMonth('created_at', $mois)->where('commercial_id','like', '%'.$searchraison.'%')->whereIn('commercial_id',[$searchraison])->orderBy('created_at', 'desc')->get();
        return view('suiviSortieTerrain.dg_raison', compact('raisons'));
    }
    
     public function res_raison()
    {
        //
       $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
       $mois = date('m');
        $annee = date('Y'); 
       $raisons = DB::table('raisons')->where('superieur_id', $commercial->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->orderBy('created_at', 'desc')->get();
       
       $raisons_pole = DB::table('raisons')->select('raisons.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'raisons.commercial_id')
            ->where('commerciaus.domaine_id', $commercial->domaine_id)
            ->whereMonth('raisons.created_at', $mois)->whereYear('raisons.created_at', $annee)->orderBy('raisons.created_at', 'desc')
            ->get();
       return view('suiviSortieTerrain.res_raison', compact('raisons_pole','raisons'));
    }
    
     public function res_raison_filtre(Request $request)
    {
        //
        $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
        $searchraison = $request->get('searchraison');
        $mois = date('m');
         $annee = date('Y'); 
        $raisons = DB::table('raisons')->where('superieur_id', $commercial->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->where('commercial_id','like', '%'.$searchraison.'%')->whereIn('commercial_id',[$searchraison])->orderBy('created_at', 'desc')->get();
        $raisons_pole = DB::table('raisons')->select('raisons.*', 'commerciaus.id as ID', 'commerciaus.domaine_id')
            ->join('commerciaus', 'commerciaus.id', 'raisons.commercial_id')
            ->where('commerciaus.domaine_id', $commercial->domaine_id)
            ->where('raisons.commercial_id','like', '%'.$searchraison.'%')->whereIn('raisons.commercial_id',[$searchraison])
            ->whereMonth('raisons.created_at', $mois)->whereYear('raisons.created_at', $annee)->orderBy('raisons.created_at', 'desc')
            ->get();
       
       return view('suiviSortieTerrain.res_raison', compact('raisons_pole','raisons'));
    }
    
     public function create_raison()
    {
        //
        return view('suiviSortieTerrain.raison');
    }
    public function store_raison(Request $request)
    {
        //
                $message = "Raison ajoutée avec succès";
                $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                
                $raison = new Raison;
                $raison->commentaire = $request->get('commentaire'); 
                $raison->commercial_id = $commercial->id;
                $raison->superieur_id = $commercial->superieur_id;
                $raison->save();
                   
              
                
                return back()->with(['message' => $message]);
    }

    
    
}
