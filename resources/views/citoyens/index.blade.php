<x-app-layout>

    <div class="col col-md-10 mt-5 mx-auto">
       
       {{-- alerte optionnelle --}}
       <div class="col-md-8 ms-0 h3">
           @if ($message = Session::get('success'))
               <p class="alert alert-success">{{ $message }}</p>
           @endif
       </div>
   @if (isset($citoyens) and $citoyens->count()>0)
   @if($nombre==1)

   @else

   <a href="{{route('citoyens.create')}}" class="btn btn-primary mt-4">Créer citoyen</a>
  @endif
  
       <div class="table-responsive-sm mt-2">
           <h4>Information citoyen</h4>
       <table class="table table-primary" >
          
           <thead>
               <tr class="text-center">
                   <th scope="col">Nom</th>
                   <th scope="col">Prenom</th>
                   <th scope="col">Date de naissance</th>
                   <th scope="col">Lieu de naissance</th>
                   <th scope="col">Télephone</th>
                   <th scope="col">Numero CNIB</th>
                   <th scope="col">Action</th>
               </tr>
           </thead>
           <tbody>
               @forelse ($citoyens as $citoyen)
               <tr class="">
                   <td scope="row">{{$citoyen->nom}}</td>
                   <td>{{$citoyen->prenom}}</td>
                   <td>{{$citoyen->date_naissance}}</td>
                   <td>{{$citoyen->lieu_naissance}}</td>
                   <td>{{$citoyen->telephone}}</td>
                   <td>{{$citoyen->cnib}}</td>
                   <td>
                       <form action="{{route('citoyens.destroy',$citoyen->id)}}" method="POST">
   
                           <a href="{{route('citoyens.show',$citoyen->id)}}" class="btn btn-info mb-2">détails</a>
                           <a href="{{route('citoyens.edit',$citoyen->id)}}" class="btn btn-warning btn-md mb-2">modifier</a>
                           @csrf
                           @method('delete')
                       <!-- Modal trigger button -->
                       @if (Auth()->user()->isadmin)
                           
                       <button
                       type="button"
                       class="btn btn-danger"
                       data-bs-toggle="modal"
                       data-bs-target="#modalId{{$citoyen->id}}">
                       Supprimer
                       </button>
                    @endif
                       
                       <!-- Modal Body -->
                       <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                       <div   class="modal fade"  id="modalId{{$citoyen->id}}"  tabindex="-1" data-bs-backdrop="static"
                        data-bs-keyboard="false"
                            role="dialog"  aria-labelledby="modalTitleId" aria-hidden="true" >
                           <div
                               class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                               role="document"
                           >
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <h5 class="modal-title" id="modalTitleId">
                                           Suppression du citoyen {{$citoyen->nom}}
                                       </h5>
                                       <button
                                           type="button"
                                           class="btn-close"
                                           data-bs-dismiss="modal"
                                           aria-label="Close"
                                       ></button>
                                   </div>
                                   <div class="modal-body">Voulez vous supprimer ce citoyen?</div>
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
                               document.getElementById("modalId$citoyen->id"),
                               options,
                           );
                       </script>
                       
                   </form>
                   </td>
               </tr>
               @empty
                   Pas de citoyen
               @endforelse
           </tbody>
       </table>
       @else
       <div class="col col-md-10">Vous n'avez pas encore mis à jour vos informations
        cliquez          <a href="{{route('citoyens.create')}}" class="btn btn-primary">ici</a> pour 
        metrre à jour vos informations 

       </div>
       @endif
     </div>
    </div>
     
   </x-app-layout>