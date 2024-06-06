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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>

<body>
 @php
    $som_mois = 0 ;
    $action_du_mois = array() ;
    $som_moisfevrier = 0 ;
    $action_du_moisfevrier = array() ;
    $som_mois_mars = 0 ;
    $action_du_mois_mars = array() ;
    $som_moisavril = 0 ;
    $action_du_moisavril = array() ;
    $som_mois_mai = 0 ;
    $action_du_mois_mai = array() ;
    $som_mois_juin = 0 ;
    $action_du_mois_juin = array() ;
    $som_mois_juillet = 0 ;
    $action_du_mois_juillet = array() ;
    $som_mois_aout = 0 ;
    $action_du_mois_aout = array() ;
    $som_mois_septembre = 0 ;
    $action_du_mois_septembre = array() ;
    $som_mois_octobre = 0 ;
    $action_du_mois_octobre = array() ;
    $som_mois_novembre = 0 ;
    $action_du_mois_novembre = array() ;
    $som_mois_decembre = 0 ;
    $action_du_mois_decembre = array() ;
    $perfo_total_mois_janvier = 0 ; $perfo_total_mois_fevrier = 0 ; $perfo_total_mois_mars = 0 ; $perfo_total_mois_avril = 0 ; $perfo_total_mois_mai = 0 ; $perfo_total_mois_juin = 0 ;
    $perfo_total_mois_juillet = 0 ; $perfo_total_mois_aout = 0 ; $perfo_total_mois_septembre = 0 ; $perfo_total_mois_octobre = 0 ; $perfo_total_mois_novembre = 0 ; $perfo_total_mois_decembre = 0 ;
 @endphp
   
   @foreach($action_me as $action)
   
     @if( date('m', strtotime($action->deadline)) == 1)
        @php   array_push($action_du_mois, $action);
     
            $mois_count = count($action_du_mois);  

            $som_mois += ($action->pourcentage);
            
            $perfo_total_mois_janvier = $som_mois / $mois_count ;
         @endphp
         
    @elseif( date('m', strtotime($action->deadline)) == 2)
        @php   array_push($action_du_moisfevrier, $action);
     
            $mois_countfevrier = count($action_du_moisfevrier);  

            $som_moisfevrier += ($action->pourcentage);
            
            $perfo_total_mois_fevrier = $som_moisfevrier / $mois_countfevrier ;
         @endphp
         
         @elseif( date('m', strtotime($action->deadline)) == 3)
        @php   array_push($action_du_mois_mars, $action);
     
            $mois_count_mars = count($action_du_mois_mars);  

            $som_mois_mars += ($action->pourcentage);
            
            $perfo_total_mois_mars = $som_mois_mars / $mois_count_mars ;
         @endphp
         
   
         @elseif( date('m', strtotime($action->deadline)) == 4)
        @php   array_push($action_du_moisavril, $action);
     
            $mois_countavril = count($action_du_moisavril);  

            $som_moisavril += ($action->pourcentage);
            
            $perfo_total_mois_avril = $som_moisavril / $mois_countavril ;
         @endphp
         
         @elseif( date('m', strtotime($action->deadline)) == 5)
        @php   array_push($action_du_mois_mai, $action);
     
            $mois_count_mai = count($action_du_mois_mai);  

            $som_mois_mai += ($action->pourcentage);
            
            $perfo_total_mois_mai = $som_mois_mai / $mois_count_mai ;
         @endphp
         
         @elseif( date('m', strtotime($action->deadline)) == 6)
        @php   array_push($action_du_mois_juin, $action);
     
            $mois_count_juin = count($action_du_mois_juin);  

            $som_mois_juin += ($action->pourcentage);
            
            $perfo_total_mois_juin = $som_mois_juin / $mois_count_juin ;
         @endphp
         
         @elseif( date('m', strtotime($action->deadline)) == 7)
        @php   array_push($action_du_mois_juillet, $action);
     
            $mois_count_juillet = count($action_du_mois_juillet);  

            $som_mois_juillet += ($action->pourcentage);
            
            $perfo_total_mois_juillet = $som_mois_juillet / $mois_count_juillet ;
         @endphp
         
         @elseif( date('m', strtotime($action->deadline)) == 8)
        @php   array_push($action_du_mois_aout, $action);
     
            $mois_count_aout = count($action_du_mois_aout);  

            $som_mois_aout += ($action->pourcentage);
            
            $perfo_total_mois_aout = $som_mois_aout / $mois_count_aout ;
         @endphp
         
         @elseif( date('m', strtotime($action->deadline)) == 9)
        @php   array_push($action_du_mois_septembre, $action);
     
            $mois_count_septembre = count($action_du_mois_septembre);  

            $som_mois_septembre += ($action->pourcentage);
            
            $perfo_total_mois_septembre = $som_mois_septembre / $mois_count_septembre ;
         @endphp
         
         @elseif( date('m', strtotime($action->deadline)) == 10)
        @php   array_push($action_du_mois_octobre, $action);
     
            $mois_count_octobre = count($action_du_mois_octobre);  

            $som_mois_octobre += ($action->pourcentage);
            
            $perfo_total_mois_octobre = $som_mois_octobre / $mois_count_octobre ;
         @endphp
         
         @elseif( date('m', strtotime($action->deadline)) == 11)
        @php   array_push($action_du_mois_novembre, $action);
     
            $mois_count_novembre = count($action_du_mois_novembre);  

            $som_mois_novembre += ($action->pourcentage);
            
            $perfo_total_mois_novembre = $som_mois_novembre / $mois_count_novembre ;
         @endphp
         
         @elseif( date('m', strtotime($action->deadline)) == 12)
        @php   array_push($action_du_mois_decembre, $action);
     
            $mois_count_decembre = count($action_du_mois_decembre);  

            $som_mois_decembre += ($action->pourcentage);
            
            $perfo_total_mois_decembre = $som_mois_decembre / $mois_count_decembre ;
           
         @endphp
     @endif
@endforeach
  
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
   
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
      
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Evolution de ma performance individuelle</h3>
                    </div>
               
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                

                 <!-- ==============================  Suivi de la performance globale de mon Entreprise ================================ -->
                 <section id="global-performance">
                    <div class="row">
                        <div class="col-md-6 col-8 align-self-center">
                        </div>
                        <div id="curve_chart" style="width: 1000px; height: 600px"></div>
                    </div>
                 </section>
                 <!-- ==============================  Suivi de la performance globale de mon Entreprise ================================ -->
            </div>
          
           
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
      
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
   
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
  
   
   <script type="text/javascript">

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
  
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Mois', 'Performance'],
            ['Janvier',  {{intval($perfo_total_mois_janvier)}}],
            ['Février',  {{intval($perfo_total_mois_fevrier)}}],
            ['Mars',  {{intval($perfo_total_mois_mars)}}],
            ['Avril',  {{intval($perfo_total_mois_avril)}}],
            ['Mai',  {{intval($perfo_total_mois_mai)}}],
            ['Juin',  {{intval($perfo_total_mois_juin)}}],
            ['Juillet',  {{intval($perfo_total_mois_juillet)}}],
            ['Août',  {{intval($perfo_total_mois_aout)}}],
            ['Septembre',  {{intval($perfo_total_mois_septembre)}}],
            ['Octobre',  {{intval($perfo_total_mois_octobre)}}],
            ['Novembre',  {{intval($perfo_total_mois_novembre)}}],
            ['Décembre',  {{intval($perfo_total_mois_decembre)}}],
          ]);
  
          var options = {
            title: '',
            curveType: 'function',
            legend: { position: 'bottom' }
          };
  
          var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
  
          chart.draw(data, options);
        }
      </script>
  
  
</body>

</html>