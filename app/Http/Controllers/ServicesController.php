<?php
namespace App\Http\Controllers;

use App\Models\Citoyens;
use App\Models\Services;
use App\Models\Pieces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services=Services::all();
       
        return view('services.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.creat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validated= $request->validate(
        [
            'code'=>'required|unique:services,code',
            'intitule'=>'required',
            'frais_dossier'=>'required',
        ]
       );
      $ne= Services::create($validated);
       return redirect()->route('services.index')->with('success','Service ajouté avec succes');
      
    }

    /**
     * Display the specified resource.
     */
    public function show(Services $service)
    {
        //rechercher les pieces rattachees au sercice dont o  veut voir les details et les compacter
        $pieces_du_service=Pieces::where('service_id',$service->id)->get();
        //dd($pieces_du_service);
        return view('services.show',compact('service','pieces_du_service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Services $service)
    {
        
       
        return view("services.edit",compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Services $service)
    {
        $validated= $request->validate(
            [
                'code'=>'required',
                'intitule'=>'required',
                'frais_dossier'=>'required',
            ]
           );
           $service->update($validated);
           return redirect()->route('services.show',$service->id)->with('success','Service modifié avec succes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Services $service)
    {
       // dd(DB::table('pieces')->where('service_id',$service->id)->get());
        DB::table('pieces')->where('service_id',$service->id)->delete();
        $service->delete();
        //Supprimer aussi les pieces qui sont liées au service suprimé

        return redirect()->route('services.index')->with('success','Service supprimé avec succes');
    }

    // une fontion demnaderservice qui revoie le formulaire de demande avec les pieces qui sont rattachées au service
    public function demanderservice($service){
        if (isset(Citoyens::where('user_id',auth()->user()->id)->first()->id)) {
            $servic=Services::find($service);
        $pieces=Pieces::where('service_id',$servic->id)->get();
        return view('demandes.creat',compact('servic','pieces'));
            
        } else {
            return redirect()->route('services.index')->with('success','Veuillez mettre vos iformations à jour dans la section citoyen avant de pouvoir demander un service');

        }
        

    }
}
