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
              
            Liste des Opportunités de {{$commerciaux->prenom}}
          </h2>
           <br>
                            <br>
                            <div style = "margin-left: 400px; margin-top:-50px" align="right"> 
                                 <form action="{{route('search_statut_maTamIndividuel', $commerciaux->id)}}" method="get" style="">
                                    <select name="search" style="width:220px;height:40px"  id="statut">
                                        <option value="" disabled selected>Rechercher par statut</option>
                                      
                                        @php $staut = DB::table('statut_opportunites')->OrderBy('libelle')->get();  @endphp
                                        @foreach($staut as $stauts)
                                        <option value="{{$stauts->id}}">{{$stauts->libelle}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/opportunite_com/maTeam/$commerciaux->id';" value >Toutes les opportunités</option>-->
                                    </select>
                                      
                                
                                    <select name="searchOr" style="width:220px;height:40px"  id="origine" style="margin-left:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par Origine</option>
                                      
                                        @php $origines = DB::table('origines')->OrderBy('libelle')->get();  @endphp
                                        @foreach($origines as $origine)
                                        <option value="{{$origine->id}}">{{$origine->libelle}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/opportunite_com/maTeam/$commerciaux->id';" value >Toutes les opportunités</option>-->
                                    </select>
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-left:5px;" type="submit">Filtrer</button>
                                </form> 
                            </div> 
                            <br>
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              	 @if($opportunite->isEmpty()) 
                 	  <p>Pas d'opportunité pour ce commercial</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Libellé</th>
                    <!--<th class="px-4 py-3">Entreprises</th>-->
                    <th class="px-4 py-3">Objectifs vente</th>
                    <th class="px-4 py-3">Statut</th>
                    <th class="px-4 py-3">Options</th>

                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
              
                @foreach($opportunite as $opportunites)
                  <tr class="text-gray-700 dark:text-gray-400">

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
                    
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        {{(number_format($opportunites->objectif_de_vente)) ? number_format($opportunites->objectif_de_vente) : ''}} Fcfa
                      </span>
                    </td>
                     @php $statut = DB::table('statut_opportunites')->where('id', $opportunites->statut)->first(); @endphp
                   @if($statut)
                    <td class="px-4 py-3 text-sm">
                    <button
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                          {{$statut->libelle}}
                    </button>
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    
                     <td class="px-4 py-3 text-sm">
                     <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Voir les détails">
                      <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{ route('detail_op',$opportunites->id) }}" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                          <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                          <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                        </svg>
                        </a>
                    </span>
                     <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Modifier le responsable de l'opportunité">
                      <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('op_maTeam.edit', $opportunites->id)}}" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                        </a>
                    </span>
                    </td>
                    </tr>
                     </tbody>
                    @endforeach
               
              </table>
            </div>
           
           {{$opportunite->links()}}
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