                                    
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Feedback</title>
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
                
                                        
                                        @php 
                                      
                                            $client = DB::table('client_facilitateurs')->where('entreprise_id', $client_entreprise->id)->first();
                                         
                                             $actions = DB::table('actions')->where('source', $client->source_id)->get(); 

                                           
                                        @endphp
               <div style = "margin-left: 550px; margin-top:50px"> 
                                <form action="{{route('searchpar_participant', $client_entreprise->id)}}" method="get" style="margsearchfin-top:5px;">
                                    <select name="search" style="width:220px;height:40px" required>
                                        <option value="" disabled selected>Rechercher par participants</option>
                                     
                                         
                                        @foreach($agent as $agents)
                                        <option value="{{$agents->id}}">{{$agents->prenom}} {{$agents->nom}}</option>
                                        @endforeach
                                        <option onclick="window.location.href='https://app.byfeeding.com/liste_utilisateurs';" value >Tous les utilisateurs</option>
                                    </select>
                                        <button class="btn" style="color:white; background-color:#EB3148" type="submit">Filtrer</button>
                                </form> 
                            </div>
            <div class="card-body">
                            
                                 <div class="d-md-flex">
                                                <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Tous les participants de {{$client_entreprise->libelle }} </h4>
                          <br>
                                           
                                            </div> 
                                           
                                    <table class="table stylish-table no-wrap">
                                        <thead>
                                            <tr >
                                                <th >Agent</th>
                                                <!--<th class="border-top-0">Structure</th>-->
                                                <th >Feedbacks donnés</th>
                                                <th >Feedbacks reçus</th>
                                                <th >Actions</th>
                                                <th >Relancer</th>
                                                <th >Options</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                
                                              
                                               
                                         
                                            @foreach($agent as $agen) 
                                            
                                        
                                             @php
                                             $clf = DB::table('client_facilitateurs')->where('entreprise_id',$agen->entreprise)->orwhere('entreprise_id',$agen->entreprise_2)->orderBy('id', 'desc')->first();
                                             $sourceFed = DB::table('source_feedbacks')->where('id', $clf->source_id)->orderBy('id', 'desc')->first();
                                            @endphp
                                            @php $feeddonner = DB::table('feedback')->where('source_id', $sourceFed->id)->where('agent_id', $agen->id)->get();@endphp
                                            @php $feedrecu = DB::table('feedback')->where('source_id', $sourceFed->id)->where('agents_id_choisi', $agen->id)->get();  @endphp
                                            @php $count_actions = DB::table('suivi_agent_prospects')->where('agent_id', $agen->id)->count();  @endphp
                                            
                                            @php $feeddonnerCheck = DB::table('feedback')->where('source_id', 6)->where('agent_id', $agen->id)->get();@endphp
                                            @php $feedrecuCheck = DB::table('feedback')->where('source_id',6)->where('agents_id_choisi', $agen->id)->get();  @endphp
                                                            <tr>
                                               
                                                                    <td class="align-middle" >
                                                                        <div class="align-middle" >
                                                            <a href="{{route('liste_actions.users', $agen->id)}}" >{{$agen->prenom}} {{$agen->nom}}</a>
                                                                         </div>
                                                                        
                                                                     </td>
                                                                <!--@php $entreprise_agent = DB::table('entreprises')->where('id', $agen->entreprise)->first();@endphp-->
                                                                <!--@if($entreprise_agent)-->
                                                                <!--     <td class="align-middle" >-->
                                                                <!--        <div class="align-middle" >-->
                                                                <!--                        {{$entreprise_agent->libelle}}-->
                                                                <!--         </div></td>-->
                                                                <!--@else -->
                                                                <!--<td class="align-middle" >  -->
                                                                <!--        <div class="align-middle" >-->
                                                                <!--                    ---->
                                                                <!--         </div></td>-->
                                                                <!--@endif-->
                                                                @if($client_entreprise->check_entreprise == "SN")
                                                                      <td class="align-middle" >
                                                                        <div class="align-middle" >
                                                                                        {{count($feeddonnerCheck)}}
                                                                         </div>
                                                                        
                                                                     </td>
                                                                @else
                                                                <td class="align-middle" >
                                                                        <div class="align-middle" >
                                                                                        {{count($feeddonner)}}
                                                                         </div>
                                                                        
                                                                     </td>
                                                                @endif
                                                                
                                                                 @if($client_entreprise->check_entreprise == "SN")
                                                                     <td class="align-middle" >
                                                                        <div class="align-middle" >
                                                                                        {{count($feedrecuCheck)}}
                                                                         </div>
                                                                        
                                                                     </td>
                                                                @else
                                                                <td class="align-middle" >
                                                                        <div class="align-middle" >
                                                                                        {{count($feedrecu)}}
                                                                         </div>
                                                                        
                                                                     </td>
                                                                @endif
                                                                    <td class="align-middle" >
                                                                         
                                                                        <div class="align-middle" >
                                                                           <a href="{{route('liste_actions.users', $agen->id)}}" >{{$count_actions}}</a>
                                                                        </div>
                                                                    </td>
                                                                      <td class="align-middle" >
                                                                        <div class="align-middle" >
                                                                        @if(count($feeddonner) == 0)
                                                                        @php $agnts = $agen->email;  @endphp
                                                <span class="d-inline-block" tabindex="0" style="margin-right : 10px;" data-toggle="tooltip" title="Relancer pour feedback">
                                                    <form action="/sendmailrelancer" method="post" id="target" class="form">
                                                       <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                       <input type="hidden" name="name" value="{{$agen->prenom}}">
                                                       <input type="hidden" name="email" value="{{$agnts}}">
                                                       <input type="hidden" name="message" value="Donner des feedbacks">
                                                       <button type="submit" class="btn btn-primary" style="margin-left: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                                                        <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                                                        </svg></button>
                                                    </form>
                                                </span>
                                                                            
                                                                        @endif
                                                                        </div>
                                                                     </td>
                                                                    <td class="align-middle" >
                                                                        
                                                                                 <form action="{{ route('utilisateurs.destroy',$agen->id) }}" method="POST">
                                                                            <div class="align-middle" style="display : flex;" style="margin-right : 10px;" data-toggle="tooltip" title="Modifier" >
                                                                              <a type="submit" id="PopoverCustomT-1" class="btn btn-primary"  href="{{route('utilisateurs.editer', $agen->id)}}" >
                                                                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                                                    </svg>
                                                                                </a>
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <a type="submit" class="btn btn-danger">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                                                      <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                                                    </svg>
                                                                                </a>
                                                                        </div>
                                                                            </form>
                                                                        
                                                                        
                                                                    </td>
                                                                    
                                                                  
                                                                 
                                                                <!--</form>-->
                                                            </tr>
                                            </tbody>
                                              
                                                             @endforeach
                                           
                                                 
                                    
                                                         
                                             
                                                                </tbody>
                                        </table>
                                        
                                        
                                        
                                        
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