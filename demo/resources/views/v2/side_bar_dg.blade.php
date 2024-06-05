
                <!-- Sidebar navigation-->
                @if(Auth::user()->nom_role == "directeur")
               
          <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/v3/admin/dashboard" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16"><path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/></svg>
                            <span class="hide-menu" style="padding-left: 10px; padding-right: 10px; color:#6352ca">Tableau de bord</span></a>
                        </li>
                     
	          <br>
	           <li class="active" style="padding-left: 15px; padding-right: 10px;">
	               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-award-fill" viewBox="0 0 16 16"><path d="m8 0 1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864 8 0z"/><path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/></svg>
                        <a href="#" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar-heading"> Mes Feedbacks </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"href="/feedback/donner" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-server" viewBox="0 0 16 16"><path d="M1.333 2.667C1.333 1.194 4.318 0 8 0s6.667 1.194 6.667 2.667V4c0 1.473-2.985 2.667-6.667 2.667S1.333 5.473 1.333 4V2.667z"/><path d="M1.333 6.334v3C1.333 10.805 4.318 12 8 12s6.667-1.194 6.667-2.667V6.334a6.51 6.51 0 0 1-1.458.79C11.81 7.684 9.967 8 8 8c-1.966 0-3.809-.317-5.208-.876a6.508 6.508 0 0 1-1.458-.79z"/><path d="M14.667 11.668a6.51 6.51 0 0 1-1.458.789c-1.4.56-3.242.876-5.21.876-1.966 0-3.809-.316-5.208-.876a6.51 6.51 0 0 1-1.458-.79v1.666C1.333 14.806 4.318 16 8 16s6.667-1.194 6.667-2.667v-1.665z"/></svg>
                                <span class="hide-menu"style="padding-left: 10px; padding-right: 10px;"> Donner un feedback</span></a>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"href="/feedback_parsource" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hdd-stack" viewBox="0 0 16 16"><path d="M14 10a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1h12zM2 9a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1a2 2 0 0 0-2-2H2z"/><path d="M5 11.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-2 0a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM14 3a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12zM2 2a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z"/><path d="M5 4.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-2 0a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/></svg>
                                <span class="hide-menu"style="padding-left: 10px; padding-right: 10px;">  Feedbacks reçus</span></a>
                            </li>
                            </ul>
	          </li><br>
                          <li class="active" style="padding-left: 15px; padding-right: 10px;">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16"><path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/><path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/><path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/></svg>
                        <a href="#" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar-heading"> Utilisation de l'app</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">   
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="/qui_est_en_ligne" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-reception-4" viewBox="0 0 16 16"><path d="M0 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2zm4-3a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-5zm4-3a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-8zm4-3a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v11a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-11z"/></svg>
                                <span class="hide-menu"style="padding-left: 10px; padding-right: 10px;">Qui est en ligne?</span></a>
                            </li>
                             <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="/derniers_updates" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-reception-4" viewBox="0 0 16 16"><path d="M0 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2zm4-3a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-5zm4-3a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-8zm4-3a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v11a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-11z"/></svg>
                                <span class="hide-menu"style="padding-left: 10px; padding-right: 10px;">Qui n'utilise pas l'app ?</span></a>
                            </li>
                           
                        </ul>
	          </li>
                        
                           
                           
                     
                    </ul>

                </nav>
                
                @elseif(Auth::user()->nom_role == "responsable")
                 
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/v3/admin/dashboard" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16"><path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/></svg>
                            <span class="hide-menu" style="padding-left: 10px; padding-right: 10px; color:#6352ca"><b>Tableau de bord</b></span></a>
                        </li>
                
	          <br>
	           <li class="active" style="padding-left: 15px; padding-right: 10px;">
	               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-award-fill" viewBox="0 0 16 16"><path d="m8 0 1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864 8 0z"/><path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/></svg>
                        <a href="#" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar-heading"> Mes Feedbacks </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"href="/feedback/donner" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-server" viewBox="0 0 16 16"><path d="M1.333 2.667C1.333 1.194 4.318 0 8 0s6.667 1.194 6.667 2.667V4c0 1.473-2.985 2.667-6.667 2.667S1.333 5.473 1.333 4V2.667z"/><path d="M1.333 6.334v3C1.333 10.805 4.318 12 8 12s6.667-1.194 6.667-2.667V6.334a6.51 6.51 0 0 1-1.458.79C11.81 7.684 9.967 8 8 8c-1.966 0-3.809-.317-5.208-.876a6.508 6.508 0 0 1-1.458-.79z"/><path d="M14.667 11.668a6.51 6.51 0 0 1-1.458.789c-1.4.56-3.242.876-5.21.876-1.966 0-3.809-.316-5.208-.876a6.51 6.51 0 0 1-1.458-.79v1.666C1.333 14.806 4.318 16 8 16s6.667-1.194 6.667-2.667v-1.665z"/></svg>
                                <span class="hide-menu"style="padding-left: 10px; padding-right: 10px;"> Donner un feedback</span></a>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"href="/feedback_parsource" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hdd-stack" viewBox="0 0 16 16"><path d="M14 10a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1h12zM2 9a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1a2 2 0 0 0-2-2H2z"/><path d="M5 11.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-2 0a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM14 3a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12zM2 2a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z"/><path d="M5 4.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-2 0a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/></svg>
                                <span class="hide-menu"style="padding-left: 10px; padding-right: 10px;">  Feedbacks reçus</span></a>
                            </li>
                            </ul>
	          </li><br>
                          <li class="active" style="padding-left: 15px; padding-right: 10px;">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16"><path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/><path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/><path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/></svg>
                        <a href="#" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar-heading"> Utilisation de l'app</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">   
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="/qui_est_en_ligne" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-reception-4" viewBox="0 0 16 16"><path d="M0 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2zm4-3a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-5zm4-3a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-8zm4-3a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v11a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-11z"/></svg>
                                <span class="hide-menu"style="padding-left: 10px; padding-right: 10px;">Qui est en ligne?</span></a>
                            </li>
                             <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="/derniers_updates" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-reception-4" viewBox="0 0 16 16"><path d="M0 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2zm4-3a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-5zm4-3a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-8zm4-3a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v11a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-11z"/></svg>
                                <span class="hide-menu"style="padding-left: 10px; padding-right: 10px;">Qui n'utilise pas l'app ?</span></a>
                            </li>
                           
                        </ul>
	          </li>
                        
                           
                           
                     
                    </ul>

                </nav>
                
                    @elseif(Auth::user()->nom_role == "adminF")
                
               <!-- ======= Sidebar ======= -->
  

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="/dashboard/feedback">
          <i class="bi bi-grid"></i>
          <span>Tableau de bord</span>
        </a>
      </li><!-- End Dashboard Nav -->
        <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Agents</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/voir_agents_assistance">
              <i class="bi bi-circle"></i><span>Voir tous les Agents</span>
            </a>
          </li>
           <li>
            <a href="/ajouter_agents">
              <i class="bi bi-circle"></i><span>Ajouter des agents</span>
            </a>
          </li>
          
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-navfacilitateur" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Facilitateurs</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-navfacilitateur" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/facilitateurs">
              <i class="bi bi-circle"></i><span>Listes</span>
            </a>
          </li>
           <li>
            <a href="/facilitateurs/create">
              <i class="bi bi-circle"></i><span>Ajouter</span>
            </a>
          </li>
        </ul>
      </li>
       <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-navcollapseentreprises" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Entreprises</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-navcollapseentreprises" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/voir_lesentreprises">
              <i class="bi bi-circle"></i><span>Voir les entreprises</span>
            </a>
          </li>
           <li>
            <a href="/ajouter_entreprise">
              <i class="bi bi-circle"></i><span>Ajouter des entreprises</span>
            </a>
          </li>
          
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Sources feedbacks</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/ajout_source">
              <i class="bi bi-circle"></i><span>Ajouter des sources</span>
            </a>
          </li>
          <li>
            <a href="/liste_sources">
              <i class="bi bi-circle"></i><span>Liste des sources</span>
            </a>
          </li>
          <!--<li>-->
          <!--  <a href="/feedback/demander">-->
          <!--    <i class="bi bi-circle"></i><span>Demande de feedback</span>-->
          <!--  </a>-->
          <!--</li>-->
          
        </ul>
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-navclients" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Clients</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-navclients" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/lister_clients">
              <i class="bi bi-circle"></i><span>Listes</span>
            </a>
          </li>
           <li>
            <a href="/ajouter_clients">
              <i class="bi bi-circle"></i><span>Ajouter</span>
            </a>
          </li>
        </ul>
      </li>
      
      
      
      
       <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Suivis</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/voir/suivi">
              <i class="bi bi-circle"></i><span>Voir les suivis</span>
            </a>
          </li>
          
        </ul>
      </li>
          <!--<li>-->
          <!--  <a href="/feedback_parsource">-->
          <!--    <i class="bi bi-circle"></i><span>Feedback reçu</span>-->
          <!--  </a>-->
          <!--</li>-->
    </ul>
  <!-- End Sidebar-->
                <!-- End Sidebar navigation -->
               
                
                @elseif(Auth::user()->nom_role == "nn")
                 
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/dashboard/feedback" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16"><path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/></svg>
                            <span class="hide-menu" style="padding-left: 10px; padding-right: 10px; color:#6352ca"><b>Tableau de bord</b></span></a>
                        </li>
             
	          <br>
	          <li class="active" style="padding-left: 15px; padding-right: 10px;">
	               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-award-fill" viewBox="0 0 16 16"><path d="m8 0 1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864 8 0z"/><path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/></svg>
                        <a href="#" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar-heading"> Source feedback </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                            <!--<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"href="#" aria-expanded="false">-->
                            <!--    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-server" viewBox="0 0 16 16"><path d="M1.333 2.667C1.333 1.194 4.318 0 8 0s6.667 1.194 6.667 2.667V4c0 1.473-2.985 2.667-6.667 2.667S1.333 5.473 1.333 4V2.667z"/><path d="M1.333 6.334v3C1.333 10.805 4.318 12 8 12s6.667-1.194 6.667-2.667V6.334a6.51 6.51 0 0 1-1.458.79C11.81 7.684 9.967 8 8 8c-1.966 0-3.809-.317-5.208-.876a6.508 6.508 0 0 1-1.458-.79z"/><path d="M14.667 11.668a6.51 6.51 0 0 1-1.458.789c-1.4.56-3.242.876-5.21.876-1.966 0-3.809-.316-5.208-.876a6.51 6.51 0 0 1-1.458-.79v1.666C1.333 14.806 4.318 16 8 16s6.667-1.194 6.667-2.667v-1.665z"/></svg>-->
                            <!--    <span class="hide-menu"style="padding-left: 10px; padding-right: 10px;"> Voir tous les Agents</span></a>-->
                            <!--</li>-->
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"href="/ajout_source" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hdd-stack" viewBox="0 0 16 16"><path d="M14 10a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1h12zM2 9a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1a2 2 0 0 0-2-2H2z"/><path d="M5 11.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-2 0a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM14 3a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12zM2 2a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z"/><path d="M5 4.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-2 0a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/></svg>
                                <span class="hide-menu"style="padding-left: 10px; padding-right: 10px;">  Ajouter des source</span></a>
                            </li>
                            </ul>
	          </li><br>
	           <li class="active" style="padding-left: 15px; padding-right: 10px;">
	               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-award-fill" viewBox="0 0 16 16"><path d="m8 0 1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864 8 0z"/><path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/></svg>
                        <a href="#" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar-heading"> Agents </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"href="/voir_agents_assistance" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-server" viewBox="0 0 16 16"><path d="M1.333 2.667C1.333 1.194 4.318 0 8 0s6.667 1.194 6.667 2.667V4c0 1.473-2.985 2.667-6.667 2.667S1.333 5.473 1.333 4V2.667z"/><path d="M1.333 6.334v3C1.333 10.805 4.318 12 8 12s6.667-1.194 6.667-2.667V6.334a6.51 6.51 0 0 1-1.458.79C11.81 7.684 9.967 8 8 8c-1.966 0-3.809-.317-5.208-.876a6.508 6.508 0 0 1-1.458-.79z"/><path d="M14.667 11.668a6.51 6.51 0 0 1-1.458.789c-1.4.56-3.242.876-5.21.876-1.966 0-3.809-.316-5.208-.876a6.51 6.51 0 0 1-1.458-.79v1.666C1.333 14.806 4.318 16 8 16s6.667-1.194 6.667-2.667v-1.665z"/></svg>
                                <span class="hide-menu"style="padding-left: 10px; padding-right: 10px;"> Voir tous les Agents</span></a>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"href="/ajouter_agents" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hdd-stack" viewBox="0 0 16 16"><path d="M14 10a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1h12zM2 9a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1a2 2 0 0 0-2-2H2z"/><path d="M5 11.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-2 0a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM14 3a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12zM2 2a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z"/><path d="M5 4.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-2 0a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/></svg>
                                <span class="hide-menu"style="padding-left: 10px; padding-right: 10px;">  Ajouter des agents</span></a>
                            </li>
                           
                            </ul>
	          </li><br>
	          
	          
                        
                           
                           
                     
                    </ul>

                </nav>
                
                @elseif(Auth::user()->nom_role == "utilisateur")
                
               <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                       <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/v3/admin/dashboard" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16"><path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/></svg>
                            <span class="hide-menu" style="padding-left: 10px; padding-right: 10px; color:#6352ca"><b>Tableau de bord</b></span></a>
                        </li>
                      <br>
                       <li class="active" style="padding-left: 15px; padding-right: 10px;">
	               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-award-fill" viewBox="0 0 16 16"><path d="m8 0 1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864 8 0z"/><path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/></svg>
                        <a href="#" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar-heading"> Mes Feedbacks </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="/feedback/donner" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-server" viewBox="0 0 16 16">
  <path d="M1.333 2.667C1.333 1.194 4.318 0 8 0s6.667 1.194 6.667 2.667V4c0 1.473-2.985 2.667-6.667 2.667S1.333 5.473 1.333 4V2.667z"/>
  <path d="M1.333 6.334v3C1.333 10.805 4.318 12 8 12s6.667-1.194 6.667-2.667V6.334a6.51 6.51 0 0 1-1.458.79C11.81 7.684 9.967 8 8 8c-1.966 0-3.809-.317-5.208-.876a6.508 6.508 0 0 1-1.458-.79z"/>
  <path d="M14.667 11.668a6.51 6.51 0 0 1-1.458.789c-1.4.56-3.242.876-5.21.876-1.966 0-3.809-.316-5.208-.876a6.51 6.51 0 0 1-1.458-.79v1.666C1.333 14.806 4.318 16 8 16s6.667-1.194 6.667-2.667v-1.665z"/>
</svg>
                                <span class="hide-menu"style="padding-left: 10px; padding-right: 10px;"> Donner un feedback</span></a>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="/feedback_parsource" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hdd-stack" viewBox="0 0 16 16">
  <path d="M14 10a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1h12zM2 9a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1a2 2 0 0 0-2-2H2z"/>
  <path d="M5 11.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-2 0a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM14 3a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12zM2 2a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z"/>
  <path d="M5 4.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-2 0a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
</svg>
                                <span class="hide-menu"style="padding-left: 10px; padding-right: 10px;">  Feedbacks reçus</span></a>
                            </li>
                             </ul>
	          </li>
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
               
 @elseif(Auth::user()->nom_role == "prospect")
 
 
 <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="/dashboard/Prospect">
          <i class="bi bi-grid"></i>
          <span>Tableau de bord</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Feedback</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/feedback/demander">
              <i class="bi bi-circle"></i><span>Demander un feedback</span>
            </a>
          </li>
          <li>
            <a href="/liste/feedback/donner">
              <i class="bi bi-circle"></i><span>Donner un feedback</span>
            </a>
          </li>
          <li>
            <a href="/liste/feedback/recus">
              <i class="bi bi-circle"></i><span>Feedback reçu</span>
            </a>
          </li>
          <!--<li>-->
          <!--  <a href="/feedback/demander">-->
          <!--    <i class="bi bi-circle"></i><span>Demande de feedback</span>-->
          <!--  </a>-->
          <!--</li>-->
          
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Actions</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/enregistrer_actions">
              <i class="bi bi-circle"></i><span>Enregistrer</span>
            </a>
          </li>
          <li>
            <a href="/liste_actions">
              <i class="bi bi-circle"></i><span>Toutes les actions</span>
            </a>
          </li>
          
        </ul>
      </li>
          <!--<li>-->
          <!--  <a href="/feedback_parsource">-->
          <!--    <i class="bi bi-circle"></i><span>Feedback reçu</span>-->
          <!--  </a>-->
          <!--</li>-->
    </ul>
  <!-- End Sidebar-->
                <!-- End Sidebar navigation -->
 
  @elseif(Auth::user()->nom_role == "facilitateur")
 
 
 <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="/dashboard/facilitateur">
          <i class="bi bi-grid"></i>
          <span>Tableau de bord</span>
        </a>
      </li><!-- End Dashboard Nav -->

   
    
        </li>
      <!--<li class="nav-item">-->
      <!--  <a class="nav-link collapsed" data-bs-target="#forms-navcollapseentreprises" data-bs-toggle="collapse" href="#">-->
      <!--    <i class="bi bi-journal-text"></i><span>Entreprises</span><i class="bi bi-chevron-down ms-auto"></i>-->
      <!--  </a>-->
      <!--  <ul id="forms-navcollapseentreprises" class="nav-content collapse " data-bs-parent="#sidebar-nav">-->
      <!--    <li>-->
      <!--      <a href="/voir_lesentreprises">-->
      <!--        <i class="bi bi-circle"></i><span>Voir les entreprises</span>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--     <li>-->
      <!--      <a href="/ajouter_entreprise">-->
      <!--        <i class="bi bi-circle"></i><span>Ajouter</span>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--     <li>-->
      <!--      <a href="/lister_entreprise_facilitateur">-->
      <!--        <i class="bi bi-circle"></i><span>Lister</span>-->
      <!--      </a>-->
      <!--    </li>-->
          
      <!--  </ul>-->
      <!--</li>-->
    
        
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Mes clients</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/lister_clients_facilitateur">
              <i class="bi bi-circle"></i><span>Voir</span>
            </a>
          </li>
          <!--<li>-->
          <!--  <a href="/ajouter_clientsFa">-->
          <!--    <i class="bi bi-circle"></i><span>Ajouter</span>-->
          <!--  </a>-->
          <!--  </li>-->
        
    </ul>
     </li>
     
      <li class="nav-item"> 
            <a class="nav-link collapsed" data-bs-target="#components-navf" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Mes participants</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-navf" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="/liste_utilisateurs">
              <i class="bi bi-circle"></i><span>Voir</span>
            </a>
          </li>
          <li>
            <a href="/file-import-export">
              <i class="bi bi-circle"></i><span>Importer</span>
            </a>
          </li>
          <li>
            <a href="/qui_est_en_ligne_byfeeding">
              <i class="bi bi-circle"></i><span>Onboarding</span>
            </a>
          </li>
          <li>
            <a href="/ajout_agents">
              <i class="bi bi-circle"></i><span>Ajouter</span>
            </a>
          </li>
          </ul>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-navS" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Sources feedbacks</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-navS" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/ajout_source">
              <i class="bi bi-circle"></i><span>Ajouter </span>
            </a>
          </li>
          <li>
            <a href="/liste_sourceF">
              <i class="bi bi-circle"></i><span>Liste des sources</span>
            </a>
          </li>
          <!--<li>-->
          <!--  <a href="/feedback/demander">-->
          <!--    <i class="bi bi-circle"></i><span>Demande de feedback</span>-->
          <!--  </a>-->
          <!--</li>-->
          
        </ul>
  
  <!-- End Sidebar-->
                <!-- End Sidebar navigation -->
 
               
               @elseif(Auth::user()->nom_role == "entreprise")
                 @php   $source = DB::table('source_feedbacks')->where('entreprise_id', Auth::user()->entreprise)->orwhere('entreprise_id', Auth::user()->entreprise_2)->orderBy('id', 'desc')->first(); 
                 
                @endphp
               <!-- ======= Sidebar ======= -->
  

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="/dashboard/feedback">
          <i class="bi bi-grid"></i>
          <span>Tableau de bord</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Feedbacks</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/feedback/donner">
              <i class="bi bi-circle"></i><span>Donner un feedback</span>
            </a>
          </li>
          @if($source->statut == 1 and $source->phase == 2)
          <li>
            <a href="/feedback_parsource">
              <i class="bi bi-circle"></i><span>Feedbacks reçus</span>
            </a>
          </li>
          @endif
          <!--<li>-->
          <!--  <a href="/feedback/demander">-->
          <!--    <i class="bi bi-circle"></i><span>Demande de feedback</span>-->
          <!--  </a>-->
          <!--</li>-->
          
        </ul>
      </li>
    @if($source->statut == 1 and $source->phase == 2)
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Plan d'action</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/enregistrer_actions">
              <i class="bi bi-circle"></i><span>Ajouter</span>
            </a>
          </li>
           <li>
            <a href="/liste_actions">
              <i class="bi bi-circle"></i><span>Toutes les actions</span>
            </a>
          </li>
           <li>
            <a href="/suivi/byfeeding">
              <i class="bi bi-circle"></i><span>Suivi</span>
            </a>
          </li>
        </ul>
      </li>
      
     
  
          <!--<li>-->
          <!--  <a href="/feedback_parsource">-->
          <!--    <i class="bi bi-circle"></i><span>Feedback reçu</span>-->
          <!--  </a>-->
          <!--</li>-->
    @if(Auth::user()->a_contacter == "responsable")
        <li class="nav-item">
            <a class="nav-link " href="/rapport_globale_responsable" target="_blank">
              <i class="bi bi-grid"></i>
              <span>Rapport global</span>
            </a>
        </li>
    @endif   
    @endif
    </ul>
    
      
   
  <!-- End Sidebar-->
                <!-- End Sidebar navigation -->
               
@endif
<style>



.dropdown-toggle {
  white-space: nowrap; }
  .dropdown-toggle::after {
    display: inline-block;
    margin-left: 0.255em;
    vertical-align: 0.255em;
    content: "";
    border-top: 0.3em solid;
    border-right: 0.3em solid transparent;
    border-bottom: 0;
    border-left: 0.3em solid transparent; }
  .dropdown-toggle:empty::after {
    margin-left: 0; }

.dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  display: none;
  float: left;
  min-width: 10rem;
  padding: 0.5rem 0;
  margin: 0.125rem 0 0;
  font-size: 1rem;
  color: #212529;
  text-align: left;
  list-style: none;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 0.25rem; }

.dropdown-menu-left {
  right: auto;
  left: 0; }

.dropdown-menu-right {
  right: 0;
  left: auto; }

@media (min-width: 576px) {
  .dropdown-menu-sm-left {
    right: auto;
    left: 0; }
  .dropdown-menu-sm-right {
    right: 0;
    left: auto; } }

@media (min-width: 768px) {
  .dropdown-menu-md-left {
    right: auto;
    left: 0; }
  .dropdown-menu-md-right {
    right: 0;
    left: auto; } }

@media (min-width: 992px) {
  .dropdown-menu-lg-left {
    right: auto;
    left: 0; }
  .dropdown-menu-lg-right {
    right: 0;
    left: auto; } }

@media (min-width: 1200px) {
  .dropdown-menu-xl-left {
    right: auto;
    left: 0; }
  .dropdown-menu-xl-right {
    right: 0;
    left: auto; } }

.dropup .dropdown-menu {
  top: auto;
  bottom: 100%;
  margin-top: 0;
  margin-bottom: 0.125rem; }

.dropup .dropdown-toggle::after {
  display: inline-block;
  margin-left: 0.255em;
  vertical-align: 0.255em;
  content: "";
  border-top: 0;
  border-right: 0.3em solid transparent;
  border-bottom: 0.3em solid;
  border-left: 0.3em solid transparent; }

.dropup .dropdown-toggle:empty::after {
  margin-left: 0; }

.dropright .dropdown-menu {
  top: 0;
  right: auto;
  left: 100%;
  margin-top: 0;
  margin-left: 0.125rem; }

.dropright .dropdown-toggle::after {
  display: inline-block;
  margin-left: 0.255em;
  vertical-align: 0.255em;
  content: "";
  border-top: 0.3em solid transparent;
  border-right: 0;
  border-bottom: 0.3em solid transparent;
  border-left: 0.3em solid; }

.dropright .dropdown-toggle:empty::after {
  margin-left: 0; }

.dropright .dropdown-toggle::after {
  vertical-align: 0; }

.dropleft .dropdown-menu {
  top: 0;
  right: 100%;
  left: auto;
  margin-top: 0;
  margin-right: 0.125rem; }

.dropleft .dropdown-toggle::after {
  display: inline-block;
  margin-left: 0.255em;
  vertical-align: 0.255em;
  content: ""; }

.dropleft .dropdown-toggle::after {
  display: none; }

.dropleft .dropdown-toggle::before {
  display: inline-block;
  margin-right: 0.255em;
  vertical-align: 0.255em;
  content: "";
  border-top: 0.3em solid transparent;
  border-right: 0.3em solid;
  border-bottom: 0.3em solid transparent; }

.dropleft .dropdown-toggle:empty::after {
  margin-left: 0; }

.dropleft .dropdown-toggle::before {
  vertical-align: 0; }

.dropdown-menu[x-placement^="top"], .dropdown-menu[x-placement^="right"], .dropdown-menu[x-placement^="bottom"], .dropdown-menu[x-placement^="left"] {
  right: auto;
  bottom: auto; }

.dropdown-divider {
  height: 0;
  margin: 0.5rem 0;
  overflow: hidden;
  border-top: 1px solid #e9ecef; }

.dropdown-item {
  display: block;
  width: 100%;
  padding: 0.25rem 1.5rem;
  clear: both;
  font-weight: 400;
  color: #212529;
  text-align: inherit;
  white-space: nowrap;
  background-color: transparent;
  border: 0; }
  .dropdown-item:hover, .dropdown-item:focus {
    color: #16181b;
    text-decoration: none;
    background-color: #f8f9fa; }
  .dropdown-item.active, .dropdown-item:active {
    color: #fff;
    text-decoration: none;
    background-color: #007bff; }
  .dropdown-item.disabled, .dropdown-item:disabled {
    color: #6c757d;
    pointer-events: none;
    background-color: transparent; }

.dropdown-menu.show {
  display: block; }

.dropdown-header {
  display: block;
  padding: 0.5rem 1.5rem;
  margin-bottom: 0;
  font-size: 0.875rem;
  color: #6c757d;
  white-space: nowrap; }

.dropdown-item-text {
  display: block;
  padding: 0.25rem 1.5rem;
  color: #212529; }

	          </style>