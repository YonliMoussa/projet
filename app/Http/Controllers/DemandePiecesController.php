<?php

namespace App\Http\Controllers;

use App\Models\DemandePieces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DemandePiecesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DemandePieces $demandePieces)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DemandePieces $demandePieces)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DemandePieces $demandePieces)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DemandePieces $demandePieces)
    {
        //
    }
    public function consulterpiece( $piece){
        // dd(DemandePieces::where('id',$piece)->first()->chemin_fichier);
       dd(Storage::disk('public')->exists(DemandePieces::where('id',$piece)->first()->chemin_fichier));
      return response()->file(Storage::url(DemandePieces::where('id',$piece)->first()->chemin_fichier));
        // return Storage::get(DemandePieces::where('id',$piece)->first()->chemin_fichier);
         
     }
}