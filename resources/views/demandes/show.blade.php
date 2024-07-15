<x-app-layout>
   <div class="col col-md-6 mt-3 mx-auto">
    <div
        class="card"
    >
        
        <div class="card-body">
            <h4 class="card-title">Details de la demande</h4>
            <p class="card-text">
                <div
                    class="table-responsive"
                >
                    <table
                        class="table table-primary table-bordered"
                    >
                        {{-- <thead>
                            <tr>
                                <th scope="col">Column 1</th>
                                <th scope="col">Column 2</th>
                                <th scope="col">Column 3</th>
                            </tr>
                        </thead> --}}
                        <tbody>
                            <tr class="">
                                <th scope="row">Demandeur</th>
                                <td>{{$citoyen->nom.' '.$citoyen->prenom}}</td>
                               
                            </tr>
                            <tr class="">
                                <th scope="row">Telephone</th>
                                <td>{{$citoyen->telephone}}</td>
                               
                            </tr>
                            <tr class="">
                                <th scope="row">Numero CNIB</th>
                                <td>{{$citoyen->cnib}}</td>
                               
                            </tr>
                            <tr class="">
                                <th scope="row">Date de naissance</th>
                                <td>{{date('d-m-Y',strtotime($citoyen->date_naissance))}}</td>
                               
                            </tr>
                            <tr class="">
                                <th scope="row">Lieu de naissance</th>
                                <td>{{$citoyen->lieu_naissance}}</td>
                               
                            </tr>
                            <tr class="">
                                <th scope="row">Service demandé</th>
                                <td>{{$service->intitule}}</td>  
                            </tr>
                            <tr class="">
                                <th scope="row">Frais dossier</th>
                                <td>{{$service->frais_dossier.' '.'CFA'}}</td>  
                            </tr>
                            <tr class="">
                                <th scope="row">Date demande</th>
                                <td>{{date('d-m-Y',strtotime($demande->created_at))}}</td>  
                            </tr>
                        </tbody>
                    </table>
                    <span>Pieces jointes</span>
                    @foreach ($piecejointes as $p)
                        <div class="col">
                    
                        <a href="{{route('consulterpiece',$p->id)}}">{{$p->intitule}}</a>
                        </div>
                    @endforeach
                </div>
                <a href="{{route('demandes.index')}}" class="btn btn-info mt-2">Retour</a>
            </p>
        </div>
    </div>
   </div>
</x-app-layout>