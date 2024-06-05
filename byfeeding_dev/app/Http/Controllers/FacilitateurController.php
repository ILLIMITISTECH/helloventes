<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Action;
use App\Entreprise;
use App\Client_facilitateur;
use App\Reunion;
use App\Agent;
use DB;
use Auth;
use App\User;
use App\Facilitateur;
use App\Mail\SendPassword;
use App\Mail\RapportResponsable;
use App\Mail\EntrepriseCreer;
use App\Mail\NotifyFacilitateur;
use App\Mail\Phase2;
use App\Source_feedback;
use Session;
use Illuminate\Support\Facades\Hash;
use App\Notifications\BienvenueSurFeedback;
use Mail;
//use mikehaertl\wkhtmlto\Pdf;
//M.A.X B.I.R.D was here
use PDF;
use Illuminate\Support\Str;
use Mailjet\LaravelMailjet\Facades\Mailjet;

class FacilitateurController extends Controller
{
    
    /**
     * Write code on Construct
     *
     * @return \Illuminate\Http\Response
     */
    public function preview()
    {
       
         return view('facilitateur.chart')->render();

    }
  
    /**
     * Write code on Construct
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadF()
    {
        //$render = view('facilitateur.detail_client')->render();
      
         $render =  view('facilitateur.chart')->render();

  
        $pdf = new Pdf;
        $pdf->addPage($render);
        $pdf->setOptions(['javascript-delay' => 5000]);
        $pdf->saveAs(public_path('report.pdf'));
   //pdf = PDF::loadView('facilitateur.detail_client_pdf', compact('agents', 'feedback','entreprise','competence_1','competence_2','competence_3','competence_4','competence_5','competence_12','competence_6','competence_7','competence_8','competence_9','competence_10','competence_11'))->setOptions(['defaultFont' => 'sans-serif']);
    //$pdf = PDF::loadView('facilitateur.detail_client')->setOptions(['defaultFont' => 'sans-serif']);
        //return $pdf->download('byfeeding.pdf');
        return response()->download(public_path('report.pdf'));
    }
    public function index()
    {
       $facilitateurs = DB::table('facilitateurs')->get();
       
       return view('facilitateur.lister', compact('facilitateurs'));
    }
    
    public function liste_pays()
    {
      $pays = DB::table('agents')->select('pays_id')->groupby('pays_id')->where('nom_role', 'entreprise')->where('pays_id', '!=', null)->get();
       
       return view('facilitateur.liste_pays', compact('pays'));
    }
    
    public function liste_sourceF()
    {
       $facilitateur = DB::table('facilitateurs')->where('user_id', Auth::user()->id)->first();
       $clients = DB::table('client_facilitateurs')->where('facilitateur_id', $facilitateur->id)->orderBy('id', 'desc')->get();
       
       return view('facilitateur.lister_sourceF', compact('clients'));
    }
    
    public function lister_clients()
    {
    $facilitateurs = DB::table('facilitateurs')->get();
    // $client_facilitateurs = DB::table('client_facilitateurs')->get();
       
       return view('facilitateur.lister_clients', compact('facilitateurs'));
    }
    public function lister_clients_facilitateur()
    {
    $facilitateur = DB::table('facilitateurs')->where('user_id', Auth::user()->id)->first();
    $clients = DB::table('client_facilitateurs')->where('facilitateur_id', $facilitateur->id)->orderBy('id', 'desc')->get();
    // $clients = DB::table('client_facilitateurs')->where('facilitateur_id', $facilitateurs->id)->get();
    
       
       return view('facilitateur.lister_clients_facilitateur', compact('clients','facilitateur'));
    }
    
     public function liste_utilisateurs_client($id)
    {
        $client_entreprise = Entreprise::Find($id);
        $agent = DB::table('agents')->where('nom_role', 'entreprise')->where('entreprise', $client_entreprise->id)->orwhere('entreprise_2', $client_entreprise->id)->orderBy('prenom', 'asc')->get();
        
        return view('facilitateur.liste_utilisateurs_client', compact('client_entreprise','agent'));
    }
    
    public function filtrer_utilisateur_participant(Request $request, $id) 
    {
        $search = $request->get('search');
     
        $client_entreprise = Entreprise::Find($id);
        $agent = DB::table('agents')->where('nom_role', 'entreprise')
        ->where('entreprise', $client_entreprise->id)
        ->where('id','like', '%'.$search.'%')
        ->whereIn('id', [$search])
        ->orwhere('entreprise_2', $client_entreprise->id)
        ->orderBy('prenom', 'asc')->get();
      
        return view('facilitateur.liste_utilisateurs_client', compact('client_entreprise','agent'));
    }
    
    
    public function lister_entreprise_facilitateur()
    {
    $facilitateur = DB::table('facilitateurs')->where('user_id', Auth::user()->id)->first();
    $entreprises = DB::table('entreprises')->where('facilitateur_id', $facilitateur->id)->get();
       
       return view('facilitateur.lister_entreprise_facilitateur', compact('entreprises','facilitateur'));
    }
    
    public function activer_source(Request $request, $id)
    {
      $message = "Feedback a été activé avec succès";
      $source = Source_feedback::findOrFail($id);
      $source->statut = 1;
      $source->save();
      
    $fl = DB::table('facilitateurs')->where('user_id', Auth::user()->id)->first();
    $cfls = DB::table('client_facilitateurs')->where('facilitateur_id', $fl->id)->get();
    foreach($cfls as $cfl)
    {
     DB::table('source_feedbacks')->where('id', $cfl->source_id)->where('id', '!=', $source->id)->update(['statut' => 0]); 
    } 
       return back()->with(['message' => $message]);
    }
    
    public function desactiver_source(Request $request, $id)
    {
      $message = "Feedback a été desactivé avec succès";
      $source = Source_feedback::findOrFail($id);
      $source->statut = 0;
      $source->save();
      
      
       return back()->with(['message' => $message]);
    }
    
    
     public function initialiser_feedback(Request $request, $id)
    {
      $message = "Feedback a été initialisé avec succès";
      $source = Source_feedback::findOrFail($id);
      $source->phase = $request->phase;
      $source->save();
      
       $pass = 123456;
        $password = Hash::make($pass);
        
        $fl = DB::table('facilitateurs')->where('user_id', Auth::user()->id)->first();
        $cfl = DB::table('client_facilitateurs')->where('facilitateur_id', $fl->id)->OrderBy('id', 'desc')->first();
        $entreprise = DB::table('entreprises')->where('id', $cfl->entreprise_id)->first();
        $sf = DB::table('source_feedbacks')->where('id', $cfl->source_id)->where('statut', 1)->first();
        $users = User::where('entreprise', $sf->entreprise_id)->orWhere('entreprise_2', $sf->entreprise_id)->orWhere('email', 'fallougueye197@gmail.com')->get();
        //dd($users);
        $usersf = User::where('id', $fl->user_id)->first();
       foreach($users as $user)
        {
           
        //  DB::table('users')->where('email', '!=', 'admin@feedback.com')->OrWhere('email', '!=', $fl->email)->update(['password' => $password]);
       
         \Mail::to($user->email)->send(new SendPassword($user, $pass, $fl));
         
       }
       \Mail::to($usersf->email)->send(new NotifyFacilitateur($users, $fl, $entreprise, $sf));
       return back()->with(['message' => $message]);
    }
    
     public function cloturer_feedback(Request $request, $id)
    {
      $message = "Feedback a été clôturé avec succès";
      $source = Source_feedback::findOrFail($id);
      $source->phase = $request->phase;
      $source->save();
      
      $pass = Str::random(5);
        $password = Hash::make($pass);
        
        $fl = DB::table('facilitateurs')->where('user_id', Auth::user()->id)->first();
        $cfl = DB::table('client_facilitateurs')->where('facilitateur_id', $fl->id)->OrderBy('id', 'desc')->first();
        $sf = DB::table('source_feedbacks')->where('id', $cfl->source_id)->where('statut', 1)->first();
        $users = User::where('entreprise', $sf->entreprise_id)->orWhere('entreprise_2', $sf->entreprise_id)->orWhere('email', 'gnagna.n@illimitis.com')->get();
        $responsables = User::where('entreprise', $sf->entreprise_id)->orWhere('entreprise_2', $sf->entreprise_id)->first();
        
       foreach($users as $user)
        {
        \Mail::to($user->email)->send(new Phase2($user, $pass, $sf));
        
         }
    //   \Mail::to($responsables->email)->send(new RapportResponsable($responsables));
       
       return back()->with(['message' => $message]);
    }
    
  
   public function voir_rapport_client($id)
    {
        $entreprise = Entreprise::find($id);
        $client = Client_facilitateur::where('entreprise_id', $entreprise->id)->first();
        $sourcef = DB::table('source_feedbacks')->where('id', $client->source_id)->first();
       
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
        return view('facilitateur.rapport_client',compact('agents','sourcef', 'feedback','entreprise','competence_1','competence_2','competence_3','competence_4','competence_5','competence_12','competence_6','competence_7','competence_8','competence_9','competence_10','competence_11'));
    }
    
     public function voir_client($id)
    {
        $entreprise = Entreprise::find($id);
        $client = Client_facilitateur::where('entreprise_id', $entreprise->id)->first();
        $sourcef = DB::table('source_feedbacks')->where('id', $client->source_id)->first();
       
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
        return view('facilitateur.voir_client',compact('agents','sourcef', 'feedback','entreprise','competence_1','competence_2','competence_3','competence_4','competence_5','competence_12','competence_6','competence_7','competence_8','competence_9','competence_10','competence_11'));
    }
    
     public function voir_detail_client($id)
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
        return view('facilitateur.detail_client',compact('agents', 'feedback','entreprise','competence_1','competence_2','competence_3','competence_4','competence_5','competence_12','competence_6','competence_7','competence_8','competence_9','competence_10','competence_11'));
    }
    
    
    public function rapport_globale_responsable()
    {
        $responsable = DB::table('agents')->where('a_contacter', 'responsable')->where('user_id', Auth::user()->id)->first();
       
        $agents = DB::table('agents')->where('entreprise', $responsable->entreprise)->where('entreprise', '!=', NULL)->get();
        
        
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
        return view('facilitateur.rapport_global_responsable',compact('responsable','agents', 'feedback','competence_1','competence_2','competence_3','competence_4','competence_5','competence_12','competence_6','competence_7','competence_8','competence_9','competence_10','competence_11'));
    }
    
    
  
   public function dashboard_facilitateur()
    {
         $facilitateur = DB::table('facilitateurs')->where('user_id', Auth::user()->id)->first();
         $clients = DB::table('client_facilitateurs')->where('facilitateur_id', $facilitateur->id)->orderBy('id', 'desc')->get();
         
         $facilitateur_backups = DB::table('client_facilitateurs')->where('facilitateur_buckup', $facilitateur->id)->orderBy('id', 'desc')->get();
        return view('facilitateur.dashboard_facilitateur', compact('clients', 'facilitateur_backups'));
    }
    
     public function diagramme_circulaire()
    {
        
     
        $entreprise = Entreprise::find(1);
       
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
        return view('facilitateur.diagramme_circulaire',compact('agents', 'feedback','entreprise','competence_1','competence_2','competence_3','competence_4','competence_5','competence_12','competence_6','competence_7','competence_8','competence_9','competence_10','competence_11'));
    
    }
  public function diagramme_circulaires($id)
    
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
        return view('facilitateur.diagramme_circulaire',compact('agents', 'feedback','entreprise','competence_1','competence_2','competence_3','competence_4','competence_5','competence_12','competence_6','competence_7','competence_8','competence_9','competence_10','competence_11'));
    }
    
  
    public function create()
    {
        $pays = DB::table('pays')->orderby('libelle', 'ASC')->get();
        $entreprise = DB::table('entreprises')->get();
        return view('facilitateur.ajouter', compact('entreprise', 'pays'));
    }
    
    public function store(Request $request)
    {
         request()->validate([
            'email' => 'required|email|unique:users,email',
             
    ]);
        $message = "Ajouté avec succès";
             $image = $request->file('logo');
            if($image){
             $imageName = $image->getClientOriginalName();
             $image->move(public_path().'/images/', $imageName);
             } 
             
            $user = new User;
            $user->prenom = $request->get('prenom');
            $user->nom = $request->get('nom');
            $user->email = $request->get('email');
            $user->nom_role = 'facilitateur';
            $user->password = Hash::make($request->get('password'));
            
            if($user->save()){

                $facilitateur = new Facilitateur;
                $facilitateur->prenom = $request->get('prenom'); 
                $facilitateur->nom = $request->get('nom'); 
                $facilitateur->email = $request->get('email');
                $facilitateur->entreprise = $request->get('entreprise');
                $facilitateur->pays = $request->get('pays');
                $facilitateur->user_id = $user->id;
                $facilitateur->logo = (isset($imageName)) ? $imageName : $facilitateur->logo;
                $facilitateur->save();
            }
            
            return back()->with(['message' => $message]);
    }
    
    public function create_clientFa()
    {
        $facilitateur = DB::table('facilitateurs')->get();
        $profil = DB::table('departements')->get();
        $entreprise = DB::table('entreprises')->get();
        $sources = DB::table('source_feedbacks')->get();
        return view('facilitateur.ajouter_clientFa', compact('entreprise', 'facilitateur', 'profil','sources'));
    }
    
    public function store_clientFa(Request $request)
    {
          
                $message = "Ajouté avec succès";
                $facilitateur = new Client_facilitateur;
                $facilitateur->facilitateur_id = $request->get('facilitateur_id');
                
                $facilitateur->entreprise_id = $request->get('entreprise_id');
                $facilitateur->source_id = $request->get('source_id');
                $facilitateur->departement_id = $request->get('departement_id');
                $facilitateur->save();

            return back()->with(['message' => $message]);
    }
    
    
public function create_client()
    {
        $facilitateur = DB::table('facilitateurs')->get();
        $profil = DB::table('departements')->get();
        $entreprise = DB::table('entreprises')->get();
        $sources = DB::table('source_feedbacks')->get();
        return view('facilitateur.ajouter_client', compact('entreprise', 'facilitateur', 'profil','sources'));
    }
    
    public function store_client(Request $request)
    {
        $message = "Ajouté avec succès";

                $facilitateur = new Client_facilitateur;
                // $facilitateur->nom_client = $request->get('nom_client'); 
                $facilitateur->facilitateur_id = $request->get('facilitateur_id');
                $facilitateur->facilitateur_buckup = $request->get('facilitateur_buckup');
                $facilitateur->entreprise_id = $request->get('entreprise_id');
                $facilitateur->source_id = $request->get('source_id');
                $facilitateur->departement_id = $request->get('departement_id');
                $facilitateur->save();

            return back()->with(['message' => $message]);
    }
  
  public function create_entreprise()
    {
         $facilitateur = DB::table('facilitateurs')->get();
        return view('facilitateur.ajouter_entreprise', compact('facilitateur'));
    }
    
    public function store_entreprise(Request $request)
    {
        $message = "Ajouté avec succès";
                 $image = $request->file('logo');
                if($image){
                 $imageName = $image->getClientOriginalName();
                 $image->move(public_path().'/images/', $imageName);
                 } 
                $entreprise = new Entreprise;
                $entreprise->libelle = $request->get('libelle');
                $entreprise->facilitateur_id = $request->get('facilitateur_id');
                $entreprise->logo = (isset($imageName)) ? $imageName : $entreprise->logo;
                $entreprise->save();

                
                 $user = DB::table('facilitateurs')->where('id', '=', $entreprise->facilitateur_id)->first();
                 $client = $entreprise->libelle ;
                 \Mail::to($user->email)->send(new EntrepriseCreer($user, $client));

            return back()->with(['message' => $message]);
    }
  

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
        $facilitateur = Facilitateur::find($id);
        $pays = DB::table('pays')->orderby('libelle', 'ASC')->get();
        $entreprise = DB::table('entreprises')->get();
        return view('facilitateur.edit', compact('entreprise', 'facilitateur', 'pays'));
    }
    
    
    public function detail_facilitateur($id)
    {
        $facilitateur = Facilitateur::find($id);
        $pays = DB::table('pays')->orderby('libelle', 'ASC')->get();
       
        return view('facilitateur.detail_facilitateur', compact('facilitateur', 'pays'));
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
        $message = "Facilitateur modifié avec succè";
        $facilitateur = Facilitateur::find($id);
        $facilitateur->prenom = $request->get('prenom'); 
        $facilitateur->nom = $request->get('nom'); 
        $facilitateur->email = $request->get('email');
        $facilitateur->entreprise = $request->get('entreprise');
        $facilitateur->pays = $request->get('pays');
        // $facilitateur->logo = $imageName ;
        $facilitateur->update();
        
         return redirect('/facilitateurs')->with(['message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = "Facilitateur supprimé";
        $facilitateur = Facilitateur::find($id);
        $facilitateur->delete();
            DB::table('users')->where('id', $facilitateur->user_id)->delete();

        return back()->with(['message' => $message]);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_clientFacilitateur($id)
    {
        $message = "Client supprimé";
        $client = Client_facilitateur::find($id);
        $client->delete();

        return back()->with(['message' => $message]);
    }
    
     public function generatePDF($id)
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

             // $pdf = PDF::loadView('facilitateur.detail_client', compact('agents', 'feedback','entreprise','competence_1','competence_2','competence_3','competence_4','competence_5','competence_12','competence_6','competence_7','competence_8','competence_9','competence_10','competence_11'));
             // $pdf->setOptions(['enable-javascript', true]);
             // $pdf->setOptions(['javascript-delay', 1000]);
             // $pdf->setOptions(['no-stop-slow-scripts', true]);
             // $pdf->setOptions(['enable-smart-shrinking', true]);
            //$pdf = PDF::loadView('facilitateur.detail_client')->setOptions(['defaultFont' => 'sans-serif']);
           // return $pdf->stream();
                return view('facilitateur.detail_client',compact('agents', 'feedback','entreprise','competence_1','competence_2','competence_3','competence_4','competence_5','competence_12','competence_6','competence_7','competence_8','competence_9','competence_10','competence_11'));

    }
    
     public function ajout_agentFa()
    {
        $directions = DB::table('directions')->get();
        $pays = DB::table('pays')->orderby('libelle', 'ASC')->get();
        $entreprises = DB::table('entreprises')->get();
        return view('facilitateur.ajouter_agent', compact('directions', 'pays', 'entreprises'));
    }

    public function ajout_agent_storeFa(Request $request)
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
}
