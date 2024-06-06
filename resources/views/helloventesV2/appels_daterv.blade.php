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
               
                @php 
                $mois = date('m');
                            $annee = date('Y'); 
                $day = date('d'); 
                @endphp
        <div class="container px-6 mx-auto grid">
            <br>
            <div align="left">
                <a href="/rv_deja_fait" class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Fiche entreprise">Rendez-vous déja fait</a>
            </div>
            
            <div style = "margin-left: 400px; margin-top:-50px" > 
                                 <form action="{{route('filtrer_pros_numero_rv')}}" method="get" style="margsearchfin-top:5px; display:flex;">
                                     
                                       
                                           
                                    <select name="search" style="width:220px;height:40px"  id="statut" style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par prospect</option>
                                      @php
                                        $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                                        $appels_arappelerff = DB::table('suivi_prospects')->select('suivi_prospects.commercial_id','suivi_prospects.created_at','suivi_prospects.type','suivi_prospects.date_rappel','suivi_prospects.choix_a_rappeler',
                        'prospect_a_appellers.*')
                        ->join('prospect_a_appellers', 'prospect_a_appellers.id', 'suivi_prospects.prospect_appel_id')
                        ->where('suivi_prospects.type', 1)->where('suivi_prospects.statut_rv', null)->where('suivi_prospects.choix_qualifier', "Rendez-vous obtenu")->where('suivi_prospects.commercial_id', $commercial->id)->whereYear('suivi_prospects.date_rendezvous', $annee)
                    ->whereMonth('suivi_prospects.date_rendezvous', $mois)
                    ->orderby('suivi_prospects.date_rendezvous', 'asc') 
                        ->get();
                                         $entreprisess = DB::table('prospect_a_appellers')->where('commercial_id', $commercial->id)->where('statut', NULL)->orderby('nom_entreprise')->get();  @endphp
                                        @foreach($appels_arappelerff as $entreprisesss)
                                        <option value="{{$entreprisesss->nom_entreprise}}">{{$entreprisesss->nom_entreprise}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                      
                                
                                    <select name="searchnumero" style="width:220px;height:40px; margin-left:10px;"  id="origine">
                                        <option value="" disabled selected>Rechercher par Numéro de téléphone</option>
                                      
                                        @foreach($appels_arappelerff as $entreprisesss)
                                        <option value="{{$entreprisesss->tel_contact}}">{{$entreprisesss->tel_contact}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                    
                                 
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-left:10px;" type="submit">Filtrer</button>
                                </form> 
                            </div> 
                            
                             <br>
            @if(count($rv_today) == 0) 
                 	  <p></p>
					 @else
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Mes rendez-vous de la semaine
          </h2>
          @endif
                             <br>
             <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
               
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              	 @if(count($rv_today) == 0) 
                 	  <p>Pas de rendez-vous cette semaine </p>
					 @else
            <div class="w-full overflow-x-auto">
               
            
        <div class="w-full overflow-x-auto">    
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Entreprises</th>
                    <!--<th class="px-4 py-3">Secteur d'activité</th>-->
                    <th class="px-4 py-3">Contact entreprise</th>
                    <th class="px-4 py-3">Date / Heure</th>
                    <th class="px-4 py-3">Lieu</th>
                     <th class="px-4 py-3">Personne</th>
                      <!--<th class="px-4 py-3">Contact</th>-->
                    <!--<th class="px-4 py-3">Libelle</th>-->
                    <th class="px-4 py-3">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($rv_today as $entreprises_today) 
                  <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$entreprises_today->nom_entreprise}}">
                         {{ \Illuminate\Support\Str::limit(($entreprises_today->nom_entreprise) ? $entreprises_today->nom_entreprise : 'Non renseigné', 20, $end='...') }}
                    </td>
                    
                    
                    <!-- <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$entreprises_today->secteur_activite}}">-->
                    <!--     {{ \Illuminate\Support\Str::limit(($entreprises_today->secteur_activite) ? $entreprises_today->secteur_activite : 'Non renseigné', 25, $end='...') }}-->
                    <!--</td>-->
                   
                   
                    
                     <td class="px-4 py-3 text-sm">
                      {{($entreprises_today->email_entreprise) ? $entreprises_today->email_entreprise : ''}} <br> {{($entreprises_today->tel_contact) ? $entreprises_today->tel_contact : ''}}
                    </td>
                     <td class="px-4 py-3 text-sm">
                      {{($entreprises_today->date_rendezvous) ? date('d/m/Y', strtotime($entreprises_today->date_rendezvous)) : ''}}
                      <br>{{($entreprises_today->heure_rv) ? $entreprises_today->heure_rv : ''}}
                    </td>
                     <td class="px-4 py-3 text-sm">
                      {{($entreprises_today->lieu_rv) ? $entreprises_today->lieu_rv : ''}}
                    </td>
                    <td class="px-4 py-3 text-sm">
                      {{($entreprises_today->personne_rv) ? $entreprises_today->personne_rv : ''}}
                      <br>{{($entreprises_today->contact_rv) ? $entreprises_today->contact_rv : ''}}
                    </td>
                    
                    
                   <td class="px-4 py-3 text-sm">
                    <div style="display:flex ">
                      
                         
                        <span style="margin-left:3px; height:28px;"  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Fiche entreprise">
            <a href="{{ route('fiche_prospect_rv',$entreprises_today->id) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                          <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                        </svg>
                    </a>
                      </span>
                      
                         <span style="margin-left:3px; height:28px;"  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Résultats appel">
                          <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('prospect_rv.edit', $entreprises_today->id)}}" >
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-forward" viewBox="0 0 16 16">
                      <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zm10.762.135a.5.5 0 0 1 .708 0l2.5 2.5a.5.5 0 0 1 0 .708l-2.5 2.5a.5.5 0 0 1-.708-.708L14.293 4H9.5a.5.5 0 0 1 0-1h4.793l-1.647-1.646a.5.5 0 0 1 0-.708z"/>
                    </svg>
                            </a>
                        </span>
                        <span style="margin-left:3px; height:28px;"  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Résultats du rendez-vous">
                          <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('cloturer_rv.edit', $entreprises_today->id)}}" >
                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
</svg>
                            </a>
                        </span>
                    
                    </div>
                    </td>
                   
                   
                  </tr>

                </tbody>
                @endforeach 
              </table>
            </div>
            </div>
                 @endif
          </div>
  </div>


<!-------------------------------------------------------------------------------------------------->
  <br>



        <div class="container px-6 mx-auto grid">
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Mes autres rendez-vous à venir
          </h2>
          
                             <br>
             
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              	  @if(count($appels_daterv) == 0)
                 	  <p>Pas de rendez-vous à venir </p>
					 @else
            <div class="w-full overflow-x-auto">
               
            
        <div class="w-full overflow-x-auto">    
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Entreprises</th>
                    <!--<th class="px-4 py-3">Secteur d'activité</th>-->
                    <th class="px-4 py-3">Contact entreprise</th>
                    <th class="px-4 py-3">Date / Heure</th>
                    <th class="px-4 py-3">Lieu</th>
                     <th class="px-4 py-3">Personne</th>
                      <!--<th class="px-4 py-3">Contact</th>-->
                    <!--<th class="px-4 py-3">Libelle</th>-->
                    <th class="px-4 py-3">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($appels_daterv as $entreprises) 
                  <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$entreprises->nom_entreprise}}">
                         {{ \Illuminate\Support\Str::limit(($entreprises->nom_entreprise) ? $entreprises->nom_entreprise : 'Non renseigné', 20, $end='...') }}
                    </td>
                    
                    
                    <!-- <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$entreprises->secteur_activite}}">-->
                    <!--     {{ \Illuminate\Support\Str::limit(($entreprises->secteur_activite) ? $entreprises->secteur_activite : 'Non renseigné', 25, $end='...') }}-->
                    <!--</td>-->
                   
                   
                    
                     <td class="px-4 py-3 text-sm">
                      {{($entreprises->email_entreprise) ? $entreprises->email_entreprise : ''}} <br> {{($entreprises->tel_contact) ? $entreprises->tel_contact : ''}}
                    </td>
                     <td class="px-4 py-3 text-sm">
                      {{($entreprises->date_rendezvous) ? date('d/m/Y', strtotime($entreprises->date_rendezvous)) : ''}}
                      <br>{{($entreprises->heure_rv) ? $entreprises->heure_rv : ''}}
                    </td>
                     <td class="px-4 py-3 text-sm">
                      {{($entreprises->lieu_rv) ? $entreprises->lieu_rv : ''}}
                    </td>
                    <td class="px-4 py-3 text-sm">
                      {{($entreprises->personne_rv) ? $entreprises->personne_rv : ''}}
                      <br>{{($entreprises->contact_rv) ? $entreprises->contact_rv : ''}}
                    </td>
                    
                    
                   <td class="px-4 py-3 text-sm">
                    <div style="display:flex ">
                      
                         
                        <span style="margin-left:3px; height:28px;"  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Fiche entreprise">
            <a href="{{ route('fiche_prospect_rv',$entreprises->id) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
</svg>
                    </a>
                      </span>
                      
                         <span style="margin-left:3px; height:28px;"  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Résultats appel">
                          <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('prospect_rv.edit', $entreprises->id)}}" >
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-forward" viewBox="0 0 16 16">
                      <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zm10.762.135a.5.5 0 0 1 .708 0l2.5 2.5a.5.5 0 0 1 0 .708l-2.5 2.5a.5.5 0 0 1-.708-.708L14.293 4H9.5a.5.5 0 0 1 0-1h4.793l-1.647-1.646a.5.5 0 0 1 0-.708z"/>
                    </svg>
                            </a>
                        </span>
                        
                        <span style="margin-left:3px; height:28px;"  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Résultats du rendez-vous">
                          <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('cloturer_rv.edit', $entreprises->id)}}" >
                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
</svg>
                            </a>
                        </span>
                    
                    </div>
                    </td>
                   
                   
                  </tr>

                </tbody>
                @endforeach 
              </table>
            </div>
            </div>
                 @endif
          </div>

 </div>
   <style>
  .pagination {
    list-style: none;
    margin: 0;
    display: flex;
    padding-left: 450px;
}
        
.pagination li {
    margin: 0 1px;
    font-size: 17px;
}
 
 </style> 
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

 
</body>

</html>