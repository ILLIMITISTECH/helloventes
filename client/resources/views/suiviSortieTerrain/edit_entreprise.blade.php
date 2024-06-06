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
                <!--Rechercher dans ILLIMITIS ILLIMITIS Christianna from ILLIMITIS Christianna from ILLIMITIS  Christianna from ILLIMITIS 11 h 20 ajouteropportunuit.txt-->

                <div class="container px-6 mx-auto grid">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                       Modifier les informations
                    </h2>
                    
                    <!-- General elements -->
             
                    <!-- Validation inputs -->
                    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <!-- Invalid input -->
                        <form action="{{route('entreprise.update', $entreprise->id)}}" method="post" class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload" enctype="multipart/form-data">
                                                     @csrf
                
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Nom entreprise 
                            </span>
                            <input name="nom_entreprise" type="text"  value="{{$entreprise->nom_entreprise}}"
                                class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                placeholder="Libellé de l'action" />
                        </label>
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Secteur d'activité :
                            </span>
                        </label>
                        @php $sec = DB::table('secteur_activites')->where('id', $entreprise->secteur_activite)->first(); @endphp
                        <select id="country" name="secteur_activite"
                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input">
                        @if($sec)    <option value="{{$entreprise->secteur_activite}}" >{{$sec->libelle}}</option>
                        @else <option value="" selected>Sélectionner le secteur d'activité</option>
                        @endif
                            @foreach($secteur as $secteurs)
                            <option value="{{$secteurs->id}}" >{{$secteurs->libelle}}</option>
                            @endforeach
                        </select>
                        
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Pays :
                            </span>
                        </label>
                        @php $pays = DB::table('pays')->where('id', $entreprise->pays_id)->first(); @endphp
                        <select id="country" name="pays_id"
                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input">
                        @if($pays)    <option value="{{$entreprise->pays_id}}" >{{$pays->libelle}}</option>
                        @else <option value="" selected>Sélectionner le pays</option>
                        @endif
                            @foreach($pay as $p)
                            <option value="{{$p->id}}" >{{$p->libelle}}</option>
                            @endforeach
                        </select>
                        
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Responsable :
                            </span>
                        </label>
                        @php $com = DB::table('commerciaus')->where('id', $entreprise->commercial_id)->first(); @endphp
                        <select id="country" name="commercial_id"
                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input">
                        @if($com)   <option value="{{$entreprise->commercial_id}}" >{{$com->prenom}} {{$com->nom}}</option>
                        @else <option value="" selected>Sélectionner le nouveau responsable </option>
                        @endif
                            @foreach($commercial as $commercials)
                            <option value="{{$commercials->id}}" >{{$commercials->prenom}} {{$commercials->nom}}</option>
                            @endforeach
                        </select>
                       
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Logo : (télécharger le logo)
                            </span>
                            <input name="logo" type="file"  value="{{$entreprise->logo}}"
                                class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                placeholder="Libellé de l'action" />
                        </label>
                    
                      <br>
                <div class="col-md-12">
                    <label for="inputState" class="form-label required">Le prospect est-il stratégique ? <b style="color:red;">*</b></label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="strategique" @if($entreprise->strategique === "1") checked @endif value="1" >
                      <label class="form-check-label" for="exampleRadios1">
                      Oui
                      </label>
                   </div>
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="strategique" @if($entreprise->strategique === "0") checked @endif value="0" >
                      <label class="form-check-label" for="exampleRadios2">
                      Non
                      </label>
                   </div> 
                    
                </div>
                <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                N° de téléphone
                            </span>
                            <input name="phone" type="text"  value="{{$entreprise->phone}}"
                                class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                placeholder="+2..." />
                        </label>
                           
                           
                           
                            <div style="margin-top: 3em;">
    
                                <button
                                    class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                    Mettre à jour
                                </button>
                                </form>
                                <a href="/lister_entreprises"> <button
                                    class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                    Annuler
                                </button></a>
                            </div>
                        
                    </div>
                    <!-- Inputs with icons -->
              
                </div>
                <!-- Réduire Envoyer un message Christianna from ILLIMITIS Maj+Retour pour ajouter une nouvelle ligne-->
        </div>
        </main>
    </div>
    </div>
                           
        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
    <script src="{{asset('v2/main.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>              
          
            <footer class="footer">
                © Made with love and Passion by <a href="https://www.illimitis.com/">ILLIMITIS</a>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('assets/plugins/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{asset('Koyalis/public/assets/js/init-alpine.js')}}"></script>
    <script src="{{asset('Koyalis/public/https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js')}}" defer></script>
    <script src="{{asset('Koyalis/public/assets/js/charts-lines.js')}}" defer></script>
    <script src="{{asset('Koyalis/public/assets/js/charts-pie.js')}}" defer></script>
</body>

</html>