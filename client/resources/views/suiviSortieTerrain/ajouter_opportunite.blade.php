<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hello ventes</title>
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
                        Ajouter une opportunité
                    </h2>
                    <!-- General elements -->
        <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
                    <!-- Validation inputs -->
                    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <!-- Invalid input -->
                         <form action="{{route('opportunites.store')}}" enctype="multipart/form-data" method="post" class="form-horizontal" id="demo1-upload" >
                    {{ csrf_field() }}
                    
                        <div class="form-group" style="display:flex;">
                            
                            <div class="form-control">
                             <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">
                                    Prospect (<span style=" color:red;">*</span>)
                                </span>
                            </label>
                            <select id="country" name="prospect_id" required
                                class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input form-control" style="width:400px;">
                                <option value="" >Selectionner le prospect</option>
                                @foreach($prospect as $prospects)
                                    <option value="{{$prospects->id}}">{{$prospects->nom_entreprise}}</option>
                                @endforeach
                            </select>
                            </div>
                            
                            <div class="form-control">
                             <label class="block text-sm" style="margin-left:50px;">
                                <span class="text-gray-700 dark:text-gray-400">
                                    Origine de l'opportunité (<span style=" color:red;">*</span>)
                                </span >
                            </label>
                            <select id="country" name="origine_id" required
                                class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input form-control" style="width:400px; margin-left:50px;">
                                <option value="" disabled selected >Selectionner l'origine</option>
                                @foreach($origine as $origines)
                                    <option value="{{$origines->id}}">{{$origines->libelle}}</option>
                                @endforeach
                            </select>
                            </div>
                            
                        </div>
                        
                          <br>
                        <div class="form-group" style="display:flex;">
                            
                            
                             
                              <div class="form-control">
                                  @php $deadline = date('Y-m-d'); 
                                        $today = now();
                $strotime_deadline = strtotime($today .'+' . 30 . ' days');
                $date_deadline = date('Y-m-d', $strotime_deadline);
                                  @endphp
                                      <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                          Deadline
                                        </span> 
                                        <input  name="deadline" type="date" value="{{$date_deadline}}"
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"
                                            style="width:400px; "  />
                                    </label>
                            </div>
                            
                            <div class="form-control">
                                    <label class="block text-sm" style="margin-left:40px;">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Statut de l'opportunité
                                        </span> (<span style=" color:red;">*</span>)
                                    </label>
                                    <select id="country" name="statut" required style="margin-left:40px; width:400px;"
                                        class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input" >
                                        <option value="" disabled selected >Sélectionner le statut</option>
                                        @foreach($statut as $statuts)
                                            <option value="{{$statuts->id}}">{{$statuts->libelle}}</option>
                                        @endforeach
                                    </select>
                            </div>
                                    
                            <br>
                        </div>
                       
                         <br>
                         <div class="form-group" style="display:flex;">
                            
                            <div class="form-control">
                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Libellé (<span style=" color:red;">*</span>)
                                        </span>
                                        <input name="libelle" type="text" required
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                            placeholder="Saisir le libellé de l'opportunité" style="width:400px;" />
                                    </label>
                            </div>
                            <!--<div class="form-control">-->
                            <!--        <label class="block text-sm" style="margin-left:50px;">-->
                            <!--            <span class="text-gray-700 dark:text-gray-400">-->
                            <!--                Date de début-->
                            <!--            </span> (<span style=" color:red;">*</span>)-->
                            <!--            <input type="date" name="date_debut" required-->
                            <!--                class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"-->
                            <!--                placeholder="DD/MM/YYYY" style="width:400px;" />-->
                            <!--        </label>-->
                            <!--</div>-->
                        <!--</div>-->
                        
                        
                        <!-- <br>-->
                        <!--<div class="form-group" style="display:flex;">-->
                            
                            <!--<div class="form-control">-->
                                    
                            <!--        <label class="block text-sm">-->
                            <!--            <span class="text-gray-700 dark:text-gray-400">-->
                            <!--                Deadline-->
                            <!--            </span> (<span style=" color:red;">*</span>)-->
                            <!--            <input type="date" name="deadline" required-->
                            <!--                class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"-->
                            <!--                placeholder="DD/MM/YYYY" style="width:400px;"/>-->
                            <!--        </label>-->
                            <!--</div>-->
                                    
                            <div class="form-control">
                                      <label class="block text-sm" style="margin-left:50px;width:400;">
                                        <span class="text-gray-700 dark:text-gray-400">
                                           Objectif de vente
                                        </span> (<span style=" color:red;">*</span>)
                                        <input  name="objectif_de_vente" type="number" required
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"
                                            placeholder="Ex: 500000" style="width:400px; " min="0" id="only_numbers" on oninput="digitsOnly();" />
                                    </label>
                            </div> <br>
                        </div>
                        
                         <br>
                         
                         
                         
                          <div class="form-group" style="display:flex;">
                            
                            <div class="form-control">
                                    
                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Concurrents potentiels sur cette opportunité
                                        </span> 
                                        <input type="text" name="concurrence" 
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                            style="width:400px;"/>
                                    </label>
                            </div>
                                    
                            <label class="block text-sm" style="margin-left:40px;">
                            <span class="text-gray-700 dark:text-gray-400" style="margin-left:10px;">
                                Notes : (télécharger le fichier)
                            </span>
                            <input name="notes" type="file" 
                                class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                 />
                        </label><br>
                        </div>
                        
                         <!--<br>-->
                         
                        <div class="form-group" style="display:flex;">
                            
                            
                        <!--<div class="form-control">-->
                        <!--<label class="block mt-4 text-sm">-->
                        <!--    <span class="text-gray-700 dark:text-gray-400">-->
                        <!--        Probabilité :  (<span style=" color:red;">*</span>) <span id="demo" class="px-2 py-1 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"></span>-->
                        <!--    </span>-->
                        <!--     <input type="range" name="probabilite" class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 form-range" required-->
                        <!--        min="0" max="100" value="0" step="10"  id="customRange3" style="width:400px; margin-left:10px;">-->
                        <!--</label>-->
                        <!--</div>-->
                        <div class="form-control">
                                    <label class="block text-sm" >
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Backup
                                        </span> 
                                    </label>
                                    <select id="country" name="commercial_backup"  style="width:400px;"
                                        class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input" >
                                        <option disabled selected >Sélectionner le backup</option>
                                        @foreach($backup as $backups)
                                         @if(Auth::user()->email != $backups->email)
                                            <option value="{{$backups->id}}">{{$backups->prenom}} {{$backups->nom}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                            </div>
                                    
                            <br>          
                            
                        

                        <!-- Valid input -->

                    </div>     
                    
                      
                      <br>
                <div class="col-md-12">
                    <label for="inputState"  class="form-label required dark:text-gray-400">Maintenez-vous les points focaux de cette entreprises ?<b style="color:red;">*</b></label>
                    
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="contact" value="1" id="proj" >
                      <label class="form-check-label dark:text-gray-400" for="exampleRadios2">
                      Oui
                      </label>
                   </div> 
                   <div class="form-check">
                      <input class="form-check-input dark:text-gray-400" type="radio" name="contact" value="0" id="projnon" checked >
                      <label class="form-check-label dark:text-gray-400" for="exampleRadios1">
                      Non
                      </label>
                   </div>
                   
                    
                </div>
                <br> 
                <div class="col-md-12">
               
               
                <div class="row" id="selectProjet">
                          <h5 class="card-title dark:text-gray-400">Contact principal (<span style=" color:red;">*</span>)</h5>
                    <div class="input-group row col-lg-12" style=" display:flex;">
                        <div class="col-lg-2">
                            <label for="inputEmail4" style="font-size:14px; width:400px" class="form-label dark:text-gray-400 ">Prénom </label> (<span style=" color:red;">*</span>)
                            <input type="text" name="prenom[]"  style=" width:190px;"  
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Prenom" id="inputEmail4"  > 
                        </div> &nbsp; &nbsp;
                        <div class="col-md-2">
                            <label for="inputEmail4" style="font-size:14px;" class="form-label dark:text-gray-400 ">Nom </label>(<span style=" color:red;">*</span>)
                            <input type="text" name="nom[]" style=" width:190px;" 
                                     class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Nom" id="inputEmail4" >
                        </div>  &nbsp; &nbsp;
                        <div class="col-md-3">
                            <label for="inputEmail4" style="font-size:14px;" class="form-label dark:text-gray-400 ">Email </label>
                            <input type="email" name="email[]" placeholder="Example@gmail.com" style=" width:200px;" 
                                     class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" 

                            id="inputEmail4"  >
                        </div>&nbsp; &nbsp;
                        <div class="col-md-3">
                            <label for="inputEmail4" style="font-size:14px;" class="form-label dark:text-gray-400 ">Téléphone </label>
                            <input type="text" name="phones[]" placeholder="+1.." style=" width:200px;" 
                                     class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" 

                            id="inputEmail4"  >
                        </div>&nbsp; &nbsp;
                        <div class="col-md-2">
                            <label for="inputEmail4" style="font-size:14px;" class="form-label dark:text-gray-400 ">Fonction </label>
                            <input type="text" name="responsabilite[]" placeholder="Responsabilité" style=" width:200px;" 
                                     class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" 

                            id="inputEmail4"  >
                        </div>
                        
                    </div>
                    <br>
             <h5 class="card-title dark:text-gray-400">Contact secondaire</h5>
                    <div class="input-group row col-lg-12" style=" display:flex;">
                        <div class="col-lg-2">
                            <label for="inputEmail4" style="font-size:14px; width:190px" class="form-label dark:text-gray-400 ">Prénom :</label>
                            <input type="text" name="prenom[]"  style=" width:200px;" 
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Prenom" id="inputEmail4" > 
                        </div> &nbsp; &nbsp;
                        <div class="col-md-2">
                            <label for="inputEmail4" style="font-size:14px;" class="form-label dark:text-gray-400 ">Nom :</label>
                            <input type="text" name="nom[]" style=" width:190px;" 
                                     class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Nom"

                            id="inputEmail4" >
                        </div> &nbsp; &nbsp;
                        <div class="col-md-3">
                            <label for="inputEmail4" style="font-size:14px;" class="form-label dark:text-gray-400 ">Email :</label>
                            <input type="email" name="email[]" placeholder="Example@gmail.com" style=" width:200px;" 
                                     class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" 

                            id="inputEmail4" >
                        </div>&nbsp; &nbsp;
                        <div class="col-md-3">
                            <label for="inputEmail4" style="font-size:14px;" class="form-label dark:text-gray-400 ">Téléphone : </label>
                            <input type="text" name="phones[]" placeholder="+1..." style=" width:200px;" 
                                     class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" 

                            id="inputEmail4" >
                        </div>&nbsp; &nbsp;
                        <div class="col-md-2">
                            <label for="inputEmail4" style="font-size:14px;" class="form-label dark:text-gray-400 ">Fonction :</label>
                            <input type="text" name="responsabilite[]" placeholder="Responsabilité" style=" width:200px;" 
                                     class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" 

                            id="inputEmail4" >
                        </div>
                        
                    </div>
                               @php $sta = DB::table('statut_opportunites')->get(); @endphp
            </div>
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
                    </div>
                    <!-- Inputs with icons -->
               @php $stas = DB::table('statut_opportunites')->get(); @endphp
                </div>
                <!-- Réduire Envoyer un message Christianna from ILLIMITIS Maj+Retour pour ajouter une nouvelle ligne-->
        </div>
        </main>
    </div>
    </div>
  <script>
                                    // Example starter JavaScript for disabling form submissions if there are invalid fields
                                    (function() {
                                        'use strict';
                                        window.addEventListener('load', function() {
                                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                            var forms = document.getElementsByClassName('needs-validation');
                                            // Loop over them and prevent submission
                                            var validation = Array.prototype.filter.call(forms, function(form) {
                                                form.addEventListener('submit', function(event) {
                                                    if (form.checkValidity() === false) {
                                                        event.preventDefault();
                                                        event.stopPropagation();
                                                    }
                                                    form.classList.add('was-validated');
                                                }, false);
                                            });
                                        }, false);
                                    })();
                                </script>
                           
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
    <script>
    
  function digitsOnly(){
    // extract only numbers from input    
    var num_val = $('#only_numbers').val().match(/\d+/);
         $('#only_numbers').val(num_val);
    } 
   
        document.getElementById("only_numbers").addEventListener("change", function() {
  let v = parseInt(this.value);
  if (v < 0) this.value = 0;
});
    </script>
<script src="{{asset('v2/main.js')}}"></script>
<script>
jQuery(document).ready(function() {   
   FormValidation.init();
});
    $(function() {
        $(".datepicker").datepicker();
        $(".uniform_on").uniform();
        $(".chzn-select").chosen();
        $('.textarea').wysihtml5();
        $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index+1;
            var $percent = ($current/$total) * 100;
            $('#rootwizard').find('.bar').css({width:$percent+'%'});
            // If it's the last tab then hide the last button and show the finish instead
            if($current >= $total) {
                $('#rootwizard').find('.pager .next').hide();
                $('#rootwizard').find('.pager .finish').show();
                $('#rootwizard').find('.pager .finish').removeClass('disabled');
            } else {
                $('#rootwizard').find('.pager .next').show();
                $('#rootwizard').find('.pager .finish').hide();
            }
        }});
        $('#rootwizard .finish').click(function() {
            alert('Finished!, Starting over!');
            $('#rootwizard').find("a[href*='tab1']").trigger('click');
        });
    });
    </script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   

               
            </div>
          
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
 
    		y


       <script type="text/javascript">
            // add row
            $("#addRow").click(function () {
                var html = '';
                
            
                        html += '   <div class="remove">';
                       html += '  </br> <center><h5 style="font-size:20px;" class="card-title"><b>Ajouter une autre opportunité</b></h5></center></br> ';
                     html += '   <label class="block text-sm">';
                       html += '     <span class="text-gray-700 dark:text-gray-400">';
                        html += '        Libellé';
                        html += '    </span>';
                        html += '    <input name="libelles[]" type="text"';
                           html += '     class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"';
                           html += '     placeholder="Libellé de l\'oppotinuité" />';
                   html += '     </label>';
                       html += ' <label class="block text-sm">';
                        html += '    <span class="text-gray-700 dark:text-gray-400">';
                         html += '       Date de début';
                  html += '          </span>';
                   html += '         <input type="date" name="date_debuts[]" ';
                    html += '            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"';
                    html += '            placeholder="DD/MM/YYYY" />';
                   html += '     </label>';
                        
                 html += '         <label class="block mt-4 text-sm">';
                   html += '         <span class="text-gray-700 dark:text-gray-400">';
                    html += '           Objectif de vente';
                     html += '       </span>';
                      html += '      <input  name="objectif_de_ventes[]" type="text"';
                      html += '          class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"';
                        html += '        placeholder="Ex: 10000000" />';
                        html += '</label>';
                        
                     html += '   <label class="block text-sm">';
                      html += '      <span class="text-gray-700 dark:text-gray-400">';
                       html += '         Statut de l opportunuité';
                        html += '    </span>';
                   html += '     </label>';
                   html += ' <select name="statutt[]" class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"  aria-label="Default select example" >';
                    html += ' <option value="0" selected>Sélectionner le statut</option>';
                            html += ' @foreach($stas as $st)';
                          html += ' <option value="{{$st->id}}">{!! $st->lib !!}</option>';
                           html += ' @endforeach';
                html += ' </select>';
                    
                    
                      html += '  <label class="block mt-4 text-sm">';
                       html += '     <span class="text-gray-700 dark:text-gray-400">';
                         html += '       Probabilité';
                         html += '   </span>';
                         html += '   <input  name="probabilites[]" type="number"';
                            html += '    class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"';
                          html += '      placeholder="100%" />';
                      html += '  </label>';
                   //  html += '  <div class="col-md-12">'; 
                   // html += ' <label for="inputState" class="form-label required">Avez-vous un contact ? <b style="color:red;">*</b></label>'; 
                   //  html += '<div class="form-check">'; 
                   //   html += ' <input class="form-check-input" type="radio" name="contactt[]" value="1" id="contactoui" >'; 
                   //   html += ' <label class="form-check-label" for="exampleRadios1">'; 
                   //   html += ' Oui'; 
                    //  html += ' </label>'; 
                 //  html += ' </div>'; 
                 //  html += ' <div class="form-check">'; 
                   // html += '   <input class="form-check-input" type="radio" name="contactt[]" value="0" id="contactnon" checked >'; 
                     // html += ' <label class="form-check-label" for="exampleRadios2">'; 
                     // html += ' Non'; 
                    //  html += ' </label>'; 
                 //  html += ' </div> '; -->
                    
                html += ' </div>'; 
                html += ' <br> '; 
                
                        
                
                 html += ' <div class="col-md-1 pt-7">';            
                       
                        html += ' <button id="removeRow" type="button" class="px-2 py-2 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="background-color:red; color:white">';
                        html += ' <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">';
                        html += '<path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>';
                        html += '</svg></button><br><br> ';
                        html += ' </div> ';
                        html += ' </div> ';
                        html += ' </div> ';
                         html += ' </div> ';
                
             
        
                $('#newRow').append(html);
            });
        
            // remove row
            $(document).on('click', '#removeRow', function () {
                $(this).closest('.remove').remove();
            });
        </script>
        <!--Multiselector Script-->
        <script>
        const getButton = document.getElementById('get');
        const multiInput = document.querySelector('multi-input'); 
        const values = document.querySelector('#values'); 
        
        getButton.onclick = () => {
          if (multiInput.getValues().length > 0) {
            values.textContent = `Got ${multiInput.getValues().join(' and ')}!`;
          } else {
            values.textContent = 'Got noone  :`^(.'; 
          }
        }
        
        document.querySelector('input').focus();

        </script>
        <!--Multiselector Script-->
        <script>
        class MultiInput extends HTMLElement {
  constructor() {
    super();
    // This is a hack :^(.
    // ::slotted(input)::-webkit-calendar-picker-indicator doesn't work in any browser.
    // ::slotted() with ::after doesn't work in Safari.
    this.innerHTML +=
    `<style>
    multi-input input::-webkit-calendar-picker-indicator {
      display: none; dark:text-gray-400
    }
    /* NB use of pointer-events to only allow events from the × icon */
    multi-input div.item::after {
      color: black;
      content: '×';
      cursor: pointer;
      font-size: 18px;
      pointer-events: auto;
      position: absolute;
      right: 5px;
      top: -1px;
    }

    </style>`;
    this._shadowRoot = this.attachShadow({mode: 'open'});
    this._shadowRoot.innerHTML =
    `<style>
    :host {
      border: var(--multi-input-border, 1px solid #ddd);
      display: block;
      overflow: hidden;
      padding: 5px;
    }
    /* NB use of pointer-events to only allow events from the × icon */
    ::slotted(div.item) {
      background-color: var(--multi-input-item-bg-color, #dedede);
      border: var(--multi-input-item-border, 1px solid #ccc);
      border-radius: 2px;
      color: #222;
      display: inline-block;
      font-size: var(--multi-input-item-font-size, 14px);
      margin: 5px;
      padding: 2px 25px 2px 5px;
      pointer-events: none;
      position: relative;
      top: -1px;
    }
    /* NB pointer-events: none above */
    ::slotted(div.item:hover) {
      background-color: #eee;
      color: black;
    }
    ::slotted(input) {
      border: none;
      font-size: var(--multi-input-input-font-size, 14px);
      outline: none;
      padding: 10px 10px 10px 5px; 
    }
    </style>
    <slot></slot>`;

    this._datalist = this.querySelector('datalist');
    this._allowedValues = [];
    for (const option of this._datalist.options) {
      this._allowedValues.push(option.value);
    }

    this._input = this.querySelector('input');
    this._input.onblur = this._handleBlur.bind(this);
    this._input.oninput = this._handleInput.bind(this);
    this._input.onkeydown = (event) => {
      this._handleKeydown(event);
    };

    this._allowDuplicates = this.hasAttribute('allow-duplicates');
  }

  // Called by _handleKeydown() when the value of the input is an allowed value.
  _addItem(value) {
    this._input.value = '';
    const item = document.createElement('div');
    item.classList.add('item');
    item.textContent = value;
    this.insertBefore(item, this._input);
    item.onclick = () => {
      this._deleteItem(item);
    };

    // Remove value from datalist options and from _allowedValues array.
    // Value is added back if an item is deleted (see _deleteItem()).
    if (!this._allowDuplicates) {
      for (const option of this._datalist.options) {
        if (option.value === value) {
          option.remove();
        };
      }
      this._allowedValues =
      this._allowedValues.filter((item) => item !== value);
    }
  }

  // Called when the × icon is tapped/clicked or
  // by _handleKeydown() when Backspace is entered.
  _deleteItem(item) {
    const value = item.textContent;
    item.remove();
    // If duplicates aren't allowed, value is removed (in _addItem())
    // as a datalist option and from the _allowedValues array.
    // So — need to add it back here.
    if (!this._allowDuplicates) {
      const option = document.createElement('option');
      option.value = value;
      // Insert as first option seems reasonable...
      this._datalist.insertBefore(option, this._datalist.firstChild);
      this._allowedValues.push(value);
    }
  }

  // Avoid stray text remaining in the input element that's not in a div.item.
  _handleBlur() {
    this._input.value = '';
  }

  // Called when input text changes,
  // either by entering text or selecting a datalist option.
  _handleInput() {
    // Add a div.item, but only if the current value
    // of the input is an allowed value
    const value = this._input.value;
    if (this._allowedValues.includes(value)) {
      this._addItem(value);
    }
  }

  // Called when text is entered or keys pressed in the input element.
  _handleKeydown(event) {
    const itemToDelete = event.target.previousElementSibling;
    const value = this._input.value;
    // On Backspace, delete the div.item to the left of the input
    if (value ==='' && event.key === 'Backspace' && itemToDelete) {
      this._deleteItem(itemToDelete);
    // Add a div.item, but only if the current value
    // of the input is an allowed value
    } else if (this._allowedValues.includes(value)) {
      this._addItem(value);
    }
  }

  // Public method for getting item values as an array.
  getValues() {
    const values = [];
    const items = this.querySelectorAll('.item');
    for (const item of items) {
      values.push(item.textContent);
    }
    return values;
  }
}

window.customElements.define('multi-input', MultiInput);

            
        </script>





	<script>
		    
                $(document).ready(function(){
                    $('#contactoui').on('change', function() {
                      if ( this.value == '1')
                      {
                        $("#formcontact").show();
                      }
                    });
                });
		</script>
		<script>
		    
                $(document).ready(function(){
                    $('#contactnon').on('change', function() {
                      if ( this.value == '0')
                      {
                        $("#formcontact").hide();
                      }
                    });
                });
		</script>
		<script>
		    //$flexSwitchDefault
		   
		    $("#formcontact").hide();
		   
		    
		    
		</script>






		<script>
		    
                $(document).ready(function(){
                    $('#projnon').on('change', function() {
                      if ( this.value == '0')
                      {
                        $("#selectProjet").show();
                      }
                    });
                    
                    $('#proj').on('change', function() {
                      if ( this.value == '1')
                      {
                        $("#focaux_prospect").show();
                      }
                    });
                });
		</script>
		<script>
		    
                $(document).ready(function(){
                    $('#projnon').on('change', function() {
                      if ( this.value == '0')
                      {
                        $("#focaux_prospect").hide();
                      }
                    });
                    
                    $('#proj').on('change', function() {
                      if ( this.value == '1')
                      {
                        $("#selectProjet").hide();
                      }
                    });
                });
		</script>
		<script>
		    //$flexSwitchDefault
		   
		    $("#selectProjet").show();
		    $("#focaux_prospect").hide();
		   
		    
		    
		</script>
		
		
		<script>
var slider = document.getElementById("customRange3");
var output = document.getElementById("demo");
output.innerHTML = slider.value;
slider.oninput = function() {
  output.innerHTML = this.value;
}
</script>
	
</body>

</html>