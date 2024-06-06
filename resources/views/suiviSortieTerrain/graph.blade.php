<table class="w-full whitespace-no-wrap">
              @php 
                
              @endphp
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
              <tr class="text-gray-700 dark:text-gray-400">
                <h3 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                  Ma performance commerciale
                </h3>
                
                <div class="grid gap-6 mb-8 md:grid-cols-2">
                  <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                      Mes opportunités selon le statut
                    </h4>
                    <canvas id="pie"></canvas>
                    <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                      <!-- Chart legend -->
                      <div class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-1 bg-blue-500 rounded-full"></span>
                        <span>Offre envoyée</span>
                      </div>
                      <div class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
                        <span>Négociations</span>
                      </div>
                      <div class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
                        <span>Contrat signé</span>
                      </div>
                    </div>
                  </div>
                  
                  <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                      Evolution de mes ventes
                    </h4>
                    <canvas id="line"></canvas>
                    <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                      <!-- Chart legend -->
                      <div class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
                        <span>Objectifs</span>
                      </div>
                      <div class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
                        <span>Réalisations</span>
                      </div>
                    </div>
                  </div>
                </div>
          </table>
          
          <script src="{{asset('Koyalis/public/assets/js/charts-lines.js')}}" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/charts-pie.js')}}" defer></script>
          