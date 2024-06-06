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

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 90%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
  color: black;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
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
            <!--<span style="width:90px; margin-left:30px" class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Retour">-->
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
            <!--</span>-->
        <div class="container px-6 mx-auto grid">
              <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Détail de l'opportunité
              </h2>
              
              <!--<a href="/suivi_opportunites"> -->
              <!--            <button style="width:100px; margin-bottom:20px; margin-left:900px"-->
              <!--          class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">-->
              <!--           Retour -->
              <!--      </button> </a> -->
          <div class="bg-light">
            <div class="container">
              <div class="row d-flex justify-content-center">
                <div class="row col-lg-12" style="display:flex;">
                     @php $prospect = DB::table('prospects')->where('id', $op->prospect_id)->first(); 
                        $proba = $op->probabilite;
                        $proba_pourcen = $proba / 100;
                        $ob_vente = $op->objectif_de_vente;
                        $valleure = $ob_vente * $proba_pourcen ;
                     @endphp
                    <div style="border-radius: 1em; width:400px; background-color:white;border: 1px solid
                        #c4c4c4;" class="col-sm-4 rounded-left">
                        <div class="card-block text-white" style="margin-top:20px;margin-left:20px">
                          <i class=" fas fa-user-tie fa-7x mt-5"></i>
                        
                          <h4 style="color:black"><b>Opportunité :</b> {{$op->libelle}}</h4><br>
                          @if($prospect)<h4 style="color:black"><b>Prospect :</b> {{($prospect->nom_entreprise) ? $prospect->nom_entreprise : '-'}}</h4><br>@endif
                          <h4 style="color:black"><b>Objectif de vente : </b>{{(number_format($op->objectif_de_vente)) ? number_format($op->objectif_de_vente) : '0'}} Fcfa</h4><br>
                          <h4 style="color:black"><b>Valleure actuelle : </b>{{(number_format($valleure)) ? number_format($valleure) : '0'}} Fcfa</h4><br>
                          <h4 style="color:black"><b>Concurrents : </b>{{($op->concurrence) ? $op->concurrence : '--'}} </h4><br>
                          <h4 style="color:black"><b>Notes : </b>{{($op->notes) ? $op->notes : '--'}} </h4>
                         
                          
                        </div>
                    </div>
                    
                    <div style="border-radius: 1em; width:600px;  background-color:white;border: 1px solid
                        #c4c4c4; margin-left:10px;" class="col-sm-4 rounded-left">
                        <div class="card-block text-center text-white">
                          <i class=" fas fa-user-tie fa-7x mt-5"></i>
                          <h4 style="color:black">Les contacts</h4>
                          <i class="far fa-edit fa-2x mt-4"></i>
                          
                          <br>
                           <center>
                            <table>
                                @php $contacts = DB::table('contacts')->where('opportunite_id', $op->id)->get();  @endphp
                              <tr>
                                <th>Prénom et Nom</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Fonction</th>
                              </tr>
                            @foreach($contacts as $contact)
                            @if($contact)
                              <tr>
                                <td>{{$contact->prenom}}</td>
                                <td>{{$contact->email}}</td>
                                <td>{{$contact->phone}}</td>
                                <td>{{$contact->responsabilite}}</td>
                              </tr>
                            @endif
                            @endforeach
                            
                            </table>
                             <br>
                            </center>

                          
                        </div>
                    </div>

                </div>
                
              </div>
            </div>
          </div>
          <br> <br>

            <h3 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Toutes mes actions
          </h3>
          <!-- New Table -->
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              @php $actions = DB::table('action_commerciales')->where('opportunite_id', $op->id)->get();  @endphp
              @if($actions->isEmpty()) 
                 	  <p>Pas d'action</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Opportuniteﾌ《</th>-->
                    <th class="px-4 py-3">Actions</th>
                    <th class="px-4 py-3">Deadline</th>
                    <th class="px-4 py-3">Statut</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach($actions as $action)
                    @if($action)
                  <tr class="text-gray-700 dark:text-gray-400">
                    <!--<td class="px-4 py-3">-->

                    <!--  <div class="flex items-center text-sm">-->
                       
                    <!--    <div>-->
                    <!--      <button type="button" class="btn btn-primary btn-lg btn-block font-semibold"><a-->
                    <!--          href="../public/forms.html">Art du Focus-->
                    <!--        </a></button>-->
                    <!--    </div>-->
                    <!--  </div>-->
                    <!--</td>-->
                    <td class="px-4 py-3 text-sm">
                      <span class="btn btn-primary btn-lg btn-block font-semibold">
                        {{($action->libelle) ? $action->libelle : ''}}
                      </span>
                    </td>
                    <td class="px-4 py-3 text-xs">
                      <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        {{($action->deadline) ? $action->deadline : ''}}
                      </span>
                    </td>
                    <td class="text-gray-700 dark:text-gray-400">
                      @if($action->cloture == 0)
                      <p style="color:orange"> En cours </p>
                      @else
                      <p style="color:green"> Fait </p>
                      @endif
                    </td>

                  </tr>
                  @endif
                  @endforeach

                </tbody>
              </table>
            </div>
            @endif
            <div
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