<html>
  <Head></Head>
  <Body>
    <div style="  background: white;   box-sizing: border-box;   color: black;      font-family: Roboto,Arial,sans-serif;   margin: 0 auto;   min-width: 320px;   max-width: 458px;   text-align: center; ">
      <div style="  border: 1px solid #dadce0;   border-radius: 8px;   margin-bottom: 8px;">
        <div style="  padding: 24px 8px;">
       <img src="https://feedback.collaboratis.com/v2/assets/images/feedback.png" alt="homepage" class="dark-logo" style="max-width: 100%;"><br><br>
          <div style="font-size: 22px; font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   font-weight: 500;   line-height: 28px;   padding: 0 8px 20px;">Bonjour, <strong>{{$user->prenom}}</strong></div>
          
          <div style="font-size: 16px; font-weight: 500; font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   letter-spacing: 0.1px;   line-height: 24px;   padding: 4px 0 38px; color:black;">
              @php setlocale(LC_TIME, "fr_FR"); @endphp
              @php 
                   $entreprise_feed = DB::table('entreprises')->where('id', $source->entreprise_id)->first();
              @endphp
          Nous vous remercions d’avoir utilisé ByFeeding pour donner et recevoir des feedbacks, le {{strftime(" %d %B %G", strtotime($source->date_debut))}} dernier lors de la team building <b>{{$entreprise_feed->libelle}}</b>.
          <br>
            <br>Maintenant, nous vous invitons à mettre en œuvre le plan d’action qui vous aidera à vous améliorer de façon continue.<br>
            <!--<b style="color:#0000ff;">By feeding, you grow !</b><br>-->
         
         
            <p><b style="color:#0000ff;">By feeding, you grow !</b></p></div>
          
        </div>
      </div>
         
            
         
    
     
     
        
            <div>
              <a href="https://app.byfeeding.com/connexion" style="  background: #1a73e8;   border-radius: 4px;   color: #ffffff;   display: inline-block;   font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   font-weight: 500;   letter-spacing: 0.25px;   line-height: 16px;   margin-bottom: 12px;   padding: 10px 24px;   text-decoration: none;" target=_blank>Mettre à jour mon plan d'action</a>
            </div>
           
  </Body>
</html>