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
                                
                                         
                                
                                <div class="main-card mb-3 card">     
                                       <div class="card-header" style="position : relative; display : flex;"> 
                                                <h3  style="font-family: 'poppins', sans-serif; font-size : 18px; color : black;" >Les activités pour lesquelles je suis Backup</h3>
                                                
                                                </div>
                                               
                                            
                                            <div class="table-responsive">
                                               @if($modeles->isEmpty())
                                                <span class="text-nice" style=" margin : 8% 2% 2% 2%;"> <i class="bi bi-info-circle-fill"></i>  Aucune activité pour laquelle vous êtes backup</span>
                                                 @else
                                                <table class="align-middle mb-0 table table-borderless  table-hover">
                                                    <thead>
                                                    <tr>
                                                    
                                                        <!--<th class="table-label"></th>-->
                                                        <!--<th class="table-label">Libellé</th>-->
                                                        <!--<th class="table-label">Responsable</th>-->
                                                        <!--<th class="table-label">Backup</th>-->
                                                        <!--<th class="table-label">Pourcentage</th>-->
                                                        <!--<th class="table-label">Échéance</th>-->
                                                        <!--<th class="table-label">Temps</th>-->
                                                        <!--<th class="table-label"></th>-->
                                                        <!--<th class="table-label"></th>-->
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!--On liste d'abort l'activté et ses paramètres-->
                                                         @foreach($modeles as $modele)  
                                                         <?php $agen = DB::table('agents')->where('user_id', Auth::user()->id)->first()  ?>
                                                         
                                                        <?php $strategiques = DB::table('strategiques')->where('id', $modele->strategique_id)->get()  ?>
                                                         @foreach($strategiques as $strategique) 
                                                        <tr class ="activites">
                                                    <td class="rs">{{$strategique->abv}}  | </td>
                                                    <td class="activite-police">{{$modele->libelle}}</td>
                                                    <?php $agen = DB::table('agents')->where('id', $modele->res_dir)->first()  ?>
                                                    <td data-toggle="tooltip" data-placement="left" title="{{$agen->prenom}} {{$agen->nom}}">
                                                        <span  style="border: 1px solid; border-radius:40px; background:black; color:white;font-size:15px; padding:5px; text-shadow: 1px 1px 2px black;">
                                                            {{substr($agen->prenom, 0, 1)}} {{substr($agen->nom, 0, 1)}}
                                                        </span>
                                                    </td>
                                                    <?php $agent = DB::table('agents')->where('id', $modele->backup)->first()  ?>
                                                    <td data-toggle="tooltip" data-placement="left" title="{{$agent->prenom}} {{$agent->nom}}">
                                                        <span  style="border: 1px solid; border-radius:40px; background: blue; color:white; font-size:15px; padding:5px; text-shadow: 1px 1px 2px black;">
                                                            {{substr($agent->prenom, 0, 1)}} {{substr($agent->nom, 0, 1)}}
                                                        </span>
                                                    </td>
                                                    
                                                    <!--pourcentage V3 -->
                                                     <?php $count = DB::table('tache_modeles')->where('modele_id', $modele->id)->count()  ?>
                                                     <?php $sum = DB::table('tache_modeles')->where('modele_id', $modele->id)->where('statut','=',1)->count()  ?>
                                                     <?php $total = $count == 0 ? 0 : $sum / $count ?>
                                                     <td style="position : relative;" >
                                                        <div class="progress-value" style="position : absolute; top : 0px;margin-top : 10%;">
                                                                        {{intval($total * 100)}}%
                                                                 </div>
                                                                <div class="progress" style="height: 5px;width : 100px; background: #C4C4C4; border-radius: 5px; margin-top :10%;">
                                                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: {{$total * 100}}%;"></div>
                                                                </div>
                                                     </td>
                                                      
                                                       <!--pourcentage V3 -->
                                                     
                                                    <td class="activite-police">{{strftime("%d/%m/%Y", strtotime($modele->deadline))}}</td>
                                                    <td class="activite-police">{{intval(strftime("%d", strtotime($modele->updated_at)) - strftime("%d", strtotime($modele->created_at)) / 86400)}} jours</td>
                                                     <td></td>
                                                    <td></td> 
                                                    </tr>
                                                            
                                                            <!--<tr>-->
                                                            <!--    <th class="table-label"></th>-->
                                                            <!--    <th class="table-label"></th>-->
                                                            <!--    <th class="table-label">Libellé des tâches</th>-->
                                                            <!--    <th class="table-label">Responsable</th>-->
                                                            
                                                            <!--    <th class="table-label">Échéance</th>-->
                                                            <!--    <th class="table-label">Statut</th>-->
                                                            <!--    <th class="table-label">Date de fin</th>-->
                                                            <!--    <th class="table-label">Durée</th>-->
                                                            <!--    <th class="table-label">Option</th>-->
                                                                
                                                            <!--</tr>-->
                                                            
                                                                  <?php $tache_modeles = DB::table('tache_modeles')->where('modele_id', $modele->id)->orderBy('deadline', 'DESC')->get()  ?>
                                                   @foreach($tache_modeles as $tache)
                                                    
                                                      <tr class="taches-row"> 
                                                    
                                                    
                                                       <td></td>
                                                        <td class="tache"><i class="bi bi-dot"></i>&nbsp&nbsp  {{$tache->libelle}}</td>
                                                        <?php $agent = DB::table('agents')->where('id', $tache->res_dir)->get()  ?>
                                                        @foreach($agent as $a)
                                                        <td data-toggle="tooltip" data-placement="left" title="{{$a->prenom}} {{$a->prenom}}">
                                                            <span  style="border-radius: 10px; background: #43928E; color: white;  font-size:12px; padding:10%;">
                                                                {{substr($a->prenom, 0, 1)}} {{substr($a->nom, 0, 1)}}
                                                            </span>
                                                        </td>
                                                        @endforeach
                                                        <td class="tache">{{strftime("%d/%m/%Y", strtotime($tache->deadline))}}</td>
                                                        @if($tache->statut == 0)
                                                        <td class="tache"><span class="badge bg-danger">Pas Fait</span></td>
                                                        @else
                                                        <td class="tache"><span class="badge bg-success">Fait</span></td>
                                                        @endif
                                                        
                                                        @if($tache->statut == 1)
                                                        <td class="tache">{{strftime("%d/%m/%Y", strtotime($tache->updated_at))}}</td>
                                                         @else
                                                        <td class="tache">En cours</td>
                                                        @endif
                                                       
                                                        <td class="tache">{{intval(strftime("%d", strtotime($tache->updated_at)) - strftime("%d", strtotime($tache->created_at)) / 86400)}} jours</td>
                                                        <td></td>
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
                                                    <hr>
                                                 
                                                  
                                            </div>
                                            
                                     
                                            </div>
                                       </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
            </div>

                       
                      
    </div>

                                            
                         
    
    
    <style>
      
/*Pour les activites*/

.activites {
   background-color : rgba(45, 54, 94, 0.1);
   
   
}  

.activites td:first-child,
.activites th:first-child {

  border-radius: 20px 0 0 20px;
}

.activites td:last-child,
.activites th:last-child {
  border-radius: 0 20px 20px 0;
 
}


.activite-police{
    font-family: 'poppins', sans-serif;
    font-size : 16px;
    font-weight : bold;
    padding : 1.5% 0 1.5% 0 !important;
}

.tache{
    font-family: 'poppins', sans-serif;
    font-size : 14px;
    
    /*padding : 1.5% 0 1.5% 0 !important;*/
}


.rs{
    margin-right : 2%;
}


        
        
    </style>
<!--================SCRIPTS=    ============ ============    -->
<script src="{{asset('v2/main.js')}}"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<style>

/*Pour les modeles*/

.modeles {
    
   border-bottom : 1px solid #C4C4C4; 
   border-top: 1px solid #C4C4C4; 
   border-top: 12px solid transparent;
   border-bottom: 12px solid transparent;
  
   box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.15);
 
   background-color : #F8F8F8;
   

}   

.text-nice{
    font-family: 'poppins', sans-serif;
}
   

/*Pour les pourcentages */


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
    width: 15%; /* Full width */
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

</body>
</html>
