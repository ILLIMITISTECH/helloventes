<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KOYALIS</title>
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
        <div class="container px-6 mx-auto grid">
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Appels d'offres
          </h2>
          <!-- CTA -->
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Client/Prospect</th>
                    <th class="px-4 py-3">Provenance</th>
                    <th class="px-4 py-3">Deadline</th>
                    <th class="px-4 py-3">Besoins du client</th>
                    <th class="px-4 py-3">Total Ht offre</th>

                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                  <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">

                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold"><a href="">
                                <h4>ECOBANK SN</h4>
                            </button>
                          </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      3 FPT
                    </td>
                    <td class="px-4 py-3 text-xs">
                      <label class="px-3 py-1 text-sm ">
                        12/03/2022
                      </label>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      <label class="px-3 py-1 text-sm ">
                        Art du Focus
                      </label>
                    </td>
                    <td>
                      <label class="px-3 py-1 text-sm ">
                        1.000.000 Fcfa
                      </label>
                    </td>


                  <tr class="text-gray-700 dark:text-gray-400">
                  <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">

                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">ORANGE SN
                            </button>
                          </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      3 FPT
                    </td>
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        320.000.000 Fcfa
                      </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      <button
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Options</button>
                    </td>

                  </tr>


                  <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">Salome
                              SABANGLE
                            </button>
                          </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      BEAFRIKALAB
                    </td>
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        130.000.000 Fcfa
                      </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      <button
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Options</button>
                    </td>
                  </tr>

                  <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">

                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold"><a
                                href="">Fallou
                                GUEYE
                              </a></button>
                          </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      FUNTECH
                    </td>
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        120.000.000 Fcfa
                      </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      <button
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Options</button>
                    </td>
                  </tr>

                  <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">

                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">

                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold"><a
                                href="">Roland
                                KYEDREBEOGO
                              </a></button>
                          </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      ILLIMITIS
                    </td>
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        320.000.000 Fcfa
                      </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      <button
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Options</button>
                    </td>
                  </tr>
                  <tr class="text-gray-700 dark:text-gray-400">

                    <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">


                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold"><a
                                href="">Christianna
                                MAISHAL
                              </a></button>
                          </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      NINFRITECH
                    </td>
                    <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        200.000.000 Fcfa
                      </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      <button
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Options</button>
                    </td>
                  </tr>

                </tbody>
              </table>
            </div>
            <div
              class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
              <span class="flex items-center col-span-3">

              </span>
              <span class="col-span-2"></span>
              <!-- Pagination -->
              <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                <nav aria-label="Table navigation">
                  <ul class="inline-flex items-center">
                    <li>
                      <button class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                        aria-label="Previous">
                        <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                          <path
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                      </button>
                    </li>
                    <li>

                      <button
                        class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">
                        <a class="page-link" href="../public/Opportunités.html">1</a>
                      </button>
                    </li>
                    <li>
                      <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                        <a class="page-link" href="">2</a>
                      </button>
                    </li>
                    <li>
                      <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                        <a class="page-link" href=""> 3</a>
                      </button>
                    </li>
                    <li>
                      <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                        <a class="page-link" href="">4</a>
                      </button>
                    </li>
                    <li>
                      <span class="px-3 py-1">...</span>
                    </li>
                    <li>
                      <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                        <a class="page-link" href="">8</a>
                      </button>
                    </li>
                    <li>
                      <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                        <a class="page-link" href="">9</a>
                      </button>
                    </li>
                    <li>
                      <button class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                        aria-label="Next">
                        <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                          <path
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                      </button>
                    </li>
                  </ul>
                </nav>
              </span>
            </div>
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