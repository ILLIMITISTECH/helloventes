<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Strategique;
use App\Agent;
use App\Direction;
use DB;
use Auth;

class strategiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $strategiques = DB::table('strategiques')->get();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('strategique/v2.lister', compact('strategiques','headers'));
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
        $directions = Direction::all();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('strategique/v2.create', compact('agents','directions','headers'));

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

            $strategique = new Strategique;
            $strategique->libelle = $request->get('libelle');
            $strategique->pourcentage = $request->get('pourcentage');
            $strategique->res_dir = $request->get('res_dir');
            $strategique->deadline = $request->get('deadline');
            $strategique->direction_id = $request->get('direction_id');
            $strategique->save();
            
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
        $strategique = Strategique::find($id);
        $agents = Agent::all();
        $directions = Direction::all();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        
        return view('strategique/v2.edite', compact('strategique','agents','directions','headers'));

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

            $message = "strategique modifée avec succée";
            $strategique->libelle = $request->get('libelle');
            $strategique->pourcentage = $request->get('pourcentage');
            $strategique->res_dir = $request->get('res_dir');
            $strategique->deadline = $request->get('deadline');
            $strategique->direction_id = $request->get('direction_id');
            $strategique->update();

        return redirect('/strategiques')->with(['message' => $message]);
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
        $strategique = Strategique::find($id);
        $strategique->delete();

        return back();
    }
    
    
}
