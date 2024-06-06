<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="Performance, collaboration, Focus, Team, Productivité">
    <meta name="description"
        content="Monster Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Suivi des sorties terrain </title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/monster-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('collov2/assets/images/icon.png')}}">
    <!-- Custom CSS -->
    <link href="{{asset('assets/plugins/chartist/dist/chartist.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('v2/assets/style.min.css')}}" rel="stylesheet">

</head>

<body>

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        @include('v2.header_dg')
       <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
        @include('v2.side_bar_dg')
        </div>
            <!-- End Sidebar scroll-->
                 </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Ajouter une entreprise</h3>
                    </div>
               
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales chart -->

                <h6> 
                                                      @if (session('message'))
                                                          <div class="alert alert-success" role="alert">
                                                              {{ session('message') }}
                                                          </div>  
                                                      @endif
                                                    </h6>
                                <form action="/ajouter_entreprises" method="post" class="form-horizontal" id="demo1-upload" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                            <div class="tab-pane" id="tab1">

                                                  <fieldset>
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput">Nom entreprise</label>
                                                      <div class="controls">
                                                      <input name="nom_entreprise" type="text" class="form-control" style="width:500px;" placeholder="Prénom" required>
                                                      </div>                      
                                                    </div>
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput">Secteur d'activité :</label>
                                                      <div class="controls">
                                                      <input name="secteur_activite" type="text" class="form-control" style="width:500px;" placeholder="Nom">
                                                      </div>                      
                                                    </div>
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput">Pays</label>
                                                      <div class="controls">
                                                            <select name="produit_id" style="width:400px;" class="form-control">
                                                              <option value="" >Selectionner le pays</option>
                                                              @foreach($pays as $pay)
                                                              <option value="{{$pay->id}}">{{$pay->libelle}}</option>
                                                              @endforeach
                                                            </select>
                                                      </div>
                                                    </div>
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput">Numéro de téléphone :</label>
                                                      <div class="controls">
                                                      <input name="phone" type="text" class="form-control" style="width:500px;" placeholder="+221..">
                                                      </div>
                                                    </div>
                                                    
                                                   
                                                 
                                <div class="col-md-12">
                                    <label for="inputState" class="form-label required">Avez-vous un point focal ? <b style="color:red;">*</b></label>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="kit" value="1" id="proj" >
                                      <label class="form-check-label" for="exampleRadios1">
                                      Oui
                                      </label>
                                   </div>
                                   <div class="form-check">
                                      <input class="form-check-input" type="radio" name="kit" value="0" id="projnon" checked>
                                      <label class="form-check-label" for="exampleRadios2">
                                      Non
                                      </label>
                                   </div> 
                                    
                                </div>
                                <br> 
                                
                                <div class="col-sm-12 col-form-label" id="selectProjet">
                                    <div class="col-sm-12">
                                      <label class="control-label" for="focusedInput">Prénom :</label>
                                      <div class="controls">
                                      <input name="point_focal_principal" type="text" class="form-control" style="width:500px;" placeholder="Prenom nom">
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <label class="control-label" for="focusedInput">Nom :</label>
                                      <div class="controls">
                                      <input name="point_focal_principal" type="text" class="form-control" style="width:500px;" placeholder="Prenom nom">
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <label class="control-label" for="focusedInput">Téléphone:</label>
                                      <div class="controls">
                                      <input name="point_focal_principal" type="text" class="form-control" style="width:500px;" placeholder="Prenom nom">
                                      </div>
                                    </div>
                                </div>
                        </div>
                                          
                               </fieldset>              
                                          
                                                <div class="form-actions pull-right" style="margin-top:20px;">
                                                    <button type="submit" class="btn btn-primary">Valider</button>
                                                </div>
                                            </form>
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
    
    $(function () {
   $( "#pourcent" ).change(function() {
      var max = parseInt($(this).attr('max'));
      var min = parseInt($(this).attr('min'));
      if ($(this).val() > max)
      {
          alert('Ne peut pas dépasser 100');
          //$(this).val(max);
      }
      else if ($(this).val() < min)
      {
        alert('Ne peut pas avoir une valeur negative');
          //$(this).val(min);
      }       
    }); 
});
    </script>
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
    
    <script src="{{asset('js/app-style-switcher.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('js/custom.js')}}"></script>
    <!--This page JavaScript -->
    <!--flot chart-->
    <script src="{{asset('assets/plugins/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('assets/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js')}}"></script>
    <script src="js/pages/dashboards/dashboard1.js"></script>
    		y

		<script>
		    
                $(document).ready(function(){
                    $('#proj').on('change', function() {
                      if ( this.value == '1')
                      {
                        $("#selectProjet").show();
                      }
                    });
                });
		</script>
		<script>
		    
                $(document).ready(function(){
                    $('#projnon').on('change', function() {
                      if ( this.value == '0')
                      {
                        $("#selectProjet").hide();
                      }
                    });
                });
		</script>
		<script>
		    //$flexSwitchDefault
		   
		    $("#selectProjet").hide();
		   
		    
		    
		</script>
	
</body>

</html>