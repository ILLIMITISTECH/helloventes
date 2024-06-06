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
            
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Mes actions
          </h2>
          <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
        
                            <div  class="col-md-3" style = "margin-top:-20px" align="right"> 
                                 <form action="{{route('search_op_action')}}" method="get">
                                    <select name="searchAction" style="width:220px;height:40px; margin-left:10px;"  id="opportunite">
                                        <option value="" disabled selected>Rechercher par opportunité</option>
                                      @php $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first(); @endphp
                                        @php $oppe = DB::table('opportunites')->OrderBy('libelle')->where('commercial_id', $commercial->id)->get();  @endphp
                                        @foreach($oppe as $oppor)
                                        <option value="{{$oppor->id}}">{{$oppor->libelle}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-left:10px;" type="submit">Filtrer</button>
                                </form> 
                            </div> 
                            <br>
        @if(count($actionCommercials) > 0) 
          <div class="w-full overflow-hidden rounded-lg shadow-xs" style = "margin-top:10px" >
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <!--<th class="px-4 py-3">#</th>-->
                        <th style="width:10%" class="px-0 py-1">Libelle</th>
                        <th style="width:10%" class="px-0 py-1">Deadline</th>
                        <th style="width:10%" class="px-0 py-1">Opportunités</th>
                        <th style="width:10%" class="px-0 py-1">Prospects</th>
                        <th style="width:10%" class="px-0 py-1">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    
                    @php $n=1; @endphp
                     @foreach($actionCommercials as $actionCommercial)
              
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <!--<td class="px-4 py-3 text-xs">-->
                    <!--  <span class="px-3 py-1 text-sm ">-->
                    <!--    {{$n++}}-->
                    <!--    </span>-->
                    <!--</td>-->
                    
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        {{$actionCommercial->libelle}}
                        </span>
                    </td>
                    
                      <td class="px-4 py-3 text-xs">
                    <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        {{($actionCommercial->deadline) ? $actionCommercial->deadline : '--'}}
                      </span>
                      </td>
                      
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        {{$actionCommercial->opportLibelle}}
                        </span>
                    </td>
                    
                  
                    <td class="px-4 py-3 text-xs">
                        <span class="px-3 py-1 text-sm ">
                            {{$actionCommercial->nom_entreprise}}
                        </span>
                    </td>
                    
                    <td class="px-4 py-3 text-sm">
                        <span
                            class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Modifier votre action">
                            <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"
                                href="{{route('action.show', $actionCommercial->id )}}">
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
                                href="{{route('cloturerAction', $actionCommercial->id )}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                                  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                  <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
                                </svg>
                            </a>
                        </span>
                    </td>
                 </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
           {{$actionCommercials->links()}}
        @if(isset($btnBlock))
        <div style="margin-top: 3em;">

            <a href="{{route('action.index')}}"
                class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Voir mes actions
            </a>
        </div>
        @endif
        </div>
         @else
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Vous n'avez pas d'actions disponibles !
                </span>
            </label>
            </div>
            @endif
        
            <!------------------------------------------------actions backup------------------------------------------------------------------->
            
            
            <br><br><br><br>
            
            
                      @php
                        $action_bakup = array();
                        $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
                        $op_backup = DB::table('opportunites')->where('commercial_backup', $commercial->id)->get();
                        foreach($op_backup as $opp_b){
                            $action_backup = DB::table('action_commerciales')->where('opportunite_id', $opp_b->id)->get();
                            array_push($action_bakup,$action_backup);
                        }
                      @endphp
            @if($action_bakup)
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Mes actions en backup
          </h2>
             @if(count($action_backup) > 0) 
          <div class="w-full overflow-hidden rounded-lg shadow-xs" style = "margin-top:10px" >
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <!--<th class="px-4 py-3">#</th>-->
                        <th style="width:10%" class="px-0 py-1">Libelle</th>
                        <th style="width:10%" class="px-0 py-1">Deadline</th>
                        <th style="width:10%" class="px-0 py-1">Opportunités</th>
                        <th style="width:10%" class="px-0 py-1">Prospects</th>
                        <th style="width:10%" class="px-0 py-1">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    
                    @php $n=1; @endphp
                     @foreach($action_backup as $action_backups)
             @php   
                $opp = DB::table('opportunites')->where('id', $action_backups->opportunite_id)->first();
                $prospect = DB::table('prospects')->where('id', $opp->prospect_id)->first();
             @endphp
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <!--<td class="px-4 py-3 text-xs">-->
                    <!--  <span class="px-3 py-1 text-sm ">-->
                    <!--    {{$n++}}-->
                    <!--    </span>-->
                    <!--</td>-->
                    
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        {{$action_backups->libelle}}
                        </span>
                    </td>
                    
                      <td class="px-4 py-3 text-xs">
                    <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        {{($action_backups->deadline) ? $action_backups->deadline : '--'}}
                      </span>
                      </td>
                      
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        {{$opp->libelle}}
                        </span>
                    </td>
                    
                  @if($prospect)
                    <td class="px-4 py-3 text-xs">
                        <span class="px-3 py-1 text-sm ">
                            {{$prospect->nom_entreprise}}
                        </span>
                    </td>
                    @else
                    <td class="px-4 py-3 text-xs">
                      --
                    </td>
                    @endif
                    <td class="px-4 py-3 text-sm">
                        <span
                            class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Modifier votre action">
                            <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"
                                href="{{route('action.show', $action_backups->id )}}">
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
                                href="{{route('cloturerAction', $action_backups->id )}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                                  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                  <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
                                </svg>
                            </a>
                        </span>
                    </td>
                 </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
           
        @if(isset($btnBlock))
        <div style="margin-top: 3em;">

            <a href="{{route('action.index')}}"
                class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Voir mes actions
            </a>
        </div>
        @endif
        </div>
         @else
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Vous n'avez pas d'actions en backup !
                </span>
            </label>
            </div>
            @endif
            
            @endif
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