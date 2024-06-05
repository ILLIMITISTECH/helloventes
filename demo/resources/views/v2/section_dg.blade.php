<?php
                                $user = DB::table('agents')->where('user_id', Auth::user()->id)->first();
                                //dd($action_respons);
                                $action_mois = date('m');
                                $action_semaineM7 = (date('d') -7);
                                $action_semaineP7 = (date('d') +7);
                                //$action_responsdff = array();
                                $action_responss = array();
                                $action_bakupss = array();
                                //dd($action_semaineP7);
                                $action_responsf = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.responsable',
                                'actions.libelle', 'actions.note',
                                'actions.agent_id','actions.reunion_id','actions.raison',  'actions.visibilite','actions.bakup',
                                'actions.risque', 'actions.delais','actions.pourcentage', 'actions.note','actions.created_at',
                                'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id','directions.nom_direction'
                                )
                                ->join('agents', 'agents.id', 'actions.agent_id')
                                ->leftjoin('directions', 'directions.id', 'agents.direction_id')
                                ->where('actions.agent_id','=', $user->id)
                               // ->where('actions.bakup','=', $users->full_name)
                                ->orderBy('actions.deadline', 'ASC')
                                ->get();
                                foreach($action_responsf as $action_respf)
                                {
                                    if(($action_semaineP7 >= date('d', strtotime($action_respf->deadline))) && ($action_semaineM7 <= date('d', strtotime($action_respf->deadline))) && ($action_mois == date('m', strtotime($action_respf->deadline))))
                                    {
                                        array_push($action_responss, $action_respf);
                                    }
                                }
                                $action_bakupsf = DB::table('actions')->select('actions.id', 'actions.deadline', 'actions.responsable',
                                'actions.libelle', 'actions.note',
                                'actions.agent_id','actions.reunion_id','actions.raison',  'actions.visibilite','actions.bakup',
                                'actions.risque', 'actions.delais','actions.pourcentage', 'actions.note','actions.created_at',
                                'agents.prenom', 'agents.nom', 'agents.photo', 'agents.id as Id','directions.nom_direction'
                                )
                                ->join('agents', 'agents.id', 'actions.agent_id')
                                ->leftjoin('directions', 'directions.id', 'agents.direction_id')
                                //->where('actions.agent_id','=', $user->id)
                                ->where('actions.bakup','=', $user->id)
                                ->orderBy('actions.pourcentage', 'ASC')
                                ->get();
                                foreach($action_bakupsf as $action_bakupf)
                                {
                                    if(($action_semaineP7 >= date('d', strtotime($action_bakupf->deadline))) && ($action_semaineM7 <= date('d', strtotime($action_bakupf->deadline))) && ($action_mois == date('m', strtotime($action_bakupf->deadline))))
                                    {
                                        array_push($action_bakupss, $action_bakupf);
                                    }
                                }
                                ?>

<div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex">
                                    <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Mes actions en instance de la semaine </h4>
                                
                                </div>
                                <div class="table-responsive mt-5">
                                   
                                    <table class="table stylish-table no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Libellé de l'action</th>
                                                <th class="border-top-0">Backup</th>
                                                <th class="border-top-0">Priorité</th>
                                                <th class="border-top-0">Progression</th>
                                                <th class="border-top-0">Retard </th>
                                                <th class="align-middle">Options </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($action_responss as $action)
                                            @if($action->visibilite == 0)
                                            <tr>
                                                
                                                <td class="align-middle" data-toggle="tooltip" title="{{$action->libelle}}"> {{ \Illuminate\Support\Str::limit($action->libelle, 35, $end='...') }}</td>
                                                @php $agentbackup = DB::table('agents')->where('id', $action->bakup)->first() @endphp
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


                                              
                                                <td class="align-middle">
                                                   {{$action->pourcentage}}%
                                                </td>
                                                
                                                @if ($action -> deadline < now())
                                                <td class="align-middle">{{intval(abs(strtotime("now") - strtotime($action->deadline))/ 86400)}} jours</td>
                                                @else
                                                <td class="align-middle">Aucun </td>
                                                @endif

                                                <td class="text-center">
                                                   <div class="student-dtl" style="display:flex; justify-content : space-arround;">
                                                       <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Mettre à jour votre action" style="margin-right : 10%;">
                                                            <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('action_user_d.editer', $action->id)}}" >
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
  <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
  <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
</svg>
                                                            </a>
                                                        </span>
                                                        <form action="{{route('visibilite.cloture', $action->id)}}" method="post" id="target" class="form">
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
                                        @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex">
                                    <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Mes actions de la semaine pour lesquelles je suis Backup </h4>
                                
                                </div>
                                <div class="table-responsive mt-5">
                                   
                                    <table class="table stylish-table no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Libellé de l'action</th>
                                                <th class="border-top-0">Backup</th>
                                                <th class="border-top-0">Priorité</th>
                                                <th class="border-top-0">Progression</th>
                                                <th class="border-top-0">Echéance</th>
                                                <th class="border-top-0">Retard </th>
                                                <th class="border-top-0">Options </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($action_bakupss as $action)
                                            @if($action->visibilite == 0)
                                            <tr>
                                                
                                                                    <td class="align-middle" data-toggle="tooltip" title="{{$action->libelle}}"> {{ \Illuminate\Support\Str::limit($action->libelle, 35, $end='...') }}</td>
                                                @php $agentbackup = DB::table('agents')->where('id', $action->bakup)->first() @endphp
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

                                              
                                                <td class="align-middle">
                                                   {{$action->pourcentage}}%
                                                       
                                                    
                                                </td>
                                                
                                                <td class="align-middle"> {{strftime("%d/%m", strtotime($action->deadline))}}</td>
                                                @if ($action -> deadline < now())
                                                <td class="align-middle">{{intval(abs(strtotime("now") - strtotime($action->deadline))/ 86400)}} jours</td>
                                                @else
                                                <td class="align-middle">Aucun </td>
                                                @endif

                                                <td class="text-center">
                                                   <div class="student-dtl" style="display:flex;">
                                                        <span class="d-inline-block" tabindex="0" style="margin-right : 10%;"data-toggle="tooltip" title="Mettre à jour votre action">
                                                          <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('action_user_d.editer', $action->id)}}" >
                                                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
  <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
  <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
</svg>
                                                            </a>
                                                        </span>
                                                        <form action="{{route('visibilite.cloture', $action->id)}}" method="post" id="target" class="form">
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
                                        @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                                    
                        <!--------------------------------actions avec projet-------------------------------------------------->
                        
         
                         <!---------------------------------------------end-------------------------------------------------------------->



                                
                           
                         