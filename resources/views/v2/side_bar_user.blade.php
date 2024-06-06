
<div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>    
                <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                     <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div> 
                      <div class="scrollbar-sidebar">
                       
                            @if(Auth::user()->nom_role == "directeur")
                            <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">Accueil</li>
                                <li>
                                    <a href="/v3/admin/dashboard">
                                        <i class="metismenu-icon pe-7s-home"></i>
                                       Tableau de Bord
                                    </a>  
                                </li>
                                <li>
                                    <a href="/mesperformances">
                                        <i class="metismenu-icon pe-7s-graph1"></i>
                                       Mes performances
                                    </a>  
                                </li>
                                
                            <li class="app-sidebar__heading">Mes actions</li>
                                <li>
                                    <a href="/user_action">
                                        <i class="metismenu-icon pe-7s-bell">
                                        </i>En retard
                                    </a>
                                </li>
                                <li>
                                    <a href="/user_action_mois">
                                        <i class="metismenu-icon pe-7s-date">
                                        </i>Ce mois
                                    </a>
                                   
                                </li>
                                 <li>
                                    <a href="/user_toute_action">
                                        <i class="metismenu-icon pe-7s-albums">
                                        </i>Toutes mes actions
                                    </a>
                                   
                                </li>
                                 <li>
                                    <a href="/actions/create">
                                        <i class="metismenu-icon pe-7s-plus" >
                                        </i>Assigner une Action
                                    </a>
                                   
                                </li>
                                 <li>
                                    <a href="/create_projet">
                                        <i class="metismenu-icon pe-7s-plus" >
                                        </i>Assigner un Projet
                                    </a>
                                   
                                </li>
                                
                                <li>
                                    <a href="/mes_projets">
                                        <i class="metismenu-icon pe-7s-file" >
                                        </i>Mes Projets
                                    </a>
                                   
                                </li>
                                
                                  <li>
                                    <a href="/tous_projets">
                                        <i class="metismenu-icon pe-7s-folder" >
                                        </i>Tous les Projets
                                    </a>
                                   
                                </li>
                                
                                 <li>
                                    <a href="/action_cloture">
                                        <i class="metismenu-icon pe-7s-close-circle" >
                                        </i>Action clôturées
                                    </a>
                                   
                                </li>
                                <!--<li>
                                    <a href="/historique_performance">
                                        <i class="metismenu-icon pe-7s-date">
                                        </i> Historique de performance
                                    </a>
                                   
                                </li>-->
                            </li>
                            
                            <li class="app-sidebar__heading">Les actions de ma team</li>
                                <li>
                                    <a href="/action_mateam_semaine">
                                        <i class="metismenu-icon pe-7s-server">
                                        </i>Cette semaine
                                    </a>
                                </li>
                                <li>
                                    <a href="/action_mateam_mois">
                                        <i class="metismenu-icon pe-7s-photo-gallery">
                                        </i>Ce mois
                                    </a>
                                   
                                </li>
                                
                                 <li>
                                    <a href="action_retard_mateam">
                                        <i class="metismenu-icon pe-7s-close-circle" >
                                        </i>Actions en retard
                                    </a>
                                   
                                </li>
                            </li>
                            <li class="app-sidebar__heading">Usage de l'App</li>
                                <li>
                                    <a href="/qui_est_en_ligne">
                                        <i class="metismenu-icon pe-7s-clock">
                                        </i>Qui est en ligne?
                                    </a>
                                </li>
                                <li>
                                    <a href="/derniers_updates">
                                        <i class="metismenu-icon pe-7s-check">
                                        </i>Derniers updates
                                    </a>
                                </li>
                                <!--<li>
                                    <a href="/historique_performance_mateam">
                                        <i class="metismenu-icon pe-7s-date">
                                        </i> Historique de performance
                                    </a>
                                   
                                </li>
                            </li>
                            <li class="app-sidebar__heading">Mes Feedbacks</li>
                                <li>
                                    <a href="/feedback/donner">
                                        <i class="metismenu-icon pe-7s-server"></i>
                                      Donner un feedback
                                    </a>  
                                </li>
                                
                                <li>
                                    <a href="/lister/feedback/recu">
                                        <i class="metismenu-icon pe-7s-server"></i>
                                      Feedbacks reçus
                                    </a>  
                                </li>
                            </li>
                            <li class="app-sidebar__heading">Mes Appréciations</li>
                                <li>
                                    <a href="/appreciation/donner">
                                        <i class="metismenu-icon pe-7s-server"></i>
                                      Donner une appréciation
                                    </a>  
                                </li>
                                <li>
                                    <a href="/liste/appreciation/recu">
                                        <i class="metismenu-icon pe-7s-server"></i>
                                      Appréciations reçues
                                    </a>  
                                </li>
                                <li>
                                    <a href="/appreciation/demander">
                                        <i class="metismenu-icon pe-7s-server"></i>
                                      Ajouter les criteres
                                    </a>  
                                </li>
                                
                                
                                
                                <!--<li>-->
                                <!--    <a href="/all_activites">-->
                                <!--        <i class="metismenu-icon pe-7s-server">-->
                                <!--        </i>Les activitées en live-->
                                <!--    </a>-->
                                <!--</li>-->
                                
                                <!--<li>-->
                                <!--    <a href="/strategiques">-->
                                <!--        <i class="metismenu-icon pe-7s-server">-->
                                <!--        </i>Strategiques-->
                                <!--    </a>-->
                                <!--</li>-->
                               
                                <!--<li>
                                    <a href="/voir_action_dg">
                                        <i class="metismenu-icon pe-7s-server">
                                        </i>Voir toutes les actions
                                    </a>
                                </li>
                                
                                
                                <li>
                                    <a href="/directeur_actionAcloture">
                                        <i class="metismenu-icon pe-7s-close-circle">
                                        </i>Actions cloturées
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="/ajout_action_dg">
                                        <i class="metismenu-icon pe-7s-next-2">
                                        </i>Assigner une action 
                                    </a>
                                </li>-->
                                
                            </ul>
                            </div>
                            @elseif(Auth::user()->nom_role == "responsable")
                            <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">Accueil</li>
                                <li>
                                    <a href="/v3/admin/dashboard">
                                        <i class="metismenu-icon pe-7s-home"></i>
                                       Tableau de Bord
                                    </a>  
                                </li>
                                 <li>
                                    <a href="/mesperformances">
                                        <i class="metismenu-icon pe-7s-graph1"></i>
                                       Mes performances
                                    </a>  
                                </li>
                            <li class="app-sidebar__heading">Mes actions</li>
                                <li>
                                    <a href="/user_action">
                                        <i class="metismenu-icon pe-7s-bell">
                                        </i>En retard
                                    </a>
                                </li>
                                <li>
                                    <a href="/user_action_mois">
                                        <i class="metismenu-icon pe-7s-date">
                                        </i>Ce mois
                                    </a>
                                   
                                </li>
                                <li>
                                    <a href="/user_toute_action">
                                        <i class="metismenu-icon pe-7s-albums">
                                        </i>Toutes mes actions
                                    </a>
                                   
                                </li>
                                 <li>
                                    <a href="/actions/create">
                                        <i class="metismenu-icon pe-7s-plus" >
                                        </i>Assigner une Action
                                    </a>
                                   
                                </li>
                                 <li>
                                    <a href="/create_projet">
                                        <i class="metismenu-icon pe-7s-plus" >
                                        </i>Assigner un Projet
                                    </a>
                                </li>
                                 <li>
                                    <a href="/mes_projets">
                                        <i class="metismenu-icon pe-7s-file" >
                                        </i>Mes Projets
                                    </a>
                                </li>
                                <li>
                                    <a href="/projets_ma_team">
                                        <i class="metismenu-icon pe-7s-folder" >
                                        </i>Les Projets de ma team
                                    </a>
                                   
                                </li>
                                </li>
                                 <li>
                                    <a href="/action_cloture">
                                        <i class="metismenu-icon pe-7s-close-circle" >
                                        </i>Action clôturées
                                    </a>
                                   
                                </li>
                                
                                </li>
                            <li class="app-sidebar__heading">Usage de l'App</li>
                                <li>
                                    <a href="/qui_est_en_ligne">
                                        <i class="metismenu-icon pe-7s-clock">
                                        </i>Qui est en ligne?
                                    </a>
                                </li>
                                <li>
                                    <a href="/derniers_updates">
                                        <i class="metismenu-icon pe-7s-check">
                                        </i>Derniers updates
                                    </a>
                                </li>
                                <!--<li>
                                    <a href="/historique_performance">
                                        <i class="metismenu-icon pe-7s-date">
                                        </i> Historique de performance
                                    </a>
                                   
                                </li>
                            </li>
                            
                            <li class="app-sidebar__heading">Les actions de ma team</li>
                                <li>
                                    <a href="/action_mateam_semaine">
                                        <i class="metismenu-icon pe-7s-date">
                                        </i>Cette semaine
                                    </a>
                                </li>
                                <li>
                                    <a href="/action_mateam_mois">
                                        <i class="metismenu-icon pe-7s-date">
                                        </i>Ce mois
                                    </a>
                                   
                                </li>
                                
                                 <li>
                                    <a href="/action_retard_mateam">
                                        <i class="metismenu-icon pe-7s-plus" >
                                        </i>Actions en retard
                                    </a>
                                   
                                </li>
                                <li>
                                    <a href="/historique_performance_mateam">
                                        <i class="metismenu-icon pe-7s-date">
                                        </i> Historique de performance
                                    </a>
                                   
                                </li>
                            <li class="app-sidebar__heading">Mes Feedbacks</li>
                                <li>
                                    <a href="/feedback/donner">
                                        <i class="metismenu-icon pe-7s-server"></i>
                                      Donner un feedback
                                    </a>  
                                </li>
                                <li>
                                    <a href="/lister/feedback/recu">
                                        <i class="metismenu-icon pe-7s-server"></i>
                                      Feedbacks reçus
                                    </a>  
                                </li>
                               
                            </li>
                            <li class="app-sidebar__heading">Mes Appréciations</li>
                                <li>
                                    <a href="/appreciation/donner">
                                        <i class="metismenu-icon pe-7s-server"></i>
                                      Donner une appréciation
                                    </a>  
                                </li>
                                <li>
                                    <a href="/liste/appreciation/recu">
                                        <i class="metismenu-icon pe-7s-server"></i>
                                      Appréciations reçues
                                    </a>  
                                </li>
                                <li>
                                    <a href="/appreciation/demander">
                                        <i class="metismenu-icon pe-7s-server"></i>
                                      Ajouter les criteres
                                    </a>  
                                </li>-->
                            
                                
                                
                                
                        </ul>
                            </div>
                            @elseif(Auth::user()->nom_role == "utilisateur")
                            <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">Accueil</li>
                                <li>
                                    <a href="/v3/admin/dashboard">
                                        <i class="metismenu-icon pe-7s-home"></i>
                                       Tableau de Bord
                                    </a>  
                                </li>
                                 <li>
                                    <a href="/mesperformances">
                                        <i class="metismenu-icon pe-7s-graph1"></i>
                                       Mes performances
                                    </a>  
                                </li>
                            <li class="app-sidebar__heading">Mes actions</li>
                                <li>
                                    <a href="/user_action">
                                        <i class="metismenu-icon pe-7s-bell">
                                        </i>En retard
                                    </a>
                                </li>
                                <li>
                                    <a href="/user_action_mois">
                                        <i class="metismenu-icon pe-7s-date">
                                        </i>Ce mois
                                    </a>
                                   
                                </li>
                                <li>
                                    <a href="/user_toute_action">
                                        <i class="metismenu-icon pe-7s-albums">
                                        </i>Toutes mes actions
                                    </a>
                                   
                                </li>
                                 <li>
                                    <a href="/actions/create">
                                        <i class="metismenu-icon pe-7s-plus" >
                                        </i>Assigner une Action
                                    </a>
                                   
                                </li>
                                <!-- <li>-->
                                <!--    <a href="/create_projet">-->
                                <!--        <i class="metismenu-icon pe-7s-plus" >-->
                                <!--        </i>Assigner un Projet-->
                                <!--    </a>-->
                                   
                                <!--</li>-->
                                
                                 <li>
                                    <a href="/mes_projets_user">
                                        <i class="metismenu-icon pe-7s-file" >
                                        </i>Mes Projets
                                    </a>
                                   
                                </li>
                                </li>
                                 <li>
                                    <a href="/action_cloture">
                                        <i class="metismenu-icon pe-7s-close-circle" >
                                        </i>Action clôturées
                                    </a>
                                   
                                </li>
                                </li>
                            <li class="app-sidebar__heading">Usage de l'App</li>
                                <li>
                                    <a href="/qui_est_en_ligne">
                                        <i class="metismenu-icon pe-7s-clock">
                                        </i>Qui est en ligne?
                                    </a>
                                </li>
                                <li>
                                    <a href="/derniers_updates">
                                        <i class="metismenu-icon pe-7s-check">
                                        </i>Derniers updates
                                    </a>
                                </li>
                                <!--<li>
                                    <a href="/historique_performance">
                                        <i class="metismenu-icon pe-7s-date">
                                        </i> Historique de performance
                                    </a>
                                   
                                </li>
                            </li>
                            <li class="app-sidebar__heading">Mes Feedbacks</li>
                                <li>
                                    <a href="/feedback/donner">
                                        <i class="metismenu-icon pe-7s-server"></i>
                                      Donner un feedback
                                    </a>  
                                </li>
                                <li>
                                    <a href="/lister/feedback/recu">
                                        <i class="metismenu-icon pe-7s-server"></i>
                                      Feedbacks reçus
                                    </a>  
                                </li>
                            </li>
                            <li class="app-sidebar__heading">Mes Appréciations</li>
                                <li>
                                    <a href="/appreciation/donner">
                                        <i class="metismenu-icon pe-7s-server"></i>
                                      Donner une appréciation
                                    </a>  
                                </li>
                                
                                <li>
                                    <a href="/liste/appreciation/recu">
                                        <i class="metismenu-icon pe-7s-server"></i>
                                      Appréciations reçues
                                    </a>  
                                </li>
                                -->
                                
                        </ul>
                            </div>
                        @elseif(Auth::user()->nom_role == "prospect")
                            <ul class="vertical-nav-menu">
                            
                            <li class="app-sidebar__heading">Mes Feedbacks</li>
                                <li>
                                    <a href="/feedback/demander">
                                        <i class="metismenu-icon pe-7s-server"></i>
                                      Demande de Feedback
                                    </a>  
                                </li>
                                <li>
                                    <a href="/liste/feedback/donner">
                                        <i class="metismenu-icon pe-7s-server"></i>
                                      Donner un feedback
                                    </a>  
                                </li>
                                <li>
                                    <a href="/liste/feedback/recus">
                                        <i class="metismenu-icon pe-7s-server"></i>
                                      Feedbacks reçus
                                    </a>  
                                </li>
                            </li>
                            <li class="app-sidebar__heading">Mes Appréciations</li>
                                <li>
                                    <a href="/apprecier/demanders">
                                        <i class="metismenu-icon pe-7s-server"></i>
                                      Demande d'appreciation
                                    </a>  
                                </li>
                                <li>
                                    <a href="/liste/apprecier/donner">
                                        <i class="metismenu-icon pe-7s-server"></i>
                                      Donner une appréciation
                                    </a>  
                                </li>
                                
                                <li>
                                    <a href="/liste/apprecier/recu">
                                        <i class="metismenu-icon pe-7s-server"></i>
                                      Appréciations reçues
                                    </a>  
                                </li>
                                
                                
                        </ul>
                            @endif
                            
                    </div>


                    
</div>  
       
<style>
   li  a {
       text-decoration : none;
       
       
   }

  .vertical-nav-menu li a{
      color:white;
  }
  
  
</style>