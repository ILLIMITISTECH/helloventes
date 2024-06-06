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
            Les  mises à jours de ce mois
          </h2>
          <div  class="col-md-3" style = "margin-top:-20px" align="right" >
                                 <form action="{{route('filtrer_liste_updates')}}" method="get" >
                                    <select name="searchCommerciaucf" style="width:220px;height:40px"  style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par commerciaux</option>
                                        @php 
                                        $commerciauxs = DB::table('commerciaus')->OrderBy('prenom')->pluck('id')->toArray();
                                        $update_opps = DB::table('update_opps')->pluck('commercial_id')->toArray();
                                        
                                        $result_comerP = array_diff($commerciauxs, $update_opps);
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
                            <br>
                            @if($updates->isEmpty()) 
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
              	 @if($updates->isEmpty()) 
                 	  <p>Pas de mises à jours</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Commercial</th>
                    <!--<th class="px-4 py-3">Entreprises</th>-->
                    <th class="px-4 py-3">Opportunités</th>
                    <th class="px-4 py-3">Libellé</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Personnes</th>
                    <th class="px-4 py-3">Commentaires</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($updates as $updatess) 
                  <tr class="text-gray-700 dark:text-gray-400">
                      
                      @php $commer = DB::table('commerciaus')->where('id', $updatess->commercial_id)->first(); @endphp
                     @if($commer)
                    <td class="px-4 py-3 text-sm">
                      {{ strtoupper(($commer->prenom) ? $commer->prenom : '')}} {{ strtoupper(($commer->nom) ? $commer->nom : '')}}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      pas de commercial
                    </td>
                    @endif
                   
                   @php $prospect = DB::table('prospects')->where('id', $updatess->prospect_id)->first();
                     $opportunites = DB::table('opportunites')->where('id', $updatess->opportunite_id)->first(); @endphp
                    <td align="left" data-toggle="tooltip" title="{{$opportunites->libelle}}">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunites->libelle, 25, $end='...') }}</h4>
                            </button>
                          
                        <!--</div>-->
                   <br>
                     @if($prospect)
                     <!--{{ ($prospect->nom_entreprise) ? $prospect->nom_entreprise : ''}}-->
                      &nbsp;<b style="color:#9045e2">({{ strtoupper(($prospect->nom_entreprise) ? $prospect->nom_entreprise : '')}})</b>
                    @else
                      -
                    @endif
                    </div>
                    </td>
                    
                    @if($updatess->libelle)
                    <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$updatess->libelle}}">
                    {{ \Illuminate\Support\Str::limit($updatess->libelle, 25, $end='...') }}
                    </td>
                     @else
                    <td class="px-4 py-3 text-sm">-</td>
                    @endif
                     <td class="px-4 py-3 text-sm">
                    {{date('d/m/Y', strtotime($updatess->date))}}
                    </td>
                    <td class="px-4 py-3 text-sm">
                    {{($updatess->personne) ? $updatess->personne : '--'}}
                    </td>
                    @if($updatess->commentaire)
                    <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$updatess->commentaire}}">
                        {{ \Illuminate\Support\Str::limit($updatess->commentaire, 25, $end='...') }}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">-</td>
                    @endif
                  </tr>

                </tbody>
                @endforeach 
              </table>
            </div>
            
{{$updates->links()}}
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