<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\BienvenueACollaboratis;
use App\Agent;
use App\Service;
use App\Direction;
use App\User;
use App\Role;
use Auth;
use DB;
use Mail;
use App\Mail\SendMail;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Exports\UsersExport;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AgentController extends Controller
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
    * @return \Illuminate\Support\Collection
    */
    public function fileImportExport()
    {
       return view('file_import');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileImport(Request $request) 
    {
        
    $message = 'Fichier importé avec succés';
    
    $filepathsource = 'old_format_xls_file';
    $filepathdes = 'new_format_xlsx_file';
    //$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::import(new UsersImport, $request->file('file')->$filepathsource);
    //$writer = new Xlsx($spreadsheet);
    //$writer->save($filepathdes);

    $new_file_name = md5(uniqid()) . '.' . $request->file('file')->getClientOriginalExtension();
    $path = $request->file('file')->move(storage_path() . '/images/', $new_file_name);
    Excel::import(new UsersImport, $path);
    
    //Excel::import(new UsersImport, $request->file('file')->getClientOriginalExtension('tmp'));
    return back()->with(['message' => $message]);
    
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileExport() 
    {
        return Excel::download(new UsersExport, 'users-collection.xlsx');
    }    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$agents = Agent::all();
        /*$agents = DB::table('agents')
        ->select('agents.prenom', 'agents.nom', 'agents.photo', 'agents.service_id', 'agents.date_naiss', 'agents.id',
        'services.nom_service','services.direction')
        ->join('services', 'services.id', 'agents.service_id')
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->get();*/
        $directions = Direction::all();
         $agents = DB::table('agents')
          ->join('directions', 'directions.id', 'agents.direction_id')
          ->select(
                  'agents.prenom', 'agents.nom', 'agents.photo', 'agents.direction_id', 'agents.date_naiss', 'agents.id',
                  'directions.nom_direction','directions.id as ID')
                  ->get();
        return view('agent/v2.lister', compact('agents','directions'));
    }
    
     public function filter_ag(Request $request){
        $search_ag = $request->get('search_ag');
        $directions = Direction::all();
        
           $agents = DB::table('agents')
          //->join('agents', 'agents.direction_id', 'directions.id')
          ->join('directions', 'directions.id', 'agents.direction_id')
          ->select(
                  'agents.prenom', 'agents.nom', 'agents.photo', 'agents.direction_id', 'agents.date_naiss', 'agents.id',
                  'directions.nom_direction','directions.id as ID')
                  ->where('directions.nom_direction', 'like', '%'.$search_ag.'%')
                  ->get();

       return view('agent/v2.lister', compact('agents','directions'));
      }    
     


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $services = Service::all();
        $directions = Direction::all();
        $roles = Role::all();
        $agents = Agent::all();
        return view('agent/v2.create',compact('services', 'roles', 'agents','directions'));

    }
    
    
    function sendEmailAgent()
    
    {
        $users = User::where('email', 'margareth.o@illimitis.com')->get();
        //dd($users);
        foreach($users as $user)
        {
         //Auth::login($user);
        
          $user->notify(new BienvenueACollaboratis());

            
        }
       //dd($users); 
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        request()->validate([
            //'photo.*' => 'mimes:doc,pdf,docx,zip,png,jpeg,odt,jpg,svc,csv,mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            

    ]);

            /*$image = $request->file('photo');
            if($image){
            $imageName = $image->getClientOriginalName();
            $image->move(public_path().'/images/', $imageName);
                } */
             
             /*$image = $request->file('photo');
                if($image){
                $imageNameP = $image->getClientOriginalName();
                $image->move(public_path().'/image/', $imageNameP);
                    }  */
                $message = "Ajouté avec succès";

                $user = new User;
                $user->prenom = $request->get('prenom');
                $user->nom = $request->get('nom');
                $user->email = $request->get('email');
                //$user->photo = $imageName;
                $user->nom_role = $request->get('nom_role');
                $user->role_id = $request->get('role_id');
                $user->password = Hash::make($request->get('password'));
                //$user->notify(new BienvenueACollaboratis());

                if($user->save()){
                    error_log('la création a réussi');

                $agent = new Agent;
                $agent->prenom = $request->get('prenom'); 
                $agent->nom = $request->get('nom'); 
                //$agent->photo =  $imageName; 
                $agent->email = $request->get('email'); 
                $agent->tel = $request->get('tel'); 
                $agent->whatshap = $request->get('whatshap'); 
                $agent->fonction = $request->get('fonction'); 
                $agent->date_naiss = $request->get('date_naiss'); 
                $agent->niveau_hieracie = $request->get('niveau_hieracie'); 
                $agent->superieur_id = $request->get('superieur_id'); 
                $agent->service_id = $request->get('service_id');
                $agent->direction_id = $request->get('direction_id');
                $agent->user_id = $request->get('user_id');  
                $agent->user_id = $user->id;
                    //$agents->save();
                    if($agent->save())
                    {
                        Auth::login($user);
                        $user->notify(new BienvenueACollaboratis());
                        return back()->with(['message' => $message]);

                    }
                    else
                    {
                        flash('user not saved')->error();

                    }

                }    
                return back()->with(['message' => $message]);
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
        $agent = Agent::find($id);
        $services = Service::all();
        $directions = Direction::all();
        $roles = Role::all();
        $agents = Agent::all();
        return view('agent/v2.edite', compact('roles','services', 'agent', 'agents','directions'));

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
                $message = "Agent modifié avec succè";

                /* $user = User::find($id);
                $user->prenom = $request->get('prenom');
                $user->nom = $request->get('nom');
                $user->email = $request->get('email');
                $user->photo = $imageNameP;
                $user->nom_role = $request->get('nom_role');
                $user->role_id = $request->get('role_id');
                $user->password = Hash::make($request->get('password'));
                $user->notify(new RegisterNotify());

                if($user->update()){
                    error_log('la création a réussi'); */

                $agent = Agent::find($id);
                $agent->prenom = $request->get('prenom'); 
                $agent->nom = $request->get('nom'); 
                //$agent->photo =  $imageName; 
                $agent->email = $request->get('email'); 
                $agent->tel = $request->get('tel'); 
                $agent->whatshap = $request->get('whatshap'); 
                $agent->fonction = $request->get('fonction'); 
                $agent->date_naiss = $request->get('date_naiss'); 
                $agent->niveau_hieracie = $request->get('niveau_hieracie'); 
                $agent->superieur_id = $request->get('superieur_id'); 
                $agent->service_id = $request->get('service_id');
                $agent->direction_id = $request->get('direction_id');
                $agent->user_id = $request->get('user_id');  
                $agent->update();
                   /*  //$agents->save();
                    if($agent->update())
                    {
                        Auth::login($user);
                        return back()->with(['message' => $message]);

                    }
                    else
                    {
                        flash('user not saved')->error();

                    }

                }     */

        return redirect('/agents')->with(['message' => $message]);
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
        $agent = Agent::find($id);
        $agent->delete();

        return back();
    }
    
    public function sendmailrappel(Request $request)
    {
        $rap = "Info envoyée avec succès";
        $name = $request->name;
        $email = $request->email;
        $subject = $request->subject;
        $message = $request->message;

        $emails = $request->emails;

        Mail::to(array($email, $emails))->send(new SendMail($subject, $message));
        Session::flash("success");
        return back()->with(['rap' => $rap]);
    }
}
