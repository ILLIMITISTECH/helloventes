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
    
    
    
    <div class="container">
      @include('v2.header_dg')
      <main class="h-full pb-16 overflow-y-auto">

        <!--les formulaires-->
      
        <div class="container px-6 mx-auto grid">
            <br>
                                        
            <div>
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Tous les besoins
          </h2>
                   @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif                     
          <div class="container" >
            
            <div class="container">
              <table >
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3">Prénom / Nom </th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">N° téléphone</th>
                    <th class="px-4 py-3">Entreprise</th>
                    <th class="px-4 py-3">Secteur d'activite</th>
                    <th class="px-4 py-3">Pays</th>
                    <th class="px-4 py-3">Attentes particulières</th>
                    <!--<th class="px-4 py-3">Options</th>-->
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
             
                  <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">

                      <div class="flex items-center text-sm">
                       
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                          <img class="object-cover w-full h-full rounded-full"
                            src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                            alt="" loading="lazy" />
                          <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                        <div>
                          <button type="button" class="btn btn-primary btn-lg btn-block font-semibold dark:text-gray-400"><a
                              href="../public/Opportunite.html">{{strtoupper(($besoins->prenom) ? $besoins->prenom : '-')}} {{ strtoupper(($besoins->nom) ? $besoins->nom : '-')}} 
                          </button>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      {{ ($besoins->email) ? $besoins->email : '-'}} 
                    </td>
                     <td class="px-4 py-3 text-sm">
                      {{ ($besoins->phone) ? $besoins->phone : ''}}
                    </td>
                    
                    <td class="px-4 py-3 text-sm">
                      {{ ($besoins->entreprise) ? $besoins->entreprise : '-'}} 
                    </td>
                    
                    @php $secteur = DB::table('secteur_activites')->where('id', $besoins->secteur_activite)->first(); @endphp
                    @php $pays = DB::table('pays')->where('id', $besoins->pays_id)->first(); @endphp
                    @if($secteur)
                     <td class="px-4 py-3 text-sm">
                      {{ ($secteur->libelle) ? $secteur->libelle : '-'}}
                    </td>
                     @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    @if($pays)
                    <td class="px-4 py-3 text-xs">
                    <a href="">
                      <span
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                         {{ ($pays->libelle) ? $pays->libelle : '-'}} 
                      </span></a>
                    </td>
                     @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    
                    <td class="px-4 py-3 text-sm">
                      {{ ($besoins->attente_particuliere) ? $besoins->attente_particuliere : '-'}} 
                    </td>
                   
                    
                  </tr>

                </tbody>
              
              </table>
            </div>
           
          
          </div>
          
          
          
          
          
          <br>
          
            <div class="container" >
            
            <div class="container">
              <table >
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3">Nombre de commerciaux</th>
                    <th class="px-4 py-3">Version</th>
                    @if($besoins->quand_recontacter)
                    <th class="px-4 py-3">Date pour recontacter</th>
                    @endif
                    <th class="px-4 py-3">Connaissance de HELLOVENTES</th>
                    
                    <!--<th class="px-4 py-3">Options</th>-->
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
             
                  <tr class="text-gray-700 dark:text-gray-400">
                    
                    <td class="px-4 py-3 text-sm">
                      {{ ($besoins->nbre_commerciaux) ? $besoins->nbre_commerciaux : '-'}} 
                    </td>
                     <td class="px-4 py-3 text-sm">
                      {{ ($besoins->version_besoin) ? $besoins->version_besoin : ''}}
                    </td>
                    @if($besoins->quand_recontacter)
                    <td class="px-4 py-3 text-sm">
                      {{ ($besoins->quand_recontacter) ? $besoins->quand_recontacter : '-'}} 
                    </td>
                    @endif
                 
                    <td class="px-4 py-3 text-sm">
                      {{ ($besoins->connaissance_pateforme) ? $besoins->connaissance_pateforme : '-'}} 
                    </td>
                   
                    
                  </tr>

                </tbody>
              
              </table>
            </div>
           
          
          </div>
           
           </div>
          


  
  
  <!----------------------------------------------------------------------cette semaine------------------------------------------------------->
   
   
  

  
   
   
  
        </div>
    </div>
    
    
    <!-----------------------------------------------------------------------contact de ce mois---------------------------------------------------------------->
    
    

    
    
    </main>
  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/init-alpine.js')}}"></script>
  <script src="{{asset('Koyalis/public/https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js')}}" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/charts-lines.js')}}" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/charts-pie.js')}}" defer></script>
               <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <script>
            $("#ceMois").hide();
            $("#tout").hide();
            </script>
      
</body>

</html>