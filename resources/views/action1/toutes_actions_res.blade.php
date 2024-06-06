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
            @if(Auth::user()->nom_role == "responsable")
             @php
             $commercialMito = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                                             setlocale(LC_TIME, 'fr_FR'); 
                                             $les_moiss = array(1,2,3,4,5,6,7,8,9,10,11,12);
                                             $les_mois = array();
                                             foreach($les_moiss as $les_moisf){
                                             $year_mensuelles = DB::table('action_commerciales')->whereMonth('deadline', $les_moisf)->where('superieur_id', $commercialMito->id)->pluck('created_at')->toArray();
                                            
                                             foreach($year_mensuelles as $year_mensuelle){
                                               array_push($les_mois, date('m', strtotime($year_mensuelle)));
                                             }
                                             }
                                              
                                             $result_moiss = array_diff($les_moiss, $les_mois);
                                             $result_mois = array_diff($les_moiss, $result_moiss);
                            
                                       
                                             $datnow = date('m');
                                        @endphp
            <br><br>
                                         <div class="col-md-3" style="margin-left:600px" >
                                           
                                           <select name="search_a" class="form-select" aria-label="Default select example">
                                              
                                               <option value="">Filtrer</option>
                                              
                                               <option value="1000000">Actions de ce mois</option>
                                               <option value="3000000">Actions de cette semaine</option>
                                               <option value="2000000" >Toutes les actions</option>
                                             
                                           </select>
                                        </div> 
        <div id="semaine"> 
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Toutes les actions de la semaine
          </h2>
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
            
                            
                                    
                                     @php 
                                        $result_payssF_ar = array();
                                        $commerciauxs = DB::table('commerciaus')->where('superieur_id', $moi->id)->pluck('id')->toArray();
                                        foreach($commerciauxs as $commerciauxss){
                                         $a = DB::table('action_commerciales')->where('commercial_id', $commerciauxss)->whereDay('created_at', '<=', $action_semaineP7)->WhereDay('created_at', '>=', $semaineM7)->whereMonth('created_at', $action_mois)->whereYear('created_at', $annee)->where('cloture', 0)->pluck('opportunite_id')->toArray();
                                         $pays = DB::table('opportunites')->pluck('id')->toArray();  
                                         $result_paysF = array_diff($pays, $a);
                                         $result_payssF = array_diff($pays, $result_paysF);
                                        
                                           foreach($result_payssF as $result_payssFs)
                                            {
                                             array_push($result_payssF_ar, $result_payssFs); 
                                            }
                                            
                                           
                                           
                                         }
                                            $prospectsf = DB::table('opportunites')->pluck('id')->toArray(); 
                                            $arDif1 = array_diff($prospectsf, $result_payssF_ar);
                                            $arDif2 = array_diff($prospectsf, $arDif1);
                                            
                                        @endphp
        
                            <div  class="col-md-3" style = "margin-top:-20px"  > 
                                 <form action="{{route('toutes_actionsFiltre_res')}}" method="get">
                                     
                                      
                                    
                                     
                                     <select name="serachCom" style="width:220px;height:40px"  id="statut" style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par Commercial(e)</option>
                                        @php 
                                        
                                        $commerciauxs = DB::table('commerciaus')->where('superieur_id', $moi->id)->pluck('id')->toArray();
                                        $entreprisess = DB::table('action_commerciales')->whereDay('created_at', '<=', $action_semaineP7)->WhereDay('created_at', '>=', $semaineM7)->whereMonth('created_at', $action_mois)->whereYear('created_at', $annee)->where('cloture', 0)->pluck('commercial_id')->toArray();
                                        
                                        $result_comerP = array_diff($commerciauxs, $entreprisess);
                                        $result_comersss = array_diff($commerciauxs, $result_comerP);
                                        
                                        
                                        @endphp
                                        
                                        @foreach($result_comersss as $result_comere)
                                        @php $commerciales = DB::table('commerciaus')->where('id', $result_comere)->OrderBy('prenom')->first();  @endphp
                                        <option value="{{$commerciales->id}}">{{$commerciales->prenom}} {{$commerciales->nom}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                      
                                
                                  
                                    <select name="searchAction" style="width:220px;height:40px; margin-left:10px;"  id="opportunite">
                                        <option value="" disabled selected>Rechercher par opportunité</option>
                                      
                                    @foreach($arDif2 as $result_pay) 
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
                        <th style="width:10%" class="px-0 py-1">Statut</th>
                        <th style="width:10%" class="px-0 py-1">Options</th>
                  </tr>
                </thead>
               
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                        @php $n=1; @endphp
                     @foreach($actions_semaine as $actionCommercial)
                     
                     @php
                         $OpportuniteAction = DB::table('opportunites')->where('id', $actionCommercial->opportunite_id)->first();
                         $commerciaux = DB::table('commerciaus')->where('id', $actionCommercial->commercial_id)->first();
                         $prosAction = DB::table('prospects')->where('id', $actionCommercial->prospect_id)->first();
                     @endphp
                @if( ($action_semaineP7 >= date('d', strtotime($actionCommercial->deadline))) && ($semaineM7 <= date('d', strtotime($actionCommercial->deadline))) && ($action_mois == date('m', strtotime($actionCommercial->deadline))) && ($annee == date('Y', strtotime($actionCommercial->deadline))) )
                  @if($actionCommercial->libelle)
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        {{$commerciaux->prenom}} {{$commerciaux->nom}}
                        </span>
                    </td>
                    
                    <td class="px-4 py-3 text-xs" data-toggle="tooltip" title="{{$actionCommercial->libelle}}">
                      <span class="px-3 py-1 text-sm ">
                          <h4>{{ \Illuminate\Support\Str::limit($actionCommercial->libelle, 25, $end='...') }}</h4>
                        </span>
                    </td>
                    
                      <td class="px-4 py-3 text-xs">
                    <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        {{($actionCommercial->deadline) ? $actionCommercial->deadline : '--'}}
                      </span>
                      </td>
                  @if($OpportuniteAction)
                        @php
                         $OpportuniteProspect = DB::table('prospects')->where('id', $OpportuniteAction->prospect_id)->first();
                        @endphp
                   
                        <td class="px-4 py-3 text-xs" >
                            <span class="px-3 py-1 text-sm " data-toggle="tooltip" title="{{$OpportuniteAction->libelle}}">
                              <h4>{{ \Illuminate\Support\Str::limit($OpportuniteAction->libelle, 25, $end='...') }}</h4>
                            </span>
                                @if($OpportuniteProspect)
                                  &nbsp;<b style="color:#9045e2" data-toggle="tooltip" title="{{$OpportuniteProspect->nom_entreprise}}">({{ strtoupper(($OpportuniteProspect->nom_entreprise) ? \Illuminate\Support\Str::limit($OpportuniteProspect->nom_entreprise, 15, $end='...') : '')}})</b>
                                @else
                                    Non renseigné
                                @endif
                        </td>
                      @elseif($prosAction)
                        <td class="px-4 py-3 text-xs" >
                          <span class="px-3 py-1 text-sm " data-toggle="tooltip" title="{{$prosAction->nom_entreprise}}">
                              <b style="color:#9045e2" >{{ \Illuminate\Support\Str::limit($prosAction->nom_entreprise, 15, $end='...') }}</b>
                            </span>
                        </td>
                     @else
                        <td class="px-4 py-3 text-xs" >
                          <span class="px-3 py-1 text-sm " >
                              Non renseigné
                            </span>
                        </td>
                     @endif
                 <td class="text-gray-700 dark:text-gray-400">
                      @if($actionCommercial->cloture == 0)
                      <p style="color:orange"> En cours </p>
                      @else
                      <p style="color:green"> Terminée </p>
                      @endif
                    </td>
                    <td class="px-4 py-3 text-xs">
                        <span  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Modifier votre action">
                            <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"
                                href="{{route('modifier_action', $actionCommercial->id )}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
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
            Toutes les actions 
          </h2>
          
          <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
            
            <!--<div  class="col-md-3" style = "margin-top:-40px"  > -->
            <!--                     <form action="{{route('toutes_actionsFiltre_res')}}" method="get">-->
            <!--                        <select name="serachComMois" style="width:220px;height:40px"  style="margin-right:10px; display:flex;">-->
                                     
            <!--                            <option value="" disabled selected>Rechercher par mois</option>-->
    
            <!--                              @foreach($result_mois as $result_moi)-->
            <!--                              @php  $obje_mensuelle = DB::table('action_commerciales')->whereMonth('deadline', $result_moi)->where('superieur_id', $commercialMito->id)->first(); @endphp-->
            <!--                             @if(date('m', strtotime($obje_mensuelle->deadline)) == 12)-->
            <!--                             <option value="{{$result_moi}}">{{ucfirst(strftime('Décembre / %Y', strtotime($obje_mensuelle->deadline)))}}</option>-->
            <!--                             @else-->
            <!--                             <option value="{{$result_moi}}">{{ucfirst(strftime('%B / %Y', strtotime($obje_mensuelle->deadline)))}}</option>-->
            <!--                             @endif-->
                                         
            <!--                             @endforeach-->
            <!--                        </select>-->
                                    
                                    
            <!--                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-left:10px;" type="submit">Filtrer</button>-->

            <!--                    </form>  -->
            <!--                </div>  -->
  @php $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first(); @endphp
                 @php
                         $actionss = DB::table('action_commerciales')->where('cloture', 0)->get();
                @endphp
                
                                                                                        @php 
                                        $prospectsf = DB::table('action_commerciales')->where('cloture', 0)->pluck('opportunite_id')->toArray(); 
                                        $pays = DB::table('opportunites')->pluck('id')->toArray(); 
                                        $result_pays = array_diff($pays, $prospectsf);
                                        $result_payss = array_diff($pays, $result_pays);
                                        @endphp
     
        
                            <div  class="col-md-3" style = "margin-top:10px"  > 
                                 <form action="{{route('toutes_actionsFiltre_res')}}" method="get">
                                     
                                     
                                    
                                    <select name="serachCom" style="width:220px;height:40px"  id="statut" style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par Commercial(e)</option>
                                        @php 
                                        $commerciauxs = DB::table('commerciaus')->where('superieur_id', $moi->id)->pluck('id')->toArray();
                                        $entreprisess = DB::table('action_commerciales')
                                        ->where('cloture', 0)->pluck('commercial_id')->toArray();
                                        
                                        $result_comerP = array_diff($commerciauxs, $entreprisess);
                                        $result_comersss = array_diff($commerciauxs, $result_comerP);
                                        
                                        @endphp
                                        
                                        @foreach($result_comersss as $result_comer)
                                        @php $commerciales = DB::table('commerciaus')->where('id', $result_comer)->OrderBy('prenom')->first();  @endphp
                                        <option value="{{$commerciales->id}}">{{$commerciales->prenom}} {{$commerciales->nom}}</option>
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
                        <th style="width:10%" class="px-0 py-1">Statut</th>
                        <th style="width:10%" class="px-0 py-1">Options</th>
                  </tr>
                </thead>
               
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                        @php $n=1; @endphp
                     @foreach($actions as $actionCommercial)
                     @if($actionCommercial->cloture == 0)
                     
                     @php
                         $OpportuniteAction = DB::table('opportunites')->where('id', $actionCommercial->opportunite_id)->first();
                         $commerciaux = DB::table('commerciaus')->where('id', $actionCommercial->commercial_id)->first();
                         $prosAction = DB::table('prospects')->where('id', $actionCommercial->prospect_id)->first();
                     @endphp
               @if($commerciaux)
                @if($actionCommercial->libelle)
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        {{$commerciaux->prenom}} {{$commerciaux->nom}}
                        </span>
                    </td>
                    
                    <td class="px-4 py-3 text-xs" data-toggle="tooltip" title="{{$actionCommercial->libelle}}">
                      <span class="px-3 py-1 text-sm ">
                          <h4>{{ \Illuminate\Support\Str::limit($actionCommercial->libelle, 25, $end='...') }}</h4>
                        </span>
                    </td>
                    
                      <td class="px-4 py-3 text-xs">
                    <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        {{($actionCommercial->deadline) ? $actionCommercial->deadline : '--'}}
                      </span>
                      </td>
                      @if($OpportuniteAction)
                        @php
                         $OpportuniteProspect = DB::table('prospects')->where('id', $OpportuniteAction->prospect_id)->first();
                        @endphp
                   
                        <td class="px-4 py-3 text-xs" >
                            <span class="px-3 py-1 text-sm " data-toggle="tooltip" title="{{$OpportuniteAction->libelle}}">
                              <h4>{{ \Illuminate\Support\Str::limit($OpportuniteAction->libelle, 25, $end='...') }}</h4>
                            </span>
                                @if($OpportuniteProspect)
                                  &nbsp;<b style="color:#9045e2" data-toggle="tooltip" title="{{$OpportuniteProspect->nom_entreprise}}">({{ strtoupper(($OpportuniteProspect->nom_entreprise) ? \Illuminate\Support\Str::limit($OpportuniteProspect->nom_entreprise, 15, $end='...') : '')}})</b>
                                @else
                                    Non renseigné
                                @endif
                        </td>
                      @elseif($prosAction)
                        <td class="px-4 py-3 text-xs" >
                          <span class="px-3 py-1 text-sm " data-toggle="tooltip" title="{{$prosAction->nom_entreprise}}">
                              <b style="color:#9045e2" >{{ \Illuminate\Support\Str::limit($prosAction->nom_entreprise, 15, $end='...') }}</b>
                            </span>
                        </td>
                     @else
                        <td class="px-4 py-3 text-xs" >
                          <span class="px-3 py-1 text-sm " >
                              Non renseigné
                            </span>
                        </td>
                     @endif
                  <td class="text-gray-700 dark:text-gray-400">
                      @if($actionCommercial->cloture == 0)
                      <p style="color:orange"> En cours </p>
                      @else
                      <p style="color:green"> Terminée </p>
                      @endif
                    </td>
                    <td class="px-4 py-3 text-xs">
                        <span  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Modifier votre action">
                            <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"
                                href="{{route('modifier_action', $actionCommercial->id )}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </a>
                        </span>
                    </td>
                 </tr>
                 @endif
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
            Toutes les actions de ce mois
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
                         $actionss = DB::table('action_commerciales')->whereMonth('created_at', $action_mois)->whereYear('created_at', $annee)->where('cloture', 0)->get();
                @endphp
                
                                                                                        @php 
                                        $prospectsf = DB::table('action_commerciales')->whereMonth('created_at', $action_mois)->whereYear('created_at', $annee)->where('cloture', 0)->pluck('opportunite_id')->toArray(); 
                                        $pays = DB::table('opportunites')->pluck('id')->toArray(); 
                                        $result_pays = array_diff($pays, $prospectsf);
                                        $result_payss = array_diff($pays, $result_pays);
                                        @endphp
     
        
                            <div  class="col-md-3" style = "margin-top:-20px"  > 
                                 <form action="{{route('toutes_actionsFiltre_res')}}" method="get">
                                     
                                      
                                     <select name="serachCom" style="width:220px;height:40px"  id="statut" style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par Commercial(e)</option>
                                        @php 
                                        $commerciauxs = DB::table('commerciaus')->where('superieur_id', $moi->id)->pluck('id')->toArray();
                                        $entreprisess = DB::table('action_commerciales')->whereMonth('created_at', $action_mois)->whereYear('created_at', $annee)->where('cloture', 0)->pluck('commercial_id')->toArray();
                                        
                                        $result_comerP = array_diff($commerciauxs, $entreprisess);
                                        $result_comersss = array_diff($commerciauxs, $result_comerP);
                                        
                                        @endphp
                                        
                                        @foreach($result_comersss as $result_comer)
                                        @php $commerciales = DB::table('commerciaus')->where('id', $result_comer)->OrderBy('prenom')->first();  @endphp
                                        <option value="{{$commerciales->id}}">{{$commerciales->prenom}} {{$commerciales->nom}}</option>
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
                        <th style="width:10%" class="px-0 py-1">Statut</th>
                        <th style="width:10%" class="px-0 py-1">Options</th>
                  </tr>
                </thead>
               
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                        @php $n=1; @endphp
                     @foreach($actions_mois as $actionCommercial)
                     
                     @php
                         $OpportuniteAction = DB::table('opportunites')->where('id', $actionCommercial->opportunite_id)->first();
                         $commerciaux = DB::table('commerciaus')->where('id', $actionCommercial->commercial_id)->first();
                         $prosAction = DB::table('prospects')->where('id', $actionCommercial->prospect_id)->first();
                     @endphp
                     @if($commerciaux)
                     @if($actionCommercial->libelle)
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        {{$commerciaux->prenom}} {{$commerciaux->nom}}
                        </span>
                    </td>
                    
                    <td class="px-4 py-3 text-xs" data-toggle="tooltip" title="{{$actionCommercial->libelle}}">
                      <span class="px-3 py-1 text-sm ">
                          <h4>{{ \Illuminate\Support\Str::limit($actionCommercial->libelle, 25, $end='...') }}</h4>
                        </span>
                    </td>
                    
                      <td class="px-4 py-3 text-xs">
                    <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        {{($actionCommercial->deadline) ? $actionCommercial->deadline : '--'}}
                      </span>
                      </td>
                     @if($OpportuniteAction)
                        @php
                         $OpportuniteProspect = DB::table('prospects')->where('id', $OpportuniteAction->prospect_id)->first();
                        @endphp
                   
                        <td class="px-4 py-3 text-xs" >
                            <span class="px-3 py-1 text-sm " data-toggle="tooltip" title="{{$OpportuniteAction->libelle}}">
                              <h4>{{ \Illuminate\Support\Str::limit($OpportuniteAction->libelle, 25, $end='...') }}</h4>
                            </span>
                                @if($OpportuniteProspect)
                                  &nbsp;<b style="color:#9045e2" data-toggle="tooltip" title="{{$OpportuniteProspect->nom_entreprise}}">({{ strtoupper(($OpportuniteProspect->nom_entreprise) ? \Illuminate\Support\Str::limit($OpportuniteProspect->nom_entreprise, 15, $end='...') : '')}})</b>
                                @else
                                    Non renseigné
                                @endif
                        </td>
                      @elseif($prosAction)
                        <td class="px-4 py-3 text-xs" >
                          <span class="px-3 py-1 text-sm " data-toggle="tooltip" title="{{$prosAction->nom_entreprise}}">
                              <b style="color:#9045e2" >{{ \Illuminate\Support\Str::limit($prosAction->nom_entreprise, 15, $end='...') }}</b>
                            </span>
                        </td>
                     @else
                        <td class="px-4 py-3 text-xs" >
                          <span class="px-3 py-1 text-sm " >
                              Non renseigné
                            </span>
                        </td>
                     @endif
                  <td class="text-gray-700 dark:text-gray-400">
                      @if($actionCommercial->cloture == 0)
                      <p style="color:orange"> En cours </p>
                      @else
                      <p style="color:green"> Terminée </p>
                      @endif
                    </td>
                    <td class="px-4 py-3 text-xs">
                        <span  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Modifier votre action">
                            <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"
                                href="{{route('modifier_action', $actionCommercial->id )}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
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
            </div>

        </div>
         @else
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Pas d'actions disponibles pour ce mois!
                </span>
            </label>
            </div>
            @endif
            
            
            <!--------------------------------------------------------------respon pole------------------------------------------------------------->
            @elseif(Auth::user()->nom_role == "responsable_pole")
                 @php
             $commercialMito = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                                             setlocale(LC_TIME, 'fr_FR'); 
                                             $les_moiss = array(1,2,3,4,5,6,7,8,9,10,11,12);
                                             $les_mois = array();
                                             foreach($les_moiss as $les_moisf){
                                             $year_mensuelles = DB::table('action_commerciales')->whereMonth('deadline', $les_moisf)->where('superieur_id', $commercialMito->id)->pluck('created_at')->toArray();
                                            
                                             foreach($year_mensuelles as $year_mensuelle){
                                               array_push($les_mois, date('m', strtotime($year_mensuelle)));
                                             }
                                             }
                                              
                                             $result_moiss = array_diff($les_moiss, $les_mois);
                                             $result_mois = array_diff($les_moiss, $result_moiss);
                            
                                       
                                             $datnow = date('m');
                                        @endphp
            <br><br>
                                         <div class="col-md-3" style="margin-left:700px" >
                                           
                                           <select name="search_a" class="form-select" aria-label="Default select example">
                                              
                                               <option value="">Filtrer</option>
                                              
                                               <option value="1000000">Actions de ce mois</option>
                                               <option value="3000000">Actions de cette semaine</option>
                                               <option value="2000000" >Toutes les actions</option>
                                             
                                           </select>
                                        </div> 
        <div id="semaine"> 
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Toutes les actions de la semaine
          </h2>
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
            
                            
                                    
                                     @php 
                                        $result_payssF_ar = array();
                                        $commerciauxs = DB::table('commerciaus')->where('domaine_id', $moi->domaine_id)->pluck('id')->toArray();
                                        foreach($commerciauxs as $commerciauxss){
                                         $a = DB::table('action_commerciales')->where('commercial_id', $commerciauxss)->whereDay('created_at', '<=', $action_semaineP7)->WhereDay('created_at', '>=', $semaineM7)->whereMonth('created_at', $action_mois)->whereYear('created_at', $annee)->where('cloture', 0)->pluck('opportunite_id')->toArray();
                                         $pays = DB::table('opportunites')->pluck('id')->toArray();  
                                         $result_paysF = array_diff($pays, $a);
                                         $result_payssF = array_diff($pays, $result_paysF);
                                        
                                           foreach($result_payssF as $result_payssFs)
                                            {
                                             array_push($result_payssF_ar, $result_payssFs); 
                                            }
                                            
                                           
                                           
                                         }
                                            $prospectsf = DB::table('opportunites')->pluck('id')->toArray(); 
                                            $arDif1 = array_diff($prospectsf, $result_payssF_ar);
                                            $arDif2 = array_diff($prospectsf, $arDif1);
                                            
                                        @endphp
        
                            <div  class="col-md-3" style = "margin-top:-20px"  > 
                                 <form action="{{route('toutes_actionsFiltre_res')}}" method="get">
                                     
                                      
                                    
                                     
                                     <select name="serachCom" style="width:220px;height:40px"  id="statut" style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par Commercial(e)</option>
                                        @php 
                                        
                                        $commerciauxs = DB::table('commerciaus')->where('domaine_id', $moi->domaine_id)->pluck('id')->toArray();
                                        $entreprisess = DB::table('action_commerciales')->whereDay('created_at', '<=', $action_semaineP7)->WhereDay('created_at', '>=', $semaineM7)->whereMonth('created_at', $action_mois)->whereYear('created_at', $annee)->where('cloture', 0)->pluck('commercial_id')->toArray();
                                        
                                        $result_comerP = array_diff($commerciauxs, $entreprisess);
                                        $result_comersss = array_diff($commerciauxs, $result_comerP);
                                        
                                        
                                        @endphp
                                        
                                        @foreach($result_comersss as $result_comere)
                                        @php $commerciales = DB::table('commerciaus')->where('id', $result_comere)->OrderBy('prenom')->first();  @endphp
                                        <option value="{{$commerciales->id}}">{{$commerciales->prenom}} {{$commerciales->nom}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                      
                                
                                  
                                    <select name="searchAction" style="width:220px;height:40px; margin-left:10px;"  id="opportunite">
                                        <option value="" disabled selected>Rechercher par opportunité</option>
                                      
                                    @foreach($arDif2 as $result_pay) 
                                                @php $pay = DB::table('opportunites')->where('id', $result_pay)->OrderBy('libelle')->first();  @endphp
                                         <option value="{{$pay->id}}">{{$pay->libelle}}</option>
                                    @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-left:10px;" type="submit">Filtrer</button>
                                </form> 
                            </div> 
                            <br>
        @if(count($actions_semaine_pole) > 0) 
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
                        <th style="width:10%" class="px-0 py-1">Statut</th>
                        <th style="width:10%" class="px-0 py-1">Options</th>
                  </tr>
                </thead>
               
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                        @php $n=1; @endphp
                     @foreach($actions_semaine_pole as $actionCommercial_pole)
                     
                     @php
                         $OpportuniteAction = DB::table('opportunites')->where('id', $actionCommercial_pole->opportunite_id)->first();
                         $commerciaux = DB::table('commerciaus')->where('id', $actionCommercial_pole->commercial_id)->first();
                         $prosAction = DB::table('prospects')->where('id', $actionCommercial_pole->prospect_id)->first();
                     @endphp
                @if( ($action_semaineP7 >= date('d', strtotime($actionCommercial_pole->deadline))) && ($semaineM7 <= date('d', strtotime($actionCommercial_pole->deadline))) && ($action_mois == date('m', strtotime($actionCommercial_pole->deadline))) && ($annee == date('Y', strtotime($actionCommercial_pole->deadline))) )
                  @if($commerciaux)
                     @if($actionCommercial_pole->libelle)
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        {{$commerciaux->prenom}} {{$commerciaux->nom}}
                        </span>
                    </td>
                    
                    <td class="px-4 py-3 text-xs" data-toggle="tooltip" title="{{$actionCommercial_pole->libelle}}">
                      <span class="px-3 py-1 text-sm ">
                          <h4>{{ \Illuminate\Support\Str::limit($actionCommercial_pole->libelle, 25, $end='...') }}</h4>
                        </span>
                    </td>
                    
                      <td class="px-4 py-3 text-xs">
                    <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        {{($actionCommercial_pole->deadline) ? $actionCommercial_pole->deadline : '--'}}
                      </span>
                      </td>
                  @if($OpportuniteAction)
                        @php
                         $OpportuniteProspect = DB::table('prospects')->where('id', $OpportuniteAction->prospect_id)->first();
                        @endphp
                   
                        <td class="px-4 py-3 text-xs" >
                            <span class="px-3 py-1 text-sm " data-toggle="tooltip" title="{{$OpportuniteAction->libelle}}">
                              <h4>{{ \Illuminate\Support\Str::limit($OpportuniteAction->libelle, 25, $end='...') }}</h4>
                            </span>
                                @if($OpportuniteProspect)
                                  &nbsp;<b style="color:#9045e2" data-toggle="tooltip" title="{{$OpportuniteProspect->nom_entreprise}}">({{ strtoupper(($OpportuniteProspect->nom_entreprise) ? \Illuminate\Support\Str::limit($OpportuniteProspect->nom_entreprise, 15, $end='...') : '')}})</b>
                                @else
                                    Non renseigné
                                @endif
                        </td>
                      @elseif($prosAction)
                        <td class="px-4 py-3 text-xs" >
                          <span class="px-3 py-1 text-sm " data-toggle="tooltip" title="{{$prosAction->nom_entreprise}}">
                              <b style="color:#9045e2" >{{ \Illuminate\Support\Str::limit($prosAction->nom_entreprise, 15, $end='...') }}</b>
                            </span>
                        </td>
                     @else
                        <td class="px-4 py-3 text-xs" >
                          <span class="px-3 py-1 text-sm " >
                              Non renseigné
                            </span>
                        </td>
                     @endif
                 <td class="text-gray-700 dark:text-gray-400">
                      @if($actionCommercial_pole->cloture == 0)
                      <p style="color:orange"> En cours </p>
                      @else
                      <p style="color:green"> Terminée </p>
                      @endif
                    </td>
                    <td class="px-4 py-3 text-xs">
                        <span  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Modifier votre action">
                            <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"
                                href="{{route('modifier_action', $actionCommercial->id )}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </a>
                        </span>
                    </td>
                 </tr>
                 @endif
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
            Toutes les actions 
          </h2>
          
          <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
            
            <!--<div  class="col-md-3" style = "margin-top:-40px"  > -->
            <!--                     <form action="{{route('toutes_actionsFiltre_res')}}" method="get">-->
            <!--                        <select name="serachComMois" style="width:220px;height:40px"  style="margin-right:10px; display:flex;">-->
                                     
            <!--                            <option value="" disabled selected>Rechercher par mois</option>-->
    
            <!--                              @foreach($result_mois as $result_moi)-->
            <!--                              @php  $obje_mensuelle = DB::table('action_commerciales')->whereMonth('deadline', $result_moi)->where('superieur_id', $commercialMito->id)->first(); @endphp-->
            <!--                             @if(date('m', strtotime($obje_mensuelle->deadline)) == 12)-->
            <!--                             <option value="{{$result_moi}}">{{ucfirst(strftime('Décembre / %Y', strtotime($obje_mensuelle->deadline)))}}</option>-->
            <!--                             @else-->
            <!--                             <option value="{{$result_moi}}">{{ucfirst(strftime('%B / %Y', strtotime($obje_mensuelle->deadline)))}}</option>-->
            <!--                             @endif-->
                                         
            <!--                             @endforeach-->
            <!--                        </select>-->
                                    
                                    
            <!--                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-left:10px;" type="submit">Filtrer</button>-->

            <!--                    </form>  -->
            <!--                </div>  -->
  @php $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first(); @endphp
                 @php
                         $actionss = DB::table('action_commerciales')->where('cloture', 0)->get();
                @endphp
                
                                                                                        @php 
                                        $prospectsf = DB::table('action_commerciales')->where('cloture', 0)->pluck('opportunite_id')->toArray(); 
                                        $pays = DB::table('opportunites')->pluck('id')->toArray(); 
                                        $result_pays = array_diff($pays, $prospectsf);
                                        $result_payss = array_diff($pays, $result_pays);
                                        @endphp
     
        
                            <div  class="col-md-3" style = "margin-top:10px"  > 
                                 <form action="{{route('toutes_actionsFiltre_res')}}" method="get">
                                     
                                     
                                    
                                    <select name="serachCom" style="width:220px;height:40px"  id="statut" style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par Commercial(e)</option>
                                        @php 
                                        $commerciauxs = DB::table('commerciaus')->where('domaine_id', $moi->domaine_id)->pluck('id')->toArray();
                                        $entreprisess = DB::table('action_commerciales')
                                        ->where('cloture', 0)->pluck('commercial_id')->toArray();
                                        
                                        $result_comerP = array_diff($commerciauxs, $entreprisess);
                                        $result_comersss = array_diff($commerciauxs, $result_comerP);
                                        
                                        @endphp
                                        
                                        @foreach($result_comersss as $result_comer)
                                        @php $commerciales = DB::table('commerciaus')->where('id', $result_comer)->OrderBy('prenom')->first();  @endphp
                                        <option value="{{$commerciales->id}}">{{$commerciales->prenom}} {{$commerciales->nom}}</option>
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
        @if(count($actions_pole) > 0) 
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
                        <th style="width:10%" class="px-0 py-1">Statut</th>
                        <th style="width:10%" class="px-0 py-1">Options</th>
                  </tr>
                </thead>
               
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                        @php $n=1; @endphp
                     @foreach($actions_pole as $actionCommercial_pole)
                     @if($actionCommercial_pole->cloture == 0)
                     
                     @php
                         $OpportuniteAction = DB::table('opportunites')->where('id', $actionCommercial_pole->opportunite_id)->first();
                         $commerciaux = DB::table('commerciaus')->where('id', $actionCommercial_pole->commercial_id)->first();
                         $prosAction = DB::table('prospects')->where('id', $actionCommercial_pole->prospect_id)->first();
                     @endphp
               @if($commerciaux)
                     @if($actionCommercial_pole->libelle)
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        {{$commerciaux->prenom}} {{$commerciaux->nom}}
                        </span>
                    </td>
                    
                    <td class="px-4 py-3 text-xs" data-toggle="tooltip" title="{{$actionCommercial_pole->libelle}}">
                      <span class="px-3 py-1 text-sm ">
                          <h4>{{ \Illuminate\Support\Str::limit($actionCommercial_pole->libelle, 25, $end='...') }}</h4>
                        </span>
                    </td>
                    
                      <td class="px-4 py-3 text-xs">
                    <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        {{($actionCommercial_pole->deadline) ? $actionCommercial_pole->deadline : '--'}}
                      </span>
                      </td>
                      @if($OpportuniteAction)
                        @php
                         $OpportuniteProspect = DB::table('prospects')->where('id', $OpportuniteAction->prospect_id)->first();
                        @endphp
                   
                        <td class="px-4 py-3 text-xs" >
                            <span class="px-3 py-1 text-sm " data-toggle="tooltip" title="{{$OpportuniteAction->libelle}}">
                              <h4>{{ \Illuminate\Support\Str::limit($OpportuniteAction->libelle, 25, $end='...') }}</h4>
                            </span>
                                @if($OpportuniteProspect)
                                  &nbsp;<b style="color:#9045e2" data-toggle="tooltip" title="{{$OpportuniteProspect->nom_entreprise}}">({{ strtoupper(($OpportuniteProspect->nom_entreprise) ? \Illuminate\Support\Str::limit($OpportuniteProspect->nom_entreprise, 15, $end='...') : '')}})</b>
                                @else
                                    Non renseigné
                                @endif
                        </td>
                      @elseif($prosAction)
                        <td class="px-4 py-3 text-xs" >
                          <span class="px-3 py-1 text-sm " data-toggle="tooltip" title="{{$prosAction->nom_entreprise}}">
                              <b style="color:#9045e2" >{{ \Illuminate\Support\Str::limit($prosAction->nom_entreprise, 15, $end='...') }}</b>
                            </span>
                        </td>
                     @else
                        <td class="px-4 py-3 text-xs" >
                          <span class="px-3 py-1 text-sm " >
                              Non renseigné
                            </span>
                        </td>
                     @endif
                  <td class="text-gray-700 dark:text-gray-400">
                      @if($actionCommercial_pole->cloture == 0)
                      <p style="color:orange"> En cours </p>
                      @else
                      <p style="color:green"> Terminée </p>
                      @endif
                    </td>
                    <td class="px-4 py-3 text-xs">
                        <span  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Modifier votre action">
                            <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"
                                href="{{route('modifier_action', $actionCommercial->id )}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </a>
                        </span>
                    </td>
                 </tr>
                 @endif
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
            Toutes les actions de ce mois
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
                         $actionss = DB::table('action_commerciales')->whereMonth('created_at', $action_mois)->whereYear('created_at', $annee)->where('cloture', 0)->get();
                @endphp
                
                                                                                        @php 
                                        $prospectsf = DB::table('action_commerciales')->whereMonth('created_at', $action_mois)->whereYear('created_at', $annee)->where('cloture', 0)->pluck('opportunite_id')->toArray(); 
                                        $pays = DB::table('opportunites')->pluck('id')->toArray(); 
                                        $result_pays = array_diff($pays, $prospectsf);
                                        $result_payss = array_diff($pays, $result_pays);
                                        @endphp
     
        
                            <div  class="col-md-3" style = "margin-top:-20px"  > 
                                 <form action="{{route('toutes_actionsFiltre_res')}}" method="get">
                                     
                                      
                                     <select name="serachCom" style="width:220px;height:40px"  id="statut" style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par Commercial(e)</option>
                                        @php 
                                        $commerciauxs = DB::table('commerciaus')->where('domaine_id', $moi->domaine_id)->pluck('id')->toArray();
                                        $entreprisess = DB::table('action_commerciales')->whereMonth('created_at', $action_mois)->whereYear('created_at', $annee)->where('cloture', 0)->pluck('commercial_id')->toArray();
                                        
                                        $result_comerP = array_diff($commerciauxs, $entreprisess);
                                        $result_comersss = array_diff($commerciauxs, $result_comerP);
                                        
                                        @endphp
                                        
                                        @foreach($result_comersss as $result_comer)
                                        @php $commerciales = DB::table('commerciaus')->where('id', $result_comer)->OrderBy('prenom')->first();  @endphp
                                        <option value="{{$commerciales->id}}">{{$commerciales->prenom}} {{$commerciales->nom}}</option>
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
        @if(count($actions_mois_pole) > 0) 
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
                        <th style="width:10%" class="px-0 py-1">Statut</th>
                        <th style="width:10%" class="px-0 py-1">Options</th>
                  </tr>
                </thead>
               
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                        @php $n=1; @endphp
                     @foreach($actions_mois_pole as $actionCommercial_pole)
                     
                     @php
                         $OpportuniteAction = DB::table('opportunites')->where('id', $actionCommercial_pole->opportunite_id)->first();
                         $commerciaux = DB::table('commerciaus')->where('id', $actionCommercial_pole->commercial_id)->first();
                         $prosAction = DB::table('prospects')->where('id', $actionCommercial_pole->prospect_id)->first();
                     @endphp
                     @if($commerciaux)
                     @if($actionCommercial_pole->libelle)
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        {{$commerciaux->prenom}} {{$commerciaux->nom}}
                        </span>
                    </td>
                    
                    <td class="px-4 py-3 text-xs" data-toggle="tooltip" title="{{$actionCommercial_pole->libelle}}">
                      <span class="px-3 py-1 text-sm ">
                          <h4>{{ \Illuminate\Support\Str::limit($actionCommercial_pole->libelle, 25, $end='...') }}</h4>
                        </span>
                    </td>
                    
                      <td class="px-4 py-3 text-xs">
                    <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        {{($actionCommercial_pole->deadline) ? $actionCommercial_pole->deadline : '--'}}
                      </span>
                      </td>
                     @if($OpportuniteAction)
                        @php
                         $OpportuniteProspect = DB::table('prospects')->where('id', $OpportuniteAction->prospect_id)->first();
                        @endphp
                   
                        <td class="px-4 py-3 text-xs" >
                            <span class="px-3 py-1 text-sm " data-toggle="tooltip" title="{{$OpportuniteAction->libelle}}">
                              <h4>{{ \Illuminate\Support\Str::limit($OpportuniteAction->libelle, 25, $end='...') }}</h4>
                            </span>
                                @if($OpportuniteProspect)
                                  &nbsp;<b style="color:#9045e2" data-toggle="tooltip" title="{{$OpportuniteProspect->nom_entreprise}}">({{ strtoupper(($OpportuniteProspect->nom_entreprise) ? \Illuminate\Support\Str::limit($OpportuniteProspect->nom_entreprise, 15, $end='...') : '')}})</b>
                                @else
                                    Non renseigné
                                @endif
                        </td>
                      @elseif($prosAction)
                        <td class="px-4 py-3 text-xs" >
                          <span class="px-3 py-1 text-sm " data-toggle="tooltip" title="{{$prosAction->nom_entreprise}}">
                              <b style="color:#9045e2" >{{ \Illuminate\Support\Str::limit($prosAction->nom_entreprise, 15, $end='...') }}</b>
                            </span>
                        </td>
                     @else
                        <td class="px-4 py-3 text-xs" >
                          <span class="px-3 py-1 text-sm " >
                              Non renseigné
                            </span>
                        </td>
                     @endif
                  <td class="text-gray-700 dark:text-gray-400">
                      @if($actionCommercial_pole->cloture == 0)
                      <p style="color:orange"> En cours </p>
                      @else
                      <p style="color:green"> Terminée </p>
                      @endif
                    </td>
                    <td class="px-4 py-3 text-xs">
                        <span  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Modifier votre action">
                            <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"
                                href="{{route('modifier_action', $actionCommercial->id )}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
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
            </div>

        </div>
         @else
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Pas d'actions disponibles pour ce mois!
                </span>
            </label>
            </div>
            @endif
            
             @endif
            <!-----------------------------------------------------------endpole-------------------------------------------------------------->
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
                        if($(this).attr("value")=="1000000"){
                            $("#tout").hide();
                            $("#semaine").hide();
                            $("#ceMois").show();
                        }
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