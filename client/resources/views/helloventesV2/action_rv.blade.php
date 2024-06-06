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
            Toutes les actions du RDV 
          </h2>

                             <br>
             <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              	 @if($action->isEmpty()) 
                 	  <p>Pas d'actions disponibles</p>
					 @else
            <div class="w-full overflow-x-auto">
               
            
        <div class="w-full overflow-x-auto">    
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Commerciaux</th>
                    <th class="px-4 py-3">Entreprises</th>
                    <th class="px-4 py-3">Libellé</th>
                    <th class="px-4 py-3">Deadline</th>
                    <th class="px-4 py-3">Statut</th>
                    <!--<th class="px-4 py-3">Options</th>-->
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($action as $actions) 
                  <tr class="text-gray-700 dark:text-gray-400">
                    @php $pros = DB::table('prospects')->where('id', $actions->prospect_id)->first();
                        $com = DB::table('commerciaus')->where('id', $actions->commercial_id)->first();
                    @endphp
                    
                    @if($com)
                    <td class="px-4 py-3 text-sm">
                      {{($com->prenom) ? $com->prenom : ''}} {{($com->nom) ? $com->nom : ''}}
                    </td>
                     @else
                    <td class="px-4 py-3 text-sm"></td>
                    @endif
                    
                    @if($pros)
                    <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$pros->nom_entreprise}}">
                         {{ \Illuminate\Support\Str::limit(($pros->nom_entreprise) ? $pros->nom_entreprise : 'Non renseigné', 20, $end='...') }}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm"></td>
                    @endif
                    <td class="px-4 py-3 text-sm">
                      {{($actions->libelle) ? $actions->libelle : ''}}
                    </td>
                    <td class="px-4 py-3 text-sm">
                    <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        {{($actions->deadline) ? $actions->deadline : '--'}}
                      </span>
                     </td>
                    <td class="text-gray-700 dark:text-gray-400">
                      @if($actions->cloture == 0)
                      <p style="color:orange"> En cours </p>
                      @else
                      <p style="color:green"> Terminée </p>
                      @endif
                    </td>
                    
                      
                   
                  </tr>

                </tbody>
                @endforeach 
              </table>
            </div>
            
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