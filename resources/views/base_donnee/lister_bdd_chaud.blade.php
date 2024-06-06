<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hello Ventes</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('Koyalis/public/assets/css/tailwind.output.css')}}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <link rel="icon" href="{{asset('icones.png')}}" />

</head>

<body>
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
    <!-- Desktop sidebar -->
  @include('v2.side_bar_dg')
    
    <!-- Mobile sidebar -->
    <!-- Backdrop -->
    
    
    
    <div class="flex flex-col flex-1 w-full">
      @include('v2.header_dg')
      <main class="h-full pb-16 overflow-y-auto">
                   <br>
       <a data-toggle="tooltip" title="Retour" style="width:90px; margin-left:30px"  type="button" id="PopoverCustomT-1" class="nm" href="javascript:history.go(-1)" >
                   <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="nmj bi bi-arrow-left-circle" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                    </svg>
                </a>
                <style>
                    .nmj:hover{
                        background-color:#9045e2;
                        color:white;
                        border-radius:100px;
                    } 
                </style>                
        <!--les formulaires-->
        <div class="container px-6 mx-auto grid">
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Base de donnees des prospects chauds
          </h2>
          
           
                   <!-- <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-4">
                                    <div class="custom-file text-left">
                                        <input type="file" name="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile"></label>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="" type="submit">Importer les prospects</button>
                                
                            
                            </form>                     
                    
                     <br>-->

                            <br>
        
                            <div style = "margin-left: 200px; margin-top:-50px" > 
                                 <form action="{{route('prospect_bddFiltre_chaud')}}" method="get" style="margsearchfin-top:5px; display:flex;">
                                    <select name="serachCom" style="width:220px;height:40px"  id="statut" style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par Commercial(e)</option>
                                        @php 
                                        $commerciauxs = DB::table('commerciaus')->pluck('id')->toArray();
                                        $entreprisess = DB::table('bdd_prospects')->where('statut',null)->where('taille_prospect','Grande')->pluck('commercial_id')->toArray();
                                        
                                        $result_comerP = array_diff($commerciauxs, $entreprisess);
                                        $result_comersss = array_diff($commerciauxs, $result_comerP);
                                        
                                        @endphp
                                        
                                        @foreach($result_comersss as $result_comer)
                                        @php $commerciales = DB::table('commerciaus')->where('id', $result_comer)->OrderBy('prenom')->first();  @endphp
                                        <option value="{{$commerciales->id}}">{{$commerciales->prenom}} {{$commerciales->nom}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                    
                                    
                                    
                                    <select name="serachPays" style="width:220px;height:40px"  id="statut" style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par pays</option>
                                        @php 
                                        $payChecks = DB::table('pays')->pluck('libelle')->toArray();
                                        $entreprisess = DB::table('bdd_prospects')->where('statut',null)->where('taille_prospect','Grande')->pluck('pays')->toArray();
                                        
                                        $result_comerPp = array_diff($payChecks, $entreprisess);
                                        $result_comersssf = array_diff($payChecks, $result_comerPp);
                                        
                                       
                                        @endphp
                                        
                                        @foreach($result_comersssf as $result_comere)
                                        @php $payss = DB::table('pays')->where('libelle', $result_comere)->orderBy('libelle')->first();  @endphp
                                        <option value="{{$payss->libelle}}">{{$payss->libelle}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                    
                                    <select name="serachVille" style="width:220px;height:40px"  id="statut" style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par ville</option>
                                        @php 
                                        $villeChecks = DB::table('villes')->pluck('libelle')->toArray();
                                        $entreprisess = DB::table('bdd_prospects')->where('statut',null)->where('taille_prospect','Grande')->pluck('ville')->toArray();
                                        
                                        $result_comerPpp = array_diff($villeChecks, $entreprisess);
                                        $result_comersssff = array_diff($villeChecks, $result_comerPpp);
                                        
                                       
                                        @endphp
                                        
                                        @foreach($result_comersssff as $result_comeree)
                                        @php $villes = DB::table('villes')->where('libelle', $result_comeree)->orderBy('libelle')->first();  @endphp
                                        <option value="{{$villes->libelle}}">{{$villes->libelle}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                    
                                    
                                    
                                     
                                
                                    <!--<select name="serachPays" style="width:220px;height:40px; margin-left:10px;"  id="origine">-->
                                    <!--    <option value="" disabled selected>Rechercher par Pays</option>-->
                                        @php 
                                        $prospects = DB::table('bdd_prospects')->pluck('pays_id')->toArray(); 
                                         $pays = DB::table('pays')->pluck('id')->toArray(); 
                                         $result_paysF = array_diff($pays, $prospects);
                                         $result_payssF = array_diff($pays, $result_paysF);
                                         
                                        @endphp
                                    <!--@foreach($result_payssF as $result_pay) -->
                                    <!--    @php $pay = DB::table('pays')->where('id', $result_pay)->OrderBy('libelle')->first();  @endphp-->
                                    <!--    <option value="{{$pay->id}}">{{$pay->libelle}}</option>-->
                                    <!--@endforeach-->
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    <!--</select>-->
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-left:10px;" type="submit">Filtrer</button>
                                </form> 
                            </div> 
                            <br>
             <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              	 @if($bdd_prospects->isEmpty()) 
                 	  <p>Pas de base de prospects chauds</p>
					 @else
            <div class="w-full overflow-x-auto">
               
            
        <div class="w-full overflow-x-auto">    
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Entreprises</th>
                    <th class="px-4 py-3">Secteur d'activité</th>
                    <th class="px-4 py-3">Nom du contact</th>
                    <th class="px-4 py-3">Numéro contact</th>
                    <th class="px-4 py-3">Pays & Ville</th>
                    <!--<th class="px-4 py-3">Suggestion</th>-->
                    <th class="px-4 py-3">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($bdd_prospects as $bdd_prospect) 
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$bdd_prospect->nom_entreprise}}">
                         {{ \Illuminate\Support\Str::limit(($bdd_prospect->nom_entreprise) ? $bdd_prospect->nom_entreprise : 'Non renseigné', 25, $end='...') }}
                    </td>
                    
                    
                     <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$bdd_prospect->secteur_activite}}">
                         {{ \Illuminate\Support\Str::limit(($bdd_prospect->secteur) ? $bdd_prospect->secteur : 'Non renseigné', 25, $end='...') }}
                    </td>
                   
                   
                    
                     <td class="px-4 py-3 text-sm">
                      {{($bdd_prospect->prenom_contact1) ? $bdd_prospect->prenom_contact1 : ''}} {{($bdd_prospect->nom_contact1) ? $bdd_prospect->nom_contact1 : ''}} 
                    </td>
                     <td class="px-4 py-3 text-sm">
                      {{($bdd_prospect->mobile_contact1) ? $bdd_prospect->mobile_contact1 : ''}}<br>{{($bdd_prospect->email_contact1) ? $bdd_prospect->email_contact1 : ''}}
                    </td>
                    
                    <td class="px-4 py-3 text-sm">
                      {{($bdd_prospect->pays) ? $bdd_prospect->pays : ''}}<br>{{($bdd_prospect->ville) ? $bdd_prospect->ville : ''}}
                    </td>
                    
                    
                    <td class="px-4 py-3 text-sm">
                    <div style="display:flex ">
                      
                         
                        <span style="margin-left:3px; height:28px;"  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Fiche entreprise">
            <a href="{{ route('fiche_prospect_bdd',$bdd_prospect->id) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
</svg>
                    </a>
                      </span>
                      
                         <span style="margin-left:3px; height:28px;"  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Modifier les infos">
                          <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('bdd_prospects.edit', $bdd_prospect->id)}}" >
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg>
                            </a>
                        </span>
                        
                    
                    </div>
                    </td>
                   
                  </tr>

                </tbody>
                @endforeach 
              </table>
            </div>
            
{{$bdd_prospects->links()}}
                 @endif
          </div>


   <style>
  .pagination {
    list-style: none;
    margin: 0;
    display: flex;
    padding-left: 450px;
}
        
.pagination li {
    margin: 0 1px;
    font-size: 17px;
}
 
 </style> 
        </div>
    </div>
    </main>
  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/init-alpine.js')}}"></script>
  <script src="{{asset('Koyalis/public/https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js')}}" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/charts-lines.js')}}" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/charts-pie.js')}}" defer></script>

 
</body>

</html>