// user action 

<div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex">
                                    <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Mes actions liée à un projet </h4>
                                
                                </div>
                                
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
                                    <table class="table stylish-table no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Projet</th>
                                                <th class="border-top-0">Libellé de l'action</th>
                                                <th class="border-top-0">Backup</th>
                                                <th class="border-top-0">Priorité</th>
                                                <th class="border-top-0">Progression</th>
                                                <th class="border-top-0">Échéance</th>
                                                <th class="border-top-0">Retard</th>
                                                <th class="border-top-0">Options</th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($pro as $proj)  
                                            @if($proj->visibilite == 0)
                                           
                                                            <tr>
                                                              
                                                                     <td class="text-nice">
                                                                   <p>
                                                                        <p  class="text-nice" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                                             <b> {{$proj->libelle}} </b>
                                                                          </p>
                                                                    </p>
                                                                    </td>
                                                                     @php $agentbackup = DB::table('agents')->where('id', $proj->bakup)->first(); @endphp
                                                                    @if($agentbackup)
                                                                    <td class="align-middle"><span style="width:50px;"><span class="round">{{substr($agentbackup->prenom, 0, 1)}} {{substr($agentbackup->nom, 0, 1)}}</span></span></td>
                                                                    @else
                                                                    <td class="align-middle"><span class="responsable">--</span></td>
                                                                    @endif
                                                                
                                                                     @if($proj->priorite == 'Elevé(E)')
                                                <td class="align-middle"data-toggle="tooltip" title="Elevé"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @elseif($proj->priorite == 'Moins(M)')
                                                <td class="align-middle"data-toggle="tooltip" title="Moyenne"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="orange" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></td>
                                                @else($proj->priorite == 'Faible(F)')
                                                <td class="align-middle"data-toggle="tooltip" title="Faible"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @endif
                                                

                                                                    <td class="align-middle" >
                                                                                        {{$proj->pourcentage}}%

                                                                     </td>
                                                                 
                                                                   
                                                                    <td class="align-middle">{{strftime("%d/%m/%Y", strtotime($proj->deadline))}}</td>
                                                                    @if($proj->deadline < now())
                                                                    <td class="align-middle">{{intval(abs(strtotime("now") - strtotime($proj->deadline))/ 86400)}} jours</td> 
                                                                    @else
                                                                    <td class="align-middle">Aucun</td>
                                                                    @endif

                                                                    <td class="align-middle" colspan ="2">
                                                                        <div class="student-dtl" style="display:flex;">
                                                   
                                                                         <span class="d-inline-block" tabindex="0" style="margin-right : 10%;">
                                                                                <a id="PopoverCustomT-1" href="{{route('action_projet.edit', $action->id)}}" type="button" class="btn boutton-options">
                                                                                    <i class="bi bi-pencil-square" style="color:black;" data-toggle="tooltip" title="Modifier l'action"></i>
                                                                                </a>
                                                                            </span>
                                                                                    <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Mettre à jour votre action">
                                                                                        <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('action_projet.edit', $proj->id)}}" >
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                                                                              <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                                                                              <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                                                                                            </svg>
                                                                                        </a>
                                                                                    </span>
                                                                           
                                                    
                                                            <form action="{{route('visibiliteraction.cloturer', $proj->id)}}" method="post" id="target" class="form">
                                                            <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                            @if($proj->pourcentage == 100)
                                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action">
                                                                <button type="submit" id="PopoverCustomT-1" class="btn btn-primary">
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
                            ----------------------------------------------------------------------------------

                                                    @php  $pro_actions = DB::table('actions')->where('projet_id', $proj->id)->where('agent_id', $user->id)->get(); @endphp
                                                @foreach($pro_actions as $pro_action)
                                                <tr id="collapseExample">
                                                        <td class="align-middle"></td>
                                                         <td class="align-middle">{{$pro_action->libelle}}</td>
                                                        @php $agentbackup = DB::table('agents')->where('id', $pro_action->bakup)->first(); @endphp
                                                                    @if($agentbackup)
                                                                    <td class="align-middle"><span style="width:50px;"><span class="round">{{substr($agentbackup->prenom, 0, 1)}} {{substr($agentbackup->nom, 0, 1)}}</span></span></td>
                                                                    @else
                                                                    <td class="align-middle"><span class="responsable">--</span></td>
                                                                    @endif
                                                                     @if($pro_action->risque == 'Elevé(E)')
                                                <td class="align-middle"data-toggle="tooltip" title="Elevé"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @elseif($pro_action->risque == 'Moins(M)')
                                                <td class="align-middle"data-toggle="tooltip" title="Moyenne"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="orange" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></td>
                                                @else($pro_action->risque == 'Faible(F)')
                                                <td class="align-middle"data-toggle="tooltip" title="Faible"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @endif

                                                                    <td class="align-middle" >
                                                                        <div class="align-middle" >
                                                                                        {{$pro_action->pourcentage}}%
                                                                         </div>
                                                                        
                                                                     </td>
                                                                 
                                                                   
                                                                    <td class="align-middle">{{strftime("%d/%m/%Y", strtotime($pro_action->deadline))}}</td>
                                                                    @if($pro_action->deadline < now())
                                                                    <td class="align-middle">{{intval(abs(strtotime("now") - strtotime($pro_action->deadline))/ 86400)}} jours</td> 
                                                                    @else
                                                                    <td class="align-middle">Aucun</td>
                                                                    @endif

                                                                          <td class="align-middle" colspan ="2">
                                                                        <div class="student-dtl" style="display:flex;">
                                                   
                                                                         <span class="d-inline-block" tabindex="0" style="margin-right : 10%;">
                                                                                <a id="PopoverCustomT-1" href="{{route('action_projet.edit', $action->id)}}" type="button" class="btn boutton-options">
                                                                                    <i class="bi bi-pencil-square" style="color:black;" data-toggle="tooltip" title="Modifier l'action"></i>
                                                                                </a>
                                                                            </span>
                                                                                    <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Mettre à jour votre action">
                                                                                        <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('action_projet.edit', $proj->id)}}" >
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                                                                              <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                                                                              <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                                                                                            </svg>
                                                                                        </a>
                                                                                    </span>
                                                                           
                                                    
                                                            <form action="{{route('visibiliteraction.cloturer', $proj->id)}}" method="post" id="target" class="form">
                                                            <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                            @if($proj->pourcentage == 100)
                                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action">
                                                                <button type="submit" id="PopoverCustomT-1" class="btn btn-primary">
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
                                                    </tr>
                                                    @endforeach
                                        </tr>
                                            </tbody>
                                                   
                                    
                                                            
                                                           
                                                             @endif
                                                             @endforeach
                                                     
                                            
                                                 
                                            </tbody>
                                        </table>
                                        </div>
                                        </div>
                                        </div>
                                
                           
                            </div>
                        </div>
                        
                        
//utilisateur mois

                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-md-flex">
                                            <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Mes actions liée à un projet de ce mois </h4>
                                        
                                        </div>
                                        <div class="table-responsive mt-5">
                                            <table class="table stylish-table no-wrap">
                                                <thead>  
                                                    <tr>
                                                        <th class="border-top-0">Projet</th>
                                                        <th class="border-top-0">Libellé de l'action</th>
                                                        <th class="border-top-0">Backup</th>
                                                        <th class="border-top-0">Priorité</th>
                                                        <th class="border-top-0">Progression</th>
                                                    
                                                        <th class="border-top-0">Échéance</th>
                                                        <th class="border-top-0">Retard</th>
                                                        <th class="border-top-0">Options</th>
                                                        
                                                    </tr>
                                                    </thead>
                                                    <tbody >
                                                    @foreach($action_respons as $action)  
                                                    @if($action->visibilite == 0 and $action->projet_id != null)
                                                    <div>
                                                        
                                                                    <tr>
                                                                <form action="/save_action" method="post" id="target">
                                                                <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                                @php $projet = DB::table('projets')->where('id', $action->projet_id)->first();  @endphp
                                                                @if($projet)
                                                                     <td class="text-nice">
                                                                   <p>
                                                                        <p  class="text-nice" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                                             {{$projet->libelle}}
                                                                          </p>
                                                                    </p>
                                                                    </td>
                                                                     @else
                                                                    <td class="text-nice"></td>
                                                                    @endif
                                                                    <td class="align-middle">{{$action->libelle}}</td>
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
                                                                                        {{$action->pourcentage}}%

                                                                     </td>
                                                                 
                                                                   
                                                                    <td class="align-middle">{{strftime("%d/%m/%Y", strtotime($action->deadline))}}</td>
                                                                    @if($action->deadline < now())
                                                                    <td class="align-middle">{{intval(abs(strtotime("now") - strtotime($action->deadline))/ 86400)}} jours</td> 
                                                                    @else
                                                                    <td class="align-middle">Aucun</td>
                                                                    @endif

                                                                    <td class="align-middle" colspan ="2">
                                                                        <div class="student-dtl" style="display:flex;">
                                                   
                                                                         <span class="d-inline-block" tabindex="0" style="margin-right : 10%;">
                                                                                <a id="PopoverCustomT-1" href="{{route('action_projet.edit', $action->id)}}" type="button" class="btn boutton-options">
                                                                                    <i class="bi bi-pencil-square" style="color:black;" data-toggle="tooltip" title="Modifier l'action"></i>
                                                                                </a>
                                                                            </span>
                                                                            
                                                                            <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Mettre à jour votre action">
                                                                              <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('action_projet_mois.edit', $action->id)}}" >
                                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
  <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
  <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
</svg>
                                                                                </a>
                                                                            </span>
                                                    
                                                                             <form action="{{route('visibiliteraction.cloturer', $action->id)}}" method="post" id="target" class="form">
                                                                                <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                                             @if($action->pourcentage == 100)
                                                                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action">
                                                             <button type="submit" id="PopoverCustomT-1" class="btn btn-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
</svg>
                                                            </button>
                                                        </span>
                                                        @else
                                                         <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action" >
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

                                                            </tr>
                                                                </tbody>
                                                        
                                                        </div>

                                                    </div>
                                                                    </div>
                                                                
                                                                    @endif
                                                                    @endforeach
                                                            
                                                    
                                                        
                                                    </tbody>
                                                </table>
                                                </div>                              </div>

// section dg
<div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex">
                                    <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Mes actions liée à un projet </h4>
                                
                                </div>
                                
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
                                    <table class="table stylish-table no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Projet</th>
                                                <th class="border-top-0">Libellé de l'action</th>
                                                <th class="border-top-0">Backup</th>
                                                <th class="border-top-0">Priorité</th>
                                                <th class="border-top-0">Progression</th>
                                                <th class="border-top-0">Échéance</th>
                                                <th class="border-top-0">Retard</th>
                                                <th class="border-top-0">Options</th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($pro as $proj)  
                                            @if($proj->visibilite == 0)
                                           
                                                            <tr>
                                                              
                                                                     <td class="text-nice">
                                                                   <p>
                                                                        <p  class="text-nice" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                                             <b> {{$proj->libelle}} </b>
                                                                          </p>
                                                                    </p>
                                                                    </td>
                                                                     @php $agentbackup = DB::table('agents')->where('id', $proj->bakup)->first(); @endphp
                                                                    @if($agentbackup)
                                                                    <td class="align-middle"><span style="width:50px;"><span class="round">{{substr($agentbackup->prenom, 0, 1)}} {{substr($agentbackup->nom, 0, 1)}}</span></span></td>
                                                                    @else
                                                                    <td class="align-middle"><span class="responsable">--</span></td>
                                                                    @endif
                                                                
                                                                     @if($proj->priorite == 'Elevé(E)')
                                                <td class="align-middle"data-toggle="tooltip" title="Elevé"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @elseif($proj->priorite == 'Moins(M)')
                                                <td class="align-middle"data-toggle="tooltip" title="Moyenne"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="orange" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></td>
                                                @else($proj->priorite == 'Faible(F)')
                                                <td class="align-middle"data-toggle="tooltip" title="Faible"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @endif
                                                

                                                                    <td class="align-middle" >
                                                                                        {{$proj->pourcentage}}%

                                                                     </td>
                                                                 
                                                                   
                                                                    <td class="align-middle">{{strftime("%d/%m/%Y", strtotime($proj->deadline))}}</td>
                                                                    @if($proj->deadline < now())
                                                                    <td class="align-middle">{{intval(abs(strtotime("now") - strtotime($proj->deadline))/ 86400)}} jours</td> 
                                                                    @else
                                                                    <td class="align-middle">Aucun</td>
                                                                    @endif

                                                                    <td class="align-middle" colspan ="2">
                                                                        <div class="student-dtl" style="display:flex;">
                                                   
                                                                         <span class="d-inline-block" tabindex="0" style="margin-right : 10%;">
                                                                                <a id="PopoverCustomT-1" href="{{route('action_projet.edit', $action->id)}}" type="button" class="btn boutton-options">
                                                                                    <i class="bi bi-pencil-square" style="color:black;" data-toggle="tooltip" title="Modifier l'action"></i>
                                                                                </a>
                                                                            </span>
                                                                                    <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Mettre à jour votre action">
                                                                                        <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('action_projet.edit', $proj->id)}}" >
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                                                                              <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                                                                              <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                                                                                            </svg>
                                                                                        </a>
                                                                                    </span>
                                                                           
                                                    
                                                            <form action="{{route('visibiliteraction.cloturer', $proj->id)}}" method="post" id="target" class="form">
                                                            <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                            @if($proj->pourcentage == 100)
                                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action">
                                                                <button type="submit" id="PopoverCustomT-1" class="btn btn-primary">
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
                            ----------------------------------------------------------------------------------

                                                    @php  $pro_actions = DB::table('actions')->where('projet_id', $proj->id)->where('agent_id', $user->id)->get(); @endphp
                                                @foreach($pro_actions as $pro_action)
                                                <tr id="collapseExample">
                                                        <td class="align-middle"></td>
                                                         <td class="align-middle">{{$pro_action->libelle}}</td>
                                                        @php $agentbackup = DB::table('agents')->where('id', $pro_action->bakup)->first(); @endphp
                                                                    @if($agentbackup)
                                                                    <td class="align-middle"><span style="width:50px;"><span class="round">{{substr($agentbackup->prenom, 0, 1)}} {{substr($agentbackup->nom, 0, 1)}}</span></span></td>
                                                                    @else
                                                                    <td class="align-middle"><span class="responsable">--</span></td>
                                                                    @endif
                                                                     @if($pro_action->risque == 'Elevé(E)')
                                                <td class="align-middle"data-toggle="tooltip" title="Elevé"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @elseif($pro_action->risque == 'Moins(M)')
                                                <td class="align-middle"data-toggle="tooltip" title="Moyenne"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="orange" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></td>
                                                @else($pro_action->risque == 'Faible(F)')
                                                <td class="align-middle"data-toggle="tooltip" title="Faible"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @endif

                                                                    <td class="align-middle" >
                                                                        <div class="align-middle" >
                                                                                        {{$pro_action->pourcentage}}%
                                                                         </div>
                                                                        
                                                                     </td>
                                                                 
                                                                   
                                                                    <td class="align-middle">{{strftime("%d/%m/%Y", strtotime($pro_action->deadline))}}</td>
                                                                    @if($pro_action->deadline < now())
                                                                    <td class="align-middle">{{intval(abs(strtotime("now") - strtotime($pro_action->deadline))/ 86400)}} jours</td> 
                                                                    @else
                                                                    <td class="align-middle">Aucun</td>
                                                                    @endif

                                                                          <td class="align-middle" colspan ="2">
                                                                        <div class="student-dtl" style="display:flex;">
                                                   
                                                                         <span class="d-inline-block" tabindex="0" style="margin-right : 10%;">
                                                                                <a id="PopoverCustomT-1" href="{{route('action_projet.edit', $action->id)}}" type="button" class="btn boutton-options">
                                                                                    <i class="bi bi-pencil-square" style="color:black;" data-toggle="tooltip" title="Modifier l'action"></i>
                                                                                </a>
                                                                            </span>
                                                                                    <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Mettre à jour votre action">
                                                                                        <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('action_projet.edit', $proj->id)}}" >
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                                                                              <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                                                                              <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                                                                                            </svg>
                                                                                        </a>
                                                                                    </span>
                                                                           
                                                    
                                                            <form action="{{route('visibiliteraction.cloturer', $proj->id)}}" method="post" id="target" class="form">
                                                            <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                            @if($proj->pourcentage == 100)
                                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action">
                                                                <button type="submit" id="PopoverCustomT-1" class="btn btn-primary">
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
                                                    </tr>
                                                    @endforeach
                                        </tr>
                                            </tbody>
                                                   
                                    
                                                            
                                                           
                                                             @endif
                                                             @endforeach
                                                     
                                            
                                                 
                                            </tbody>
                                        </table>
                                        </div>
                                        </div>
                                        </div>