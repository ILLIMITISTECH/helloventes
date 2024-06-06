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
                Mes objectifs
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
              	 @if($commerciau) 
                 	 
            <div class="w-full overflow-x-auto">
               
            <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3" style="text-align:center; width:100px;">Ventes</th>
                    <th class="px-4 py-3" style="text-align:center; width:100px;">Contacts</th>
                    <!--<th class="px-4 py-3" style="text-align:center; width:100px;">Démos</th>-->
                    <th class="px-4 py-3" style="text-align:center; width:100px;">Rendez-vous</th>
                    <th class="px-4 py-3" style="text-align:center; width:100px;">Appels</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
               
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <td style="text-align:center; width:100px;" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        
                      {{($commerciau->objectif_mois) ? number_format($commerciau->objectif_mois) : 'pas renseigné'}}
                     
                    </td>
                    
                    <td class="px-4 py-3 text-sm" style="text-align:center; width:100px;">
                        
                      {{($commerciau->nbre_contact) ? $commerciau->nbre_contact : ''}}
                     
                    </td>
                    
                    <!--<td style="text-align:center; width:100px;" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        
                      {{($commerciau->nbre_demo) ? $commerciau->nbre_demo : ''}}
                     
                    </td>-->
                    
                    <td style="text-align:center; width:100px;"  class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        
                      {{($commerciau->objectif_visite) ? $commerciau->objectif_visite : ''}}
                     
                    </td>
                    
                    <td style="text-align:center; width:100px;" class="px-4 py-3 text-sm">
                        
                      {{($commerciau->nbre_appel_quotidien) ? $commerciau->nbre_appel_quotidien : ''}}
                     
                    </td>
                    
                   
            
                   
                   
                    
                    
                    
                   
                  </tr>

                </tbody>
                
              </table>
             </div>
            
     
             @else
             
 <p>Pas d'objectifs</p>
					
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