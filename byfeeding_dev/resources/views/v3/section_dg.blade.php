
                             
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
                                <h5>@if (session('messagea'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('messagea') }}
                                </div>  
                                @endif
                                </h5>
                                <h5>@if (session('messagem'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('messagem') }}
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
                                
                                <div class ="card">
                                    <div class="card-header">
                                        <h3  style="font-family: 'poppins', sans-serif; font-size : 16px; font-weight : bolder; color : black;" >Bienvenue {{Auth::user()->prenom}}</h3>
                                    </div>
                                
                                </div>
                                    
                                <div class="card">
                                        <table style= "margin:  2%;">
                                             <?php $modelessp = DB::table('modeles')->where('res_dir', Auth::user()->id)->count()  ?>
                                                    <?php $modelessps = DB::table('modeles')->where('backup', Auth::user()->id)->count()  ?>
                                            <tr>
                                                <td><div id="donut3" data-role="donut" data-value="{{$modelessp + $modelessps}}" data-hole=".6" data-stroke="#f5f5f5" data-fill="#9C27B0" data-animate="{{$modelessp + $modelessps}}"></div></td>
                                                <td> &nbsp&nbsp&nbsp</td>
                                                <td style="margin-left : 2%;">
                                                   
                                                    <div style ="margin-top : 0px;">
                                                        <h4>Tu as à {{$modelessp + $modelessps}} activités en instances</h4>
                                                        <p class"text-nice">Passe les en revue, finalise tes taches et participe au succès de ces activités</p>
                                                        <br>
                                                        <a type="button" class="btn btn-dark" href="/activites_instance">Voir mes activités en instances</a>
                                                    </div>
                                                </td>  
                                            </tr>
                                        </table>
                                </div>
                                
                                
                                <div class="card">
                                        <table style= "margin:  2%;">
                                            <?php $actions = DB::table('actions')->where('agent_id', Auth::user()->id)->count()  ?>
                                                    <?php 
                                                     $users = App\Agent::select('id', DB::raw('CONCAT(prenom, " ", nom) AS full_name'))->where('user_id', Auth::user()->id)->orderBy('prenom')->get();
                                                    ?>
                                                    @foreach($users as $user)
                                                    <?php 
                                                     $action = DB::table('actions')->where('bakup', $user->full_name)->count();
                                                    ?>
                                                    @endforeach
                                            <tr>
                                                
                                                <td><div id="donut2" data-role="donut" data-value="{{$actions}}" data-hole="0" data-stroke="transparent" data-fill="#4CAF50" data-animate="{{$actions}}"></div></td>
                                                <td> &nbsp&nbsp&nbsp</td>
                                                <td style="margin-left : 2%;">
                                                    
                                                    <div style ="margin-top : 0px;">
                                                        <h4>Tu as à {{$actions}} actions en cours</h4>
                                                        <p class"text-nice">Passe en revue tes projets et prends le temps nécéssaire pour avancer sur chacun d'entre eux</p>
                                                        <br>
                                                        <a type="button" class="btn btn-dark" href="/user_action">Voir mes projets en cours</a>
                                                    </div>
                                                </td>  
                                            </tr>
                                        </table>
                                </div>
                                    
                                    
                                    
                                    
                                    
                            
                                        
                               
                                
                                
                                
                                
                                
                                   
                                           
                                <!--<div class="main-card mb-3 card">
                                     <div class="card-header" style="position : relative; display : flex;"> 
                                        <h3  style="font-family: 'poppins', sans-serif; font-size : 18px; font-weight : bolder; color : black;" >Mes activités en instances</h3>
                                           
                                     @if(Auth::user()->nom_role == "directeur")
                                        <a href="/create_dg" type="button" class="btn btn-dark" style="position : absolute; right : 5%;top: 10%; color : white;"> <i class="bi bi-plus-circle"></i>&nbsp Ajouter une activité</a>
                                     @elseif(Auth::user()->nom_role == "responsable")
                                     <a href="/create_dg" type="button" class="btn btn-dark" style="position : absolute; right : 5%; top: 1%; color : white;"> <i class="bi bi-plus-circle"></i>&nbsp Ajouter une activité</a>
                                     @endif
                                            <div class="widget-content-wrapper" style="position : absolute; right :30%; top: 1%;">
                                               <form action="/search_ech" method="get" style="margin-top:5px;">
                                                    <select name="search_ech" required>
                                                        <option value="" disabled selected>trier ici</option>
                                                        @foreach($activim as $tache)
                                                        <option value="{{$tache->deadline}}">{{$tache->deadline}}</option>
                                                        @endforeach
                                                    </select>
                                                        <button class="btn btn-dark" type="submit">Trier les activités</button>
                                        
                                                </form>     
                                           </div>
                                    </div>
                                    
                                    <div class="card-body">

                                    <div class="table-responsive" style="min-height : 100px;">
                                       @if($modeles->isEmpty())
                                                 <span class="text-nice" style=" margin : 8% 2% 2% 2%;"> <i class="bi bi-info-circle-fill"></i>   Aucune activité pour laquelle vous êtes responsable ! </span>
                                                 @else
                                        <table class="align-middle mb-0 table table-borderless">
                                            <thead>
                                            <tr>
                                              
                                            </tr>
                                            </thead>
                                            <tbody>
                                                 @foreach($modeles as $modele)  
                                                 <?php $agen = DB::table('agents')->where('user_id', Auth::user()->id)->first()  ?>
                                                 
                                                <?php $strategiques = DB::table('strategiques')->where('id', $modele->strategique_id)->get()  ?>
                                                 @foreach($strategiques as $strategique) 
                                                <tr class ="activites">
                                                    <td class="rs">{{$strategique->abv}}  | </td>
                                                    <td class="activite-police">{{$modele->libelle}}</td>
                                                    <?php $agen = DB::table('agents')->where('id', $modele->res_dir)->first()  ?>
                                                    <td data-toggle="tooltip" data-placement="left" title="{{$agen->prenom}} {{$agen->nom}}">
                                                        <span  style="border: 1px solid; border-radius:40%; background:black; color:white;font-size:15px; padding:5px; text-shadow: 1px 1px 2px black;">
                                                            {{substr($agen->prenom, 0, 1)}} {{substr($agen->nom, 0, 1)}}
                                                        </span>
                                                    </td>
                                                    <?php $agent = DB::table('agents')->where('id', $modele->backup)->first()  ?>
                                                    <td data-toggle="tooltip" data-placement="left" title="{{$agent->prenom}} {{$agent->nom}}">
                                                        <span  style="border: 1px solid; border-radius:40px; background: blue; color:white; font-size:15px; padding:5px; text-shadow: 1px 1px 2px black;">
                                                            {{substr($agent->prenom, 0, 1)}} {{substr($agent->nom, 0, 1)}}
                                                        </span>
                                                    </td>
                                                    
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
                                                      

                                                    <td class="activite-police">{{strftime("%d/%m/%Y", strtotime($modele->deadline))}}</td>
                                                    <td class="activite-police">{{intval(strftime("%d", strtotime($modele->updated_at)) - strftime("%d", strtotime($modele->created_at)) / 86400)}} jours</td>
                                                     <td></td>
                                                    <td><a href="{{route('active.modifier',$modele->id)}}" class ="btn btn-green" style="color : white;"></i> Modifier l'activité</a></td> 
                                                    </tr>
                                                
                                                    
                                                  
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
                                                        <td class="tache"><span class="badge bg-success" style="padding : 3% 14% 3% 14%">Fait</span></td>
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
                                </div>-->
                                    
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