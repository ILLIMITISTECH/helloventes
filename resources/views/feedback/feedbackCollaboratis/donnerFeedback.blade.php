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

</head>
<body>
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
    
    
                <!-- end side bar -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Donner un feedback</h3>
                    </div>
               
                </div>
            </div>
             <div class="row" style = "margin-left : 20px">
                            <div class="col-md-12">
                                <div class="section-title-box" style="position : relative; display : flex;">
                                    <h4 class="section-title"></h4>
                                    
                                </div>
                                 <h5>
						@if (session('message'))
                        <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                        </div>  
                        @endif
                    </h5>
                       <!-- formulaire -->
                              
        <div class="card col-lg-10 mt-4 mb-10">
            <div class="card-body">
                
                    <div class="input-group row ">
                       <form class="row " action="/feedback/donner" method="post">
                             {{ csrf_field() }}
                        <div class="mb-9">
                            <label for=" " class="required form-label">Collaborateur : </label>
                            <select class="form-select" name="agents_id_choisi" aria-label="Select example" required>
                                <option value="">Sélectionner</option>
                                        @foreach($agents as $agent)  
                                        <option value="{{$agent->id}}">{{$agent->prenom}} {{$agent->nom}}</option>
                                        @endforeach
                                </select>        
                          
                        </div><br><br>
                        <div class="mb-9">
                            <label for=" " class="required form-label">Source du feedback : </label>
                            <select class="form-select" id="proj" name="source_id" aria-label="Select example" >
                                <option value="">Sélectionner</option>
                                        @foreach($sources as $source)  
                                        <option value="{{$source->id}}">{{$source->nom_source}}</option>
                                        @endforeach
                                </select>        
                           
                        </div>
                        <div class="mb-9" id="selectProjet">
                                <label for=" " class="required form-label">Liste des Projets  </label>
                                <select class="form-select" name="projet_id" aria-label="Select example" >
                                    <option value="">Sélectionner</option>
                                            @foreach($projets as $projet)  
                                            <option value="{{$projet->id}}">{{$projet->libelle}}</option>
                                            @endforeach
                                    </select>        
                               
                            </div><br><br>
                        <div class="mb-9">
                            <label for="exampleFormControlInput1" class="required form-label">Mon feedback positif<span class="red">*</span></label>
                            <textarea class="form-control" name="apprecier" rows="5" cols="30" > Soyez précis ...</textarea>
                        </div>
                        <br><br><br>
                        <div class="mb-9">
                        <label for="exampleFormControlInput1" class="required form-label">Mon feedback constructif (propositions d'améliorations)<span class="red">*</span>)</label>
                        <textarea class="form-control" name="ameliorer" rows="5" cols="30">Soyez précis ...</textarea>
                        </div>
                        <br><br><br>
                      
                            <div class="mb-7">
                              Voulez vous partager ce feedback de manière anonyme ? (<span class="red">*</span>)
                                   <div class="form-check">
                                      <input class="form-check-input" type="radio" name="type_ano" id="exampleRadios1" value="0" checked>
                                      <label class="form-check-label" for="exampleRadios1">
                                      Oui
                                      </label>
                                   </div>
                                   <div class="form-check">
                                      <input class="form-check-input" type="radio" name="type_ano" id="exampleRadios2" value="1" >
                                      <label class="form-check-label" for="exampleRadios2">
                                      Non
                                      </label>
                                   </div> 
                            </div>
					 <div class="mt-5 col-12">
                            <button type="submit" class="btn btn-info" style="color:white">Valider</button>
                        </div>
                         </form>
                        
						
               
            </div>
             </div>
        </div>

                       <!-- end formulaire --> 
                       
                         <!-- res strategique -->

                         <!-- end res strategique -->

                        <!-- perfo de mes direc -->
                        

                         <!-- end perfo de mes direct -->
                        
                        <!-- section -->

                        <!-- end section -->

                            
                                            
                                       
                    
                    </div>
                            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
                            </div>
            </div>
    </div>
    
 <style>
 
      .red{
            color :red;
            font-weight : bold;
        }
        .text-nice{
            font-family: 'poppins', sans-serif;
        }
        
        .btn-green {
            background-color : #43928E ;
            color : white;
        }
        .rounded-container{
            width: 586px;
            height: 526px;
            background: white;
            border-radius: 51px;
            margin-right : auto;
            text-align : center;
        }
</style>
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
    
    	<script>
		    
                $(document).ready(function(){
                    $('#proj').on('change', function() {
                      if ( this.value == '3')
                      {
                        $("#selectProjet").show();
                      }
                      else
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
