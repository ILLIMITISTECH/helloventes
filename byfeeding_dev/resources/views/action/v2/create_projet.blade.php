<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="Performance, collaboration, Focus, Team, Productivité">
    <meta name="description"
        content="Monster Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Collaboratis </title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/monster-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('collov2/assets/images/icon.png')}}">
    <!-- Custom CSS -->
    <link href="{{asset('assets/plugins/chartist/dist/chartist.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('v2/assets/style.min.css')}}" rel="stylesheet">

</head>

<body>

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        @include('v2.header_dg')
       <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
        @include('v2.side_bar_dg')
        </div>
            <!-- End Sidebar scroll-->
                 </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Ajouter une action</h3>
                    </div>
               
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales chart -->

                <h6> 
                                                      @if (session('message'))
                                                          <div class="alert alert-success" role="alert">
                                                              {{ session('message') }}
                                                          </div>  
                                                      @endif
                                                    </h6>
                                                               <form action="{{route('create.projet')}}" method="post" class="form-horizontal" id="demo1-upload" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                            <div class="tab-pane" id="tab1">

                                                  <fieldset>
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput">Libellé<b style="color:red;">*</b></label>
                                                      <div class="controls">
                                                     
                                                      <input name="libelle" type="text" class="form-control" placeholder="l'action">
                                                      </div>                      
                                                    </div>
                                                    
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput">Deadline</label>
                                                      <div class="controls">
                                                      
                                                      <input name="deadline" type="date" class="form-control" placeholder="date de l action">   
                                                                                                                     </div>                    
                                                    </div>
                                                    
                                                    
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput">Priorité</label>
                                                      <div class="controls">
                                                     
                                                      <select name="priorite" class="form-control">
                                                                      <option value="none" selected="" disabled="">Risque</option>
                                                                      <option value="Faible(F)">Faible (F)</option>
                                                                      <option value="Moins(M)">Moyen (M)</option>
                                                                      <option value="Elevé(E)">Elevé (E)</option>
                                                                    </select>
                                                      </div>                      
                                                    </div>
                                                    <div class="control-group">
                                                      
                                                      <div class="controls">
                                                     
                                                      <input name="pourcentage" id="postcode" type="hidden" value="00" class="form-control" placeholder="pourcentage...%">
                                                      </div>                      
                                                    </div>
                                               
                                      
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput">Sélectionner le Responsable du Projet<b style="color:red;">*</b></label>
                                                      <div class="controls">
                                                     
                                                      <select name="responsable" class="form-control">
                                                                      <option value="none" selected="" disabled="">Sélectionner le Responsable du Projet</option>
                                                                      @foreach($agents as $agent)
                                                                      <option value="{{$agent->id}}">{{$agent->prenom}} {{$agent->nom}}</option>
                                                                      @endforeach                                    
                                                                    </select>
                                                      </div>                      
                                                    </div>
                                                    <div class="control-group">
                                                      <!--<label class="control-label" for="focusedInput">Sélectionner le Backup</label>-->
                                                      <!--<h3 class="card-title">Sélectionner le Backup <b style="color:red;">*</b></</h3>-->

                                                            <div class="row" id="formulaire">
                                                                <div class="card col-lg-12 mt-4 mb-10">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Ajouter l'action </h5>
                                                                        <div id="inputFormRow">
                                                                            <div class="input-group row mb-3">
                                                                                <label class="control-label" for="focusedInput">Sélectionner le Backup<b style="color:red;">*</b></label>                                                                                  <select name="agent_id[]" class="form-control">
                                                                                  <option value="none" selected="" disabled="">Sélectionner le Backup</option>
                                                                                  @foreach($agents as $agent)
                                                                                  <option value="{{$agent->id}}">{{$agent->prenom}} {{$agent->nom}}</option>
                                                                                  @endforeach                                    
                                                                                </select>
                                                                                <!--<div class="col-md-2 mt-10">                
                                                                                    <button id="removeRow" type="button" class="btn btn-danger"><i class="bi bi-trash"></i> </button>
                                                                                </div> -->
                                                                            </div>
                                                                            <div class="control-group">
                                                      <label class="control-label" for="focusedInput">Libellé de l'action<b style="color:red;">*</b></label>
                                                      <div class="controls">
                                                     
                                                      <input name="libelle_action[]" type="text" class="form-control" placeholder="l'action">
                                                      </div>                      
                                                    </div>
                                                    
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput">Deadline</label>
                                                      <div class="controls">
                                                      
                                                      <input name="deadlines[]" type="date" class="form-control" placeholder="date de l'action">   
                                                                                                                     </div>                    
                                                    </div>
                                                    
                                                    
                                                    <div class="control-group">
                                                      <label class="control-label" for="focusedInput">Priorité</label>
                                                      <div class="controls">
                                                     
                                                      <select name="priorites[]" class="form-control">
                                                                      <option value="none" selected="" disabled="">Risque</option>
                                                                      <option value="Faible(F)">Faible (F)</option>
                                                                      <option value="Moins(M)">Moyen (M)</option>
                                                                      <option value="Elevé(E)">Elevé (E)</option>
                                                                    </select>
                                                      </div>                      
                                                    </div>
                                                                        </div>
                                                                        <div id="newRow"></div>
                                                                        <button id="addRow" type="button" class="btn btn-info mt-5">Ajouter plus</button>
                                                                    </div>
                                                                </div>
                                                            </div>
						                          </div>
						
                                                    
                                                      <!--<div class="controls">-->
                                                     
                                                      <!--<select name="bakup" class="form-control">-->
                                                      <!--                <option value="none" selected="" disabled="">Sélectionner le Backup</option>-->
                                                      <!--                @foreach($agents as $agent)-->
                                                      <!--                <option value="{{$agent->id}}">{{$agent->prenom}} {{$agent->nom}}</option>-->
                                                      <!--                @endforeach                                    -->
                                                      <!--              </select>-->
                                                      <!--</div>                      -->
                                                  
                                                    <!--<div class="control-group">
                                                      <label class="control-label" for="focusedInput">Select date de réunion</label>
                                                      <div class="controls">
                                                     
                                                      <select name="reunion_id" class="form-control">
                                                                      <option value="none" selected="" disabled="">Select date de réunion</option>
                                                                      @foreach($reunions as $reunion)
                                                                      <option value="{{$reunion->id}}">{{$reunion->date}}</option>
                                                                      @endforeach
                                    
                                                                    </select>
                                                      </div>                      
                                                    </div>-->
                                                    
                                                  </fieldset>
                                                
                                            </div>

                                            
                                            <!-- <ul class="pager wizard">
                                                <li class="previous first" style="display:none;"><a href="javascript:void(0);">First</a></li>
                                                <li class="previous"><a href="javascript:void(0);">Précédent</a></li>
                                                 <li class="next last" style="display:none;"><a href="javascript:void(0);">Last</a></li> 
                                                <li class="next"><a href="javascript:void(0);">Suivant</a></li>
                                                <li class="next finish" style="display:none;"><a href="javascript:;">Enregistrer</a></li>
                                            </ul> -->
                                                <div class="form-actions pull-right" style="margin-top:20px;">
                                                    <button type="submit" class="btn " style="background:#43928e"><strong style="color:white" >Enregistrer</strong></button>
                                                </div>
                                                 </div>
                                            </form>
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
    <script src="./assets/plugins/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
    <script src="js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
    <!--This page JavaScript -->
    <!--flot chart-->
    <script src="./assets/plugins/flot/jquery.flot.js"></script>
    <script src="./assets/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="js/pages/dashboards/dashboard1.js"></script>
    
      <script src="https://cdn.metroui.org.ua/v4.3.2/js/metro.min.js"></script>
<script src="{{asset('v2/main.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<script src="{!! asset('assets/js/script.js') !!}"></script>

 <script type="text/javascript">
            // add row
            $("#addRow").click(function () {
                var html = '';
                html += '<div id="inputFormRow">';
                html += '<div class="input-group row mb-3">';
                html += ' <select name="agent_id[]" class="form-control">';
                  html += ' <option value="none" selected="" disabled="">Sélectionner le Backup</option>';
                   html += ' @foreach($agents as $agent)';
                html += '   <option value="{{$agent->id}}">{{$agent->prenom}} {{$agent->nom}}</option>';
                   html += ' @endforeach';                                    
               html += '  </select>';
   
                 html += ' <div class="control-group">';
                        html += ' <label class="control-label" for="focusedInput">Libellé de l action<b style="color:red;">*</b></label>';
                      html += '   <div class="controls">';
                      html += '   <input name="libelle_action[]" type="text" class="form-control" placeholder="l action">';
                        html += '  </div> ';                 
                      html += ' </div>';
                      html += ' <div class="control-group">';
                      html += '   <label class="control-label" for="focusedInput">Deadline</label>';
                        html += '  <div class="controls">';
                        html += '  <input name="deadlines[]" type="date" class="form-control" placeholder="date de l action">';
                      html += '  </div>';
                      html += '  </div>';
                      html += ' <div class="control-group">';
                        html += '  <label class="control-label" for="focusedInput">Priorité</label>';
                         html += ' <div class="controls">';
                         html += ' <select name="priorites[]" class="form-control">';
                              html += '<option value="none" selected="" disabled="">Risque</option>';
                             html += ' <option value="Faible(F)">Faible (F)</option>';
                             html += ' <option value="Moins(M)">Moyen (M)</option>';
                              html += '<option value="Elevé(E)">Elevé (E)</option>';
                            html += '</select>';
                     html += ' </div>  ';
                 html += ' </div>';
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