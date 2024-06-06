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
            @if(Auth::user()->nom_role == "responsable")
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Rendez vous de la semaine des commerciaux
          </h2>
          
           @php $commerciaux = DB::table('commerciaus')->get(); @endphp
          <div  class="col-md-3" style = "margin-top:5px" align="right" >
                                 <form action="{{route('plannings_resFiltre')}}" method="get" >
                                    <select name="commercialFiltre" style="width:220px;height:40px"  style="margin-right:10px; display:flex;" >
                                        <option value="" disabled selected>Rechercher par commerciaux</option>
                                       @foreach($commerciaux as $commerciauxss)
                                        <option value="{{$commerciauxss->id}}">{{$commerciauxss->prenom}} {{$commerciauxss->nom}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="" type="submit">Filtrer</button>
                                </form> 
                            </div>
                            
                            <br>
                           <div class="raison" align="right">
                    <a href="/res_raison" style="width:100px;"
                                class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Rendez-vous raisons
                            </a>
                 </div>
                 <br> 
             <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              	 @if($planning == null) 
                 	  <p>Pas de rendez-vous</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Commerciaux</th>
                    <th class="px-4 py-3">Libelle</th>
                    <th class="px-4 py-3">Entreprises</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Heure</th>
                    <th class="px-4 py-3">statut</th>
                    <!--<th class="px-4 py-3">Options</th>-->
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($planning as $plannings) 
                    @php 
                     $comm = DB::table('commerciaus')->where('id', $plannings->commercial_id)->first();
                     $pros = DB::table('prospects')->where('id', $plannings->prospect_id)->first(); 
                    @endphp
                  
                  <tr class="text-gray-700 dark:text-gray-400">
                    @if($comm)
                   <td class="px-4 py-3 text-sm">
                      {{ ($comm->prenom) ? $comm->prenom : ''}} {{ ($comm->nom) ? $comm->nom : ''}}
                    </td>
                    @else
                     <td class="px-4 py-3 text-sm">
                      non renseigné
                      <!--</a>-->
                    </td>
                    @endif
                    <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$plannings->libelle}}">
                      {{ ($plannings->libelle) ?  \Illuminate\Support\Str::limit($plannings->libelle, 45, $end='...') : 'non renseigné'}}
                    </td>
                    @if($pros)
                    <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$pros->nom_entreprise}}">
                      {{ strtoupper(($pros->nom_entreprise) ?  \Illuminate\Support\Str::limit($pros->nom_entreprise, 30, $end='...') : '')}}
                      <!--</a>-->
                    </td>
                    @else
                     <td class="px-4 py-3 text-sm">
                      non renseigné
                      <!--</a>-->
                    </td>
                    @endif
                    <td class="px-4 py-3 text-sm">
                      <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        {{ ($plannings->date) ? $plannings->date : ''}}
                      </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        {{ ($plannings->heure_debut) ? $plannings->heure_debut : ''}}
                      </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      @if($plannings->statut == 1)
                      <p style="color:green"> Fait </p>
                      @else
                      <p style="color:orange"> En cours.. </p>
                      @endif
                    </td>
                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--  {{ ($plannings->heure_debut) ? $plannings->heure_debut : ''}}-->
                    <!--</td>-->
                    
                  
                    
                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--<div style="display:flex ">-->
                        
                         
                    <!--     <span style="margin-left:3px; height:28px;"  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="modifier le planning">-->
                    <!--      <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('entreprise.edit', $plannings->id)}}" >-->
                    <!--          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">-->
                    <!--              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>-->
                    <!--              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>-->
                    <!--            </svg>-->
                    <!--        </a>-->
                    <!--    </span>-->
                    <!--<span style="margin-left:3px; height:28px;" class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Supprimer le planning">-->
                    <!--     <form action="{{ route('entreprise.destroy',$plannings->id) }}" method="POST">-->
                    <!--        @csrf-->
                    <!--        @method('DELETE')-->
                    <!--        <button type="submit" >-->
                    <!--        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">-->
                    <!--          <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>-->
                    <!--        </svg>-->
                    <!--        </button>-->
                        
                    <!--    </form>-->
                    <!--</span>-->
                    <!--</div>-->
                    <!--</td>-->
                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--  <input type="text" class="form-control" placeholder="+226 00 00 00 00" aria-label="Username"-->
                    <!--    aria-describedby="addon-wrapping">-->
                    <!--</td>-->
                  </tr>

                </tbody>
                @endforeach 
              </table>
            </div>
            
                 @endif
                 <!------------------------------------------------------------------------------------>
          <br> 
         
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Rendez-vous à venir des commerciaux
          </h2>
@if(count($planning_avenir) == 0)
                 	  <p></p>
					 @else
          
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Commerciaux</th>
                    <th class="px-4 py-3">Libelle</th>
                    <th class="px-4 py-3">Entreprises</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Heure</th>
                    <th class="px-4 py-3">statut</th>
                    <!--<th class="px-4 py-3">Options</th>-->
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($planning_avenir as $plannings_avenir) 
                    @php 
                     $comm = DB::table('commerciaus')->where('id', $plannings_avenir->commercial_id)->first();
                     $pros = DB::table('prospects')->where('id', $plannings_avenir->prospect_id)->first(); 
                    @endphp
                    
                  <tr class="text-gray-700 dark:text-gray-400">
                      @if($comm)
                   <td class="px-4 py-3 text-sm">
                      {{ ($comm->prenom) ? $comm->prenom : ''}} {{ ($comm->nom) ? $comm->nom : ''}}
                    </td>
                    @else
                     <td class="px-4 py-3 text-sm">
                      non renseigné
                      <!--</a>-->
                    </td>
                    @endif
                    <td class="px-4 py-3 text-sm"  data-toggle="tooltip" title="{{$plannings_avenir->libelle}}">
                      {{ ($plannings_avenir->libelle) ?  \Illuminate\Support\Str::limit($plannings_avenir->libelle, 25, $end='...')  : 'non renseigné'}}
                    </td>
                    @if($pros)
                    <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$pros->nom_entreprise}}">
                      {{ strtoupper(($pros->nom_entreprise) ? \Illuminate\Support\Str::limit($pros->nom_entreprise, 30, $end='...')  : '')}}
                      <!--</a>-->
                    </td>
                    @else
                     <td class="px-4 py-3 text-sm">
                      non renseigné
                      <!--</a>-->
                    </td>
                    @endif
                    <td class="px-4 py-3 text-sm">
                      <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        {{ ($plannings_avenir->date) ? $plannings_avenir->date : ''}} 
                      </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      {{ ($plannings_avenir->heure_debut) ? $plannings_avenir->heure_debut : ''}}
                    </td>
                    <td class="px-4 py-3 text-sm">
                      @if($plannings_avenir->statut == 1)
                      <p style="color:green"> Fait </p>
                      @else
                      <p style="color:orange"> En cours.. </p>
                      @endif
                    </td>
                    
                  </tr>

                </tbody>
                @endforeach 
              </table>
            </div>
<!---------------------------------------------------------------------------->
                 
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
        
        
        
        <!----------------------------------------------respon pole-------------------------------------------------------------------->
        @elseif(Auth::user()->nom_role == "responsable_pole")
         <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Planning de la semaine des commerciaux
          </h2>
         @php $commerciaux = DB::table('commerciaus')->where('domaine_id', $moi->domaine_id)->get(); @endphp
          <div  class="col-md-3" style = "margin-top:5px" align="right" >
                                 <form action="{{route('plannings_resFiltre')}}" method="get" >
                                    <select name="commercialFiltre" style="width:220px;height:40px"  style="margin-right:10px; display:flex;" >
                                        <option value="" disabled selected>Rechercher par commerciaux</option>
                                       @foreach($commerciaux as $commerciauxss)
                                        <option value="{{$commerciauxss->id}}">{{$commerciauxss->prenom}} {{$commerciauxss->nom}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='http://dev.koyalis.com/suivi_opportunites';" value >Toutes les opportunités</option>-->
                                    </select>
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="" type="submit">Filtrer</button>
                                </form> 
                            </div>
                            
                            <br>
                           <div class="raison" align="right">
                    <a href="/res_raison" style="width:100px;"
                                class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                les raisons
                            </a>
                 </div>
                 <br> 
             <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              	 @if($planning_pole == null) 
                 	  <p>Pas de planning</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Commerciaux</th>
                    <!--<th class="px-4 py-3">Libelle</th>-->
                    <th class="px-4 py-3">Entreprises</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Heure</th>
                    <th class="px-4 py-3">statut</th>
                    <!--<th class="px-4 py-3">Options</th>-->
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($planning_pole as $plannings_pole) 
                    @php 
                     $comm = DB::table('commerciaus')->where('id', $plannings_pole->commercial_id)->first();
                     $pros = DB::table('prospects')->where('id', $plannings_pole->prospect_id)->first(); 
                    @endphp
                  <tr class="text-gray-700 dark:text-gray-400">
                    @if($comm)
                   <td class="px-4 py-3 text-sm">
                      {{ ($comm->prenom) ? $comm->prenom : ''}} {{ ($comm->nom) ? $comm->nom : ''}}
                    </td>
                    @else
                     <td class="px-4 py-3 text-sm">
                      non renseigné
                      <!--</a>-->
                    </td>
                    @endif
                    <!--<td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$plannings_pole->libelle}}">-->
                    <!--  {{ ($plannings_pole->libelle) ?  \Illuminate\Support\Str::limit($plannings_pole->libelle, 45, $end='...') : 'non renseigné'}}-->
                    <!--</td>-->
                    @if($pros)
                    <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$pros->nom_entreprise}}">
                      {{ strtoupper(($pros->nom_entreprise) ?  \Illuminate\Support\Str::limit($pros->nom_entreprise, 30, $end='...') : '')}}
                      <!--</a>-->
                    </td>
                    @else
                     <td class="px-4 py-3 text-sm">
                      non renseigné
                      <!--</a>-->
                    </td>
                    @endif
                    <td class="px-4 py-3 text-sm">
                      <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        {{ ($plannings_pole->date) ? $plannings_pole->date : ''}}
                      </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        {{ ($plannings_pole->heure_debut) ? $plannings_pole->heure_debut : ''}}
                      </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      @if($plannings_pole->statut == 1)
                      <p style="color:green"> Fait </p>
                      @else
                      <p style="color:orange"> En cours.. </p>
                      @endif
                    </td>
                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--  {{ ($plannings_pole->heure_debut) ? $plannings_pole->heure_debut : ''}}-->
                    <!--</td>-->
                    
                  
                    
                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--<div style="display:flex ">-->
                        
                         
                    <!--     <span style="margin-left:3px; height:28px;"  class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="modifier le planning">-->
                    <!--      <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('entreprise.edit', $plannings_pole->id)}}" >-->
                    <!--          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">-->
                    <!--              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>-->
                    <!--              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>-->
                    <!--            </svg>-->
                    <!--        </a>-->
                    <!--    </span>-->
                    <!--<span style="margin-left:3px; height:28px;" class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Supprimer le planning">-->
                    <!--     <form action="{{ route('entreprise.destroy',$plannings_pole->id) }}" method="POST">-->
                    <!--        @csrf-->
                    <!--        @method('DELETE')-->
                    <!--        <button type="submit" >-->
                    <!--        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">-->
                    <!--          <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>-->
                    <!--        </svg>-->
                    <!--        </button>-->
                        
                    <!--    </form>-->
                    <!--</span>-->
                    <!--</div>-->
                    <!--</td>-->
                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--  <input type="text" class="form-control" placeholder="+226 00 00 00 00" aria-label="Username"-->
                    <!--    aria-describedby="addon-wrapping">-->
                    <!--</td>-->
                  </tr>

                </tbody>
                @endforeach 
              </table>
            </div>
            
                 @endif
                 <!------------------------------------------------------------------------------------>
          <br> 
          
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Planning à venir des commerciaux
          </h2>
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
@if(count($planning_avenir_pole) == 0)
                 	  <p>Pas de planning à venir</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Commerciaux</th>
                    <!--<th class="px-4 py-3">Libelle</th>-->
                    <th class="px-4 py-3">Entreprises</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Heure</th>
                    <th class="px-4 py-3">statut</th>
                    <!--<th class="px-4 py-3">Options</th>-->
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($planning_avenir_pole as $plannings_pole_avenir) 
                    @php 
                     $comm = DB::table('commerciaus')->where('id', $plannings_pole_avenir->commercial_id)->first();
                     $pros = DB::table('prospects')->where('id', $plannings_pole_avenir->prospect_id)->first(); 
                    @endphp
                  <tr class="text-gray-700 dark:text-gray-400">
                      @if($comm)
                   <td class="px-4 py-3 text-sm">
                      {{ ($comm->prenom) ? $comm->prenom : ''}} {{ ($comm->nom) ? $comm->nom : ''}}
                    </td>
                    @else
                     <td class="px-4 py-3 text-sm">
                      non renseigné
                      <!--</a>-->
                    </td>
                    @endif
                    <!--<td class="px-4 py-3 text-sm"  data-toggle="tooltip" title="{{$plannings_pole_avenir->libelle}}">-->
                    <!--  {{ ($plannings_pole_avenir->libelle) ?  \Illuminate\Support\Str::limit($plannings_pole_avenir->libelle, 25, $end='...')  : 'non renseigné'}}-->
                    <!--</td>-->
                    @if($pros)
                    <td class="px-4 py-3 text-sm" data-toggle="tooltip" title="{{$pros->nom_entreprise}}">
                      {{ strtoupper(($pros->nom_entreprise) ? \Illuminate\Support\Str::limit($pros->nom_entreprise, 30, $end='...')  : '')}}
                      <!--</a>-->
                    </td>
                    @else
                     <td class="px-4 py-3 text-sm">
                      non renseigné
                      <!--</a>-->
                    </td>
                    @endif
                    <td class="px-4 py-3 text-sm">
                      <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        {{ ($plannings_pole_avenir->date) ? $plannings_pole_avenir->date : ''}} 
                      </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      {{ ($plannings_pole_avenir->heure_debut) ? $plannings_pole_avenir->heure_debut : ''}}
                    </td>
                    <td class="px-4 py-3 text-sm">
                      @if($plannings_pole_avenir->statut == 1)
                      <p style="color:green"> Fait </p>
                      @else
                      <p style="color:orange"> En cours.. </p>
                      @endif
                    </td>
                    
                  </tr>

                </tbody>
                @endforeach 
              </table>
            </div>
<!---------------------------------------------------------------------------->
                 
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
        @endif
        <!---------------------------------------------end pole------------------------------------------------------------>
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