
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
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="pagetitle" style = "text-align : center;">
      <h1 style =" color:#4154f1">Demander un feedback</h1>
      
    </div><!-- End Page Title -->
     <br><br>
    <h5>
      @if (session('message'))
                  <div class="alert alert-success" role="alert">
                  {{ session('message') }}
                  </div>  
                  @endif
    </h5>
                
                       <!-- formulaire -->
                              
        <div class="card col-lg-10 mt-4 mb-10">
            <div class="card-body">
                
                    <div class="input-group row ">
<form  enctype="multipart/form-data" method="post" action="/feedback/demander">
{{ csrf_field() }}
   
                    <!--<div class="input-group row mb-3">-->
                        <h2></h2>
                            <label for="exampleFormControlInput1" class="required form-label">Objet du Feedback : (<span class="red">*</span>)</label>
                            <input type="text" class="form-control" name="nom_feedback" required autocomplete="prenom" placeholder="Entrer le titre"/>
                       
                     
        
                        <!-- Ajouter plusieurs participants -->
                        
                 <h5 class="card-title">Ajouter les collaborateurs</h5>

                               
                                        <div id="inputFormRow">
                                            <div class="input-group row mb-3">
                                                <div class="col-md-12">
                                                    <label for="inputEmail4" class="form-label ">Prénom :</label>
                                                    <input type="text" name="prenom[]" class="form-control" id="inputEmail4">
                                                </div> 
                                                <div class="col-md-12">
                                                    <label for="inputEmail4" class="form-label ">Nom : </label>
                                                    <input type="text" name="nom[]" class="form-control" id="inputEmail4">
                                                </div> 
                                                <div class="col-md-12">
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
                                        <button id="addRow" type="button" class="btn mt-5" style="background-color:#1561a2; color:white">Ajouter plus</button>
                                   
						<div class="mt-5 col-12">
                            <button type="submit" class="btn" style="background-color:#1561a2; color:white">Enregistrer</button>
                          
</form>
                        </div>

                        <!-- end Ajouter plusieurs participants -->

                             
                    
                    </div>
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
 </div>
 
   <script src="{{asset('assets/vendor/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/chart.js/chart.min.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/quill/quill.min.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('assets/vendor/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>
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
