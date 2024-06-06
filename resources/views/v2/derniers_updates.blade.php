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
            Qui n'utilise pas l'app
          </h2>
                         
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <!--<th class="px-4 py-3">Photo</th>-->
                    <th class="px-4 py-3">Commerciaux</th>
                    <th class="px-4 py-3">Dernière modification</th>
                    
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
               <?php
                                               $all_user_update = array();
                                               $commerciauss = DB::table('commerciaus')->get();
                                             ?>
                                                @foreach($commerciauss as $commerciaus)
                                                    @php
                                                        $action_last = DB::table('opportunites')->select('opportunites.updated_at','commerciaus.prenom', 'commerciaus.nom', 'users.photo')
                                                        ->join('commerciaus', 'opportunites.commercial_id', 'commerciaus.id')
                                                        ->join('users', 'commerciaus.user_id', 'users.id')
                                                        ->where('commerciaus.id', $commerciaus->id)->orderBy('opportunites.updated_at','DESC')
                                                        ->first();
                                                        if(!empty($action_last))
                                                            array_push($all_user_update, $action_last);
                                                    @endphp
                                                   
                                                @endforeach
                                                
                                                @php
                                                    array_multisort( array_column($all_user_update, "updated_at"), SORT_ASC, $all_user_update );
                                                @endphp
                                                 
                                            @foreach($all_user_update as $user)
                                                @if(intval(abs(strtotime("now") - strtotime($user->updated_at))/ 86400) >= 3)

                  <tr class="text-gray-700 dark:text-gray-400">
                   
                   
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
                          {{($user->prenom) ? $user->prenom : '-'}} {{ ($user->nom) ? $user->nom : '-'}} 
                          
                        </div>
                      </div>
                    </td>
                   
                    @if(intval(abs(strtotime("now") - strtotime($user->updated_at))/ 86400) >= 3 )
                                            <td class="px-4 py-3 text-xs">il y'a {{intval(abs(strtotime("now") - strtotime($user->updated_at))/ 86400)}} jours 
                                            </td>
                   
                   @endif
                @endif
                                               
                </tr>
            @endforeach

                </tbody>
             
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