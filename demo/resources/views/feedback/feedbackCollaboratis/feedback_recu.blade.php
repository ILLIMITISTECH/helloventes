<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="short icon" href="{{asset('v2/assets/images/feedback.png')}}">
  <title>Feedback</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
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

                        <div class="pagetitle" >
                          <h1 style="color:#4154f1">Feedbacks reçus</h1>
                          
                        </div>
             <div class="col-md-3">
                   </div>
                       <!-- formulaire 1-->
                       
      @php $a = DB::table('agents')->where('user_id', Auth::user()->id)->first(); @endphp                 
    <div class="row" >
        <div><select name="search_a" class="form-select" aria-label="Default select example" style = "width : 200px">
           <option value="">Filtrer</option>
            @if ($a->entreprise != 12)
           <option value="1" >Feedbacks anonymes</option>
           <option value="3" >Feedbacks constructifs</option>
           @endif
            <option value="4" >Feedbacks positifs</option>
            <option value="5" >Compétences à améliorer</option>
            <option value="2" >Tous les feedbacks</option>
         
        </select></div>
        <div style = "margin-left: 650px; margin-top:-50px"> 
                                 <form action="{{route('searchfeedback', $id)}}" method="get" style="margsearchfin-top:5px;">
                                    <select name="search" style="width:220px;height:40px" required>
                                        <option value="" disabled selected>Rechercher par collègue</option>
                                       @php $a = DB::table('agents')->where('user_id', Auth::user()->id)->first(); @endphp
                                        @php $aEntreprises = DB::table('agents')->where('entreprise', $a->entreprise)->orderBy('prenom', 'asc')->get(); @endphp
                                        <!--@php $agents = DB::table('agents')->where('nom_role', 'entreprise')->where('entreprise', 2)->get();  @endphp-->
                                        @foreach($aEntreprises as $agent)
                                        <option value="{{$agent->id}}">{{$agent->prenom}} {{$agent->nom}}</option>
                                        @endforeach
                                        <!--<option onclick="window.location.href='https://feedback.collaboratis.com/feedbackliste/$source->id';" value >Toutes les actions</option>-->
                                    </select>
                                        <button class="btn" style="color:white; background-color:#d5569b" type="submit">Filtrer</button>
                                </form> 
                            </div> 
        <div class="card col-lg-12 mt-4 mb-12">
            <div class="card-body">
              
                <div id="inputFormRow"><br>
                    <div class="row mb-3" id="toutfeed">
                          
								 @if($feedback->isEmpty()) 
								 
    							 <p>Pas de feedback</p>
    							@else
    							
                                <!--@foreach($feedback as $feedbacks)-->
                                <!--   @php $source_nom = DB::table('source_feedbacks')->where('id', $feedbacks->source_id)->first(); @endphp-->
                                <!--@endforeach-->
                                <!--   @if($source_nom)-->
                                <!--   <span style = "color : #d5569b">{{$source_nom->nom_source}}</span>-->
                                <!--   @endif-->
                                    
                            
                         
                                            <table class="table table-borderless">
                                            <thead>
                                            <tr style = "color : #1561a2;">
										              <th>Identité</th>
										              <th>Feedback positif</th>
										              @if ($a->entreprise != 12)
										              <th>Feedback constructif</th>
										              @endif
										              <th>A améliorer</th>
										      </tr>
										      </thead>
										      <tbody>

										    
										         @foreach($feedback as $feedbacks)
										         
										      <br><tr>

                                                       <?php $agents = DB::table('agents')->where('id', $feedbacks->agent_id)->first(); ?>
                                                   @if($agents)   
                        						     @if($feedbacks->type_ano == null)
                                                         <td>{{$agents->prenom}} {{$agents->nom}}</td>
                                                        @elseif($feedbacks->type_ano == 0)
                                                          <td>Anonyme</td>
                                                        @else
                                                        <td>{{$agents->prenom}} {{$agents->nom}}</td>
                                                        @endif
                                                      @endif 
                                                        
                        						    </td>
										               
										              <td>{{ ($feedbacks->apprecier_1 && $feedbacks->crypted) ? decrypt($feedbacks->apprecier_1) : ''}} - 
										                  {{ ($feedbacks->apprecier_2 && $feedbacks->crypted) ? decrypt($feedbacks->apprecier_2) : ''}} - 
										                  {{ ($feedbacks->apprecier_3 && $feedbacks->crypted) ? decrypt($feedbacks->apprecier_3) : ''}}
										              </td>
										              @if ($a->entreprise != 12)
										              <td>{{ ($feedbacks->ameliorer_1 && $feedbacks->crypted) ? decrypt($feedbacks->ameliorer_1) : ''}} - 
										                  {{ ($feedbacks->ameliorer_2 && $feedbacks->crypted) ? decrypt($feedbacks->ameliorer_2) : ''}} -
										                  {{ ($feedbacks->ameliorer_3 && $feedbacks->crypted) ? decrypt($feedbacks->ameliorer_3) : ''}}
										              </td>
										              @endif
										              <?php $competences= DB::table('competences')->where('id', $feedbacks->competence_id)->first(); ?>
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
								    
                    </div>
                    </div>
                    <!---------------------------------------------------------------->
                    @if ($a->entreprise != 12)
                    <div class="input-group row mb-3" id="ano">

								 @if($feedback->isEmpty()) 
								 
    							 <p>Pas de feedback</p>
    							
    							@else
    							
                                <!--@foreach($feedback as $feedbacks)-->
                                <!--   @php $source_nom = DB::table('source_feedbacks')->where('id', $feedbacks->source_id)->first(); @endphp-->
                                <!--@endforeach-->
                                <!--   @if($source_nom)-->
                                <!--    <span style = "color : red">{{$source_nom->nom_source}}</span>-->
                                <!--   @endif-->
                                    
                         
                                  <div class="table-responsive mt-5">
                            
                                            <table class="table table-borderless">
                               
                                            <thead>
                                            <tr style = "color : #1561a2;">
										             <!--<th>Photo</th>-->
										              <th>Identité</th>
										              <th>Feedback positif</th>
										              <th>Feedback constructif</th>
										              <th>Compétence à améliorer</th>
										          </tr>
										      </thead>
										      <tbody>

										      
										         @foreach($feedback as $feedbacks)
										         @if($feedbacks->type_ano == 0)
										          <tr>
										              <!--<td>{{($feedbacks->nom_feedback && $feedbacks->crypted) ? decrypt(strval($feedbacks->nom_feedback)) : ''}}</td>-->
										               
                                                       <?php $agents = DB::table('agents')->where('id', $feedbacks->agent_id)->first(); ?>
                                                   
                        						     @if($feedbacks->type_ano == 0)
                                                        <td>Anonyme</td>
                                                        @else
                                                         <td>{{$agents->prenom}} {{$agents->nom}}</td>
                                                        @endif
                                                       
                                                        
                        						    </td>
										               
										              <td>{{ ($feedbacks->apprecier_1 && $feedbacks->crypted) ? decrypt($feedbacks->apprecier_1) : ''}} - 
										                  {{ ($feedbacks->apprecier_2 && $feedbacks->crypted) ? decrypt($feedbacks->apprecier_2) : ''}} - 
										                  {{ ($feedbacks->apprecier_3 && $feedbacks->crypted) ? decrypt($feedbacks->apprecier_3) : ''}}
										              </td>
										              <td>{{ ($feedbacks->ameliorer_1 && $feedbacks->crypted) ? decrypt($feedbacks->ameliorer_1) : ''}} - 
										                  {{ ($feedbacks->ameliorer_2 && $feedbacks->crypted) ? decrypt($feedbacks->ameliorer_2) : ''}} - 
										                  {{ ($feedbacks->ameliorer_3 && $feedbacks->crypted) ? decrypt($feedbacks->ameliorer_3) : ''}}
										              </td>
										              <?php $competences= DB::table('competences')->where('id', $feedbacks->competence_id)->first(); ?>
										              @if($competences)
										              <td>{{$competences->libelle}}</td>
										              @else
										              <td>--</td>
										              @endif
										          </tr>
										         @endif
										    	@endforeach     
										       
										      </tbody>
						</table>
						<div class="link">{{$feedback->links()}}</div>
						 @endif
								    
                    </div></div>
                   @endif
                     <!------------------------apprecier------------------------->
                      
                            
                    <div class="input-group row mb-3" id="apprecier">
                        
                           <h2></h2> <h2></h2>
                       <table class="table table-borderless   ">
										      <thead>
										          <tr style = "color : #1561a2;">
										              <!--<th>Photo</th>-->
										              <th>Identité</th>
										              <th>Feedback positif</th>
										          </tr>
										      </thead>
										      <tbody>
										      @foreach($feedback as $feedbacks)
										          <tr>
										              <!--<td>{{($feedbacks->nom_feedback && $feedbacks->crypted) ? decrypt(strval($feedbacks->nom_feedback)) : ''}}</td>-->
										               
                                                       <?php $agents = DB::table('agents')->where('id', $feedbacks->agent_id)->first(); ?>
                                                      
                        						     @if($agents)   
                        						     @if($feedbacks->type_ano == null)
                                                         <td>{{$agents->prenom}} {{$agents->nom}}</td>
                                                        @elseif($feedbacks->type_ano == 0)
                                                          <td>Anonyme</td>
                                                        @else
                                                        <td>{{$agents->prenom}} {{$agents->nom}}</td>
                                                        @endif
                                                      @endif 
                                                       
                                                        
                        						    </td>
										               
										              <td>{{ ($feedbacks->apprecier_1 && $feedbacks->crypted) ? decrypt($feedbacks->apprecier_1) : ''}} - {{ ($feedbacks->apprecier_2 && $feedbacks->crypted) ? decrypt($feedbacks->apprecier_2) : ''}} - {{ ($feedbacks->apprecier_3 && $feedbacks->crypted) ? decrypt($feedbacks->apprecier_3) : ''}}
										              </td>
										          </tr>
										            
										      @endforeach
										      </tbody>
						</table>
						<div class="link">{{$feedback->links()}}</div>
                    </div>
                    
                     <!------------------------ameliorer----------------->
                    @if ($a->entreprise != 12) 
                    <div class="input-group row mb-3" id="ameliorer">
                         
                           <h2></h2> <h2></h2>
                       <table class="table table-borderless   ">
										      <thead>
										          <tr style = "color : #1561a2;">
										              <!--<th>Photo</th>-->
										              <th>Identité</th>
										              <th>Feedback constructif</th>
										          </tr>
										      </thead>
										      <tbody>
										      @foreach($feedback as $feedbacks)
										          <tr>
										              <!--<td>{{($feedbacks->nom_feedback && $feedbacks->crypted) ? decrypt(strval($feedbacks->nom_feedback)) : ''}}</td>-->
										               
                                                       @if($agents)   
                        						     @if($feedbacks->type_ano == null)
                                                         <td>{{$agents->prenom}} {{$agents->nom}}</td>
                                                        @elseif($feedbacks->type_ano == 0)
                                                          <td>Anonyme</td>
                                                        @else
                                                        <td>{{$agents->prenom}} {{$agents->nom}}</td>
                                                        @endif
                                                      @endif 
                                                       
                                                        
                        						    </td>
										              
										             <td>{{ ($feedbacks->ameliorer_1 && $feedbacks->crypted) ? decrypt($feedbacks->ameliorer_1) : ''}} - {{ ($feedbacks->ameliorer_2 && $feedbacks->crypted) ? decrypt($feedbacks->ameliorer_2) : ''}} - {{ ($feedbacks->ameliorer_3 && $feedbacks->crypted) ? decrypt($feedbacks->ameliorer_3) : ''}}
										              </td>
										          </tr>
										      @endforeach
										      </tbody>
						</table>
						<div class="link">{{$feedback->links()}}</div>
                    </div>
                    @endif
                    <!----------------------------------->
                     <!------------------------competence----------------->
                     
                    <div class="input-group row mb-3" id="competence">
                         
                           <h2></h2> <h2></h2>
                       <table class="table table-borderless   ">
										      <thead>
										          <tr style = "color : #1561a2;">
										              <!--<th>Photo</th>-->
										              <th>Identité</th>
										              <th>Compétence à améliorer</th>
										          </tr>
										      </thead>
										      <tbody>
										      @foreach($feedback as $feedbacks)
										          <tr>
										              <!--<td>{{($feedbacks->nom_feedback && $feedbacks->crypted) ? decrypt(strval($feedbacks->nom_feedback)) : ''}}</td>-->
										               
                                                        @if($agents)   
                        						     @if($feedbacks->type_ano == null)
                                                         <td>{{$agents->prenom}} {{$agents->nom}}</td>
                                                        @elseif($feedbacks->type_ano == 0)
                                                          <td>Anonyme</td>
                                                        @else
                                                        <td>{{$agents->prenom}} {{$agents->nom}}</td>
                                                        @endif
                                                      @endif 
                                                       
                                                        
                        						    </td>
										              <?php $competences= DB::table('competences')->where('id', $feedbacks->competence_id)->first(); ?>
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
                
                <script>
                    
                    function csrf(name="csrf-token"){
    const metas = document.getElementsByTagName('meta');
    for (let i = 0; i < metas.length; i++) {
        if (metas[i].getAttribute('name') === name) {
            return metas[i].getAttribute('content');
        }
    }
    
    return null;
}
                </script>
</body>
</html>
