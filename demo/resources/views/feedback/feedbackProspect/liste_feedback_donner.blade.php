
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
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="pagetitle" style = "text-align : center;">
      <h1 style =" color:#4154f1">Liste des feedback</h1>
      
    </div><!-- End Page Title -->
     <br><br>
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

								 @if(count($feed) == 0)  
								 
    								           <p>Pas de demande de Feedback</p>
    								          @else
                                                   
                       <table class="table table-borderless  ">
										      <thead>
										          <tr style="color:#1561a2">
										              <th>Titre</th>
										              <th>Agent</th>
										              <th>Date</th>
										              <th>Option</th>
										          </tr>
										      </thead>
										      <tbody>

                                       @foreach($feed as $key => $feedbac)
                                          @foreach($feedbac as $feedbacks)
										          <tr>
										              <td>{{$feedbacks->nom_feedback}}</td>
                                                        <?php $prospects = DB::table('prospects')->where('id', $feedbacks->prospect_id)->first(); ?>
										                <td>{{$prospects->prenom}} {{$prospects->nom}}</td>

										              <td>{{date('d/m/Y', strtotime($feedbacks->created_at))}}</td>
										              <td>
										                 
										              <a type="button" href="{{route('repondre.feedback', $feedbacks->id)}}" class="btn" style = "background-color:#1561a2; color:white">Répondre</a>
										             
										              </td>
										          </tr>
										         	@endforeach
										    	@endforeach      
										       
										      </tbody>
						</table>
						 @endif
								    
						
                    </div>
                </div>
            </div>
        </div>
    </div></div>

                       <!-- end formulaire1 --> 
                       
                      

                            
                                           
                    
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
</body>
</html>
