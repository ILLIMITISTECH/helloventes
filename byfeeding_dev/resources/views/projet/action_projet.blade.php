<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="Performance, collaboration, Focus, Team, Productivité">
    <meta name="description"
        content="Monster Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Collaboratis </title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/monster-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('collov2/assets/images/icon.png')}}">
    <!-- Custom CSS -->
    <link href="{{asset('assets/plugins/chartist/dist/chartist.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('v2/assets/style.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">

</head>

<body>

  <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        @include('v2.header_dg')
         <aside class="left-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                @include('v2.side_bar_dg')
            </div>
                <!-- End Sidebar scroll-->
         </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
           
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales chart -->



                <!-- ==============================  Action projet ================================ -->
               
 <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex">
                                    <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Mes actions de la semaine liée à un projet </h4>
                                
                                </div>
                                
                                <div class="table-responsive mt-5">
                                    <table class="table stylish-table no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Projet</th>
                                              <th class="border-top-0">Libellé de l'action</th>
                                                <th class="border-top-0">Backup</th>
                                                <th class="border-top-0">Priorité</th>
                                                <th class="border-top-0">Progression</th>
                                                <th class="border-top-0">Échéance</th>
                                                <th class="border-top-0">Retard</th>
                                                <th class="border-top-0">Options</th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($pro as $proj)  
                                            @php  $pro_actions = DB::table('actions')->where('agent_id', $user->id)->where('projet_id', $proj->id)->first();  @endphp
                                           
                                                @if($pro_actions)
                                            @if($pro_actions->visibilite == 0)
                                           
                                                            <tr>
                                                              
                                                                     <td class="text-nice">
                                                                   <p>
                                                                        <p  class="text-nice" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                                             <b> {{$proj->libelle}} </b>
                                                                          </p>
                                                                    </p>
                                                                    </td>
                                                                     <td class="align-middle">--</td>
                                                                    <td class="align-middle">--</td>
                                                @if($proj->priorite == 'Elevé(E)')
                                                <td class="align-middle"data-toggle="tooltip" title="Elevé"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @elseif($proj->priorite == 'Moins(M)')
                                                <td class="align-middle"data-toggle="tooltip" title="Moyenne"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="orange" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></td>
                                                @else($proj->priorite == 'Faible(F)')
                                                <td class="align-middle"data-toggle="tooltip" title="Faible"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @endif
                                                                    <td class="align-middle">{{$proj->pourcentage}}%</td>
                                                                    <td class="align-middle">{{strftime("%d/%m/%Y", strtotime($proj->deadline))}}</td>
                                                                    <td class="align-middle">--</td>
                                                                    <td class="align-middle"></td>
                                                <!--                     @php $agentbackup = DB::table('agents')->where('id', $proj->bakup)->first(); @endphp-->
                                                <!--                    @if($agentbackup)-->
                                                <!--                    <td class="align-middle"><span style="width:50px;"><span class="round">{{substr($agentbackup->prenom, 0, 1)}} {{substr($agentbackup->nom, 0, 1)}}</span></span></td>-->
                                                <!--                    @else-->
                                                <!--                    <td class="align-middle"><span class="responsable">--</span></td>-->
                                                <!--                    @endif-->
                                                                
                                               
                                                

                                                <!--                    <td class="align-middle" >-->
                                                <!--                                        {{$proj->pourcentage}}%-->

                                                <!--                     </td>-->
                                                                 
                                                                   
                                                <!--                    <td class="align-middle">{{strftime("%d/%m/%Y", strtotime($proj->deadline))}}</td>-->
                                                <!--                    @if($proj->deadline < now())-->
                                                <!--                    <td class="align-middle">{{intval(abs(strtotime("now") - strtotime($proj->deadline))/ 86400)}} jours</td> -->
                                                <!--                    @else-->
                                                <!--                    <td class="align-middle">Aucun</td>-->
                                                <!--                    @endif-->

                                                <!--                    <td class="align-middle" colspan ="2">-->
                                                <!--                        <div class="student-dtl" style="display:flex;">-->
                                                   
                                                <!--                         <span class="d-inline-block" tabindex="0" style="margin-right : 10%;">-->
                                                <!--                                <a id="PopoverCustomT-1" href="{{route('action_projet.edit', $proj->id)}}" type="button" class="btn boutton-options">-->
                                                <!--                                    <i class="bi bi-pencil-square" style="color:black;" data-toggle="tooltip" title="Modifier l'action"></i>-->
                                                <!--                                </a>-->
                                                <!--                            </span>-->
                                                <!--                                    <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Mettre à jour votre action">-->
                                                <!--                                        <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('action_projet.edit', $proj->id)}}" >-->
                                                <!--                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">-->
                                                <!--                                              <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>-->
                                                <!--                                              <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>-->
                                                <!--                                            </svg>-->
                                                <!--                                        </a>-->
                                                <!--                                    </span>-->
                                                                           
                                                    
                                                <!--            <form action="{{route('visibiliteraction.cloturer', $proj->id)}}" method="post" id="target" class="form">-->
                                                <!--            <input type="hidden" value="{{csrf_token()}}" name="_token"/>-->
                                                <!--            @if($proj->pourcentage == 100)-->
                                                <!--            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action">-->
                                                <!--                <button type="submit" id="PopoverCustomT-1" class="btn btn-primary">-->
                                                <!--                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">-->
                                                <!--                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>-->
                                                <!--                      <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>-->
                                                <!--                    </svg>-->
                                                <!--                </button>-->
                                                <!--            </span>-->
                                                <!--            @else-->
                                                <!--            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action" disabled>-->
                                                <!--                <button type="submit" id="PopoverCustomT-1" class="btn btn-primary" disabled>-->
                                                <!--                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">-->
                                                <!--                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>-->
                                                <!--                      <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>-->
                                                <!--                    </svg>-->
                                                <!--                </button>-->
                                                <!--            </span>-->
                                                <!--            @endif-->
                                                <!--            </form>-->
                                                    
                                                <!--                            </div>-->
                                                <!--                    </td>-->
                            <!-------------------------------------------------------------------------------------->

                                                    @php  $pro_actions = DB::table('actions')->where('projet_id', $proj->id)->where('agent_id', $user->id)->get(); @endphp
                                                @foreach($pro_actions as $pro_action)
                    
                                                <tr id="collapseExample">
                                                        <td class="align-middle"></td>
                                                                    <td class="align-middle" data-toggle="tooltip" title="{{$pro_action->libelle}}"> {{ \Illuminate\Support\Str::limit($pro_action->libelle, 25, $end='...') }}</td>
                                                        @php $agentbackup = DB::table('agents')->where('id', $pro_action->bakup)->first(); @endphp
                                                                    @if($agentbackup)
                                                                    <td class="align-middle"><span style="width:50px;"><span class="round">{{substr($agentbackup->prenom, 0, 1)}} {{substr($agentbackup->nom, 0, 1)}}</span></span></td>
                                                                    @else
                                                                    <td class="align-middle"><span class="responsable">--</span></td>
                                                                    @endif
                                                                     @if($pro_action->risque == 'Elevé(E)')
                                                <td class="align-middle"data-toggle="tooltip" title="Elevé"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @elseif($pro_action->risque == 'Moins(M)')
                                                <td class="align-middle"data-toggle="tooltip" title="Moyenne"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="orange" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></td>
                                                @else($pro_action->risque == 'Faible(F)')
                                                <td class="align-middle"data-toggle="tooltip" title="Faible"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @endif

                                                                    <td class="align-middle" >
                                                                        <div class="align-middle" >
                                                                                        {{$pro_action->pourcentage}}%
                                                                         </div>
                                                                        
                                                                     </td>
                                                                 
                                                                   
                                                                    <td class="align-middle">{{strftime("%d/%m/%Y", strtotime($pro_action->deadline))}}</td>
                                                                    @if($pro_action->deadline < now())
                                                                    <td class="align-middle">{{intval(abs(strtotime("now") - strtotime($pro_action->deadline))/ 86400)}} jours</td> 
                                                                    @else
                                                                    <td class="align-middle">Aucun</td>
                                                                    @endif

                                                                          <td class="align-middle" colspan ="2">
                                                                        <div class="student-dtl" style="display:flex;">
                                                   
                                                                          <!--<span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Modifier votre action">-->
                                                                          <!--      <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('action_projet.edit', $pro_action->id)}}" >-->
                                                                          <!--          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">-->
                                                                          <!--            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>-->
                                                                          <!--            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>-->
                                                                          <!--          </svg>-->
                                                                          <!--      </a>-->
                                                                          <!--  </span>-->
                                                                           <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Modifier votre action">
                                                                                <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('action_proj.edit', $pro_action->id)}}" >
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                                                    </svg>
                                                                                </a>
                                                                            </span>
                                                                                    <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Mettre à jour votre action">
                                                                                        <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('action_projet_dash.edit', $pro_action->id)}}" >
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                                                                              <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                                                                              <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                                                                                            </svg>
                                                                                        </a>
                                                                                    </span>
                                                                           
                                                    
                                                            <form action="{{route('visibiliteraction.cloturer', $pro_action->id)}}" method="post" id="target" class="form">
                                                            <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                            @if($pro_action->pourcentage == 100)
                                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action">
                                                                <button type="submit" id="PopoverCustomT-1" class="btn btn-primary">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                                      <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                                                    </svg>
                                                                </button>
                                                            </span>
                                                            @else
                                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action" disabled>
                                                                <button type="submit" id="PopoverCustomT-1" class="btn btn-primary" disabled>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                                      <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                                                    </svg>
                                                                </button>
                                                            </span>
                                                            @endif
                                                            </form>
                                                    
                                                                            </div>
                                                                    </td>
                                                    </tr>
                                                    @endforeach
                                        </tr>
                                            </tbody>
                                                   
                                                     
                                    @endif
                                   
                                     @endif
                                     @endforeach
                                                     
                                            
                                                 
                                            </tbody>
                                        </table>
                                        </div>
                                        </div>
                                        </div>
                                
                           
                            </div>
                        </div>
                 <!-- ============================== end action pojet ================================ -->
                 
                              <!--------------------------------actions avec projet en retard-------------------------------------------------->
                        
          <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex">
                                    <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Mes actions pour lesquelles je suis Backup liée à un projet </h4>
                                
                                </div>
                                
                                <div class="table-responsive mt-5">
                                    <table class="table stylish-table no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Projet</th>
                                              <th class="border-top-0">Libellé de l'action</th>
                                                <th class="border-top-0">Backup</th>
                                                <th class="border-top-0">Priorité</th>
                                                <th class="border-top-0">Progression</th>
                                                <th class="border-top-0">Retard</th>
                                                <th class="border-top-0">Options</th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($pro as $proj)  
                                            @php  $pro_actions = DB::table('actions')->where('agent_id', $user->id)->where('projet_id', $proj->id)->first();  @endphp
                                           
                                                @if($pro_actions)
                                            @if($pro_actions->visibilite == 0)
                                           
                                                            <tr class = "actions">
                                                               <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                                      <td class="align-middle">
                                                                   <p>
                                                                        <p  class="text-nice collapsed" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                                             {{$proj->libelle}}
                                                                          </p>
                                                                    </p>
                                                                    </td>
                                                                    <td class="align-middle">--</td>
                                                                    <td class="align-middle">--</td>
                                                @if($proj->priorite == 'Elevé(E)')
                                                <td class="align-middle"data-toggle="tooltip" title="Elevé"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @elseif($proj->priorite == 'Moins(M)')
                                                <td class="align-middle"data-toggle="tooltip" title="Moyenne"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="orange" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></td>
                                                @else($proj->priorite == 'Faible(F)')
                                                <td class="align-middle"data-toggle="tooltip" title="Faible"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @endif
                                                                    <td class="align-middle">{{$proj->pourcentage}}%</td>
                                                                     <td class="align-middle">--</td>
                                                                    <!--@if($proj->deadline < now())-->
                                                                    <!--<td class="align-middle">{{intval(abs(strtotime("now") - strtotime($pro_action->deadline))/ 86400)}} jours</td> -->
                                                                    <!--@else-->
                                                                    <!--<td class="align-middle">Aucun</td>-->
                                                                    <!--@endif                                                                    <td class="align-middle"></td>-->
                                                <!--                     @php $agentbackup = DB::table('agents')->where('id', $proj->bakup)->first(); @endphp-->
                                                <!--                    @if($agentbackup)-->
                                                <!--                    <td class="align-middle"><span style="width:50px;"><span class="round">{{substr($agentbackup->prenom, 0, 1)}} {{substr($agentbackup->nom, 0, 1)}}</span></span></td>-->
                                                <!--                    @else-->
                                                <!--                    <td class="align-middle"><span class="responsable">--</span></td>-->
                                                <!--                    @endif-->
                                                                
                                                <!--                     @if($proj->priorite == 'Elevé(E)')-->
                                                <!--<td class="align-middle"data-toggle="tooltip" title="Elevé"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">-->
                                                <!--  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>-->
                                                <!--</svg></button></td>-->
                                                <!--@elseif($proj->priorite == 'Moins(M)')-->
                                                <!--<td class="align-middle"data-toggle="tooltip" title="Moyenne"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="orange" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">-->
                                                <!--  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>-->
                                                <!--</svg></td>-->
                                                <!--@else($proj->priorite == 'Faible(F)')-->
                                                <!--<td class="align-middle"data-toggle="tooltip" title="Faible"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">-->
                                                <!--  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>-->
                                                <!--</svg></button></td>-->
                                                <!--@endif-->
                                                

                                                <!--                    <td class="align-middle" >-->
                                                <!--                                        {{$proj->pourcentage}}%-->

                                                <!--                     </td>-->
                                                                 
                                                                   
                                                <!--                    <td class="align-middle">{{strftime("%d/%m/%Y", strtotime($proj->deadline))}}</td>-->
                                                <!--                    @if($proj->deadline < now())-->
                                                <!--                    <td class="align-middle">{{intval(abs(strtotime("now") - strtotime($proj->deadline))/ 86400)}} jours</td> -->
                                                <!--                    @else-->
                                                <!--                    <td class="align-middle">Aucun</td>-->
                                                <!--                    @endif-->

                                                <!--                    <td class="align-middle" colspan ="2">-->
                                                <!--                        <div class="student-dtl" style="display:flex;">-->
                                                   
                                                <!--                         <span class="d-inline-block" tabindex="0" style="margin-right : 10%;">-->
                                                <!--                                <a id="PopoverCustomT-1" href="{{route('action_projet.edit', $proj->id)}}" type="button" class="btn boutton-options">-->
                                                <!--                                    <i class="bi bi-pencil-square" style="color:black;" data-toggle="tooltip" title="Modifier l'action"></i>-->
                                                <!--                                </a>-->
                                                <!--                            </span>-->
                                                <!--                                    <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Mettre à jour votre action">-->
                                                <!--                                        <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('action_projet.edit', $proj->id)}}" >-->
                                                <!--                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">-->
                                                <!--                                              <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>-->
                                                <!--                                              <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>-->
                                                <!--                                            </svg>-->
                                                <!--                                        </a>-->
                                                <!--                                    </span>-->
                                                                           
                                                    
                                                <!--            <form action="{{route('visibiliteraction.cloturer', $proj->id)}}" method="post" id="target" class="form">-->
                                                <!--            <input type="hidden" value="{{csrf_token()}}" name="_token"/>-->
                                                <!--            @if($proj->pourcentage == 100)-->
                                                <!--            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action">-->
                                                <!--                <button type="submit" id="PopoverCustomT-1" class="btn btn-primary">-->
                                                <!--                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">-->
                                                <!--                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>-->
                                                <!--                      <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>-->
                                                <!--                    </svg>-->
                                                <!--                </button>-->
                                                <!--            </span>-->
                                                <!--            @else-->
                                                <!--            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action" disabled>-->
                                                <!--                <button type="submit" id="PopoverCustomT-1" class="btn btn-primary" disabled>-->
                                                <!--                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">-->
                                                <!--                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>-->
                                                <!--                      <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>-->
                                                <!--                    </svg>-->
                                                <!--                </button>-->
                                                <!--            </span>-->
                                                <!--            @endif-->
                                                <!--            </form>-->
                                                    
                                                <!--                            </div>-->
                                                <!--                    </td>-->
                            <!-------------------------------------------------------------------------------------->

                                                    @php  $pro_actions = DB::table('actions')->where('projet_id', $proj->id)->where('bakup', $user->id)->get(); @endphp
                                                @foreach($pro_actions as $pro_action)
                    
                                                <tr  id="collapseExample">
                                                        <td class="align-middle"></td>
                                                                    <td class="align-middle" data-toggle="tooltip" title="{{$pro_action->libelle}}"> {{ \Illuminate\Support\Str::limit($pro_action->libelle, 25, $end='...') }}</td>
                                                        @php $agentbackup = DB::table('agents')->where('id', $pro_action->bakup)->first(); @endphp
                                                                    @if($agentbackup)
                                                                    <td class="align-middle"><span style="width:50px;"><span class="round">{{substr($agentbackup->prenom, 0, 1)}} {{substr($agentbackup->nom, 0, 1)}}</span></span></td>
                                                                    @else
                                                                    <td class="align-middle"><span class="responsable">--</span></td>
                                                                    @endif
                                                                     @if($pro_action->risque == 'Elevé(E)')
                                                <td class="align-middle"data-toggle="tooltip" title="Elevé"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @elseif($pro_action->risque == 'Moins(M)')
                                                <td class="align-middle"data-toggle="tooltip" title="Moyenne"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="orange" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></td>
                                                @else($pro_action->risque == 'Faible(F)')
                                                <td class="align-middle"data-toggle="tooltip" title="Faible"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg></button></td>
                                                @endif

                                                                    <td class="align-middle" >
                                                                        <div class="align-middle" >
                                                                                        {{$pro_action->pourcentage}}%
                                                                         </div>
                                                                        
                                                                     </td>
                                                                 
                                                                   
                                                                    @if($pro_action->deadline < now())
                                                                    <td class="align-middle">{{intval(abs(strtotime("now") - strtotime($pro_action->deadline))/ 86400)}} jours</td> 
                                                                    @else
                                                                    <td class="align-middle">Aucun</td>
                                                                    @endif

                                                                          <td class="align-middle" colspan ="2">
                                                                        <div class="student-dtl" style="display:flex;">
                                                   
                                                                          <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Modifier votre action">
                                                                                <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('action_proj.edit', $pro_action->id)}}" >
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                                                    </svg>
                                                                                </a>
                                                                            </span>
                                                                                  <span class="d-inline-block" tabindex="0" style="margin-right : 10%;" data-toggle="tooltip" title="Mettre à jour votre action">
                                                                                        <a type="submit" id="PopoverCustomT-1" class="btn btn-primary" href="{{route('action_projet_dash.edit', $pro_action->id)}}" >
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                                                                              <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                                                                              <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                                                                                            </svg>
                                                                                        </a>
                                                                                    </span>
                                                                           
                                                    
                                                            <form action="{{route('visibiliteraction.cloturer', $pro_action->id)}}" method="post" id="target" class="form">
                                                            <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                            @if($pro_action->pourcentage == 100)
                                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action">
                                                                <button type="submit" id="PopoverCustomT-1" class="btn btn-primary">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                                      <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                                                    </svg>
                                                                </button>
                                                            </span>
                                                            @else
                                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Cloturer l'action" >
                                                                <button type="submit" id="PopoverCustomT-1" class="btn btn-primary" disabled>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                                      <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                                                    </svg>
                                                                </button>
                                                            </span>
                                                            @endif
                                                            </form>
                                                    
                                                                            </div>
                                                                    </td>
                                                    </tr>
                                                    @endforeach
                                        </tr>
                                            </tbody>
                                                   
                                                     
                                    @endif
                                   
                                     @endif
                                     @endforeach
                                                     
                                            
                                                 
                                            </tbody>
                                        </table>
                                        </div>
                                        </div>
                                        </div>
                                
                           
                            </div>
                        </div>
                         <!---------------------------------------------end-------------------------------------------------------------->

                  <!-- ============================== Action en insctance ================================ -->
                  
                   <!-- ============================== Action en insctance ================================ -->
                
               
            </div>
          
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
          
          
   <style>



.responsable{
    height : 70px;
    width : 70px;
    border-radius : 50%;
    color : white;
    background-color : red;
    padding :10%;
    text-align: center;
    font-size : 16px;
    background : #43928E;
}

.backup {
    height : 70px;
    width : 70px;
    border-radius : 50%;
    color : white;
    background-color : blue;
    padding :10%;
    text-align: center;
    font-size : 14px;
}




.section-title{
    font-family : poppins;
    font-size : 16px;
    font-weight :bold;
}
.section-title-box{
    margin-bottom : 2%;
}

.section-main{
    margin : 2%;
}
.text-nice{
    font-family: 'poppins', sans-serif;
}

.card-body-todo{
    
}


.actions  td:first-child,
.actions  th:first-child {

  border-radius: 5px 5px 5px 5px;
  padding: 5%;
}

.actions  td:last-child,
.actions th:last-child {
  border-radius: 0 5px 5px 0;
 
}   
    
    
.boutton-options {
    background-color : #4B8F8C;
    padding : 0 15px 0 15px;
}  
    
    
    

.flip-box {
background-color: transparent;
width: 25px;
height: 25px;
border: 1px solid #f1f1f1;
perspective: 1000px;
}

.flip-box-inner {
position: relative;
width: 100%;
height: 100%;
text-align: center;
transition: transform 0.8s;
transform-style: preserve-3d;
}

.flip-box:hover .flip-box-inner {
transform: rotateY(180deg);
}

.flip-box-front, .flip-box-back {
position: absolute;
width: 100%;
height: 100%;
-webkit-backface-visibility: hidden;
backface-visibility: hidden;
}

.flip-box-front {

color: black;
}

.flip-box-back {
background-color: white;
color: green;
text-align: center;
transform: rotateY(180deg);
}
</style> 

<style>

/* The Modal (background) */
.modal {
display: none; /* Hidden by default */
margin-left: 90px;
margin-top: 150px;
width: 250px; /* Full width */
height: 80px; /* Full height */


}

/* Modal Content */
.modal-content {
background-color: #fefefe;
margin: auto;
padding: 20px;
border: 1px solid #888;
width: 100%;
height: 100%;
}

/* The Close Button */
.close {
color: #aaaaaa;
float: right;
font-size: 28px;
font-weight: bold;
}

.close:hover,
.close:focus {
color: #000;
text-decoration: none;
cursor: pointer;
}
</style>

<style>
.todo-nav {
    margin-top: 10px
}

.todo-list {
    margin: 10px 0
}

.todo-list .todo-item {
    padding: 15px;
    margin: 5px 0;
    border-radius: 0;
    background: #f7f7f7
}

.todo-list.only-active .todo-item.complete {
    display: none
}

.todo-list.only-active .todo-item:not(.complete) {
    display: block
}

.todo-list.only-complete .todo-item:not(.complete) {
    display: none
}

.todo-list.only-complete .todo-item.complete {
    display: block
}

.todo-list .todo-item.complete span {
    text-decoration: line-through
}

.remove-todo-item {
    color: #ccc;
    visibility: hidden
}

.remove-todo-item:hover {
    color: #5f5f5f
}

.todo-item:hover .remove-todo-item {
    visibility: visible
}

div.checker {
    width: 18px;
    height: 18px
}

div.checker input,
div.checker span {
    width: 18px;
    height: 18px
}

div.checker span {
    display: -moz-inline-box;
    display: inline-block;
    zoom: 1;
    text-align: center;
    background-position: 0 -260px;
}

div.checker, div.checker input, div.checker span {
    width: 19px;
    height: 19px;
}

div.checker, div.radio, div.uploader {
    position: relative;
}

div.button, div.button *, div.checker, div.checker *, div.radio, div.radio *, div.selector, div.selector *, div.uploader, div.uploader * {
    margin: 0;
    padding: 0;
}

div.button, div.checker, div.radio, div.selector, div.uploader {
    display: -moz-inline-box;
    display: inline-block;
    zoom: 1;
    vertical-align: middle;
}
    
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
$(document).ready(function(){

@foreach($action_respons as $suivi)

$("#loginVisibilite{{$suivi->id}}").change(function(){  
var visibilite = $("#loginVisibilite{{$suivi->id}}").val();
var suiviID = $("#suiviID{{$suivi->id}}").val()
if(visibilite==""){
alert("please select an option");
}else{
$.ajax({
url: '{{url("/admin/banSuivi")}}',
data: 'visibilite=' + visibilite + '&suiviID=' + suiviID,
type: 'get',
success:function(response){
console.log(response);  
}
});
}

});

$("#loginnVisibilite{{$suivi->id}}").change(function(){  
var visibilite = $("#loginnVisibilite{{$suivi->id}}").val();
var suiviID = $("#suiviID{{$suivi->id}}").val()
if(visibilite==""){
alert("please select an option");
}else{
$.ajax({
url: '{{url("/admin/banSuivi")}}',  
data: 'visibilite=' + visibilite + '&suiviID=' + suiviID,
type: 'get',
success:function(response){
console.log(response);
}
});
}

});
@endforeach
});
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script>
$(document).ready(function(){

@foreach($action_bakups as $suivi)

$("#loginVisibilite{{$suivi->id}}").change(function(){  
var visibilite = $("#loginVisibilite{{$suivi->id}}").val();
var suiviID = $("#suiviID{{$suivi->id}}").val()
if(visibilite==""){
alert("please select an option");
}else{
$.ajax({
url: '{{url("/admin/banSuivi")}}',
data: 'visibilite=' + visibilite + '&suiviID=' + suiviID,
type: 'get',
success:function(response){
console.log(response);  
}
});
}

});

$("#loginnVisibilite{{$suivi->id}}").change(function(){  
var visibilite = $("#loginnVisibilite{{$suivi->id}}").val();
var suiviID = $("#suiviID{{$suivi->id}}").val()
if(visibilite==""){
alert("please select an option");
}else{
$.ajax({
url: '{{url("/admin/banSuivi")}}',  
data: 'visibilite=' + visibilite + '&suiviID=' + suiviID,
type: 'get',
success:function(response){
console.log(response);
}
});
}

});
@endforeach
});
</script>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
if (event.target == modal) {
modal.style.display = "none";
}
}
</script>

<script>
    $( document ).ready(function() {
    
    "use strict";
    
    var todo = function() { 
        $('.todo-list .todo-item input').click(function() {
        if($(this).is(':checked')) {
            $(this).parent().parent().parent().toggleClass('complete');
        } else {
            $(this).parent().parent().parent().toggleClass('complete');
        }
    });
    
    $('.todo-nav .all-task').click(function() {
        $('.todo-list').removeClass('only-active');
        $('.todo-list').removeClass('only-complete');
        $('.todo-nav li.active').removeClass('active');
        $(this).addClass('active');
    });
    
    $('.todo-nav .active-task').click(function() {
        $('.todo-list').removeClass('only-complete');
        $('.todo-list').addClass('only-active');
        $('.todo-nav li.active').removeClass('active');
        $(this).addClass('active');
    });
    
    $('.todo-nav .completed-task').click(function() {
        $('.todo-list').removeClass('only-active');
        $('.todo-list').addClass('only-complete');
        $('.todo-nav li.active').removeClass('active');
        $(this).addClass('active');
    });
    
    $('#uniform-all-complete input').click(function() {
        if($(this).is(':checked')) {
            $('.todo-item .checker span:not(.checked) input').click();
        } else {
            $('.todo-item .checker span.checked input').click();
        }
    });
    
    $('.remove-todo-item').click(function() {
        $(this).parent().remove();
    });
    };
    
    todo();
    
    $(".add-task").keypress(function (e) {
        if ((e.which == 13)&&(!$(this).val().length == 0)) {
            $('<div class="todo-item"><div class="checker"><span class=""><input type="checkbox"></span></div> <span>' + $(this).val() + '</span> <a href="javascript:void(0);" class="float-right remove-todo-item"><i class="icon-close"></i></a></div>').insertAfter('.todo-list .todo-item:last-child');
            $(this).val('');
        } else if(e.which == 13) {
            alert('Please enter new task');
        }
        $(document).on('.todo-list .todo-item.added input').click(function() {
            if($(this).is(':checked')) {
                $(this).parent().parent().parent().toggleClass('complete');
            } else {
                $(this).parent().parent().parent().toggleClass('complete');
            }
        });
        $('.todo-list .todo-item.added .remove-todo-item').click(function() {
            $(this).parent().remove();
        });
    });
});
</script>
 
                        <!-- end section -->

                           
                    
                </div>
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
<script src="./assets/plugins/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
    <script src="js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
    <!--This page JavaScript -->
    <!--flot chart-->
    <script src="./assets/plugins/flot/jquery.flot.js"></script>
    <script src="./assets/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="js/pages/dashboards/dashboard1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="{{asset('v2/main.js')}}"></script>

</body>
</html>
