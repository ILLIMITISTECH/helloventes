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
           RAPPORTS
          </h3>
           <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
              @php 
                            $mois = date('m');
                            $annee = date('Y'); 
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
          <!-- Cards -->
          <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
              
             @php $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first(); @endphp
                <!-- start perfo -->
                 
                    
                    <!-- Card -->
                    
                    
                    <!-- Card -->
                    
                   
                    <!-- Card -->
                   
                    
                                <!-----------gestion des appels------------------------------------>
                   <!--<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">-->
                   <!--           <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">-->
                   <!--            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-outbound-fill" viewBox="0 0 16 16">-->
                   <!--               <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM11 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-4.146 4.147a.5.5 0 0 1-.708-.708L14.293 1H11.5a.5.5 0 0 1-.5-.5z"/>-->
                   <!--             </svg>-->
                   <!--           </div>-->
                   <!--            <a href="/gestion_appels">-->
                   <!--           <div>-->
                   <!--             <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir ma prospections">-->
                   <!--                Ma prospection-->
                   <!--             </button>-->
                   <!--             <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">-->
                   <!--             </p>-->
                   <!--           </div>-->
                   <!--           </a>-->
                   <!-- </div>-->
                    
                    
                    
                    <!--<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">-->
                    <!--          <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">-->
                    <!--           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar" viewBox="0 0 16 16">-->
                    <!--          <path d="M3.5 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM3 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>-->
                    <!--          <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm12-1v14h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zm-1 0H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h9V1z"/>-->
                    <!--        </svg>-->
                    <!--          </div>-->
                    <!--           <a href="/dash_ventes">-->
                    <!--          <div>-->
                    <!--            <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les ventes ">-->
                    <!--               Mes ventes-->
                    <!--            </button>-->
                    <!--            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">-->
                    <!--            </p>-->
                    <!--          </div>-->
                    <!--          </a>-->
                    <!--</div>-->
                 
                    <!--<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">-->
                    <!--          <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">-->
                    <!--           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-data" viewBox="0 0 16 16">-->
                    <!--          <path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0V9z"/>-->
                    <!--          <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>-->
                    <!--          <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>-->
                    <!--        </svg>-->
                    <!--          </div>-->
                    <!--           <a href="/dash_realisations">-->
                    <!--          <div>-->
                    <!--            <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les réalisations">-->
                    <!--               Réalisations-->
                    <!--            </button>-->
                    <!--            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">-->
                    <!--            </p>-->
                    <!--          </div>-->
                    <!--          </a>-->
                    <!--</div>-->
                    
                    
                    
                 

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
                 </div>
                 
                 <!--------------------------------------------------------------------------------------------------------------------->
                 @if(Auth::user()->nom_role == "commerciaux")
                 <a href="/commerciaux_maTeamIndividuel_moi" data-toggle="tooltip" title="Rapport individuel de performance commerciale">
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                       
                        <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-badge" viewBox="0 0 16 16">
                              <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                              <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z"/>
                            </svg>
                        </div>
                    <div>
                       
                    <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >
                        Rapport individuel
                    </button>
                    </div>
                    </div>
                    </a>
                  <br>
                 <a href="/rapport_team" data-toggle="tooltip" title="Rapport global de performance commerciale">
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                       
                        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar" viewBox="0 0 16 16">
                              <path d="M3.5 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM3 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm12-1v14h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zm-1 0H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h9V1z"/>
                            </svg>
                        </div>
                    <div>
                    <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >
                        Rapport global
                    </button>
                    </div>
                    </div>
                    </a>
                 @elseif(Auth::user()->nom_role == "directeur")
                 <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
              
             
                <!-- start perfo -->
                
                    <!-- Card -->
                    <a href="/rapport_team" data-toggle="tooltip" title="Rapport global de performance commerciale">
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                       
                        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar" viewBox="0 0 16 16">
                              <path d="M3.5 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM3 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm12-1v14h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zm-1 0H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h9V1z"/>
                            </svg>
                        </div>
                    <div>
                    <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >
                        Rapport global
                    </button>
                    </div>
                    </div>
                    </a>
                    
                    <!--<a href="/rapport_teamSN" data-toggle="tooltip" title="Rapport global de performance commerciale">
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                       
                        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar" viewBox="0 0 16 16">
                              <path d="M3.5 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM3 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm12-1v14h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zm-1 0H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h9V1z"/>
                            </svg>
                        </div>
                    <div>
                    <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" style="display:flex;">
                     <span>Rapport global</span>  <span><img src="{{asset('pays/sn.png')}}" style="width:20px; margin-top:3px; margin-left:2px;"></span>
                    </button>
                    
                    </div>
                    </div>
                    </a>-->
                    
                   <!-- <a href="/rapport_teamBF" data-toggle="tooltip" title="Rapport global de performance commerciale">
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                       
                        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar" viewBox="0 0 16 16">
                              <path d="M3.5 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM3 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm12-1v14h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zm-1 0H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h9V1z"/>
                            </svg>
                        </div>
                    <div>
                     <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" style="display:flex;">
                     <span>Rapport global</span>  <span><img src="{{asset('pays/bf.png')}}" style="width:20px; margin-top:3px; margin-left:2px;"></span>
                    </button>
                    </div>
                    </div>
                    </a>-->
                    
                    <a href="/commerciaux_maTeamIndividuel" data-toggle="tooltip" title="Rapport individuel de performance commerciale">
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                       
                        <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-badge" viewBox="0 0 16 16">
                              <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                              <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z"/>
                            </svg>
                        </div>
                    <div>
                    <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >
                        Rapport individuel
                    </button>
                    </div>
                    </div>
                    </a>
                    
                    <!--<a href="/rapport_contacts" data-toggle="tooltip" title="Rapport global de la base de contact ">-->
                    <!--<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">-->
                       
                    <!--    <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">-->
                    <!--        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard" viewBox="0 0 16 16">-->
                    <!--          <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>-->
                    <!--          <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>-->
                    <!--        </svg>-->
                    <!--    </div>-->
                    <!--<div>-->
                    <!--<button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >-->
                    <!--    Rapport contacts-->
                    <!--</button>-->
                    <!--</div>-->
                    <!--</div>-->
                    <!--</a>-->
                    
                    <!--<a href="/objectif_ventes" data-toggle="tooltip" title="Rapport global l'évolution de ventes">
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
                    </a>-->
                    
                    <!--<a href="/liste_demos" data-toggle="tooltip" title="Rapport global l'évolution de ventes">-->
                    <!--<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">-->
                       
                    <!--    <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">-->
                    <!--        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-data" viewBox="0 0 16 16">-->
                    <!--          <path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0V9z"/>-->
                    <!--          <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>-->
                    <!--          <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>-->
                    <!--        </svg>-->
                    <!--    </div>-->
                    <!--<div>-->
                    <!--<button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >-->
                    <!--    Les démos de ce mois -->
                    <!--</button>-->
                    <!--</div>-->
                    <!--</div>-->
                    <!--</a>-->
                    
                    <!--<a href="/liste_updates" data-toggle="tooltip" title="Rapport global l'évolution de ventes">-->
                    <!--<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">-->
                       
                    <!--    <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">-->
                    <!--        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-data" viewBox="0 0 16 16">-->
                    <!--          <path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0V9z"/>-->
                    <!--          <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>-->
                    <!--          <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>-->
                    <!--        </svg>-->
                    <!--    </div>-->
                    <!--<div>-->
                    <!--<button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >-->
                    <!--     Les mises à jours -->
                    <!--</button>-->
                    <!--</div>-->
                    <!--</div>-->
                    <!--</a>-->
                    
                    <!--<a href="/toutes_actions_fait" data-toggle="tooltip" title="Rapport global l'évolution de ventes">-->
                    <!--<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">-->
                       
                    <!--    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">-->
                    <!--        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-square" viewBox="0 0 16 16">-->
                    <!--          <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z"/>-->
                    <!--          <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>-->
                    <!--        </svg>-->
                    <!--    </div>-->
                    <!--<div>-->
                    <!--<button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >-->
                    <!--     Actions effectuées-->
                    <!--</button>-->
                    <!--</div>-->
                    <!--</div>-->
                    <!--</a>-->
                    
                    <!--<a href="/toutes_actions_aVenir" data-toggle="tooltip" title="Rapport global l'évolution de ventes">-->
                    <!--<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">-->
                       
                    <!--    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">-->
                    <!--        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">-->
                    <!--          <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>-->
                    <!--          <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>-->
                    <!--        </svg>-->
                    <!--    </div>-->
                    <!--<div>-->
                    <!--<button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >-->
                    <!--     Actions à venir -->
                    <!--</button>-->
                    <!--</div>-->
                    <!--</div>-->
                    <!--</a>-->
                    
                    
                    
                <!--    <a href="/plannings" data-toggle="tooltip" title="Voir les commissions des commericaux">-->
                <!--    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">-->
                       
                <!--        <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">-->
                <!--            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">-->
                <!--  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>-->
                <!--</svg>-->
                <!--        </div>-->
                <!--    <div>-->
                <!--    <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >-->
                <!--        Rendez-vous-->
                <!--    </button>-->
                <!--    </div>-->
                <!--    </div>-->
                <!--    </a>-->
                    <!-- Card -->
                    
                     <!-- end perfo -->
                
                <!-- <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
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
                    </div>-->
                     </div>
                 @elseif(Auth::user()->nom_role == "responsable" or Auth::user()->nom_role == "responsable_pole")
                 <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
              
             
                <!-- start perfo -->
                
                    <!-- Card -->
                    <a href="/rapport_team" data-toggle="tooltip" title="Rapport global de performance commerciale">
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                       
                        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar" viewBox="0 0 16 16">
                              <path d="M3.5 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM3 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm12-1v14h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zm-1 0H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h9V1z"/>
                            </svg>
                        </div>
                    <div>
                    <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >
                        Rapport global
                    </button>
                    </div>
                    </div>
                    </a>
                    
                    <!--<a href="/rapport_teamSN" data-toggle="tooltip" title="Rapport global de performance commerciale">
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                       
                        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar" viewBox="0 0 16 16">
                              <path d="M3.5 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM3 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm12-1v14h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zm-1 0H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h9V1z"/>
                            </svg>
                        </div>
                    <div>
                    <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" style="display:flex;">
                     <span>Rapport global</span>  <span><img src="{{asset('pays/sn.png')}}" style="width:20px; margin-top:3px; margin-left:2px;"></span>
                    </button>
                    
                    </div>
                    </div>
                    </a>-->
                    
                   <!-- <a href="/rapport_teamBF" data-toggle="tooltip" title="Rapport global de performance commerciale">
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                       
                        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar" viewBox="0 0 16 16">
                              <path d="M3.5 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM3 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm12-1v14h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zm-1 0H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h9V1z"/>
                            </svg>
                        </div>
                    <div>
                     <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" style="display:flex;">
                     <span>Rapport global</span>  <span><img src="{{asset('pays/bf.png')}}" style="width:20px; margin-top:3px; margin-left:2px;"></span>
                    </button>
                    </div>
                    </div>
                    </a>-->
                    
                    <a href="/commerciaux_maTeamIndividuel" data-toggle="tooltip" title="Rapport individuel de performance commerciale">
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                       
                        <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-badge" viewBox="0 0 16 16">
                              <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                              <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z"/>
                            </svg>
                        </div>
                    <div>
                    <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >
                        Rapport individuel
                    </button>
                    </div>
                    </div>
                    </a>
                    
                    <!--<a href="/rapport_contacts_res" data-toggle="tooltip" title="Rapport global de la base de contact ">-->
                    <!--<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">-->
                       
                    <!--    <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">-->
                    <!--        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard" viewBox="0 0 16 16">-->
                    <!--          <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>-->
                    <!--          <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>-->
                    <!--        </svg>-->
                    <!--    </div>-->
                    <!--<div>-->
                    <!--<button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >-->
                    <!--    Rapport contacts-->
                    <!--</button>-->
                    <!--</div>-->
                    <!--</div>-->
                    <!--</a>-->
                    
                    <!--<a href="/objectif_ventes_res" data-toggle="tooltip" title="Rapport global l'évolution de ventes">
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
                    </a>-->
                    
                    <!--<a href="/liste_demos_res" data-toggle="tooltip" title="Rapport global l'évolution de ventes">-->
                    <!--<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">-->
                       
                    <!--    <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">-->
                    <!--        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-data" viewBox="0 0 16 16">-->
                    <!--          <path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0V9z"/>-->
                    <!--          <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>-->
                    <!--          <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>-->
                    <!--        </svg>-->
                    <!--    </div>-->
                    <!--<div>-->
                    <!--<button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >-->
                    <!--    Les démos de ce mois -->
                    <!--</button>-->
                    <!--</div>-->
                    <!--</div>-->
                    <!--</a>-->
                    
                    <!--<a href="/liste_updates_res" data-toggle="tooltip" title="Rapport global l'évolution de ventes">-->
                    <!--<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">-->
                       
                    <!--    <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">-->
                    <!--        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-data" viewBox="0 0 16 16">-->
                    <!--          <path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0V9z"/>-->
                    <!--          <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>-->
                    <!--          <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>-->
                    <!--        </svg>-->
                    <!--    </div>-->
                    <!--<div>-->
                    <!--<button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >-->
                    <!--     Les mises à jours -->
                    <!--</button>-->
                    <!--</div>-->
                    <!--</div>-->
                    <!--</a>-->
                    
                    
                    <!--<a href="/toutes_actions_fait_res" data-toggle="tooltip" title="Rapport global l'évolution de ventes">-->
                    <!--<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">-->
                       
                    <!--    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">-->
                    <!--        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-square" viewBox="0 0 16 16">-->
                    <!--          <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z"/>-->
                    <!--          <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>-->
                    <!--        </svg>-->
                    <!--    </div>-->
                    <!--<div>-->
                    <!--<button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >-->
                    <!--     Actions effectuées-->
                    <!--</button>-->
                    <!--</div>-->
                    <!--</div>-->
                    <!--</a>-->
                    
                    <!--<a href="/toutes_actions_aVenir_res" data-toggle="tooltip" title="Rapport global l'évolution de ventes">-->
                    <!--<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">-->
                       
                    <!--    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">-->
                    <!--        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">-->
                    <!--          <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>-->
                    <!--          <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>-->
                    <!--        </svg>-->
                    <!--    </div>-->
                    <!--<div>-->
                    <!--<button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >-->
                    <!--     Actions à venir -->
                    <!--</button>-->
                    <!--</div>-->
                    <!--</div>-->
                    <!--</a>-->
                    
                    
                    
                <!--    <a href="/plannings_res" data-toggle="tooltip" title="Voir les commissions des commericaux">-->
                <!--    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">-->
                       
                <!--        <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">-->
                <!--            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">-->
                <!--  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>-->
                <!--</svg>-->
                <!--        </div>-->
                <!--    <div>-->
                <!--    <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >-->
                <!--        Rendez-vous-->
                <!--    </button>-->
                <!--    </div>-->
                <!--    </div>-->
                <!--    </a>-->
                    
                    <!-- Card -->
                    
                     <!-- end perfo -->
               
                <!-- <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
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
                    -->
                      </div>
                 @endif
                 <!------------------------------------------------------------------------------------------------------------------------------------->
                 
         
      </main>
    </div>
  </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>



   <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/init-alpine.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
 


</body>

</html>