<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('index');
});
Route::get('/ia', 'Version3Controller@indeex');

Route::get('/connexion', 'UserController@login');  
Route::post('/connexion', 'UserController@login');

Route::group(['middleware' => 'Connecter'], function(){
    
Route::get('/ventes_sn_all_tri', 'OpportuniteController@ventes_sn_all_tri');
Route::get('/ventes_bf_all_tri', 'OpportuniteController@ventes_bf_all_tri');


Route::get('/sta_exemple', 'Prospect_a_appellerController@sta_exemple');

Route::get('/rv_deja_fait', 'Prospect_a_appellerController@rv_deja_fait');
Route::get('/appels_mois', 'Prospect_a_appellerController@appels_mois');

Route::get('/mes_objectifs', 'Prospect_a_appellerController@mes_objectifs');
Route::get('/sta_commerciaux_appels', 'Prospect_a_appellerController@sta_commerciaux_appels');
Route::get('/sta_commerciaux_appels_nbreffectuer_today/{id}', 'Prospect_a_appellerController@sta_commerciaux_appels_nbreffectuer_today')->name('sta_commerciaux_appels_nbreffectuer_today');
Route::get('/sta_commerciaux_appels_nbreffecter/{id}', 'Prospect_a_appellerController@sta_commerciaux_appels_nbreffecter')->name('sta_commerciaux_appels_nbreffecter');
Route::get('/sta_commerciaux_appels_nbreffectuer/{id}', 'Prospect_a_appellerController@sta_commerciaux_appels_nbreffectuer')->name('sta_commerciaux_appels_nbreffectuer');
Route::get('/sta_commerciaux_appels_nbrqualifier/{id}', 'Prospect_a_appellerController@sta_commerciaux_appels_nbrqualifier')->name('sta_commerciaux_appels_nbrqualifier');
Route::get('/sta_commerciaux_appels_nbrnonqualifier/{id}', 'Prospect_a_appellerController@sta_commerciaux_appels_nbrnonqualifier')->name('sta_commerciaux_appels_nbrnonqualifier');
Route::get('/sta_commerciaux_appels_nbrappeler/{id}', 'Prospect_a_appellerController@sta_commerciaux_appels_nbrappeler')->name('sta_commerciaux_appels_nbrappeler');
Route::get('/sta_commerciaux_appels_rv/{id}', 'Prospect_a_appellerController@sta_commerciaux_appels_rv')->name('sta_commerciaux_appels_rv');
Route::get('/sta_commerciaux_appels_nbrpvendre/{id}', 'Prospect_a_appellerController@sta_commerciaux_appels_nbrpvendre')->name('sta_commerciaux_appels_nbrpvendre');
Route::get('/filtrer_sta_commerciaux_appels', 'Prospect_a_appellerController@filtrer_sta_commerciaux_appels')->name('filtrer_sta_commerciaux_appels');
Route::get('/filtrer_sta_commerciaux_appels_mois', 'Prospect_a_appellerController@filtrer_sta_commerciaux_appels_mois')->name('filtrer_sta_commerciaux_appels_mois');
Route::get('/filtre_appels_effectuer_team', 'Prospect_a_appellerController@filtre_appels_effectuer_team')->name('filtre_appels_effectuer_team');

Route::get('/search_pros_numero', 'Prospect_a_appellerController@filtrer_pros_numero')->name('search_pros_numero');
Route::get('/filtrer_pros_numero_rappeler', 'Prospect_a_appellerController@filtrer_pros_numero_rappeler')->name('filtrer_pros_numero_rappeler');
Route::get('/filtrer_pros_numero_qualifier', 'Prospect_a_appellerController@filtrer_pros_numero_qualifier')->name('filtrer_pros_numero_qualifier');
Route::get('/filtrer_pros_numero_nonqualifier', 'Prospect_a_appellerController@filtrer_pros_numero_nonqualifier')->name('filtrer_pros_numero_nonqualifier');
Route::get('/filtrer_pros_numero_rv', 'Prospect_a_appellerController@filtrer_pros_numero_rv')->name('filtrer_pros_numero_rv');


Route::get('/sta_commerciaux_appels_nbreffectuer_semaine/{id}', 'Prospect_a_appellerController@sta_commerciaux_appels_nbreffectuer_semaine')->name('sta_commerciaux_appels_nbreffectuer_semaine');
Route::get('/sta_commerciaux_appels_nbrqualifier_semaine/{id}', 'Prospect_a_appellerController@sta_commerciaux_appels_nbrqualifier_semaine')->name('sta_commerciaux_appels_nbrqualifier_semaine');
Route::get('/sta_commerciaux_appels_nbrnonqualifier_semaine/{id}', 'Prospect_a_appellerController@sta_commerciaux_appels_nbrnonqualifier_semaine')->name('sta_commerciaux_appels_nbrnonqualifier_semaine');
Route::get('/sta_commerciaux_appels_nbrappeler_semaine/{id}', 'Prospect_a_appellerController@sta_commerciaux_appels_nbrappeler_semaine')->name('sta_commerciaux_appels_nbrappeler_semaine');
Route::get('/sta_commerciaux_appels_rv_semaine/{id}', 'Prospect_a_appellerController@sta_commerciaux_appels_rv_semaine')->name('sta_commerciaux_appels_rv_semaine');

Route::get('/ajout_prospect_appeler', 'Prospect_a_appellerController@ajout_prospect_appeler')->name('ajout_prospect_appeler');
Route::post('/ajout_prospect_appeler', 'Prospect_a_appellerController@store_prospect_appeler')->name('store_prospect_appeler');

Route::get('/edit_entreprise_resultat/edit/{id}', 'Prospect_a_appellerController@edit_entreprise_resultat')->name('entreprise_resultat.edit');
Route::post('/edit_entreprise_resultat/edit/{id}', 'Prospect_a_appellerController@update_entreprise_resultat')->name('entreprise_resultat.update');

Route::get('/edit_entreprise_qualifier/edit/{id}', 'Prospect_a_appellerController@edit_entreprise_qualifier')->name('entreprise_qualifier.edit');
Route::post('/edit_entreprise_qualifier/edit/{id}', 'Prospect_a_appellerController@update_entreprise_qualifier')->name('entreprise_qualifier.update');

Route::get('/edit_entreprise_nonqualifier/edit/{id}', 'Prospect_a_appellerController@edit_entreprise_nonqualifier')->name('entreprise_nonqualifier.edit');
Route::post('/edit_entreprise_nonqualifier/edit/{id}', 'Prospect_a_appellerController@update_entreprise_nonqualifier')->name('entreprise_nonqualifier.update');

Route::get('/edit_entreprise_rv/edit/{id}', 'Prospect_a_appellerController@edit_entreprise_rv')->name('entreprise_rv.edit');
Route::post('/edit_entreprise_rvt/edit/{id}', 'Prospect_a_appellerController@update_entreprise_rv')->name('entreprise_rv.update');

Route::get('/edit_entreprise_arappeler/edit/{id}', 'Prospect_a_appellerController@edit_entreprise_arappeler')->name('entreprise_arappeler.edit');
Route::post('/edit_entreprise_arappeler/edit/{id}', 'Prospect_a_appellerController@update_entreprise_arappeler')->name('entreprise_arappeler.update');

Route::post('/import_me', 'Prospect_a_appellerController@import_me')->name('import_me');
Route::get('/import-prospect_me', 'Prospect_a_appellerController@import_prospect_me')->name('import_prospect_me');

Route::get('/file-import', 'Prospect_a_appellerController@importView')->name('import-view');
Route::post('/import', 'Prospect_a_appellerController@import')->name('import');
Route::get('/export-users/{id}', 'Prospect_a_appellerController@exportUsers')->name('export-users');
Route::get('/export-plannings', 'Prospect_a_appellerController@exportPlannings')->name('export-plannings');

Route::get('/nouveaux_clients', 'Prospect_a_appellerController@nouveaux_clients');
Route::get('/total_clients', 'Prospect_a_appellerController@total_clients');

Route::get('/import-prospect/{id}', 'Prospect_a_appellerController@import_prospect')->name('import_prospect');




Route::get('/liste_besoins', 'UserController@liste_besoins');
Route::get('/voir_plus_formulaire/{id}', 'UserController@voir_plus_formulaire')->name('voir_plus.formulaire');
Route::get('/clotuer/formulaire/{id}', 'UserController@cloturer_formulaire')->name('cloturer_formulaire');




Route::get('/appel_parjour', 'Prospect_a_appellerController@appel_parjour'); 
Route::get('/appel_parpays', 'Prospect_a_appellerController@appel_parpays'); 
Route::get('/voir_appel_parjour/{id}', 'Prospect_a_appellerController@voir_appel_parjour')->name('voir.appel_parjour');
Route::get('/voir_parjour/{id}', 'Prospect_a_appellerController@voir_parjour')->name('voir.parjour');
Route::get('/filtre_appel_parpays', 'Prospect_a_appellerController@filtre_appel_parpays')->name('filtre_appel_parpays');
Route::get('/voir_rv_parjour/{id}', 'Prospect_a_appellerController@voir_rv_parjour')->name('voir.rv_parjour');





Route::get('/importer_bdd', 'Base_donneeController@importer_bdd'); 
Route::post('/import_bdd_store', 'Base_donneeController@import_bdd_store');

Route::get('/ajouter_bdd', 'Base_donneeController@ajouter_bdd'); 
Route::post('/ajouter_bdd_store', 'Base_donneeController@ajouter_bdd_store');

Route::get('/lister_bdd', 'Base_donneeController@lister_bdd'); 
Route::get('/prospect_bddFiltre', 'Base_donneeController@prospect_bddFiltre')->name('prospect_bddFiltre');

Route::get('/lister_bdd_chaud', 'Base_donneeController@lister_bdd_chaud'); 
Route::get('/prospect_bddFiltre_chaud', 'Base_donneeController@prospect_bddFiltre_chaud')->name('prospect_bddFiltre_chaud');

Route::get('/nouveaux_clients_tous', 'Base_donneeController@nouveaux_clients_tous'); 
Route::get('/nouveaux_clients_tousFiltre', 'Base_donneeController@nouveaux_clients_tousFiltre')->name('nouveaux_clients_tousFiltre');

Route::get('/nouveaux_clients_tous_pass', 'Base_donneeController@nouveaux_clients_tous_pass'); 
Route::get('/nouveaux_clients_tous_passFiltre', 'Base_donneeController@nouveaux_clients_tous_passFiltre')->name('nouveaux_clients_tous_passFiltre');

Route::get('/bdd_prospect/edit/{id}', 'Base_donneeController@edit_bdd_prospects')->name('bdd_prospects.edit');
Route::post('/bdd_prospects/edit/{id}', 'Base_donneeController@update_bdd_prospects')->name('bdd_prospects.update');
Route::get('/fiche_prospect_bdd/{id}', 'Base_donneeController@fiche_prospect_bdd')->name('fiche_prospect_bdd');

Route::get('/bdd_prospect/qualifier/{id}', 'Base_donneeController@qualifier_bdd_prospects')->name('bdd_prospects.qualifier');
Route::post('/bdd_prospects/qualifier/{id}', 'Base_donneeController@qualifier_bdd_prospects_store')->name('bdd_prospectStore.qualifier');



Route::get('/affecter_des_prospects', 'Prospect_a_appellerController@affecter_des_prospects'); 
Route::get('/prospects_a_appeler', 'Prospect_a_appellerController@prospects_a_appeler'); 
Route::get('/prospect_a_appeler/edit/{id}', 'Prospect_a_appellerController@edit_prospect_a_appeler')->name('prospect_a_appeler.edit');
Route::post('/prospect_a_appelers/edit/{id}', 'Prospect_a_appellerController@update_prospect_a_appeler')->name('prospect_a_appeler.update');

Route::get('/prospect_effectuer/edit/{id}', 'Prospect_a_appellerController@edit_prospect_effectuer')->name('prospect_effectuer.edit');
Route::post('/prospect_effectuers/edit/{id}', 'Prospect_a_appellerController@update_prospect_effectuer')->name('prospect_effectuer.update');

Route::get('/prospect_qualifier/edit/{id}', 'Prospect_a_appellerController@edit_prospect_qualifier')->name('prospect_qualifier.edit');
Route::post('/prospect_qualifiers/edit/{id}', 'Prospect_a_appellerController@update_prospect_qualifier')->name('prospect_qualifier.update');
Route::get('/fiche_prospect_qualifiers/{id}', 'Prospect_a_appellerController@fiche_prospect_qualifiers')->name('fiche_prospect_qualifiers');

Route::get('/prospect_non_qualifier/{id}', 'Prospect_a_appellerController@edit_prospect_non_qualifier')->name('prospect_non_qualifier.edit');
Route::post('/prospect_non_qualifiers/edit/{id}', 'Prospect_a_appellerController@update_prospect_non_qualifier')->name('prospect_non_qualifier.update');
Route::get('/fiche_prospectnon_qualifiers/{id}', 'Prospect_a_appellerController@fiche_prospect_non_qualifiers')->name('fiche_prospect_non_qualifiers');

Route::get('/prospect_a_rappaler/{id}', 'Prospect_a_appellerController@edit_prospect_a_rappaler')->name('prospect_a_rappaler.edit');
Route::post('/prospect_a_rappalers/edit/{id}', 'Prospect_a_appellerController@update_prospect_a_rappaler')->name('prospect_a_rappaler.update');
Route::get('/fiche_prospect_a_rappaler/{id}', 'Prospect_a_appellerController@fiche_prospect_a_rappaler')->name('fiche_prospect_a_rappaler');

Route::get('/action_rv/{id}', 'Prospect_a_appellerController@action_rv')->name('action_rv.voir');
Route::get('/prospect_rv/{id}', 'Prospect_a_appellerController@edit_prospect_rv')->name('prospect_rv.edit');
Route::post('/prospect_rvs/edit/{id}', 'Prospect_a_appellerController@update_prospect_rv')->name('prospect_rv.update');
Route::get('/fiche_prospect_rv/{id}', 'Prospect_a_appellerController@fiche_prospect_rv')->name('fiche_prospect_rv');
Route::get('/cloturer_rv/{id}', 'Prospect_a_appellerController@edit_cloturer_rv')->name('cloturer_rv.edit');
Route::post('/cloturer_rv/edit/{id}', 'Prospect_a_appellerController@update_cloturer_rv')->name('cloturer_rv.update');

Route::get('/prospect_produit_avendre/{id}', 'Prospect_a_appellerController@edit_prospect_produit_avendre')->name('prospect_produit_avendre.edit');
Route::post('/prospect_produit_avendres/edit/{id}', 'Prospect_a_appellerController@update_prospect_produit_avendre')->name('prospect_produit_avendre.update');
Route::get('/fiche_prospect_produit_avendre/{id}', 'Prospect_a_appellerController@fiche_prospect_produit_avendre')->name('fiche_prospect_produit_avendre');


Route::get('/suivi_appel/edit/{id}', 'Prospect_a_appellerController@edit_suivi_appel')->name('suivi_appel.edit');
Route::post('/suivi_appel/edit', 'Prospect_a_appellerController@update_suivi_appel')->name('suivi_appel.update');
Route::get('/fiche_prospect/{id}', 'Prospect_a_appellerController@fiche_prospect')->name('fiche_prospect');
Route::get('/fiche_prospect_resultat/{id}', 'Prospect_a_appellerController@fiche_prospect_resultat')->name('fiche_prospect_resultat');

Route::get('/appels_a_effectuer', 'Prospect_a_appellerController@appels_a_effectuer');
Route::get('/appels_effectuer', 'Prospect_a_appellerController@appels_effectuer');
Route::get('/appelsaqualifier', 'Prospect_a_appellerController@appelsaqualifier');
Route::get('/appelsnonqualifier', 'Prospect_a_appellerController@appelsnonqualifier');
Route::get('/appels_arappeler', 'Prospect_a_appellerController@appels_arappeler');
Route::get('/appels_daterv', 'Prospect_a_appellerController@appels_daterv');
Route::get('/produit_avendre', 'Prospect_a_appellerController@produit_avendre');
Route::get('/appels_effectuer_team', 'Prospect_a_appellerController@appels_effectuer_team');



//suivi des sorties terrain
Route::get('/rapport_tri_sn', 'ProspectionController@rapport_tri_sn');
Route::get('/rapport_tri_bf', 'ProspectionController@rapport_tri_bf');
Route::get('/rapport_tri_glo', 'ProspectionController@rapport_tri_glo');


Route::get('/sendEmailAgent', 'AgentController@sendEmailAgent');
Route::post('/sendmailrappel', 'AgentController@sendmailrappel');
Route::patch('/demanderefuser/{action}', 'AgentController@demanderefuser')->name('demanderefuser.action');
Route::patch('/demandeaccepter/{action}', 'AgentController@demandeaccepter')->name('demandeaccepter.action');

Route::get('/mailing', 'ProspectionController@mailing');
Route::post('/mail_prospect', 'ProspectionController@mail_prospect')->name('mail_prospect');

// Route::get('/sendEmailAgent_team', 'AgentController@sendEmailAgent');
Route::post('/sendmailrappel_mateam', 'AgentController@sendmailrappel');

Route::get('download/rapport_reunion','DirectionController@download');

Route::get('/derniers_updates', 'UserController@derniers_updates');

Route::get('/admin/dashboard', 'UserController@dashboard');
Route::get('/dashboard/commerciaux', 'UserController@dashboard_commerciaux');
Route::get('/dashboard/commerciauxNew', 'UserController@dashboard_commerciauxNew');

Route::get('/dash_ventes', 'UserController@dash_ventes');
Route::get('/dash_rapports', 'UserController@dash_rapports');
Route::get('/classement_mensuels', 'UserController@classement_mensuels');
Route::get('/top_commerciaux_tri', 'UserController@top_commerciaux_tri');
Route::get('/gestion_appels', 'UserController@gestion_appels');
Route::get('/dash_realisations', 'UserController@dash_realisations');
Route::get('/admin/dashboard/user', 'UserController@dashboard_user');
Route::get('/admin/dashboard/directeur', 'UserController@dashboard_directeur');
Route::get('/admin/dashboard/responsable', 'UserController@dashboard_responsable');

Route::get('/admin/ajouter/origine', 'CommerciauxController@createOrigine')->name('createOrigine');
Route::get('/admin/ajouter/statut', 'CommerciauxController@createStatut')->name('createStatut');
Route::post('/admin/store/origine', 'CommerciauxController@storeOrigine')->name('storeOrigine');
Route::post('/admin/store/statut', 'CommerciauxController@storeStatut')->name('storeStatut');
Route::get('/toutes_actions', 'ActionController@toutes_actions');
Route::get('/toutes_actionsFiltre', 'ActionController@toutes_actionsFiltre')->name('toutes_actionsFiltre');

Route::get('/toutes_actions_fait', 'ActionController@toutes_actions_fait');
Route::get('/toutes_actionsFiltre_fait', 'ActionController@toutes_actionsFiltre_fait')->name('toutes_actionsFiltre_fait');

Route::get('/mesactions_a_venir', 'ActionController@mesactions_a_venir');
Route::get('/mesactions_a_venirFiltre', 'ActionController@mesactions_a_venirFiltre')->name('mesactions_a_venirFiltre');

Route::get('/toutes_actions_aVenir', 'ActionController@toutes_actions_aVenir');
Route::get('/toutes_actionsFiltre_aVenir', 'ActionController@toutes_actionsFiltre_aVenir')->name('toutes_actionsFiltre_aVenir');

Route::get('/toutes_actions_fait_res', 'ActionController@toutes_actions_fait_res');
Route::get('/toutes_actionsFiltre_fait_res', 'ActionController@toutes_actionsFiltre_fait_res')->name('toutes_actionsFiltre_fait_res');

Route::get('/toutes_actions_aVenir_res', 'ActionController@toutes_actions_aVenir_res');
Route::get('/toutes_actionsFiltre_aVenir_res', 'ActionController@toutes_actionsFiltre_aVenir_res')->name('toutes_actionsFiltre_aVenir_res');


Route::get('/toutes_actions_res', 'ActionController@toutes_actions_res');
Route::get('/toutes_actionsFiltre_res', 'ActionController@toutes_actionsFiltre_res')->name('toutes_actionsFiltre_res');

Route::get('/statistique_opportunites', 'OpportuniteController@statistique_opportunites');
Route::get('/statistique_oppSN_70', 'OpportuniteController@statistique_oppSN_70');
Route::get('/statistique_oppSN_50', 'OpportuniteController@statistique_oppSN_50');
Route::get('/statistique_oppBF_70', 'OpportuniteController@statistique_oppBF_70');
Route::get('/statistique_oppBF_50', 'OpportuniteController@statistique_oppBF_50');
Route::get('/liste_hot_deals', 'OpportuniteController@statistique_hot_deals');
Route::get('/liste_hot_deals_sn', 'OpportuniteController@statistique_hot_deals_sn');
Route::get('/liste_hot_deals_bf', 'OpportuniteController@statistique_hot_deals_bf');
Route::get('/filtrer_hot_deals_sn', 'OpportuniteController@filtrer_hot_deals_sn')->name('filtrer_hot_deals_sn');
Route::get('/filtrer_hot_deals_bf', 'OpportuniteController@filtrer_hot_deals_bf')->name('filtrer_hot_deals_bf');

Route::get('/filtre_hot_deals', 'OpportuniteController@filtre_hot_deals')->name('filtre_hot_deals');
Route::get('/tous_hot_deals', 'OpportuniteController@tous_hot_deals');
Route::get('/filtre_tous_hot_deals', 'OpportuniteController@filtre_tous_hot_deals')->name('filtre_tous_hot_deals');
Route::get('/filtrer_hot_deals', 'OpportuniteController@filtrer_hot_deals')->name('filtrer_hot_deals');
Route::get('/statistique_oppBF_50', 'OpportuniteController@statistique_oppBF_50')->name('statistique_oppBF_50');
Route::get('/statistique_oppBF_70', 'OpportuniteController@statistique_oppBF_70')->name('statistique_oppBF_70');
Route::get('/statistique_oppSN_50', 'OpportuniteController@statistique_oppSN_50')->name('statistique_oppSN_50');
Route::get('/statistique_oppSN_70', 'OpportuniteController@statistique_oppSN_70')->name('statistique_oppSN_70');

Route::get('/top_commerciaux_detail', 'OpportuniteController@top_commerciaux_detail');
Route::get('/filtre_top_commerciaux_detail', 'OpportuniteController@filtre_top_commerciaux_detail')->name('filtre_top_commerciaux_detail');

Route::get('/clotuer/action/{id}', 'ActionController@cloturerAction')->name('cloturerAction');
Route::get('/opportunite_action', 'ActionController@opportunite_action');
Route::get('/modifier_action/{id}', 'ActionController@modifier_action')->name('modifier_action');
Route::post('/update_action/{id}', 'ActionController@update_action')->name('update_action');

Route::get('/modifier_action_stra/{id}', 'ActionController@modifier_action_stra')->name('modifier_action_stra');
Route::post('/update_action_stra/{id}', 'ActionController@update_action_stra')->name('update_action_stra');

Route::get('/modifier_action_Ecritik/{id}', 'ActionController@modifier_action_Ecritik')->name('modifier_action_Ecritik');
Route::post('/update_action_Ecritik/{id}', 'ActionController@update_action_Ecritik')->name('update_action_Ecritik');


Route::resource('/action', 'ActionController'); 
Route::resource('/commerciaux', 'CommerciauxController'); 
Route::resource('/opportunites', 'OpportuniteController');
Route::get('/lister_opportunites_res', 'OpportuniteController@lister_opportunites_res');
Route::get('/opportunite_prevus', 'OpportuniteController@opportunite_prevus');
Route::get('/opportunite_deuxieme_tri', 'OpportuniteController@opportunite_deuxieme_tri');

Route::get('/lister_opportunites_resFiltre', 'OpportuniteController@lister_opportunites_resFiltre')->name('lister_opportunites_resFiltre');

Route::get('/suivi_opportunites', 'OpportuniteController@suivi_opportunites');
Route::get('/marcher_suivi_opportunites', 'OpportuniteController@marcher_suivi_opportunites');

Route::get('/mettre_a_jour_statut/op/{id}', 'OpportuniteController@mettre_a_jour_statut_edit')->name('mettre_a_jour_statut.edit');
Route::post('/mettre_a_jour_statuts/op/{id}', 'OpportuniteController@mettre_a_jour_statut_update')->name('mettre_a_jour_statut.update');

Route::get('/mettre_a_jour_proba/op/{id}', 'OpportuniteController@mettre_a_jour_proba_edit')->name('mettre_a_jour_proba.edit');
Route::post('/mettre_a_jour_probas/op/{id}', 'OpportuniteController@mettre_a_jour_proba_update')->name('mettre_a_jour_proba.update');

Route::get('/mettre_a_jour_statut/op_prospect/{id}', 'OpportuniteController@statut_op_prospect_edit')->name('statut_op_prospect.edit');
Route::post('/mettre_a_jour_statuts/opSuivi/{id}', 'OpportuniteController@statut_op_prospect_update')->name('statut_op_prospect.update');

Route::get('/mettre_a_jour_statut/appel_offre/{id}', 'OpportuniteController@statut_appel_offre_edit')->name('statut_appel_offre.edit');
Route::post('/mettre_a_jour_statuts/appel_offre/{id}', 'OpportuniteController@statut_appel_offre_update')->name('statut_appel_offre.update');

Route::get('/filtrer_prospect', 'OpportuniteController@filtrer_prospect')->name('filtrer_prospect');


Route::get('/edit_action_critique/op/{id}', 'OpportuniteController@edit_action_critique')->name('action_critique.edit');
Route::patch('/edit_action_critiques/op/{id}', 'OpportuniteController@update_action_critique')->name('action_critique.update');
Route::get('/edit/op_maTeam/{id}', 'OpportuniteController@op_maTeam_edit')->name('op_maTeam.edit');
Route::patch('/edits/op_maTeam/{id}', 'OpportuniteController@op_maTeam_update')->name('op_maTeam.update');
Route::get('/edit/op/{id}', 'OpportuniteController@op_edit')->name('op.edit');
Route::patch('/edits/op/{id}', 'OpportuniteController@op_update')->name('op.update');

Route::get('/edit/appel_offre/{id}', 'OpportuniteController@appel_offre_edit')->name('appel_offre.edit');
Route::patch('/edits/appel_offre/{id}', 'OpportuniteController@appel_offre_update')->name('appel_offre.update');

Route::get('/edit/op_prospect/{id}', 'OpportuniteController@op_prospect_edit')->name('op_prospect.edit');
Route::patch('/edits/op_prospect/{id}', 'OpportuniteController@op_prospect_update')->name('op_prospect.update');

Route::get('/edit/com/{id}', 'OpportuniteController@commerciaux_edit')->name('commerciaux.edit');
Route::post('/edits/com/{id}', 'OpportuniteController@commerciaux_update')->name('commerciaux.update');
Route::get('/edit/contact/{id}', 'OpportuniteController@contact_edit')->name('contact.edit');
Route::post('/edits/contact/{id}', 'OpportuniteController@contact_update')->name('contact.update');

Route::get('/edit/listcom/{id}', 'OpportuniteController@listcommerciaux_edit')->name('listcommerciaux.edit');
Route::post('/edits/listcom/{id}', 'OpportuniteController@listcommerciaux_update')->name('listcommerciaux.update');

Route::get('/search_op_action', 'ActionController@search_op_action')->name('search_op_action');
Route::get('/search_commerciau', 'ProspectionController@filtrer_commerciaux')->name('search_commerciaux');
Route::get('/search_commerciau_para', 'ProspectionController@filtrer_commerciaux_para')->name('search_commerciaux_para');
Route::get('/search_commerciauRes', 'ProspectionController@filtrer_commerciauxRes')->name('search_commerciauRes');
Route::get('/tous_search_commerciau', 'ProspectionController@tous_search_commerciau')->name('tous_search_commerciau');



Route::get('/prospect_stra', 'ProspectionController@prospect_stra');
Route::get('/filtrer_liste_updates_res', 'ProspectionController@filtrer_liste_updates_res')->name('filtrer_liste_updates_res');
Route::get('/filtrer_liste_updates', 'ProspectionController@filtrer_liste_updates')->name('filtrer_liste_updates');
Route::get('/filtrer_liste_demos_res', 'ProspectionController@filtrer_liste_demos_res')->name('filtrer_liste_demos_res');
Route::get('/filtrer_liste_demos', 'ProspectionController@filtrer_liste_demos')->name('filtrer_liste_demos');

Route::get('/securite_search_par_com_res', 'UserController@securite_search_par_com_res')->name('securite_search_par_com_res');
Route::get('/onboarding_search_par_com_res', 'UserController@onboarding_search_par_com_res')->name('onboarding_search_par_com_res');
Route::get('/filtre_rapport_prospect', 'ProspectionController@filtre_rapport_prospect')->name('filtre_rapport_prospect');
Route::get('/search_par_com_res', 'ProspectionController@search_par_com_res')->name('search_par_com_res');
Route::get('/search_par_com', 'ProspectionController@filtrer_par_com')->name('search_par_com');
Route::get('/filtrer_par_com_Rcontact', 'ProspectionController@filtrer_par_com_Rcontact')->name('filtrer_par_com_Rcontact');
Route::get('/filtrer_par_com_Rcontact_res', 'ProspectionController@filtrer_par_com_Rcontact_res')->name('filtrer_par_com_Rcontact_res');

Route::get('/search_statut_appelO', 'OpportuniteController@filtrer_opportunite_appelO')->name('search_statut_appelO');
Route::get('/search_statut_appelO_tous', 'OpportuniteController@filtrer_opportunite_appelO_tous')->name('search_statut_appelO_tous');
Route::get('/search_statut', 'OpportuniteController@filtrer_opportunite')->name('search_statut');
Route::get('/search_opportunite_commercial', 'OpportuniteController@filtrer_commercial')->name('search_commercial');
Route::post('/archiver/{id}', 'OpportuniteController@archiver_opportunite')->name('archiver.opportunite');
Route::post('/desarchiver/{id}', 'OpportuniteController@desarchiver_opportunite')->name('desarchiver.opportunite');
Route::get('/search_statut_maTeam', 'OpportuniteController@filtrer_statut_maTeam')->name('search_statut_maTeam');
Route::get('/search_statut_maTeam_res', 'OpportuniteController@filtrer_statut_maTeam_res')->name('search_statut_maTeam_res');


Route::get('/opportunite_prospectCreate/{id}', 'OpportuniteController@opportunite_prospectCreate')->name('opportunite_prospectCreate');
Route::post('/opportunite_prospectStore', 'OpportuniteController@opportunite_prospectStore')->name('opportunite_prospectStore');

Route::get('/create_raison', 'RaisonController@create_raison');
Route::post('/store_raison', 'RaisonController@store_raison')->name('store_raison');
Route::get('/dg_raison', 'RaisonController@dg_raison');
Route::get('/res_raison', 'RaisonController@res_raison');
Route::get('/dg_raison_filtre', 'RaisonController@dg_raison_filtre')->name('dg_raison_filtre');
Route::get('/res_raison_filtre', 'RaisonController@res_raison_filtre')->name('res_raison_filtre');



Route::get('/appelOCreate/{id}', 'OpportuniteController@appelO_VenteCreate')->name('appelO_VenteCreate');
Route::post('/appelO_VenteStore/{id}', 'OpportuniteController@appelO_update_archiver')->name('appelO_update_archiver');
Route::get('/opportunite_prospect_VenteCreate/{id}', 'OpportuniteController@opportunite_prospect_VenteCreate')->name('opportunite_prospect_VenteCreate');
Route::post('/opportunite_prospectStore/{id}', 'OpportuniteController@opp_prospect_update_archiver')->name('opp_prospect_update_archiver');

Route::get('/opportunite_VenteCreate/{id}', 'OpportuniteController@opportunite_VenteCreate')->name('opportunite_VenteCreate');
Route::post('/opportunite_VenteStore', 'OpportuniteController@opportunite_VenteStore')->name('opportunite_VenteStore');

Route::get('/opportunite_ajoutDemo/{id}', 'OpportuniteController@opportunite_ajoutDemo')->name('opportunite_ajoutDemo');
Route::post('/opportunite_ajoutDemos', 'OpportuniteController@opportunite_ajoutDemoStore')->name('opportunite_ajoutDemoStore');

Route::get('/liste_demos', 'OpportuniteController@liste_demos');
Route::get('/liste_updates', 'OpportuniteController@liste_updates');

Route::get('/liste_demos_res', 'OpportuniteController@liste_demos_res');
Route::get('/liste_updates_res', 'OpportuniteController@liste_updates_res');

Route::get('/opportunite_ajoutUpdate/{id}', 'OpportuniteController@opportunite_ajoutUpdate')->name('opportunite_ajoutUpdate');
Route::post('/opportunite_ajoutUpdate', 'OpportuniteController@opportunite_ajoutUpdateStore')->name('opportunite_ajoutUpdateStore');

Route::post('/update_archiver/{id}', 'OpportuniteController@update_archiver')->name('update_archiver');
Route::get('/historiques/{id}', 'OpportuniteController@historiques_op')->name('historiques_op.voir');
Route::get('/historiques_proba/{id}', 'OpportuniteController@historiques_proba')->name('historiques_proba.voir');

Route::get('/toutes_lesactions/{id}', 'OpportuniteController@toutes_lesactions_op')->name('toutes_lesactions.voir');
Route::get('/opportunite_archiver', 'OpportuniteController@opportunite_archiver');
Route::get('/opportunite_gagner', 'OpportuniteController@opportunite_gagner');
Route::get('/opportunite_perdu', 'OpportuniteController@opportunite_perdu');
Route::get('/opportunite_abandonner', 'OpportuniteController@opportunite_abandonner');
Route::get('/toutes_lesactions_moi/{id}', 'OpportuniteController@toutes_lesactions_op_moi')->name('toutes_lesactions.voir_moi');

Route::get('/opportunite_abandonner_maTeam_res', 'OpportuniteController@opportunite_abandonner_maTeam_res');
Route::get('/opportunite_archiver_maTeam_res', 'OpportuniteController@opportunite_archiver_maTeam_res');
Route::get('/opportunite_gagner_maTeam_res', 'OpportuniteController@opportunite_gagner_maTeam_res');
Route::get('/opportunite_perdu_maTeam_res', 'OpportuniteController@opportunite_perdu_maTeam_res');

Route::get('/opportunite_abandonner_maTeam', 'OpportuniteController@opportunite_abandonner_maTeam');
Route::get('/opportunite_archiver_maTeam', 'OpportuniteController@opportunite_archiver_maTeam');
Route::get('/opportunite_gagner_maTeam', 'OpportuniteController@opportunite_gagner_maTeam');
Route::get('/opportunite_perdu_maTeam', 'OpportuniteController@opportunite_perdu_maTeam');

Route::get('/toutes_les_opportunite', 'OpportuniteController@toutes_les_opportunite');


Route::get('/filtre_onboarding', 'ProspectionController@filtre_onboarding')->name('filtre_onboarding'); 
Route::get('/filtre_password', 'ProspectionController@filtre_password')->name('filtre_password'); 

Route::get('/rapport_prospects', 'ProspectionController@rapport_prospect');
Route::get('/rapport_com/{id}', 'ProspectionController@rapport_commercial')->name('rapport_commercial');
Route::get('/rapport_comFiltre', 'ProspectionController@rapport_commercialFiltre')->name('rapport_commercialFiltre');

Route::get('/rapport_individuel', 'ProspectionController@rapport_individuel');

Route::get('/planning_commercial/{id}', 'ProspectionController@planning_commercial')->name('planning_commercial');
Route::get('/rapport_team', 'ProspectionController@rapport_team');
Route::get('/rapport_teamFiltre', 'ProspectionController@rapport_teamFiltre')->name('rapport_teamFiltre');
Route::get('/rapport_teamSN', 'ProspectionController@rapport_teamSN');
Route::get('/rapport_teamSNFiltre', 'ProspectionController@rapport_teamSNFiltre')->name('rapport_teamSNFiltre');
Route::get('/rapport_teamBF', 'ProspectionController@rapport_teamBF');
Route::get('/rapport_teamBFFiltre', 'ProspectionController@rapport_teamBFFiltre')->name('rapport_teamBFFiltre');

Route::get('/rapport_teamCI', 'ProspectionController@rapport_teamCI');
Route::get('/rapport_teamCIFiltre', 'ProspectionController@rapport_teamCIFiltre')->name('rapport_teamCIFiltre');

Route::get('/rapport_teamYear', 'ProspectionController@rapport_teamYear');
Route::get('/rapport_teamYearFiltre', 'ProspectionController@rapport_teamYearFiltre')->name('rapport_teamYearFiltre');

Route::get('/rapport_teamYearme', 'ProspectionController@rapport_teamYearme');
Route::get('/rapport_teamOpportunite', 'ProspectionController@rapport_teamOpportunite');
Route::get('/rapport_teamYearFiltreme', 'ProspectionController@rapport_teamYearFiltreme')->name('rapport_teamYearFiltreme');

Route::get('/rapport_contacts_res', 'OpportuniteController@rapport_contacts_res');
Route::get('/rapport_contacts', 'OpportuniteController@rapport_contact');
Route::get('/liste_contacts', 'OpportuniteController@liste_contact');
Route::get('/action_critiques', 'OpportuniteController@action_critiques');
Route::get('/action_echeances_critiques', 'OpportuniteController@action_echeances_critiques');
Route::get('/historiques_statuts', 'ProspectionController@historiques_statuts');
Route::get('/mes_vente_deumois', 'OpportuniteController@mes_vente_deumois');
Route::get('/mes_vente_deumois_tri', 'OpportuniteController@mes_vente_deumois_tri');

Route::get('/voir_sesVente_dumois/{id}', 'OpportuniteController@voir_sesVente_dumois')->name('voir_sesVente_dumois');
Route::get('/voir_sesVente_dumoispasse/{id}', 'OpportuniteController@voir_sesVente_dumoispasse')->name('voir_sesVente_dumoispasse');

Route::get('/ventes_sn', 'OpportuniteController@ventes_sn');
Route::get('/ventes_sn_tri', 'OpportuniteController@ventes_sn_tri');
Route::get('/ventes_sn_tri_dernier', 'OpportuniteController@ventes_sn_tri_dernier');

Route::get('/les_ventes', 'OpportuniteController@les_ventes');
Route::get('/les_ventesFiltre', 'OpportuniteController@les_ventesFiltre')->name('les_ventesFiltre');
Route::get('/les_ventes_mois', 'OpportuniteController@les_ventes_mois');
Route::get('/les_ventes_moisFiltre', 'OpportuniteController@les_ventes_moisFiltre')->name('les_ventes_moisFiltre');
Route::get('/les_ventes_mois_pass', 'OpportuniteController@les_ventes_mois_pass');
Route::get('/les_ventes_mois_passFiltre', 'OpportuniteController@les_ventes_mois_passFiltre')->name('les_ventes_mois_passFiltre');
Route::get('/les_ventes_mois_tri', 'OpportuniteController@les_ventes_mois_tri');
Route::get('/les_ventes_mois_triFiltre', 'OpportuniteController@les_ventes_mois_triFiltre')->name('les_ventes_mois_triFiltre');
Route::get('/les_ventes_mois_tri_dernier', 'OpportuniteController@les_ventes_mois_tri_dernier');
Route::get('/les_ventes_mois_tri_dernierFiltre', 'OpportuniteController@les_ventes_mois_tri_dernierFiltre')->name('les_ventes_mois_tri_dernierFiltre');

Route::get('/les_ventes_me', 'OpportuniteController@les_ventes_me');
Route::get('/les_ventes_mois_me', 'OpportuniteController@les_ventes_mois_me');
Route::get('/les_ventes_mois_tri_me', 'OpportuniteController@les_ventes_mois_tri_me');

Route::get('/tous_ventes', 'OpportuniteController@tous_ventes');
Route::get('/ventes_tri', 'OpportuniteController@ventes_tri');
Route::get('/mesventes_tri', 'OpportuniteController@mesventes_tri');

Route::get('/ventes_technologies_tri', 'OpportuniteController@ventes_technologies_tri');
Route::get('/ventes_formation_tri', 'OpportuniteController@ventes_formation_tri');
Route::get('/ventes_formation_tri_dernier', 'OpportuniteController@ventes_formation_tri_dernier');
Route::get('/ventes_technologies_tri_dernier', 'OpportuniteController@ventes_technologies_tri_dernier');

Route::get('/ventes_bf', 'OpportuniteController@ventes_bf');
Route::get('/ventes_bf_tri', 'OpportuniteController@ventes_bf_tri');
Route::get('/ventes_bf_tri_dernier', 'OpportuniteController@ventes_bf_tri_dernier');

Route::get('/ventes_formation', 'OpportuniteController@ventes_formation');
Route::get('/ventes_technologies', 'OpportuniteController@ventes_technologies');

Route::get('/ventes_snFiltre', 'OpportuniteController@ventes_snFiltre')->name('ventes_snFiltre');
Route::get('/ventes_bfFiltre', 'OpportuniteController@ventes_bfFiltre')->name('ventes_bfFiltre');

Route::get('/ventes_technologie', 'OpportuniteController@ventes_technologiesFiltre')->name('ventes_technologieFiltre');
Route::get('/ventes_formationFiltre', 'OpportuniteController@ventes_formationFiltre')->name('ventes_formationFiltre');

Route::get('/mescommisions_dumois', 'OpportuniteController@mescommisions_dumois');
Route::get('/tous_commisions_dumois', 'OpportuniteController@tous_commisions_dumois');
Route::get('/tous_commisions_dumois_res', 'OpportuniteController@tous_commisions_dumois_res');

Route::get('/tous_commisions_dumoisFiltre', 'OpportuniteController@tous_commisions_dumoisFiltre')->name('tous_commisions_dumoisFiltre');
Route::get('/tous_commisions_dumois_resFiltre', 'OpportuniteController@tous_commisions_dumois_resFiltre')->name('tous_commisions_dumois_resFiltre');
// responsable
Route::get('/rapport_prospects_res', 'ProspectionController@rapport_prospects_res');
Route::get('/commerciaux_maTeam_res', 'ProspectionController@commerciaux_maTeam_res'); 
Route::get('/insert_superieur', 'ProspectionController@insert_superieur'); 
Route::get('/insert_pays', 'Prospect_a_appellerController@insert_pays'); 
Route::get('/insert_paysop', 'OpportuniteController@insert_paysop'); 

Route::get('/edit/commercial/{id}', 'OpportuniteController@commerciaul_edit')->name('commerciaul.edit');
Route::post('/edits/commercial/{id}', 'OpportuniteController@commerciaul_update')->name('commerciaul.update');

Route::get('/edit/listcommercial_res/{id}', 'OpportuniteController@listcommerciaul_edit_res')->name('listcommercial_res.edit');
Route::post('/edits/listcommercial_res/{id}', 'OpportuniteController@listcommerciaul_update_res')->name('listcommercial_res.update');

Route::get('/ajout_objectif', 'OpportuniteController@ajout_objectif');
Route::post('/ajout_objectifs', 'OpportuniteController@store_objectif');

Route::get('/sup_com/{id}', 'CommerciauxController@sup_com_demande')->name('sup_com_demande');
Route::post('/sup_comm/{id}', 'CommerciauxController@sup_com_demande_store')->name('sup_com_demande_store');

Route::get('/sup_com_dg/{id}', 'CommerciauxController@sup_com_demande_dg')->name('sup_com_demande_dg');
Route::post('/sup_comm_dg/{id}', 'CommerciauxController@sup_com_demande_store_dg')->name('sup_com_demande_store_dg');

Route::get('/ajout_objectif_res', 'OpportuniteController@ajout_objectif_res');
Route::post('/ajout_objectifs_res', 'OpportuniteController@store_objectif_res');

Route::get('/objectif_ventes_res', 'ProspectionController@objectif_ventes_res'); 
Route::get('/prospect_maTeam_res', 'ProspectionController@prospect_maTeam_res'); 
Route::get('/onboarding_res', 'UserController@onboarding_res');
Route::get('/password_changer_res', 'UserController@password_changer_res');
// end res
Route::get('/pros_rapport/{id}', 'ProspectionController@pros_rapport_liste')->name('pros_rapport.lister');
Route::get('/pros_rapport_sannsOp/{id}', 'ProspectionController@pros_rapport_sannsOp_liste')->name('pros_rapport_sannsOp.lister');
Route::get('/prospect_maTeam', 'ProspectionController@prospect_maTeam'); 

Route::get('/action_stra', 'OpportuniteController@action_stra'); 

Route::get('/opportunite_maTeam', 'OpportuniteController@opportunite_maTeam');
Route::get('/opportunite_maTeam_res', 'OpportuniteController@opportunite_maTeam_res');
Route::get('/tous_les_pospects', 'ProspectionController@tous_les_pospects'); 
Route::get('/tous_les_pospects_stra', 'ProspectionController@tous_les_pospects_stra'); 
Route::get('/prospect_maTeamFiltre', 'ProspectionController@prospect_maTeamFiltre')->name('prospect_maTeamFiltre');
Route::get('/op_maTeamFiltre', 'OpportuniteController@op_maTeamFiltre')->name('op_maTeamFiltre');
Route::get('/tous_prospect_maTeamFiltre', 'ProspectionController@tous_prospect_maTeamFiltre')->name('tous_prospect_maTeamFiltre');
Route::get('/prospect_maTeamFiltreRes', 'ProspectionController@prospect_maTeamFiltreRes')->name('prospect_maTeamFiltreRes'); 
Route::get('/op_maTeamFiltreRes', 'OpportuniteController@op_maTeamFiltreRes')->name('op_maTeamFiltreRes'); 
Route::get('/appelOffre_Filtre', 'OpportuniteController@appelOffre_Filtre')->name('appelOffre_Filtre');

Route::get('/parametres', 'ProspectionController@parametres');
Route::get('/parametres_res', 'ProspectionController@parametres_res');
Route::get('/commerciaux_maTeam', 'ProspectionController@commerciaux_maTeam');

Route::get('/commerciaux_maTeamIndividuel', 'ProspectionController@commerciaux_maTeamIndividuel');
Route::get('/commerciaux_maTeamIndividuel_moi', 'ProspectionController@commerciaux_maTeamIndividuel_moi');
Route::get('/commerciaux_maTeamIndividuel_res', 'ProspectionController@commerciaux_maTeamIndividuel_res');
Route::get('/commerciaux_maTeamIndividuelFiltre', 'ProspectionController@commerciaux_maTeamIndividuelFiltre')->name('commerciaux_maTeamIndividuelFiltre');
Route::get('/commerciaux_maTeamIndividuel_resFiltre', 'ProspectionController@commerciaux_maTeamIndividuel_resFiltre')->name('commerciaux_maTeamIndividuel_resFiltre');

Route::get('/tous_les_commerciaux', 'ProspectionController@tous_les_commerciaux');
Route::get('/objectif_ventes', 'ProspectionController@objectif_ventes'); 
Route::get('/opportunite/prospect_maTeam/{id}', 'ProspectionController@opportunite_prospect_maTeam')->name('opportunite_prospect.maTeam');
Route::get('/opportunite_com/maTeam/{id}', 'ProspectionController@opportunite_com_maTeam')->name('opportunite_com.maTeam');
Route::get('/opportunite_comIndividuel/maTeam/{id}', 'ProspectionController@opportunite_comIndividuel_maTeam')->name('opportunite_comIndividuel.maTeam');
Route::get('/prospect_com/maTeam/{id}', 'ProspectionController@prospect_com_maTeam')->name('prospect_com.maTeam');
Route::get('/prospect_comIndivuduel/maTeam/{id}', 'ProspectionController@prospect_comIndivuduel_maTeam')->name('prospect_comIndivuduel.maTeam');
Route::get('/search_statut_maTam/{id}', 'ProspectionController@filtrer_opportunite_maTam')->name('search_statut_maTam');
Route::get('/search_statut_maTamIndividuel/{id}', 'ProspectionController@filtrer_opportuniteIndividuel_maTam')->name('search_statut_maTamIndividuel');
Route::get('/liste_contact_maTeam/{id}', 'OpportuniteController@liste_contact_maTeam')->name('liste_contact_maTeam');
Route::get('/top_commercial/{id}', 'ProspectionController@top_commercial')->name('top_commercial'); 

Route::get('/tous_liste_contacts', 'OpportuniteController@tous_liste_contacts')->name('tous_liste_contacts');

Route::get('/ajouter_contact', 'ProspectionController@ajouter_contact'); 
Route::post('/ajouter_contacts', 'ProspectionController@store_contact'); 

Route::get('/ajouter_entreprise_client', 'UserController@ajouter_entreprise_client'); 
Route::post('/ajouter_entreprise_clients', 'UserController@store_entreprise_client'); 

Route::get('/ajax/opportunites/{prospect}', 'ProspectionController@getOpportunitesByProspect');
Route::get('/ajout_prospection', 'ProspectionController@ajout_prospection'); 
Route::post('/ajout_prospections', 'ProspectionController@store_prospection');

// routes/web.php or routes/api.php
Route::get('/get-subcategories', 'ProspectionController@getSubcategories');

Route::get('/mon_plannings', 'ProspectionController@mon_plannings');
Route::get('/action_cettesemaines', 'ActionController@action_cettesemaine');
Route::get('/tous_mon_plannings', 'ProspectionController@tous_mon_plannings');
Route::get('/plannings', 'ProspectionController@plannings');
Route::get('/planningsMois', 'ProspectionController@planningsMois');
Route::get('/plannings_res', 'ProspectionController@plannings_res');
Route::get('/planningsFiltre', 'ProspectionController@planningsFiltre')->name('planningsFiltre');
Route::get('/planningsFiltreMois', 'ProspectionController@planningsFiltreMois')->name('planningsFiltreMois');
Route::get('/plannings_resFiltre', 'ProspectionController@plannings_resFiltre')->name('plannings_resFiltre');
Route::delete('/delete_mon_planning/{id}', 'ProspectionController@delete_mon_planning')->name('mon_planning.destroy');
Route::get('/mon_planning/edit/{id}', 'ProspectionController@edit_mon_planning')->name('mon_planning.edit');
Route::post('/mon_planning/edit/{id}', 'ProspectionController@update_mon_planning')->name('mon_planning.update');

Route::post('/clotuer/mon_planning/{id}', 'ProspectionController@cloturer_mon_planning')->name('mon_planning.cloturer');
Route::get('/cloturer_mon_planning_edit/{id}', 'ProspectionController@cloturer_mon_planning_edit')->name('cloturer_mon_planning_edit');

Route::get('/onboarding', 'UserController@onboarding');
Route::post('/alerter_passwordNot', 'UserController@alerter_passwordNot')->name('alerter_passwordNot');
Route::post('/alerter_passwordNot_res', 'UserController@alerter_passwordNot_res')->name('alerter_passwordNot_res');
Route::post('/connexion_helloventes', 'UserController@connexion_helloventes')->name('connexion_helloventes');

Route::get('/password_changer', 'UserController@password_changer');
Route::post('/sendmailalerter_password', 'UserController@sendmailalerter_password');

Route::get('/ajouter_entreprises', 'ProspectionController@create_entreprise'); 
// routes/web.php or routes/api.php
Route::get('/autocomplete', 'ProspectionController@autoComplete')->name('autocomplete');

Route::post('/ajouter_entreprises', 'ProspectionController@store_entreprise');
Route::get('/ajout_pros_op/{id}', 'ProspectionController@ajout_pros_op')->name('ajout_pros_op'); 
Route::get('/ajout_action_op/{id}', 'OpportuniteController@ajout_action_op')->name('ajout_action_op');
Route::get('/ajout_rv_op/{id}', 'OpportuniteController@ajout_rv_op')->name('ajout_rv_op');

Route::get('/tous_appel_offre', 'OpportuniteController@tous_appel_offre'); 

Route::get('/lister_entreprises', 'ProspectionController@lister_entreprise'); 
Route::get('/marcher_lister_entreprise', 'ProspectionController@marcher_lister_entreprise'); 

// routes/web.php or routes/api.php
Route::get('/live-search', 'ProspectionController@liveSearch');

Route::get('/MyprospectFiltre', 'ProspectionController@MyprospectFiltre')->name('MyprospectFiltre'); 
Route::get('/prospect_stra_filtre', 'ProspectionController@prospect_stra_filtre')->name('prospect_stra_filtre'); 
Route::get('/tous_prospect_stra_filtre', 'ProspectionController@tous_prospect_stra_filtre')->name('tous_prospect_stra_filtre'); 

Route::get('/opportunite/prospects/{id}', 'ProspectionController@opportunite_prospect_create')->name('opportunite_prospect.create');
Route::post('/opportunite/prospect/{id}', 'ProspectionController@opportunite_prospect_store')->name('opportunite_prospect.store');
Route::get('/opportunite/prospect_lister/{id}', 'ProspectionController@opportunite_prospect_lister')->name('opportunite_prospect.lister');
Route::get('/detail_prospects/{id}', 'ProspectionController@detail_prospect')->name('detail_prospect');
Route::get('/detail_op/{id}', 'OpportuniteController@detail_op')->name('detail_op');

Route::get('/profil/edit/{id}', 'UserController@profile_user')->name('profile_user.editer');
Route::post('/profil/edit/{id}', 'UserController@update_profile_user')->name('update_profile_user.update');

Route::get('/entreprise/edit/{id}', 'ProspectionController@edit_entreprise')->name('entreprise.edit');
Route::post('/entreprise/edit/{id}', 'ProspectionController@update_entreprise')->name('entreprise.update');
Route::delete('/delete_entreprise/{id}', 'ProspectionController@destroy_entreprise')->name('entreprise.destroy');
Route::delete('/delete_contact/{id}', 'ProspectionController@delete_contact')->name('delete_contact.destroy');
Route::delete('/delete_op/{id}', 'OpportuniteController@destroy_op')->name('op.destroy');
Route::delete('/delete_come/{id}', 'OpportuniteController@destroy_com')->name('com.destroy');

Route::get('ajouter_prospections', 'ProspectionController@create_prospections'); 
Route::post('ajouter_prospections', 'ProspectionController@store_prospections'); 
Route::get('/suivi_prospection', 'ProspectionController@lister_prospections'); 

Route::get('/profil_user/{profil_user}/edit', 'UserController@profil_user')->name('profile_user.editer');
Route::post('/update-password', 'UserController@updatePassword')->name('update.password');

Route::patch('/profil_user/{profil_user}', 'UserController@update_profil_user')->name('profil_user.update');
// Route::get('/profil_user_password/{profil_user}/edit', 'UserController@profil_user_password')->name('profil_user_password.editer');
// Route::patch('/profil_user_password/{profil_user}', 'UserController@update_profil_user_password')->name('profil_user_password.update');
Route::get('/profil_user/{profil_user}/edit', 'UserController@password_edit')->name('profil_user.editer');
Route::patch('/profil_user/{profil_user}', 'UserController@password_update')->name('profil_user.update');
});
//end suivi




Auth::routes();  

//Clear route cache:
 Route::get('/route-cache', function() {
     $exitCode = Artisan::call('route:cache');
     return 'Routes cache cleared';
 });
 
 Route::get('/view-clear', function() {
     $exitCode = Artisan::call('view:clear');
     return 'Routes cache cleared';
 });

 //Clear config cache:
 Route::get('/config-cache', function() {
     $exitCode = Artisan::call('config:cache');
     return 'Config cache cleared';
 }); 

// Clear application cache:
 Route::get('/clear-cache', function() {
     $exitCode = Artisan::call('cache:clear');
     return 'Application cache cleared';
 });

// Clear application cache:
 Route::get('/rappel_statut', function() {
     $exitCode = Artisan::call('RappelStatut:day');
     return 'Application cache cleared';
 });


Route::get('/perfo_semaine', function() {
     $exitCode = Artisan::call('performance:semaine');
     return 'Application cache cleared';
 });
 
 Route::get('/perfo_semaineSN', function() {
     $exitCode = Artisan::call('performanceSN:semaine');
     return 'Application cache cleared';
 });
 
 Route::get('/perfo_semaineBF', function() {
     $exitCode = Artisan::call('performanceBF:semaine');
     return 'Application cache cleared';
 });
 
 Route::get('/run_automatic', function() {
     $exitCode = Artisan::call('schedule:run');
     return 'Application cache cleared';
 });



 // Clear view cache:
  Route::get('/config-clear', function() {
     $exitCode = Artisan::call('config:clear');
     return 'Application cache cleared';
 });
 
  Route::get('/paginations', function() {
     $exitCode = Artisan::call('vendor:publish --tag=laravel-pagination');
     //return 'Application cache cleared';
 });
 
   Route::get('/performance_update', function() {
     $exitCode = Artisan::call('performance:update');
     return 'Performance insérée';
 });
 
 
   Route::get('/performance_ci', function() {
     $exitCode = Artisan::call('performanceCI:semaine');
     return 'Performance CI insérée';
 });
 
 
  Route::get('/moins_deuxday', function() {
     $exitCode = Artisan::call('Deux:Jours');
     return 'Mail envoye';
 });
 
  Route::get('/odatatest', function() {
     $exitCode = Artisan::call('odata:c');
     return 'ok';
 });
 
  Route::get('/key-generate', function() {
     $exitCode = Artisan::call('key:generate');
     return 'Application cache cleared';
 });
 
 Route::get('/recap', function() {
     $exitCode = Artisan::call('recap:day');
     return 'Application cache cleared';
 });

 Route::get('/test', 'TestController@test'); 
 Route::get('/odata', 'OdataController@lister');
 
 Route::get('send-mail-test', function () {
   
    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
   
    \Mail::to('fallou.g@illimitis.com')->send(new \App\Mail\MyTestMail($details));
   
    dd("Email is Sent.");
});



