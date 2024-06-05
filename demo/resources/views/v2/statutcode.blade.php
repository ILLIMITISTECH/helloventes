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

   
    <h5>
      @if (session('message'))
                  <div class="alert alert-success" role="alert">
                  {{ session('message') }}
                  </div>  
                  @endif
    </h5>
    <h5>
      @if (session('rap'))
                  <div class="alert alert-success" role="alert">
                  {{ session('rap') }}
                  </div>  
                  @endif
    </h5>
                       <!-- formulaire -->
                              
         <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
               @php
                            $fac = DB::table('facilitateurs')->where('user_id', Auth::user()->id)->first();
                            $clf = DB::table('client_facilitateurs')->where('facilitateur_id', $fac->id)->orderBy('created_at', 'desc')->first();
                            $ent = DB::table('entreprises')->where('id', $clf->entreprise_id)->first();
                            
                            $now = now();
                            $heureNow = date('H', strtotime($now));
                            $minuteNow = date('i');
                            
                            $userNows = DB::table('users')->where('entreprise', $ent->id)
                            ->where('last_online_at', '!=', null)
                            ->where('heure', '!=', $heureNow)
                            ->get();
                            $checkTotalMinute = 0;
                            $checkTotalMinuteNow = 0;
                            $checkUserConnect = 0;
                            $checkUserNoConnect = 0;
                             $checkUserNoConnectarr = array();
                                foreach($userNows as $userNow)
                                    {
                                   
                                   
                                        $Minplus20 = $userNow->minute + 20;
                                        
                                        $convertHeure = $userNow->heure * 60 ;
                                        $checkTotalMinute = $convertHeure + $Minplus20 ;
                                        $convertHeureNow = $heureNow * 60 ;
                                        $checkTotalMinuteNow = $minuteNow + $convertHeureNow ;
                                        
                                        if($checkTotalMinute < $checkTotalMinuteNow)
                                           {
                                           $checkUserNoConnect += $userNow;
                                           array_push($checkUserNoConnectarr, $checkUserNoConnect);
                                           }
                                           else
                                           {
                                           $checkUserConnect += count($userNow);
                                           }
                                        
                                       }
                                
                          
                            @endphp
                            

                            <div class="card-body">
                                
                              
                                                
                            
                                <div style = "margin-left: 600px; margin-top:50px; display:flex;"> 
                                
                                <form action="/search_participant" method="get" style="margsearchfin-top:5px;">
                                    <select name="searchP" style="width:220px;height:40px" required>
                                        <option value="" disabled selected>Rechercher par participant</option>
                                  @php $user_tout = DB::table('users')->where('nom_role', 'entreprise')->where('entreprise', $ent->id)->get();  @endphp
                                        @foreach($user_tout as $user_tous)
                                        <option value="{{$user_tous->prenom}}">{{$user_tous->prenom}} {{$user_tous->nom}}</option>
                                       
                                          @endforeach
                                        <option onclick="window.location.href='http://dev-byfeeding.optievent.xyz/liste_utilisateurs';" value >Tous les utilisateurs</option>
                                    </select>
                                        <button class="btn" style="color:white; background-color:#EB3148" type="submit">Filtrer</button>
                                </form> 
                                
                                <!--<form action="{{route('statutagents_byfeeding.filtrer')}}" method="get" style="margsearchfin-top:5px; margin-left: 10px;">-->
                                <!--    <select name="search" style="width:220px;height:40px" required>-->
                                <!--        <option value="" disabled selected>Rechercher par client</option>-->
                                      
                                      
                                       
                                <!--        @foreach($clients as $entreprisef)-->
                                <!--          @php $entreprises = DB::table('entreprises')->where('id', $entreprisef->entreprise_id)->first(); @endphp-->
                                          
                                <!--        <option value="{{$entreprises->id}}">{{$entreprises->libelle}}</option>-->
                                <!--        @endforeach-->
                                <!--        <option onclick="window.location.href='http://dev-byfeeding.optievent.xyz/liste_utilisateurs';" value >Tous les utilisateurs</option>-->
                                <!--    </select>-->
                                <!--        <button class="btn" style="color:white; background-color:#EB3148" type="submit">Filtrer</button>-->
                                <!--</form> -->
                            </div>
                           
                            
                             @php $dnow = date('d'); $dnowH = date('H:i'); $hr = date('H'); $mnt = date('i') + 20; @endphp 
                             

                                               
                               
                                        
                                            @php $nbrusers = DB::table('users')
                                            ->whereDay('last_online_at', $dnow)
                                            //->where('last_online_time', '=' ,$dnowH)
                                             ->where('heure', '=' ,$hr)
                                             ->where('minute', '<=' ,$mnt)
                                            ->where('last_online_at', '!=', null)
                                            ->where('entreprise', $ent->id)
                                            ->count(); 
                                            @endphp
                                               
                                            
                           
                                               
                                               
                                               
                                            <tr>
                                                <td>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-record-circle-fill" viewBox="0 0 16 16">
                                                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-8 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                                   
                                                    </svg> : <strong>{{$nbrusers}}</strong>
                                                   
                                                </td>
                                            </tr>
                                          
                                          
                                            
                                @php $nbruserss = DB::table('users')->where('entreprise', $ent->id)->orwhere('last_online_at', '=', null)->where('heure', '<' ,$hr)->where('minute', '<=' ,$mnt)->count();@endphp
                               
                               
                                            
                                           <tr>
                                               <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-record-circle-fill" viewBox="0 0 16 16">
                                              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-8 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                            </svg> : <strong>{{$nbruserss}}</strong></td>
                                           </tr>
                                                  
                                                 
                                <div class="table-responsive">
                                    <table class="table user-table no-wrap">
                                        <thead>
                                            <tr>

                                                <!--<th class="border-top-0">Photo</th>-->
                                                <th class="border-top-0">Identité</th>
                                                <th class="border-top-0">Email</th>
                                                <th class="border-top-0">Structure</th>
                                                <th class="border-top-0">Statut</th>
                                                <th class="border-top-0">Connexion</th>
                                                <th class="border-top-0">Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             @foreach($useragentes as $agentess) 
                                             @foreach($agentess as $user) 
                                            @if($user->entreprise == $ent->id)
                                            <tr>
                                                
                                
                                                <td  class="align-middle">
                                                    <span class="text-nice" style="text-align : left;">{{$user->prenom}} {{$user->nom}} </span>
                                                </td>
                                            @php $entreprise_agent = DB::table('entreprises')->where('id', $user->entreprise)->first();  @endphp
                                            
                                             <td class="align-middle" >
                                            <div class="align-middle" >
                                                            {{$user->email}}
                                             </div></td>
                                             
                                            @if($entreprise_agent)
                                                 <td class="align-middle" >
                                                    <div class="align-middle" >
                                                                    {{$entreprise_agent->libelle}} {{$user->isOnline()}}
                                                     </div></td>
                                            @else 
                                            <td class="align-middle" >  
                                                    <div class="align-middle" >
                                                                --
                                                     </div></td>
                                            @endif
                                           
                               
                                                
                                            @if($user->heure == $hr and $user->minute <= $mnt)
                                           
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
                                                @if((strftime("%Y", strtotime($user->last_online_at))) == 1970 )
                                                <td class="align-middle">Jamais</td>
                                                @else
                                                <td class="align-middle">Le {{strftime("%d/%m/%Y", strtotime($user->last_online_at))}}</td>
                                                @endif
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
                                                 <td class="align-middle" >
                                            <div class="align-middle" style="display : flex;" style="margin-right : 10px;" data-toggle="tooltip" title="Modifier" >
                                              <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"  href="{{route('utilisateursenligne.editer', $user->id)}}" >
                                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            </td>
                                                </tr>
                                                
                                                @endforeach
                                                @endif
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
 <script type="text/javascript">
</body>

</html>