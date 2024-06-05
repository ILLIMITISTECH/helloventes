<!doctype html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="short icon" href="{{asset('collov2/assets/images/icon.png')}}">
    <title>Collaboratis | Mes tâches</title>
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
                            <div class="card-body" style="position : relative;">
                                <h3  style="font-family: 'poppins', sans-serif; font-size : 16px;color : black;" >Suivi des mes Tâches </h3>
                             
                                <div class="table-responsive" style="margin-top : 2%;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card" >
                                                 <div class="card-body not-done">
                                                 <table class="" style ="width : 90%;">
                                                    <thead>
                                                    <tr>
                                                        <th class="table-label" colspan="2">Mes tâches non éffectuées</th>
                                                        <th class="table-label"></th>
                                                        <th class="table-label"></th>
                                                        <th class="table-label"></th>
                                                        <th class="table-label"></th>
                                                        <th class="table-label"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody >
                                                        <!--On liste d'abort les catégories d'activtés-->
                                                         <?php $agen = DB::table('agents')->where('user_id', Auth::user()->id)->first()  ?>
                                                        <?php $taches = DB::table('tache_modeles')->where('statut','=',0)->where('res_dir',$agen->id)->get()  ?>
                                                       @foreach($taches as $tache)
                                                        <tr >
                                                            <td class="text-nice">{{$tache->libelle}}</td>
                                                            <td class="text-nice"></td>
                                                            <td class="text-nice"></td>
                                                            <td class="text-nice"><span class="badge bg-danger">{{$tache->deadline}}</span></td>
                                                            <td class="text-nice"></td>
                                                            <td class="text-nice" style="text-align : right;">
                                                                         
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="font-size : 10px;">
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
                                                     </tbody>
                                                 </table>
            
                                                
                                         
                                                  </div>
                                            </div>
                                          
                                           
                                        
                                        </div>
                                            
                                        <div class="col-md-6">
                                            <div class="card">
                                                  <div class="card-body done">
                                                    <table class="" style ="width : 90%;">
                                                        <thead>
                                                        <tr>
                                                           
                                                            <th class="table-label" colspan="2">Mes tâches éffectuées</th>
                                                            <th class="table-label"></th>
                                                            <th class="table-label"></th>
                                                            <th class="table-label"></th>
                                                            <th class="table-label"></th>
                                                            <th class="table-label" style="text-align : right;"></th>
          
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                <!--On liste d'abort les catégories d'activtés-->
                                                <?php $agen = DB::table('agents')->where('user_id', Auth::user()->id)->first()  ?>
                                                <?php $taches = DB::table('tache_modeles')->where('statut','=',1)->where('res_dir',$agen->id)->get()  ?>
                                               @foreach($taches as $tache)
                                                <tr >
                                                    <td class="text-nice">{{$tache->libelle}} </td>
                                                    <td class="text-nice"></td>
                                                    <td class="text-nice"></td>
                                                    <td class="text-nice"><span class="badge bg-danger">{{$tache->deadline}}</span></td>
                                                    <td class="text-nice"></td>
                                                    <td class="text-nice" style="text-align : right;">
                                                        <!--<a class="btn btn-green" type="button" style="font-size : 10px; color : white;">
                                                            Archiver
                                                        </a>-->
                                                        
                                                        <form action="{{route('archiver', $tache->id)}}" method="post" id="target" class="form">
                                                            <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                            <span class="d-inline-block" tabindex="0">
                                                                <button type="submit" id="PopoverCustomT-1" style="font-size : 10px; color : white;" class="btn btn-green">
                                                                Archiver
                                                                </button>
                                                            </span>
                                                        </form>   
                                                    </td>
                                                </tr>
                                                @endforeach
                                             </tbody>
                                            </table>  
                                                  </div>
                                            </div>
                                        
                                        </div>    
                                    </div>        
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
            background: rgba(67, 146, 142, 0.2);
            border-radius: 15px;
            
            min-height : 500px !important;
            
            
        }
        .not-done {
            background: rgba(255, 11, 11, 0.2);
            border-radius: 15px;
           
            min-height : 500px !important;
        }
        
        .kanban-title{
             font-family: 'poppins', sans-serif; 
             font-size : 18px; 
             color : white;
        }
        
        .col-md-6 .card {
            border : none;
        }
      .badge{ 
          padding :5%;
      }
       
        
        
    </style>
<!--================SCRIPTS=    ============ ============    -->
<script src="{{asset('v2/main.js')}}"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>


</body>
</html>
