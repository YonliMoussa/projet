<x-app-layout>
  
    
    <div class="col col-md-4 mx-auto mt-4">
 
     <div class="card">
        
         <div class="card-body">
         <h3> Formulaire d'ajout de pièce</h3>
             <p class="card-text">
                 <form action="{{route('pieces.store')}}" method="POST">
                    @csrf
                         <input type="hidden" name="service_id" value="{{$id}}">
                        
                    <div class="mb-3">
                        <label for="" class="form-label">Intitulé</label>
                        <input type="text" class="form-control @error('intitule') is-invalid @enderror"
                        value="{{old('intitule')}}" 
                        name="intitule">
                        @error('intitule')
                        <div class="text-danger">{{ $message }}</div>
                       @enderror
                      
                    </div>
                    {{-- <div class="mb-3">
                        <label for="" class="form-label">Description </label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror"
                        value="{{old('description')}}"
                         name="description" placeholder="Donnez la description de la piece">
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                       @enderror
                     </div> --}}
                     <button type="submit" class="btn btn-primary sm">Enregistrer</button>
                   <a href="{{route('services.show',$id)}}"> <button type="button" class="btn btn-secondary sm">Retour</button></a>
                         </form>
             </p>
         </div>
     </div>
    </div>
 </x-app-layout>