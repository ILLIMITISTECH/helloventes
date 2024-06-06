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

        <!--les formulaires-->
        <div class="container px-6 mx-auto grid">
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Tous les propects stratégiques
          </h2>
              <div class="px-2 my-3" style="width:250px; margin-left:700px; margin-top:-60px">
                 <button
                  class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                  <a href="/tous_les_pospects_stra">Voir pour tous les prospects</a>
                </button>
              </div>
          <br><br>
          @if(Auth::user()->nom_role == "responsable_pole")
           <div style = "margin-top:-50px" align="right"> 
                                 <form action="{{route('prospect_stra_filtre')}}" method="get" style="">
                                
                                    <select name="serachPaysStra" style="width:220px;height:40px;"  id="origine">
                                        <option value="" disabled selected>Rechercher par Pays</option>
                                      @php 
                                         $result_payssF_ar = array();
                                        $commerciauxs = DB::table('commerciaus')->where('domaine_id', $moi->domaine_id)->pluck('id')->toArray();
                                        foreach($commerciauxs as $commerciauxss){
                                         $prospects = DB::table('prospects')->where('commercial_id', $commerciauxss)->where('strategique', 1)->pluck('pays_id')->toArray(); 
                                         $pays = DB::table('pays')->pluck('id')->toArray(); 
                                         $result_paysF = array_diff($pays, $prospects);
                                         $result_payssF = array_diff($pays, $result_paysF);
                                        
                                           foreach($result_payssF as $result_payssFs)
                                            {
                                             array_push($result_payssF_ar, $result_payssFs); 
                                            }
                                            
                                           
                                           
                                         }
                                            $prospectsf = DB::table('pays')->pluck('id')->toArray(); 
                                            $arDif1 = array_diff($prospectsf, $result_payssF_ar);
                                            $arDif2 = array_diff($prospectsf, $arDif1);
                                            
                                        @endphp
                                       
                                            @foreach($arDif2 as $result_pay) 
                                                @php $pay = DB::table('pays')->where('id', $result_pay)->OrderBy('libelle')->first();  @endphp
                                                <option value="{{$pay->id}}">{{$pay->libelle}}</option>
                                            @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="" type="submit">Filtrer</button>
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
              	 @if($prospects_pole->isEmpty()) 
                 	  <p>Pas de prospect</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Commerciaux</th>
                    <th class="px-4 py-3">Entreprises</th>
                    <th class="px-4 py-3">Pays</th>
                    <th class="px-4 py-3">Nbre opportunutés</th>
                    <th class="px-4 py-3">Secteur d'activité</th>
                    <th class="px-4 py-3">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($prospects_pole as $entreprises_pole) 
                @php $opportunite = DB::table('opportunites')->where('prospect_id', $entreprises_pole->id)->where('archiver', 0)->count();
                         $secteur = DB::table('secteur_activites')->where('id', $entreprises_pole->secteur_activite)->first();
                    @endphp
                @if($opportunite > 0)
                  <tr class="text-gray-700 dark:text-gray-400">
                   @php $com = DB::table('commerciaus')->where('id', $entreprises_pole->commercial_id)->first(); @endphp
                    @if($com)
                     <td class="px-4 py-3 text-sm">
                      {{ ($com->prenom) ? $com->prenom : '-'}} {{ ($com->nom) ? $com->nom : '-'}}
                    </td>
                    @else
                     <td class="px-4 py-3 text-sm">
                      --
                    </td>
                    @endif
                    
                    <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$entreprises_pole->nom_entreprise}}">
                        <!--<a href="{{ route('opportunite_prospect.lister',$entreprises_pole->id) }}" >-->
                      {{ strtoupper(($entreprises_pole->nom_entreprise) ? \Illuminate\Support\Str::limit($entreprises_pole->nom_entreprise, 25, $end='...') : '')}}
                      <!--</a>-->
                    </td>
                    @php $pays = DB::table('pays')->where('id', $entreprises_pole->pays_id)->first(); @endphp
                     @if($pays)
                    <td class="px-4 py-3 text-sm">
                      {{ strtoupper(($pays->libelle) ? $pays->libelle : '')}}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      Non renseigné
                    </td>
                    @endif
                    
                    <td class="px-4 py-3 text-xs">
                    <a href="{{ route('opportunite_prospect.lister',$entreprises_pole->id) }}" data-toggle="tooltip" title="Voir les opportunités">
                      <span
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        {{$opportunite}}
                      </span></a>
                    </td>
                    @if($secteur)
                    @if($secteur->id == 15)
                     <td class="px-4 py-3 text-sm">
                      {{ ($entreprises_pole->autres) ? $entreprises_pole->autres : 'Non renseigné'}}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$secteur->libelle}}">
                        {{ ($secteur->libelle) ? \Illuminate\Support\Str::limit($secteur->libelle, 25, $end='...') : '-' }}
                    </td>
                    @endif
                    @else
                     <td class="px-4 py-3 text-sm">
                     --
                    </td>
                    @endif
                    
                    <td class="px-4 py-3 text-sm">
                    <a href="{{ route('opportunite_prospect.create',$entreprises_pole->id) }}">
                      <span data-toggle="tooltip" title="Ajouter une opportunité"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        +
                      </span></a>&nbsp;
                      <a href="{{ route('detail_prospect',$entreprises_pole->id) }}">
                      <button data-toggle="tooltip" title="Détail du prospect"
                    class="px-3 py-1 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                          <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                          <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                        </svg>
                  </button></a>
                    <!-- <span  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Modifier le prospect">-->
                    <!--  <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('entreprise.edit', $entreprises_pole->id)}}" >-->
                    <!--      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">-->
                    <!--      <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>-->
                    <!--      <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>-->
                    <!--    </svg>-->
                    <!--    </a>-->
                    <!--</span>-->
                    </td>
                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--  <input type="text" class="form-control" placeholder="+226 00 00 00 00" aria-label="Username"-->
                    <!--    aria-describedby="addon-wrapping">-->
                    <!--</td>-->
                  </tr>

                </tbody>
                @endif
                @endforeach 
              </table>
            </div>
            
{{$prospects_pole->links()}}
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
        
    @else    
        <!---------------------------------------------------------------------------------------------------------------------------->
        
        <div style = "margin-top:-50px" align="right"> 
                                 <form action="{{route('prospect_stra_filtre')}}" method="get" style="">
                                
                                    <select name="serachPaysStra" style="width:220px;height:40px;"  id="origine">
                                        <option value="" disabled selected>Rechercher par Pays</option>
                                      
                                         @php 
                                        $prospectsf = DB::table('prospects')->where('strategique', 1)->pluck('pays_id')->toArray(); 
                                        $pays = DB::table('pays')->pluck('id')->toArray(); 
                                        $result_pays = array_diff($pays, $prospectsf);
                                        $result_payss = array_diff($pays, $result_pays);
                                        @endphp
                                    @foreach($result_payss as $result_pay) 
                                        @php $pay = DB::table('pays')->where('id', $result_pay)->OrderBy('libelle')->first();  @endphp
                                        <option value="{{$pay->id}}">{{$pay->libelle}}</option>
                                    @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="" type="submit">Filtrer</button>
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
              	 @if($prospects->isEmpty()) 
                 	  <p>Pas de prospect</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Commerciaux</th>
                    <th class="px-4 py-3">Entreprises</th>
                    <th class="px-4 py-3">Pays</th>
                    <th class="px-4 py-3">Nbre opportunutés</th>
                    <th class="px-4 py-3">Secteur d'activité</th>
                    <th class="px-4 py-3">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($prospects as $entreprises) 
                @php $opportunite = DB::table('opportunites')->where('prospect_id', $entreprises->id)->where('archiver', 0)->count();
                         $secteur = DB::table('secteur_activites')->where('id', $entreprises->secteur_activite)->first();
                    @endphp
                @if($opportunite > 0)
                  <tr class="text-gray-700 dark:text-gray-400">
                   @php $com = DB::table('commerciaus')->where('id', $entreprises->commercial_id)->first(); @endphp
                    @if($com)
                     <td class="px-4 py-3 text-sm">
                      {{ ($com->prenom) ? $com->prenom : '-'}} {{ ($com->nom) ? $com->nom : '-'}}
                    </td>
                    @else
                     <td class="px-4 py-3 text-sm">
                      --
                    </td>
                    @endif
                    
                    <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$entreprises->nom_entreprise}}">
                        <!--<a href="{{ route('opportunite_prospect.lister',$entreprises->id) }}" >-->
                      {{ strtoupper(($entreprises->nom_entreprise) ? \Illuminate\Support\Str::limit($entreprises->nom_entreprise, 25, $end='...') : '')}}
                      <!--</a>-->
                    </td>
                    @php $pays = DB::table('pays')->where('id', $entreprises->pays_id)->first(); @endphp
                     @if($pays)
                    <td class="px-4 py-3 text-sm">
                      {{ strtoupper(($pays->libelle) ? $pays->libelle : '')}}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      Non renseigné
                    </td>
                    @endif
                    
                    <td class="px-4 py-3 text-xs">
                    <a href="{{ route('opportunite_prospect.lister',$entreprises->id) }}" data-toggle="tooltip" title="Voir les opportunités">
                      <span
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        {{$opportunite}}
                      </span></a>
                    </td>
                    @if($secteur)
                    @if($secteur->id == 15)
                     <td class="px-4 py-3 text-sm">
                      {{ ($entreprises->autres) ? $entreprises->autres : 'Non renseigné'}}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$secteur->libelle}}">
                        {{ ($secteur->libelle) ? \Illuminate\Support\Str::limit($secteur->libelle, 25, $end='...') : '-' }}
                    </td>
                    @endif
                    @else
                     <td class="px-4 py-3 text-sm">
                     --
                    </td>
                    @endif
                    
                    <td class="px-4 py-3 text-sm">
                    <a href="{{ route('opportunite_prospect.create',$entreprises->id) }}">
                      <span data-toggle="tooltip" title="Ajouter une opportunité"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        +
                      </span></a>&nbsp;
                      <a href="{{ route('detail_prospect',$entreprises->id) }}">
                      <button data-toggle="tooltip" title="Détail du prospect"
                    class="px-3 py-1 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                          <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                          <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                        </svg>
                  </button></a>
                    <!-- <span  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Modifier le prospect">-->
                    <!--  <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('entreprise.edit', $entreprises->id)}}" >-->
                    <!--      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">-->
                    <!--      <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>-->
                    <!--      <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>-->
                    <!--    </svg>-->
                    <!--    </a>-->
                    <!--</span>-->
                    </td>
                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--  <input type="text" class="form-control" placeholder="+226 00 00 00 00" aria-label="Username"-->
                    <!--    aria-describedby="addon-wrapping">-->
                    <!--</td>-->
                  </tr>

                </tbody>
                @endif
                @endforeach 
              </table>
            </div>
            
{{$prospects->links()}}
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
    @endif    
        <!--------------------------------------------------------------------------------------------------------------->
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