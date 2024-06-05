<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Indicateur;
use App\Suivi_indicateur;
use DB;
use Auth;
use App\User;
use Session;

class IndicateurController extends Controller
{
    /**   
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $indicateurs = Indicateur::all();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('indicateur.lister', compact('indicateurs','headers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('indicateur.create', compact('headers'));

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

            $indicateur = new Indicateur;
            $indicateur->libelle = $request->get('libelle');
            $indicateur->cible = $request->get('cible'); 
            $indicateur->date_cible = $request->get('date_cible');

            if($indicateur->save()){  

            $suivi_indicateur = new Suivi_indicateur;
            $suivi_indicateur->date = $request->get('date');
            $suivi_indicateur->pourcentage = $request->get('pourcentage'); 
            $suivi_indicateur->note = $request->get('note');
            $suivi_indicateur->indicateur = $request->get('indicateur');
            $suivi_indicateur->indicateur_id = $request->get('indicateur_id');
            $suivi_indicateur->indicateur_id = $indicateur->id;
            $suivi_indicateur->save();

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
        $indicateur = Indicateur::find($id);
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('indicateur.edite', compact('indicateur','headers'));

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

        $message = "Indicateur modifé avec succé";
        $indicateur = Indicateur::find($id);
        $indicateurUpdate = $request->all();
        $indicateur->update($indicateurUpdate);

        return redirect('/indicateurs')->with(['message' => $message]);
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
        $indicateur = Indicateur::find($id);
        $indicateur->delete();

        return back();
    }
}
