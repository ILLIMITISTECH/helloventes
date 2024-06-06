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
            Statistique des opportunités
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
          <div class="grid gap-6 mb-12 md:grid-cols-2 xl:grid-cols-4">
              
             @php $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first(); @endphp
                <!-- start perfo -->
           
                    
                   
                                <!-----------gestion des appels------------------------------------>
                   
                    @php 
                            $mois = date('m');
                            $annee = date('Y'); 
                          @endphp
                          
                  <!--  <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hdd-stack-fill" viewBox="0 0 16 16">
                                  <path d="M2 9a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1a2 2 0 0 0-2-2H2zm.5 3a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm2 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zM2 2a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm.5 3a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm2 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1z"/>
                                </svg>
                              </div>
                               <a href="/opportunite_maTeam">
                              <div>  
                                  @php  
                                  $opp = DB::table('opportunites')->where('archiver', 0)->count();
                                
                                   $count_opps = $opp - 3;
                                   @endphp
                                   
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les opportunités ">
                                    Total opportunités 
                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{number_format($opp)}} 
                                </p>
                              </div>
                              </a>
                    </div>-->
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hdd-stack-fill" viewBox="0 0 16 16">
                                  <path d="M2 9a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1a2 2 0 0 0-2-2H2zm.5 3a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm2 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zM2 2a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm.5 3a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm2 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1z"/>
                                </svg>
                              </div>
                               <a href="/statistique_oppSN_70">
                              <div>
                                  @php $opp_sn_70 = DB::table('opportunites')->where('archiver', 0)->where('pays_id', 1)->where('probabilite', '>=', 70)->count(); @endphp
                                
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >
                                   Total opportunités proba > 70 <span><img src="{{asset('pays/sn.png')}}" style="width:20px; margin-top:3px; margin-left:2px;"></span>
                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{number_format($opp_sn_70)}} 
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
                               <a href="/statistique_oppSN_50">
                              <div>
                                  @php $opps_sn_70 = DB::table('opportunites')->where('archiver', 0)->where('pays_id', 1)->where('probabilite', '<', 70)->count(); @endphp
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                   Total opportunités proba < 70<span><img src="{{asset('pays/sn.png')}}" style="width:20px; margin-top:3px; margin-left:2px;"></span>
                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{number_format($opps_sn_70)}} 
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
                               <a href="/liste_hot_deals_sn">
                              <div>  
                                  @php  
                                  $hot_deals = DB::table('opportunites')->where('archiver', 0)->where('probabilite', '>', 70)->count();
                                   $count_hot_deals = $hot_deals -1;
                                    $moissn = date('m');
                                   $opportunite_trihot_dealssn = DB::table('opportunites')->select('opportunites.*', 'commerciaus..prenom','commerciaus.nom','commerciaus.pays_id')
                                        ->join('commerciaus', 'commerciaus.id', 'opportunites.commercial_id')
                                        ->where('opportunites.archiver', 0)
                                        ->where('opportunites.probabilite', '>=', 60)
                                        ->where('commerciaus.pays_id', 1)
                                        ->whereMonth('opportunites.deadline', $moissn)
                                        ->orderBy('probabilite', 'asc')
                                        ->count();
                                   @endphp
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les hot deals ">
                                    Hot Deals  <span><img src="{{asset('pays/sn.png')}}" style="width:20px; margin-top:3px; margin-left:2px;"></span> de ce mois
                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{number_format($opportunite_trihot_dealssn)}} 
                                </p>
                              </div>
                              </a>
                    </div>
 
                  
                     <!-- end top meilleur -->
        </div>
        <br>
                   <!-- start top meilleur --> 
    <div class="grid gap-6 mb-12 md:grid-cols-2 xl:grid-cols-4">
        
        <!--<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hdd-stack-fill" viewBox="0 0 16 16">
                                  <path d="M2 9a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1a2 2 0 0 0-2-2H2zm.5 3a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm2 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zM2 2a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm.5 3a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm2 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1z"/>
                                </svg>
                              </div>
                               <a href="/statistique_oppBF_70">
                              <div>
                                  @php $opp_bf_70 = DB::table('opportunites')->where('archiver', 0)->where('pays_id', 5)->where('probabilite', '>=', 70)->count(); @endphp
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >
                                   Total opportunités 
                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                {{number_format($opp)}} 
                                </p>
                              </div>
                              </a>
                    </div>-->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hdd-stack-fill" viewBox="0 0 16 16">
                                  <path d="M2 9a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1a2 2 0 0 0-2-2H2zm.5 3a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm2 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zM2 2a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm.5 3a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm2 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1z"/>
                                </svg>
                              </div>
                               <a href="/statistique_oppBF_70">
                              <div>
                                  @php $opp_bf_70 = DB::table('opportunites')->where('archiver', 0)->where('pays_id', 5)->where('probabilite', '>=', 70)->count(); @endphp
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" >
                                   Total opportunités proba > 70  <span><img src="{{asset('pays/bf.png')}}" style="width:20px; margin-top:3px; margin-left:2px;"></span>
                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{number_format($opp_bf_70)}} 
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
                               <a href="/statistique_oppBF_50">
                              <div>
                                  @php $opps_bf_70 = DB::table('opportunites')->where('archiver', 0)->where('pays_id', 5)->where('probabilite', '<', 70)->count(); @endphp
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                   Total opportunités proba < 70  <span><img src="{{asset('pays/bf.png')}}" style="width:20px; margin-top:3px; margin-left:2px;"></span>
                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{number_format($opps_bf_70)}} 
                                </p>
                              </div>
                              </a>
                    </div>
                    <!--<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
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
                    </div> -->
                    
                 
                    
                  <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hdd-stack-fill" viewBox="0 0 16 16">
                                  <path d="M2 9a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1a2 2 0 0 0-2-2H2zm.5 3a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm2 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zM2 2a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm.5 3a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm2 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1z"/>
                                </svg>
                              </div>
                               <a href="/liste_hot_deals_bf">
                              <div>  
                                  @php  
                                  $hot_deals = DB::table('opportunites')->where('archiver', 0)->where('probabilite', '>', 70)->count();
                                  $moisbf = date('m');
                                   $count_hot_deals = $hot_deals -1;
                                    $opportunite_trihot_dealsbf = DB::table('opportunites')->select('opportunites.*', 'commerciaus..prenom','commerciaus.nom','commerciaus.pays_id')
                                        ->join('commerciaus', 'commerciaus.id', 'opportunites.commercial_id')
                                        ->where('opportunites.archiver', 0)
                                        ->where('opportunites.probabilite', '>=', 60)
                                        ->where('commerciaus.pays_id', 5)
                                        ->whereMonth('opportunites.deadline', $moisbf)
                                        ->orderBy('probabilite', 'asc')
                                        ->count();
                                   @endphp
                                <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" data-toggle="tooltip" title="Voir les hot deals ">
                                    Hot Deals  <span><img src="{{asset('pays/bf.png')}}" style="width:20px; margin-top:3px; margin-left:2px;"></span> de ce mois
                                </button>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                 {{number_format($opportunite_trihot_dealsbf)}} 
                                </p>
                              </div>
                              </a>
                    </div>
                    
                    
       </div>  
                       
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