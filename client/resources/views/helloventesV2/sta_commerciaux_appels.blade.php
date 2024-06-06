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
              @php          $today = date('d');
                            $mois = date('m');
                            $annee = date('Y'); 
                          @endphp   
                          
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
                Statistiques des appels de cette semaine
          </h2>

                               
                                  @php  
                                  $today = date('d');
                                  $objectif = DB::table('commerciaus')->sum('nbre_appel_quotidien');
                        
                        $week = [];
                        $saturday = strtotime('monday this week');
                        foreach (range(0, 6) as $day) {
                            $week[] = date("Y-m-d", (($day * 86400) + $saturday));
                        }
                        
                        
                        $appels_effectuer = array();
                        foreach($week as $weeks)
                         { 
                          $we = date('Y',  strtotime($weeks));
                         
                        $appels_effectuers = DB::table('suivi_prospects')
                            ->whereYear('created_at', date('Y',  strtotime($weeks)))
                            ->whereMonth('created_at', date('m',  strtotime($weeks)))
                            ->whereDay('created_at', date('d',  strtotime($weeks)))
                            
                            ->get(); 
                         
                           foreach($appels_effectuers as $appels_effectuerss)
                            { 
                                array_push($appels_effectuer,$appels_effectuerss);
                            }
                            }
                            
                            $total_realiser = count($appels_effectuer);
                            if($objectif > 0){
                                $perfo_appels = $total_realiser * (100) / $objectif ;
                            }
                            else{
                                $perfo_appels = 0 ;
                            }
                                  @endphp
         
           <div  class="col-md-3" style = "margin-top:5px" align="right" >
                 <a href="/appels_mois">
                    <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="" type="submit">Voir les appels de ce mois</button>
                 </a>             
            </div> 
          @php $commerciauxd = DB::table('commerciaus')->get(); @endphp
                <div  class="col-md-3" style = "margin-top:5px" align="right" >
                                 <form action="{{route('filtrer_sta_commerciaux_appels')}}" method="get" >
                                    <select name="searchCommerciaucf" style="width:220px;height:40px"  style="margin-right:10px; display:flex;" >
                                        <option value="" disabled selected>Rechercher par commerciaux</option>
                                       @foreach($commerciauxd as $commerciauxss)
                                        <option value="{{$commerciauxss->id}}">{{$commerciauxss->prenom}} {{$commerciauxss->nom}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='https://dev-v1v2.helloventes.com/sta_commerciaux_appels';" >Tous les commerciaux</option>-->
                                    </select>
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="" type="submit">Filtrer</button>
                                </form> 
                            </div> 
                  
<div class="form-group" style="display:flex" >
                            <span style="color:0063ed;margin-left:150px;"
                                class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">

                            Objectifs : {{$objectif}} 
                            </span>
                            <span style="color:0063ed;margin-left:50px;"
                                class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">

                            Réalisations : {{$total_realiser}}
                            </span>
                            <span style="color:0063ed;margin-left:50px;"
                                class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">

                            Performance : {{intval($perfo_appels)}}%
                            </span>
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
              	 @if(count($commerciaux) > 0 ) 
                 	 
            <div class="w-full overflow-x-auto">
               
            <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3" style="text-align:left; width:100px;">Commerciaux</th>
                    <!--<th class="px-4 py-3" style="text-align:center; width:100px;">Prospects à appeler</th>-->
                    <th class="px-4 py-3" style="text-align:center; width:100px;">Réalisés</th>
                    <th class="px-4 py-3" style="text-align:center; width:100px;">Appels du jour</th>
                    <th class="px-4 py-3" style="text-align:center; width:100px;">Qualifiés</th>
                    <th class="px-4 py-3" style="text-align:center; width:100px;">Non qualifiés</th>
                    <th class="px-4 py-3" style="text-align:center; width:100px;">A rappeler</th>
                    <th class="px-4 py-3" style="text-align:center; width:100px;">RV obtenu</th>
                    <!--<th class="px-4 py-3" style="text-align:center; width:100px;">Produits/Services à vendre</th>-->
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
               
               @foreach($commerciaux as $commercial)
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <td class="px-4 py-3 text-sm" style="text-align:left; width:100px;">
                        
                      {{($commercial->prenom) ? $commercial->prenom : 'pas renseigné'}} {{($commercial->nom) ? $commercial->nom : 'pas renseigné'}}
                     
                    </td>
                     @php 
                     
                     $week = [];
                $saturday = strtotime('monday this week');
                foreach (range(0, 6) as $day) {
                    $week[] = date("Y-m-d", (($day * 86400) + $saturday));
                }
                $appels_a_effectuer = " ";
                foreach($week as $weeks)
                 { 
                     $appels_a_effectuers = DB::table('prospect_a_appellers')
                     ->where('commercial_id', $commercial->id)
                     ->where('statut', null)
                     ->whereYear('created_at', date('Y',  strtotime($weeks)))
                     ->whereMonth('created_at', date('m',  strtotime($weeks)))
                     ->whereDay('created_at', date('d',  strtotime($weeks)))
                     ->count(); 
                     $appels_a_effectuer = $appels_a_effectuers;
                     
                    
                 }    
                 
                 
                     @endphp
                     
                    
                    <!--<td class="px-4 py-3 text-sm" style="text-align:center; width:100px;">
                        
                        <a href="{{route('sta_commerciaux_appels_nbreffecter', $commercial->id)}}" data-toggle="tooltip" title="Les prospects à appeler de {{$commercial->prenom}}">
                      <span style="color:0063ed;"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">

                       
                                 {{number_format($appels_a_effectuer)}} 
                               
                     </span>
                      </a>
                    </td>
                    -->
                    @php  
                    
                     $week = [];
                        $saturday = strtotime('monday this week');
                        foreach (range(0, 6) as $day) {
                            $week[] = date("Y-m-d", (($day * 86400) + $saturday));
                        }
                        
                        
                        $appels_effectuer = array();
                        $appelsaqualifier = array();
                        $appelsnonqualifier = array();
                        $appels_arappeler = array();
                        $appels_daterv = array();
                        foreach($week as $weeks)
                         { 
                          $we = date('Y',  strtotime($weeks));
                         
                        $appels_effectuers = DB::table('suivi_prospects')
                            ->where('commercial_id', $commercial->id)
                            ->whereYear('created_at', date('Y',  strtotime($weeks)))
                            ->whereMonth('created_at', date('m',  strtotime($weeks)))
                            ->whereDay('created_at', date('d',  strtotime($weeks)))
                            
                            ->get(); 
                         
                           foreach($appels_effectuers as $appels_effectuerss)
                            { 
                                array_push($appels_effectuer,$appels_effectuerss);
                            }
                            
                            
                            $appelsaqualifiers = DB::table('suivi_prospects')
                            ->where('commercial_id', $commercial->id)->where('type', 1)
                            ->whereYear('created_at', date('Y',  strtotime($weeks)))
                            ->whereMonth('created_at', date('m',  strtotime($weeks)))
                            ->whereDay('created_at', date('d',  strtotime($weeks)))
                            ->get(); 
                         
                           foreach($appelsaqualifiers as $appelsaqualifierss)
                            { 
                                array_push($appelsaqualifier,$appelsaqualifierss);
                            }
                            
                            
                            $appelsnonqualifiers = DB::table('suivi_prospects')
                            ->where('commercial_id', $commercial->id)->where('type', 2)
                            ->whereYear('created_at', date('Y',  strtotime($weeks)))
                            ->whereMonth('created_at', date('m',  strtotime($weeks)))
                            ->whereDay('created_at', date('d',  strtotime($weeks)))
                            ->get(); 
                         
                           foreach($appelsnonqualifiers as $appelsnonqualifierss)
                            { 
                                array_push($appelsnonqualifier,$appelsnonqualifierss);
                            }
                            
                            
                            $appels_arappelers = DB::table('suivi_prospects')
                            ->where('commercial_id', $commercial->id)->where('type', 5)
                            ->whereYear('created_at', date('Y',  strtotime($weeks)))
                            ->whereMonth('created_at', date('m',  strtotime($weeks)))
                            ->whereDay('created_at', date('d',  strtotime($weeks)))
                            ->get(); 
                         
                           foreach($appels_arappelers as $appels_arappelerss)
                            { 
                                array_push($appels_arappeler,$appels_arappelerss);
                            }
                                                
                                                
                                                
                            $appels_datervs = DB::table('suivi_prospects')->where('type', 1)->where('choix_qualifier', "Rendez-vous obtenu")
                            ->where('commercial_id', $commercial->id)
                            ->whereYear('created_at', date('Y',  strtotime($weeks)))
                            ->whereMonth('created_at', date('m',  strtotime($weeks)))
                            ->whereDay('created_at', date('d',  strtotime($weeks)))
                            ->get(); 
                         
                           foreach($appels_datervs as $appels_datervss)
                            { 
                                array_push($appels_daterv,$appels_datervss);
                            }
                        }
                        
                        $appels_effectuer_today = DB::table('suivi_prospects')
                        ->where('commercial_id', $commercial->id)
                        ->whereYear('created_at', $annee)
                        ->whereMonth('created_at', $mois)
                        ->whereDay('created_at', $today)
                        ->count();
                        
                        
                    @endphp
                    
                    <td class="px-4 py-3 text-sm" style="text-align:center; width:100px;">
                        
                       <a href="{{route('sta_commerciaux_appels_nbreffectuer_semaine', $commercial->id)}}" data-toggle="tooltip" title="Les prospects déjà appelé de {{$commercial->prenom}}">
                      <span style="color:0063ed;"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">

                                 {{$commercial->total}} 
                                </span>
                      </a>
                     
                    </td>
                    
                     <td class="px-4 py-3 text-sm" style="text-align:center; width:100px;">
                        
                       <a href="{{route('sta_commerciaux_appels_nbreffectuer_today', $commercial->id)}}" data-toggle="tooltip" title="Les prospects déjà appelé de {{$commercial->prenom}}">
                      <span style="color:0063ed;"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">

                                 {{number_format($appels_effectuer_today)}} 
                                </span>
                      </a>
                     
                    </td>
                                
                    <td style="text-align:center; width:100px;" class="px-4 py-3 text-sm">
                        
 <a href="{{route('sta_commerciaux_appels_nbrqualifier_semaine', $commercial->id)}}" data-toggle="tooltip" title="Les prospects qualifiés de {{$commercial->prenom}}">
                      <span style="color:0063ed;"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">

                                 {{count($appelsaqualifier)}} 
                                </span>
                      </a>
                     
                    </td>
                    
                            
                    <td class="px-4 py-3 text-sm" style="text-align:center; width:100px;">
                        
                      <a href="{{route('sta_commerciaux_appels_nbrnonqualifier_semaine', $commercial->id)}}" data-toggle="tooltip" title="Les prospects non qualifiés de {{$commercial->prenom}}">
                      <span style="color:0063ed;"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">

                                 {{count($appelsnonqualifier)}} 
                                </span>
                      </a>
                     
                    </td>
                    
                    <td class="px-4 py-3 text-sm" style="text-align:center; width:100px;">
                        
                       <a href="{{route('sta_commerciaux_appels_nbrappeler_semaine', $commercial->id)}}" data-toggle="tooltip" title="Les prospects à rappeler de {{$commercial->prenom}}">
                      <span style="color:0063ed;"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">

                                 {{count($appels_arappeler)}} 
                                </span>
                      </a>
                     
                    </td>
                    
                    <td class="px-4 py-3 text-sm" style="text-align:center; width:100px;">
                        
                      <a href="{{route('sta_commerciaux_appels_rv_semaine', $commercial->id)}}" data-toggle="tooltip" title="Rendez-vous obtenu de {{$commercial->prenom}}">
                      <span style="color:0063ed;"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">

                                 {{count($appels_daterv)}} 
                                </span>
                      </a>
                     
                    </td>
                    @php  $produit_avendre = DB::table('suivi_prospects')->where('type', 5)->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->count(); @endphp
 <!--                   <td class="px-4 py-3 text-sm" style="text-align:center; width:100px;">-->
                        
 <!--<a href="{{route('sta_commerciaux_appels_nbrpvendre', $commercial->id)}}" data-toggle="tooltip" title="Demande de produits ou services à vendre de {{$commercial->prenom}}">-->
 <!--                     <span style="color:0063ed;"-->
 <!--                       class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">-->

 <!--                                {{number_format($produit_avendre)}} -->
 <!--                               </span>-->
 <!--                     </a>-->
                     
 <!--                   </td>-->
                    
                   
            
                   
                   
                    
                    
                    
                   
                  </tr>
                  @endforeach

                </tbody>
                
              </table>
             </div>
            
     
             @else
             
 <p></p>
					
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

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>              

</body>

</html>