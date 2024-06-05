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
                                                <th class="border-top-0" style="text-align : center;">Dernière modification </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                               $all_user_update = array();
                                               $agents = DB::table('agents')->get();
                                             ?>
                                                @foreach($agents as $agents)
                                                    @php
                                                        $action_last = DB::table('actions')->select('actions.updated_at','agents.prenom', 'agents.nom', 'users.photo')->join('agents', 'actions.agent_id', 'agents.id')->join('users', 'agents.user_id', 'users.id')->where('agents.id', $agents->id)->orderBy('actions.updated_at','DESC')->first();
                                                        if(!empty($action_last))
                                                            array_push($all_user_update, $action_last);
                                                    @endphp
                                                   
                                                @endforeach
                                                
                                                @php
                                                    array_multisort( array_column($all_user_update, "updated_at"), SORT_ASC, $all_user_update );
                                                @endphp
                                                 
                                            @foreach($all_user_update as $user)
                                                @if(intval(abs(strtotime("now") - strtotime($user->updated_at))/ 86400) >= 3)

                                               <tr>
                                                   <td class="d-flex align-items-center">
                                                       @if($user->photo == NULL)
                                                       <span class="rounded-circle" style="border: 1px solid #3f6ad8; background: white; color:#2C365E; font-weight:bold; font-size:18px; padding:10px; text-shadow: 1px 1px 2px white;">{{substr($user->prenom, 0,1)}} {{substr($user->nom, 0,1)}}</span>
                                                       @else
                        						      	<img width="50" height="50" class="rounded-circle" src="{{ url('images/', $user->photo) }}" alt="">
                        						       @endif
                        						    </td>
                        						    <td>
                        						      	<div class="pl-3 email" >
                        						      		<span class="text-nice" style="text-align : left;">{{$user->prenom}} {{$user->nom}}</span>
                        						      		
                        						      	</div>
                                                   </td>
                                                  
                                            <!--@if(intval(abs(strtotime("now") - strtotime($user->updated_at))/ 86400) == 0)-->
                                                <!--@if(intval(abs(strtotime("now") - strtotime($user->updated_at))/ 3600) > 0)-->
                                                
                                                <!--    @if(intval(abs(strtotime("now") - strtotime($user->updated_at))/3600) == 1) -->
                                                <!--    <td class="text-center" >-->
                                                <!--      il y'a {{intval(abs(strtotime("now") - strtotime($user->updated_at))/3600)}} heure-->
                                                <!--    </td>-->
                                                <!--    @else-->
                                                <!--    <td class="text-center">-->
                                                <!--    il y'a {{intval(abs(strtotime("now") - strtotime($user->updated_at))/3600)}} heures-->
                                                <!--    </td>-->
                                                <!--    @endif-->
                                                    
                                                <!--@else(intval(abs(strtotime("now") - strtotime($user->updated_at))/ 3600) == 0)-->
                                                <!--<td class="text-center">il y'a {{intval(abs(strtotime("now") - strtotime($user->updated_at))/60)}} minutes</td>-->
                                                <!--@endif-->
                                            <!--@elseif(intval(abs(strtotime("now") - strtotime($user->updated_at))/ 86400) == 1)-->
                                            <!--<td class="text-center">Hier à {{strftime("%H:%M", strtotime($user->updated_at))}}</td>-->
                                            <!--@endif-->
                                            @if(intval(abs(strtotime("now") - strtotime($user->updated_at))/ 86400) >= 3 )
                                            <td class="text-center">il y'a {{intval(abs(strtotime("now") - strtotime($user->updated_at))/ 86400)}} jours </td>
                                            @endif
                                        @endif
                                               
                                                </tr>
                                        @endforeach
                                           

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