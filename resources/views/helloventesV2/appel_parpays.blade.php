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
            Rapport des appels par pays de ce mois
          </h2>
           <div  class="col-md-3" style = "margin-top:-20px" align="right" >
                              @php
                                           
                                             
                                             setlocale(LC_TIME, 'fr_FR'); 
                                             $les_moiss = array("01","02","03","04","05","06","07","08","09","10","11","12");
                                             
                                             $les_mois = array();
                                             foreach($les_moiss as $les_moisf){
                                             $year_mensuelles = DB::table('suivi_prospects')->whereMonth('jour', $les_moisf)->where('jour', '!=', null)->pluck('jour')->toArray();
                                            
                                             foreach($year_mensuelles as $year_mensuelle){
                                               array_push($les_mois, date('m', strtotime($year_mensuelle)));
                                             }
                                             }
                                              
                                             $result_moiss = array_diff($les_moiss, $les_mois);
                                             $result_mois = array_diff($les_moiss, $result_moiss);
                            
                                            
                                             $datnow = date('m');
                                        @endphp
                                <!-- <form action="{{route('filtre_appel_parpays')}}" method="get" >-->
                                     
                                <!--      <select name="searchMois" style="width:220px;height:40px"  style="margin-right:50px; display:flex;">-->
                                     
                                <!--        <option value="" disabled selected>Rechercher par mois</option>-->
                                        
                                <!--          @foreach($result_mois as $result_moi)-->
                                <!--          @php  $appel_mensuelle = DB::table('suivi_prospects')->whereMonth('jour', $result_moi)->where('jour', '!=', null)->first(); @endphp-->
                                <!--         @if(date('m', strtotime($appel_mensuelle->jour)) == 12)-->
                                <!--         <option value="{{$result_moi}}">{{ucfirst(strftime('Décembre / %Y', strtotime($appel_mensuelle->jour)))}}</option>-->
                                <!--          @elseif(date('m', strtotime($appel_mensuelle->jour)) == 02)-->
                                <!--         <option value="{{$result_moi}}">{{ucfirst(strftime('Février / %Y', strtotime($appel_mensuelle->jour)))}}</option>-->
                                <!--         @else-->
                                <!--         <option value="{{$result_moi}}">{{ucfirst(strftime('%B / %Y', strtotime($appel_mensuelle->jour)))}}</option>-->
                                <!--         @endif-->
                                         
                                <!--         @endforeach-->
                                <!--    </select>-->
                                    
                                   
                                <!--        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="" type="submit">Filtrer</button>-->
                                <!--</form> -->
                            </div> 
                
                 

                             <br>
             <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              	 @if($appel_parpays->isEmpty()) 
                 	  <p>Pas d'appels</p>
					 @else
            <div class="w-full overflow-x-auto">
               
            
        <div class="w-full overflow-x-auto">    
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Pays</th>
                    <th class="px-4 py-3">Total appels</th>
                    <th class="px-4 py-3">RV obtenu</th>
                    <th class="px-4 py-3">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($appel_parpays as $entreprises) 
               @php    $mois = date('m');
                        
                        $nbre_rv = DB::table('suivi_prospects')->whereMonth('jour', $mois)->where('pays_id', $entreprises->pays_id)->where('type', 1)->where('choix_qualifier', 'Rendez-vous obtenu')->count();                
                @endphp
                  <tr class="text-gray-700 dark:text-gray-400">
                  
                    <td class="px-4 py-3 text-sm">
                      {{$entreprises->libelle}} 
                    </td>
                    
                    <td class="px-4 py-3 text-sm">
                      {{$entreprises->total}} 
                    </td>
                    
                    <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="Voir les rendez-vous">
                        <a href="{{ route('voir.rv_parjour',$entreprises->id) }}">
                      {{$nbre_rv}} 
                        </a>
                    </td>
                    
                    <td class="px-4 py-3 text-sm">
                        <div style="display:flex ">
                        <span style="margin-left:3px; height:28px;"  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Voir les jours">
                        <a href="{{ route('voir.parjour',$entreprises->pays_id) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                          <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                          <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
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