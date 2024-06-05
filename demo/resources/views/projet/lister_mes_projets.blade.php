<!doctype html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="short icon" href="{{asset('collov2/assets/images/icon.png')}}">
    <title>Collaboratis | Mes projets</title>
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
            <!--header -->
             @include('v2.header_dg')
            <!-- end header -->

        <div class="app-main">
                <!-- side bar -->
                
                @include('v2.side_bar_dg')
    
                <!-- end side bar -->
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-title-box" style="position : relative; display : flex;">
                                    <h4 class="section-title">Mes projets</h4>
                                    
                                </div>
                                
                                    @if(Session::has("success"))
                                            <div class="alert alert-success">
                                                <b>Projet clôturé avec succès.</b> 
                                            </div>
                                        @endif
                                        <h5>@if (session('message'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('message') }}
                                </div>  
                                @endif
                                </h5>
                                      <div class="main-card card" style="border-radius : 10px;">
                                    <div class="card-header" style="font-family: 'Montserrat', sans-serif; font-size : 12 px; font-weight : bolder; color : black;">Liste de mes projets</div>
                                    <div class="table-responsive">
                                        <table class="align-middle mb-0 table table-borderless  table-hover">
                                            <thead>  
                                            <tr>
                                                <th class="">Libellé</th>
                                                <!--<th>Backup</th>-->
                                                <th class="">Priorité</th>
                                                <th class="">Progression</th>
                                                <th class="">Échéance</th>
                                                <th class="">Retard</th>
                                                <th class="">Options</th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody class="panel">
                                            @foreach($projets as $action)  
                                             @if($action->visibilite == 0)
                                            <div>
                                                
                                                            <tr class="actions">
                                                                <!--<form action="/save_action" method="post" id="target">-->
                                                                <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                                    <!--<td id="show" class="text-nice">{{$action->libelle}}</td>-->
                                                                    <td class="text-nice">
                                                                   <p>
                                                                        <p  class="text-nice" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                                             {{$action->libelle}}
                                                                          </p>
                                                                    </p>
                                                                    </td>
                                                                    
                                                                   @if($action->priorite == 'Elevé(E)')
                                                                    <td class="text-nice"><div class="badge badge-danger">Elevé</div></td>
                                                                    @elseif($action->priorite == 'Moins(M)')
                                                                    <td class="text-nice"><div class="badge badge-warning">Moyen</div></td>
                                                                    @else($action->priorite == 'Faible(F)')
                                                                    <td class="text-nice"><div class="badge badge-success">Faible</div></td>
                                                                    @endif
                                                                    <td style="position : relative;" >
                                                                        <div class="progress-value" style="position : absolute; top : -15px;margin-top : 10%;">
                                                                                        {{$action->pourcentage}}%
                                                                         </div>
                                                                        <div class="progress" style="height: 5px;width : 100px; background: #C4C4C4; border-radius: 5px; margin-top :10%;">
                                                                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: {{$action->pourcentage}}%;"></div>
                                                                        </div>
                                                                     </td>
                                                                 
                                                                   
                                                                    <td class="text-nice"><span class="badge bg-dark">{{strftime("%d/%m/%Y", strtotime($action->deadline))}}</span></td>
                                                                    @if($action->deadline < now())
                                                                    <td class="tache text-nice">{{intval(abs(strtotime("now") - strtotime($action->deadline))/ 86400)}} jours</td> 
                                                                    @else
                                                                    <td class="tache text-nice"> Pas de retard</td>
                                                                    @endif

                                                                    <td class="text-center" colspan ="2">
                                                                        <div class="student-dtl" style="display:flex;">
                                                   
                                                                            <span class="d-inline-block" tabindex="0" style="margin-right : 10%;">
                                                                                <!--<a id="PopoverCustomT-1" href="{{route('lesbakup.projet', $action->id)}}" type="button" class="btn boutton-options">-->
                                                                                <!--    <i class="bi bi-person-fill" style="color : black;" data-toggle="tooltip" title="Liste des backup"></i>-->
                                                                                <!--</a>-->
                                                                            </span>
                                                                            
                                                                            <span class="d-inline-block" tabindex="0" style="margin-right : 10%;">
                                                                                <a id="PopoverCustomT-1" href="{{route('monprojet.editer', $action->id)}}" type="button" class="btn boutton-options">
                                                                                    <i class="fas fa-sync" style="color : black;" data-toggle="tooltip" title="Mettre à jour votre projet"></i>
                                                                                </a>
                                                                            </span>
                                                    
                                                                             <form action="{{route('visibiliter.cloturer', $action->id)}}" method="post" id="target" class="form">
                                                                                <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                                            @if($action->pourcentage == 100)
                                                                             <span class="d-inline-block" tabindex="0">
                                                                                 <button type="submit" id="PopoverCustomT-1" class="btn boutton-options">
                                                                              
                                                                                <i class="fas fa-check" style="color : black;" data-toggle="tooltip" title="Cloturer le projet"></i>
                                                                                </button>
                                                                            </span>
                                                                            @else
                                                                             <span class="d-inline-block" tabindex="0" disabled>
                                                                                 <button type="submit" id="PopoverCustomT-1" class="btn boutton-options" disabled>
                                                                              
                                                                                <i class="fas fa-check" style="color : black;" data-toggle="tooltip" title="Cloturer le projet" disabled></i>
                                                                                </button>
                                                                            </span>
                                                                            @endif
                                                                            </form>
                                                    
                                                
                                                                            </div>
                                                                    </td>
                                                              @php $agentbackups = DB::table('agent_projets')->where('projet_id', $action->id)->get();  @endphp
                                                                @foreach($agentbackups as $agentbackup)
                                                               
                                                                 <tr class="collapse" id="collapseExample">
                                                                     <td class="text-nice"> <b></b> </td>
                                                                     @php $agent = DB::table('agents')->where('id', $agentbackup->agent_id)->first();  @endphp
                                                                     <td class="text-nice"><b>  {{$agent->prenom}}</b></td>
                                                                     <td class="text-nice"><b> {{$agent->nom}}</b></td>
                                                                     <td class="text-nice"> <b></b> </td>
                                                                     <td class="text-nice"> <b></b> </td>
                                                                     <td class="text-nice"> <b></b> </td>
                                                                 </tr>
                                                                
                                                                @endforeach    
                                                                <!--</form>-->
                                                            </tr>
                                                        </tbody>
                                                   
                                                </div>

                                            </div>
                                                            </div>
                                                           @endif
                                                             @endforeach
                                                     
                                            
                                                 
                                            </tbody>
                                        </table>
                                        <!--<p>-->
  <!--<a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">-->
  <!--  Link with href-->
  <!--</a>-->
  <!--<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">-->
  <!--  Button with data-target-->
  <!--</button>-->
<!--</p>-->
<!--<div class="collapse" id="collapseExample">-->
<!--  <div class="card card-body">-->
    <!--Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.-->
<!--  </div>-->
<!--</div>-->
                                        </div>
                                </div>
                           
                            </div>
                        </div>


                    </div>
<style>



.responsable{
    height : 70px;
    width : 70px;
    border-radius : 50%;
    color : white;
    background-color : red;
    padding :10%;
    text-align: center;
    font-size : 16px;
    background : #43928E;
}

.backup {
    height : 70px;
    width : 70px;
    border-radius : 50%;
    color : white;
    background-color : blue;
    padding :10%;
    text-align: center;
    font-size : 14px;
}




.section-title{
    font-family : poppins;
    font-size : 16px;
    font-weight :bold;
}
.section-title-box{
    margin-bottom : 2%;
}

.section-main{
    margin : 2%;
}
.text-nice{
    font-family: 'poppins', sans-serif;
}

.card-body-todo{
    
}


.actions  td:first-child,
.actions  th:first-child {

  border-radius: 5px 5px 5px 5px;
  padding: 5%;
}

.actions  td:last-child,
.actions th:last-child {
  border-radius: 0 5px 5px 0;
 
}   
    
    
.boutton-options {
    background-color : #4B8F8C;
    padding : 0 15px 0 15px;
}  
    
    
    

.flip-box {
background-color: transparent;
width: 25px;
height: 25px;
border: 1px solid #f1f1f1;
perspective: 1000px;
}

.flip-box-inner {
position: relative;
width: 100%;
height: 100%;
text-align: center;
transition: transform 0.8s;
transform-style: preserve-3d;
}

.flip-box:hover .flip-box-inner {
transform: rotateY(180deg);
}

.flip-box-front, .flip-box-back {
position: absolute;
width: 100%;
height: 100%;
-webkit-backface-visibility: hidden;
backface-visibility: hidden;
}

.flip-box-front {

color: black;
}

.flip-box-back {
background-color: white;
color: green;
text-align: center;
transform: rotateY(180deg);
}
</style> 

<style>

/* The Modal (background) */
.modal {
display: none; /* Hidden by default */
margin-left: 90px;
margin-top: 150px;
width: 250px; /* Full width */
height: 80px; /* Full height */


}

/* Modal Content */
.modal-content {
background-color: #fefefe;
margin: auto;
padding: 20px;
border: 1px solid #888;
width: 100%;
height: 100%;
}

/* The Close Button */
.close {
color: #aaaaaa;
float: right;
font-size: 28px;
font-weight: bold;
}

.close:hover,
.close:focus {
color: #000;
text-decoration: none;
cursor: pointer;
}
</style>

<style>
.todo-nav {
    margin-top: 10px
}

.todo-list {
    margin: 10px 0
}

.todo-list .todo-item {
    padding: 15px;
    margin: 5px 0;
    border-radius: 0;
    background: #f7f7f7
}

.todo-list.only-active .todo-item.complete {
    display: none
}

.todo-list.only-active .todo-item:not(.complete) {
    display: block
}

.todo-list.only-complete .todo-item:not(.complete) {
    display: none
}

.todo-list.only-complete .todo-item.complete {
    display: block
}

.todo-list .todo-item.complete span {
    text-decoration: line-through
}

.remove-todo-item {
    color: #ccc;
    visibility: hidden
}

.remove-todo-item:hover {
    color: #5f5f5f
}

.todo-item:hover .remove-todo-item {
    visibility: visible
}

div.checker {
    width: 18px;
    height: 18px
}

div.checker input,
div.checker span {
    width: 18px;
    height: 18px
}

div.checker span {
    display: -moz-inline-box;
    display: inline-block;
    zoom: 1;
    text-align: center;
    background-position: 0 -260px;
}

div.checker, div.checker input, div.checker span {
    width: 19px;
    height: 19px;
}

div.checker, div.radio, div.uploader {
    position: relative;
}

div.button, div.button *, div.checker, div.checker *, div.radio, div.radio *, div.selector, div.selector *, div.uploader, div.uploader * {
    margin: 0;
    padding: 0;
}

div.button, div.checker, div.radio, div.selector, div.uploader {
    display: -moz-inline-box;
    display: inline-block;
    zoom: 1;
    vertical-align: middle;
}
    
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
$(document).ready(function(){

@foreach($action_respons as $suivi)

$("#loginVisibilite{{$suivi->id}}").change(function(){  
var visibilite = $("#loginVisibilite{{$suivi->id}}").val();
var suiviID = $("#suiviID{{$suivi->id}}").val()
if(visibilite==""){
alert("please select an option");
}else{
$.ajax({
url: '{{url("/admin/banSuivi")}}',
data: 'visibilite=' + visibilite + '&suiviID=' + suiviID,
type: 'get',
success:function(response){
console.log(response);  
}
});
}

});

$("#loginnVisibilite{{$suivi->id}}").change(function(){  
var visibilite = $("#loginnVisibilite{{$suivi->id}}").val();
var suiviID = $("#suiviID{{$suivi->id}}").val()
if(visibilite==""){
alert("please select an option");
}else{
$.ajax({
url: '{{url("/admin/banSuivi")}}',  
data: 'visibilite=' + visibilite + '&suiviID=' + suiviID,
type: 'get',
success:function(response){
console.log(response);
}
});
}

});
@endforeach
});
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script>
$(document).ready(function(){

@foreach($action_bakups as $suivi)

$("#loginVisibilite{{$suivi->id}}").change(function(){  
var visibilite = $("#loginVisibilite{{$suivi->id}}").val();
var suiviID = $("#suiviID{{$suivi->id}}").val()
if(visibilite==""){
alert("please select an option");
}else{
$.ajax({
url: '{{url("/admin/banSuivi")}}',
data: 'visibilite=' + visibilite + '&suiviID=' + suiviID,
type: 'get',
success:function(response){
console.log(response);  
}
});
}

});

$("#loginnVisibilite{{$suivi->id}}").change(function(){  
var visibilite = $("#loginnVisibilite{{$suivi->id}}").val();
var suiviID = $("#suiviID{{$suivi->id}}").val()
if(visibilite==""){
alert("please select an option");
}else{
$.ajax({
url: '{{url("/admin/banSuivi")}}',  
data: 'visibilite=' + visibilite + '&suiviID=' + suiviID,
type: 'get',
success:function(response){
console.log(response);
}
});
}

});
@endforeach
});
</script>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
if (event.target == modal) {
modal.style.display = "none";
}
}
</script>

<script>
    $( document ).ready(function() {
    
    "use strict";
    
    var todo = function() { 
        $('.todo-list .todo-item input').click(function() {
        if($(this).is(':checked')) {
            $(this).parent().parent().parent().toggleClass('complete');
        } else {
            $(this).parent().parent().parent().toggleClass('complete');
        }
    });
    
    $('.todo-nav .all-task').click(function() {
        $('.todo-list').removeClass('only-active');
        $('.todo-list').removeClass('only-complete');
        $('.todo-nav li.active').removeClass('active');
        $(this).addClass('active');
    });
    
    $('.todo-nav .active-task').click(function() {
        $('.todo-list').removeClass('only-complete');
        $('.todo-list').addClass('only-active');
        $('.todo-nav li.active').removeClass('active');
        $(this).addClass('active');
    });
    
    $('.todo-nav .completed-task').click(function() {
        $('.todo-list').removeClass('only-active');
        $('.todo-list').addClass('only-complete');
        $('.todo-nav li.active').removeClass('active');
        $(this).addClass('active');
    });
    
    $('#uniform-all-complete input').click(function() {
        if($(this).is(':checked')) {
            $('.todo-item .checker span:not(.checked) input').click();
        } else {
            $('.todo-item .checker span.checked input').click();
        }
    });
    
    $('.remove-todo-item').click(function() {
        $(this).parent().remove();
    });
    };
    
    todo();
    
    $(".add-task").keypress(function (e) {
        if ((e.which == 13)&&(!$(this).val().length == 0)) {
            $('<div class="todo-item"><div class="checker"><span class=""><input type="checkbox"></span></div> <span>' + $(this).val() + '</span> <a href="javascript:void(0);" class="float-right remove-todo-item"><i class="icon-close"></i></a></div>').insertAfter('.todo-list .todo-item:last-child');
            $(this).val('');
        } else if(e.which == 13) {
            alert('Please enter new task');
        }
        $(document).on('.todo-list .todo-item.added input').click(function() {
            if($(this).is(':checked')) {
                $(this).parent().parent().parent().toggleClass('complete');
            } else {
                $(this).parent().parent().parent().toggleClass('complete');
            }
        });
        $('.todo-list .todo-item.added .remove-todo-item').click(function() {
            $(this).parent().remove();
        });
    });
});
</script>
 
                        <!-- end section -->

                            <div class="app-wrapper-footer">
                                <div class="app-footer">
                                    <div class="app-footer__inner">
                                        <div class="app-footer-left">
                                            <ul class="nav">
                                                <li class="nav-item">
                                                    <a href="javascript:void(0);" class="nav-link">
                                                        © Collaboratis 2021
                                                    </a>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>    
                    
                </div>
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="{{asset('v2/main.js')}}"></script>

<!--<show and hide>-->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



</body>
</html>
