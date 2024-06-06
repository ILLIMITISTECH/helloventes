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
    
    
    
    <div class="container">
      @include('v2.header_dg')
<main class="h-full pb-16 overflow-y-auto" >

        <!--les formulaires-->
        <div class="container px-6 mx-auto grid">
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="font-size:18px;">
            Toutes les opportunités prévues
          </h2>
                   <div class="row" style="display-flex"> 
                   
                    
                     
                    </div> 
          <h6> 
              @if (session('message'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('message') }}
                  </div>  
              @endif
            </h6>
             <h6> 
              @if (session('messages'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('messages') }}
                  </div>  
              @endif
            </h6>
         
            
            <h6> 
              @if (session('msBra'))
                  <div class="alert" role="alert">
                     
                    <div class="alert alert-succes" role="alert">
                      <b style="color:green;">{{ session('msBra') }}</b>
                  </div>  
                  </div>  
              @endif
            </h6>
            
        <br>
        
        <h6> 
              @if (session('msAten'))
                  <div class="alert" role="alert">
                     
                    <div class="alert alert-succes" role="alert">
                      <b style="color:red;">{{ session('msAten') }}</b>
                  </div>  
                  </div>  
              @endif
            </h6>
            
        <br>
             <h6> 
              @if (session('messageAttention'))
                  <div class="alert alert-danger" role="alert">
                      {{ session('messageAttention') }}
                  </div>  
              @endif
            </h6>
            <h6> 
              @if (session('fini'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('fini') }}
                  </div>  
              @endif
            </h6>
            <h6> 
              @if (session('archive'))
                  <div class="alert alert-success" style="background-color:lightgreen" role="alert">
                      {{ session('archive') }}
                  </div>  
              @endif
            </h6>
            
                      
                            <br>
                            <div class="container px-6 mx-auto grid" >
           
                                      
                           
                            <br>

           <div class="container" id="tout">
              
              @if($opportunites->isEmpty()) 
                 	  <p>Pas d'opportunité</p>
					 @else
            <div class="container">
              <table >
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th style="width:10%" class="px-0 py-1">Commerciaux</th>
                    <th style="width:20%" align="left">Libellé</th>
                    <th style="width:8%" class="px-0 py-1">Entreprises</th>
                    <th style="width:6%" class="px-0 py-1">Probabilité</th>
                    <th style="width:10%" class="px-0 py-1">Origine</th>
                    <th style="width:10%" class="px-0 py-1">Date MAJ</th>
                    <!--<th style="width:10%"  class="px-0 py-1">Options</th>-->
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach($opportunites as $opportunite)
            
                  <tr class="text-gray-700 dark:text-gray-400">
                   <td class="px-1 py-3 text-sm">
                      @if($opportunite){{ ($opportunite->prenom) ? $opportunite->prenom : ''}} {{ ($opportunite->nom) ? $opportunite->nom : ''}}@else - @endif
                    </td>
                     <td align="left" data-toggle="tooltip" title="{{$opportunite->libelle}}">

                      <div class="flex items-center text-sm">
                        <a href="{{ route('detail_op',$opportunite->id) }}">
                          <div>
                            <button type="button" class="btn btn-primary btn-lg btn-block font-semibold">
                                <h4>{{ \Illuminate\Support\Str::limit($opportunite->libelle, 30, $end='...') }}</h4>
                            </button>
                             <br>
                    
                          </div></a>
                        </div>
                  
                     </td>
                  
                  <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        
                         @if($opportunite)
                
                      &nbsp;<b style="color:#9045e2">({{ strtoupper(($opportunite->nom_entreprise) ? $opportunite->nom_entreprise : '')}})</b>
                    @else
                      -
                    @endif
                      </span>
                    </td>
                    
                     <td class="px-4 py-3 text-xs">
                      <span class="px-3 py-1 text-sm ">
                        
                        {{$opportunite->probabilite ? $opportunite->probabilite : '00'}} %
                      </span>
                    </td>
                    @php $statut = DB::table('statut_opportunites')->where('id', $opportunite->statut)->first(); @endphp
                    @if($statut)
                    <td class="px-4 py-3 text-sm">
                      <button style="font-size:10px;"
                        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                          {{($statut->libelle) ? $statut->libelle : ''}}
                    </button>
                    </td>
                    @else
                    <td class="px-4 py-3 text-sm">
                      -
                    </td>
                    @endif
                    <td class="px-4 py-3 text-sm">
                     
                     {{date('d-m-Y', strtotime($opportunite->updated_at))}}
                      
                    </td>
                    
                 </tr>
              
                  @endforeach
                </tbody>
              </table>
            </div>
            @endif
             </div>
             
         
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
  
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <script>
            $("#70-100").hide();
            $("#50-70").hide();
            </script>
             <script>
            $(document).ready(function(){
              $("select").change(function(){
                    $( "select option:selected").each(function(){
                        //enter bengal districts
                        if($(this).attr("value")=="1000"){
                            $("#tout").hide();
                            $("#50-70").hide();
                            $("#70-100").show();
                        }
                        if($(this).attr("value")=="1001"){
                            $("#50-70").show();
                            $("#70-100").hide();
                            $("#tout").hide();
                        }
                        if($(this).attr("value")=="1002"){
                            $("#70-100").hide();
                            $("#tout").show();
                            $("#50-70").hide();
                        }
                        //enter other states
                       
                    });
                });  
            }); 

                </script>
  <style>
  .pagination {
    list-style: none;
    margin: 0;
    display: flex;
    padding-left: 1500%;
}
        
.pagination li {
    margin: 0 1px;
    font-size: 17px;
}
 
 </style> 
 
   <style>


.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  margin-left: -50px;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #9045e2}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #0093a2;
}
</style>
</body>


</html>