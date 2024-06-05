  <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Feedback</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('v2/assets/img/favicon.png')}}" rel="icon">
  <link href="{{asset('v2/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/vendor/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

</head>

<body>


 
        @include('v2.header_dg')
        <aside id="sidebar" class="sidebar">
                <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                @include('v2.side_bar_dg')
            </div>
                <!-- End Sidebar scroll-->
         </aside>
    
    
    
                <!-- end side bar -->
                <main id="main" class="main">

                        <div class="pagetitle" style = "text-align:center">
                          <h1 style="color:#4154f1">Synthèse de mes feedbacks reçus</h1>
                          
                        </div><br><br>
                       <!-- formulaire 1-->
                       
                       
    
        <section class="section" style = "margin-left : 30px">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                       
								
    								          
    					@php
    					
    					$afedd = DB::table('agents')->where('user_id', Auth::user()->id)->first();
    					$source_feedbaks = DB::table('feedback')->select('feedback.id', 'feedback.agents_id_choisi', 'source_feedbacks.id as Id', 'source_feedbacks.statut', 'source_feedbacks.phase', 
    					'source_feedbacks.nom_source', 'agents.id as IDA')
    					->join('agents', 'agents.id', 'feedback.agents_id_choisi')
    					->join('source_feedbacks', 'source_feedbacks.id', 'feedback.source_id')
    					->where('feedback.agents_id_choisi', $afedd->id)
    					->orderBy('source_feedbacks.id', 'DESC')
    					->pluck('source_feedbacks.Id')
    					->toArray();
    					
    					$check_sources = DB::table('source_feedbacks')->pluck('id')
    					->toArray();
    					
    					$check_firsts = array_diff($check_sources, $source_feedbaks);
    					$check_seconds = array_diff($check_sources, $check_firsts);
    				     
    					
    					@endphp
    								          
    								          
    					 <!--<table class="table table-borderless mt-5">-->
          <!--                              <thead>-->
          <!--                                  <tr style = "color : #1561a2;">-->
								  <!--            <th scope="col">Origine du feedback</th>-->
								              <!--<th scope="col">Options</th>-->
										<!--    </tr>-->
										<!--      </thead>-->
										<!--      <tbody>-->
										          
                                        
										<!--         @foreach($check_seconds as $source_feed)-->
										<!--           @php $source_feedbak = DB::table('source_feedbacks')->where('id', $source_feed)->orderBy('id', 'DESC')->first(); @endphp-->
										        
										<!--          <tr>-->
										<!--              <td>{{$source_feedbak->nom_source}}</td>-->
										<!--         @if($source_feedbak->statut == 1 && $source_feedbak->phase == 1)    -->
										<!--            <td>-->
										<!--                 <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Télécharger" disabled>-->
          <!--                                                <a type="button" href="#" id="PopoverCustomT-1" class="btn" style="background-color:#d5569b" disabled>-->
          <!--                                                     <svg xmlns="#" width="16" height="16" fill="white" class="bi bi-filetype-pdf" viewBox="0 0 16 16" disabled>-->
          <!--                                                        <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 -->
          <!--                                                        .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 -->
          <!--                                                        1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 -->
          <!--                                                        .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.-->
          <!--                                                        68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1--->
          <!--                                                        .068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7-->
          <!--                                                        .896v1.117h1.606v.638H7.896Z" disabled/>-->
          <!--                                                      </svg>-->
          <!--                                                  </a>-->
          <!--                                              </span>-->
										<!--                <a type="button" href="#" class="btn" style="background-color:#4154f1; color:white" disabled>Rapport détaillé</a>-->
										<!--                 @if($action)-->
										<!--                   @if($action->source == $source_feedbak->id)-->
										<!--                    <a type="button" href="{{route('listfeedback_par_sourceA', $action->id)}}" class="btn" style="background-color:#4154f1; color:white" disabled>Plan d'actions</a>-->
										<!--                     @else-->
										<!--                      <button type="button" class="btn" title="Pas d'action" style="background-color:#4154f1; color:white" disabled>Plan d'actions</button>-->
										<!--                      @endif -->
										<!--                       @else-->
										<!--                        <button type="button" class="btn" title="Pas d'action" style="background-color:#4154f1; color:white" disabled>Plan d'actions</button>-->
          <!--                                                 @endif  -->
                                                          
        								               
										<!--              </td>-->
										<!--            @elseif($source_feedbak->statut == 1 && $source_feedbak->phase == 2)    -->
										<!--             <td>-->
										<!--                  <span class="d-inline-block" tabindex="0" style="" data-toggle="tooltip" title="Télécharger">-->
          <!--                                                <a href="{{ route('telecharger.feedback_source', $source_feedbak->id)}}" target="_blank" id="PopoverCustomT-1" class="btn" style="background-color:#d5569b">-->
          <!--                                                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-filetype-pdf" viewBox="0 0 16 16">-->
          <!--                                                        <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>-->
          <!--                                                      </svg>-->
          <!--                                                  </a>-->
          <!--                                              </span>-->
										<!--                <a type="button" href="{{route('voir.feedback_source', $source_feedbak->id)}}" class="btn" style="background-color:#4154f1; color:white">Rapport détaillé</a>-->
										<!--                 @if($action)-->
										<!--                   @if($action->source == $source_feedbak->id)-->
										<!--                    <a type="button" href="{{route('listfeedback_par_sourceA', $action->id)}}" class="btn" style="background-color:#4154f1; color:white" >Plan d'actions</a>-->
										<!--                     @else-->
										<!--                      <button type="button" class="btn" title="Pas d'action" style="background-color:#4154f1; color:white" disabled>Plan d'actions</button>-->
										<!--                      @endif -->
										<!--                       @else-->
										<!--                        <button type="button" class="btn" title="Pas d'action" style="background-color:#4154f1; color:white" disabled>Plan d'actions</button>-->
          <!--                                                 @endif  -->
                                                          
        								               
										<!--              </td>-->
										<!--            @endif-->
                                                        
										<!--          </tr>-->
										        
										<!--    	@endforeach     -->
										       
										<!--      </tbody>-->
						    <!--</table>-->
                     @if($feedback->isEmpty() ) 
								 
    								           <p>Pas de feedback</p>
    								          @else                        
                    @php $a = DB::table('agents')->where('user_id', Auth::user()->id)->first(); @endphp
				         @php $clf = DB::table('client_facilitateurs')->where('entreprise_id',$a->entreprise_2)->first(); @endphp
				         @if($clf)
                                   
                                    <table class="table table-borderless mt-5">
                                        <thead>
                                            <tr style = "color : #1561a2;">
								              <th scope="col">Origine du feedback</th>
								              <!--<th scope="col">Options</th>-->
										    </tr>
										      </thead>
										      <tbody>
										          
                                        
										         @foreach($source_list as $source)
										        
										         @if($source->id == $clf->source_id)
										          <tr>
										              <td>{{$source->nom_source}}</td>
										         @if($source->statut == 1 && $source->phase == 1)    
										            <td>
										                 <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Télécharger" disabled>
                                                          <a type="button" href="#" id="PopoverCustomT-1" class="btn" style="background-color:#d5569b" disabled>
                                                               <svg xmlns="#" width="16" height="16" fill="white" class="bi bi-filetype-pdf" viewBox="0 0 16 16" disabled>
                                                                  <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 
                                                                  .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 
                                                                  1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 
                                                                  .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.
                                                                  68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-
                                                                  .068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7
                                                                  .896v1.117h1.606v.638H7.896Z" disabled/>
                                                                </svg>
                                                            </a>
                                                        </span>
										                <a type="button" href="#" class="btn" style="background-color:#4154f1; color:white" disabled>Rapport détaillé</a>
										                 @if($action)
										                   @if($action->source == $source->id)
										                    <a type="button" href="{{route('listfeedback_par_sourceA', $action->id)}}" class="btn" style="background-color:#4154f1; color:white" disabled>Plan d'actions</a>
										                     @else
										                      <button type="button" class="btn" title="Pas d'action" style="background-color:#4154f1; color:white" disabled>Plan d'actions</button>
										                      @endif 
										                       @else
										                        <button type="button" class="btn" title="Pas d'action" style="background-color:#4154f1; color:white" disabled>Plan d'actions</button>
                                                           @endif  
                                                          
        								               
										              </td>
										            @elseif($source->statut == 1 && $source->phase == 2)    
										             <td>
										                  <span class="d-inline-block" tabindex="0" style="" data-toggle="tooltip" title="Télécharger">
                                                          <a href="{{ route('telecharger.feedback_source', $source->id)}}" target="_blank" id="PopoverCustomT-1" class="btn" style="background-color:#d5569b">
                                                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                                                  <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
                                                                </svg>
                                                            </a>
                                                        </span>
										                <a type="button" href="{{route('voir.feedback_source', $source->id)}}" class="btn" style="background-color:#4154f1; color:white">Rapport détaillé</a>
										                 @if($action)
										                   @if($action->source == $source->id)
										                    <a type="button" href="{{route('listfeedback_par_sourceA', $action->id)}}" class="btn" style="background-color:#4154f1; color:white" >Plan d'actions</a>
										                     @else
										                      <button type="button" class="btn" title="Pas d'action" style="background-color:#4154f1; color:white" disabled>Plan d'actions</button>
										                      @endif 
										                       @else
										                        <button type="button" class="btn" title="Pas d'action" style="background-color:#4154f1; color:white" disabled>Plan d'actions</button>
                                                           @endif  
                                                          
        								               
										              </td>
										            @endif
                                                        
										          </tr>
										        
						                        	@endif
										    	@endforeach     
										       
										      </tbody>
						    </table>
						
					 @endif
					 
					 
					 
						 @php $a = DB::table('agents')->where('user_id', Auth::user()->id)->first(); @endphp
						 @if($a->entreprise != 2)
						<table class="table table-borderless mt-5" >
                                        <thead>
                                            <tr style = "color : #1561a2;">
								              <th scope="col">Origine du feedback</th>
								              <!--<th scope="col">Options</th>-->
										    </tr>
										      </thead>
										      <tbody>
										          
                                        
										         @foreach($source_list as $source)
										         @php $a = DB::table('agents')->where('user_id', Auth::user()->id)->first(); @endphp
										         @php $clf = DB::table('client_facilitateurs')->where('entreprise_id',$a->entreprise)->first(); @endphp
										         @if($source->id == $clf->source_id)
										          <tr>
										              <td>{{$source->nom_source}}</td>
										         @if($source->statut == 1 && $source->phase == 1)    
										            <td>
										                 <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Télécharger" disabled>
                                                          <a type="button" href="#" id="PopoverCustomT-1" class="btn" style="background-color:#d5569b" disabled>
                                                               <svg xmlns="#" width="16" height="16" fill="white" class="bi bi-filetype-pdf" viewBox="0 0 16 16" disabled>
                                                                  <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 
                                                                  .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 
                                                                  1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 
                                                                  .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.
                                                                  68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-
                                                                  .068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7
                                                                  .896v1.117h1.606v.638H7.896Z" disabled/>
                                                                </svg>
                                                            </a>
                                                        </span>
										                <a type="button" href="#" class="btn" style="background-color:#4154f1; color:white" disabled>Rapport détaillé</a>
										                 @if($action)
										                   @if($action->source == $source->id)
										                    <a type="button" href="{{route('listfeedback_par_sourceA', $action->id)}}" class="btn" style="background-color:#4154f1; color:white" disabled>Plan d'actions</a>
										                     @else
										                      <button type="button" class="btn" title="Pas d'action" style="background-color:#4154f1; color:white" disabled>Plan d'actions</button>
										                      @endif 
										                       @else
										                        <button type="button" class="btn" title="Pas d'action" style="background-color:#4154f1; color:white" disabled>Plan d'actions</button>
                                                           @endif  
                                                          
        								               
										              </td>
										            @elseif($source->statut == 1 && $source->phase == 2)    
										             <td>
										                  <span class="d-inline-block" tabindex="0" style="" data-toggle="tooltip" title="Télécharger">
                                                          <a href="{{ route('telecharger.feedback_source', $source->id)}}" target="_blank" id="PopoverCustomT-1" class="btn" style="background-color:#d5569b">
                                                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                                                  <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
                                                                </svg>
                                                            </a>
                                                        </span>
										                <a type="button" href="{{route('voir.feedback_source', $source->id)}}" class="btn" style="background-color:#4154f1; color:white">Rapport détaillé</a>
										                 @if($action)
										                   @if($action->source == $source->id)
										                    <a type="button" href="{{route('listfeedback_par_sourceA', $action->id)}}" class="btn" style="background-color:#4154f1; color:white" >Plan d'actions</a>
										                     @else
										                      <button type="button" class="btn" title="Pas d'action" style="background-color:#4154f1; color:white" disabled>Plan d'actions</button>
										                      @endif 
										                       @else
										                        <button type="button" class="btn" title="Pas d'action" style="background-color:#4154f1; color:white" disabled>Plan d'actions</button>
                                                           @endif  
                                                          
        								               
										              </td>
										            @endif
                                                        
										          </tr>
										         @endif
										    	@endforeach     
										       
										      </tbody>
						</table>
						  @endif
                        @endif		
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

                       <!-- end formulaire1 --> 
    @php  $agent_groupe = DB::table('agents')->where('nom', $personne_choisi->groupe)->first();@endphp
        @if( $agent_groupe)
    @php  $feedback_groupe = DB::table('feedback')->where('agents_id_choisi', $agent_groupe->id)->where('choix', 'feedback')->get(); @endphp
    @foreach($feedback_groupe as $feedback_groupes)
        <?php $groupes = DB::table('agents')->where('id', $feedback_groupes->agents_id_choisi)->first(); ?>
    @endforeach
    <section class="section" style = "margin-left : 30px">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                       
								 @if($feedback_groupe->isEmpty() ) 
								 
    								           <p style = "color : #1561a2;">Pas de feedback groupé</p>
    								          @else
                                                   
                   
                                   
                                    <table class="table table-borderless mt-5">
                                        <thead>
                                            <tr style = "color : #1561a2;">
								              <th scope="col">Origine du feedback pour ton groupe</th>
								              <!--<th scope="col">Options</th>-->
										    </tr>
										      </thead>
										      <tbody>
										          
                                        
										         @foreach($source_list as $source)
										         @php $a = DB::table('agents')->where('user_id', Auth::user()->id)->first(); @endphp
										         @php $clf = DB::table('client_facilitateurs')->where('entreprise_id',$a->entreprise)->first(); @endphp
										         @if($source->id == $clf->source_id)
										          <tr>
										              <td>{{$source->nom_source}}</td>
										         @if($source->statut == 1 && $source->phase == 1)    
										            <td>
										                 <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Télécharger" disabled>
                                                          <a type="button" href="#" id="PopoverCustomT-1" class="btn" style="background-color:#d5569b" disabled>
                                                               <svg xmlns="#" width="16" height="16" fill="white" class="bi bi-filetype-pdf" viewBox="0 0 16 16" disabled>
                                                                  <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 
                                                                  .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 
                                                                  1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 
                                                                  .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.
                                                                  68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-
                                                                  .068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7
                                                                  .896v1.117h1.606v.638H7.896Z" disabled/>
                                                                </svg>
                                                            </a>
                                                        </span>
										                <a type="button" href="#" class="btn" style="background-color:#4154f1; color:white" disabled>Rapport détaillé</a>
										              
										              </td>
										            @elseif($source->statut == 1 && $source->phase == 2)    
										             <td>
										                  <span class="d-inline-block" tabindex="0" style="" data-toggle="tooltip" title="Télécharger">
                                                          <a href="{{ route('telecharger.feedback_source_groupe', $source->id)}}" target="_blank" id="PopoverCustomT-1" class="btn" style="background-color:#d5569b">
                                                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                                                  <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
                                                                </svg>
                                                            </a>
                                                        </span>
										                <a type="button" href="{{route('voir.voir_listfeedback_groupe', $source->id)}}" class="btn" style="background-color:#4154f1; color:white">Rapport détaillé</a>
										               
										              </td>
										            @endif
                                                        
										          </tr>
										         @endif
										    	@endforeach     
										       
										      </tbody>
						</table>
						 
                        @endif		
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
                       
       @endif               

                            
                                       
                    
                    </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </main>
    </div>
 
 <style>
 
      .red{
            color :red;
            font-weight : bold;
        }
        .text-nice{
            font-family: 'poppins', sans-serif;
        }
        
        .btn-green {
            background-color : #43928E ;
            color : white;
        }
        .rounded-container{
            width: 586px;
            height: 526px;
            background: white;
            border-radius: 51px;
            margin-right : auto;
            text-align : center;
        }
</style>
 <script src="{{asset('assets/vendor/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/chart.js/chart.min.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/quill/quill.min.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>
    
</body>
</html>
