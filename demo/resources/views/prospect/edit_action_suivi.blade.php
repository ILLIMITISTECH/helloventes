                                    
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Feedback</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('v2/assets/img/favicon.png')}}" rel="icon">
  <link href="{{asset('v2/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/vendor/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

</head>

<body>


 
        @include('v2.header_dg')
        <aside id="sidebar" class="sidebar">
                <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                @include('v2.side_bar_dg')
            </div>
                <!-- End Sidebar scroll-->
         </aside>
    
                <!-- end side bar -->
        <main id="main" class="main">

   
    <h5>
      @if (session('message'))
                  <div class="alert alert-success" role="alert">
                  {{ session('message') }}
                  </div>  
                  @endif
    </h5>
                       <!-- formulaire -->
                              
         <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
                            <div class="card-body">
                                <div class="d-md-flex">
                                                <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Modifié les actions de suivi</h4>
                                            </div> 
                                        
                                 <form action="{{route('action_suivi.update', $action_suivi->id)}}" method="post"  class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload" enctype="multipart/form-data">
                                                    @method('PATCH')
                                                     @csrf
                                            <div class="tab-pane" id="tab1">

                                             <fieldset>
                                                
                                                    <div class="control-group">
                                                        <label class="control-label" for="focusedInput">Dans 5 ans</label>
                                                      <div class="controls">
                                                      <input name="souhait" id="postcode" type="text" value="{{$action_suivi->souhait}}" class="form-control" >
                                                      </div>
                                                    </div>
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput">Poste dans 5 ans</label>
                                                      <div class="controls">
                                                      <input name="poste_job" id="postcode" type="text" value="{{$action_suivi->poste_job}}" class="form-control" >
                                                      </div>
                                                    </div>
                                                @php  
                                                
                                                    $competences_1 = DB::table('competences')->where('id', $action_suivi->competence_dev1)->first();
                                                    $competences_2 = DB::table('competences')->where('id', $action_suivi->competence_dev2)->first();
                                                    $competences_3 = DB::table('competences')->where('id', $action_suivi->competence_dev3)->first();
                                                
                                                @endphp
                                                  <h5 class="card-title">Vos compétences à développer :</h5>
                                                  
                                                  <div class="row mb-3">
                                              <label for="inputText" class="col-sm-12 col-form-label">Les 3 compétences clés  que vous souhaitez développer au cours des 6 prochains mois, au regard des résultats du feedback 360, et de votre plan d'actions de développement personnel ? </label>
                                             <br><br>
                                              <div class="col-sm-4"> <div align="right"></div>
                                              <select class="form-select" name="competence_dev1" aria-label="Default select example">
                                                  <option value="{{$action_suivi->competence_dev1}}" selected="" > {{$competences_1 ? $competences_1->libelle : ' '}}</option>
                                                  @foreach($competences as $competence)
                                                  <option value="{{$competence->id}}">{{$competence->libelle}}</option>
                                                  @endforeach  
                                              </select>
                                              </div>
                                              <div class="col-sm-4"><div align="right"></div>
                                              <select class="form-select" name="competence_dev2" aria-label="Default select example">
                                                    <option value="{{$action_suivi->competence_dev2}}" selected="" >{{$competences_2 ? $competences_2->libelle : ' '}}</option>
                                                    @foreach($competences as $competence)
                                                    <option value="{{$competence->id}}">{{$competence->libelle}}</option>
                                                    @endforeach  
                                              </select>
                                              </div>
                                              <div class="col-sm-4"><div align="right"></div>
                                              <select class="form-select" name="competence_dev3" aria-label="Default select example">
                                                    <option value="{{$action_suivi->competence_dev3}}" selected="" > {{$competences_3 ? $competences_3->libelle : ' '}}</option>
                                                  @foreach($competences as $competence)
                                                  <option value="{{$competence->id}}">{{$competence->libelle}}</option>
                                                  @endforeach    
                                              </select>
                                              </div>
                                            
                                            </div>
                                                  
                                               
                                                  </fieldset>
                                                
                                            </div>

                                            
                                            <!-- <ul class="pager wizard">
                                                <li class="previous first" style="display:none;"><a href="javascript:void(0);">First</a></li>
                                                <li class="previous"><a href="javascript:void(0);">Précédent</a></li>
                                                 <li class="next last" style="display:none;"><a href="javascript:void(0);">Last</a></li> 
                                                <li class="next"><a href="javascript:void(0);">Suivant</a></li>
                                                <li class="next finish" style="display:none;"><a href="javascript:;">Enregistrer</a></li>
                                            </ul> -->
                                                <div class="form-actions pull-right" style="margin-top:10px;">
                                                    <button type="submit" class="btn btn-primary" onclick="myFunction()">Valider</button>
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
                            </div>
                        </div>

                                                
                    </div>
                        

                        
                    </div>
                    
                        <!-- end section -->

                            <div class="app-wrapper-footer">
                                <div class="app-footer">
                                    <div class="app-footer__inner">
                                        <div class="app-footer-left">
                                            <ul class="nav">
                                                <li class="nav-item">
                                                    <a href="javascript:void(0);" class="nav-link">
                                                        
                                                    </a>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>    
                    
                </div>
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
          alert('Le pourcentage ne peut pas dépasser 100');
          //$(this).val(max);
      }
      else if ($(this).val() < min)
      {
        alert('Le pourcentage ne peut pas avoir une valeur négative');
          //$(this).val(min);
      }       
    }); 
});
    </script>
</body>
</html>
