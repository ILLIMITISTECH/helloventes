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
       
 <div>
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
              
            Liste de mes échéances critiques
          </h2>
          <div class="px-6 my-6" style="width:150px; margin-left:920px; margin-top:-60px">
             <button
              class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              <a href="/opportunites">Retour</a>
            </button>
          </div>
          </div>
             <br>
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              	 @if($opportunite->isEmpty()) 
                 	  <p>Pas d'opportunité</p>
					 @else
					 
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
               
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-1 py-3">Commercial</th>
                    <th class="px-4 py-3">Libellé</th>
                    <th class="px-1 py-3">Prospect</th>
                    <th class="px-1 py-3">Objectifs vente</th>
                    <th class="px-1 py-3">Statut</th>
                    <th class="px-1 py-3">Deadline</th>

                  </tr>
                </thead>
                 @php
                    $semaineM7 = (date('d') -7);
                    $action_semaineP7 = (date('d') +7);
                    $action_mois = date('m');
                 @endphp
                @php 
                    $opportunite_critique = DB::table('opportunites')->where('archiver', 0 )->whereIn('origine_id', [1,2] )->OrderBy('created_at', 'desc')->paginate();
                @endphp
                
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($opportunite_critique as $opportunite_critiques)
                            @php $deadline = date('Y-m-d'); $prospect = DB::table('prospects')->where('id', $opportunite_critiques->prospect_id)->first();
                                $commercial = DB::table('commerciaus')->where('id', $opportunite_critiques->commercial_id)->first();
                            @endphp
               @if(($action_semaineP7 >= date('d', strtotime($opportunite_critiques->deadline))) && ($semaineM7 <= date('d', strtotime($opportunite_critiques->deadline))) && ($action_mois == date('m', strtotime($opportunite_critiques->deadline))))

                @if($opportunite_critiques->deadline > $deadline )
                  <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3 text-sm">
                      {{($commercial->prenom)}} {{($commercial->nom)}}
                    </td>
                    <td class="px-4 py-3" data-toggle="tooltip" title="Voir les détails">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                        <a href="{{ route('detail_op',$opportunite_critiques->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunite_critiques->libelle, 25, $end='...') }}</h4>
                            </button>
                          </div></a>
                        <!--</div>-->
                    </td>
                    @if($prospect)
                    <td class="px-4 py-3 text-sm">
                      {{ ($prospect->nom_entreprise) ? $prospect->nom_entreprise : ''}}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    <td class="px-1 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        {{(number_format($opportunite_critiques->objectif_de_vente)) ? number_format($opportunite_critiques->objectif_de_vente) : ''}} f
                      </span>
                    </td>
                     @php $statut = DB::table('statut_opportunites')->where('id', $opportunite_critiques->statut)->first(); @endphp
                    @php $statut = DB::table('statut_opportunites')->where('id', $opportunite_critiques->statut)->first(); @endphp
                    @if($statut)
                    <td class="px-1 py-3 text-sm">
                      <button
                        class="px-1 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                          {{($statut->libelle) ? $statut->libelle : ''}}
                    </button>
                    </td>
                    @else
                    <td class="px-1 py-3 text-sm">
                      -
                    </td>
                    @endif
                    <td class="px-1 py-3 text-xs">
                      <span class="px-1 py-1 text-sm ">
                        {{($opportunite_critiques->deadline) ? $opportunite_critiques->deadline : '-'}}
                      </span>
                    </td>
                    
                    
                    </tr>
                  @endif
                    @endif
                     </tbody>
                    @endforeach
               
              </table>
            </div>
         
          {{$opportunite->links()}}
             @endif
          </div>



<!------------------------------------------------------echeances critiques------------------------------------------------------->
<br><br>
     <div>
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
              
            Liste des appels d'offres dûs
          </h2>
         
          </div>
          
                    <br>
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              	 @if($opportunite->isEmpty()) 
                 	  <p>Pas d'opportunité</p>
					 @else
					 
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
               
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-1 py-3">Commercial</th>
                    <th class="px-4 py-3">Libellé</th>
                    <th class="px-1 py-3">Prospect</th>
                    <th class="px-1 py-3">Objectifs vente</th>
                    <th class="px-1 py-3">Statut</th>
                    <th class="px-1 py-3">Deadline</th>

                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($opportunite as $opportunites)
                @php $deadline = date('Y-m-d'); $prospect = DB::table('prospects')->where('id', $opportunites->prospect_id)->first();
                    $commercial = DB::table('commerciaus')->where('id', $opportunites->commercial_id)->first();
                @endphp
               
                @if($opportunites->deadline > $deadline )
                  <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3 text-sm">
                      {{($commercial->prenom)}} {{($commercial->nom)}}
                    </td>
                    <td class="px-4 py-3" data-toggle="tooltip" title="Voir les détails">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                        <a href="{{ route('detail_op',$opportunites->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunites->libelle, 25, $end='...') }}</h4>
                            </button>
                          </div></a>
                        <!--</div>-->
                    </td>
                    @if($prospect)
                    <td class="px-4 py-3 text-sm">
                      {{ ($prospect->nom_entreprise) ? $prospect->nom_entreprise : ''}}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    <td class="px-1 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        {{(number_format($opportunites->objectif_de_vente)) ? number_format($opportunites->objectif_de_vente) : ''}} Fcfa
                      </span>
                    </td>
                     @php $statut = DB::table('statut_opportunites')->where('id', $opportunites->statut)->first(); @endphp
                    @php $statut = DB::table('statut_opportunites')->where('id', $opportunites->statut)->first(); @endphp
                    @if($statut)
                    <td class="px-1 py-3 text-sm">
                      <button
                        class="px-1 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                          {{($statut->libelle) ? $statut->libelle : ''}}
                    </button>
                    </td>
                    @else
                    <td class="px-1 py-3 text-sm">
                      -
                    </td>
                    @endif
                    <td class="px-1 py-3 text-xs">
                      <span class="px-1 py-1 text-sm ">
                        {{($opportunites->deadline) ? $opportunites->deadline : '-'}}
                      </span>
                    </td>
                    
                    
                    </tr>
                  
                    @endif
                     </tbody>
                    @endforeach
               
              </table>
            </div>
         
          {{$opportunite->links()}}
             @endif
          </div>

<!-----------------------------------------------------------------end-------------------------------------------------------------->
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