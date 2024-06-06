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
use App\Prospect_a_appeller;
use App\Commerciau;
use App\Opportunite;
use App\Prospect;
use App\Bdd_prospect;
use App\Contact;
use App\Mail\MailProsAffecter;
use App\Suivi_prospect;
use Auth;
use DB;
use Mail;

use Session;
use Mailjet\LaravelMailjet\Facades\Mailjet;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportUser;
use App\Imports\ImportBdd;
use App\Exports\ExportUser;
use App\Exports\ExportPlanning;

class Base_donneeController extends Controller
{
    use AuthenticatesUsers;

    
    public function importer_bdd()
    {
        $me = Commerciau::where('user_id', Auth::user()->id)->first();
       
        return view('base_donnee.import_bdd', compact('me'));

    }    
    
    public function import_bdd_store(Request $request){
        $me = Commerciau::where('user_id', Auth::user()->id)->first();
        $message = 'Base de donnees importée avec succès ';
        $commercial_id = $me->id;
        $superieur_id = $me->superieur_id;
        
         $request->validate([
            'file' => 'required|file|mimes:xlsx,xls'
         ]);
        $file = $request->get('file');
        Excel::import(new ImportBdd($commercial_id,$superieur_id), $request->file('file')->store('files'));
        
        //$comerciaux = DB::table('commerciaus')->get();
        
        //foreach($comerciaux as $comerciau)
        //{
            
            //DB::table('bdd_prospects')->where('email_1', $comerciau->email)->update(['commercial_id' => $comerciau->id]);
        //}
        
        // foreach($comerciaux as $comerciaub)
        //{
            
           // DB::table('bdd_prospects')->where('email_2', $comerciaub->email)->update(['backup' => $comerciaub->id]);
        //}

        return redirect('/lister_bdd')->with(['message' => $message]);
    }

    public function lister_bdd()
    {
        $me = Commerciau::where('user_id', Auth::user()->id)->first();
        $bdd_prospects = DB::table('bdd_prospects')->where('statut',null)->orderBy('nom_entreprise')->paginate(1000);
        
        $villeChecks = DB::table('villes')->pluck('libelle')->toArray();
            $entreprisess = DB::table('bdd_prospects')->pluck('ville')->toArray();
                                        
            $result_comerPpp = array_diff($entreprisess, $villeChecks);
            
            foreach($result_comerPpp as $result_comerPp)
            {
                
                DB::table('villes')->where('libelle', '<>', $result_comerPp)->insert(['libelle' => $result_comerPp]);
            }
       
        return view('base_donnee.lister_bdd', compact('bdd_prospects'));

    }  
     public function prospect_bddFiltre(Request $request)
    {
        $serachCom = $request->get('serachCom');
        $serachPays = $request->get('serachPays');
        $serachVille = $request->get('serachVille');
        $serachprospect = $request->get('serachprospect');
        $bdd_prospects = DB::table('bdd_prospects')
        ->where('statut',null)
        //->where('commercial_id','like', '%'.$serachCom.'%')
        //->orwhereIn('commercial_id',[$serachCom])
         ->when(request()->has('serachCom'), function($q){
            $q->where('commercial_id', request('serachCom'));
        })
        ->when(request()->has('serachPays'), function($q){
            $q->where('pays', request('serachPays'));
        })
        ->when(request()->has('serachVille'), function($q){
            $q->where('ville', request('serachVille'));
        })
        ->orderBy('nom_entreprise')
        ->paginate(10000);
        
           
        
        return view('base_donnee.lister_bdd', compact('bdd_prospects'));
    }
    
    public function edit_bdd_prospects($id)
    {
        //
        $entreprise = Bdd_prospect::find($id);
        $commercial = DB::table('commerciaus')->orderby('prenom')->get();
        $resultat = DB::table('resultat_appels')->orderby('libelle')->get();
        $pay = DB::table('pays')->orderby('libelle')->get();
        $domaine = DB::table('domaines')->orderby('libelle')->get();
        return view('base_donnee.edit_bdd', compact('pay', 'domaine', 'resultat', 'entreprise', 'commercial'));

    }
  
    public function update_bdd_prospects(Request $request, $id)
    {
            $message = "Prospect modifié avec succès";
            
        $today = date('Y-m-d');   
            
        $com_connect = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
        
        $prospect = Bdd_prospect::findOrFail($id);
        $prospect->pays = $request->get('pays');
        $prospect->ville =$request->get('ville');
        $prospect->nom_entreprise = $request->get('nom_entreprise');
        $prospect->adresse = $request->get('adresse');
        $prospect->phone = $request->get('phone');
        $prospect->email_entreprise = $request->get('email_entreprise');
        $prospect->site_web = $request->get('site_web');
        $prospect->secteur = $request->get('secteur');
        $prospect->taille_prospect = $request->get('taille_prospect');
        $prospect->type_prospect = $request->get('type_prospect');
        $prospect->commercial_id = $request->get('commercial_id');
        $prospect->commercial2 = $request->get('commercial2');
        $prospect->nom_contact1 = $request->get('nom_contact1');
        $prospect->prenom_contact1 = $request->get('prenom_contact1');
        $prospect->email_contact1 = $request->get('email_contact1');
        $prospect->fonction_contact1 = $request->get('fonction_contact1');
        $prospect->mobile_contact1 = $request->get('mobile_contact1');
        $prospect->whatshap_contact1 = $request->get('whatshap_contact1');
        $prospect->nom_contact2 = $request->get('nom_contact2');
        $prospect->prenom_contact2 = $request->get('prenom_contact2');
        $prospect->email_contact2 = $request->get('email_contact2');
        $prospect->fonction_contact2 = $request->get('fonction_contact2');
        $prospect->mobile_contact2 = $request->get('mobile_contact2');
        $prospect->whatshap_contact2 = $request->get('whatshap_contact2');
        // $prospect->commercial_id = $commercial->id;
        $prospect->save();
                
              
        return redirect()->route('bdd_prospects.qualifier', $prospect->id)->with(['message' => $message]);
    }


     public function fiche_prospect_bdd($id)
    {
        //
        $entreprise = Bdd_prospect::find($id);
        // $suivi = DB::table('suivi_prospects')->where('prospect_appel_id', $entreprise->id)->get();
        return view('base_donnee.fiche_prospect_bdd', compact('entreprise'));

    }
    
    public function qualifier_bdd_prospects($id)
    {
        //
        $entreprise = Bdd_prospect::find($id);
        $commercial = DB::table('commerciaus')->orderby('prenom')->get();
        $resultat = DB::table('resultat_appels')->orderby('libelle')->get();
        $pay = DB::table('pays')->orderby('libelle')->get();
        $domaine = DB::table('domaines')->orderby('libelle')->get();
        return view('base_donnee.qualifier_bdd', compact('pay', 'domaine', 'resultat', 'entreprise', 'commercial'));

    }
  
    public function qualifier_bdd_prospects_store(Request $request, $id)
    {
            $message = "Prospect modifié avec succès";
            
        $today = date('Y-m-d');   
            
        $com_connect = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
        
        $prospect = Bdd_prospect::findOrFail($id);
        $prospect->statut = $request->get('statut');
        $prospect->save();
        
        $pros = DB::table('bdd_prospects')->where('id', $prospect->id)->first();
        if($pros->statut == 1){
            DB::table('prospects')->insert(['prospect_bdd' => 'prospect_bdd','prospect_bdd_id' => $pros->id,'nom_entreprise' => $pros->nom_entreprise, 'phone' => $pros->phone, 'email_entreprise' => $pros->email_entreprise,
            'secteur' => $pros->secteur,'contact' => 1,'commercial_id' => $pros->commercial_id,'superieur_id' => $pros->superieur_id]);
        }
        
        $pros_bdd = DB::table('prospects')->where('prospect_bdd', 'prospect_bdd')->orderby('id', 'desc')->first();
        
        if($pros_bdd){
            if($pros->statut == 1){
            DB::table('contacts')->insert(['prenom' => $pros->prenom_contact1,'nom' => $pros->nom_contact1,
            'email' => $pros->email_contact1, 'phone' => $pros->mobile_contact1, 'whatsapp' => $pros->whatshap_contact1, 'prospect_id' => $pros_bdd->id,'commercial_id' => $pros->commercial_id,'superieur_id' => $pros->superieur_id]);
            }
        }
        if($pros_bdd){
            if($pros->statut == 1){
                if($pros->prenom_contact2 != null){
                    DB::table('contacts')->insert(['prenom' => $pros->prenom_contact2,'nom' => $pros->nom_contact2, 'prospect_id' => $pros_bdd->id,'commercial_id' => $pros->commercial_id,'superieur_id' => $pros->superieur_id,
                    'email' => $pros->email_contact2, 'phone' => $pros->mobile_contact2, 'whatsapp' => $pros->whatshap_contact2]);
                }
            }
        }
        return redirect('/lister_bdd')->with(['message' => $message]);
    }

       public function nouveaux_clients_tous()
    {
        $mois = date('m');
        $annee = date('Y');
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $nvx_clients = array();  
        $opp_vendu = DB::table('ventes')->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->orderBy('created_at', 'desc')->get(); 
            foreach($opp_vendu as $opp_vendus){
                $opp = DB::table('opportunites')->where('id', $opp_vendus->opportunite_id)->first();
                $nvx_clientss = DB::table('prospects')->where('id', $opp->prospect_id)->get(); 
                foreach($nvx_clientss as $nvx_clientsss){
                    array_push($nvx_clients,$nvx_clientsss);
                }
            }
        
        return view('base_donnee.nouveaux_clients_tous', compact('nvx_clients'));
    }


   public function nouveaux_clients_tousFiltre(Request $request)
    {
        $serachCom = $request->get('serachCom');
        $serachPays = $request->get('serachPays');
        $serachprospect = $request->get('serachprospect');
        
        $mois = date('m');
        $annee = date('Y');
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $nvx_clients = array();  
        $opp_vendu = DB::table('ventes')->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->orderBy('created_at', 'desc')->where('commercial_id','like', '%'.$serachCom.'%')
        ->orwhereIn('commercial_id',[$serachCom])->get(); 
            foreach($opp_vendu as $opp_vendus){
                $opp = DB::table('opportunites')->where('id', $opp_vendus->opportunite_id)->first();
                $nvx_clientss = DB::table('prospects')->where('id', $opp->prospect_id)->get(); 
                foreach($nvx_clientss as $nvx_clientsss){
                    array_push($nvx_clients,$nvx_clientsss);
                }
            }
        
        return view('base_donnee.nouveaux_clients_tous', compact('nvx_clients'));
    }
    
    
       public function nouveaux_clients_tous_pass()
    {
        $mois = (date('m') - 1);
        $annee = date('Y');
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $nvx_clients = array();  
        $opp_vendu = DB::table('ventes')->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->orderBy('created_at', 'desc')->get(); 
            foreach($opp_vendu as $opp_vendus){
                $opp = DB::table('opportunites')->where('id', $opp_vendus->opportunite_id)->first();
                $nvx_clientss = DB::table('prospects')->where('id', $opp->prospect_id)->get(); 
                foreach($nvx_clientss as $nvx_clientsss){
                    array_push($nvx_clients,$nvx_clientsss);
                }
            }
        
        return view('base_donnee.nouveaux_clients_tous_pass', compact('nvx_clients'));
    }


   public function nouveaux_clients_tous_passFiltre(Request $request)
    {
        $serachCom = $request->get('serachCom');
        $serachPays = $request->get('serachPays');
        $serachprospect = $request->get('serachprospect');
        
        $mois = (date('m') - 1);
        $annee = date('Y');
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $nvx_clients = array();  
        $opp_vendu = DB::table('ventes')->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->orderBy('created_at', 'desc')->where('commercial_id','like', '%'.$serachCom.'%')
        ->orwhereIn('commercial_id',[$serachCom])->get(); 
            foreach($opp_vendu as $opp_vendus){
                $opp = DB::table('opportunites')->where('id', $opp_vendus->opportunite_id)->first();
                $nvx_clientss = DB::table('prospects')->where('id', $opp->prospect_id)->get(); 
                foreach($nvx_clientss as $nvx_clientsss){
                    array_push($nvx_clients,$nvx_clientsss);
                }
            }
        
        return view('base_donnee.nouveaux_clients_tous_pass', compact('nvx_clients'));
    }


    
    public function lister_bdd_chaud()
    {
        $me = Commerciau::where('user_id', Auth::user()->id)->first();
        $bdd_prospects = DB::table('bdd_prospects')->where('statut',null)->where('taille_prospect','Grande')->orderBy('nom_entreprise')->paginate(1000);
        
        $villeChecks = DB::table('villes')->pluck('libelle')->toArray();
            $entreprisess = DB::table('bdd_prospects')->pluck('ville')->toArray();
                                        
            $result_comerPpp = array_diff($entreprisess, $villeChecks);
            
            foreach($result_comerPpp as $result_comerPp)
            {
                
                DB::table('villes')->where('libelle', '<>', $result_comerPp)->insert(['libelle' => $result_comerPp]);
            }
       
        return view('base_donnee.lister_bdd_chaud', compact('bdd_prospects'));

    }  
     public function prospect_bddFiltre_chaud(Request $request)
    {
        $serachCom = $request->get('serachCom');
        $serachPays = $request->get('serachPays');
        $serachVille = $request->get('serachVille');
        $serachprospect = $request->get('serachprospect');
        $bdd_prospects = DB::table('bdd_prospects')
        ->where('statut',null)->where('taille_prospect','Grande')
        //->where('commercial_id','like', '%'.$serachCom.'%')
        //->orwhereIn('commercial_id',[$serachCom])
         ->when(request()->has('serachCom'), function($q){
            $q->where('commercial_id', request('serachCom'));
        })
        ->when(request()->has('serachPays'), function($q){
            $q->where('pays', request('serachPays'));
        })
        ->when(request()->has('serachVille'), function($q){
            $q->where('ville', request('serachVille'));
        })
        ->orderBy('nom_entreprise')
        ->paginate(10000);
        
           
        
        return view('base_donnee.lister_bdd_chaud', compact('bdd_prospects'));
    }

    public function ajouter_bdd()
    {
        //
        // $entreprise = Bdd_prospect::find($id);
        $commercial = DB::table('commerciaus')->orderby('prenom')->get();
        $resultat = DB::table('resultat_appels')->orderby('libelle')->get();
        $pay = DB::table('pays')->orderby('libelle')->get();
        $domaine = DB::table('domaines')->orderby('libelle')->get();
        return view('base_donnee.ajouter_bdd', compact('pay', 'domaine', 'resultat', 'commercial'));

    }
  
    public function ajouter_bdd_store(Request $request)
    {
            $message = "Prospect ajouté avec succès";
            
        $today = date('Y-m-d');   
            
        $com_connect = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
        
        $prospect = new Bdd_prospect;
        $prospect->pays = $request->get('pays');
        $prospect->ville =$request->get('ville');
        $prospect->nom_entreprise = $request->get('nom_entreprise');
        $prospect->adresse = $request->get('adresse');
        $prospect->phone = $request->get('phone');
        $prospect->email_entreprise = $request->get('email_entreprise');
        $prospect->site_web = $request->get('site_web');
        $prospect->secteur = $request->get('secteur');
        $prospect->taille_prospect = $request->get('taille_prospect');
        $prospect->type_prospect = $request->get('type_prospect');
        $prospect->commercial_id = $request->get('commercial_id');
        $prospect->commercial2 = $request->get('commercial2');
        $prospect->nom_contact1 = $request->get('nom_contact1');
        $prospect->prenom_contact1 = $request->get('prenom_contact1');
        $prospect->email_contact1 = $request->get('email_contact1');
        $prospect->fonction_contact1 = $request->get('fonction_contact1');
        $prospect->mobile_contact1 = $request->get('mobile_contact1');
        $prospect->whatshap_contact1 = $request->get('whatshap_contact1');
        $prospect->nom_contact2 = $request->get('nom_contact2');
        $prospect->prenom_contact2 = $request->get('prenom_contact2');
        $prospect->email_contact2 = $request->get('email_contact2');
        $prospect->fonction_contact2 = $request->get('fonction_contact2');
        $prospect->mobile_contact2 = $request->get('mobile_contact2');
        $prospect->whatshap_contact2 = $request->get('whatshap_contact2');
        // $prospect->commercial_id = $commercial->id;
        $prospect->save();
                
              
        return redirect('/lister_bdd')->with(['message' => $message]);
    }
}