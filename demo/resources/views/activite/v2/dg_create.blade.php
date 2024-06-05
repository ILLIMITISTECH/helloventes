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
                            <div class="card-body">
                                <h5 class="card-title" style="font-family: 'poppins', sans-serif; font-size : 18px; color : black;">Ajouter des activités</h5>
                                <form action="{{route('activite.store_dg')}}" method="post" class="form-horizontal" id="demo1-upload">
                                    {{ csrf_field() }}
                                            <div class="tab-pane" id="tab1">

                                                  <fieldset>
                                                    <div class="control-group">
                                                      <label class="text-nice" for="focusedInput">Libelé de l'activité <span class="red">*</span></label>
                                                      <div class="controls">
                                                      <input name="libelle_act" type="text" class="form-control" placeholder="Libelé de l'activité">
                                                      </div>                      
                                                    </div>
                                                    <br>
                                                     <div class="control-group">
                                                      <label class="text-nice" for="focusedInput">Date de début de l'activité (format : 2021-05-25) <span class="red">*</span></label>
                                                      <div class="controls">
                                                      <input name="date_debut" type="date" class="form-control" placeholder="Date de début de l'activité">
                                                      </div>                      
                                                    </div>
                                                    <div class="control-group">
                                                      <label class="text-nice" for="focusedInput">Deadline de l'activité (format : 2021-05-25) <span class="red">*</span></label>
                                                      <div class="controls">
                                                      <input name="deadlines" type="date" class="form-control" placeholder="Deadline de l'activité">
                                                      </div>                      
                                                    </div>
                                                    <br>
                                                    <div class="control-group">
                                                      <label for="inputState" class="text-nice">Responsable l'activité <span class="red">*</span></label>
                                                        <select id="inputState" name="res_dirs" class="form-select">
                                                          <option selected>Sélectionner le responsable</option>
                                                          @foreach($agents as $agent)
                                                          <option value="{{$agent->id}}">{{$agent->prenom}} {{$agent->nom}}</option>
                                                          @endforeach
                                                        </select>
                                                    </div> 
                                                    <br>
                                                    <div class="control-group">
                                                      <label for="inputState" class="text-nice">Responsable le backup <span class="red">*</span></label>
                                                        <select id="inputState" name="backup" class="form-select">
                                                          <option selected>Sélectionner le backup</option>
                                                          @foreach($agents as $agent)
                                                          <option value="{{$agent->id}}">{{$agent->prenom}} {{$agent->nom}}</option>
                                                          @endforeach
                                                        </select>
                                                    </div> 
                                                    <br>
                                                     <div class="control-group">
                                                      <label for="inputState" class="text-nice">Rattacher l’activité à un objectif du plan stratégique (Pas Obligatoire)</label>
                                                        <select id="inputState" name="strategique_id" class="form-select">
                                                          <option selected>Selectionner l’objectif </option>
                                                           @foreach($strategiques as $strategique)
                                                          <option value="{{$strategique->id}}">{{$strategique->abv}}</option>
                                                          @endforeach
                                                        </select>
                                                    </div> 
                                                    <br>
                                                  </fieldset>
                                                  <hr>
                                            </div>
                                            
                                            <div class="tab-pane" id="tab2">
                                                  <h5 class="card-title" style="font-family: 'poppins', sans-serif; font-size : 16px; color : black;">Ajouter une tâche à cette activité</h5>
                                                  <br>
                                                   <table class="table">
                                                                 <thead>
                                                                     <tr>
                                                                         <th  class="text-nice">Libelé de la tâche <span class="red">*</span></th>
                                                                         <th  class="text-nice">Responsable de la tâche <span class="red">*</span></th>
                                                                         <th  class="text-nice">Deadline de la tâche (format : 2021-05-25) <span class="red">*</span</th>
                                                                         <th><a href="#" class=" btn btn-dark addRow"><i class="bi bi-plus-circle-fill"></i> Ajouter plus de tâches </a></th>
                                                                     </tr>
                                                                 </thead>
                                                                 <tbody>
                                                                        <tr>
                                                                             <td>
                                                                                
                                                                                   
                                                                                    <input type="text" name="libelle[]" class="form-control" placeholder="Libellé de la Tâche" aria-label="First name">
                                                                                  
                                                                              </td>
                                                                             <td>
                                                                                 
                                                                                    <select id="inputState" name="res_dir[]" class="form-select">
                                                                                      <option selected>Sélectionner le responsable</option>
                                                                                      @foreach($agents as $agent)
                                                                                      <option value="{{$agent->id}}">{{$agent->prenom}} {{$agent->nom}}</option>
                                                                                      @endforeach
                                                                                    </select>
                                                                              
                                                                             </td>    
                                                                             
                                                                             <td>     
                                                                                 
                                                                                      <div class="controls">
                                                                                       <input name="deadline[]" type="date" class="form-control" placeholder="Deadline de l'activité">
                                                                                    </div>
                                                                                </div>
                                                                             </td>
                                                                             
                                                                             
                                                                             
                                                                             <td><a href="#" class="btn btn-danger remove"><i class="bi bi-trash"></i></a></td>
                                                                             </tr>
                                                                     </tr>
                                                                 </tbody>
                                                                 <tfoot>
                                                                     <tr>
                                                                         <td style="border: none"></td>
                                                                         <td style="border: none"></td>
                                                                         <td style="border: none"></td>
                                                                         
                                                                     </tr>
                                                                 </tfoot>
                                                             </table>
                                                 
                                                  
                                            
                                                  <hr>
                                                  <div class="control-group">
                                                      <label class="text-nice" for="focusedInput">Souhaitez-vous utiliser cette activitée comme modèle? <span class="red">*</span></label>
                                                      <div class="controls">
                                                          <div class="check">
                                                            <input name="statut" value="1" type="radio" id="oui"> Oui <br>
                                                            <input name="statut" value="0" type="radio" id="non" > Non<br>
                                                          </div>
                                                      </div>                      
                                                    </div> <br>
                                                    
                                                    <div class="control-group" id="categorie">
                                                      <label for="inputState" class="text-nice" id="categorie">Catégorie <span class="red">*</span></label>
                                                        <select id="inputState" name="categorie_id" class="form-select" id="categorie">
                                                          <option value="300">Sélectionner une Catégorie</option>
                                                          <?php $categories = DB::table('categories')->get()  ?>
                                                          @foreach($categories as $categorie)
                                                          <option value="{{$categorie->id}}">{{$categorie->libelle}}</option>
                                                          @endforeach
                                                        </select>
                                                    </div> 
                                                  
                                            </div>

                                                <div class="form-actions pull-left" style="margin-top:20px;">
                                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                </div>
                                            </form>
                                           
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
 <!--================SCRIPTS=    ============ ============                                     -->
                                            
                                            
                                            
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"> </script>
<script type="text/javascript">
    $('tbody').delegate('.quantity,.budget','keyup',function(){
        var tr=$(this).parent().parent();
        var quantity=tr.find('.quantity').val();
        var budget=tr.find('.budget').val();
        var amount=(quantity*budget);
        tr.find('.amount').val(amount);
        total();
    });
    function total(){
        var total=0;
        $('.amount').each(function(i,e){
            var amount=$(this).val()-0;
        total +=amount;
    });
    $('.total').html(total+".00 tk");    
    }
    $('.addRow').on('click',function(){
        addRow();
    });
    function addRow()
    {
        var tr='<tr>'+
        '<td> <input type="text" name="libelle[]" class="form-control" placeholder="Libellé de la Tâche" aria-label="First name"> </td>'+
                
        '<td>  <select id="inputState" name="res_dir[]" class="form-select"><option selected>Sélectionner le responsable</option> @foreach($agents as $agent)<option value="{{$agent->id}}">{{$agent->prenom}} {{$agent->nom}}</option> @endforeach</select></td>'+
                                                                                     
        '<td>  <div class="controls"><input name="deadline[]" type="date" class="form-control" placeholder="Deadline"> </div></td>'+
                                                                                   
        '<td><a href="#" class="btn btn-danger remove"><i class="bi bi-trash"></i></a></td>'+
        '</tr>';
        $('tbody').append(tr);
    };
    $('.remove').live('click',function(){
        var last=$('tbody tr').length;
        if(last==1){
            alert("Désolé vous ne pouvez pas supprimer cette ligne !");
        }
        else{
             $(this).parent().parent().remove();
        }
     
    });
</script>

                                <script>
                                    // Example starter JavaScript for disabling form submissions if there are invalid fields
                                    (function() {
                                        'use strict';
                                        window.addEventListener('load', function() {
                                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                            var forms = document.getElementsByClassName('needs-validation');
                                            // Loop over them and prevent submission
                                            var validation = Array.prototype.filter.call(forms, function(form) {
                                                form.addEventListener('submit', function(event) {
                                                    if (form.checkValidity() === false) {
                                                        event.preventDefault();
                                                        event.stopPropagation();
                                                    }
                                                    form.classList.add('was-validated');
                                                }, false);
                                            });
                                        }, false);
                                    })();
                                </script>
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
        
        
    </style>

<script src="{{asset('v2/main.js')}}"></script>
<script>

jQuery(document).ready(function() {   
   FormValidation.init();
});


    $(function() {
        $(".datepicker").datepicker();
        $(".uniform_on").uniform();
        $(".chzn-select").chosen();
        $('.textarea').wysihtml5();

        $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index+1;
            var $percent = ($current/$total) * 100;
            $('#rootwizard').find('.bar').css({width:$percent+'%'});
            // If it's the last tab then hide the last button and show the finish instead
            if($current >= $total) {
                $('#rootwizard').find('.pager .next').hide();
                $('#rootwizard').find('.pager .finish').show();
                $('#rootwizard').find('.pager .finish').removeClass('disabled');
            } else {
                $('#rootwizard').find('.pager .next').show();
                $('#rootwizard').find('.pager .finish').hide();
            }
        }});
        $('#rootwizard .finish').click(function() {
            alert('Finished!, Starting over!');
            $('#rootwizard').find("a[href*='tab1']").trigger('click');
        });
    });
    </script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
    
    $(function () {
   $( "#pourcent" ).change(function() {
      var max = parseInt($(this).attr('max'));
      var min = parseInt($(this).attr('min'));
      if ($(this).val() > max)
      {
          alert('Ne peut pas dépasser 100');
          //$(this).val(max);
      }
      else if ($(this).val() < min)
      {
        alert('Ne peut pas avoir une valeur negative');
          //$(this).val(min);
      }       
    }); 
});
    </script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
    $("#categorie").hide();
    $("#oui").click(function(){
        $("#categorie").show();
    });
    $("#non").click(function(){
        $("#categorie").hide();
    });
    document.getElementById("non").required = true;
    });
    </script>
</body>
</html>
