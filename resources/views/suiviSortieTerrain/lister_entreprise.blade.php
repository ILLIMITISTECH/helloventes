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
            Mes prospects
          </h2>
      
                <a href="/prospect_maTeam">
                    <button style="width:150px"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                         Tous les Prospects 
                    </button> </a>
              
                     <br>

                            @if($entreprise->isEmpty()) 
                 	        
					        @else
                                <div style = "margin-top:-50px" align="right"> 
                                 <form action="{{route('MyprospectFiltre')}}" method="get" style="">
                                
                                    <select name="serachPaysP" style="width:220px;height:40px;"  id="origine">
                                        <option value="" disabled selected>Rechercher par Pays</option>
                                      
                                       @php 
                                       $com = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                                       $result_paysse = array();
                                       foreach($entreprise as $entreprisesgn){
                                        $prospects = DB::table('prospects')->where('commercial_id', $com->id)->pluck('pays_id')->toArray(); 
                                        $paysgn = DB::table('pays')->pluck('id')->toArray(); 
                                        $pays = DB::table('pays')->where('id', $entreprisesgn->pays_id)->pluck('id')->toArray(); 
                                        $result_pays = array_diff($paysgn, $prospects);
                                        $result_payss = array_diff($paysgn, $result_pays);
                                        
                                        foreach($result_payss as $result_pa){
                                        array_push($result_paysse,$result_pa);
                                        }
                                        }
                                        
                                        $pays_1 = DB::table('pays')->pluck('id')->toArray(); 
                                        $dif_1 = array_diff($pays_1, $result_paysse);
                                        $dif_2 = array_diff($pays_1, $dif_1);
                                        
                                    @endphp
                                       
                                    @foreach($dif_2 as $result_pay) 
                                        @php $pay = DB::table('pays')->where('id', $result_pay)->OrderBy('libelle')->first();  @endphp
                                        <option value="{{$pay->id}}">{{$pay->libelle}}</option>
                                    @endforeach
                                   
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="" type="submit">Filtrer</button>
                                </form> 
                            </div> 
                            <br>
                            @endif
             <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              	 @if($entreprise->isEmpty()) 
                 	  <p>Pas de prospect</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3">Entreprises</th>
                    <th class="px-4 py-3">Pays</th>
                    <th class="px-4 py-3">Nbre opportunités</th>
                    <th class="px-4 py-3">Secteur d'activité</th>
                    <th class="px-4 py-3">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($entreprise as $entreprises) 
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <td class="px-4 py-3 text-sm">
                        <!--<a href="{{ route('opportunite_prospect.lister',$entreprises->id) }}" >-->
                      {{ strtoupper(($entreprises->nom_entreprise) ? $entreprises->nom_entreprise : '')}}
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
                    @php $opportunite = DB::table('opportunites')->where('prospect_id', $entreprises->id)->where('archiver', 0)->count();
                         $secteur = DB::table('secteur_activites')->where('id', $entreprises->secteur_activite)->first();
                    @endphp
                    <td class="px-4 py-3 text-xs">
                    <a href="{{ route('opportunite_prospect.lister',$entreprises->id) }}" data-toggle="tooltip" title="Voir les opportunités">
                      <span
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        {{$opportunite}}
                      </span></a>
                    </td>
                    @if($secteur)
                    @if($secteur->id == 15)
                     <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$entreprises->autres}}">
                         {{ \Illuminate\Support\Str::limit(($entreprises->autres) ? $entreprises->autres : 'Non renseigné', 25, $end='...') }}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$secteur->libelle}}">
                      {{ \Illuminate\Support\Str::limit( ($secteur->libelle) ? $secteur->libelle : '-', 25, $end='...') }}
                    </td>
                    @endif
                    @else
                     <td class="px-4 py-3 text-sm" title="{{$entreprises->secteur_pros_a_appeler}}">
                     {{ \Illuminate\Support\Str::limit( ($entreprises->secteur_pros_a_appeler) ? $entreprises->secteur_pros_a_appeler : '--', 25, $end='...') }}
                    </td>
                    @endif
                    
                    <td class="px-4 py-3 text-sm">
                    <div style="display:flex ">
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
                         <span style="margin-left:3px; height:28px;"  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Mettre à jour le prospect">
                          <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('entreprise.edit', $entreprises->id)}}" >
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </a>
                        </span>
                    <span style="margin-left:3px; height:28px;" class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Supprimer le prospect">
                         <form action="{{ route('entreprise.destroy',$entreprises->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                              <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                            </svg>
                            </button>
                        
                        </form>
                    </span>
                    </div>
                    </td>
                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--  <input type="text" class="form-control" placeholder="+226 00 00 00 00" aria-label="Username"-->
                    <!--    aria-describedby="addon-wrapping">-->
                    <!--</td>-->
                  </tr>

                </tbody>
                @endforeach 
              </table>
            </div>
            
{{$entreprise->links()}}
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