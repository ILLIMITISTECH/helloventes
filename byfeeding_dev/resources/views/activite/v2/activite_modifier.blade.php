<!doctype html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="short icon" href="{{asset('collov2/assets/images/icon.png')}}">
    <title>Collaboratis | Modifier une activité</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                                <div class="card-header" style="position : relative">
                                    
                             
                                <h5 class="card-title" style="font-family: 'poppins', sans-serif; font-size : 18px; color : black;">Modifier l'activité</h5>
                                
                                <form action="{{ route('activite.destroyac', $activite->id) }}" method="POST">
                                            {{csrf_field()}}
                                            @method('DELETE')
                                            <button type="submit" onclick="myFunction()" class="btn btn-danger pull-right" style="position : absolute; right : 5%; top : 2%;" >Supprimer</button>
                                </form>
                                  </div>         
                               <form action="{{route('active_update', $activite->id)}}" method="post"  class="dropzone dropzone-custom needsclick add-professors" enctype="multipart/form-data">
                                                    @method('PATCH')
                                                     @csrf
                                            <div class="tab-pane" id="tab1">

                                                  <fieldset>
                                                    <div class="control-group">
                                                      <label class="text-nice" for="focusedInput">Libelé de l'activité <span class="red">*</span></label>
                                                      <div class="controls">
                                                      <input name="libelle_act" value="{{$activite->libelle}}" type="text" class="form-control" placeholder="Libelé de l'activité">
                                                      </div>                      
                                                    </div>
                                                    <br>
                                                      <div class="control-group">
                                                      <label class="text-nice" for="focusedInput">Date de début de l'activité (format : 2021-05-25) <span class="red">*</span></label>
                                                      <div class="controls">
                                                      <input name="date_debut" type="date" value="{{$activite->date_debut}}" class="form-control" placeholder="Date de début de l'activité">
                                                      </div>                      
                                                    </div>
                                                    <br>
                                                    <div class="control-group">
                                                      <label class="text-nice" for="focusedInput">Deadline de l'activité (format : 2021-05-25) <span class="red">*</span></label>
                                                      <div class="controls">
                                                      <input name="deadlines" type="date" value="{{$activite->deadline}}" class="form-control" placeholder="Deadline de l'activité">
                                                      </div>                      
                                                    </div>
                                                    <br>
                                                    <div class="control-group">
                                                      <label for="inputState" class="text-nice">Responsable l'activité <span class="red">*</span></label>
                                                      <?php $agent = DB::table('agents')->where('id', $activite->res_dir)->first() ?>
                                                        <select id="inputState" name="res_dirs" class="form-select">
                                                          <option value="{{$activite->res_dir}}">{{$agent->prenom}} {{$agent->nom}}</option>
                                                          @foreach($agents as $agent)
                                                          <option value="{{$agent->id}}">{{$agent->prenom}} {{$agent->nom}}</option>
                                                          @endforeach
                                                        </select>
                                                    </div> 
                                                    <br>
                                                    <div class="control-group">
                                                      <label for="inputState" class="text-nice">Responsable le backup <span class="red">*</span></label>
                                                      <?php $agent = DB::table('agents')->where('id', $activite->backup)->first() ?>
                                                        <select id="inputState" name="backup" class="form-select">
                                                          <option value="{{$activite->backup}}">{{$agent->prenom}} {{$agent->nom}}</option>
                                                          @foreach($agents as $agent)
                                                          <option value="{{$agent->id}}">{{$agent->prenom}} {{$agent->prenom}}</option>
                                                          @endforeach
                                                        </select>
                                                    </div> 
                                                    <br>
                                                     <div class="control-group">
                                                      <label for="inputState" class="text-nice">Rattacher l’activité à un objectif du plan stratégique (Pas Obligatoire)</label>
                                                        <?php $stra = DB::table('strategiques')->where('id', $activite->strategique_id)->first() ?>
                                                        <select id="inputState" name="strategique_id" class="form-select">
                                                          <option value="{{$activite->strategique_id}}">{{$stra->abv}}</option>
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
                                                  <h5 class="card-title" style="font-family: 'poppins', sans-serif; font-size : 16px; color : black;">Modifier une tâche à cette activité</h5>
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
                                                                     <?php $taches = DB::table('tache_modeles')->where('modele_id', $activite->id)->get() ?>
                                                                      <?php $date = date('y-m-d h:i:s'); ?>
                                                                      
                                                                     @foreach($taches as $tache)
                                                                        <tr>
                                                                            
                                                                             <td>
                                                                                
                                                                                   
                                                                                    <input type="text" name="libelle[]" value="{{$tache->libelle}}" class="form-control" placeholder="Libellé de la Tâche" aria-label="First name">
                                                                                  
                                                                              </td>
                                                                             <td>
                                                                                 <?php $agens = DB::table('agents')->where('id', $tache->res_dir)->get() ?>
                                                                                    <select id="inputState" name="res_dir[]" class="form-select">
                                                                                        @foreach($agens as $agen)
                                                                                      <option value="{{$tache->res_dir}}">{{$agen->prenom}} {{$agen->nom}}</option>
                                                                                      @endforeach
                                                                                      @foreach($agents as $agent)
                                                                                      <option value="{{$agent->id}}">{{$agent->prenom}} {{$agent->nom}}</option>
                                                                                      @endforeach
                                                                                    </select>
                                                                              
                                                                             </td>    
                                                                             
                                                                             <td>     
                                                                                 
                                                                                      <div class="controls">
                                                                                       <input name="deadline[]" value="{{$tache->deadline}}" type="date" class="form-control" placeholder="Deadline de l'activité">
                                                                                       <input type="hidden" id="task" value="{{$tache->id}}">
                                                                                    </div>
                                                                                </div>
                                                                             </td>
                                                                             
                                                                             
                                                                             
                                                                             <!--<td><a href="#" class="btn btn-danger remove"><i class="bi bi-trash"></i></a></td>-->
                                                                             <td>
                                                                                 
                                                                                 <form action="{{ route('activite.destroyta', $tache->id) }}" id="demo11-upload" method="POST">
                                                                                    {{csrf_field()}}
                                                                                    <button class="btn btn-danger" onclick="share11()"><i class="bi bi-trash"></i></button>
                                                                                </form>
                                                                                <!--<button class="deleteRecord" data-id="{{ $tache->id }}" >Delete Record</button>-->
                                                                                
                                                                             </td>
                                                                             </tr>
                                                                     </tr>
                                                                     @endforeach
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
                                                  <input name="categorie_id" value="{{$activite->categorie_id}}" type="hidden">
                                                
                                                  
                                            </div>

                                                <div class="form-actions pull-left" style="margin-top:20px;">
                                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                    
                                                </div>
                                                
                                            
                                            </form>
                                       
                                            
                                            
                                            
                                            
                                            
                                            
 <!--================SCRIPTS=    ============ ============                                     -->
                                            
    <script>
function myFunction() {
  alert("Êtes vous sur de vouloir supprimer cette activité ? ");
}
</script>

</body>
</html>
                                        
                                            
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                
        '<td>  <select id="inputState" name="res_dir[]" class="form-select"><option selected>Sélectionner le responsable</option> @foreach($agents as $agent)<option value="{{$agent->id}}">{{$agent->prenom}} {{$agent->prenom}}</option> @endforeach</select></td>'+
                                                                                     
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
    
    
     <script>
        
        var form_share11 = document.getElementById('demo11-upload').action;
        var task11 = $("#task").val();
        function share11(){
            $.post(form_share11,
            {
                id: task11
                
            },
            function(data, status){
                console.log('data: ', data);
                console.log('status: ', status);
            });
        }
    </script>
    
    
    <script>
        $(".deleteRecord").click(function(){
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
   
    $.ajax(
    {
        url: "destroyactiviteta/"+id,
        type: 'DELETE',
        data: {
            "id": id,
            "_token": token,
        },
        success: function (){
            console.log("it Works");
        }
    });
   
});
    </script>
    
    
</body>
</html>
