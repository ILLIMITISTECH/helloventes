 <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Dashboard Card -->
            <div class="col-xxl-12 col-md-12" >
              <div class="card info-card sales-card text-white" style = "background: #1561a2;">
                <div class="card-body" >
                  <h5 class="card-title text-white">Bonjour {{Auth::user()->prenom}} {{Auth::user()->nom}} !  </span></h5>
                        Bienvenue sur votre Tableau de bord. Vous pouvez consulter vos feedbacks et vous améliorer.
                </div>
              </div>
            </div><!-- End Dashboard Card -->
        </div>
            <!-- Revenue Card -->
        <div class="row">
            @if(Auth::user()->nom_role == 'adminF')
            <h5>
      @if (session('message'))
                  <div class="alert alert-success" role="alert">
                  {{ session('message') }}
                  </div>  
                  @endif
    </h5>
             
            <div class="col-xxl-2 col-xl-6">

              <div class="card info-card customers-card">

               

                <div class="card-body">
                  <h5 class="card-title" style="color:#1561a2">Envoyer mail avec one click</h5>

                  <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-activity" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2Z"/></svg>
                    <div class="ps-3" style="color : #1561a2; font-size : 40px">
                        
                       <form action="{{route('sendpassword')}}" method="post">
                           {{csrf_field()}}
                           <button type="submit">Phase 1</button>
                       </form>
                        
                    </div>
                  </div>

                </div>
              </div>

            </div>
            
            <div class="col-xxl-2 col-xl-6">

              <div class="card info-card customers-card">

               

                <div class="card-body">
                  <h5 class="card-title" style="color:#1561a2">Envoyer mail avec one click</h5>

                  <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-activity" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2Z"/></svg>
                    <div class="ps-3" style="color : #1561a2; font-size : 40px">
                        
                       <form action="{{route('phase2')}}" method="post">
                           {{csrf_field()}}
                           <button type="submit">Phase 2</button>
                       </form>
                        
                    </div>
                  </div>

                </div>
              </div>

            </div>
            
            <!---------------------------------------------------------------------------------------------------------------------->
            
            @php 
                $nombre_participant = DB::table('agents')->where('nom_role', 'entreprise')->count();
                $nombre_feedback = DB::table('feedback')->where('choix', 'feedback')->count();
                $nombre_facilitateur = DB::table('facilitateurs')->count();
                $p = 0 ;
                $nombre_pays = DB::table('agents')->select('pays_id')->groupby('pays_id')->where('nom_role', 'entreprise')->where('pays_id', '!=', null)->get();
                    
            @endphp
                @foreach($nombre_pays as $nombre_pay)
                                
                    @php $p ++ ; @endphp
                      
                @endforeach
            <div class="col-xxl-4 col-xl-3" style= " height:50px;">

              <div class="card info-card customers-card">

               

                <div class="card-body">
                  <h5 class="card-title" style="color:#1561a2">Nombre total de participants </h5>

                  <div class="d-flex align-items-center">
                     <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="black" class="bi bi-people" viewBox="0 0 16 16"><path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/></svg>
                    
                    <div class="ps-3" style="color : #1561a2; font-size : 40px">{{$nombre_participant}}</div>
                  </div>

                </div>
              </div>

            </div>
            
            <!-- End Revenue Card -->
           
            
            <div class="col-xxl-4 col-xl-3" style= " height:50px;">

              <div class="card info-card customers-card">


                <div class="card-body">
                    <a class="nav-link " href="/facilitateurs">
               <h5 class="card-title" style="color:#1561a; ">Nombre total de facilitateurs</h5>

                  <div class="d-flex align-items-center">
                     <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="black" class="bi bi-people" viewBox="0 0 16 16"><path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/></svg>
                    <div class="ps-3" style="color : #1561a2; font-size : 30px">{{$nombre_facilitateur}}</div>
                  </div>
</a>
                </div>
              </div>

            </div>
            
            
            <div class="col-xxl-4 col-xl-3" style= " height:50px;">

              <div class="card info-card customers-card">

               

                <div class="card-body">
                  <h5 class="card-title" style="color:#1561a2">Nombre total de feedbacks </h5>

                  <div class="d-flex align-items-center">
                        <img src="{{asset('images/feed.png')}}" alt="" width="50px;" height="50px;">                    
                    <div class="ps-3" style="color : #1561a2; font-size : 40px">{{$nombre_feedback}}</div>
                  </div>

                </div>
              </div>

            </div>
            
            
            <div class="col-xxl-4 col-xl-3" style= " height:50px;">

              <div class="card info-card customers-card">


                <div class="card-body">
                    <a class="nav-link " href="/liste_pays">
                  <h5 class="card-title" style="color:#1561a; ">Nombre total de pays</h5>

                  <div class="d-flex align-items-center">
                     <img src="{{asset('images/des-pays.png')}}" alt="" width="50px;" height="50px;">  
                   <div class="ps-3" style="color : #1561a2; font-size : 40px">{{$p}}</div> 
                  </div>
                    </a>
                </div>
              </div>

            </div>
            
        
          
            
            
            @else
             <h5>
      @if (session('message'))
                  <div class="alert alert-success" role="alert">
                  {{ session('message') }}
                  </div>  
                  @endif
    </h5>
            <div class="col-xxl-4 col-xl-3" style= " height:50px;">

              <div class="card info-card customers-card">

               

                <div class="card-body">
                  <h5 class="card-title" style="color:#1561a2">Feedbacks reçus</h5>

                  <div class="d-flex align-items-center">
                     <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="black" class="bi bi-people" viewBox="0 0 16 16"><path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/></svg>
                    
                    <div class="ps-3" style="color : #1561a2; font-size : 40px">{{$feedback}}</div>
                  </div>

                </div>
              </div>

            </div>
            <div class="col-xxl-4 col-xl-3" style= " height:50px;">

              <div class="card info-card customers-card">

               

                <div class="card-body">
                  <h5 class="card-title" style="color:#1561a2">Feedbacks donnés </h5>

                  <div class="d-flex align-items-center">
                     <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="black" class="bi bi-people" viewBox="0 0 16 16"><path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/></svg>
                    
                    <div class="ps-3" style="color : #1561a2; font-size : 40px">{{$feedbackdonner}}</div>
                  </div>

                </div>
              </div>

            </div>
            <!-- End Revenue Card -->
           
            
            <div class="col-xxl-4 col-xl-3" style= " height:50px;">

              <div class="card info-card customers-card">


                <div class="card-body">
                  <h5 class="card-title" style="color:#1561a; ">Satisfaction de travailler avec moi</h5>

                  <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-activity" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2Z"/></svg>
                    <div class="ps-3" style="color : #1561a2; font-size : 40px">{{intval($notes)}} <span style="color:black">/ 10</span></div>
                  </div>

                </div>
              </div>

            </div>
            
            @php $entreprise_a = DB::table('client_facilitateurs')->where('entreprise_id', Auth::user()->entreprise)->first();
                $source = DB::table('source_feedbacks')->where('id', $entreprise_a->source_id)->first();
            @endphp
            @if($source->statut == 1 and $source->phase == 2)
             @if(Auth::user()->a_contacter == "responsable")
           <div class="col-xxl-4 col-xl-3" style= " height:50px;">

              <div class="card info-card customers-card">

                <div class="card-body">
            <a class="nav-link " href="/rapport_globale_responsable" target="_blank">
               
                  <h5 class="card-title" style="color:#1561a2">Rapport global</h5>

                  <div class="d-flex align-items-center">
                <a class="nav-link " href="/rapport_globale_responsable" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-layout-text-window" viewBox="0 0 16 16">
                  <path d="M3 6.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v1H1V2a1 1 0 0 1 1-1h12zm1 3v10a1 1 0 0 1-1 1h-2V4h3zm-4 0v11H2a1 1 0 0 1-1-1V4h10z"/>
                </svg>                    <div class="ps-3" style="color : #1561a2; font-size : 40px"></div></a>
                  </div>
                </a>
                </div>
              </div>

            </div>
            @endif
            @endif
            @endif
            
            <!-- End Revenue Card -->

             <div class="col-lg-12" style= " margin-top:150px">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Mes suggestions de compétences clés à développer au cours des 6 prochains mois</h5>

              <!-- Bar Chart -->
              <div id="piechart" style="width: 100%; height: 500px;">&nbsp;</div>

            <script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart() {
// Chart 1
var data = google.visualization.arrayToDataTable([['OS Mobile', 'Parts de marché'],["Leadership",{{$competence_1}}],["Management",{{$competence_2}}],["Confiance en soi",{{$competence_3}}],["Délégation",{{$competence_4}}],["Écoute active",{{$competence_5}}],["Gestion de conflits",{{$competence_6}}],["Techniques de Vente et négociation",{{$competence_7}}],["Prise de parole en public",{{$competence_8}}],["Travail en équipe",{{$competence_9}}],["Intelligence émotionnelle",{{$competence_10}}],["Focus et productivité",{{$competence_11}}],["Orientation resultat",{{$competence_12}}]]);
var options = {
};
var chart = new google.visualization.PieChart(document.getElementById('piechart'));
chart.draw(data, options);
}
</script>

              <!-- End Bar Chart -->

            </div>
          </div>
        </div>
          </div>
      
    </section>