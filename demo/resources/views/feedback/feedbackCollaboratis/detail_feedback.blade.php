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
                        <h3 class="page-title mb-0 p-0">Feedback reçus</h3>
                    </div>
               
                </div>
            </div>
                                        
                       <!-- formulaire 1-->
                       
                       
    <div class="row" style = "margin-left : 15px">
        <div class="col-md-3">
                                           
           <select name="search_a" class="form-select" aria-label="Default select example">
               <option value="">Filtrer</option>
               <option value="2" >Feedback constructifs</option>
               <option value="1" >Tous les positifs</option>
               <option value="3" >Feedback</option>
             
           </select>
      
        </div><br><br>
        <div class="card col-lg-12 mt-4 mb-10">
            <div class="card-body">
                <div id="inputFormRow">
                    <div class="input-group row mb-3" id="ag">
                       <table class="table table-hover table-rounded  ">
                                           
										        
										      <thead>
										          <tr>
										              <th>Collaborateur</th>
										              <th>Feedback positif</th>
										              <th>Feedback constructif</th>
										          </tr>
										      </thead>
										      <tbody>
										      @foreach($feedbackdonner as $feedbackdonners)
										          <tr>
										              @if($feedbackdonners->type_ano == 0)
                                                        <td>Anonyme</td>
                                                        @else
                                                        <?php $agents = DB::table('agents')->where('id', $feedbackdonners->agent_id)->first(); ?>
										                <td>{{$agents->prenom}} {{$agents->nom}}</td>
                                                        @endif
										              <td>{{ ($feedbackdonners->apprecier_1 && $feedbackdonners->crypted) ? decrypt($feedbackdonners->apprecier_1) : ''}}<br>
										                  {{ ($feedbackdonners->apprecier_2 && $feedbackdonners->crypted) ? decrypt($feedbackdonners->apprecier_2) : ''}}<br>
										                  {{ ($feedbackdonners->apprecier_3 && $feedbackdonners->crypted) ? decrypt($feedbackdonners->apprecier_3) : ''}}
										              </td>
										              <td>{{ ($feedbackdonners->ameliorer_1 && $feedbackdonners->crypted) ? decrypt($feedbackdonners->ameliorer_1) : ''}}<br>
										                  {{ ($feedbackdonners->ameliorer_2 && $feedbackdonners->crypted) ? decrypt($feedbackdonners->ameliorer_2) : ''}}<br>
										                  {{ ($feedbackdonners->ameliorer_3 && $feedbackdonners->crypted) ? decrypt($feedbackdonners->ameliorer_3) : ''}}
										              </td>
										          </tr>
										      @endforeach
										      </tbody>
						</table>
                    </div>
                    <!------------------------ameliorer----------------->
                    <div class="input-group row mb-3" id="ameliorer">
                       <table class="table table-hover table-rounded  ">
										      <thead>
										          <tr>
										              <th>Feedback constructif</th>
										          </tr>
										      </thead>
										      <tbody>
										      @foreach($feedbackdonner as $feedbackdonners)
										          <tr>
										              <td>{{ ($feedbackdonners->ameliorer_1 && $feedbackdonners->crypted) ? decrypt($feedbackdonners->ameliorer_1) : ''}}
										                  {{ ($feedbackdonners->ameliorer_2 && $feedbackdonners->crypted) ? decrypt($feedbackdonners->ameliorer_2) : ''}}
										                  {{ ($feedbackdonners->ameliorer_3 && $feedbackdonners->crypted) ? decrypt($feedbackdonners->ameliorer_3) : ''}}
										             </td>
										          </tr>
										      @endforeach
										      </tbody>
						</table>
                    </div>
                    
                    <!------------------------apprecier------------------------->
                    <div class="input-group row mb-3" id="apprecier">
                       <table class="table table-hover table-rounded  ">
										      <thead>
										          <tr>
										              <th>Feedback positif</th>
										          </tr>
										      </thead>
										      <tbody>
										      @foreach($feedbackdonner as $feedbackdonners)
										          <tr>
										              <td>{{ ($feedbackdonners->apprecier_1 && $feedbackdonners->crypted) ? decrypt($feedbackdonners->apprecier_1) : ''}}
										                  {{ ($feedbackdonners->apprecier_2 && $feedbackdonners->crypted) ? decrypt($feedbackdonners->apprecier_2) : ''}}
										                  {{ ($feedbackdonners->apprecier_3 && $feedbackdonners->crypted) ? decrypt($feedbackdonners->apprecier_3) : ''}}
										              </td>
										          </tr>
										      @endforeach
										      </tbody>
						</table>
                    </div>
                </div>
            </div>
        </div>
    </div>

                       <!-- end formulaire1 --> 
                       
                       <!-- formulaire 2--> 


                       <!-- end formulaire 2 --> 


                            
                                          
                    
</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
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
               $("#apprecier").hide();
               $("#ameliorer").hide();
            </script>
            <script>
            $(document).ready(function(){
              $("select").change(function(){
                    $( "select option:selected").each(function(){
                        //enter bengal districts
                        if($(this).attr("value")=="1"){
                            $("#apprecier").show();
                            $("#ameliorer").hide();
                            $("#ag").hide();
                        }
                        if($(this).attr("value")=="2"){
                            $("#apprecier").hide();
                            $("#ameliorer").show();
                            $("#ag").hide();
                        }
                        if($(this).attr("value")=="3"){
                            $("#apprecier").hide();
                            $("#ameliorer").hide();
                            $("#ag").show();
                        }
                       
                    });
                });  
            }); 

                </script>
    
    
</body>
</html>
