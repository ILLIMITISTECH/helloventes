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
<main class="h-full pb-16 overflow-y-auto">
<br>
       <a data-toggle="tooltip" title="Retour" style="width:90px; margin-left:30px"  type="button" id="PopoverCustomT-1" class="nm" href="javascript:history.go(-1)" >
                   <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="nmj bi bi-arrow-left-circle" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                    </svg>
                </a>
                <style>
                    .nmj:hover{
                        background-color:#9045e2;
                        color:white;
                        border-radius:100px;
                    } 
                </style>
                  <!---------------------------------->
        <div class="container px-6 mx-auto grid">
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
              
            Liste des Opportunités perdues du 1er trimestre
          </h2>
           <h6> 
              @if (session('archive'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('archive') }}
                  </div>  
              @endif
            </h6>
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              	 @if($check_opportunite_tri->isEmpty()) 
                 	  <p>Pas d'opportunité perdue du 1er trimestre</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Commerciaux</th>
                    <th class="px-4 py-3">Libellé</th>
                    <th class="px-4 py-3">Prospect</th>
                    <th class="px-4 py-3">Objectifs vente</th>
                    <th class="px-4 py-3">Statut</th>
                    <!--<th class="px-4 py-3">Date désarchivage</th>-->
                    <!--<th class="px-4 py-3">Options</th>-->

                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($check_opportunite_tri as $opportunites_tri)
                @php $prospect = DB::table('prospects')->where('id', $opportunites_tri->prospect_id)->first();
                $vente = DB::table('ventes')->where('opportunite_id', $opportunites_tri->id)->first(); 
                    $com = DB::table('commerciaus')->where('id', $opportunites_tri->commercial_id)->first();
                     $trimestre = date("m");
                @endphp
                
                @if( ($trimestre >= 01) && ($trimestre <= 03) )
                 @if(  (date("m", strtotime($opportunites_tri->deadline)) >= 01) && (date("m", strtotime($opportunites_tri->deadline)) <= 03) )
                 
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <td class="px-4 py-3 text-sm">
                      {{ ($com->prenom) ? $com->prenom : ''}} {{ ($com->nom) ? $com->nom : ''}}
                    </td>
                     <td class="px-4 py-3" data-toggle="tooltip" title="Voir les détails">
                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                        <a href="{{ route('detail_op',$opportunites_tri->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunites_tri->libelle, 25, $end='...') }}</h4>
                            </button>
                          </div></a>
                        <!--</div>-->
                    </td>
                     @if($prospect)
                    <td class="px-4 py-3 text-sm">
                      {{ ($prospect->nom_entreprise) ? $prospect->nom_entreprise : ''}}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                   @if($vente)
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                       {{(number_format($vente->montant)) ? number_format($vente->montant) : ''}} Fcfa
                      </span>
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                     @php $statut = DB::table('statut_opportunites')->where('id', $opportunites_tri->statut)->first(); @endphp
                    @if($statut)
                    <td class="px-4 py-3 text-sm">
                      <button
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                          {{($statut->libelle) ? $statut->libelle : ''}}
                    </button>
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    </tr>
                    @endif 
                     @endif
                     
                     
                @if( ($trimestre >= 04) && ($trimestre <= 06) )
                 @if(  (date("m", strtotime($opportunites_tri->deadline)) >= 04) && (date("m", strtotime($opportunites_tri->deadline)) <= 06) )
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <td class="px-4 py-3 text-sm">
                      {{ ($com->prenom) ? $com->prenom : ''}} {{ ($com->nom) ? $com->nom : ''}}
                    </td>
                     <td class="px-4 py-3" data-toggle="tooltip" title="Voir les détails">
                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                        <a href="{{ route('detail_op',$opportunites_tri->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunites_tri->libelle, 25, $end='...') }}</h4>
                            </button>
                          </div></a>
                        <!--</div>-->
                    </td>
                     @if($prospect)
                    <td class="px-4 py-3 text-sm">
                      {{ ($prospect->nom_entreprise) ? $prospect->nom_entreprise : ''}}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    @if($vente)
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                       {{(number_format($vente->montant)) ? number_format($vente->montant) : ''}} Fcfa
                      </span>
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                     @php $statut = DB::table('statut_opportunites')->where('id', $opportunites_tri->statut)->first(); @endphp
                    @if($statut)
                    <td class="px-4 py-3 text-sm">
                      <button
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                          {{($statut->libelle) ? $statut->libelle : ''}}
                    </button>
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    </tr>
                         @endif
                      @endif
                      
                @if( ($trimestre >= 7) && ($trimestre <= 9) )
                 @if(  (date("m", strtotime($opportunites_tri->deadline)) >= 7) && (date("m", strtotime($opportunites_tri->deadline)) <= 9) )
                 
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <td class="px-4 py-3 text-sm">
                      {{ ($com->prenom) ? $com->prenom : ''}} {{ ($com->nom) ? $com->nom : ''}}
                    </td>
                     <td class="px-4 py-3" data-toggle="tooltip" title="Voir les détails">
                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                        <a href="{{ route('detail_op',$opportunites_tri->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunites_tri->libelle, 25, $end='...') }}</h4>
                            </button>
                          </div></a>
                        <!--</div>-->
                    </td>
                     @if($prospect)
                    <td class="px-4 py-3 text-sm">
                      {{ ($prospect->nom_entreprise) ? $prospect->nom_entreprise : ''}}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                       {{(number_format($opportunites_tri->objectif_de_vente)) ? number_format($opportunites_tri->objectif_de_vente) : ''}} Fcfa
                      </span>
                    </td>
                     @php $statut = DB::table('statut_opportunites')->where('id', $opportunites_tri->statut)->first(); @endphp
                    @if($statut)
                    <td class="px-4 py-3 text-sm">
                      <button
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                          {{($statut->libelle) ? $statut->libelle : ''}}
                    </button>
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    </tr>
                    
                    
                    @endif
                    @endif
                    
                    @if( ($trimestre >= 10) && ($trimestre <= 12) )
                 @if(  (date("m", strtotime($opportunites_tri->deadline)) >= 10) && (date("m", strtotime($opportunites_tri->deadline)) <= 12) )
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <td class="px-4 py-3 text-sm">
                      {{ ($com->prenom) ? $com->prenom : ''}} {{ ($com->nom) ? $com->nom : ''}}
                    </td>
                     <td class="px-4 py-3" data-toggle="tooltip" title="Voir les détails">
                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                        <a href="{{ route('detail_op',$opportunites_tri->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunites_tri->libelle, 25, $end='...') }}</h4>
                            </button>
                          </div></a>
                        <!--</div>-->
                    </td>
                     @if($prospect)
                    <td class="px-4 py-3 text-sm">
                      {{ ($prospect->nom_entreprise) ? $prospect->nom_entreprise : ''}}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                       {{(number_format($opportunites_tri->objectif_de_vente)) ? number_format($opportunites_tri->objectif_de_vente) : ''}} Fcfa
                      </span>
                    </td>
                     @php $statut = DB::table('statut_opportunites')->where('id', $opportunites_tri->statut)->first(); @endphp
                    @if($statut)
                    <td class="px-4 py-3 text-sm">
                      <button
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                          {{($statut->libelle) ? $statut->libelle : ''}}   
                    </button>
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                 
                    </tr>
                    @endif
                    @endif
                    
                     </tbody>
                    @endforeach
               
              </table>
            </div>
         
          {{$check_opportunite_tri->links()}}
             @endif
          </div>

        </div> 
        <!---------------------------------->
        <!--les formulaires-->
        
        <div class="container px-6 mx-auto grid">
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
              
            Liste des Opportunités gagnées
          </h2>
           <h6> 
              @if (session('archive'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('archive') }}
                  </div>  
              @endif
            </h6>
            @if(Auth::user()->nom_role == "responsable")
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              	 @if($opportunite->isEmpty()) 
                 	  <p>Pas d'opportunité gagnée</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Commerciaux</th>
                    <th class="px-4 py-3">Libellé</th>
                    <th class="px-4 py-3">Prospect</th>
                    <th class="px-4 py-3">Objectifs vente</th>
                    <th class="px-4 py-3">Statut</th>
                    <!--<th class="px-4 py-3">Date désarchivage</th>-->
                    <!--<th class="px-4 py-3">Options</th>-->

                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($opportunite as $opportunites)
                @php $prospect = DB::table('prospects')->where('id', $opportunites->prospect_id)->first(); 
                $vente = DB::table('ventes')->where('opportunite_id', $opportunites->id)->first(); 
                  $com = DB::table('commerciaus')->where('id', $opportunites->commercial_id)->first(); 
                @endphp
                  <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3 text-sm">
                      {{ ($com->prenom) ? $com->prenom : ''}} {{ ($com->nom) ? $com->nom : ''}}
                    </td>
                    <td class="px-4 py-3" data-toggle="tooltip" title="Voir les détails">

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
                      {{ ($prospect->nom_entreprise) ? $prospect->nom_entreprise : ''}}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                       {{(number_format($opportunites->objectif_de_vente)) ? number_format($opportunites->objectif_de_vente) : ''}} Fcfa
                      </span>
                    </td>
                     @php $statut = DB::table('statut_opportunites')->where('id', $opportunites->statut)->first(); @endphp
                    @if($statut)
                    <td class="px-4 py-3 text-sm">
                      <button
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                          {{($statut->libelle) ? $statut->libelle : ''}}
                    </button>
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    <!-- <td class="px-4 py-3 text-sm">-->
                    <!--  {{ ($opportunites->deadline_desarchiver) ? $opportunites->deadline_desarchiver : '--'}}-->
                   
                    <!--</td>-->
                     <!--<td class="px-4 py-3 text-xs">-->
                     <!--      <form action="{{route('desarchiver.opportunite', $opportunites->id)}}" method="post" id="target" class="form">-->
                     <!--     <input type="hidden" value="{{csrf_token()}}" name="_token"/>-->
                     <!--   <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Désarchiver l'opportunité">-->
                     <!--      <button type="submit" id="PopoverCustomT-1" class="btn btn-primary" >-->
                     <!--         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-square" viewBox="0 0 16 16">-->
                     <!--         <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 9.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>-->
                     <!--       </svg>-->
                     <!--       </button>-->
                     <!--   </span>-->
                     <!--   </form>-->
                  <!--   <a href="{{ route('desarchiver.opportunite',$opportunites->id) }}">-->
                  <!--    <button data-toggle="tooltip" title="Désarchiver l'opportunité"-->
                  <!--  class="px-2 py-1 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">-->
                  <!--  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-square" viewBox="0 0 16 16">-->
                  <!--    <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 9.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>-->
                  <!--  </svg>-->
                  <!--</button></a>-->
                  
                    <!--</td>-->
                    </tr>
                     </tbody>
                    @endforeach
               
              </table>
            </div>
         {{$opportunite->links()}}
             @endif
          </div>

        </div>
        
        
        <!--------------------------------------------------renpon pole----------------------------------------------------------------->
        @elseif(Auth::user()->nom_role == "responsable_pole")
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
              	 @if($opportunite_pole->isEmpty()) 
                 	  <p>Pas d'opportunité gagnée</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Commerciaux</th>
                    <th class="px-4 py-3">Libellé</th>
                    <th class="px-4 py-3">Prospect</th>
                    <th class="px-4 py-3">Objectifs vente</th>
                    <th class="px-4 py-3">Statut</th>
                    <!--<th class="px-4 py-3">Date désarchivage</th>-->
                    <!--<th class="px-4 py-3">Options</th>-->

                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($opportunite_pole as $opportunites_pole)
                @php $prospect = DB::table('prospects')->where('id', $opportunites_pole->prospect_id)->first(); 
                  $com = DB::table('commerciaus')->where('id', $opportunites_pole->commercial_id)->first(); 
                @endphp
                  <tr class="text-gray-700 dark:text-gray-400">
                      @if($com)
                     <td class="px-4 py-3 text-sm">
                      {{ ($com->prenom) ? $com->prenom : '-'}} {{ ($com->nom) ? $com->nom : '-'}}
                    </td>
                    @else
                     <td class="px-4 py-3 text-sm">
                      --
                    </td>
                    @endif
                    <td class="px-4 py-3" data-toggle="tooltip" title="Voir les détails">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                        <a href="{{ route('detail_op',$opportunites_pole->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunites_pole->libelle, 25, $end='...') }}</h4>
                            </button>
                          </div></a>
                        <!--</div>-->
                    </td>
                     @if($prospect)
                    <td class="px-4 py-3 text-sm">
                      {{ ($prospect->nom_entreprise) ? $prospect->nom_entreprise : ''}}
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                       {{(number_format($opportunites_pole->objectif_de_vente)) ? number_format($opportunites_pole->objectif_de_vente) : ''}} Fcfa
                      </span>
                    </td>
                     @php $statut = DB::table('statut_opportunites')->where('id', $opportunites_pole->statut)->first(); @endphp
                    @if($statut)
                    <td class="px-4 py-3 text-sm">
                      <button
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                          {{($statut->libelle) ? $statut->libelle : ''}}
                    </button>
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    <!-- <td class="px-4 py-3 text-sm">-->
                    <!--  {{ ($opportunites_pole->deadline_desarchiver) ? $opportunites_pole->deadline_desarchiver : '--'}}-->
                   
                    <!--</td>-->
                     <!--<td class="px-4 py-3 text-xs">-->
                     <!--      <form action="{{route('desarchiver.opportunite', $opportunites_pole->id)}}" method="post" id="target" class="form">-->
                     <!--     <input type="hidden" value="{{csrf_token()}}" name="_token"/>-->
                     <!--   <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Désarchiver l'opportunité">-->
                     <!--      <button type="submit" id="PopoverCustomT-1" class="btn btn-primary" >-->
                     <!--         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-square" viewBox="0 0 16 16">-->
                     <!--         <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 9.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>-->
                     <!--       </svg>-->
                     <!--       </button>-->
                     <!--   </span>-->
                     <!--   </form>-->
                  <!--   <a href="{{ route('desarchiver.opportunite',$opportunites_pole->id) }}">-->
                  <!--    <button data-toggle="tooltip" title="Désarchiver l'opportunité"-->
                  <!--  class="px-2 py-1 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">-->
                  <!--  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-square" viewBox="0 0 16 16">-->
                  <!--    <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 9.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>-->
                  <!--  </svg>-->
                  <!--</button></a>-->
                  
                    <!--</td>-->
                    </tr>
                     </tbody>
                    @endforeach
               
              </table>
            </div>
         {{$opportunite_pole->links()}}
             @endif
          </div>

        </div>
        @endif
        <!----------------------------------------------------------end respon pole------------------------------------------------------------->
    </div>
    </main>
  </div>
  </div>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/init-alpine.js')}}"></script>
  <script src="{{asset('Koyalis/public/https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js')}}" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/charts-lines.js')}}" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/charts-pie.js')}}" defer></script>
</body>


</html>