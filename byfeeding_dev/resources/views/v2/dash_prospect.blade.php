 <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Dashboard Card -->
            <div class="col-xxl-4 col-md-4" >
              <div class="card info-card sales-card text-white" style = "background: #1561a2;">
                <div class="card-body" >
                  <h5 class="card-title text-white">Bonjour {{Auth::user()->prenom}} !  </span></h5>
                        Bienvenue sur votre Tableau de bord Feedback. Vous pouvez invité vos collegues
                </div>
              </div>
            </div><!-- End Dashboard Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-xl-4">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title" style="color:#1561a2">Feedbacks demandés </h5>

                  <div class="d-flex align-items-center">
                     <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="black" class="bi bi-people" viewBox="0 0 16 16"><path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/></svg>
                    
                    <div class="ps-3" style="color : #1561a2; font-size : 40px">{{$feedbackdemander}}</div>
                  </div>
                </div>
              </div>
        </div>    
                          @php $rep = array(); @endphp
                                        @foreach($feedback as $feedb)
                                        @foreach($feedb as $feedbacks)
                                        
									        <?php  $reponse = DB::table('reponse_feedback')->where('demande_feedback_id', $feedbacks->id)->get();  
									       // dd($reponse);
									        array_push($rep, $reponse); ?>
									        
									    @endforeach  
										@endforeach 
              <div class="col-xxl-4 col-xl-4">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title" style="color:#1561a2">Feedbacks reçus </h5>

                  <div class="d-flex align-items-center">
                     <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="black" class="bi bi-people" viewBox="0 0 16 16"><path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/></svg>
                    
                    <div class="ps-3" style="color : #1561a2; font-size : 40px">{{count($rep)}}</div>
                  </div>

                </div>
              </div>

            </div>
            <!-- End Revenue Card -->
                        
             <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Nombre de Feedback mensuel</h5>

              <!-- Bar Chart -->
              <div id="barChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#barChart"), {
                    series: [{
                      data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
                    }],
                    chart: {
                      type: 'bar',
                      height: 350
                      
                    },
                    plotOptions: {
                      bar: {
                        borderRadius: 4,
                        horizontal: true,
                      }
                    },
                    dataLabels: {
                      enabled: false
                    },
                    xaxis: {
                      categories: ['Novembre', 'Décembre', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai',
                        'Juin', 'Juillet', 'Aout'
                      ],
                    }
                  }).render();
                });
              </script>
              <!-- End Bar Chart -->

            </div>
          </div>
        </div>
          </div>
      
    </section>






