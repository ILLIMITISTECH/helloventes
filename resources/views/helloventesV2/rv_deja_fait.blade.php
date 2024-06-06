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

                $week = [];
                $saturday = strtotime('monday this week');
                foreach (range(0, 6) as $day) {
                    $week[] = date("Y-m-d", (($day * 86400) + $saturday));
                }
                $rv_today = array();
                foreach($week as $weeks)
                 { 
                    $rv_todays = DB::table('suivi_prospects')->where('type', 1)->where('choix_qualifier', "Rendez-vous obtenu")->where('commercial_id', $commercial->id)
                    ->whereDay('date_rendezvous',date('d', strtotime($weeks)))
                    ->whereMonth('date_rendezvous',date('m', strtotime($weeks)))
                    ->whereYear('date_rendezvous',date('Y', strtotime($weeks)))
                    ->orderby('date_rendezvous', 'asc')
                    ->where('statut_rv', 1)
                    ->get();
                   
                   foreach($rv_todays as $rv_todayss){
                    array_push($rv_today, $rv_todayss);
                    }
                   
                }
                
                $mois = date('m');
                $annee = date('Y');
                $rv_mois = DB::table('suivi_prospects')->where('type', 1)->where('choix_qualifier', "Rendez-vous obtenu")->where('commercial_id', $commercial->id)
                    ->whereMonth('date_rendezvous', $mois)
                    ->whereYear('date_rendezvous', $annee)
                    ->orderby('date_rendezvous', 'asc')
                    ->where('statut_rv', 1)
                    ->get();
                @endphp
                @php 
                $mois = date('m');
                            $annee = date('Y'); 
                $day = date('d'); 
                @endphp
        <div class="container px-6 mx-auto grid">
           
            @if(count($rv_mois) == 0) 
                 	  <p></p>
					 @else
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Mes rendez-vous déja fait
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
              	 @if(count($rv_mois) == 0) 
                 	  <p>Pas de rendez-vous ce mois </p>
					 @else
            <div class="w-full overflow-x-auto">
               
            
        <div class="w-full overflow-x-auto">    
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Entreprises</th>
                    <th class="px-4 py-3">Contact entreprise</th>
                    <th class="px-4 py-3">Resultat RV</th>
                    <th class="px-4 py-3">Date / Lieu</th>
                    <!--<th class="px-4 py-3">Lieu</th>-->
                     <th class="px-4 py-3">Personne</th>
                     <th class="px-4 py-3">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($rv_mois as $entreprises_today) 
                  <tr class="text-gray-700 dark:text-gray-400">
                    @php $pros = DB::table('prospect_a_appellers')->where('id', $entreprises_today->prospect_appel_id)->first(); @endphp
                    <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$pros->nom_entreprise}}">
                         {{ \Illuminate\Support\Str::limit(($pros->nom_entreprise) ? $pros->nom_entreprise : 'Non renseigné', 20, $end='...') }}
                    </td>
                    
                   
                    
                     <td class="px-4 py-3 text-sm">
                      {{($pros->email_entreprise) ? $pros->email_entreprise : ''}} <br> {{($pros->tel_contact) ? $pros->tel_contact : ''}}
                    </td>
                     <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$entreprises_today->resultat_rv}}">
                         {{ \Illuminate\Support\Str::limit(($entreprises_today->resultat_rv) ? $entreprises_today->resultat_rv : 'Non renseigné', 20, $end='...') }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                      {{($entreprises_today->date_rendezvous) ? date('d/m/Y', strtotime($entreprises_today->date_rendezvous)) : ''}}
                      <br>{{($entreprises_today->heure_rv) ? $entreprises_today->heure_rv : ''}}
                      <br>{{($entreprises_today->lieu_rv) ? $entreprises_today->lieu_rv : ''}}
                    </td>
                    <!-- <td class="px-4 py-3 text-sm">-->
                    <!--  {{($entreprises_today->lieu_rv) ? $entreprises_today->lieu_rv : ''}}-->
                    <!--</td>-->
                    <td class="px-4 py-3 text-sm">
                      {{($entreprises_today->personne_rv) ? $entreprises_today->personne_rv : ''}}
                      <br>{{($entreprises_today->contact_rv) ? $entreprises_today->contact_rv : ''}}
                    </td>
                    
                    <td>
                                    <span style="margin-left:3px; height:28px;"  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Voir les actions">
                                      <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('action_rv.voir', $entreprises_today->id)}}" >
                                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
</svg>
                                        </a>
                                    </span>
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