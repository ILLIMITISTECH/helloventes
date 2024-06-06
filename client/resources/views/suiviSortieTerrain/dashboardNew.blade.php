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
     <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
          <h3 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Tableau de bord 
          </h3>
           <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
            @php $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first(); @endphp
                @php 
                    $mois = date('m');
                    $annee = date('Y'); 
                    
                     
                     
                    $top_mois = date('m');
                    $mois_past = ($top_mois - 1);  

                    $weekdaysundaylast = " ";
                    $weekdaymondaylast = " ";
                                                $sunday_last = strtotime('sunday last week');
                                                foreach (range(0,0) as $daysun) {
                                                    $weekdaysundaylast = date("Y-m-d", (($daysun * 86400) + $sunday_last));
                                                }
                                                
                                                $monday_last = strtotime('monday last week');
                                                foreach (range(0,0) as $daymon) {
                                                    $weekdaymondaylast = date("Y-m-d", (($daymon * 86400) + $monday_last));
                                                }
                                                
                    $weekday_sundaylast = (date('d', strtotime($weekdaysundaylast)));  
                    $weekday_mondaylast = (date('d', strtotime($weekdaymondaylast)));  
                    
                    $weekdaysundaythis = " ";
                    $weekdaymondaythis = " ";
                                                $sunday_this = strtotime('sunday this week');
                                                foreach (range(0,0) as $daysunthis) {
                                                    $weekdaysundaythis = date("Y-m-d", (($daysunthis * 86400) + $sunday_this));
                                                }
                                                
                                                $monday_this = strtotime('monday this week');
                                                foreach (range(0,0) as $daymonthis) {
                                                    $weekdaymondaythis = date("Y-m-d", (($daymonthis * 86400) + $monday_this));
                                                }
                                                
                    $weekday_sundaythis = (date('d', strtotime($weekdaysundaythis)));  
                    $weekday_mondaythis = (date('d', strtotime($weekdaymondaythis)));

                @endphp
          <!-- CTA -->
          <!--<a class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
            href="https://github.com/estevanmaito/windmill-dashboard">
            <div class="flex items-center">
              <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path
                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                </path>
              </svg>
              <span>Star this project on GitHub</span>
            </div>
            <span>View more &RightArrow;</span>
          </a>-->
          
          <style>
        * {
          box-sizing: border-box;
        }
      
        .main1 {
          width: 60%;
          float: left;
          padding: 15px;
          border: 1px solid none;
        }
        
        .main2 {
          width: 40%;
          float: left;
          padding: 15px;
          border: 1px solid none;
        }
        
        .main3 {
          width: 30%;
          float: left;
          padding: 15px;
          border: 1px solid none;
        }
        
        .main4 {
          width: 35%;
          float: left;
          padding: 15px;
          border: 1px solid none;
        }
        
        .main5 {
          width: 35%;
          float: left;
          padding: 15px;
          border: 1px solid none;
        }
        </style>
                 <div class="container">
                     @if((Auth::user()->nom_role == "responsable") OR (Auth::user()->nom_role == "directeur"))
                        <div class="main1">
                            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-3">
                                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                          <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                          </path>
                                        </svg>
                                    </div>
                                    <a href="/les_ventes">
                                    @php
                                       $total_ventes = DB::table('ventes')->whereYear('created_at', $annee)->sum('montant'); 
                                       
                                       $les_vente_sum = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle')
                                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                                        //->where('commercial_id', $commercial->id)
                                        ->whereYear('ventes.created_at', $annee)
                                        ->orderBy('ventes.montant', 'desc')->sum('ventes.montant');
                                    @endphp
                                    <div>
                                        <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les appels offres en cours">
                                                Total Ventes
                                        </button>
                                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                            {{number_format($les_vente_sum)}} FCFA
                                        </p>
                                    </div>
                                  </a>
                                </div>
                                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                          <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                          </path>
                                        </svg>
                                    </div>
                                     @php
                                       $total_ventes_mois = DB::table('ventes')->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->sum('montant'); 
                                       
                                       $les_vente_sum_mois = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle')
                                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                                        //->where('commercial_id', $commercial->id)
                                        ->whereYear('ventes.created_at', $annee)
                                        ->whereMonth('ventes.created_at', $mois)
                                        ->orderBy('ventes.montant', 'desc')->sum('ventes.montant');
                                    @endphp
                                    <a href="/les_ventes_mois">
                                    <div>
                                        <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les appels offres en cours">
                                                Total Ventes ce mois
                                        </button>
                                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                            {{number_format($les_vente_sum_mois)}} FCFA
                                        </p>
                                    </div>
                                    </a>
                                </div>
                                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                          <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                          </path>
                                        </svg>
                                    </div>
                                    <a href="/opportunite_maTeam">
                                    @php
                                       $total_opportunites = DB::table('opportunites')->whereYear('created_at', $annee)->where('archiver', 0)->count(); 
                                    @endphp
                                    <div>
                                        <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les appels offres en cours">
                                                Total Opportunités
                                        </button>
                                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                           {{number_format($total_opportunites)}}
                                        </p>
                                    </div>
                                   </a>
                                </div>
                                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                          <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                          </path>
                                        </svg>
                                    </div>
                                     @php
                                       $total_opportunites_mois = DB::table('opportunites')->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->where('archiver', 0)->count(); 
                                    @endphp
                                    <!--<a href="/lister_opportunites_res">-->
                                    <div>
                                        <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les appels offres en cours">
                                               Total Opportunités actives ce mois
                                        </button>
                                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                            {{number_format($total_opportunites_mois)}}
                                        </p>
                                    </div>
                                    <!--</a>-->
                                </div>
                                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                          <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                          </path>
                                        </svg>
                                    </div>
                                        @php  $nvx_clientsyear = array();  
                                          $opp_venduyear = DB::table('ventes')->whereYear('created_at', $annee)->get(); 
                                                foreach($opp_venduyear as $opp_vendusyear){
                                                    $oppyear = DB::table('opportunites')->where('id', $opp_vendusyear->opportunite_id)->first();
                                                    if($oppyear){
                                                    $nvx_clientssyear = DB::table('prospects')->where('id', $oppyear->prospect_id)->get(); 
                                                    array_push($nvx_clientsyear,$nvx_clientssyear);
                                                    }
                                                }
                                        @endphp
                                    <!--<a href="/nouveaux_clients_tous">-->
                                    <div>
                                        <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Total Clients">
                                                Total Clients
                                        </button>
                                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                            {{count($nvx_clientsyear)}}
                                        </p>
                                    </div>
                                    <!--</a>-->
                                </div>
                                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                          <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                          </path>
                                        </svg>
                                    </div>
                                        @php  $nvx_clients = array();  
                                          $opp_vendu = DB::table('ventes')->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->get(); 
                                                foreach($opp_vendu as $opp_vendus){
                                                    $opp = DB::table('opportunites')->where('id', $opp_vendus->opportunite_id)->first();
                                                    $nvx_clientss = DB::table('prospects')->where('id', $opp->prospect_id)->get(); 
                                                    array_push($nvx_clients,$nvx_clientss);
                                                }
                                        @endphp
                                    <a href="/nouveaux_clients_tous">
                                    <div>
                                        <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les clients du mois">
                                                Clients du mois
                                        </button>
                                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                           {{count($nvx_clients)}}
                                        </p>
                                    </div>
                                    </a>
                                </div>
                                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                          <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                          </path>
                                        </svg>
                                    </div>
                                     @php $passmois = (date('m') - 1);  $nvx_clientspass = array();  
                                          $opp_vendupass = DB::table('ventes')->whereYear('created_at', $annee)->whereMonth('created_at', $passmois)->get(); 
                                                foreach($opp_vendupass as $opp_venduspass){
                                                    $opppass = DB::table('opportunites')->where('id', $opp_venduspass->opportunite_id)->first();
                                                    if($opppass){
                                                    $nvx_clientsspass = DB::table('prospects')->where('id', $opppass->prospect_id)->get(); 
                                                    array_push($nvx_clientspass,$nvx_clientsspass);
                                                    }
                                                }
                                        @endphp
                                    <a href="/nouveaux_clients_tous_pass">
                                    <div>
                                        <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les clients du mois passé">
                                                Clients du mois passé
                                        </button>
                                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                            {{count($nvx_clientspass)}}
                                        </p>
                                    </div>
                                    </a>
                                </div>
                                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                          <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                          </path>
                                        </svg>
                                    </div>
                                    
                                    @php 
                                        $deadlinef = date('Y-m-d');
                                        $commercialRes = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                                        $opportuniteF = DB::table('opportunites')->where('archiver', 0 )->whereIn('origine_id', [1,2] )->where('opportunites.statut', '!=', 18 )->where('deadline', '>=', $deadlinef )->where('superieur_id', $commercialRes->superieur_id)->OrderBy('created_at', 'desc')->count();
                                    @endphp
                                    @if(Auth::user()->nom_role == 'responsable')
                                    <a href="/lister_opportunites_res">
                                    <div>
                                        <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les appels d'offres en cours">
                                                Appels d'offres
                                        </button>
                                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                            {{$opportuniteF}}
                                        </p>
                                    </div>
                                    </a>
                                    @elseif(Auth::user()->nom_role == 'directeur')
                                    @php $deadline = date('Y-m-d');  $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                                            $op = DB::table('opportunites')->where('commercial_id', $commercial->id)->where('archiver', 0 )->whereIn('origine_id', [1,2] )->count(); @endphp
                                        @php $prospects = DB::table('prospects')->where('commercial_id', $commercial->id)->where('strategique', 1)->get();
                                        
                                        $eche = array();
                                        foreach($prospects as $prospect)
                                       
                                           {
                                                $opportunite_critique = DB::table('opportunites')->where('archiver', 0 )->where('prospect_id', $prospect->id)->OrderBy('created_at', 'desc')->get();
                                                 
                                                foreach($opportunite_critique as $opportunite_critiquesf)
                                                {
                                                
                                                
                                                $actions = DB::table('action_commerciales')->where('cloture', 0 )->where('opportunite_id', $opportunite_critiquesf->id)->OrderBy('created_at', 'desc')->get();
                                                 
                                                foreach($actions as $action)
                                                 array_push($eche, $action);
                                                 
                                                }
                                         
                                            }
                                                
                                            $opportunite = DB::table('opportunites')->where('archiver', 0 )->whereIn('origine_id', [1,2] )->where('opportunites.statut', '!=', 18 )->where('deadline', '>=', $deadline )->OrderBy('created_at', 'desc')->count();
                                        @endphp
                                    <a href="/opportunites">
                                    <div>
                                        <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les appels d'offres en cours">
                                                Appels d'offres
                                        </button>
                                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                            {{$opportunite}}
                                        </p>
                                    </div>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    
                    <div class="main2">
                            <div class="grid gap-6 lg-12 md:grid-cols-12 xl:grid-cols-10">
                                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                          <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                          </path>
                                        </svg>
                                    </div>
                                    @php
                                       $vmoispass = (date('m') - 1);
                                       $total_ventes_mois_pass = DB::table('ventes')->whereYear('created_at', $annee)->whereMonth('created_at', $vmoispass)->sum('montant'); 
                                       
                                       $les_vente_sum_mois_pass = DB::table('ventes')->select('ventes.*', 'commerciaus.prenom', 'commerciaus.nom', 'opportunites.libelle')
                                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
                                        ->join('opportunites', 'opportunites.id', 'ventes.opportunite_id')
                                        //->where('commercial_id', $commercial->id)
                                        ->whereYear('ventes.created_at', $annee)
                                        ->whereMonth('ventes.created_at', $vmoispass)
                                        ->orderBy('ventes.montant', 'desc')->sum('ventes.montant');
                                    @endphp
                                    <a href="/les_ventes_mois_pass">
                                    <div>
                                        <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les appels offres en cours">
                                                Total Ventes le mois passé
                                        </button>
                                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                            {{number_format($les_vente_sum_mois_pass)}} FCFA
                                        </p>
                                    </div>
                                    </a>
                                </div>
                                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                          <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                          </path>
                                        </svg>
                                    </div>
                                     @php
                                       $moispassop = (date('m') - 1);
                                       $total_opportunites_mois_pass = DB::table('opportunites')->whereYear('created_at', $annee)->whereMonth('created_at', $moispassop)->where('archiver', 0)->count(); 
                                    @endphp
                                    <!--<a href="/lister_opportunites_res">-->
                                    <div>
                                        <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les appels offres en cours">
                                              Total Opportunités actives le mois passé
                                        </button>
                                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                            {{number_format($total_opportunites_mois_pass)}}
                                        </p>
                                    </div>
                                    <!--</a>-->
                                </div>
                           
                        
                            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                                 Evolution des ventes
                                </h4>
                                <canvas id="lineGN"></canvas>
                                <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                                  <div class="flex items-center">
                                    <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
                                    <span>Objectifs</span>
                                  </div>
                                  <div class="flex items-center">
                                    <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
                                    <span>Réalisations</span>
                                  </div>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                    
                 </div>
                
                <div class="container">
                        <div class="main3">
                            <div class="grid gap-6 lg-12 md:grid-cols-12 xl:grid-cols-10">
                                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                          <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                          </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les appels offres en cours">
                                                Total Vendeurs du mois
                                        </button>
                                        @php 
                                        
                                           $topVentes = DB::table('ventes')->select('commercial_id','created_at','montant', DB::raw('sum(montant) as `total`'))
                                           ->whereYear('created_at', $annee)
                                           ->whereMonth('created_at', $mois)
                                           ->groupBy('commercial_id')->orderBy('total','DESC')->paginate(4);  
                                        @endphp
                                         @if(count($topVentes) == 0)
                                                 <p style="text-align:right; margin-top:5px; color:#0093a2;" class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                                     Pas de ventes
                                                 </p>
                                                @else
                                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                            <ul>
                                                @foreach($topVentes as $top_perfo)        
                                                   @php  $commer = DB::table('commerciaus')->where('id', $top_perfo->commercial_id)->first(); @endphp
                                                    <!-- Card -->
                                                    @if($commer)
                                                        <li><a href="{{route('voir_sesVente_dumois',$commer->id)}}" data-toggle="tooltip" title="Voir les ventes de {{($commer) ? $commer->prenom : ''}}">{{($commer) ? $commer->prenom : ''}} {{($commer) ? $commer->nom : ''}}</a>
                                                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                                                {{number_format($top_perfo->total)}} Fcfa 
                                                                <p style="text-align:right; margin-top:5px; color:#0093a2;" class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                                                  @if($commer->objectif_mois)
                                                                  {{intval(($top_perfo->total)*100 / $commer->objectif_mois)}}  % 
                                                                  @else
                                                                 
                                                                  @endif
                                                                </p>
                                                            </p>
                                                        </li>
                                                    @endif
                                                @endforeach
                                                @endif
                                            </ul>
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                    <div>
                                        <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les appels offres en cours">
                                                Total Vendeurs du mois passé
                                        </button>
                                        @php 
                                           $moispasse = (date('m') - 1);
                                           $topVentespass = DB::table('ventes')->select('commercial_id','created_at','montant', DB::raw('sum(montant) as `total`'))
                                           ->whereYear('created_at', $annee)
                                           ->whereMonth('created_at', $moispasse)
                                           ->groupBy('commercial_id')->orderBy('total','DESC')->paginate(4);  
                                        @endphp
                                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                            <ul>
                                                @if(count($topVentespass) == 0)
                                                 <p style="text-align:right; margin-top:5px; color:#0093a2;" class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                                     Pas de ventes
                                                 </p>
                                                @else
                                                @foreach($topVentespass as $top_perfopass)        
                                                   @php  $commerpass = DB::table('commerciaus')->where('id', $top_perfopass->commercial_id)->first(); @endphp
                                                    <!-- Card -->
                                                    @if($commerpass)
                                                        <li><a href="{{route('voir_sesVente_dumoispasse',$commerpass->id)}}" data-toggle="tooltip" title="Voir les ventes de {{($commerpass) ? $commerpass->prenom : ''}}">{{($commerpass) ? $commerpass->prenom : ''}} {{($commerpass) ? $commerpass->nom : ''}}</a>
                                                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                                                {{number_format($top_perfopass->total)}} Fcfa 
                                                                <p style="text-align:right; margin-top:5px; color:#0093a2;" class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                                                  @if($commerpass->objectif_mois)
                                                                  {{intval(($top_perfopass->total)*100 / $commerpass->objectif_mois)}}  % 
                                                                  @else
                                                                 
                                                                  @endif
                                                                </p>
                                                            </p>
                                                        </li>
                            
                                                    @endif
                                                @endforeach
                                                @endif
                                            </ul>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    <div class="main4">
                      <div class="grid gap-6 lg-12 md:grid-cols-12 xl:grid-cols-10">
                                 <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                    <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                                       Opportunités par statut (ce mois)
                                    </h4>
                                    <div id="piechart" style="width: 100%; height: 300px;">&nbsp;</div>
                                </div>
                            </div>
                    </div>
                    
                        <div class="main5">
                            <div class="grid gap-6 lg-12 md:grid-cols-12 xl:grid-cols-10">
                                <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                    <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                                       Opportunités par statut (le mois passée)
                                    </h4>
                                    <div id="piechartNew" style="width: 100%; height: 300px;">&nbsp;</div>
                                </div>
                            </div>
                        </div>
                </div>  
                
                 <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                    
                    <!-- Card -->
                    
                     <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hdd-stack-fill" viewBox="0 0 16 16">
                                  <path d="M2 9a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1a2 2 0 0 0-2-2H2zm.5 3a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm2 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zM2 2a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm.5 3a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm2 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1z"/>
                                </svg>
                              </div>
                               <a href="/tous_hot_deals">
                              <div>  
                                  @php  
                                  $hot_deals = DB::table('opportunites')->where('archiver', 0)->where('probabilite', '>=', 60)->orderBy('probabilite', 'asc')->count();
                                   $count_hot_deals = $hot_deals -1;
                                   @endphp
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les hot deals ">
                                    Hot deals
                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{number_format($hot_deals)}} 
                                </p>
                              </div>
                              </a>
                    </div>
                    
                      <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar" viewBox="0 0 16 16">
                              <path d="M3.5 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM3 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm12-1v14h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zm-1 0H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h9V1z"/>
                            </svg>
                              </div>
                               <a href="/plannings">
                              <div> 
                                 @php
                                 $commercial = App\Commerciau::where('user_id', Auth::user()->id)->first();
                                    $planning = DB::table('prospections')
                                    ->where('statut',0)
                                    ->whereYear('created_at', $annee)
                                    ->whereMonth('created_at', $mois)
                                    ->whereDay('created_at', '>=',  $weekday_mondaythis)
                                    ->whereDay('created_at', '<=', $weekday_sundaythis)
                                    ->orderby('date', 'desc')->count();

                                 @endphp
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" title="Mes rendez-vous" >
                                  Les rendez-vous de la semaine
                                </button>   
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{number_format($planning)}} 
                                </p>
                                
                              </div>
                              </a>
                    </div>
                    
                    
                    
                    
                    

                </div>
             @else
                     
                      <!-- Card -->
             <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800" >
                      <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                          <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                          </path>
                        </svg>
                      </div>
        
                        <a href="/opportunites"> <div>
                        @php $deadline = date('Y-m-d');  $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                            $op = DB::table('opportunites')->where('commercial_id', $commercial->id)->where('archiver', 0 )->whereIn('origine_id', [1,2] )->count(); @endphp
                        @php $prospects = DB::table('prospects')->where('commercial_id', $commercial->id)->where('strategique', 1)->get();
                        
                        $eche = array();
                        foreach($prospects as $prospect)
                       
                           {
                                $opportunite_critique = DB::table('opportunites')->where('archiver', 0 )->where('prospect_id', $prospect->id)->OrderBy('created_at', 'desc')->get();
                                 
                                foreach($opportunite_critique as $opportunite_critiquesf)
                                {
                                
                                
                                $actions = DB::table('action_commerciales')->where('cloture', 0 )->where('opportunite_id', $opportunite_critiquesf->id)->OrderBy('created_at', 'desc')->get();
                                 
                                foreach($actions as $action)
                                 array_push($eche, $action);
                                 
                                }
                         
                            }
                                
                            $opportunite = DB::table('opportunites')->where('archiver', 0 )->whereIn('origine_id', [1,2] )->where('opportunites.statut', '!=', 18 )->where('deadline', '>=', $deadline )->OrderBy('created_at', 'desc')->count();
                        @endphp
                   
                       
                        <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les appels offres en cours">
                            Appels d’offres en cours
                        </button>
                       
    
                        
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        
                          {{$opportunite}}
                        </p>
                      </div>
                      </a>
                    </div>
                    
                    
                    <!-- Card -->
                    
                   
                    <!-- Card -->
                   
                    
                    
                                <!-----------gestion des appels------------------------------------>
                   <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-outbound-fill" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM11 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-4.146 4.147a.5.5 0 0 1-.708-.708L14.293 1H11.5a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                              </div>
                               <a href="/gestion_appels">
                              <div>
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir mes activités de prospection">
                                   Ma prospection
                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                </p>
                              </div>
                              </a>
                    </div>
                    
                    
                    
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar" viewBox="0 0 16 16">
                              <path d="M3.5 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM3 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm12-1v14h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zm-1 0H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h9V1z"/>
                            </svg>
                              </div>
                               <a href="/dash_ventes">
                              <div>
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les ventes">
                                   Ventes
                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                </p>
                              </div>
                              </a>
                    </div>
                 
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-data" viewBox="0 0 16 16">
                              <path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0V9z"/>
                              <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                              <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                            </svg>
                              </div>
                               <a href="/dash_rapports">
                              <div>
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les rapports">
                                   Rapports
                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                </p>
                              </div>
                              </a>
                    </div>
                    
                      <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar" viewBox="0 0 16 16">
                              <path d="M3.5 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM3 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm12-1v14h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zm-1 0H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h9V1z"/>
                            </svg>
                              </div>
                               <a href="/tous_mon_plannings">
                              <div>
                                 @php
                                 $commercial = App\Commerciau::where('user_id', Auth::user()->id)->first();
                                    $planning = DB::table('prospections')->where('commercial_id', $commercial->id)->where('statut',0)->orderby('date', 'desc')->count();

                                 @endphp
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" title="Mes rendez-vous" >
                                  Mes rendez-vous
                                </button>   
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{number_format($planning)}} 
                                </p>
                                
                              </div>
                              </a>
                    </div>
                    
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hdd-stack-fill" viewBox="0 0 16 16">
                                  <path d="M2 9a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1a2 2 0 0 0-2-2H2zm.5 3a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm2 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zM2 2a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm.5 3a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm2 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1z"/>
                                </svg>
                              </div>
                               <a href="/lister_entreprises">
                              <div>  
                                  @php  
                                 $commercial_number = App\Commerciau::where('user_id', Auth::user()->id)->first();
                                    $entreprise_number = DB::table('prospects')->where('commercial_id', $commercial_number->id)->count();
                                    
                                   @endphp
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les hot deals ">
                                    Mes prospects
                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{number_format($entreprise_number)}} 
                                </p>
                              </div>
                              </a>
                    </div>
                    
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hdd-stack-fill" viewBox="0 0 16 16">
                                  <path d="M2 9a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1a2 2 0 0 0-2-2H2zm.5 3a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm2 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zM2 2a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm.5 3a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm2 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1z"/>
                                </svg>
                              </div>
                               <a href="/suivi_opportunites">
                              <div>  
                                  @php  
                                  
                                          $opportunite_number = DB::table('opportunites')->where('commercial_id', $commercial_number->id)->where('archiver', 0)->count();

                                   @endphp
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les hot deals ">
                                    Mes opportunités
                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{number_format($opportunite_number)}} 
                                </p>
                              </div>
                              </a>
                    </div>
                    

                </div>
            @endif   
          <!-- Cards -->
         
                 <!--------------------------------------------------------------------------------------------------------------------->
                 
                 <!------------------------------------------------------------------------------------------------------------------------------------->
                 
                                        @php 
                                            $top_mois = date('m'); 
                                            $top_performer = DB::table('ventes')->groupBy('commercial_id')->whereYear('created_at', $annee)
                                            ->whereMonth('created_at', $top_mois)
                                            ->sum('montant'); 
                                         @endphp  
                
                   @php 
                       
                       $topComAppelt = DB::table('suivi_prospects')->select('commercial_id','created_at','type', DB::raw('count(type) as `total`'))
                       ->whereYear('created_at', $annee)
                       ->whereMonth('created_at', $top_mois)
                       ->groupBy('commercial_id')->orderBy('total','DESC')->paginate(4);  

                       @endphp
                       
            @if(count($topComAppelt) > 0)
                  <h3 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                  Top prospecteurs du mois (RV obtenu)
                  <span
                            class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Liste des actions à venir">
                            <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"
                                href="/top_commerciaux_tri">
                                Voir les résultats du trimestre en cours
                            </a>
                        </span>
                </h3>
            @else
            
            @endif
            
            
               <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                  
               
               
               
                   <!-- start top meilleur --> 
                    
                  @php 
                  
                   $weekf = [];
                    $saturday = strtotime('monday this week');
                    foreach (range(0, 6) as $day) {
                        $weekf[] = date("Y-m-d", (($day * 86400) + $saturday));
                    }
                   
                  
                       $topComAppel = DB::table('suivi_prospects')->select('commercial_id','created_at','type', DB::raw('count(type) as `totals`'))
                       ->groupBy('commercial_id')
                       ->where('type', 1)
                       ->whereMonth('created_at', '=', $mois)
                       ->whereYear('created_at', '=', $annee)
                       ->orderBy('totals','DESC')->paginate(4); 
                        
                      
                   
                       @endphp
                       @foreach($topComAppel as $top_perfoAb)        
                       @php  $commerTop = DB::table('commerciaus')->where('id', $top_perfoAb->commercial_id)->first(); @endphp
                    <!-- Card -->
                      @if($commerTop)
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                    </svg>
                              </div>
                            
                             <!--<a href="{{route('voir_sesVente_dumois',$commerTop->id)}}" data-toggle="tooltip" title="Voir les ventes de {{($commerTop) ? $commerTop->prenom : ''}}">-->
                                <div>
                            <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                 {{($commerTop) ? $commerTop->prenom : ''}} {{($commerTop) ? $commerTop->nom : ''}}
                            </button>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                              @if($top_perfoAb->totals == 1){{number_format($top_perfoAb->totals)}} Appel @else ($top_perfoAb->totals > 1){{number_format($top_perfoAb->totals)}} Appels @endif
                              <p style="text-align:right; margin-top:5px; color:#0093a2;" class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                  @if(($commerTop) ? $commerTop->nbre_appel_quotidien != null : '')
                                  <!--{{intval(($top_perfoAb->totals)*100 / ($commerTop->nbre_appel_quotidien * 20)	)}}  % -->
                                  @else
                                 <!--0%-->
                                  @endif
                                  </p>
                            </p>
                          </div>
                          <!--</a>-->
                        
                         
                        </div>
@endif
                    @endforeach
                    <!-- end Card -->
                     </div>
                     
          </div>
         
      
          
          @php 
            $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
            $opportunite_perdu = DB::table('opportunites')->where('commercial_id', $commercial->id)->where('archiver', 0)->where('statut', 18)->count();
            $contractualisation = DB::table('opportunites')->where('commercial_id', $commercial->id)->where('archiver', 0)->where('statut', 15)->count();
            $cahier_charge = DB::table('opportunites')->where('commercial_id', $commercial->id)->where('archiver', 0)->where('statut', 12)->count();
            $contrat_initial = DB::table('opportunites')->where('commercial_id', $commercial->id)->where('archiver', 0)->where('statut', 11)->count();
            $interet_confirme = DB::table('opportunites')->where('commercial_id', $commercial->id)->where('archiver', 0)->where('statut', 10)->count();
            $offre_envoyer = DB::table('opportunites')->where('commercial_id', $commercial->id)->where('archiver', 0)->where('statut', 14)->count();
            $negociation = DB::table('opportunites')->where('commercial_id', $commercial->id)->where('archiver', 0)->where('statut', 13)->count();
            $contrat_signe = DB::table('opportunites')->where('commercial_id', $commercial->id)->where('archiver', 0)->where('statut', 16)->count();
            
          @endphp
          
          
           @php
                            $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                            $vente_janvier = DB::table('ventes')->whereYear('created_at', $annee)->whereMonth('created_at', 1)->sum('montant');
                            $vente_fevrier = DB::table('ventes')->whereYear('created_at', $annee)->whereMonth('created_at', 2)->sum('montant');
                            $vente_mars = DB::table('ventes')->whereYear('created_at', $annee)->whereMonth('created_at', 3)->sum('montant');
                            $vente_avril = DB::table('ventes')->whereYear('created_at', $annee)->whereMonth('created_at', 4)->sum('montant');
                            $vente_mai = DB::table('ventes')->whereYear('created_at', $annee)->whereMonth('created_at', 5)->sum('montant');
                            $vente_juin = DB::table('ventes')->whereYear('created_at', $annee)->whereMonth('created_at', 6)->sum('montant');
                            $vente_juillet = DB::table('ventes')->whereYear('created_at', $annee)->whereMonth('created_at', 7)->sum('montant');
                            $vente_aout = DB::table('ventes')->whereYear('created_at', $annee)->whereMonth('created_at', 8)->sum('montant');
                            $vente_sep = DB::table('ventes')->whereYear('created_at', $annee)->whereMonth('created_at', 9)->sum('montant');
                            $vente_oct = DB::table('ventes')->whereYear('created_at', $annee)->whereMonth('created_at', 10)->sum('montant');
                            $vente_nov = DB::table('ventes')->whereYear('created_at', $annee)->whereMonth('created_at', 11)->sum('montant');
                            $vente_dec = DB::table('ventes')->whereYear('created_at', $annee)->whereMonth('created_at', 12)->sum('montant');
                            
                            $objectif =  $commercial->objectif_mois ; 
                            
                            $objCommer = DB::table('commerciaus')
                           ->where('id', $commercial->id)
                           ->first();  
                            $objMois = date('m');    
                           
                            $obj_janvier_mois = DB::table('stock_mensuelles')->whereYear('created_at', $annee)->whereMonth('created_at', 1)->first();
                            $obj_oct_mois = DB::table('stock_mensuelles')->whereYear('created_at', $annee)->whereMonth('created_at', 10)->first();

                            $obj_janvier = DB::table('stock_mensuelles')->whereYear('created_at', $annee)->whereMonth('created_at', 1)->sum('objectif_mois');
                            $obj_fevrier = DB::table('stock_mensuelles')->whereYear('created_at', $annee)->whereMonth('created_at', 2)->sum('objectif_mois');
                            $obj_mars = DB::table('stock_mensuelles')->whereYear('created_at', $annee)->whereMonth('created_at', 3)->sum('objectif_mois');
                            $obj_avril = DB::table('stock_mensuelles')->whereYear('created_at', $annee)->whereMonth('created_at', 4)->sum('objectif_mois');
                            $obj_mai = DB::table('stock_mensuelles')->whereYear('created_at', $annee)->whereMonth('created_at', 5)->sum('objectif_mois');
                            $obj_juin = DB::table('stock_mensuelles')->whereYear('created_at', $annee)->whereMonth('created_at', 6)->sum('objectif_mois');
                            $obj_juillet = DB::table('stock_mensuelles')->whereYear('created_at', $annee)->whereMonth('created_at', 7)->sum('objectif_mois');
                            $obj_aout = DB::table('stock_mensuelles')->whereYear('created_at', $annee)->whereMonth('created_at', 8)->sum('objectif_mois');
                            $obj_sep = DB::table('stock_mensuelles')->whereYear('created_at', $annee)->whereMonth('created_at', 9)->sum('objectif_mois');
                            $obj_oct = DB::table('stock_mensuelles')->whereYear('created_at', $annee)->whereMonth('created_at', 10)->sum('objectif_mois');
                            $obj_nov = DB::table('stock_mensuelles')->whereYear('created_at', $annee)->whereMonth('created_at', 11)->sum('objectif_mois');
                            $obj_dec = DB::table('stock_mensuelles')->whereYear('created_at', $annee)->whereMonth('created_at', 12)->sum('objectif_mois');
                            
                            $obj_octMois = DB::table('stock_mensuelles')->whereYear('created_at', $annee)->whereMonth('created_at', $objMois)->first();

                       
                        @endphp

          
          <!--Mes actions-->
          <h3 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
           Mes actions commerciales
          
          
                        <span
                            class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Liste des actions à venir">
                            <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"
                                href="/mesactions_a_venir">
                                Action à venir
                            </a>
                        </span></h3>
          <!-- New Table -->
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
             <div class="w-full overflow-hidden rounded-lg shadow-xs">
              @php
                $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                
                $week = [];
                $saturday = strtotime('monday this week');
                foreach (range(0, 6) as $day) {
                    $week[] = date("Y-m-d", (($day * 86400) + $saturday));
                }
                $action_com = array();
                foreach($week as $weeks)
                 { 
                    $action_comf = DB::table('action_commerciales')
                    ->where('cloture', 0)->where('commercial_id', $commercial->id)
                    ->whereDay('deadline', '=',date('d', strtotime($weeks)))
                    ->whereMonth('deadline', '=',date('m', strtotime($weeks)))
                        ->whereYear('deadline', '=',date('Y', strtotime($weeks)))
                    ->get();
                   
                   foreach($action_comf as $action_comfs){
                    array_push($action_com, $action_comfs);
                    }
                    
                }
                
                @endphp
              @if(count($action_com) == 0) 
                 	  <p class="dark:text-gray-400">Pas d'action</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Opportunités</th>
                    <th class="px-4 py-3">Actions</th>
                    <th class="px-4 py-3">Deadline</th>
                    <th class="px-4 py-3">Statut</th>
                    <th class="px-4 py-3">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                   
                @php
                    $semaineM7 = (date('d') -7);
                    $action_semaineP7 = (date('d') +7);
                    $action_mois = date('m');
                    $action_year = date('Y');
                 @endphp
                 
                    @foreach($action_com as $action)
                    @if( ($action_semaineP7 >= date('d', strtotime($action->deadline))) && ($semaineM7 <= date('d', strtotime($action->deadline))) && ($action_mois == date('m', strtotime($action->deadline))) && ($action_year == date('Y', strtotime($action->deadline))) )

                    @if($action)
                  <tr class="text-gray-700 dark:text-gray-400">
                       @php $opp = DB::table('opportunites')->where('id', $action->opportunite_id)->first();
                        $prosAction = DB::table('prospects')->where('id', $action->prospect_id)->first(); @endphp
                        
                       @if($opp)
                                   @php
                                     $OpportuniteProspect = DB::table('prospects')->where('id', $opp->prospect_id)->first();
                                 @endphp
                    
                    <td class="px-4 py-3">

                      <div class="flex items-center text-sm">
                       
                            <span class="px-3 py-1 text-sm " data-toggle="tooltip" title="{{$opp->libelle}}">
                              <h4>{{ \Illuminate\Support\Str::limit($opp->libelle, 30, $end='...') }}</h4>
                            </span>
                            
                                @if($OpportuniteProspect)
                                 <b style="color:#9045e2"  data-toggle="tooltip" title="{{$OpportuniteProspect->nom_entreprise}}">
                                 ({{ strtoupper(($OpportuniteProspect->nom_entreprise) ? \Illuminate\Support\Str::limit($OpportuniteProspect->nom_entreprise, 30, $end='...') : '')}})</b>
                                @else
                                    Non renseigné
                                @endif
                                </div>
                      @elseif($prosAction)
                        <td class="px-4 py-3 text-xs" >
                          <span class="px-3 py-1 text-sm " data-toggle="tooltip" title="{{$prosAction->nom_entreprise}}">
                              <b style="color:#9045e2" >{{ \Illuminate\Support\Str::limit($prosAction->nom_entreprise, 30, $end='...') }}</b>
                            </span>
                        </td>
                     @else
                        <td class="px-4 py-3 text-xs" >
                          <span class="px-3 py-1 text-sm " >
                              Non renseigné
                            </span>
                        </td>
                     @endif
                     
                    <td class="px-4 py-3 text-sm">
                      <span class="btn btn-primary btn-lg btn-block font-semibold">
                       {{($action->libelle) ? $action->libelle : ''}}
                      </span>
                    </td>
                    <td class="px-4 py-3 text-xs">
                      <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        {{($action->deadline) ? $action->deadline : '--'}}
                      </span>
                    </td>
                    <td class="text-gray-700 dark:text-gray-400">
                      @if($action->cloture == 0)
                      <p style="color:orange"> En cours </p>
                      @else
                      <p style="color:green"> Fait </p>
                      @endif
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <span
                            class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Clôturer l'action">
                            <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"
                                href="{{route('cloturerAction', $action->id )}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                                  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                  <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
                                </svg>
                            </a>
                        </span>
                    </td>
                  </tr>
                  @endif
                  @endif
                  @endforeach

                </tbody>
              </table>
            <br> <br>
            </div>

            @endif
          </div>
          
           @php 
               $smoispass = (date('m') - 1);
            $opportunite_perdu = DB::table('opportunites')->where('archiver', 0)->where('statut', 18)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->count();
            $contractualisation = DB::table('opportunites')->where('archiver', 0)->where('statut', 15)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->count();
            $cahier_charge = DB::table('opportunites')->where('archiver', 0)->where('statut', 12)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->count();
            $contrat_initial = DB::table('opportunites')->where('archiver', 0)->where('statut', 11)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->count();
            $interet_confirme = DB::table('opportunites')->where('archiver', 0)->where('statut', 10)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->count();
            $offre_envoyer = DB::table('opportunites')->where('archiver', 0)->where('statut', 14)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->count();
            $negociation = DB::table('opportunites')->where('archiver', 0)->where('statut', 13)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->count();
            $contrat_signe = DB::table('opportunites')->where('archiver', 0)->where('statut', 16)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->count();
            
            $opportunite_perdu_pass = DB::table('opportunites')->where('archiver', 0)->where('statut', 18)->whereYear('created_at', $annee)->whereMonth('created_at', $smoispass)->count();
            $contractualisation_pass = DB::table('opportunites')->where('archiver', 0)->where('statut', 15)->whereYear('created_at', $annee)->whereMonth('created_at', $smoispass)->count();
            $cahier_charge_pass = DB::table('opportunites')->where('archiver', 0)->where('statut', 12)->whereYear('created_at', $annee)->whereMonth('created_at', $smoispass)->count();
            $contrat_initial_pass = DB::table('opportunites')->where('archiver', 0)->where('statut', 11)->whereYear('created_at', $annee)->whereMonth('created_at', $smoispass)->count();
            $interet_confirme_pass = DB::table('opportunites')->where('archiver', 0)->where('statut', 10)->whereYear('created_at', $annee)->whereMonth('created_at', $smoispass)->count();
            $offre_envoyer_pass = DB::table('opportunites')->where('archiver', 0)->where('statut', 14)->whereYear('created_at', $annee)->whereMonth('created_at', $smoispass)->count();
            $negociation_pass = DB::table('opportunites')->where('archiver', 0)->where('statut', 13)->whereYear('created_at', $annee)->whereMonth('created_at', $smoispass)->count();
            $contrat_signe_pass = DB::table('opportunites')->where('archiver', 0)->where('statut', 16)->whereYear('created_at', $annee)->whereMonth('created_at', $smoispass)->count();
      
          @endphp
   
                <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                    <script type="text/javascript">
                    google.load("visualization", "1", {packages:["corechart"]});
                    google.setOnLoadCallback(drawChart);
                    function drawChart() {
                    // Chart 1
                    var data = google.visualization.arrayToDataTable([['OS Mobile', 'Parts de marché'],["Négociation",{{$negociation}}],["Offre envoyée",{{$offre_envoyer}}]
                        ,["Contrat signé",{{$contrat_signe}}],["Intérêt confirmé",{{$interet_confirme}}],["Contact initial",{{$contrat_initial}}],["Cahier de charges reçu",{{$cahier_charge}}],["Contractualisation en cours",{{$contractualisation}}],["Opportunitée perdue",{{$opportunite_perdu}}]
                    ]);
                    var options = {
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                    chart.draw(data, options);
                    }
                </script>
                    
                <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                    <script type="text/javascript">
                    google.load("visualization", "1", {packages:["corechart"]});
                    google.setOnLoadCallback(drawChart);
                    function drawChart() {
                    // Chart 1
                    var data = google.visualization.arrayToDataTable([['OS Mobile', 'Parts de marché'],["Négociation",{{$negociation_pass}}],["Offre envoyée",{{$offre_envoyer_pass}}]
                        ,["Contrat signé",{{$contrat_signe_pass}}],["Intérêt confirmé",{{$interet_confirme_pass}}],["Contact initial",{{$contrat_initial_pass}}],["Cahier de charges reçu",{{$cahier_charge_pass}}],["Contractualisation en cours",{{$contractualisation_pass}}],["Opportunitée perdue",{{$opportunite_perdu_pass}}]
                    ]);
                    var options = {
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('piechartNew'));
                    chart.draw(data, options);
                    }
                </script>
        </div>
      </main>
    </div>
  </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<!--<script>-->

          

<!--var ctx = document.getElementById("myChart");-->
<!--var myChart = new Chart(ctx, {-->
<!--  type: 'pie',-->
<!--  data: {-->
<!--    labels: ['Négociation', 'Offre envoyée', 'Contrat signé', 'Intérêt confirmé', 'Contact initial', 'Cahier de charges reçu', 'Contractualisation en cours', 'Opportunitée perdue'],-->
<!--    datasets: [{-->
<!--      label: '# of Tomatoes',-->
<!--      data: [{{$negociation}}, {{$offre_envoyer}}, {{$contrat_signe}}, {{$interet_confirme}}, {{$contrat_initial}}, {{$cahier_charge}} , {{$contractualisation}}, {{$opportunite_perdu}}],-->
<!--      backgroundColor: [-->
<!--        'rgba(54, 162, 235, 0.2)',-->
<!--        'rgba(255, 206, 86, 0.2)',-->
<!--        'rgba(75, 192, 192, 0.2)'-->
<!--      ],-->
<!--      borderColor: [-->
<!--        'rgba(54, 162, 235, 1)',-->
<!--        'rgba(255, 206, 86, 1)',-->
<!--        'rgba(75, 192, 192, 1)'-->
<!--      ],-->
<!--      borderWidth: 1-->
<!--    }]-->
<!--  },-->
<!--  options: {-->
   	<!--//cutoutPercentage: 40,-->
<!--    responsive: false,-->

<!--  }-->
<!--});-->
<!--</script>-->

<script>
    /**
 * For usage, visit Chart.js docs https://www.chartjs.org/docs/latest/
 */
const lineConfig = {
  type: 'line',
  data: {
    labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
    datasets: [
      {
            label: 'Objectifs',
        /**
         * These colors come from Tailwind CSS palette
         * https://tailwindcss.com/docs/customizing-colors/#default-color-palette
         */
        backgroundColor: '#0694a2',
        borderColor: '#0694a2',
        data: [
      @if($objMois == 1) {{$objCommer->objectif_mois}}  @else{{$obj_janvier}}@endif
      , @if($objMois == 2) {{$objCommer->objectif_mois}}  @else{{$obj_fevrier}}@endif
      , @if($objMois == 3) {{$objCommer->objectif_mois}}  @else{{$obj_mars}}@endif
      , @if($objMois == 4) {{$objCommer->objectif_mois}}  @else{{$obj_avril}}@endif
      , @if($objMois == 5) {{$objCommer->objectif_mois}}  @else{{$obj_mai}}@endif
      , @if($objMois == 6) {{$objCommer->objectif_mois}}  @else{{$obj_juin}}@endif
      , @if($objMois == 7) {{$objCommer->objectif_mois}}  @else{{$obj_juillet}}@endif
      , @if($objMois == 8) {{$objCommer->objectif_mois}}  @else{{$obj_aout}}@endif
      , @if($objMois == 9) {{$objCommer->objectif_mois}}  @else{{$obj_sep}}@endif, 
        @if($objMois == 10) {{$objCommer->objectif_mois}}  @else {{$obj_oct}} @endif
      , @if($objMois == 11) {{$objCommer->objectif_mois}}  @else{{$obj_nov}}@endif
      , @if($objMois == 12) {{$objCommer->objectif_mois}}  @else{{$obj_dec}}@endif],
        fill: false,
      },
      {
        label: 'Réalisations',
        fill: false,
        /**
         * These colors come from Tailwind CSS palette
         * https://tailwindcss.com/docs/customizing-colors/#default-color-palette
         */
        backgroundColor: '#7e3af2',
        borderColor: '#7e3af2',
        data: [{{$vente_janvier}}, {{$vente_fevrier}}, {{$vente_mars}}, {{$vente_avril}}, {{$vente_mai}}, {{$vente_juin}}, {{$vente_juillet}}, {{$vente_aout}}, {{$vente_sep}}, {{$vente_oct}}, {{$vente_nov}}, {{$vente_dec}}],
      },
    ],
  },
  options: {
    responsive: true,
    /**
     * Default legends are ugly and impossible to style.
     * See examples in charts.html to add your own legends
     *  */
    legend: {
      display: false,
    },
    tooltips: {
      mode: 'index',
      intersect: false,
    },
    hover: {
      mode: 'nearest',
      intersect: true,
    },
    scales: {
      x: {
        display: true,
        scaleLabel: {
          display: true,
          labelString: 'Month',
        },
      },
      y: {
        display: true,
        scaleLabel: {
          display: true,
          labelString: 'Value',
        },
      },
    },
  },
}

// change this to the id of your chart element in HMTL
const lineCtx = document.getElementById('lineGN')
window.myLine = new Chart(lineCtx, lineConfig)

</script>


   <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/init-alpine.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
 


</body>

</html>