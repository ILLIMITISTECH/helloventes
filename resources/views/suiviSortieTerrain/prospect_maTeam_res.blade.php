<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hello Ventes</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('Koyalis/public/assets/css/tailwind.output.css')}}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
  <!-- CSS only -->
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

          <br><br>
                <a href="/prospect_stra">
                    <button style="width:150px"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                         Prospects stratégiques
                    </button> </a>

           @if(Auth::user()->nom_role == "responsable")
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Tous les prospects
          </h2>
          	 @if(count($entreprise) <= 0) 
                 	  <p>Pas de prospect</p>
					 @else
          <br>
                            <div style = "margin-left: 400px; margin-top:-50px" > 
                                 <form action="{{route('prospect_maTeamFiltreRes')}}" method="get" style="margsearchfin-top:5px; display:flex;">
                                    <select name="serachCom" style="width:220px;height:40px"  id="statut" style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par Commercial(e)</option>
                                        @php 
                                        $moi = App\Commerciau::where('user_id', Auth::user()->id)->first();
                                        $commerciauxs = DB::table('commerciaus')->where('superieur_id', $moi->id)->pluck('id')->toArray();
                                        $entreprisess = DB::table('prospects')->pluck('id')->toArray();
                                        
                                        $result_comerP = array_diff($entreprisess, $commerciauxs);
                                        $result_comersss = array_diff($commerciauxs, $result_comerP);
                                        
                                        @endphp
                                        
                                        @foreach($result_comersss as $result_comer)
                                        @php $commerciales = DB::table('commerciaus')->where('id', $result_comer)->OrderBy('prenom')->first();  @endphp
                                        <option value="{{$commerciales->id}}">{{$commerciales->prenom}} {{$commerciales->nom}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                      
                                
                                    <select name="serachPays" style="width:220px;height:40px; margin-left:10px;"  id="origine">
                                        <option value="" disabled selected>Rechercher par Pays</option>
                                        @php 
                                         $result_payssF_ar = array();
                                        $commerciauxs = DB::table('commerciaus')->where('superieur_id', $moi->id)->pluck('id')->toArray();
                                        foreach($commerciauxs as $commerciauxss){
                                         $prospects = DB::table('prospects')->where('commercial_id', $commerciauxss)->pluck('pays_id')->toArray(); 
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
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-left:10px;" type="submit">Filtrer</button>
                                </form> 
                            </div> 
                            <br>
                            
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              
            <div class="w-full overflow-x-auto">
               
                
              <table class="w-full whitespace-no-wrap" id="products-table">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3">Entreprises</th>
                    <th class="px-4 py-3">Contact</th>
                    <th class="px-4 py-3">Pays</th>
                    <th class="px-4 py-3">Nbre opportunités</th>
                    <th class="px-4 py-3">Commerciaux</th>
                    <!--<th class="px-4 py-3">Options</th>-->
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($entreprise as $entreprises) 
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                     <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$entreprises->nom_entreprise}}">
                     
                      {{ strtoupper(($entreprises->nom_entreprise) ? \Illuminate\Support\Str::limit($entreprises->nom_entreprise, 25, $end='...') : '')}}
                    </td>
                    <td class="px-4 py-3 text-sm">
                      {{$entreprises->phone}}
                    </td>
                    @php
                     $me = DB::table('commerciaus')->where('user_id', auth::user()->id)->first();
                     $prospect_total = DB::table('prospects')->where('superieur_id', $me->id)->count();
                    $opportunite_total = DB::table('opportunites')->where('superieur_id', $me->id)->where('archiver', 0)->count();
                    
                    $pays = DB::table('pays')->where('id', $entreprises->pays_id)->first(); @endphp
                     @if($pays)
                    <td class="px-4 py-3 text-sm">
                      {{ strtoupper(($pays->libelle) ? $pays->libelle : '')}}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      Non renseigné
                    </td>
                    @endif
                    
                    @php $opportunite = DB::table('opportunites')->where('prospect_id', $entreprises->id)->where('archiver', 0)->count(); 
                        $com = DB::table('commerciaus')->where('id', $entreprises->commercial_id)->first(); 
                    @endphp
                    <td class="px-4 py-3 text-xs">
                    <a href="{{ route('opportunite_prospect.maTeam',$entreprises->id) }}" data-toggle="tooltip" title="Voir les opportunités">
                      <span
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        {{$opportunite}}
                      </span></a>
                    </td>
                    @if($com)
                     <td class="px-4 py-3 text-sm">
                      {{ ($com->prenom) ? $com->prenom : '-'}} {{ ($com->nom) ? $com->nom : '-'}}
                    </td>
                    @else
                     <td class="px-4 py-3 text-sm">
                      --
                    </td>
                    @endif
                  <!--  <td class="px-4 py-3 text-sm">-->
                  <!--  <a href="{{ route('opportunite_prospect.create',$entreprises->id) }}">-->
                  <!--    <span data-toggle="tooltip" title="Ajouter une opportunité"-->
                  <!--      class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">-->
                  <!--      +-->
                  <!--    </span></a>&nbsp;-->
                  <!--    <a href="{{ route('detail_prospect',$entreprises->id) }}">-->
                  <!--    <button data-toggle="tooltip" title="Détail du prospect"-->
                  <!--  class="px-3 py-1 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">-->
                  <!--  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">-->
                  <!--        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>-->
                  <!--        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>-->
                  <!--      </svg>-->
                  <!--</button></a>-->
                    
                  <!--  </td>-->
                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--  <input type="text" class="form-control" placeholder="+226 00 00 00 00" aria-label="Username"-->
                    <!--    aria-describedby="addon-wrapping">-->
                    <!--</td>-->
                  </tr>

                </tbody>
                @endforeach 
                 <tr class="text-gray-700 dark:text-gray-400">
                   <td class="px-4 py-3 text-sm">
                      <span style="color:0063ed; background-color:#0093a2"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        {{$prospect_total}}
                      </span>
                    </td>
                    <td class="px-4 py-3">

                      <div >
                          <b></b>
                    
                      </div>
                    </td>
                    
                    
                    <td class="px-4 py-3 text-xs">
                      <span style="color:0063ed; background-color:#0093a2"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        {{$opportunite_total}}
                      </span>
                    </td>
                    
                    
                  
                  </tr>
              </table>
                
            </div>

          </div>

@endif
  
        </div>
        
        <!------------------------------------------------------------responsable pole-------------------------------------------------------------------->
        
        @elseif(Auth::user()->nom_role == "responsable_pole")
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Tous les prospects
          </h2>
          	 @if(count($entreprise_pole) <= 0) 
                 	  <p>Pas de prospect</p>
					 @else
          <br>
                            <div style = "margin-left: 400px; margin-top:-50px" > 
                                 <form action="{{route('prospect_maTeamFiltreRes')}}" method="get" style="margsearchfin-top:5px; display:flex;">
                                    <select name="serachCom" style="width:220px;height:40px"  id="statut" style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par Commercial(e)</option>
                                        @php 
                                        $moi = App\Commerciau::where('user_id', Auth::user()->id)->first();
                                        $commerciauxs = DB::table('commerciaus')->where('domaine_id', $moi->domaine_id)->pluck('id')->toArray();
                                        $entreprisess = DB::table('prospects')->pluck('id')->toArray();
                                        
                                        $result_comerP = array_diff($entreprisess, $commerciauxs);
                                        $result_comersss = array_diff($commerciauxs, $result_comerP);
                                        
                                        @endphp
                                        
                                        @foreach($result_comersss as $result_comer)
                                        @php $commerciales = DB::table('commerciaus')->where('id', $result_comer)->OrderBy('prenom')->first();  @endphp
                                        <option value="{{$commerciales->id}}">{{$commerciales->prenom}} {{$commerciales->nom}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                      
                                
                                    <select name="serachPays" style="width:220px;height:40px; margin-left:10px;"  id="origine">
                                        <option value="" disabled selected>Rechercher par Pays</option>
                                        @php 
                                         $result_payssF_ar = array();
                                        $commerciauxs = DB::table('commerciaus')->where('domaine_id', $moi->domaine_id)->pluck('id')->toArray();
                                        foreach($commerciauxs as $commerciauxss){
                                         $prospects = DB::table('prospects')->where('commercial_id', $commerciauxss)->pluck('pays_id')->toArray(); 
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
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-left:10px;" type="submit">Filtrer</button>
                                </form> 
                            </div> 
                            <br>
                            
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              
            <div class="w-full overflow-x-auto">
               
                
              <table class="w-full whitespace-no-wrap" id="products-table">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3">Entreprises</th>
                    <th class="px-4 py-3">Contact</th>
                    <th class="px-4 py-3">Pays</th>
                    <th class="px-4 py-3">Nbre opportunités</th>
                    <th class="px-4 py-3">Commerciaux</th>
                    <!--<th class="px-4 py-3">Options</th>-->
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($entreprise_pole as $entreprises_pole) 
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$entreprises_pole->nom_entreprise}}">
                    
                      {{ strtoupper(($entreprises_pole->nom_entreprise) ? \Illuminate\Support\Str::limit($entreprises_pole->nom_entreprise, 25, $end='...') : '')}}
                    </td>
                    <td class="px-4 py-3 text-sm">
                      {{$entreprises_pole->phone}}
                    </td>
                    
                    @php
                     $me = DB::table('commerciaus')->where('user_id', auth::user()->id)->first();
                    
                     $prospect_total_pole = DB::table('prospects')->select('prospects.*', 'commerciaus.*')
                        ->join('commerciaus', 'commerciaus.id', 'prospects.commercial_id')
                        ->where('commerciaus.domaine_id', $moi->domaine_id)
                        ->count();
                     $opportunite_total_pole = DB::table('opportunites')->select('opportunites.*', 'commerciaus.*')
                        ->join('commerciaus', 'commerciaus.id', 'opportunites.commercial_id')
                        ->where('commerciaus.domaine_id', $moi->domaine_id)->where('opportunites.archiver', 0)
                        ->count();
                    $pays = DB::table('pays')->where('id', $entreprises_pole->pays_id)->first(); @endphp
                     @if($pays)
                    <td class="px-4 py-3 text-sm">
                      {{ strtoupper(($pays->libelle) ? $pays->libelle : '')}}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      Non renseigné
                    </td>
                    @endif
                    
                    @php $opportunite_pole = DB::table('opportunites')->where('prospect_id', $entreprises_pole->id)->where('archiver', 0)->count(); 
                        $com = DB::table('commerciaus')->where('id', $entreprises_pole->commercial_id)->first(); 
                    @endphp
                    <td class="px-4 py-3 text-xs">
                    <a href="{{ route('opportunite_prospect.maTeam',$entreprises_pole->id) }}" data-toggle="tooltip" title="Voir les opportunités">
                      <span
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        {{$opportunite_pole}}
                      </span></a>
                    </td>
                    @if($com)
                     <td class="px-4 py-3 text-sm">
                      {{ ($com->prenom) ? $com->prenom : '-'}} {{ ($com->nom) ? $com->nom : '-'}}
                    </td>
                    @else
                     <td class="px-4 py-3 text-sm">
                      --
                    </td>
                    @endif
                  <!--  <td class="px-4 py-3 text-sm">-->
                  <!--  <a href="{{ route('opportunite_prospect.create',$entreprises_pole->id) }}">-->
                  <!--    <span data-toggle="tooltip" title="Ajouter une opportunité"-->
                  <!--      class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">-->
                  <!--      +-->
                  <!--    </span></a>&nbsp;-->
                  <!--    <a href="{{ route('detail_prospect',$entreprises_pole->id) }}">-->
                  <!--    <button data-toggle="tooltip" title="Détail du prospect"-->
                  <!--  class="px-3 py-1 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">-->
                  <!--  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">-->
                  <!--        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>-->
                  <!--        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>-->
                  <!--      </svg>-->
                  <!--</button></a>-->
                    
                  <!--  </td>-->
                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--  <input type="text" class="form-control" placeholder="+226 00 00 00 00" aria-label="Username"-->
                    <!--    aria-describedby="addon-wrapping">-->
                    <!--</td>-->
                  </tr>

                </tbody>
                @endforeach 
                 <tr class="text-gray-700 dark:text-gray-400">
                   <td class="px-4 py-3 text-sm">
                      <span style="color:0063ed; background-color:#0093a2"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        {{$prospect_total_pole}}
                      </span>
                    </td>
                    <td class="px-4 py-3">

                      <div >
                          <b></b>
                    
                      </div>
                    </td>
                    
                    
                    <td class="px-4 py-3 text-xs">
                      <span style="color:0063ed; background-color:#0093a2"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        {{$opportunite_total_pole}}
                      </span>
                    </td>
                    
                    
                  
                  </tr>
              </table>
                
            </div>

          </div>

@endif
  
        </div>
 @endif       
        <!------------------------------------------------------------END responsable pole-------------------------------------------------------------------->
        
    </div>
    </main>
  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/init-alpine.js')}}"></script>
  <script src="{{asset('Koyalis/public/https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js')}}" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/charts-lines.js')}}" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/charts-pie.js')}}" defer></script>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    

</body>

</html>