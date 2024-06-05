<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Action;
use App\Agent;
use App\Reunion;
use App\Suivi_action;
use App\Feedback;
use App\Critere;
use App\ReponseFeedback;
use App\Mail\DonnerDesFeedback;
use App\Entreprise;
use App\Personne_choisi;
use App\Critere_feedback;
use App\Source_feedback;
use App\Suivi_agent_prospect;
use DB;
use Auth;
use App\User;
use App\Direction;
use Session;
use Illuminate\Support\Facades\Hash;
use App\Notifications\BienvenueSurFeedback;
use App\Notifications\VosActions;
use Mail;

//M.A.X B.I.R.D was here
use PDF;
use Illuminate\Support\Str;

class ProspectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function parametre()
    {
        return view('Admin.parametre');
    }

    public function voir_agents_assistance()
    {
        $agents = DB::table('agents')->where('nom_role', 'entreprise')->where('assistance', 1)->get();
        
        return view('prospect.liste_agent_assistance', compact('agents'));
    }
    public function liste_utilisateurs()
    {
       $facilitateur = DB::table('facilitateurs')->where('user_id', Auth::user()->id)->first();
        $clients = DB::table('client_facilitateurs')->where('facilitateur_id', $facilitateur->id)->orderby('id', 'desc')->first();
        
        $agents= array();
        /* foreach($clients as $client){
             $entreprises = DB::table('entreprises')->where('id',$client->entreprise_id)->first();
             $agent = DB::table('agents')->where('nom_role', 'entreprise')->where('entreprise', $entreprises->id)->orderby('prenom', 'asc')->get();
             array_push($agents, $agent);

         } */
         //dd($agents);
        return view('prospect.liste_utilisateurs', compact('facilitateur','clients','agents'));
    }
    
    
     public function liste_actions_utilisateurs($id)
    {
        $agent = Agent::FindOrFail($id);
        $actions = DB::table('suivi_agent_prospects')->where('agent_id', $agent->id)->get();
        return view('prospect.liste_actions_utilisateurs', compact('agent', 'actions'));
    }
    
     public function liste_actions_agent($id)
    {
        $agent = Agent::FindOrFail($id);
        $actions = DB::table('actions')->where('agent_id', $agent->id)->get();
        return view('prospect.liste_actions_agent', compact('agent', 'actions'));
    }

 public function liste_actions_utilisateursA($id)
    {
        $entreprise = Entreprise::FindOrFail($id);
        $agents = DB::table('agents')->where('entreprise', $entreprise->id)->get();
        return view('prospect.liste_actions_utilisateursA', compact('agents', 'entreprise'));
    }
    
     public function action_agent($id)
    {
        $source = Source_feedback::FindOrFail($id);
        $actions = DB::table('actions')->where('source', $source->id)->get();
       
        return view('prospect.action_agent', compact( 'source','actions'));
    }


 public function filtrer_utilisateur_client(Request $request) 
    {
        $search = $request->get('search');
        $facilitateur = DB::table('facilitateurs')->where('user_id', Auth::user()->id)->first();
        $clients = DB::table('client_facilitateurs')->where('facilitateur_id', $facilitateur->id)->where('entreprise_id','like', '%'.$search.'%')->first();
        $agents= array();
        /* foreach($clients as $client){
             
             $agent = DB::table('agents')->where('nom_role', 'entreprise')->where('entreprise', $client->entreprise_id)->orderby('nom', 'asc')->get();
             array_push($agents, $agent);

         } */
        return view('prospect.liste_utilisateurs', compact('facilitateur','clients','agents','search'));
    }
    
     public function voir_lesentreprises()
    {
        $entreprises = DB::table('entreprises')->get();
        
        return view('prospect.liste_entreprises', compact('entreprises'));
    }
/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajout_agent()
    {
        $directions = Direction::all();
        $pays = DB::table('pays')->orderby('libelle', 'ASC')->get();
        $entreprises = DB::table('entreprises')->get();
        return view('prospect.ajouter_agent', compact('directions', 'pays', 'entreprises'));
    }

    public function ajout_agent_store(Request $request)
    {
        //

        request()->validate([
            //'photo.*' => 'mimes:doc,pdf,docx,zip,png,jpeg,odt,jpg,svc,csv,mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            

    ]);

                $message = "Ajouté avec succès";

                $user = new User;
                $user->prenom = $request->get('prenom');
                $user->nom = $request->get('nom');
                $user->email = $request->get('email');
                $user->entreprise = $request->get('entreprise');
                $user->groupe = $request->get('groupe');
                //$user->photo = $imageName;
                $user->nom_role = 'entreprise';
                $user->password = Hash::make(123456);
                //$user->notify(new BienvenueACollaboratis());

                if($user->save()){
                    error_log('la création a réussi');

                $agent = new Agent;
                $agent->prenom = $request->get('prenom'); 
                $agent->nom = $request->get('nom'); 
                //$agent->photo =  $imageName; 
                $agent->email = $request->get('email');
                $agent->email_perso = $request->get('email_perso');
                $agent->pays_id = $request->get('pays_id');
                $agent->departement = $request->get('departement');
                $agent->tel = $request->get('tel');
                $agent->whatshap = $request->get('whatshap');
                $agent->fonction = $request->get('fonction');
                $agent->nom_role = 'entreprise';
                $agent->groupe = $request->get('groupe');
                $agent->entreprise =  $user->entreprise ;
                $agent->direction_id = $request->get('direction_id');
                $agent->user_id = $request->get('user_id');  
                $agent->user_id = $user->id;
                $agent->save();
                    // if($agent->save())
                    // {
                    //     Auth::login($user);
                    //     $user->notify(new BienvenueSurFeedback());
                    //     return back()->with(['message' => $message]);

                    // }
                    // else
                    // {
                    //     flash('user not saved')->error();

                    // }

                }    
                return back()->with(['message' => $message]);
    }
    
    public function voir_lerapport_globale($id)
    {
        $entreprise = Entreprise::find($id);
       
        $agents = DB::table('agents')->where('entreprise', $entreprise->id)->where('entreprise', '!=', NULL)->get();
        
        
        $competence_1sum = array();
        $competence_2sum = array();
        $competence_3sum = array();
        $competence_4sum = array();
        $competence_5sum = array();
        $competence_6sum = array();
        $competence_7sum = array();
        $competence_8sum = array();
        $competence_9sum = array();
        $competence_10sum = array();
        $competence_11sum = array();
        $competence_12sum = array();
        $feedback = array();
            foreach($agents as $agent){
                $feed = DB::table('feedback')->where('agents_id_choisi', $agent->id)->first();
            $competence_1a = DB::table('feedback')->where('agents_id_choisi', $agent->id)->where('competence_id',1)->count();
            $competence_2a = DB::table('feedback')->where('agents_id_choisi', $agent->id)->where('competence_id',2)->count();
            $competence_3a = DB::table('feedback')->where('agents_id_choisi', $agent->id)->where('competence_id',3)->count();
            $competence_4a = DB::table('feedback')->where('agents_id_choisi', $agent->id)->where('competence_id',4)->count();
            $competence_5a = DB::table('feedback')->where('agents_id_choisi', $agent->id)->where('competence_id',5)->count();
            $competence_6a = DB::table('feedback')->where('agents_id_choisi', $agent->id)->where('competence_id',6)->count();
            $competence_7a = DB::table('feedback')->where('agents_id_choisi', $agent->id)->where('competence_id',7)->count();
            $competence_8a = DB::table('feedback')->where('agents_id_choisi', $agent->id)->where('competence_id',8)->count();
            $competence_9a = DB::table('feedback')->where('agents_id_choisi', $agent->id)->where('competence_id',9)->count();
            $competence_10a = DB::table('feedback')->where('agents_id_choisi', $agent->id)->where('competence_id',10)->count();
            $competence_11a = DB::table('feedback')->where('agents_id_choisi', $agent->id)->where('competence_id',11)->count(); 
            $competence_12a = DB::table('feedback')->where('agents_id_choisi', $agent->id)->where('competence_id',12)->count(); 
            
            array_push($feedback, $feed);
            array_push($competence_1sum, $competence_1a);
            array_push($competence_2sum, $competence_2a);
            array_push($competence_3sum, $competence_3a);
            array_push($competence_4sum, $competence_4a);
            array_push($competence_5sum, $competence_5a);
            array_push($competence_6sum, $competence_6a);
            array_push($competence_7sum, $competence_7a);
            array_push($competence_8sum, $competence_8a);
            array_push($competence_9sum, $competence_9a);
            array_push($competence_10sum, $competence_10a);
            array_push($competence_11sum, $competence_11a);
            array_push($competence_12sum, $competence_12a);
            
            }
            $competence_1 = array_sum($competence_1sum);
            $competence_2 = array_sum($competence_2sum);
            $competence_3 = array_sum($competence_3sum);
            $competence_4 = array_sum($competence_4sum);
            $competence_5 = array_sum($competence_5sum);
            $competence_6 = array_sum($competence_6sum);
            $competence_7 = array_sum($competence_7sum);
            $competence_8 = array_sum($competence_8sum);
            $competence_9 = array_sum($competence_9sum);
            $competence_10 = array_sum($competence_10sum);
            $competence_11 = array_sum($competence_11sum);
            $competence_12 = array_sum($competence_12sum);
        return view('prospect.rapport_globale',compact('feedback','entreprise','competence_1','competence_2','competence_3','competence_4','competence_5','competence_12','competence_6','competence_7','competence_8','competence_9','competence_10','competence_11'));
    }
    
    public function competences_a_developper()
    {
        $agent = DB::table('agents')->where('user_id', Auth::user()->id)->first();
        
            $personne_choisi = DB::table('agents')->where('user_id', Auth::user()->id)->first();
            $competence_1 = DB::table('feedback')->where('agents_id_choisi', $personne_choisi->id)->where('competence_id',1)->count();
            $competence_2 = DB::table('feedback')->where('agents_id_choisi', $personne_choisi->id)->where('competence_id',2)->count();
            $competence_3 = DB::table('feedback')->where('agents_id_choisi', $personne_choisi->id)->where('competence_id',3)->count();
            $competence_4 = DB::table('feedback')->where('agents_id_choisi', $personne_choisi->id)->where('competence_id',4)->count();
            $competence_5 = DB::table('feedback')->where('agents_id_choisi', $personne_choisi->id)->where('competence_id',5)->count();
            $competence_6 = DB::table('feedback')->where('agents_id_choisi', $personne_choisi->id)->where('competence_id',6)->count();
            $competence_7 = DB::table('feedback')->where('agents_id_choisi', $personne_choisi->id)->where('competence_id',7)->count();
            $competence_8 = DB::table('feedback')->where('agents_id_choisi', $personne_choisi->id)->where('competence_id',8)->count();
            $competence_9 = DB::table('feedback')->where('agents_id_choisi', $personne_choisi->id)->where('competence_id',9)->count();
            $competence_10 = DB::table('feedback')->where('agents_id_choisi', $personne_choisi->id)->where('competence_id',10)->count();
            $competence_11 = DB::table('feedback')->where('agents_id_choisi', $personne_choisi->id)->where('competence_id',11)->count(); 
        return view('prospect.competences_a_developper',compact('agent','competence_1','competence_2','competence_3','competence_4','competence_5','competence_6','competence_7','competence_8','competence_9','competence_10','competence_11'));
    }

    public function competences_a_developper_store(Request $request, $id)
    {
                
                
                $agent = DB::table('agents')->where('user_id', Auth::user()->id)->first();
                
                $competence = Suivi_agent_prospect::findOrFail($id);
                $competence->competence_dev1 = $request->get('competence_dev1');
                $competence->competence_dev2 = $request->get('competence_dev2');
                $competence->competence_dev3 = $request->get('competence_dev3');
                // $competence->agent_id = $agent->id;
                $competence->save();
                
                return redirect('/dev_dans_cinq');
    }
    
    
     public function dev_dans_cinq()
    {
        $agent = DB::table('agents')->where('user_id', Auth::user()->id)->first();
        
           
        return view('prospect.dansCinqAns',compact('agent'));
    }
    
     public function competences_a_developper_storeSouhait(Request $request, $id)
    {
                $message = "Vos compétences dans 5 ans sont ajoutées avec succès";
                
                // $agent = DB::table('agents')->where('user_id', Auth::user()->id)->first();
                
                $compétence = Suivi_agent_prospect::findOrFail($id);
                $compétence->souhait = $request->get('souhait');
                $compétence->poste_job = $request->get('poste_job');
                $compétence->save();
                
                return redirect('/dashboard/feedback')->with(['message' => $message]);
    }
    
    public function voir_suivi()
    {
        $suivis = DB::table('suivi_agent_prospects')->get();

        return view('prospect.liste_suivi', compact('suivis'));
    }
    
    public function enregistrer_actions()
    {
        return view ('prospect.enregistrer_actions');
    }

    
    public function enregistrer_actions_store(Request $request)
    {
      
            $agents = DB::table('agents')->where('user_id', Auth::user()->id)->first();
            $message = "Action ajoutée avec succès";
            
                 $libelle = $request->get('libelle');
                 $deadline = $request->get('deadline');
                 $agent_id = $request->get('agent_id');
                 $source = $request->get('source');

                 for($i=0; $i < count($libelle); $i++){
                 $personnes = [
                    
                     'libelle' => $libelle[$i],
                     'deadline' => $deadline[$i],
                     'source' => $source[$i],
                     'pourcentage' => 00,
                     'agent_id' =>$agents->id,
                         ];
                     
                     DB::table('actions')->insert($personnes);
                 }
                  return redirect('/assistances')->with(['message' =>$message]);
    }
    
    
      public function edit_action_prospectE($id)
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
        return view('prospect.edit_action_prospectE', compact('actions', 'action','agents','reunions','headers'));
   
    }
    
     public function edit_action_pros($id)
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
        return view('prospect.edit_action_pros', compact('actions', 'action','agents','reunions','headers'));
    }
    public function update_action_pros(Request $request, $id)
    {
        //

        
        $message = "Action mise à jour avec succès !";
        /*  $suivi_action = Suivi_action::find($id);
        $suivi_actionUpdate = $request->all();
        $suivi_action->save($suivi_actionUpdate);
 */
            /* $suivi_action = Suivi_action::find($id);
            $suivi_action->deadline = $request->get('deadline');
            $suivi_action->pourcentage = $request->get('pourcentage'); 
            $suivi_action->note = $request->get('note');
            $suivi_action->delais = $request->get('delais');
            $suivi_action->action = $request->get('action');
            $suivi_action->action_id = $request->get('action_id'); 
            $suivi_action->save(); */
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
            $action->bakup = $request->get('bakup');
            $action->agent = $request->get('agent');
            $action->pourcentage = $request->get('pourcentage'); 
            $action->agent_id = $request->get('agent_id'); 
            $action->reunion_id = $request->get('reunion_id');
            $action->raison = $request->get('raison');
            $action->update();

        return redirect('/liste_actions')->with(['message' => $message]);
    }
  
   public function update_action_prospectE(Request $request, $id)
    {
    
        $message = "Action modifiée avec succès !";
    
            $action = Action::find($id);
            $action->libelle = $request->get('libelle');
            $action->deadline = $request->get('deadline'); 
            $action->visibilite = $request->get('visibilite');
            $action->note = $request->get('note');
            // $action->risque = $request->get('risque');   
            $action->delais = $request->get('delais'); 
            $action->reunion = $request->get('reunion');
            $action->agent = $request->get('agent');
            $action->pourcentage = $request->get('pourcentage'); 
            // $action->agent_id = $request->get('agent_id'); 
            $action->raison = $request->get('raison');
            $action->update();

   
        return redirect('/liste_actions')->with(['message' => $message]);
    }
    
    
    
         public function edit_action_suivi($id)
    {
        
        $action_suivi = Suivi_agent_prospect::find($id);
        $competences = DB::table('competences')->get();
        
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('prospect.edit_action_suivi', compact('competences','action_suivi','headers'));
    }
    public function update_action_suivi(Request $request, $id)
    {
    
        $message = "Action modifiée avec succès !";
    
            $competence = Suivi_agent_prospect::findOrFail($id);
            $competence->competence_dev1 = $request->get('competence_dev1');
            $competence->competence_dev2 = $request->get('competence_dev2');
            $competence->competence_dev3 = $request->get('competence_dev3');
            $competence->souhait = $request->get('souhait');
            $competence->poste_job = $request->get('poste_job');
            // $competence->email = $request->get('email');
            // $competence->tel = $request->get('tel');
            // $competence->whatshap = $request->get('whatshap');
            // $competence->date_naiss = $request->get('date_naiss');
            // $competence->nombre_annee_pro = $request->get('nombre_annee_pro');
            // $competence->profil_LinkedIn = $request->get('profil_LinkedIn');
            // $competence->lien_LinkedIn = $request->get('lien_LinkedIn');
            $competence->save();
    
        return redirect('/liste_actions')->with(['message' => $message]);
    }
    
    
public function lister_actions()
    {
        $agents = DB::table('agents')->where('user_id', Auth::user()->id)->first();
        $actions = DB::table('actions')->where('agent_id', $agents->id)->get();
        return view ('prospect.lister_actions', compact('actions'));
    }
    public function filtre_actions_prosE(Request $request)
    {
        $search = $request->get('search');
        $agents = DB::table('agents')->where('user_id', Auth::user()->id)->first();
        $actions = DB::table('actions')
        ->where('agent_id', $agents->id)
        ->where('source','like', '%'.$search.'%')
        ->get();
        return view ('prospect.lister_actions', compact('actions', 'search'));
    }
    
    public function enregistrer_actions_pros()
    {
        return view ('prospect.enregistrer_actions_pros');
    }

    
    public function enregistrer_actions_store_pros(Request $request)
    {
      
            $agents = DB::table('prospects')->where('email', Auth::user()->email)->first();
            $message = "Action ajoutée avec succès";
            
                 $libelle = $request->get('libelle');
                 $deadline = $request->get('deadline');
                 $agent_id = $request->get('agent_id');

                 for($i=0; $i < count($libelle); $i++){
                 $personnes = [
                    
                     'libelle' => $libelle[$i],
                     'deadline' => $deadline[$i],
                     'agent_id' =>$agents->id,
                         ];
                     
                     DB::table('actions')->insert($personnes);
                 }
                  return back()->with(['message' =>$message]);
    }

public function besoin_assistances()
    {
        return view ('prospect.besoin_assistances');
    }

    
    public function besoin_assistances_storeOui(Request $request, $id)
    {
      
            $agents = DB::table('prospects')->where('email', Auth::user()->email)->first();
            $message = " ";
            
                $agent = Agent::findOrFail($id);
                $agent->assistance = 1 ;
                $agent->save();
                  return redirect('/liste_actions')->with(['message' =>$message]);
    }
    public function besoin_assistances_storeNon(Request $request, $id)
    {
      
            // dd($agents);
            $message = "";
            
                $agent = Agent::findOrFail($id);
                $agent->assistance = 0 ;
                $agent->save();
                
            //   $user = DB::table('agents')->where('user_id', Auth::user()->id)->first();
            // Mail::send('mail.actions_prospect', ['user' => $user], function ($m) use ($user) {
            //     $m->from('notifycollaboratis@gmail.com', 'Feedback');
    
            //     $m->to($user->email, $user->prenom)->subject(' Vos actions');
            // });
                  return redirect('/liste_actions')->with(['message' =>$message]);
    }


    public function show($id)
    {
        //
    }

   public function edit_utilisateurs($id)
    {
        $agent = Agent::find($id);
        $pays = DB::table('pays')->orderby('libelle', 'ASC')->get();
        $entreprise = DB::table('entreprises')->get();
        $direction = DB::table('directions')->get();
        return view('prospect.edit_utilisateurs', compact('entreprise', 'agent', 'direction', 'pays'));
    }
    
    public function update_utilisateurs(Request $request, $id)
    {
        $message = "Utilisateur modifié avec succè";
        $agent = Agent::find($id);
        $agent->prenom = $request->get('prenom'); 
        $agent->nom = $request->get('nom'); 
        $agent->email = $request->get('email');
        $agent->email_perso = $request->get('email_perso');
        $agent->pays_id = $request->get('pays_id');
        $agent->departement = $request->get('departement');
        $agent->tel = $request->get('tel');
        $agent->whatshap = $request->get('whatshap');
        $agent->fonction = $request->get('fonction');
        $agent->direction_id = $request->get('direction_id');
        $agent->update();
            DB::table('users')->where('id', $agent->user_id)->update(['email' => $agent->email]);
        
         return redirect('/liste_utilisateurs')->with(['message' => $message]);
    }
    
    
     public function edit_utilisateurs_enligne($id)
    {
        $agent = User::find($id);
        $pays = DB::table('pays')->orderby('libelle', 'ASC')->get();
        $entreprise = DB::table('entreprises')->get();
        $direction = DB::table('directions')->get();
        return view('prospect.edit_utilisateurs_enligne', compact('entreprise', 'agent', 'direction', 'pays'));
    }
    
    public function update_utilisateurs_enligne(Request $request, $id)
    {
        $message = "Utilisateur modifié avec succè";
        $agent = User::find($id);
        $agent->prenom = $request->get('prenom'); 
        $agent->nom = $request->get('nom'); 
        $agent->email = $request->get('email');
        
        $agent->update();
            DB::table('agents')->where('user_id', $agent->id)->update(['email' => $agent->email]);
            DB::table('agents')->where('user_id', $agent->id)->update(['prenom' => $agent->prenom]);
            DB::table('agents')->where('user_id', $agent->id)->update(['nom' => $agent->nom]);
        
         return redirect('/qui_est_en_ligne_byfeeding')->with(['message' => $message]);
    }
    
    public function sendmailrelancer(Request $request)
    {
        $rap = "Info envoyée avec succès";
        $name = $request->name;
        $email = $request->email;
        $subject = $request->subject;
        $message = $request->message;

        Mail::to(array($email))->send(new DonnerDesFeedback($subject, $message, $name));
        Session::flash("success");
        return back()->with(['rap' => $rap]);
    }
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
        //
    }

   public function utilisateurs_delete($id)
    {
        $message = "Utilisateur supprimé";
        $utilisateur = Agent::find($id);
        $utilisateur->delete();
            
            DB::table('users')->where('id', $utilisateur->user_id)->delete();

        return back()->with(['message' => $message]);
    }
    
    public function destroy($id)
    {
        //
    }
}
