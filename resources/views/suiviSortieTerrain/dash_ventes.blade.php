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
            Ventes
          </h3>
           <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
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
          <!-- Cards -->
          <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
              
             @php $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first(); @endphp
                <!-- start perfo -->
              
                    
                    <!-- Card -->
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                      <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd"
                            d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                            clip-rule="evenodd"></path>
                        </svg>
                      </div>
                      <a href="/mes_vente_deumois">
                      <div>
                          @php 
                            $mois = date('m');
                            $annee = date('Y'); 
                          @endphp
                           @php  $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->sum('montant');
                           if($commercial->objectif_mois){
                                $pourcentage_mois = $vente * (100) / ($commercial->objectif_mois);
                                }
                            else{
                                $pourcentage_mois = 0;
                            }
                           @endphp
                        <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir mes ventes">
                            CA réalisé 
                        </button>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                          {{number_format($vente)}} Fcfa
                         <p style="text-align:right; margin-top:5px; color:#0093a2;" class="text-lg font-semibold text-gray-800 dark:text-gray-200"> {{intval($pourcentage_mois)}}% </p>
                        </p>
                      </div></a>
                    </div>
                    
                    <!-- Card -->
                   
                   <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                  <path
                                    d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                                  </path>
                                </svg>
                              </div>
                               <a href="/mescommisions_dumois">
                              <div>
                                  @php  $commission = DB::table('commissions')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->sum('commission'); @endphp
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir mes commissions">
                                    Commissions  
                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{number_format($commission)}} Fcfa
                                </p>
                              </div>
                              </a>
                    </div>
                    <!-- Card -->
                   <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                  <path
                                    d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                                  </path>
                                </svg>
                              </div>
                               <a href="/nouveaux_clients">
                              <div>
                                  @php  $nvx_clients = array();  
                                  $opp_vendu = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->get(); 
                                        foreach($opp_vendu as $opp_vendus){
                                            $opp = DB::table('opportunites')->where('id', $opp_vendus->opportunite_id)->first();
                                            $nvx_clientss = DB::table('prospects')->where('id', $opp->prospect_id)->get(); 
                                            array_push($nvx_clients,$nvx_clientss);
                                        }
                                  @endphp
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir mes nouveaux clients">
                                    Nouveaux clients  
                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{count($nvx_clients)}}
                                </p>
                              </div>
                              </a>
                    </div>
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                  <path
                                    d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                                  </path>
                                </svg>
                              </div>
                               <a href="/total_clients">
                              <div>
                                  @php  $nvx_clientsT = array();  
                                  $opp_venduT = DB::table('ventes')->where('commercial_id', $commercial->id)->get();
                                        foreach($opp_venduT as $opp_vendusT){
                                            $oppT = DB::table('opportunites')->where('id', $opp_vendusT->opportunite_id)->first();
                                            if($oppT){
                                            $nvx_clientssT = DB::table('prospects')->where('id', $oppT->prospect_id)->get(); 
                                            
                                            array_push($nvx_clientsT,$nvx_clientssT);
                                            }
                                        }
                                  @endphp
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir mes clients">
                                    Total clients  
                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{count($nvx_clientsT)}}
                                </p>
                              </div>
                              </a>
                    </div>
                     <!-- Card -->
                     
                     
                  
                     <!-- end perfo -->
                 </div>
                  
                 <!--------------------------------------------------------------------------------------------------------------------->
                 @if(Auth::user()->nom_role == "directeur")
                 <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
              
                    <!-- <a href="/ventes_sn" data-toggle="tooltip" title="Rapport global de performance commerciale">
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                       
                        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar" viewBox="0 0 16 16">
                              <path d="M3.5 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM3 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm12-1v14h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zm-1 0H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h9V1z"/>
                            </svg>
                        </div>
                    <div>
                    <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" style="display:flex;">
                     <span>Les CA réalisés </span>  <span><img src="{{asset('pays/sn.png')}}" style="width:20px; margin-top:3px; margin-left:2px;"></span>
                    </button>
                    
                    </div>
                    </div>
                    </a>-->
                    
                     <a href="/objectif_ventes" data-toggle="tooltip" title="Objectifs et réalisations">
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                       
                        <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-data" viewBox="0 0 16 16">
                              <path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0V9z"/>
                              <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                              <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                            </svg>
                        </div>
                    <div>
                    <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >
                        Objectif / réalisation 
                    </button>
                    </div>
                    </div>
                    </a>
                    
                     <a href="/ventes_bf" data-toggle="tooltip" title="Rapport global de performance commerciale">
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                       
                        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar" viewBox="0 0 16 16">
                              <path d="M3.5 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM3 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm12-1v14h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zm-1 0H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h9V1z"/>
                            </svg>
                        </div>
                    <div>
                    <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" style="display:flex;">
                     <span>Les CA réalisés (team) </span>  
                    </button>
                    
                    </div>
                    </div>
                    </a>
                    <a href="/tous_commisions_dumois" data-toggle="tooltip" title="Voir les commissions des commericaux">
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                       
                        <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-exchange" viewBox="0 0 16 16">
                              <path d="M0 5a5.002 5.002 0 0 0 4.027 4.905 6.46 6.46 0 0 1 .544-2.073C3.695 7.536 3.132 6.864 3 5.91h-.5v-.426h.466V5.05c0-.046 0-.093.004-.135H2.5v-.427h.511C3.236 3.24 4.213 2.5 5.681 2.5c.316 0 .59.031.819.085v.733a3.46 3.46 0 0 0-.815-.082c-.919 0-1.538.466-1.734 1.252h1.917v.427h-1.98c-.003.046-.003.097-.003.147v.422h1.983v.427H3.93c.118.602.468 1.03 1.005 1.229a6.5 6.5 0 0 1 4.97-3.113A5.002 5.002 0 0 0 0 5zm16 5.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0zm-7.75 1.322c.069.835.746 1.485 1.964 1.562V14h.54v-.62c1.259-.086 1.996-.74 1.996-1.69 0-.865-.563-1.31-1.57-1.54l-.426-.1V8.374c.54.06.884.347.966.745h.948c-.07-.804-.779-1.433-1.914-1.502V7h-.54v.629c-1.076.103-1.808.732-1.808 1.622 0 .787.544 1.288 1.45 1.493l.358.085v1.78c-.554-.08-.92-.376-1.003-.787H8.25zm1.96-1.895c-.532-.12-.82-.364-.82-.732 0-.41.311-.719.824-.809v1.54h-.005zm.622 1.044c.645.145.943.38.943.796 0 .474-.37.8-1.02.86v-1.674l.077.018z"/>
                            </svg>
                        </div>
                    <div>
                    <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >
                        Les commissions (team)
                    </button>
                    </div>
                    </div>
                    </a>
                    
                    
                     <!--<a href="/ventes_technologies" data-toggle="tooltip" title="Rapport global de performance commerciale">
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                       
                        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar" viewBox="0 0 16 16">
                              <path d="M3.5 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM3 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm12-1v14h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zm-1 0H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h9V1z"/>
                            </svg>
                        </div>
                    <div>
                    <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" style="display:flex;">
                     <span>Les CA réalisés (TECHNOLOGIES)</span>
                    </button>
                    
                    </div>
                    </div>
                    </a>-->
                    
                     <!--<a href="/ventes_formation" data-toggle="tooltip" title="Rapport global de performance commerciale">
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                       
                        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar" viewBox="0 0 16 16">
                              <path d="M3.5 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM3 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm12-1v14h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zm-1 0H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h9V1z"/>
                            </svg>
                        </div>
                    <div>
                    <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" style="display:flex;">
                     <span>Les CA réalisés (FORMATION)</span>  
                    </button>
                    
                    </div>
                    </div>
                    </a>-->
                    <!-- Card -->
                    
                     <!-- end perfo -->
                
                 
                <!-- <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                  <path
                                    d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                                  </path>
                                </svg>
                              </div>
                               <a href="/nouveaux_clients_tous">
                              <div>
                                  @php  $nvx_clients = array();  
                                  $opp_vendu = DB::table('ventes')->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->get(); 
                                        foreach($opp_vendu as $opp_vendus){
                                            $opp = DB::table('opportunites')->where('id', $opp_vendus->opportunite_id)->first();
                                            $nvx_clientss = DB::table('prospects')->where('id', $opp->prospect_id)->get(); 
                                            array_push($nvx_clients,$nvx_clientss);
                                        }
                                  @endphp
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir mes nouveaux clients">
                                    Nouveaux clients (Team) 
                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{count($nvx_clients)}}
                                </p>
                              </div>
                              </a>
                    </div>
                     </div>-->
                 @elseif(Auth::user()->nom_role == "responsable"  or Auth::user()->nom_role == "responsable_pole")
                 <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
              
                     <!-- <a href="/ventes_sn" data-toggle="tooltip" title="Rapport global de performance commerciale">
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                       
                        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar" viewBox="0 0 16 16">
                              <path d="M3.5 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM3 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm12-1v14h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zm-1 0H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h9V1z"/>
                            </svg>
                        </div>
                    <div>
                    <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" style="display:flex;">
                     <span>Les CA réalisés </span>  <span><img src="{{asset('pays/sn.png')}}" style="width:20px; margin-top:3px; margin-left:2px;"></span>
                    </button>
                    
                    </div>
                    </div>
                    </a>-->
                    
                     <a href="/ventes_bf" data-toggle="tooltip" title="Rapport global de performance commerciale">
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                       
                        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar" viewBox="0 0 16 16">
                              <path d="M3.5 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM3 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm12-1v14h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zm-1 0H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h9V1z"/>
                            </svg>
                        </div>
                    <div>
                    <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" style="display:flex;">
                     <span>Les CA réalisés </span>  
                    </button>
                    
                    </div>
                    </div>
                    </a>
                    <a href="/tous_commisions_dumois_res" data-toggle="tooltip" title="Voir les commissions des commericaux">
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                       
                        <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-exchange" viewBox="0 0 16 16">
                              <path d="M0 5a5.002 5.002 0 0 0 4.027 4.905 6.46 6.46 0 0 1 .544-2.073C3.695 7.536 3.132 6.864 3 5.91h-.5v-.426h.466V5.05c0-.046 0-.093.004-.135H2.5v-.427h.511C3.236 3.24 4.213 2.5 5.681 2.5c.316 0 .59.031.819.085v.733a3.46 3.46 0 0 0-.815-.082c-.919 0-1.538.466-1.734 1.252h1.917v.427h-1.98c-.003.046-.003.097-.003.147v.422h1.983v.427H3.93c.118.602.468 1.03 1.005 1.229a6.5 6.5 0 0 1 4.97-3.113A5.002 5.002 0 0 0 0 5zm16 5.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0zm-7.75 1.322c.069.835.746 1.485 1.964 1.562V14h.54v-.62c1.259-.086 1.996-.74 1.996-1.69 0-.865-.563-1.31-1.57-1.54l-.426-.1V8.374c.54.06.884.347.966.745h.948c-.07-.804-.779-1.433-1.914-1.502V7h-.54v.629c-1.076.103-1.808.732-1.808 1.622 0 .787.544 1.288 1.45 1.493l.358.085v1.78c-.554-.08-.92-.376-1.003-.787H8.25zm1.96-1.895c-.532-.12-.82-.364-.82-.732 0-.41.311-.719.824-.809v1.54h-.005zm.622 1.044c.645.145.943.38.943.796 0 .474-.37.8-1.02.86v-1.674l.077.018z"/>
                            </svg>
                        </div>
                    <div>
                    <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >
                        Les commissions 
                    </button>
                    </div>
                    </div>
                    </a>
                    
                    
                    
                     <!--<a href="/ventes_technologies" data-toggle="tooltip" title="Rapport global de performance commerciale">
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                       
                        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar" viewBox="0 0 16 16">
                              <path d="M3.5 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM3 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm12-1v14h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zm-1 0H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h9V1z"/>
                            </svg>
                        </div>
                    <div>
                    <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" style="display:flex;">
                     <span>Les CA réalisés (TECHNOLOGIES)</span>
                    </button>
                    
                    </div>
                    </div>
                    </a>
                    
                     <a href="/ventes_formation" data-toggle="tooltip" title="Rapport global de performance commerciale">
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                       
                        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar" viewBox="0 0 16 16">
                              <path d="M3.5 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM3 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm12-1v14h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zm-1 0H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h9V1z"/>
                            </svg>
                        </div>
                    <div>
                    <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" style="display:flex;">
                     <span>Les CA réalisés (FORMATION)</span>  
                    </button>
                    
                    </div>
                    </div>
                    </a>-->
                    
                    <!-- Card -->
                    
                     <!-- end perfo -->
                 
                 <!--<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                  <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                      <path
                                        d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                                      </path>
                                    </svg>
                                  </div>
                               <a href="/nouveaux_clients_tous">
                                      <div>
                                          @php  $nvx_clients = array();  
                                          $opp_vendu = DB::table('ventes')->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->get(); 
                                                foreach($opp_vendu as $opp_vendus){
                                                    $opp = DB::table('opportunites')->where('id', $opp_vendus->opportunite_id)->first();
                                                    $nvx_clientss = DB::table('prospects')->where('id', $opp->prospect_id)->get(); 
                                                    array_push($nvx_clients,$nvx_clientss);
                                                }
                                          @endphp
                                        <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir mes nouveaux clients">
                                            Nouveaux clients (Team) 
                                        </button>
                                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                         {{count($nvx_clients)}}
                                        </p>
                                      </div>
                              </a>
                    </div>-->
                    
                    </div>
                 @endif
                 <!------------------------------------------------------------------------------------------------------------------------------------->
                 
                                   
                   
                       
            
          

          <!--Mes actions-->
         
          <!-- New Table -->
          
      </main>
    </div>
  </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  


   <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/init-alpine.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
 


</body>

</html>