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
        <!--les formulaires-->
        <div class="container px-6 mx-auto grid">
            <img style="width:200px; " src="{{asset('Koyalis/hellovente3.png')}}" alt="logo"> <br>
            <h2 class="my-2 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Rapport <b style="color:#9045e2">global</b> de performance commerciale de l'année
          </h2>
           @php $chtoday = date('m'); $rap_check = DB::table('performance_globales')->whereMonth('created_at', $chtoday)->orderBy('id', 'DESC')->first(); @endphp
           @if($rap_check)
           @php DB::table('performance_globales')->whereMonth('created_at', $chtoday)
                ->update(['objectif_vente' => $rap_check->objectif_vente, 'objectif_contact' => $rap_check->objectif_contact,
                'objectif_demo' => $rap_check->objectif_demo, 'objectif_visite' => $rap_check->objectif_visite]); 
           @endphp
           @endif
           <div  class="col-md-3" style = "margin-top:-20px" align="right" >
                              @php
                                             setlocale(LC_TIME, 'fr_FR'); 
                                             $les_moiss = array("01","02","03","04","05","06","07","08","09","10","11","12");
                                             $les_mois = array();
                                             foreach($les_moiss as $les_moisf){
                                             $year_mensuelles = DB::table('performance_globales')->whereMonth('created_at', $les_moisf)->pluck('created_at')->toArray();
                                            
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
                                 <form action="{{route('rapport_teamYearFiltre')}}" method="get" >
                                     
                                      <select name="searchMois" style="width:220px;height:40px"  style="margin-right:10px; display:flex;">
                                     
                                        <option value="" disabled selected>Rechercher par mois</option>
                                        
                                          @foreach($result_mois as $result_moi)
                                          @php  $obje_mensuelle = DB::table('performance_globales')->whereMonth('created_at', $result_moi)->first(); @endphp
                                         <!--@if(date('m', strtotime($obje_mensuelle->created_at)) == 12)-->
                                         <!--<option value="{{$result_moi}}">{{ucfirst(strftime('Décembre / %Y', strtotime($obje_mensuelle->created_at)))}}</option>-->
                                         <!-- @elseif(date('m', strtotime($obje_mensuelle->created_at)) == 02)-->
                                         <!--<option value="{{$result_moi}}">{{ucfirst(strftime('Février / %Y', strtotime($obje_mensuelle->created_at)))}}</option>-->
                                         <!--@else-->
                                         <!--<option value="{{$result_moi}}">{{ucfirst(strftime('%B / %Y', strtotime($obje_mensuelle->created_at)))}}</option>-->
                                         <!--@endif-->
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
            @php $m = date('m');
             setlocale(LC_TIME, 'fr_FR'); 
                $per = DB::table('performance_globales')->whereMonth('created_at', $m)->first();
            @endphp
          @if($per)
          <p style="font-size:20px">{{ucfirst(strftime('%B %Y', strtotime($per->created_at)))}}</p>
          @endif
          <br><br>
          <h2 class="my-4 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Ventes 
          </h2>
          <br>
                       
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
        
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap" style="border: solid 1px black;">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3" style="border: solid 1px black;"></th>
                    <th class="px-4 py-3" style="border: solid 1px black;">Objectifs</th>
                    <th class="px-4 py-3" style="border: solid 1px black;">Réalisations</th>
                    <th class="px-4 py-3" style="border: solid 1px black;">%</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @php $zero = 1; @endphp
                @php 
                     $total_objectif = 0; 
                     $total_realisation_vente = 0; 
                     $total_perfo_vente = 0; 
                @endphp
                @foreach($performances as $performance)
                @php 
                     $total_objectif += $performance->objectif_vente;
                     $total_realisation_vente += $performance->realisation_vente;
                     $total_perfo_vente += $performance->perfo_vente;
                     
                @endphp
                
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">Semaine {{$zero}} </td>
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">{{number_format($performance->objectif_vente)}}</td>
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">{{number_format($performance->realisation_vente)}}</td>
                        @if($performance->objectif_vente)
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">@if($performance->realisation_vente) {{intval( ($performance->realisation_vente / $performance->objectif_vente) * 100)}}% @else 0% @endif</td>
                        @else
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">0%</td>
                        @endif                    </tr>
                    @php $zero++; 
                    
                         if($total_objectif){
                         $pourcentage_ventemois = $total_realisation_vente * (100) / ($total_objectif);
                         }
                         else{
                             $pourcentage_ventemois = 0;
                         }
                    @endphp
                @endforeach
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">Total </td>
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">{{number_format($total_objectif)}}</span></td>
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">{{number_format($total_realisation_vente)}}</span></td>
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
<span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            @if($total_objectif)
                                {{intval($pourcentage_ventemois)}}% 
                            @else 0% @endif</span></td>                </tr>
                
              

                </tbody>
              </table>
            </div>
       
          
                
          </div>


  
        </div>
    
    
    <br>
  <div class="container px-6 mx-auto grid">
          <h2 class="my-4 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Démo clients 
          </h2>
          <br>
                       
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
        
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap" style="border: solid 1px black;">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                   
                    <th class="px-4 py-3" style="border: solid 1px black;"></th>
                    <th class="px-4 py-3" style="border: solid 1px black;">Objectifs</th>
                    <th class="px-4 py-3" style="border: solid 1px black;">Réalisations</th>
                    <th class="px-4 py-3" style="border: solid 1px black;">%</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @php $zero = 1; @endphp
                @php 
                     $total_obje_demo = 0; 
                     $total_realisation_demo = 0; 
                     $total_perfo_demo = 0; 
                     $total_perfo_objectif_demo = 0; 
                @endphp
                @foreach($performances as $performance)
                @php 
                     $total_obje_demo += $performance->objectif_demo;
                     $total_realisation_demo += $performance->realisation_demo;
                     $total_perfo_demo += $performance->perfo_demo;
                     $total_perfo_objectif_demo += $performance->objectif_demo;
                @endphp
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">Semaine {{$zero}} </td>
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">{{number_format($performance->objectif_demo)}}</td>
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">{{number_format($performance->realisation_demo)}}</td>
                        @if($performance->objectif_demo)
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">@if($performance->realisation_demo) {{intval( ($performance->realisation_demo / $performance->objectif_demo) * 100)}}% @else 0% @endif</td>
                        @else
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">0%</td>
                        @endif                    </tr>
                    @php $zero++;
                    
                    if($total_obje_demo){
                         $pourcentage_demomois = $total_realisation_demo * (100) / ($total_obje_demo);
                         }
                         else{
                             $pourcentage_demomois = 0;
                         }
                         @endphp
                @endforeach
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">Total </td>
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">{{number_format($total_obje_demo)}}</span></td>
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">{{number_format($total_realisation_demo)}}</span></td>
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                    <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            @if($total_obje_demo)
                                {{intval($pourcentage_demomois)}}% 
                            @else 0% @endif</span></td>              
                    </tr>
                
                

                </tbody>
              </table>
            </div>
       
          
                
          </div>


  
        </div>
    
    
    
    <br>
    <div class="container px-6 mx-auto grid">
          <h2 class="my-4 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Contacts clients 
          </h2>
          <br>
                       
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
        
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap" style="border: solid 1px black;">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3" style="border: solid 1px black;"></th>
                    <th class="px-4 py-3" style="border: solid 1px black;">Objectifs</th>
                    <th class="px-4 py-3" style="border: solid 1px black;">Réalisations</th>
                    <th class="px-4 py-3" style="border: solid 1px black;">%</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @php $zero = 1; @endphp
                @php 
                     $total_obje_contact = 0; 
                     $total_realisation_contact = 0; 
                     $total_perfo_contact = 0; 
                     $total_perfo_objectif_contact = 0; 
                @endphp
                @foreach($performances as $performance)
                @php 
                     $total_obje_contact += $performance->objectif_contact;
                     $total_realisation_contact += $performance->realisation_contact;
                     $total_perfo_contact += $performance->perfo_contact;
                     $total_perfo_objectif_contact += $performance->objectif_contact;
                @endphp
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">Semaine {{$zero}} </td>
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">{{number_format($performance->objectif_contact)}}</td>
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">{{number_format($performance->realisation_contact)}}</td>
                         @if($performance->objectif_contact)
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">@if($performance->realisation_contact) {{intval( ($performance->realisation_contact / $performance->objectif_contact) * 100)}}% @else 0% @endif</td>
                        @else
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">0%</td>
                        @endif                    </tr>
                    @php $zero++; 
                    
                    if($total_obje_contact){
                         $pourcentage_contactmois = $total_realisation_contact * (100) / ($total_obje_contact);
                         }
                         else{
                             $pourcentage_contactmois = 0;
                         }
                         @endphp
                         
                @endforeach
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">Total </td>
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">{{number_format($total_obje_contact)}}</span></td>
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">{{number_format($total_realisation_contact)}}</span></td>
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        @if($total_obje_contact)
                                {{intval($pourcentage_contactmois)}}% 
                            @else 0% @endif</span></td>    
                </tr>
                
              

                </tbody>
              </table>
            </div>
       
          
                
          </div>


  
        </div>
    
    
    
          <br>
    <div class="container px-6 mx-auto grid">
          <h2 class="my-4 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Visites terrain  
          </h2>
          <br>
                       
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
        
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap" style="border: solid 1px black;">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3" style="border: solid 1px black;"></th>
                    <th class="px-4 py-3" style="border: solid 1px black;">Objectifs</th>
                    <th class="px-4 py-3" style="border: solid 1px black;">Réalisations</th>
                    <th class="px-4 py-3" style="border: solid 1px black;">%</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @php $zero = 1; @endphp
                @php 
                     $total_obje_visite = 0; 
                     $total_realisation_visite = 0; 
                     $total_perfo_visite = 0; 
                     $total_perfo_objectif_visite = 0; 
                @endphp
                @foreach($performances as $performance)
                @php 
                     $total_obje_visite += $performance->objectif_visite;
                     $total_realisation_visite += $performance->realisation_visite;
                     $total_perfo_visite += $performance->perfo_visite;
                     $total_perfo_objectif_visite += $performance->objectif_visite;
                @endphp
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">Semaine {{$zero}} </td>
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">{{number_format($performance->objectif_visite)}}</td>
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">{{number_format($performance->realisation_visite)}}</td>
                        @if($performance->objectif_visite)
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">@if($performance->realisation_visite) {{intval( ($performance->realisation_visite / $performance->objectif_visite) * 100)}}% @else 0% @endif</td>
                        @else
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">0%</td>
                        @endif                    </tr>
                    @php $zero++; 
                    
                    if($total_obje_visite){
                         $pourcentage_visitemois = $total_realisation_visite * (100) / ($total_obje_visite);
                         }
                         else{
                             $pourcentage_visitemois = 0;
                         }
                    @endphp
                @endforeach
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">Total </td>
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">{{number_format($total_obje_visite)}}</span></td>
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">{{number_format($total_realisation_visite)}}</span></td>
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
 <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            @if($total_obje_visite)
                                {{intval($pourcentage_visitemois)}}% 
                            @else 0% @endif</span></td>
                            </tr>
                
                </tbody>
              </table>
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