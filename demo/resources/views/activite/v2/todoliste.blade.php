<!doctype html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="short icon" href="{{asset('collov2/assets/images/icon.png')}}">
    <title>COLLABORATIS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
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
<link href="{{asset('v2/main.css')}}" rel="stylesheet"></head>
<body>
    @include('v3.modal')
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
            <!--header -->
            @include('v2.header_dg')
            <!-- end header -->

        <div class="app-main">
                <!-- side bar -->
                @include('v2.side_bar_dg')

                <div class="card-body" style="position : relative;">
                        
                                <div class="wrapper">
                                    <header 
                                        <h3 style ="font-family: 'poppins', sans-serif; font-size : 16px;color : black; margin-bottom :2%;" >Ma To-do list</h3> 
                                    </header>
                                                <form action="{{route('todo.list')}}" method="post"  class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload" enctype="multipart/form-data">
                                                     @csrf
                                            
                                                      <p class="text-nice"> <i class="bi bi-lightbulb"> </i> Astuce :  Définissez vos 3 Priorités de la journée et mettez vous immédiatement au travail</p>
                                                      <div class="inputField">
                                                        
                                                      <input name="tache_liste" type="text" class="form-control" placeholder="Ajouter une nouvelle Tâche" required>
                                                      <input name="user_id" value="{{Auth::user()->id}}" type="hidden" class="form-control" placeholder="Tache">
                                                      
                                                     <button type="submit" class="button"><i class="fas fa-plus"></i></button>
                                                      </div>   
                                                       
                                                </form>
                                                                                                      
                                            <ul class="todoList">
                                                  <!-- data are comes from local storage -->
                                                
                                                  @foreach($listes as $list)
                                                  
                                                    <li> 
                                                        <div style="position : relative;">
                                                             <span style=" font-family : poppins; margin-top : 10%;">{{$list->tache_liste}} </span>
                                                            
                                                            <form action="{{route('liste.destroy', $list->id)}}" method="post">
                                                                    {{ csrf_field() }}
                                                                    @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger" style ="position : absolute; right : 2%; top :5%; "><i class="bi bi-trash"></i></button>
                                                            </form>
                                                        </div>
                                                   </li>
                                                  
                                                   @endforeach
                                                  
                                                   
                                                </ul>
                                                
                                                <div class="footer">
                                                  <span style="font-family : poppins; display : block;" >Tu as <span class="pendingTasks">{{count($listes)}}</span> tâches en instances</span>
                                                  
                                                </div>
                                            </div>
                                
                                
    
                            </div>
                        </div>
                    </div>
                      
            
              
                    
                </div>
               
        </div>
    </div>
    
    
    <!--To do list CSS code -->
     <style> 
     
     .pendingTasks{
         color : white;
         background-color : black;
         padding : 1% 2% 1% 2%;
         border-radius : 15%;
         font-family : poppins;
         
     }
     
     .wrapper{
  background: #fff;
  max-width: 800px;
  width: 100%;
  margin: auto;
  padding: 25px;
  border-radius: 5px;
  box-shadow: 0px 10px 15px rgba(0,0,0,0.1);
}
.wrapper header{
  font-size: 30px;
  font-weight: 600;
}
.wrapper .inputField{
  margin: 20px 0;
  width: 100%;
  display: flex;
  height: 45px;
}
.inputField input{
  width: 85%;
  height: 100%;
  outline: none;
  border-radius: 3px;
  border: 1px solid #ccc;
  font-size: 17px;
  padding-left: 15px;
  transition: all 0.3s ease;
}
.inputField input:focus{
  border-color: #8E49E8;
}
.inputField button{
  width: 50px;
  height: 100%;
  border: none;
  color: #fff;
  margin-left: 5px;
  font-size: 21px;
  outline: none;
  background: #43928E;
  cursor: pointer;
  border-radius: 3px;
  opacity: 0.9;
  transition: all 0.3s ease;
}
.inputField button:hover,
.footer button:hover{
  background: #43928E;
}
.inputField button.active{
  opacity: 1;
}
.wrapper .todoList{
  max-height: 250px;
  overflow-y: auto;
}
.todoList li{
  position: relative;
  list-style: none;
  height: 45px;
  line-height: 15px;
  width: 550px;
  margin-bottom: 8px;
  background: #f2f2f2;
  border-radius: 3px;
  padding: 0 15px;
  cursor: default;
  overflow: hidden;
}
.todoList li .icon{
  position: absolute;
  right: -45px;
  background: #e74c3c;
  width: 45px;
  text-align: center;
  color: #fff;
  border-radius: 0 3px 3px 0;
  cursor: pointer;
  transition: all 0.2s ease;
}
.todoList li:hover .icon{
  right: 0px;
}
.wrapper .footer{
  
  width: 100%;
  margin-top: 20px;
  align-items: center;
  justify-content: space-between;
}
.footer button{
  padding: 6px 10px;
  border-radius: 3px;
  border: none;
  outline: none;
  color: #fff;
  font-weight: 400;
  font-size: 16px;
  margin-left: 5px;
  background: #43928E;
  cursor: pointer;
  user-select: none;
  opacity: 0.6;
  pointer-events: none;
  transition: all 0.3s ease;
}
.footer button.active{
  opacity: 1;
  pointer-events: auto;
}
     
     
     </style>
     
     
     <style> 
     
  
.inputFields td{
  width: 85%;
  height: 100%;
  outline: none;
  border-radius: 3px;
  border: 1px solid #ccc;
  font-size: 17px;
  padding-left: 15px;
  transition: all 0.3s ease;
}
.inputFields td:focus{
  border-color: #8E49E8;
}
.inputFields button{
  width: 50px;
  height: 100%;
  border: none;
  color: #fff;
  margin-left: 5px;
  font-size: 21px;
  outline: none;
  background: red;
  cursor: pointer;
  border-radius: 3px;
  opacity: 0.9;
  transition: all 0.3s ease;
}
.inputFields button:hover,
.footer button:hover{
  background: #43928E;
}
.inputFields button.active{
  opacity: 1;
}

     
     </style>
    
    <style>
        .red{
            color :red;
            font-weight : bold;
        }
        .text-nice{
            font-family: 'poppins', sans-serif;
            font-size : 16px;
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
            border-radius: 15px;
            
            min-height : 500px !important;
            
            
        }
        .not-done {
            background: rgba(255, 11, 11, 0.5);
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
