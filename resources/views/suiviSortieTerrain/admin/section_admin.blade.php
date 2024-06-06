<div class="row">
                        
    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Nombre des prospects</h4>
              
                
                <span class="text-success">{{$countProspect}}</span>
                
                
                
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Nombre des prospects Burkina Faso</h4>
              
                
                <span class="text-success">{{$countCountry->where('pays_id', 2)->count()}}</span>
                
                
                
            </div>
        </div>
    </div>
    
    
    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Nombre des prospects Sénégal</h4>
              
                
                <span class="text-success">{{$countCountry->where('pays_id', 1)->count()}}</span>
                
                
                
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Nombres commerciaux Burkina Faso</h4>
              
                
                <span class="text-success">{{$countCommerciaux->where('pays_id', 2)->count()}}</span>
                
                
                
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    
</div>
<br>
<div class="row">
    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Nombres commerciaux Sénégal</h4>
              
                
                <span class="text-success">{{$countCommerciaux->where('pays_id', 1)->count()}}</span>
                
                
                
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Nombre opportunites Burkina Faso</h4>
              
                
                <span class="text-success">{{$countOpportunites->where('pays_id', 2)->count()}}</span>
                
                
                
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Nombre opportunites Sénégal</h4>
              
                
                <span class="text-success">{{$countOpportunites->where('pays_id', 1)->count()}}</span>
                
                
                
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    
</div>
    
<br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>


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