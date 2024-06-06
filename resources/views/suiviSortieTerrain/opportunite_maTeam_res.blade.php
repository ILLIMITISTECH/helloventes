
      <!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hello Ventes</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('Koyalis/public/assets/css/tailwind.output.css')}}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
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
     
<main>
<div class="row">
        <div class="col-12 col-s-12">
        <!--les formulaires-->
        <div class="container px-6 mx-auto grid">
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="font-size:18px;">
            Les opportunités 
          </h2>
                  <div class="row" style="display-flex"> 
                    <a href="/opportunite_gagner_maTeam_res">
                    <button style="width:178px"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                         Opportunités gagnées
                    </button> </a> 
                    
                    <a href="/opportunite_perdu_maTeam_res">
                    <button style="width:175px"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                         Opportunités perdues
                    </button> </a> 
                    
                    <a href="/opportunite_abandonner_maTeam_res">
                    <button style="width:220px"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                         Opportunités abandonnées
                    </button> </a>
                    
                    <a href="/opportunite_archiver_maTeam_res">
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
    @if(Auth::user()->nom_role == "responsable") 
                    <!--        <div style = "margin-left: 650px; margin-top:-50px" > -->
                    <!--             <form action="{{route('op_maTeamFiltreRes')}}" method="get" style="margsearchfin-top:5px; display:flex;">-->
                                    
                    <!--              <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-left:10px;" type="submit">Filtrer</button>-->
                    <!--            </form> -->
                    <!--        </div> -->
                   
                    
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
            
                        @if($opportunite->isEmpty()) 
                 	    <p></p>
					    @else
                            <br>
                            <div class="container px-6 mx-auto grid" >
           
                                         <div class="col-md-3" style="margin-right:-30px;margin-top:-50px;">
                                           
                                           <select name="search_a" class="form-select" aria-label="Default select example">
                                              
                                               <option value="">Filtrer par probabilité</option>
                                              
                                               <option value="1000">Probabilité de 70 à 100%</option>
                                               <option value="1001">Probabilité de 50 à 70%</option>
                                               <option value="1002" >Toutes les opportunités</option>
                                             
                                           </select>
                                        </div> 
                            <div style = "margin-left: 350px; margin-top:-50px" > 
                            
                                 <form action="{{route('search_statut_maTeam_res')}}" method="get" style="margsearchfin-top:5px; display:flex;">
                                     <p style = " margin-top:10px;">Rechercher</p>
                                     <select name="serachCom" style="width:160px;height:40px"  id="statut" style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Par Commercial(e)</option>
                                        @php 
                                        $moi = App\Commerciau::where('user_id', Auth::user()->id)->first();
                                        $commerciauxs = DB::table('commerciaus')->where('superieur_id', $moi->id)->pluck('id')->toArray();
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
                                    
                                    <select name="search" style="width:100px;height:40px; margin-left:10px;"  id="statut" style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Par statut</option>
                                      
                                        @php $staut = DB::table('statut_opportunites')->OrderBy('libelle')->get();  @endphp
                                        @foreach($staut as $stauts)
                                        <option value="{{$stauts->id}}">{{$stauts->libelle}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                      
                                
                                    <select name="searchOr" style="width:100px;height:40px; margin-left:10px;"  id="origine">
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
                        @endif
        <div class="row">
		<div class="col-12 col-s-12">
           <div class="container" id="tout">
              
              @if($opportunite->isEmpty()) 
                 	  <p>Pas d'opportunité</p>
					 @else
	
    <div class="container">
        <div class="row">
            <div class="col-12 col-s-12">
              <table class="table" id="table">
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
                    $com = DB::table('commerciaus')->where('superieur_id', $commercial->id)->where('id', $opportunites->commercial_id)->first();
                    $infoActions = DB::table('action_commerciales')->where('opportunite_id', $opportunites->id)->where('cloture', 0)->orderBy('deadline', 'desc')->paginate(3);
                @endphp
                 @if($opportunites->archiver == 0 )
                 @if($com)
                  <tr class="text-gray-700 dark:text-gray-400">
                   <td class="px-1 py-3 text-sm">
                      {{ ($com->prenom) ? $com->prenom : ''}} {{ ($com->nom) ? $com->nom : ''}}
                    </td>
                    <td align="left" data-toggle="tooltip" title="{{$opportunites->libelle}} : @foreach($infoActions as $infoAction) {{($infoAction->libelle) ? $infoAction->libelle : 'pas action'}} : {{($infoAction->deadline) ? $infoAction->deadline : ''}} @endforeach">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                        <a href="{{ route('detail_op',$opportunites->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunites->libelle, 25, $end='...') }}</h4>
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
                          <a href="{{route('op.edit', $opportunites->id)}}">Modifier l'opportunité</a>
                          <a href="{{route('opportunite_VenteCreate', $opportunites->id)}}">Clôturer </a>
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
                  @endforeach
                </tbody>
                </div>
            </div>
              </table>
            </div>
            
            @endif
             </div>
           </div>
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
                    $com = DB::table('commerciaus')->where('superieur_id', $commercial->id)->where('id', $opportunites->commercial_id)->first();
                @endphp
                 @if($opportunites->archiver == 0 )
                 @if($com)
                 @if($opportunites->probabilite >= 70)
                  <tr class="text-gray-700 dark:text-gray-400">
                   <td class="px-1 py-3 text-sm">
                      {{ ($com->prenom) ? $com->prenom : ''}} {{ ($com->nom) ? $com->nom : ''}}
                    </td>
                    <td align="left" data-toggle="tooltip" title="{{$opportunites->libelle}}">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                        <a href="{{ route('detail_op',$opportunites->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunites->libelle, 25, $end='...') }}</h4>
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
                      <!--  <form action="{{route('archiver.opportunite', $opportunites->id)}}" method="post" id="target" class="form">-->
                 <!--<span  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Mettre à jour le statut">-->
                 <!--     <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('mettre_a_jour_statut.edit', $opportunites->id)}}" >-->
                 <!--         <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">-->
                 <!--         <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>-->
                 <!--         <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>-->
                 <!--       </svg>-->
                 <!--       </a>-->
                 <!--   </span>-->
                   <!-- <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Modifier l'opportunité">
                      <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('op.edit', $opportunites->id)}}" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                        </a>
                    </span>-->
                   <!--<span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Ajouter une action">-->
                   <!--   <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('opportunite_prospectCreate', $opportunites->id)}}" >-->
                   <!--       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-plus" viewBox="0 0 16 16">-->
                   <!--       <path d="M8.5 6a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V10a.5.5 0 0 0 1 0V8.5H10a.5.5 0 0 0 0-1H8.5V6z"/>-->
                   <!--       <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>-->
                   <!--     </svg>-->
                   <!--     </a>-->
                   <!-- </span>-->
                   <!-- <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Voir l'historique des statuts">
                      <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"  href="{{ route('historiques_op.voir',$opportunites->id) }}" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                          <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                          <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                          <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                        </a>
                    </span>-->
                    
                 
                      <!--  <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Cloturer">
                          <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('opportunite_VenteCreate', $opportunites->id)}}" >
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                      <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                      <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
                    </svg>
                            </a>
                        </span>-->
                        
                        <div class="dropdown">
                          <button class="dropbtn px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                             <b>...</b> 
                            </button>
                          <div class="dropdown-content">
                          <a href="{{ route('detail_op',$opportunites->id) }}">Voir détails</a>
                          <a href="{{route('op.edit', $opportunites->id)}}">Modifier l'opportunité</a>
                          <a href="{{route('opportunite_VenteCreate', $opportunites->id)}}">Clôturer </a>
                          <!--<a href="{{route('op.edit', $opportunites->id)}}">Modifier l'opportunité</a>-->
                          <a href="{{ route('historiques_op.voir',$opportunites->id) }}">Voir l'historique des statuts</a>
                          <a href="{{route('opportunite_prospectCreate', $opportunites->id)}}">Ajouter une action </a>
                          <!--<a href="{{route('opportunite_VenteCreate', $opportunites->id)}}">Clôturer </a>-->
                          </div>
                        </div>
                      
                      <!--  <div class="menu-nav">
                            <div class="menu-item"></div>
                            <div class="dropdown-container" tabindex="-1">
                              <div class="three-dots"></div>
                              <div class="dropdown">
                                  
                                     <a href="{{ route('detail_op',$opportunites->id) }}" id="a">
                                         <div>
                                  Voir details
                                </div></a>
                                <a  id="a" href="{{route('op.edit', $opportunites->id)}}" ><div>
                                  Modifier l'opportunité 
                                </div></a>
                               
                                <a  id="a"  href="{{ route('historiques_op.voir',$opportunites->id) }}" ><div>
                                 Voir l'historique des statuts   
                                </div></a>
                                 <a id="a" href="{{route('opportunite_VenteCreate', $opportunites->id)}}" ><div>
                                  Cloturer  
                                 </div></a>
                              </div>
                            </div>
                          </div>
                           </div>
                          </div>-->
                          
                    
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
                    $origine = DB::table('origines')->where('id', $opportunites->origine_id)->first(); 
                    $com = DB::table('commerciaus')->where('superieur_id', $commercial->id)->where('id', $opportunites->commercial_id)->first();
                @endphp
                 @if($opportunites->archiver == 0 )
                 @if($com)
                 @if($opportunites->probabilite >= 50 && $opportunites->probabilite <= 70)
                  <tr class="text-gray-700 dark:text-gray-400">
                   <td class="px-1 py-3 text-sm">
                      {{ ($com->prenom) ? $com->prenom : ''}} {{ ($com->nom) ? $com->nom : ''}}
                    </td>
                    <td align="left" data-toggle="tooltip" title="{{$opportunites->libelle}}">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                        <a href="{{ route('detail_op',$opportunites->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunites->libelle, 25, $end='...') }}</h4>
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
                      <!--  <form action="{{route('archiver.opportunite', $opportunites->id)}}" method="post" id="target" class="form">-->
                 <!--<span  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Mettre à jour le statut">-->
                 <!--     <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('mettre_a_jour_statut.edit', $opportunites->id)}}" >-->
                 <!--         <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">-->
                 <!--         <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>-->
                 <!--         <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>-->
                 <!--       </svg>-->
                 <!--       </a>-->
                 <!--   </span>-->
                   <!-- <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Modifier l'opportunité">
                      <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('op.edit', $opportunites->id)}}" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                        </a>
                    </span>-->
                   <!--<span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Ajouter une action">-->
                   <!--   <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('opportunite_prospectCreate', $opportunites->id)}}" >-->
                   <!--       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-plus" viewBox="0 0 16 16">-->
                   <!--       <path d="M8.5 6a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V10a.5.5 0 0 0 1 0V8.5H10a.5.5 0 0 0 0-1H8.5V6z"/>-->
                   <!--       <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>-->
                   <!--     </svg>-->
                   <!--     </a>-->
                   <!-- </span>-->
                   <!-- <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Voir l'historique des statuts">
                      <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"  href="{{ route('historiques_op.voir',$opportunites->id) }}" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                          <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                          <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                          <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                        </a>
                    </span>-->
                    
                 
                      <!--  <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Cloturer">
                          <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('opportunite_VenteCreate', $opportunites->id)}}" >
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                      <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                      <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
                    </svg>
                            </a>
                        </span>-->
                        
                        <div class="dropdown">
                          <button class="dropbtn px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                             <b>...</b> 
                            </button>
                          <div class="dropdown-content">
                          <a href="{{ route('detail_op',$opportunites->id) }}">Voir détails</a>
                          <a href="{{route('op.edit', $opportunites->id)}}">Modifier l'opportunité</a>
                          <a href="{{route('opportunite_VenteCreate', $opportunites->id)}}">Clôturer </a>
                          <!--<a href="{{route('op.edit', $opportunites->id)}}">Modifier l'opportunité</a>-->
                          <a href="{{ route('historiques_op.voir',$opportunites->id) }}">Voir l'historique des statuts</a>
                          <a href="{{route('opportunite_prospectCreate', $opportunites->id)}}">Ajouter une action </a>
                          <!--<a href="{{route('opportunite_VenteCreate', $opportunites->id)}}">Clôturer </a>-->
                          </div>
                        </div>
                      
                      <!--  <div class="menu-nav">
                            <div class="menu-item"></div>
                            <div class="dropdown-container" tabindex="-1">
                              <div class="three-dots"></div>
                              <div class="dropdown">
                                  
                                     <a href="{{ route('detail_op',$opportunites->id) }}" id="a">
                                         <div>
                                  Voir details
                                </div></a>
                                <a  id="a" href="{{route('op.edit', $opportunites->id)}}" ><div>
                                  Modifier l'opportunité 
                                </div></a>
                               
                                <a  id="a"  href="{{ route('historiques_op.voir',$opportunites->id) }}" ><div>
                                 Voir l'historique des statuts   
                                </div></a>
                                 <a id="a" href="{{route('opportunite_VenteCreate', $opportunites->id)}}" ><div>
                                  Cloturer  
                                 </div></a>
                              </div>
                            </div>
                          </div>
                           </div>
                          </div>-->
                          
                    
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
      
      <!-----------------------------------------------------------responsable pole------------------------------------------------------------>
       @elseif(Auth::user()->nom_role == "responsable_pole")
      <div style = "margin-left: 650px; margin-top:-50px" > 
                                 <form action="{{route('op_maTeamFiltreRes')}}" method="get" style="margsearchfin-top:5px; display:flex;">
                                    <select name="serachCom" style="width:220px;height:40px"  id="statut" style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par Commercial(e)</option>
                                        @php 
                                        $moi = App\Commerciau::where('user_id', Auth::user()->id)->first();
                                        $commerciauxs = DB::table('commerciaus')->where('domaine_id', $moi->domaine_id)->pluck('id')->toArray();
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
                                  <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-left:10px;" type="submit">Filtrer</button>
                                </form> 
                            </div> 
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
            
                        @if($opportunite_pole->isEmpty()) 
                 	    <p></p>
					    @else
                            <br>
                            <div class="container px-6 mx-auto grid" >
           
                                         <div class="col-md-3" style="margin-right:-30px;margin-top:-50px;">
                                           
                                           <select name="search_a" class="form-select" aria-label="Default select example">
                                              
                                               <option value="">Filtrer par probabilité</option>
                                              
                                               <option value="1000">Probabilité de 70 à 100%</option>
                                               <option value="1001">Probabilité de 50 à 70%</option>
                                               <option value="1002" >Toutes les opportunités</option>
                                             
                                           </select>
                                        </div> 
                            <div style = "margin-left: 400px; margin-top:-50px" > 
                                 <form action="{{route('search_statut_maTeam_res')}}" method="get" style="margsearchfin-top:5px; display:flex;">
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
                        @endif
        <div class="row">
		<div class="col-12 col-s-12">
           <div class="container" id="tout">
              
              @if($opportunite_pole->isEmpty()) 
                 	  <p>Pas d'opportunité</p>
					 @else
	
    <div class="container">
        <div class="row">
            <div class="col-12 col-s-12">
              <table class="table" id="table">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th style="width:10%" class="px-0 py-1">Commerciaux</th>
                    <th style="width:25%" align="left">Libellé</th>
                    <!--<th style="width:8%" class="px-0 py-1">Entreprises</th>-->
                    <th style="width:10%" class="px-0 py-1">Objectifs vente</th>
                    <th style="width:5%" class="px-0 py-1">Probabilité</th>
                    <th style="width:10%" class="px-0 py-1">Statut</th>
                    <th style="width:10%"  class="px-0 py-1">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach($opportunite_pole as $opportunites_pole)
                @php $prospect = DB::table('prospects')->where('id', $opportunites_pole->prospect_id)->first(); 
                    $origine = DB::table('origines')->where('id', $opportunites_pole->origine_id)->first(); 
                    $com = DB::table('commerciaus')->where('id', $opportunites_pole->commercial_id)->first();
                @endphp
                 @if($opportunites_pole->archiver == 0 )
                 @if($com)
                  <tr class="text-gray-700 dark:text-gray-400">
                   <td class="px-1 py-3 text-sm">
                      {{ ($com->prenom) ? $com->prenom : ''}} {{ ($com->nom) ? $com->nom : ''}}
                    </td>
                    <td align="left" data-toggle="tooltip" title="{{$opportunites_pole->libelle}}">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                        <a href="{{ route('detail_op',$opportunites_pole->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunites_pole->libelle, 30, $end='...') }}</h4>
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
                        
                        {{(number_format($opportunites_pole->objectif_de_vente)) ? number_format($opportunites_pole->objectif_de_vente) : '0'}} f
                      </span>
                    </td>
                    
                     <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        
                        {{$opportunites_pole->probabilite ? $opportunites_pole->probabilite : '00'}} %
                      </span>
                    </td>
                    @php $statut = DB::table('statut_opportunites')->where('id', $opportunites_pole->statut)->first(); @endphp
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
                    
                        
                        <div class="dropdown">
                          <button class="dropbtn px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                             <b>...</b> 
                            </button>
                          <div class="dropdown-content">
                          <a href="{{ route('detail_op',$opportunites_pole->id) }}">Voir détails</a>
                          <!--<a href="{{route('op.edit', $opportunites_pole->id)}}">Modifier l'opportunité</a>-->
                          <a href="{{ route('historiques_op.voir',$opportunites_pole->id) }}">Voir l'historique des statuts</a>
                          <a href="{{route('opportunite_prospectCreate', $opportunites_pole->id)}}">Ajouter une action </a>
                          <!--<a href="{{route('opportunite_VenteCreate', $opportunites_pole->id)}}">Clôturer </a>-->
                          </div>
                        </div>
                      
                          
                    
                    </td>
                 </tr>
                 @endif
                  @endif
                  @endforeach
                </tbody>
                </div>
            </div>
              </table>
            </div>
            
            @endif
             </div>
           </div>
            </div>  
             
             <!-- start 70 - 100 % -->
             
            
           
          <div class="container" id="70-100">
        
             <div class="container px-2 mx-auto grid">
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="font-size:18px;">
            Opportunités probabilité : 70 - 100 %
          </h2>
             
             <div class="container">
              
              @if($opportunite_pole->isEmpty()) 
                 	  <p>Pas d'opportunité</p>
					 @else
            <div class="container">
              <table >
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                   <th style="width:10%" class="px-0 py-1">Commerciaux</th>
                    <th style="width:25%" align="left">Libellé</th>
                    <!--<th style="width:8%" class="px-0 py-1">Entreprises</th>-->
                    <th style="width:10%" class="px-0 py-1">Objectifs vente</th>
                    <th style="width:5%" class="px-0 py-1">Probabilité</th>
                    <th style="width:10%" class="px-0 py-1">Statut</th>
                    <th style="width:10%"  class="px-0 py-1">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach($opportunite_pole as $opportunites_pole)
                        @php $prospect = DB::table('prospects')->where('id', $opportunites_pole->prospect_id)->first(); 
                            $origine = DB::table('origines')->where('id', $opportunites_pole->origine_id)->first(); 
                             $come = DB::table('commerciaus')->where('id', $opportunites_pole->commercial_id)->first();
                        @endphp
                @if($opportunites_pole->probabilite >= 70)
                @if($opportunites_pole->archiver == 0 )
                 @if($come)
                  <tr class="text-gray-700 dark:text-gray-400">
                   <td class="px-1 py-3 text-sm">
                      {{ ($come->prenom) ? $come->prenom : ''}} {{ ($come->nom) ? $come->nom : ''}}
                    </td>
                     <td align="left" data-toggle="tooltip" title="{{$opportunites_pole->libelle}}">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                        <a href="{{ route('detail_op',$opportunites_pole->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunites_pole->libelle, 30, $end='...') }}</h4>
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
                        
                        {{(number_format($opportunites_pole->objectif_de_vente)) ? number_format($opportunites_pole->objectif_de_vente) : '0'}} f
                      </span>
                    </td>
                    
                     <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        
                        {{$opportunites_pole->probabilite ? $opportunites_pole->probabilite : '00'}} %
                      </span>
                    </td>
                    @php $statut = DB::table('statut_opportunites')->where('id', $opportunites_pole->statut)->first(); @endphp
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
                      <!--  <form action="{{route('archiver.opportunite', $opportunites_pole->id)}}" method="post" id="target" class="form">-->
                 <!--<span  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Mettre à jour le statut">-->
                 <!--     <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('mettre_a_jour_statut.edit', $opportunites_pole->id)}}" >-->
                 <!--         <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">-->
                 <!--         <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>-->
                 <!--         <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>-->
                 <!--       </svg>-->
                 <!--       </a>-->
                 <!--   </span>-->
                   <!-- <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Modifier l'opportunité">
                      <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('op.edit', $opportunites_pole->id)}}" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                        </a>
                    </span>-->
                   <!--<span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Ajouter une action">-->
                   <!--   <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('opportunite_prospectCreate', $opportunites_pole->id)}}" >-->
                   <!--       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-plus" viewBox="0 0 16 16">-->
                   <!--       <path d="M8.5 6a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V10a.5.5 0 0 0 1 0V8.5H10a.5.5 0 0 0 0-1H8.5V6z"/>-->
                   <!--       <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>-->
                   <!--     </svg>-->
                   <!--     </a>-->
                   <!-- </span>-->
                   <!-- <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Voir l'historique des statuts">
                      <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"  href="{{ route('historiques_op.voir',$opportunites_pole->id) }}" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                          <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                          <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                          <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                        </a>
                    </span>-->
                    
                 
                      <!--  <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Cloturer">
                          <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('opportunite_VenteCreate', $opportunites_pole->id)}}" >
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                      <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                      <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
                    </svg>
                            </a>
                        </span>-->
                        
                        <div class="dropdown">
                          <button class="dropbtn px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                             <b>...</b> 
                            </button>
                          <div class="dropdown-content">
                          <a href="{{ route('detail_op',$opportunites_pole->id) }}">Voir détails</a>
                          <!--<a href="{{route('op.edit', $opportunites_pole->id)}}">Modifier l'opportunité</a>-->
                          <a href="{{ route('historiques_op.voir',$opportunites_pole->id) }}">Voir l'historique des statuts</a>
                          <a href="{{route('opportunite_prospectCreate', $opportunites_pole->id)}}">Ajouter une action </a>
                          <!--<a href="{{route('opportunite_VenteCreate', $opportunites_pole->id)}}">Clôturer </a>-->
                          </div>
                        </div>
                      
                      <!--  <div class="menu-nav">
                            <div class="menu-item"></div>
                            <div class="dropdown-container" tabindex="-1">
                              <div class="three-dots"></div>
                              <div class="dropdown">
                                  
                                     <a href="{{ route('detail_op',$opportunites_pole->id) }}" id="a">
                                         <div>
                                  Voir details
                                </div></a>
                                <a  id="a" href="{{route('op.edit', $opportunites_pole->id)}}" ><div>
                                  Modifier l'opportunité 
                                </div></a>
                               
                                <a  id="a"  href="{{ route('historiques_op.voir',$opportunites_pole->id) }}" ><div>
                                 Voir l'historique des statuts   
                                </div></a>
                                 <a id="a" href="{{route('opportunite_VenteCreate', $opportunites_pole->id)}}" ><div>
                                  Cloturer  
                                 </div></a>
                              </div>
                            </div>
                          </div>
                           </div>
                          </div>-->
                          
                    
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
              
              @if($opportunite_pole->isEmpty()) 
                 	  <p>Pas d'opportunité</p>
					 @else
            <div class="container">
              <table >
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                   <th style="width:10%" class="px-0 py-1">Commerciaux</th>
                    <th style="width:25%" align="left">Libellé</th>
                    <!--<th style="width:8%" class="px-0 py-1">Entreprises</th>-->
                    <th style="width:10%" class="px-0 py-1">Objectifs vente</th>
                    <th style="width:4%" class="px-0 py-1">Probabilité</th>
                    <th style="width:10%" class="px-0 py-1">Statut</th>
                    <th style="width:10%"  class="px-0 py-1">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach($opportunite_pole as $opportunites_pole)
                @php $prospect = DB::table('prospects')->where('id', $opportunites_pole->prospect_id)->first(); 
                 $comer = DB::table('commerciaus')->where('id', $opportunites_pole->commercial_id)->first();
                    $origine = DB::table('origines')->where('id', $opportunites_pole->origine_id)->first(); 
                @endphp
                @if($opportunites_pole->probabilite >= 50 && $opportunites_pole->probabilite <= 70)
                @if($opportunites_pole->archiver == 0 )
                @if($comer)
                  <tr class="text-gray-700 dark:text-gray-400">
                   <td class="px-1 py-3 text-sm">
                      {{ ($comer->prenom) ? $comer->prenom : ''}} {{ ($comer->nom) ? $comer->nom : ''}}
                    </td>
                     <td align="left" data-toggle="tooltip" title="{{$opportunites_pole->libelle}}">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                        <a href="{{ route('detail_op',$opportunites_pole->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunites_pole->libelle, 30, $end='...') }}</h4>
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
                        
                        {{(number_format($opportunites_pole->objectif_de_vente)) ? number_format($opportunites_pole->objectif_de_vente) : '0'}} f
                      </span>
                    </td>
                    
                     <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        
                        {{$opportunites_pole->probabilite ? $opportunites_pole->probabilite : '00'}} %
                      </span>
                    </td>
                    @php $statut = DB::table('statut_opportunites')->where('id', $opportunites_pole->statut)->first(); @endphp
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
                      <!--  <form action="{{route('archiver.opportunite', $opportunites_pole->id)}}" method="post" id="target" class="form">-->
                 <!--<span  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Mettre à jour le statut">-->
                 <!--     <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('mettre_a_jour_statut.edit', $opportunites_pole->id)}}" >-->
                 <!--         <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">-->
                 <!--         <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>-->
                 <!--         <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>-->
                 <!--       </svg>-->
                 <!--       </a>-->
                 <!--   </span>-->
                   <!-- <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Modifier l'opportunité">
                      <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('op.edit', $opportunites_pole->id)}}" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                        </a>
                    </span>-->
                   <!--<span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Ajouter une action">-->
                   <!--   <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('opportunite_prospectCreate', $opportunites_pole->id)}}" >-->
                   <!--       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-plus" viewBox="0 0 16 16">-->
                   <!--       <path d="M8.5 6a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V10a.5.5 0 0 0 1 0V8.5H10a.5.5 0 0 0 0-1H8.5V6z"/>-->
                   <!--       <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>-->
                   <!--     </svg>-->
                   <!--     </a>-->
                   <!-- </span>-->
                   <!-- <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Voir l'historique des statuts">
                      <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"  href="{{ route('historiques_op.voir',$opportunites_pole->id) }}" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                          <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                          <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                          <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                        </a>
                    </span>-->
                    
                 
                      <!--  <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Cloturer">
                          <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('opportunite_VenteCreate', $opportunites_pole->id)}}" >
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                      <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                      <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
                    </svg>
                            </a>
                        </span>-->
                        
                        <div class="dropdown">
                          <button class="dropbtn px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                             <b>...</b> 
                            </button>
                          <div class="dropdown-content">
                          <a href="{{ route('detail_op',$opportunites_pole->id) }}">Voir détails</a>
                          <!--<a href="{{route('op.edit', $opportunites_pole->id)}}">Modifier l'opportunité</a>-->
                          <a href="{{ route('historiques_op.voir',$opportunites_pole->id) }}">Voir l'historique des statuts</a>
                          <a href="{{route('opportunite_prospectCreate', $opportunites_pole->id)}}">Ajouter une action </a>
                          <!--<a href="{{route('opportunite_VenteCreate', $opportunites_pole->id)}}">Clôturer </a>-->
                          </div>
                        </div>
                      
                      <!--  <div class="menu-nav">
                            <div class="menu-item"></div>
                            <div class="dropdown-container" tabindex="-1">
                              <div class="three-dots"></div>
                              <div class="dropdown">
                                  
                                     <a href="{{ route('detail_op',$opportunites_pole->id) }}" id="a">
                                         <div>
                                  Voir details
                                </div></a>
                                <a  id="a" href="{{route('op.edit', $opportunites_pole->id)}}" ><div>
                                  Modifier l'opportunité 
                                </div></a>
                               
                                <a  id="a"  href="{{ route('historiques_op.voir',$opportunites_pole->id) }}" ><div>
                                 Voir l'historique des statuts   
                                </div></a>
                                 <a id="a" href="{{route('opportunite_VenteCreate', $opportunites_pole->id)}}" ><div>
                                  Cloturer  
                                 </div></a>
                              </div>
                            </div>
                          </div>
                           </div>
                          </div>-->
                          
                    
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
      @endif
      <!----------------------------------------------------------------------------------------------------------------------------------------------->
    </div>
           
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
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<!--<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>-->
<!--<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>-->


                
<!--                <script>-->
<!--  $(document).ready(function() {-->
<!--    $('#table').DataTable();-->
<!--} );-->
<!-- </script>-->
  <style>
  .pagination {
    list-style: none;
    margin: 0;
    display: flex;
   
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