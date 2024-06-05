<html>
  <Head></Head>
  <Body>
    <div style="  background: white;   box-sizing: border-box;   color: black;      font-family: Roboto,Arial,sans-serif;   margin: 0 auto;   min-width: 320px;   max-width: 458px;   text-align: center; ">
      <div style="  border: 1px solid #dadce0;   border-radius: 8px;   margin-bottom: 8px;">
        <div style="  padding: 24px 8px;">
       <img src="https://feedback.collaboratis.com/v2/assets/images/feedback.png" alt="homepage" class="dark-logo" style="max-width: 100%;"><br><br>
          <div style="font-size: 22px; font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   font-weight: 500;   line-height: 28px;   padding: 0 8px 20px;">Bonjour <strong>{{$user->prenom}}</strong></div>
               
          <div style="font-size: 16px; font-weight: 500; font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   letter-spacing: 0.1px;   line-height: 24px;   padding: 4px 0 38px; color:black;">
         @php $source_feed = DB::table('source_feedbacks')->where('id', $entreprise->source_id)->first();
                   $entreprise_feed = DB::table('entreprises')->where('id', $user->entreprise)->first();
                @endphp
          Que le temps passe vite! Trois semaines se sont déjà écoulées depuis la session de Team building avec vos collaborateurs de {{$entreprise_feed->libelle}}

          <br>
          <br>
            <!--<b style="color:#0000ff;">By feeding, you grow !</b><br>-->
            Avez-vous pu clôturer vos actions ? (Si vous avez besoin d’aide dans l’atteinte de vos objectifs, vous pouvez nous contacter au 77 416 69 69 ou sur info@illimitis.com )
         
            <p><b style="color:#0000ff;">By feeding, you grow !</b></p></div>
          
        </div>
      </div>
         
            
         
    
     
     
        
            <div>
              <a href="https://app.byfeeding.com/connexion" style="  background: #1a73e8;   border-radius: 4px;   color: #ffffff;   display: inline-block;   font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   font-weight: 500;   letter-spacing: 0.25px;   line-height: 16px;   margin-bottom: 12px;   padding: 10px 24px;   text-decoration: none;" target=_blank>Clôturer mes actions</a>
            </div>
           
  </Body>
</html>