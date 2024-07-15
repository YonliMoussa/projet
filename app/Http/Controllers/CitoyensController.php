<?php

namespace App\Http\Controllers;

use App\Models\Citoyens;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class CitoyensController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
      // Affiche les information de tous les citoyens pour l'admin
       $citoyens= Citoyens::all();
       //pour montrer uniquement les infos du citoyen connecte
       $citoyens= Citoyens::where('user_id',auth()->user()->id)->get();
       $nombre= Citoyens::where('user_id',auth()->user()->id)->count();
    //    dd(auth()->user()->id);
       //dd($nombre);
        return view('citoyens.index',compact('citoyens','nombre'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user=auth()->user();
       $nom=Str::before($user->name, ' ');
       $prenom=Str::after($user->name, ' ');
        return view('citoyens.creat',compact('user','nom','prenom'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated=$request->validate(
           [
                'nom'=>'required',
                'prenom'=>'required',
                'date_naissance'=>'required',
                'lieu_naissance'=>'required',
                'telephone'=>'required',
                'cnib'=>'required',
            ]

        );
        $nombre= Citoyens::where('user_id',auth()->user()->id)->count();
        if ( $nombre>=1) {
            return redirect()->route('citoyens.index')->with('success','Citoyen existe dejà,vous ne pouvez pas ajouter un autre');
              } 
        else {
                  
            $validated['user_id']=auth()->user()->id;
            
            Citoyens::create($validated);
            //mettre à jour le name de user sil a eu changement
            $newname=$validated['nom'].' '.$validated['prenom'];
          DB::table('users')->where('id',auth()->user()->id)->update(['name'=>$newname]);
            return redirect()->route('citoyens.index')->with('success','Citoyen ajouté avec succes');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Citoyens $citoyen)
    {
        return view('citoyens.show',compact('citoyen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Citoyens $citoyen)
    {
        return view('citoyens.edit',compact('citoyen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Citoyens $citoyen)
    {
        $validated=$request->validate(
            [
                'nom'=>'required',
                'prenom'=>'required',
                'date_naissance'=>'required',
                'lieu_naissance'=>'required',
                'telephone'=>'required',
                'cnib'=>'required',
            ]

        );
        $newname=$validated['nom'].' '.$validated['prenom'];
        DB::table('users')->where('id',auth()->user()->id)->update(['name'=>$newname]);
        $citoyen->update($validated);

        return redirect()->route('citoyens.index')->with('success','Citoyen modifié avec succes');

        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Citoyens $citoyen)
    {
        //pour l'admin de pouvoir supprimer un citoyen
        $citoyen->delete();
        return redirect()->route('citoyens.index')->with('success','Citoyen supprimé avec succes');

    }
    public function index2()
    {
        //fonction du non admin qui affiche les infos du citoyen connecté
        $citoyen= Citoyens::where('user_id',auth()->user()->id)->first();

    }
}
