<x-app-layout>

    
    <div class="col col-md-8 mt-3 mx-auto">
       <span class="h2"> Details du pieces</span>
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
                @if (@isset($piece))
                    
                @endif
                <tr class="">
                    <td scope="row">{{$piece->id}}</td>
                    <td>{{$piece->intitule}}</td>
                    <td>{{$piece->service}}</td>
                   
                </tr>
               
            </tbody>
          
        </table>
        <a href="{{route('pieces.index')}}" class="btn btn-info">retour</a>
      </div>
     </div>
      
</x-app-layout>