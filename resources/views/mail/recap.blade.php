<!doctype html>

<html>
  <Head></Head>
  <Body>
    <div style="  background: white;   box-sizing: border-box;   color: black;      font-family: Roboto,Arial,sans-serif;   margin: 0 auto;   min-width: 320px;   max-width: 458px;   text-align: center; ">
      <div style=" border: 1px solid #dadce0;   border-radius: 8px;   margin-bottom: 8px;">
        <div style=" padding: 24px 8px;">
       <img src="{{asset('Koyalis/hellovente3.png')}}" alt="homepage" class="dark-logo" style="max-width: 90%;"><br><br>
          <div style="  font-size: 20px;   font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   font-weight: 500;   line-height: 28px;   padding: 0 8px 20px; color:black;">Bonjour cher {{$user->prenom}}, <br><br></div>
        <div style="  font-size: 20px;   font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   font-weight: 500;   line-height: 28px;   padding: 0 8px 20px; color:black;">
        <style>
       ul li{ 
           text-align: justify;
           text-justify: inter-word;
       }
  </style>
         Voici votre performance commerciale et vos priorités de la semaine :<br>           
       
        @php
        
         $dates = date('Y-m-d');
           $mois = date('m');
            $annee = date('Y');
            $update = (date('d') - 5);
            $days = (date('d') - 8);
            $todays = date('d');
         $opportunites = DB::table('opportunites')->select('opportunites.*', 'prospects.id as idp', 'prospects.nom_entreprise')
                ->join('prospects', 'prospects.id', 'opportunites.prospect_id')
                ->where('opportunites.deadline', '>=', $dates)
                ->where('opportunites.commercial_id', $user->id)
                ->where('opportunites.archiver', 0)
                ->paginate(4);
            $appels_effectuer = DB::table('suivi_prospects')->where('commercial_id', $user->id)->whereYear('created_at', $annee)->count();
            $appels_a_effectuer = DB::table('prospect_a_appellers')->where('commercial_id', $user->id)->where('statut', null)->count();
           $appels_daterv = DB::table('suivi_prospects')->where('type', 1)->where('choix_qualifier', "Rendez-vous obtenu")->where('commercial_id', $user->id)->whereYear('created_at', $annee)->where('statut_rv', null)->count();
        
        $vente = DB::table('ventes')->where('commercial_id', $user->id)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->sum('montant');
        $vente_count = DB::table('ventes')->where('commercial_id', $user->id)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->count();
        $vente_semaine = DB::table('performances')->where('commercial_id', $user->id)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->orderBy('id', 'desc')->first();
        $vente_semaine_pass = $user->objectif_mois / 4;
        $vente_semaine_pass_deal = DB::table('ventes')->where('commercial_id', $user->id)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->whereDay('created_at','>=', $days)->count();
        $vente_semaine_pass_dealV = DB::table('ventes')->where('commercial_id', $user->id)->whereYear('created_at', $annee)->whereMonth('created_at', $mois)->whereDay('created_at','>=', $days)->sum('montant');

        @endphp
                <p><b>Opportunités : </b> </p>
                     <br>
                  @foreach($opportunites as $opportunite)
                  <ul>
                  @if($opportunite->probabilite >= 70)
                  <li>{{$opportunite->libelle}} de probabilité supérieure à 70%. Continuez à pousser 💪</li>
                  @elseif($opportunite->probabilite >= 50 && $opportunite->probabilite <= 70)
                  <li>{{$opportunite->libelle}} de probabilité entre 50 et 70%. Retroussez vos manches et accélérez 🚴</li>
                  @elseif($opportunite->probabilite <= 50)
                  <li>{{$opportunite->libelle}} de probabilité inférieure à 50. Vous pouvez et devez faire mieux 😟</li>
                  @endif
                  @php $nbr_mjs =  DB::table('opportunites')->select('opportunites.*', 'prospects.id as idp', 'prospects.nom_entreprise')
                ->join('prospects', 'prospects.id', 'opportunites.prospect_id')
                ->where('opportunites.id', $opportunite->id)
                ->where('opportunites.deadline', '>=', $dates)
                ->where('opportunites.commercial_id', $user->id)
                ->where('opportunites.archiver', 0)
                ->whereYear('opportunites.updated_at', $annee)
                ->whereDay('opportunites.updated_at', '<=', $update)
                ->count(); @endphp
                @if($nbr_mjs > 0)
                   <li>Attention : {{$nbr_mjs}} opportunités n’ont pas été mises à jour depuis plus de 5 jours. Ce n’est pas normal 😓</li>
                @endif
                  </ul>
                  @endforeach
                   <ul>
                  <li></li>
                  <li><a href="https://illimitis.helloventes.com/connexion">Voir toutes vos opportunités sur HelloVentes</a></li>
                   </ul>
                <p><b>Prospection : </b></p>
                  
                   <ul>
                 
                  <li>📞 {{$appels_effectuer}} appels téléphoniques effectifs sur {{$appels_a_effectuer}} attendus (@if($appels_a_effectuer != 0) {{intval(($appels_effectuer)*100 / ($appels_a_effectuer))}}% @else 0% @endif)</li>
                  
                  <li>🤝 {{$appels_daterv}} rendez-vous obtenus</li>
                  @php  
                  
                   $topComAppelt = DB::table('suivi_prospects')->select('commercial_id','created_at','type', DB::raw('count(type) as `total`'))
                       ->whereYear('created_at', $annee)
                       ->whereMonth('created_at', $mois)
                       ->whereIn('commercial_id', [$user->id])
                        ->groupBy('commercial_id')->orderBy('total','DESC')->pluck('commercial_id')->toArray(); 
                     
                        $keyV = array_search($user->id, $topComAppelt);
                    
                       $commerciauvs = DB::table('commerciaus')->count();
                       
                  @endphp
                  
                  @if($keyV)
                    <li>
                           🏁 Vous êtes classé(e)
                            <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                @if($keyV == 0)
                                       1e
                                      @elseif($keyV == 1)
                                      2e
                                      @elseif($keyV == 2)
                                      3e
                                      @elseif($keyV == 3)
                                      4e
                                      @elseif($keyV == 4)
                                      5e
                                      @elseif($keyV == 5)
                                      6e
                                      @elseif($keyV == 6)
                                      7e
                                      @elseif($keyV == 7)
                                      8e
                                      @elseif($keyV == 8)
                                      9e
                                      @elseif($keyV == 9)
                                      10e
                                      @elseif($keyV == 10)
                                      11e
                                      @elseif($keyV == 11)
                                      12e
                                      @elseif($keyV == 12)
                                      13e
                                      @elseif($keyV == 13)
                                      14e
                                      @elseif($keyV == 14)
                                      15e
                                      @elseif($keyV == 15)
                                      16e
                                      @elseif($keyV == 16)
                                      17e
                                      @elseif($keyV == 17)
                                      18e
                                      @elseif($keyV == 18)
                                      19e
                                      @elseif($keyV == 19)
                                      20e
                                      @elseif($keyV == 20)
                                      21e
                                      @elseif($keyV == 21)
                                      22e
                                      @elseif($keyV == 22)
                                      23e
                                      @elseif($keyV == 23)
                                      24e
                                      @elseif($keyV == 24)
                                      25e
                                      @elseif($keyV == 25)
                                      26e
                                      @elseif($keyV == 26)
                                      27e
                                      @elseif($keyV == 27)
                                      28e
                                      @elseif($keyV == 28)
                                      29e
                                      @elseif($keyV == 29)
                                      30e
                                 @endif
                                  /{{$commerciauvs}}
                            </button>
                           
                            en terme de performance de la prospection
                        
                        </li>
                    @else
                    <li>Attention: vous n'avez pas de prospection</li>
                    @endif
                  <li></li>
                  <li><a href="https://illimitis.helloventes.com/connexion">Voir toutes vos activités de prospection sur HelloVentes</a></li>
                 
                  </ul>
                  
                  
                  <p><b>Ventes : </b></p>
                   
                   <ul>
                
                  
                  <li>🗓️ Semaine passée :
                  
                 {{ $vente_semaine_pass_deal }}
                  deals clos la semaine passée, pour un montant de @if($vente_semaine_pass_dealV)
                  {{ number_format($vente_semaine_pass_dealV)}} FCFA
                  @else
                  0
                  @endif 
                  </li> 
                  
                  <li>🗓️  Ce mois :{{number_format($vente)}} FCFA clos, sur un objectif de  {{number_format($user->objectif_mois )}} FCFA (@if($vente != 0)  
                  ( {{intval(($vente)*100 / ($user->objectif_mois))}}%)
                  @else
                   0%
                  @endif
                  ) </li> 
                  
                  @php  
                        $tim_mois = date('m');
                          $vente_countFristtri = DB::table('ventes')->where('commercial_id', $user->id)->whereYear('created_at', $annee)->whereMonth('created_at', '>=', 01)->whereMonth('created_at', '<=', 03)->sum('montant');
                          $vente_countSecondtri = DB::table('ventes')->where('commercial_id', $user->id)->whereYear('created_at', $annee)->whereMonth('created_at', '>=', 04)->whereMonth('created_at', '<=', 06)->sum('montant');
                          $vente_countThirttri = DB::table('ventes')->where('commercial_id', $user->id)->whereYear('created_at', $annee)->whereMonth('created_at', '>=', 7)->whereMonth('created_at', '<=', 9)->sum('montant');
                          $vente_countFourtri = DB::table('ventes')->where('commercial_id', $user->id)->whereYear('created_at', $annee)->whereMonth('created_at', '>=', 10)->whereMonth('created_at', '<=', 12)->sum('montant');
                 
                          $obje_countFristtri = DB::table('objectif_commissions')->where('commercial_id', $user->id)->whereYear('created_at', $annee)->whereMonth('created_at', '>=', 01)->whereMonth('created_at', '<=', 03)->sum('Objectif_mois');
                          $obje_countSecondtri = DB::table('objectif_commissions')->where('commercial_id', $user->id)->whereYear('created_at', $annee)->whereMonth('created_at', '>=', 04)->whereMonth('created_at', '<=', 06)->sum('Objectif_mois');
                          $obje_countThirttri = DB::table('objectif_commissions')->where('commercial_id', $user->id)->whereYear('created_at', $annee)->whereMonth('created_at', '>=', 7)->whereMonth('created_at', '<=', 9)->sum('Objectif_mois');
                          $obje_countFourtri = DB::table('objectif_commissions')->where('commercial_id', $user->id)->whereYear('created_at', $annee)->whereMonth('created_at', '>=', 10)->whereMonth('created_at', '<=', 12)->sum('Objectif_mois');

                 
                  @endphp
                  
                    @if($tim_mois >= 01 && $tim_mois <= 03)
                   <li>🗓️ 
                   Ce trimestre : {{number_format($vente_countFristtri)}}  FCFA clos, sur un objectif de {{number_format($obje_countFristtri)}} 
                   (@if($vente_countFristtri != 0)  
                  ( {{intval(($vente_countFristtri)*100 / ($obje_countFristtri))}}%)
                  @else
                   0%
                  @endif
                   </li>
                   @endif
                   
                   @if($tim_mois >= 04 && $tim_mois <= 06)
                   <li>🗓️  
                   Ce trimestre : {{number_format($vente_countSecondtri)}}  FCFA clos, sur un objectif de {{number_format($obje_countSecondtri)}} 
                   (@if($vente_countSecondtri != 0)  
                  ( {{intval(($vente_countSecondtri)*100 / ($obje_countSecondtri))}}%)
                  @else
                   0%
                  @endif
                   </li>
                   @endif
                   
                   @if($tim_mois >= 7 && $tim_mois <= 9)
                   <li>🗓️  
                   Ce trimestre : {{number_format($vente_countThirttri)}}  FCFA clos, sur un objectif de {{number_format($obje_countThirttri)}} 
                   (@if($vente_countThirttri != 0)  
                  ( {{intval(($vente_countThirttri)*100 / ($obje_countThirttri))}}%)
                  @else
                   0%
                  @endif
                   </li>
                   @endif
                   
                  @if($tim_mois >= 10 && $tim_mois <= 12)
                   <li>🗓️  
                   Ce trimestre : {{number_format($vente_countFourtri)}}  FCFA clos, sur un objectif de {{number_format($obje_countFourtri)}} 
                   (@if($vente_countFourtri != 0)  
                  ( {{intval(($vente_countFourtri)*100 / ($obje_countFourtri))}}%)
                  @else
                   0%
                  @endif
                   </li>
                   @endif
                 
                 
                  @php 
                       $topVentes = DB::table('ventes')->select('commercial_id','created_at','montant', DB::raw('sum(montant) as `total`'))
                       ->whereYear('created_at', $annee)
                       ->whereMonth('created_at', $mois)
                       ->whereIn('commercial_id', [$user->id])
                       ->groupBy('commercial_id')->orderBy('total','DESC')->pluck('commercial_id')->toArray(); 
                      
                        $key = array_search($user->id, $topVentes);
                       
                       $commerciaus = DB::table('commerciaus')->count();
                       @endphp
                       
    
                       @if($key)     
                        <li>
                           🏁 Vous êtes classé(e)
                            <button class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                @if($key == 0)
                                       1e
                                      @elseif($key == 1)
                                      2e
                                      @elseif($key == 2)
                                      3e
                                      @elseif($key == 3)
                                      4e
                                      @elseif($key == 4)
                                      5e
                                      @elseif($key == 5)
                                      6e
                                      @elseif($key == 6)
                                      7e
                                      @elseif($key == 7)
                                      8e
                                      @elseif($key == 8)
                                      9e
                                      @elseif($key == 9)
                                      10e
                                      @elseif($key == 10)
                                      11e
                                      @elseif($key == 11)
                                      12e
                                      @elseif($key == 12)
                                      13e
                                      @elseif($key == 13)
                                      14e
                                      @elseif($key == 14)
                                      15e
                                      @elseif($key == 15)
                                      16e
                                      @elseif($key == 16)
                                      17e
                                      @elseif($key == 17)
                                      18e
                                      @elseif($key == 18)
                                      19e
                                      @elseif($key == 19)
                                      20e
                                      @elseif($key == 20)
                                      21e
                                      @elseif($key == 21)
                                      22e
                                      @elseif($key == 22)
                                      23e
                                      @elseif($key == 23)
                                      24e
                                      @elseif($key == 24)
                                      25e
                                      @elseif($key == 25)
                                      26e
                                      @elseif($key == 26)
                                      27e
                                      @elseif($key == 27)
                                      28e
                                      @elseif($key == 28)
                                      29e
                                      @elseif($key == 29)
                                      30e
                                 @endif
                                  /{{$commerciaus}}
                            </button>
                           
                            en terme de performance des ventes
                        
                        </li>
                        @else
                         <li>Attention : vous n'avez pas de vente</li>
                        @endif
                      
                 <li></li>
                  <li><a href="https://illimitis.helloventes.com/connexion">Voir le classement des top commerciaux sur HelloVentes</a></li>
                 
                  </ul> 
            <!--  </tbody>-->
              
            <!--</table>-->
        <div>
      
       <div style="  font-size: 20px;   font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   font-weight: 500;   line-height: 28px;   padding: 0 8px 20px; color:black;">
          
          <b>  
          <p> Bonnes Ventes</p>
          </b>
         <br>
         
         
          
          </div> 
         
            <div>
              <a href="https://illimitis.helloventes.com/connexion" style=" background: #1a73e8;   border-radius: 4px;   color: #ffffff;   display: inline-block;   font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   font-weight: 500;   letter-spacing: 0.25px;   line-height: 16px;   margin-bottom: 12px;   padding: 10px 24px;   text-decoration: none;" target=_blank>Allez sur Hello Ventes</a>
            </div>
           
    <img height=1 src=https://www.google.com/appserve/mkt/img/AFnwnKUwncdGojxpaQzytvL82kkIIInVwWfgEX7RFtep8KfDcA8.gif width=3>
  </Body>
</html>