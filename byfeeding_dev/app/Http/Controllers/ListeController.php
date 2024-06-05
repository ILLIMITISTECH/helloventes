<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Liste;
use DB;
use Auth;

class ListeController extends Controller
{
    public function todo()
    
    {
         $listes = DB::table('listes')->where('user_id', Auth::user()->id)->get();
         
         $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
        
        return view('activite/v2.todoliste', compact('listes','headers'));
    }
    
    public function todolist(Request $request)
    
    {
        $message = "Ajouter avec succee";
        $lister = new Liste;
        $lister->tache_liste = $request->get('tache_liste');
        $lister->user_id = $request->get('user_id');
        $lister->save();
        
        return redirect()->back()->with(['message' => $message]);

    }
    
    public function destroy( $id) 
    {
        $lister = liste::find($id);
        $lister->delete();

        return back();
    }
}
