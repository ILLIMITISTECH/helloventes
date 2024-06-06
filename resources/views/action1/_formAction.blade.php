<label class="block text-sm">
<span class="text-gray-700 dark:text-gray-400">
    Libellé
</span> (<span style=" color:red;">*</span>)
<input
    name="libelle"
     @if(isset($showAction))
     value="{{$showAction->libelle}}"
     @endif
    class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
    placeholder="Saisir le libellé de l'action" required/>
</label>
 <br>
@php 
    $today = date('Y-m-d'); 
@endphp
<label class="block text-sm">
    <span class="text-gray-700 dark:text-gray-400">
        Deadline
    </span> (<span style=" color:red;">*</span>)
    <input type="date"
        name="date" value="{{$today}}"
         @if(isset($showAction))
         value="{{$showAction->deadline}}"
         @endif
        class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
        placeholder="DD/MM/YYYY" required />
</label>


<!-- Valid input -->
<label class="block mt-4 text-sm">
    <span class="text-gray-700 dark:text-gray-400">
        Opportunité
    </span> 
    @if(isset($commercialOpportunites))
        @foreach($commercialOpportunites as $commercialOpportunite)
            @php $commercialId = $commercialOpportunite->commercial_id; @endphp
        @endforeach
    @endif
    
   <!-- <input type="hidden"
        name="commercialId"
         @if(isset($commercialId)) value="{{$commercialId}}"   @else  @endif
        class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"/>
        -->
         @php $respon = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first(); 
              $opp_tout = DB::table('opportunites')->where('superieur_id', $respon->id)->orderBy('libelle')->get();
              $prospectss_tout = DB::table('prospects')->where('superieur_id', $respon->id)->orderBy('nom_entreprise')->get();   
         @endphp
        @if(Auth::user()->nom_role == 'responsable')
            @if(isset($opp_tout))
            <select id="country" name="opportuniteId" 
                class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input">
                <option disabled selected>Selectionner l'opportunité </option> 
                @foreach($opp_tout as $opp_touts)
                <option value="{{$opp_touts->id}}">{{$opp_touts->libelle}}</option>
                @endforeach
            </select>
             @else  
             <input type="text"
                name="prospectLibelle"
                 value="{{$showAction->opportLibelle}}"
                class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input" readonly/>
          
            @endif
        @else
            @if(isset($commercialOpportunites))
            <select id="country" name="opportuniteId" 
                class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input">
                <option disabled selected>Selectionner l'opportunité</option> 
                @foreach($commercialOpportunites as $commercialOpportunite)
                <option value="{{$commercialOpportunite->id}}">{{$commercialOpportunite->libelle}}</option>
                @endforeach
            </select>
             @else  
             <input type="text"
                name="prospectLibelle"
                 value="{{$showAction->opportLibelle}}"
                class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input" readonly/>
          
            @endif
        @endif
        
         <label class="block mt-4 text-sm">
    <span class="text-gray-700 dark:text-gray-400">
        Prospect
    </span>
    @php $moi = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();
    $prospectss = DB::table('prospects')->where('commercial_id', $moi->id)->orderBy('nom_entreprise')->get(); @endphp
       @if(Auth::user()->nom_role == 'responsable')
       <select id="country" name="prospectId" 
            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input">
            <option disabled selected>Selectionner le prospect</option> 
            @foreach($prospectss_tout as $prospectss_touts)
            <option value="{{$prospectss_touts->id}}" >{{$prospectss_touts->nom_entreprise}}</option>
            @endforeach
        </select>
        @else
       <select id="country" name="prospectId" 
            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input">
            <option disabled selected>Selectionner le prospect</option> 
            @foreach($prospectss as $prospecte)
            <option value="{{$prospecte->id}}" >{{$prospecte->nom_entreprise}}</option>
            @endforeach
        </select>
        @endif
         <br>
                            <div class="form-control">
                                    <label class="block text-sm" >
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Responsable
                                        </span> (<span style=" color:red;">*</span>)
                                    </label>
                                    <select id="country" name="commercial_id" required 
                                        class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input" >
                                        <option value="" disabled selected >Sélectionner le responsable</option>
                                        @foreach($commercial as $commercials)
                                            <option value="{{$commercials->id}}">{{$commercials->prenom}} {{$commercials->nom}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            
                            <!--<div class="form-control">-->
                            <!--        <label class="block text-sm" >-->
                            <!--            <span class="text-gray-700 dark:text-gray-400">-->
                            <!--                c’est une sortie terrain ?-->
                            <!--            </span> (<span style=" color:red;">*</span>)-->
                            <!--        </label>-->
                            <!--        <select id="country" name="type" required -->
                            <!--            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input" >-->
                                        <!--<option value="" disabled selected >Sélectionner le responsable</option>-->
                            <!--            <option value="oui">oui</option>-->
                            <!--            <option value="non">non</option>-->
    
                            <!--        </select>-->
                            <!--</div>-->
     <br> 
    <div class="col-md-12">
        <label for="inputState" class="form-label required dark:text-gray-400">L'action est-elle prioritaire ? <b style="color:red;">*</b></label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="priorite" @if(isset($showAction)) @if($showAction->priorite === "1") checked @endif @endif value="1" >
          <label class="form-check-label dark:text-gray-400" for="exampleRadios1">
          Oui
          </label>
       </div>
       <div class="form-check">
          <input class="form-check-input" type="radio" name="priorite" @if(isset($showAction)) @if($showAction->priorite === "0") checked @endif @else checked  @endif value="0">
          <label class="form-check-label dark:text-gray-400" for="exampleRadios2">
          Non
          </label>
       </div> 
        
    </div>
    <br> 

    <!--<input-->
    <!--    class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"-->
    <!--    placeholder="Art du focus Priorité - Éfficacité - Productivité" />-->
</label>
<!--<label class="block mt-4 text-sm">-->
<!--    <span class="text-gray-700 dark:text-gray-400">-->
<!--        Résumé de l'action-->
<!--    </span>-->
<!--    <textarea name="resumer" class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input" id="exampleFormControlTextarea1" rows="3">@if(isset($showAction)){{$showAction->resume}} @endif</textarea>-->
<!--</label>-->
