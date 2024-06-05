<!doctype html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="short icon" href="{{asset('collov2/assets/images/icon.png')}}">
    <title>Collaboratis | Modèles d'activités</title>
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

                                <div class ="row">
                                        @if (session('message'))
                                    <div class="alert alert-success" role="alert">
                                       {{ session('message') }}
                                    </div>
                                    @endif
                                    
                                </div>
                                
                                
                <div class="app-main__outer">  
                    <div class="app-main__inner">
                                  <div class="main-card mb-3 card">
                                      @if (session('message'))
                                <div class="alert alert-primary" role="alert">
                                   {{ session('message') }}
                                </div>
                                @endif
                            <div class="card-body" style="position : relative;">
                                <a href="/ajout_cat" class="btn btn-dark" style="position : absolute; right : 2%;"><i class="bi bi-plus-circle"></i> Ajouter une catégorie</a>
                                <h5 class="card-title" style="font-family: 'poppins', sans-serif; font-size : 18px; color : black;">Sélectionner un modèle d'activité </h5>
                                <p>Une fois le modèle choisi vous pourrez modifier l’activité comme vous le souhaitez </p>
                                <div class="table-responsive">
                                       
                                        <table class="align-middle mb-0 table table-borderless  table-hover">
                                            <thead>
                                            <tr>
                                               
                                                <th class="">Catégorie d'activité</th>
                                                <th class="table-label"></th>
                                                <th class="table-label"></th>
                                                <th class="table-label"></th>
                                                <th class="table-label"></th>
                                                <th class="table-label"></th>
                                                <th class="" style="text-align :center;">Options</th>
                                               
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <!--On liste d'abort les catégories d'activtés-->
                                                <?php $categories = DB::table('categories')->get()  ?>
                                               @foreach($categories as $categorie)
                                                <tr class ="catégorie">
                                                    <td class="text-nice">{{$categorie->libelle}} </td>
                                                    <td class="text-nice"></td>
                                                    <td class="text-nice"></td>
                                                    <td class="text-nice"></td>
                                                    <td class="text-nice"></td>
                                                    <td class="text-nice"></td>
                                                    <td class="text-nice">
                                                       <form action="{{ route('destroy_cat',$categorie->id) }}" method="POST">
                                                        <a href="{{ route('edit_categorie',$categorie->id) }}" class="btn btn-success" style="font-size : 16px; padding : 5% 15% 5% 15%;"><i class="bi bi-pencil"></i></a> 
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="font-size : 16px; padding : 5% 15% 5% 15%;"><i class="bi bi-trash-fill"></i></button> 
                                                    </form>
                                                    </td>
                                                </tr>
                                         
                                                <tr>
                                                    <th class="table-label"></th>
                                                    <th class="text-nice">Libellé des modéles</th>
                                                    <th class="text-nice">Créateur</th>
                                                    <th class="text-nice">Durée</th>
                                                    <th class="text-nice">Tâches</th>
                                                    <th class="text-nice">Option</th>
                                                </tr>
                                                    <?php $activites = DB::table('activites')->where('statut', '=', 1)->where('categorie_id', $categorie->id)->orderBy('deadline', 'DESC')->get()  ?>
                                                     @foreach($activites as $activite)
                                                     <?php $createurs = DB::table('users')->where('id', $activite->createur_id)->get()  ?>
                                                     <?php $taches = DB::table('taches')->where('activite_id', $activite->id)->count()  ?>
                                                      <tr> 
                                                       <td></td>
                                                        <td class="text-nice">{{$activite->libelle}}</td>
                                                        @foreach($createurs as $createur)
                                                        <td data-toggle="tooltip" data-placement="left" title="{{substr($createur->prenom, 0, 1)}} {{substr($createur->nom, 0, 1)}}">
                                                            <span  style="border-radius:40px; background:#ffdf6c; color:black;  font-size:13px; padding:5px;">
                                                               {{substr($createur->prenom, 0, 1)}} {{substr($createur->nom, 0, 1)}}
                                                            </span>
                                                        </td>
                                                        @endforeach
                                                       <td class="text-nice">{{intval(strftime("%d", strtotime($activite->updated_at)) - strftime("%d", strtotime($activite->created_at)) / 86400)}} jours</td>
                                                       <td class="text-nice"><span class="badge bg-dark" style="padding : 10%;">{{$taches}}</span></td>
                                                       <td class="text-nice"> <a class="btn btn-green" href="{{ route('ajout_modele',$activite->id) }}" style="font-size : 12px;">Utiliser </a></td>
                                               
                                                     </tr>
                                                     @endforeach
                                                @endforeach
                                             </tbody>
                                            </table>
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
        
        .catégorie{
           border-bottom : 1px solid #C4C4C4; 
           /*border-top: 1px solid #C4C4C4; */
          
           box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.15);
         
           /*background-color : #F8F8F8;*/
   
        }
        
        
    </style>
<!--================SCRIPTS=    ============ ============    -->
<script src="{{asset('v2/main.js')}}"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>


</body>
</html>
