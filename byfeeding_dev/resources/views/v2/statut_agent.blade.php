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

</head>

<body>

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
          @include('v2.header_dg')
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
        @include('v2.side_bar_dg')
        </div>
            <!-- End Sidebar scroll-->
                 </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Statut des Agents</h3>
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
                <div class="row">
                    <!-- column -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                               
                                <div class="table-responsive">
                                    <table class="table user-table no-wrap">
                                        <thead>
                                            <tr>

                                                <th class="border-top-0">Photo</th>
                                                <th class="border-top-0">Identité</th>
                                                <th class="border-top-0">Direction</th>
                                                <th class="border-top-0">Statut</th>
                                                <th class="border-top-0">Dernière connexion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($userAgents as $user)
                                            <tr>
                                                
                                                <td  class="align-middle">
                                                    <div class="row">
                                                        <span style="text-align: left;">
                                                        @if($user->photo == NULL)
                                                       <span class="rounded-circle" style="border: 1px solid #3F6AD8; background: white; color:#2C365E; font-weight:bold; font-size:18px; padding:10px; text-shadow: 1px 1px 2px white;">{{substr($user->prenom, 0,1)}} {{substr($user->nom, 0,1)}}</span>
                                                       @else
                        						      	<img width="50" height="50" class="rounded-circle" src="{{ url('images/', $user->photo) }}" alt="">
                        						       @endif
                        						      
                                                        </span>
                                                        <br>
                                                        
                                                    </div>
                                                   
                                                </td>
                                                <td  class="align-middle">
                                                    <span class="text-nice" style="text-align : left;">{{$user->prenom}} {{$user->nom}} </span>
                                                </td>
                                                <td  class="align-middle">
                                                    <?php $agentss = DB::table('agents')->where('user_id', $user->id)->get() ?>
                        						      		@foreach($agentss as $a)
                        						      		<?php $directions = DB::table('directions')->where('id', $a->direction_id)->get() ?>
                        						      		@foreach($directions as $d)
                        						      		<span class="text-nice"> {{$d->nom_direction}}</span>
                        						      		@endforeach
                        						      		@endforeach
                                                </td>
                                                
                                                        @if($user->isOnline())
                                                     <td class="align-middle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-record-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-8 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
</svg></td>
                                                        @else
                                                       <td class="align-middle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-record-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-8 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
</svg></td>
                                                       @endif
                                                   
                                                @if(intval(abs(strtotime("now") - strtotime($user->last_online_at))/ 86400) == 0)
                                                  @if(intval(abs(strtotime("now") - strtotime($user->last_online_at))/ 3600) > 0)
                                                @if(intval(abs(strtotime("now") - strtotime($user->last_online_at))/3600) == 1)
                                                <td class="align-middle">
                                                  il y'a {{intval(abs(strtotime("now") - strtotime($user->last_online_at))/3600)}} heure
                                                </td>
                                                @else
                                                <td class="align-middle">
                                                il y'a {{intval(abs(strtotime("now") - strtotime($user->last_online_at))/3600)}} heures
                                                </td>
                                                @endif
                                                  @else(intval(abs(strtotime("now") - strtotime($user->last_online_at))/ 3600) == 0)
                                                  <td class="align-middle">il y'a {{intval(abs(strtotime("now") - strtotime($user->last_online_at))/60)}} minutes</td>
                                                  @endif
                                                @elseif(intval(abs(strtotime("now") - strtotime($user->last_online_at))/ 86400) == 1)
                                                <td class="align-middle">Hier à {{strftime("%H:%M", strtotime($user->last_online_at))}}</td>
                                                @elseif(intval(abs(strtotime("now") - strtotime($user->last_online_at))/ 86400) >= 2 && intval(abs(strtotime("now") - strtotime($user->last_online_at))/ 86400) <= 27)
                                                <td class="text-nice">il y'a {{intval(abs(strtotime("now") - strtotime($user->last_online_at))/ 86400)}} jours </td>
                                                @else(intval(abs(strtotime("now") - strtotime($user->last_online_at))/ 86400) > 27)
                                                <td class="align-middle">Le {{strftime("%d/%m/%Y", strtotime($user->last_online_at))}}</td>
                                                @endif
                                                <?php $agents = DB::table('agents')->where("user_id",$user->id)->get(); ?>
                                                @foreach($agents as $agent)
                                               <?php $actio = DB::table('modeles')->where("res_dir",$agent->id)->orderBy('updated_at','DESC')->paginate(1); ?>
                                            @endforeach
                                            <?php $agentts = DB::table('agents')->where("user_id",$user->id)->get(); ?>
                                                @foreach($agentts as $agentt)
                                               <?php $actiot = DB::table('tache_modeles')->where("res_dir",$agentt->id)->orderBy('updated_at','DESC')->paginate(1); ?>
                                            @endforeach
                                               <?php $actionsf = DB::table('actions')->where('agent_id',$user->id)->orWhereNull('agent_id')->orderBy('updated_at','DESC')->paginate(1); ?>
                                                 @foreach($actionsf as $actionf)
                                                </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             
           
               
            </div>
          
            <footer class="footer">
                © Made with love and Passion by <a href="https://www.illimitis.com/">ILLIMITIS</a>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="./assets/plugins/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
    <script src="js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
    <!--This page JavaScript -->
    <!--flot chart-->
    <script src="./assets/plugins/flot/jquery.flot.js"></script>
    <script src="./assets/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="js/pages/dashboards/dashboard1.js"></script>
</body>

</html>