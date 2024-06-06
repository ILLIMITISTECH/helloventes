                                                   
<div class="app-page-title">
                           
                           <div class="row">
                               <div class="col-md-6 col-lg-6">
                                   <div class="card-shadow-success mb-3 widget-chart widget-chart2 text-left card">
                                       <div class="perfo-box">
                                           <div class="widget-content-outer">
                                               <div class="widget-content-wrapper">
                                                   @if($actions == " ")
                                                    Pas d'action
                                                    @else
                                                    @if($sum_actions == " ")
                                                    Pas d'action
                                                    @else
                                                    
                                                    
                                                  @if(intval($sum) > 70) 
                                                   <div class="widget-content-left pr-2 fsize-1">
                                                       <div class="widget-numbers mt-0 fsize-3 text-success">{{intval($sum)}}%</div>
                                                   </div>
                                                   <div class="widget-content-right w-100">
                                                       <div class="progress-bar-xs progress">
                                                           <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{intval($sum)}}" aria-valuemin="0" aria-valuemax="100" style="width: {{intval($sum)}}%;"></div>
                                                       </div>
                                                   </div>
                                                   @elseif(intval($sum) >= 50 && intval($sum) <= 70)
                                                   <div class="widget-content-left pr-2 fsize-1">
                                                       <div class="widget-numbers mt-0 fsize-3 text-warning">{{intval($sum)}}%</div>
                                                   </div>
                                                   <div class="widget-content-right w-100">
                                                       <div class="progress-bar-xs progress">
                                                           <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="{{intval($sum)}}" aria-valuemin="0" aria-valuemax="100" style="width: {{intval($sum)}}%;"></div>
                                                       </div>
                                                   </div>
                                                    @elseif(intval($sum) < 50)
                                                   <div class="widget-content-left pr-2 fsize-1">
                                                       <div class="widget-numbers mt-0 fsize-3 text-danger">{{intval($sum)}}%</div>
                                                   </div>
                                                   <div class="widget-content-right w-100">
                                                       <div class="progress-bar-xs progress">
                                                           <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="{{intval($sum)}}" aria-valuemin="0" aria-valuemax="100" style="width: {{intval($sum)}}%;"></div>
                                                       </div>
                                                   </div>
                                                   @endif
                                                @endif
                                                @endif
                                                 
                                               </div>
                                               <div class="widget-content-left fsize-1">
                                                   <div class="text-muted opacity-6">Ma Performance</div>
                                               </div>
                                           </div>
                                       </div>
                                        
                                   </div>
                               </div>
                              
                                
                               <div class="col-md-6 col-lg-6">
                                   <div class="card-shadow-success mb-3 widget-chart widget-chart2 text-left card">
                                       <div class="perfo-box">
                                           <div class="widget-content-outer">
                                               <div class="widget-content-wrapper">      
                                                   @if($action_directions == " ")
                                                    Pas d'action
                                                    @else
                                                    @if($sum_directions == " ")
                                                    Pas d'action
                                                    @else
                                                   @if(intval($sum_dir) > 70)
                                                   <div class="widget-content-left pr-2 fsize-1">
                                                       <div class="widget-numbers mt-0 fsize-3 text-success">{{intval($sum_dir)}}%</div>
                                                   </div>
                                                   <div class="widget-content-right w-100">
                                                       <div class="progress-bar-xs progress">
                                                           <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{intval($sum_dir)}}" aria-valuemin="0" aria-valuemax="100" style="width: {{intval($sum_dir)}}%;"></div>
                                                       </div>
                                                   </div>
                                                   @elseif(intval($sum_dir) >= 50 && intval($sum_dir) <= 70)
                                                   <div class="widget-content-left pr-2 fsize-1">
                                                       <div class="widget-numbers mt-0 fsize-3 text-warning">{{intval($sum_dir)}}%</div>
                                                   </div>
                                                   <div class="widget-content-right w-100">
                                                       <div class="progress-bar-xs progress">
                                                           <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="{{intval($sum_dir)}}" aria-valuemin="0" aria-valuemax="100" style="width: {{intval($sum_dir)}}%;"></div>
                                                       </div>
                                                   </div>
                                                   @elseif(intval($sum_dir) < 50)
                                                   <div class="widget-content-left pr-2 fsize-1">
                                                       <div class="widget-numbers mt-0 fsize-3 text-danger">{{intval($sum_dir)}}%</div>
                                                   </div>
                                                   <div class="widget-content-right w-100">
                                                       <div class="progress-bar-xs progress">
                                                           <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="{{intval($sum_dir)}}" aria-valuemin="0" aria-valuemax="100" style="width: {{intval($sum_dir)}}%;"></div>
                                                       </div>
                                                   </div>
                                                   @endif
                                                   @endif
                                                   @endif
                                               </div>
                                               <div class="widget-content-left fsize-1">
                                                   <div class="text-muted opacity-6">Performance de ma direction</div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>

                                
                               
                           </div>
                           
                       </div> 
                      