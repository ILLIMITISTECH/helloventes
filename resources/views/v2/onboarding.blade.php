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

        <!--les formulaires-->
        <div class="container px-6 mx-auto grid">
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
           Onboarding
          </h2>
          
           <div style = "margin-left: 600px; margin-top:-50px" > 
                                 <form action="{{route('filtre_onboarding')}}" method="get" style="margsearchfin-top:5px; display:flex;">
                                    <select name="serachOn" style="width:220px;height:40px"  id="statut" style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par Commercial(e)</option>
                                        @php $commerciaux = DB::table('users')->where('email', '!=', 'admin@gmail.com')->OrderBy('prenom')->get(); @endphp
                                        @foreach($commerciaux as $commerciau)
                                        <option value="{{$commerciau->id}}">{{$commerciau->prenom}} {{$commerciau->nom}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                    <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-left:10px;" type="submit">Filtrer</button>
                         </form> 
                            </div> 
                            <br>
             <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
                                        @php $dnow = date('d'); $dnowH = date('H:i'); $hr = date('H'); $mnt = date('i') + 20; @endphp 
                                               
                               
                                        
                                            @php $nbrusers = DB::table('users')
                                            ->whereDay('last_online_at', $dnow)
                                            //->where('last_online_time', '=' ,$dnowH)
                                             ->where('heure', '=' ,$hr)
                                             ->where('minute', '<=' ,$mnt)
                                            ->where('last_online_at', '!=', null)
                                            ->where('email', '!=', 'admin@gmail.com')
                                            ->count(); 
                                            @endphp
                                            @php $nbruserss = DB::table('users')->where('email', '!=', 'admin@gmail.com')
                                                 ->orWhere('last_online_at', null)
                                                 ->where('heure', '!=', $hr)
                                                 ->count();
                                            
                                            $horsLigne = $nbruserss - $nbrusers ;
                                            $abs2 = gmp_abs($horsLigne);
                                            @endphp
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="row" style="display:flex; ">  
              	&nbsp;&nbsp; <tr>
                    <td>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-record-circle-fill" viewBox="0 0 16 16">
                          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-8 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                       
                        </svg> : <strong>{{$nbrusers}}</strong>
                       
                    </td>
                </tr>
                &nbsp;&nbsp;&nbsp;
                <tr>
                   <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-record-circle-fill" viewBox="0 0 16 16">
                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-8 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                  </svg> : <strong>{{gmp_strval($abs2)}}</strong></td>
               </tr>
            </div>
            
            
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3">Commerciaux</th>
                    <th class="px-4 py-3">statut</th>
                    <th class="px-4 py-3">Dernière connexion</th>
                    
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    
                    
                @foreach($users as $user) 
                @php $commerciauxf = DB::table('commerciaus')->where('user_id', $user->id)->first(); @endphp
                  <tr class="text-gray-700 dark:text-gray-400">
                   @if($commerciauxf)
                    <td class="px-4 py-3">

                      <div class="flex items-center text-sm">
                        
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                           @if($user->photo)
                          <img class="object-cover w-full h-full rounded-full"
                            src="{{ url('imgs/', $user->photo) }}"
                            alt="" loading="lazy" />
                            @else
                            <img class="object-cover w-full h-full rounded-full"
                            src="{{ asset('imgs/pp.png') }}"
                            alt="" loading="lazy" />
                            @endif
                          <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                        <div>
                          {{($commerciauxf->prenom) ? $commerciauxf->prenom : '-'}} {{ ($commerciauxf->nom) ? $commerciauxf->nom : '-'}} 
                          
                        </div>
                      </div>
                    </td>
                    @else
                     <td class="px-4 py-3 text-sm">
                     --
                    </td>
                    @endif
                    
                    @if($user->heure == $hr and $user->minute <= $mnt)
                    <td class="px-4 py-3 text-sm">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-record-circle-fill" viewBox="0 0 16 16">
                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-8 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    </svg>
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-record-circle-fill" viewBox="0 0 16 16">
                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-8 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    </svg>
                    </td>
                    @endif
                    
                     @if(intval(abs(strtotime("now") - strtotime($user->last_online_at))/ 86400) == 0)
                      @if(intval(abs(strtotime("now") - strtotime($user->last_online_at))/ 3600) > 0)
                    @if(intval(abs(strtotime("now") - strtotime($user->last_online_at))/3600) == 1)
                    <td class="px-4 py-3 text-sm">
                      il y'a {{intval(abs(strtotime("now") - strtotime($user->last_online_at))/3600)}} heure
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                    il y'a {{intval(abs(strtotime("now") - strtotime($user->last_online_at))/3600)}} heures
                    </td>
                    @endif
                      @else(intval(abs(strtotime("now") - strtotime($user->last_online_at))/ 3600) == 0)
                      <td class="px-4 py-3 text-sm">il y'a {{intval(abs(strtotime("now") - strtotime($user->last_online_at))/60)}} minutes</td>
                      @endif
                    @elseif(intval(abs(strtotime("now") - strtotime($user->last_online_at))/ 86400) == 1)
                    <td class="px-4 py-3 text-sm">Hier à {{strftime("%H:%M", strtotime($user->last_online_at))}}</td>
                    @elseif(intval(abs(strtotime("now") - strtotime($user->last_online_at))/ 86400) >= 2 && intval(abs(strtotime("now") - strtotime($user->last_online_at))/ 86400) <= 27)
                    <td class="text-nice">il y'a {{intval(abs(strtotime("now") - strtotime($user->last_online_at))/ 86400)}} jours </td>
                    @else(intval(abs(strtotime("now") - strtotime($user->last_online_at))/ 86400) > 27)
                    @if((strftime("%Y", strtotime($user->last_online_at))) == 1970 )
                    <td class="px-4 py-3 text-sm">Jamais</td>
                    @else
                    <td class="px-4 py-3 text-sm">Le {{strftime("%d/%m/%Y", strtotime($user->last_online_at))}}</td>
                    @endif
                    @endif
                    
                    
                   
                  </tr>

                </tbody>
                @endforeach
                
              </table>
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