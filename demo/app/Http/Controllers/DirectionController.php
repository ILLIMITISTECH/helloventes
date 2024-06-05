<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Direction;

class DirectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $directions = Direction::all();
        return view('direction/v2.lister', compact('directions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('direction/v2.create');

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
            'nom_direction' => 'required|string|max:255',

    ]);
            $message = "Ajouté avec succès";

            $direction = new Direction;
            $direction->nom_direction = $request->get('nom_direction'); 
            $direction->save();
            
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
        $direction = Direction::find($id);
        return view('direction/v2.edite', compact('direction'));

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

        $message = "Direction modifée avec succée";
        $direction = Direction::find($id);
        $directionUpdate = $request->all();
        $direction->update($directionUpdate);

        return redirect('/directions')->with(['message' => $message]);
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
        $direction = Direction::find($id);
        $direction->delete();

        return back();
    }
    
    public function download(){
        return redirect('https://demo-collaboratis.optievent.com/pdf/template_rapport_reunion_collaboratis.pdf');
    }
}
