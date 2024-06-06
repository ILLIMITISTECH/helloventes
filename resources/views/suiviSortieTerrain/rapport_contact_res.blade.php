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
            Rapport global des contacts 
          </h2>
            <br>
          <div  class="col-md-3" style = "margin-top:-20px" align="right" >
              @php
                                             setlocale(LC_TIME, 'fr_FR'); 
                                             $les_moiss = array("01","02","03","04","05","06","7","8","9","10","11","12");
                                             $les_mois = array();
                                             foreach($les_moiss as $les_moisf){
                                             $year_mensuelles = DB::table('stock_mensuelles')->whereMonth('created_at', $les_moisf)->pluck('created_at')->toArray();
                                            
                                             foreach($year_mensuelles as $year_mensuelle){
                                               array_push($les_mois, date('m', strtotime($year_mensuelle)));
                                             }
                                             }
                                              
                                             $result_moiss = array_diff($les_moiss, $les_mois);
                                             $result_mois = array_diff($les_moiss, $result_moiss);
                            
                                             $month_not_here = array("01","02","03","04","05","06","7","8","9","10","11","12");
                              
                                            $result_month_not_heres = array_diff($month_not_here, $result_mois);
                                             
                                             $datnow = date('m');
                                        @endphp
              
                                 <form action="{{route('filtrer_par_com_Rcontact')}}" method="get" >
                                     
                                      <select name="searchCommerciauMois" style="width:220px;height:40px"  style="margin-right:10px; display:flex;">
                                     
                                        <option value="" disabled selected>Rechercher par mois</option>
                                        
                                          @foreach($result_mois as $result_moi)
                                          @php  $obje_mensuelle = DB::table('stock_mensuelles')->whereMonth('created_at', $result_moi)->first(); @endphp
                                       
                                         
                                          <!--<option value="" disabled>Mois sans contacts</option>-->
                                        
                                        @if(date('m', strtotime($obje_mensuelle->created_at)) == "12")
                                         <option value="{{$result_moi}}">{{ucfirst(strftime('Décembre / %Y', strtotime($obje_mensuelle->created_at)))}}</option>
                                           @elseif(date('m', strtotime($obje_mensuelle->created_at)) == "02")
                                         <option value="2">{{ucfirst(strftime('Février / %Y', strtotime($obje_mensuelle->created_at)))}}</option>
                                         @else
                                         @if($result_moi == "01")
                                         <option value="1">{{ucfirst(strftime('%B / %Y', strtotime($obje_mensuelle->created_at)))}}</option>
                                         @elseif($result_moi == "02")
                                         <option value="2">{{ucfirst(strftime('%B / %Y', strtotime($obje_mensuelle->created_at)))}}</option>
                                            @elseif($result_moi == "03")
                                         <option value="3">{{ucfirst(strftime('%B / %Y', strtotime($obje_mensuelle->created_at)))}}</option>
                                        @elseif($result_moi == "04")
                                         <option value="4">{{ucfirst(strftime('%B / %Y', strtotime($obje_mensuelle->created_at)))}}</option>
                                        @elseif($result_moi == "05")
                                         <option value="5">{{ucfirst(strftime('%B / %Y', strtotime($obje_mensuelle->created_at)))}}</option>
                                        @elseif($result_moi == "06")
                                         <option value="6">{{ucfirst(strftime('%B / %Y', strtotime($obje_mensuelle->created_at)))}}</option>
                                        @else
                                        <option value="{{$result_moi}}">{{ucfirst(strftime('%B / %Y', strtotime($obje_mensuelle->created_at)))}}</option>
                                        @endif
                                         @endif
                                         
                                         @endforeach
                                         
                                           <br>
                                        @foreach($result_month_not_heres as $result_month_not_here)
                                        
                                        @php  $obje_mensuelle_not_here = DB::table('action_commerciales')->whereMonth('created_at', $result_month_not_here)->first(); @endphp
                                            @if($obje_mensuelle_not_here)
                                            @if($result_month_not_here <= (date('m')))
                                            
                                            @if($result_month_not_here == "12")
                                         <option value="{{$result_month_not_here}}">{{ucfirst(strftime('Décembre / %Y', strtotime($obje_mensuelle_not_here->created_at)))}}</option>
                                           @elseif($result_month_not_here == "02")
                                         <option value="{{$result_month_not_here}}">{{ucfirst(strftime('Février / %Y', strtotime($obje_mensuelle_not_here->created_at)))}}</option>
                                         @else
                                            <option value="{{$result_month_not_here}}">
                                                {{ucfirst(strftime('%B / %Y', strtotime($obje_mensuelle_not_here->created_at)))}}
                                            </option>
                                         @endif
                                            @endif
                                            @endif
                                         @endforeach
                                         
                                    </select>
                                    
                                    <select name="searchCommerciaucf" style="width:220px;height:40px"  style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par commerciaux </option>
                                        @php 
                                        $commerciauxs = DB::table('commerciaus')->where('domaine_id', $moi->domaine_id)->OrderBy('prenom')->pluck('id')->toArray();
                                        $entreprisess = DB::table('stock_mensuelles')->pluck('commercial_id')->toArray();
                                        
                                        $result_comerP = array_diff($commerciauxs, $entreprisess);
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
                    @php 
                       setlocale(LC_TIME, 'fr_FR'); 
                       
                    @endphp
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              	 @if($stock_mensuelles == null) 
                 	  <p>La liste est vide !</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3">Commerciaux</th>
                    <th class="px-4 py-3">Mois / Année</th>
                    <th class="px-4 py-3">Nouveaux contacts</th>
                    <th class="px-4 py-3">Les contacts mises à jours</th>>
                    <th class="px-4 py-3">%Performance</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @php
                        $semaineM7 = (date('d') -7);
                        $action_semaineP7 = (date('d') +7);
                        $action_mois = date('m');
                    @endphp

                    @php 
                       setlocale(LC_TIME, 'fr_FR'); 
                      
                    @endphp
                @foreach($stock_mensuelles as $stock_mensuelle)
                @php
                    $com = DB::table('commerciaus')->where('id', $stock_mensuelle->commercial_id)->orderBy('prenom')->first();
                @endphp
                @if($com)
                  <tr class="text-gray-700 dark:text-gray-400">
                    @if($com)
                    <td class="px-4 py-3 text-sm">
                       {{ ($com->prenom) ? $com->prenom : ''}} {{ ($com->nom) ? $com->nom : ''}}
                    </td>
                    @else
                    <td>-</td>
                    @endif
                    <td class="px-4 py-3 text-sm">
                       @if(date('m', strtotime($stock_mensuelle->created_at)) == 02)
                       Février
                       @elseif(date('m', strtotime($stock_mensuelle->created_at)) == 12)
                       Décembre
                       @else
                       {{ucfirst(strftime('%B', strtotime($stock_mensuelle->created_at)))}}
                       @endif
                       /  {{date('Y', strtotime($stock_mensuelle->created_at))}}
                    </td>
                    
                    
                    <td class="px-4 py-3 text-sm">
                       {{ ($stock_mensuelle->nbre_contact_ajouter) ? $stock_mensuelle->nbre_contact_ajouter : 0}}
                    </td>
                    
                   
                     <td class="px-4 py-3 text-sm">
                    <span
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                       {{ ($stock_mensuelle->nbre_contact) ? $stock_mensuelle->nbre_contact : 0}}
                      </span>
                    </td>
                    
                     <td class="px-4 py-3 text-sm">
                      {{($stock_mensuelle->pourcentage_contact_mois) ? $stock_mensuelle->pourcentage_contact_mois : '00'}}%
                    </td>
                    
                   
               
                  </tr>
@endif
                </tbody>
                @endforeach 
              </table>
            </div>
       
          
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