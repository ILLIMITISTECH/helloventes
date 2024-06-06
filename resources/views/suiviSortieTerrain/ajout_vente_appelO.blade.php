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
                     {{$opportunite->libelle}}
                    </h2>
                    <a href="/suivi_opportunites"> 
                          <button style="width:100px; margin-bottom:20px; margin-left:900px"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                         Retour 
                    </button> </a> 
                    <!-- General elements -->
         @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
                    <!-- Validation inputs -->
                    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <!-- Invalid input -->
                     <form action="{{route('appelO_update_archiver', $opportunite->id)}}" method="post" class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload" enctype="multipart/form-data">
                                                     @csrf
                   
                      <div class="col-md-12">
                          <br>
                    <label for="inputState" class="form-label required">Le motif de la clôture ? <b style="color:red;">*</b></label>
                    <br><br>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="archiver" value="2" id="gagner" >
                      <label class="form-check-label" for="exampleRadios1">
                      Gagnée
                      </label>
                   </div>
                   
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="archiver" value="3" id="annuler" >
                      <label class="form-check-label" for="exampleRadios2">
                     Perdue
                      </label>
                   </div> 
                    
                   <div class="form-check">
                      <input class="form-check-input" type="radio" name="archiver" value="1" id="archiver" >
                      <label class="form-check-label" for="exampleRadios2">
                     Archivée
                      </label>
                   </div> 
                    
                </div>
                <br>
                <div class="row" id="selectProjet">
                    
                    <h5 class="card-title">Ajouter le montant final (<span style=" color:red;">*</span>)</h5>
                    <div class="input-group row col-lg-12" style=" display:flex;">
                        <div class="col-lg-2">
                        <label class="block text-sm">
                          
                            <input name="montant" type="number" 
                                class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                placeholder="Saisir le libellé de l'oppotinuité" />
                                
                          <input name="opportunite_id" type="hidden" 
                                class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                placeholder="Saisir le libellé de l'oppotinuité" value="{{$opportunite->id}}" />
                        </label>
                        </div>
                    </div>
                    </br>
                    <h5 class="card-title">Le montant de départ : {{$opportunite->objectif_de_vente}} Fcfa</h5>
                    <div class="input-group row col-lg-12" style=" display:flex;">
                        <div class="col-lg-2">
                        <label class="block text-sm">
                          
                            <input name="montant_debut" type="hidden" value="{{$opportunite->objectif_de_vente}}"
                                class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                placeholder="Saisir le libellé de l'oppotinuité" />
                        </label>
                        </div>
                    </div>
                    
                 </div>
                 
                 <div class="row" id="archiverRaison">
                     
                    <h5 class="card-title">Raison de l'archivage (<span style=" color:red;">*</span>)</h5>
                    <div class="input-group row col-lg-12" style=" display:flex;">
                        <div class="col-lg-2">
                        <label class="block text-sm">
                          
                            <input name="raison_archive" type="text" 
                                class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                placeholder="Saisir la raison" /></label>
                        </div>
                    </div>
                    <h5 class="card-title">Deadline pour désarchiver(<span style=" color:red;">*</span>)</h5>
                    <div class="input-group row col-lg-12" style=" display:flex;">
                        <div class="col-lg-2">
                        <label class="block text-sm">
                          
                            <input name="deadline_desarchiver" type="date" 
                                class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                 /></label>
                        </div>
                    </div>
                    
                 </div>
                     
                      <div class="row" id="annulerRaison">
                     
                    <h5 class="card-title">Raison de l'annulation (<span style=" color:red;">*</span>)</h5>
                    <div class="input-group row col-lg-12" style=" display:flex;">
                        <div class="col-lg-2">
                        <label class="block text-sm">
                          
                            <input name="raison_annuler" type="text" 
                                class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                placeholder="Saisir la raison" /></label>
                        </div>
                    </div>

                 </div>     

                        <!-- Valid input -->
                       
                    
                
             

              
            </div>
                        <div style="margin-top: 3em;">

                            <button type="submit"
                                class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Valider
                            </button>
                            </form>
                        </div>
                    </div>
                    <!-- Inputs with icons -->
              
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
   
 <script>
        document.getElementById("inp").addEventListener("change", function() {
          let v = parseInt(this.value);
          if (v < 1) this.value = 1;
          if (v > 50) this.value = 50;
            });
    </script>
               
               
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

		<script>
		    
                $(document).ready(function(){
                    $('#gagner').on('change', function() {
                      if ( this.value == '2')
                      {
                        $("#selectProjet").show();
                      }
                    });
                    
                    $('#archiver').on('change', function() {
                      if ( this.value == '1')
                      {
                        $("#archiverRaison").show();
                      }
                    });
                    
                    $('#annuler').on('change', function() {
                      if ( this.value == '3')
                      {
                        $("#annulerRaison").show();
                      }
                    });
                });
		</script>
		<script>
		    
                $(document).ready(function(){
                    $('#archiver').on('change', function() {
                      if ( this.value == '1')
                      {
                        $("#selectProjet").hide();
                      }
                      if ( this.value == '3')
                      {
                        $("#selectProjet").hide();
                      }
                    });
                    $('#annuler').on('change', function() {
                     
                      if ( this.value == '3')
                      {
                        $("#selectProjet").hide();
                      }
                    });
                    
                    
                    $('#gagner').on('change', function() {
                      if ( this.value == '2')
                      {
                        $("#archiverRaison").hide();
                      }
                      if ( this.value == '3')
                      {
                        $("#archiverRaison").hide();
                      }
                    });
                    $('#annuler').on('change', function() {
                     
                      if ( this.value == '3')
                      {
                        $("#archiverRaison").hide();
                      }
                    });
                    
                    
                    $('#gagner').on('change', function() {
                      if ( this.value == '2')
                      {
                        $("#annulerRaison").hide();
                      }
                      if ( this.value == '1')
                      {
                        $("#annulerRaison").hide();
                      }
                    });
                    $('#archiver').on('change', function() {
                     
                      if ( this.value == '1')
                      {
                        $("#annulerRaison").hide();
                      }
                    });
                });
		</script>
		<script>
		    //$flexSwitchDefault
		   
		    $("#selectProjet").hide();
		   
		    $("#archiverRaison").hide();
		    
		    $("#annulerRaison").hide();
		    
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