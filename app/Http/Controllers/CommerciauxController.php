<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Commerciau;
use App\User;
use App\Origine;
use App\statutOpportunite;
use Auth;
use App\Mail\BienvenueCommercieaux;
use DB;
use Mail;

use Session;
use Mailjet\LaravelMailjet\Facades\Mailjet;

class CommerciauxController extends Controller
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
    public function index()
    {
        $commerciaux = DB::table('commerciaus')->get();
        return view('suiviSortieTerrain/admin.lister_commerciaux', compact('commerciaux'));
    }
    
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $commercial_superieur = DB::table('commerciaus')->where('nom_role', 'responsable')->orderBy('prenom')->get();
        $commercial_superieurdirecteur = DB::table('commerciaus')->orderBy('prenom')->get();
      
        $pays = DB::table('pays')->orderBy('libelle')->get();
        $role = DB::table('roles')->orderBy('libelle')->get();
        $domaines = DB::table('domaines')->orderBy('libelle')->get();
        $type = DB::table('parametres')->get();
        $entreprises = DB::table('entreprise_clients')->get();
        return view('suiviSortieTerrain/admin.ajouter_commerciaux',compact('domaines','pays', 'commercial_superieurdirecteur', 'role', 'type', 'commercial_superieur','entreprises'));

    }
    
    public function store(Request $request)
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
                $user->superieur_id = $request->get('superieur_id');
                //$user->photo = $imageName;
                $user->nom_role = $request->get('nom_role');
                $user->entreprise_client_id = $request->get('entreprise_client_id');
                $user->password = Hash::make(123456);
                //$user->notify(new BienvenueACollaboratis());

                if($user->save()){
                    error_log('la création a réussi');

                $commerciaux = new Commerciau;
                $commerciaux->prenom = $request->get('prenom'); 
                $commerciaux->nom = $request->get('nom'); 
                //$commerciaux->photo =  $imageName; 
                $commerciaux->email = $request->get('email'); 
                $commerciaux->commission_p = $request->get('commission_p'); 
                $commerciaux->objectif_mois = $request->get('objectif_mois'); 
                $commerciaux->pays_id = $request->get('pays_id');
                $commerciaux->superieur_id = $request->get('superieur_id');
                $commerciaux->entreprise_client_id = $user->entreprise_client_id;
                $commerciaux->nbre_contact = $request->get('nbre_contact');
                $commerciaux->nbre_demo = $request->get('nbre_demo');
                $commerciaux->domaine_id = $request->get('domaine_id');
                $commerciaux->nbre_appel_quotidien = $request->get('nbre_appel_quotidien');
                $commerciaux->nom_role = $request->get('nom_role');
                $commerciaux->user_id = $user->id;
                $commerciaux->save();
                
                $user = DB::table('users')->where('id', '=', $commerciaux->user_id)->first();
                 \Mail::to($user->email)->send(new BienvenueCommercieaux($user));

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
        $commerciaux = Commerciau::find($id);
        $pays = DB::table('pays')->orderBy('libelle')->get();
        $role = DB::table('roles')->orderBy('libelle')->get();
        return view('suiviSortieTerrain/admin.edit_commerciaux', compact('role','pays', 'commerciaux'));

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
                $message = "Commercial modifié avec succè";

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

                $commerciaux = Commerciau::find($id);
                $commerciaux->prenom = $request->get('prenom'); 
                $commerciaux->nom = $request->get('nom'); 
                //$commerciaux->photo =  $imageName; 
                $commerciaux->email = $request->get('email'); 
                $commerciaux->pays_id = $request->get('pays_id');
                $commerciaux->nom_role = $request->get('nom_role'); 
                $commerciaux->update();
                
                DB::table('users')->where('id', $commerciaux->user_id)->update(['prenom' => $commerciaux->prenom]);
                DB::table('users')->where('id', $commerciaux->user_id)->update(['nom' => $commerciaux->nom]);
                DB::table('users')->where('id', $commerciaux->user_id)->update(['email' => $commerciaux->email]);
                DB::table('users')->where('id', $commerciaux->user_id)->update(['nom_role' => $commerciaux->nom_role]);

                   /*  //$commerciauxs->save();
                    if($commerciaux->update())
                    {
                        Auth::login($user);
                        return back()->with(['message' => $message]);

                    }
                    else
                    {
                        flash('user not saved')->error();

                    }

                }     */

        return redirect('/commerciaux')->with(['message' => $message]);
    }
    
     public function sup_com_demande_dg($id)
    {
        $commerciaux = Commerciau::find($id);
        $commercial = DB::table('commerciaus')->orderBy('prenom')->get();
        
        return view('suiviSortieTerrain.sup_com_demande_dg',compact('commerciaux','commercial'));

    }
    
    public function sup_com_demande_store_dg(Request $request, $id)
    {
            $message = "Commercial supprimé avec succès";

            $commerciaux = Commerciau::findOrFail($id);
            $commerciaux->sup = $request->get('sup'); 
            $commerciaux->save();
            
            $check = DB::table('commerciaus')->where('id', $commerciaux->id)->where('nom_role', 'responsable')->first();
            $com_superieur = DB::table('commerciaus')->where('id', $commerciaux->sup)->first();

            if($check)
            {
                DB::table('commerciaus')->where('superieur_id', $check->id)->update(['superieur_id' => $commerciaux->sup]);
                DB::table('commerciaus')->where('id', $commerciaux->sup)->update(['nom_role' => 'responsable']);
                DB::table('users')->where('id', $com_superieur->user_id)->update(['superieur_id' => $commerciaux->sup]);
                DB::table('users')->where('id', $com_superieur->user_id)->update(['nom_role' => 'responsable']);
            }
            
            
            DB::table('prospects')->where('commercial_id', $commerciaux->id)->update(['commercial_id' => $commerciaux->sup, 'superieur_id' => $com_superieur->superieur_id]);
            DB::table('opportunites')->where('commercial_id', $commerciaux->id)->update(['commercial_id' => $commerciaux->sup, 'superieur_id' => $com_superieur->superieur_id]);
            DB::table('contacts')->where('commercial_id', $commerciaux->id)->update(['commercial_id' => $commerciaux->sup, 'superieur_id' => $com_superieur->superieur_id]);
            DB::table('action_commerciales')->where('commercial_id', $commerciaux->id)->update(['commercial_id' => $commerciaux->sup, 'superieur_id' => $com_superieur->superieur_id]);
            DB::table('prospections')->where('commercial_id', $commerciaux->id)->update(['commercial_id' => $commerciaux->sup, 'superieur_id' => $com_superieur->superieur_id]);
            DB::table('update_opps')->where('commercial_id', $commerciaux->id)->update(['commercial_id' => $commerciaux->sup, 'superieur_id' => $com_superieur->superieur_id]);
            DB::table('demos')->where('commercial_id', $commerciaux->id)->update(['commercial_id' => $commerciaux->sup, 'superieur_id' => $com_superieur->superieur_id]);
            
            
            DB::table('commerciaus')->where('id', $commerciaux->id)->delete();
            DB::table('users')->where('id', $commerciaux->user_id)->delete();
            
            
        $commerciauxg = DB::table('commerciaus')->get();
        foreach($commerciauxg as $commerciau)
        {
            DB::table('prospects')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('opportunites')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('action_commerciales')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('prospections')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('contacts')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('demos')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('update_opps')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('stock_mensuelles')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
             DB::table('stock_journalieres')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            
            DB::table('prospects')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
            DB::table('opportunites')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
            DB::table('action_commerciales')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
            DB::table('prospections')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
            DB::table('contacts')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
            DB::table('demos')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
            DB::table('update_opps')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
            DB::table('stock_mensuelles')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
             DB::table('stock_journalieres')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
            DB::table('performances')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
        }
            return redirect('/commerciaux_maTeam')->with(['message' => $message]);
    }
    
    

     public function sup_com_demande($id)
    {
        $commerciaux = Commerciau::find($id);
        $commercial = DB::table('commerciaus')->orderBy('prenom')->get();
        
        return view('suiviSortieTerrain.sup_com_demande',compact('commerciaux','commercial'));

    }
    
    public function sup_com_demande_store(Request $request, $id)
    {
            $message = "Commercial supprimé avec succès";

            $commerciaux = Commerciau::findOrFail($id);
            $commerciaux->sup = $request->get('sup'); 
            $commerciaux->save();
            
            $com_superieur = DB::table('commerciaus')->where('id', $commerciaux->sup)->first();
            
             $check = DB::table('commerciaus')->where('id', $commerciaux->id)->where('nom_role', 'responsable')->first();
            
            if($check)
            {
                DB::table('commerciaus')->where('superieur_id', $check->id)->update(['superieur_id' => $commerciaux->sup]);
                DB::table('commerciaus')->where('id', $commerciaux->sup)->update(['nom_role' => 'responsable']);
                DB::table('users')->where('id', $com_superieur->user_id)->update(['superieur_id' => $commerciaux->sup]);
                DB::table('users')->where('id', $com_superieur->user_id)->update(['nom_role' => 'responsable']);
            }
            
            DB::table('prospects')->where('commercial_id', $commerciaux->id)->update(['commercial_id' => $commerciaux->sup, 'superieur_id' => $com_superieur->superieur_id]);
            DB::table('opportunites')->where('commercial_id', $commerciaux->id)->update(['commercial_id' => $commerciaux->sup, 'superieur_id' => $com_superieur->superieur_id]);
            DB::table('contacts')->where('commercial_id', $commerciaux->id)->update(['commercial_id' => $commerciaux->sup, 'superieur_id' => $com_superieur->superieur_id]);
            DB::table('action_commerciales')->where('commercial_id', $commerciaux->id)->update(['commercial_id' => $commerciaux->sup, 'superieur_id' => $com_superieur->superieur_id]);
            DB::table('prospections')->where('commercial_id', $commerciaux->id)->update(['commercial_id' => $commerciaux->sup, 'superieur_id' => $com_superieur->superieur_id]);
            DB::table('update_opps')->where('commercial_id', $commerciaux->id)->update(['commercial_id' => $commerciaux->sup, 'superieur_id' => $com_superieur->superieur_id]);
            DB::table('demos')->where('commercial_id', $commerciaux->id)->update(['commercial_id' => $commerciaux->sup, 'superieur_id' => $com_superieur->superieur_id]);
            
            DB::table('commerciaus')->where('id', $commerciaux->id)->delete();
            DB::table('users')->where('id', $commerciaux->user_id)->delete();
            
            
            $commerciauxg = DB::table('commerciaus')->get();
        foreach($commerciauxg as $commerciau)
        {
            DB::table('prospects')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('opportunites')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('action_commerciales')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('prospections')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('contacts')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('demos')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('update_opps')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('stock_mensuelles')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
             DB::table('stock_journalieres')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            
            DB::table('prospects')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
            DB::table('opportunites')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
            DB::table('action_commerciales')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
            DB::table('prospections')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
            DB::table('contacts')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
            DB::table('demos')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
            DB::table('update_opps')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
            DB::table('stock_mensuelles')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
             DB::table('stock_journalieres')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
            DB::table('performances')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['entreprise_client_id' => $commerciau->entreprise_client_id]);
            
        }
            return redirect('/commerciaux_maTeam_res')->with(['message' => $message]);
    }
    
    
    
    public function destroy($id)
    {
        //
        $message = "Agent supprimé avec succès";
        $commerciaux = Commerciau::find($id);
        $commerciaux->delete();
        
        DB::table('users')->where('id', $commerciaux->user_id)->delete();

        return back();
    }
    
    
    public function createOrigine()
    {
        //
        return view('suiviSortieTerrain/admin.ajouterOrigine');

    }
    
    public function storeOrigine(Request $request)
    {
        //
        $this->validate($request, [
            'libelle'        => 'required|max:255',
        ]);
        
        Origine::create([
            'libelle'  => $request->libelle,
        ]);
        
        $message = 'Origine ajoutée avec succès';
        
        return redirect()->back()->with(['message' => $message]);
        
    }
    
    public function createStatut()
    {
        //
        return view('suiviSortieTerrain/admin.ajouterStatut');

    }
    
    public function storeStatut(Request $request)
    {
        //
        // dd($request->all());
        $this->validate($request, [
            'libelle'        => 'required|max:255',
        ]);
        
        statutOpportunite::create([
            'libelle'  => $request->libelle,
        ]);
        
        $message = 'Statut ajouté avec succès';
        
        return back()->with(['message' => $message]);
        
    }
    
    
     
    
    
}
