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
           
            Les top commerciaux du mois
          </h2>
          <div style = "margin-left: 600px; margin-top:-50px" > 
                                 <form action="{{route('filtre_top_commerciaux_detail')}}" method="get" style="margin-top:30px; display:flex;">
                                    <!--<select name="serachCom" style="font-size:17px;width:220px;height:40px"  id="statut" style="margin-right:10px; display:flex;">-->
                                    <!--    <option value="" disabled selected>Rechercher par Commercial(e)</option>-->
                                        @php 
                                        $deadline = date('Y-m-d'); 
                                        $commerciauxs = DB::table('commerciaus')->pluck('id')->toArray();
                                        $entreprisess = DB::table('opportunites')->where('archiver', 0)->where('probabilite', '>', 70)
                                        ->pluck('commercial_id')->toArray();
                                        
                                        $result_comerP = array_diff($commerciauxs, $entreprisess);
                                        $result_comersss = array_diff($commerciauxs, $result_comerP);
                                        
                                        @endphp
                                        
                                    <!--    @foreach($result_comersss as $result_comer)-->
                                    <!--    @php $commerciales = DB::table('commerciaus')->where('id', $result_comer)->OrderBy('prenom')->first();  @endphp-->
                                    <!--    <option value="{{$commerciales->id}}">{{$commerciales->prenom}} {{$commerciales->nom}}</option>-->
                                    <!--    @endforeach-->
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    <!--</select>-->
                                      
                                
                                    <select name="serachPays" style="font-size:17px;width:220px;height:40px; margin-left:10px;"  id="origine">
                                        <option value="" disabled selected>Rechercher par Pays</option>
                                        @php 
                                          
                                        $prospects = DB::table('ventes')->select('ventes.*', 'commerciaus..prenom','commerciaus.nom','commerciaus.pays_id')
                                        ->join('commerciaus', 'commerciaus.id', 'ventes.commercial_id')
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
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-left:10px;" type="submit">Filtrer</button>
                                </form> 
                            </div> 
                            <br>
          @php $moiss = date('m'); 
                $annee = date('Y'); 
                $trimestre = date('m'); 
              @endphp
         
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              	
            <div class="w-full overflow-x-auto">
             <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Commerciaux</th>
                    <th class="px-4 py-3">CA realises</th>
                    <!--<th class="px-4 py-3">Mois</th>-->
                    <!--<th class="px-4 py-3">Chiffre d'affaires</th>-->
                    <!--<th class="px-4 py-3">Commissions</th>-->

                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach($vente as $ventes)
                    
                @if( ($trimestre >= 01) && ($trimestre <= 03) )
                @if(  (date("m", strtotime($ventes->created_at)) >= 01) && (date("m", strtotime($ventes->created_at)) <= 03) )
                  <tr class="text-gray-700 dark:text-gray-400">

                    <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->

                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold"><a href="">
                                <h4>{{$ventes->prenom}} {{$ventes->nom}}</h4>
                            </button>
                          <!--</div>-->
                        </div>
                    </td>
                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--  TOLGO-->
                    <!--</td>-->
                  
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                          
                        {{(number_format($ventes->montant)) ? number_format($ventes->montant) : '0'}} Fcfa
                      </span>
                    </td>
                    
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                          @php  setlocale(LC_TIME, 'fr_FR');   @endphp
                         {{ucfirst(strftime('%B', strtotime($ventes->created_at)))}}
                      </span>
                    </td>
                  </tr>
                  
                  @endif
                  @endif
                  
                @if( ($trimestre >= 04) && ($trimestre <= 06) )
                @if(  (date("m", strtotime($ventes->created_at)) >= 04) && (date("m", strtotime($ventes->created_at)) <= 06) )
                  <tr class="text-gray-700 dark:text-gray-400">

                    <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->

                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold"><a href="">
                                <h4>{{$ventes->prenom}} {{$ventes->nom}}  </h4>
                            </button>
                          <!--</div>-->
                        </div>
                    </td>
                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--  TOLGO-->
                    <!--</td>-->
                  
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        {{(number_format($ventes->total)) ? number_format($ventes->total) : '0'}} Fcfa
                      </span>
                    </td>
                    <!--<td class="px-4 py-3 text-xs">-->
                    <!--  <span class="px-3 py-1 text-sm ">-->
                    <!--      @php  setlocale(LC_TIME, 'fr_FR');   @endphp-->
                    <!--     {{ucfirst(strftime('%B', strtotime($ventes->created_at)))}}-->
                    <!--  </span>-->
                    <!--</td>-->
                  </tr>
                  
                    @endif
                  @endif
                  
                @if( ($trimestre >= 7) && ($trimestre <= 9) )
                @if(  (date("m", strtotime($ventes->created_at)) >= 7) && (date("m", strtotime($ventes->created_at)) <= 9) )
                  <tr class="text-gray-700 dark:text-gray-400">

                    <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->

                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold"><a href="">
                                <h4>{{$ventes->prenom}} {{$ventes->nom}}  </h4>
                            </button>
                          <!--</div>-->
                        </div>
                    </td>
                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--  TOLGO-->
                    <!--</td>-->
                  
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        {{(number_format($ventes->montant)) ? number_format($ventes->montant) : '0'}} Fcfa
                      </span>
                    </td>
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                          @php  setlocale(LC_TIME, 'fr_FR');   @endphp
                         {{ucfirst(strftime('%B', strtotime($ventes->created_at)))}}
                      </span>
                    </td>
                  </tr>
                  
                      @endif
                  @endif
                  
                @if( ($trimestre >= 10) && ($trimestre <= 12) )
                @if(  (date("m", strtotime($ventes->created_at)) >= 10) && (date("m", strtotime($ventes->created_at)) <= 12) )
                  <tr class="text-gray-700 dark:text-gray-400">

                    <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <!--<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">-->

                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold"><a href="">
                                <h4>{{$ventes->prenom}} {{$ventes->nom}}  </h4>
                            </button>
                          <!--</div>-->
                        </div>
                    </td>
                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--  TOLGO-->
                    <!--</td>-->
                  
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        {{(number_format($ventes->montant)) ? number_format($ventes->montant) : '0'}} Fcfa
                      </span>
                    </td>
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                          @php  setlocale(LC_TIME, 'fr_FR');   @endphp
                         {{ucfirst(strftime('%B', strtotime($ventes->created_at)))}}
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