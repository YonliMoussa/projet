<x-app-layout>

 <div class="col col-md-8 mt-3 mx-auto">
    @if (Auth()->user()->isadmin)
        
    <a href="{{route('services.create')}}" class="btn btn-primary mb-3"> Créer service</a>
    @endif
    {{-- alerte optionnelle --}}
    <div class="col-md-* ms-0 h3">
        @if ($message = Session::get('success'))
            <p class="alert alert-success">{{ $message }}</p>
        @endif
    </div>
@if ($services->count())
    

    <div class="table-responsive-sm">
        <h4>Liste des services</h4>
    <table class="table tale-primary" >
       
        <thead >
            <tr >
                <th scope="col">Code</th>
                <th scope="col">Intitulé</th>
                <th scope="col">Frais de dossier</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($services as $service)
            <tr class="">
                <td scope="row">{{$service->code}}</td>
                <td>{{$service->intitule}}</td>
                <td>{{$service->frais_dossier}}</td>
                <td>
                    <form action="{{route('services.destroy',$service->id)}}" method="POST">

                        <a href="{{route('services.show',$service->id)}}" class="btn btn-info mb-2">détails</a>
                       
                        @if (Auth()->user()->isadmin)
                            
                        <a href="{{route('services.edit',$service->id)}}" class="btn btn-warning btn-md mb-2">modifier</a>
                        @csrf
                        @method('delete')
                        <!-- Modal trigger button -->
                        <button
                        type="button"
                        class="btn btn-danger mb-2"
                        data-bs-toggle="modal"
                        data-bs-target="#modalId{{$service->id}}">
                        Supprimer
                        </button>
                        
                        <!-- Modal Body -->
                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                        <div   class="modal fade"  id="modalId{{$service->id}}"  tabindex="-1" data-bs-backdrop="static"
                     data-bs-keyboard="false"
                         role="dialog"  aria-labelledby="modalTitleId" aria-hidden="true" >
                        <div
                            class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                            role="document"
                            >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modalTitleId">
                                        Suppression du service
                                        </h4>
                                    <button
                                    type="button"
                                    class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"
                                    ></button>
                                </div>
                                <div class="modal-body">Voulez vous supprimer ce service?</div>
                                <div class="modal-footer">
                                    <button
                                    type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal">
                                        Annuler
                                        </button>
                                    <button type="submit" class="btn btn-danger mb-2">Supprimer</button>
                                </div>
                                </div>
                                </div>
                                </div>
                                
                                <!-- Optional: Place to the bottom of scripts -->
                                <script>
                        const myModal = new bootstrap.Modal(
                            document.getElementById("modalId$service->id"),
                            options,
                        );
                    </script>
                        @endif
                    
                <a href="{{route('demanderservice',$service->id)}}" class="btn btn-primary mb-2">Demander service</a>
                    </form>
                </td>
            </tr>
            @empty
                Pas de service
            @endforelse
        </tbody>
    </table>
    @else
    <p>Pas de service pour le moment</p>
@endif
  </div>
 </div>
  
</x-app-layout>