<!doctype html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="short icon" href="{{asset('collov2/assets/images/icon.png')}}">
    <title>Collaboratis | Tableau de bord</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
    
<link href="{{asset('v2/main.css')}}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
<link rel="stylesheet" href="{!! asset('assets/css/styles.css') !!}">
<link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css">

      
<!--Polices-->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{!! asset ('assets/plugins/magnific-popup/dist/magnific-popup.css') !!}">
    <link rel="stylesheet" href="{!! asset ('assets/plugins/jquery-datatables-editable/datatables.css') !!}">
    
    <!-- DataTables -->
    <link href="{!! asset ('assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css') !!}" />
    <link href="{!! asset ('assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css') !!}" />
    <link href="{!! asset ('assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css') !!}" />
    <link href="{!! asset ('assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css') !!}" />
    <link href="{!! asset ('assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css') !!}" />

    <!--<link href="{!! asset ('assets/css/bootstrap.min.css" rel="stylesheet" type="text/css') !!}">-->
    <link href="{!! asset ('assets/css/core.css" rel="stylesheet" type="text/css') !!}">
    <link href="{!! asset ('assets/css/icons.css" rel="stylesheet" type="text/css') !!}">
    <link href="{!! asset ('assets/css/components.css" rel="stylesheet" type="text/css') !!}">
    <link href="{!! asset ('assets/css/pages.css" rel="stylesheet" type="text/css') !!}">
    <link href="{!! asset ('assets/css/menu.css" rel="stylesheet" type="text/css') !!}">
    <link href="{!! asset ('assets/css/responsive.css" rel="stylesheet" type="text/css') !!}">

    <script src="{!! asset ('assets/js/modernizr.min.js') !!}"></script>

</head>

<body>
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       Assigner une activité :
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
               <div class="row" style= "text-align : center;">
                  
                </div>
            </div>
              
            
        
      </div>
 
    </div>
  </div>
</div>

    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
            <!--header -->
            @include('v2.header_dg')
            <!-- end header -->

        <div class="app-main">
                <!-- side bar -->
                @include('v2.side_bar_dg')

                <!-- end side bar -->
                <div class="app-main__outer">
                    <div class="app-main__inner">
                       <!-- perfo -->

                       <!-- end perfo --> 
                        
                         <!-- formulaire -->
    <h3 class="card-title">Demander un feedback</h3>
                    <h5>
						@if (session('message'))
                        <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                        </div>  
                        @endif
                     </h5>
<form  enctype="multipart/form-data" method="post" action="/feedback/demander">
{{ csrf_field() }}
    <div class="row">
        <div class="card col-lg-12 mt-4 mb-10">
            <div class="card-body">
                <div >
                    <div class="input-group row mb-3">
                        <div class="mb-7">
                            <label for="exampleFormControlInput1" class="required form-label">Titre du Feedback : (<span class="red">*</span>)</label>
                            <input type="text" class="form-control" name="nom_feedback" required autocomplete="prenom" placeholder="Entrer le titre"/>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                            <label class="col-form-label">Date de début : (<span class="red">*</span>)</label>
                            <div class="">
                            <input type="date" class="form-control" name="date_debut" placeholder="dd/mm/yyyy" required/>
                            </div>
                            </div>
                            <div class="form-group col-md-6">
                            <label class="col-form-label">Date de fin : (<span class="red">*</span>)</label>
                            <div class="">
                            <input type="date" class="form-control" name="date_fin" placeholder="dd/mm/yyyy" required/>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                    
     <!--                   <h3 class="card-title">Ajouter des critères d’évaluations</h3>-->

     <!--               <div class="row" >-->
     <!--                   <div class="card col-lg-12 mt-4 mb-10">-->
     <!--                       <div class="card-body">-->
     <!--                           <div >-->
     <!--                               <div class="input-group row mb-3">-->
                                               
     <!--                                       <div class="mb-10">-->
     <!--                                           <label for="exampleFormControlInput1" class=" form-label">Critère d’évaluation 1:</label>-->
     <!--                                           <input type="text" name="critere_1"  class="form-control form-control-solid" required/>-->
     <!--                                       </div>-->
     <!--                                       <div class="mb-10">-->
     <!--                                           <label for="exampleFormControlInput1" class=" form-label">Critère d’évaluation 2 :</label>-->
     <!--                                           <input type="text" name="critere_2"  class="form-control form-control-solid"/>-->
     <!--                                       </div>-->
     <!--                                       <div class="mb-10">-->
     <!--                                           <label for="exampleFormControlInput1" class=" form-label">Critère d’évaluation 3 :</label>-->
     <!--                                           <input type="text" name="critere_3"  class="form-control form-control-solid" />-->
     <!--                                       </div>-->
                                            
					<!--				</div>-->
					<!--			</div>-->
					<!--		</div>-->
					<!--	</div>-->
					<!--</div>-->
                        

                         <!-- end perfo de mes direct -->
                        
                        <!-- Ajouter plusieurs participants -->
                        
                 <h3 class="card-title">Ajouter plusieurs participants</h3>

                               <div class="row" id="formulaire">
                                <div class="card col-lg-12 mt-4 mb-10">
                                    <div class="card-body">
                                        <div id="inputFormRow">
                                            <div class="input-group row mb-3">
                                                <div class="col-md-8">
                                                    <label for="inputEmail4" class="form-label ">Prénom :</label>
                                                    <input type="text" name="prenom[]" class="form-control" id="inputEmail4">
                                                </div> 
                                                <div class="col-md-8">
                                                    <label for="inputEmail4" class="form-label ">Nom : </label>
                                                    <input type="text" name="nom[]" class="form-control" id="inputEmail4">
                                                </div> 
                                                <div class="col-md-8">
                                                    <label for="inputEmail4" class="form-label ">Email : </label>
                                                    <input type="email" name="email[]" placeholder="example@gmail.com" class="form-control" id="inputEmail4">
                                                </div> 
                                                <input type="hidden" name="password[]" placeholder="example@gmail.com" value="1234" class="form-control" id="inputEmail4">
                                                <!--<div class="col-md-2 mt-10">                
                                                    <button id="removeRow" type="button" class="btn btn-danger"><i class="bi bi-trash"></i> </button>
                                                </div> -->
                                            </div>
                                        </div>
                                        <div id="newRow"></div>
                                        <button id="addRow" type="button" class="btn btn-info mt-5">Ajouter plus</button>
                                    </div>
                                </div>
                            </div>
						<div class="mt-5 col-12">
                            <button type="submit" class="btn btn-info">Enregistrer</button>
                          
</form>
                        </div>

                        <!-- end Ajouter plusieurs participants -->

                             
                    
                    </div>
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
 </div>
 
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
                html += ' <div class="col-md-8">';
                html += '<label for="inputEmail4" class="form-label ">Prénom : </label>';
                html += '<input type="text" name="prenom[]" class="form-control" id="inputEmail4">';
                html += ' </div> ';
                html += '<input type="hidden" name="password[]" placeholder="example@gmail.com" value="1234" class="form-control" id="inputEmail4">';

                html += ' <div class="col-md-8">';
                html += '<label for="inputEmail4" class="form-label ">Nom : </label>';
                html += '<input type="text" name="nom[]" class="form-control" id="inputEmail4">';
                html += ' </div> ';
                html += '<div class="col-md-8">'
                    html += ' <label for="inputEmail4" class="form-label ">Email : </label>';
                    html += '<input type="email" name="email[]" placeholder="example@gmail.com" class="form-control" id="inputEmail4">';
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
