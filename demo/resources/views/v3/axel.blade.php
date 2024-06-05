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
                             </div>
                                    
                               
                                
                                <div class="main-card mb-3 card">
                                    <div class="card-header" style="position : relative; display : flex;"> 
                                        <h3  style="font-family: 'poppins', sans-serif; font-size : 16px; font-weight : bolder; color : black;" >Mes activités en instances</h3>
                                        <a type="button" class="btn btn-dark" style="position : absolute; right :30%; color : white;">Ajouter une activité</a>
                                          <div class="widget-content-wrapper" style="position : absolute; right :10%;">
                                               <form action="/search_ech" method="get" style="margin-top:5px;">
                                                    <select name="search_ech" required>
                                                        <option value="" disabled selected>Trier par écheance</option>
                                                        @foreach($activi as $tache)
                                                        <option value="{{$tache->deadline}}">{{$tache->deadline}}</option>
                                                        @endforeach
                                                    </select>
                                                        <button class="btn btn-dark" type="submit">Filtrer</button>
                                        
                                                    </form>     
                                           </div>
                                    </div>
                                    <div class="table-responsive">
                                       
                                        <table class="align-middle mb-0 table table-borderless  table-hover">
                                            <thead>
                                            <tr>
                                                <th class="table-label"></th>
                                                <th class="table-label">Libellé</th>
                                                <th class="table-label">Responsable</th>
                                                <th class="table-label">Backup</th>
                                                <th class="table-label">Pourcentage</th>
                                                <th class="table-label">Échéance</th>
                                                <th class="table-label">Temps</th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                                    <!--On liste d'abort l'activté et ses paramètres-->
                                                   
                                                    <tr style="border-bottom : 1px solid #C4C4C4 ;">
                                                        <td><b>RS1</b></td>
                                                        <td class="">Rebrander le site web de collaboratis</td>
                                                        
                                                        <td data-toggle="tooltip" data-placement="left" title="Axel Nonguierma">
                                                            <span  style="border: 1px solid #f7b924; border-radius:40px; background:#ffdf6c; color:white; font-weight:bold; font-size:15px; padding:5px; text-shadow: 1px 1px 2px black;">
                                                                A  N
                                                            </span>
                                                        </td>
                                                         <td data-toggle="tooltip" data-placement="left" title="Anthyme Kabore">
                                                            <span  style="border: 1px solid #f7b924; border-radius:40px; background:#ffdf6c; color:white; font-weight:bold; font-size:15px; padding:5px; text-shadow: 1px 1px 2px black;">
                                                                A  k
                                                            </span>
                                                        </td>
                                                        <!--pourcentage V3 -->
                                                         <td style="position : relative;" >
                                                             <div class="progress-value" style="position : absolute; top : -5px;margin-top : 2%;">
                                                                    50%
                                                             </div>
                                                            <div class="progress" style="height: 5px;width : 100px; background: #C4C4C4; border-radius: 5px; margin-top :5%;">
                                                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                                                            </div>
                                                         </td>
                                                           <!--pourcentage V3 -->
                                                        <td class="text-left">30/05/2021</td>
                                                        <td class="">Depuis 10 jours</td>
                                                        
                                                        
                                                    </tr>
                                                
                                            </tbody>
                                            
                                            </table>
                                            
                                    </div>
                                    <!--Lister pour chaque activité les taches correspondantes -->
                                    <table class="align-middle mb-0 table table-borderless table-hover" style="margin-left : 5%"> 
                                        <thead>
                                             <tr>
                                                <th></th>
                                                <th class="table-label-mini">Libellé des taches</th>
                                                <th class="table-label-mini">Responsable</th>
                                                <th class="table-label-mini">Échéance</th>
                                                <th class="table-label-mini">Statut</th>
                                                <th class="table-label-mini">Mise à jour</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td>Trouver et valider le template</td>
                                                 <td data-toggle="tooltip" data-placement="left" title="Margareth Orango">
                                                    <span  style="border-radius:40px; background: black; color:white; font-size:12px; padding:5px; ">
                                                        M O
                                                    </span>
                                                </td>
                                                <td class="text-left">30/05/2021</td>
                                                <td class="text-left"><span class="badge bg-success">Fait</span></td>
                                                <td class="text-left">
                                                    <div class="dropdown">
                                                        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="font-size : 12px;">
                                                            Mise à jour
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li><a class="dropdown-item" href="#">Fait</a></li>
                                                            <li><a class="dropdown-item" href="#">Pas Fait</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                              <tr>
                                                <td></td>
                                                <td>Concevoir tous les visuels pour le site web</td>
                                                 <td data-toggle="tooltip" data-placement="left" title="Margareth Orango">
                                                    <span  style="border-radius:40px; background: red; color:white; font-size:12px; padding:5px; ">
                                                        F S
                                                    </span>
                                                </td>
                                                <td class="text-left">30/05/2021</td>
                                                <td class="text-left"><span class="badge bg-success">Fait</span></td>
                                                <td class="text-left">
                                                    <div class="dropdown">
                                                        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="font-size : 12px;">
                                                            Mise à jour
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li><a class="dropdown-item" href="#">Fait</a></li>
                                                            <li><a class="dropdown-item" href="#">Pas Fait</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>Finaliser le design de la landing page</td>
                                                 <td data-toggle="tooltip" data-placement="left" title="Margareth Orango">
                                                    <span  style="border-radius:40px; background: green; color:white; font-size:12px; padding:5px; ">
                                                       C K
                                                    </span>
                                                </td>
                                                <td class="text-left">30/05/2021</td>
                                                <td class="text-left"><span class="badge bg-success">Fait</span></td>
                                                <td class="text-left">
                                                    <div class="dropdown">
                                                        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="font-size : 12px;">
                                                            Mise à jour
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li><a class="dropdown-item" href="#">Fait</a></li>
                                                            <li><a class="dropdown-item" href="#">Pas Fait</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                             <tr>
                                                <td></td>
                                                <td>Reformuler et corriger les fautes </td>
                                                 <td data-toggle="tooltip" data-placement="left" title="Margareth Orango">
                                                    <span  style="border-radius:40px; background: blue; color:white; font-size:12px; padding:5px; ">
                                                       M O
                                                    </span>
                                                </td>
                                                <td class="text-left">30/05/2021</td>
                                                <td class="text-left"><span class="badge bg-success">Fait</span></td>
                                                <td class="text-left">
                                                    <div class="dropdown">
                                                        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="font-size : 12px;">
                                                            Mise à jour
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li><a class="dropdown-item" href="#">Fait</a></li>
                                                            <li><a class="dropdown-item" href="#">Pas Fait</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>    
                                    </table>
                                    
                                    
                                    
                                                  
                            </div>
                                    
                        </div>
               
                   
<style>

/*Pour les pourcentages */



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