<x-app-layout>

    
    <div class="col col-md-8 mt-3 mx-auto">
       <span class="h2"> Details du services</span>
        <div class="table-responsive-sm">
            <div class="col-md-8 ms-0 h3">
                @if ($message = Session::get('success'))
                    <p class="alert alert-success">{{ $message }}</p>
                @endif
            </div>
        <table class="table table-primary" >
           
            <thead>
                <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Intitulé</th>
                    <th scope="col">Frais de dossier</th>
                   
                </tr>
            </thead>
            <tbody>
                @if (@isset($service))
                    
                @endif
                <tr class="">
                    <td scope="row">{{$service->code}}</td>
                    <td>{{$service->intitule}}</td>
                    <td>{{$service->frais_dossier}}</td>
                </tr>
             
            </tbody>
           
        </table>
        
    </div>
    <div class="col col-md4">
        <p class="h4">Pièces à fournir:</p>
    @forelse ($pieces_du_service as $piece)
   <ol>
    <li class="list-group-item "><span class="h5">-</span> {{$piece->intitule}}</li>
 </ol>
@empty
<span>Pas de piece à fournir</span>
@endforelse

    </div>
    <a href="{{route('services.index')}}" class="btn btn-info">retour</a>
    @if (Auth()->user()->isadmin)
        
    <a href="{{route('ajoutepiece',$service->id)}}" class="btn btn-primary"> Ajouter piece</a>
    @endif
</div>
      
</x-app-layout>