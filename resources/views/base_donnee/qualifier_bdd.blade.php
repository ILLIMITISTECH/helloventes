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
                <!--les formulaires-->
                <!--Rechercher dans ILLIMITIS ILLIMITIS Christianna from ILLIMITIS Christianna from ILLIMITIS  Christianna from ILLIMITIS 11 h 20 ajouteropportunuit.txt-->

                <div class="container px-6 mx-auto grid">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        Compléter les informations du prospects
                    </h2>
                  
                    <!-- General elements -->
             
                    <!-- Validation inputs -->
                    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <!-- Invalid input -->
                        <form action="{{route('bdd_prospectStore.qualifier', $entreprise->id)}}" method="post" class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload" enctype="multipart/form-data">
                                                     @csrf
                
                 <div class="form-group" >
                           
                            
                    <!--<div class="form-group" style="display:flex;">-->
                         <div class="1 row">
                             <br>
                            <div class="form-check">
                                <label class="form-check-label" for="flexRadioDefault1">
                                Ce prospect est-il qualifié ? 
                              </label><br><br>
                              <input class="form-check-input" type="radio" value="1" name="statut" checked>
                              <label class="form-check-label" for="flexRadioDefault1">
                                Oui
                              </label>&ensp;&ensp;&ensp;
                              <input class="form-check-input" type="radio" value="" name="statut">
                              <label class="form-check-label" for="flexRadioDefault1">
                                Non
                              </label>
                            <!--</div>-->
                            
                            
                    </div>
                       
                    </div>
                    <br>
              
                            <div style="margin-top: 3em;">
    
                                <button
                                    class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                    Valider
                                </button>
                                </form>
                              
                            </div>
                        
                    </div>
                    <!-- Inputs with icons -->
              
                </div>
                <!-- Réduire Envoyer un message Christianna from ILLIMITIS Maj+Retour pour ajouter une nouvelle ligne-->
        </div>
        </main>
    </div>
    </div>
                           
        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
    <script src="{{asset('v2/main.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>              
          
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
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('assets/plugins/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{asset('Koyalis/public/assets/js/init-alpine.js')}}"></script>
    <script src="{{asset('Koyalis/public/https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js')}}" defer></script>
    <script src="{{asset('Koyalis/public/assets/js/charts-lines.js')}}" defer></script>
    <script src="{{asset('Koyalis/public/assets/js/charts-pie.js')}}" defer></script>
    
    
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






		
		
		<!--<script type="text/javascript">-->
  <!--          $(document).ready(function() {-->
  <!--              $('input[type="checkbox"]').click(function() {-->
  <!--                  var inputValue = $(this).attr("value");-->
  <!--                  $("." + inputValue).toggle();-->
                    <!--/*alert("Checkbox " + inputValue + " is selected");*/-->
  <!--              });-->
  <!--          });-->
  <!--      </script>-->
<script>
		    $("#qualifier").hide();
		    $("#rappeler").hide();
		    $("#nonqualifier").hide();
		    $("#rv").hide();
		    $("#date_depot_agreement").hide();
		    $("#date_depot").hide();
		    $("#commercial_suivi").hide();
		    $("#date_r").hide();
		    $("#commentaire_qualifier").hide();
		    $("#demande_r").hide();
		    $("#raison_nonqualifier").hide();
		    $("#date_prevoyer").hide();
		</script>
		
	<script>
	                $('#10000000').on('change', function() {
                      
                        $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").hide();
		                $("#date_r").hide();
		                $("#demande_r").hide();
		                $("#raison_nonqualifier").show();
		                $("#date_prevoyer").hide();
		                $("#commentaire_qualifier").hide();
                    });
                    $('#20000000').on('change', function() {
                      
                        $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").hide();
                        $("#date_r").hide();
		                $("#demande_r").hide();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").hide();
		                $("#commentaire_qualifier").hide();
                    });
                    $('#30000000').on('change', function() {
                      
                        $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").hide();
                        $("#date_r").hide();
		                $("#demande_r").hide();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").show();
		                $("#commentaire_qualifier").hide();
                    });
                    
                    // -----------------------------------------------------------
		    
	
		            $('#1000000').on('change', function() {
                      
                        $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").hide();
		                $("#date_r").show();
		                $("#commentaire_qualifier").hide();
		                $("#demande_r").show();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").hide();
                    });
                    $('#2000000').on('change', function() {
                      
                        $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").hide();
                        $("#date_r").show();
		                $("#demande_r").hide();
		                $("#commentaire_qualifier").hide();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").hide();
                    });
                    $('#3000000').on('change', function() {
                      
                        $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").hide();
                        $("#date_r").show();
		                $("#demande_r").hide();
		                $("#commentaire_qualifier").hide();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").hide();
                    });
                    $('#4000000').on('change', function() {
                      
                        $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").hide();
                        $("#date_r").show();
                        $("#commentaire_qualifier").hide();
		                $("#demande_r").hide();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").hide();
                    });
                    $('#5000000').on('change', function() {
                      
                        $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").hide();
                        $("#date_r").show();
                        $("#commentaire_qualifier").hide();
		                $("#demande_r").hide();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").hide();
                    });
                    // -----------------------------------------------------------
		    
		            $('#100000').on('change', function() {
                      
                        $("#rv").show();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").show();
		                $("#commentaire_qualifier").show();
		                $("#date_r").hide();
		                $("#demande_r").hide();
		                $("#raison_nonqualifier").hide();
		    $("#date_prevoyer").hide();
                    });
                    $('#200000').on('change', function() {
                      
                        $("#rv").hide();
                        $("#date_depot").show();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").show();
                        $("#date_r").hide();
                        $("#commentaire_qualifier").show();
		                $("#demande_r").hide();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").hide();
                    });
                    $('#300000').on('change', function() {
                      
                        $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").show();
		                $("#commercial_suivi").show();
		                $("#commentaire_qualifier").show();
                        $("#date_r").hide();
		                $("#demande_r").hide();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").hide();
                    });
                    $('#400000').on('change', function() {
                      
                        $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").show();
                        $("#date_r").hide();
                        $("#commentaire_qualifier").show();
		                $("#demande_r").hide();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").hide();
                    });
                    // -----------------------------------------------------------
                $(document).ready(function(){
                    $('#types').on('change', function() {
                      if ( this.value == '1')
                      {
                        $("#qualifier").show();
                        $("#rappeler").hide();
		                $("#nonqualifier").hide();
		                $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commentaire_qualifier").hide();
		                $("#commercial_suivi").hide();
                        $("#date_r").hide();
		                $("#demande_r").hide();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").hide();
                      }
                      
                     
                      
                    });
                    
                    $('#types').on('change', function() {
                      if ( this.value == '2')
                      {
                        
		                $("#nonqualifier").show();
		                 $("#qualifier").hide();
                        $("#rappeler").hide();
                        $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").hide();
                        $("#date_r").hide();
                        $("#commentaire_qualifier").hide();
		                $("#demande_r").hide();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").hide();
                      }
                      
                    });
                    
                    $('#types').on('change', function() {
                      if ( this.value == '5')
                      {
                        $("#qualifier").hide();
                        $("#rappeler").show();
		                $("#nonqualifier").hide();
		                $("#rv").hide();
                        $("#date_depot").hide();
		                $("#date_depot_agreement").hide();
		                $("#commercial_suivi").hide();
                        $("#date_r").hide();
                        $("#commentaire_qualifier").hide();
		                $("#demande_r").hide();
		                $("#raison_nonqualifier").hide();
		                $("#date_prevoyer").hide();
                      }
                      
                    });
                    
                });
		</script>
		
		
		<script>
var slider = document.getElementById("customRange3");
var output = document.getElementById("demo");
output.innerHTML = slider.value;
slider.oninput = function() {
  output.innerHTML = this.value;
}
</script>

 
	
		<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
		<script>
		    
		    init: function () {
                  this.inputElements = [...this.$el.querySelectorAll("input[data-rules]")];
                  this.initDomData();
                },
                initDomData: function () {
                  this.inputElements.map((ele) => {
                  this[ele.name] = {
                    serverErrors: JSON.parse(ele.dataset.serverErrors),
                    blurred: false
                    };
                  });
                }
		</script>
		
	
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

		<script>
            var path = "{{ route('autocomplete') }}";
            $('input.typeahead').typeahead({
                source:  function (query, process) {
                return $.get(path, { query: query }, function (data) {
                        return process(data);
                    });
                }
            });
        </script>
		<!--<script>-->
  <!--      $(function () {-->
  <!--          var text1 = "existe deja";-->
  <!--         $('#nom_entreprise').autocomplete({-->
  <!--             source:function(request,response){-->
                
  <!--                 $.getJSON('?term='+request.term,function(data){-->
  <!--                      var array = $.map(data,function(row){-->
  <!--                          return {-->
  <!--                              value:row.id,-->
  <!--                              label:row.nom_entreprise,-->
  <!--                              nom_entreprise:row.nom_entreprise-->
                                
  <!--                          }-->
  <!--                      })-->

  <!--                      response($.ui.autocomplete.filter(array,request.term));-->
  <!--                 })-->
  <!--             },-->
  <!--             minLength:1,-->
  <!--             delay:500,-->
  <!--             select:function(event,ui){-->
  <!--                 $('#nom_entreprise').val(ui.item.nom_entreprise)-->
                  
  <!--             }-->
  <!--         })-->
  <!--      })-->
  <!--  </script>-->
	<script>
var slider = document.getElementById("customRange3");
var output = document.getElementById("demo");
output.innerHTML = slider.value;
slider.oninput = function() {
  output.innerHTML = this.value;
}
</script>
</body>

</html>
</body>

</html>