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
            Prospection
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
           
                    
                   
                                <!-----------gestion des appels------------------------------------>
                   
                    @php 
                            $mois = date('m');
                            $annee = date('Y'); 
                          @endphp
                          
                    <!--<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hdd-stack-fill" viewBox="0 0 16 16">
                                  <path d="M2 9a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1a2 2 0 0 0-2-2H2zm.5 3a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm2 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zM2 2a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm.5 3a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm2 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1z"/>
                                </svg>
                              </div>
                               <a href="/suivi_opportunites">
                              <div>  
                                  @php  
                                  $opp = DB::table('opportunites')->where('commercial_id', $commercial->id)->where('archiver', 0)->count();
                                   
                                   @endphp
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir mes opportunités ">
                                    Opportunités 
                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{number_format($opp)}} 
                                </p>
                              </div>
                              </a>
                    </div>-->
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-outbound-fill" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM11 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-4.146 4.147a.5.5 0 0 1-.708-.708L14.293 1H11.5a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                              </div>
                               <a href="/prospects_a_appeler">
                              <div>
                                  @php $appels_a_effectuer = DB::table('prospect_a_appellers')->where('commercial_id', $commercial->id)->where('statut', null)->count(); @endphp
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les à effectuer">
                                   Prospects à appeler
                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{number_format($appels_a_effectuer)}} 
                                </p>
                              </div>
                              </a>
                    </div>
                    
                    
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                  <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                                </svg>
                              </div>
                               <a href="/appels_effectuer">
                              <div>  
                                  @php  
                                  $appels_effectuer = DB::table('suivi_prospects')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->count();
                                   
                                   @endphp
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les appels effectués ">
                                    Appels réalisés 
                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{number_format($appels_effectuer)}} 
                                  <p style="text-align:right; margin-top:5px; color:#0093a2;" class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                  @if($appels_a_effectuer != 0)
                                  {{intval(($appels_effectuer)*100 / ($appels_a_effectuer))}}  % 
                                  @else
                                 0%
                                  @endif
                                  </p>
                                </p>
                              </div>
                              </a>
                    </div>
                    
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                  <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                                </svg>
                              </div>
                               <a href="/appelsaqualifier">
                              <div>
                                  @php 
                                  $appelsaqualifier = DB::table('suivi_prospects')->where('type', 1)->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->count();
                                 @endphp
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les prospects qualifiés">
                                    Prospects qualifiés
                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{number_format($appelsaqualifier)}} 
                                 <p style="text-align:right; margin-top:5px; color:#0093a2;" class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                  @if($appels_effectuer != 0)
                                  {{intval(($appelsaqualifier)*100 / ($appels_effectuer))}}  % 
                                  @else
                                 0%
                                  @endif
                                  </p>
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
                               <a href="/appelsnonqualifier">
                              <div>
                                  @php   $appelsnonqualifier = DB::table('suivi_prospects')->where('type', 2)->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->count(); 
                                  
                                  @endphp
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les prospects non qualifiés">
                                    Prospects non qualifiés

                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{number_format($appelsnonqualifier)}} 
                                </p>
                              </div>
                              </a>
                    </div>
                    
                    
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-outbound-fill" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM11 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-4.146 4.147a.5.5 0 0 1-.708-.708L14.293 1H11.5a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                              </div>
                               <a href="/appels_arappeler">
                              <div>
                                  @php  $appels_arappeler = DB::table('suivi_prospects')->where('type', 5)->where('commercial_id', $commercial->id)->count(); @endphp
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les prospects à rappeler">
                                    Prospects à rappeler

                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{number_format($appels_arappeler)}} 
                                </p>
                              </div>
                              </a>
                    </div>
                    
                    <!--<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-heart-fill" viewBox="0 0 16 16">
                                  <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5ZM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2ZM8 7.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z"/>
                                </svg>
                              </div>
                               <a href="/appels_daterv">
                              <div>
                                  @php  $appels_daterv = DB::table('suivi_prospects')->where('type', 1)->where('choix_qualifier', "Rendez-vous obtenu")->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->where('statut_rv', null)->count(); @endphp
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les rendez-vous obtenus">
                                    Rendez-vous obtenu

                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{number_format($appels_daterv)}} 
                                </p>
                              </div>
                              </a>
                    </div>-->
                    
                    
                   <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                  <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                                </svg>
                              </div>
                               <a href="/sta_commerciaux_appels">
                              <div>
                                 
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Affecter des prospects">
                                   Statistiques des appels
                                </button>
                                
                              </div>
                              </a>
                    </div>
                    
                    <!--<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">-->
                    <!--          <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">-->
                    <!--           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-outbound-fill" viewBox="0 0 16 16">-->
                    <!--              <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM11 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-4.146 4.147a.5.5 0 0 1-.708-.708L14.293 1H11.5a.5.5 0 0 1-.5-.5z"/>-->
                    <!--            </svg>-->
                    <!--          </div>-->
                               <!--<a href="/produit_avendre">-->
                    <!--          <div>-->
                    <!--              @php  $produit_avendre = DB::table('suivi_prospects')->where('type', 5)->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->count(); @endphp-->
                    <!--            <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les demandes de produits ou services à vendre">-->
                    <!--                Liste de produits ou services à vendre-->
                    <!--            </button>-->
                    <!--            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">-->
                    <!--             {{number_format($produit_avendre)}} -->
                    <!--            </p>-->
                    <!--          </div>-->
                              <!--</a>-->
                    <!--</div>-->
                    
                    
                    @if(Auth::user()->email == "margareth.o@illimitis.com")
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                              <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                              <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                            </svg>
                              </div>
                               <a href="/affecter_des_prospects">
                              <div>
                                 
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Affecter des prospects">
                                    Affecter des prospects
                                </button>
                                
                              </div>
                              </a>
                    </div>
                    @elseif(Auth::user()->email == "mathilde.z@illimitis.com")
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                              <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                              <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                            </svg>
                              </div>
                               <a href="/affecter_des_prospects">
                              <div>
                                 
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Affecter des prospects">
                                    Affecter des prospects
                                </button>
                                
                              </div>
                              </a>
                    </div>
                    @endif
                    
                    @if(Auth::user()->nom_role == "directeur")
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                              <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                              <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                            </svg>
                              </div>
                               <a href="/affecter_des_prospects">
                              <div>
                                 
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Affecter des prospects">
                                    Charger de nouveaux prospects
                                </button>
                                
                              </div>
                              </a>
                    </div>
                    
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                  <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                                </svg>
                              </div>
                               <a href="/sta_commerciaux_appels">
                              <div>
                                 
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Affecter des prospects">
                                   Statistiques des appels
                                </button>
                                
                              </div>
                              </a>
                    </div>
                    
                    
                    @elseif(Auth::user()->nom_role == "responsable")
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                  <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                                </svg>
                              </div>
                               <a href="/affecter_des_prospects">
                              <div>
                                 
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir mes commissions">
                                    Charger de nouveaux prospects
                                </button>
                                
                              </div>
                              </a>
                    </div>
                    
                            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                  <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                      <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                                    </svg>
                                  </div>
                               <a href="/sta_commerciaux_appels">
                              <div>
                                 
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Affecter des prospects">
                                   Statistiques des appels
                                </button>
                                
                              </div>
                              </a>
                            </div>
                    
                    @elseif(Auth::user()->nom_role == "commerciaux")
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                              <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                              <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                            </svg>
                              </div>
                               <a href="{{route('import_prospect_me')}}">
                              <div>
                                 
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Importer des prospects">
                                    Charger de nouveaux prospects
                                </button>
                                
                              </div>
                              </a>
                    </div>
                    @endif
                    
                    <!--<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-outbound-fill" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM11 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-4.146 4.147a.5.5 0 0 1-.708-.708L14.293 1H11.5a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                              </div>
                               <a href="/prospects_a_appeler">
                              <div>
                                  
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir mes commissions">
                                    Appel 
                                </button>
                               
                              </div>
                              </a>
                    </div>-->
                    
                     <!-- end perfo -->
               
                 
                 <!--------------------------------------------------------------------------------------------------------------------->
          <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                </svg>
                              </div>
                               
                              <div>
                                 
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >
                                    Objectifs quotidien
                                </button>
                                @if($commercial->nbre_appel_quotidien)
                                @php $obj_jour = $commercial->nbre_appel_quotidien ; @endphp
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{intval($commercial->nbre_appel_quotidien)}} 
                                </p>
                                @else
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 0
                                </p>
                                @endif
                              </div>
                              
                              
                             
                    </div>
             
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trophy-fill" viewBox="0 0 16 16">
                                  <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935z"/>
                                </svg>
                              </div>
                             
                              <div>
                                  @if($commercial->nbre_appel_quotidien)
                                  @php  
                                  $today = date('d');
                                  $appels_effectuer_quotidien = DB::table('suivi_prospects')->where('commercial_id', $commercial->id)->whereDay('created_at', $today)->count();
                                  $obj_jour = $commercial->nbre_appel_quotidien  ;
                                  $total_appels = $appels_effectuer_quotidien;  @endphp
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Ma performance quotidienne">
                                    Mes appels quotidiens réalisés 
                                </button>   
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{intval($appels_effectuer_quotidien)}} 
                                </p>
                                @else
                                 <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Ma performance quotidienne">
                                     Mes appels quotidiens réalisés 
                                </button>   
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                0
                                </p>
                                @endif
                             
                              </div>
                             
                    </div> 
                    
                    
                  <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                </svg>
                              </div>
                               <a href="/appels_effectuer_team">
                              <div>  
                                  @php  
                                  $today = date('d');
                                  $m = date('m');
                                  $a = date('Y');
                                  $appels_effectuer_team = DB::table('suivi_prospects')->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->whereDay('created_at', $today)->whereMonth('created_at', $m)->whereYear('created_at', $a)->count();
                                   
                                   @endphp
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les appels effectués ce jour">
                                    Appels réalisés ce jour(team)
                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{number_format($appels_effectuer_team)}} 
                                  
                                </p>
                              </div>
                              </a>
                    </div>
                    
                    
                    @if(Auth::user()->nom_role == "responsable" or Auth::user()->nom_role == "directeur")
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                </svg>
                              </div>
                               <a href="/appel_parpays">
                              <div>  
                                  
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir le rapport des appels">
                                    Rapports appels
                                </button>
                               
                              </div>
                              </a>
                    </div>
                    @endif
                   
                 </div>
                   <!-- start top meilleur --> 
                    
                       
          <!--Mes actions-->
          
          <!-- New Table -->
          <!--<div class="w-full overflow-hidden rounded-lg shadow-xs">-->
             
   
            <script type="text/javascript" src="https://www.google.com/jsapi"></script>

         
        </div>
      </main>
    </div>
  </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<!--<script>-->

          






   <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/init-alpine.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
 


</body>

</html>