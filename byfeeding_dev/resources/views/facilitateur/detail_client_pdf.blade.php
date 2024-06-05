
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


 
       
        <aside id="sidebar" class="sidebar">
                <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                
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
                       <!-- formulaire -->
                              
         <section class="section">
          
             <div align="left" class="col-lg-6"  valign="top:5px">
                   

                     </div>
          <div class="card">
             
            <div class="card-body">
                
                 @php $client = DB::table('client_facilitateurs')->where('entreprise_id', $entreprise->id)->first(); @endphp
                 @php $facilitateur = DB::table('facilitateurs')->where('id', $client->facilitateur_id)->first(); @endphp
                  
                       
				 
                   
                    <br><br>
                <div class="row"  valign="top:10px">
                    <div align="left" class="col-lg-6"  valign="top:10px">
                    <span style="font-family: 'MarkOffcPro-Book', arial; color: #1561a2;; font-size: 38px; line-height: 24px; margin-left:10px;  margin-top:20px;">
                        <img alt="logo" style="max-width: 100px" src="{{ url('images/', $entreprise->logo) }}" >
                    </span>
                     </div>
                     <div align="right" class="col-lg-6"  valign="top:10px">
                            <span style="font-family: 'MarkOffcPro-Book', arial; color: #1561a2; font-size: 20px; line-height: 24px; margin-right:10px;  margin-top:20px;">
                        <span class="outlookFallback"> Facilitateur :  <span  style="font-size:20px; color: #000000;" >
                            @if(Auth::user()->nom_role == "facilitateur")
                            {{Auth::user()->prenom}} {{Auth::user()->nom}}
                            @else
                            {{$facilitateur->prenom}} {{$facilitateur->nom}}
                            @endif
                        </span>
                    </div>
                    <div align="left" class="col-lg-6"  valign="top:10px">
                        <span style="font-family: 'MarkOffcPro-Book', arial; color: #1561a2;; font-size: 20px; line-height: 24px; margin-left:20px;  margin-top:20px;">
                            <span class="outlookFallback"> {{$entreprise->libelle}}  <span  style="font-size:20px; color: #000000;" >
                        </span>
                    </div>
						    </div>
						    <br><br>
						    	<div align="left" valign="top:10px"><span style="font-family: 'MarkOffcPro-Book', arial; color: #1561a2;; font-size: 25px; line-height: 24px; margin-left:10px;  margin-top:20px;">
                                @php setlocale (LC_ALL, "fr_FR");   @endphp
                                
                                @foreach($feedback as $feedbacks)
                                @if($feedbacks)
                                    @php $source = DB::table('source_feedbacks')->where('id', $feedbacks->source_id)->first(); @endphp
                                 @endif
                                @endforeach
                             
                                <span class="outlookFallback">Global Feedback Report -  <span style="font-size: 20px;">
                                     {{strftime("%d %B, %Y", strtotime($source->date_fin))}}
                                    </span></span></span>
                               
						    </div>
				    <br>
        <div class="row">
            <div class="col-xxl-4 col-xl-4">

              <div class="card info-card customers-card">

               
                @php $feedback = DB::table('feedback')->where('source_id', $client->source_id)->where('choix', 'feedback')->count(); 
                 $feed = DB::table('feedback')->where('source_id', $client->source_id)->where('choix', 'feedback')->get();
                  
                   $var = array();
                    foreach ($feed as $feeds){
                        $somme_note = $feeds->note;
                        array_push($var,$somme_note);
                       
                    }
                    $total_somme_note = array_sum($var);
                    $nb_note = count($var);
                    $notes = $nb_note == 0 ? 0 :  $total_somme_note / $nb_note;
                 @endphp
                <div class="card-body">
                  <h5 class="card-title" style="color:#1561a2">Moyenne de satisfaction </h5>

                  <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-activity" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2Z"/></svg>
                    
                    <div class="ps-3" style="color : #1561a2; font-size : 40px">{{number_format($notes, 1, ',', '')}}/10</div>
                  </div>

                </div>
              </div>

            </div>
                    
        <div class="col-xxl-4 col-xl-4">

              <div class="card info-card customers-card">

               
                @php $feedback = DB::table('feedback')->where('source_id', $client->source_id)->where('choix', 'feedback')->count(); 
                 $feed = DB::table('feedback')->where('source_id', $client->source_id)->where('choix', 'feedback')->get();
                  
                   $var = array();
                    foreach ($feed as $feeds){
                        $somme_note = $feeds->note;
                        array_push($var,$somme_note);
                       
                    }
                    $total_somme_note = array_sum($var);
                    $nb_note = count($var);
                    $notes = $nb_note == 0 ? 0 :  $total_somme_note / $nb_note;
                 @endphp
                <div class="card-body">
                  <h5 class="card-title" style="color:#1561a2">Feedbacks reçus</h5>

                  <div class="d-flex align-items-center">
                     <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="black" class="bi bi-people" viewBox="0 0 16 16"><path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/></svg>
                    
                    <div class="ps-3" style="color : #1561a2; font-size : 40px">{{$feedback}}</div>
                  </div>

                </div>
              </div>

            </div>
          
                  <div class="col-xxl-4 col-xl-4">

              <div class="card info-card customers-card">

               

                <div class="card-body">
                  <h5 class="card-title" style="color:#1561a2">Actions enregistrées </h5>
                    @php 
                    $agents = DB::table('agents')->where('entreprise', $entreprise->id)->get();
                    $action = array();
                    foreach($agents as $agent){
                    $actions = DB::table('actions')->where('agent_id', $agent->id)->get();
                        array_push($action, $actions);
                     }
                     
                    @endphp
                   
                   
                  <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"  fill="currentColor" class="bi bi-list-task" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z"/>
                      <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z"/>
                      <path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z"/>
                    </svg>                    
                    <div class="ps-3" style="color : #1561a2; font-size : 40px">{{count($action)}}</div>
                  </div>

                </div>
              </div>

            </div>   
             </div>  
             <br>
						<div align="left" valign="top:10px"><span style="font-family: 'MarkOffcPro-Book', arial; color: #1561a2;; font-size: 20px; line-height: 24px; margin-left:10px;  margin-top:20px;">
                               
                             
                                <span class="outlookFallback"><b>Graphique des compétences clés à développer dans votre équipe :</b> <span style="font-size: 25px;">
                                    </span></span></span>
                               
                    <div id="piechart" style="width: 100%; height: 500px;">&nbsp;</div>
            
            
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>


  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>
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
 <script src="{{asset('v2/main.js')}}"></script>
<script src="{{asset('assets/vendor/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/chart.js/chart.min.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/quill/quill.min.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/php-email-form/validate.js')}}"></script>
 <script type="text/javascript">
            // add row
            $("#addRow").click(function () {
                var html = '';
                html += '<div id="inputFormRow">';
                html += '<div class="input-group row mb-3">';
              html += '  <div class="col-md-10">';
            html += ' <label for="inputEmail4" class="form-label ">Source de l action  :</label>';
            html += ' <select class="form-select" name="source[]" aria-label="Default select example">';
            html += '  <option selected>Selectionner</option>';
            html += '        <option value="Ecofast Team Building 25 Sep 2021">Ecofast Team Building 25 Sep 2021</option>';
           html += '        <option value="Ecofast Team Building 12 Mar 2022">Ecofast Team Building 12 Mar 2022</option>';
          html += '   </select>';
        html += '   </div>';
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

 
 
 
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart() {
// Chart 1
var data = google.visualization.arrayToDataTable([['OS Mobile', 'Parts de marché'],["Leadership",{{$competence_1}}],["Management",{{$competence_2}}],["Confiance en soi",{{$competence_3}}],["Délégation",{{$competence_4}}],["Écoute active",{{$competence_5}}],["Gestion de conflits",{{$competence_6}}],["Techniques de Vente et négociation",{{$competence_7}}],["Prise de parole en public",{{$competence_8}}],["Travail en équipe",{{$competence_9}}],["Intelligence émotionnelle",{{$competence_10}}],["Focus et productivité",{{$competence_11}}],["Orientation resultat",{{$competence_12}}]]);
var options = {
};
var chart = new google.visualization.PieChart(document.getElementById('piechart'));
chart.draw(data, options);
}
</script>
</body>

</html>