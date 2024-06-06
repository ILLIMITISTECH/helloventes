<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hello Ventes</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('Koyalis/public/assets/css/tailwind.output.css')}}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />

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
      
        <div class="container px-6 mx-auto grid">
            <br>
                                         
            <div >
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Mes contacts
          </h2>
                                        
          <div class="w-full overflow-hidden rounded-lg shadow-xs" >
            
            <div class="w-full overflow-x-auto">
       <center>
                        @php 
                            $dat = date('m');
                            setlocale(LC_TIME, 'fr_FR'); 
                            $mes_contacts = DB::table('contacts')->where('commercial_id', $commercial->id)->groupBy('created_at')->get();
                            
                            $contact_janvier = DB::table('contacts')->where('commercial_id', $commercial->id)->whereMonth('created_at', 1)->count();
                            $contact_fevrier = DB::table('contacts')->where('commercial_id', $commercial->id)->whereMonth('created_at', 2)->count();
                            $contact_mars = DB::table('contacts')->where('commercial_id', $commercial->id)->whereMonth('created_at', 3)->count();
                            $contact_avril = DB::table('contacts')->where('commercial_id', $commercial->id)->whereMonth('created_at', 4)->count();
                            $contact_mai = DB::table('contacts')->where('commercial_id', $commercial->id)->whereMonth('created_at', 5)->count();
                            $contact_juin = DB::table('contacts')->where('commercial_id', $commercial->id)->whereMonth('created_at', 6)->count();
                            $contact_juillet = DB::table('contacts')->where('commercial_id', $commercial->id)->whereMonth('created_at', 7)->count();
                            $contact_aout = DB::table('contacts')->where('commercial_id', $commercial->id)->whereMonth('created_at', 8)->count();
                            $contact_sep = DB::table('contacts')->where('commercial_id', $commercial->id)->whereMonth('created_at', 9)->count();
                            $contact_oct = DB::table('contacts')->where('commercial_id', $commercial->id)->whereMonth('created_at', 10)->count();
                            $contact_nov = DB::table('contacts')->where('commercial_id', $commercial->id)->whereMonth('created_at', 11)->count();
                            $contact_dec = DB::table('contacts')->where('commercial_id', $commercial->id)->whereMonth('created_at', 12)->count();
                            
                            
                        @endphp
       <table style="width:50%">
  <tr>
    <th>Année / Mois</th>
    <th>New contacts</th>
    <th>Update contacts </th>
    <th> %Performannce</th>
  </tr>
  @php $mois = array('janvier', 'fevrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'decembre'); 
       $mes_contacts = DB::table('contacts')->where('commercial_id', $commercial->id)->whereMonth('created_at', '<=' , $dat)->get();
       $count = 0;
       $count_mois = array();
  @endphp
  @foreach($mois as $moi)
  
   @php
   foreach($mes_contacts as $mes_contact)
   {
   if($moi == strftime('%B', strtotime($mes_contact->created_at)))
   {
    
   
   array_push($count_mois, $mes_contact->created_at);
    
   }
   }
   
    foreach($count_mois as $count_moi)
   {
   if($moi == strftime('%B', strtotime($count_moi)) && strftime('%B', strtotime($count_moi)) == $moi)
   {
    
    
   $count = $count + 1;
  
   }
    
   }
   
 
   @endphp
  <tr>
      
    <td>{{$moi}}</td>
     
     @if($moi == 'janvier')
    <td>{{$contact_janvier}}</td>
    @elseif($moi == 'fevrier')
    <td>{{$contact_fevrier}}</td>
     @elseif($moi == 'mars')
    <td>{{$contact_mars}}</td>
     @elseif($moi == 'avril')
    <td>{{$contact_avril}}</td>
     @elseif($moi == 'mai')
    <td>{{$contact_mai}}</td>
     @elseif($moi == 'juin')
    <td>{{$contact_juin}}</td>
     @elseif($moi == 'juillet')
    <td>{{$contact_juillet}}</td>
     @elseif($moi == 'août')
    <td>{{$contact_aout}}</td>
     @elseif($moi == 'septembre')
    <td>{{$contact_sep}}</td>
     @elseif($moi == 'octobre')
    <td>{{$contact_oct}}</td>
     @elseif($moi == 'novembre')
    <td>{{$contact_nov}}</td>
     @elseif($moi == 'decembre')
    <td>{{$contact_dec}}</td>
    @endif
    
    
    @if($moi == 'janvier')
    <td>{{$contact_janvier}}</td>
    @elseif($moi == 'fevrier')
    <td>{{$contact_fevrier}}</td>
     @elseif($moi == 'mars')
    <td>{{$contact_mars}}</td>
     @elseif($moi == 'avril')
    <td>{{$contact_avril}}</td>
     @elseif($moi == 'mai')
    <td>{{$contact_mai}}</td>
     @elseif($moi == 'juin')
    <td>{{$contact_juin}}</td>
     @elseif($moi == 'juillet')
    <td>{{$contact_juillet}}</td>
     @elseif($moi == 'août')
    <td>{{$contact_aout}}</td>
     @elseif($moi == 'septembre')
    <td>{{$contact_sep}}</td>
     @elseif($moi == 'octobre')
    <td>{{$contact_oct}}</td>
     @elseif($moi == 'novembre')
    <td>{{$contact_nov}}</td>
     @elseif($moi == 'decembre')
    <td>{{$contact_dec}}</td>
    @endif
    
    
    
    <td>2%</td>
  </tr>
  @endforeach
</table>
</center>
            </div>

        
          </div>
           </div>

    <!-----------------------------------------------------------------------contact de ce mois---------------------------------------------------------------->
    
    

    
    
    </main>
  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/init-alpine.js')}}"></script>
  <script src="{{asset('Koyalis/public/https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js')}}" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/charts-lines.js')}}" defer></script>
  <script src="{{asset('Koyalis/public/assets/js/charts-pie.js')}}" defer></script>
               <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

          
             <style>
             table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
     table,
td {
    border: 1px solid #333;
}

thead,
tfoot {
    background-color: #333;
    color: #fff;
}
                </style>
</body>

</html>