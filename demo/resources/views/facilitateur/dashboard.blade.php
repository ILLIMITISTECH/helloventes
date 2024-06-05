 <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Dashboard Card -->
            <div class="col-xxl-12 col-md-12" >
              <div class="card info-card sales-card text-white" style = "background: #1561a2;">
                <div class="card-body" >
                  <h5 class="card-title text-white">Bonjour {{Auth::user()->prenom}} !  </span></h5>
                        Bienvenue sur votre Tableau de bord. Vous pouvez administrer vos feedbacks, consulter les rapports de synthèse de vos clients, et suivre l'exécution de plans d'action individuels.
                </div>
              </div>
            </div><!-- End Dashboard Card -->
        </div>
          <h5>
      @if (session('message'))
                  <div class="alert alert-success" role="alert">
                  {{ session('message') }}
                  </div>  
                  @endif
    </h5>
        
         <div class="d-md-flex">
                                                <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Les sessions de feedbacks   </h4>
                                            </div> 
                                           
                                    <table class="table stylish-table no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Nom client</th>
                                                <th class="border-top-0">Source</th>
                                                <th class="border-top-0">Nombre agents</th>
                                                 <th class="border-top-0">Feedbacks</th>
                                                 <th class="border-top-0">Actions</th>
                                                 <!--<th class="border-top-0">Actions de suivi</th>-->
                                                  <th class="border-top-0">Satisfaction</th>
                                                <th class="border-top-0">Options</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                           
                                            @foreach($clients as $client) 
                                                            <tr>
                                               
                                                @php $entreprise = DB::table('entreprises')->where('id', $client->entreprise_id)->orderBy('id', 'desc')->first(); @endphp
                                                @php $source_nom = DB::table('source_feedbacks')->where('id', $client->source_id)->orderBy('id', 'desc')->first(); @endphp
                                                @if($entreprise)
                                                <td class="align-middle" >
                                                    <div class="align-middle" >
                                                        {{$entreprise->libelle}} 
                                                    </div>
                                                </td>
                                                @else
                                                <td class="align-middle" >
                                                    <div class="align-middle" >
                                                        -- 
                                                    </div>
                                                </td>
                                                @endif
                                                @if($source_nom)
                                                <td class="align-middle" >
                                                    <div class="align-middle" >
                                                        {{$source_nom->nom_source}} 
                                                    </div>
                                                </td>
                                                @else
                                                <td class="align-middle" >
                                                    <div class="align-middle" >
                                                        -- 
                                                    </div>
                                                </td>
                                                @endif
                                                <!-- @php $departement = DB::table('departements')->where('id', $client->departement_id)->first(); @endphp  -->
                                                <!--@if($departement)-->
                                                <!--<td class="align-middle" >-->
                                                <!--    <div class="align-middle" >-->
                                                <!--        {{$departement->libelle}} -->
                                                <!--    </div>-->
                                                <!--</td>-->
                                                <!--@else-->
                                                <!--<td class="align-middle" >-->
                                                <!--    <div class="align-middle" >-->
                                                <!--        -- -->
                                                <!--    </div>-->
                                                <!--</td>-->
                                                <!--@endif-->
                                                @php $entreprise = DB::table('entreprises')->where('id', $client->entreprise_id)->first(); @endphp  
                                                @php $a = DB::table('agents')->where('entreprise', $entreprise->id)->orwhere('entreprise_2', $entreprise->id)->count(); @endphp 
                                                @php $aCheck = DB::table('agents')->where('check_entreprise', '=', 'SN')->where('check_2023', '=', 'SN')->count(); @endphp
                                                @php $aCheck_2023 = DB::table('agents')->where('check_2023', '=', 'SN')->where('entreprise', '=', 2)->count(); @endphp
                                                
                                                @if($client->source_id == 6)
                                                <td class="align-middle" >
                                                    <div class="align-middle" >
                                                        {{$aCheck}}  
                                                    </div>
                                                </td>
                                                @elseif($client->entreprise_id == 2)
                                                <td class="align-middle" >
                                                    <div class="align-middle" >
                                                        {{$aCheck_2023}}  
                                                    </div>
                                                </td>
                                                @else
                                                 <td class="align-middle" >
                                                    <div class="align-middle" >
                                                        {{$a}}  
                                                    </div>
                                                </td>
                                                @endif
                                               
                                                 <td class="align-middle" >
                                                     @php 
                                                     $feedback = DB::table('feedback')->where('source_id', $client->source_id)->where('choix', 'feedback')->count(); 
                                                     $feed = DB::table('feedback')->where('source_id', $client->source_id)->where('choix', 'feedback')->get();
                                                
                                                       $var = array();
                                                        foreach ($feed as $feeds){
                                                            $somme_note = $feeds->note;
                                                            array_push($var,$somme_note);
                                                           
                                                        }
                                                        $total_somme_note = array_sum($var);
                                                        $nb_note = count($var);
                                                        $notes = $nb_note == 0 ? 0 :  $total_somme_note / $nb_note;
                                                     @endphp
                                                    <div class="align-middle" >
                                                        {{$feedback}}
                                                    </div>
                                                </td>
                                                
                                                <td class="align-middle" >
                                                     @php
                                                       $actions = DB::table('actions')->where('source', $client->source_id)->get();
                                                    @endphp
                                                    <div class="align-middle" >
                                                       <a href="{{route('action_agent.lister', $client->source_id)}}"> {{count($actions)}} </a>
                                                    </div>
                                                </td>
                                             

                                                <td class="align-middle" >
                                                    <div class="align-middle" >
                                                        {{number_format($notes, 1, ',', '')}}/10
                                                    </div>
                                                </td>
                                              @php $dnow = date('Y-m-d'); @endphp
                                                                     
                                                                   <td class="align-middle" style="display:flex;">
                                                                      <div class="align-middle" style="display : flex;" >
                                                                          @php $sourcefg = DB::table('source_feedbacks')->where('id', $client->source_id)->first(); @endphp
                                                                          @if($sourcefg->phase == 2)
                                                                        <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Rapport">
                                                                           <button type="submit" id="PopoverCustomT-1"style="background:#f8f9fa; border:#f8f9fa">
                                                                            <a type="submit" href="{{route('voir_detail_client.facilitateur', $client->entreprise_id)}}" target="_blank">
                                                                                 <img src="{{asset('images/report(1).png')}}" alt="" width="20px;" height="20px;">
                                                                            </a>
                                                                            </button>
                                                                        </span>
                                                                        @else
                                                                        <span class="d-inline-block" tabindex="0" style="margin-right : 10%;">
                                                                           <button type="submit" id="PopoverCustomT-1"style="background:#f8f9fa; border:#f8f9fa" disabled>
                                                                           
                                                                                 <img src="{{asset('images/report(1).png')}}" alt="" width="20px;" height="20px;">
                                                                           
                                                                            </button>
                                                                        </span>
                                                                        @endif
                                                                        </div> 
                                                                         
                                                            @if($sourcefg->phase == 1)
                                                                        &nbsp;<div class="align-middle" style="display : flex;" >
                                                                        <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Initialiser">
                                                                             <form action="{{route('initialiser.feedback', $sourcefg->id)}}" method="post">
                                                                                {{csrf_field()}}
                                                                                <input name="phase" value="1" hidden>
                                                                            <button type="submit" id="PopoverCustomT-1" style="background:#f8f9fa; border:#f8f9fa" disabled>
                                                                                <img src="{{asset('images/forward1.png')}}" alt="" width="20px;" height="20px;">
                                                                            </button>
                                                                            </form>
                                                                        </span>
                                                                        </div> 
                                                                         &nbsp;<div class="align-middle" style="display : flex;" >
                                                                        <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Clôturer">
                                                                           <form action="{{route('cloturer.feedback', $sourcefg->id)}}" method="post">
                                                                                  {{csrf_field()}}
                                                                                  <input name="phase" value="2" hidden>
                                                                            <button type="submit" id="PopoverCustomT-1" style="background:#f8f9fa;border:#f8f9fa">
                                                                                <img src="{{asset('images/cancel1.png')}}" alt="" width="20px;" height="20px;">
                                                                            </button>
                                                                             </form>
                                                                        </span>
                                                                        </div> 
                                                            @elseif($sourcefg->phase == 2)
                                                                         &nbsp;<div class="align-middle" style="display : flex;" >
                                                                        <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Initialiser">
                                                                             <form action="{{route('initialiser.feedback', $sourcefg->id)}}" method="post">
                                                                                  {{csrf_field()}}
                                                                                  <input name="phase" value="1" hidden>
                                                                            <button type="submit" id="PopoverCustomT-1" style="background:#f8f9fa; border:#f8f9fa" disabled>
                                                                                <img src="{{asset('images/forward1.png')}}" alt="" width="20px;" height="20px;">
                                                                            </button>
                                                                             </form>
                                                                        </span>
                                                                        </div> 
                                                                        &nbsp;<div class="align-middle" style="display : flex;" >
                                                                        <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Clôturer">
                                                                           <form action="{{route('cloturer.feedback', $sourcefg->id)}}" method="post">
                                                                                  {{csrf_field()}}
                                                                                  <input name="phase" value="2" hidden>
                                                                            <button type="submit" id="PopoverCustomT-1" style="background:#f8f9fa;border:#f8f9fa" disabled>
                                                                                <img src="{{asset('images/cancel1.png')}}" alt="" width="20px;" height="20px;">
                                                                            </button>
                                                                             </form>
                                                                        </span>
                                                                        </div> 
                                                            @else
                                                                         &nbsp;<div class="align-middle" style="display : flex;" >
                                                                        <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Initialiser">
                                                                             <form action="{{route('initialiser.feedback', $sourcefg->id)}}" method="post">
                                                                                  {{csrf_field()}}
                                                                                  <input name="phase" value="1" hidden>
                                                                            <button type="submit" id="PopoverCustomT-1" style="background:#f8f9fa; border:#f8f9fa">
                                                                                <img src="{{asset('images/forward1.png')}}" alt="" width="20px;" height="20px;">
                                                                            </button>
                                                                             </form>
                                                                        </span>
                                                                        </div> 
                                                                        &nbsp;<div class="align-middle" style="display : flex;" >
                                                                        <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Clôturer">
                                                                           <form action="{{route('cloturer.feedback', $sourcefg->id)}}" method="post">
                                                                                  {{csrf_field()}}
                                                                                  <input name="phase" value="2" hidden>
                                                                            <button type="submit" id="PopoverCustomT-1" style="background:#f8f9fa;border:#f8f9fa" disabled>
                                                                                <img src="{{asset('images/cancel1.png')}}" alt="" width="20px;" height="20px;">
                                                                            </button>
                                                                             </form>
                                                                        </span>
                                                                        </div> 
                                                            @endif
                                                                     </td>
                                                                     <!-- <td class="align-middle" >
                                                                      <div class="align-middle" style="display : flex;" >
                                                                        <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip">
                                                                            <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"  href="{{route('voir_client.facilitateur', $client->entreprise_id)}}" >
                                                                                Voir
                                                                            </a>
                                                                        </span>
                                                                        </div> 
                                                                     </td>-->
                                                                   
                                                                  
                                                                 
                                                                <!--</form>-->
                                                            </tr>
                                            </tbody>
                                                   
                                    
                                                            
                                                             @endforeach

                                             
                                                                </tbody>
                                        </table>
                @php $facilitateurBackup = DB::table('facilitateurs')->where('user_id', Auth::user()->id)->first(); @endphp                      
                @if($facilitateurBackup->prenom == "ILLIMITIS")
                
                
                 <table class="table stylish-table no-wrap">
                                         <!--<thead>
                                            <tr>
                                                <th class="border-top-0">Nom client</th>
                                                <th class="border-top-0">Source</th>
                                                <th class="border-top-0">Nombre agents</th>
                                                 <th class="border-top-0">Feedbacks</th>
                                                 <th class="border-top-0">Actions</th>
                                                <th class="border-top-0">Actions de suivi</th>
                                                  <th class="border-top-0">Satisfaction</th>
                                                <th class="border-top-0">Options</th>

                                            </tr>
                                            </thead>
                                            <tbody>-->
                                           
                                            @foreach($facilitateur_backups as $client) 
                                                            <tr>
                                               
                                                @php $entreprise = DB::table('entreprises')->where('id', $client->entreprise_id)->orderBy('id', 'desc')->first(); @endphp
                                                @php $source_nom = DB::table('source_feedbacks')->where('id', $client->source_id)->orderBy('id', 'desc')->first(); @endphp
                                                @if($entreprise)
                                                <td class="align-middle" >
                                                    <div class="align-middle" >
                                                        {{$entreprise->libelle}} 
                                                    </div>
                                                </td>
                                                @else
                                                <td class="align-middle" >
                                                    <div class="align-middle" >
                                                        -- 
                                                    </div>
                                                </td>
                                                @endif
                                                @if($source_nom)
                                                <td class="align-middle" >
                                                    <div class="align-middle" >
                                                        {{$source_nom->nom_source}} 
                                                    </div>
                                                </td>
                                                @else
                                                <td class="align-middle" >
                                                    <div class="align-middle" >
                                                        -- 
                                                    </div>
                                                </td>
                                                @endif
                                                <!-- @php $departement = DB::table('departements')->where('id', $client->departement_id)->first(); @endphp  -->
                                                <!--@if($departement)-->
                                                <!--<td class="align-middle" >-->
                                                <!--    <div class="align-middle" >-->
                                                <!--        {{$departement->libelle}} -->
                                                <!--    </div>-->
                                                <!--</td>-->
                                                <!--@else-->
                                                <!--<td class="align-middle" >-->
                                                <!--    <div class="align-middle" >-->
                                                <!--        -- -->
                                                <!--    </div>-->
                                                <!--</td>-->
                                                <!--@endif-->
                                                @php $entreprise = DB::table('entreprises')->where('id', $client->entreprise_id)->first(); @endphp  
                                                @php $a = DB::table('agents')->where('entreprise', $entreprise->id)->orwhere('entreprise_2', $entreprise->id)->count(); @endphp 
                                                @php $aCheck = DB::table('agents')->where('check_entreprise', '=', 'SN')->where('check_2023', '=', 'SN')->count(); @endphp
                                                @php $aCheck_2023 = DB::table('agents')->where('check_2023', '=', 'SN')->where('entreprise', '=', 2)->count(); @endphp
                                                
                                                @if($client->source_id == 6)
                                                <td class="align-middle" >
                                                    <div class="align-middle" >
                                                        {{$aCheck}}  
                                                    </div>
                                                </td>
                                                @elseif($client->entreprise_id == 2)
                                                <td class="align-middle" >
                                                    <div class="align-middle" >
                                                        {{$aCheck_2023}}  
                                                    </div>
                                                </td>
                                                @else
                                                 <td class="align-middle" >
                                                    <div class="align-middle" >
                                                        {{$a}}  
                                                    </div>
                                                </td>
                                                @endif
                                               
                                                 <td class="align-middle" >
                                                     @php 
                                                     $feedback = DB::table('feedback')->where('source_id', $client->source_id)->where('choix', 'feedback')->count(); 
                                                     $feed = DB::table('feedback')->where('source_id', $client->source_id)->where('choix', 'feedback')->get();
                                                
                                                       $var = array();
                                                        foreach ($feed as $feeds){
                                                            $somme_note = $feeds->note;
                                                            array_push($var,$somme_note);
                                                           
                                                        }
                                                        $total_somme_note = array_sum($var);
                                                        $nb_note = count($var);
                                                        $notes = $nb_note == 0 ? 0 :  $total_somme_note / $nb_note;
                                                     @endphp
                                                    <div class="align-middle" >
                                                        {{$feedback}}
                                                    </div>
                                                </td>
                                                
                                                <td class="align-middle" >
                                                     @php
                                                       $actions = DB::table('actions')->where('source', $client->source_id)->get();
                                                    @endphp
                                                    <div class="align-middle" >
                                                       <a href="{{route('action_agent.lister', $client->source_id)}}"> {{count($actions)}} </a>
                                                    </div>
                                                </td>
                                             

                                                <td class="align-middle" >
                                                    <div class="align-middle" >
                                                        {{number_format($notes, 1, ',', '')}}/10
                                                    </div>
                                                </td>
                                              @php $dnow = date('Y-m-d'); @endphp
                                                                     
                                                                   <td class="align-middle" style="display:flex;">
                                                                      <div class="align-middle" style="display : flex;" >
                                                                          @php $sourcefg = DB::table('source_feedbacks')->where('id', $client->source_id)->first(); @endphp
                                                                          @if($sourcefg->phase == 2)
                                                                        <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Rapport">
                                                                           <button type="submit" id="PopoverCustomT-1"style="background:#f8f9fa; border:#f8f9fa">
                                                                            <a type="submit" href="{{route('voir_detail_client.facilitateur', $client->entreprise_id)}}" target="_blank">
                                                                                 <img src="{{asset('images/report(1).png')}}" alt="" width="20px;" height="20px;">
                                                                            </a>
                                                                            </button>
                                                                        </span>
                                                                        @else
                                                                        <span class="d-inline-block" tabindex="0" style="margin-right : 10%;">
                                                                           <button type="submit" id="PopoverCustomT-1"style="background:#f8f9fa; border:#f8f9fa" disabled>
                                                                           
                                                                                 <img src="{{asset('images/report(1).png')}}" alt="" width="20px;" height="20px;">
                                                                           
                                                                            </button>
                                                                        </span>
                                                                        @endif
                                                                        </div> 
                                                                         
                                                            @if($sourcefg->phase == 1)
                                                                        &nbsp;<div class="align-middle" style="display : flex;" >
                                                                        <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Initialiser">
                                                                             <form action="{{route('initialiser.feedback', $sourcefg->id)}}" method="post">
                                                                                {{csrf_field()}}
                                                                                <input name="phase" value="1" hidden>
                                                                            <button type="submit" id="PopoverCustomT-1" style="background:#f8f9fa; border:#f8f9fa" disabled>
                                                                                <img src="{{asset('images/forward1.png')}}" alt="" width="20px;" height="20px;">
                                                                            </button>
                                                                            </form>
                                                                        </span>
                                                                        </div> 
                                                                         &nbsp;<div class="align-middle" style="display : flex;" >
                                                                        <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Clôturer">
                                                                           <form action="{{route('cloturer.feedback', $sourcefg->id)}}" method="post">
                                                                                  {{csrf_field()}}
                                                                                  <input name="phase" value="2" hidden>
                                                                            <button type="submit" id="PopoverCustomT-1" style="background:#f8f9fa;border:#f8f9fa">
                                                                                <img src="{{asset('images/cancel1.png')}}" alt="" width="20px;" height="20px;">
                                                                            </button>
                                                                             </form>
                                                                        </span>
                                                                        </div> 
                                                            @elseif($sourcefg->phase == 2)
                                                                         &nbsp;<div class="align-middle" style="display : flex;" >
                                                                        <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Initialiser">
                                                                             <form action="{{route('initialiser.feedback', $sourcefg->id)}}" method="post">
                                                                                  {{csrf_field()}}
                                                                                  <input name="phase" value="1" hidden>
                                                                            <button type="submit" id="PopoverCustomT-1" style="background:#f8f9fa; border:#f8f9fa" disabled>
                                                                                <img src="{{asset('images/forward1.png')}}" alt="" width="20px;" height="20px;">
                                                                            </button>
                                                                             </form>
                                                                        </span>
                                                                        </div> 
                                                                        &nbsp;<div class="align-middle" style="display : flex;" >
                                                                        <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Clôturer">
                                                                           <form action="{{route('cloturer.feedback', $sourcefg->id)}}" method="post">
                                                                                  {{csrf_field()}}
                                                                                  <input name="phase" value="2" hidden>
                                                                            <button type="submit" id="PopoverCustomT-1" style="background:#f8f9fa;border:#f8f9fa" disabled>
                                                                                <img src="{{asset('images/cancel1.png')}}" alt="" width="20px;" height="20px;">
                                                                            </button>
                                                                             </form>
                                                                        </span>
                                                                        </div> 
                                                            @else
                                                                         &nbsp;<div class="align-middle" style="display : flex;" >
                                                                        <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Initialiser">
                                                                             <form action="{{route('initialiser.feedback', $sourcefg->id)}}" method="post">
                                                                                  {{csrf_field()}}
                                                                                  <input name="phase" value="1" hidden>
                                                                            <button type="submit" id="PopoverCustomT-1" style="background:#f8f9fa; border:#f8f9fa">
                                                                                <img src="{{asset('images/forward1.png')}}" alt="" width="20px;" height="20px;">
                                                                            </button>
                                                                             </form>
                                                                        </span>
                                                                        </div> 
                                                                        &nbsp;<div class="align-middle" style="display : flex;" >
                                                                        <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Clôturer">
                                                                           <form action="{{route('cloturer.feedback', $sourcefg->id)}}" method="post">
                                                                                  {{csrf_field()}}
                                                                                  <input name="phase" value="2" hidden>
                                                                            <button type="submit" id="PopoverCustomT-1" style="background:#f8f9fa;border:#f8f9fa" disabled>
                                                                                <img src="{{asset('images/cancel1.png')}}" alt="" width="20px;" height="20px;">
                                                                            </button>
                                                                             </form>
                                                                        </span>
                                                                        </div> 
                                                            @endif
                                                                     </td>
                                                                     <!-- <td class="align-middle" >
                                                                      <div class="align-middle" style="display : flex;" >
                                                                        <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip">
                                                                            <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"  href="{{route('voir_client.facilitateur', $client->entreprise_id)}}" >
                                                                                Voir
                                                                            </a>
                                                                        </span>
                                                                        </div> 
                                                                     </td>-->
                                                                   
                                                                  
                                                                 
                                                                <!--</form>-->
                                                            </tr>
                                            </tbody>
                                                   
                                    
                                                            
                                                             @endforeach

                                             
                                                                </tbody>
                                        </table>
                                @endif
        
        
            <!-- Revenue Card -->
        <!--<div class="row">-->
         
        <!--    <div class="col-xxl-4 col-xl-6">-->

        <!--      <div class="card info-card customers-card">-->

               

        <!--        <div class="card-body">-->
        <!--          <h5 class="card-title" style="color:#1561a2">Feedbacks reçus </h5>-->

        <!--          <div class="d-flex align-items-center">-->
        <!--             <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="black" class="bi bi-people" viewBox="0 0 16 16"><path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/></svg>-->
                    
        <!--            <div class="ps-3" style="color : #1561a2; font-size : 40px">00</div>-->
        <!--          </div>-->

        <!--        </div>-->
        <!--      </div>-->

        <!--    </div>-->
            <!-- End Revenue Card -->
           
            
                     
          
            
            <!-- End Revenue Card -->

            
          </div>
      
    </section>