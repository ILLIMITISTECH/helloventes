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
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Mes historiques de statut
          </h2>
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3">Opportunités</th>
                    <th class="px-4 py-3">Statut</th>
                    <th class="px-4 py-3">Date statut</th>
                    <th class="px-4 py-3">Date modifiée</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($opportunite as $opportunites) 
                @php $historiques = DB::table('historiques')->where('opportunite_id', $opportunites->id)->get(); @endphp
                @foreach($historiques as $historique) 
                @php $op = DB::table('opportunites')->where('id', $historique->opportunite_id)->first(); 
                    $statut = DB::table('statut_opportunites')->where('id', $historique->statut)->first();
                @endphp
                  <tr class="text-gray-700 dark:text-gray-400">
                   @if($op)
                    <td class="px-4 py-3 text-sm">
                      {{ ($op->libelle) ? $op->libelle : ''}} 
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    
                    @if($statut)
                    <td class="px-4 py-3 text-sm">
                      {{ ($statut->libelle) ? $statut->libelle : ''}} 
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    
                    <td class="px-4 py-3 text-sm">
                      {{ date('d/m/Y', strtotime(($historique->date_ajouter))) ? date('d/m/Y', strtotime($historique->date_ajouter)) : '-'}} 
                    </td>
                    <td class="px-4 py-3 text-sm">
                      {{ date('d/m/Y', strtotime(($historique->date_modifier))) ? date('d/m/Y', strtotime($historique->date_modifier)) : '-'}} 
                    </td>

                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--  <input type="text" class="form-control" placeholder="+226 00 00 00 00" aria-label="Username"-->
                    <!--    aria-describedby="addon-wrapping">-->
                    <!--</td>-->
                  </tr>

                </tbody>
                @endforeach
                @endforeach
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