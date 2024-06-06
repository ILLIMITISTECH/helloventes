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
            Rendez-vous de la semaine des commerciaux
          </h2>
          @php $commerciaux = DB::table('commerciaus')->get();   $pays_comms = DB::table('pays')->whereIn('id', ['1', '5', '13'])->get();  @endphp
                            <div  class="col-md-3" style = "margin-top:5px" align="right" >
                                 <form action="{{route('planningsFiltre')}}" method="get" >
                                    <select name="commercialFiltre" style="width:220px;height:40px"  style="margin-right:10px; display:flex;" >
                                        <option value="" disabled selected>Rechercher par commerciaux</option>
                                       @foreach($commerciaux as $commerciauxss)
                                        <option value="{{$commerciauxss->id}}">{{$commerciauxss->prenom}} {{$commerciauxss->nom}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                    
                                    <select name="PayscommercialFiltre" style="width:220px;height:40px"  style="margin-right:10px; display:flex;" >
                                        <option value="" disabled selected>Rechercher par pays</option>
                                       @foreach($pays_comms as $pays_comm)
                                        <option value="{{$pays_comm->id}}">{{$pays_comm->libelle}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="" type="submit">Filtrer</button>
                                </form> 
                            </div>
                            
                            <br>
          
                    <div class="raison" align="right">
                            <a href="/planningsMois" style="width:100px; margin-left : -20px;"
                                class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                RV du mois
                            </a>
                            <a href="/dg_raison" style="width:100px;"
                                class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Sorties terrain raisons
                            </a>
                              <span style="margin-left:3px; height:28px;"  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Importer">
                            <a href="{{route('export-plannings')}}">
                        Exporter
                    </a>
                      </span>
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
@if($planning == null)
                 	  <p>Pas de rendez-vous</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Commerciaux</th>
                    <!--<th class="px-4 py-3">Libelle</th>-->
                    <th class="px-4 py-3">Entreprises</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Heure</th>
                    <th class="px-4 py-3">pays</th>
                    <th class="px-4 py-3">statut</th>
                    <!--<th class="px-4 py-3">Options</th>-->
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($planning as $plannings) 
                    @php 
                     $comm = DB::table('commerciaus')->where('id', $plannings->commercial_id)->first();
                     $pros = DB::table('prospects')->where('id', $plannings->prospect_id)->first(); 
                     $pay = DB::table('pays')->where('id', $plannings->pays_id)->first(); 
                    @endphp
                    @if($pros)
                  <tr class="text-gray-700 dark:text-gray-400">
                      @if($comm)
                   <td class="px-4 py-3 text-sm">
                      {{ ($comm->prenom) ? $comm->prenom : ''}} {{ ($comm->nom) ? $comm->nom : ''}}
                    </td>
                    @else
                     <td class="px-4 py-3 text-sm">
                      non renseigné
                      <!--</a>-->
                    </td>
                    @endif
                    <!--<td class="px-4 py-3 text-sm"  data-toggle="tooltip" title="{{$plannings->libelle}}">-->
                    <!--  {{ ($plannings->libelle) ?  \Illuminate\Support\Str::limit($plannings->libelle, 25, $end='...')  : 'non renseigné'}}-->
                    <!--</td>-->
                    @if($pros)
                    <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$pros->nom_entreprise}}">
                      {{ strtoupper(($pros->nom_entreprise) ? \Illuminate\Support\Str::limit($pros->nom_entreprise, 30, $end='...')  : '')}}
                      <!--</a>-->
                    </td>
                    @else
                     <td class="px-4 py-3 text-sm">
                      non renseigné
                      <!--</a>-->
                    </td>
                    @endif
                    <td class="px-4 py-3 text-sm">
                      <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        {{ ($plannings->date) ? $plannings->date : ''}} 
                      </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      {{ ($plannings->heure_debut) ? $plannings->heure_debut : ''}}
                    </td>
                    @if($pay)
                    <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$pay->libelle}}">
                      {{ strtoupper(($pay->libelle) ? \Illuminate\Support\Str::limit($pay->libelle, 30, $end='...')  : '')}}
                      <!--</a>-->
                    </td>
                    @else
                     <td class="px-4 py-3 text-sm">
                      non renseigné
                      <!--</a>-->
                    </td>
                    @endif
                    <td class="px-4 py-3 text-sm">
                      @if($plannings->statut == 1)
                      <p style="color:green"> Fait </p>
                      @else
                      <p style="color:orange"> En cours.. </p>
                      @endif
                    </td>
                    
                  </tr>
@endif
                </tbody>
                @endforeach 
              </table>
            </div>
            
                 @endif
          
          </div>
          <!------------------------------------------------------------------------------------>
          <br> 
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Rendez-vous à venir des commerciaux
          </h2>
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
@if($planning_avenir == null)
                 	  <p>Pas de rendez-vous à venir</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Commerciaux</th>
                    <!--<th class="px-4 py-3">Libelle</th>-->
                    <th class="px-4 py-3">Entreprises</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Heure</th>
                    <th class="px-4 py-3">statut</th>
                    <!--<th class="px-4 py-3">Options</th>-->
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($planning_avenir as $plannings_avenir) 
                    @php 
                     $comm = DB::table('commerciaus')->where('id', $plannings_avenir->commercial_id)->first();
                     $pros = DB::table('prospects')->where('id', $plannings_avenir->prospect_id)->first(); 
                    @endphp
                    @if($pros)
                  <tr class="text-gray-700 dark:text-gray-400">
                      @if($comm)
                   <td class="px-4 py-3 text-sm">
                      {{ ($comm->prenom) ? $comm->prenom : ''}} {{ ($comm->nom) ? $comm->nom : ''}}
                    </td>
                    @else
                     <td class="px-4 py-3 text-sm">
                      non renseigné
                      <!--</a>-->
                    </td>
                    @endif
                    <!--<td class="px-4 py-3 text-sm"  data-toggle="tooltip" title="{{$plannings_avenir->libelle}}">-->
                    <!--  {{ ($plannings_avenir->libelle) ?  \Illuminate\Support\Str::limit($plannings_avenir->libelle, 25, $end='...')  : 'non renseigné'}}-->
                    <!--</td>-->
                    @if($pros)
                    <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$pros->nom_entreprise}}">
                      {{ strtoupper(($pros->nom_entreprise) ? \Illuminate\Support\Str::limit($pros->nom_entreprise, 30, $end='...')  : '')}}
                      <!--</a>-->
                    </td>
                    @else
                     <td class="px-4 py-3 text-sm">
                      non renseigné
                      <!--</a>-->
                    </td>
                    @endif
                    <td class="px-4 py-3 text-sm">
                      <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        {{ ($plannings_avenir->date) ? $plannings_avenir->date : ''}} 
                      </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      {{ ($plannings_avenir->heure_debut) ? $plannings_avenir->heure_debut : ''}}
                    </td>
                    <td class="px-4 py-3 text-sm">
                      @if($plannings_avenir->statut == 1)
                      <p style="color:green"> Fait </p>
                      @else
                      <p style="color:orange"> En cours.. </p>
                      @endif
                    </td>
                    
                  </tr>
@endif
                </tbody>
                @endforeach 
              </table>
            </div>
<!---------------------------------------------------------------------------->
                 
                 @endif
          </div>
   <style>
  .pagination {
    list-style: none;
    padding-left: 450px;
    margin: 0;
    display: flex;
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