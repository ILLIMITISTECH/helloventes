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
            <br><br>
                <a href="/prospect_stra">
                    <button style="width:150px"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                         Prospects stratégiques
                    </button> </a>
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Tous les prospects
          </h2>
          <div class="px-2 my-3" style="width:250px; margin-left:700px; margin-top:-60px">
             <button
              class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              <a href="/tous_les_pospects">Voir pour tous les prospects</a>
            </button>
          </div>
          <br>
          <br> <br>
        
                            <div style = "margin-left: 400px; margin-top:-50px" > 
                                 <form action="{{route('prospect_maTeamFiltre')}}" method="get" style="margsearchfin-top:5px; display:flex;">
                                    <select name="serachCom" style="width:220px;height:40px"  id="statut" style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par Commercial(e)</option>
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
                                      
                                
                                    <select name="serachPays" style="width:220px;height:40px; margin-left:10px;"  id="origine">
                                        <option value="" disabled selected>Rechercher par Pays</option>
                                        @php 
                                        $prospects = DB::table('prospects')->pluck('pays_id')->toArray(); 
                                         $pays = DB::table('pays')->pluck('id')->toArray(); 
                                         $result_paysF = array_diff($pays, $prospects);
                                         $result_payssF = array_diff($pays, $result_paysF);
                                         
                                        @endphp
                                    @foreach($result_payssF as $result_pay) 
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
              	 @if($entreprise->isEmpty()) 
                 	  <p>Pas de prospect</p>
					 @else
            <div class="w-full overflow-x-auto">
               
                
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr>
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
                @php 
                $prospect_total = DB::table('prospects')->count();
                                $opportunite_total = DB::table('opportunites')->where('archiver', 0)->count();
                                
                $opportunite = DB::table('opportunites')->where('prospect_id', $entreprises->id)->where('archiver', 0)->count(); 
                    @endphp
                @if($opportunite > 0)
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$entreprises->nom_entreprise}}">
                        <!--<a href="{{ route('opportunite_prospect.maTeam',$entreprises->id) }}" data-toggle="tooltip" title="Voir les opportunités">-->
                      <!--{{ ($entreprises->nom_entreprise) ? $entreprises->nom_entreprise : ''}}-->
                      <!--{{ ($entreprises->nom_entreprise) ? $entreprises->nom_entreprise : ''}}-->
                      {{ strtoupper(($entreprises->nom_entreprise) ? \Illuminate\Support\Str::limit($entreprises->nom_entreprise, 25, $end='...') : '')}}
                      <!--</a>-->
                    </td>
                    <td class="px-4 py-3 text-sm">
                      {{($entreprises->phone) ? $entreprises->phone : ''}}
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
                    
                    @php 
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
                 
                  </tr>
                @endif
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
                <div class="d-flex justify-content-center">
                    {!! $entreprise->links() !!}
                </div>
           
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