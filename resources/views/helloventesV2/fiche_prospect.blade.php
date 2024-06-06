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
        <div class="container px-6 mx-auto grid">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Fiche de l’entreprise
              </h2>
           
              
               <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
          <div class="bg-light">
            <div class="container">
              <div class="row d-flex justify-content-center">
                <div class="row col-lg-12" style="display:flex;">
                    @php $pays = DB::table('pays')->where('id', $entreprise->pays_id)->first(); @endphp
                    <div style="border-radius: 1em; width:300px; height:350px; background-color:white;border: 1px solid
                        #c4c4c4;" class="col-sm-4 rounded-left">
                        <div class="card-block text-center text-white">
                          <i class=" fas fa-user-tie fa-7x mt-5"></i>
<br>
                          <h4 style="color:black">{{$entreprise->nom_entreprise}}</h4>
                          <i class="far fa-edit fa-2x mt-4"></i>
                            Details
                          <h4 style="color:black; text-align:left">Date importee : {{date('d/m/Y', strtotime($entreprise->created_at))}}</h4><br>
                          <h4 style="color:black; text-align:left" data-toggle="tooltip" title="{{$entreprise->secteur_activite}}">Secteur d'activite : {{($entreprise->secteur_activite) ? $entreprise->secteur_activite : 'Non renseigné'}}</h4>
                          <br>
                          @if($entreprise->site_web)<h4 style="color:black">Site web : {{$entreprise->site_web}}</h4>@endif
                          @if($pays)<br>
                          <h4 style="color:black; text-align:left">Pays : {{$pays->libelle}}</h4>
                          @endif
                       <br>
                    <a href="{{route('prospect_a_appeler.edit', $entreprise->id)}}"> 
                          <button style="width:180px"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                         Modifier 
                    </button> </a> 
                        </div>
                    </div>
                    
                    <div style="border-radius: 1em; width:750px; height:700px; background-color:white;border: 1px solid
                        #c4c4c4; margin-left:10px;" class="col-sm-4 rounded-left">
                        <div class="card-block text-center text-white">
                          <i class=" fas fa-user-tie fa-7x mt-5"></i>
                          <h4 style="color:black">Détails de l'entreprise</h4>
                          <i class="far fa-edit fa-2x mt-4"></i>
                          
                          <br>
                           <center>
                            <table>
                                <tr>
                                    <th>Contact entreprise</th>
                                    <th>Suggestion</th>
                                    <th>Numéro</th>
                                    <th>Besoins prioritaires</th>
                                    <th>Autres besoins</th>
                                    <!--<th>Pays</th> -->
                                </tr>
                                
                                <tr>
                                    <td>{{($entreprise->tel_fixe) ? $entreprise->tel_fixe : '-'}} <br> {{($entreprise->email_entreprise) ? $entreprise->email_entreprise : '-'}}</td>
                                    <td>{{($entreprise->solution_a_vendre) ? $entreprise->solution_a_vendre : '-'}} </td>
                                    <td>{{($entreprise->tel_contact) ? $entreprise->tel_contact : '-'}} </td>
                                    <td>{{($entreprise->autre_besoins) ? $entreprise->autre_besoins : '-'}}</td>
                                    <td>{{($entreprise->besoin_prioritaire) ? $entreprise->besoin_prioritaire : '-'}}</td>
                                   
                                </tr>
                            </table>
                            </center>

                          
                        </div>
                    </div>

                </div>
                
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