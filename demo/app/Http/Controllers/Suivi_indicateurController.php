<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Suivi_indicateur;
use App\Indicateur;
use DB;
use Auth;
use App\User;
use Session;


class Suivi_indicateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$suivi_indicateurs = Suivi_indicateur::all();

        $suivi_indicateurs = DB::table('suivi_indicateurs')->select('suivi_indicateurs.id', 'suivi_indicateurs.date', 'suivi_indicateurs.pourcentage', 'suivi_indicateurs.note',
         'suivi_indicateurs.indicateur_id',
          'indicateurs.id', 'indicateurs.libelle', 'indicateurs.cible', 'indicateurs.date_cible')
          ->join('indicateurs', 'indicateurs.id', 'suivi_indicateurs.indicateur_id')
          ->get();
          $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('suivi_indicateur.lister', compact('suivi_indicateurs','headers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $indicateurs = Indicateur::all();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('suivi_indicateur.create', compact('indicateurs','headers'));

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
            'date' => 'required|string|max:255',

    ]);
            $message = "Ajouté avec succès";

            $suivi_indicateur = new Suivi_indicateur;
            $suivi_indicateur->date = $request->get('date');
            $suivi_indicateur->pourcentage = $request->get('pourcentage'); 
            $suivi_indicateur->note = $request->get('note');
            $suivi_indicateur->indicateur = $request->get('indicateur');
            $suivi_indicateur->indicateur_id = $request->get('indicateur_id');
            $suivi_indicateur->save();

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
        $suivi_indicateur = Suivi_indicateur::find($id);
        $indicateurs = Indicateur::all();
        $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        return view('suivi_indicateur.edite', compact('indicateurs', 'suivi_indicateur','headers'));

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
        /* $suivi_indicateur = Suivi_indicateur::find($id);
        $suivi_indicateurUpdate = $request->all();
        $suivi_indicateur->update($suivi_indicateurUpdate); */
        $suivi_indicateur = Suivi_indicateur::find($id);
        $suivi_indicateur->date = $request->get('date');
        $suivi_indicateur->pourcentage = $request->get('pourcentage'); 
        $suivi_indicateur->note = $request->get('note');
        $suivi_indicateur->indicateur = $request->get('indicateur');
        $suivi_indicateur->indicateur_id = $request->get('indicateur_id');
        $suivi_indicateur->update();

        return redirect('/suivi_indicateurs')->with(['message' => $message]);
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
        $suivi_indicateur = Suivi_indicateur::find($id);
        $suivi_indicateur->delete();

        return back();
    }
}
