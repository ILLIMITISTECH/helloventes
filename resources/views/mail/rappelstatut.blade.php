<!doctype html>

<html>
  <Head></Head>
  <Body>
    <div style="  background: white;   box-sizing: border-box;   color: black;      font-family: Roboto,Arial,sans-serif;   margin: 0 auto;   min-width: 320px;   max-width: 458px;   text-align: center; ">
      <div style=" border: 1px solid #dadce0;   border-radius: 8px;   margin-bottom: 8px;">
        <div style=" padding: 24px 8px;">
       <img src="{{asset('Koyalis/hellovente3.png')}}" alt="homepage" class="dark-logo" style="max-width: 90%;"><br><br>
          <div style="  font-size: 20px;   font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   font-weight: 500;   line-height: 28px;   padding: 0 8px 20px; color:black;">Bonjour cher commercial, <br><br></div>
        <div style="  font-size: 20px;   font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   font-weight: 500;   line-height: 28px;   padding: 0 8px 20px; color:black;">
         @php  $opportunites = DB::table('opportunites')->where('id', $historique->opportunite_id)->first(); @endphp
           Le statut de l'opportunité : @if($historique){{$opportunites->libelle}}@endif ne bouge pas <br>
         La durée est :
                     @php
                    $toD1 = now();
                    $toDurer = intval(abs(strtotime($toD1) - strtotime($historique->date_ajouter))/ 86400);
                    
                      $duree = intval(abs(strtotime($historique->date_modifier) - strtotime($historique->date_ajouter))/ 86400);
                    @endphp
                    
                    @if($duree == 0)
                  
                      {{$toDurer}} jours
               
                    @else
                
                      {{$duree}} jours
                
                    @endif
        <div>
      
       <div style="  font-size: 20px;   font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   font-weight: 500;   line-height: 28px;   padding: 0 8px 20px; color:black;">
          
          <b>  
          <p> Bonnes Ventes</p>
          </b>
         <br>
         
         
          
          </div> 
         
            <div>
              <a href="https://tamtam.helloventes.com/connexion" style=" background: #1a73e8;   border-radius: 4px;   color: #ffffff;   display: inline-block;   font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   font-weight: 500;   letter-spacing: 0.25px;   line-height: 16px;   margin-bottom: 12px;   padding: 10px 24px;   text-decoration: none;" target=_blank>Allez sur Hello Ventes</a>
            </div>
           
    <img height=1 src=https://www.google.com/appserve/mkt/img/AFnwnKUwncdGojxpaQzytvL82kkIIInVwWfgEX7RFtep8KfDcA8.gif width=3>
  </Body>
</html>