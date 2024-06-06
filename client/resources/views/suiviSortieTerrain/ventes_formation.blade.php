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
              @php $moiss = date('m'); 
                $annee = date('Y'); 
              @endphp
            @php  $vente_sum = DB::table('ventes')->where('domaine_id', 1)->whereYear('created_at', $annee)->whereMonth('created_at', $moiss)->sum('montant'); @endphp
            Les ventes de ce mois : FORMATIONS
            <br>
            <div style="display-flex">
                <div style="margin-left:650px;margin-top:-40px">
                    <a href="/ventes_formation_tri" 
                        class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Pour ce trimestre
                      </a>
                </div>
                <div style="margin-left:500px;margin-top:-40px">
                    <a href="/ventes_formation_tri_dernier" 
                        class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Dernier trimestre
                      </a>
                </div>
            </div>
                <br>
             <div style="margin-left:450px;">
                    <span 
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        {{number_format(($venteMontants)) ? number_format($venteMontants) : '0'}} Fcfa
                      </span></div>
          </h2>
          
          
          <div  class="col-md-3" style = "margin-top:-20px" align="right" >
                              @php
                                             setlocale(LC_TIME, 'fr_FR'); 
                                             $les_moiss = array("01","02","03","04","05","06","7","8","9","10","11","12");
                                             $les_mois = array();
                                             foreach($les_moiss as $les_moisf){
                                             $year_mensuelles = DB::table('ventes')->where('domaine_id', 1)->whereMonth('created_at', $les_moisf)->pluck('created_at')->toArray();
                                            
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
                                 <form action="{{route('ventes_formationFiltre')}}" method="get" >
                                     
                                      <select name="searchMois" style="width:220px;height:40px"  style="margin-right:10px; display:flex;">
                                     
                                        <option value="" disabled selected>Rechercher par mois</option>
                                        
                                          @foreach($result_mois as $result_moi)
                                          @php  $obje_mensuelle = DB::table('ventes')->where('domaine_id', 1)->whereMonth('created_at', $result_moi)->first(); @endphp
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
                                         <!--<option value="" disabled>Mois sans ventes</option>-->
                                        @foreach($result_month_not_heres as $result_month_not_here)
                                        
                                         @php  $obje_mensuelle_not_here = DB::table('action_commerciales')->whereMonth('created_at', $result_month_not_here)->first(); @endphp
                                        @if($obje_mensuelle_not_here)
                                            @if($result_month_not_here <= (date('m')))
                                            <option value="{{$result_month_not_here}}">
                                                {{ucfirst(strftime('%B / %Y', strtotime($obje_mensuelle_not_here->created_at)))}}
                                            </option>
                                            @endif
                                            @endif
                                         @endforeach
                                    </select>
                                    
                                   
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="" type="submit">Filtrer</button>
                                </form> 
                            </div> 
                            <br>
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              	
            <div class="w-full overflow-x-auto">
                @if(count($ventess) == 0)
                <p>Pas de ventes de ce mois</p>
                @else
             <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                      <th class="px-4 py-3">Commercial</th>
                    <th class="px-4 py-3">Opportunité</th>
                    <th class="px-4 py-3"></th>
                    <th class="px-4 py-3">Chiffre d'affaires</th>

                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach($ventess as $ventes)
                    @php $op = DB::table('opportunites')->where('id', $ventes->opportunite_id)->first(); @endphp
                    @php $com = DB::table('commerciaus')->where('id', $ventes->commercial_id)->first(); @endphp
                    @if($com)
                    @if($op)
                  <tr class="text-gray-700 dark:text-gray-400">
                       <td class="px-4 py-3">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">

                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold"><a href="">
                                <h4>{{$com->prenom}} {{$com->nom}}</h4>
                            </button>
                          </div>
                        </div>
                    </td>
                    <td class="px-4 py-3" data-toggle="tooltip" title="{{$op->libelle}}">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">

                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold"><a href="">
                                <h4>{{ \Illuminate\Support\Str::limit($op->libelle, 30, $end='...') }}</h4>
                            </button>
                          </div>
                        </div>
                    </td>
                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--  TOLGO-->
                    <!--</td>-->
                    <td class="px-4 py-3"></td>
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        {{(number_format($ventes->montant)) ? number_format($ventes->montant) : '0'}} Fcfa
                      </span>
                    </td>
                    
                  </tr>
                  @endif
                  @endif
                @endforeach
                </tbody>
              </table>
              @endif
            </div>
         
           
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