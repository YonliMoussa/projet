<x-app-layout>

  <div class="col col-md-10 mx-auto mt-4">
    {{-- <a href="{{route('demandes.create')}}" class="btn btn-primary mb-3"> Faire une demande</a> --}}
    <div class="col-md-8 ms-0 h3">
      @if ($message = Session::get('success'))
          <p class="alert alert-success">{{ $message }}</p>
      @endif
  </div>
    <div class="card text-start">
       
        <div class="card-body">
            <h4 class="card-title"> 
              @if (Auth()->user()->isadmin)
                
              Liste des demandes
              @else
                Mes demandes
              @endif
              @if (isset($demandes ) and $demandes->count()>0)
                
           
              <div class="col colmd-12 mt-3">
                <div
                  class="table-responsive"
                >
                  <table
                    class="table table-primary table-bordered">
                    <thead>
                      <tr class="text-center">
                        <th scope="col">Demandeur</th>
                        <th scope="col">Service demandé</th>
                        <th scope="col">Date demande</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($demandes as $demande)
                        
                     
                      <tr class="">
                        <td scope="row">{{$demande->nom.' '.$demande->prenom}}</td>
                        <td>{{$demande->intitule}}</td>
                        <td>{{date('d-m-Y',strtotime($demande->created_at))}}</td>
                        <td>
                          <form action="{{route('demandes.destroy',$demande->id)}}" method="post">
                          <a href="{{route('demandes.show',$demande->id)}}" class="btn btn-primary btn-sm">Détails</a>
                          <a href="{{route('demandes.edit',$demande->id)}}" class="btn btn-warning btn-sm">Modifier</a>
                          
                          <!-- Modal trigger button -->
                        
                          @if (Auth()->user()->isadmin)
                            @csrf
                            @method('delete')
                          <button
                          type="button"
                          class="btn btn-danger btn-sm"
                          data-bs-toggle="modal"
                          data-bs-target="#modalId{{$demande->id}}"
                          >
                          Supprimer
                          </button>
                        @endif
                          
                          <!-- Modal Body -->
                          <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                          <div
                            class="modal fade"
                            id="modalId{{$demande->id}}"
                            tabindex="-1"
                            data-bs-backdrop="static"
                            data-bs-keyboard="false"
                            
                            role="dialog"
                            aria-labelledby="modalTitleId"
                            aria-hidden="true"
                          >
                            <div
                class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                              role="document"
                            >
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="modalTitleId">
                                    Suppression de demande
                                  </h5>
                                  <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                  ></button>
                                </div>
                                <div class="modal-body">Voulez vous supprimer la demande?</div>
                                <div class="modal-footer">
                                  <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal"
                                  >
                                    Close
                                  </button>
                                  <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          
                          <!-- Optional: Place to the bottom of scripts -->
                          <script>
                            const myModal = new bootstrap.Modal(
                              document.getElementById("modalId"),
                              options,
                            );
                          </script>
                          
                        </form>
                        </td>
                      </tr>
                      @empty
                        
                      @endforelse
                      {{-- fin de ligne --}}
                    </tbody>
                  </table>
                  @else
                <div class="col col-md-8">
                  Pas de demandes,veuillez <a href="{{route('services.index')}}" class="btn btn-primary btn-sm">ici</a> pour choisir un service
                </div>
                  @endif
                </div>
                
              </div>
            </h4>
            <p class="card-text"></p>
        </div>
    </div>
  </div>
    
</x-app-layout>