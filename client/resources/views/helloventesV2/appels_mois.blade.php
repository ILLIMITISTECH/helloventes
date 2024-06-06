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
              @php          $today = date('d');
                            $mois = date('m');
                            $annee = date('Y'); 
                          @endphp                     
        <!--les formulaires-->
        <div class="container px-6 mx-auto grid">
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Statistiques des appels de ce mois
          </h2>
          @php $commerciauxd = DB::table('commerciaus')->get(); @endphp
                <div  class="col-md-3" style = "margin-top:5px" align="right" >
                                 <form action="{{route('filtrer_sta_commerciaux_appels_mois')}}" method="get" >
                                    <select name="searchCommerciaucf" style="width:220px;height:40px"  style="margin-right:10px; display:flex;" >
                                        <option value="" disabled selected>Rechercher par commerciaux</option>
                                       @foreach($commerciauxd as $commerciauxss)
                                        <option value="{{$commerciauxss->id}}">{{$commerciauxss->prenom}} {{$commerciauxss->nom}}</option>
                                        @endforeach
                                        
                                        <!--<option onclick="window.location.href='https://dev-v1v2.helloventes.com/';" value >Tous les commerciaux</option>-->
                                    </select>
                                        <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="" type="submit">Filtrer</button>
                                </form> 
                            </div> 
                        @php  
                                  $today = date('d');
                                  $annee = date('Y');
                                  $mois = date('m');
                                  $objectifs = DB::table('commerciaus')->sum('nbre_appel_quotidien');
                                  $objectif = $objectifs * 4;
                        
                        $total_realiser = DB::table('suivi_prospects')
                            ->whereYear('created_at', $annee)
                            ->whereMonth('created_at',$mois)
                            ->count(); 
                        
                        if($objectif > 0){
                                $perfo_appels = $total_realiser * (100) / $objectif ;
                            }
                            else{
                                $perfo_appels = 0 ;
                            }
                                  @endphp
         <div class="form-group" style="display:flex" >
                            <span style="color:0063ed;margin-left:150px;"
                                class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">

                            Objectifs : {{$objectif}} 
                            </span>
                            <span style="color:0063ed;margin-left:50px;"
                                class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">

                            Réalisations : {{$total_realiser}}
                            </span>
                            <span style="color:0063ed;margin-left:50px;"
                                class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">

                            Performance : {{intval($perfo_appels)}}%
                            </span>
                        </div>

                             <br>
             <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              	 @if(count($commerciaux) > 0 ) 
                 	 
            <div class="w-full overflow-x-auto">
               
            <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3" style="text-align:left; width:100px;">Commerciaux</th>
                    <!--<th class="px-4 py-3" style="text-align:center; width:100px;">Prospects à appeler</th>-->
                    <th class="px-4 py-3" style="text-align:center; width:100px;">Appels réalisés</th>
                    <th class="px-4 py-3" style="text-align:center; width:100px;">Appels du jour</th>
                    <th class="px-4 py-3" style="text-align:center; width:100px;">Qualifiés</th>
                    <th class="px-4 py-3" style="text-align:center; width:100px;">Non qualifiés</th>
                    <th class="px-4 py-3" style="text-align:center; width:100px;">A rappeler</th>
                    <th class="px-4 py-3" style="text-align:center; width:100px;">RV obtenu</th>
                    <!--<th class="px-4 py-3" style="text-align:center; width:100px;">Produits/Services à vendre</th>-->
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
               
               @foreach($commerciaux as $commercial)
                  <tr class="text-gray-700 dark:text-gray-400">
                   
                    <td class="px-4 py-3 text-sm" style="text-align:left; width:100px;">
                        
                      {{($commercial->prenom) ? $commercial->prenom : 'pas renseigné'}} {{($commercial->nom) ? $commercial->nom : 'pas renseigné'}}
                     
                    </td>
                     @php $appels_a_effectuer = DB::table('prospect_a_appellers')->where('commercial_id', $commercial->id)->where('statut', null)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->count(); @endphp
                     
                    
                    <!--<td class="px-4 py-3 text-sm" style="text-align:center; width:100px;">-->
                        
                    <!--    <a href="{{route('sta_commerciaux_appels_nbreffecter', $commercial->id)}}" data-toggle="tooltip" title="Les prospects à appeler de {{$commercial->prenom}}">-->
                    <!--  <span style="color:0063ed;"-->
                    <!--    class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">-->

                       
                    <!--             {{number_format($appels_a_effectuer)}} -->
                               
                    <!-- </span>-->
                    <!--  </a>-->
                    <!--</td>-->
                    
                    @php  
                        $appels_effectuer = DB::table('suivi_prospects')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->count();
                        $appels_effectuer_today = DB::table('suivi_prospects')->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->whereDay('created_at', $today)->count();
                    @endphp
                    
                    <td class="px-4 py-3 text-sm" style="text-align:center; width:100px;">
                        
                       <!--<a href="{{route('sta_commerciaux_appels_nbreffectuer', $commercial->id)}}" data-toggle="tooltip" title="Les prospects déjà appelé de {{$commercial->prenom}}">-->
                      <span style="color:0063ed;"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">

                                 {{number_format($appels_effectuer)}} 
                                </span>
                      <!--</a>-->
                     
                    </td>
                    
                     <td class="px-4 py-3 text-sm" style="text-align:center; width:100px;">
                        
                       <a href="{{route('sta_commerciaux_appels_nbreffectuer_today', $commercial->id)}}" data-toggle="tooltip" title="Les prospects déjà appelé de {{$commercial->prenom}}">
                      <span style="color:0063ed;"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">

                                 {{number_format($appels_effectuer_today)}} 
                                </span>
                      </a>
                     
                    </td>
                                                      @php 
                                  $appelsaqualifier = DB::table('suivi_prospects')->where('type', 1)->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->count();
                                 @endphp
                    <td style="text-align:center; width:100px;" class="px-4 py-3 text-sm">
                        
 <a href="{{route('sta_commerciaux_appels_nbrqualifier', $commercial->id)}}" data-toggle="tooltip" title="Les prospects qualifiés de {{$commercial->prenom}}">
                      <span style="color:0063ed;"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">

                                 {{number_format($appelsaqualifier)}} 
                                </span>
                      </a>
                     
                    </td>
                    
                             @php   $appelsnonqualifier = DB::table('suivi_prospects')->where('type', 2)->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->count(); 
                                  
                             @endphp
                    <td class="px-4 py-3 text-sm" style="text-align:center; width:100px;">
                        
                      <a href="{{route('sta_commerciaux_appels_nbrnonqualifier', $commercial->id)}}" data-toggle="tooltip" title="Les prospects non qualifiés de {{$commercial->prenom}}">
                      <span style="color:0063ed;"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">

                                 {{number_format($appelsnonqualifier)}} 
                                </span>
                      </a>
                     
                    </td>
                    
                    @php  $appels_arappeler = DB::table('suivi_prospects')->where('type', 5)->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->count(); @endphp
                    <td class="px-4 py-3 text-sm" style="text-align:center; width:100px;">
                        
                       <a href="{{route('sta_commerciaux_appels_nbrappeler', $commercial->id)}}" data-toggle="tooltip" title="Les prospects à rappeler de {{$commercial->prenom}}">
                      <span style="color:0063ed;"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">

                                 {{number_format($appels_arappeler)}} 
                                </span>
                      </a>
                     
                    </td>
                    
                     @php  $appels_daterv = DB::table('suivi_prospects')->where('type', 1)->where('choix_qualifier', "Rendez-vous obtenu")->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->count(); @endphp
                    <td class="px-4 py-3 text-sm" style="text-align:center; width:100px;">
                        
                      <a href="{{route('sta_commerciaux_appels_rv', $commercial->id)}}" data-toggle="tooltip" title="Rendez-vous obtenu de {{$commercial->prenom}}">
                      <span style="color:0063ed;"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">

                                 {{number_format($appels_daterv)}} 
                                </span>
                      </a>
                     
                    </td>
                    @php  $produit_avendre = DB::table('suivi_prospects')->where('type', 5)->where('commercial_id', $commercial->id)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->count(); @endphp
 <!--                   <td class="px-4 py-3 text-sm" style="text-align:center; width:100px;">-->
                        
 <!--<a href="{{route('sta_commerciaux_appels_nbrpvendre', $commercial->id)}}" data-toggle="tooltip" title="Demande de produits ou services à vendre de {{$commercial->prenom}}">-->
 <!--                     <span style="color:0063ed;"-->
 <!--                       class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">-->

 <!--                                {{number_format($produit_avendre)}} -->
 <!--                               </span>-->
 <!--                     </a>-->
                     
 <!--                   </td>-->
                    
                   
            
                   
                   
                    
                    
                    
                   
                  </tr>
                  @endforeach

                </tbody>
                
              </table>
             </div>
            
     
             @else
             
 <p>Pas d'objectifs</p>
					
                 @endif
          </div>


   <style>
  .pagination {
    list-style: none;
    margin: 0;
    display: flex;
    padding-left: 450px;
}
        
.pagination li {
    margin: 0 1px;
    font-size: 17px;
}
 
 </style> 
 
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
     <script>
        const getButton = document.getElementById('get');
        const multiInput = document.querySelector('multi-input'); 
        const values = document.querySelector('#values'); 
        
        getButton.onclick = () => {
          if (multiInput.getValues().length > 0) {
            values.textContent = `Got ${multiInput.getValues().join(' and ')}!`;
          } else {
            values.textContent = 'Got noone  :`^(.'; 
          }
        }
        
        document.querySelector('input').focus();

        </script>
        <!--Multiselector Script-->
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

</body>

</html>