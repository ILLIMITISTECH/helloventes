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
        <!--les formulaires-->
        <div class="container px-6 mx-auto grid">
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Les prospects qualifiés de <b>{{$commercial->prenom}} {{$commercial->nom}}
          </h2>
                          @php 
                          
                          $week = [];
                        $saturday = strtotime('monday this week');
                        foreach (range(0, 6) as $day) {
                            $week[] = date("Y-m-d", (($day * 86400) + $saturday));
                        }
                        
                        
                        $appels_effectuer = array();
                        $appelsaqualifier = array();
                        $appelsnonqualifier = array();
                        $appels_arappeler = array();
                        $appels_daterv = array();
                        foreach($week as $weeks)
                         { 
                          $we = date('Y',  strtotime($weeks));
                         $appelsaqualifiers = DB::table('suivi_prospects')
                            ->where('commercial_id', $commercial->id)->where('type', 1)
                            ->whereYear('created_at', date('Y',  strtotime($weeks)))
                            ->whereMonth('created_at', date('m',  strtotime($weeks)))
                            ->whereDay('created_at', date('d',  strtotime($weeks)))
                            ->get(); 
                         
                           foreach($appelsaqualifiers as $appelsaqualifierss)
                            { 
                                array_push($appelsaqualifier,$appelsaqualifierss);
                            }
                            }
                          
                          @endphp

                             <br>
             <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              	 @if(count($appelsaqualifier) == 0) 
                 	  <p>Pas de prospect qualifiés </p>
					 @else
            <div class="w-full overflow-x-auto">
               
            
        <div class="w-full overflow-x-auto">    
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Entreprises</th>
                    <!--<th class="px-4 py-3">Secteur d'activité</th>-->
                    <!--<th class="px-4 py-3">Contact entreprise</th>-->
                    <!--<th class="px-4 py-3">Domaine validé </th>-->
                    <th class="px-4 py-3">Contact</th>
                    <th class="px-4 py-3">Centres d'intérêts</th>
                    <th class="px-4 py-3">Next step</th>
                    <th class="px-4 py-3">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($appelsaqualifier as $entreprises) 
                  <tr class="text-gray-700 dark:text-gray-400">
                    @php $pros = DB::table('prospect_a_appellers')->where('id', $entreprises->prospect_appel_id)->first(); @endphp
                   <td class="px-4 py-3 text-sm"  data-toggle="tooltip" title="{{$pros->nom_entreprise}}">
                       
                      {{ strtoupper(\Illuminate\Support\Str::limit(($pros->nom_entreprise) ? $pros->nom_entreprise : '', 25, $end='...'))}}
   <br>
                        <!--<p data-toggle="tooltip" title="{{$entreprises->etat_qualifier}}">{{ \Illuminate\Support\Str::limit(($pros->secteur_activite) ? $pros->secteur_activite : ' ', 25, $end='...') }}</p>-->
                    </td>
                    
                    
                    <!-- <td class="px-4 py-3 text-sm">-->
                    <!--  {{($pros->email_entreprise) ? $pros->email_entreprise : ''}} -->
                    <!--  <br>{{($pros->tel_fixe) ? $pros->tel_fixe : ''}}-->
                    <!--</td>-->
                    @php    $domaine = DB::table('domaines')->where('id', $entreprises->domaine_valider)->first();  @endphp
                    
                    <!-- <td class="px-4 py-3 text-sm">-->
                    <!--  @if($domaine){{($domaine->libelle) ? $domaine->libelle : ''}}@else  Non renseigné @endif-->
                    <!--</td>-->
                    
                    <td class="px-4 py-3 text-sm">
                       {{($pros->tel_contact) ? $pros->tel_contact : ''}}  
                    </td>
                    
                    <td class="px-4 py-3 text-sm">
                      {{($entreprises->choix_qualifier) ? $entreprises->choix_qualifier : 'Pas renseigné'}}
                    </td>
                    
                    <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$entreprises->etat_qualifier}}">
                        {{ ($entreprises->etat_qualifier) ? $entreprises->etat_qualifier : 'Pas renseigné ' }}
                    </td>
                    
                    
                    <td class="px-4 py-3 text-sm">
                    <div style="display:flex ">
                      
                         
                        <span style="margin-left:3px; height:28px;"  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Voir la fiche de l’entreprise">
 <a href="{{ route('fiche_prospect_qualifiers',$entreprises->id) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
</svg>
                    </a>
                      </span>
                      
                        <!-- <span style="margin-left:3px; height:28px;"  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Mettre à jour le prospect">-->
                        <!--  <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('prospect_qualifier.edit', $entreprises->id)}}" >-->
                        <!--      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">-->
                        <!--          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>-->
                        <!--          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>-->
                        <!--        </svg>-->
                        <!--    </a>-->
                        <!--</span>-->
                        
                        <!--<span style="margin-left:3px; height:28px;"  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Mettre à jour le prospect">-->
                        <!--  <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('prospect_a_appeler.edit', $entreprises->id)}}" >-->
                        <!--     Rendez-vous-->
                        <!--    </a>-->
                        <!--</span>-->
                        
                        <!--<span style="margin-left:3px; height:28px;"  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Mettre à jour le prospect">-->
                        <!--  <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('prospect_a_appeler.edit', $entreprises->id)}}" >-->
                        <!--     Devis -->
                        <!--    </a>-->
                        <!--</span>-->
                        
                    
                    </div>
                    </td>
                   
                  </tr>

                </tbody>
                @endforeach 
              </table>
            </div>
            
                 @endif
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