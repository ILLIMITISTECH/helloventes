
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Byfeeding</title>
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

    <div class="pagetitle" style = "text-align : center;">
      <h1 style =" color:#4154f1">Donner un feedback</h1>
                          <!--<a type="button" href="/agent_feed_restant" class="btn" style = "background-color:blue; color:#4154f1">Les Collègues restants</a>-->

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
                              
         <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
                  <br>
 <div class="pagetitle" style = "text-align : center;">
      <!--<h1 style =" color:#4154f1">Donner un feedback</h1>-->
        @php   $as = DB::table('agents')->where('user_id', Auth::user()->id)->first(); 
            // $sourcess = DB::table('source_feedbacks')->get();
            $clfss = DB::table('client_facilitateurs')->where('entreprise_id',$as->entreprise)->orwhere('entreprise_id',$as->entreprise_2)->orderBy('id', 'desc')->first(); 
	
            $feedsGFs = DB::table('feedback')->where('agent_id', $as->id)->where('source_id', $clfss->source_id)->pluck('agents_id_choisi')->toArray(); 
            $gss = DB::table('agents')->where('id', '!=', $as->id)->where('entreprise', $as->entreprise)->orderBy('prenom', 'ASC')->pluck('id')->toArray();
                
                 $resultss = array_diff($gss, $feedsGFs);
                
        @endphp  
@if(count($resultss) == 0)
        <a type="button" href="#" class="btn" style = "background-color:orange; color:#4154f1">Bravo, vous avez donné des feedbacks a tous vos collègues pour cette session</a>
        @else
            <a type="button" href="/agent_feed_restant" class="btn" style = "background-color:orange; color:#4154f1">Voir les {{count($resultss)}} collègues en attente de feedback</a>
        @endif            
            </div>
              <!-- General Form Elements -->
              <form class="row " action="/feedback/donner" method="post">
                  {{csrf_field()}}
                  @php $a = DB::table('agents')->where('user_id', Auth::user()->id)->first(); @endphp
                 @if ($a->entreprise == 12)
                  <div class="row mb-3" >
                  <label class="col-sm-12 col-form-label">Collègue f</label>
                  <div class="col-sm-12">
                    <select class="form-select" name="agents_id_choisi" aria-label="Default select example">
                      <option value="{{$a_feed_restant->id}}">{{$a_feed_restant->prenom}} {{$a_feed_restant->nom}}</option>
                          @php 
                           $a = DB::table('agents')->where('user_id', Auth::user()->id)->first(); 
                           $feedsGF = DB::table('feedback')->where('agent_id', $a->id)->pluck('agents_id_choisi')->toArray(); 
                           $g = DB::table('agents')->where('entreprise', $a->entreprise)->where('id', '!=', $a->id)->pluck('id')->toArray();
                           $results = array_diff($g, $feedsGF);
                          @endphp
                      @foreach($results as $agent_rest)  
                       @php $agent = DB::table('agents')->where('id', $agent_rest)->first(); @endphp
                      <option value="{{$agent->id}}">{{$agent->prenom}} {{$agent->nom}}</option>
                     
                      @endforeach
                    </select>
                  </div>
                </div><br><br>
                <div class="row mb-3">
                  <label class="col-sm-12 col-form-label">Source Feedback</label>
                  <div class="col-sm-12">
                      
                    <select class="form-select" name="source_id" aria-label="Default select example">
                          @foreach($sources as $source)  
                          @php $a = DB::table('agents')->where('user_id', Auth::user()->id)->first(); @endphp
										         @php $clf = DB::table('client_facilitateurs')->where('entreprise_id',$a->entreprise)->first(); @endphp
										         @if($source->id == $clf->source_id)
                              <option value="{{$source->id}}" selected>{{$source->nom_source}}</option>
                          @endif
                          @endforeach
                    </select>
                  </div>
                </div><br><br>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-12 col-form-label">Les 3 choses que j’apprécie le plus chez cette personne</label>
                  <div class="col-sm-12">
                      <span style="color:red">*</span>
                    <textarea width = "50" heigth ="400px" class="form-control" name="apprecier_1" placeholder="Soyez précis" required></textarea>
                  </div>
                  <div class="col-sm-12">
                      <span style="color:red">*</span>
                    <textarea width = "50" heigth ="400px" class="form-control" name="apprecier_2" placeholder="Soyez précis" required></textarea>
                  </div>
                  <span style="color:white">*</span>
                  <div class="col-sm-12">
                    <textarea width = "50" heigth ="400px" class="form-control" name="apprecier_3" placeholder="Soyez précis" ></textarea>
                  </div>
                </div><br><br>
               
                 <fieldset class="row mb-3">
                  <label for="customRange3" class="form-label">A combien estimez-vous votre satisfaction à travailler avec ce collègue ? (utilisez la barre ci-dessous pour noter de 1 à 10) <div class="btn btn-primary">Note: <span id="demo"></span></div></label>
                  <div class="col-sm-10">
                    <input type="range" name="note" class="form-range" min="0" max="10" value="0" step="1"  id="customRange3">
                  </div>
                  <br><br>
                   

                   <label class="col-sm-12 col-form-label">Quelle est la compétence clé que vous souhaitez voir votre collègue développer au cours des 6 prochains mois ? </label>
                      <div class="col-sm-12">
                          
                        <select class="form-select" name="competence_id" aria-label="Default select example">
                            <option value="0" selected>Sélectionner</option>
                              @foreach($competences as $competence)  
                                  <option value="{{$competence->id}}">{{$competence->libelle}}</option>
                              @endforeach
                        </select>
                      </div>
                </fieldset>
                

                <!-----------------------------------------------------------------------autres entreprises------------------------------------->
                 @else() 
                  <h2></h2> <h2></h2>
                <div class="row mb-3" >
                  <label class="col-sm-12 col-form-label">Collègue</label>
                  <div class="col-sm-12">
                       @php $a = DB::table('agents')->where('user_id', Auth::user()->id)->first(); @endphp
                      @php $fedds = DB::table('feedback')->where('agent_id', $a->id)->get(); $aEntreprisesfs = array();  @endphp
                      
                      @php $aEntreprises = DB::table('agents')->where('entreprise', $a->entreprise)->orderBy('prenom', 'asc')->get();   @endphp
                     
                    <select class="form-select" name="agents_id_choisi" aria-label="Default select example">
                      <option value="{{$a_feed_restant->id}}">{{$a_feed_restant->prenom}} {{$a_feed_restant->nom}}</option>
                          @php 
                           $a = DB::table('agents')->where('user_id', Auth::user()->id)->first(); 
                           $feedsGF = DB::table('feedback')->where('agent_id', $a->id)->pluck('agents_id_choisi')->toArray(); 
                           $g = DB::table('agents')->where('entreprise', $a->entreprise)->where('id', '!=', $a->id)->pluck('id')->toArray();
                           $results = array_diff($g, $feedsGF);
                          @endphp
                      @foreach($results as $agent_rest)  
                       @php $agent = DB::table('agents')->where('id', $agent_rest)->first(); @endphp
                      <option value="{{$agent->id}}">{{$agent->prenom}} {{$agent->nom}}</option>
                     
                      @endforeach
                    </select>
                  </div>
                </div><br><br>
                <div class="row mb-3">
                  <label class="col-sm-12 col-form-label">Source Feedback</label>
                  <div class="col-sm-12">
                      
                    <select class="form-select" name="source_id" aria-label="Default select example">
	@foreach($sources as $source)
                          @php $a = DB::table('agents')->where('user_id', Auth::user()->id)->first(); @endphp
						  @php $clf = DB::table('client_facilitateurs')->where('entreprise_id',$a->entreprise)->orwhere('entreprise_id',$a->entreprise_2)->orderBy('id', 'desc')->first(); @endphp
							
									@if($source->id == $clf->source_id)
                              <option value="{{$source->id}}" selected>{{$source->nom_source}}</option>
                          @endif
                          @endforeach
                    </select>
                  </div>
                </div><br><br>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-12 col-form-label">Les 3 choses que j’apprécie le plus chez cette personne</label>
                  <div class="col-sm-12">
                      <span style="color:red">*</span>
                    <textarea width = "50" heigth ="400px" class="form-control" name="apprecier_1" placeholder="Soyez précis" required></textarea>
                  </div>
                  <div class="col-sm-12">
                      <span style="color:red">*</span>
                    <textarea width = "50" heigth ="400px" class="form-control" name="apprecier_2" placeholder="Soyez précis" required></textarea>
                  </div>
                  <span style="color:white">*</span>
                  <div class="col-sm-12">
                    <textarea width = "50" heigth ="400px" class="form-control" name="apprecier_3" placeholder="Soyez précis" ></textarea>
                  </div>
                </div><br><br>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-12 col-form-label">Les 3 choses que j’aimerais que cette personne développe et ou améliore</label>
                  <div class="col-sm-12">
                      <span style="color:red">*</span>
                    <textarea width = "50" heigth ="400px" class="form-control" name="ameliorer_1" placeholder="Soyez précis" required></textarea>
                  </div>
                  <div class="col-sm-12">
                      <span style="color:red">*</span>
                    <textarea width = "50" heigth ="400px" class="form-control" name="ameliorer_2" placeholder="Soyez précis" required></textarea>
                  </div>
                  <span style="color:white">*</span>
                  <div class="col-sm-12">
                    <textarea width = "50" heigth ="400px" class="form-control" name="ameliorer_3" placeholder="Soyez précis" ></textarea>
                  </div>
                </div><br><br>
                
                 <fieldset class="row mb-3">
                  <label for="customRange3" class="form-label">A combien estimez-vous votre satisfaction à travailler avec {{$a_feed_restant->prenom}} {{$a_feed_restant->nom}} ? (utilisez la barre ci-dessous pour noter de 1 à 10) <div class="btn btn-primary">Note: <span id="demo"></span></div></label>
                  <div class="col-sm-10">
                    <input type="range" name="note" class="form-range" min="0" max="10" value="0" step="1"  id="customRange3">
                  </div>
                  <br><br>
                  <label for="penser3" class="form-label">A combien estimez-vous la satisfaction de {{$a_feed_restant->prenom}} {{$a_feed_restant->nom}} à travailler avec vous ? (utilisez la barre ci-dessous pour noter de 1 à 10) <div class="btn btn-primary">Note: <span id="penser"></span></div></label>
                  <div class="col-sm-10">
                    <input type="range" name="satisfaction_penser" class="form-range" min="0" max="10" value="0" step="1"  id="penser3">
                  </div>
                  <br><br>
                   <label class="col-sm-12 col-form-label">Quelle est la compétence clé que vous souhaitez voir votre collègue développer au cours des 6 prochains mois ? </label>
                      <div class="col-sm-12">
                          
                        <select class="form-select" name="competence_id" aria-label="Default select example">
                            <option value="0" selected>Sélectionner</option>
                              @foreach($competences as $competence)  
                                  <option value="{{$competence->id}}">{{$competence->libelle}}</option>
                              @endforeach
                        </select>
                      </div>
                </fieldset>
                
                <fieldset class="row mb-3">
                  <legend class="col-form-label col-sm-12 pt-0">Voulez vous partager ce feedback de manière anonyme ?</legend>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="type_ano" id="gridRadios1" value="0" >
                      <label class="form-check-label" for="gridRadios1">
                       Oui
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="type_ano" id="gridRadios2" value="1" checked>
                      <label class="form-check-label" for="gridRadios2">
                        Non
                      </label>
                    </div>
                   
                  </div><br><br>
                </fieldset>
                @endif

                <div class="row mb-3">
                  <div class="col-sm-10">
                    <button type="submit" class="btn" style = "background-color:#4154f1; color:white">Envoyer</button>
                  </div>
                  
                
                </div>
                
                

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>

        
      </div>
    </section>

                       <!-- end formulaire --> 
                
                                            
                                       
                    
                   
                            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
                           
            </main>


 
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
   	 <script>
var slider = document.getElementById("customRange3");
var output = document.getElementById("demo");

var sliders = document.getElementById("penser3");
var outputs = document.getElementById("penser");

output.innerHTML = slider.value;
slider.oninput = function() {
  output.innerHTML = this.value;
}

outputs.innerHTML = sliders.value;
sliders.oninput = function() {
  outputs.innerHTML = this.value;
}
</script>
</body>
</html>
