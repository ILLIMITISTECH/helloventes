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
           Liste des utilisateurs qui n'ont pas changé leur mot de passe par défaut
          </h2>
          <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
          <td class="px-4 py-3 text-sm">
                      <div class="align-middle" >
                        <!--<span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"  tabindex="0" style="margin-right : 10px;" data-toggle="tooltip" title="Alerter">-->
                        <form action="{{route('alerter_passwordNot_res')}}" method="post" id="target" class="form">
                            @csrf
                           <button data-toggle="tooltip" title="Envoyer un mail aux commerciaux" type="submit" class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-left: 5px;">
                               Rappel</button>
                        </form>
                        <!--</span>-->
                        </div>
                    </td>
           <br> <br>
           <td class="px-4 py-3 text-sm">
                      <div class="align-middle" >
                        <!--<span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"  tabindex="0" style="margin-right : 10px;" data-toggle="tooltip" title="Alerter">-->
                        <!--<form action="{{route('connexion_helloventes')}}" method="post" id="target" class="form">-->
                        <!--    @csrf-->
                        <!--   <button data-toggle="tooltip" title="Envoyer un mail aux commerciaux" type="submit" class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-left: 5px;">-->
                        <!--       Connexion</button>-->
                        <!--</form>-->
                        <!--</span>-->
                        </div>
                    </td>
           <br> <br>
          <div style = "margin-left: 600px; margin-top:-50px" > 
                                 <form action="{{route('securite_search_par_com_res')}}" method="get" style="margsearchfin-top:5px; display:flex;">
                                    <select name="searchCommerciau" style="width:220px;height:40px"  id="statut" style="margin-right:10px; display:flex;">
                                        <option value="" disabled selected>Rechercher par Commercial(e)</option>
                                        @php $moi = App\Commerciau::where('user_id', Auth::user()->id)->first();
                                        $commerciaux = DB::table('users')->where('change_password', '0')->where('superieur_id', $moi->id)->where('email', '!=', 'admin@gmail.com')->OrderBy('prenom')->get(); @endphp
                                        @foreach($commerciaux as $commerciau)
                                        <option value="{{$commerciau->id}}">{{$commerciau->prenom}} {{$commerciau->nom}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                    <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-left:10px;" type="submit">Filtrer</button>
                         </form> 
                            </div> 
                            <br>
             
                                       
          
            
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3">Commerciaux</th>
                    <!--<th class="px-4 py-3">statut</th>-->
                    <!--<th class="px-4 py-3">Dernière connexion</th>-->
                    <th class="px-4 py-3">Options</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach($commerciaux_password as $users) 
                @foreach($users as $user) 
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <td class="px-4 py-3 text-sm">
                      {{ ($user->prenom) ? $user->prenom : '-'}} {{ ($user->nom) ? $user->nom : '-'}}
                    </td>
                    
                    
                    
                    
                    <td class="px-4 py-3 text-sm">
                      <div class="align-middle" >
                        @php $com = $user->email;  @endphp
                        <!--<span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"  tabindex="0" style="margin-right : 10px;" data-toggle="tooltip" title="Alerter">-->
                        <form action="/sendmailalerter_password" method="post" id="target" class="form">
                           <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                           <input type="hidden" name="name" value="{{$user->prenom}}">
                           <input type="hidden" name="email" value="{{$com}}">
                           <input type="hidden" name="message" value="Modifier votre mot de passe par défaut">
                           <button data-toggle="tooltip" title="Alerter" type="submit" class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-left: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                            <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                            </svg></button>
                        </form>
                        <!--</span>-->
                        </div>
                    </td>
                   
                  </tr>

                </tbody>
                @endforeach
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