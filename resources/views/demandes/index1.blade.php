<x-app-layout>

  <div class="col col-md-10 mx-auto mt-4">
    {{-- <a href="{{route('demandes.create')}}" class="btn btn-primary mb-3"> Faire une demande</a> --}}

    <div class="card text-start">
       
        <div class="card-body">
            <h4 class="card-title"> Mes demandes
              
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
                      @forelse ($mesdemandes as $demande)
                        
                     
                      <tr class="">
                        <td scope="row">{{$demande->nom.' '.$demande->prenom}}</td>
                        <td>{{$demande->intitule}}</td>
                        <td>{{date('d-m-Y',strtotime($demande->created_at))}}</td>
                        <td>
                          <form action="{{route('demandes.destroy',$demande->id)}}" method="post">
                          <a href="{{route('demandes.show',$demande->id)}}" class="btn btn-primary btn-sm">Détails</a>
                          <a href="{{route('demandes.edit',$demande->id)}}" class="btn btn-warning btn-sm">Modifier</a>
                          
                          <!-- Modal trigger button -->
                          <button
                            type="button"
                            class="btn btn-danger btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#modalId{{$demande->id}}"
                          >
                          Supprimer
                          </button>
                          
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
                                  <button type="button" class="btn btn-primary">Save</button>
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
                </div>
                
              </div>
            </h4>
            <p class="card-text"></p>
        </div>
    </div>
  </div>
    
</x-app-layout>