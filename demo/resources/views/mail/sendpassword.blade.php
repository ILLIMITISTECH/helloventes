<html>
  <Head></Head>
  <Body>
    <div style="  background: white;   box-sizing: border-box;   color: black;      font-family: Roboto,Arial,sans-serif;   margin: 0 auto;   min-width: 320px;   max-width: 458px;   text-align: center; ">
      <div style="  border: 1px solid #dadce0;   border-radius: 8px;   margin-bottom: 8px;">
        <div style="  padding: 24px 8px;">
       <img src="https://feedback.collaboratis.com/v2/assets/images/feedback.png" alt="homepage" class="dark-logo" style="max-width: 100%;"><br><br>
          <div style="  font-size: 22px;   font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   font-weight: 500;   line-height: 28px;   padding: 0 8px 20px;">Bonjour, <strong>{{$user->prenom}}</strong></div>
          
          <div style="font-size: 16px;   font-weight: 500;   font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   letter-spacing: 0.1px;   line-height: 24px;   padding: 4px 0 38px; color:black;"><p>En vous nourrissant, vous grandissez.</p>
            <p>En nourrissant les autres, vous contribuez à leur croissance.</p>
            <p><b style="color:#0000ff;">By feeding, you grow !</b></p><br>
           
            C’est pour cela que le Coach : @if($fl)<b>{{$fl->prenom}}</b>@else <b>--</b> @endif  vous offre la plateforme ByFeeding; dans le but de nourrir vos collaborateurs de vos feedbacks positifs et constructifs pour leur croissance.<br>
            Avec ByFeeding, osez donner et recevoir des feedbacks à 360°, et définir un plan de croissance individuelle pour les 6 prochains mois.<br>
            Votre compte est désormais actif sur la plateforme ByFeeding<br>
            Connectez-vous dès maintenant et donnez un feedback à vos collaborateurs, à l’aide des informations ci-dessous : <br><br>
            
             Votre Login est : {{$user->email}}<br>
             @if($user->entreprise == 2)
              Si vous utilisez Byfeeding pour la première fois, votre mot de passe par défaut est : 123456 <br><br>
              Nous vous recommandons de le modifier immédiatement dès votre première connexion, pour la confidentialité de votre feedback. <br><br>
              Si vous avez déjà utilisé Byfeeding, connectez-vous avec votre mot de passe usuel. Si vous ne vous en rappelez pas, cliquez sur « mot de passe oublié » et nous vous enverrons un lien de réinitialisation à votre email. <br><br>
            @else
            Mot de passe : 123456 <br>
            (PS :) à modifier dès votre première connexion.
            
           <br><br>
           @endif
            <b style="color:#0000ff;">By feeding, you grow !</b></div>
          
        </div>
      </div>
         
            
         
    
     
     
        
            <div>
              <a href="https://demo.byfeeding.com/connexion" style="  background: #1a73e8;   border-radius: 4px;   color: #ffffff;   display: inline-block;   font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   font-weight: 500;   letter-spacing: 0.25px;   line-height: 16px;   margin-bottom: 12px;   padding: 10px 24px;   text-decoration: none;" target=_blank>Je me connecte</a>
            </div>
           
  </Body>
</html>