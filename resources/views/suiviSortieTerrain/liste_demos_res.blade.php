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
            @if(Auth::user()->nom_role == "responsable")
            <div  class="col-md-3" style = "margin-top:5px" align="right" >
                                 <form action="{{route('filtrer_liste_demos')}}" method="get" >
                                    <select name="searchCommerciaucf" style="width:220px;height:40px"  style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par commerciaux</option>
                                        @php 
                                        $commerciauxs = DB::table('commerciaus')->where('superieur_id', $moi->id)->OrderBy('prenom')->pluck('id')->toArray();
                                        $demo = DB::table('demos')->pluck('commercial_id')->toArray();
                                        
                                        $result_comerP = array_diff($commerciauxs, $demo);
                                        $result_comersss = array_diff($commerciauxs, $result_comerP);
                                        
                                        @endphp
                                        
                                        
                                       @foreach($result_comersss as $result_comer)
                                        @php $commerciales = DB::table('commerciaus')->where('id', $result_comer)->first();  @endphp
                                         @if($commerciales)
                                        <option value="{{$commerciales->id}}">{{$commerciales->prenom}} {{$commerciales->nom}}</option>
                                        @endif
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="" type="submit">Filtrer</button>
                                </form> 
                            </div>
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Les  démos de ce mois
          </h2>
           
                            @if($demos->isEmpty()) 
                 	        <p></p>
					        @else
                                <div style = "margin-top:-50px" align="right"> 
                                 
                            </div> 
                            <br>
                            @endif
             <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              	 @if($demos->isEmpty()) 
                 	  <p>Pas de Démos</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Commercial</th>
                    <th class="px-4 py-3">Entreprises</th>
                    <th class="px-4 py-3">Opportunités</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Personnes</th>
                    <th class="px-4 py-3">Commentaires</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($demos as $demoss) 
                  <tr class="text-gray-700 dark:text-gray-400">
                      
                       @php $commer = DB::table('commerciaus')->where('id', $demoss->commercial_id)->first(); @endphp
                     @if($commer)
                    <td class="px-4 py-3 text-sm">
                      {{ strtoupper(($commer->prenom) ? $commer->prenom : '')}} {{ strtoupper(($commer->nom) ? $commer->nom : '')}}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      pas de commercial
                    </td>
                    @endif
                   
                    @php $prospect = DB::table('prospects')->where('id', $demoss->prospect_id)->first(); @endphp
                     @if($prospect)
                    <td class="px-4 py-3 text-sm">
                      {{ strtoupper(($prospect->nom_entreprise) ? $prospect->nom_entreprise : '')}}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      pas de prospect
                    </td>
                    @endif
                    
                    @php $opportunite = DB::table('opportunites')->where('id', $demoss->opportunite_id)->first();
                    @endphp
                     @if($opportunite)
                    <td class="px-4 py-3 text-sm">
                      {{ strtoupper(($opportunite->libelle) ? $opportunite->libelle : '')}}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      pas d'opportunités
                    </td>
                    @endif
                    
                     <td class="px-4 py-3 text-sm">
                    {{date('d/m/Y', strtotime($demoss->date))}}
                    </td>
                    <td class="px-4 py-3 text-sm">
                    {{($demoss->personne) ? $demoss->personne : '--'}}
                    </td>
                   
                    <td class="px-4 py-3 text-sm">
                    {{($demoss->commentaire) ? $demoss->commentaire : '--'}}
                    </td>
                    
                  </tr>

                </tbody>
                @endforeach 
              </table>
            </div>
            
{{$demos->links()}}
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
        
        <!----------------------------------------------------respon pole-------------------------------------------------------->
        @elseif(Auth::user()->nom_role == "responsable_pole")
        <div  class="col-md-3" style = "margin-top:5px" align="right" >
                                 <form action="{{route('filtrer_liste_demos')}}" method="get" >
                                    <select name="searchCommerciaucf" style="width:220px;height:40px"  style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par commerciaux</option>
                                        @php 
                                        $commerciauxs = DB::table('commerciaus')->where('domaine_id', $moi->domaine_id)->OrderBy('prenom')->pluck('id')->toArray();
                                        $demo = DB::table('demos')->pluck('commercial_id')->toArray();
                                        
                                        $result_comerP = array_diff($commerciauxs, $demo);
                                        $result_comersss = array_diff($commerciauxs, $result_comerP);
                                        
                                        @endphp
                                        
                                        
                                       @foreach($result_comersss as $result_comer)
                                        @php $commerciales = DB::table('commerciaus')->where('id', $result_comer)->first();  @endphp
                                         @if($commerciales)
                                        <option value="{{$commerciales->id}}">{{$commerciales->prenom}} {{$commerciales->nom}}</option>
                                        @endif
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="" type="submit">Filtrer</button>
                                </form> 
                            </div>
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Les  démos de ce mois
          </h2>
           
                            @if($demos_pole->isEmpty()) 
                 	        <p></p>
					        @else
                                <div style = "margin-top:-50px" align="right"> 
                                 
                            </div> 
                            <br>
                            @endif
             <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              	 @if($demos_pole->isEmpty()) 
                 	  <p>Pas de Démos</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Commercial</th>
                    <th class="px-4 py-3">Entreprises</th>
                    <th class="px-4 py-3">Opportunités</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Personnes</th>
                    <th class="px-4 py-3">Commentaires</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($demos_pole as $demoss_pole) 
                  <tr class="text-gray-700 dark:text-gray-400">
                      
                       @php $commer = DB::table('commerciaus')->where('id', $demoss_pole->commercial_id)->first(); @endphp
                     @if($commer)
                    <td class="px-4 py-3 text-sm">
                      {{ strtoupper(($commer->prenom) ? $commer->prenom : '')}} {{ strtoupper(($commer->nom) ? $commer->nom : '')}}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      pas de commercial
                    </td>
                    @endif
                   
                    @php $prospect = DB::table('prospects')->where('id', $demoss_pole->prospect_id)->first(); @endphp
                     @if($prospect)
                    <td class="px-4 py-3 text-sm">
                      {{ strtoupper(($prospect->nom_entreprise) ? $prospect->nom_entreprise : '')}}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      pas de prospect
                    </td>
                    @endif
                    
                    @php $opportunite = DB::table('opportunites')->where('id', $demoss_pole->opportunite_id)->first();
                    @endphp
                     @if($opportunite)
                    <td class="px-4 py-3 text-sm">
                      {{ strtoupper(($opportunite->libelle) ? $opportunite->libelle : '')}}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      pas d'opportunités
                    </td>
                    @endif
                    
                     <td class="px-4 py-3 text-sm">
                    {{date('d/m/Y', strtotime($demoss_pole->date))}}
                    </td>
                    <td class="px-4 py-3 text-sm">
                    {{($demoss_pole->personne) ? $demoss_pole->personne : '--'}}
                    </td>
                   
                    <td class="px-4 py-3 text-sm">
                    {{($demoss_pole->commentaire) ? $demoss_pole->commentaire : '--'}}
                    </td>
                    
                  </tr>

                </tbody>
                @endforeach 
              </table>
            </div>
            
{{$demos->links()}}
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
        @endif
        <!----------------------------------end pole------------------------------------------------------------------------------->
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