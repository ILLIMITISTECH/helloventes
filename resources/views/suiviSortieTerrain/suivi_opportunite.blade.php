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
    
    
    
    <div class="container">
      @include('v2.header_dg')
<main class="h-full pb-16 overflow-y-auto" >
    <div class="row">
        <div class="col-12 col-s-12">
        
        <!--les formulaires-->
        <div class="container px-6 mx-auto grid">
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="font-size:18px;">
            Suivi des Opportunités 
          </h2>
          <div class="form-group" style="display:flex;">
           <h6> 
              @if (session('ajout_action'))
                  <div class="alert alert-success" role="alert">
                      <a  href="{{route('ajout_action_op', session('ajout_action'))}}"  class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Ajouter une action</a>
                      
                  </div>  
              @endif
            </h6> 
               <h6>
                  @if (session('ajout_rv'))
                      <div class="alert alert-success" role="alert" style="margin-left:50px;">
                          <a  href="{{route('ajout_rv_op', session('ajout_rv'))}}"  class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Ajouter un rendez-vous</a>
                          
                      </div>  
                  @endif
              </h6>
              </div>
                    <!-- General elements -->
            <h6>
             
              <br>  
                   <div class="row" style="display:flex, margin-top:20px;"> 
                    
                   <a href="/opportunite_gagner">
                    <button style="width:178px"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                         Opportunités gagnées
                    </button> </a> 
                    
                    <a href="/opportunite_perdu">
                    <button style="width:175px"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                         Opportunités perdues
                    </button> </a> 
                    
                    <a href="/opportunite_abandonner">
                    <button style="width:220px"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                         Opportunités abandonnées
                    </button> </a>
                    
                    <a href="/opportunite_archiver">
                    <button style="width:200px"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                         Opportunités en stand-by
                    </button> </a>
                    </div> 
            <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
             <h6> 
              @if (session('messages'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('messages') }}
                  </div>  
              @endif
            </h6>
          
            
            <h6> 
              @if (session('msBra'))
                 
                     
                    <div class="alert alert-succes" role="alert">
                      <b style="color:green;">{{ session('msBra') }}</b>
                  </div>  
                 
              @endif
            </h6>
            
        <br>
        
        <h6> 
              @if (session('msAten'))
                  
                     
                    <div class="alert alert-succes" role="alert">
                      <b style="color:red;">{{ session('msAten') }}</b>
                  </div>  
                
              @endif
            </h6>
            
     <h6> 
              @if (session('fini'))
                  <div class="alert alert-success" role="alert">
                      <b style="color:lightgreen;">{{ session('fini') }}</b>
                  </div>  
              @endif
            </h6>
            
            
            <h6> 
              @if (session('archive'))
                  <div class="alert alert-success" role="alert">
                     <b style="color:lightgreen;"> {{ session('archive') }}</b>
                  </div>  
              @endif
            </h6>
             <br><br>
                        
                            
                            <div class="container px-6 mx-auto grid" >
                            <div align="left"  style="margin-top:10px;">
                            </div>
                                         <div align="left"  style="margin-top:-50px;">
                                           
                                            <select name="search" style="width:220px;height:40px"  id="statut" style="margin-left:-10px;">
                                              
                                               <option value="">Filtrer par probabilité</option>
                                              
                                               <option value="1001">Probabilité de 70 à 100%</option>
                                               <option value="1002">Probabilité de 50 à 70%</option>
                                               <option value="1003" >Toutes les opportunités</option>
                                             
                                           </select>
                                        </div> 
                            <div style = "margin-left: 380px; margin-top:-50px" > 
                                 <form action="{{route('search_statut')}}" method="get" style="margsearchfin-top:5px; display:flex;">
                                     
                                       
                                           
                                    <select name="search" style="width:220px;height:40px"  id="statut" style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par statut</option>
                                      
                                        @php $staut = DB::table('statut_opportunites')->OrderBy('libelle')->get();  @endphp
                                        @foreach($staut as $stauts)
                                        <option value="{{$stauts->id}}">{{$stauts->libelle}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                      
                                
                                    <select name="searchOr" style="width:220px;height:40px; margin-left:10px;"  id="origine">
                                        <option value="" disabled selected>Rechercher par Origine</option>
                                      
                                        @php $origines = DB::table('origines')->OrderBy('libelle')->get();  @endphp
                                        @foreach($origines as $origine)
                                        <option value="{{$origine->id}}">{{$origine->libelle}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                    
                                 
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-left:10px;" type="submit">Filtrer</button>
                                </form> 
                            </div> 
                            <br>

           <div class="container" id="tout">
              
              @if($opportunite->isEmpty()) 
                 	  <p class="dark:text-gray-400">Pas d'opportunité</p>
					 @else
            <div class="container">
                 <div class="row">
                            <div class="col-12 col-s-12">
              <table >
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Origine</th>-->
                    <th style="width:18%" align="left" >Libellé</th>
                    <!--<th style="width:8%" class="px-0 py-1">Entreprises</th>-->
                    <th style="width:10%" class="px-0 py-1">Objectifs vente</th>
                    <th style="width:10%" class="px-0 py-1">Probabilité</th>
                    <th style="width:10%" class="px-0 py-1">Statut</th>
                    <th style="width:10%" class="px-0 py-1">Date MAJ</th>
                    <th style="width:10%"  class="px-0 py-1">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach($opportunite as $opportunites)
                @php $prospect = DB::table('prospects')->where('id', $opportunites->prospect_id)->first(); 
                    $origine = DB::table('origines')->where('id', $opportunites->origine_id)->first(); 
                    $infoActions = DB::table('action_commerciales')->where('opportunite_id', $opportunites->id)->where('cloture', 0)->orderBy('deadline', 'desc')->paginate(3); 

                @endphp
                 @if($opportunites->archiver == 0 )
                  <tr class="text-gray-700 dark:text-gray-400">
                    <!--  @if($origine)-->
                    <!--<td class="px-4 py-3 text-xs">-->
                    <!--  <span class="px-3 py-1 text-sm ">-->
                    <!--    {{($origine->libelle) ? $origine->libelle : ''}}-->
                    <!--  </span>-->
                    <!--</td>-->
                    <!--@else-->
                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--  --->
                    <!--</td>-->
                    <!--@endif-->
                    <td align="left" data-toggle="tooltip" title="{{$opportunites->libelle}} : @foreach($infoActions as $infoAction) {{($infoAction->libelle) ? $infoAction->libelle : 'pas action'}} : {{($infoAction->deadline) ? $infoAction->deadline : ''}} @endforeach">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                        <a href="{{ route('detail_op',$opportunites->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunites->libelle, 25, $end='...') }}</h4>
                            </button>
                          </div></a>
                        <!--</div>-->
                   
                     @if($prospect)
                     <!--{{ ($prospect->nom_entreprise) ? $prospect->nom_entreprise : ''}}-->
                      &nbsp;<b style="color:#9045e2">({{ strtoupper(($prospect->nom_entreprise) ? $prospect->nom_entreprise : '')}})</b>
                    @else
                      -
                    @endif
                     </td>
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        
                        {{(number_format($opportunites->objectif_de_vente)) ? number_format($opportunites->objectif_de_vente) : '0'}} f
                      </span>
                    </td>
                    
                     <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        
                        {{$opportunites->probabilite ? $opportunites->probabilite : '00'}} %
                      </span>
                    </td>
                    @php $statut = DB::table('statut_opportunites')->where('id', $opportunites->statut)->first(); @endphp
                    @if($statut)
                    <td class="px-4 py-3 text-sm">
                      <button style="font-size:10px;"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                          {{($statut->libelle) ? $statut->libelle : ''}}
                    </button>
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    
                    <td class="px-4 py-3 text-sm">
                     
                     {{date('d-m-Y', strtotime($opportunites->updated_at))}}
                      
                    </td>
                    <td>
                                                <div class="row">
                            <div class="col-12 col-s-12" style="display:flex;">
                        
                         <span  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Mettre à jour le statut">
                              <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('mettre_a_jour_statut.edit', $opportunites->id)}}" >
                                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                  <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                  <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                                </svg>
                                </a>
                            </span>
                  
                       <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Update l'action de l'opportunité">
                          <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('opportunite_prospectCreate', $opportunites->id)}}" >
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-plus" viewBox="0 0 16 16">
                              <path d="M8.5 6a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V10a.5.5 0 0 0 1 0V8.5H10a.5.5 0 0 0 0-1H8.5V6z"/>
                              <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                            </svg>
                            </a>
                        </span>
                  
                        
                        <div class="dropdown">
                          <button class="dropbtn px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                             <b>...</b> 
                            </button>
                          <div class="dropdown-content">
                          <a href="{{ route('detail_op',$opportunites->id) }}">Voir détails</a>
                          <!--<a href="{{route('mettre_a_jour_proba.edit', $opportunites->id)}}">Modifier probabilité</a>-->
                          <a href="{{route('op.edit', $opportunites->id)}}">Modifier l'opportunité</a>
                          <a href="{{ route('historiques_op.voir',$opportunites->id) }}">Voir l'historique des statuts</a>
                          <!--<a href="{{ route('historiques_proba.voir',$opportunites->id) }}">Voir l'historique des probabilités</a>-->
                          <a href="{{route('opportunite_VenteCreate', $opportunites->id)}}">Clôturer </a>
                          <a href="{{route('toutes_lesactions.voir', $opportunites->id)}}">Voir les actions</a>
                          <a href="{{route('opportunite_ajoutUpdate', $opportunites->id)}}">Ajouter des updates </a>
                          <a href="{{route('opportunite_ajoutDemo', $opportunites->id)}}">Ajouter une démo </a>
                          </div>
                        </div>
                      
                    </div>
                    </div>
                    
                    </td>
                 </tr>
                 @endif
                  @endforeach
                </tbody>
              </table>
               </div>
                    </div>
            </div>
           {{$opportunite->links()}}
            @endif
             </div>
             
             
             <!-- start 70 - 100 % -->
             
            
           
          <div class="container" id="70-100">
        
             <div class="container px-2 mx-auto grid">
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="font-size:18px;">
            Opportunités probabilité : 70 - 100 %
          </h2>
             
             <div class="container">
              
              @if($opportunite->isEmpty()) 
                 	  <p class="dark:text-gray-400" >Pas d'opportunité</p>
					 @else
            <div class="container">
              <table >
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Origine</th>-->
                    <th style="width:18%" >Libellé</th>
                    <th style="width:8%" class="px-0 py-1">Entreprises</th>
                    <th style="width:10%" class="px-0 py-1">Objectifs vente</th>
                    <th style="width:10%" class="px-0 py-1">Probabilité</th>
                    <th style="width:10%" class="px-0 py-1">Statut</th>
                    <th style="width:10%" class="px-0 py-1">Date MAJ</th>
                    <th style="width:10%"  class="px-0 py-1">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach($opportunite as $opportunites)
                        @php $prospect = DB::table('prospects')->where('id', $opportunites->prospect_id)->first(); 
                            $origine = DB::table('origines')->where('id', $opportunites->origine_id)->first(); 
                            $infoActions = DB::table('action_commerciales')->where('opportunite_id', $opportunites->id)->where('cloture', 0)->orderBy('deadline', 'desc')->paginate(3); 
                        @endphp
                @if($opportunites->probabilite >= 70)
                 @if($opportunites->archiver == 0 )
                  <tr class="text-gray-700 dark:text-gray-400">
                 
                    <td align="left" data-toggle="tooltip" title="{{$opportunites->libelle}} : @foreach($infoActions as $infoAction) {{($infoAction->libelle) ? $infoAction->libelle : 'pas action'}} : {{($infoAction->deadline) ? $infoAction->deadline : ''}} @endforeach">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                        <a href="{{ route('detail_op',$opportunites->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunites->libelle, 25, $end='...') }}</h4>
                            </button>
                          </div></a>
                        <!--</div>-->
                    </td>
                     @if($prospect)
                    <td class="px-4 py-3 text-sm">
                     <!--{{ ($prospect->nom_entreprise) ? $prospect->nom_entreprise : ''}}-->
                      {{ strtoupper(($prospect->nom_entreprise) ? $prospect->nom_entreprise : '')}}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        
                        {{(number_format($opportunites->objectif_de_vente)) ? number_format($opportunites->objectif_de_vente) : '0'}} f
                      </span>
                    </td>
                    
                     <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        
                        {{$opportunites->probabilite ? $opportunites->probabilite : '00'}} %
                      </span>
                    </td>
                    @php $statut = DB::table('statut_opportunites')->where('id', $opportunites->statut)->first(); @endphp
                    @if($statut)
                    <td class="px-4 py-3 text-sm">
                      <button style="font-size:10px;"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                          {{($statut->libelle) ? $statut->libelle : ''}}
                    </button>
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    <td class="px-4 py-3 text-sm">
                     
                     {{date('d-m-Y', strtotime($opportunites->updated_at))}}
                      
                    </td>
                    
                    <td class="px-4 py-3 text-sm">
                        <div class="row">
                            <div class="col-12 col-s-12" style="display:flex;">
                      <!--  <form action="{{route('archiver.opportunite', $opportunites->id)}}" method="post" id="target" class="form">-->
                 <span  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Mettre à jour le statut">
                      <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('mettre_a_jour_statut.edit', $opportunites->id)}}" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                          <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                          <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                        </svg>
                        </a>
                    </span>
                   
                   <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Update l'action de l'opportunité">
                      <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('opportunite_prospectCreate', $opportunites->id)}}" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-plus" viewBox="0 0 16 16">
                          <path d="M8.5 6a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V10a.5.5 0 0 0 1 0V8.5H10a.5.5 0 0 0 0-1H8.5V6z"/>
                          <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                        </svg>
                        </a>
                    </span>
                  
                        
                        <div class="dropdown">
                          <button class="dropbtn px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                             <b>...</b> 
                            </button>
                          <div class="dropdown-content">
                          <a href="{{ route('detail_op',$opportunites->id) }}">Voir détails</a>
                          <a href="{{route('op.edit', $opportunites->id)}}">Modifier l'opportunité</a>
                          <a href="{{ route('historiques_op.voir',$opportunites->id) }}">Voir l'historique des statuts</a>
                          <a href="{{route('opportunite_VenteCreate', $opportunites->id)}}">Clôturer </a>
                          <a href="{{route('toutes_lesactions.voir', $opportunites->id)}}">Voir les actions</a>
                          <a href="{{route('opportunite_ajoutUpdate', $opportunites->id)}}">Ajouter des updates </a>
                          <a href="{{route('opportunite_ajoutDemo', $opportunites->id)}}">Ajouter une démo </a>
                          </div>
                        </div>
                      </div>
                       </div>
                    </td>
                 </tr>
                 @endif
                 @endif
                  @endforeach
                </tbody>
              </table>
            </div>
           {{$opportunite->links()}}
            @endif
             </div>
             </div>
             </div>
             
             <!-- end 70 - 100% -->
             
             
             
             
               <!-- start 50 - 70 % -->
               
    
          <div class="container" id="50-70">
        
             <div class="container px-6 mx-auto grid">
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="font-size:18px;">
            Opportunités probabilité : 50 - 70 %
          </h2>
             
             <div class="container" >
              
              @if($opportunite->isEmpty()) 
                 	  <p class="dark:text-gray-400">Pas d'opportunité</p>
					 @else
            <div class="container">
              <table >
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Origine</th>-->
                    <th style="width:18%" >Libellé</th>
                    <th style="width:8%" class="px-0 py-1">Entreprises</th>
                    <th style="width:10%" class="px-0 py-1">Objectifs vente</th>
                    <th style="width:10%" class="px-0 py-1">Probabilité</th>
                    <th style="width:10%" class="px-0 py-1">Statut</th>
                    <th style="width:10%" class="px-0 py-1">Date MAJ</th>
                    <th style="width:10%"  class="px-0 py-1">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach($opportunite as $opportunites)
                @php $prospect = DB::table('prospects')->where('id', $opportunites->prospect_id)->first(); 
                    $origine = DB::table('origines')->where('id', $opportunites->origine_id)->first(); 
                    $infoActions = DB::table('action_commerciales')->where('opportunite_id', $opportunites->id)->where('cloture', 0)->orderBy('deadline', 'desc')->paginate(3); 

                @endphp
                @if($opportunites->probabilite >= 50 && $opportunites->probabilite <= 70)
                 @if($opportunites->archiver == 0 )
                  <tr class="text-gray-700 dark:text-gray-400">
                 
                    <td align="left" data-toggle="tooltip" title="{{$opportunites->libelle}} : @foreach($infoActions as $infoAction) {{($infoAction->libelle) ? $infoAction->libelle : 'pas action'}} : {{($infoAction->deadline) ? $infoAction->deadline : ''}} @endforeach">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                        <a href="{{ route('detail_op',$opportunites->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunites->libelle, 25, $end='...') }}</h4>
                            </button>
                          </div></a>
                        <!--</div>-->
                    </td>
                     @if($prospect)
                    <td class="px-4 py-3 text-sm">
                     <!--{{ ($prospect->nom_entreprise) ? $prospect->nom_entreprise : ''}}-->
                      {{ strtoupper(($prospect->nom_entreprise) ? $prospect->nom_entreprise : '')}}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        
                        {{(number_format($opportunites->objectif_de_vente)) ? number_format($opportunites->objectif_de_vente) : '0'}} f
                      </span>
                    </td>
                    
                     <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        
                        {{$opportunites->probabilite ? $opportunites->probabilite : '00'}} %
                      </span>
                    </td>
                    @php $statut = DB::table('statut_opportunites')->where('id', $opportunites->statut)->first(); @endphp
                    @if($statut)
                    <td class="px-4 py-3 text-sm">
                      <button style="font-size:10px;"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                          {{($statut->libelle) ? $statut->libelle : ''}}
                    </button>
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    <td class="px-4 py-3 text-sm">
                     
                     {{date('d-m-Y', strtotime($opportunites->updated_at))}}
                      
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <div class="row">
                            <div class="col-12 col-s-12" style="display:flex;">
                      <!--  <form action="{{route('archiver.opportunite', $opportunites->id)}}" method="post" id="target" class="form">-->
                 <span  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Mettre à jour le statut">
                      <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('mettre_a_jour_statut.edit', $opportunites->id)}}" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                          <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                          <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                        </svg>
                        </a>
                    </span>
                   
                   <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Ajouter une action">
                      <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('opportunite_prospectCreate', $opportunites->id)}}" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-plus" viewBox="0 0 16 16">
                          <path d="M8.5 6a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V10a.5.5 0 0 0 1 0V8.5H10a.5.5 0 0 0 0-1H8.5V6z"/>
                          <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                        </svg>
                        </a>
                    </span>
                  
                        
                        <div class="dropdown">
                          <button class="dropbtn px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                             <b>...</b> 
                            </button>
                          <div class="dropdown-content">
                          <a href="{{ route('detail_op',$opportunites->id) }}">Voir détails</a>
                          <a href="{{route('op.edit', $opportunites->id)}}">Modifier l'opportunité</a>
                          <a href="{{ route('historiques_op.voir',$opportunites->id) }}">Voir l'historique des statuts</a>
                          <a href="{{route('opportunite_VenteCreate', $opportunites->id)}}">Clôturer </a>
                          <a href="{{route('toutes_lesactions.voir', $opportunites->id)}}">Voir les actions</a>
                          <a href="{{route('opportunite_ajoutUpdate', $opportunites->id)}}">Ajouter des updates </a>
                          <a href="{{route('opportunite_ajoutDemo', $opportunites->id)}}">Ajouter une démo </a>
                          </div>
                        </div>
                      </div>
                       </div>
                    </td>
                 </tr>
                 @endif
                 @endif
                  @endforeach
                </tbody>
              </table>
            </div>
           {{$opportunite->links()}}
            @endif
             </div>
             </div>
             </div>
             
             <!-- end 50 - 70% -->
            
         
      
            <!----------------------------------------------Opportunites backup--------------------------------------------------------------------------->
          <br><br><br><br>
          <div class="container">
          @if($opportunite_backup->isEmpty()) 
                 	  <p class="dark:text-gray-400">Pas d'opportunité en backup</p>
					 @else
             <div class="container px-6 mx-auto grid">
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="font-size:18px;">
            Opportunités en backup
          </h2>
             <div class="container">
                 <div class="row">
                            <div class="col-12 col-s-12">
              <table>
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Origine</th>-->
                    <th style="width:18%" align="left">Libellé</th>
                    <th style="width:8%" class="px-0 py-1">Entreprises</th>
                    <th style="width:10%" class="px-0 py-1">Objectifs vente</th>
                    <th style="width:10%" class="px-0 py-1">Probabilité</th>
                    <th style="width:10%" class="px-0 py-1">Statut</th>
                    <th style="width:10%"  class="px-0 py-1">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach($opportunite_backup as $opportunite_backups)
                @php $prospect = DB::table('prospects')->where('id', $opportunite_backups->prospect_id)->first(); 
                    $origine = DB::table('origines')->where('id', $opportunite_backups->origine_id)->first(); 
                    $infoActionbs = DB::table('action_commerciales')->where('opportunite_id', $opportunite_backups->id)->where('cloture', 0)->orderBy('deadline', 'desc')->paginate(3); 

                @endphp
                 @if($opportunite_backups->archiver == 0 )
                  <tr class="text-gray-700 dark:text-gray-400">
                    <!--  @if($origine)-->
                    <!--<td class="px-4 py-3 text-xs">-->
                    <!--  <span class="px-3 py-1 text-sm ">-->
                    <!--    {{($origine->libelle) ? $origine->libelle : ''}}-->
                    <!--  </span>-->
                    <!--</td>-->
                    <!--@else-->
                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--  --->
                    <!--</td>-->
                    <!--@endif-->
                    <td align="left" data-toggle="tooltip" title="Voir les détails : {{$opportunite_backups->libelle}} : @foreach($infoActionbs as $infoActionb) {{($infoActionb->libelle) ? $infoActionb->libelle : 'pas action'}} : {{($infoActionb->deadline) ? $infoActionb->deadline : ''}} @endforeach">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                        <a href="{{ route('detail_op',$opportunite_backups->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunite_backups->libelle, 25, $end='...') }}</h4>
                            </button>
                          </div></a>
                        <!--</div>-->
                    </td>
                     @if($prospect)
                    <td class="px-4 py-3 text-sm">
                     <!--{{ ($prospect->nom_entreprise) ? $prospect->nom_entreprise : ''}}-->
                      {{ strtoupper(($prospect->nom_entreprise) ? $prospect->nom_entreprise : '')}}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        
                        {{(number_format($opportunite_backups->objectif_de_vente)) ? number_format($opportunite_backups->objectif_de_vente) : '0'}} Fcfa
                      </span>
                    </td>
                    
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        
                        {{$opportunite_backups->probabilite ? $opportunite_backups->probabilite : '00'}} %
                      </span>
                      
                    @php $statut = DB::table('statut_opportunites')->where('id', $opportunite_backups->statut)->first(); @endphp
                    @if($statut)
                    <td class="px-4 py-3 text-sm">
                      <button style="font-size:10px;"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                          {{($statut->libelle) ? $statut->libelle : ''}}
                    </button>
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    
                       
                     <td class="px-4 py-3 text-sm">
                      <div class="row">
                            <div class="col-12 col-s-12" style="display:flex;">
                 <span  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Mettre à jour le statut">
                      <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('mettre_a_jour_statut.edit', $opportunite_backups->id)}}" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                          <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                          <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                        </svg>
                        </a>
                    </span>
                  
                   <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Ajouter une action">
                      <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('opportunite_prospectCreate', $opportunite_backups->id)}}" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-plus" viewBox="0 0 16 16">
                          <path d="M8.5 6a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V10a.5.5 0 0 0 1 0V8.5H10a.5.5 0 0 0 0-1H8.5V6z"/>
                          <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                        </svg>
                        </a>
                    </span>
                
                        
                        <div class="dropdown">
                          <button class="dropbtn px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                             <b>...</b> 
                            </button>
                          <div class="dropdown-content">
                         <a href="{{ route('detail_op',$opportunite_backups->id) }}">Voir détails</a>
                          <a href="{{route('op.edit', $opportunite_backups->id)}}">Modifier l'opportunité</a>
                          <a href="{{ route('historiques_op.voir',$opportunite_backups->id) }}">Voir l'historique des statuts</a>
                          <!--<a href="{{route('opportunite_VenteCreate', $opportunite_backups->id)}}">Clôturer </a>-->
                          <a href="{{route('toutes_lesactions.voir', $opportunite_backups->id)}}">Voir les actions</a>
                          <a href="{{route('opportunite_ajoutUpdate', $opportunite_backups->id)}}">Ajouter des updates </a>
                          <a href="{{route('opportunite_ajoutDemo', $opportunite_backups->id)}}">Ajouter une démo </a>
                          </div>
                        </div>
                      
                     
                         </div>
                    </div> 
                    
                    </td>
                    
                 </tr>
                 @endif
                  @endforeach
                </tbody>
              </table>
              </div>
              </div>
            </div>
            {{$opportunite_backup->links()}}
            @endif
            </div>
            </div>
         <!------------------------------------------------------------end----------------------------------->
         
</div></div>
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
  
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <script>
            $("#70-100").hide();
            $("#50-70").hide();
            </script>
             <script>
            $(document).ready(function(){
              $("select").change(function(){
                    $( "select option:selected").each(function(){
                        //enter bengal districts
                        if($(this).attr("value")=="1001"){
                            $("#tout").hide();
                            $("#50-70").hide();
                            $("#70-100").show();
                        }
                        if($(this).attr("value")=="1002"){
                            $("#50-70").show();
                            $("#70-100").hide();
                            $("#tout").hide();
                        }
                        if($(this).attr("value")=="1003"){
                            $("#70-100").hide();
                            $("#tout").show();
                            $("#50-70").hide();
                        }
                        //enter other states
                       
                    });
                });  
            }); 

                </script>
  <style>
  .pagination {
    list-style: none;
    margin: 0;
    display: flex;
    padding-left: 1500%;
}
        
.pagination li {
    margin: 0 1px;
    font-size: 17px;
}
 
 </style> 
 
   <style>


.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  margin-left: -50px;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #9045e2}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #0093a2;
}
</style>
</body>


</html>