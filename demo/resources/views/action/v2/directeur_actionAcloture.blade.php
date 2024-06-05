<!doctype html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="short icon" href="{{asset('collov2/assets/images/icon.png')}}">
    <title>COLLABORATIS</title>
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Set a style for all buttons */
.myButton {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 20%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Float cancel and delete buttons and add an equal width */
.cancelbtn, .deletebtn {
  float: left;
  width: 50%;
}

/* Add a color to the cancel button */
.cancelbtn {
  background-color: #ccc;
  color: black;
}

/* Add a color to the delete button */
.deletebtn {
  background-color: #f44336;
  width: 50%;
}

/* Add padding and center-align text to the container */
.container {
  padding: 16px;
  text-align: center;
  width:50%;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: #474e5d;
  padding-top: 50px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width:200 px; /* Could be more or less, depending on screen size */
}

/* Style the horizontal ruler */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}
 
/* The Modal Close Button (x) */
.close {
  position: absolute;
  right: 35px;
  top: 15px;
  font-size: 40px;
  font-weight: bold;
  color: #f1f1f1;
}

.close:hover,
.close:focus {
  color: #f44336;
  cursor: pointer;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
 
}

/* Change styles for cancel button and delete button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .deletebtn {
     width: 100%;
  }
}
</style>
</head>
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
                       <!-- perfo -->
                      
                                

                       <!-- end perfo --> 
                        
                        
                        <!-- perfo de mes direc -->
                       

                         <!-- end perfo de mes direct -->
                        
                        <!-- section -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                <h5> @if (session('messageResponsable'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('messageResponsable') }}
                                                </div>  
                                            @endif</h5>
                                            <h5>
                                    @if (session('valider'))
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ session('valider') }}
                                    </div>  
                                    @endif
                                </h5>
                                
                                <h5>
                                    @if (session('refuser'))
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ session('refuser') }}
                                    </div>  
                                    @endif
                                </h5>
                                    <div class="card-header" style="font-family: 'Montserrat', sans-serif; font-size : 12 px; font-weight : bolder; color : black;">Actions cloturées de ma Team</div>
                                    
                                    <div class="table-responsive">
                                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th class="">Libellé</th>
                                                <th>Responsable</th>
                                                <th>Back-up</th>  
                                                <th class="text-center">Priorité</th>
                                                <th class="text-center">Échéance</th>
                                              
                                                <th class="text-left">Option</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($actions as $action)
                                            
                                            <tr>
                                                <td class="">{{$action->libelle}}</td>
                                                 @if($action->niveau_hieracie =='Directeur')
                                                <td data-toggle="tooltip" data-placement="left" title="{{$action->prenom}} {{$action->nom}}"><span  style="border: 1px solid #f7b924; border-radius:40px; background:#ffdf6c; color:white; font-weight:bold; font-size:15px; padding:5px; text-shadow: 1px 1px 2px black;">{{substr($action->prenom, 0, 1)}} {{substr($action->nom, 0, 1)}}</span></td>
                                                @elseif($action->niveau_hieracie =='Chef de Service')
                                                <td data-toggle="tooltip" data-placement="left" title="{{$action->prenom}} {{$action->nom}}"><span  style="border: 1px solid #3f6ad8; border-radius:40px; background:#3f6ad8; color:white; font-weight:bold; font-size:15px; padding:5px; text-shadow: 1px 1px 2px black;">{{substr($action->prenom, 0, 1)}} {{substr($action->nom, 0, 1)}}</span></td>
                                                @elseif($action->niveau_hieracie =='Agent')
                                                <td data-toggle="tooltip" data-placement="left" title="{{$action->prenom}} {{$action->nom}}"><span  style="border: 1px solid #39c47d; border-radius:40px; background:#7dc48f; color:white; font-weight:bold; font-size:15px; padding:5px; text-shadow: 1px 1px 2px black;">{{substr($action->prenom, 0, 1)}} {{substr($action->nom, 0, 1)}}</span></td>
                                                @elseif($action->niveau_hieracie == null)
                                                <td data-toggle="tooltip" data-placement="left" title="{{$action->prenom}} {{$action->nom}}"><span  style="border: 1px solid #d2488f; border-radius:40px; background:#d2488f; color:white; font-weight:bold; font-size:15px; padding:5px; text-shadow: 1px 1px 2px black;">{{substr($action->prenom, 0, 1)}} {{substr($action->nom, 0, 1)}}</span></td>
                                                @endif
                                                @foreach($my_agents as $age)
                                                @foreach($agents as $agen)
                                                @if($action->bakup == $age->full_name && $agen->id == $age->id)
                                                
                                                @if($action->niveau_hieracie =='Directeur')
                                                <td data-toggle="tooltip" data-placement="left" title="{{$agen->prenom}} {{$agen->nom}}"><span  style="border: 1px solid #f7b924; border-radius:40px; background:#ffdf6c; color:white; font-weight:bold; font-size:15px; padding:5px; text-shadow: 1px 1px 2px black;">{{substr($agen->prenom, 0, 1)}} {{substr($agen->nom, 0, 1)}}</span></td>
                                                @elseif($action->niveau_hieracie =='Chef de Service')
                                                <td data-toggle="tooltip" data-placement="left" title="{{$agen->prenom}} {{$agen->nom}}"><span  style="border: 1px solid #3f6ad8; border-radius:40px; background:#3f6ad8; color:white; font-weight:bold; font-size:15px; padding:5px; text-shadow: 1px 1px 2px black;">{{substr($agen->prenom, 0, 1)}} {{substr($agen->nom, 0, 1)}}</span></td>
                                                @elseif($action->niveau_hieracie =='Agent')
                                                <td data-toggle="tooltip" data-placement="left" title="{{$agen->prenom}} {{$agen->nom}}"><span  style="border: 1px solid #39c47d; border-radius:40px; background:#7dc48f; color:white; font-weight:bold; font-size:15px; padding:5px; text-shadow: 1px 1px 2px black;">{{substr($agen->prenom, 0, 1)}} {{substr($agen->nom, 0, 1)}}</span></td>
                                                @elseif($action->niveau_hieracie == null)
                                                <td data-toggle="tooltip" data-placement="left" title="{{$agen->prenom}} {{$agen->nom}}"><span  style="border: 1px solid #d2488f; border-radius:40px; background:#d2488f; color:white; font-weight:bold; font-size:15px; padding:5px; text-shadow: 1px 1px 2px black;">{{substr($agen->prenom, 0, 1)}} {{substr($agen->nom, 0, 1)}}</span></td>
                                                @endif
                                                @endif
                                                @endforeach
                                                @endforeach
                                                @if($action->risque == 'Elevé(E)')
                                                <td class="text-center"><div class="badge badge-danger">Elevé</div></td>
                                                @elseif($action->risque == 'Moins(M)')
                                                <td class="text-center"><div class="badge badge-warning">Moyen</div></td>
                                                @else($action->risque == 'Faible(F)')
                                                <td class="text-center"><div class="badge badge-success">Faible</div></td>
                                                @endif
                                                <td class="text-center">{{strftime("%d/%m/%Y", strtotime($action->deadline))}}</td>
                                                
                                                <td class="text-left">
                                                    <div class="val-refus" style="display:flex;">
                                                        @if(count($actions) == 1)
                                                         <form action="{{route('visibilite.valider', $action->id)}}" method="post" id="target" class="form">
                                                            <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                            <span class="d-inline-block" tabindex="0">
                                                            <button type="submit"  style="margin-right: 10px; padding: 0px 22px; height:20px; background:#49a797; border:none;">
                                                                
                                                                     <i class="fas fa-check" data-toggle="tooltip" title="Valider"  style="font-size: 17px; color:black;"></i>
                                                                
                                                            </button>
                                                            </span>
                                                         </form>    
                                                        @elseif(count($actions) > 1)
                                                         <form action="{{route('visibilite.valider', $action->id)}}" method="post" id="target" class="form">
                                                            <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                            <span class="d-inline-block" tabindex="0">
                                                            <button type="submit" class="btn boutton-options" style=" padding: 0px 22px; margin-right: 10px;  height:20px; background-color :#49a797; border:none;">
                                                                
                                                                     <i class="fas fa-check" data-toggle="tooltip" title="Valider" style="font-size: 17px; color:black;"></i>
                                                                
                                                            </button>
                                                            </span>
                                                         </form>                                                        
                                                         @endif
                                                   
                                                        @if(count($actions) == 1)
                                                        <form action="{{route('visibilite.refuser', $action->id)}}" method="post" id="target" class="form">
                                                         <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                            <span class="d-inline-block" tabindex="0">
                                                            <button type="submit" class="btn boutton-options" style="padding: 0px 22px; height:20px; background-color: red ; border:none;">
                                                                
                                                                     <i class="fas fa-times" data-toggle="tooltip" title="Refuser"  style="font-size: 17px; color:black;"></i>
                                                                
                                                            </button>
                                                            </span>
                                                        </form>
                                                        @elseif(count($actions) > 1)
                                                        <form action="{{route('visibilite.refuser', $action->id)}}" method="post" id="target" class="form">
                                                         <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                            <span class="d-inline-block" tabindex="0">
                                                            <button  type=" submit"  class="btn boutton-options" style="padding: 0px 22px; height:20px; background-color: red ; border:none;" >
                                                           
                                                                
                                                                     <i class="fas fa-times" data-toggle="tooltip" title="Refuser"  style="font-size: 17px; color:black;"></i>
                                                               
                                                            
                                                            </button>
                                                            </span>
                                                        </form>                                                       
                                                        @endif 
                                                        
                                                        
                                                    </div>
                                                 </td>   
                                                   
                                                                         <td>
                                                                              <input type="hidden" name="deadline" calss="w3-input" value="{{$action->deadline}}">
                                                    <input type="hidden" name="pourcentage" calss="w3-input" value="{{$action->pourcentage}}">
                                                    <input type="hidden" name="note" calss="w3-input" value="{{$action->note}}">
                                                    <input type="hidden" name="action_id" calss="w3-input" value="{{$action->id}}">
                                                                        <div class="form-group" hidden>    
                                                                                            
                                                                            <label style="color:black;">Votre Email</label>
                                                                        <input type="email" style="border: solid 1px gray;" class="form-control" value="{{$action->email}}" name="email" id="email" placeholder="Votre Email" data-rule="email" data-msg="Please enter a valid email" />
                                                                        <div class="validation"></div>
                                                                       
                                                                        </div>
                                                                        </td>
                                                                       
                                                    
                                                                        

                                            </tr>
                                            
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-block text-center card-footer">
                                       
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                        
                    </div>
                    <style>

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

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
$(document).ready(function(){

@foreach($actions as $suivi)

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

@foreach($actions as $suivi)

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
<style>
  
.popup{
    cursor:pointer;
}

.pop{
    display: none; /* Hidden by default */
    border-radius: 10px;
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 42%;
    top: 30%;
    overflow: auto; /* Enable scroll if needed */
    width: 25%; /* Full width */
     /* Full height */
    padding-top:0px;
    /* Animation ins */
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@keyframes animatetop {
from {top: -300px; opacity: 0}
to {top: 0; opacity: 1}
}
</style>

<script>
// Get the modal
var pop = document.getElementById("pop");

// Get the button that opens the modal
var popup = document.getElementById("popup");

// Get the element that closes the modal
var popclose = document.getElementById("popClose");

popclose.onclick = function(){
    var modal = document.getElementById('modals');
    modal.style.display = "none";
}
// When the user clicks the button, open the modal 
function display() {
    var pop = document.getElementById("pop");
    pop.style.display = "block";
}


// When the user clicks anywhere outside of the popup, close it
window.onclick = function(event) {
if (event.target == pop) {
pop.style.display = "none";
}
}

function check(){
    var radios = document.querySelectorAll('.radios');

    for(var i = 0; i<radios.length; i++){
        if(radios[i].checked.value='O'){
            alert("Bien joué {{Auth::user()->prenom}} 💯 | Action cloturé avec succés." );
        }
    }
}
</script>
 
                        <!-- end section -->

                            <div class="app-wrapper-footer">
                                <div class="app-footer">
                                    <div class="app-footer__inner">
                                        <div class="app-footer-left">
                                            <ul class="nav">
                                                <li class="nav-item">
                                                    <a href="javascript:void(0);" class="nav-link">
                                                        © Collaboratis 2020
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

<script src="{{asset('v2/main.js')}}"></script>

</body>
</html>
