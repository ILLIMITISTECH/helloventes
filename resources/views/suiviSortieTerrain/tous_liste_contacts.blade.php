<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hello Ventes</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('Koyalis/public/assets/css/tailwind.output.css')}}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <link rel="icon" href="{{asset('icones.png')}}" />

</head>

<body>
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
    <!-- Desktop sidebar -->
  @include('v2.side_bar_dg')
    
    <!-- Mobile sidebar -->
    <!-- Backdrop -->
    
    
    
    <div class="flex flex-col flex-1 w-full">
      @include('v2.header_dg')
      <main class="h-full pb-16 overflow-y-auto">
<br>
       <a data-toggle="tooltip" title="Retour" style="width:90px; margin-left:30px"  type="button" id="PopoverCustomT-1" class="nm" href="javascript:history.go(-1)" >
                   <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="nmj bi bi-arrow-left-circle" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                    </svg>
                </a>
                <style>
                    .nmj:hover{
                        background-color:#9045e2;
                        color:white;
                        border-radius:100px;
                    } 
                </style>
        <!--les formulaires-->
      
        <div class="container px-6 mx-auto grid">
            <br>
                                         <div class="col-md-3" align="right">
                                           
                                           <select name="search_a" class="form-select" aria-label="Default select example">
                                              
                                               <option value="">Filtrer</option>
                                              
                                               <option value="1">Contact de ce mois</option>
                                               <option value="3">Contact de cette semaine</option>
                                               <option value="4">Contact Sans email</option>
                                               <option value="5">Contact Sans téléphone mobile</option>
                                               <option value="2" >Tous les contacts</option>
                                             
                                           </select>
                                        </div> 
            <div id="tout">
                <div class="container px-6 mx-auto grid" >
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Tous les contacts
          </h2>
                                        
          <div class="w-full overflow-hidden rounded-lg shadow-xs" >
              @if($contacts->isEmpty()) 
                 	  <p>Pas de contacts</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3">Prénom / Nom </th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">N° téléphone</th>
                    <th class="px-4 py-3">Opportunités</th>
                    <th class="px-4 py-3">Entreprises</th>
                    <!--<th class="px-4 py-3">Options</th>-->
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($contacts as $contact) 
                  <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">

                      <div class="flex items-center text-sm">
                       
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                          <img class="object-cover w-full h-full rounded-full"
                            src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                            alt="" loading="lazy" />
                          <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                        <div>
                          <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">{{strtoupper(($contact->prenom) ? $contact->prenom : '-')}} {{ strtoupper(($contact->nom) ? $contact->nom : '-')}} 
                          </button>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      {{ ($contact->email) ? $contact->email : '-'}} 
                    </td>
                     <td class="px-4 py-3 text-sm">
                      {{ ($contact->phone) ? $contact->phone : '-'}}
                    </td>
                    @php $op = DB::table('opportunites')->where('id', $contact->opportunite_id)->first(); @endphp
                    @php $prospectt = DB::table('prospects')->where('id', $contact->prospect_id)->first(); @endphp
                    @if($op)
                     <td class="px-4 py-3 text-sm">
                      {{ ($op->libelle) ? $op->libelle : '-'}}
                    </td>
                     @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    @if($prospectt)
                    <td class="px-4 py-3 text-xs">
                    <a href="">
                      <span
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                         {{ ($prospectt->nom_entreprise) ? $prospectt->nom_entreprise : '-'}} 
                      </span></a>
                    </td>
                     @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    
                   
                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--  <input type="text" class="form-control" placeholder="+226 00 00 00 00" aria-label="Username"-->
                    <!--    aria-describedby="addon-wrapping">-->
                    <!--</td>-->
                  </tr>

                </tbody>
                @endforeach 
              </table>
            </div>

            @endif
          </div>
           </div>
            </div>
          
       <div id="ceMois">     

     <div class="container px-6 mx-auto grid" >
       
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Les contacts de ce mois
          </h2>
                @php
                    $mois = date('m');
                    $annee = date('Y');
                    $contact_mois = DB::table('contacts')->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->get();
                @endphp
          <div class="w-full overflow-hidden rounded-lg shadow-xs" >
              @if($contact_mois->isEmpty()) 
                 	  <p>Pas de contacts</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3">Prénom / Nom </th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">N° téléphone</th>
                    <th class="px-4 py-3">Opportunités</th>
                    <th class="px-4 py-3">Entreprises</th>
                    <!--<th class="px-4 py-3">Options</th>-->
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
               
                @foreach($contact_mois as $contact_m) 
                  <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">

                      <div class="flex items-center text-sm">
                       
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                          <img class="object-cover w-full h-full rounded-full"
                            src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                            alt="" loading="lazy" />
                          <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                        <div>
                          <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">{{strtoupper(($contact_m->prenom) ? $contact_m->prenom : '-')}} {{ strtoupper(($contact_m->nom) ? $contact_m->nom : '-')}} 
                          </button>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      {{ ($contact_m->email) ? $contact_m->email : '-'}} 
                    </td>
                     <td class="px-4 py-3 text-sm">
                      {{ ($contact_m->phone) ? $contact_m->phone : '-'}}
                    </td>
                    @php $op = DB::table('opportunites')->where('id', $contact_m->opportunite_id)->first(); @endphp
                    @php $prospectt = DB::table('prospects')->where('id', $contact_m->prospect_id)->first(); @endphp
                    @if($op)
                     <td class="px-4 py-3 text-sm">
                      {{ ($op->libelle) ? $op->libelle : '-'}}
                    </td>
                     @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    @if($prospectt)
                    <td class="px-4 py-3 text-xs">
                    <a href="">
                      <span
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                         {{ ($prospectt->nom_entreprise) ? $prospectt->nom_entreprise : '-'}} 
                      </span></a>
                    </td>
                     @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    
                   
                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--  <input type="text" class="form-control" placeholder="+226 00 00 00 00" aria-label="Username"-->
                    <!--    aria-describedby="addon-wrapping">-->
                    <!--</td>-->
                  </tr>

                </tbody>
                @endforeach 
              </table>
            </div>
          
            @endif
          </div>
 </div>
  </div>

  
  
  <!----------------------------------------------------------------------cette semaine------------------------------------------------------->
   
   
     <div id="semaine">     

     <div class="container px-6 mx-auto grid" >
       
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Les contacts de cette semaine
          </h2>
          @php
                    $semaineM7 = (date('d') -7);
                    $action_semaineP7 = (date('d') +7);
                    $action_mois = date('m');
                 @endphp
                @php
                    $mois = date('m');
                    $contact_semaine = DB::table('contacts')
                            ->whereDay('created_at', '<=', $action_semaineP7)
                            ->WhereDay('created_at', '>=', $semaineM7)
                            ->whereMonth('created_at', $action_mois)
                            ->whereYear('created_at', $annee)
                            ->get();
                @endphp
          <div class="w-full overflow-hidden rounded-lg shadow-xs" >
              @if($contact_semaine->isEmpty()) 
                 	  <p>Pas de contacts</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3">Prénom / Nom </th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">N° téléphone</th>
                    <th class="px-4 py-3">Opportunités</th>
                    <th class="px-4 py-3">Entreprises</th>
                    <!--<th class="px-4 py-3">Options</th>-->
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
               
                @foreach($contact_semaine as $contact_s) 
                  <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">

                      <div class="flex items-center text-sm">
                       
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                          <img class="object-cover w-full h-full rounded-full"
                            src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                            alt="" loading="lazy" />
                          <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                        <div>
                          <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">{{strtoupper(($contact_s->prenom) ? $contact_s->prenom : '-')}} {{ strtoupper(($contact_s->nom) ? $contact_s->nom : '-')}} 
                          </button>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      {{ ($contact_s->email) ? $contact_s->email : '-'}} 
                    </td>
                     <td class="px-4 py-3 text-sm">
                      {{ ($contact_s->phone) ? $contact_s->phone : '-'}}
                    </td>
                    @php $op = DB::table('opportunites')->where('id', $contact_s->opportunite_id)->first(); @endphp
                    @php $prospectt = DB::table('prospects')->where('id', $contact_s->prospect_id)->first(); @endphp
                    @if($op)
                     <td class="px-4 py-3 text-sm">
                      {{ ($op->libelle) ? $op->libelle : '-'}}
                    </td>
                     @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    @if($prospectt)
                    <td class="px-4 py-3 text-xs">
                    <a href="">
                      <span
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                         {{ ($prospectt->nom_entreprise) ? $prospectt->nom_entreprise : '-'}} 
                      </span></a>
                    </td>
                     @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    
                   
                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--  <input type="text" class="form-control" placeholder="+226 00 00 00 00" aria-label="Username"-->
                    <!--    aria-describedby="addon-wrapping">-->
                    <!--</td>-->
                  </tr>

                </tbody>
                @endforeach 
              </table>
            </div>
            
            @endif
          </div>
 </div>
  </div>

  <!---------------------------------------------------------------------------------------------------------------------->
   
   <div id="sansmail">
                <div class="container px-6 mx-auto grid" >
                    @php  $nbre_contact_Smail = DB::table('contacts')
                            ->where('email', null)->count();  
             @endphp
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
               {{number_format(($nbre_contact_Smail)) ? number_format($nbre_contact_Smail) : '0'}} 
                      contacts sans email
            <!--<div style="margin-left:500px; background-color:#0093a2">-->
                   
                      <!--</div>-->
          </h2>
             @php    $contact_Smail = DB::table('contacts')
                            ->where('email', null)->get();  
                   
             @endphp
          <div class="w-full overflow-hidden rounded-lg shadow-xs" >
              @if($contact_Smail->isEmpty()) 
                 	  <p>Pas de contacts sans email</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3">Prénom / Nom </th>
                    <!--<th class="px-4 py-3">Email</th>-->
                    <th class="px-4 py-3">N° téléphone</th>
                    <th class="px-4 py-3">Opportunités</th>
                    <th class="px-4 py-3">Entreprises</th>
                    <!--<th class="px-4 py-3">Options</th>-->
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($contact_Smail as $contact_Sm) 
                  <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">

                      <div class="flex items-center text-sm">
                       
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                          <img class="object-cover w-full h-full rounded-full"
                            src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                            alt="" loading="lazy" />
                          <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                        <div>
                          <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">{{strtoupper(($contact_Sm->prenom) ? $contact_Sm->prenom : '-')}} {{ strtoupper(($contact_Sm->nom) ? $contact_Sm->nom : '-')}} 
                          </button>
                        </div>
                      </div>
                    </td>
                   
                     <td class="px-4 py-3 text-sm">
                      {{ ($contact_Sm->phone) ? $contact_Sm->phone : '-'}}
                    </td>
                    @php $op = DB::table('opportunites')->where('id', $contact_Sm->opportunite_id)->first(); @endphp
                    @php $prospectt = DB::table('prospects')->where('id', $contact_Sm->prospect_id)->first(); @endphp
                    @if($op)
                     <td class="px-4 py-3 text-sm">
                      {{ ($op->libelle) ? $op->libelle : '-'}}
                    </td>
                     @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    @if($prospectt)
                    <td class="px-4 py-3 text-xs">
                    <a href="">
                      <span
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                         {{ ($prospectt->nom_entreprise) ? $prospectt->nom_entreprise : '-'}} 
                      </span></a>
                    </td>
                     @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    
                   
                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--  <input type="text" class="form-control" placeholder="+226 00 00 00 00" aria-label="Username"-->
                    <!--    aria-describedby="addon-wrapping">-->
                    <!--</td>-->
                  </tr>

                </tbody>
                @endforeach 
              </table>
            </div>

            @endif
          </div>
           </div>
            </div>
          <!---------------------------------------------------------------------------------------------->
  <div id="sansphone">
                <div class="container px-6 mx-auto grid" >
                     @php    $nbre_contact_Smail = DB::table('contacts')
                            ->where('phone', null)->count();    
             @endphp
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{number_format(($nbre_contact_Smail)) ? number_format($nbre_contact_Smail) : '0'}}  contacts sans téléphone mobile
          </h2>
             @php    $contact_Smail = DB::table('contacts')
                            ->where('phone', null)->get();    
             @endphp
          <div class="w-full overflow-hidden rounded-lg shadow-xs" >
              @if($contact_Smail->isEmpty()) 
                 	  <p>Pas de contacts sans téléphone mobile</p>
					 @else
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3">Prénom / Nom </th>
                    <th class="px-4 py-3">Email</th>
                    <!--<th class="px-4 py-3">N° téléphone</th>-->
                    <th class="px-4 py-3">Opportunités</th>
                    <th class="px-4 py-3">Entreprises</th>
                    <!--<th class="px-4 py-3">Options</th>-->
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($contact_Smail as $contact_Sm) 
                  <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">

                      <div class="flex items-center text-sm">
                       
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                          <img class="object-cover w-full h-full rounded-full"
                            src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                            alt="" loading="lazy" />
                          <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                        <div>
                          <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">{{strtoupper(($contact_Sm->prenom) ? $contact_Sm->prenom : '-')}} {{ strtoupper(($contact_Sm->nom) ? $contact_Sm->nom : '-')}} 
                          </button>
                        </div>
                      </div>
                    </td>
                   
                     <td class="px-4 py-3 text-sm">
                      {{ ($contact_Sm->email) ? $contact_Sm->email : '-'}}
                    </td>
                    @php $op = DB::table('opportunites')->where('id', $contact_Sm->opportunite_id)->first(); @endphp
                    @php $prospectt = DB::table('prospects')->where('id', $contact_Sm->prospect_id)->first(); @endphp
                    @if($op)
                     <td class="px-4 py-3 text-sm">
                      {{ ($op->libelle) ? $op->libelle : '-'}}
                    </td>
                     @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    @if($prospectt)
                    <td class="px-4 py-3 text-xs">
                    <a href="">
                      <span
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                         {{ ($prospectt->nom_entreprise) ? $prospectt->nom_entreprise : '-'}} 
                      </span></a>
                    </td>
                     @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    
                   
                    <!--<td class="px-4 py-3 text-sm">-->
                    <!--  <input type="text" class="form-control" placeholder="+226 00 00 00 00" aria-label="Username"-->
                    <!--    aria-describedby="addon-wrapping">-->
                    <!--</td>-->
                  </tr>

                </tbody>
                @endforeach 
              </table>
            </div>

            @endif
          </div>
           </div>
            </div>
          <!---------------------------------------------------------------------------------------------->
  
        </div>
    </div>
    
    
    <!-----------------------------------------------------------------------contact de ce mois---------------------------------------------------------------->
    
    

    
    
    </main>
  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/init-alpine.js')}}"></script>
  <script src="{{asset('Koyalis/public/https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js')}}" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/charts-lines.js')}}" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/charts-pie.js')}}" defer></script>
               <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <script>
            $("#ceMois").hide();
            $("#tout").hide();
            $("#sansmail").hide();
            $("#sansphone").hide();
            </script>
             <script>
            $(document).ready(function(){
              $("select").change(function(){
                    $( "select option:selected").each(function(){
                        //enter bengal districts
                        if($(this).attr("value")=="1"){
                            $("#tout").hide();
                            $("#semaine").hide();
                            $("#ceMois").show();
                            $("#sansmail").hide();
                            $("#sansphone").hide();
                        }
                        if($(this).attr("value")=="2"){
                            $("#tout").show();
                            $("#ceMois").hide();
                            $("#semaine").hide();
                            $("#sansmail").hide();
                            $("#sansphone").hide();
                        }
                        if($(this).attr("value")=="3"){
                            $("#semaine").show();
                            $("#tout").hide();
                            $("#ceMois").hide();
                            $("#sansmail").hide();
                            $("#sansphone").hide();
                        }
                        if($(this).attr("value")=="4"){
                            $("#tout").hide();
                            $("#semaine").hide();
                            $("#ceMois").hide();
                            $("#sansmail").show();
                            $("#sansphone").hide();
                        }
                        if($(this).attr("value")=="5"){
                            $("#tout").hide();
                            $("#semaine").hide();
                            $("#sansphone").show();
                            $("#ceMois").hide();
                            $("#sansmail").hide();
                        }
                        //enter other states
                       
                    });
                });  
            }); 

                </script>
</body>

</html>