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

            <!-- formulaire -->
                              
<section class="section">
             <br>
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
                             
                                 <div class="d-md-flex">
                                                <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Toutes mes actions </h4>
                                            </div> 
                                            @php
                                               $segment = request()->input('search');
                                               echo $segment; // article
                                            @endphp
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Agent</th>
                                                <th class="border-top-0">Email</th>
                                                <!--<th class="border-top-0">Mobile</th>-->
                                                <!--<th class="border-top-0">Naissance</th>-->
                                                <th class="border-top-0">Expériences</th>
                                                <th class="border-top-0">LinkedIn </th>
                                                <th class="border-top-0">Compétences </th>
                                                 <th class="border-top-0">Souhait </th>
                                                <th class="border-top-0">Postes </th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($suivis->isEmpty() )
                                             <p>Pas de suivi</p>
                                            @else
                                            @foreach($suivis as $suivi) 
                                        
                                     @php  $agents = DB::table ('agents')->where('id', $suivi->agent_id)->first();  
                                            $competence1 = DB::table ('competences')->where('id', $suivi->competence_dev1)->first(); 
                                            $competence2 = DB::table ('competences')->where('id', $suivi->competence_dev2)->first(); 
                                            $competence3 = DB::table ('competences')->where('id', $suivi->competence_dev3)->first(); 
                                     @endphp
                                     <tr>
                                                <td class="align-middle" data-toggle="tooltip" title=""> {{$agents ? $agents->prenom : '-'}} {{$agents ? $agents->nom : '-'}}</td>
                                                <td class="align-middle" data-toggle="tooltip" title=""> {{$suivi->email}} / {{$suivi->tel}}</td>
                                                <!--<td class="align-middle" data-toggle="tooltip" title=""> {{$suivi->tel}}</td>-->
                                                <!--<td class="align-middle" data-toggle="tooltip" title=""> {{$suivi->date_naiss}}</td>-->
                                                <td class="align-middle" data-toggle="tooltip" title=""> {{$suivi->nombre_annee_pro	}} ans</td>
                                                <td class="align-middle" data-toggle="tooltip" title=""> {{$suivi->lien_LinkedIn}}</td>
                                                <td class="align-middle" data-toggle="tooltip" title=""> {{$competence1 ? $competence1->libelle : '-'}}, {{$competence2 ? $competence2->libelle : '-'}}, {{$competence3 ? $competence3->libelle : '-'}}</td>
                                                <td class="align-middle" data-toggle="tooltip" title=""> {{$suivi->souhait}}</td>
                                                <td class="align-middle" data-toggle="tooltip" title=""> {{$suivi->poste_job}}</td>
                   <!--</form>-->
                                        </tr>
                                        @endforeach
                                                     @endif
                                            </tbody>
                                                   
                                    
                                                            
                                                             
                                        </table>
                                        
                                        
                                        
                                        
                                
                           
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
<script src="{{asset('v2/main.js')}}"></script>

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    
 
               
               
            </div>
          
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
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
 <style>
    multi-input input::-webkit-calendar-picker-indicator {
      display: none;
    }
    /* NB use of pointer-events to only allow events from the × icon */
    multi-input div.item::after {
      color: black;
      content: '×';
      cursor: pointer;
      font-size: 18px;
      pointer-events: auto;
      position: absolute;
      right: 5px;
      top: -1px;
    }
    

    </style>
   
    <style>
    :host {
      border: var(--multi-input-border, 1px solid #ddd);
      display: block;
      overflow: hidden;
      padding: 5px;
    }
    /* NB use of pointer-events to only allow events from the × icon */
    ::slotted(div.item) {
      background-color: var(--multi-input-item-bg-color, #dedede);
      border: var(--multi-input-item-border, 1px solid #ccc);
      border-radius: 2px;
      color: #222;
      display: inline-block;
      font-size: var(--multi-input-item-font-size, 14px);
      margin: 5px;
      padding: 2px 25px 2px 5px;
      pointer-events: none;
      position: relative;
      top: -1px;
    }
    /* NB pointer-events: none above */
    ::slotted(div.item:hover) {
      background-color: #eee;
      color: black;
    }
    ::slotted(input) {
      border: none;
      font-size: var(--multi-input-input-font-size, 14px);
      outline: none;
      padding: 10px 10px 10px 5px; 
    }
    </style>
    
        </script>

 
 
 
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
</body>
</html>