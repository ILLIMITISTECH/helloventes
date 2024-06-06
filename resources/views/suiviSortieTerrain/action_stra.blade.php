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
<main class="h-full pb-16 overflow-y-auto">

        <!--les formulaires-->
            <div class="container px-6 mx-auto grid">
               
          
         
          <!------------------------------------echeances critiques------------------------------------------->
         <div>
              <!--<div class="px-6 my-6" style="width:250px; margin-left:820px; margin-top:40px">
                         <button
                          class="flex items-center justify-between  px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                          <a href="/toutes_les_opportunite">Voir pour toute la team</a>
                        </button>
                      </div>-->
            
             
            </div>

          
           <div>
                  <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                      
                    Liste de mes actions stratégiques
                  </h2>
                      <br>
                      <!-- <div style = "margin-top:-50px" align="right"> 
                                 <form action="{{route('filtrer_prospect')}}" method="get" style="">
                                
                                    <select name="searchPros" style="width:220px;height:40px;"  id="origine">
                                        <option value="" disabled selected>Rechercher par Pays</option>
                                      
                                       @php 
                                       $com = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                                       $result_paysse = array();
                                       foreach($prospects as $entreprisesgn){
                                        $prospects = DB::table('prospects')->where('commercial_id', $com->id)->pluck('pays_id')->toArray(); 
                                        $paysgn = DB::table('pays')->pluck('id')->toArray(); 
                                        $pays = DB::table('pays')->where('id', $entreprisesgn->pays_id)->pluck('id')->toArray(); 
                                        $result_pays = array_diff($paysgn, $prospects);
                                        $result_payss = array_diff($paysgn, $result_pays);
                                        
                                        foreach($result_payss as $result_pa){
                                        array_push($result_paysse,$result_pa);
                                        }
                                        }
                                        
                                        $pays_1 = DB::table('pays')->pluck('id')->toArray(); 
                                        $dif_1 = array_diff($pays_1, $result_paysse);
                                        $dif_2 = array_diff($pays_1, $dif_1);
                                        
                                    @endphp
                                       
                                    @foreach($dif_2 as $result_pay) 
                                        @php $pay = DB::table('pays')->where('id', $result_pay)->OrderBy('libelle')->first();  @endphp
                                        <option value="{{$pay->id}}">{{$pay->libelle}}</option>
                                    @endforeach
                                   
                                    </select>
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="" type="submit">Filtrer</button>
                                </form> 
                            </div> -->
                            <br>
                </div>
          <div class="container">
              	
            <div class="container">
              <table >
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th style="width:15%"  class="px-4 py-3">Action</th>
                    <th style="width:15%" class="px-4 py-3">Opportunité</th>
                    <th style="width:10%" class="px-1 py-3">Prospect</th>
                    <!--<th style="width:10%" class="px-1 py-3">Pays</th>-->
                    <!--<th style="width:10%" class="px-1 py-3">Objectifs vente</th>-->
                    <!--<th style="width:13%" class="px-1 py-3">Statut</th>-->
                    <th style="width:10%" class="px-1 py-3">Deadline</th>
                    <th style="width:10%" class="px-1 py-3">Options</th>

                  </tr>
                </thead>
                @php
                    $semaineM7 = (date('d') -7);
                    $action_semaineP7 = (date('d') +7);
                    $action_mois = date('m');
                @endphp
                  @php $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first(); @endphp
                 @php $deadline = date('Y-m-d'); $prospects = DB::table('prospects')->where('commercial_id', $commercial->id)->where('strategique', 1)->paginate(); @endphp
              
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($prospects as $prospect)
                 @php 
                    $opportunite_critique = DB::table('opportunites')->where('archiver', 0 )->where('prospect_id', $prospect->id)->OrderBy('created_at', 'desc')->paginate();
                @endphp
                 @php 
                    $paysPros = DB::table('pays')->where('id',$prospect->pays_id)->first();
                @endphp
                
                @foreach($opportunite_critique as $opportunite_critiquesf)
             
                @php 
                    $actions = DB::table('action_commerciales')->where('commercial_id', $commercial->id)->where('cloture', 0 )->where('opportunite_id', $opportunite_critiquesf->id)->OrderBy('created_at', 'desc')->get();
                @endphp
                
                @if(count($actions) > 0)
                @foreach($actions as $action)
                  <tr class="text-gray-700 dark:text-gray-400">
                      
                       <td class="px-4 py-3" data-toggle="tooltip" title="Voir les détails">

                      <div class="flex items-center text-sm ">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                        <a href="{{ route('detail_op',$opportunite_critiquesf->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ ($action->libelle) ? $action->libelle : '--' }}</h4>
                            </button>
                          </div></a>
                        <!--</div>-->
                    </td>
                    <td class="px-4 py-3" data-toggle="tooltip" title="Voir les détails">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->
                        <a href="{{ route('detail_op',$opportunite_critiquesf->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunite_critiquesf->libelle, 25, $end='...') }}</h4>
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
                   
                    
                     @php $pays = DB::table('pays')->where('id', $prospect->pays_id)->first(); @endphp
                   
                     @php $statut = DB::table('statut_opportunites')->where('id', $opportunite_critiquesf->statut)->first(); @endphp
                    @php $statut = DB::table('statut_opportunites')->where('id', $opportunite_critiquesf->statut)->first(); @endphp
                  
                    <td class="px-1 py-3 text-xs">
                      <span class="px-1 py-1 text-sm ">
                        {{($action->deadline) ? $action->deadline : '-'}}
                      </span>
                    </td>
                    
                    <td class="px-4 py-3 text-sm">
                        <span
                            class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Modifier votre action">
                            <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"
                                href="{{route('modifier_action_stra', $action->id )}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </a>
                        </span>
                        <span
                            class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Clôturer l'action">
                            <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"
                                href="{{route('cloturerAction', $action->id )}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                                  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                  <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
                                </svg>
                            </a>
                        </span>
                    </td>
                    </tr>
                     @endforeach
                     @endif
                
                     </tbody>
                    @endforeach
                    @endforeach
               
              </table>
            </div>
         
          {{$prospects->links()}}
            
          </div>
         
          <!-------------end-------------------------->
          
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