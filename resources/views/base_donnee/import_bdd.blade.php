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
          
            <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
                                   
        <!--les formulaires-->
         <center>
        <div class="container px-6 mx-auto grid" id="box inner-shadow">
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" >
        
        <div id="professional-div">
            <h3 style="text-align: justify;">Consultez les images pour voir un exemple des informations que le fichier Excel à importer doit contenir. Veuillez noter qu'avant l'importation de votre fichier Excel, veuillez retirer la première ligne.
            </h3>
            
            <br>
            <img src="{{asset('images/cap1.jpg')}}">
            <img src="{{asset('images/cap2.jpg')}}">
            <br>
        </div>
          </h2>
          <!--<center>-->
          <!--     <p class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="margin-top:-20px; font-size:15px;">-->
          <!-- Exemple du fichier à importer-->
          <!--</p>-->
          <!--<img src="{{asset('images/exemple.png')}}" style="width:500px; height:200px;">-->
          <!--</center>-->
           <br>
                <center>
                    <form action="/import_bdd_store" method="post" enctype="multipart/form-data">
                        
                                @csrf
                                <div class="form-group mb-4" id="professional-div">
                                    <label><strong>Importer la base de donnees des prospects ici : </strong>
                                    <br>
                                        <small class="warning text-muted" id="blink"><strong>{{__('Veuillez sélectionner le fichier à télécharger. Assurez-vous de choisir uniquement des fichiers au format Excel (.xlsx ou .xls)')}}</strong></small>
                                        </label>
                                      <br>
                                    <div class="custom-file text-left">
                                        <br>
                                        <center>
                                        <input type="file" name="file" class="custom-file-input" placeholder="Sélectionner le fichier a importer" id="customFile" required>
                                        <label class="custom-file-label" for="customFile"></label>
                                        
                                        @if ($errors->has('file'))
                                           <p class="text-right mb-0">
                                               <small class="btn btn-danger" style="color:red;" id="file-error">{{ $errors->first('file') }}</small>
                                           </p>
                                       @endif
                                        </center>
                                    </div>
                                    <input type="hidden" name="commercial_id" value="{{$me->id}}" class="custom-file-input" id="customFile" required>
                                    <input type="hidden" name="superieur_id" value="{{$me->superieur_id}}" class="custom-file-input" id="customFile" required>
                                
                                <br>
                                <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="" type="submit">Importer la base de donnees
                                </button>
                               
                            </div>
                            </form>                     
                    </center>
                                    <br>

                                   <style>
#professional-div {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    background-color: #f7f7f7;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
    font-size: 16px;
    color: #333;
    text-align: center;
}

@keyframes blink {
        0% { opacity: 1; }
        50% { opacity: 0; }
        100% { opacity: 1; }
    }

    #blink {
        animation: blink 4s infinite;
        font-weight: bold;
    }

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
                                
                                </center>
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