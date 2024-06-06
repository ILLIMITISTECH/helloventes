@if(Auth::user()->nom_role == "directeur")    
<div class="row">
<h4 class="page-title mb-2 p-2">Les performances mensuelles des directions  </h4>

                  
                    @php $i= 0; @endphp
                    @foreach($directions as $direction)
                        @php
                            $cumul_late = DB::table('actions')
                                        ->join('agents', 'agents.id', 'actions.agent_id')
                                        ->whereDate('deadline','<', now())
                                        ->where('pourcentage','<', 100)
                                        ->where('agents.direction_id', $direction->id)->count();
                        @endphp
                        <!-- Column -->
                        <a href="{{route('cumul_retard.direction', $direction->id)}}" class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"> {{$direction->nom_direction}} <br> <span style="color:red"><b>- {{ $cumul_late }}</b>&nbsp;&nbsp;(Jours)</span></h4>
                                    <div class="text-end">
                                        <!-- <h2 class="font-light mb-0"><i class="ti-arrow-up text-success"></i> $120</h2>
                                        <span class="text-muted">Todays Income</span> -->
                                    </div>
                                    @if(intval($action_sum_array_dir[$i]) >= 80)
                                <span class="text-success">{{intval($action_sum_array_dir[$i])}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{intval($action_sum_array_dir[$i])}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @elseif(intval($action_sum_array_dir[$i]) >= 50)
                                <span class="text-warning">{{intval($action_sum_array_dir[$i])}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{intval($action_sum_array_dir[$i])}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @elseif(intval($action_sum_array_dir[$i]) < 50)
                                <span class="text-danger">{{intval($action_sum_array_dir[$i])}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                        style="width: {{intval($action_sum_array_dir[$i])}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @endif
                                    
                                </div>
                            </div>
                        </a>
                        @php $i++; @endphp
                    @endforeach
</div>
@elseif(Auth::user()->nom_role == "responsable")

<div class="row">
    <h4 class="page-title mb-2 p-2">La performance mensuelle des membres de mon équipe  </h4>
 <?php $age = DB::table('agents')->where('user_id',Auth::user()->id)->first() ?>
                                         <?php $agens = DB::table('agents')->where('direction_id',$age->direction_id)->get() ?>
                                         
                                         @php $a = 0; @endphp
                                        @foreach($agens as $agent)
                    <!-- Column -->
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> {{$agent->prenom}} {{$agent->nom}}</h4>
                                <div class="text-end">
                                    <!-- <h2 class="font-light mb-0"><i class="ti-arrow-up text-success"></i> $120</h2>
                                    <span class="text-muted">Todays Income</span> -->
                                </div>
                                @if(intval($sum_array_agent[$a]) >= 80)
                                <span class="text-success">{{intval($sum_array_agent[$a])}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{intval($sum_array_agent[$a])}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @elseif(intval($sum_array_agent[$a]) >= 50)
                                <span class="text-warning">{{intval($sum_array_agent[$a])}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{intval($sum_array_agent[$a])}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @elseif(intval($sum_array_agent[$a]) < 50)
                                <span class="text-danger">{{intval($sum_array_agent[$a])}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                        style="width: {{intval($sum_array_agent[$a])}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                    @php $a++; @endphp
                                        @endforeach 
                                        <!-- Column -->
 </div>   
@endif


               