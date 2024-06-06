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
use Auth;
use DB;
use Mail;

use Session;
use Mailjet\LaravelMailjet\Facades\Mailjet;

class TestController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
      
    public function store_testopp(Request $request)
    {
        //
                $message = "Opportunité ajoutée avec succès";
                $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                
                $opportunite = new Opportunite;
                $opportunite->libelle = $request->get('libelle'); 
                $opportunite->prospect_id = $request->get('prospect_id'); 
                $opportunite->commercial_id = $commercial->id;
                // $opportunite->marge = $request->get('marge');
                $opportunite->probabilite = $request->get('probabilite');
                $opportunite->objectif_de_vente = $request->get('objectif_de_vente');
                $opportunite->contact = $request->get('contact');
                $opportunite->statut = $request->get('statut');
                $opportunite->date_debut = $request->get('date_debut');
                $opportunite->save();
                   
                    $prenom = $request->get('prenom'); 
                    $nom = $request->get('nom'); 
                    $email = $request->get('email'); 
                    $phones = $request->get('phones');
                    $responsabilite = $request->get('responsabilite'); 
                    $prospect_id = $opportunite->prospect_id;
                    $opportunite_id = $opportunite->id;
                    $commercial_id = $opportunite->commercial_id;
                    
                    for($i=0; $i < count($prenom); $i++){
                    $contacts = [
                        
                        'prenom' => $prenom[$i],
                        'nom' => $nom[$i],
                        'email' => $email[$i],
                        'phone' => $phones[$i],
                        'responsabilite' => $responsabilite[$i],
                        'opportunite_id' =>$opportunite->id,
                        'prospect_id' =>$opportunite->prospect_id,
                        'commercial_id' =>$opportunite->commercial_id
                         ];
                     if($prenom[$i] !== null){
                            DB::table('contacts')->insert($contacts);
                            
                        }
                    }  
                
                        $libelles = $request->get('libelles'); 
                        $prospect_id = $opportunite->prospect_id;
                        $commercial_id = $opportunite->commercial_id; 
                        $probabilites = $request->get('probabilites'); 
                        $objectif_de_ventes = $request->get('objectif_de_ventes');
                        $statutt = $request->get('statutt');
                        $contactt = $request->get('contactt');
                        $date_debuts = $request->get('date_debuts');
                        
                        for($i=0; $i < count($libelles); $i++){
                        $sous_opportunites = [
                            
                            'libelle' => $libelles[$i],
                            'statut' => $statutt[$i],
                            'contact' => $contactt[$i],
                            'date_debut' => $date_debuts[$i],
                            'probabilite' => $probabilites[$i],
                            'objectif_de_vente' => $objectif_de_ventes[$i],
                            'commercial_id' => $opportunite->commercial_id,
                            'prospect_id' =>$opportunite->prospect_id,
                            'opportunite_id' =>$opportunite->id
                             ];
                     
                            DB::table('sous_opportunites')->insert($sous_opportunites);
                             
                        }
                            
                            $sous_op =  DB::table('sous_opportunites')->orderBy('id', 'desc')->first();
                        //   dd($sous_op);
                                $prenomss = $request->get('prenomss'); 
                                $nomss = $request->get('nomss'); 
                                $emailss = $request->get('emailss'); 
                                $phonesss = $request->get('phonesss');
                                $responsabilitess = $request->get('responsabilitess'); 
                                $prospect_id = $sous_op->prospect_id;
                                $opportunite_id = $sous_op->id;
                                $commercial_id = $sous_op->commercial_id;
                                
                                for($i=0; $i < count($prenom); $i++){
                                $contacts = [
                                    
                                    'prenom' => $prenomss[$i],
                                    'nom' => $nomss[$i],
                                    'email' => $emailss[$i],
                                    'phone' => $phonesss[$i],
                                    'responsabilite' => $responsabilitess[$i],
                                    'opportunite_id' =>$sous_op->id,
                                    'prospect_id' =>$sous_op->prospect_id,
                                    'commercial_id' =>$sous_op->commercial_id
                                     ];
                             if($prenomss[$i] !== null){
                                    DB::table('contacts')->insert($contacts);
                                    
                                }
                            }
                
                return back()->with(['message' => $message]);
    }
    public function test()
    {
        $prospection = DB::table('prospections')->get();
        return view('suiviSortieTerrain.lister_prospections', compact('prospection'));
    }
   
    // ajouter opportubité
       public function store(Request $request)
    {
        //
                $message = "Opportunité ajoutée avec succès";
                $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                
                $opportunite = new Opportunite;
                $opportunite->libelle = $request->get('libelle'); 
                $opportunite->prospect_id = $request->get('prospect_id'); 
                $opportunite->commercial_id = $commercial->id;
                // $opportunite->marge = $request->get('marge');
                $opportunite->probabilite = $request->get('probabilite');
                $opportunite->objectif_de_vente = $request->get('objectif_de_vente');
                $opportunite->contact = $request->get('contact');
                $opportunite->statut = $request->get('statut');
                $opportunite->date_debut = $request->get('date_debut');
                $opportunite->save();
                   
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
                    
                        $libelles = $request->get('libelles'); 
                        $prospect_id = $opportunite->prospect_id;
                        $commercial_id = $opportunite->commercial_id; 
                        $probabilites = $request->get('probabilites'); 
                        $objectif_de_ventes = $request->get('objectif_de_ventes');
                        $statutt = $request->get('statutt');
                        $contactt = $request->get('contactt');
                        $date_debuts = $request->get('date_debuts');
                        
                        for($i=0; $i < count($libelle); $i++){
                        $sous_opportunites = [
                            
                            'libelle' => $libelles[$i],
                            'statut' => $statutt[$i],
                            'contact' => $contactt[$i],
                            'date_debut' => $date_debuts[$i],
                            'probabilite' => $probabilites[$i],
                            'objectif_de_vente' => $objectif_de_ventes[$i],
                            'commercial_id' => $opportunite->commercial_id,
                            'prospect_id' =>$opportunite->prospect_id
                             ];
                     
                            DB::table('sous_opportunites')->insert($sous_opportunites);
                            
                        }
                    
                return back()->with(['message' => $message]);
    }
    
    
}
