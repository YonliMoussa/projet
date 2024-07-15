<?php

namespace App\Http\Controllers;

use App\Models\Citoyens;
use App\Models\DemandePieces;
use App\Models\Demandes;
use App\Models\Pieces;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\db;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

class DemandesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //si admin on affiche toutes les demandes
        if (Auth()->user()->isadmin) {
            $demandes= DB::table('demandes')
->join('services', 'services.id', '=', 'demandes.service_id')
->join('citoyens', 'citoyens.id', '=', 'demandes.citoyen_id')
->select('demandes.id', 'citoyens.nom','citoyens.prenom', 'services.intitule','demandes.created_at')
->get();
        } else {
            
            $citoyen=Citoyens::where('user_id',Auth()->user()->id)->first();
               
            $demandes= DB::table('demandes')
            ->join('services', 'services.id', '=', 'demandes.service_id')
            ->join('citoyens', 'citoyens.id', '=', 'demandes.citoyen_id')
            ->select('demandes.id', 'citoyens.nom','citoyens.prenom', 'services.intitule','demandes.created_at')
            //si pas admin on affiche seulement les demandes de l'utilisateur courant
            ->where('citoyens.user_id',Auth()->user()->id)
            ->get();
        }
        
        //toutes les demandes admin
       

//dd($demandes);

        return view('demandes.index',compact('demandes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('demandes.creat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dans la table demandespieces on store:piece_id,demande_id,chemin_fichier,nom_fichier
        //dans la table demnes on strore citoyen_id(utilisateur courant),service_d
        $nbpieces=DB::table('services')
        
        ->join('pieces', 'services.id', '=', 'pieces.service_id')
        
        ->where('services.id', Str::afterLast(url()->previous(), '/'))
        ->count();   
        
        
   
    
        $validated=$request->validate(
            [
                'description'=>'required|string|max:100',
                'files'=>'required|array|size:'.$nbpieces,
                'files.*'=>'file|mimes:pdf'
               
               
            ]);
         //  dd($validated);

        //on creer la demande avec id citoyen et id service
        $var['citoyen_id']=Citoyens::where('user_id',auth()->user()->id)->first()->id;
        $var['service_id']=Str::afterLast(url()->previous(), '/');
        $var['description']=$request->description;
        //on creer la demande et on garde la nouvelle demande pour ajouter son id dans la table damendespieces
      $newdemande=Demandes::create($var);
     
       
       // dd($pieces=$request->file('file'),$pid=$request->pid);
        $pieces=$request->file('files');
      
        $pid=$request->pid;
       $i=0;
       if(isset($pieces)){

     
        foreach ($pieces as $piece) {
           
            $pieceid=$pid[$i++];
            $nomfichier=$piece->getClientOriginalName();
            $extension=$piece->getClientOriginalExtension();
            $chemin=$piece->storeAs('fichierdemanses',date('YmdHis').$pieceid.'.'.$extension,'public');
            $nouvelledemandepiece['piece_id']=$pieceid;
            $nouvelledemandepiece['demande_id']=$newdemande->id;
            $nouvelledemandepiece['chemin_fichier']=$chemin;
            $nouvelledemandepiece['nom_fichier']=$nomfichier;

           // dd($nouvelledemandepiece);
           $n= DemandePieces::create($nouvelledemandepiece);
           
        }      
          return redirect()->route('demandes.index')->with('success','Demande crée avec succes');

    }
        else{


            return redirect()->route('demandes.index')->with('success','Demande non crée');
            }

           
     
    }

    /**
     * Display the specified resource.
     */
    public function show(Demandes $demande)
    {
      
        
        $service=Services::where('id',$demande->service_id)->first();
        $citoyen=Citoyens::where('id',$demande->citoyen_id)->first();
        $piecejointes= $demand= DB::table('demandes')
        ->join('demande_pieces', 'demande_pieces.demande_id', '=', 'demandes.id')
        ->join('pieces', 'pieces.id', '=', 'demande_pieces.piece_id')
        
        ->where('demandes.id',$demande->id)
        ->get();
      //dd($piecejointes);
        
        return view('demandes.show',compact('service','piecejointes','citoyen','demande'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Demandes $demande)
    {
        $pieces= $demand= DB::table('demande_pieces')
       
         ->join('pieces', 'pieces.id', '=', 'demande_pieces.piece_id')
    
        ->where('demande_pieces.demande_id',$demande->id)
         ->get();   
      
        return view('demandes.edit',compact('pieces','demande'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Demandes $demande)
    {
        $piecesnew=$request->file('files');
        $piecesold= DB::table('demande_pieces')
        
        ->join('pieces', 'pieces.id', '=', 'demande_pieces.piece_id')
        
        ->where('demande_pieces.demande_id',$demande->id)
        ->get();   
        //faire une comparaison enre le nombre de pieces de la demande et le nombre soumis à la modification
        if(isset($piecesnew)){

            if(count($piecesnew)!=count($piecesold)){
             return redirect()->route('demandes.edit',$demande->id)->with('success','Tous les champs sont obligatoires');
             
             }
             }else{
            return redirect()->route('demandes.edit',$demande->id)->with('success','Tous les champs sont obligatoires');

        }
        //on valide la saisie
        $validated=$request->validate(
            [
                'description'=>'required|string|max:100',
           'files'=>'bail|required',
           
            
            
            
            ]);
            db::table('demandes')->where('id',$demande->id)->update(['description'=>$request->description]);
            
            //on supprimes les anciennes pieces
    
    foreach ($piecesold as $p) {
       # code...
       Storage::disk('public')->delete($p ->chemin_fichier);
    }
    
    //on met à jour les informations dans la base de donnée et on ajoute les nouvelles pieces
    
    
    $pid=$request->pid;
   $i=0;
   
    foreach ($piecesnew as $piece) {
       
        $pieceid=$pid[$i++];
        $nomfichier=$piece->getClientOriginalName();
        $extension=$piece->getClientOriginalExtension();
        $chemin=$piece->storeAs('fichierdemanses',date('YmdHis').$pieceid.'.'.$extension,'public');
        $nouvelledemandepiece['chemin_fichier']=$chemin;
        $nouvelledemandepiece['nom_fichier']=$nomfichier;

       // on boucle sur la liste des pieces en les mettant à jour
      db::table('demande_pieces')->where('id',$pieceid)->update($nouvelledemandepiece);
      
       
    }

    return redirect()->route('demandes.index')->with('success','Demande modifiée avec succes');


         //fin

        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Demandes $demandes)
    {
        //Controller pour que l'administrateur seul   puisse supprimer
        if (Auth()->user()->isadmin) {
            //on suprime la demande et les pieces liées à la demande

            return redirect()->route('demandes.index')->with('success','Demande supprimée avec succes');
            
            } else {
            return redirect()->route('demandes.index')->with('success','Vous n\'avez pas le droit de faire cette opperation');
            # code...
        }
        
    }

    public function index1()
    {
        //demnades qui concerne uniquement lutilisateur courant
        $citoyen=Citoyens::where('user_id',Auth()->user()->id)->first();
               
        $mesdemandes= DB::table('demandes')
        ->join('services', 'services.id', '=', 'demandes.service_id')
        ->join('citoyens', 'citoyens.id', '=', 'demandes.citoyen_id')
        ->select('demandes.id', 'citoyens.nom','citoyens.prenom', 'services.intitule','demandes.created_at')
        ->where('citoyens.user_id',Auth()->user()->id)
        ->get();
        //dd($mesdemandes);
        
        return view('demandes.index1',compact('mesdemandes'));
    }

}
