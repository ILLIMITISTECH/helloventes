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


 
                <!-- end side bar -->
                <main id="main" class="main">

        <section class="section" style = "margin-left : 100px">
      <div class="row">
        <div class="col-lg-10">
          <div class="card">
            <div class="card-body">
                <br><br> 
                    <div class="row">
                      
                    @php  $agent_groupe = DB::table('agents')->where('nom', $personne_choisi->groupe)->first();@endphp
                  
                    @php  $feedback_groupe = DB::table('feedback')->where('agents_id_choisi', $agent_groupe->id)->where('choix', 'feedback')->where('source_id', $source->id)->get(); @endphp
                        
						 <!--@php $a = DB::table('agents')->where('user_id', Auth::user()->id)->first(); @endphp-->
						 @php $clf = DB::table('client_facilitateurs')->where('entreprise_id',$agent_groupe->entreprise)->first(); @endphp
							@php $facilitateur = DB::table('facilitateurs')->where('id', $clf->facilitateur_id)->first(); @endphp
					     		<div align="left" class="col-lg-6">
					     		    <span style="font-family: 'MarkOffcPro-Book', arial; color: #1561a2;; font-size: 20px; line-height: 24px;">
                                <span class="outlookFallback">{{$agent_groupe->prenom}}&nbsp;{{$agent_groupe->nom}}</span></span>
                               
						        </div>
						    <div align="right" class="col-lg-6">
						        <span style="font-family: 'MarkOffcPro-Book', arial; color: #1561a2;; font-size: 20px; line-height: 20px;">
                                Facilitateur : <span class="outlookFallback" style="color:black;">{{$facilitateur->prenom}} {{$facilitateur->nom}}</span></span>
                               
						    </div>
						     
					     	</div>
					     	
					     	<br>
						<!--<div  align="left" class="row align-items-left">
                        <div class="col-md-12 col-12 align-self-left">
                            <h2 class="page-title mb-0 p-0" style="text-align:center; font-family: 'MarkOffcPro-Book', arial; black;">Team Feedback Report - </h2>
                        </div>
                       </div>-->
                        <div class="row">
						
							
					     		<div align="left" valign="top:10px"><span style="font-family: 'MarkOffcPro-Book', arial; color: #1561a2;; font-size: 25px; line-height: 24px; margin-left:10px;  margin-top:20px;">
                                @php setlocale (LC_ALL, "fr_FR");  @endphp
                                <span class="outlookFallback">Global 360 Feedback Report - <span style="font-size: 20px;">  {{strftime("%d %B, %Y", strtotime($source->date_fin))}}</span></span></span>
                               
						    </div>
					     	</div>
                       <br><br>
                     <div class="row">
                     <div align="left" valign="top">
                         <span style="font-family: 'MarkOffcPro-Book', arial; black; font-size: 20px; line-height: 24px; margin-left:20px;">
                           <span class="outlookFallback" style="color:#1561a2;">Origine :  <span style="font-size: 18px;"> 
                           @foreach($feedback_groupe as $feedbacks)
                                    @php $source_nom = DB::table('source_feedbacks')->where('id', $feedbacks->source_id)->first(); @endphp
                                @endforeach
                                   </span></span> </span>@if($source_nom)
                                        {{$source_nom->nom_source}}
                                    @endif<br><br>
						</div> 
                   
                  </div>  
                  <hr>
                 
                      @php
                      $var = array();
                            $feed = DB::table('feedback')->where('agents_id_choisi', $agent_groupe->id)->get();
                            foreach ($feed as $feeds){
                                $somme_note = $feeds->note;
                                array_push($var,$somme_note);
                            }
                            $total_somme_note = array_sum($var);
                            $nb_note = count($var);
                            $notes = $nb_note == 0 ? 0 :  $total_somme_note / $nb_note;
                      @endphp
                   
                       <div class="row align-items-center">
                            <div class="col-md-12 col-12 align-self-center">
                                <span style="font-family: 'MarkOffcPro-Book', arial; black; font-size: 20px; line-height: 24px; margin-left:20px;">
                               <span class="outlookFallback" style="color:#1561a2;">Moyenne de satisfaction de ma team envers moi : </span></span>{{intval($notes)}}/10 <br><br><hr>
    						</div>
						</div>
				
				
				 <div class="row align-items-center">
                    <div class="col-md-12 col-12 align-self-center">
                        <span style="font-family: 'MarkOffcPro-Book', arial; color: black; font-size: 20px; line-height: 24px; margin-left:20px;">
                           <span class="outlookFallback" style="color:#1561a2;"> Compétences clés à développer: </span></span><hr>
                            @php $competences = DB::table('competences')->get(); @endphp
                       @foreach($competences as $competence)
                         @if($competence)
                          @php
                      $var = array();
                            $feed = DB::table('feedback')->where('agents_id_choisi', $personne_choisi->id)->where('competence_id', $competence->id)->get();
                            foreach ($feed as $feeds){
                                $somme_note = $feeds->note;
                                array_push($var,$somme_note);
                            }
                            $total_somme_note = array_sum($var);
                            $nb_note = count($var);
                            $notesC = $nb_note == 0 ? 0 :  $total_somme_note / $nb_note;
                            
                            $feedf = DB::table('feedback')->where('agents_id_choisi', $agent_groupe->id)->where('competence_id', $competence->id)->first();
                      @endphp
                       @if($feedf)
                        <ul>
                           
                            @if($feedf->note != 0)
                            <li>{{$competence->libelle}} : {{intval($notesC)}}/10</li>
                             @endif
                              
                        </ul>
                        @endif
                        @endif
                       @endforeach
						</div>
                 	</div>
					<hr>
				   
                        <div class="row align-items-center">
                          <div class="col-md-12 col-12 align-self-center">
                              <span style="font-family: 'MarkOffcPro-Book', arial; black; font-size: 20px; line-height: 24px; margin-left:20px;">
                           <span class="outlookFallback" style="color:#1561a2;"> Feedbacks Positifs : </span></span><hr>
                            @foreach($feedback_groupe as $feedbacks)
                            @if($feedbacks)
                           <ul style="list-style-type:">
                             <li>{{ ($feedbacks->apprecier_1 && $feedbacks->crypted) ? decrypt($feedbacks->apprecier_1) : ' '}}, {{ ($feedbacks->apprecier_2 && $feedbacks->crypted) ? decrypt($feedbacks->apprecier_2) : ' '}}, {{ ($feedbacks->apprecier_3 && $feedbacks->crypted) ? decrypt($feedbacks->apprecier_3) : ' '}}</li>
                             <!--<li>{{ ($feedbacks->apprecier_2 && $feedbacks->crypted) ? decrypt($feedbacks->apprecier_2) : ' '}}</li>
                             <li>{{ ($feedbacks->apprecier_3 && $feedbacks->crypted) ? decrypt($feedbacks->apprecier_3) : ' '}}</li>-->
                            </ul>
                            @endif
                            @endforeach
						   </div>
                    	</div>
                     <hr>
                     
      
                     <div class="row align-items-center">
                    <div class="col-md-12 col-12 align-self-center">
                        <span style="font-family: 'MarkOffcPro-Book', arial; color: black; font-size: 20px; line-height: 24px; margin-left:20px;">
                           <span class="outlookFallback" style="color:#1561a2;"> Feedbacks Constructifs : </span></span><hr>
                     @foreach($feedback_groupe as $feedbacks)
                     @if($feedbacks)
                     <ul style="list-style-type:">
                     <li>{{ ($feedbacks->ameliorer_1 && $feedbacks->crypted) ? decrypt($feedbacks->ameliorer_1)  : ' '}}, {{ ($feedbacks->ameliorer_2 && $feedbacks->crypted) ? decrypt($feedbacks->ameliorer_2)  : ' '}}, {{ ($feedbacks->ameliorer_3 && $feedbacks->crypted) ? decrypt($feedbacks->ameliorer_3)  : ' '}}</li>
                    <!-- <li>{{ ($feedbacks->ameliorer_2 && $feedbacks->crypted) ? decrypt($feedbacks->ameliorer_2)  : ' '}}</li>
                     <li>{{ ($feedbacks->ameliorer_3 && $feedbacks->crypted) ? decrypt($feedbacks->ameliorer_3)  : ' '}}</li>-->
                     </ul>
                     @endif
                    @endforeach
						</div>
						</div>
                 
   
                    </div>
                    	<div align="center" valign="top:10px"><span style="font-family: 'MarkOffcPro-Book', arial; color: #1561a2;; font-size: 15px; line-height: 24px; margin-top:20px;">
Rapport généré via la plateforme <b>Byfeeding</b> | <a href="www.byfeeding.com" traget=_blanc>www.byfeeding.com</a>  | By feeding we grow !</span> </div>  
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
                </div>
                
            </div>
        </div>
        
    </section>

                       <!-- end formulaire1 --> 
                       
                      

                            
                                       
                    
                    </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </main>
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

