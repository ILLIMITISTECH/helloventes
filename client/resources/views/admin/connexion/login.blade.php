<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Hello Ventes</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    
    <link rel="stylesheet" href="{{asset('Koyalis/public/assets/css/tailwind.output.css')}}" />
    <script
      src="{{asset('Koyalis/public/https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js')}}" 
      defer
    ></script>
    <script src="{{asset('Koyalis/public/assets/js/init-alpine.js')}}" ></script>
    <link rel="icon" href="{{asset('icones.png')}}" />
  </head>
  <body>
     <!--<center><img style="width:400px; padding-left: 20px;" src="{{asset('Koyalis/hellovente3.png')}}" alt="logo"></center> -->
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
      <div
        class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800"
      >
        <div class="flex flex-col overflow-y-auto md:flex-row">
          <div class="h-32 md:h-auto md:w-1/2">
            <img 
              aria-hidden="true"
              class="object-cover w-full h-full dark:hidden"
              src="{{asset('ty.png')}}"
              alt="Office"
            />
            <img
              aria-hidden="true"
              class="hidden object-cover w-full h-full dark:block"
              src="{{asset('ty.png')}}"
              alt="Office"
            />
          </div>
          <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
                <center><img style="width:290px; " src="{{asset('images/LogoDigitalMind+-removebg-preview.png')}}" alt="logoDigM+"></center>
                <center><img style="width:200px; " src="https://tamtam.helloventes.com/Koyalis/hellovente3.png" alt="logo"></center> 

              <h1
                class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"
              >
                <!--Login-->
              </h1>
              <h6> @if (session('message'))
                                            <div class="alert alert-danger" role="alert">
                                                {{ session('message') }}
                                            </div>  
                                        @endif</h6>
               <form action="{{ url('connexion') }}" id="loginForm" method="post">
                                            {{ csrf_field() }}
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Votre email</span>
                <input name="email" type="text" required
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="moi@supervendeur.com"
                />
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400"> Votre mot de passe</span>
                <input name="password" required
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="***************"
                  type="password"
                />
              </label>

              <!-- You should use a button here, as the anchor is only used for the example  -->
              <button                 class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Connexion</button>

              <hr class="my-8" />

             
              <p class="mt-4">
                <a
                  class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                  href="{{ route('password.request') }}"
                >
                  Mot de passe oublié?
                </a>
              </p>
             
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
