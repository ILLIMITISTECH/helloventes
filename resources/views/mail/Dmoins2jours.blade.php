<!doctype html>

<html>
  <Head></Head>
  <Body>
    <div style="  background: white;   box-sizing: border-box;   color: black;      font-family: Roboto,Arial,sans-serif;   margin: 0 auto;   min-width: 320px;   max-width: 458px;   text-align: center; ">
      <div style=" border: 1px solid #dadce0;   border-radius: 8px;   margin-bottom: 8px;">
        <div style=" padding: 24px 8px;">
       <img src="{{asset('Koyalis/hellovente3.png')}}" alt="homepage" class="dark-logo" style="max-width: 80%;"><br><br>
          <div style="  font-size: 20px;   font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   font-weight: 500;   line-height: 28px;   padding: 0 8px 20px; color:black;">Bonjour {{$user->prenom}} ! <br></div>
          
          <br>
      
        <div style=" padding: 24px 16px 32px;">
          
          <div style="font-size:16px;   font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   line-height: 28px;   padding: 0 8px;color:black">Pour rappel la deadline de ces tâches sont dans <b>2 jours</b> : </div>
         <br><br><br>
         
         
          
          <div style="border: 1px solid #dadce0;   border-radius: 8px;   box-sizing: border-box;   margin: 0 auto 28px;   max-width: 578px;   padding: 16px;">
            <div style="color: black;   display: flex;   font-size: 12px;   letter-spacing: 0.3px;   line-height: 16px;">
          
          
          
           <table>
            <tr>  <th> <div style=" margin-right: auto;"><b>Libellé</b></div></th>
              <th><div style="max-width:100x; margin-left:200px;"><b>Opportunité </b></div></th>
            </div>
            <div style=" padding-top: 12px; display: flex;text-align:left;color:black;">
        
                                                          @foreach($actions as $action)
                                                            
                                                          
                                                                 <tr>
                                                                <td>{{$action->libelle}}</td> 
                                                                <!--<?php $op = DB::table('opportunites')->where('id', $action->opportunite_id)->first(); ?>-->
                                                                @if($op == NULL )
                                                                <td><div style="max-width:100x; margin-left:150px;">-</div></td>
                                                                @else
                                                                 <td><div style="max-width:100x; margin-left:150px;">{{$op->libelle}}</div></td>
                                                                @endif
                                                                </tr>
                                                       @endforeach
                                                       
     
       </div>
       </table>   
       </div></div> 
         
            <div>
              <a href="https://illimitis.helloventes.com/connexion" style=" background: #1a73e8;   border-radius: 4px;   color: #ffffff;   display: inline-block;   font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   font-weight: 500;   letter-spacing: 0.25px;   line-height: 16px;   margin-bottom: 12px;   padding: 10px 24px;   text-decoration: none;" target=_blank>Allez sur Hello Ventes</a>
            </div>
           
    <img height=1 src=https://www.google.com/appserve/mkt/img/AFnwnKUwncdGojxpaQzytvL82kkIIInVwWfgEX7RFtep8KfDcA8.gif width=3>
  </Body>
</html>