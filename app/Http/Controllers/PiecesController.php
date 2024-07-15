<?php

namespace App\Http\Controllers;

use App\Models\Pieces;
use App\Models\Services;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
 

class PiecesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pieces = DB::table('pieces')
            ->join('services', 'pieces.service_id', '=', 'services.id')
            ->select('pieces.*', 'services.intitule as service')
            ->latest()
            ->get();
         //   dd($pieces);
        //$pieces=Pieces::all();
        return view('pieces.index',compact('pieces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        return view('pieces.creat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $validated= $request->validate(
            [
                
                'intitule'=>'required',
                'service_id'=>'required',
               
                ]
            );
           // dd($validated);
            Pieces::create($validated);
            return redirect()->route('services.index')->with('success','Piece ajoutée');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pieces $piece)
    {
        $piece=  $pieces = DB::table('pieces')
        ->join('services', 'pieces.service_id', '=', 'services.id')
        ->where('pieces.id',$piece->id)
        ->select('pieces.*', 'services.intitule as service')
        ->first();
        return view('pieces.show',compact('piece'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pieces $piece)
    {
    return view('pieces.edit',compact('piece'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pieces $piece)
    {
        $validated= $request->validate(
            [
                
                'intitule'=>'required',
               
               
                ]
            );
            $piece->update($validated);
            return redirect()->route('pieces.index')->with('success','Pièce modifiée');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pieces $piece)
    {
       // dd($piece);
        $piece->delete();
        return redirect()->route('pieces.index')->with('success','Pièce supprimée');
    }
    public function ajout($id)
    {

        $service=$user = DB::table('services')->where('id',$id)->first();
       // dd($service);
        return view('pieces.creat',compact('id'));
 
        
      
    }
}
