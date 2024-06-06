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
              @if($besoins->isEmpty()) 
                 	  <p class="dark:text-gray-400">Pas de besoins</p>
					 @else
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
                    <!--<th class="px-4 py-3">Attentes particulières</th>-->
                    <th class="px-4 py-3">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($besoins as $besoin) 
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
                              href="../public/Opportunite.html">{{strtoupper(($besoin->prenom) ? $besoin->prenom : '-')}} {{ strtoupper(($besoin->nom) ? $besoin->nom : '-')}} 
                          </button>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      {{ ($besoin->email) ? $besoin->email : '-'}} 
                    </td>
                     <td class="px-4 py-3 text-sm">
                      {{ ($besoin->phone) ? $besoin->phone : ''}}
                    </td>
                    
                    <td class="px-4 py-3 text-sm">
                      {{ ($besoin->entreprise) ? $besoin->entreprise : '-'}} 
                    </td>
                    
                    @php $secteur = DB::table('secteur_activites')->where('id', $besoin->secteur_activite)->first(); @endphp
                    @php $pays = DB::table('pays')->where('id', $besoin->pays_id)->first(); @endphp
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
                    
                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--  {{ ($besoin->attente_particuliere) ? $besoin->attente_particuliere : '-'}} -->
                    <!--</td>-->
                   
                    <td class="px-4 py-3 text-sm">
                        <div style="display:flex ">
                      <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Voir plus">
                      <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('voir_plus.formulaire', $besoin->id)}}" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
</svg>
                        </a>
                    </span>
                    <span
                            class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" >
                            <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"
                                href="{{route('cloturer_formulaire', $besoin->id )}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-all" viewBox="0 0 16 16">
  <path d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992a.252.252 0 0 1 .02-.022zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486-.943 1.179z"/>
</svg>
                            </a>
                        </span>
                        </div>
                    </td>
                  </tr>

                </tbody>
                @endforeach 
              </table>
            </div>
           
            @endif
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