<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KOYALIS</title>
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
                       Ajouter les actions suivi
                    </h2>
                    <!-- General elements -->
                     @if (session('message'))
                        <div class="alert alert-success" style="background-color:B0F2B6" role="alert">
                         {{ session('message') }}
                        </div>  
                      @endif
                    <!-- Validation inputs -->
                    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <!-- Invalid input -->
                         <form action="{{route('opportunites.store')}}" enctype="multipart/form-data" method="post" class="form-horizontal" id="demo1-upload" >
                            {{ csrf_field() }}
                            
                        <!-- Invalid input -->
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Client/Prospect
                            </span>
                        </label>
                        <select id="country" name="country"
                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input">
                            <option value="1">Roland KYEDREBEOGO</option>
                            <option value="2">Axel NONGUIERMA</option>
                            <option value="3">Margareth ORANGO</option>
                            <option value="4">Christianna MAISHAL</option>
                            <option value="5">Salome SABANGLE</option>
                            <option value="6">Gnagan DIAGNE</option>
                            <option value="7">Fallou GUEYE </option>
                        </select>
                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Opportunités
                            </span>
                            <input
                                class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"
                                placeholder="Art du focus Priorité - Éfficacité - Productivité" />
                        </label>

                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Date de début
                            </span>
                            <input type="date"
                                class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                placeholder="DD/MM/YYYY" />
                        </label>
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Client/Prospect
                            </span>
                        </label>
                        <select id="country" name="country"
                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input">
                            <option value="australia">ÉCOBANK SN</option>
                            <option value="canada">SONATEL ORANGE</option>
                            <option value="usa">OLAM</option>
                            <option value="australia">UBA Côte d'Ivoire </option>
                            <option value="canada">PLAN INTERNATIONAL</option>
                            <option value="usa">SUNU Assurances Vies</option>
                            <option value="australia">CVA Logistics SN </option>
                            <option value="canada">SODACOM</option>
                            <option value="usa">CoRNT / GIZ (Mauritanie)</option>
                        </select>

                        <!-- Valid input -->

                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Client/Prospect
                            </span>
                        </label>
                        <label>
                            <select id="country" name="country"
                                class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input">
                                <option value="australia">Fait</option>
                                <option value="canada">Pas fait</option>
                            </select>
                        </label>
                            <div style="margin-top: 3em;">
    
                                <button
                                    class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                    Valider
                                </button>
                            </div>
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