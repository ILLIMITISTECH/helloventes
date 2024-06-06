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
                    <div class="col-md-12 col-8 align-self-center">
                       
                        <h3 class="page-title mb-0 p-0">Liste des feedbacks </h3>
                    </div>
               
                </div>
            </div>
            
                
                                                               <div class="widget-content"style = "margin-left : 20px">
                                                                   <div class="widget-content-outer">
                                                                       <div class="widget-content-wrapper">
                                                                        
                                                                       <form action="{{route('searchfeedback', $id)}}" method="get" style="margsearchfin-top:5px;">
                                                                            <select name="search" style="width:730px;" required>
                                                                                <option value="" disabled selected>Rechercher par agents</option>
                                                                                
                                                                               
                                                                                @php $agents = DB::table('agents')->get();  @endphp
                                                                                @foreach($agents as $agent)
                                                                                <option value="{{$agent->id}}">{{$agent->prenom}} {{$agent->nom}}</option>
                                                                                @endforeach
                                                                               
                                                                                
                                                                            </select>
                                                                                <button class="btn btn-primary" style="color:white;" type="submit">Filtrer</button>
                                                                
                                                                            </form> 
                                                                            
                                                                       </div>
                                                                       <div class="widget-content-left fsize-1">
                                                                           <div class="text-muted opacity-6"></div>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                          
                                        <div class="col-md-3">
                                           
                                           
                                      
                                        </div>
                       <!-- formulaire 1-->
                       
                       
    <div class="row" style = "margin-left : 20px">
        <div><select name="search_a" class="form-select" aria-label="Default select example" style = "width : 200px">
           <option value="">Filtrer</option>
           <option value="1" >Feedback anonyme</option>
           <option value="3" >Feedback constructifs</option>
            <option value="4" >Tous les positifs</option>
            <option value="2" >Tous les feedbacks</option>
         
        </select></div>
        <div class="card col-lg-10 mt-4 mb-10">
            <div class="card-body">
              
                <div id="inputFormRow">
                    <div class="input-group row mb-3" id="ag">

								 @if($feedback->isEmpty()) 
								 
    							 <p>Pas de feedback</p>
    							@else
    							
                                @foreach($feedback as $feedbacks)
                                   @php $source_nom = DB::table('source_feedbacks')->where('id', $feedbacks->source_id)->first(); @endphp
                                @endforeach
                                   @if($source_nom)
                                   <b>{{$source_nom->nom_source}}</b>
                                   @endif
                                           
                                  <div class="table-responsive mt-5">
                            
                                            <table class="table stylish-table no-wrap">
                               
                                            <thead>
                                            <tr>
										              <th>Photo</th>
										              <th>Agent</th>
										              <th>Feedback positif</th>
										              <th>Feedback constructif</th>
										          </tr>
										      </thead>
										      <tbody>

										     
										         @foreach($feedback as $feedbacks)
										         
										          <tr>
										              <!--<td>{{($feedbacks->nom_feedback && $feedbacks->crypted) ? decrypt(strval($feedbacks->nom_feedback)) : ''}}</td>-->
										               
                                                       <?php $agents = DB::table('agents')->where('id', $feedbacks->agent_id)->first(); ?>
                                                        @if($feedbacks->type_ano == 0)
                                                            <td> </td>
                                                        @else
                                                            <td class="d-flex align-items-center">
                                                           @if($agents->photo == NULL)
                                                           <span class="rounded-circle" style="border: 1px solid #3f6ad8; background: white; color:#2C365E; font-weight:bold; font-size:12px; padding:10px; text-shadow: 1px 1px 2px white;">{{substr($agents->prenom, 0,1)}} {{substr($agents->nom, 0,1)}}</span>
                                                           @else
                            						      	<img width="30" height="30" class="rounded-circle" src="{{ url('images/', $agents->photo) }}" alt="">
                            						       @endif
                            						    @endif
                        						    </td> 
                        						     @if($feedbacks->type_ano == 0)
                                                        <td>Anonyme</td>
                                                        @else
                                                         <td>{{$agents->prenom}} {{$agents->nom}}</td>
                                                        @endif
                                                       
                                                        
                        						    </td>
										               
										              <td>{{ ($feedbacks->apprecier && $feedbacks->crypted) ? decrypt($feedbacks->apprecier) : ''}}</td>
										              <td>{{ ($feedbacks->ameliorer && $feedbacks->crypted) ? decrypt($feedbacks->ameliorer) : ''}}</span></td>
										          </tr>

										    	@endforeach     
										       
										      </tbody>
						</table>
						 @endif
								    
                    </div>
                    </div>
                    <!---------------------------------------------------------------->
                    <div class="input-group row mb-3" id="ano">

								 @if($feedback->isEmpty()) 
								 
    							 <p>Pas de feedback</p>
    							
    							@else
    							
                                @foreach($feedback as $feedbacks)
                                   @php $source_nom = DB::table('source_feedbacks')->where('id', $feedbacks->source_id)->first(); @endphp
                                @endforeach
                                   @if($source_nom)
                                   {{$source_nom->nom_source}}
                                   @endif
                                           
                                  <div class="table-responsive mt-5">
                            
                                            <table class="table stylish-table no-wrap">
                               
                                            <thead>
                                            <tr>
										             <th>Photo</th>
										              <th>Agent</th>
										              <th>Feedback positif</th>
										              <th>Feedback constructif</th>
										          </tr>
										      </thead>
										      <tbody>

										      
										         @foreach($feedback as $feedbacks)
										         @if($feedbacks->type_ano == 0)
										          <tr>
										              <!--<td>{{($feedbacks->nom_feedback && $feedbacks->crypted) ? decrypt(strval($feedbacks->nom_feedback)) : ''}}</td>-->
										               
                                                       <?php $agents = DB::table('agents')->where('id', $feedbacks->agent_id)->first(); ?>
                                                        <td class="d-flex align-items-center">
                                                       @if($agents->photo == NULL)
                                                       <span class="rounded-circle" style="border: 1px solid #3f6ad8; background: white; color:#2C365E; font-weight:bold; font-size:12px; padding:10px; text-shadow: 1px 1px 2px white;">{{substr($agents->prenom, 0,1)}} {{substr($agents->nom, 0,1)}}</span>
                                                       @else
                        						      	<img width="30" height="30" class="rounded-circle" src="{{ url('images/', $agents->photo) }}" alt="">
                        						       @endif
                        						    </td> 
                        						     @if($feedbacks->type_ano == 0)
                                                        <td>Anonyme</td>
                                                        @else
                                                         <td>{{$agents->prenom}} {{$agents->nom}}</td>
                                                        @endif
                                                       
                                                        
                        						    </td>
										               
										              <td>{{ ($feedbacks->apprecier && $feedbacks->crypted) ? decrypt($feedbacks->apprecier) : ''}}</td>
										              <td>{{ ($feedbacks->ameliorer && $feedbacks->crypted) ? decrypt($feedbacks->ameliorer) : ''}}</span></td>
										          </tr>
										         @endif
										    	@endforeach     
										       
										      </tbody>
						</table>
						 @endif
								    
                    </div></div>
                    <!------------------------------------>
                    <div class="input-group row mb-3" id="toutfeed">

								 @if($feedback->isEmpty()) 
								 
    							 <p>Pas de feedback</p>
    							@else
    							
                                @foreach($feedback as $feedbacks)
                                   @php $source_nom = DB::table('source_feedbacks')->where('id', $feedbacks->source_id)->first(); @endphp
                                @endforeach
                                   @if($source_nom)
                                   {{$source_nom->nom_source}}
                                   @endif
                                           
                                  <div class="table-responsive mt-5">
                            
                                            <table class="table stylish-table no-wrap">
                               
                                            <thead>
                                            <tr>
										              <th>Photo</th>
										              <th>Agent</th>
										              <th>Feedback positif</th>
										              <th>Feedback constructif</th>
										          </tr>
										      </thead>
										      <tbody>

										      
										         @foreach($feedback as $feedbacks)
										          <tr>
										              <!--<td>{{($feedbacks->nom_feedback && $feedbacks->crypted) ? decrypt(strval($feedbacks->nom_feedback)) : ''}}</td>-->
										               
                                                       <?php $agents = DB::table('agents')->where('id', $feedbacks->agent_id)->first(); ?>
                                                        <td class="d-flex align-items-center">
                                                       @if($agents->photo == NULL)
                                                       <span class="rounded-circle" style="border: 1px solid #3f6ad8; background: white; color:#2C365E; font-weight:bold; font-size:12px; padding:10px; text-shadow: 1px 1px 2px white;">{{substr($agents->prenom, 0,1)}} {{substr($agents->nom, 0,1)}}</span>
                                                       @else
                        						      	<img width="30" height="30" class="rounded-circle" src="{{ url('images/', $agents->photo) }}" alt="">
                        						       @endif
                        						    </td> 
                        						     @if($feedbacks->type_ano == 0)
                                                        <td>Anonyme</td>
                                                        @else
                                                         <td>{{$agents->prenom}} {{$agents->nom}}</td>
                                                        @endif
                                                       
                                                        
                        						    </td>
										               
										              <td>{{ ($feedbacks->apprecier && $feedbacks->crypted) ? decrypt($feedbacks->apprecier) : ''}}</td>
										              <td>{{ ($feedbacks->ameliorer && $feedbacks->crypted) ? decrypt($feedbacks->ameliorer) : ''}}</span></td>
										          </tr>
										    	@endforeach     
										       
										      </tbody>
						</table>
						 @endif
								    
                    </div></div>
                    <!----------------------------------->
                     <!------------------------apprecier------------------------->
                    <div class="input-group row mb-3" id="apprecier">
                       <table class="table table-hover table-rounded  ">
										      <thead>
										          <tr>
										              <th>Photo</th>
										              <th>Agent</th>
										              <th>Feedback positif</th>
										          </tr>
										      </thead>
										      <tbody>
										      @foreach($feedback as $feedbacks)
										          <tr>
										              <!--<td>{{($feedbacks->nom_feedback && $feedbacks->crypted) ? decrypt(strval($feedbacks->nom_feedback)) : ''}}</td>-->
										               
                                                       <?php $agents = DB::table('agents')->where('id', $feedbacks->agent_id)->first(); ?>
                                                        <td class="d-flex align-items-center">
                                                       @if($agents->photo == NULL)
                                                       <span class="rounded-circle" style="border: 1px solid #3f6ad8; background: white; color:#2C365E; font-weight:bold; font-size:12px; padding:10px; text-shadow: 1px 1px 2px white;">{{substr($agents->prenom, 0,1)}} {{substr($agents->nom, 0,1)}}</span>
                                                       @else
                        						      	<img width="30" height="30" class="rounded-circle" src="{{ url('images/', $agents->photo) }}" alt="">
                        						       @endif
                        						    </td> 
                        						     @if($feedbacks->type_ano == 0)
                                                        <td>Anonyme</td>
                                                        @else
                                                         <td>{{$agents->prenom}} {{$agents->nom}}</td>
                                                        @endif
                                                       
                                                        
                        						    </td>
										               
										              <td>{{ ($feedbacks->apprecier && $feedbacks->crypted) ? decrypt($feedbacks->apprecier) : ''}}</td>
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
										              <th>Photo</th>
										              <th>Agent</th>
										              <th>Feedback constructif</th>
										          </tr>
										      </thead>
										      <tbody>
										      @foreach($feedback as $feedbacks)
										          <tr>
										              <!--<td>{{($feedbacks->nom_feedback && $feedbacks->crypted) ? decrypt(strval($feedbacks->nom_feedback)) : ''}}</td>-->
										               
                                                       <?php $agents = DB::table('agents')->where('id', $feedbacks->agent_id)->first(); ?>
                                                        <td class="d-flex align-items-center">
                                                       @if($agents->photo == NULL)
                                                       <span class="rounded-circle" style="border: 1px solid #3f6ad8; background: white; color:#2C365E; font-weight:bold; font-size:12px; padding:10px; text-shadow: 1px 1px 2px white;">{{substr($agents->prenom, 0,1)}} {{substr($agents->nom, 0,1)}}</span>
                                                       @else
                        						      	<img width="30" height="30" class="rounded-circle" src="{{ url('images/', $agents->photo) }}" alt="">
                        						       @endif
                        						    </td> 
                        						     @if($feedbacks->type_ano == 0)
                                                        <td>Anonyme</td>
                                                        @else
                                                         <td>{{$agents->prenom}} {{$agents->nom}}</td>
                                                        @endif
                                                       
                                                        
                        						    </td>
										              
										              <td>{{ ($feedbacks->ameliorer && $feedbacks->crypted) ? decrypt($feedbacks->ameliorer) : ''}}</span></td>
										          </tr>
										      @endforeach
										      </tbody>
						</table>
                    </div>
                    
                    <!----------------------------------->
                    
                </div>
            </div>
        </div>
    </div><br><br><br><br><br><br><br><br><br><br><br><br><br>

                       <!-- end formulaire1 --> 
               
                    </div>
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
               $("#ano").hide();
               $("#toutfeed").hide();
                $("#apprecier").hide();
               $("#ameliorer").hide();
            </script>
            <script>
            $(document).ready(function(){
              $("select").change(function(){
                    $( "select option:selected").each(function(){
                        //enter bengal districts
                        if($(this).attr("value")=="1"){
                            $("#ano").show();
                            $("#toutfeed").hide();
                            $("#ag").hide();
                             $("#apprecier").hide();
                            $("#ameliorer").hide();
                        }
                        if($(this).attr("value")=="2"){
                            $("#ano").hide();
                            $("#toutfeed").show();
                            $("#ag").hide();
                             $("#apprecier").hide();
                            $("#ameliorer").hide();
                        }
                       if($(this).attr("value")=="4"){
                            $("#apprecier").show();
                            $("#ameliorer").hide();
                            $("#ag").hide();
                            $("#ano").hide();
                        }
                        if($(this).attr("value")=="3"){
                            $("#apprecier").hide();
                            $("#ameliorer").show();
                            $("#ag").hide();
                            $("#ano").hide();
                        }
                       
                    });
                });  
            }); 

                </script>
</body>
</html>
