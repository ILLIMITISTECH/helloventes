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
            Rapport prospects 
          </h2>
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              	 
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3">Commerciaux</th>
                    <th class="px-4 py-3">Nbre prospects</th>
                    <th class="px-4 py-3">Nbre prospects sans opportunités</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                   
                @foreach($commerciau as $commerciaux)
                @php 
                
                    $pros_op = DB::table('opportunites')->where('commercial_id', $commerciaux->id)->where('archiver', 0)->pluck('prospect_id')->toArray(); 
                    
                    $prospecte = DB::table('prospects')->where('commercial_id', $commerciaux->id)->pluck('id')->toArray();
                    
                    $results = array_diff($prospecte, $pros_op);
                   
                    $prospect = DB::table('prospects')->where('commercial_id', $commerciaux->id)->count();  
                    
                    
                     $me = DB::table('commerciaus')->where('user_id', auth::user()->id)->first();
                    $prospect_total = DB::table('prospects')->where('superieur_id', $me->id)->count();
                    $pros_op_total = DB::table('opportunites')->where('superieur_id', $me->id)->where('archiver', 0)->pluck('prospect_id')->toArray(); 
                    
                    $prospecte_total = DB::table('prospects')->where('superieur_id', $me->id)->pluck('id')->toArray();
                    
                    $results_total = array_diff($prospecte_total, $pros_op_total);
                @endphp
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                   <td class="px-4 py-3 text-sm">
                       {{$commerciaux->prenom}} {{$commerciaux->nom}}
                     
                    </td>
                   
                     <td class="px-4 py-3 text-sm">
                         <a href="{{route('pros_rapport.lister', $commerciaux->id)}}" data-toggle="tooltip" title="Voir les prospects">
                    <span
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                       {{$prospect}}
                      </span>
                      <!--</a>-->
                    </td>
                    
                     <td class="px-4 py-3 text-sm">
                         <a href="{{route('pros_rapport_sannsOp.lister', $commerciaux->id)}}" data-toggle="tooltip" title="Voir les prospects sans opportunité">
                      <span
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                       {{count($results)}}
                      </span>
                      <!--</a>-->
                    </td>
                    
                   
               
                  </tr>

                </tbody>
                @endforeach 
                   <tr class="text-gray-700 dark:text-gray-400">
                   
                    <td class="px-4 py-3">

                      <div >
                          <b>TOTAL</b>
                    
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      <span style="color:0063ed; background-color:#0093a2"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        {{$prospect_total}}
                      </span>
                    </td>
                    
                    <td class="px-4 py-3 text-xs">
                      <span style="color:0063ed; background-color:#0093a2"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        {{count($results_total)}}
                      </span>
                    </td>
                    
                  
                  </tr>
              </table>
            </div>
       
          
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