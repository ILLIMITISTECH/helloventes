 <!-- section -->
 @if(Auth::user()->nom_role == "directeur")
                                    <div class="row">
                                        <div class="main-card mb-3 card">
                                             <div class="card-header" style="position : relative; display : flex;"> 
                                                <h3  style="font-family: 'poppins', sans-serif; font-size : 18px; font-weight : bolder; color : black;" >Les résultats stratégiques de ma Team</h3>
                                             </div>
                                            <div class="card-body"  style="position : relative;">
                                           <div class="row-fluid ">
                                                    <div id="productSlider" class="carousel slide" data-ride="carousel">
                                                
                                                        <div class="carousel-inner row w-100 mx-auto">
                                                            @php $i= 0; @endphp
                                                                        @foreach($strategiques->chunk(3) as $strategiqueCollections)
                                                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                
                                                                    <div class="row">
                                                                        
                                                                        @foreach($strategiqueCollections as $strategique)
                                                                         <div class="col-md-4 col-lg-4" style="margin-top : 1%;">
                                                                            <div class="card-shadow-danger mb-3 widget-chart widget-chart2 text-left">
                                                                                <div class="perfo-box" style="position : relative;">
                                                                                    <div class="widget-content-outer">
                                                                                        <div class="widget-content-left fsize-1" style="margin-top :-3%;">
                                                                                           <div class="perfo-label">{{$strategique->abv}} : {{$strategique->libelle}}</div>
                                                                                       </div>
                                                                                        <div class="widget-content-wrapper" style="margin-top : 10%;">
                                                                                           <div class="widget-content-left pr-2 fsize-1">
                                                                                               <div class="widget-numbers mt-0 fsize-2 text-success">{{intval($call_array[$i])}}%</div>
                                                                                           </div>
                                                                                           <div class="widget-content-right w-100">
                                                                                               <div class="progress" style="height: 10px;">
                                                                                                   <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{intval($call_array[$i])}}" aria-valuemin="0" aria-valuemax="100" style="width: {{intval($call_array[$i])}}%;"></div>
                                                                                               </div>
                                                                                           </div>
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                         @php $i++; @endphp

                                                                        @endforeach
                                                                    </div>
                                                
                                                                </div>
                                                            @endforeach
                                                            
                                                             
                                                        </div>
                                                
                                                        <a class="carousel-control-prev" href="#productSlider" role="button" data-slide="prev" style="position : absolute; left : -8%; color: black;">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color : black; color : white; border-radius :50%;"></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next" href="#productSlider" role="button" data-slide="next" style="position : absolute; right : -8%; color: black;">
                                                            <span class="carousel-control-next-icon" aria-hidden="true" style="background-color : black; color : white; border-radius :50%;"></span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                </div>
                                            </div> 
                                            
                                          <!-- endforeach chunk   -->
                                          
                                          
                                                         <!--   <div class="row">
                                                                  @php $i= 0; @endphp
                                                                        @foreach($strategiques as $strategique)
                                                                         <div class="col-md-4 col-lg-4" style="margin-top : 1%;">
                                                                            <div class="card-shadow-danger mb-3 widget-chart widget-chart2 text-left">
                                                                                <div class="perfo-box" style="position : relative;">
                                                                                    <div class="widget-content-outer">
                                                                                        <div class="widget-content-left fsize-1">
                                                                                           <div class="perfo-label" style="position :absolute; top : 2%">{{$strategique->abv}} : {{$strategique->libelle}}</div>
                                                                                       </div>
                                                                                        <div class="widget-content-wrapper" style="margin-top : 10%;">
                                                                                           <div class="widget-content-left pr-2 fsize-1">
                                                                                               <div class="widget-numbers mt-0 fsize-2 text-success">{{intval($call_array[$i])}}%</div>
                                                                                           </div>
                                                                                           <div class="widget-content-right w-100">
                                                                                               <div class="progress" style="height: 10px;">
                                                                                                   <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{intval($call_array[$i])}}" aria-valuemin="0" aria-valuemax="100" style="width: {{intval($call_array[$i])}}%;"></div>
                                                                                               </div>
                                                                                           </div>
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                         @php $i++; @endphp
                                                                        @endforeach
                                                                    </div> -->
                                    </div>
                                  </div>
                                </div
                               
@elseif(Auth::user()->nom_role == "responsable")
                                    <div class="row">
                                        <div class="main-card mb-3 card">
                                             <div class="card-header" style="position : relative; display : flex;"> 
                                                <h3  style="font-family: 'poppins', sans-serif; font-size : 18px; font-weight : bolder; color : black;" >Les résultats stratégiques de ma Direction</h3>
                                             </div>
                                            <div class="card-body"  style="position : relative;">
                                       
                                                 <div class="row-fluid">
                                                <div id="productSlider" class="carousel slide" data-ride="carousel">
                                            
                                                    <div class="carousel-inner row w-100 mx-auto">
                                                        @php $i= 0; @endphp
                                                                    @foreach($strategiquess->chunk(3) as $strategiqueCollections)
                                                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            
                                                                <div class="row">
                                                                    @foreach($strategiqueCollections as $strategique)
                                                                     <div class="col-md-4 col-lg-4" style="margin-top : 1%;">
                                                                    <div class="card-shadow-danger  widget-chart widget-chart2 text-left card">
                                                                        <div class="perfo-box" style="position : relative;">
                                                                            <div class="widget-content-outer" >
                                                                                <div class="widget-content-left fsize-1" style="margin-top :-3%;">
                                                                                   <div class="perfo-label" >{{$strategique->abv}} : {{$strategique->libelle}}</div>
                                                                               </div>
                                                                                <div class="widget-content-wrapper" style="margin-top : 10%;">
                                                                                   <div class="widget-content-left pr-2 fsize-1">
                                                                                       <div class="widget-numbers mt-0 fsize-2 text-success">{{intval($sum_arrays[$i])}}%</div>
                                                                                   </div>
                                                                                   <div class="widget-content-right w-100">
                                                                                       <div class="progress" style="height: 10px;">
                                                                                           <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{intval($sum_arrays[$i])}}" aria-valuemin="0" aria-valuemax="100" style="width: {{intval($sum_arrays[$i])}}%;"></div>
                                                                                       </div>
                                                                                   </div>
                                                                                    
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                 @php $i++; @endphp
                                                             @endforeach
                                                                </div>
                                            
                                                            </div>
                                                           
                                                        @endforeach
                                                    </div>
                                            
                                                    <a class="carousel-control-prev" href="#productSlider" role="button" data-slide="prev" style="position : absolute; left : -8%; color: black;">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color : black; color : white; border-radius :50%;"></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next" href="#productSlider" role="button" data-slide="next" style="position : absolute; right : -8%; color: black;">
                                                            <span class="carousel-control-next-icon" aria-hidden="true" style="background-color : black; color : white; border-radius :50%;"></span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                               
                                            </div>
                                        </div>
                                        
                                                                           </div>
                                     </div>
                                    </div>
                                
@endif
