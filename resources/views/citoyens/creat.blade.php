<x-app-layout>
  
    
    <div class="col col-md-8 mx-auto mt-4">
 
     <div class="card">
        
         <div class="card-body">
         <center><strong ><span class="card-title h4">Formulaire de création de citoyen</span></strong> </center>
             <p class="card-text">
                 <form action="{{route('citoyens.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class=" col-md-4 mb-3">
                            <label for="" class="form-label">Nom</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror"
                            value="{{$nom}}"
                            name="nom" >
                            @error('nom')
                            <div class="text-danger">{{ $message }}</div>
                           @enderror
                       </div>
                       <div class="col-md-4 mb-3">
                           <label for="" class="form-label">Prenom</label>
                           <input type="text" class="form-control @error('prenom') is-invalid @enderror"
                           value="{{$prenom}}" 
                           name="prenom">
                           @error('prenom')
                           <div class="text-danger">{{ $message }}</div>
                          @enderror
                         
                       </div>
                       <div class="col-md-4 mb-3">
                           <label for="" class="form-label">Date  de naissance</label>
                           <input type="date" class="form-control @error('date_naissance') is-invalid @enderror"
                           value="{{old('date_naissance')}}"
                            name="date_naissance" >
                           @error('date_naissance')
                           <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                    </div>

                    <div class="row">
                     <div class="col-md-4 mb-3">
                        <label for="" class="form-label">Lieu de naissance</label>
                        <input type="text" class="form-control @error('lieu_naissance') is-invalid @enderror"
                        value="{{old('lieu_naissance')}}" 
                        name="lieu_naissance">
                        @error('lieu_naissance')
                        <div class="text-danger">{{ $message }}</div>
                       @enderror
                    </div>
                     <div class="col-md-4 mb-3">
                        <label for="" class="form-label">Telephone</label>
                        <input type="text" class="form-control @error('telephone') is-invalid @enderror"
                        value="{{old('telephone')}}" 
                        name="telephone">
                        @error('telephone')
                        <div class="text-danger">{{ $message }}</div>
                       @enderror
                    </div>
                     <div class="col-md-4 mb-3">
                        <label for="" class="form-label">Numero CNIB</label>
                        <input type="text" class="form-control @error('cnib') is-invalid @enderror"
                        value="{{old('cnib')}}" 
                        name="cnib">
                        @error('cnib')
                        <div class="text-danger">{{ $message }}</div>
                       @enderror
                    </div>
                </div>
                     <button type="submit" class="btn btn-primary sm">Enregistrer</button>
                     <a href="{{route('citoyens.index')}}"><button  type="button" class="btn btn-secondary sm">Retour</button></a>
                         </form>
             </p>
         </div>
     </div>
    </div>
 </x-app-layout>