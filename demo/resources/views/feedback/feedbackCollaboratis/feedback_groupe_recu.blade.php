<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="short icon" href="{{asset('v2/assets/images/feedback.png')}}">
  <title>Feedback</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('v2/assets/img/feedback.png')}}" rel="icon">
  <link href="{{asset('v2/assets/img/feedback.png')}}" rel="apple-touch-icon">

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
           
                @include('v2.side_bar_dg')
            
                <!-- End Sidebar scroll-->
         </aside>
       <!-- end side bar -->
               <main id="main" class="main">

                       
             <div class="col-md-3">
                   </div>
                       <!-- formulaire 1-->
                       
                       
    <div class="row" >
        <div><select name="search_a" class="form-select" aria-label="Default select example" style = "width : 200px">
           <option value="">Filtrer</option>
           <option value="1" >Feedbacks anonymes</option>
           <option value="3" >Feedbacks constructifs</option>
            <option value="4" >Feedbacks positifs</option>
            <option value="5" >Compétences à améliorer</option>
            <option value="2" >Tous les feedbacks</option>
         
        </select></div>
       
        <div class="card col-lg-12 mt-4 mb-12">
            <div class="card-body">
              
                <div id="inputFormRow">
        <div class="row mb-3" >
        @php  $agent_groupe = DB::table('agents')->where('nom', $personne_choisi->groupe)->first();@endphp
          @if( $agent_groupe)
        @php  $feedback_groupe = DB::table('feedback')->where('agents_id_choisi', $agent_groupe->id)->where('choix', 'feedback')->get(); @endphp
            @foreach($feedback_groupe as $feedback_groupes)
    							        <?php $groupes = DB::table('agents')->where('id', $feedback_groupes->agents_id_choisi)->first(); ?>
    							    @endforeach
                          <div class="pagetitle" >
                          <h1 style="color:#4154f1">Feedbacks reçus du groupe {{$groupes->nom}}</h1>
                          
                        </div>
								 @if($feedback_groupe->isEmpty()) 
								 
    							 <p>Pas de feedback</p>
    							@else
    							    
    							    <br>
                                            <table class="table table-borderless">
                                            <thead>
                                            <tr style = "color : #1561a2;">
										              <th>Identité</th>
										              <th>Feedback positif</th>
										              <th>Feedback constructif</th>
										              <th>A améliorer</th>
										      </tr>
										      </thead>
										      <tbody>

										    
										         @foreach($feedback_groupe as $feedback_groupes)
										         
										      <br><tr>

                                                       <?php $agents = DB::table('agents')->where('id', $feedback_groupes->agent_id)->first(); ?>
                                                      
                        						     @if($feedback_groupes->type_ano == 0)
                                                        <td>Anonyme</td>
                                                        @else
                                                         <td>{{$agents->prenom}} {{$agents->nom}}</td>
                                                        @endif
                                                       
                                                        
                        						    </td>
										               
										              <td>{{ decrypt($feedback_groupes->apprecier_1)}} - 
										                  {{ ($feedback_groupes->apprecier_2 && $feedback_groupes->crypted) ? decrypt($feedback_groupes->apprecier_2) : ''}} - 
										                  {{ ($feedback_groupes->apprecier_3 && $feedback_groupes->crypted) ? decrypt($feedback_groupes->apprecier_3) : ''}}
										              </td>
										              <td>{{ ($feedback_groupes->ameliorer_1 && $feedback_groupes->crypted) ? decrypt($feedback_groupes->ameliorer_1) : ''}} - 
										                  {{ ($feedback_groupes->ameliorer_2 && $feedback_groupes->crypted) ? decrypt($feedback_groupes->ameliorer_2) : ''}} -
										                  {{ ($feedback_groupes->ameliorer_3 && $feedback_groupes->crypted) ? decrypt($feedback_groupes->ameliorer_3) : ''}}
										              </td>
										              <?php $competences= DB::table('competences')->where('id', $feedback_groupes->competence_id)->first(); ?>
										              @if($competences)
										              <td>{{$competences->libelle}}</td>
										              @else
										              <td>--</td>
										              @endif
										          </tr>

										    	@endforeach     
										       
										      </tbody>
						</table>
						<div class="link">{{$feedback->links()}}</div>
						 @endif
						 @endif
								    
                    </div>
                    </div>
                     </div>
    </div></div>
                    </div>
                
                    
            
    </div><br><br><br><br><br><br><br><br><br><br><br><br><br>

                       <!-- end formulaire1 --> 
               
                    </main>
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
    <script src="{{asset('assets/vendor/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/chart.js/chart.min.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/quill/quill.min.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>
    
    
            <script>
               $("#ano").hide();
                $("#apprecier").hide();
               $("#ameliorer").hide();
               $("#competence").hide();
            </script>
            <script>
            $(document).ready(function(){
              $("select").change(function(){
                    $( "select option:selected").each(function(){
                        //enter bengal districts
                        if($(this).attr("value")=="1"){
                            $("#ano").show();
                            $("#toutfeed").hide();
                             $("#apprecier").hide();
                            $("#ameliorer").hide();
                            $("#competence").hide();
                        }
                        if($(this).attr("value")=="2"){
                            $("#ano").hide();
                            $("#toutfeed").show();
                            $("#ag").hide();
                             $("#apprecier").hide();
                            $("#ameliorer").hide();
                            $("#competence").hide();
                        }
                       if($(this).attr("value")=="4"){
                            $("#apprecier").show();
                            $("#ameliorer").hide();
                            $("#toutfeed").hide();
                            $("#competence").hide();
                            $("#ano").hide();
                        }
                        if($(this).attr("value")=="3"){
                            $("#apprecier").hide();
                            $("#ameliorer").show();
                            $("#toutfeed").hide();
                            $("#competence").hide();
                            $("#ano").hide();
                        }
                        if($(this).attr("value")=="5"){
                            $("#apprecier").hide();
                            $("#ameliorer").hide();
                            $("#toutfeed").hide();
                            $("#competence").show();
                            $("#ano").hide();
                        }
                       
                    });
                });  
            }); 

                </script>
</body>
</html>
