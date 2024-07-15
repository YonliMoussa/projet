<x-app-layout>

 <div class="col col-md-8 mt-3 mx-auto">
    {{-- <a href="{{route('pieces.create')}}" class="btn btn-primary mb-3"> Créer piece</a>
    <a href="{{route('ajoutepiece',2)}}" class="btn btn-primary mb-3"> Créer piece</a> --}}
    {{-- alerte optionnelle --}}
    <div class="col-md-8 ms-0 ">
        @if ($message = Session::get('success'))
            <p class="alert alert-success">{{ $message }}</p>
        @endif
    </div>

    <div class="table-responsive-sm">
        <h4>Liste des pieces</h4>
        @if (isset($pieces) and count($pieces))
            
        
    <table class="table table-primary" >
       
        <thead>
            <tr class="text-center">
                <th scope="col">Code</th>
                <th scope="col">Intitulé</th>
                <th scope="col">Service</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pieces as $piece)
            <tr class="">
                <td scope="row">{{$piece->id}}</td>
                <td>{{$piece->intitule}}</td>
                <td>{{$piece->service}}</td>
                <td>
                    <form action="{{route('pieces.destroy',$piece->id)}}" method="POST">

                        <a href="{{route('pieces.show',$piece->id)}}" class="btn btn-info mb-2">détails</a>
                        <a href="{{route('pieces.edit',$piece->id)}}" class="btn btn-warning btn-md mb-2">modifier</a>
                        @csrf
                        @method('delete')
                    <!-- Modal trigger button -->
                    <button
                        type="button"
                        class="btn btn-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#modalId{{$piece->id}}">
                        Supprimer
                    </button>
                    
                    <!-- Modal Body -->
                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                    <div   class="modal fade"  id="modalId{{$piece->id}}"  tabindex="-1" data-bs-backdrop="static"
                     data-bs-keyboard="false"
                         role="dialog"  aria-labelledby="modalTitleId" aria-hidden="true" >
                        <div
                            class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                            role="document"
                        >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modalTitleId">
                                        Suppression de la pièce 
                                    </h4>
                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"
                                    ></button>
                                </div>
                                <div class="modal-body">Voulez vous supprimer cette piece?</div>
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
                            document.getElementById("modalId$piece->id"),
                            options,
                        );
                    </script>
                    
                </form>
                </td>
            </tr>
            @empty
                Pas de piece
            @endforelse
        </tbody>
    </table>
    @else
           
   <span class="h5 tet-info"> Pas de piece pour le moment ,veuillez ajouter une dans la section service</span>
        @endif
  </div>
 </div>
  
</x-app-layout>