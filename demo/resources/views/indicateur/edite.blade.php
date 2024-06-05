<!DOCTYPE html>
<html class="no-js">
    
    <head> 
        <title>Collaboratis</title>
        <!-- Bootstrap --> 
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/illimitis/collobo.jpeg')}}">
        <link href="{{asset('assetsss/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
        <link href="{{asset('assetsss/bootstrap/css/bootstrap-responsive.min.css')}}" rel="stylesheet" media="screen">
        <link href="{{asset('assetsss/vendors/easypiechart/jquery.easy-pie-chart.css')}}" rel="stylesheet" media="screen">
        <link href="{{asset('assetsss/assets/styles.css')}}" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="{{asset('assetsss/vendors/modernizr-2.6.2-respond-1.1.0.min.js')}}"></script>
    </head>
    
    <body>
         <!-- Mobile Menu header -->
         @include('admin.header_rap')
        <!-- Mobile Menu header -->
        <div class="container-fluid">
            <div class="row-fluid">
            
            @include('admin.side_bar_rap')
                
                <!--/span-->
                <div class="span9" id="content">
                    <div class="row-fluid">
                           <!-- <div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
                            <h4>Success</h4> 
                            
                        	The operation completed successfully 
                            </div> -->
                            <h5> @if (session('admin'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('admin') }}
                                            </div>  
                                        @endif</h5>
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="/admin/dashboard/rapporteur">Dashboard</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li>
	                                        <a href="/indicateurs">Les indicateurs</a> <span class="divider">/</span>	
	                                    </li>
                                        <li>
	                                        <a href="/suivi_indicateurs">Suivi Indicateur</a> <span class="divider">/</span>	
	                                    </li>
	                                    <!-- <li class="active">Tools</li> -->
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                        
                       

                    <!-- wizard -->
                    <div id="content">
                    <div class="row-fluid section">
                         <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Information</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <div id="rootwizard">
                                        <!-- <div class="navbar">
                                           <div class="navbar-inner">
                                            <div class="container">
                                            <ul>
                                                <li><a href="#tab1" data-toggle="tab">Step 1</a></li>
                                                <li><a href="#tab2" data-toggle="tab">Step 2</a></li>
                                                <li><a href="#tab3" data-toggle="tab">Step 3</a></li>
                                            </ul> 
                                         </div>
                                          </div>
                                        </div> -->
                                       <!--  <div id="bar" class="progress progress-striped active">
                                          <div class="bar"></div>
                                        </div> -->
                                        <h4> 
                                                      @if (session('message'))
                                                          <div class="alert alert-success" role="alert">
                                                              {{ session('message') }}
                                                          </div>  
                                                      @endif
                                                    </h4>
                                        <div class="tab-content">
                                        <form action="{{route('indicateurs.update', $indicateur->id)}}" method="post" class="form-horizontal" id="demo1-upload" enctype="multipart/form-data">
                                        @method('PATCH')
                                                     @csrf
                                            <div class="tab-pane" id="tab1">

                                                  <fieldset>
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput">Indicateur</label>
                                                      <div class="controls">
                                                     
                                                      <input name="libelle" type="text" value="{{$indicateur->libelle}}" class="form-control" placeholder="Indicateur">
                                                      </div>                      
                                                    </div>
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput">Cible</label>
                                                      <div class="controls">
                                                      
                                                      <input name="cible" type="text" value="{{$indicateur->cible}}" class="form-control" placeholder="Nom du cible">

                                                                                                                     </div>                    
                                                    </div>
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput">Date</label>
                                                      <div class="controls">
                                                      
                                                      <input name="date_cible" id="postcode" value="{{$indicateur->date_cible}}" type="date" class="form-control" placeholder="Date du cible">

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
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-primary">Valider</button>
                                                </div>
                                            </form>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                    
	            <!-- /wizard -->
                </div>
            </div>
            </div>
            <hr>
            <footer>
                <p>&copy; Collaboratis</p>
            </footer>
        </div>
        <!--/.fluid-container-->
        <script src="{{asset('assetsss/vendors/jquery-1.9.1.min.js')}}"></script>
        <script src="{{asset('assetsss/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assetsss/vendors/easypiechart/jquery.easy-pie-chart.js')}}"></script>
        <script src="{{asset('assetsss/assets/scripts.js')}}"></script>
        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000});
        });
        </script>
        <link href="{{asset('assetsss/vendors/datepicker.css')}}" rel="stylesheet" media="screen">
        <link href="{{asset('assetsss/vendors/uniform.default.css')}}" rel="stylesheet" media="screen">
        <link href="{{asset('assetsss/vendors/chosen.min.css')}}" rel="stylesheet" media="screen">

        <link href="{{asset('assetsss/vendors/wysiwyg/bootstrap-wysihtml5.css')}}" rel="stylesheet" media="screen">
        <script src="{{asset('assetsss/vendors/jquery.uniform.min.js')}}"></script>
        <script src="{{asset('assetsss/vendors/chosen.jquery.min.js')}}"></script>
        <script src="{{asset('assetsss/vendors/bootstrap-datepicker.js')}}"></script>

        <script src="{{asset('assetsss/vendors/wysiwyg/wysihtml5-0.3.0.js')}}"></script>
        <script src="{{asset('assetsss/vendors/wysiwyg/bootstrap-wysihtml5.js')}}"></script>

        <script src="{{asset('assetsss/vendors/wizard/jquery.bootstrap.wizard.min.js')}}"></script>

        <script type="text/javascript" src="{{asset('assetsss/vendors/jquery-validation/dist/jquery.validate.min.js')}}"></script>
        <script src="{{asset('assetsss/assets/form-validation.js')}}"></script>
            
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

    </body>

</html>