<x-app-layout>
  
    
    <div class="col col-md-4 mx-auto mt-4">
 
     <div class="card">
        
         <div class="card-body">
            <strong><span class="card-title h4">Formulaire de modification de pièce</span></strong> 
             <p class="card-text">
                @if (@isset($piece))
                 <form action="{{route('pieces.update',$piece)}}" method="POST">
                    @csrf
                    @method('put')
                    
                     <div class="mb-3">
                         <label for="" class="form-label">Intitulé</label>
                         <input type="text" class="form-control" value="{{$piece->intitule}}" name="intitule">
                         @error('intitule')
                         <div class="text-danger">{{ $message }}</div>
                        @enderror
                     </div>
                     {{-- <div class="mb-3">
                         <label for="" class="form-label">Description</label>
                         <input type="text" class="form-control" value="{{$piece->frais_dossier}}" name="description">
                         @error('description')
                         <div class="text-danger">{{ $message }}</div>
                        @enderror
                     </div> --}}
                     <button type="submit" class="btn btn-primary sm">Valider</button>
                     <a href="{{route('pieces.index')}}"><button  type="button" class="btn btn-secondary sm">Retour</button></a>

                 </form>
                 @else
                 <div class="alert alert-danger">Desolé,fichier introuvable!</div>
                 @endif
             </p>
         </div>
     </div>
    </div>
 </x-app-layout>