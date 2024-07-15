<x-app-layout>
  
    
    <div class="col col-md-6 mx-auto mt-4">
 
     <div class="card">
        
         <div class="card-body">
            <div class="col-md-* ms-0 h3">
                @if ($message = Session::get('success'))
                    <p class="alert alert-danger">{{ $message }}</p>
                @endif
            </div>
         <center><strong ><span class="card-title h4">Formulaire de modification de demande</span></strong> </center>
             <p class="card-text">
                 <form action="{{route('demandes.update',$demande->id)}}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                     <div class=" mb-3">
                        <label for="" class="form-label">Titre de la demande</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror"
                        value="{{$demande->description}}" 
                        name="description">
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                       @enderror
                    </div>
                     @forelse ($pieces as $piece)
                         <input type="hidden" name="pid[]" value="{{$piece->id}}">
                     {{-- on fait le foreach ici pour afficher le/les input pour charger les fichiers --}}
                     <div class="  mb-3">
                         {{-- Pour les fichiers on boucle Pour le labele on peut afficher l'intitule de la piece --}}
                         <label for="" class="form-label">{{$piece->intitule}}</label>
                         <input type="file" class="form-control @error('files') is-invalid @enderror"
                         name="files[]"  multiple>
                         @error('files')
                         <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                     @empty
                         
                     @endforelse
                   
                   
                     <button type="submit" class="btn btn-primary sm">Enregistrer</button>
                     <a href="{{route('demandes.index')}}"><button  type="button" class="btn btn-secondary sm">Retour</button></a>
                         </form>
             </p>
         </div>
     </div>
    </div>
 </x-app-layout>