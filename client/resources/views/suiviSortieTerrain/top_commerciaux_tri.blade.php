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
            Classement mensuel
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
                             $trimestre = date("m");
                          @endphp
       
         
                 
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
                       
            @if(count($topComAppelt) ==! 0)
                  <h3 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                  Top commerciaux de ce trimestre (Appels effectués)
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
                       
                @if( ($trimestre >= 01) && ($trimestre <= 03) )
                @if(  (date("m", strtotime($top_perfoAb->created_at)) >= 01) && (date("m", strtotime($top_perfoAb->created_at)) <= 03) )
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
                        @endif
                        @endif
                        
                        
                         @if( ($trimestre >= 04) && ($trimestre <= 06) )
                @if(  (date("m", strtotime($top_perfoAb->created_at)) >= 04) && (date("m", strtotime($top_perfoAb->created_at)) <= 06) )
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
                        @endif
                        @endif
                        
                         @if( ($trimestre >= 7) && ($trimestre <= 9) )
                @if(  (date("m", strtotime($top_perfoAb->created_at)) >= 7) && (date("m", strtotime($top_perfoAb->created_at)) <= 9) )
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
                        @endif
                        @endif
                        
                         @if( ($trimestre >= 10) && ($trimestre <= 12) )
                @if(  (date("m", strtotime($top_perfoAb->created_at)) >= 10) && (date("m", strtotime($top_perfoAb->created_at)) <= 12) )
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
                        @endif
                        @endif
                        
                    @endforeach
                    <!-- end Card -->
                     </div>
                     <!-- end top meilleur -->
              
              
              
                @php 
                       $topVentes = DB::table('ventes')->select('commercial_id','created_at','montant', DB::raw('sum(montant) as `total`'))
                       ->whereYear('created_at', $annee)
                       ->whereMonth('created_at', $top_mois)
                       ->groupBy('commercial_id')->orderBy('total','DESC')->paginate(4);  
                       @endphp
                   <!-- start top meilleur --> 
                  @if(count($topVentes) > 0)
                  <h3 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                  Top commerciaux de ce trimestre (Ventes)
                </h3>
                    @else
                    
                    @endif
                    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                  
            
                      
                       @foreach($topVentes as $top_perfo)      
                       
                        @if( ($trimestre >= 01) && ($trimestre <= 03) )
                             @if(  (date("m", strtotime($top_perfo->created_at)) >= 01) && (date("m", strtotime($top_perfo->created_at)) <= 03) )
                                   @php  $commer = DB::table('commerciaus')->where('id', $top_perfo->commercial_id)->first(); @endphp
                                <!-- Card -->
                                  @if($commer)
                                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                </svg>
                              </div>
                            
                             <a href="{{route('voir_sesVente_dumois',$commer->id)}}" data-toggle="tooltip" title="Voir les ventes de {{($commer) ? $commer->prenom : ''}}">
                                <div>
                            <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                 {{($commer) ? $commer->prenom : ''}} {{($commer) ? $commer->nom : ''}}
                            </button>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                              {{number_format($top_perfo->total)}} Fcfa 
                              <p style="text-align:right; margin-top:5px; color:#0093a2;" class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                  @if($commer->objectif_mois)
                                  {{intval(($top_perfo->total)*100 / $commer->objectif_mois)}}  % 
                                  @else
                                 
                                  @endif
                                  </p>
                            </p>
                          </div>
                          </a>
                        </div>
                        @endif
                        @endif
                        @endif
                        
                        
                        @if( ($trimestre >= 04) && ($trimestre <= 06) )
                             @if(  (date("m", strtotime($top_perfo->created_at)) >= 04) && (date("m", strtotime($top_perfo->created_at)) <= 06) )
                                   @php  $commer = DB::table('commerciaus')->where('id', $top_perfo->commercial_id)->first(); @endphp
                                <!-- Card -->
                                  @if($commer)
                                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                </svg>
                              </div>
                            
                             <a href="{{route('voir_sesVente_dumois',$commer->id)}}" data-toggle="tooltip" title="Voir les ventes de {{($commer) ? $commer->prenom : ''}}">
                                <div>
                            <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                 {{($commer) ? $commer->prenom : ''}} {{($commer) ? $commer->nom : ''}}
                            </button>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                              {{number_format($top_perfo->total)}} Fcfa 
                              <p style="text-align:right; margin-top:5px; color:#0093a2;" class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                  @if($commer->objectif_mois)
                                  {{intval(($top_perfo->total)*100 / $commer->objectif_mois)}}  % 
                                  @else
                                 
                                  @endif
                                  </p>
                            </p>
                          </div>
                          </a>
                        </div>
                        @endif
                        @endif
                        @endif
                        
                        @if( ($trimestre >= 7) && ($trimestre <= 9) )
                             @if(  (date("m", strtotime($top_perfo->created_at)) >= 7) && (date("m", strtotime($top_perfo->created_at)) <= 7) )
                                   @php  $commer = DB::table('commerciaus')->where('id', $top_perfo->commercial_id)->first(); @endphp
                                <!-- Card -->
                                  @if($commer)
                                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                </svg>
                              </div>
                            
                             <a href="{{route('voir_sesVente_dumois',$commer->id)}}" data-toggle="tooltip" title="Voir les ventes de {{($commer) ? $commer->prenom : ''}}">
                                <div>
                            <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                 {{($commer) ? $commer->prenom : ''}} {{($commer) ? $commer->nom : ''}}
                            </button>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                              {{number_format($top_perfo->total)}} Fcfa 
                              <p style="text-align:right; margin-top:5px; color:#0093a2;" class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                  @if($commer->objectif_mois)
                                  {{intval(($top_perfo->total)*100 / $commer->objectif_mois)}}  % 
                                  @else
                                 
                                  @endif
                                  </p>
                            </p>
                          </div>
                          </a>
                        </div>
                        @endif
                        @endif
                        @endif
                        
                        @if( ($trimestre >= 10) && ($trimestre <= 12) )
                             @if(  (date("m", strtotime($top_perfo->created_at)) >= 10) && (date("m", strtotime($top_perfo->created_at)) <= 12) )
                                   @php  $commer = DB::table('commerciaus')->where('id', $top_perfo->commercial_id)->first(); @endphp
                                <!-- Card -->
                                  @if($commer)
                                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                              <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                </svg>
                              </div>
                            
                             <a href="{{route('voir_sesVente_dumois',$commer->id)}}" data-toggle="tooltip" title="Voir les ventes de {{($commer) ? $commer->prenom : ''}}">
                                <div>
                            <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                 {{($commer) ? $commer->prenom : ''}} {{($commer) ? $commer->nom : ''}}
                            </button>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                              {{number_format($top_perfo->total)}} Fcfa 
                              <p style="text-align:right; margin-top:5px; color:#0093a2;" class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                  @if($commer->objectif_mois)
                                  {{intval(($top_perfo->total)*100 / $commer->objectif_mois)}}  % 
                                  @else
                                 
                                  @endif
                                  </p>
                            </p>
                          </div>
                          </a>
                        </div>
                        @endif
                        @endif
                        
                        
@endif
                    @endforeach
                     </div>
                    <!-- end Card -->
                    
                     <!-- end top meilleur -->
                      
                     
                  
                    
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
                            $vente_janvier = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 1)->sum('montant');
                            $vente_fevrier = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 2)->sum('montant');
                            $vente_mars = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 3)->sum('montant');
                            $vente_avril = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 4)->sum('montant');
                            $vente_mai = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 5)->sum('montant');
                            $vente_juin = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 6)->sum('montant');
                            $vente_juillet = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 7)->sum('montant');
                            $vente_aout = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 8)->sum('montant');
                            $vente_sep = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 9)->sum('montant');
                            $vente_oct = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 10)->sum('montant');
                            $vente_nov = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 11)->sum('montant');
                            $vente_dec = DB::table('ventes')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 12)->sum('montant');
                            
                            $objectif =  $commercial->objectif_mois ; 
                            
                            $objCommer = DB::table('commerciaus')
                           ->where('id', $commercial->id)
                           ->first();  
                            $objMois = date('m');    
                           
                            $obj_janvier_mois = DB::table('stock_mensuelles')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 1)->first();
                            $obj_oct_mois = DB::table('stock_mensuelles')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 10)->first();

                            $obj_janvier = DB::table('stock_mensuelles')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 1)->sum('objectif_mois');
                            $obj_fevrier = DB::table('stock_mensuelles')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 2)->sum('objectif_mois');
                            $obj_mars = DB::table('stock_mensuelles')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 3)->sum('objectif_mois');
                            $obj_avril = DB::table('stock_mensuelles')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 4)->sum('objectif_mois');
                            $obj_mai = DB::table('stock_mensuelles')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 5)->sum('objectif_mois');
                            $obj_juin = DB::table('stock_mensuelles')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 6)->sum('objectif_mois');
                            $obj_juillet = DB::table('stock_mensuelles')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 7)->sum('objectif_mois');
                            $obj_aout = DB::table('stock_mensuelles')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 8)->sum('objectif_mois');
                            $obj_sep = DB::table('stock_mensuelles')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 9)->sum('objectif_mois');
                            $obj_oct = DB::table('stock_mensuelles')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 10)->sum('objectif_mois');
                            $obj_nov = DB::table('stock_mensuelles')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 11)->sum('objectif_mois');
                            $obj_dec = DB::table('stock_mensuelles')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', 12)->sum('objectif_mois');
                            
                            $obj_octMois = DB::table('stock_mensuelles')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', $objMois)->first();

                       
                        @endphp

          
          <!--Mes actions-->
          

          </div>
   
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