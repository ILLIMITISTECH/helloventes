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
    
    
    
    <div class="container">
      @include('v2.header_dg')
      <main class="h-full pb-16 overflow-y-auto">

        <!--les formulaires-->
      
        <div class="container px-6 mx-auto grid">
            <br>
                                         <div class="col-md-3" align="right">
                                           
                                           <select name="search_a" class="form-select" aria-label="Default select example">
                                              
                                               <option value="">Filtrer</option>
                                              
                                               <option value="1">Contact de ce mois</option>
                                               <option value="3">Contact de cette semaine</option>
                                               <option value="2" >Tous les contacts</option>
                                             
                                           </select>
                                        </div> 
            <div id="tout">
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Mes contacts
          </h2>
                   @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif                     
          <div class="container" >
              @if($contacts->isEmpty()) 
                 	  <p class="dark:text-gray-400">Pas de contacts</p>
					 @else
            <div class="container">
              <table >
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3">Prénom / Nom </th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">N° téléphone</th>
                    <th class="px-4 py-3">Opportunités</th>
                    <th class="px-4 py-3">Entreprises</th>
                    <th class="px-4 py-3">Options</th>
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
                          <button type="button" class="btn btn-primary btn-lg btn-block font-semibold dark:text-gray-400">
                              {{strtoupper(($contact->prenom) ? $contact->prenom : '-')}} {{ strtoupper(($contact->nom) ? $contact->nom : '-')}} 
                          </button>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      {{ ($contact->email) ? $contact->email : '-'}} 
                    </td>
                     <td class="px-4 py-3 text-sm">
                      {{ ($contact->phone) ? $contact->phone : ''}}
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
                    
                   
                    <td class="px-4 py-3 text-sm">
                        <div style="display:flex ">
                      <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Modifier l'opportunité">
                      <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('contact.edit', $contact->id)}}" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                        </a>
                    </span>
                    <span style="margin-left:3px; height:28px;" class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Supprimer le contact">
                         <form action="{{ route('delete_contact.destroy', $contact->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                              <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                            </svg>
                            </button>
                        
                        </form>
                    </span>
                        </div>
                    </td>
                  </tr>

                </tbody>
                @endforeach 
              </table>
            </div>
             {{$contacts->links()}}
            @endif
          </div>
           </div>
          
       <div id="ceMois">     

     <div class="container px-6 mx-auto grid" >
       
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Mes contacts de ce mois
          </h2>
          @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif     
                @php
                    $mois = date('m');
                    $annee = date('Y'); 
                    $contact_mois = DB::table('contacts')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->paginate();
                @endphp
          <div class="container">
              @if($contact_mois->isEmpty()) 
                 	  <p class="dark:text-gray-400">Pas de contacts ce mois</p>
					 @else
            <div class="container">
              <table >
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3">Prénom / Nom </th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">N° téléphone</th>
                    <th class="px-4 py-3">Opportunités</th>
                    <th class="px-4 py-3">Entreprises</th>
                    <th class="px-4 py-3">Options</th>
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
                      {{ ($contact_m->phone) ? $contact_m->phone : ''}}
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
                    
                    <td class="px-4 py-3 text-sm">
                        <div style="display:flex ">
                      <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Modifier l'opportunité">
                      <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('contact.edit', $contact_m->id)}}" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                        </a>
                    </span>
                    
                    <span style="margin-left:3px; height:28px;" class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Supprimer le contact">
                         <form action="{{ route('delete_contact.destroy', $contact_m->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                              <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                            </svg>
                            </button>
                        
                        </form>
                    </span>
                        </div>
                    </td>
                  
                  </tr>

                </tbody>
                @endforeach 
              </table>
            </div>
             {{$contact_mois->links()}}
            @endif
          </div>
 </div>
  </div>

  
  
  <!----------------------------------------------------------------------cette semaine------------------------------------------------------->
   
   
     <div id="semaine">     

     <div class="container px-6 mx-auto grid" >
       
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Mes contacts de cette semaine
          </h2>
          @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif     
          @php
                    $semaineM7 = (date('d') -7);
                    $action_semaineP7 = (date('d') +7);
                    $action_mois = date('m');
                 @endphp
                @php
                    $mois = date('m');
                    $contact_semaine = DB::table('contacts')->where('commercial_id', $commercial->id)
                            ->whereDay('created_at', '<=', $action_semaineP7)
                            ->WhereDay('created_at', '>=', $semaineM7)
                            ->whereMonth('created_at', $action_mois)
                            ->whereYear('created_at', $annee)
                            ->paginate(10);
                @endphp
          <div class="container">
              @if($contact_semaine->isEmpty()) 
                 	  <p class="dark:text-gray-400">Pas de contacts cette semaine</p>
					 @else
            <div class="container">
              <table >
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3">Prénom / Nom </th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">N° téléphone</th>
                    <th class="px-4 py-3">Opportunités</th>
                    <th class="px-4 py-3">Entreprises</th>
                    <th class="px-4 py-3">Options</th>
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
                      {{ ($contact_s->phone) ? $contact_s->phone : ''}}
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
                     <td class="px-4 py-3 text-sm">
                         <div style="display:flex ">
                      <span class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Modifier l'opportunité">
                      <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('contact.edit', $contact_s->id)}}" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                        </a>
                    </span>
                   <span style="margin-left:3px; height:28px;" class="px-2 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" tabindex="0" style="margin-right : 5%;" data-toggle="tooltip" title="Supprimer le contact">
                         <form action="{{ route('delete_contact.destroy', $contact_s->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                              <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                            </svg>
                            </button>
                        
                        </form>
                    </span>
                        </div>
                    </td>
                  </tr>

                </tbody>
                @endforeach 
              </table>
            </div>
            {{$contact_semaine->links()}}
            @endif
          </div>
 </div>
  </div>

  
   
   
  
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
                        }
                        if($(this).attr("value")=="2"){
                            $("#tout").show();
                            $("#ceMois").hide();
                            $("#semaine").hide();
                        }
                        if($(this).attr("value")=="3"){
                            $("#semaine").show();
                            $("#tout").hide();
                            $("#ceMois").hide();
                        }
                        //enter other states
                       
                    });
                });  
            }); 

                </script>
</body>

</html>