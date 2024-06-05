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
    <title>Collaboratis </title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/monster-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('collov2/assets/images/icon.png')}}">
    <!-- Custom CSS -->
    <link href="{{asset('assets/plugins/chartist/dist/chartist.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('v2/assets/style.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">

</head>
<body>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
            <!--header -->
            
            @include('v2.header_dg')
            <!-- end header -->
     
       <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- side bar -->
                @include('v2.side_bar_dg')
        </div>
            <!-- End Sidebar scroll-->
                 </aside>
      
                <!-- end side bar -->
                
                       <!-- perfo -->

                       <!-- end perfo --> 
                     
                        <!-- perfo de mes direc -->
                       

                         <!-- end perfo de mes direct -->
                        <div class="page-wrapper" style = "height : 5000px; ">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Mise à jour</h3>
                    </div>
               
                </div>
            </div>

                        <!-- section -->

                <div class="app-main__outer">
                    <div class="app-main__inner">
                     <div class="main-card mb-3 card">
                            <div class="card-body">
                                <form action="{{route('action_user_toute.update', $action->id)}}" method="post"  class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload" enctype="multipart/form-data">
                                                    @method('PATCH')
                                                     @csrf
                                            <div class="tab-pane" id="tab1">

                                             <fieldset>
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput"></label>
                                                      <div class="controls">
                                                     
                                                      <input name="libelle" type="hidden" class="form-control" value="{{$action->libelle}}" placeholder="l'action">
                                                      </div>                      
                                                    </div>
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput"></label>
                                                      <div class="controls">
                                                      
                                                      <input name="deadline" type="hidden" class="form-control" value="{{$action->deadline}}" placeholder="date de l action">
                                                        </div>                    
                                                    </div>
                                                    <div class="control-group">
                                                      <div class="controls">
                                                      <input name="visibilite" type="hidden" class="form-control" value="{{$action->visibilite}}" placeholder="visibilite">
                                                      </div>
                                                    </div>
                                                    <div class="control-group">
                                                      <div class="controls">
                                                      <input name="delais" type="hidden" class="form-control" value="{{$action->delais}}" placeholder="Durée">
                                                      </div>
                                                    </div>
                                                    <div class="control-group">
                                                    <label class="control-label" for="focusedInput">Pourcentage (ne pas mettre (%) et mettre uniquement des valeurs paires )</label>
                                                      <div class="controls">
                                                      <input name="pourcentage" type="number" class="form-control" value="{{$action->pourcentage}}" placeholder="pourcentage" id="pourcent" min="0" max="100" step="2">
                                                      </div>
                                                    </div>
                                                    <div class="control-group">
                                                      <div class="controls">
                                                      <input name="risque" id="postcode" type="hidden" value="{{$action->risque}}" class="form-control" placeholder="Risque">
                                                      </div>
                                                    </div>
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput">Commentaire</label>
                                                      <div class="controls">
                                                      <input name="note" id="postcode" type="text" value="{{$action->note}}" class="form-control" placeholder="notes">
                                                      </div>
                                                    </div>

                                                    <div class="control-group">
                                                      <div class="controls">
                                                      <input name="responsable" id="postcode" type="hidden" value="{{$action->responsable}}" class="form-control" placeholder="notes">
                                                      </div>
                                                    </div>
                                                    <div class="control-group">
                                                      <div class="controls">
                                                      <input name="agent_id" id="postcode" type="hidden" value="{{$action->agent_id}}" class="form-control" placeholder="notes">
                                                      </div>
                                                    </div>
                                                    <div class="control-group">
                                                      <div class="controls">
                                                      <input name="reunion_id" id="postcode" type="hidden" value="{{$action->reunion_id}}" class="form-control" placeholder="notes">
                                                      </div>
                                                    </div>
                                                    <div class="control-group">
                                                      <div class="controls">
                                                      <input name="bakup" id="postcode" type="hidden" value="{{$action->bakup}}" class="form-control" placeholder="bakup">
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
