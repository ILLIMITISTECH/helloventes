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
        <!--les formulaires-->
         @php $Y = date('Y'); @endphp
        <div class="container px-6 mx-auto grid">
            <img style="width:200px; " src="{{asset('Koyalis/hellovente3.png')}}" alt="logo"> <br>
            <h2 class="my-2 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Rapport <b style="color:#9045e2">individuel</b> de performance commerciale de l'année : <strong>{{$Y}}</strong>
          </h2>
          
                            <br>
            @php $m = date('m');
             setlocale(LC_TIME, 'fr_FR'); 
                $per = DB::table('performances')->where('commercial_id', $commerciau->id)->whereMonth('created_at', $m)->first();
            @endphp
          <p style="font-size:20px">{{$commerciau->prenom}} {{$commerciau->nom}}</p>
          <!--@if($per)
          <p style="font-size:20px">{{ucfirst(strftime('%Y', strtotime($per->created_at)))}}</p>
          @endif -->
          <br><br>
          <h2 class="my-4 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Ventes 
          </h2>
          <br>
                       
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
        
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap" style="border: solid 1px black;">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3" style="border: solid 1px black;"></th>
                    <th class="px-4 py-3" style="border: solid 1px black;">Objectifs</th>
                    <th class="px-4 py-3" style="border: solid 1px black;">Réalisations</th>
                    <th class="px-4 py-3" style="border: solid 1px black;">% de réalisations</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @php $zero = 1; @endphp
                @php 
                    $total_objectif = 0; 
                    $total_realisation_vente = 0; 
                    $total_perfo_vente = 0; 
                @endphp
                @foreach($performances as $performance)
                @if($performance->commercial_id == $commerciau->id)
                @php 
                    $total_objectif += $performance->objectif_mois;
                    $total_realisation_vente += $performance->montant_vente;
                    $total_perfo_vente += $performance->pourcentage;
                @endphp
                
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                             @if(date('m', strtotime($performance->created_at)) == "08")
                             {{ucfirst(strftime('Août %Y', strtotime($performance->created_at)))}}
                             @elseif(date('m', strtotime($performance->created_at)) == "02")
                             {{ucfirst(strftime('Février %Y', strtotime($performance->created_at)))}}
                             @elseif(date('m', strtotime($performance->created_at)) == "12")
                             {{ucfirst(strftime('Décembre %Y', strtotime($performance->created_at)))}}
                             @else
                             {{ucfirst(strftime('%B %Y', strtotime($performance->created_at)))}}
                             @endif</td>
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">{{number_format($performance->objectif_mois)}}</td>
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">{{number_format($performance->montant_vente)}}</td>
                        @if($performance->objectif_mois)
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">@if($performance->montant_vente) {{intval( ($performance->montant_vente / $performance->objectif_mois) * 100)}}% @else 0% @endif</td>
                        @else
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">0%</td>
                        @endif
                    </tr>
                    @php $zero++; 
                    
                        if($total_objectif){
                         $pourcentage_ventemois = $total_realisation_vente * (100) / ($total_objectif);
                         }
                         else{
                             $pourcentage_ventemois = 0;
                         }
                         
                    @endphp
                    @endif
                @endforeach
               <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">Total </td>
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">{{number_format($total_objectif)}}</span></td>
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">{{number_format($total_realisation_vente)}}</span></td>
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            @if($total_objectif)
                                {{intval($pourcentage_ventemois)}}% 
                            @else 0% @endif</span></td>
                </tr>
                
                <!--<tr class="text-gray-700 dark:text-gray-400">-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">Semaine 2 </td>-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> </td>-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> </td>-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> </td>-->
                <!--</tr>-->
                
                <!--<tr class="text-gray-700 dark:text-gray-400">-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> Semaine 3</td>-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> </td>-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> </td>-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> </td>-->
                <!--</tr>-->
                
                <!--<tr class="text-gray-700 dark:text-gray-400">-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> Semaine 4</td>-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> </td>-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> </td>-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> </td>-->
                <!--</tr>-->
                
                <!--<tr class="text-gray-700 dark:text-gray-400">-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">Total </td>-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> </td>-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> </td>-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> </td>-->
                <!--</tr>-->

                </tbody>
              </table>
            </div>
       
          
                
          </div>


  
        </div>
    
    
    <br>
   <!-- <div class="container px-6 mx-auto grid">
          <h2 class="my-4 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Démo clients 
          </h2>
          <br>
                       
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
        
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap" style="border: solid 1px black;">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                 
                    <th class="px-4 py-3" style="border: solid 1px black;"></th>
                    <th class="px-4 py-3" style="border: solid 1px black;">Objectifs</th>
                    <th class="px-4 py-3" style="border: solid 1px black;">Réalisations</th>
                    <th class="px-4 py-3" style="border: solid 1px black;">% de réalisations</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @php $zero = 1; @endphp
                @php 
                     $total_obje_demo = 0; 
                     $total_realisation_demo = 0; 
                     $total_perfo_demo = 0; 
                     $total_perfo_objectif_demo = 0; 
                @endphp
                @foreach($performances as $performance)
                 @if($performance->commercial_id == $commerciau->id)
                @php 
                
                     $total_obje_demo += $performance->nbre_demo;
                     $total_realisation_demo += $performance->nbre_demo_ajouter;
                     $total_perfo_objectif_demo += $performance->nbre_demo;
                @endphp
                     <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">{{ucfirst(strftime('%B %Y', strtotime($performance->created_at)))}} </td>
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">{{number_format($performance->nbre_demo)}}</td>
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">{{number_format($performance->nbre_demo_ajouter)}}</td>
                        @if($performance->nbre_demo)
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">@if($performance->nbre_demo_ajouter) {{intval( ($performance->nbre_demo_ajouter / $performance->nbre_demo) * 100)}}% @else 0% @endif</td>
                        @else
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">0%</td>
                        @endif
                    </tr>
                    @php $zero++; 
                    
                    if($total_obje_demo){
                         $pourcentage_demomois = $total_realisation_demo * (100) / ($total_obje_demo);
                         }
                         else{
                             $pourcentage_demomois = 0;
                         }
                         
                    @endphp
                    @endif
                @endforeach
              <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">Total </td>
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">{{number_format($total_obje_demo)}}</span></td>
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">{{number_format($total_realisation_demo)}}</span></td>
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            @if($total_obje_demo)
                                {{intval($pourcentage_demomois)}}% 
                            @else 0% @endif</span></td>
                </tr>
                
              
              

                </tbody>
              </table>
            </div>
       
          
                
          </div>


  
        </div>
    
    
    
    <br>-->
    <div class="container px-6 mx-auto grid">
          <h2 class="my-4 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Contacts clients 
          </h2>
          <br>
                       
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
        
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap" style="border: solid 1px black;">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3" style="border: solid 1px black;"></th>
                    <th class="px-4 py-3" style="border: solid 1px black;">Objectifs</th>
                    <th class="px-4 py-3" style="border: solid 1px black;">Réalisations</th>
                    <th class="px-4 py-3" style="border: solid 1px black;">% de réalisations</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @php $zero = 1; @endphp
                @php 
                
                     $total_obje_contact = 0; 
                     $total_realisation_contact = 0; 
                     $total_perfo_contact = 0; 
                     $total_perfo_objectif_contact = 0; 
                @endphp
                @foreach($performances as $performance)
                 @if($performance->commercial_id == $commerciau->id)
                @php 
                
                     $total_obje_contact += $performance->nbre_contact;
                     $total_realisation_contact += $performance->nbre_contact_ajouter;
                     $total_perfo_contact += $performance->pourcentage_contact_mois;
                     $total_perfo_objectif_contact += $performance->nbre_contact;
                @endphp
                     <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                        @if(date('m', strtotime($performance->created_at)) == "08")
                             {{ucfirst(strftime('Août %Y', strtotime($performance->created_at)))}}
                             @elseif(date('m', strtotime($performance->created_at)) == "02")
                             {{ucfirst(strftime('Février %Y', strtotime($performance->created_at)))}}
                             @elseif(date('m', strtotime($performance->created_at)) == "12")
                             {{ucfirst(strftime('Décembre %Y', strtotime($performance->created_at)))}}
                             @else
                             {{ucfirst(strftime('%B %Y', strtotime($performance->created_at)))}}
                             @endif</td>
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">{{number_format($performance->nbre_contact)}}</td>
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">{{number_format($performance->nbre_contact_ajouter)}}</td>
                        @if($performance->nbre_contact)
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">@if($performance->nbre_contact_ajouter) {{intval( ($performance->nbre_contact_ajouter / $performance->nbre_contact) * 100)}}% @else 0% @endif</td>
                        @else
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">0%</td>
                        @endif
                    </tr>
                    @php $zero++; 
                    
                    if($total_obje_contact){
                         $pourcentage_contactmois = $total_realisation_contact * (100) / ($total_obje_contact);
                         }
                         else{
                             $pourcentage_contactmois = 0;
                         }
                    
                    @endphp
                    @endif
                @endforeach
               <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">Total </td>
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">{{number_format($total_obje_contact)}}</span></td>
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">{{number_format($total_realisation_contact)}}</span></td>
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            @if($total_obje_contact)
                                {{intval($pourcentage_contactmois)}}% 
                            @else 0% @endif</span></td>
                </tr>
                
                <!--<tr class="text-gray-700 dark:text-gray-400">-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">Semaine 2 </td>-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> </td>-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> </td>-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> </td>-->
                <!--</tr>-->
                
                <!--<tr class="text-gray-700 dark:text-gray-400">-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> Semaine 3</td>-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> </td>-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> </td>-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> </td>-->
                <!--</tr>-->
                
                <!--<tr class="text-gray-700 dark:text-gray-400">-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> Semaine 4</td>-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> </td>-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> </td>-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> </td>-->
                <!--</tr>-->
                
                <!--<tr class="text-gray-700 dark:text-gray-400">-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">Total </td>-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> </td>-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> </td>-->
                <!--    <td class="px-4 py-3 text-sm" style="border: solid 1px black;"> </td>-->
                <!--</tr>-->

                </tbody>
              </table>
            </div>
       
          
                
          </div>


  
        </div>
        
         <br>
    <div class="container px-6 mx-auto grid">
          <h2 class="my-4 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Visites terrain  
          </h2>
          <br>
                       
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
        
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap" style="border: solid 1px black;">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <!--<th class="px-4 py-3">Liste des prospects</th>-->
                    <th class="px-4 py-3" style="border: solid 1px black;"></th>
                    <th class="px-4 py-3" style="border: solid 1px black;">Objectifs</th>
                    <th class="px-4 py-3" style="border: solid 1px black;">Réalisations</th>
                    <th class="px-4 py-3" style="border: solid 1px black;">% de réalisations</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @php $zero = 1; @endphp
                @php 
                     $total_obje_visite = 0; 
                     $total_realisation_visite = 0; 
                     $total_perfo_visite = 0; 
                     $total_perfo_objectif_visite = 0; 
                @endphp
                @foreach($performances as $performance)
                @if($performance->commercial_id == $commerciau->id)
                @php 
                     $total_obje_visite += $performance->objectif_visite;
                      $total_perfo_visite += $performance->pourcentage_visite_mois;
                     $total_realisation_visite += $performance->nbre_visite_ajouter;
                     
                     $total_perfo_objectif_visite += $performance->objectif_visite;
                @endphp
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                        @if(date('m', strtotime($performance->created_at)) == "08")
                             {{ucfirst(strftime('Août %Y', strtotime($performance->created_at)))}}
                             @elseif(date('m', strtotime($performance->created_at)) == "02")
                             {{ucfirst(strftime('Février %Y', strtotime($performance->created_at)))}}
                             @elseif(date('m', strtotime($performance->created_at)) == "12")
                             {{ucfirst(strftime('Décembre %Y', strtotime($performance->created_at)))}}
                             @else
                             {{ucfirst(strftime('%B %Y', strtotime($performance->created_at)))}}
                             @endif</td>
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">{{number_format($performance->objectif_visite)}}</td>
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">{{number_format($performance->nbre_visite_ajouter)}}</td>
                        @if($performance->objectif_visite)
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">@if($performance->nbre_visite_ajouter) {{intval( ($performance->nbre_visite_ajouter / $performance->objectif_visite) * 100)}}% @else 0% @endif</td>
                        @else
                        <td class="px-4 py-3 text-sm" style="border: solid 1px black;">0%</td>
                        @endif
                    </tr>
                    @php $zero++; 
                    
                    if($total_obje_visite){
                         $pourcentage_visitemois = $total_realisation_visite * (100) / ($total_obje_visite);
                         }
                         else{
                             $pourcentage_visitemois = 0;
                         }
                         @endphp
                    @endif
                @endforeach
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">Total </td>
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">{{number_format($total_obje_visite)}}</span></td>
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">{{number_format($total_realisation_visite)}}</span></td>
                    <td class="px-4 py-3 text-sm" style="border: solid 1px black;">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            @if($total_obje_visite)
                                {{intval($pourcentage_visitemois)}}% 
                            @else 0% @endif</span></td>
                </tr>
                
                </tbody>
              </table>
            </div>
       
          
                
          </div>


  
        </div>
    
    </main>
  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/init-alpine.js')}}"></script>
  <script src="{{asset('Koyalis/public/https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js')}}" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/charts-lines.js')}}" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/charts-pie.js')}}" defer></script>
</body>

</html>