<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hello Ventes</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('Koyalis/public/assets/css/tailwind.output.css')}}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
  <link rel="stylesheet" type="text/css" href="{{asset('DataTables/media/css/jquery.dataTables.min.css')}}">
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
            Rapport des commerciaux
          </h2>
          <!--<div class="px-2 my-3" style="width:250px; margin-left:700px; margin-top:-60px">-->
          <!--   <button-->
          <!--    class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">-->
          <!--    <a href="/tous_les_commerciaux">Voir tous les commerciaux</a>-->
          <!--  </button>-->
          <!--</div>-->
          
          <br>
                         <div  class="col-md-3" style = "margin-top:-20px" align="right" >
                                 <form action="{{route('commerciaux_maTeamIndividuelFiltre')}}" method="get" >
                                    <select name="searchCommerciau" style="width:220px;height:40px"  style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par commerciaux</option>
                                      @php 
                                        $commerciauxs = DB::table('commerciaus')->pluck('id')->toArray();
                                        $entreprisess = DB::table('prospects')->pluck('commercial_id')->toArray();
                                      
                                        $result_comerP = array_diff($commerciauxs, $entreprisess);
                                        $result_comersss = array_diff($commerciauxs, $result_comerP);
                                        
                                        @endphp
                                        
                                        @foreach($result_comersss as $result_comer)
                                        @php $commerciales = DB::table('commerciaus')->where('id', $result_comer)->OrderBy('prenom')->first();  @endphp
                                        <option value="{{$commerciales->id}}">{{$commerciales->prenom}} {{$commerciales->nom}}</option>
                                        @endforeach
                                       
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="" type="submit">Filtrer</button>
                                </form> 
                            </div> 
                            <br>
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              	 @if($commerciaux->isEmpty()) 
                 	  <p>Pas de commerciaux</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3">Prénom / Nom</th>
                    <th class="px-4 py-3">Nbre prospects</th>
                    <th class="px-4 py-3">Nbre opportunutés</th>
                    <th class="px-4 py-3">Nouveaux contacts</th>
                    <th class="px-4 py-3">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                     @php
                    $semaineM7 = (date('d') -7);
                    $action_semaineP7 = (date('d') +7);
                    $action_mois = date('m');
                    $annee = date('Y');
                 @endphp
                 
                @foreach($commerciaux as $commerciau) 
                                @php 
                                    $opportunite = DB::table('opportunites')->where('commercial_id', $commerciau->id)->where('archiver', 0)->count(); 
                                    $prospect = DB::table('prospects')->where('commercial_id', $commerciau->id)->count();
                                    
                                    $contacts = DB::table('contacts')->where('commercial_id', $commerciau->id)
                                        ->whereDay('created_at', '<=', $action_semaineP7)
                                        ->WhereDay('created_at', '>=', $semaineM7)
                                        ->whereMonth('created_at', $action_mois)
                                        ->whereYear('created_at', $annee)
                                        ->count();
                                    $photo = DB::table('users')->where('id', $commerciau->user_id)->first();
                                @endphp
                  
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <td class="px-4 py-3">

                      <div class="flex items-center text-sm">
                        
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                           @if($photo->photo)
                          <img class="object-cover w-full h-full rounded-full"
                            src="{{ url('imgs/', $photo->photo) }}"
                            alt="" loading="lazy" />
                            @else
                            <img class="object-cover w-full h-full rounded-full"
                            src="{{ asset('imgs/pp.png') }}"
                            alt="" loading="lazy" />
                            @endif
                          <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                        <div>
                          {{($commerciau->prenom) ? $commerciau->prenom : '-'}} {{ ($commerciau->nom) ? $commerciau->nom : '-'}} 
                          
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <a href="{{ route('prospect_com.maTeam',$commerciau->id) }}" data-toggle="tooltip" title="Voir les prospects de {{$commerciau->prenom}}">
                      <span style="color:0063ed;"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        {{$prospect}}
                      </span>
                      </a>
                    </td>
                    
                    <td class="px-4 py-3 text-xs">
                    <a href="{{ route('opportunite_com.maTeam',$commerciau->id) }}" data-toggle="tooltip" title="Voir les opportunités de {{$commerciau->prenom}}">
                      <span
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        {{$opportunite}}
                      </span></a>
                    </td>
                     <td class="px-4 py-3 text-sm">
                    <a href="{{ route('liste_contact_maTeam',$commerciau->id) }}" data-toggle="tooltip" title="Voir les nouveaux contacts de {{$commerciau->prenom}}">
                    <span
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        {{$contacts}}
                      </span></a>
                    </td>
                   <td class="px-4 py-3 text-sm">
                       <div style="display:flex ">
                       <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Rapport de {{$commerciau->prenom}}">
                          <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('rapport_commercial', $commerciau->id)}}" >
                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard" viewBox="0 0 16 16">
                              <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                              <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                            </svg>
                        </a>
                    </span>
                    <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Planning de {{$commerciau->prenom}}">
                          <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('planning_commercial', $commerciau->id)}}" >
                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                              <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                            </svg>
                        </a>
                    </span>
                   <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Modifier les informations">
                          <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('listcommerciaux.edit', $commerciau->id)}}" >
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
       
            {{$commerciaux->links()}}
                 @endif
          </div>


  
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