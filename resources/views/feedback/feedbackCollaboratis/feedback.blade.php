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
use App\Personne_choisi;
use App\Critere_feedback;
use App\Source_feedback;
use DB;
use Auth;
use App\User;
use Session;
use Illuminate\Support\Facades\Hash;
use Mail;

//M.A.X B.I.R.D was here
use PDF;
use Illuminate\Support\Str;


class FeedbackController extends Controller
{
        public function create_source()
         {
                         $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
                        ->where('user_id', Auth::user()->id)
                        ->join('directions', 'directions.id', 'agents.direction_id')
                        ->paginate(1);
                        $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
         
           
           // $feedback = Feedback::find($id);//pour recuperer id cliquer
             return view('feedback/feedbackCollaboratis.ajouter_source', compact('headers', 'users'));
             
         } 
         
         public function store_source(Request $request)
         {
            $message = "Source ajoutée";
            $source = new Source_feedback;
            $source->nom_source = $request->get('nom_source');
            $source->save();
           
            return back()->with(['message' =>$message]);
         } 
     public function feedbackDonner()
         {
            $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
                ->where('user_id', Auth::user()->id)
                ->join('directions', 'directions.id', 'agents.direction_id')
                ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
            $sources = DB::table('source_feedbacks')->get();
            $projets = DB::table('projets')->get();
            $agents = Agent::orderBy('prenom')->get();
           // $feedback = Feedback::find($id);//pour recuperer id cliquer
             return view('feedback/feedbackCollaboratis.donnerFeedback', compact('headers','sources','projets', 'users', 'agents'));
             
         } 
         
         public function feedbackDonner_store(Request $request)
         {
            $agent = DB::table('agents')->where('user_id', Auth::user()->id)->first();
            $message = "Feedback envoyée";
            $donner = new Feedback;
            $donner->nom_feedback = encrypt($request->get('nom_feedback'));
            $donner->agents_id_choisi = $request->get('agents_id_choisi');
            $donner->source_id = $request->get('source_id');
            $donner->projet_id = $request->get('projet_id');
            $donner->ameliorer = encrypt($request->get('ameliorer'));
            $donner->apprecier = encrypt($request->get('apprecier'));
            $donner->type_ano = $request->get('type_ano');
            $donner->agent_id = $agent->id;
            $donner->choix = 'feedback';
            $donner->crypted = 1;
            $donner->save();
           
            $user = DB::table('agents')->where('id', $donner->agents_id_choisi)->orderBy('prenom')->first();

            Mail::send('mail.feedbackdonner', ['user' => $user], function ($m) use ($user) {
                $m->from('notifycollaboratis@gmail.com', 'Feedback-Collaboratis');
    
                $m->to($user->email, $user->prenom)->subject('Demande Feedback');
            }); 
                
            return back()->with(['message' =>$message]);
         } 
         public function listfeedback_par_source()
         {
             
             $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
            ->where('user_id', Auth::user()->id)
            ->join('directions', 'directions.id', 'agents.direction_id')
            ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
             
             $personne_choisi = DB::table('agents')->where('user_id', Auth::user()->id)->first();
             $feedback = DB::table('feedback')->where('agents_id_choisi', $personne_choisi->id)->where('choix', 'feedback')->get();
			$source_list = DB::table('source_feedbacks')->get();	
		
             return view('feedback/feedbackCollaboratis.listfeedback_par_source', compact('headers','users', 'source_list', 'feedback'));
             
         } 
          public function voir_listfeedback($id)
         {
             
            $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
                                            ->where('user_id', Auth::user()->id)
                                            ->join('directions', 'directions.id', 'agents.direction_id')
                                            ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
            $source_list = DB::table('source_feedbacks')->get();	
            $personne_choisi = DB::table('agents')->where('user_id', Auth::user()->id)->first();
			$source = Source_feedback::find($id);
			$feedback = DB::table('feedback')->where('agents_id_choisi', $personne_choisi->id)->where('choix', 'feedback')->where('source_id', $source->id)->get();
            return view('feedback/feedbackCollaboratis.feedback_recu', compact('headers','id','users', 'source', 'source_list', 'feedback'));
         }

        public function telecharger_listfeedback($id)
        {
            $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
                                            ->where('user_id', Auth::user()->id)
                                            ->join('directions', 'directions.id', 'agents.direction_id')
                                            ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
            $source_list = DB::table('source_feedbacks')->get();	
            $personne_choisi = DB::table('agents')->where('user_id', Auth::user()->id)->first();
			$source = Source_feedback::find($id);
			$feedback = DB::table('feedback')->where('agents_id_choisi', $personne_choisi->id)->where('choix', 'feedback')->where('source_id', $source->id)->get();
            $random = Str::random(6);

            $pdf =PDF::loadView('pdf.feedback_content', compact('headers','id','users', 'source', 'source_list', 'feedback'))
            ->setOptions([
                "defaultFont" => "poppins",
                "defaultPaperSize" => "a4",
                "dpi" => 130
            ])
            ->setWarnings(false);
            
            return $pdf->download($source->nom_source . '_' . $random . ".pdf");
            
            return view('pdf.feedback_content', compact('headers','id','users', 'source', 'source_list', 'feedback'));

         }
          
           public function filtrer_feedback(Request $request, $id)
         {
             $search = $request->get('search');
             $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
            ->where('user_id', Auth::user()->id)
            ->join('directions', 'directions.id', 'agents.direction_id')
            ->paginate(1);
            $source = Source_feedback::find($id);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
             	$source_list = DB::table('source_feedbacks')->get();	
             $personne_choisi = DB::table('agents')->where('user_id', Auth::user()->id)->first();
			    $feedback = DB::table('feedback')->where('agents_id_choisi', $personne_choisi->id)
			    ->where('choix', 'feedback')
			    ->where('type_ano', 1)
			    ->where('source_id', $source->id)
			    ->where('agent_id','like', '%'.$search.'%')
			    ->get();
             return view('feedback/feedbackCollaboratis.feedback_recu', compact('headers','id','users','search', 'source_list', 'feedback'));
         }
           public function ListeFeedbackRecu()
         {
             
             $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
            ->where('user_id', Auth::user()->id)
            ->join('directions', 'directions.id', 'agents.direction_id')
            ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
             
             $personne_choisi = DB::table('agents')->where('user_id', Auth::user()->id)->first();
             $feedback = DB::table('feedback')->where('agents_id_choisi', $personne_choisi->id)->where('choix', 'feedback')->get();
									        
             return view('feedback/feedbackCollaboratis.feedback_recu', compact('headers','users', 'personne_choisi', 'feedback'));
             
         } 
         public function feedbackRecu($id)
         {
             
             $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
            ->where('user_id', Auth::user()->id)
            ->join('directions', 'directions.id', 'agents.direction_id')
            ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
             
             $feedback = Feedback::find($id);
             $feedbackdonner = DB::table('feedback')->where('id', $feedback->id)->get();
            
             
             return view('feedback/feedbackCollaboratis.detail_feedback', compact('headers','users', 'feedback', 'feedbackdonner'));
             
         } 
         
       
         
        public function appreciationDonner()
         {
             
             $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
            ->where('user_id', Auth::user()->id)
            ->join('directions', 'directions.id', 'agents.direction_id')
            ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
             
             $critere = DB::table('criteres')->get();
              $agents = DB::table('agents')->get();
             return view('feedback/feedbackCollaboratis.donnerApreciation', compact('headers','users', 'agents', 'critere'));
             
         }
         public function appreciationDonner_store(Request $request)
         {
            $agent = DB::table('agents')->where('user_id', Auth::user()->id)->first();
            $message = "Appréciation envoyée";
            $donner = new Feedback;
            $donner->nom_feedback = $request->get('nom_feedback');
            $donner->agents_id_choisi = $request->get('agents_id_choisi');
            $donner->apprecier_1 = $request->get('apprecier_1');
            $donner->apprecier_2 = $request->get('apprecier_2');
            $donner->apprecier_3 = $request->get('apprecier_3');
            $donner->ameliorer_1 = $request->get('ameliorer_1');
            $donner->ameliorer_2 = $request->get('ameliorer_2');
            $donner->ameliorer_3 = $request->get('ameliorer_3');            
            $donner->type_ano = $request->get('type_ano');
            $donner->agent_id = $agent->id;
            $donner->choix = 'appreciation';
            $donner->save();
           
            // $critere = new Critere_feedback;
            // $critere->nom_critere = $request->get('nom_critere');
            // $critere->note_critere = $request->get('note_critere');
            // $critere->feedback_id = $donner->id;
            // $critere->save();
           
            $nom_critere = $request->get('nom_critere');
            $note_critere = $request->get('note_critere');
            $feedback_id = $request->get('feedback_id');
            
            for($i=0; $i < count($nom_critere); $i++){
            $criteres = [
                
                'nom_critere' => $nom_critere[$i],
                'note_critere' => $note_critere[$i],
                'feedback_id' =>$donner->id
                 ];
                 
                DB::table('critere_feedbacks')->insert($criteres);
        
        
                $user = DB::table('agents')->where('id', $donner->agents_id_choisi)->first();
    
                  Mail::send('mail.appreciationdonner', ['user' => $user], function ($m) use ($user) {
                    $m->from('notifycollaboratis@gmail.com', 'Feedback-Collaboratis');
        
                    $m->to($user->email, $user->prenom)->subject('Demande Feedback');
                }); 
            }
            return back()->with(['message' =>$message]);
         } 
          public function ListerAppreciationRecu()
         {
             
             $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
            ->where('user_id', Auth::user()->id)
            ->join('directions', 'directions.id', 'agents.direction_id')
            ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
             
             $personne_choisi = DB::table('agents')->where('user_id', Auth::user()->id)->first();
             $feedback = DB::table('feedback')->where('agents_id_choisi', $personne_choisi->id)->where('choix', 'appreciation')->get();
             return view('feedback/feedbackCollaboratis.liste_appreciation_recu', compact('headers','users','personne_choisi', 'feedback'));
             
         }
         public function appreciationRecus($id)
         {
             
             $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
            ->where('user_id', Auth::user()->id)
            ->join('directions', 'directions.id', 'agents.direction_id')
            ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
             
             $feedback = Feedback::find($id);
             $feedbackdonner = DB::table('feedback')->where('id', $feedback->id)->get();
             return view('feedback/feedbackCollaboratis.detail_appreciation', compact('headers','users', 'feedback', 'feedbackdonner'));
             
         }
         public function appreciationDemander()
         {
             
             $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
            ->where('user_id', Auth::user()->id)
            ->join('directions', 'directions.id', 'agents.direction_id')
            ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
             
             return view('feedback/feedbackCollaboratis.demandeAppreciation', compact('headers','users'));
             
         }
         public function appreciationDemander_store(Request $request)
         {
            $message = "Critère enregistré";
            $critere = new Critere;
            $critere->libelle = $request->get('libelle');
            $critere->save();
            return back()->with(['message' =>$message]);
         } 
         
       // Prospect  C.M was Here
        
        
        public function donnerFeedback($id)
         {
                         $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
                        ->where('user_id', Auth::user()->id)
                        ->join('directions', 'directions.id', 'agents.direction_id')
                        ->paginate(1);
                        $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();

                        $feedback = Feedback::find($id);//pour recuperer id cliquer
             return view('feedback.feedback_donner', compact('headers','users','feedback'));
             
         }
        
          public function donnerFeedback_store(Request $request, $id)
          {

                $feedback = Feedback::find($id);
                $personne_choisi = DB::table('personne_choisis')->where('feedback_id', $feedback->id)->where('email', Auth::user()->email)->first();

             $message = "Feedback envoyée";
             $donne = new ReponseFeedback;
             $donne->apprecier_1 = $request->get('apprecier_1');
             $donne->apprecier_2 = $request->get('apprecier_2');
             $donne->apprecier_3 = $request->get('apprecier_3');
             $donne->ameliorer_1 = $request->get('ameliorer_1');
             $donne->ameliorer_2 = $request->get('ameliorer_2');
             $donne->ameliorer_3 = $request->get('ameliorer_3');
             $donne->note_critere_1 = $request->get('note_critere_1');
             $donne->note_critere_2 = $request->get('note_critere_2');
             $donne->note_critere_3 = $request->get('note_critere_3');
             $donne->personne_choisi_id = $personne_choisi->id;
             $donne->demande_feedback_id = $feedback->id;
             $donne->choix = 'feedback';
             $donne->save();
            
             return back()->with(['message' =>$message]);
          }
          public function ListeFeedbackDonner()
         {
             
             $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
            ->where('user_id', Auth::user()->id)
            ->join('directions', 'directions.id', 'agents.direction_id')
            ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
             
             $personne_choisi = DB::table('personne_choisis')->select('feedback_id')->where('email', Auth::user()->email)->get();
             $feed = array();
             foreach($personne_choisi as $personne_choisis){
             $feedback = DB::table('feedback')->where('id', $personne_choisis->feedback_id)->where('choix', 'feedback')->get();
             array_push($feed, $feedback);
            //  dd($personne_choisi);
             }
             return view('feedback.liste_feedback_donner', compact('headers','users','personne_choisi', 'feedback', 'feed'));
             
         }
         //reponse
         public function ListeProspectFeedbackRecu()
         {
             
             $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
            ->where('user_id', Auth::user()->id)
            ->join('directions', 'directions.id', 'agents.direction_id')
            ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
             
             $prospect = DB::table('prospects')->where('email', Auth::user()->email)->get();
               $feedback = array();
             foreach($prospect as $prospects){
             $feed = DB::table('feedback')->where('prospect_id', $prospects->id)->where('choix', 'feedback')->get();
             array_push($feedback, $feed);
            //  dd($personne_choisi);
             }
            // $reponse = DB::table('reponse_feedback')->where('demande_feedback_id', $prospect->feedback_id)->where('choix', 'feedback')->get();
									        
             return view('feedback.liste_feedback_recu', compact('headers','users', 'prospect', 'feedback'));
             
         } 
         public function prospectFeedbackRecu($id)
         {
             
             $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
            ->where('user_id', Auth::user()->id)
            ->join('directions', 'directions.id', 'agents.direction_id')
            ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
             
             $personne_choisie = Personne_choisi::find($id);
             $reponses = DB::table('reponse_feedback')->where('personne_choisi_id', $personne_choisie->id)->first();

            
             
             return view('feedback.feedbackRecu', compact('headers','users', 'personne_choisie', 'reponses'));
             
         } 
         
          public function apprecierDemander()
          {
             
              $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
            ->where('user_id', Auth::user()->id)
             ->join('directions', 'directions.id', 'agents.direction_id')
             ->paginate(1);
             $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
             
              return view('feedback.demanderappreciation', compact('headers','users'));
             
          } 
          public function apprecierDemander_store(Request $request)
          {
             $prospect = DB::table('prospects')->where('email', Auth::user()->email)->first();
             $message = "Demande d'appréciation envoyée";
             $demande = new Feedback;
             $demande->nom_feedback = $request->get('nom_feedback');
             $demande->date_debut = $request->get('date_debut');
             $demande->date_fin = $request->get('date_fin');
             $demande->prospect_id = $prospect->id;
             $demande->choix = 'appreciation';
             $demande->save();
            
           
                $user = new User;
                $user->email = $request->get('email');
                $user->nom_role = 'prospect';
                $pass = '1234';
                
             $prenom = $request->get('prenom');
             $nom = $request->get('nom');
             $email = $request->get('email');
             $nom_role = $request->get('nom_role');
             $feedback_id = $request->get('feedback_id');
             $user->password = Hash::make($pass); 
             
             for($i=0; $i < count($prenom); $i++){
             $personnes = [
                
                 'prenom' => $prenom[$i],
                 'nom' => $nom[$i],
                 'email' => $email[$i],
                 'nom_role' => 'prospect',
                 'feedback_id' =>$demande->id,
                 'password' => Hash::make(1234)
                     ];
                 
                 DB::table('personne_choisis')->insert($personnes);
                 DB::table('prospects')->insert($personnes);
                 $usrs = User::where('email', '=', $request->input('email'))->first();
                if ($usrs === null) {
                    DB::table('users')->insert($personnes);
                  // User does not exist
                } else {
                  $mess = 'bloquer';
                }
                 
                 $prospects = DB::table('prospects')->where('id', $demande->prospect_id)->first();
                 // $fee = DB::table('feedback')->first();
                 $user = DB::table('personne_choisis')->where('feedback_id', $demande->id)->get();

                 foreach($user as $users){
                    
    
                   Mail::send('mail.prospectDemandeFeedback', ['users' => $users, 'prospects' => $prospects], function ($m) use ($users) {
                     $m->from('notifycollaboratis@gmail.com', 'Feedback-Collaboratis');
        
                     $m->to($users->email, $users->prenom)->subject('Demande Feedback');
                 }); 
                 }
             }
            
             return back()->with(['message' =>$message]);
          } 
          
           public function ListeapprecierDonner()
         {
             
             $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
            ->where('user_id', Auth::user()->id)
            ->join('directions', 'directions.id', 'agents.direction_id')
            ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
             
            $personne_choisi = DB::table('personne_choisis')->select('feedback_id')->where('email', Auth::user()->email)->get();
             $feed = array();
             foreach($personne_choisi as $personne_choisis){
             $feedback = DB::table('feedback')->where('id', $personne_choisis->feedback_id)->where('choix', 'appreciation')->get();
             array_push($feed, $feedback);
            //  dd($personne_choisi);
             }
             
             return view('feedback.liste_apprecier_donner', compact('headers','users','personne_choisi', 'feedback', 'feed'));
             
         }
          public function apprecierDonners($id)
         {
                         $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
                        ->where('user_id', Auth::user()->id)
                        ->join('directions', 'directions.id', 'agents.direction_id')
                        ->paginate(1);
                        $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
            
            $critere = DB::table('criteres')->get();
                        $feedback = Feedback::find($id);//pour recuperer id cliquer
             return view('feedback.donnerApreciation', compact('headers','users','feedback', 'critere'));
             
         }
         public function apprecierDonner_store(Request $request, $id)
          {
               $feedback = Feedback::find($id);
             $personne_choisi = DB::table('personne_choisis')->where('feedback_id', $feedback->id)->where('email', Auth::user()->email)->first();

               
             $message = "Appréciation envoyée";
             $donne = new ReponseFeedback;
             $donne->apprecier_1 = $request->get('apprecier_1');
             $donne->apprecier_2 = $request->get('apprecier_2');
             $donne->apprecier_3 = $request->get('apprecier_3');
             $donne->ameliorer_1 = $request->get('ameliorer_1');
             $donne->ameliorer_2 = $request->get('ameliorer_2');
             $donne->ameliorer_3 = $request->get('ameliorer_3');
             $donne->personne_choisi_id = $personne_choisi->id;
             $donne->demande_feedback_id = $feedback->id;
             $donne->choix = 'appreciation';
             $donne->save();
             
                $nom_critere = $request->get('nom_critere');
                $note_critere = $request->get('note_critere');
                $feedback_id = $request->get('feedback_id');
            
            for($i=0; $i < count($nom_critere); $i++){
            $criteres = [
                
                'nom_critere' => $nom_critere[$i],
                'note_critere' => $note_critere[$i],
                'feedback_id' => $donne->demande_feedback_id
                 ];
                 
                DB::table('critere_feedbacks')->insert($criteres);
            }
             return back()->with(['message' =>$message]);
         
      }
     
       public function ListeapprecierRecu()
         {
             
             $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
            ->where('user_id', Auth::user()->id)
            ->join('directions', 'directions.id', 'agents.direction_id')
            ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
             
            //  $prospect = DB::table('prospects')->where('email', Auth::user()->email)->first();
            //  $feedback = DB::table('feedback')->where('prospect_id', $prospect->id)->get();
            // $reponse = DB::table('reponse_feedback')->where('demande_feedback_id', $prospect->feedback_id)->where('choix', 'feedback')->get();
			
			   $prospect = DB::table('prospects')->where('email', Auth::user()->email)->get();
               $feedback = array();
             foreach($prospect as $prospects){
             $feed = DB::table('feedback')->where('prospect_id', $prospects->id)->where('choix', 'appreciation')->get();
             array_push($feedback, $feed);
            //  dd($personne_choisi);
             }
             
             return view('feedback.liste_apprecier_recu', compact('headers','users', 'prospect', 'feedback', 'feed'));
             
         }
         public function ListeProspectapprecierRecu($id)
         {
             
             $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
            ->where('user_id', Auth::user()->id)
            ->join('directions', 'directions.id', 'agents.direction_id')
            ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
             
            //  $prospect = DB::table('prospects')->where('email', Auth::user()->email)->first();
            //  $feedbackdonner  = DB::table('feedback')->where('prospect_id', $prospect->id)->get();
            // $reponse = DB::table('reponse_feedback')->where('demande_feedback_id', $prospect->feedback_id)->where('choix', 'feedback')->get();
			 
			 $personne_choisie = Personne_choisi::find($id);
             $reponses = DB::table('reponse_feedback')->where('personne_choisi_id', $personne_choisie->id)->first();
             
            
             return view('feedback.detail_apprecier_recu', compact('headers','users', 'personne_choisie', 'reponses'));
             
         } 
         
         //end Prospect
         
         
         //public function feedbackLister()
         //{
             
        //     $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        //    ->where('user_id', Auth::user()->id)
        //    ->join('directions', 'directions.id', 'agents.direction_id')
        //    ->paginate(1);
        //    $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
             
            // $personne_choisi = DB::table('personne_choisis')->where('email', Auth::user()->email)->get();
            
             
             
        //     return view('feedback.liste_feedback_donner', compact('headers','users'));
             
        // } 
         
         
          public function feedbackDemander()
          {
             
              $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
            ->where('user_id', Auth::user()->id)
             ->join('directions', 'directions.id', 'agents.direction_id')
             ->paginate(1);
             $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
             
              return view('feedback.demanderfeedback', compact('headers','users'));
             
          } 
          public function feedbackDemander_store(Request $request)
          {
             $prospect = DB::table('prospects')->where('email', Auth::user()->email)->first();
             $message = "Demande feedback envoyée";
             $demande = new Feedback;
             $demande->nom_feedback = $request->get('nom_feedback');
             $demande->date_debut = $request->get('date_debut');
             $demande->date_fin = $request->get('date_fin');
             $demande->critere_1 = $request->get('critere_1');
             $demande->critere_2 = $request->get('critere_2');
             $demande->critere_3 = $request->get('critere_3');
             $demande->prospect_id = $prospect->id;
             $demande->choix = 'feedback';
             $demande->save();
            
                $user = new User;
                $user->email = $request->get('email');
                $user->nom_role = 'prospect';
                $pass = '1234';
                
             $prenom = $request->get('prenom');
             $nom = $request->get('nom');
             $email = $request->get('email');
             $nom_role = $request->get('nom_role');
             $feedback_id = $request->get('feedback_id');
             $user->password = Hash::make($pass); 
             
             for($i=0; $i < count($prenom); $i++){
             $personnes = [
                
                 'prenom' => $prenom[$i],
                 'nom' => $nom[$i],
                 'email' => $email[$i],
                 'nom_role' => 'prospect',
                 'feedback_id' =>$demande->id,
                 'password' => Hash::make(1234)
                     ];
                 
                 DB::table('personne_choisis')->insert($personnes);
                 DB::table('prospects')->insert($personnes);
                 
                $usrs = User::where('email', '=', $request->input('email'))->first();
                if ($usrs === null) {
                    DB::table('users')->insert($personnes);
                  // User does not exist
                } else {
                  $mess = 'bloquer';
                }
                   
                 
                 $prospects = DB::table('prospects')->where('id', $demande->prospect_id)->first();
                 // $fee = DB::table('feedback')->first();
                 $user = DB::table('personne_choisis')->where('feedback_id', $demande->id)->get();

                 foreach($user as $users){
                    
    
                  Mail::send('mail.prospectDemandeFeedback', ['users' => $users, 'prospects' => $prospects], function ($m) use ($users) {
                     $m->from('notifycollaboratis@gmail.com', 'Feedback-Collaboratis');
        
                     $m->to($users->email, $users->prenom)->subject('Demande Feedback');
                 }); 
                 }
             }
            
             return back()->with(['message' =>$message]);
          } 
                            //envoi mail
                            //  public function envoimail()
                            //     {
                            //         $mail = DB::table('prospects')->get();
                                    
                            //          foreach($mail as $mails){
                            //          Mail::send('mail.sendmailagent', ['mails' => $mails], function ($m) use ($mails) {
                            //              $m->from('notifycollaboratis@gmail.com', 'Feedback-Collaboratis');
                            
                            //              $m->to($mails->email, $mails->prenom)->subject('Mail de Bienvenue');
                            //          }); 
                            //          }
                                     
                            //         return "Email send";
                            //     }
                             
         
         
         
         public function feedbackRecu1($id)
         {
             
             $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
            ->where('user_id', Auth::user()->id)
            ->join('directions', 'directions.id', 'agents.direction_id')
            ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
             
             $feedback = Feedback::find($id);
             $reponse = DB::table('reponse_feedback')->where('demande_feedback_id', $feedback->id)->get();
            
             
             return view('feedback.feedbackRecu', compact('headers','users', 'feedback', 'reponse'));
             
         } 
         
         public function ListerFeedbackRecu()
         {
             
             $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
            ->where('user_id', Auth::user()->id)
            ->join('directions', 'directions.id', 'agents.direction_id')
            ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
             
             $personne_choisi = DB::table('personne_choisis')->where('email', Auth::user()->email)->get();
             
             return view('feedback.liste_feedback_recu', compact('headers','users', 'personne_choisi'));
             
         } 
         public function feedbackRapport()
         {
             
             $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
            ->where('user_id', Auth::user()->id)
            ->join('directions', 'directions.id', 'agents.direction_id')
            ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
             
             return view('feedback.rapportFeedback', compact('headers','users'));
             
         }
         public function feedbackNotation()
         {
             
             $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
            ->where('user_id', Auth::user()->id)
            ->join('directions', 'directions.id', 'agents.direction_id')
            ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
             
             return view('feedback.notationMaTeam', compact('headers','users'));
             
         }
         
         
         
         
         
         public function ListerAppreciationDonner()
         {
             
             $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
            ->where('user_id', Auth::user()->id)
            ->join('directions', 'directions.id', 'agents.direction_id')
            ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
             
             return view('feedback.liste_appreciation_donner', compact('headers','users'));
             
         }
         
       
}         