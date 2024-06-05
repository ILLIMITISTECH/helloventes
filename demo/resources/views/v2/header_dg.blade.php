 <!-- ======= Header ======= -->
  @if(Auth::user()->nom_role == "facilitateur")
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="/" class="logo d-flex align-items-center">
        <img src="{{asset('v2/assets/images/feedback.png')}}" alt="homepage" class="dark-logo" style="max-width: 100%;"/>
        
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">


        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            @if(Auth::user()->photo != null )
            <img alt="user" class="profile-pic me-2" src="{{ url('images/', Auth::user()->photo) }}" >
           @else
            <span class="profile-pic me-2" style=" background: white; color:#023E8A; font-weight:bold; font-size:18px; padding:10px;"> {{substr(Auth::user()->prenom,0,1)}}{{substr(Auth::user()->nom,0,1)}} </span>
           @endif
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{Auth::user()->prenom}}&nbsp;{{Auth::user()->nom}}</h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            
          
              <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('profile_user.editer',Auth::user()->id) }}" >
                <i class="bi bi-person"></i>
                <span>Mon profil</span>
              </a>
            </li>    
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('profil_facilitateur.editer',Auth::user()->id) }}" >
                <i class="bi bi-gear"></i>
                <span>Changer le mot de passe</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

           <!-- <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Parametre</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li> -->

           
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
               
                <span>Deconnexion</span>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->
  
  @else
   <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="/" class="logo d-flex align-items-center">
        <img src="{{asset('v2/assets/images/feedback.png')}}" alt="homepage" class="dark-logo" style="max-width: 100%;"/>
        
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">


        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            @if(Auth::user()->photo != null )
            <img alt="user" class="profile-pic me-2" src="{{ url('images/', Auth::user()->photo) }}" >
           @else
            <span class="profile-pic me-2" style=" background: white; color:#023E8A; font-weight:bold; font-size:18px; padding:10px;"> {{substr(Auth::user()->prenom,0,1)}}{{substr(Auth::user()->nom,0,1)}} </span>
           @endif
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{Auth::user()->prenom}}&nbsp;{{Auth::user()->nom}}</h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
             <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('profile_user.editer',Auth::user()->id) }}" >
                <i class="bi bi-person"></i>
                <span>Mon profil</span>
              </a>
            </li>    
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('profil_user.editer',Auth::user()->id) }}" >
                <i class="bi bi-gear"></i>
                <span>Changer le mot de passe</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

           <!-- <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Parametre</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li> -->

           
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
               
                <span>Deconnexion</span>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->
  @endif