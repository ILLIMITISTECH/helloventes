<div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales chart -->
       <div class="select-box" style="margin-left : 0px; margin-top :0px;">

                                       
                                        <div class="col-md-3">
                                           
                                           <select name="search_a" class="form-select" aria-label="Default select example">
                                              
                                               <option value="">Filtrer</option>
                                              
                                               <option value="1" id="cours">Actions en cours</option>
                                               <option value="3" id="cours">Actions finalisées </option>
                                               <option value="4">Actions de cette semaine</option>
                                               <option value="5" >Actions de ce mois</option>
                                               <option value="6" >Actions de ce trimestre</option>
                                               <option value="2" >Toutes les actions</option>
                                             
                                           </select>
                                      
                                    <!--Filtrer par periode-->

                                       
                                           
                                         <!--<select name="search_a" class="form-select" aria-label="Default select example">    -->
                                         <!--      <option value="">Filtrer par période</option>-->
                                              
                                         <!--      <option value="4">Actions de cette semaine</option>-->
                                         <!--      <option value="5" >Actions de ce mois</option>-->
                                         <!--      <option value="6" >Actions de ce trimestre</option>-->
                                         <!--      <option value="7" >Toutes les actions</option>-->
                                             
                                         <!--  </select>-->
                                        </div>
                               

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <!--<div class="d-md-flenex">-->
                                <!--    <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Mes actions en instance de la semaine </h4>-->
                                
                                <!--</div>-->
                                
                                    @if(Session::has("success"))
                                            <div class="alert alert-success">
                                                <b>Action clôturée avec succès.</b> 
                                            </div>
                                        @endif
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
                                <div class="table-responsive mt-5">
                                     <div id="toutAction">
                                           <div class="d-md-flex">
                                    <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Toutes mes actions </h4>
                                
                                </div> 
                                    <table class="table stylish-table no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Libellé</th>
                                                <th class="border-top-0">Backup</th>
                                                <th class="border-top-0">Priorité</th>
                                                <th class="border-top-0">Progression</th>
                                                
                                                <th class="border-top-0">Retard</th>
                                                <th class="border-top-0">Options</th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                             
                                            @foreach($action_respons as $action)  
                                            
                                            @if($action->visibilite == 0 and $action->projet_id == null)
                                           
                                                            <tr>
                                                                <!--<form action="/save_action" method="post" id="target">-->
                                                                <!--<input type="hidden" value="{{csrf_token()}}" name="_token"/>-->
                                                                    <td class="align-middle" data-toggle="tooltip" title="{{$action->libelle}}"> {{ \Illuminate\Support\Str::limit($action->libelle, 35, $end='...') }}</td>
                                                                    @php $agentbackup = DB::table('agents')->where('id', $action->bakup)->first(); @endphp
                                                                    @if($agentbackup)
                                                                    <td class="align-middle" style="width:50px;"><span class="round">{{substr($agentbackup->prenom, 0, 1)}} {{substr($agentbackup->nom, 0, 1)}}</span></td>
                                                                    @else
                                                                    <td class="align-middle" style="width:50px;"><span class="round">--</span></td>
                                                                    @endif
                                                                         @if($action->risque == 'Elevé(E)')
                                                <td class="align-middle"data-toggle="tooltip" title="Elevé"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @elseif($action->risque == 'Moins(M)')
                                                <td class="align-middle"data-toggle="tooltip" title="Moyenne"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="orange" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></td>
                                                @else($action->risque == 'Faible(F)')
                                                <td class="align-middle"data-toggle="tooltip" title="Faible"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @endif

                                                                    <td class="align-middle" >
                                                                        <div class="align-middle" >
                                                                                        {{$action->pourcentage}}%
                                                                         </div>
                                                                        
                                                                     </td>
                                                                 
                                                                   
                                                                    @if($action->deadline < now())
                                                                    <td class="align-middle">{{intval(abs(strtotime("now") - strtotime($action->deadline))/ 86400)}} jours</td> 
                                                                    @else
                                                                    <td class="align-middle">Aucun</td>
                                                                    @endif

                                                                    <td class="align-middle" colspan ="2">
                                                                        <div class="student-dtl" style="display:flex;">
                                                                            <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Modifier votre action">
                                                                              <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"  href="{{route('action_user2.edit', $action->id)}}" >
                                                                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                                                    </svg>
                                                                                </a>
                                                                            </span>
                                                                             <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Mettre à jour votre action">
                                                                                  <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('action_user_toute.editer', $action->id)}}" >
                                                                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                                                                      <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                                                                      <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                                                                                    </svg>
                                                                                    </a>
                                                                                </span>
                                                                            
                                                                           
                                                    
                                                                             <form action="{{route('visibilite1.cloture', $action->id)}}" method="post" id="target" class="form">
                                                                                <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                                            @if($action->pourcentage == 100)
                                                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action">
                                                             <button type="submit" id="PopoverCustomT-1" class="btn btn-primary" >
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
</svg>
                                                            </button>
                                                        </span>
                                                        @else
                                                         <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action" disabled>
                                                             <button type="submit" id="PopoverCustomT-1" class="btn btn-primary" disabled>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
</svg>
                                                            </button>
                                                        </span>
                                                                            @endif
                                                                            </form>
                                                    
                                                
                                                                            </div>
                                                                    </td>
                                                                 
                                                                    
                                                                <!--</form>-->
                                                            </tr>
                                            </tbody>
                                                   
                                    
                                                            
                                                           
                                                             @endif
                                                             @endforeach
                                                     
                                            
                                             
                                                                </tbody>
                                        </table>
                                         </div>  
                                         
                                <div id="enCours">
                                <div class="d-md-flex">
                                    <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Mes actions En cours </h4>
                                
                                </div>  
                                    <table class="table stylish-table no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Libellé</th>
                                                <th class="border-top-0">Backup</th>
                                                <th class="border-top-0">Priorité</th>
                                                <th class="border-top-0">Progression</th>
                                                
                                                <th class="border-top-0">Retard</th>
                                                <th class="border-top-0">Options</th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                             
                                            @foreach($action_respons as $action)  
                                            @if($action->visibilite == 0 and $action->projet_id == null and $action->pourcentage != 100)
                                           
                                                            <tr>
                                                                <!--<form action="/save_action" method="post" id="target">-->
                                                                <!--<input type="hidden" value="{{csrf_token()}}" name="_token"/>-->
                                                                    <td class="align-middle" data-toggle="tooltip" title="{{$action->libelle}}"> {{ \Illuminate\Support\Str::limit($action->libelle, 35, $end='...') }}</td>
                                                                    @php $agentbackup = DB::table('agents')->where('id', $action->bakup)->first(); @endphp
                                                                    @if($agentbackup)
                                                                    <td class="align-middle" style="width:50px;"><span class="round">{{substr($agentbackup->prenom, 0, 1)}} {{substr($agentbackup->nom, 0, 1)}}</span></td>
                                                                    @else
                                                                    <td class="align-middle" style="width:50px;"><span class="round">--</span></td>
                                                                    @endif
                                                                     @if($action->risque == 'Elevé(E)')
                                                <td class="align-middle"data-toggle="tooltip" title="Elevé"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @elseif($action->risque == 'Moins(M)')
                                                <td class="align-middle"data-toggle="tooltip" title="Moyenne"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="orange" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></td>
                                                @else($action->risque == 'Faible(F)')
                                                <td class="align-middle"data-toggle="tooltip" title="Faible"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @endif

                                                                    <td class="align-middle" >
                                                                        <div class="align-middle" >
                                                                                        {{$action->pourcentage}}%
                                                                         </div>
                                                                        
                                                                     </td>
                                                                 
                                                                   
                                                                    @if($action->deadline < now())
                                                                    <td class="align-middle">{{intval(abs(strtotime("now") - strtotime($action->deadline))/ 86400)}} jours</td> 
                                                                    @else
                                                                    <td class="align-middle">Aucun</td>
                                                                    @endif

                                                                    <td class="align-middle" colspan ="2">
                                                                        <div class="student-dtl" style="display:flex;">
                                                                            <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Modifier votre action">
                                                                              <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"  href="{{route('action_user2.edit', $action->id)}}" >
                                                                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                                                    </svg>
                                                                                </a>
                                                                            </span>
                                                                             <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Mettre à jour votre action">
                                                                                  <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('action_user_toute.editer', $action->id)}}" >
                                                                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                                                                      <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                                                                      <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                                                                                    </svg>
                                                                                    </a>
                                                                                </span>
                                                                            
                                                                           
                                                    
                                                                             <form action="{{route('visibilite1.cloture', $action->id)}}" method="post" id="target" class="form">
                                                                                <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                                            @if($action->pourcentage == 100)
                                                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action">
                                                             <button type="submit" id="PopoverCustomT-1" class="btn btn-primary" >
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
</svg>
                                                            </button>
                                                        </span>
                                                        @else
                                                         <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action" disabled>
                                                             <button type="submit" id="PopoverCustomT-1" class="btn btn-primary" disabled>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
</svg>
                                                            </button>
                                                        </span>
                                                                            @endif
                                                                            </form>
                                                    
                                                
                                                                            </div>
                                                                    </td>
                                                                 
                                                                    
                                                                <!--</form>-->
                                                            </tr>
                                            </tbody>
                                                   
                                    
                                                            
                                                           
                                                             @endif
                                                             @endforeach
                                                     
                                            
                                             
                                                                </tbody>
                                        </table>
                                         </div>  
                        
                         <div id="finie">
                                <div class="d-md-flex">
                                    <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Mes actions finies </h4>
                                
                                </div>  
                                    <table class="table stylish-table no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Libellé</th>
                                                <th class="border-top-0">Backup</th>
                                                <th class="border-top-0">Priorité</th>
                                                <th class="border-top-0">Progression</th>
                                                
                                                <th class="border-top-0">Retard</th>
                                                <th class="border-top-0">Options</th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                             
                                            @foreach($action_respons as $action)  
                                            @if($action->visibilite == 0 and $action->projet_id == null and $action->pourcentage = 100)
                                           
                                                            <tr>
                                                                <!--<form action="/save_action" method="post" id="target">-->
                                                                <!--<input type="hidden" value="{{csrf_token()}}" name="_token"/>-->
                                                                    <td class="align-middle" data-toggle="tooltip" title="{{$action->libelle}}"> {{ \Illuminate\Support\Str::limit($action->libelle, 35, $end='...') }}</td>
                                                                    @php $agentbackup = DB::table('agents')->where('id', $action->bakup)->first(); @endphp
                                                                   @if($agentbackup)
                                                                    <td class="align-middle" style="width:50px;"><span class="round">{{substr($agentbackup->prenom, 0, 1)}} {{substr($agentbackup->nom, 0, 1)}}</span></td>
                                                                    @else
                                                                    <td class="align-middle" style="width:50px;"><span class="round">--</span></td>
                                                                    @endif
                                                                     @if($action->risque == 'Elevé(E)')
                                                <td class="align-middle"data-toggle="tooltip" title="Elevé"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @elseif($action->risque == 'Moins(M)')
                                                <td class="align-middle"data-toggle="tooltip" title="Moyenne"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="orange" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></td>
                                                @else($action->risque == 'Faible(F)')
                                                <td class="align-middle"data-toggle="tooltip" title="Faible"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @endif

                                                                    <td class="align-middle" >
                                                                        <div class="align-middle" >
                                                                                        {{$action->pourcentage}}%
                                                                         </div>
                                                                        
                                                                     </td>
                                                                 
                                                                   
                                                                    @if($action->deadline < now())
                                                                    <td class="align-middle">{{intval(abs(strtotime("now") - strtotime($action->deadline))/ 86400)}} jours</td> 
                                                                    @else
                                                                    <td class="align-middle">Aucun</td>
                                                                    @endif

                                                                    <td class="align-middle" colspan ="2">
                                                                        <div class="student-dtl" style="display:flex;">
                                                                            <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Modifier votre action">
                                                                              <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"  href="{{route('action_user2.edit', $action->id)}}" >
                                                                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                                                    </svg>
                                                                                </a>
                                                                            </span>
                                                                             <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Mettre à jour votre action">
                                                                                  <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('action_user_toute.editer', $action->id)}}" >
                                                                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                                                                      <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                                                                      <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                                                                                    </svg>
                                                                                    </a>
                                                                                </span>
                                                                            
                                                                           
                                                    
                                                                             <form action="{{route('visibilite1.cloture', $action->id)}}" method="post" id="target" class="form">
                                                                                <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                                            @if($action->pourcentage == 100)
                                                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action">
                                                             <button type="submit" id="PopoverCustomT-1" class="btn btn-primary" >
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                          <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                        </svg>
                                                            </button>
                                                        </span>
                                                        @else
                                                         <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action" disabled>
                                                             <button type="submit" id="PopoverCustomT-1" class="btn btn-primary" disabled>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                          <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                        </svg>
                                                            </button>
                                                        </span>
                                                                            @endif
                                                                            </form>
                                                    
                                                
                                                                            </div>
                                                                    </td>
                                                                 
                                                                    
                                                                <!--</form>-->
                                                            </tr>
                                            </tbody>
                                                   
                                    
                                                            
                                                           
                                                             @endif
                                                             @endforeach
                                                     
                                            
                                             
                                                                </tbody>
                                        </table>
                                         </div>  
                        
                        
                          <div class="table-responsive mt-5">
                                     <div id="semaine">
                                           <div class="d-md-flex">
                                    <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Mes actions de cette semaine </h4>
                                
                                </div> 
                                    <table class="table stylish-table no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Libellé</th>
                                                <th class="border-top-0">Backup</th>
                                                <th class="border-top-0">Priorité</th>
                                                <th class="border-top-0">Progression</th>
                                                
                                                <th class="border-top-0">Retard</th>
                                                <th class="border-top-0">Options</th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $action_semaineM7 = (date('d') -7);
                                                $action_semaineP7 = (date('d') +7);
                                                $action_tri_encoursM = (date('m') -1);
                                                $action_tri_encoursP = (date('m') +2);
                                                $action_tri_encoursMA = (date('m') -2);
                                                $action_tri_encoursPA = (date('m') +1);
                                                $action_mois = date('m');
                          
                                                 $action_respons = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.responsable', 'actions.projet_id', 'actions.libelle', 'actions.note',
                                            'actions.agent_id','actions.reunion_id','actions.raison',  'actions.visibilite','actions.bakup',  'actions.risque', 'actions.delais','actions.pourcentage', 'actions.note','actions.created_at',
                                            'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id','directions.nom_direction'
                                            )
                                            ->join('agents', 'agents.id', 'actions.agent_id')
                                            ->leftjoin('directions', 'directions.id', 'agents.direction_id')
                                            ->where('actions.agent_id','=', $user->id)
                                            //->orWhere('actions.bakup','=', $user->full_name)
                                            ->get();
                                            @endphp
                                            @foreach($action_respons as $action)  
                                            @php 
                                            
                                            $pourcentage = $action->pourcentage; @endphp
                                        @if(($action_semaineP7 >= date('d', strtotime($action->deadline))) && ($action_semaineM7 <= date('d', strtotime($action->deadline))) && ($action_mois == date('m', strtotime($action->deadline))))

                                            @if($action->visibilite == 0 and $action->projet_id == null)
                                           
                                                            <tr>
                                                                <!--<form action="/save_action" method="post" id="target">-->
                                                                <!--<input type="hidden" value="{{csrf_token()}}" name="_token"/>-->
                                                                    <td class="align-middle" data-toggle="tooltip" title="{{$action->libelle}}"> {{ \Illuminate\Support\Str::limit($action->libelle, 35, $end='...') }}</td>
                                                                    @php $agentbackup = DB::table('agents')->where('id', $action->bakup)->first(); @endphp
                                                                    @if($agentbackup)
                                                                    <td class="align-middle" style="width:50px;"><span class="round">{{substr($agentbackup->prenom, 0, 1)}} {{substr($agentbackup->nom, 0, 1)}}</span></td>
                                                                    @else
                                                                    <td class="align-middle" style="width:50px;"><span class="round">--</span></td>
                                                                    @endif
                                                                     @if($action->risque == 'Elevé(E)')
                                                <td class="align-middle"data-toggle="tooltip" title="Elevé"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @elseif($action->risque == 'Moins(M)')
                                                <td class="align-middle"data-toggle="tooltip" title="Moyenne"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="orange" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></td>
                                                @else($action->risque == 'Faible(F)')
                                                <td class="align-middle"data-toggle="tooltip" title="Faible"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @endif

                                                                    <td class="align-middle" >
                                                                        <div class="align-middle" >
                                                                                       {{ $pourcentage }}%
                                                                         </div>
                                                                        
                                                                     </td>
                                                                 
                                                                   
                                                                    @if($action->deadline < now())
                                                                    <td class="align-middle">{{intval(abs(strtotime("now") - strtotime($action->deadline))/ 86400)}} jours</td> 
                                                                    @else
                                                                    <td class="align-middle">Aucun</td>
                                                                    @endif

                                                                    <td class="align-middle" colspan ="2">
                                                                        <div class="student-dtl" style="display:flex;">
                                                                            <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Modifier votre action">
                                                                              <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"  href="{{route('action_user2.edit', $action->id)}}" >
                                                                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                                                    </svg>
                                                                                </a>
                                                                            </span>
                                                                             <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Mettre à jour votre action">
                                                                                  <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('action_user_toute.editer', $action->id)}}" >
                                                                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                                                                      <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                                                                      <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                                                                                    </svg>
                                                                                    </a>
                                                                                </span>
                                                                            
                                                                           
                                                    
                                                                             <form action="{{route('visibilite1.cloture', $action->id)}}" method="post" id="target" class="form">
                                                                                <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                                            @if($action->pourcentage == 100)
                                                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action">
                                                             <button type="submit" id="PopoverCustomT-1" class="btn btn-primary" >
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
</svg>
                                                            </button>
                                                        </span>
                                                        @else
                                                         <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action" disabled>
                                                             <button type="submit" id="PopoverCustomT-1" class="btn btn-primary" disabled>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
</svg>
                                                            </button>
                                                        </span>
                                                                            @endif
                                                                            </form>
                                                    
                                                
                                                                            </div>
                                                                    </td>
                                                                 
                                                                    
                                                                <!--</form>-->
                                                            </tr>
                                            </tbody>
                                                   
                                    
                                                            
                                                           @endif
                                                             @endif
                                                             @endforeach
                                                     
                                            
                                             
                                                                </tbody>
                                        </table>
                                         </div>  
                                         
                                         
                            <div id="mois">
                                <div class="d-md-flex">
                                    <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Mes actions de ce mois </h4>
                                
                                </div>  
                                    <table class="table stylish-table no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Libellé</th>
                                                <th class="border-top-0">Backup</th>
                                                <th class="border-top-0">Priorité</th>
                                                <th class="border-top-0">Progression</th>
                                                <th class="border-top-0">deadline</th>
                                                <th class="border-top-0">Retard</th>
                                                <th class="border-top-0">Options</th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                             
                                            @foreach($action_respons as $action) 
                                            @if($action_mois == date('m', strtotime($action->deadline)))
                                            @if($action->visibilite == 0 and $action->projet_id == null)
                                           
                                                            <tr>
                                                                <!--<form action="/save_action" method="post" id="target">-->
                                                                <!--<input type="hidden" value="{{csrf_token()}}" name="_token"/>-->
                                                                    <td class="align-middle" data-toggle="tooltip" title="{{$action->libelle}}"> {{ \Illuminate\Support\Str::limit($action->libelle, 35, $end='...') }}</td>
                                                                    @php $agentbackup = DB::table('agents')->where('id', $action->bakup)->first(); @endphp
                                                                    @if($agentbackup)
                                                                    <td class="align-middle" style="width:50px;"><span class="round">{{substr($agentbackup->prenom, 0, 1)}} {{substr($agentbackup->nom, 0, 1)}}</span></td>
                                                                    @else
                                                                    <td class="align-middle" style="width:50px;"><span class="round">--</span></td>
                                                                    @endif
                                                                     @if($action->risque == 'Elevé(E)')
                                                <td class="align-middle"data-toggle="tooltip" title="Elevé"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @elseif($action->risque == 'Moins(M)')
                                                <td class="align-middle"data-toggle="tooltip" title="Moyenne"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="orange" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></td>
                                                @else($action->risque == 'Faible(F)')
                                                <td class="align-middle"data-toggle="tooltip" title="Faible"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @endif

                                                                    <td class="align-middle" >
                                                                        <div class="align-middle" >
                                                                                        {{$action->pourcentage}}%
                                                                         </div>
                                                                        
                                                                     </td>
                                                                  <td class="align-middle" >
                                                                        <div class="align-middle" >
                                                                                        {{$action->deadline}}
                                                                         </div>
                                                                        
                                                                     </td>
                                                                   
                                                                    @if($action->deadline < now())
                                                                    <td class="align-middle">{{intval(abs(strtotime("now") - strtotime($action->deadline))/ 86400)}} jours</td> 
                                                                    @else
                                                                    <td class="align-middle">Aucun</td>
                                                                    @endif

                                                                    <td class="align-middle" colspan ="2">
                                                                        <div class="student-dtl" style="display:flex;">
                                                                            <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Modifier votre action">
                                                                              <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"  href="{{route('action_user2.edit', $action->id)}}" >
                                                                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                                                    </svg>
                                                                                </a>
                                                                            </span>
                                                                             <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Mettre à jour votre action">
                                                                                  <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('action_user_toute.editer', $action->id)}}" >
                                                                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                                                                      <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                                                                      <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                                                                                    </svg>
                                                                                    </a>
                                                                                </span>
                                                                            
                                                                           
                                                    
                                                                             <form action="{{route('visibilite1.cloture', $action->id)}}" method="post" id="target" class="form">
                                                                                <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                                            @if($action->pourcentage == 100)
                                                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action">
                                                             <button type="submit" id="PopoverCustomT-1" class="btn btn-primary" >
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
</svg>
                                                            </button>
                                                        </span>
                                                        @else
                                                         <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action" disabled>
                                                             <button type="submit" id="PopoverCustomT-1" class="btn btn-primary" disabled>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
</svg>
                                                            </button>
                                                        </span>
                                                                            @endif
                                                                            </form>
                                                    
                                                
                                                                            </div>
                                                                    </td>
                                                                 
                                                                    
                                                                <!--</form>-->
                                                            </tr>
                                            </tbody>
                                                   
                                    
                                                            
                                                           @endif
                                                             @endif
                                                             @endforeach
                                                     
                                            
                                             
                                                                </tbody>
                                        </table>
                                         </div>  
                        
                             <div id="tri">
                                <div class="d-md-flex">
                                    <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Mes actions de ce trimestre </h4>
                                
                                </div>  
                                    <table class="table stylish-table no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Libellé</th>
                                                <th class="border-top-0">Backup</th>
                                                <th class="border-top-0">Priorité</th>
                                                <th class="border-top-0">Progression</th>
                                                <th class="border-top-0">deadline</th>
                                                <th class="border-top-0">Retard</th>
                                                <th class="border-top-0">Options</th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($action_respons as $action)  
                                        
                                             @if(($action_tri_encoursP >= date('m', strtotime($action->deadline)))  && ($action_tri_encoursM <= date('m', strtotime($action->deadline))) &&
                                                 ($action_tri_encoursPA >= date('m', strtotime($action->deadline)))  && ($action_tri_encoursMA <= date('m', strtotime($action->deadline)))
                                             )

                                            @if($action->visibilite == 0 and $action->projet_id == null )
                                           
                                                            <tr>
                                                                <!--<form action="/save_action" method="post" id="target">-->
                                                                <!--<input type="hidden" value="{{csrf_token()}}" name="_token"/>-->
                                                                    <td class="align-middle" data-toggle="tooltip" title="{{$action->libelle}}"> {{ \Illuminate\Support\Str::limit($action->libelle, 35, $end='...') }}</td>
                                                                    @php $agentbackup = DB::table('agents')->where('id', $action->bakup)->first(); @endphp
                                                                   @if($agentbackup)
                                                                    <td class="align-middle" style="width:50px;"><span class="round">{{substr($agentbackup->prenom, 0, 1)}} {{substr($agentbackup->nom, 0, 1)}}</span></td>
                                                                    @else
                                                                    <td class="align-middle" style="width:50px;"><span class="round">--</span></td>
                                                                    @endif
                                                                     @if($action->risque == 'Elevé(E)')
                                                <td class="align-middle"data-toggle="tooltip" title="Elevé"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @elseif($action->risque == 'Moins(M)')
                                                <td class="align-middle"data-toggle="tooltip" title="Moyenne"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="orange" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></td>
                                                @else($action->risque == 'Faible(F)')
                                                <td class="align-middle"data-toggle="tooltip" title="Faible"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @endif

                                                                    <td class="align-middle" >
                                                                        <div class="align-middle" >
                                                                                        {{$action->pourcentage}}%
                                                                         </div>
                                                                        
                                                                     </td>
                                                                 
                                                                 <td class="align-middle" >
                                                                        <div class="align-middle" >
                                                                                        {{$action->deadline}}
                                                                         </div>
                                                                        
                                                                     </td>
                                                                   
                                                                    @if($action->deadline < now())
                                                                    <td class="align-middle">{{intval(abs(strtotime("now") - strtotime($action->deadline))/ 86400)}} jours</td> 
                                                                    @else
                                                                    <td class="align-middle">Aucun</td>
                                                                    @endif

                                                                    <td class="align-middle" colspan ="2">
                                                                        <div class="student-dtl" style="display:flex;">
                                                                            <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Modifier votre action">
                                                                              <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"  href="{{route('action_user2.edit', $action->id)}}" >
                                                                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                                                    </svg>
                                                                                </a>
                                                                            </span>
                                                                             <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Mettre à jour votre action">
                                                                                  <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('action_user_toute.editer', $action->id)}}" >
                                                                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                                                                      <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                                                                      <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                                                                                    </svg>
                                                                                    </a>
                                                                                </span>
                                                                            
                                                                           
                                                    
                                                                             <form action="{{route('visibilite1.cloture', $action->id)}}" method="post" id="target" class="form">
                                                                                <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                                            @if($action->pourcentage == 100)
                                                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action">
                                                             <button type="submit" id="PopoverCustomT-1" class="btn btn-primary" >
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
</svg>
                                                            </button>
                                                        </span>
                                                        @else
                                                         <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action" disabled>
                                                             <button type="submit" id="PopoverCustomT-1" class="btn btn-primary" disabled>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
</svg>
                                                            </button>
                                                        </span>
                                                                            @endif
                                                                            </form>
                                                    
                                                
                                                                            </div>
                                                                    </td>
                                                                 
                                                                    
                                                                <!--</form>-->
                                                            </tr>
                                            </tbody>
                                                   
                                    
                                                            
                                                           @endif
                                                             @endif
                                                             @endforeach
                                                     
                                            
                                             
                                                                </tbody>
                                        </table>
                                         </div>  
                        
                       
                        
                        <!-end filtre--->
                        
                                        </div>
                                        </div>
                                        </div>
                                
                           
                            </div>
                        </div>
                        
                        
           


                <!-- ==============================  Performances ================================ -->
               
                 <!-- ==============================  Performances ================================ -->
                

              
            </div>
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
             	<script src="{{asset('User/assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('User/assets/js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="{{asset('User/assets/js/custom/widgets.js')}}"></script>
            <script>
            $("#enCours").hide();
            $("#finie").hide();
            $("#semaine").hide();
            $("#mois").hide();
            $("#tri").hide();
            </script>
            <script>
            $(document).ready(function(){
              $("select").change(function(){
                    $( "select option:selected").each(function(){
                        //enter bengal districts
                        if($(this).attr("value")=="1"){
                            $("#enCours").show();
                            $("#finie").hide();
                            $("#toutAction").hide();
                            $("#semaine").hide();
                            $("#mois").hide();
                            $("#tri").hide();
                        }
                        if($(this).attr("value")=="3"){
                            $("#enCours").hide();
                            $("#finie").show();
                            $("#toutAction").hide();
                            $("#semaine").hide();
                            $("#mois").hide();
                            $("#tri").hide();
                        }
                        //enter other states
                        if($(this).attr("value")=="2"){
                            $("#enCours").hide();
                            $("#finie").hide();
                            $("#toutAction").show();
                            $("#semaine").hide();
                            $("#mois").hide();
                            $("#tri").hide();
                        }
                        if($(this).attr("value")=="4"){
                            $("#mois").hide();
                            $("#tri").hide();
                            $("#enCours").hide();
                            $("#semaine").show();
                            $("#finie").hide();
                            $("#toutAction").hide();
                        }
                        if($(this).attr("value")=="5"){
                            $("#semaine").hide();
                            $("#tri").hide();
                            $("#enCours").hide();
                            $("#finie").hide();
                            $("#mois").show();
                            $("#toutAction").hide();
                        }
                        if($(this).attr("value")=="6"){
                            $("#semaine").hide();
                            $("#mois").hide();
                            $("#enCours").hide();
                            $("#finie").hide();
                            $("#toutAction").hide();
                            $("#tri").show();
                        }
                        //enter other states
                       
                    });
                });  
            }); 

                </script>
               