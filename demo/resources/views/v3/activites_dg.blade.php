<!doctype html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="short icon" href="{{asset('collov2/assets/images/icon.png')}}">
    <title>Collaboratis | Activités en instances de ma team</title>
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
    <!-- Button trigger modal -->
    
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

                                <div class ="row">
                                        @if (session('message'))
                                    <div class="alert alert-success" role="alert">
                                       {{ session('message') }}
                                    </div>
                                    @endif
                                    
                                </div>
                                
                                
                <div class="app-main__outer" >  
                    <div class="app-main__inner" >
                                  <div class="main-card mb-3 card">
                                      @if (session('message'))
                                <div class="alert alert-primary" role="alert">
                                   {{ session('message') }}
                                </div>
                                @endif
                                  <div class="card-header" style="position : relative; display : flex;"> 
                                        <h3  style="font-family: 'poppins', sans-serif; font-size : 18px;color : black;" >Activités en instances de ma team</h3>
                                         <a href="/create_dg" type="button" class="btn btn-dark" style="position : absolute; right : 5%; color : white;"> + Ajouter une activité</a>
                                         <div class="" style="position : absolute; right : 30%; color : white;">
                                           
                                            <select class="form-select" id="validationCustom04" required>
                                              <option selected disabled value=""> <span><i class="bi bi-filter-circle-fill"></i></span>Filtrer par direction</option>
                                              <option>Direction technique</option>
                                            </select>
                                            <div class="invalid-feedback">
                                              Please select a valid state.
                                            </div>
                                          </div>
                                     
                                         
                               </div>
                               
                               @if(Auth::user()->nom_role == 'directeur')
                               <div class="card-body" style="position : relative;">
                             
                                <div class="table-responsive" style="margin-top : 2%;">
                                    
                                        <table class="align-middle mb-0 table table-borderless  table-hover">
                                            <thead>
                                            <tr>
                                               
                                                <th class="table-label">Libellé</th>
                                                <th class="table-label">Responsable</th>
                                                <th class="table-label">Backup</th>
                                                <th class="table-label">Pourcentage</th>
                                                <th class="table-label">Échéance</th>
                                                <th class="table-label">Temps</th>
                                                <th class="table-label">Options</th>
                                                <th class="table-label"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php $agen = DB::table('agents')->where('user_id', Auth::user()->id)->first()  ?>
                                                         <?php $agen_dir = DB::table('agents')->where('direction_id', $agen->direction_id)->get()  ?>
                                                        
                                                        <?php $modeles = DB::table('modeles')->get()  ?>
        
                                                <!--On liste d'abort l'activté et ses paramètres-->
                                                 @foreach($modeles as $modele)  
                                                 <?php $agen = DB::table('agents')->where('user_id', Auth::user()->id)->first()  ?>
                                                
                                                <tr>
                                                    <td class="activite-element">{{$modele->libelle}}</td>
                                                    <?php $ages = DB::table('agents')->where('id', $modele->res_dir)->get()  ?>
                                                    @foreach($ages as $as)
                                                    <td data-toggle="tooltip" data-placement="left" title="{{$as->prenom}} {{$as->nom}}">
                                                        <span  style="border: 1px solid #f7b924; border-radius:40px; background:#ffdf6c; color:white; font-weight:bold; font-size:15px; padding:5px; text-shadow: 1px 1px 2px black;">
                                                            {{substr($as->prenom, 0, 1)}} {{substr($as->nom, 0, 1)}}
                                                        </span>
                                                    </td>
                                                    @endforeach
                                                    <?php $agenss = DB::table('agents')->where('id', $modele->backup)->get()  ?>
                                                    @foreach($agenss as $ass)
                                                    <td data-toggle="tooltip" data-placement="left" title="{{$ass->prenom}} {{$ass->nom}}">
                                                        <span  style="border: 1px solid #f7b924; border-radius:40px; background:#ffdf6c; color:white; font-weight:bold; font-size:15px; padding:5px; text-shadow: 1px 1px 2px black;">
                                                            {{substr($ass->prenom, 0, 1)}} {{substr($ass->nom, 0, 1)}}
                                                        </span>
                                                    </td>
                                                    @endforeach
                                                    <!--pourcentage V3 -->
                                                     <?php $count = DB::table('tache_modeles')->where('modele_id', $modele->id)->count()  ?>
                                                     <?php $sum = DB::table('tache_modeles')->where('modele_id', $modele->id)->where('statut','=',1)->count()  ?>
                                                     <?php $total = $count == 0 ? 0 : $sum / $count ?>
                                                     <td style="position : relative;" >
                                                        <div class="progress-value" style="position : absolute; top : -2px;margin-top : 2%;">
                                                                        {{intval($total * 100)}}%
                                                                 </div>
                                                                <div class="progress" style="height: 5px;width : 100px; background: #C4C4C4; border-radius: 5px; margin-top :5%;">
                                                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: {{$total * 100}}%;"></div>
                                                                </div>
                                                     </td>
                                                      
                                                       <!--pourcentage V3 -->
                                                     
                                                    <td class="activite-element">{{strftime("%d/%m/%Y", strtotime($modele->deadline))}}</td>
                                                    <td class="activite-element">{{$modele->nbr_jour}} jours</td>
                                                    <td><a href="{{route('voir_modele',$modele->id)}}" class="btn btn-dark" type="button" style="font-size : 12px;">
                                                                    Voir plus
                                                                </a></td>
                                                    <td></td>
                                                    
                                                    </tr>
                                                  
                                                    <!--- activites -->
                                                    <?php $agen = DB::table('agents')->where('user_id', Auth::user()->id)->first()  ?>
                                                         <?php $agen_dir = DB::table('agents')->where('direction_id', $agen->direction_id)->get()  ?>
                                                         
                                                        <?php $activites = DB::table('activites')->where('statut','=',0)->get()  ?>
        
                                                <!--On liste d'abort l'activté et ses paramètres-->
                                                
                                                  
                                                    
                                                    @endforeach
                                             </tbody>
                                            </table>
                                                
                                        </div>
                                            
                                        
                                    </div>        
                               @else
                            <div class="card-body" style="position : relative;">
                             
                                <div class="table-responsive" style="margin-top : 2%;">
                                            
                                                 
                                        <table class="align-middle mb-0 table table-borderless  table-hover">
                                            <thead>
                                            <tr>
                                               
                                                <th class="table-label">Libellé</th>
                                                <th class="table-label">Responsable</th>
                                                <th class="table-label">Backup</th>
                                                <th class="table-label">Pourcentage</th>
                                                <th class="table-label">Échéance</th>
                                                <th class="table-label">Temps</th>
                                                <th class="table-label">Options</th>
                                                <th class="table-label"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php $agen = DB::table('agents')->where('user_id', Auth::user()->id)->first()  ?>
                                                         <?php $agen_dir = DB::table('agents')->where('direction_id', $agen->direction_id)->get()  ?>
                                                        @foreach($agen_dir as $agenr)   
                                                        <?php $modeles = DB::table('modeles')->where('res_dir', $agenr->id)->get()  ?>
        
                                                <!--On liste d'abort l'activté et ses paramètres-->
                                                 @foreach($modeles as $modele)  
                                                 <?php $agen = DB::table('agents')->where('user_id', Auth::user()->id)->first()  ?>
                                                
                                                <tr>
                                                    
                                                    <td class="activite-element">{{$modele->libelle}}</td>
                                                    <?php $ages = DB::table('agents')->where('id', $modele->res_dir)->get()  ?>
                                                    @foreach($ages as $as)
                                                    <td data-toggle="tooltip" data-placement="left" title="{{$as->prenom}} {{$as->nom}}">
                                                        <span  style="border: 1px solid #f7b924; border-radius:40px; background:#ffdf6c; color:white; font-weight:bold; font-size:15px; padding:5px; text-shadow: 1px 1px 2px black;">
                                                            {{substr($as->prenom, 0, 1)}} {{substr($as->nom, 0, 1)}}
                                                        </span>
                                                    </td>
                                                    @endforeach
                                                    <?php $agenss = DB::table('agents')->where('id', $modele->backup)->get()  ?>
                                                    @foreach($agenss as $ass)
                                                    <td data-toggle="tooltip" data-placement="left" title="{{$ass->prenom}} {{$ass->nom}}">
                                                        <span  style="border: 1px solid #f7b924; border-radius:40px; background:#ffdf6c; color:white; font-weight:bold; font-size:15px; padding:5px; text-shadow: 1px 1px 2px black;">
                                                            {{substr($ass->prenom, 0, 1)}} {{substr($ass->nom, 0, 1)}}
                                                        </span>
                                                    </td>
                                                    @endforeach
                                                    <!--pourcentage V3 -->
                                                     <?php $count = DB::table('tache_modeles')->where('modele_id', $modele->id)->count()  ?>
                                                     <?php $sum = DB::table('tache_modeles')->where('modele_id', $modele->id)->where('statut','=',1)->count()  ?>
                                                     <?php $total = $count == 0 ? 0 : $sum / $count ?>
                                                     <td style="position : relative;" >
                                                        <div class="progress-value" style="position : absolute; top : -2px;margin-top : 2%;">
                                                                        {{intval($total * 100)}}%
                                                                 </div>
                                                                <div class="progress" style="height: 5px;width : 100px; background: #C4C4C4; border-radius: 5px; margin-top :5%;">
                                                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: {{$total * 100}}%;"></div>
                                                                </div>
                                                     </td>
                                                      
                                                       <!--pourcentage V3 -->
                                                     
                                                    <td class="activite-element">{{strftime("%d/%m/%Y", strtotime($modele->deadline))}}</td>
                                                    <td class="activite-element">{{$modele->nbr_jour}} jours</td>
                                                    <td><a href="{{route('voir_modele',$modele->id)}}" class="btn btn-dark" type="button" style="font-size : 12px;">
                                                                    Voir plus
                                                                </a></td>
                                                    <td></td>
                                                    
                                                    </tr>
                                                  
                                                    <!--- activites -->
                                                    <?php $agen = DB::table('agents')->where('user_id', Auth::user()->id)->first()  ?>
                                                         <?php $agen_dir = DB::table('agents')->where('direction_id', $agen->direction_id)->get()  ?>
                                                         
                                                        <?php $activites = DB::table('activites')->where('statut','=',0)->get()  ?>
        
                                                <!--On liste d'abort l'activté et ses paramètres-->
                                                
                                                  
                                                    @endforeach
                                                    @endforeach
                                             </tbody>
                                            </table>
                                                
                                        </div>
                                            
                                        
                                    </div>  
                                    @endif
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        
            </div>          
            
            
            
            
            
            
            
                                         
                                            
                        <!-- end section -->

                            <div class="app-wrapper-footer">
                                <div class="app-footer">
                                    <div class="app-footer__inner">
                                        <div class="app-footer-left">
                                            <ul class="nav">
                                                <li class="nav-item">
                                                    <a href="javascript:void(0);" class="nav-link">
                                                        
                                                    </a>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>    
                    
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
            font-size : 14px;
        }
        
        .btn-green {
            background-color : #43928E ;
            color : white;
        }
        
        .catégorie {
           border-bottom : 1px solid #C4C4C4; 
           border-top: 1px solid #C4C4C4; 
          
           box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.15);
         
           background-color : #F8F8F8;
   
        }
        
        .table-done-container{
            border-radius : 20px;
            background-color : #43928E;
         
        }
        .done{
            background: rgba(67, 146, 142, 0.5);
            border-radius: 5px;
            border: none;
            min-height : 500px !important;
            
            
        }
        .not-done {
            background: rgba(255, 11, 11, 0.5);
            border-radius: 5 px;
            border: none;
            min-height : 500px !important;
        }
        
        .kanban-title{
             font-family: 'poppins', sans-serif; 
             font-size : 18px; 
             color : white;
        }
       table {
            
        }
       
        
        
    </style>
<!--================SCRIPTS=    ============ ============    -->
<script src="{{asset('v2/main.js')}}"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>


</body>
</html>
