<!doctype html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="short icon" href="{{asset('collov2/assets/images/icon.png')}}">
    <title>Collaboratis | Tableau de bord</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
    
<link href="{{asset('v2/main.css')}}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
<link rel="stylesheet" href="{!! asset('assets/css/styles.css') !!}">
<link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css">

      
<!--Polices-->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{!! asset ('assets/plugins/magnific-popup/dist/magnific-popup.css') !!}">
    <link rel="stylesheet" href="{!! asset ('assets/plugins/jquery-datatables-editable/datatables.css') !!}">
    
    <!-- DataTables -->
    <link href="{!! asset ('assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css') !!}" />
    <link href="{!! asset ('assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css') !!}" />
    <link href="{!! asset ('assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css') !!}" />
    <link href="{!! asset ('assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css') !!}" />
    <link href="{!! asset ('assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css') !!}" />

    <!--<link href="{!! asset ('assets/css/bootstrap.min.css" rel="stylesheet" type="text/css') !!}">-->
    <link href="{!! asset ('assets/css/core.css" rel="stylesheet" type="text/css') !!}">
    <link href="{!! asset ('assets/css/icons.css" rel="stylesheet" type="text/css') !!}">
    <link href="{!! asset ('assets/css/components.css" rel="stylesheet" type="text/css') !!}">
    <link href="{!! asset ('assets/css/pages.css" rel="stylesheet" type="text/css') !!}">
    <link href="{!! asset ('assets/css/menu.css" rel="stylesheet" type="text/css') !!}">
    <link href="{!! asset ('assets/css/responsive.css" rel="stylesheet" type="text/css') !!}">

    <script src="{!! asset ('assets/js/modernizr.min.js') !!}"></script>

</head>

<body>
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       Assigner une activité :
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
               <div class="row" style= "text-align : center;">
                   <h3  style="font-family: 'poppins', sans-serif; font-size : 16px ;text-align : center;" >Souhaitez-vous assigner une activité basée sur un modèle ?  </h3>
                  <table style="margin-top : 5%; margin-right : 20%;">
                      <tr>
                          <td>
                            <a href="/modeles_activites" type="button" class="btn  btn-green">Oui</a>
                          </td>
                          <td>
                            <a href="/create_dg" type="button" class="btn  btn-warning">Non</a>
                          </td>
                      </tr>
                  </table>
                </div>
            </div>
              
            
        
      </div>
 
    </div>
  </div>
</div>

    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
            <!--header -->
            @include('v2.header_dg')
            <!-- end header -->

        <div class="app-main">
                <!-- side bar -->
                @include('v2.side_bar_dg')

                <!-- end side bar -->
                <div class="app-main__outer">
                    <div class="app-main__inner">
    <h4 class="">Appréciation Recu</h4>

                       <!-- formulaire 1-->
                       
                       
    <div class="row" id="formulaire">
        <div class="card col-lg-12 mt-4 mb-10">
            <div class="card-body">
                <div id="inputFormRow">
                    <div class="input-group row mb-3">
                       <table class="table table-hover table-rounded  ">
										      <thead>
										          <tr>
										              <th>Agent</th>
										              <th>Les 3  choses apprecier</th>
										              <th>Les 3 choses a ameliorer</th>
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
										              <td>{{$feedbackdonners->apprecier_1}} , {{$feedbackdonners->apprecier_2}}, {{$feedbackdonners->apprecier_3}}</td>
										              <td>{{$feedbackdonners->ameliorer_1}}, {{$feedbackdonners->ameliorer_2}}, {{$feedbackdonners->ameliorer_3}}</span></td>
										       
										          </tr>
										      @endforeach
										      </tbody>
						</table>
						<table class="table table-hover table-rounded  ">
										      <thead>
										          <tr>
										              <th>Les critères</th>
										          </tr>
										      </thead>
										      <tbody>
										      @foreach($feedbackdonner as $feedbackdonners)
										          <tr>
										         <?php $critere = DB::table('critere_feedbacks')->where('feedback_id', $feedbackdonners->id)->get(); ?>
										           <td>
										          @foreach($critere as $criteres)
										             {{$criteres->nom_critere}} : {{$criteres->note_critere}}/5 <br>
										          @endforeach
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
<script src="https://cdn.metroui.org.ua/v4.3.2/js/metro.min.js"></script>
<script src="{{asset('v2/main.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<script src="{!! asset('assets/js/script.js') !!}"></script>

</body>
</html>
