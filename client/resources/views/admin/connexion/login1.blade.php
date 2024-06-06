<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    
    <!--====== Title ======-->
    <title>Koyalis</title>
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--====== Favicon Icon ======-->
        <link rel="short icon" href="{{asset('collov2/assets/images/icon.png')}}">
        
    <!--====== Animate CSS ======-->
    <link rel="stylesheet" href="{{asset('collov2/assets/css/animate.css')}}">
        
    <!--====== Magnific Popup CSS ======-->
    <link rel="stylesheet" href="{{asset('collov2/assets/css/magnific-popup.css')}}">
        
    <!--====== Slick CSS ======-->
    <link rel="stylesheet" href="{{asset('collov2/assets/css/slick.css')}}">
        
    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="{{asset('collov2/assets/css/LineIcons.css')}}">
        
    <!--====== Font Awesome CSS ======-->
    <link rel="stylesheet" href="{{asset('collov2/assets/css/font-awesome.min.css')}}">
        
    <!--====== Bootstrap CSS ======-->
    <link rel="stylesheet" href="{{asset('collov2/assets/css/bootstrap.min.css')}}">
    
    <!--====== Default CSS ======-->
    <link rel="stylesheet" href="{{asset('collov2/assets/css/default.css')}}">
    
    <!--====== Style CSS ======-->
    <link rel="stylesheet" href="{{asset('collov2/assets/css/style.css')}}">
    
</head>

<body>
    <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->    
   
   
    <!--====== PRELOADER PART START ======-->

   

    <!--====== PRELOADER PART ENDS ======-->
    
    <!--====== HEADER PART START ======-->
    
    <header class="header-area">
        <div class="navbar-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- navbar area -->
        
        <div id="home" class="header-hero bg_cover" style="background-image: url({{asset('collov2/assets/images/banner-bg.svg')}}">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6" style=" margin-top: 70px; ">
                        <div class="subscribe-area wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                            <div class="row">
                                <div class="col-lg-12"   style="text-align: center;">
                                    <div class="subscribe-content mt-45">
                                        <!-- <h2 class="subscribe-title">Bienvenue sur :</h2> -->
                                        <img src="v2/assets/images/logo-illimitis.png" alt="logo" >
                                    </div>
                                </div>
                               
                                    <br> <br> <br> <br>  <br> <br> 
                                         
                                     <p>Login : admin@gmail.com<br> 
                                    Password : admin123 </p>
                                <div class="col-lg-12" style="text-align: center;">
                                     
                                <h6> @if (session('message'))
                                            <div class="alert alert-danger" role="alert">
                                                {{ session('message') }}
                                            </div>  
                                        @endif</h6>
                                    <div class=" mt-20">
                                        <form action="{{ url('connexion') }}" id="loginForm" method="post">
                                            {{ csrf_field() }}
                                               <span class="subscribe-form" style="padding-bottom: 10px;"><input type="text" placeholder="example@gmail.com" title="Please enter you username" required="" value="" name="email" id="email" class="form-control"></span> <br>
                                               <span class="subscribe-form" style="padding-bottom: 10px;"><input type="password" title="Please enter your password" placeholder="******" required="" value="" name="password" id="password" class="form-control"></span>  <br>
                                                <button class="main-btn">Connexion</button>
                                        </form>
                                        <br>
                                        <!--<p>
                                        @if(Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">{{ __('Mot de passe oublié?') }}</a>
                                        @endif
                                        </p>-->
                                        
                                        <p>
                                        @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="forgot-password-link">
                                        {{ __('Mot de passe oublié?') }}
                                    </a>
                                @endif
                                        </p>
                                    </div>
                                </div>
                             </div> <!-- row -->
                        </div> <!-- subscribe area -->
                    </div>
                </div> <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-hero-image text-center wow fadeIn" data-wow-duration="1.3s" data-wow-delay="1.4s">
                           <p>&nbsp;</p>
                           <p>&nbsp;</p>
                           <p>&nbsp;</p>

                        </div> <!-- header hero image -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
            <div id="particles-1" class="particles"></div>
        </div> <!-- header hero -->
    </header>
    

    
    <!--====== BACK TOP TOP PART START ======-->

    <a href="#" class="back-to-top"><i class="lni-chevron-up"></i></a>

    <!--====== BACK TOP TOP PART ENDS ======-->   
    
    <!--====== PART START ======-->
    
<!--
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-"></div>
            </div>
        </div>
    </section>
-->
    
    <!--====== PART ENDS ======-->




    <!--====== Jquery js ======-->
    <script src="{{asset('collov2/assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('collov2/assets/js/vendor/modernizr-3.7.1.min.js')}}"></script>
    
    <!--====== Bootstrap js ======-->
    <script src="{{asset('collov2/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('collov2/assets/js/bootstrap.min.js')}}"></script>
    
    <!--====== Plugins js ======-->
    <script src="{{asset('collov2/assets/js/plugins.js')}}"></script>
    
    <!--====== Slick js ======-->
    <script src="{{asset('collov2/assets/js/slick.min.js')}}"></script>
    
    <!--====== Ajax Contact js ======-->
    <script src="{{asset('collov2/assets/js/ajax-contact.js')}}"></script>
    
    <!--====== Counter Up js ======-->
    <script src="{{asset('collov2/assets/js/waypoints.min.js')}}"></script>
    <script src="{{asset('collov2/assets/js/jquery.counterup.min.js')}}"></script>
    
    <!--====== Magnific Popup js ======-->
    <script src="{{asset('collov2/assets/js/jquery.magnific-popup.min.js')}}"></script>
    
    <!--====== Scrolling Nav js ======-->
    <script src="{{asset('collov2/assets/js/jquery.easing.min.js')}}"></script>
    <script src="{{asset('collov2/assets/js/scrolling-nav.js')}}"></script>
    
    <!--====== wow js ======-->
    <script src="{{asset('collov2/assets/js/wow.min.js')}}"></script>
    
    <!--====== Particles js ======-->
    <script src="{{asset('collov2/assets/js/particles.min.js')}}"></script>
    
    <!--====== Main js ======-->
    <script src="{{asset('collov2/assets/js/main.js')}}"></script>
    
</body>

</html>
