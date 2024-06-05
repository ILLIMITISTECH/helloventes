                                    
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Byfeeding</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('v2/assets/img/favicon.png')}}" rel="icon">
  <link href="{{asset('v2/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/vendor/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

</head>

<body>


 
        @include('v2.header_dg')
        <aside id="sidebar" class="sidebar">
                <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                @include('v2.side_bar_dg')
            </div>
                <!-- End Sidebar scroll-->
         </aside>
    
                <!-- end side bar -->
        <main id="main" class="main">

   
    <h5>
      @if (session('message'))
                  <div class="alert alert-success" role="alert">
                  {{ session('message') }}
                  </div>  
                  @endif
    </h5>
    <h5>
      @if (session('rap'))
                  <div class="alert alert-success" role="alert">
                  {{ session('rap') }}
                  </div>  
                  @endif
    </h5>
                       <!-- formulaire -->
                              
         <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
             
              
            <div class="card-body">
                            
                                 <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Toutes les actions de {{$agent->prenom}} {{$agent->nom}}  </h4>
                                           @if($actions->isEmpty() )
                                             <p>Pas d'action</p>
                                            @else
                                   <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Libellé</th>
                                                <th class="border-top-0">Deadline</th>
                                                <th class="border-top-0">Pourcentage</th>
                                                <th class="border-top-0">Retard</th>
                                                <!--<th class="border-top-0">Options</th>-->
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                            
                                            @foreach($actions as $action) 
                                            @if($action->visibilite == 0 or $action->visibilite == null)
                                                            <tr>
                                                <td class="align-middle" data-toggle="tooltip" title="{{$action->libelle}}"> {{ \Illuminate\Support\Str::limit($action->libelle, 35, $end='...') }}</td>
                                                                    <td class="align-middle" >
                                                                        <div class="align-middle" >
                                                                                        {{$action->deadline}}
                                                                         </div>
                                                                        
                                                                     </td>
                                                                     
                                                                    <td class="align-middle" >
                                                                        <div class="align-middle" >
                                                                                        {{$action->pourcentage}}%
                                                                         </div>
                                                                        
                                                                     </td>
                                                                 
                                                                   
                                                                    @if($action->deadline < now())
                                                                    <td class="align-middle">{{intval(abs(strtotime("now") - strtotime($action->deadline))/ 86400)}} jours</td> 
                                                                    @else
                                                                    <td class="align-middle">Aucun</td>
                                                                    @endif

                                                                   
                                                                 
                                                                    
                                                                <!--</form>-->
                                                            </tr>
                                            </tbody>
                                                   
                                    
                                                            
                                                           @endif
                                                             @endforeach
                                                    
                                            
                                             
                                                                </tbody>
                                        </table>
                                        @endif
                                      </section>    
                                               <!---------------------------------------------------------------------->
                                        
                                    
                                        
                <section class="section">
            
                      <div class="row">
                        <div class="col-lg-12">
                
                          <div class="card">
                            <div class="card-body">
                             
                                 <div class="d-md-flex">
                                                <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Les actions de suivi</h4>
                                            </div> 
                                        
                                         @php    
                                            $actions = DB::table('suivi_agent_prospects')->where('agent_id', $agent->id)->get();
                                            $action_suivi = DB::table('suivi_agent_prospects')->where('email', Auth::user()->email)->get(); 
                                         @endphp
                                            @if($actions->isEmpty() )
                                             <p>Pas d'action de suivi</p>
                                            @else
                                    <table class="table table-borderless">
                                      
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Compétences</th>
                                                <th class="border-top-0">Qui vous souhaitez être dans 5 ans </th>
                                                <th class="border-top-0">Quel poste vous souhaitez être dans 5 ans</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                               
                                                        @foreach($actions as $action) 
                                                         <tr>
                                             
                                                                    <td class="align-middle" >
                                                                        @php $competence1 = DB::table('competences')->where('id', $action->competence_dev1)->first();
                                                                             $competence2 = DB::table('competences')->where('id', $action->competence_dev2)->first();
                                                                             $competence3 = DB::table('competences')->where('id', $action->competence_dev3)->first();
                                                                        @endphp
                                                                        <div class="align-middle" >
                                                                                        {{$competence1 ? $competence1->libelle : '--'}} 
                                                                                        <br>
                                                                                        {{$competence2 ? $competence2->libelle : '--'}}
                                                                                         <br>
                                                                                        {{$competence3 ? $competence3->libelle : '--'}}
                                                                         </div>
                                                                        
                                                                    </td>
                                                                 <td class="align-middle" >
                                                                       
                                                                        <div class="align-middle" >
                                                                           {{$action ? $action->souhait : '--'}}
                                                                         </div>
                                                                        
                                                                    </td>
                                                                    <td class="align-middle" >
                                                                       
                                                                        <div class="align-middle" >
                                                                           {{$action ? $action->poste_job : '--'}}
                                                                         </div>
                                                                        
                                                                    </td>
                                                        
                                                            </tr>
                                            </tbody>
                                                   
                                    
                                                            
                                                             @endforeach
                                                     @endif
                                            
                                             
                                                                </tbody>
                                        </table>
                                        
                                        
                                         </div>
                                          </div>
                                           </div>
                                            </div>
                                     
                                       </section>     
                                        
                                        
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
    
    $(function () {
   $( "#pourcent" ).change(function() {
      var max = parseInt($(this).attr('max'));
      var min = parseInt($(this).attr('min'));
      if ($(this).val() > max)
      {
          alert('Ne peut pas dépasser 100');
          //$(this).val(max);
      }
      else if ($(this).val() < min)
      {
        alert('Ne peut pas avoir une valeur negative');
          //$(this).val(min);
      }       
    }); 
});
    </script>
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
    
    <script src="{{asset('js/app-style-switcher.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('js/custom.js')}}"></script>
    <!--This page JavaScript -->
    <!--flot chart-->
    <script src="{{asset('assets/plugins/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('assets/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js')}}"></script>
    <script src="js/pages/dashboards/dashboard1.js"></script>
 <script type="text/javascript">
            // add row
            $("#addRow").click(function () {
                var html = '';
                html += '<div id="inputFormRow">';
                html += '<div class="input-group row mb-3">';
                html += ' <div class="col-md-8">';
                html += '<label for="inputEmail4" class="form-label ">Libelle : </label>';
                html += '<input type="text" name="libelle[]" class="form-control" id="inputEmail4">';
                html += ' </div> ';

                html += ' <div class="col-md-8">';
                html += '<label for="inputEmail4" class="form-label ">Deadline : </label>';
                html += '<input type="date" name="deadline[]" class="form-control" id="inputEmail4">';
                html += ' </div> ';
               
                    html += ' <div class="col-md-2 pt-7">';            
                        html += '<button id="removeRow" type="button" class="btn btn-danger"><i class="bi bi-trash"></i> </button>';
                        html += ' </div> ';
                        html += ' </div> ';
                        html += ' </div> ';
        
                $('#newRow').append(html);
            });
        
            // remove row
            $(document).on('click', '#removeRow', function () {
                $(this).closest('#inputFormRow').remove();
            });
        </script>
        <!--Multiselector Script-->
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

 
 
 
 <style>
 
      .red{
            color :red;
            font-weight : bold;
        }
        .text-nice{
            font-family: 'poppins', sans-serif;
        }
        
        .btn-green {
            background-color : #43928E ;
            color : white;
        }
        .rounded-container{
            width: 586px;
            height: 526px;
            background: white;
            border-radius: 51px;
            margin-right : auto;
            text-align : center;
        }
</style>
	
</body>

</html>