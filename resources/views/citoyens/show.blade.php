<x-app-layout>
    <div class="col col-md-6 mx-auto mt-5">
        <div class="card text-start">
            
            <div class="card-body">
                <h4 class="card-title">Detail du citoyen</h4>
                <p class="card-text">
                    <div
                        class="table-responsive table-bordered"
                    >
                        <table
                            class="table table-primary"
                        >
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prenom</th>
                                    <th scope="col">Date de naissance</th>
                                    <th scope="col">Lieu de naissance</th>
                                    <th scope="col">Télephone</th>
                                    <th scope="col">Numero CNIB</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">
                                    <td scope="row">{{$citoyen->nom}}</td>
                                    <td>{{$citoyen->prenom}}</td>
                                    <td>{{date('d-m-Y',strtotime($citoyen->date_naissance))}}</td>
                                    <td>{{$citoyen->lieu_naissance}}</td>
                                    <td>{{$citoyen->telephone}}</td>
                                    <td>{{$citoyen->cnib}}</td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                    
                </p>
            </div>
            <a href="{{route('citoyens.index')}}"><button  type="button" class="btn btn-secondary sm m-3">Retour</button></a>
        </div>

    </div>
</x-app-layout>