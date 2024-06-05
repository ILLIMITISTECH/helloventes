<html>
  <Head></Head>
  <Body>
    <div style="  background: white;   box-sizing: border-box;   color: black;      font-family: Roboto,Arial,sans-serif;   margin: 0 auto;   min-width: 320px;   max-width: 458px;   text-align: center; ">
      <div style="  border: 1px solid #dadce0;   border-radius: 8px;   margin-bottom: 8px;">
        <div style="  padding: 24px 8px;">
       <img src="https://feedback.collaboratis.com/v2/assets/images/feedback.png" alt="homepage" class="dark-logo" style="max-width: 100%;"><br><br>
          <div style="  font-size: 22px;   font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   font-weight: 500;   line-height: 28px;   padding: 0 8px 20px;">Bonjour, <strong>@if($fl)<b>{{$fl->prenom}}</b>@else <b>--</b> @endif</strong></div>
          
          <div style="font-size: 16px;   font-weight: 500;   font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   letter-spacing: 0.1px;   line-height: 24px;   padding: 4px 0 38px; color:black;"><p>En nous nourrissant, nous grandissons.</p>
            <p>En nourrissant les autres, nous contribuons à leur croissance. C’est pour cela que la plateforme Byfeeding a été mise en place. </p>
            <!--<p><b style="color:#0000ff;">By feeding, you grow !</b></p><br>-->
           
            Pour votre client <strong>@if($entreprise)<b>{{$entreprise->libelle}}</b>@else <b>--</b> @endif,<br>
            <b>{{count($users)}} participants </b> de la session <strong>@if($sf)<b>{{$sf->nom_source}}</b>@else <b>--</b> @endif ont reçu le mail de démarrage ; avec leurs informations de connexion.<br>
            Veuillez les informer de consulter leur boite mail (inclut vérification dans les spams) ; de se connecter à la plateforme et de <b>changer immédiatement leur mot de passe</b>.  <br>
           
            
            <b style="color:#0000ff;">By feeding, you grow !</b></div>
          
        </div>
      </div>
        
            <div>
              <a href="https://demo.byfeeding.com/connexion" style="  background: #1a73e8;   border-radius: 4px;   color: #ffffff;   display: inline-block;   font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   font-weight: 500;   letter-spacing: 0.25px;   line-height: 16px;   margin-bottom: 12px;   padding: 10px 24px;   text-decoration: none;" target=_blank>Je me connecte</a>
            </div>
           
  </Body>
</html>