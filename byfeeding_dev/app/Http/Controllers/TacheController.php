<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tache;
use App\Activite;
use App\Agent;
use DB;
use Auth;

class TacheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $taches = DB::table('taches')->get();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('tache/v2.lister', compact('taches','headers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $agents = Agent::all();
        $activites = Activite::all();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('tache/v2.create', compact('agents','activites','headers'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'libelle' => 'required|string|max:255',

    ]);
            $message = "Ajouté avec succès";

            $tache = new Tache;
            $tache->libelle = $request->get('libelle');
            $tache->res_dir = $request->get('res_dir');
            $tache->nbr_jour = $request->get('nbr_jour');
            $tache->deadline = $request->get('deadline');
            $tache->activite_id = $request->get('activite_id');
            $tache->save();
            
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
        $tache = Tache::find($id);
        $agents = Agent::all();
        $activites = Activite::all();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('tache/v2.edite', compact('tache','agents','activites','headers'));

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

            $message = "tache modifée avec succée";
            $tache = Tache::find($id);
            $tache->libelle = $request->get('libelle');
            $tache->res_dir = $request->get('res_dir');
            $tache->nbr_jour = $request->get('nbr_jour');
            $tache->deadline = $request->get('deadline');
            $tache->activite_id = $request->get('activite_id');
            $tache->update();
            
        return redirect('/taches')->with(['message' => $message]);
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
        $tache = Tache::find($id);
        $tache->delete();

        return back();
    }
    
    
}
