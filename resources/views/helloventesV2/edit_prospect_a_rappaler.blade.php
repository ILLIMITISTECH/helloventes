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
                <!--Rechercher dans ILLIMITIS ILLIMITIS Christianna from ILLIMITIS Christianna from ILLIMITIS  Christianna from ILLIMITIS 11 h 20 ajouteropportunuit.txt-->

                <div class="container px-6 mx-auto grid">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                       Modifier les informationsRésultats de l'appel / Mise à jour du prospect
                    </h2>
                  
                    <!-- General elements -->
             
                    <!-- Validation inputs -->
                    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <!-- Invalid input -->
                        <form action="{{route('prospect_a_rappaler.update', $entreprise->id)}}" method="post" class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload" enctype="multipart/form-data">
                                                     @csrf
                
                 <div class="form-group" >
                            <div class="form-control">
                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Résultats de l'appel 
                                        </span> 
                                    </label>
                        
                                   <select name="type"  style="width:400px;"  id="types" class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input" style="width:400px;">
                                      <option value="" disabled selected>Selectionner les résultats </option>
                                      @foreach($resultat as $resultats)
                                      <option value="{{$resultats->id}}">{{$resultats->libelle}}</option>
                                      @endforeach
                                    </select>
                                
                            </div>
                            
                       
              
                            <!------------------1--------------qualifier------------------------>
                         <div class="1 row" id="qualifier">
                             <br>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" value="Rendez-vous obtenu" name="choix_qualifier" id="100000" >
                              <label class="form-check-label" for="flexRadioDefault1">
                                Rendez-vous obtenu
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" value="Demande de dépot d'une offre de service" type="radio" name="choix_qualifier" id="200000" >
                              <label class="form-check-label" for="flexRadioDefault2">
                                Demande de dépot d'une offre de service
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" value="Dépôt d'une demande d'agrément" type="radio" name="choix_qualifier" id="300000" >
                              <label class="form-check-label" for="flexRadioDefault2">
                                Dépôt d'une demande d'agrément
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" value="Manifestation/confirmation d'interet" type="radio" name="choix_qualifier" id="400000" >
                              <label class="form-check-label" for="flexRadioDefault2">
                                Manifestation/confirmation d'interet
                              </label>
                            </div>
                    </div>
                    
                    <!-----------------------------100000----rv------------------------------------->
                        <div class="4 row" id="rv"><br>
                        <div class="form-group" style="display:flex;">
                            <div class="form-control">
                                      <label class="block text-sm" style="width:400px;">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            La date du rendez-vous  
 
                                        </span> 
                                        <input  name="date_rendezvous" type="date" 
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"
                                             style="width:400; " />
                                    </label>
                            </div> <br>
                             <div class="form-control">
                            
                                      <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400" style="margin-left:50px;">
                                          Lieu 
                                        </span> 
                                        <input  name="lieu_rv" type="text" style="margin-left:50px;width:400px;"
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"
                                          />
                                    </label>
                            </div>
                            </div>
                             <div class="form-group" style="display:flex;">
                           
                            <div class="form-control">
                                    <label class="block text-sm" >
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Personnes
                                        </span>
                                        <input type="text" name="personne_rv" 
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                             style="width:400px;" />
                                    </label>
                            </div>
                            
                            <div class="form-control">
                                    <label class="block text-sm" >
                                        <span class="text-gray-700 dark:text-gray-400" style="margin-left:50px;">
                                            Contact de la personne 
                                        </span>
                                        <input  name="contact_rv" type="text" style="margin-left:50px;width:400px;"
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"
                                          />
                                    </label>
                            </div>
                        </div>
                        <div class="form-control">
                                    <label class="block text-sm" >
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Heure
                                        </span>
                                        <input type="time" name="heure_rv" 
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                             style="width:400px;" />
                                    </label>
                            </div>
                        </div>
                        <br>
                    <!--------------------------------------date_depot_offre-------------------------------->
                    <div class="row" id="date_depot">
                        <div class="form-control">
                                      <label class="block text-sm" style="width:400px;">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Date de dépôt prévue
                                        </span> 
                                        <input  name="date_depot_offre" type="date" 
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"
                                             style="width:400; " />
                                    </label>
                            </div> 
                    </div>
                    <!--------------------------------------date_depot_agreement-------------------------------->
                    <div class="row" id="date_depot_agreement">
                        <div class="form-control">
                                      <label class="block text-sm" style="width:400px;">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Date de dépôt prévue
                                        </span> 
                                        <input  name="date_depot_agreement" type="date" 
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"
                                             style="width:400; " />
                                    </label>
                            </div> 
                    </div>
                        <!--------------------------------commercial_suivi---------------------------------------->
                    <div class="form-group" style="display:flex;">
                        <div class="row" id="commercial_suivi">
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400" >
                                    Assigner à un lead commercial pour suivi (<span style=" color:red;">*</span>)
                                </span>
                            <select id="country" name="commercial_suivi" style="width:400px;"
                                class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input">
                            <option value="" selected>Sélectionner le nouveau responsable </option>
                                @foreach($commercial as $commercials)
                                <option value="{{$commercials->id}}" >{{$commercials->prenom}} {{$commercials->nom}}</option>
                                @endforeach
                            </select>
                            </label>
                        </div>
                    <!--------------------------------commentaire---------------------------------------->
                        <div class="form-control" id="commentaire_qualifier">
                            <label class="block text-sm" style="margin-left:50px;width:400;">
                            <span class="text-gray-700 dark:text-gray-400">
                                Commentaires
                            </span>
                            <textarea class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                name="commentaire_qualifier" id="w3review" name="w3review" rows="2" cols="50" style="width:400px; border:solid 1px black;"></textarea>
                                            
                            </label>
                        </div>
                    </div>
                    <!------------------------------------------------------------------------------------------>
                    <!--------------------5--------------rappeler------------------------->
                    <div class="row" id="rappeler">
                        <br>
                       
                       <div class="form-check">
                          <input class="form-check-input" type="radio" value="Demande du prospect" name="choix_a_rappeler" id="1000000" >
                          <label class="form-check-label" for="flexRadioDefault1">
                            Demande du prospect
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="Indisponibilité" name="choix_a_rappeler" id="2000000"  >
                          <label class="form-check-label" for="flexRadioDefault2">
                            Indisponibilité
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="Pas de réponse" name="choix_a_rappeler" id="3000000" >
                          <label class="form-check-label" for="flexRadioDefault3">
                            Pas de réponse
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="Numéro incorrect / a vérifier" name="choix_a_rappeler" id="4000000"  >
                          <label class="form-check-label" for="flexRadioDefault4">
                            Numéro incorrect / a vérifier
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="Rendez-vous à confirmer" name="choix_a_rappeler" id="5000000" >
                          <label class="form-check-label" for="flexRadioDefault5">
                            Rendez-vous à confirmer 
                          </label>
                        </div>
                    </div>
                     <!-----------------------------5-------------------------rappeler-------------------->
                    <div class="4 row" id="demande_r"><br>
                        <div class="form-group" style="display:flex;">
                            <div class="form-control">
                                      <label class="block text-sm" style="width:400px;">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Préciser la demande 
 
                                        </span> 
                                        <input  name="demande_rappel" type="text" 
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"
                                             style="width:400; " />
                                    </label>
                            </div> <br>
                             <div class="form-control">
                            
                                      <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400" style="margin-left:50px;">
                                          Les besoins 
                                        </span> 
                                        <input  name="besoin_rappel" type="text" style="margin-left:50px;width:400px;"
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"
                                          />
                                    </label>
                            </div>
                        </div>
                    </div>
                    @php 
                    
                     $weekday = " ";
            
                        $saturday = strtotime('monday this week');
                        
                        
                        foreach (range(0,0) as $day) {
                            $weekday = date("Y-m-d", (($day * 86400) + $saturday));
                        }
          
                        $samedi = (date('d', strtotime($weekday)) + 5);
                        $dimanche = (date('d', strtotime($weekday)) + 6);
                                $deadline = date('Y-m-d'); 
                                                    $today = now();
                           
                            $strotime_deadline = strtotime($today .'+' . 3 . ' days');
                            $date_deadline = date('Y-m-d', $strotime_deadline);
                            
                             if(date('d', strtotime($date_deadline)) == $samedi){
                            $strotime_deadline = strtotime($date_deadline .'+' . 2 . ' days');
                            $date_deadline = date('Y-m-d', $strotime_deadline);
                            }
                            elseif(date('d', strtotime($date_deadline)) == $dimanche){
                            $strotime_deadline = strtotime($date_deadline .'+' . 1 . ' days');
                            $date_deadline = date('Y-m-d', $strotime_deadline);
                            } 
                        @endphp
                    <div class="4 row" id="date_r"><br>
                        <div class="form-control">
                                      <label class="block text-sm" style="width:400px;">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Date de rappel prévue 
 
                                        </span> 
                                        <input  name="date_rappel" type="date" value="{{$date_deadline}}" 
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"
                                             style="width:400; " />
                                    </label>
                            </div> 
                    </div>
                    <!-----------------------------2-------------------------nonqualifier-------------------->
                    
                    <div class="2 row" id="nonqualifier">
                        <br>
                       
                       <div class="form-check">
                          <input class="form-check-input" type="radio" value="Pas interessé(e)" name="choix_non_qualifier" id="10000000" >
                          <label class="form-check-label" for="flexRadioDefault1">
                            Pas interessé(e)
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="Pas de réponse après 10 appels" name="choix_non_qualifier" id="20000000"  >
                          <label class="form-check-label" for="flexRadioDefault2">
                            Pas de réponse après 10 appels
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="Pas de budget" name="choix_non_qualifier" id="30000000"  >
                          <label class="form-check-label" for="flexRadioDefault2">
                            Pas de budget
                          </label>
                        </div>

                    </div>
                        <!-----------------------------2-------------------------nonqualifier-------------------->
                    <div class="4 row" id="raison_nonqualifier"><br>
                            <div class="form-control">
                                      <label class="block text-sm" style="width:400px;">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Renseigner les raisons
 
                                        </span> 
                                        <input  name="raison_no_qualifier" type="text" 
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"
                                             style="width:400; " />
                                    </label>
                            </div> <br>
                    </div>
                    <div class="4 row" id="date_prevoyer"><br>
                        <div class="form-control">
                                      <label class="block text-sm" style="width:400px;">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Renseigner la date de relance que vous prévoyez
 
                                        </span> 
                                        <input  name="date_relance_noqualifier" type="date" 
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"
                                             style="width:400; " />
                                    </label>
                            </div> 
                    </div>
                    <!------------------------------------------------------------------------->
                    
                    <!--      <br>-->
                    <!--<div class="form-group" style="display:flex;">-->
                    <!--    <label class="block text-sm">-->
                    <!--        <span class="text-gray-700 dark:text-gray-400">-->
                    <!--            Nom entreprise -->
                    <!--        </span>-->
                    <!--        <input name="nom_entreprise" type="text" style="width:400px;" value="{{$entreprise->nom_entreprise}}"-->
                    <!--            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"-->
                    <!--            placeholder="Libellé de l'action" />-->
                    <!--    </label>	-->
                        
                    <!--    <label class="block text-sm">-->
                    <!--        <span class="text-gray-700 dark:text-gray-400" style="margin-left:50px;">-->
                    <!--            Email entreprise -->
                    <!--        </span>-->
                    <!--        <input name="email_entreprise" type="email" style="margin-left:50px;width:400px;" value="{{$entreprise->email_entreprise}}"-->
                    <!--            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"-->
                    <!--            placeholder="email..." />-->
                    <!--    </label>-->
                    <!--</div>-->
                    
                    <!--<br>-->
                    <!--<div class="form-group" style="display:flex;">-->
                    <!--     <label class="block text-sm">-->
                    <!--        <span class="text-gray-700 dark:text-gray-400">-->
                    <!--            N° de téléphone fixe-->
                    <!--        </span>-->
                    <!--        <input name="tel_fixe" type="text" style="width:400px;" value="{{$entreprise->tel_fixe}}"-->
                    <!--            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"-->
                    <!--            placeholder="+2..." />-->
                    <!--    </label>-->
                    <!--     <label class="block text-sm">-->
                    <!--        <span class="text-gray-700 dark:text-gray-400" style="margin-left:50px;">-->
                    <!--             N° de téléphone contact -->
                    <!--        </span>-->
                    <!--        <input name="tel_contact" type="tetx" style="margin-left:50px;width:400px;" value="{{$entreprise->tel_contact}}"-->
                    <!--            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"-->
                    <!--            placeholder="+2......" />-->
                    <!--    </label>-->
                    <!--</div>-->
                    
                    <!--<br>-->
                    <!--<div class="form-group" style="display:flex;">-->
                    <!--    <label class="block text-sm">-->
                    <!--        <span class="text-gray-700 dark:text-gray-400" >-->
                    <!--            Besoins prioritaires-->
                    <!--        </span>-->
                    <!--        <input name="besoin_prioritaire" type="text" style="width:400px;" value="{{$entreprise->besoin_prioritaire}}"-->
                    <!--            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"-->
                    <!--            placeholder="Besoins prioritaires" />-->
                    <!--    </label>-->
                    <!--    <label class="block text-sm">-->
                    <!--        <span class="text-gray-700 dark:text-gray-400" style="margin-left:50px;">-->
                    <!--            Autres besoins -->
                    <!--        </span>-->
                    <!--        <input name="autre_besoins" type="text" style="margin-left:50px;width:400px;" value="{{$entreprise->autre_besoins}}"-->
                    <!--            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"-->
                    <!--            placeholder="Autres besoins" />-->
                    <!--    </label>-->
                    <!--</div>-->
                        <!--<div class="form-control">-->
                        <!--<label class="block mt-4 text-sm">-->
                        <!--    <span class="text-gray-700 dark:text-gray-400">-->
                        <!--        Probabilité :   <span id="demo" class="px-2 py-1 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"></span>-->
                        <!--    </span>-->
                         
                        <!--     <input type="range" name="probabilite" value="{{$entreprise->probabilite}}" class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 form-range" -->
                        <!--        min="0" max="100" value="0" step="10"  id="customRange3" style="width:400px; margin-left:10px;">-->
                        <!--</label>-->
                        <!--</div>-->
                        
                        
                    <!--<br>-->
                    <!--<div class="form-group" style="display:flex;">-->
                    <!--   
                    <!--    <label class="block text-sm">-->
                    <!--        <span class="text-gray-700 dark:text-gray-400" style="margin-left:50px;">-->
                    <!--            Responsable -->
                    <!--        </span>-->
                    <!--    @php $com = DB::table('commerciaus')->where('id', $entreprise->commercial_id)->first(); @endphp-->
                    <!--    <select id="country" name="commercial_id" style="margin-left:50px;width:400px;"-->
                    <!--        class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input">-->
                    <!--    @if($com)   <option value="{{$entreprise->commercial_id}}" >{{$com->prenom}} {{$com->nom}}</option>-->
                    <!--    @else <option value="" selected>Sélectionner le nouveau responsable </option>-->
                    <!--    @endif-->
                    <!--        @foreach($commercial as $commercials)-->
                    <!--        <option value="{{$commercials->id}}" >{{$commercials->prenom}} {{$commercials->nom}}</option>-->
                    <!--        @endforeach-->
                    <!--    </select>-->
                    <!--    </label>-->
                    <!--</div>-->
                        <!--<label class="block text-sm">-->
                        <!--    <span class="text-gray-700 dark:text-gray-400">-->
                        <!--        Logo : (télécharger le logo)-->
                        <!--    </span>-->
                        <!--    <input name="logo" type="file"  value="{{$entreprise->logo}}"-->
                        <!--        class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"-->
                        <!--        placeholder="Libellé de l'action" />-->
                        <!--</label>-->
                    
                      <br>
                           
                           
                            <div style="margin-top: 3em;">
    
                                <button
                                    class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                    Mettre à jour
                                </button>
                                </form>
                              
                            </div>
                        
                    </div>
                    <!-- Inputs with icons -->
              
                </div>
                <!-- Réduire Envoyer un message Christianna from ILLIMITIS Maj+Retour pour ajouter une nouvelle ligne-->
        </div>
        </main>
    </div>
    </div>
                           
        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
    <script src="{{asset('v2/main.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>              
          
            <footer class="footer">
                © Made with love and Passion by <a href="https://www.illimitis.com/">ILLIMITIS</a>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('assets/plugins/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{asset('Koyalis/public/assets/js/init-alpine.js')}}"></script>
    <script src="{{asset('Koyalis/public/https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js')}}" defer></script>
    <script src="{{asset('Koyalis/public/assets/js/charts-lines.js')}}" defer></script>
    <script src="{{asset('Koyalis/public/assets/js/charts-pie.js')}}" defer></script>
    
    
       <script>
        class MultiInput extends HTMLElement {
  constructor() {
    super();
    // This is a hack :^(.
    // ::slotted(input)::-webkit-calendar-picker-indicator doesn't work in any browser.
    // ::slotted() with ::after doesn't work in Safari.
    this.innerHTML +=
    `<style>
    multi-input input::-webkit-calendar-picker-indicator {
      display: none;
    }
    /* NB use of pointer-events to only allow events from the × icon */
    multi-input div.item::after {
      color: black;
      content: '×';
      cursor: pointer;
      font-size: 18px;
      pointer-events: auto;
      position: absolute;
      right: 5px;
      top: -1px;
    }

    </style>`;
    this._shadowRoot = this.attachShadow({mode: 'open'});
    this._shadowRoot.innerHTML =
    `<style>
    :host {
      border: var(--multi-input-border, 1px solid #ddd);
      display: block;
      overflow: hidden;
      padding: 5px;
    }
    /* NB use of pointer-events to only allow events from the × icon */
    ::slotted(div.item) {
      background-color: var(--multi-input-item-bg-color, #dedede);
      border: var(--multi-input-item-border, 1px solid #ccc);
      border-radius: 2px;
      color: #222;
      display: inline-block;
      font-size: var(--multi-input-item-font-size, 14px);
      margin: 5px;
      padding: 2px 25px 2px 5px;
      pointer-events: none;
      position: relative;
      top: -1px;
    }
    /* NB pointer-events: none above */
    ::slotted(div.item:hover) {
      background-color: #eee;
      color: black;
    }
    ::slotted(input) {
      border: none;
      font-size: var(--multi-input-input-font-size, 14px);
      outline: none;
      padding: 10px 10px 10px 5px; 
    }
    </style>
    <slot></slot>`;

    this._datalist = this.querySelector('datalist');
    this._allowedValues = [];
    for (const option of this._datalist.options) {
      this._allowedValues.push(option.value);
    }

    this._input = this.querySelector('input');
    this._input.onblur = this._handleBlur.bind(this);
    this._input.oninput = this._handleInput.bind(this);
    this._input.onkeydown = (event) => {
      this._handleKeydown(event);
    };

    this._allowDuplicates = this.hasAttribute('allow-duplicates');
  }

  // Called by _handleKeydown() when the value of the input is an allowed value.
  _addItem(value) {
    this._input.value = '';
    const item = document.createElement('div');
    item.classList.add('item');
    item.textContent = value;
    this.insertBefore(item, this._input);
    item.onclick = () => {
      this._deleteItem(item);
    };

    // Remove value from datalist options and from _allowedValues array.
    // Value is added back if an item is deleted (see _deleteItem()).
    if (!this._allowDuplicates) {
      for (const option of this._datalist.options) {
        if (option.value === value) {
          option.remove();
        };
      }
      this._allowedValues =
      this._allowedValues.filter((item) => item !== value);
    }
  }

  // Called when the × icon is tapped/clicked or
  // by _handleKeydown() when Backspace is entered.
  _deleteItem(item) {
    const value = item.textContent;
    item.remove();
    // If duplicates aren't allowed, value is removed (in _addItem())
    // as a datalist option and from the _allowedValues array.
    // So — need to add it back here.
    if (!this._allowDuplicates) {
      const option = document.createElement('option');
      option.value = value;
      // Insert as first option seems reasonable...
      this._datalist.insertBefore(option, this._datalist.firstChild);
      this._allowedValues.push(value);
    }
  }

  // Avoid stray text remaining in the input element that's not in a div.item.
  _handleBlur() {
    this._input.value = '';
  }

  // Called when input text changes,
  // either by entering text or selecting a datalist option.
  _handleInput() {
    // Add a div.item, but only if the current value
    // of the input is an allowed value
    const value = this._input.value;
    if (this._allowedValues.includes(value)) {
      this._addItem(value);
    }
  }

  // Called when text is entered or keys pressed in the input element.
  _handleKeydown(event) {
    const itemToDelete = event.target.previousElementSibling;
    const value = this._input.value;
    // On Backspace, delete the div.item to the left of the input
    if (value ==='' && event.key === 'Backspace' && itemToDelete) {
      this._deleteItem(itemToDelete);
    // Add a div.item, but only if the current value
    // of the input is an allowed value
    } else if (this._allowedValues.includes(value)) {
      this._addItem(value);
    }
  }

  // Public method for getting item values as an array.
  getValues() {
    const values = [];
    const items = this.querySelectorAll('.item');
    for (const item of items) {
      values.push(item.textContent);
    }
    return values;
  }
}

window.customElements.define('multi-input', MultiInput);

            
        </script>






		
		
		<!--<script type="text/javascript">-->
  <!--          $(document).ready(function() {-->
  <!--              $('input[type="checkbox"]').click(function() {-->
  <!--                  var inputValue = $(this).attr("value");-->
  <!--                  $("." + inputValue).toggle();-->
                    <!--/*alert("Checkbox " + inputValue + " is selected");*/-->
  <!--              });-->
  <!--          });-->
  <!--      </script>-->
<script>
		    $("#qualifier").hide();
		    $("#rappeler").hide();
		    $("#nonqualifier").hide();
		    $("#rv").hide();
		    $("#date_depot_agreement").hide();
		    $("#date_depot").hide();
		    $("#commercial_suivi").hide();
		    $("#date_r").hide();
		    $("#commentaire_qualifier").hide();
		    $("#demande_r").hide();
		    $("#raison_nonqualifier").hide();
		    $("#date_prevoyer").hide();
		</script>
		
	<script>
	                $('#10000000').on('change', function() {
                      
                        $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").hide();
		                $("#date_r").hide();
		                $("#demande_r").hide();
		                $("#raison_nonqualifier").show();
		                $("#date_prevoyer").hide();
		                $("#commentaire_qualifier").hide();
                    });
                    $('#20000000').on('change', function() {
                      
                        $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").hide();
                        $("#date_r").hide();
		                $("#demande_r").hide();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").hide();
		                $("#commentaire_qualifier").hide();
                    });
                    $('#30000000').on('change', function() {
                      
                        $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").hide();
                        $("#date_r").hide();
		                $("#demande_r").hide();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").show();
		                $("#commentaire_qualifier").hide();
                    });
                    
                    // -----------------------------------------------------------
		    
	
		            $('#1000000').on('change', function() {
                      
                        $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").hide();
		                $("#date_r").show();
		                $("#commentaire_qualifier").hide();
		                $("#demande_r").show();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").hide();
                    });
                    $('#2000000').on('change', function() {
                      
                        $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").hide();
                        $("#date_r").show();
		                $("#demande_r").hide();
		                $("#commentaire_qualifier").hide();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").hide();
                    });
                    $('#3000000').on('change', function() {
                      
                        $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").hide();
                        $("#date_r").show();
		                $("#demande_r").hide();
		                $("#commentaire_qualifier").hide();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").hide();
                    });
                    $('#4000000').on('change', function() {
                      
                        $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").hide();
                        $("#date_r").show();
                        $("#commentaire_qualifier").hide();
		                $("#demande_r").hide();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").hide();
                    });
                    $('#5000000').on('change', function() {
                      
                        $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").hide();
                        $("#date_r").show();
                        $("#commentaire_qualifier").hide();
		                $("#demande_r").hide();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").hide();
                    });
                    // -----------------------------------------------------------
		    
		            $('#100000').on('change', function() {
                      
                        $("#rv").show();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").show();
		                $("#commentaire_qualifier").show();
		                $("#date_r").hide();
		                $("#demande_r").hide();
		                $("#raison_nonqualifier").hide();
		    $("#date_prevoyer").hide();
                    });
                    $('#200000').on('change', function() {
                      
                        $("#rv").hide();
                        $("#date_depot").show();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").show();
                        $("#date_r").hide();
                        $("#commentaire_qualifier").show();
		                $("#demande_r").hide();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").hide();
                    });
                    $('#300000').on('change', function() {
                      
                        $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").show();
		                $("#commercial_suivi").show();
		                $("#commentaire_qualifier").show();
                        $("#date_r").hide();
		                $("#demande_r").hide();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").hide();
                    });
                    $('#400000').on('change', function() {
                      
                        $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").show();
                        $("#date_r").hide();
                        $("#commentaire_qualifier").show();
		                $("#demande_r").hide();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").hide();
                    });
                    // -----------------------------------------------------------
                $(document).ready(function(){
                    $('#types').on('change', function() {
                      if ( this.value == '1')
                      {
                        $("#qualifier").show();
                        $("#rappeler").hide();
		                $("#nonqualifier").hide();
		                $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commentaire_qualifier").hide();
		                $("#commercial_suivi").hide();
                        $("#date_r").hide();
		                $("#demande_r").hide();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").hide();
                      }
                      
                     
                      
                    });
                    
                    $('#types').on('change', function() {
                      if ( this.value == '2')
                      {
                        
		                $("#nonqualifier").show();
		                 $("#qualifier").hide();
                        $("#rappeler").hide();
                        $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").hide();
                        $("#date_r").hide();
                        $("#commentaire_qualifier").hide();
		                $("#demande_r").hide();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").hide();
                      }
                      
                    });
                    
                    $('#types').on('change', function() {
                      if ( this.value == '5')
                      {
                        $("#qualifier").hide();
                        $("#rappeler").show();
		                $("#nonqualifier").hide();
		                $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").hide();
                        $("#date_r").hide();
                        $("#commentaire_qualifier").hide();
		                $("#demande_r").hide();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").hide();
                      }
                      
                    });
                    
                });
		</script>
		
		
		
		<script>
var slider = document.getElementById("customRange3");
var output = document.getElementById("demo");
output.innerHTML = slider.value;
slider.oninput = function() {
  output.innerHTML = this.value;
}
</script>

 
	
		<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
		<script>
		    
		    init: function () {
                  this.inputElements = [...this.$el.querySelectorAll("input[data-rules]")];
                  this.initDomData();
                },
                initDomData: function () {
                  this.inputElements.map((ele) => {
                  this[ele.name] = {
                    serverErrors: JSON.parse(ele.dataset.serverErrors),
                    blurred: false
                    };
                  });
                }
		</script>
		
	
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

		<script>
            var path = "{{ route('autocomplete') }}";
            $('input.typeahead').typeahead({
                source:  function (query, process) {
                return $.get(path, { query: query }, function (data) {
                        return process(data);
                    });
                }
            });
        </script>
		<!--<script>-->
  <!--      $(function () {-->
  <!--          var text1 = "existe deja";-->
  <!--         $('#nom_entreprise').autocomplete({-->
  <!--             source:function(request,response){-->
                
  <!--                 $.getJSON('?term='+request.term,function(data){-->
  <!--                      var array = $.map(data,function(row){-->
  <!--                          return {-->
  <!--                              value:row.id,-->
  <!--                              label:row.nom_entreprise,-->
  <!--                              nom_entreprise:row.nom_entreprise-->
                                
  <!--                          }-->
  <!--                      })-->

  <!--                      response($.ui.autocomplete.filter(array,request.term));-->
  <!--                 })-->
  <!--             },-->
  <!--             minLength:1,-->
  <!--             delay:500,-->
  <!--             select:function(event,ui){-->
  <!--                 $('#nom_entreprise').val(ui.item.nom_entreprise)-->
                  
  <!--             }-->
  <!--         })-->
  <!--      })-->
  <!--  </script>-->
	<script>
var slider = document.getElementById("customRange3");
var output = document.getElementById("demo");
output.innerHTML = slider.value;
slider.oninput = function() {
  output.innerHTML = this.value;
}
</script>
</body>

</html>
</body>

</html>