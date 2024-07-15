<x-app-layout>
  
    
    <div class="col col-md-4 mx-auto mt-4">
 
     <div class="card">
        
         <div class="card-body">
            <strong><span class="card-title h4">Formulaire de modification de sevice</span></strong> 
             <p class="card-text">
                @if (@isset($service))
                 <form action="{{route('services.update',$service)}}" method="POST">
                    @csrf
                    @method('put')
                     <div class="mb-3">
                         <label for="" class="form-label">Code</label>
                         <input type="text" class="form-control" value="{{$service->code}}" name="code">
                         @error('code')
                         <div class="text-danger">{{ $message }}</div>
                        @enderror
                     </div>
                     <div class="mb-3">
                         <label for="" class="form-label">Intitulé</label>
                         <input type="text" class="form-control" value="{{$service->intitule}}" name="intitule">
                         @error('intitule')
                         <div class="text-danger">{{ $message }}</div>
                        @enderror
                     </div>
                     <div class="mb-3">
                         <label for="" class="form-label">Frais de dossier</label>
                         <input type="text" class="form-control" value="{{$service->frais_dossier}}" name="frais_dossier">
                         @error('frais_dossier')
                         <div class="text-danger">{{ $message }}</div>
                        @enderror
                     </div>
                     <button type="submit" class="btn btn-primary sm">Valider</button>
                 </form>
                 @else
                 <div class="alert alert-danger">Desolé,fichier introuvable!</div>
                 @endif
             </p>
         </div>
     </div>
    </div>
 </x-app-layout>