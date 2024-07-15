<x-app-layout>
  
    
    <div class="col col-md-4 mx-auto mt-4">
 
     <div class="card">
        
         <div class="card-body">
          <strong><span class="card-title h4">Formulaire d'ajout de sevice</span></strong> 
             <p class="card-text">
                 <form action="{{route('services.store')}}" method="POST">
                    @csrf
                     <div class="mb-3">
                         <label for="" class="form-label">Code</label>
                         <input type="text" class="form-control @error('code') is-invalid @enderror"
                         value="{{old('code')}}"
                         name="code">
                         @error('code')
                         <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Intitulé</label>
                        <input type="text" class="form-control @error('intitule') is-invalid @enderror"
                        value="{{old('intitule')}}" 
                        name="intitule">
                        @error('intitule')
                        <div class="text-danger">{{ $message }}</div>
                       @enderror
                      
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Frais de dossier</label>
                        <input type="text" class="form-control @error('frais_dossier') is-invalid @enderror"
                        value="{{old('frais_dossier')}}"
                         name="frais_dossier" placeholder="Veuillez sair la valeur numerique">
                        @error('frais_dossier')
                        <div class="text-danger">{{ $message }}</div>
                       @enderror
                     </div>
                     <button type="submit" class="btn btn-primary sm">Enregistrer</button>
                     <a href="{{route('services.index')}}"><button  type="button" class="btn btn-secondary sm">Retour</button></a>

                         </form>
             </p>
         </div>
     </div>
    </div>
 </x-app-layout>