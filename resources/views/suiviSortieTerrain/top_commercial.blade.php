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
            Objectifs 
          </h2>
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              	 @if($commerciau == null) 
                 	  <p>Pas de commercial</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3">Commercial</th>
                    <th class="px-4 py-3">Mois / Année</th>
                    <th class="px-4 py-3">CA. attendu</th>
                    <th class="px-4 py-3">%Com</th>
                    <th class="px-4 py-3">%Performance</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                     @php
                    $semaineM7 = (date('d') -7);
                    $action_semaineP7 = (date('d') +7);
                    $action_mois = date('m');
                 @endphp
                 
               
                    @php 
                       setlocale(LC_TIME, 'fr_FR'); 
                       $stock_mensuelles = DB::table('stock_mensuelles')->where('commercial_id', $commerciau->id)->get();
                    @endphp
                @foreach($stock_mensuelles as $stock_mensuelle)
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <td class="px-4 py-3">

                      <div class="flex items-center text-sm">
                       
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                          <img class="object-cover w-full h-full rounded-full"
                            src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                            alt="" loading="lazy" />
                          <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                        <div class="btn btn-primary btn-lg btn-block font-semibold">
                          {{($commerciau->prenom) ? $commerciau->prenom : '-'}} {{ ($commerciau->nom) ? $commerciau->nom : '-'}} 
                          
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                       {{strftime('%B', strtotime($stock_mensuelle->created_at))}} /  {{date('Y', strtotime($stock_mensuelle->created_at))}}
                     
                      
                    </td>
                    
                   
                     <td class="px-4 py-3 text-sm">
                    <span
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        {{($stock_mensuelle->objectif_mois) ? $stock_mensuelle->objectif_mois : 0}}
                      </span>
                    </td>
                    
                     <td class="px-4 py-3 text-sm">
                      {{($stock_mensuelle->commission_p) ? $stock_mensuelle->commission_p : '00'}}%
                    </td>
                    
                     <td class="px-4 py-3 text-sm">
                    <span
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        {{intval($stock_mensuelle->pourcentage)}}%
                      </span>
                    </td>
                   
               
                  </tr>

                </tbody>
                @endforeach 
               
              </table>
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