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

        <!--les formulaires-->
        <div class="container px-6 mx-auto grid">
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="font-size:18px;">
            Toutes les opportunités en cours
          </h2>
                   <div class="row" style="display-flex"> 
                    <a href="/opportunite_gagner_maTeam">
                    <button style="width:178px"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                         Opportunités gagnées
                    </button> </a> 
                    
                    <a href="/opportunite_perdu_maTeam">
                    <button style="width:175px"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                         Opportunités perdues
                    </button> </a> 
                    
                    <a href="/opportunite_abandonner_maTeam">
                    <button style="width:220px"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                         Opportunités abandonnées
                    </button> </a>
                    
                    <a href="/opportunite_archiver_maTeam">
                    <button style="width:200px"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                         Opportunités en stand-by
                    </button> </a> 
                    
                    
                    
                     <!--<div style = "margin-left:420px;margin-top:-50px;" > -->
                     <!--            <form action="{{route('op_maTeamFiltre')}}" method="get" style="margsearchfin-top:5px; display:flex;">-->
                                    
                     <!--             <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-left:10px;" type="submit">Filtrer</button>-->
                     <!--           </form> -->
                     <!--       </div> -->
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
           <!--  <h6> 
              @if (session('messageBravo'))
                  <div class="alert" role="alert">
                     
                    <img src="{{URL::asset('Koyalis/gif/'. session('messageBravo'))}}" width="100px;">
                    <br>
                  </div>  
              @endif
            </h6>-->
            
            <h6> 
              @if (session('msBra'))
                  <div class="alert" role="alert">
                     
                    <div class="alert alert-succes" role="alert">
                      <b style="color:green;">{{ session('msBra') }}</b>
                  </div>  
                  </div>  
              @endif
            </h6>
            
        <br>
        
        <h6> 
              @if (session('msAten'))
                  <div class="alert" role="alert">
                     
                    <div class="alert alert-succes" role="alert">
                      <b style="color:red;">{{ session('msAten') }}</b>
                  </div>  
                  </div>  
              @endif
            </h6>
            
        <br>
             <h6> 
              @if (session('messageAttention'))
                  <div class="alert alert-danger" role="alert">
                      {{ session('messageAttention') }}
                  </div>  
              @endif
            </h6>
            <h6> 
              @if (session('fini'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('fini') }}
                  </div>  
              @endif
            </h6>
            <h6> 
              @if (session('archive'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('archive') }}
                  </div>  
              @endif
            </h6>
            
                      
                            <br>
                            <div class="container px-6 mx-auto grid" >
                            
                                         <div class="col-md-3" style="width:100px; margin-right:100px;margin-top:-50px;">
                                           
                                           <select name="search_a" style="width:200px;" class="form-select" aria-label="Default select example">
                                              
                                               <option value="">Filtrer par probabilité</option>
                                              
                                               <option value="1000">Probabilité de 70 à 100%</option>
                                               <option value="1001">Probabilité de 50 à 70%</option>
                                               <option value="1002" >Toutes les opportunités</option>
                                             
                                           </select>
                                        </div> 
                            
                            <div style = " margin-left:210px;margin-top:-50px" > 
                            
                                 <form action="{{route('search_statut_maTeam')}}" method="get" style="margsearchfin-top:5px; display:flex;">
                                     <p style = " margin-top:10px;">Rechercher</p>
                                    <select name="serachCom" style="width:160px;height:40px; margin-left:10px;"  id="statut" style="display:flex;">
                                        <option value="" disabled selected>Par Commercial(e)</option>
                                         @php 
                                         
                                        $comMeConnect = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                                        $commerciauxs = DB::table('commerciaus')->pluck('id')->toArray();
                                        $entreprisess = DB::table('opportunites')->where('archiver', 0)->pluck('commercial_id')->toArray();
                                        
                                        $result_comerP = array_diff($commerciauxs, $entreprisess);
                                        $result_comersss = array_diff($commerciauxs, $result_comerP);
                                        
                                        @endphp
                                        
                                        @foreach($result_comersss as $result_comer)
                                        @php $commerciales = DB::table('commerciaus')->where('id', $result_comer)->OrderBy('prenom')->first();  @endphp
                                        <option value="{{$commerciales->id}}">{{$commerciales->prenom}} {{$commerciales->nom}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                    <select name="serachpays" style="width:90px;height:40px; margin-left:10px;"  id="statut" >
                                        <option value="" disabled selected>Par pays</option>
                                         @php 
                                        $pays = DB::table('pays')->pluck('id')->toArray();
                                        $entreprisess = DB::table('opportunites')->where('archiver', 0)->pluck('pays_id')->toArray();
                                        
                                        $result_comerPays = array_diff($pays, $entreprisess);
                                        $result_comerssspays = array_diff($pays, $result_comerPays);
                                        
                                        @endphp
                                        
                                        @foreach($result_comerssspays as $result_comerpays)
                                        @php $payss = DB::table('pays')->where('id', $result_comerpays)->OrderBy('libelle')->first();  @endphp
                                        <option value="{{$payss->id}}">{{$payss->libelle}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                    <select name="search" style="width:100px;height:40px; margin-left:10px;"  id="statut" style="margin-left:10px; display:flex;">
                                        <option value="" disabled selected>Par statut</option>
                                      
                                        @php $staut = DB::table('statut_opportunites')->OrderBy('libelle')->get();  @endphp
                                        @foreach($staut as $stauts)
                                        <option value="{{$stauts->id}}">{{$stauts->libelle}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                      
                                
                                    <select name="searchOr" style="width:100px;height:40px; margin-left:20px;"  id="origine">
                                        <option value="" disabled selected>Par Origine</option>
                                      
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
                 	  <p>Pas d'opportunité</p>
					 @else
            <div class="container">
              <table >
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th style="width:10%" class="px-0 py-1">Commerciaux</th>
                    <th style="width:20%" align="left">Libellé</th>
                    <!--<th style="width:8%" class="px-0 py-1">Entreprises</th>-->
                    <th style="width:10%" class="px-0 py-1">Objectifs vente</th>
                    <th style="width:6%" class="px-0 py-1">Probabilité</th>
                    <th style="width:10%" class="px-0 py-1">Statut</th>
                    <th style="width:10%" class="px-0 py-1">Date MAJ</th>
                    <th style="width:10%"  class="px-0 py-1">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @if($comMeConnect->domaine_id == 1)
                    @foreach($opportunite as $opportunites)
                @php $prospect = DB::table('prospects')->where('id', $opportunites->prospect_id)->first(); 
                    $origine = DB::table('origines')->where('id', $opportunites->origine_id)->first(); 
                    $com = DB::table('commerciaus')->where('id', $opportunites->commercial_id)->first();
                    $comDomainePays = DB::table('commerciaus')
                                ->where('id', $opportunites->commercial_id)
                                ->where('domaine_id', $comMeConnect->domaine_id)
                                ->where('pays_id', $comMeConnect->pays_id)
                                ->first();
                    $infoActions = DB::table('action_commerciales')->where('opportunite_id', $opportunites->id)->where('cloture', 0)->orderBy('deadline', 'desc')->paginate(3); 

                @endphp
                 @if($opportunites->archiver == 0 )
                 @if($comDomainePays)
                  <tr class="text-gray-700 dark:text-gray-400">
                   <td class="px-1 py-3 text-sm">
                      @if($comDomainePays){{ ($comDomainePays->prenom) ? $comDomainePays->prenom : ''}} {{ ($comDomainePays->nom) ? $comDomainePays->nom : ''}}@else - @endif
                    </td>
                     <td align="left" data-toggle="tooltip" title="{{$opportunites->libelle}} : @foreach($infoActions as $infoAction) {{($infoAction->libelle) ? $infoAction->libelle : 'pas action'}} : {{($infoAction->deadline) ? $infoAction->deadline : ''}} @endforeach">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                        <a href="{{ route('detail_op',$opportunites->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunites->libelle, 30, $end='...') }}</h4>
                            </button>
                             <br>
                     @if($prospect)
                     <!--{{ ($prospect->nom_entreprise) ? $prospect->nom_entreprise : ''}}-->
                      &nbsp;<b style="color:#9045e2">({{ strtoupper(($prospect->nom_entreprise) ? $prospect->nom_entreprise : '')}})</b>
                    @else
                      -
                    @endif
                          </div></a>
                        <!--</div>-->
                  
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
                    <td class="px-4 py-3 text-sm">
                    
                        <div class="dropdown">
                          <button class="dropbtn px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                             <b>...</b> 
                            </button>
                          <div class="dropdown-content">
                          <a href="{{ route('detail_op',$opportunites->id) }}">Voir détails</a>
                          <a href="{{ route('mettre_a_jour_statut.edit', $opportunites->id) }}">Mettre à jour statut</a>
                          <a href="{{ route('toutes_lesactions.voir',$opportunites->id) }}">Les actions</a>
                         <a href="{{route('op.edit', $opportunites->id)}}">Modifier l'opportunité</a>
                          <a href="{{ route('historiques_op.voir',$opportunites->id) }}">Voir l'historique des statuts</a>
                          <a href="{{route('opportunite_prospectCreate', $opportunites->id)}}">Ajouter une action </a>
                          <a href="{{route('opportunite_VenteCreate', $opportunites->id)}}">Clôturer </a>
                          </div>
                        </div>
                      
                  
                          
                    
                    </td>
                 </tr>
                 @endif
                 @endif
                  @endforeach
                  
                   @elseif($comMeConnect->domaine_id == 2 && $comMeConnect->nom_role == "responsable")
                    @foreach($opportunite as $opportunites)
                @php $prospect = DB::table('prospects')->where('id', $opportunites->prospect_id)->first(); 
                    $origine = DB::table('origines')->where('id', $opportunites->origine_id)->first(); 
                    $com = DB::table('commerciaus')->where('id', $opportunites->commercial_id)->first();
                    $comDomainePaysres = DB::table('commerciaus')
                                ->where('id', $opportunites->commercial_id)
                                ->where('pays_id', $comMeConnect->pays_id)
                                ->first();
                    $infoActions = DB::table('action_commerciales')->where('opportunite_id', $opportunites->id)->where('cloture', 0)->orderBy('deadline', 'desc')->paginate(3); 

                @endphp
                 @if($opportunites->archiver == 0 )
                 @if($comDomainePaysres)
                  <tr class="text-gray-700 dark:text-gray-400">
                   <td class="px-1 py-3 text-sm">
                      @if($comDomainePaysres){{ ($comDomainePaysres->prenom) ? $comDomainePaysres->prenom : ''}} {{ ($comDomainePaysres->nom) ? $comDomainePaysres->nom : ''}}@else - @endif
                    </td>
                     <td align="left" data-toggle="tooltip" title="{{$opportunites->libelle}} : @foreach($infoActions as $infoAction) {{($infoAction->libelle) ? $infoAction->libelle : 'pas action'}} : {{($infoAction->deadline) ? $infoAction->deadline : ''}} @endforeach">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                        <a href="{{ route('detail_op',$opportunites->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunites->libelle, 30, $end='...') }}</h4>
                            </button>
                             <br>
                     @if($prospect)
                     <!--{{ ($prospect->nom_entreprise) ? $prospect->nom_entreprise : ''}}-->
                      &nbsp;<b style="color:#9045e2">({{ strtoupper(($prospect->nom_entreprise) ? $prospect->nom_entreprise : '')}})</b>
                    @else
                      -
                    @endif
                          </div></a>
                        <!--</div>-->
                  
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
                    <td class="px-4 py-3 text-sm">
                    
                        <div class="dropdown">
                          <button class="dropbtn px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                             <b>...</b> 
                            </button>
                          <div class="dropdown-content">
                          <a href="{{ route('detail_op',$opportunites->id) }}">Voir détails</a>
                          <a href="{{ route('mettre_a_jour_statut.edit', $opportunites->id) }}">Mettre à jour statut</a>
                          <a href="{{ route('toutes_lesactions.voir',$opportunites->id) }}">Les actions</a>
                         <a href="{{route('op.edit', $opportunites->id)}}">Modifier l'opportunité</a>
                          <a href="{{ route('historiques_op.voir',$opportunites->id) }}">Voir l'historique des statuts</a>
                          <a href="{{route('opportunite_prospectCreate', $opportunites->id)}}">Ajouter une action </a>
                          <a href="{{route('opportunite_VenteCreate', $opportunites->id)}}">Clôturer </a>
                          </div>
                        </div>
                      
                  
                          
                    
                    </td>
                 </tr>
                 @endif
                 @endif
                  @endforeach
                  
                  @else
                      @foreach($opportunite as $opportunites)
                @php $prospect = DB::table('prospects')->where('id', $opportunites->prospect_id)->first(); 
                    $origine = DB::table('origines')->where('id', $opportunites->origine_id)->first(); 
                    $com = DB::table('commerciaus')->where('id', $opportunites->commercial_id)->first();
                    $infoActions = DB::table('action_commerciales')->where('opportunite_id', $opportunites->id)->where('cloture', 0)->orderBy('deadline', 'desc')->paginate(3); 

                @endphp
                 @if($opportunites->archiver == 0 )
                 @if($com)
                  <tr class="text-gray-700 dark:text-gray-400">
                   <td class="px-1 py-3 text-sm">
                      @if($com){{ ($com->prenom) ? $com->prenom : ''}} {{ ($com->nom) ? $com->nom : ''}}@else - @endif
                    </td>
                     <td align="left" data-toggle="tooltip" title="{{$opportunites->libelle}} : @foreach($infoActions as $infoAction) {{($infoAction->libelle) ? $infoAction->libelle : 'pas action'}} : {{($infoAction->deadline) ? $infoAction->deadline : ''}} @endforeach">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                        <a href="{{ route('detail_op',$opportunites->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunites->libelle, 30, $end='...') }}</h4>
                            </button>
                             <br>
                     @if($prospect)
                     <!--{{ ($prospect->nom_entreprise) ? $prospect->nom_entreprise : ''}}-->
                      &nbsp;<b style="color:#9045e2">({{ strtoupper(($prospect->nom_entreprise) ? $prospect->nom_entreprise : '')}})</b>
                    @else
                      -
                    @endif
                          </div></a>
                        <!--</div>-->
                  
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
                    <td class="px-4 py-3 text-sm">
                    
                        <div class="dropdown">
                          <button class="dropbtn px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                             <b>...</b> 
                            </button>
                          <div class="dropdown-content">
                          <a href="{{ route('detail_op',$opportunites->id) }}">Voir détails</a>
                          <a href="{{ route('mettre_a_jour_statut.edit', $opportunites->id) }}">Mettre à jour statut</a>
                          <a href="{{ route('toutes_lesactions.voir',$opportunites->id) }}">Les actions</a>
                         <a href="{{route('op.edit', $opportunites->id)}}">Modifier l'opportunité</a>
                          <a href="{{ route('historiques_op.voir',$opportunites->id) }}">Voir l'historique des statuts</a>
                          <a href="{{route('opportunite_prospectCreate', $opportunites->id)}}">Ajouter une action </a>
                          <a href="{{route('opportunite_VenteCreate', $opportunites->id)}}">Clôturer </a>
                          </div>
                        </div>
                      
                  
                          
                    
                    </td>
                 </tr>
                 @endif
                 @endif
                  @endforeach
                  @endif
                </tbody>
              </table>
            </div>
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
                 	  <p>Pas d'opportunité</p>
					 @else
            <div class="container">
              <table >
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th style="width:10%" class="px-0 py-1">Commerciaux</th>
                    <th style="width:20%" align="left">Libellé</th>
                    <!--<th style="width:8%" class="px-0 py-1">Entreprises</th>-->
                    <th style="width:10%" class="px-0 py-1">Objectifs vente</th>
                    <th style="width:6%" class="px-0 py-1">Probabilité</th>
                    <th style="width:10%" class="px-0 py-1">Statut</th>
                    <th style="width:10%" class="px-0 py-1">Date MAJ</th>
                    <th style="width:10%"  class="px-0 py-1">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    
                    @foreach($opportunite as $opportunites)
                        @php $prospect = DB::table('prospects')->where('id', $opportunites->prospect_id)->first(); 
                            $origine = DB::table('origines')->where('id', $opportunites->origine_id)->first(); 
                             $come = DB::table('commerciaus')->where('id', $opportunites->commercial_id)->first();
                        @endphp
                @if($opportunites->probabilite >= 70)
                @if($opportunites->archiver == 0 )
                @if($come)
                  <tr class="text-gray-700 dark:text-gray-400">
                   <td class="px-1 py-3 text-sm">
                      @if($come){{ ($come->prenom) ? $come->prenom : ''}} {{ ($come->nom) ? $come->nom : ''}}@else - @endif
                    </td>
                     <td align="left" data-toggle="tooltip" title="{{$opportunites->libelle}}">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                        <a href="{{ route('detail_op',$opportunites->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunites->libelle, 30, $end='...') }}</h4>
                            </button>
                             <br>
                     @if($prospect)
                     <!--{{ ($prospect->nom_entreprise) ? $prospect->nom_entreprise : ''}}-->
                      &nbsp;<b style="color:#9045e2">({{ strtoupper(($prospect->nom_entreprise) ? $prospect->nom_entreprise : '')}})</b>
                    @else
                      -
                    @endif
                          </div></a>
                        <!--</div>-->
                   
                    
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
                    <td class="px-4 py-3 text-sm">
                    
                        
                        <div class="dropdown">
                          <button class="dropbtn px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                             <b>...</b> 
                            </button>
                          <div class="dropdown-content">
                          <a href="{{ route('detail_op',$opportunites->id) }}">Voir détails</a>
                          <!--<a href="{{route('op.edit', $opportunites->id)}}">Modifier l'opportunité</a>-->
                          <a href="{{ route('historiques_op.voir',$opportunites->id) }}">Voir l'historique des statuts</a>
                          <a href="{{route('opportunite_prospectCreate', $opportunites->id)}}">Ajouter une action </a>
                          <!--<a href="{{route('opportunite_VenteCreate', $opportunites->id)}}">Clôturer </a>-->
                          </div>
                        </div>
                      
                     
                          
                    
                    </td>
                 </tr>
                 @endif
                 @endif
                 @endif
                  @endforeach
                </tbody>
              </table>
            </div>
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
                 	  <p>Pas d'opportunité</p>
					 @else
            <div class="container">
              <table >
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                  <th style="width:10%" class="px-0 py-1">Commerciaux</th>
                    <th style="width:20%" align="left">Libellé</th>
                    <!--<th style="width:8%" class="px-0 py-1">Entreprises</th>-->
                    <th style="width:10%" class="px-0 py-1">Objectifs vente</th>
                    <th style="width:6%" class="px-0 py-1">Probabilité</th>
                    <th style="width:10%" class="px-0 py-1">Statut</th>
                    <th style="width:10%" class="px-0 py-1">Date MAJ</th>
                    <th style="width:10%"  class="px-0 py-1">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach($opportunite as $opportunites)
                @php $prospect = DB::table('prospects')->where('id', $opportunites->prospect_id)->first(); 
                 $comer = DB::table('commerciaus')->where('id', $opportunites->commercial_id)->first();
                    $origine = DB::table('origines')->where('id', $opportunites->origine_id)->first(); 
                @endphp
                @if($opportunites->probabilite >= 50 && $opportunites->probabilite <= 70)
                @if($opportunites->archiver == 0 )
                @if($comer)
                  <tr class="text-gray-700 dark:text-gray-400">
                   <td class="px-1 py-3 text-sm">
                      @if($comer){{ ($comer->prenom) ? $comer->prenom : ''}} {{ ($comer->nom) ? $comer->nom : ''}}@else - @endif
                    </td>
                    <td align="left" data-toggle="tooltip" title="{{$opportunites->libelle}}">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                        <a href="{{ route('detail_op',$opportunites->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunites->libelle, 30, $end='...') }}</h4>
                            </button>
                             <br>
                     @if($prospect)
                     <!--{{ ($prospect->nom_entreprise) ? $prospect->nom_entreprise : ''}}-->
                      &nbsp;<b style="color:#9045e2">({{ strtoupper(($prospect->nom_entreprise) ? $prospect->nom_entreprise : '')}})</b>
                    @else
                      -
                    @endif
                          </div></a>
                        <!--</div>-->
                   
                     
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
                    <td class="px-4 py-3 text-sm">
                   
                        
                        <div class="dropdown">
                          <button class="dropbtn px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                             <b>...</b> 
                            </button>
                          <div class="dropdown-content">
                          <a href="{{ route('detail_op',$opportunites->id) }}">Voir détails</a>
                          <!--<a href="{{route('op.edit', $opportunites->id)}}">Modifier l'opportunité</a>-->
                          <a href="{{ route('historiques_op.voir',$opportunites->id) }}">Voir l'historique des statuts</a>
                          <a href="{{route('opportunite_prospectCreate', $opportunites->id)}}">Ajouter une action </a>
                          <!--<a href="{{route('opportunite_VenteCreate', $opportunites->id)}}">Clôturer </a>-->
                          </div>
                        </div>
                      
                     
                    
                    </td>
                 </tr>
                 @endif
                 @endif
                 @endif
                  @endforeach
                </tbody>
              </table>
            </div>
            @endif
             </div>
             </div>
             </div>
             
             <!-- end 50 - 70% -->
            
         
      
           
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
                        if($(this).attr("value")=="1000"){
                            $("#tout").hide();
                            $("#50-70").hide();
                            $("#70-100").show();
                        }
                        if($(this).attr("value")=="1001"){
                            $("#50-70").show();
                            $("#70-100").hide();
                            $("#tout").hide();
                        }
                        if($(this).attr("value")=="1002"){
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