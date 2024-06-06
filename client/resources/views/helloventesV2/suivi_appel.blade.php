<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hello Ventes</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('Koyalis/public/assets/css/tailwind.output.css')}}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
  <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"/>
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
                        Ajouter les résultats de l’appel : 
                        
              
                    </h2>
                    <!-- General elements -->
                    
                  
            <br>
            <br>
        <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
                    <!-- Validation inputs -->
                    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <!-- Invalid input -->
                         <form action="{{route('suivi_appel.update', $entreprises->id)}}" enctype="multipart/form-data" method="post" class="form-horizontal" id="demo1-upload" >
                    {{ csrf_field() }}
                    
                        <div class="form-group" style="display:flex;">
                            
                            <div class="form-control">
                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                           Prospect : {{$entreprises->nom_entreprise}}
                                        </span>
                                         <input name="prospect_appel_id" value="{{$entreprises->id}}" type="hidden" />
                                       
                            </div>
                             
                      
                            
                        </div>
                         <br>
                         
                        <div class="form-group" >
                            <div class="form-control">
                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            résultats 
                                        </span> (<span style=" color:red;">*</span>)
                                    </label>
                                   <select name="type" required style="width:400px;" id="types"  class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input" style="width:400px;">
                                      <option value="" disabled selected>Selectionner le resultats </option>
                                      @foreach($resultat as $resultats)
                                      <option value="{{$resultats->id}}">{{$resultats->libelle}}</option>
                                      @endforeach
                                    </select>
                                
                            </div>
                            
                            <!----1--------------->
                         <div class="row" id="qualifier">
                             <br>
                            
                                <b>Remplir les informations</b><br><br>
                                 <div class="form-group" style="display:flex;">
                            <div class="form-control"  style="width:400px;">
                                    <label class="block text-sm" >
                                        <span class="text-gray-700 dark:text-gray-400">
                                           Domaine validé
                                        </span> 
                                    </label>
                                    <select name="domaine_valider"   style="width:400px;"  class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input" style="width:400px;">
                                      <option value="" disabled selected>Selectionner le domaine</option>
                                      @foreach($domaine as $domaines)
                                      <option value="{{$domaines->id}}">{{$domaines->libelle}}</option>
                                      @endforeach
                                    </select>
                            </div>
                            <br>
                            <div class="form-control">
                                      <label class="block text-sm" style="margin-left:50px;width:400px;">
                                        <span class="text-gray-700 dark:text-gray-400">
                                          Personne à contacter 
                                        </span> 
                                        <input  name="personne_a_contacter" type="text" 
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"
                                            placeholder="prenom et nom" style="width:400; " />
                                    </label>
                            </div> 
                            </div>
                            <br>
                            <div class="form-group" style="display:flex;">
                            <div class="form-control">
                                      <label class="block text-sm" style="width:400px;">
                                        <span class="text-gray-700 dark:text-gray-400">
                                           Téléphone de la personne
                                        </span> 
                                        <input  name="contact_personne" type="text" 
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"
                                            placeholder="Ex: 00" style="width:400; " />
                                    </label>
                            </div> <br>
                            <div class="form-control">
                                      <label class="block text-sm" style="margin-left:50px;width:400px;">
                                        <span class="text-gray-700 dark:text-gray-400">
                                           Email de la personne
                                        </span> 
                                        <input  name="email_personne" type="email" 
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"
                                          style="width:400; " />
                                    </label>
                            </div> <br></div>
                        </div>
                    </div>
                    
                    <!---------3---------->
                    <div class="row" id="rappeler">
                        <br>
                        <div class="form-control">
                                      <label class="block text-sm" style="width:400px;">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Date rappel 
 
                                        </span> 
                                        <input  name="date_rappel" type="date" 
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"
                                             style="width:400; " />
                                    </label>
                            </div> 
                    </div>
                        <!---------4---------->
                        <div class="row" id="rv"><br>
                            <div class="form-control">
                                      <label class="block text-sm" style="width:400px;">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            La date du rendez-vous  
 
                                        </span> 
                                        <input  name="date_rendezvous" type="date" 
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"
                                             style="width:400; " />
                                    </label>
                            </div> <br>
                        </div>
                      
                            <div style="margin-top: 3em;">
                            <button type="submit"
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
  <script>
                                    // Example starter JavaScript for disabling form submissions if there are invalid fields
                                    (function() {
                                        'use strict';
                                        window.addEventListener('load', function() {
                                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                            var forms = document.getElementsByClassName('needs-validation');
                                            // Loop over them and prevent submission
                                            var validation = Array.prototype.filter.call(forms, function(form) {
                                                form.addEventListener('submit', function(event) {
                                                    if (form.checkValidity() === false) {
                                                        event.preventDefault();
                                                        event.stopPropagation();
                                                    }
                                                    form.classList.add('was-validated');
                                                }, false);
                                            });
                                        }, false);
                                    })();
                                </script>
                           
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
    
   
    
<script src="{{asset('v2/main.js')}}"></script>
<script>
jQuery(document).ready(function() {   
   FormValidation.init();
});
    $(function() {
        $(".datepicker").datepicker();
        $(".uniform_on").uniform();
        $(".chzn-select").chosen();
        $('.textarea').wysihtml5();
        $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index+1;
            var $percent = ($current/$total) * 100;
            $('#rootwizard').find('.bar').css({width:$percent+'%'});
            // If it's the last tab then hide the last button and show the finish instead
            if($current >= $total) {
                $('#rootwizard').find('.pager .next').hide();
                $('#rootwizard').find('.pager .finish').show();
                $('#rootwizard').find('.pager .finish').removeClass('disabled');
            } else {
                $('#rootwizard').find('.pager .next').show();
                $('#rootwizard').find('.pager .finish').hide();
            }
        }});
        $('#rootwizard .finish').click(function() {
            alert('Finished!, Starting over!');
            $('#rootwizard').find("a[href*='tab1']").trigger('click');
        });
    });
    </script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   
 <script>
        document.getElementById("inp").addEventListener("change", function() {
          let v = parseInt(this.value);
          if (v < 1) this.value = 1;
          if (v > 50) this.value = 50;
            });
    </script>
               
               
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
 
    		y


      
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






		<script>
		    $("#qualifier").hide();
		    $("#rappeler").hide();
		    $("#rv").hide();
		</script>

		<script>
		    
                $(document).ready(function(){
                    $('#types').on('change', function() {
                      if ( this.value == '1')
                      {
                        $("#qualifier").show();
                        $("#rappeler").hide();
		                $("#rv").hide();
                      }
                      
                    });
                    
                    $('#types').on('change', function() {
                      if ( this.value == '3')
                      {
                        $("#qualifier").hide();
                        $("#rappeler").show();
		                $("#rv").hide();
                      }
                      
                    });
                    
                    $('#types').on('change', function() {
                      if ( this.value == '4')
                      {
                        $("#qualifier").hide();
                        $("#rappeler").hide();
		                $("#rv").show();
                      }
                      
                    });
                    
                    $('#types').on('change', function() {
                      if ( this.value == '2')
                      {
                        $("#qualifier").hide();
                        $("#rappeler").hide();
		                $("#rv").hide();
                      }
                      
                    });
                    
                    $('#types').on('change', function() {
                      if ( this.value == '5')
                      {
                        $("#qualifier").hide();
                        $("#rappeler").hide();
		                $("#rv").hide();
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
	
</body>

</html>