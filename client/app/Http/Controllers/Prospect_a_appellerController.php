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
use App\Imports\ImportUserMe;
use App\Exports\ExportUser;
use App\Exports\ExportPlanning;

class Prospect_a_appellerController extends Controller
{
    use AuthenticatesUsers;




 public function insert_pays()
    {
        $commerciaux = DB::table('commerciaus')->get();
        $jour = array();
        foreach($commerciaux as $commerciau)
        {
            DB::table('suivi_prospects')
                ->whereIn('commercial_id', [$commerciau->id])
                ->update(['pays_id' => $commerciau->pays_id]);
                
            $jour_created = DB::table('suivi_prospects')
                ->where('commercial_id', $commerciau->id)->get();
                foreach($jour_created as $jour_createds)
                {
                    array_push($jour, $jour_createds);
                }
            
        }
        
        foreach($jour as $jours)
                {
                    $day = date('Y-m-d', strtotime($jours->created_at));
                    DB::table('suivi_prospects')
                    ->whereIn('id', [$jours->id])
                    ->update(['jour' => $day]);
                }
            
        echo 'yes is okay';
    }
    


public function appel_parjour()
    {
        $mois = date('m');
        $day = date('13');
        $annee = date('Y');
        
        $commerciaux = DB::table('commerciaus')->groupBy('pays_id')->get();
        $appel_parjour = DB::table('suivi_prospects')->whereMonth('created_at', $mois)->where('jour', '!=', null)->groupBy('jour')->get();
        
        $appel_parjour_count = DB::table('suivi_prospects')->whereYear('created_at', $annee)->whereDay('created_at', $day)->whereMonth('created_at', $mois)->count();
        return view('helloventesV2.appel_parjour', compact('commerciaux','appel_parjour'));

    }
    
public function appel_parpays()
    {
        $mois = date('m');
        $day = date('13');
        $annee = date('Y');
        
        $appel_parpays = DB::table('suivi_prospects')
        ->select('suivi_prospects.*', 'pays.id as ID', 'pays.libelle', DB::raw('count(suivi_prospects.pays_id) as `total`'))
        ->join('pays','pays.id', 'suivi_prospects.pays_id')
        ->whereMonth('suivi_prospects.jour', $mois)
        ->where('suivi_prospects.jour', '!=', null)
        ->where('suivi_prospects.pays_id', '!=', null)
        ->groupBy('suivi_prospects.pays_id')->orderBy('total','DESC')->get();
        // dd($appel_parpays);
        return view('helloventesV2.appel_parpays', compact('appel_parpays'));

    }
    
      public function filtre_appel_parpays(Request $request)
    {
        $mois = date('m');
        $searchMois = $request->get('searchMois');
        
        $appel_parpays = DB::table('suivi_prospects')
        ->select('suivi_prospects.*', 'pays.id as ID', 'pays.libelle', DB::raw('count(suivi_prospects.pays_id) as `total`'))
        ->join('pays','pays.id', 'suivi_prospects.pays_id')
        ->whereMonth('suivi_prospects.jour',$searchMois)
        ->where('suivi_prospects.jour', '!=', null)
        ->where('suivi_prospects.pays_id', '!=', null)
        ->groupBy('suivi_prospects.pays_id')->orderBy('total','DESC')->get();
        
        // $appel_parpays = DB::table('suivi_prospects')->where('jour', '!=', null)->where('pays_id', '!=', null)
        // ->whereMonth('jour','like', '%'.$searchMois.'%')->groupBy('pays_id')->get();
        
        return view('helloventesV2.appel_parpays', compact('appel_parpays'));
    }
    
public function voir_appel_parjour($id)
    {
        //
        $appels = Suivi_prospect::find($id);
        // $split = explode(" ", $id);
        // $jour = $split[0];
        $appels = Suivi_prospect::where('jour', $appels->jour)->where('pays_id', $appels->pays_id)->get();
        
        return view('helloventesV2.voir_appel_parjour', compact('appels'));

    }
    
    public function voir_rv_parjour($id)
    {
        //
        $appels = Suivi_prospect::find($id);
        // $split = explode(" ", $id);
        // $jour = $split[0];
        $appels = Suivi_prospect::where('jour', $appels->jour)->where('pays_id', $appels->pays_id)->where('type', 1)->where('choix_qualifier', 'Rendez-vous obtenu')->get();
        
        return view('helloventesV2.rv_parjour', compact('appels'));

    }
  
public function voir_parjour($id)
    {
        $mois = date('m');
        // $appels = Suivi_prospect::find($id);
        $split = explode(" ", $id);
        $pays_id = $split[0];
        $appel_parjour = Suivi_prospect::where('pays_id', $pays_id)->whereMonth('jour', $mois)->groupBy('jour')->get();
        
        return view('helloventesV2.appel_parjour', compact('appel_parjour','pays_id'));

    }
  
      
       public function nouveaux_clients()
    {
        $mois = date('m');
        $annee = date('Y');
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $nvx_clients = array();  
        $opp_vendu = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->orderBy('created_at', 'desc')->get(); 
            foreach($opp_vendu as $opp_vendus){
                $opp = DB::table('opportunites')->where('id', $opp_vendus->opportunite_id)->first();
                $nvx_clientss = DB::table('prospects')->where('id', $opp->prospect_id)->get(); 
                foreach($nvx_clientss as $nvx_clientsss){
                    array_push($nvx_clients,$nvx_clientsss);
                }
            }
        
        return view('helloventesV2.nouveaux_clients', compact('nvx_clients'));
    }
    
       public function total_clients()
    {
        $mois = date('m');
        $annee = date('Y');
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $nvx_clientsT = array();  
        $opp_venduT = DB::table('ventes')->where('commercial_id', $commercial->id)->orderBy('created_at', 'desc')->get();
            foreach($opp_venduT as $opp_vendusT){
                $oppT = DB::table('opportunites')->where('id', $opp_vendusT->opportunite_id)->first();
                if($oppT){
                $nvx_clientssT = DB::table('prospects')->where('id', $oppT->prospect_id)->get(); 
                    foreach($nvx_clientssT as $nvx_clientssTs){         
                    array_push($nvx_clientsT,$nvx_clientssTs);
                    }
                }
            }
        
        return view('helloventesV2.total_clients', compact('nvx_clientsT'));
    }
    
    public function ajout_prospect_appeler()
    {
        //
        return view('helloventesV2.ajout_prospect_appeler');

    }
  
    public function store_prospect_appeler(Request $request)
    {
            $message = "Prospect ajouté avec succès";
            $com_connect = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
            
                $entreprise = new Prospect_a_appeller;
                $entreprise->nom_entreprise = $request->get('nom_entreprise');
                $entreprise->nom_contact = $request->get('nom_contact');
                $entreprise->commercial_id = $com_connect->id;
                $entreprise->tel_contact = $request->get('tel_contact');
                $entreprise->besoin_prioritaire = $request->get('besoin_prioritaire');
                $entreprise->pays_id = $request->get('pays_id');
                $entreprise->secteur_activite = $request->get('secteur_activite');
                $entreprise->solution_a_vendre = $request->get('solution_a_vendre');
                // $entreprise->site_web = $request->get('site_web');
                $entreprise->save();
        return redirect('/prospects_a_appeler')->with(['message' => $message]);
    }
    


public function sta_exemple()
        {
            //
            $top_mois = date('m');
            $annee = date('Y');
            
            $weekday = " ";
            
                        $saturday = strtotime('monday this week');
                        
                        
                        foreach (range(0,0) as $day) {
                            $weekday = date("Y-m-d", (($day * 86400) + $saturday));
                        }
          
            $weekday_plus4 = (date('d', strtotime($weekday)) + 4);       
                        
        
        
        $commerciaux = DB::table('suivi_prospects')->select('suivi_prospects.commercial_id','suivi_prospects.created_at','suivi_prospects.type',
        'commerciaus.prenom','commerciaus.nom','commerciaus.id', DB::raw('count(suivi_prospects.type) as `total`'))
                        ->join('commerciaus', 'commerciaus.id', 'suivi_prospects.commercial_id')
                       ->whereYear('suivi_prospects.created_at', $annee)
                        ->whereMonth('suivi_prospects.created_at', $top_mois)
                        ->whereDay('suivi_prospects.created_at', '>=' ,  date('d',  strtotime($weekday)))
                        ->whereDay('suivi_prospects.created_at', '<=' , $weekday_plus4)
                       ->groupBy('suivi_prospects.commercial_id')->orderBy('total','DESC')->get(); 
                        
                
                       
        //$commerciaux = DB::table('commerciaus')->orderby('prenom')->get();
        return view('helloventesV2.sta_exemple', compact('commerciaux'));

    }


public function edit_entreprise_rv($id)
    {
        //
        $entreprise = Prospect_a_appeller::find($id);
        $commercial = DB::table('commerciaus')->orderby('prenom')->get();
        $resultat = DB::table('resultat_appels')->orderby('libelle')->get();
        $pay = DB::table('pays')->orderby('libelle')->get();
        $domaine = DB::table('domaines')->orderby('libelle')->get();
        return view('helloventesV2.edit_entreprise_rv', compact('pay', 'domaine', 'resultat', 'entreprise', 'commercial'));

    }
  
    public function update_entreprise_rv(Request $request, $id)
    {
            $message = "Prospect modifié avec succès";
            
        //     if($request->file('logo')){
        //   $logo = $request->file('logo');
        //   $file_name = $logo->getClientOriginalName();
        //   $logo->move(public_path().'/imgs/', $file_name);
        // }
            
            
                $entreprise = Prospect_a_appeller::findOrFail($id);
                $entreprise->nom_entreprise = $request->get('nom_entreprise');
                $entreprise->email_entreprise = $request->get('email_entreprise');
                $entreprise->commercial_id = $request->get('commercial_id');
                $entreprise->tel_fixe = $request->get('tel_fixe');
                $entreprise->besoin_prioritaire = $request->get('besoin_prioritaire');
                $entreprise->pays_id = $request->get('pays_id');
                $entreprise->autre_besoins = $request->get('autre_besoins');
                $entreprise->secteur_activite = $request->get('secteur_activite');
                $entreprise->tel_contact = $request->get('tel_contact');
                $entreprise->site_web = $request->get('site_web');
                // $entreprise->logo  = (isset($file_name)) ? $file_name : $entreprise->logo;   
                $entreprise->save();
                $suivi = DB::table('suivi_prospects')->where('prospect_appel_id', $entreprise->id)->first();
        return redirect()->route('fiche_prospect_rv', $suivi->id)->with(['message' => $message]);
    }
    
public function edit_entreprise_arappeler($id)
    {
        //
        $entreprise = Prospect_a_appeller::find($id);
        $commercial = DB::table('commerciaus')->orderby('prenom')->get();
        $resultat = DB::table('resultat_appels')->orderby('libelle')->get();
        $pay = DB::table('pays')->orderby('libelle')->get();
        $domaine = DB::table('domaines')->orderby('libelle')->get();
        return view('helloventesV2.edit_entreprise_arappeler', compact('pay', 'domaine', 'resultat', 'entreprise', 'commercial'));

    }
  
    public function update_entreprise_arappeler(Request $request, $id)
    {
            $message = "Prospect modifié avec succès";
            
        //     if($request->file('logo')){
        //   $logo = $request->file('logo');
        //   $file_name = $logo->getClientOriginalName();
        //   $logo->move(public_path().'/imgs/', $file_name);
        // }
            
            
                $entreprise = Prospect_a_appeller::findOrFail($id);
                $entreprise->nom_entreprise = $request->get('nom_entreprise');
                $entreprise->email_entreprise = $request->get('email_entreprise');
                $entreprise->commercial_id = $request->get('commercial_id');
                $entreprise->tel_fixe = $request->get('tel_fixe');
                $entreprise->besoin_prioritaire = $request->get('besoin_prioritaire');
                $entreprise->pays_id = $request->get('pays_id');
                $entreprise->autre_besoins = $request->get('autre_besoins');
                $entreprise->secteur_activite = $request->get('secteur_activite');
                $entreprise->tel_contact = $request->get('tel_contact');
                $entreprise->site_web = $request->get('site_web');
                // $entreprise->logo  = (isset($file_name)) ? $file_name : $entreprise->logo;   
                $entreprise->save();
                $suivi = DB::table('suivi_prospects')->where('prospect_appel_id', $entreprise->id)->first();
        return redirect()->route('fiche_prospect_a_rappaler', $suivi->id)->with(['message' => $message]);
    }
    
public function edit_entreprise_nonqualifier($id)
    {
        //
        $entreprise = Prospect_a_appeller::find($id);
        $commercial = DB::table('commerciaus')->orderby('prenom')->get();
        $resultat = DB::table('resultat_appels')->orderby('libelle')->get();
        $pay = DB::table('pays')->orderby('libelle')->get();
        $domaine = DB::table('domaines')->orderby('libelle')->get();
        return view('helloventesV2.edit_entreprise_nonqualifier', compact('pay', 'domaine', 'resultat', 'entreprise', 'commercial'));

    }
  
    public function update_entreprise_nonqualifier(Request $request, $id)
    {
            $message = "Prospect modifié avec succès";
            
        //     if($request->file('logo')){
        //   $logo = $request->file('logo');
        //   $file_name = $logo->getClientOriginalName();
        //   $logo->move(public_path().'/imgs/', $file_name);
        // }
            
            
                $entreprise = Prospect_a_appeller::findOrFail($id);
                $entreprise->nom_entreprise = $request->get('nom_entreprise');
                $entreprise->email_entreprise = $request->get('email_entreprise');
                $entreprise->commercial_id = $request->get('commercial_id');
                $entreprise->tel_fixe = $request->get('tel_fixe');
                $entreprise->besoin_prioritaire = $request->get('besoin_prioritaire');
                $entreprise->pays_id = $request->get('pays_id');
                $entreprise->autre_besoins = $request->get('autre_besoins');
                $entreprise->secteur_activite = $request->get('secteur_activite');
                $entreprise->tel_contact = $request->get('tel_contact');
                $entreprise->site_web = $request->get('site_web');
                // $entreprise->logo  = (isset($file_name)) ? $file_name : $entreprise->logo;   
                $entreprise->save();
                $suivi = DB::table('suivi_prospects')->where('prospect_appel_id', $entreprise->id)->first();
        return redirect()->route('fiche_prospect_non_qualifiers', $suivi->id)->with(['message' => $message]);
    }

public function edit_entreprise_qualifier($id)
    {
        //
        $entreprise = Prospect_a_appeller::find($id);
        $commercial = DB::table('commerciaus')->orderby('prenom')->get();
        $resultat = DB::table('resultat_appels')->orderby('libelle')->get();
        $pay = DB::table('pays')->orderby('libelle')->get();
        $domaine = DB::table('domaines')->orderby('libelle')->get();
        return view('helloventesV2.edit_entreprise_qualifier', compact('pay', 'domaine', 'resultat', 'entreprise', 'commercial'));

    }
  
    public function update_entreprise_qualifier(Request $request, $id)
    {
            $message = "Prospect modifié avec succès";
            
        //     if($request->file('logo')){
        //   $logo = $request->file('logo');
        //   $file_name = $logo->getClientOriginalName();
        //   $logo->move(public_path().'/imgs/', $file_name);
        // }
            
            
                $entreprise = Prospect_a_appeller::findOrFail($id);
                $entreprise->nom_entreprise = $request->get('nom_entreprise');
                $entreprise->email_entreprise = $request->get('email_entreprise');
                $entreprise->commercial_id = $request->get('commercial_id');
                $entreprise->tel_fixe = $request->get('tel_fixe');
                $entreprise->besoin_prioritaire = $request->get('besoin_prioritaire');
                $entreprise->pays_id = $request->get('pays_id');
                $entreprise->autre_besoins = $request->get('autre_besoins');
                $entreprise->secteur_activite = $request->get('secteur_activite');
                $entreprise->tel_contact = $request->get('tel_contact');
                $entreprise->site_web = $request->get('site_web');
                // $entreprise->logo  = (isset($file_name)) ? $file_name : $entreprise->logo;   
                $entreprise->save();
                $suivi = DB::table('suivi_prospects')->where('prospect_appel_id', $entreprise->id)->first();
        return redirect()->route('fiche_prospect_qualifiers', $suivi->id)->with(['message' => $message]);
    }

public function edit_entreprise_resultat($id)
    {
        //
        $entreprise = Prospect_a_appeller::find($id);
        $commercial = DB::table('commerciaus')->orderby('prenom')->get();
        $resultat = DB::table('resultat_appels')->orderby('libelle')->get();
        $pay = DB::table('pays')->orderby('libelle')->get();
        $domaine = DB::table('domaines')->orderby('libelle')->get();
        return view('helloventesV2.edit_entreprise_a', compact('pay', 'domaine', 'resultat', 'entreprise', 'commercial'));

    }
  
    public function update_entreprise_resultat(Request $request, $id)
    {
            $message = "Prospect modifié avec succès";
            
        //     if($request->file('logo')){
        //   $logo = $request->file('logo');
        //   $file_name = $logo->getClientOriginalName();
        //   $logo->move(public_path().'/imgs/', $file_name);
        // }
            
            
                $entreprise = Prospect_a_appeller::findOrFail($id);
                $entreprise->nom_entreprise = $request->get('nom_entreprise');
                $entreprise->email_entreprise = $request->get('email_entreprise');
                $entreprise->commercial_id = $request->get('commercial_id');
                $entreprise->tel_fixe = $request->get('tel_fixe');
                $entreprise->besoin_prioritaire = $request->get('besoin_prioritaire');
                $entreprise->pays_id = $request->get('pays_id');
                $entreprise->autre_besoins = $request->get('autre_besoins');
                $entreprise->secteur_activite = $request->get('secteur_activite');
                $entreprise->tel_contact = $request->get('tel_contact');
                $entreprise->site_web = $request->get('site_web');
                // $entreprise->logo  = (isset($file_name)) ? $file_name : $entreprise->logo;   
                $entreprise->save();
        return redirect()->route('fiche_prospect_resultat', $entreprise->id)->with(['message' => $message]);
    }


public function edit_prospect_effectuer($id)
    {
        //
        $entreprise = Prospect_a_appeller::find($id);
        $commercial = DB::table('commerciaus')->orderby('prenom')->get();
        $resultat = DB::table('resultat_appels')->orderby('libelle')->get();
        $pay = DB::table('pays')->orderby('libelle')->get();
        $domaine = DB::table('domaines')->orderby('libelle')->get();
        return view('helloventesV2.edit_prospect_effectuer', compact('pay', 'domaine', 'resultat', 'entreprise', 'commercial'));

    }
  
    public function update_prospect_effectuer(Request $request, $id)
    {
            $message = "Prospect modifié avec succès";
            
        //     if($request->file('logo')){
        //   $logo = $request->file('logo');
        //   $file_name = $logo->getClientOriginalName();
        //   $logo->move(public_path().'/imgs/', $file_name);
        // }
        
                
                            $today = date('Y-m-d');    

               $entreprise = Prospect_a_appeller::findOrFail($id);
                $entreprise->nom_entreprise = $request->get('nom_entreprise');
                $entreprise->email_entreprise = $request->get('email_entreprise');
                $entreprise->commercial_id = $request->get('commercial_id');
                $entreprise->tel_fixe = $request->get('tel_fixe');
                $entreprise->besoin_prioritaire = $request->get('besoin_prioritaire');
                $entreprise->pays_id = $request->get('pays_id');
                $entreprise->autre_besoins = $request->get('autre_besoins');
                $entreprise->secteur_activite = $request->get('secteur_activite');
                $entreprise->tel_contact = $request->get('tel_contact');
                $entreprise->site_web = $request->get('site_web');
                // $entreprise->logo  = (isset($file_name)) ? $file_name : $entreprise->logo;   
                $entreprise->save();
                
                $com_pays = DB::table('commerciaus')->where('id', $entreprise->commercial_id)->first();
                
                $suivi = new Suivi_prospect;
                $suivi->prospect_appel_id = $entreprise->id;
                $suivi->type = $request->get('type');
                $suivi->choix_qualifier = $request->get('choix_qualifier');
                $suivi->choix_a_rappeler = $request->get('choix_a_rappeler');
                $suivi->choix_non_qualifier = $request->get('choix_non_qualifier');
                $suivi->domaine_valider = $request->get('domaine_valider');
                $suivi->personne_a_contacter = $request->get('personne_a_contacter');
                $suivi->date_depot_offre = $request->get('date_depot_offre');
                $suivi->date_depot_agreement = $request->get('date_depot_agreement');
                $suivi->commercial_suivi = $request->get('commercial_suivi');
                $suivi->commentaire_qualifier = $request->get('commentaire_qualifier');
                $suivi->heure_rv = $request->get('heure_rv');
                $suivi->raison_no_qualifier = $request->get('raison_no_qualifier');
                $suivi->date_relance_noqualifier = $request->get('date_relance_noqualifier');
                $suivi->demande_rappel = $request->get('demande_rappel');
                $suivi->besoin_rappel = $request->get('besoin_rappel');
                $suivi->contact_personne = $request->get('contact_personne');
                $suivi->email_personne = $request->get('email_personne');
                $suivi->date_rendezvous = $request->get('date_rendezvous');
                $suivi->libelle_rv = $request->get('libelle_rv');
                $suivi->contact_rv = $request->get('contact_rv');
                $suivi->lieu_rv = $request->get('lieu_rv');
                $suivi->commentaire_rv = $request->get('commentaire_rv');
                $suivi->injoignable_comm = $request->get('injoignable_comm');
                $suivi->personne_rv = $request->get('personne_rv');
                $suivi->resume = $request->get('resume');
                $suivi->date_rappel = $request->get('date_rappel');
                $suivi->commercial_id = $entreprise->commercial_id;
                $suivi->pays_id = $com_pays->pays_id;
                $suivi->jour = $today;
                if($suivi->type){
                $suivi->save();
                }
                
                
                $comm = DB::table('commerciaus')->where('id', $suivi->commercial_id)->first();
                $com_suivi = DB::table('commerciaus')->where('id', $suivi->commercial_suivi)->first();
                $sup_suivi = DB::table('suivi_prospects')->where('prospect_appel_id', $suivi->prospect_appel_id)->orderby('id', 'asc')->first();
                if($suivi->type == 1){
                    DB::table('prospects')->insert(['nom_entreprise' => $entreprise->nom_entreprise, 'secteur_pros_a_appeler' => $entreprise->secteur_activite, 'suivi_prospect' => $suivi->id, 'phone' => $entreprise->tel_contact, 'pays_id' => $entreprise->pays_id, 'provenance' => 'Prospect appelé', 'secteur_activite' => $entreprise->secteur_activite, 'superieur_id' => $com_suivi->superieur_id, 'email_entreprise' => $entreprise->email_entreprise, 'commercial_id' => $suivi->commercial_suivi,  'created_at' => $suivi->updated_at,  'updated_at' => $suivi->updated_at]);
                
                    DB::table('prospects')->where('suivi_prospect', $sup_suivi->id)->delete();
                }
                
                DB::table('suivi_prospects')->where('id', $sup_suivi->id)->where('id', '!=', $suivi->id)->delete();
                
                if($suivi->type){
                    DB::table('prospect_a_appellers')->where('id', $suivi->prospect_appel_id)->update(['statut' => 1]);
                }
                
               
                
                
                 $pros = DB::table('prospects')->where('suivi_prospect', $suivi->id)->first();
               
                if($suivi->type == 1 and $suivi->choix_qualifier == "Rendez-vous obtenu"){
                    DB::table('prospections')->insert(['date' => $suivi->date_rendezvous, 'heure_debut' => $suivi->heure_rv, 'lieu' => $suivi->lieu_rv, 'prospect_id' => $pros->id, 'suivi_prospect' => $suivi->id, 'superieur_id' => $comm->superieur_id, 'commercial_id' => $suivi->commercial_id,  'created_at' => $suivi->updated_at,  'updated_at' => $suivi->updated_at]);
                }
                
        return redirect('/appels_effectuer')->with(['message' => $message]);
    }
    
    
    
 public function filtrer_sta_commerciaux_appels(Request $request)
    {
        $searchCommerciaucf = $request->get('searchCommerciaucf');
        // $commerciaux = DB::table('commerciaus')->where('id','like', '%'.$searchCommerciaucf.'%')->whereIn('id',[$searchCommerciaucf])->orderby('prenom')->get();
        
         $top_mois = date('m');
            $annee = date('Y');
            
            $weekday = " ";
            
                        $saturday = strtotime('monday this week');
                        
                        
                        foreach (range(0,0) as $day) {
                            $weekday = date("Y-m-d", (($day * 86400) + $saturday));
                        }
          
            $weekday_plus4 = (date('d', strtotime($weekday)) + 4);       
                        
        
        
        $commerciaux = DB::table('suivi_prospects')->select('suivi_prospects.commercial_id','suivi_prospects.created_at','suivi_prospects.type',
        'commerciaus.prenom','commerciaus.nom','commerciaus.id', DB::raw('count(suivi_prospects.type) as `total`'))
                        ->join('commerciaus', 'commerciaus.id', 'suivi_prospects.commercial_id')
                       ->whereYear('suivi_prospects.created_at', $annee)
                        ->whereMonth('suivi_prospects.created_at', $top_mois)
                        ->whereDay('suivi_prospects.created_at', '>=' ,  date('d',  strtotime($weekday)))
                        ->whereDay('suivi_prospects.created_at', '<=' , $weekday_plus4)
                        ->where('commerciaus.id','like', '%'.$searchCommerciaucf.'%')
                        ->whereIn('commerciaus.id',[$searchCommerciaucf])
                       ->groupBy('suivi_prospects.commercial_id')->orderBy('total','DESC')->get();
        return view('helloventesV2.sta_commerciaux_appels', compact('commerciaux'));
    }
    
    
    public function appels_mois()
        {
            //

        //$commerciaux = DB::table('commerciaus')->orderby('prenom')->get();
        
         $top_mois = date('m');
            $annee = date('Y');
        
        
                       
        $commerciaux = DB::table('suivi_prospects')->select('suivi_prospects.commercial_id','suivi_prospects.created_at','suivi_prospects.type',
        'commerciaus.prenom','commerciaus.nom','commerciaus.id', DB::raw('count(suivi_prospects.type) as `total`'))
                        ->join('commerciaus', 'commerciaus.id', 'suivi_prospects.commercial_id')
                       ->whereYear('suivi_prospects.created_at', $annee)
                        ->whereMonth('suivi_prospects.created_at', $top_mois)
                       ->groupBy('suivi_prospects.commercial_id')->orderBy('total','DESC')->get(); 
                        
                      
        return view('helloventesV2.appels_mois', compact('commerciaux'));

    }
    public function filtrer_sta_commerciaux_appels_mois(Request $request)
        {
        $searchCommerciaucf = $request->get('searchCommerciaucf');
        // $commerciaux = DB::table('commerciaus')->where('id','like', '%'.$searchCommerciaucf.'%')->whereIn('id',[$searchCommerciaucf])->orderby('prenom')->get();
        
         $top_mois = date('m');
            $annee = date('Y');
        
        
                       
        $commerciaux = DB::table('suivi_prospects')->select('suivi_prospects.commercial_id','suivi_prospects.created_at','suivi_prospects.type',
        'commerciaus.prenom','commerciaus.nom','commerciaus.id', DB::raw('count(suivi_prospects.type) as `total`'))
                        ->join('commerciaus', 'commerciaus.id', 'suivi_prospects.commercial_id')
                       ->whereYear('suivi_prospects.created_at', $annee)
                        ->whereMonth('suivi_prospects.created_at', $top_mois)
                        ->where('commerciaus.id','like', '%'.$searchCommerciaucf.'%')
                        ->whereIn('commerciaus.id',[$searchCommerciaucf])
                       ->groupBy('suivi_prospects.commercial_id')->orderBy('total','DESC')->get(); 
        
        return view('helloventesV2.appels_mois', compact('commerciaux'));

    }
    
    
    public function sta_commerciaux_appels_nbreffectuer_semaine($id)
        {
            //
        $mois = date('m');
                            $annee = date('Y'); 
        $commercial = Commerciau::find($id);
        return view('helloventesV2.semaine_appel_realiser', compact('commercial','mois', 'annee'));

    }
    
    public function sta_commerciaux_appels_nbrqualifier_semaine($id)
        {
            //
          $mois = date('m');
                            $annee = date('Y'); 
        $commercial = Commerciau::find($id);
        return view('helloventesV2.semaine_appel_qualifier', compact('commercial','mois', 'annee'));

    }
    
    public function sta_commerciaux_appels_nbrnonqualifier_semaine($id)
        {
            //
            
            $mois = date('m');
                            $annee = date('Y'); 

        $commercial = Commerciau::find($id);
        return view('helloventesV2.semaine_appel_non_qualifier', compact('commercial','mois', 'annee'));

    }
    
    public function sta_commerciaux_appels_nbrappeler_semaine($id)
        {
            //
       
        $mois = date('m');
                            $annee = date('Y'); 
        $commercial = Commerciau::find($id);
        return view('helloventesV2.semaine_appel_a_rappeler', compact('commercial','mois', 'annee'));

    }
    
     public function sta_commerciaux_appels_rv_semaine($id)
        {
            //
       $mois = date('m');
                            $annee = date('Y'); 
        
        $commercial = Commerciau::find($id);
        return view('helloventesV2.semaine_appel_rv_obtenu', compact('commercial','mois', 'annee'));

    }
    
     public function sta_commerciaux_appels()
        {
            //

        $top_mois = date('m');
            $annee = date('Y');
            
            $weekday = " ";
            
                        $saturday = strtotime('monday this week');
                        
                        
                        foreach (range(0,0) as $day) {
                            $weekday = date("Y-m-d", (($day * 86400) + $saturday));
                        }
          
            $weekday_plus4 = (date('d', strtotime($weekday)) + 4);       
                        
        
        
        $commerciaux = DB::table('suivi_prospects')->select('suivi_prospects.commercial_id','suivi_prospects.created_at','suivi_prospects.type',
        'commerciaus.prenom','commerciaus.nom','commerciaus.id', DB::raw('count(suivi_prospects.type) as `total`'))
                        ->join('commerciaus', 'commerciaus.id', 'suivi_prospects.commercial_id')
                       ->whereYear('suivi_prospects.created_at', $annee)
                        ->whereMonth('suivi_prospects.created_at', $top_mois)
                        ->whereDay('suivi_prospects.created_at', '>=' ,  date('d',  strtotime($weekday)))
                        ->whereDay('suivi_prospects.created_at', '<=' , $weekday_plus4)
                       ->groupBy('suivi_prospects.commercial_id')->orderBy('total','DESC')->get(); 
        
        return view('helloventesV2.sta_commerciaux_appels', compact('commerciaux'));

    }
    
    public function sta_commerciaux_appels_nbreffecter($id)
        {
            //
        $mois = date('m');
                            $annee = date('Y'); 
        $commercial = Commerciau::find($id);
        return view('helloventesV2.sta_commerciaux_appels_nbreffecter', compact('commercial','mois', 'annee'));

    }
    
    public function sta_commerciaux_appels_nbreffectuer_today($id)
        {
            $today = date('d');
        $mois = date('m');
                            $annee = date('Y'); 
        $commercial = Commerciau::find($id);
        return view('helloventesV2.sta_commerciaux_appels_nbreffectuer_today', compact('commercial','mois', 'annee', 'today'));

    }
    
    public function sta_commerciaux_appels_nbreffectuer($id)
        {
            //
        $mois = date('m');
                            $annee = date('Y'); 
        $commercial = Commerciau::find($id);
        return view('helloventesV2.sta_commerciaux_appels_nbreffectuer', compact('commercial','mois', 'annee'));

    }
    
    public function sta_commerciaux_appels_nbrqualifier($id)
        {
            //
          $mois = date('m');
                            $annee = date('Y'); 
        $commercial = Commerciau::find($id);
        return view('helloventesV2.sta_commerciaux_appels_nbrqualifier', compact('commercial','mois', 'annee'));

    }
    
    public function sta_commerciaux_appels_nbrnonqualifier($id)
        {
            //
            
            $mois = date('m');
                            $annee = date('Y'); 

        $commercial = Commerciau::find($id);
        return view('helloventesV2.sta_commerciaux_appels_nbrnonqualifier', compact('commercial','mois', 'annee'));

    }
    
    public function sta_commerciaux_appels_nbrappeler($id)
        {
            //
       
        $mois = date('m');
                            $annee = date('Y'); 
        $commercial = Commerciau::find($id);
        return view('helloventesV2.sta_commerciaux_appels_nbrappeler', compact('commercial','mois', 'annee'));

    }
    
     public function sta_commerciaux_appels_rv($id)
        {
            //
       $mois = date('m');
                            $annee = date('Y'); 
        
        $commercial = Commerciau::find($id);
        return view('helloventesV2.sta_commerciaux_appels_rv', compact('commercial','mois', 'annee'));

    }
    
    public function sta_commerciaux_appels_nbrpvendre($id)
        {
            //
          $mois = date('m');
                            $annee = date('Y'); 
        $commercial = Commerciau::find($id);
        return view('helloventesV2.sta_commerciaux_appels_nbrpvendre', compact('commercial','mois', 'annee'));

    }
    
    public function edit_prospect_qualifier($id)
    {
        //
         $entreprise = Suivi_prospect::find($id);
        
        $commercial = DB::table('commerciaus')->orderby('prenom')->get();
        $suivi_qualifier = DB::table('suivi_qualifiers')->orderby('libelle')->get();
        $suivi_q = DB::table('suivi_prospects')->where('id', $entreprise->id)->first();
        $resultat = DB::table('resultat_appels')->orderby('libelle')->get();
        $domaine = DB::table('domaines')->orderby('libelle')->get();
        return view('helloventesV2.edit_prospect_qualifier', compact('suivi_q', 'suivi_qualifier', 'entreprise', 'commercial','resultat','domaine'));

    }
  
    public function update_prospect_qualifier(Request $request, $id)
    {
            $message = "Prospect modifié avec succès";
     
                /*$entreprise = Prospect_a_appeller::findOrFail($id);
                $entreprise->nom_entreprise = $request->get('nom_entreprise');
                $entreprise->email_entreprise = $request->get('email_entreprise');
                $entreprise->commercial_id = $request->get('commercial_id');
                $entreprise->tel_fixe = $request->get('tel_fixe');
                $entreprise->besoin_prioritaire = $request->get('besoin_prioritaire');
                $entreprise->autre_besoins = $request->get('autre_besoins');
                $entreprise->secteur_activite = $request->get('secteur_activite');
                $entreprise->tel_contact = $request->get('tel_contact');
                $entreprise->save();*/
                

                $suivi = Suivi_prospect::findOrFail($id);
                $suivi->domaine_valider = $request->get('domaine_valider');
                $suivi->personne_a_contacter = $request->get('personne_a_contacter');
                $suivi->contact_personne = $request->get('contact_personne');
                $suivi->email_personne = $request->get('email_personne');
                $suivi->etat_qualifier = $request->get('etat_qualifier');
                $suivi->date_rendezvous = $request->get('date_rendezvous');
                $suivi->libelle_rv = $request->get('libelle_rv');
                $suivi->commentaire_rv = $request->get('commentaire_rv');
                $suivi->injoignable_comm = $request->get('injoignable_comm');
                $suivi->centre_dinteret = $request->get('centre_dinteret');
                $suivi->personne_rv = $request->get('personne_rv');
                $suivi->resume = $request->get('resume');
                $suivi->date_rappel = $request->get('date_rappel');
                $suivi->save();
                
        return redirect('/appelsaqualifier')->with(['message' => $message]);
    }
    
    
    
    public function edit_prospect_non_qualifier($id)
    {
        //
        $entreprise = Suivi_prospect::find($id);
        
        $commercial = DB::table('commerciaus')->orderby('prenom')->get();
        $suivi_qualifier = DB::table('suivi_qualifiers')->orderby('libelle')->get();
        $suivi_q = DB::table('suivi_prospects')->where('id', $entreprise->id)->first();
        $resultat = DB::table('resultat_appels')->orderby('libelle')->get();
        $domaine = DB::table('domaines')->orderby('libelle')->get();
        return view('helloventesV2.edit_prospect_non_qualifier', compact('suivi_q', 'suivi_qualifier', 'entreprise', 'commercial','resultat','domaine'));

    }
  
    public function update_prospect_non_qualifier(Request $request, $id)
    {
            $message = "Prospect modifié avec succès";
            
            $com_connect = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                
                $suivi = Suivi_prospect::findOrFail($id);
                $suivi->type = $request->get('type');
                $suivi->choix_qualifier = $request->get('choix_qualifier');
                $suivi->choix_a_rappeler = $request->get('choix_a_rappeler');
                $suivi->choix_non_qualifier = $request->get('choix_non_qualifier');
                $suivi->domaine_valider = $request->get('domaine_valider');
                $suivi->personne_a_contacter = $request->get('personne_a_contacter');
                $suivi->date_depot_offre = $request->get('date_depot_offre');
                $suivi->date_depot_agreement = $request->get('date_depot_agreement');
                $suivi->commercial_suivi = $request->get('commercial_suivi');
                $suivi->commentaire_qualifier = $request->get('commentaire_qualifier');
                $suivi->heure_rv = $request->get('heure_rv');
                $suivi->raison_no_qualifier = $request->get('raison_no_qualifier');
                $suivi->date_relance_noqualifier = $request->get('date_relance_noqualifier');
                $suivi->demande_rappel = $request->get('demande_rappel');
                $suivi->besoin_rappel = $request->get('besoin_rappel');
                $suivi->contact_personne = $request->get('contact_personne');
                $suivi->email_personne = $request->get('email_personne');
                $suivi->date_rendezvous = $request->get('date_rendezvous');
                $suivi->libelle_rv = $request->get('libelle_rv');
                $suivi->contact_rv = $request->get('contact_rv');
                $suivi->lieu_rv = $request->get('lieu_rv');
                $suivi->commentaire_rv = $request->get('commentaire_rv');
                $suivi->injoignable_comm = $request->get('injoignable_comm');
                $suivi->personne_rv = $request->get('personne_rv');
                $suivi->resume = $request->get('resume');
                $suivi->date_rappel = $request->get('date_rappel');
                if($suivi->commercial_suivi == NULL)
                {
                    $suivi->commercial_suivi = $com_connect->id;
                }
                if($suivi->type){
                $suivi->save();
                }
                
                $com_suivi = DB::table('commerciaus')->where('id', $suivi->commercial_suivi)->first();
                $entreprise = DB::table('prospect_a_appellers')->where('id', $suivi->prospect_appel_id)->first();
                if($suivi->type == 1){
                    DB::table('prospects')->insert(['nom_entreprise' => $entreprise->nom_entreprise, 'secteur_pros_a_appeler' => $entreprise->secteur_activite, 'suivi_prospect' => $suivi->id, 'phone' => $entreprise->tel_contact, 'pays_id' => $entreprise->pays_id, 'provenance' => 'Prospect appelé', 'secteur_activite' => $entreprise->secteur_activite, 'superieur_id' => $com_suivi->superieur_id, 'email_entreprise' => $entreprise->email_entreprise,  'commercial_id' => $suivi->commercial_suivi,  'created_at' => $suivi->updated_at,  'updated_at' => $suivi->updated_at]);
                }
                
                $pros = DB::table('prospects')->where('suivi_prospect', $suivi->id)->first();
               $comm = DB::table('commerciaus')->where('id', $suivi->commercial_id)->first();
                if($suivi->type == 1 and $suivi->choix_qualifier == "Rendez-vous obtenu"){
                    DB::table('prospections')->insert(['date' => $suivi->date_rendezvous, 'heure_debut' => $suivi->heure_rv, 'lieu' => $suivi->lieu_rv, 'prospect_id' => $pros->id, 'suivi_prospect' => $suivi->id, 'superieur_id' => $comm->superieur_id, 'commercial_id' => $suivi->commercial_id,  'created_at' => $suivi->updated_at,  'updated_at' => $suivi->updated_at]);
                }
        return redirect('/appelsnonqualifier')->with(['message' => $message]);
    }
    
     public function edit_prospect_a_rappaler($id)
    {
        //
        $entreprise = Suivi_prospect::find($id);
        
        $commercial = DB::table('commerciaus')->orderby('prenom')->get();
        $suivi_qualifier = DB::table('suivi_qualifiers')->orderby('libelle')->get();
        $suivi_q = DB::table('suivi_prospects')->where('id', $entreprise->id)->first();
        $resultat = DB::table('resultat_appels')->orderby('libelle')->get();
        $domaine = DB::table('domaines')->orderby('libelle')->get();
        return view('helloventesV2.edit_prospect_a_rappaler', compact('suivi_q', 'suivi_qualifier', 'entreprise', 'commercial','resultat','domaine'));

    }
  
    public function update_prospect_a_rappaler(Request $request, $id)
    {
         $today = date('Y-m-d'); 
            $message = "Prospect modifié avec succès";
                $com_connect = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                $suivi = Suivi_prospect::findOrFail($id);
                $suivi->type = $request->get('type');
                $suivi->choix_qualifier = $request->get('choix_qualifier');
                $suivi->choix_a_rappeler = $request->get('choix_a_rappeler');
                $suivi->choix_non_qualifier = $request->get('choix_non_qualifier');
                $suivi->domaine_valider = $request->get('domaine_valider');
                $suivi->personne_a_contacter = $request->get('personne_a_contacter');
                $suivi->date_depot_offre = $request->get('date_depot_offre');
                $suivi->date_depot_agreement = $request->get('date_depot_agreement');
                $suivi->commercial_suivi = $request->get('commercial_suivi');
                $suivi->commentaire_qualifier = $request->get('commentaire_qualifier');
                $suivi->heure_rv = $request->get('heure_rv');
                $suivi->raison_no_qualifier = $request->get('raison_no_qualifier');
                $suivi->date_relance_noqualifier = $request->get('date_relance_noqualifier');
                $suivi->demande_rappel = $request->get('demande_rappel');
                $suivi->besoin_rappel = $request->get('besoin_rappel');
                $suivi->contact_personne = $request->get('contact_personne');
                $suivi->email_personne = $request->get('email_personne');
                $suivi->date_rendezvous = $request->get('date_rendezvous');
                $suivi->libelle_rv = $request->get('libelle_rv');
                $suivi->contact_rv = $request->get('contact_rv');
                $suivi->lieu_rv = $request->get('lieu_rv');
                $suivi->commentaire_rv = $request->get('commentaire_rv');
                $suivi->injoignable_comm = $request->get('injoignable_comm');
                $suivi->personne_rv = $request->get('personne_rv');
                $suivi->resume = $request->get('resume');
                $suivi->date_rappel = $request->get('date_rappel');
                if($suivi->commercial_suivi == NULL)
                {
                    $suivi->commercial_suivi = $com_connect->id;
                }
                if($suivi->type){
                $suivi->save();
                }
                
                 $com_pays = DB::table('commerciaus')->where('id', $suivi->commercial_id)->first();
               
                
                DB::table('suivi_prospects')->where('id', $suivi->id)->update(['created_at' => $suivi->updated_at, 'pays_id' => $com_pays->pays_id, 'jour' => $today]);
                
                $com_suivi = DB::table('commerciaus')->where('id', $suivi->commercial_suivi)->first();
                $entreprise = DB::table('prospect_a_appellers')->where('id', $suivi->prospect_appel_id)->first();
                if($suivi->type == 1){
                    DB::table('prospects')->insert(['nom_entreprise' => $entreprise->nom_entreprise, 'secteur_pros_a_appeler' => $entreprise->secteur_activite, 'suivi_prospect' => $suivi->id, 'phone' => $entreprise->tel_contact, 'pays_id' => $entreprise->pays_id, 'provenance' => 'Prospect appelé', 'secteur_activite' => $entreprise->secteur_activite, 'superieur_id' => $com_suivi->superieur_id, 'email_entreprise' => $entreprise->email_entreprise, 'commercial_id' => $suivi->commercial_suivi,  'created_at' => $suivi->updated_at,  'updated_at' => $suivi->updated_at]);
                }
                
                $pros = DB::table('prospects')->where('suivi_prospect', $suivi->id)->first();
               $comm = DB::table('commerciaus')->where('id', $suivi->commercial_id)->first();
                if($suivi->type == 1 and $suivi->choix_qualifier == "Rendez-vous obtenu"){
                    DB::table('prospections')->insert(['date' => $suivi->date_rendezvous, 'heure_debut' => $suivi->heure_rv, 'lieu' => $suivi->lieu_rv, 'prospect_id' => $pros->id, 'suivi_prospect' => $suivi->id, 'superieur_id' => $comm->superieur_id, 'commercial_id' => $suivi->commercial_id,  'created_at' => $suivi->updated_at,  'updated_at' => $suivi->updated_at]);
                }
        return redirect('/appels_arappeler')->with(['message' => $message]);
    }
    
    
      public function edit_prospect_rv($id)
    {
        //
        $entreprise = Suivi_prospect::find($id);
        
        $commercial = DB::table('commerciaus')->orderby('prenom')->get();
        $suivi_qualifier = DB::table('suivi_qualifiers')->orderby('libelle')->get();
        $suivi_q = DB::table('suivi_prospects')->where('id', $entreprise->id)->first();
        $resultat = DB::table('resultat_appels')->orderby('libelle')->get();
        $domaine = DB::table('domaines')->orderby('libelle')->get();
        return view('helloventesV2.edit_prospect_rv', compact('suivi_q', 'suivi_qualifier', 'entreprise', 'commercial','resultat','domaine'));

    }
  
    public function update_prospect_rv(Request $request, $id)
    {
            $message = "Prospect modifié avec succès";
                $com_connect = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                $suivi = Suivi_prospect::findOrFail($id);
                $suivi->type = $request->get('type');
                $suivi->choix_qualifier = $request->get('choix_qualifier');
                $suivi->choix_a_rappeler = $request->get('choix_a_rappeler');
                $suivi->choix_non_qualifier = $request->get('choix_non_qualifier');
                $suivi->domaine_valider = $request->get('domaine_valider');
                $suivi->personne_a_contacter = $request->get('personne_a_contacter');
                $suivi->date_depot_offre = $request->get('date_depot_offre');
                $suivi->date_depot_agreement = $request->get('date_depot_agreement');
                $suivi->commercial_suivi = $request->get('commercial_suivi');
                $suivi->commentaire_qualifier = $request->get('commentaire_qualifier');
                $suivi->heure_rv = $request->get('heure_rv');
                $suivi->raison_no_qualifier = $request->get('raison_no_qualifier');
                $suivi->date_relance_noqualifier = $request->get('date_relance_noqualifier');
                $suivi->demande_rappel = $request->get('demande_rappel');
                $suivi->besoin_rappel = $request->get('besoin_rappel');
                $suivi->contact_personne = $request->get('contact_personne');
                $suivi->email_personne = $request->get('email_personne');
                $suivi->date_rendezvous = $request->get('date_rendezvous');
                $suivi->libelle_rv = $request->get('libelle_rv');
                $suivi->contact_rv = $request->get('contact_rv');
                $suivi->lieu_rv = $request->get('lieu_rv');
                $suivi->commentaire_rv = $request->get('commentaire_rv');
                $suivi->injoignable_comm = $request->get('injoignable_comm');
                $suivi->personne_rv = $request->get('personne_rv');
                $suivi->resume = $request->get('resume');
                $suivi->date_rappel = $request->get('date_rappel');
                if($suivi->commercial_suivi == NULL)
                {
                    $suivi->commercial_suivi = $com_connect->id;
                }
                if($suivi->type){
                $suivi->save();
                }
                
                $com_suivi = DB::table('commerciaus')->where('id', $suivi->commercial_suivi)->first();
                $entreprise = DB::table('prospect_a_appellers')->where('id', $suivi->prospect_appel_id)->first();
                if($suivi->type == 1){
                    DB::table('prospects')->insert(['nom_entreprise' => $entreprise->nom_entreprise, 'secteur_pros_a_appeler' => $entreprise->secteur_activite, 'suivi_prospect' => $suivi->id, 'phone' => $entreprise->tel_contact, 'pays_id' => $entreprise->pays_id, 'provenance' => 'Prospect appelé', 'secteur_activite' => $entreprise->secteur_activite, 'superieur_id' => $com_suivi->superieur_id, 'email_entreprise' => $entreprise->email_entreprise, 'commercial_id' => $suivi->commercial_suivi,  'created_at' => $suivi->updated_at,  'updated_at' => $suivi->updated_at]);
                }
                
                $pros = DB::table('prospects')->where('suivi_prospect', $suivi->id)->first();
               $comm = DB::table('commerciaus')->where('id', $suivi->commercial_id)->first();
                if($suivi->type == 1 and $suivi->choix_qualifier == "Rendez-vous obtenu"){
                    DB::table('prospections')->insert(['date' => $suivi->date_rendezvous, 'heure_debut' => $suivi->heure_rv, 'lieu' => $suivi->lieu_rv, 'prospect_id' => $pros->id, 'suivi_prospect' => $suivi->id, 'superieur_id' => $comm->superieur_id, 'commercial_id' => $suivi->commercial_id,  'created_at' => $suivi->updated_at,  'updated_at' => $suivi->updated_at]);
                }
        return redirect('/appels_daterv')->with(['message' => $message]);
    }
    
    
      public function edit_prospect_produit_avendre($id)
    {
        //
        $entreprise = Suivi_prospect::find($id);
        
        $commercial = DB::table('commerciaus')->orderby('prenom')->get();
        $suivi_qualifier = DB::table('suivi_qualifiers')->orderby('libelle')->get();
        $suivi_q = DB::table('suivi_prospects')->where('id', $entreprise->id)->first();
        $resultat = DB::table('resultat_appels')->orderby('libelle')->get();
        $domaine = DB::table('domaines')->orderby('libelle')->get();
        return view('helloventesV2.edit_prospect_produit_avendre', compact('suivi_q', 'suivi_qualifier', 'entreprise', 'commercial','resultat','domaine'));

    }
  
    public function update_prospect_produit_avendre(Request $request, $id)
    {
            $message = "Prospect modifié avec succès";
                $com_connect = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                $suivi = Suivi_prospect::findOrFail($id);
                $suivi->type = $request->get('type');
                $suivi->choix_qualifier = $request->get('choix_qualifier');
                $suivi->choix_a_rappeler = $request->get('choix_a_rappeler');
                $suivi->choix_non_qualifier = $request->get('choix_non_qualifier');
                $suivi->domaine_valider = $request->get('domaine_valider');
                $suivi->personne_a_contacter = $request->get('personne_a_contacter');
                $suivi->date_depot_offre = $request->get('date_depot_offre');
                $suivi->date_depot_agreement = $request->get('date_depot_agreement');
                $suivi->commercial_suivi = $request->get('commercial_suivi');
                $suivi->heure_rv = $request->get('heure_rv');
                $suivi->raison_no_qualifier = $request->get('raison_no_qualifier');
                $suivi->date_relance_noqualifier = $request->get('date_relance_noqualifier');
                $suivi->demande_rappel = $request->get('demande_rappel');
                $suivi->besoin_rappel = $request->get('besoin_rappel');
                $suivi->contact_personne = $request->get('contact_personne');
                $suivi->email_personne = $request->get('email_personne');
                $suivi->date_rendezvous = $request->get('date_rendezvous');
                $suivi->libelle_rv = $request->get('libelle_rv');
                $suivi->contact_rv = $request->get('contact_rv');
                $suivi->lieu_rv = $request->get('lieu_rv');
                $suivi->commentaire_rv = $request->get('commentaire_rv');
                $suivi->injoignable_comm = $request->get('injoignable_comm');
                $suivi->personne_rv = $request->get('personne_rv');
                $suivi->resume = $request->get('resume');
                $suivi->date_rappel = $request->get('date_rappel');
                if($suivi->commercial_suivi == NULL)
                {
                    $suivi->commercial_suivi = $com_connect->id;
                }
                if($suivi->type){
                $suivi->save();
                }
                
                $com_suivi = DB::table('commerciaus')->where('id', $suivi->commercial_suivi)->first();
                $entreprise = DB::table('prospect_a_appellers')->where('id', $suivi->prospect_appel_id)->first();
                if($suivi->type == 1){
                    DB::table('prospects')->insert(['nom_entreprise' => $entreprise->nom_entreprise, 'secteur_pros_a_appeler' => $entreprise->secteur_activite, 'suivi_prospect' => $suivi->id, 'phone' => $entreprise->tel_contact, 'pays_id' => $entreprise->pays_id, 'provenance' => 'Prospect appelé', 'secteur_activite' => $entreprise->secteur_activite, 'superieur_id' => $com_suivi->superieur_id, 'email_entreprise' => $entreprise->email_entreprise, 'commercial_id' => $suivi->commercial_suivi,  'created_at' => $suivi->updated_at,  'updated_at' => $suivi->updated_at]);
                }
                
                $pros = DB::table('prospects')->where('suivi_prospect', $suivi->id)->first();
               $comm = DB::table('commerciaus')->where('id', $suivi->commercial_id)->first();
                if($suivi->type == 1 and $suivi->choix_qualifier == "Rendez-vous obtenu"){
                    DB::table('prospections')->insert(['date' => $suivi->date_rendezvous, 'heure_debut' => $suivi->heure_rv, 'lieu' => $suivi->lieu_rv, 'prospect_id' => $pros->id, 'suivi_prospect' => $suivi->id, 'superieur_id' => $comm->superieur_id, 'commercial_id' => $suivi->commercial_id,  'created_at' => $suivi->updated_at,  'updated_at' => $suivi->updated_at]);
                }
        return redirect('/produit_avendre')->with(['message' => $message]);
    }
    
    
    public function appels_a_effectuer()
    {
         $mois = date('m');
                            $annee = date('Y'); 
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $appels_a_effectuer = DB::table('prospect_a_appellers')->where('commercial_id', $commercial->id)->where('statut', null)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->orderby('nom_entreprise')->get();
        return view('helloventesV2.appels_a_effectuer', compact('appels_a_effectuer'));
    }
    
    public function appels_effectuer()
    {
         $mois = date('m');
                            $annee = date('Y'); 
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $appels_effectuer = DB::table('suivi_prospects')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->orderby('created_at', 'desc')->get();
        return view('helloventesV2.appels_effectuer', compact('appels_effectuer'));
    }
    
    public function appels_effectuer_team()
    {
         $mois = date('m');
                            $annee = date('Y'); 
                            $today = date('d'); 
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $appels_effectuer = DB::table('suivi_prospects')->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->whereDay('created_at', $today)->orderby('created_at', 'desc')->get();
        return view('helloventesV2.appels_effectuer_team', compact('appels_effectuer'));
    }
    
     public function filtre_appels_effectuer_team(Request $request)
        {
        $searchCommerciaucf = $request->get('searchCommerciaucf');
        
         $mois = date('m');
                            $annee = date('Y'); 
                            $today = date('d'); 
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $appels_effectuer = DB::table('suivi_prospects')->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->whereDay('created_at', $today)->where('commercial_id','like', '%'.$searchCommerciaucf.'%')
                        ->whereIn('commercial_id',[$searchCommerciaucf])->orderby('created_at', 'desc')->get();
        return view('helloventesV2.appels_effectuer_team', compact('appels_effectuer'));

    }

    public function filtrer_pros_numero_qualifier(Request $request)
    {
         $mois = date('m');
         $annee = date('Y'); 
         
         $search = $request->get('search');
        $searchnumero = $request->get('searchnumero');
        
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $appelsaqualifier = DB::table('suivi_prospects')->select('suivi_prospects.*',
                        'prospect_a_appellers.id as `ID`','prospect_a_appellers.nom_entreprise','prospect_a_appellers.secteur_activite','prospect_a_appellers.tel_contact','prospect_a_appellers.email_entreprise')
                        ->join('prospect_a_appellers', 'prospect_a_appellers.id', 'suivi_prospects.prospect_appel_id')
                        ->where('suivi_prospects.type', 1)->where('suivi_prospects.commercial_id', $commercial->id)->orderBy('prospect_a_appellers.nom_entreprise', 'asc')
                        ->where('prospect_a_appellers.nom_entreprise','like', '%'.$search.'%')->where('prospect_a_appellers.tel_contact','like', '%'.$searchnumero.'%')->get();
                return view('helloventesV2.appelsaqualifier', compact('appelsaqualifier'));
    }
    
    public function filtrer_pros_numero_nonqualifier(Request $request)
    {
         $mois = date('m');
         $annee = date('Y'); 
         
         $search = $request->get('search');
        $searchnumero = $request->get('searchnumero');
        
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $appelsnonqualifier = DB::table('suivi_prospects')->select('suivi_prospects.*',
                        'prospect_a_appellers.id as `ID`','prospect_a_appellers.nom_entreprise','prospect_a_appellers.secteur_activite','prospect_a_appellers.tel_contact','prospect_a_appellers.email_entreprise')
                        ->join('prospect_a_appellers', 'prospect_a_appellers.id', 'suivi_prospects.prospect_appel_id')
                        ->where('suivi_prospects.type', 2)->where('suivi_prospects.commercial_id', $commercial->id)->orderBy('prospect_a_appellers.nom_entreprise', 'asc')
                        ->where('prospect_a_appellers.nom_entreprise','like', '%'.$search.'%')->where('prospect_a_appellers.tel_contact','like', '%'.$searchnumero.'%')->get();
                return view('helloventesV2.appelsnonqualifier', compact('appelsnonqualifier'));
    }
    
     public function filtrer_pros_numero_rv(Request $request)
    {
        
         $search = $request->get('search');
        $searchnumero = $request->get('searchnumero');
        
        $mois = date('m');
                $annee = date('Y'); 
                 $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
                
                $week = [];
                $saturday = strtotime('monday this week');
                foreach (range(0, 6) as $day) {
                    $week[] = date("Y-m-d", (($day * 86400) + $saturday));
                }
                $rv_today = array();
                foreach($week as $weeks)
                 { 
                    $rv_todays = DB::table('suivi_prospects')->select('suivi_prospects.*',
                        'prospect_a_appellers.id as `ID`','prospect_a_appellers.nom_entreprise','prospect_a_appellers.secteur_activite','prospect_a_appellers.tel_contact','prospect_a_appellers.email_entreprise')
                        ->join('prospect_a_appellers', 'prospect_a_appellers.id', 'suivi_prospects.prospect_appel_id')
                        ->where('suivi_prospects.type', 1)->where('suivi_prospects.choix_qualifier', "Rendez-vous obtenu")->where('suivi_prospects.commercial_id', $commercial->id)
                        ->where('prospect_a_appellers.nom_entreprise','like', '%'.$search.'%')->where('prospect_a_appellers.tel_contact','like', '%'.$searchnumero.'%')
                    ->whereDay('suivi_prospects.date_rendezvous',date('d', strtotime($weeks)))
                    ->whereMonth('suivi_prospects.date_rendezvous',date('m', strtotime($weeks)))
                    ->whereYear('suivi_prospects.date_rendezvous',date('Y', strtotime($weeks)))
                    ->orderby('suivi_prospects.date_rendezvous', 'asc')
                    ->where('suivi_prospects.statut_rv', null)
                    ->get();
                   
                   foreach($rv_todays as $rv_todayss){
                    array_push($rv_today, $rv_todayss);
                    }
                   
                 }
               
                   $appels_daterv = DB::table('suivi_prospects')->select('suivi_prospects.*',
                        'prospect_a_appellers.id as `ID`','prospect_a_appellers.nom_entreprise','prospect_a_appellers.secteur_activite','prospect_a_appellers.tel_contact','prospect_a_appellers.email_entreprise')
                        ->join('prospect_a_appellers', 'prospect_a_appellers.id', 'suivi_prospects.prospect_appel_id')
                        ->where('suivi_prospects.type', 1)->where('suivi_prospects.choix_qualifier', "Rendez-vous obtenu")->where('suivi_prospects.commercial_id', $commercial->id)
                        ->where('prospect_a_appellers.nom_entreprise','like', '%'.$search.'%')->where('prospect_a_appellers.tel_contact','like', '%'.$searchnumero.'%')
                        ->where('suivi_prospects.statut_rv', null)
                     ->whereYear('suivi_prospects.date_rendezvous', $annee)
                    ->whereMonth('suivi_prospects.date_rendezvous', $mois)
                    ->orderby('suivi_prospects.date_rendezvous', 'asc') 
                    ->get();
                    
                  
                
                
                    
                 return view('helloventesV2.appels_daterv', compact('commercial','rv_today','appels_daterv'));
    }
    
    
    public function appelsaqualifier()
    {
         $mois = date('m');
                            $annee = date('Y'); 
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $appelsaqualifier = DB::table('suivi_prospects')->select('suivi_prospects.*',
                        'prospect_a_appellers.id as `ID`','prospect_a_appellers.nom_entreprise','prospect_a_appellers.secteur_activite','prospect_a_appellers.tel_contact','prospect_a_appellers.email_entreprise')
                        ->join('prospect_a_appellers', 'prospect_a_appellers.id', 'suivi_prospects.prospect_appel_id')
                        ->where('suivi_prospects.type', 1)->where('suivi_prospects.commercial_id', $commercial->id)->orderBy('prospect_a_appellers.nom_entreprise', 'asc')->get();
        return view('helloventesV2.appelsaqualifier', compact('appelsaqualifier'));
    }
    
    public function appelsnonqualifier()
    {
         $mois = date('m');
                            $annee = date('Y'); 
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
         $appelsnonqualifier = DB::table('suivi_prospects')->select('suivi_prospects.*',
                        'prospect_a_appellers.id as `ID`','prospect_a_appellers.nom_entreprise','prospect_a_appellers.secteur_activite','prospect_a_appellers.tel_contact','prospect_a_appellers.email_entreprise')
                        ->join('prospect_a_appellers', 'prospect_a_appellers.id', 'suivi_prospects.prospect_appel_id')
                        ->where('suivi_prospects.type', 2)->where('suivi_prospects.commercial_id', $commercial->id)->orderBy('prospect_a_appellers.nom_entreprise', 'asc')
                        ->whereMonth('suivi_prospects.created_at', $mois)->whereYear('suivi_prospects.created_at', $annee)->get();
        return view('helloventesV2.appelsnonqualifier', compact('appelsnonqualifier'));
    }
    
    public function appels_arappeler()
    {
         $mois = date('m');
         $today = date('d');
                            $annee = date('Y'); 
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $appels_arappeler_today = DB::table('suivi_prospects')->select('suivi_prospects.id','suivi_prospects.commercial_id','suivi_prospects.created_at','suivi_prospects.type','suivi_prospects.date_rappel','suivi_prospects.choix_a_rappeler',
                        'prospect_a_appellers.id as `ID`','prospect_a_appellers.nom_entreprise','prospect_a_appellers.secteur_activite','prospect_a_appellers.tel_contact','prospect_a_appellers.email_entreprise')
                        ->join('prospect_a_appellers', 'prospect_a_appellers.id', 'suivi_prospects.prospect_appel_id')
                        ->where('suivi_prospects.type', 5)->where('suivi_prospects.commercial_id', $commercial->id)->whereYear('date_rappel', $annee)->whereMonth('date_rappel', $mois)->whereDay('date_rappel', $today)->get();
            
        $appels_arappeler = DB::table('suivi_prospects')->select('suivi_prospects.id','suivi_prospects.commercial_id','suivi_prospects.created_at','suivi_prospects.type','suivi_prospects.date_rappel','suivi_prospects.choix_a_rappeler',
                        'prospect_a_appellers.id as `ID`','prospect_a_appellers.nom_entreprise','prospect_a_appellers.secteur_activite','prospect_a_appellers.tel_contact','prospect_a_appellers.email_entreprise')
                        ->join('prospect_a_appellers', 'prospect_a_appellers.id', 'suivi_prospects.prospect_appel_id')
                        ->where('suivi_prospects.type', 5)->where('suivi_prospects.commercial_id', $commercial->id)->orderBy('suivi_prospects.date_rappel', 'asc')->get();
        return view('helloventesV2.appels_arappeler', compact('appels_arappeler','appels_arappeler_today'));
    }
    
      public function edit_cloturer_rv($id)
    {
        //
        $entreprise = Suivi_prospect::find($id);
        
        $commercial = DB::table('commerciaus')->orderby('prenom')->get();
        
        return view('helloventesV2.cloturer_rv', compact('entreprise', 'commercial'));

    }
    
     public function update_cloturer_rv(Request $request, $id)
    {
        // dd($id);
        $me = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
        $message = "Rendez-vous clôturée avec succès";
        
        $cloture_rv = Suivi_prospect::findOrFail($id);
        $cloture_rv->statut_rv = 1;
        $cloture_rv->resultat_rv = $request->get('resultat_rv');
        $cloture_rv->save();
        
        $pros = DB::table('prospects')->where('suivi_prospect', $cloture_rv->id)->first();
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
                     'prospect_id' => $pros->id,
                     'commercial_id' => $commercial_id[$i],
                     'suivi_prospect' => $cloture_rv->id,

                         ];
                     
                     DB::table('action_commerciales')->insert($personnes);
                     
                 }
                 
                 $commerciaux = DB::table('commerciaus')->get();
                 foreach($commerciaux as $commerciau)
                 {
                     DB::table('action_commerciales')->where('commercial_id', $commerciau->id)->update(['superieur_id' => $commerciau->superieur_id]);
                 }
        return redirect('/appels_daterv')->with(['message' => $message, 'messages' => $messages]);
        
    }
    
    
    public function appels_daterv()
    {
        $mois = date('m');
                $annee = date('Y'); 
                 $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
                
                $week = [];
                $saturday = strtotime('monday this week');
                foreach (range(0, 6) as $day) {
                    $week[] = date("Y-m-d", (($day * 86400) + $saturday));
                }
                $rv_today = array();
                 foreach($week as $weeks)
                 { 
                    $rv_todays = DB::table('suivi_prospects')->select('suivi_prospects.*',
                        'prospect_a_appellers.id as `ID`','prospect_a_appellers.nom_entreprise','prospect_a_appellers.secteur_activite','prospect_a_appellers.tel_contact','prospect_a_appellers.email_entreprise')
                        ->join('prospect_a_appellers', 'prospect_a_appellers.id', 'suivi_prospects.prospect_appel_id')
                        ->where('suivi_prospects.type', 1)->where('suivi_prospects.choix_qualifier', "Rendez-vous obtenu")->where('suivi_prospects.commercial_id', $commercial->id)
                    ->whereDay('suivi_prospects.date_rendezvous',date('d', strtotime($weeks)))
                    ->whereMonth('suivi_prospects.date_rendezvous',date('m', strtotime($weeks)))
                    ->whereYear('suivi_prospects.date_rendezvous',date('Y', strtotime($weeks)))
                    ->orderby('suivi_prospects.date_rendezvous', 'asc')
                    ->where('suivi_prospects.statut_rv', null)
                    ->get();
                   
                   foreach($rv_todays as $rv_todayss){
                    array_push($rv_today, $rv_todayss);
                    }
                   
                 }
               
                   $appels_daterv = DB::table('suivi_prospects')->select('suivi_prospects.*',
                        'prospect_a_appellers.id as `ID`','prospect_a_appellers.nom_entreprise','prospect_a_appellers.secteur_activite','prospect_a_appellers.tel_contact','prospect_a_appellers.email_entreprise')
                        ->join('prospect_a_appellers', 'prospect_a_appellers.id', 'suivi_prospects.prospect_appel_id')
                        ->where('suivi_prospects.type', 1)->where('suivi_prospects.choix_qualifier', "Rendez-vous obtenu")->where('suivi_prospects.commercial_id', $commercial->id)
                        ->where('suivi_prospects.statut_rv', null)
                    ->whereYear('suivi_prospects.date_rendezvous', $annee)
                    ->whereMonth('suivi_prospects.date_rendezvous', $mois)
                    ->orderby('suivi_prospects.date_rendezvous', 'asc') 
                    ->get();
                
                    
                   
                 
       
        return view('helloventesV2.appels_daterv', compact('commercial','rv_today','appels_daterv'));
    }
    
    
    public function rv_deja_fait()
    {
        $mois = date('m');
                $annee = date('Y'); 
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();

                $week = [];
                $saturday = strtotime('monday this week');
                foreach (range(0, 6) as $day) {
                    $week[] = date("Y-m-d", (($day * 86400) + $saturday));
                }
                $appels_daterv = array();
                foreach($week as $weeks)
                 { 
                    $appels_datervs = DB::table('suivi_prospects')->where('type', 1)->where('choix_qualifier', "Rendez-vous obtenu")->where('commercial_id', $commercial->id)
                    ->whereDay('date_rendezvous', '!=', date('d', strtotime($weeks)))
                    ->whereMonth('date_rendezvous', '!=', date('m', strtotime($weeks)))
                    ->whereYear('date_rendezvous', '!=', date('Y', strtotime($weeks)))
                    ->orderby('date_rendezvous', 'asc')
                     ->whereYear('created_at', $annee)
                    ->whereMonth('created_at', $mois)
                    ->where('statut_rv', 1)
                    ->get();
                   
                   foreach($appels_datervs as $appels_datervss){
                    array_push($appels_daterv, $appels_datervss);
                    }
                   
                }
                 
       
        return view('helloventesV2.rv_deja_fait', compact('commercial','appels_daterv'));
    }
    
     public function produit_avendre()
    {
         $mois = date('m');
                            $annee = date('Y'); 
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $produit_avendre = DB::table('suivi_prospects')->where('type', 5)->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->get();
        return view('helloventesV2.produit_avendre', compact('produit_avendre'));
    }
     
     
     
     
     
     
    public function import_prospect($id)
    {
        //
        $commerciau = Commerciau::find($id);
       
        return view('helloventesV2.import_prospect', compact('commerciau'));

    }
     
     public function fiche_prospect($id)
    {
        //
        $entreprise = Prospect_a_appeller::find($id);
        $suivi = DB::table('suivi_prospects')->where('prospect_appel_id', $entreprise->id)->get();
        return view('helloventesV2.fiche_prospect', compact('entreprise', 'suivi'));

    }
    
     public function fiche_prospect_resultat($id)
    {
        //
        $entreprise = Prospect_a_appeller::find($id);
        $suivi = DB::table('suivi_prospects')->where('prospect_appel_id', $entreprise->id)->get();
        return view('helloventesV2.fiche_prospect_resultat', compact('entreprise', 'suivi'));

    }
    
     public function fiche_prospect_qualifiers($id)
    {
        //
        $suivis = Suivi_prospect::find($id);
        $entreprise = DB::table('prospect_a_appellers')->where('id', $suivis->prospect_appel_id)->first();
        return view('helloventesV2.fiche_prospect_qualifier', compact('entreprise', 'suivis'));

    }
    
    
     public function fiche_prospect_non_qualifiers($id)
    {
        //
        $suivis = Suivi_prospect::find($id);
        $entreprise = DB::table('prospect_a_appellers')->where('id', $suivis->prospect_appel_id)->first();
        return view('helloventesV2.fiche_prospect_non_qualifiers', compact('entreprise', 'suivis'));

    }
    
     public function fiche_prospect_a_rappaler($id)
    {
        //
        $suivis = Suivi_prospect::find($id);
        $entreprise = DB::table('prospect_a_appellers')->where('id', $suivis->prospect_appel_id)->first();
        return view('helloventesV2.fiche_prospect_a_rappaler', compact('entreprise', 'suivis'));

    }
    
     public function action_rv($id)
    {
        //
        $suivis = Suivi_prospect::find($id);
        $action = DB::table('action_commerciales')->where('suivi_prospect', $suivis->id)->get();
        return view('helloventesV2.action_rv', compact('action', 'suivis'));

    }
      public function filtrer_pros_numero(Request $request)
    {
        $search = $request->get('search');
        $searchnumero = $request->get('searchnumero');

        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $entreprise = DB::table('prospect_a_appellers')->where('commercial_id', $commercial->id)->where('statut', NULL)->orderby('id', 'desc')->where('nom_entreprise','like', '%'.$search.'%')->where('tel_contact','like', '%'.$searchnumero.'%')->paginate(10000);
        return view('helloventesV2.prospects_a_appeler', compact('entreprise'));
    }
  
      public function filtrer_pros_numero_rappeler(Request $request)
    {
        $mois = date('m');
         $today = date('d');
                            $annee = date('Y'); 
        $search = $request->get('search');
        $searchnumero = $request->get('searchnumero');

        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        
        $appels_arappeler_today = DB::table('suivi_prospects')->select('suivi_prospects.id','suivi_prospects.commercial_id','suivi_prospects.created_at','suivi_prospects.type','suivi_prospects.date_rappel','suivi_prospects.choix_a_rappeler',
                        'prospect_a_appellers.id as `ID`','prospect_a_appellers.nom_entreprise','prospect_a_appellers.secteur_activite','prospect_a_appellers.tel_contact','prospect_a_appellers.email_entreprise')
                        ->join('prospect_a_appellers', 'prospect_a_appellers.id', 'suivi_prospects.prospect_appel_id')
                        ->where('suivi_prospects.type', 5)->where('suivi_prospects.commercial_id', $commercial->id)->whereYear('date_rappel', $annee)->whereMonth('date_rappel', $mois)->whereDay('date_rappel', $today)
                        ->where('prospect_a_appellers.nom_entreprise','like', '%'.$search.'%')->where('prospect_a_appellers.tel_contact','like', '%'.$searchnumero.'%')->get();

        $appels_arappeler = DB::table('suivi_prospects')->select('suivi_prospects.id','suivi_prospects.commercial_id','suivi_prospects.created_at','suivi_prospects.type','suivi_prospects.date_rappel','suivi_prospects.choix_a_rappeler',
                        'prospect_a_appellers.id as `ID`','prospect_a_appellers.nom_entreprise','prospect_a_appellers.secteur_activite','prospect_a_appellers.tel_contact','prospect_a_appellers.email_entreprise')
                        ->join('prospect_a_appellers', 'prospect_a_appellers.id', 'suivi_prospects.prospect_appel_id')
                        ->where('suivi_prospects.type', 5)->where('suivi_prospects.commercial_id', $commercial->id)->orderBy('suivi_prospects.date_rappel', 'asc')
                        ->where('prospect_a_appellers.nom_entreprise','like', '%'.$search.'%')->where('prospect_a_appellers.tel_contact','like', '%'.$searchnumero.'%')->get();
        
        
        return view('helloventesV2.appels_arappeler', compact('appels_arappeler','appels_arappeler_today'));
    }
    
    
     public function fiche_prospect_rv($id)
    {
        //
        $suivis = Suivi_prospect::find($id);
        $entreprise = DB::table('prospect_a_appellers')->where('id', $suivis->prospect_appel_id)->first();
        return view('helloventesV2.fiche_prospect_rv', compact('entreprise', 'suivis'));

    }
    
     public function fiche_prospect_produit_avendre($id)
    {
        //
        $suivis = Suivi_prospect::find($id);
        $entreprise = DB::table('prospect_a_appellers')->where('id', $suivis->prospect_appel_id)->first();
        return view('helloventesV2.fiche_prospect_produit_avendre', compact('entreprise', 'suivis'));

    }
    
     public function edit_suivi_appel($id)
    {
        //
        $entreprises = Prospect_a_appeller::find($id);
        $commercial = DB::table('commerciaus')->orderby('prenom')->get();
        $resultat = DB::table('resultat_appels')->orderby('libelle')->get();
        $domaine = DB::table('domaines')->orderby('libelle')->get();
        
        return view('helloventesV2.suivi_appel', compact('domaine', 'resultat', 'entreprises', 'commercial'));

    }
  
    public function update_suivi_appel(Request $request)
    {
          $today = date('Y-m-d');    
            $message = "Résultats  enregistrés avec succès";
         $moi = Commerciau::where('user_id', Auth::user()->id)->first();
         
                $suivi = new Suivi_prospect;
                $suivi->prospect_appel_id = $request->get('prospect_appel_id');
                $suivi->type = $request->get('type');
                $suivi->domaine_valider = $request->get('domaine_valider');
                $suivi->personne_a_contacter = $request->get('personne_a_contacter');
                $suivi->contact_personne = $request->get('contact_personne');
                $suivi->email_personne = $request->get('email_personne');
                $suivi->date_rendezvous = $request->get('date_rendezvous');
                $suivi->resume = $request->get('resume');
                $suivi->date_rappel = $request->get('date_rappel');
                $suivi->commercial_id = $moi->id;
                $suivi->pays_id = $moi->pays_id;
                $suivi->jour = $today;
                $suivi->save();
                
                DB::table('prospect_a_appellers')->where('id', $suivi->prospect_appel_id)->update(['statut' => 1]);

        return redirect('/prospects_a_appeler')->with(['message' => $message]);
    }
    
    
    public function mes_objectifs()
    {
        $commerciau = Commerciau::where('user_id', Auth::user()->id)->first();
       return view('helloventesV2.mes_objectifs', compact('commerciau'));

    }

   public function edit_prospect_a_appeler($id)
    {
        //
        $entreprise = Prospect_a_appeller::find($id);
        $commercial = DB::table('commerciaus')->orderby('prenom')->get();
        $resultat = DB::table('resultat_appels')->orderby('libelle')->get();
        $pay = DB::table('pays')->orderby('libelle')->get();
        $domaine = DB::table('domaines')->orderby('libelle')->get();
        return view('helloventesV2.edit_prospect_a_appeler', compact('pay', 'domaine', 'resultat', 'entreprise', 'commercial'));

    }
  
    public function update_prospect_a_appeler(Request $request, $id)
    {
            $message = "Prospect modifié avec succès";
            
        //     if($request->file('logo')){
        //   $logo = $request->file('logo');
        //   $file_name = $logo->getClientOriginalName();
        //   $logo->move(public_path().'/imgs/', $file_name);
        // }
            $today = date('Y-m-d');   
            $com_connect = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                $entreprise = Prospect_a_appeller::findOrFail($id);
                $entreprise->nom_entreprise = $request->get('nom_entreprise');
                $entreprise->email_entreprise = $request->get('email_entreprise');
                $entreprise->commercial_id = $request->get('commercial_id');
                $entreprise->tel_fixe = $request->get('tel_fixe');
                $entreprise->besoin_prioritaire = $request->get('besoin_prioritaire');
                $entreprise->pays_id = $request->get('pays_id');
                $entreprise->autre_besoins = $request->get('autre_besoins');
                $entreprise->secteur_activite = $request->get('secteur_activite');
                $entreprise->tel_contact = $request->get('tel_contact');
                $entreprise->site_web = $request->get('site_web');
                // $entreprise->logo  = (isset($file_name)) ? $file_name : $entreprise->logo;   
                $entreprise->save();
                
                $com_pays = DB::table('commerciaus')->where('id', $entreprise->commercial_id)->first();
                
                $suivi = new Suivi_prospect;
                $suivi->prospect_appel_id = $entreprise->id;
                $suivi->type = $request->get('type');
                $suivi->choix_qualifier = $request->get('choix_qualifier');
                $suivi->choix_a_rappeler = $request->get('choix_a_rappeler');
                $suivi->choix_non_qualifier = $request->get('choix_non_qualifier');
                $suivi->domaine_valider = $request->get('domaine_valider');
                $suivi->personne_a_contacter = $request->get('personne_a_contacter');
                $suivi->date_depot_offre = $request->get('date_depot_offre');
                $suivi->date_depot_agreement = $request->get('date_depot_agreement');
                $suivi->commercial_suivi = $request->get('commercial_suivi');
                $suivi->commentaire_qualifier = $request->get('commentaire_qualifier');
                $suivi->heure_rv = $request->get('heure_rv');
                $suivi->raison_no_qualifier = $request->get('raison_no_qualifier');
                $suivi->date_relance_noqualifier = $request->get('date_relance_noqualifier');
                $suivi->demande_rappel = $request->get('demande_rappel');
                $suivi->besoin_rappel = $request->get('besoin_rappel');
                $suivi->contact_personne = $request->get('contact_personne');
                $suivi->email_personne = $request->get('email_personne');
                $suivi->date_rendezvous = $request->get('date_rendezvous');
                $suivi->libelle_rv = $request->get('libelle_rv');
                $suivi->contact_rv = $request->get('contact_rv');
                $suivi->lieu_rv = $request->get('lieu_rv');
                $suivi->commentaire_rv = $request->get('commentaire_rv');
                $suivi->injoignable_comm = $request->get('injoignable_comm');
                $suivi->personne_rv = $request->get('personne_rv');
                $suivi->resume = $request->get('resume');
                $suivi->date_rappel = $request->get('date_rappel');
                $suivi->commercial_id = $entreprise->commercial_id;
                $suivi->pays_id = $com_pays->pays_id;
                $suivi->jour = $today;
                if($suivi->commercial_suivi == NULL)
                {
                    $suivi->commercial_suivi = $com_connect->id;
                }
                if($suivi->type){
                $suivi->save();
                }
                
                $com_suivi = DB::table('commerciaus')->where('id', $suivi->commercial_suivi)->first();
                
                if($suivi->type){
                    DB::table('prospect_a_appellers')->where('id', $suivi->prospect_appel_id)->update(['statut' => 1]);
                }
                
                // if($suivi->type = 4){
                //     DB::table('prospect_a_appellers')->where('id', $suivi->prospect_appel_id)->update(['probabilite' => 20]);
                // }
              
                if($suivi->type == 1){
              
                    DB::table('prospects')->insert(['nom_entreprise' => $entreprise->nom_entreprise, 'secteur_pros_a_appeler' => $entreprise->secteur_activite, 'phone' => $entreprise->tel_contact, 'pays_id' => $entreprise->pays_id, 'provenance' => 'Prospect appelé', 'secteur_activite' => $entreprise->secteur_activite, 'superieur_id' => $com_suivi->superieur_id, 'email_entreprise' => $entreprise->email_entreprise, 
                     'commercial_id' => $suivi->commercial_suivi, 'suivi_prospect' => $suivi->id,  'created_at' => $suivi->updated_at,  'updated_at' => $suivi->updated_at]);
                }
                
                
                $pros = DB::table('prospects')->where('suivi_prospect', $suivi->id)->first();
               $comm = DB::table('commerciaus')->where('id', $suivi->commercial_id)->first();
                if($suivi->type == 1 and $suivi->choix_qualifier == "Rendez-vous obtenu"){
                    DB::table('prospections')->insert(['date' => $suivi->date_rendezvous, 'heure_debut' => $suivi->heure_rv, 'lieu' => $suivi->lieu_rv, 'prospect_id' => $pros->id, 'suivi_prospect' => $suivi->id, 'superieur_id' => $comm->superieur_id, 'commercial_id' => $suivi->commercial_id,  'created_at' => $suivi->updated_at,  'updated_at' => $suivi->updated_at]);
                }
        return redirect('/prospects_a_appeler')->with(['message' => $message]);
    }

   public function prospects_a_appeler()
    {
        $commercial = Commerciau::where('user_id', Auth::user()->id)->first();
        $entreprise = DB::table('prospect_a_appellers')->where('commercial_id', $commercial->id)->where('statut', NULL)->orderby('id', 'desc')->paginate();
        return view('helloventesV2.prospects_a_appeler', compact('entreprise'));
    }
    
    
     public function affecter_des_prospects()
    {
        
        $commerciaux = DB::table('commerciaus')->whereIn('domaine_id', [1,2])->orderBy('prenom')->paginate(30);
        return view('helloventesV2.affecter_des_prospects', compact('commerciaux'));
    }
    
    public function import_prospect_me()
    {
        $me = Commerciau::where('user_id', Auth::user()->id)->first();
       
        return view('helloventesV2.import_prospect_me', compact('me'));

    }
     
     
    public function import_me(Request $request){
        $me = Commerciau::where('user_id', Auth::user()->id)->first();
        $message = 'Base de prospects importée avec succès ';
        $commercial_id = $me->id;
        $superieur_id = $me->superieur_id;
        
         $request->validate([
            'file' => 'required|file|mimes:xlsx,xls'
         ]);
        $file = $request->get('file');
        Excel::import(new ImportUserMe($commercial_id,$superieur_id), $request->file('file')->store('files'));

        return redirect('/prospects_a_appeler')->with(['message' => $message]);
    }

    public function import(Request $request){
        $me = Commerciau::where('user_id', Auth::user()->id)->first();
        $message = 'Base de prospects importée avec succès ';
        $messageError = "Ce fichier n'est pas valide ";
        $commercial_id = $request->get('commercial_id');
        $superieur_id = $request->get('superieur_id');
        
         $request->validate([
            'file' => 'required|file|mimes:xlsx,xls'
         ]);
         
        $file = $request->get('file');
        
      
        Excel::import(new ImportUser($commercial_id,$superieur_id), $request->file('file')->store('files'));
       
        $date = date('Y-m-d-H:s');
        $count_pros = array();
        $pros = DB::table('prospect_a_appellers')->where('commercial_id', $commercial_id)->get();
                foreach($pros as $prose){
                    if(date('Y-m-d-H:s', strtotime ($prose->created_at)) == $date){
                        array_push($count_pros,$prose);
                    }
                }
                $nbre_pros = count($count_pros);
                $com = DB::table('commerciaus')->where('id', $commercial_id)->where('id','!=', $me->id)->first();
                if($com){
                Mail::to($com->email)->send(new MailProsAffecter($com, $me, $nbre_pros));
                }
                return redirect('/affecter_des_prospects')->with(['message' => $message]);
        
       
        
        
    }

    public function exportUsers(Request $request){
        
        return Excel::download(new ExportUser($request->id), 'prospect_a_appellers.xlsx');
    }
    
    public function exportPlannings(Request $request){
        
        return Excel::download(new ExportPlanning, 'sorti_terrains_de_la_semaine.xlsx');
    }
    
    
    
    
}
