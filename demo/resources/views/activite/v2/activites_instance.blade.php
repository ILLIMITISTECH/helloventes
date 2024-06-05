<!doctype html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="short icon" href="{{asset('collov2/assets/images/icon.png')}}">
    <title>Collaboratis | Mes activités en instance</title>
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
</head>
<body>
        
        @include('v3.modal')
        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
                <!--header -->
                @include('v2.header_dg')
                <!-- end header -->
    
            <div class="app-main">
                    <!-- side bar -->
                    @include('v2.side_bar_dg')
          
                    <!-- end side bar -->
                    
                           <!-- perfo -->
    
                           <!-- end perfo --> 
                          
                            
                            <!-- perfo de mes direc -->
                           
    
                             <!-- end perfo de mes direct -->
                            
                            <!-- section -->
                
                    <div class="app-main__outer">
                            <div class="app-main__inner">                            
                
                                @if(Session::has("success"))
                                <div class="alert alert-success">
                                <b>Action clôturée avec succès.</b> 
                                </div>
                                @endif
                                
                                <div class="row">
                                            
                                            <div class="col-md-12">
                                                <h5>@if (session('message'))
                                                <div class="alert alert-success alert-dismissible" role="alert">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    {{ session('message') }}
                                                </div>  
                                                @endif
                                                </h5>
                                                <h5>@if (session('cloture'))
                                                <div class="alert alert-success alert-dismissible" role="alert">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    {{ session('cloture') }}
                                                </div>  
                                                @endif
                                                </h5>
                                                
                                          
                                                
                                                <div class="main-card mb-3 card" stlye="margin-left:50%;">
                                                       <div class="card-header" style="position : relative; display : flex;"> 
                                                        <h3  style="font-family: 'poppins', sans-serif; font-size : 18px; font-weight : bolder; color : black;" >Mes activités en instances</h3>
                                                           
                                                     @if(Auth::user()->nom_role == "directeur")
                                                        <a href="/create_dg" type="button" class="btn btn-dark" style="position : absolute; right : 5%;top: 10%; color : white;"> <i class="bi bi-plus-circle"></i>&nbsp Ajouter une activité</a>
                                                     @elseif(Auth::user()->nom_role == "responsable")
                                                     <a href="/create_dg" type="button" class="btn btn-dark" style="position : absolute; right : 5%; top: 1%; color : white;"> <i class="bi bi-plus-circle"></i>&nbsp Ajouter une activité</a>
                                                     @endif
                                                    <button type="button" class="btn btn-dark" style="position : absolute; right : 30%;top: 10%; color : white;">  <i class="bi bi-filter-circle-fill"></i>&nbspTrier par échéance</button>
                                                    </div>
                                                    <div class="table-responsive">
                                                    <?php $modelessp = DB::table('modeles')->where('res_dir', Auth::user()->id)->get()  ?>
                                                        @if($modelessp->isEmpty())
                                                                 <span class="text-nice" style=" margin : 8% 2% 2% 2%;"> <i class="bi bi-info-circle-fill"></i>   Aucune activité pour laquelle je suis responsable ! </span>
                                                                 @else
                                                        <table class="align-middle mb-0 table table-borderless">
                                                            <thead>
                                                            <tr>
                                                        
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!--On liste d'abort l'activté et ses paramètres-->
                                                                 @foreach($modelessp as $modele)  
                                                                 <?php $agen = DB::table('agents')->where('user_id', Auth::user()->id)->first()  ?>
                                                                  <?php $strategiques = DB::table('strategiques')->where('id', $modele->strategique_id)->get()  ?>
                                                                 @foreach($strategiques as $strategique) 
                                                                <tr class ="activites">
                                        
                                                                    <td class="activite-police" style="width : 35%;">{{$modele->libelle}}</td>
                                                                    <?php $agen = DB::table('agents')->where('id', $modele->res_dir)->first()  ?>
                                                                    <?php $agent = DB::table('agents')->where('id', $modele->backup)->first()  ?>
                                                                    <td style="display : flex;">
                                                                        <div  class ="responsable" data-toggle="tooltip" data-placement="left" title="{{$agen->prenom}} {{$agen->nom}}">
                                                                            <span class="initials">
                                                                            {{substr($agen->prenom, 0, 1)}} {{substr($agen->nom, 0, 1)}}
                                                                            </span>
                                                                        </div>
                                                                        <div class ="backup" data-toggle="tooltip" data-placement="right" title="{{$agent->prenom}} {{$agent->nom}}">
                                                                              <span class="initials">
                                                                                {{substr($agent->prenom, 0, 1)}} {{substr($agent->nom, 0, 1)}}
                                                                            </span>
                                                                        </div>
                                                                    </td>
                                                                   
                                                                    <!--pourcentage V3 -->
                                                                     <?php $count = DB::table('tache_modeles')->where('modele_id', $modele->id)->count()  ?>
                                                                     <?php $sum = DB::table('tache_modeles')->where('modele_id', $modele->id)->where('statut','=',1)->count()  ?>
                                                                     <?php $total = $count == 0 ? 0 : $sum / $count ?>
                                                                     <td style="position : relative;" >
                                                                        <div class="progress-value" style="position : absolute; top : 8%;">
                                                                                        {{intval($total * 100)}}%
                                                                                 </div>
                                                                                <div class="progress" style="height: 5px;width : 100px; background: #C4C4C4; border-radius: 5px; margin-top :5%;">
                                                                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: {{$total * 100}}%;"></div>
                                                                                </div>
                                                                     </td>
                                                                      
                                                                       <!--pourcentage V3 -->
                                                                     @if($modele->pourcentage == 100)
                                                                     <td>Finalisée le {{strftime("%d/%m", strtotime($modele->updated_at))}}</td>
                                                                     @else
                                                                     <td>En cours</td>
                                                                     @endif
                                                                     
                                                                     <?php $today = "%d/%m" ?>
                                                                     
                                                                    @if(strftime("%d/%m",strtotime($modele->date_debut)) > $today)
                                                                    <td class="activite-police">Lancement le {{strftime("%d/%m", strtotime($modele->date_debut))}}</td>
                                                                    @else
                                                                    <td class="activite-police">Lancée depuis {{intval(strftime("%d/%m", strtotime($modele->date_debut)) - $today) / 86400}} jours</td>
                                                                    @endif
                                                                    <td class="activite-police">Deadline : {{strftime("%d/%m", strtotime($modele->deadline))}}</td>
                                                                    <td><a href="{{route('active.modifier',$modele->id)}}" class ="btn btn-danger" style="color : white;"></i> Modifier</a></td> 
                        
                                                                </tr>
                                                                    <!--On liste d'abort l'activté et ses paramètres-->
                                                                    
                                                                <tr>
                                                                    <!--Espace vide-->
                                                                </tr>
                                                                    
                                                                <?php $tache_modeles = DB::table('tache_modeles')->where('modele_id', $modele->id)->orderBy('deadline', 'DESC')->get()  ?>
                                                               @foreach($tache_modeles as $tache)
                                                                    
                                                                 <tr class="taches-row"> 
                                                                
                                                                  

                                                                    <td class="tache"><i class="bi bi-dot"></i>&nbsp&nbsp  {{$tache->libelle}}</td>
                                                                     <?php $agent = DB::table('agents')->where('id', $tache->res_dir)->get()  ?>
                                                                     @if($tache->res_dir == NULL)
                                                                     <td>--</td>
                                                                    @else
                                                                    @foreach($agent as $a)
                                                                   
                                                                     <td>
                                                                            <div class="lil-responsable" data-toggle="tooltip" data-placement="left" title="{{$a->prenom}} {{$a->nom}}">
                                                                                 <span class="initials">
                                                                                {{substr($a->prenom, 0, 1)}} {{substr($a->nom, 0, 1)}}
                                                                                </span>
                                                                            </div>
                                                                           
                                                                        </td>
                                                                       
                                                                    @endforeach
                                                                     @endif
                                                                    <td class="tache">Deadline : {{strftime("%d/%m/%Y", strtotime($tache->deadline))}}</td>
                                                                    @if($tache->statut == 0)
                                                                    <td class="tache"><span class="badge bg-danger">Pas Fait</span></td>
                                                                    @else
                                                                    <td class="tache"><span class="badge bg-success" style="padding : 3% 14% 3% 14%">Fait</span></td>
                                                                    @endif
                                                                    
                                                                    @if($tache->statut == 1)
                                                                    <td class="tache">Finalisée le {{strftime("%d/%m/%Y", strtotime($tache->updated_at))}}</td>
                                                                     @else
                                                                    <td class="tache">Tâche en cours</td>
                                                                    @endif
                                                                   
                                                                    <td class="tache">Assignée depuis {{intval(strftime("%d", strtotime($tache->updated_at)) - strftime("%d", strtotime($tache->created_at)) / 86400)}} jours</td>
                                                                    
                                                                    <td class="tache">
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="font-size : 12px;">
                                                                                Mise à jour
                                                                            </button>
                                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                                <li>
                                                                                    <form action="{{route('faitm', $tache->id)}}" method="post" id="target" class="form">
                                                                                    <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                                                         <span class="d-inline-block" tabindex="0">
                                                                                             <button type="submit" id="PopoverCustomT-1" class="btn boutton-options">
                                                                                              Fait
                                                                                            </button>
                                                                                        </span>
                                                                                     </form>   
                                                                                </li>
                                                                                <li>
                                                                                    <form action="{{route('pasfaitm', $tache->id)}}" method="post" id="target" class="form">
                                                                                    <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                                                         <span class="d-inline-block" tabindex="0">
                                                                                             <button type="submit" id="PopoverCustomT-1" class="btn boutton-options">
                                                                                              Pas Fait
                                                                                            </button>
                                                                                        </span>
                                                                                     </form>   
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                 
                                                                  
                                                                 </tr>
                                                                  @endforeach
                                                                    
                
                                                                  
                                                              @endforeach
                                                                   @endforeach
                                                             </tbody>
                                                            </table>
                                                            @endif
                                                          
           
                                                    </div>
                                                    
                                               
                                                    <div class="table-responsive">
                                                        <?php $modeless = DB::table('modeles')->where('backup', Auth::user()->id)->get()  ?>
                                                        @if($modeless->isEmpty())
                                                                <span class="text-nice" style=" margin : 8% 2% 2% 2%;"> </span>
                                                                 @else
                                                        <table class="align-middle mb-0 table table-borderless" style="width:100%">
                                                            <thead>
                                                            <tr>
                                                        
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!--On liste d'abort l'activté et ses paramètres-->
                                                                 @foreach($modeless as $modele)  
                                                                 <?php $agen = DB::table('agents')->where('user_id', Auth::user()->id)->first()  ?>
                                                                  <?php $strategiques = DB::table('strategiques')->where('id', $modele->strategique_id)->get()  ?>
                                                                 @foreach($strategiques as $strategique) 
                                                                <tr class ="activites">
                                                                    
                                                                    <td class="activite-police" style="width : 35%;">{{$modele->libelle}}</td>
                                                                    <?php $agen = DB::table('agents')->where('id', $modele->res_dir)->first()  ?>
                                                                    <?php $agent = DB::table('agents')->where('id', $modele->backup)->first()  ?>
                                                                    <td style="display : flex;">
                                                                        <div  class ="responsable" data-toggle="tooltip" data-placement="left" title="{{$agen->prenom}} {{$agen->nom}}">
                                                                            <span class="initials">
                                                                            {{substr($agen->prenom, 0, 1)}} {{substr($agen->nom, 0, 1)}}
                                                                            </span>
                                                                        </div>
                                                                        <div class ="backup" data-toggle="tooltip" data-placement="right" title="{{$agent->prenom}} {{$agent->nom}}">
                                                                              <span class="initials">
                                                                                {{substr($agent->prenom, 0, 1)}} {{substr($agent->nom, 0, 1)}}
                                                                            </span>
                                                                        </div>
                                                                    </td>
                                                                    
                                                                    <!--pourcentage V3 -->
                                                                     <?php $count = DB::table('tache_modeles')->where('modele_id', $modele->id)->count()  ?>
                                                                     <?php $sum = DB::table('tache_modeles')->where('modele_id', $modele->id)->where('statut','=',1)->count()  ?>
                                                                     <?php $total = $count == 0 ? 0 : $sum / $count ?>
                                                                     <td style="position : relative;" >
                                                                        <div class="progress-value" style="position : absolute; top : 8%;">
                                                                                        {{intval($total * 100)}}%
                                                                                 </div>
                                                                                <div class="progress" style="height: 5px;width : 100px; background: #C4C4C4; border-radius: 5px; margin-top :5%;">
                                                                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: {{$total * 100}}%;"></div>
                                                                                </div>
                                                                     </td>
                                                                      
                                                                   <!--pourcentage V3 -->
                                                                     @if($modele->pourcentage == 100)
                                                                     <td>Finalisée le {{strftime("%d/%m/%Y", strtotime($modele->updated_at))}}</td>
                                                                     @else
                                                                     <td>En cours</td>
                                                                     @endif
                                                                    <td class="activite-police">Lancée depuis {{intval(strftime("%d", strtotime($modele->updated_at)) - strftime("%d", strtotime($modele->created_at)) / 86400)}} jours</td>
                                                                    <td class="activite-police">Deadline : {{strftime("%d/%m/%Y", strtotime($modele->deadline))}}</td>
                                                                    <td><a href="{{route('active.modifier',$modele->id)}}" class ="btn btn-danger" style="color : white;"></i> Modifier</a></td> 
                                                                    </tr>
                                                                    
                                                                    <tr>
                                                             
                                                                    </tr>
                                                                    
                                                                    <?php $tache_modeles = DB::table('tache_modeles')->where('modele_id', $modele->id)->orderBy('deadline', 'DESC')->get()  ?>
                                                                   @foreach($tache_modeles as $tache)
                                                                    
                                                                     <tr class="taches-row"> 
                                                                        <td class="tache"><i class="bi bi-dot"></i>&nbsp&nbsp  {{$tache->libelle}}</td>
                                                                         <?php $agent = DB::table('agents')->where('id', $tache->res_dir)->get()  ?>
                                                                        @foreach($agent as $a)
                                                                        <td>
                                                                            <div class="lil-responsable" data-toggle="tooltip" data-placement="left" title="{{$a->prenom}} {{$a->nom}}">
                                                                                 <span class="initials">
                                                                                {{substr($a->prenom, 0, 1)}} {{substr($a->nom, 0, 1)}}
                                                                                </span>
                                                                            </div>
                                                                           
                                                                        </td>
                                                                        @endforeach
                                                                        <td class="tache">Deadline : {{strftime("%d/%m/%Y", strtotime($tache->deadline))}}</td>
                                                                        @if($tache->statut == 0)
                                                                        <td class="tache"><span class="badge bg-danger">Pas Fait</span></td>
                                                                        @else
                                                                        <td class="tache"><span class="badge bg-success" style="padding : 3% 14% 3% 14%">Fait</span></td>
                                                                        @endif
                                                                        
                                                                        @if($tache->statut == 1)
                                                                        <td class="tache"> Finalisée le {{strftime("%d/%m/%Y", strtotime($tache->updated_at))}}</td>
                                                                         @else
                                                                        <td class="tache">Tâche en cours</td>
                                                                        @endif
                                                                       
                                                                        <td class="tache">Assignée depuis {{intval(strftime("%d", strtotime($tache->updated_at)) - strftime("%d", strtotime($tache->created_at)) / 86400)}} jours</td>
                                                                       
                                                                        <td class="tache">
                                                                            <div class="dropdown">
                                                                                <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="font-size : 12px;">
                                                                                    Mise à jour
                                                                                </button>
                                                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                                    <li>
                                                                                        <form action="{{route('faitm', $tache->id)}}" method="post" id="target" class="form">
                                                                                        <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                                                             <span class="d-inline-block" tabindex="0">
                                                                                                 <button type="submit" id="PopoverCustomT-1" class="btn boutton-options">
                                                                                                  Fait
                                                                                                </button>
                                                                                            </span>
                                                                                         </form>   
                                                                                    </li>
                                                                                    <li>
                                                                                        <form action="{{route('pasfaitm', $tache->id)}}" method="post" id="target" class="form">
                                                                                        <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                                                             <span class="d-inline-block" tabindex="0">
                                                                                                 <button type="submit" id="PopoverCustomT-1" class="btn boutton-options">
                                                                                                  Pas Fait
                                                                                                </button>
                                                                                            </span>
                                                                                         </form>   
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </td>
                                                                     
                                                                      
                                                                     </tr>
                                                                  @endforeach
                                                                    
                
                                                                  
                                                              @endforeach
                                                                   @endforeach
                                                             </tbody>
                                                            </table>
                                                            @endif
                                                          
                                                         
                                                          
                                                    </div>
                                            
                                                   
                                                </div>
                                                
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3  style="font-family: 'poppins', sans-serif; font-size : 18px; ; color : black;">Liste des Tâches qui vous sont assignées !</h3>
                                                      
                                                    </div>
                                                    <div class="card-body">
                                                          <p class="text-nice" style="padding-left :1%;">
                                                            <i class="bi bi-info-circle-fill"></i> Ces tâches proviennent d'activités sur lesquelles vous intervenez ; en les mettant à jour vous contribuerez à la finalisation des dites activités.
                                                        </p>
                                                        <div class="table-responsive">
                                                        <?php $tache_modelesints = DB::table('tache_modeles')->where('res_dir', Auth::user()->id)->orderBy('deadline', 'DESC')->get()  ?>
                                                         @if($tache_modelesints->isEmpty())
                                                               <span class="text-nice" style=" margin : 8% 2% 2% 2%;"></span>
                                                                 @else
                                                        
                                                        <table class="align-middle mb-0 table table-borderless">
                                                            <thead>
                                                            <tr>
                                                        
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                               
                                                                
                                                        @foreach($tache_modelesints as $tache_modelesint)
                                                        <?php $agend = DB::table('agents')->where('user_id', Auth::user()->id)->first()  ?>
                                                        <?php $modelessint = DB::table('modeles')->where('id', $tache_modelesint->modele_id)->get()  ?>
                                                    
                                                                     <tr class="taches-row"> 
                                                                 
                                                                       <td class="tache"><i class="bi bi-check2-circle"></i>&nbsp&nbsp  {{$tache_modelesint->libelle}}</td>
                                                                         <?php $agentinvs = DB::table('agents')->where('id', $tache_modelesint->res_dir)->get()  ?>
                                                                        @foreach($agentinvs as $agentinv)
                                                                        <!--  <td>-->
                                                                        <!--    <div class="lil-responsable" data-toggle="tooltip" data-placement="left" title="{{$agentinv->prenom}} {{$agentinv->nom}}">-->
                                                                        <!--         <span class="initials">-->
                                                                        <!--        {{substr($agentinv->prenom, 0, 1)}} {{substr($agentinv->nom, 0, 1)}}-->
                                                                        <!--        </span>-->
                                                                        <!--    </div>-->
                                                                           
                                                                        <!--</td>-->
                                                                        @endforeach
                                                                        <td class="tache">Deadline : {{strftime("%d/%m/%Y", strtotime($tache_modelesint->deadline))}}</td>
                                                                        @if($tache_modelesint->statut == 0)
                                                                        <td class="tache"><span class="badge bg-danger">Pas Fait</span></td>
                                                                        @else
                                                                        <td class="tache"><span class="badge bg-success" style="padding : 3% 14% 3% 14%">Fait</span></td>
                                                                        @endif
                                                                        
                                                                        @if($tache_modelesint->statut == 1)
                                                                        <td class="tache">Finalisée le {{strftime("%d/%m/%Y", strtotime($tache_modelesint->updated_at))}}</td>
                                                                         @else
                                                                        <td class="tache">Tâche en cours</td>
                                                                        @endif
                                                                       
                                                                        <td class="tache">Assignée depuis {{intval(strftime("%d", strtotime($tache_modelesint->updated_at)) - strftime("%d", strtotime($tache_modelesint->created_at)) / 86400)}} jours</td>
                                                                       
                                                                        <td class="tache">
                                                                            <div class="dropdown">
                                                                                <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="font-size : 12px;">
                                                                                    Mise à jour
                                                                                </button>
                                                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                                    <li>
                                                                                        <form action="{{route('faitm', $tache_modelesint->id)}}" method="post" id="target" class="form">
                                                                                        <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                                                             <span class="d-inline-block" tabindex="0">
                                                                                                 <button type="submit" id="PopoverCustomT-1" class="btn boutton-options">
                                                                                                  Fait
                                                                                                </button>
                                                                                            </span>
                                                                                         </form>   
                                                                                    </li>
                                                                                    <li>
                                                                                        <form action="{{route('pasfaitm', $tache_modelesint->id)}}" method="post" id="target" class="form">
                                                                                        <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                                                             <span class="d-inline-block" tabindex="0">
                                                                                                 <button type="submit" id="PopoverCustomT-1" class="btn boutton-options">
                                                                                                  Pas Fait
                                                                                                </button>
                                                                                            </span>
                                                                                         </form>   
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </td>
                                                                     
                                                                      
                                                                     </tr>
                                                                 
                                                                    
                                                             
                                                                  
                                                              @endforeach
                                                             </tbody>
                                                            </table>
                                                            
                                                            
                                                            @endif
                                                          
                                                         
                                                          
                                                    </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                            </div>
                    </div>
    
                      
            </div>
                   <!--End of the main div-->
        </div>
        <!--End of the main container-->
    
        </div>
    </div>
    

<!--================SCRIPTS=    ============ ============    -->
<script src="{{asset('v2/main.js')}}"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</body>
</html>
