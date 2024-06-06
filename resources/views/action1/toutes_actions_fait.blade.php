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
    
    
    
    <div class="flex flex-col flex-1 w-full" style="width:1050px">
      @include('v2.header_dg')
<main class="h-full pb-16 overflow-y-auto" >
    
        <!--les formulaires-->
        <div class="container px-6 mx-auto grid">
        
        <div class="container px-6 mx-auto grid">
            <br><br>
                                         <div class="col-md-3" style="margin-left:700px" >
                                           
                                           <select name="search_a" class="form-select" aria-label="Default select example">
                                              
                                               <option value="">Filtrer</option>
                                              
                                               <!--<option value="1000000">Actions de ce mois</option>-->
                                               <option value="3000000">Actions de cette semaine</option>
                                               <option value="2000000" >Toutes les actions effectuées</option>
                                             
                                           </select>
                                        </div> 
        <div id="semaine"> 
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Actions effectuées cette semaine pour chaque opportunité
          </h2>
          <br>
           @php
                    $semaineM7 = (date('d') -7);
                    $action_semaineP7 = (date('d') +7);
                    $action_mois = date('m');
                     $mois = date('m');
                       $annee = date('Y'); 
                 @endphp
          <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
  @php $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first(); @endphp
                 @php
                         $actionss = DB::table('action_commerciales')->whereDay('deadline', '<=', $action_semaineP7)->WhereDay('deadline', '>=', $semaineM7)->whereMonth('deadline', $action_mois)->whereYear('deadline', $annee)->where('cloture', 1)->get();
                @endphp
                
                                                                                        @php 
                                        $prospectsf = DB::table('action_commerciales')->where('cloture', 1)->whereDay('deadline', '<=', $action_semaineP7)->WhereDay('deadline', '>=', $semaineM7)->whereMonth('deadline', $action_mois)->whereYear('deadline', $annee)->pluck('opportunite_id')->toArray(); 
                                        $pays = DB::table('opportunites')->pluck('id')->toArray(); 
                                        $result_pays = array_diff($pays, $prospectsf);
                                        $result_payss = array_diff($pays, $result_pays);
                                        @endphp
     
        
                            <div  class="col-md-3" style = "margin-top:-20px" align="right"> 
                                 <form action="{{route('toutes_actionsFiltre_fait')}}" method="get">
                                     <select name="serachCom" style="width:220px;height:40px"  id="statut" style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par Commercial(e)</option>
                                        @php 
                                        $commerciauxs = DB::table('commerciaus')->pluck('id')->toArray();
                                        $entreprisess = DB::table('action_commerciales')->whereDay('deadline', '<=', $action_semaineP7)->WhereDay('deadline', '>=', $semaineM7)->whereMonth('deadline', $action_mois)->whereYear('deadline', $annee)->where('cloture', 1)->pluck('commercial_id')->toArray();
                                        
                                        $result_comerP = array_diff($commerciauxs, $entreprisess);
                                        $result_comersss = array_diff($commerciauxs, $result_comerP);
                                        
                                        @endphp
                                        
                                        @foreach($result_comersss as $result_comer)
                                        @php $commerciales = DB::table('commerciaus')->where('id', $result_comer)->OrderBy('prenom')->first();  @endphp
                                        <option value="{{$commerciales->id}}">{{$commerciales->prenom}} {{$commerciales->nom}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                      
                                
                                    <select name="serachPays" style="width:220px;height:40px; margin-left:10px;"  id="origine">
                                        <option value="" disabled selected>Rechercher par Pays</option>
                                        @php 
                                        $prospects = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
                                        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
                                        ->whereDay('action_commerciales.deadline', '<=', $action_semaineP7)->WhereDay('action_commerciales.deadline', '>=', $semaineM7)->whereMonth('action_commerciales.deadline', $action_mois)->whereYear('action_commerciales.deadline', $annee)->where('cloture', 1)
                                        ->pluck('commerciaus.pays_id')->toArray(); 

                                         $pays = DB::table('pays')->pluck('id')->toArray(); 
                                         $result_paysF = array_diff($pays, $prospects);
                                         $result_payssF = array_diff($pays, $result_paysF);
                                         
                                        @endphp
                                    @foreach($result_payssF as $result_pay) 
                                        @php $pay = DB::table('pays')->where('id', $result_pay)->OrderBy('libelle')->first();  @endphp
                                        <option value="{{$pay->id}}">{{$pay->libelle}}</option>
                                    @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                    <select name="searchAction" style="width:220px;height:40px; margin-left:10px;"  id="opportunite">
                                        <option value="" disabled selected>Rechercher par opportunité</option>
                                      
                                    @foreach($result_payss as $result_pay) 
                                        @php $pay = DB::table('opportunites')->where('id', $result_pay)->OrderBy('libelle')->first();  @endphp
                                        <option value="{{$pay->id}}">{{$pay->libelle}}</option>
                                    @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-left:10px;" type="submit">Filtrer</button>
                                </form> 
                            </div> 
                            <br>
        @if(count($actions_semaine) > 0) 
          <div class="w-full overflow-hidden rounded-lg shadow-xs" style = "margin-top:10px" >
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th style="width:10%" class="px-0 py-1">Commerciaux</th>
                        <th style="width:10%" class="px-0 py-1">Libelle</th>
                        <th style="width:10%" class="px-0 py-1">Deadline</th>
                        <th style="width:10%" class="px-0 py-1">Opportunités</th>
                        <!--<th style="width:10%" class="px-0 py-1">Options</th>-->
                  </tr>
                </thead>
               
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                        @php $n=1; @endphp
                     @foreach($actions_semaine as $actionCommercialss)
                     
                     @php
                         $OpportuniteAction = DB::table('opportunites')->where('id', $actionCommercialss->opportunite_id)->first();
                         $commerciaux = DB::table('commerciaus')->where('id', $actionCommercialss->commercial_id)->first();
                         $semaineM7 = (date('d') -7);
                    $action_semaineP7 = (date('d') +7);
                    $action_mois = date('m');
                    $mois = date('m');
                      $annee = date('Y'); 
                     @endphp
                @if($actionCommercialss->cloture == 1)
                @if( ($action_semaineP7 >= date('d', strtotime($actionCommercialss->deadline))) && ($semaineM7 <= date('d', strtotime($actionCommercialss->deadline))) && ($action_mois == date('m', strtotime($actionCommercialss->deadline))) && ($annee == date('Y', strtotime($actionCommercialss->deadline))) )

            
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        {{$commerciaux->prenom}} {{$commerciaux->nom}}
                        </span>
                    </td>
                    
                    <td class="px-4 py-3 text-xs" data-toggle="tooltip" title="{{$actionCommercialss->libelle}}">
                      <span class="px-3 py-1 text-sm ">
                          <h4>{{ \Illuminate\Support\Str::limit($actionCommercialss->libelle, 45, $end='...') }}</h4>
                        </span>
                    </td>
                    
                      <td class="px-4 py-3 text-xs">
                    <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        {{($actionCommercialss->deadline) ? $actionCommercialss->deadline : '--'}}
                      </span>
                      </td>
                       @php
                         $OpportuniteProspect = DB::table('prospects')->where('id', $OpportuniteAction->prospect_id)->first();
                     @endphp
                     @if($OpportuniteAction)
                    <td class="px-4 py-3 text-xs" data-toggle="tooltip" title="{{$OpportuniteAction->libelle}}">
                      <span class="px-3 py-1 text-sm ">
                          <h4>{{ \Illuminate\Support\Str::limit($OpportuniteAction->libelle, 30, $end='...') }}</h4>
                        </span>
                         @if($OpportuniteProspect)
                      &nbsp;<b style="color:#9045e2">({{ strtoupper(($OpportuniteProspect->nom_entreprise) ? $OpportuniteProspect->nom_entreprise : '')}})</b>
                    @else
                      -
                    @endif
                    </td>
                    @else
                     @php
                         $Prospect = DB::table('prospects')->where('id', $actionCommercialss->prospect_id)->first();
                     @endphp
                    <td class="px-4 py-3 text-xs" data-toggle="tooltip" title="{{$Prospect->nom_entreprise}}">
                        <b style="color:#9045e2">
                            {{ \Illuminate\Support\Str::limit(strtoupper($Prospect->nom_entreprise), 30, $end='...') }}
                            </b>
                    </td>
                  
                    @endif
                 
                 </tr>
                 @endif
                 @endif
                  @endforeach
                </tbody>
              </table>
            </div>

        </div>
         @else
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Pas d'actions disponibles pour cette semaine !
                </span>
            </label>
            </div>
            @endif
        </div>
            <!------------------------------------------------actions toutes actions------------------------------------------------------------------->
            
            <div id="tout"> 
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Toutes les actions effectuées pour chaque opportunité 
          </h2>
          <br>
          <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
  @php $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first(); @endphp
                 @php
                         $actionss = DB::table('action_commerciales')->where('cloture', 1)->get();
                @endphp
                
                                                                                        @php 
                                        $prospectsf = DB::table('action_commerciales')->where('cloture', 1)->pluck('opportunite_id')->toArray(); 
                                        $pays = DB::table('opportunites')->pluck('id')->toArray(); 
                                        $result_pays = array_diff($pays, $prospectsf);
                                        $result_payss = array_diff($pays, $result_pays);
                                        @endphp
     
        
                            <div  class="col-md-3" style = "margin-top:-20px" align="right"> 
                                 <form action="{{route('toutes_actionsFiltre_fait')}}" method="get">
                                    <select name="serachCom" style="width:220px;height:40px"  id="statut" style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par Commercial(e)</option>
                                        @php 
                                        $commerciauxs = DB::table('commerciaus')->pluck('id')->toArray();
                                        $entreprisess = DB::table('action_commerciales')
                                        ->where('cloture', 1)->pluck('commercial_id')->toArray();
                                        
                                        $result_comerP = array_diff($commerciauxs, $entreprisess);
                                        $result_comersss = array_diff($commerciauxs, $result_comerP);
                                        
                                        @endphp
                                        
                                        @foreach($result_comersss as $result_comer)
                                        @php $commerciales = DB::table('commerciaus')->where('id', $result_comer)->OrderBy('prenom')->first();  @endphp
                                        <option value="{{$commerciales->id}}">{{$commerciales->prenom}} {{$commerciales->nom}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                      
                                
                                    <select name="serachPays" style="width:220px;height:40px; margin-left:10px;"  id="origine">
                                        <option value="" disabled selected>Rechercher par Pays</option>
                                        @php 
                                        $prospects = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
                                        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
                                        ->where('cloture', 1)->pluck('commerciaus.pays_id')->toArray(); 

                                         $pays = DB::table('pays')->pluck('id')->toArray(); 
                                         $result_paysF = array_diff($pays, $prospects);
                                         $result_payssF = array_diff($pays, $result_paysF);
                                         
                                        @endphp
                                    @foreach($result_payssF as $result_pay) 
                                        @php $pay = DB::table('pays')->where('id', $result_pay)->OrderBy('libelle')->first();  @endphp
                                        <option value="{{$pay->id}}">{{$pay->libelle}}</option>
                                    @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                    <select name="searchAction" style="width:220px;height:40px; margin-left:10px;"  id="opportunite">
                                        <option value="" disabled selected>Rechercher par opportunité</option>
                                      
                                    @foreach($result_payss as $result_pay) 
                                        @php $pay = DB::table('opportunites')->where('id', $result_pay)->OrderBy('libelle')->first();  @endphp
                                        <option value="{{$pay->id}}">{{$pay->libelle}}</option>
                                    @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-left:10px;" type="submit">Filtrer</button>
                                </form> 
                            </div> 
                            <br>
        @if(count($actions) > 0) 
          <div class="w-full overflow-hidden rounded-lg shadow-xs" style = "margin-top:10px" >
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th style="width:10%" class="px-0 py-1">Commerciaux</th>
                        <th style="width:10%" class="px-0 py-1">Libelle</th>
                        <th style="width:10%" class="px-0 py-1">Deadline</th>
                        <th style="width:10%" class="px-0 py-1">Opportunités</th>
                        <!--<th style="width:10%" class="px-0 py-1">Options</th>-->
                  </tr>
                </thead>
               
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                        @php $n=1; @endphp
                     @foreach($actions as $actionCommercial)
                     
                     @php
                         $OpportuniteAction = DB::table('opportunites')->where('id', $actionCommercial->opportunite_id)->first();
                         $commerciaux = DB::table('commerciaus')->where('id', $actionCommercial->commercial_id)->first();
                     @endphp
                     @if($actionCommercial->cloture == 1)
              @if($OpportuniteAction)
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        {{$commerciaux->prenom}} {{$commerciaux->nom}}
                        </span>
                    </td>
                    
                    <td class="px-4 py-3 text-xs" data-toggle="tooltip" title="{{$actionCommercial->libelle}}">
                      <span class="px-3 py-1 text-sm ">
                          <h4>{{ \Illuminate\Support\Str::limit($actionCommercial->libelle, 45, $end='...') }}</h4>
                        </span>
                    </td>
                    
                      <td class="px-4 py-3 text-xs">
                    <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        {{($actionCommercial->deadline) ? $actionCommercial->deadline : '--'}}
                      </span>
                      </td>
                     @php
                         $OpportuniteProspect = DB::table('prospects')->where('id', $OpportuniteAction->prospect_id)->first();
                     @endphp
                     @if($OpportuniteAction)
                    <td class="px-4 py-3 text-xs" data-toggle="tooltip" title="{{$OpportuniteAction->libelle}}">
                      <span class="px-3 py-1 text-sm ">
                          <h4>{{ \Illuminate\Support\Str::limit($OpportuniteAction->libelle, 30, $end='...') }}</h4>
                        </span>
                         @if($OpportuniteProspect)
                      &nbsp;<b style="color:#9045e2">({{ strtoupper(($OpportuniteProspect->nom_entreprise) ? $OpportuniteProspect->nom_entreprise : '')}})</b>
                    @else
                      -
                    @endif
                    </td>
                    @else
                    <td class="px-4 py-3 text-xs"></td>
                    @endif
                 
                 </tr>
                 @endif
                 @endif
                  @endforeach
                </tbody>
              </table>
            </div>

        </div>
         @else
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Pas d'actions disponibles !
                </span>
            </label>
            </div>
            @endif
         </div>
         <!------------------------------------------------action mois-------------------------------------------------------------------------->
         

            <div id="ceMois"> 
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Actions effectuées ce mois pour chaque opportunité 
          </h2>
          
          <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
  @php $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first(); @endphp
                 @php
                         $actionss = DB::table('action_commerciales')->whereMonth('deadline', $action_mois)->whereYear('deadline', $annee)->where('cloture', 1)->get();
                @endphp
                
                                                                                        @php 
                                        $prospectsf = DB::table('action_commerciales')->whereMonth('deadline', $action_mois)->whereYear('deadline', $annee)->where('cloture', 1)->pluck('opportunite_id')->toArray(); 
                                        $pays = DB::table('opportunites')->pluck('id')->toArray(); 
                                        $result_pays = array_diff($pays, $prospectsf);
                                        $result_payss = array_diff($pays, $result_pays);
                                        @endphp
     
        
                            <div  class="col-md-3" style = "margin-top:-20px" align="right"> 
                                 <form action="{{route('toutes_actionsFiltre_fait')}}" method="get">
                                     <select name="serachCom" style="width:220px;height:40px"  id="statut" style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par Commercial(e)</option>
                                        @php 
                                        $commerciauxs = DB::table('commerciaus')->pluck('id')->toArray();
                                        $entreprisess = DB::table('action_commerciales')->whereMonth('deadline', $action_mois)->whereYear('deadline', $annee)->where('cloture', 1)->pluck('commercial_id')->toArray();
                                        
                                        $result_comerP = array_diff($commerciauxs, $entreprisess);
                                        $result_comersss = array_diff($commerciauxs, $result_comerP);
                                        
                                        @endphp
                                        
                                        @foreach($result_comersss as $result_comer)
                                        @php $commerciales = DB::table('commerciaus')->where('id', $result_comer)->OrderBy('prenom')->first();  @endphp
                                        <option value="{{$commerciales->id}}">{{$commerciales->prenom}} {{$commerciales->nom}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                      
                                
                                    <select name="serachPays" style="width:220px;height:40px; margin-left:10px;"  id="origine">
                                        <option value="" disabled selected>Rechercher par Pays</option>
                                        @php 
                                        $prospects = DB::table('action_commerciales')->select('action_commerciales.*', 'commerciaus.prenom','commerciaus.nom','commerciaus.pays_id')
                                        ->join('commerciaus', 'commerciaus.id', 'action_commerciales.commercial_id')
                                        ->whereMonth('action_commerciales.deadline', $action_mois)->whereYear('action_commerciales.deadline', $annee)->where('cloture', 1)
                                        ->pluck('commerciaus.pays_id')->toArray(); 

                                         $pays = DB::table('pays')->pluck('id')->toArray(); 
                                         $result_paysF = array_diff($pays, $prospects);
                                         $result_payssF = array_diff($pays, $result_paysF);
                                         
                                        @endphp
                                    @foreach($result_payssF as $result_pay) 
                                        @php $pay = DB::table('pays')->where('id', $result_pay)->OrderBy('libelle')->first();  @endphp
                                        <option value="{{$pay->id}}">{{$pay->libelle}}</option>
                                    @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                    <select name="searchAction" style="width:220px;height:40px; margin-left:10px;"  id="opportunite">
                                        <option value="" disabled selected>Rechercher par opportunité</option>
                                      
                                    @foreach($result_payss as $result_pay) 
                                        @php $pay = DB::table('opportunites')->where('id', $result_pay)->OrderBy('libelle')->first();  @endphp
                                        <option value="{{$pay->id}}">{{$pay->libelle}}</option>
                                    @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-left:10px;" type="submit">Filtrer</button>
                                </form> 
                            </div> 
                            <br>
        @if(count($actions_mois) > 0) 
          <div class="w-full overflow-hidden rounded-lg shadow-xs" style = "margin-top:10px" >
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th style="width:10%" class="px-0 py-1">Commerciaux</th>
                        <th style="width:10%" class="px-0 py-1">Libelle</th>
                        <th style="width:10%" class="px-0 py-1">Deadline</th>
                        <th style="width:10%" class="px-0 py-1">Opportunités</th>
                        <!--<th style="width:10%" class="px-0 py-1">Options</th>-->
                  </tr>
                </thead>
               
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                        @php $n=1; @endphp
                     @foreach($actions_mois as $actionCommercial)
                     
                     @php
                         $OpportuniteAction = DB::table('opportunites')->where('id', $actionCommercial->opportunite_id)->first();
                         $commerciaux = DB::table('commerciaus')->where('id', $actionCommercial->commercial_id)->first();
                     @endphp
              @if($OpportuniteAction)
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        {{$commerciaux->prenom}} {{$commerciaux->nom}}
                        </span>
                    </td>
                    
                    <td class="px-4 py-3 text-xs" data-toggle="tooltip" title="{{$actionCommercial->libelle}}">
                      <span class="px-3 py-1 text-sm ">
                          <h4>{{ \Illuminate\Support\Str::limit($actionCommercial->libelle, 45, $end='...') }}</h4>
                        </span>
                    </td>
                    
                      <td class="px-4 py-3 text-xs">
                    <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        {{($actionCommercial->deadline) ? $actionCommercial->deadline : '--'}}
                      </span>
                      </td>
                     @php
                         $OpportuniteProspect = DB::table('prospects')->where('id', $OpportuniteAction->prospect_id)->first();
                     @endphp
                     @if($OpportuniteAction)
                    <td class="px-4 py-3 text-xs" data-toggle="tooltip" title="{{$OpportuniteAction->libelle}}">
                      <span class="px-3 py-1 text-sm ">
                          <h4>{{ \Illuminate\Support\Str::limit($OpportuniteAction->libelle, 30, $end='...') }}</h4>
                        </span>
                         @if($OpportuniteProspect)
                      &nbsp;<b style="color:#9045e2">({{ strtoupper(($OpportuniteProspect->nom_entreprise) ? $OpportuniteProspect->nom_entreprise : '')}})</b>
                    @else
                      -
                    @endif
                    </td>
                    @else
                    <td class="px-4 py-3 text-xs"></td>
                    @endif
                 
                 </tr>
                 @endif
                  @endforeach
                </tbody>
              </table>
            </div>

        </div>
         @else
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Pas d'actions disponibles poue ce mois!
                </span>
            </label>
            </div>
            @endif
         </div>
         <!------------------------------------------------end-------------------------------------------------------------------------->
          
          
    </div>
    </main>
  </div>
  </div>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/init-alpine.js')}}"></script>
  <script src="{{asset('Koyalis/public/https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js')}}" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/charts-lines.js')}}" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/charts-pie.js')}}" defer></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
            $("#ceMois").hide();
            $("#semaine").hide();
            </script>
             <script>
            $(document).ready(function(){
              $("select").change(function(){
                    $( "select option:selected").each(function(){
                        //enter bengal districts
                        // if($(this).attr("value")=="1000000"){
                        //     $("#tout").hide();
                        //     $("#semaine").hide();
                        //     $("#ceMois").show();
                        // }
                        if($(this).attr("value")=="2000000"){
                            $("#tout").show();
                            $("#ceMois").hide();
                            $("#semaine").hide();
                        }
                        if($(this).attr("value")=="3000000"){
                            $("#semaine").show();
                            $("#tout").hide();
                            $("#ceMois").hide();
                        }
                        //enter other states
                       
                    });
                });  
            }); 

                </script>
</body>


</html>