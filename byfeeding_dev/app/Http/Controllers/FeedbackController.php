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
use App\Suivi_agent_prospect;
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
    
    public function agent_feed_restant()
        {
            $a = DB::table('agents')->where('user_id', Auth::user()->id)->first(); 
            // $source = DB::table('source_feedbacks')->get();
            $clf = DB::table('client_facilitateurs')->where('entreprise_id',$a->entreprise)->orwhere('entreprise_id',$a->entreprise_2)->orderBy('id', 'desc')->first(); 
	
            $feedsGF = DB::table('feedback')->where('agent_id', $a->id)->where('source_id', $clf->source_id)->pluck('agents_id_choisi')->toArray(); 
            $g = DB::table('agents')->where('id', '!=', $a->id)->where('entreprise', $a->entreprise)->orderBy('prenom', 'ASC')->pluck('id')->toArray();
                
                 $results = array_diff($g, $feedsGF);
//dd($results);
                 
                
            return view('feedback/feedbackCollaboratis.agent_feed_restant', compact('results', 'a'));
        }
        
        public function donner_feed_restant($id)
        {
            $a_feed_restant = Agent::find($id); 

            $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
                ->where('user_id', Auth::user()->id)
                ->join('directions', 'directions.id', 'agents.direction_id')
                ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
            $sources = DB::table('source_feedbacks')->get();
            $competences = DB::table('competences')->orderBy('libelle')->get();
            $projets = DB::table('projets')->get();
            $agents = Agent::orderBy('prenom')->Where('entreprise', 3)->get();
                
            return view('feedback/feedbackCollaboratis.agent_restant_donnerFeedback', compact('a_feed_restant', 'headers', 'competences','sources','projets', 'users', 'agents'));
        }
        
        public function create_source()
         {
                         $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
                        ->where('user_id', Auth::user()->id)
                        ->join('directions', 'directions.id', 'agents.direction_id')
                        ->paginate(1);
                        $entreprises = DB::table('entreprises')->get();
                        $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
         
           
           // $feedback = Feedback::find($id);//pour recuperer id cliquer
             return view('feedback/feedbackCollaboratis.ajouter_source', compact('headers','entreprises', 'users'));
             
         } 
         
         public function store_source(Request $request)
         {
            $date = date('y-m-d h:i:s');
            $message = "Source ajoutée";
            $source = new Source_feedback;
            $source->nom_source = $request->get('nom_source');
            $source->entreprise_id = $request->get('entreprise_id');
            $source->date_debut = $request->get('date_debut');
            $source->date_fin = $request->get('date_fin');
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
            $competences = DB::table('competences')->orderBy('libelle')->get();
            $projets = DB::table('projets')->get();
            $agents = Agent::orderBy('prenom')->Where('entreprise', 3)->get();
           // $feedback = Feedback::find($id);//pour recuperer id cliquer
             return view('feedback/feedbackCollaboratis.donnerFeedback', compact('headers', 'competences','sources','projets', 'users', 'agents'));
             
         } 
         
         public function feedbackDonner_store(Request $request)
         {
            $agent = DB::table('agents')->where('user_id', Auth::user()->id)->first();
            $message = "Feedback envoyé";
            $donner = new Feedback;
            $donner->nom_feedback = encrypt($request->get('nom_feedback'));
            $donner->agents_id_choisi = $request->get('agents_id_choisi');
            $donner->source_id = $request->get('source_id');
            $donner->projet_id = $request->get('projet_id');
            $donner->apprecier_1 = encrypt($request->get('apprecier_1'));
            $donner->apprecier_2 = encrypt($request->get('apprecier_2'));
            $donner->apprecier_3 = encrypt($request->get('apprecier_3'));
            $donner->ameliorer_1 = encrypt($request->get('ameliorer_1'));
            $donner->ameliorer_2 = encrypt($request->get('ameliorer_2'));
            $donner->ameliorer_3 = encrypt($request->get('ameliorer_3'));
            $donner->type_ano = $request->get('type_ano');
            $donner->note = $request->get('note');
            $donner->satisfaction_penser = $request->get('satisfaction_penser');
            $donner->competence_id = $request->get('competence_id');
            $donner->agent_id = $agent->id;
            $donner->choix = 'feedback';
            $donner->crypted = 1;
            $donner->save();
           
            $user = DB::table('agents')->where('id', $donner->agents_id_choisi)->orderBy('prenom')->first();
           /* Mail::send('mail.feedbackdonner', ['user' => $user], function ($m) use ($user) {
                $m->from('notifycollaboratis@gmail.com', 'Feedback-Collaboratis');
    
                $m->to($user->email, $user->prenom)->subject(' Feedback');
            }); */
                
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
			
             $action = DB::table('actions')->where('agent_id', $personne_choisi->id)->first(); 
			$source_list = DB::table('source_feedbacks')->get();	
		
             return view('feedback/feedbackCollaboratis.listfeedback_par_source', compact('headers','users', 'source_list','action', 'personne_choisi', 'feedback'));  
             
         } 
         
          public function listfeedback_par_sourceA($id)
         {
             
             $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
            ->where('user_id', Auth::user()->id)
            ->join('directions', 'directions.id', 'agents.direction_id')
            ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
             
             $personne_choisi = DB::table('agents')->where('user_id', Auth::user()->id)->first();
             $feedback = DB::table('feedback')->where('agents_id_choisi', $personne_choisi->id)->where('choix', 'feedback')->get();
             $action = DB::table('actions')->where('agent_id', $personne_choisi->id)->first(); 
			$source_list = DB::table('source_feedbacks')->get();	
			
			$actionF = Action::find($id);
			
			$actions = DB::table('actions')->where('id', $actionF->id)->get();
		
             return view('feedback/feedbackCollaboratis.listfeedback_par_action', compact('headers','users', 'actionF', 'source_list','action', 'personne_choisi', 'feedback', 'actions'));  
             
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
			$feedback = DB::table('feedback')->where('agents_id_choisi', $personne_choisi->id)->where('choix', 'feedback')->where('source_id', $source->id)->paginate(10);
			
		
            return view('feedback/feedbackCollaboratis.feedback_recu', compact('headers','personne_choisi','id','users', 'source', 'source_list', 'feedback'));
         }
         
         public function voir_listfeedback_groupe($id)
         {
             
            $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
                                            ->where('user_id', Auth::user()->id)
                                            ->join('directions', 'directions.id', 'agents.direction_id')
                                            ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
            $source_list = DB::table('source_feedbacks')->get();	
            $personne_choisi = DB::table('agents')->where('user_id', Auth::user()->id)->first();
			$source = Source_feedback::find($id);
			$feedback = DB::table('feedback')->where('agents_id_choisi', $personne_choisi->id)->where('choix', 'feedback')->where('source_id', $source->id)->paginate(10);
			
		
            return view('feedback/feedbackCollaboratis.feedback_groupe_recu', compact('headers','personne_choisi','id','users', 'source', 'source_list', 'feedback'));
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

            $pdf =PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdf.pdfeed', compact( 'headers','id','users', 'source', 'source_list', 'feedback', 'personne_choisi'))
            ->setOptions([
                "defaultFont" => "poppins",
                "defaultPaperSize" => "a4",
                "dpi" => 130
            ])
            ->setWarnings(false);
            
            //return $pdf->download($source->nom_source . '_' . $random . ".pdf");
            
            return view('pdf.pdfeed', compact('headers','id','users', 'source', 'source_list', 'feedback', 'personne_choisi'));

         }
         
         public function telecharger_listfeedbackPDF($id)
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

            $pdf =PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdf.mypdfeed', compact( 'headers','id','users', 'source', 'source_list', 'feedback', 'personne_choisi'))
            ->setOptions([
                "defaultFont" => "poppins",
                "defaultPaperSize" => "a4",
                "dpi" => 130
            ])
            ->setWarnings(false);
            
            //return $pdf->download($source->nom_source . '_' . $random . ".pdf");
            return $pdf->download('byfeeding.pdf');
            //return view('pdf.pdfeed', compact('headers','id','users', 'source', 'source_list', 'feedback', 'personne_choisi'));

         }
         
         
         
           public function agentsdownload()
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
       $pdf =PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdf.mypdfeed_agent', compact( 'facilitateur','clients','agents'))
            ->setOptions([
                "defaultFont" => "poppins",
                "defaultPaperSize" => "a4",
                "dpi" => 130
            ])
            ->setWarnings(false);
            
            //return $pdf->download($source->nom_source . '_' . $random . ".pdf");
            return $pdf->download('byfeeding.pdf');
    }
          
          
          public function telecharger_listfeedback_groupe($id)
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

            $pdf =PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdf.pdfeed', compact( 'headers','id','users', 'source', 'source_list', 'feedback', 'personne_choisi'))
            ->setOptions([
                "defaultFont" => "poppins",
                "defaultPaperSize" => "a4",
                "dpi" => 130
            ])
            ->setWarnings(false);
            
            //return $pdf->download($source->nom_source . '_' . $random . ".pdf");
            
            return view('pdf.pdfeed_groupe', compact('headers','id','users', 'source', 'source_list', 'feedback', 'personne_choisi'));

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
			    ->paginate(10);
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
             $feedback = DB::table('feedback')->where('agents_id_choisi', $personne_choisi->id)->where('choix', 'feedback')->paginate(10);
									        
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
         
       // Prospect 
        
        public function donnerFeedback($id)
         {
                         $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
                        ->where('user_id', Auth::user()->id)
                        ->join('directions', 'directions.id', 'agents.direction_id')
                        ->paginate(1);
                        $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();

                        $feedback = Feedback::find($id);//pour recuperer id cliquer
             return view('feedback/feedbackProspect.feedback_donner', compact('headers','users','feedback'));
             
         }
        
          public function donnerFeedback_store(Request $request, $id)
          {

                $feedback = Feedback::find($id);
                $personne_choisi = DB::table('personne_choisis')->where('feedback_id', $feedback->id)->where('email', Auth::user()->email)->first();

             $message = "Feedback envoyé";
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
             return view('feedback/feedbackProspect.liste_feedback_donner', compact('headers','users','personne_choisi', 'feed'));
             
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
									        
             return view('feedback/feedbackProspect.liste_feedback_recu', compact('headers','users', 'feed', 'prospect', 'feedback'));
             
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

            
             
             return view('feedback/feedbackProspect.feedbackRecu', compact('headers','users', 'personne_choisie', 'reponses'));
             
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
             
              return view('feedback/feedbackProspect.demanderfeedback', compact('headers','users'));
             
          } 
          public function feedbackDemander_store(Request $request)
          {
             $prospect = DB::table('prospects')->where('email', Auth::user()->email)->first();
            //  dd($prospect);
             $message = "Demande feedback envoyé";
             $demande = new Feedback;
             $demande->nom_feedback = $request->get('nom_feedback');
            //  $demande->date_debut = $request->get('date_debut');
            //  $demande->date_fin = $request->get('date_fin');
            //  $demande->critere_1 = $request->get('critere_1');
            //  $demande->critere_2 = $request->get('critere_2');
            //  $demande->critere_3 = $request->get('critere_3');
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
                 DB::table('users')->insert($personnes);
                // $usrs = User::where('email', '=', $request->input('email'))->first();
                // if ($usrs === null) {
                //     DB::table('users')->insert($personnes);
                //   // User does not exist
                // } else {
                //   $mess = 'bloquer';
                // }
                   
                 
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
         
         
           //Suivi byfeeding 
         
         public function feedbackSuivi()
         {
            $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
                ->where('user_id', Auth::user()->id)
                ->join('directions', 'directions.id', 'agents.direction_id')
                ->paginate(1);
            $users = Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
            $sources = DB::table('source_feedbacks')->get();
            $competences = DB::table('competences')->get();
            $projets = DB::table('projets')->get();
            $agents = Agent::orderBy('prenom')->where('nom_role', 'entreprise')->get();
           // $feedback = Feedback::find($id);//pour recuperer id cliquer
             return view('feedback/feedbackCollaboratis.suivi', compact('headers', 'competences','sources','projets', 'users', 'agents'));
             
         } 
         
         public function feedbackSuivi_store(Request $request)
         {
             $agent = DB::table('agents')->where('user_id', Auth::user()->id)->first();
            

                $user = new Suivi_agent_prospect;
                $user->email = $request->get('email');
                $user->tel = $request->get('tel');
                $user->whatshap = $request->get('whatshap');
                $user->date_naiss = $request->get('date_naiss');
                $user->nombre_annee_pro = $request->get('nombre_annee_pro');
                $user->profil_LinkedIn = $request->get('profil_LinkedIn');
                $user->lien_LinkedIn = $request->get('lien_LinkedIn');
                $user->agent_id = $agent->id;
                $user->entreprise = $agent->entreprise;
                $user->save();
                return redirect('/competences_a_developper');
         } 

         
       
}         