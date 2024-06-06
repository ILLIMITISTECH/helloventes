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
                <!--Rechercher dans ILLIMITIS ILLIMITIS Christianna from ILLIMITIS Christianna from ILLIMITIS  Christianna from ILLIMITIS 11 h 20 ajouteropportunuit.txt-->

                <div class="container px-6 mx-auto grid">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        {{$pgTitle}}
                    </h2>
                    <!-- General elements -->
                    <h6>
                     @if (session('message'))
                        <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                         {{ session('message') }}
                        </div>  
                      @endif
                      </h2>
                      <br>
                    <!-- Validation inputs -->
                    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                         <span class="text-gray-700 dark:text-gray-400">
        Opportunité : <b> {{$opportunite->libelle}}</b>
    </span>
    <br><br>
  
                        <!-- Invalid input -->
                          <form action="/ajout_prospections" enctype="multipart/form-data" method="post" class="form-horizontal" id="demo1-upload" >
                    {{ csrf_field() }}
                    
                    
                    
                        <div class="form-group" style="display:flex;">
                            
                            <div class="form-control">
                             <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">
                                    Libellé  (<span style=" color:red;">*</span>)
                                </span>
                            </label>
                           <input  name="libelle" type="text" 
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"
                                            style="width:400px; "  />
                            </div>
                            <div class="form-control">
                                  @php
                                        $today = date('Y-m-d');
                                  @endphp
                                      <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400" style="margin-left:50px;">
                                          Date (<span style=" color:red;">*</span>)
                                        </span> 
                                        <input  name="date" type="date" value="{{$today}}"
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"
                                             style="width:400px; margin-left:50px;"  />
                                    </label>
                            </div>
                            
                            <!--<div class="form-control">-->
                            <!-- <label class="block text-sm" style="margin-left:50px;">-->
                            <!--    <span class="text-gray-700 dark:text-gray-400">-->
                            <!--        c’est une sortie terrain ?-->
                            <!--    </span >-->
                            <!--</label>-->
                            <!--<select id="country" name="type" -->
                            <!--    class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input form-control" style="width:400px; margin-left:50px;">-->
                            <!--    <option value="oui">Oui</option>-->
                            <!--     <option value="non">Non</option>-->
                               
                            <!--</select>-->
                            <!--</div>-->
                            
                        </div>
                    
                        <div class="form-group" style="display:flex;">
                            
                            <div class="form-control">
                            <!-- <label class="block text-sm">-->
                            <!--    <span class="text-gray-700 dark:text-gray-400">-->
                            <!--        Prospect (<span style=" color:red;">*</span>)-->
                            <!--    </span>-->
                            <!--</label>-->
                          <input type="hidden" name="prospect_id" value="{{$opportunite->prospect_id}}"
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                            placeholder="DD/MM/YYYY" style="width:400px;" />
                          <input type="hidden" name="opportunite_id" value="{{$opportunite->id}}"
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                            placeholder="DD/MM/YYYY" style="width:400px;" />
                            </div>
                             <div class="form-control">
                                    <label class="block text-sm" >
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Heure 
                                        </span> (<span style=" color:red;">*</span>)
                                        <input type="time" name="heure_debut" required
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                            placeholder="DD/MM/YYYY" style="width:400px;" />
                                    </label>
                            </div>
                            
                            
                        </div>
                        
                          <!--<br>-->
                      
                    </div>     
                <div class="col-md-12">
               
               
              
                       <!--<div id="newRow"></div>
                        <button id="addRow" type="button" class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="background-color:#1561a2; color:white">Ajouter plus</button>
                            -->
                            <div style="margin-top: 3em;">
                            <button type="submit"
                                class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Valider
                            </button>
                            </form>
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