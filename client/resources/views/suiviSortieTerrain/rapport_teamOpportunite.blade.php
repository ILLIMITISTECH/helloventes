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
        <!--les formulaires-->
        <div class="container px-6 mx-auto grid">
            <img style="width:200px; " src="{{asset('Koyalis/hellovente3.png')}}" alt="logo"> <br>
            <h2 class="my-2 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Rapport <b style="color:#9045e2">d'opportunité</b> par commercial
          </h2>
          
                            <br>
         
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
        
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap" style="border: solid 1px black;">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3" style="border: solid 1px black;"></th>
                    <th class="px-4 py-3" style="border: solid 1px black;">Commercial Prénom</th>
                     <th class="px-4 py-3" style="border: solid 1px black;">Commercial Nom</th>
                    <th class="px-4 py-3" style="border: solid 1px black;">Nombre d'opportunités</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                   @foreach($opportunitesParCommercial as $opportunite)
                    @php $com = DB::table('commerciaus')->where('id', $opportunite->commercial_id)->whereNotIn('prenom', ['Axel', 'Mathilde', 'Boris', 'Kevin', 'Adja Fatou', 'Josué'])->first();  @endphp
                    @if($com)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                           </td>
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">{{ ($com->prenom) ? $com->prenom : '--' }}</td>
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">{{ ($com->nom) ? $com->nom : '--' }}</td>
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">{{ ($opportunite->nombre_opportunites) ? $opportunite->nombre_opportunites : '--' }}</td>
                    </tr>
                    @endif
                    @endforeach
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                           </td>
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;"><strong>Total</strong></td>
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;"></td>
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;"><strong>{{ ($opportunitesParCommercialSum) ? $opportunitesParCommercialSum : '--' }}</strong></td>
                    </tr>
                </tbody>
              </table>
            </div>
       
          
                
          </div>


  
        </div>
    
    
    <br>
  
   
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