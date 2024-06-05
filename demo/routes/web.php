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

Route::get('/sendEmailAgent', 'AgentController@sendEmailAgent');
Route::post('/sendmailrappel', 'AgentController@sendmailrappel');
Route::post('/sendmailrelancer', 'ProspectController@sendmailrelancer');

Route::get('download/rapport_reunion','DirectionController@download');

Route::get('/connexion', 'Version3Controller@login');  
Route::post('/connexion', 'Version3Controller@login');

Route::get('/inscription', 'UserController@inscription');
Route::post('/inscription', 'UserController@inscriptions')->name('inscription.register');

/*
Route::get('/install', function () {
    app()->make(\Illuminate\Support\Composer::class)->run(['require', 'barryvdh/laravel-dompdf']);
    dd('Component created');
});
*/

Route::get('/inscriptions_prospects', 'UserController@inscriptionP');
Route::post('/inscriptions_prospects','UserController@saveinscriptionP')->name('SaveInscriprionP');

Route::group(['middleware' => 'Connecter'], function(){
Route::post('/sendpassword', 'UserController@sendpassword')->name('sendpassword');
Route::post('/phase2', 'UserController@phase2')->name('phase2');

// Route::post('/sendpasswordclient', 'UserController@sendpasswordclient')->name('sendpassword.client');
// Route::post('/phase2client', 'UserController@phase2client')->name('phase2.client');

Route::get('/liste_sources', 'UserController@liste_sources');
Route::post('/activer/{id}', 'UserController@activer')->name('activer');
Route::post('/desactiver/{id}', 'UserController@desactiver')->name('desactiver');

Route::resource('actions', 'ActionController');
Route::resource('facilitateurs', 'FacilitateurController');
Route::resource('agents', 'AgentController');  
Route::resource('reunions', 'ReunionController');
Route::resource('decissions', 'DecissionController');
Route::resource('directions', 'DirectionController');
Route::resource('services', 'ServiceController'); 
Route::resource('themes', 'ThemeController');
Route::resource('suivi_actions', 'Suivi_actionController');
Route::resource('suivi_indicateurs', 'Suivi_indicateurController');
Route::resource('indicateurs', 'IndicateurController');
Route::resource('suivi_modules', 'Suivi_moduleController');
Route::resource('modules', 'ModuleController');
Route::resource('roles', 'RoleController');
Route::resource('formations', 'FormationController');
Route::resource('users', 'UserController');
Route::resource('annonces', 'AnnonceController');

Route::get('/ajout_source', 'FeedbackController@create_source');
Route::post('/ajout_source', 'FeedbackController@store_source');
Route::get('/liste_sourceF', 'FacilitateurController@liste_sourceF');
Route::get('/profil/edit/{id}', 'UserController@profile_user')->name('profile_user.editer');
Route::post('/profil/edit/{id}', 'UserController@update_profile_user')->name('update_profile_user.update');

// Modifier action avec projet ma team
Route::get('/action_ma_teamS{id}/edit', 'UserController@edit_action_ma_teamS')->name('action_ma_teamS.editer');
Route::patch('/action_user_dS/{id}', 'UserController@update_action_ma_teamS')->name('action_ma_teamS.update');
Route::get('/action_ma_teamM{id}/edit', 'UserController@edit_action_ma_teamM')->name('action_ma_teamM.editer');
Route::patch('/action_user_dM/{id}', 'UserController@update_action_ma_teamM')->name('action_ma_teamM.update');
Route::get('/action_ma_teamR{id}/edit', 'UserController@edit_action_ma_teamR')->name('action_ma_teamR.editer');
Route::patch('/action_user_dR/{id}', 'UserController@update_action_ma_teamR')->name('action_ma_teamR.update');

Route::get('/action_user/{action}/edit', 'UserController@edit_action')->name('action_user.editer');
Route::patch('/action_user/{action}', 'UserController@update_action')->name('action_user.update');
Route::get('/action_responsable/{action}/edit', 'UserController@edit_action_responsable')->name('action_responsable.editer');
Route::patch('/action_responsable/{action}', 'UserController@update_action_responsable')->name('action_responsable.update');
Route::get('/action_user_d/{action}/edit', 'UserController@edit_action_d')->name('action_user_d.editer');
Route::patch('/action_user_d/{action}', 'UserController@update_action_d')->name('action_user_d.update');

Route::get('/action_user_toute/{action}/edit', 'UserController@edit_action_toute')->name('action_user_toute.editer');
Route::patch('/action_user_toute/{action}', 'UserController@update_action_toute')->name('action_user_toute.update');
Route::get('/action_user_retard/{action}/edit', 'UserController@edit_action_retard')->name('action_user_retard.editer');
Route::patch('/action_user_retard/{action}', 'UserController@update_action_retard')->name('action_user_retard.update');
Route::get('/action_user_mois/{action}/edit', 'UserController@edit_action_mois')->name('action_user_mois.editer');
Route::patch('/action_user_mois/{action}', 'UserController@update_action_mois')->name('action_user_mois.update');

Route::get('/action_user_a/{action}/edit', 'UserController@edit_action_user')->name('action_user_a.editer');
Route::patch('/action_user_a/{action}', 'UserController@update_action_user')->name('action_user_a.update');
Route::get('/action_responsable_a/{action}/edit', 'UserController@edit_action_responsab')->name('action_responsable_a.editer');
Route::patch('/action_responsable_a/{action}', 'UserController@update_action_responsab')->name('action_responsable_a.update');
Route::get('/admin/banSuivi', 'UserController@banSuivi');

Route::get('/competences_a_developper', 'ProspectController@competences_a_developper');
Route::post('/competences_a_developper/{id}', 'ProspectController@competences_a_developper_store')->name('competences.a_developper');
Route::post('/competences_a_developperSouhait/{id}', 'ProspectController@competences_a_developper_storeSouhait')->name('competences.a_developperSouhait');
Route::get('/dev_dans_cinq', 'ProspectController@dev_dans_cinq');
Route::get('/voir/suivi', 'ProspectController@voir_suivi');

Route::post('/save-chart-image', 'FacilitateurController@saveImage');
Route::get('generate-pdf/{id}', 'FacilitateurController@generatePDF')->name('generate.pdf');
// Route pour sauvegarder l'image
Route::get('generatepdf', 'FacilitateurController@downloadPDF');


Route::get('generate-pdfUser', 'FeedbackController@pdfUser')->name('pdfUser.pdf');
Route::get('/search_participant', 'UserController@search_participant');


Route::get('/action_user_fresponsable/{action}/edit', 'UserController@edit_action_fresponsable')->name('action_user_fresponsable.editer');
Route::patch('/action_user_fresponsable/{action}', 'UserController@update_action_fresponsable')->name('action_user_fresponsable.update');

Route::get('/action_user_futilisateur/{action}/edit', 'UserController@edit_action_futilisateur')->name('action_user_futilisateur.editer');
Route::patch('/action_user_futilisateur/{action}', 'UserController@update_action_futilisateur')->name('action_user_futilisateur.update');

Route::get('/action_user_fdirecteur/{action}/edit', 'UserController@edit_action_fdirecteur')->name('action_user_fdirecteur.editer');
Route::patch('/action_user_fdirecteur/{action}', 'UserController@update_action_fdirecteur')->name('action_user_fdirecteur.update');

Route::get('/action_user_frapporteur/{action}/edit', 'UserController@edit_action_frapporteur')->name('action_user_frapporteur.editer');
Route::patch('/action_user_frapporteur/{action}', 'UserController@update_action_frapporteur')->name('action_user_frapporteur.update');

Route::get('/profil_user/{profil_user}/edit', 'UserController@profil_user')->name('profil_user.editer');
Route::patch('/profil_user/{profil_user}', 'UserController@update_profil_user')->name('profil_user.update');

Route::get('/profil_user_facilitateur/{profil_user}/edit', 'UserController@profil_facilitateur')->name('profil_facilitateur.editer');
Route::patch('/profil_user_facilitateur/{profil_user}', 'UserController@update_profil_facilitateur')->name('profil_facilitateur.update');

Route::get('/detail/{id}/facilitateur', 'FacilitateurController@detail_facilitateur')->name('detail_facilitateur.voir');

Route::get('/liste_pays', 'FacilitateurController@liste_pays');

Route::get('/profil_rap/{profil_rap}/edit', 'UserController@profil_rap')->name('profil_rap.editer');
Route::patch('/profil_rap/{profil_rap}', 'UserController@update_profil_rap')->name('profil_rap.update');

Route::get('/profil_responsable/{profil_responsable}/edit', 'UserController@profil_responsable')->name('profil_responsable.editer');
Route::patch('/profil_responsable/{profil_responsable}', 'UserController@update_profil_responsable')->name('profil_responsable.update');

Route::get('/profil_dg/{profil_dg}/edit', 'UserController@profil_dg')->name('profil_dg.editer');
Route::patch('/profil_dg/{profil_dg}', 'UserController@update_profil_dg')->name('profil_dg.update');

Route::get('/action_responsable_reasigner/{action}/edit', 'UserController@edit_action_responsabreasigner')->name('action_responsable_reasigner.editer');
Route::patch('/action_responsable_reasigner/{action}', 'UserController@update_action_responsabreasigner')->name('action_responsable_reasigner.update');

Route::get('/action_rap_reasigner/{action}/edit', 'UserController@edit_action_rapreasigner')->name('action_rap_reasigner.editer');
Route::patch('/action_rap_reasigner/{action}', 'UserController@update_action_rapreasigner')->name('action_rap_reasigner.update');

Route::get('/action_dg_reasigner/{action}/edit', 'UserController@edit_action_dgreasigner')->name('action_dg_reasigner.editer');
Route::patch('/action_dg_reasigner/{action}', 'UserController@update_action_dgreasigner')->name('action_dg_reasigner.update');

Route::get('/action_responsable_asigner/{action}/edit', 'UserController@edit_action_responsabasigner')->name('action_responsable_asigner.editer');
Route::patch('/action_responsable_asigner/{action}', 'UserController@update_action_responsabasigner')->name('action_responsable_asigner.update');

Route::get('/action_rap_asigner/{action}/edit', 'UserController@edit_action_rapasigner')->name('action_rap_asigner.editer');
Route::patch('/action_rap_asigner/{action}', 'UserController@update_action_rapasigner')->name('action_rap_asigner.update');

Route::get('/action_dg_asigner/{action}/edit', 'UserController@edit_action_dgasigner')->name('action_dg_asigner.editer');
Route::patch('/action_dg_asigner/{action}', 'UserController@update_action_dgasigner')->name('action_dg_asigner.update');

Route::get('/dashboardDirecteur', function () {
    return view('v2.dashboard');
});

Route::get('/dashboardResponsable', function () {
    return view('v2.res_dash');
});

Route::get('/dashboard/facilitateur', 'FacilitateurController@dashboard_facilitateur');
Route::get('/admin/dashboard', 'UserController@dashboard');
Route::get('/admin/dashboard/user', 'UserController@dashboard_user');
Route::get('/admin/dashboard/directeur', 'UserController@dashboard_directeur');
Route::get('/admin/dashboard/rapporteur', 'UserController@dashboard_rapporteur');
Route::get('/admin/dashboard/responsable', 'UserController@dashboard_responsable');
Route::get('/admin/dashboard/tech', 'UserController@tech');
Route::get('/admin/dashboard/marketing', 'UserController@marketing');
Route::get('/admin/dashboard/assistant', 'UserController@assistant');
Route::get('/admin/dashboard/secretaire', 'UserController@secretaire');
Route::post('/save_action', 'UserController@save_action');
Route::get('/voir_history/{id}', 'UserController@history')->name('history.voir');
Route::get('/voir_history_responsable/{id}', 'UserController@history_responsable')->name('history_responsable.voir');

Route::get('/voir_history_d/{id}', 'UserController@history_d')->name('history_d.voir');
Route::post('/save_action_d', 'UserController@save_action_d');
Route::get('/voir_direction/{id}', 'UserController@direction')->name('direction.voir');
Route::get('/voir_agent/{id}', 'UserController@agent')->name('agent.voir');
Route::get('/voir_user_agent/{id}', 'UserController@user_agent')->name('user_agent.voir');
Route::get('/voir_responsable_agent/{id}', 'UserController@responsable_agent')->name('responsable_agent.voir');

Route::get('/voir_user_agent_rap/{id}', 'UserController@user_agent_rap')->name('user_agent_rap.voir');
Route::get('/voir_history_r/{id}', 'UserController@history_r')->name('history_r.voir');
Route::post('/save_action_r', 'UserController@save_action_r');
Route::post('/save_action_responsable', 'UserController@save_action_responsable');
Route::get('/action_user_r/{action}/edit', 'UserController@edit_action_r')->name('action_user_r.editer');;
Route::patch('/action_user_r/{action}', 'UserController@update_action_r')->name('action_user_r.update');
Route::get('/action_user_rap/{action}/edit', 'UserController@edit_action_rap')->name('action_user_rap.editer');;
Route::patch('/action_user_rap/{action}', 'UserController@update_action_rap')->name('action_user_rap.update');
Route::get('/user_action_r', 'UserController@user_action_r');
Route::get('/user_actionA_r', 'UserController@user_actionA_r');
Route::get('/user_annonce_r', 'UserController@user_annonce_r');
Route::get('/ajout_annonce_r', 'UserController@ajout_annonce_r');
Route::post('/ajout_annonce_r', 'UserController@ajout_annonceA_r')->name('ajout.annonce_r');

Route::get('/user_annonce_res', 'UserController@user_annonce_res');
Route::get('/user_annonce_user', 'UserController@user_annonce_user');

Route::get('/user_reunion', 'UserController@user_reunion');
Route::get('/user_action', 'UserController@user_action');
Route::get('/user_action_semaine', 'Version3Controller@user_action_semaine');
Route::get('/user_action_mois', 'UserController@user_action_mois');
Route::get('/user_toute_action', 'UserController@user_toute_action');
Route::get('/action_mateam_semaine', 'UserController@action_mateam_semaine');
Route::get('/action_mateam', 'UserController@action_mateam');
Route::get('/action_retard_mateam', 'UserController@action_retard_mateam');
Route::get('/historique_performance', 'UserController@historique_performance');
Route::get('/historique_performance_mateam', 'UserController@historique_performance_mateam');


Route::get('/user_actionA', 'UserController@user_actionA');

Route::get('/responsable_reunion', 'UserController@responsable_reunion')->name('ajout.reunion');
Route::get('/responsable_action', 'UserController@responsable_action');
Route::get('/responsable_actionA', 'UserController@responsable_actionA');

Route::get('/user_reunion_dg', 'UserController@user_reunion_dg');
Route::get('/user_action_dg', 'UserController@user_action_dg');
Route::get('/user_actionA_dg', 'UserController@user_actionA_dg');
Route::get('/user_annonce', 'UserController@user_annonce');

Route::get('/ajout_annonce', 'UserController@ajout_annonce');
Route::post('/ajout_annonce', 'UserController@ajout_annonceA')->name('ajout.annonce');

Route::get('/donner_feed_restant/{id}', 'FeedbackController@donner_feed_restant')->name('donner_feed_restant');
Route::get('/agent_feed_restant', 'FeedbackController@agent_feed_restant');

Route::get('/search_a', 'UserController@my_filter');
Route::get('/search', 'ActionController@filter');
Route::get('/searchf/{id}', 'FeedbackController@filtrer_feedback')->name('searchfeedback');
Route::get('/searchfstatut', 'UserController@statut_agents_byfeeding_filtrer')->name('statutagents_byfeeding.filtrer');
Route::get('/searchfclient', 'ProspectController@filtrer_utilisateur_client')->name('searchparclient');
Route::get('/searchf_participant/{id}', 'FacilitateurController@filtrer_utilisateur_participant')->name('searchpar_participant');
Route::get('/searchaction_prosE', 'ProspectController@filtre_actions_prosE');
Route::get('/action_cloture', 'ActionController@action_cloture');
Route::get('/action_assignee', 'ActionController@action_assignee');
Route::get('/search_ag', 'AgentController@filter_ag');
Route::get('/action_direct/{id}', 'ActionController@showDirection')->name('direction.vue');   

Route::get('/ajout_action_dg', 'ActionController@ajout_action_dg');
Route::post('/ajout_action_dg', 'ActionController@ajout_actionDG')->name('ajout.action_dg');
Route::get('/voir_action_dg', 'ActionController@voir_action_dg');
Route::get('/search_action', 'ActionController@filter_action_dg');
Route::get('/filter_action', 'UserController@filter_action');

Route::get('/contact', 'MailController@contact');
Route::get('/contact', 'MailManuController@contact');

Route::post('send/email', 'MailController@sendemail')->name('contact.store');
Route::post('send/emails', 'MailManuController@sendemail')->name('contactm.store');

Route::get('/responsable_actionAcloture', 'UserController@responsable_actionAcloture');
Route::get('/rapporteur_actionAcloture', 'UserController@rapporteur_actionAcloture');
Route::get('/directeur_actionAcloture', 'UserController@directeur_actionAcloture');

Route::get('/ajout_action_asigne', 'ActionController@ajout_action_asigneRES');
Route::post('/ajout_action_asigne', 'ActionController@ajout_actionAsigneRES')->name('ajout.action_asigneRES');

Route::get('/ajout_action_asigneR', 'ActionController@ajout_action_asigneRAP');
Route::post('/ajout_action_asigneR', 'ActionController@ajout_actionAsigneRAP')->name('ajout.action_asigneRAP');

Route::get('/ajout_action_asignerespon', 'ActionController@ajout_action_asignerespon');
Route::post('/ajout_action_asignerespon', 'ActionController@ajout_actionAsignerespon')->name('ajout.action_asignerespon');

Route::get('/ajout_action_asigneresponR', 'ActionController@ajout_action_asigneresponRAP');
Route::post('/ajout_action_asigneresponR', 'ActionController@ajout_actionAsigneresponRAP')->name('ajout.action_asigneresponRAP');

Route::get('/ajout_action_user_moi', 'ActionController@ajout_action_user_moi');
Route::post('/ajout_action_user_moi', 'ActionController@ajout_actionAuser_moi')->name('ajout.action_user_moi');

Route::get('/ajout_action_rap_moi', 'ActionController@ajout_action_rap_moi');
Route::post('/ajout_action_rap_moi', 'ActionController@ajout_actionArap_moi')->name('ajout.action_rap_moi');

Route::get('/ajout_action_responsable_moi', 'ActionController@ajout_action_responsable_moi');
Route::post('/ajout_action_responsable_moi', 'ActionController@ajout_actionAresponsable_moi')->name('ajout.action_responsable_moi');

Route::get('/ajout_action_dg_moi', 'ActionController@ajout_action_dg_moi');
Route::post('/ajout_action_dg_moi', 'ActionController@ajout_actionAdg_moi')->name('ajout.action_dg_moi');

Route::post('/cloture/{id}', 'UserController@status_cloture')->name('visibilite.cloture');
Route::post('/clotures/{id}', 'UserController@status_cloture1')->name('visibilite1.cloture');
Route::post('/valider/{id}', 'UserController@status_valider')->name('visibilite.valider');
Route::post('/refuser/{id}', 'UserController@status_refuser')->name('visibilite.refuser');
Route::post('/activer_source/{id}', 'FacilitateurController@activer_source')->name('activer.source');
Route::post('/desactiver_source/{id}', 'FacilitateurController@desactiver_source')->name('desactiver.source');

Route::post('/info/{id}', 'UserController@info')->name('info.valider');
Route::post('/passwords/{id}', 'UserController@passwords')->name('passwords.valider');
Route::post('/image/{id}', 'UserController@image')->name('image.valider');


Route::get('/res_reunion/{reunion}/edit', 'ReunionController@edit_res_reunion')->name('res_reunion.editer');
Route::patch('/res_reunion/{reunion}', 'ReunionController@update_res_reunion')->name('res_reunion.update');
Route::DELETE('res_reunion/{res_reunion}', 'ReunionController@res_supprimer')->name('res_reunion.destroy');

Route::get('/dg_reunion/{reunion}/edit', 'ReunionController@edit_dg_reunion')->name('dg_reunion.editer');
Route::patch('/dg_reunion/{reunion}', 'ReunionController@update_dg_reunion')->name('dg_reunion.update');
Route::DELETE('dg_reunion/{dg_reunion}', 'ReunionController@dg_supprimer')->name('dg_reunion.destroy');

Route::get('/res_annonce/{annonce}/edit', 'AnnonceController@edit_res_annonce')->name('res_annonce.editer');
Route::patch('/res_annonce/{annonce}', 'AnnonceController@update_res_annonce')->name('res_annonce.update');
Route::DELETE('res_annonce/{dg_annonce}', 'AnnonceController@res_supprimer')->name('res_annonce.destroy');

Route::get('/dg_annonce/{annonce}/edit', 'AnnonceController@edit_dg_annonce')->name('dg_annonce.editer');
Route::patch('/dg_annonce/{annonce}', 'AnnonceController@update_dg_annonce')->name('dg_annonce.update');
Route::DELETE('dg_annonce/{dg_annonce}', 'AnnonceController@dg_supprimer')->name('dg_annonce.destroy');

Route::get('/qui_est_en_ligne', 'UserController@statut_agents');
Route::get('/derniers_updates', 'UserController@derniers_updates');

Route::get('/qui_est_en_ligne_byfeeding', 'UserController@statut_agents_byfeeding');

Route::get('/administrateur', function () {
    return view('dashboard.index');
});

// version 3
Route::resource('activites', 'ActiviteController');
Route::resource('strategiques', 'StrategiqueController');
Route::resource('taches', 'TacheController');

Route::get('/v3/admin/dashboard', 'Version3Controller@dashboard');
Route::get('/mesperformances', 'Version3Controller@mesperformances');
Route::get('/performance_de_ma_team', 'Version3Controller@teamperformance');
Route::get('/search_ech/', 'Version3Controller@filter')->name('search_ech');
Route::post('/fait/{id}', 'Version3Controller@fait')->name('fait');
Route::post('/pasfait/{id}', 'Version3Controller@pasfait')->name('pasfait');
Route::get('/taches_dg', function () {
    
    $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
    return view('v3.taches_dg', compact('headers'));
    


});


//modifier action avec projet
Route::get('/actionprojet/{action}/edit', 'ProjetController@edit_action_projet')->name('action_projet.edit');
Route::patch('/actionprojet/{action}', 'ProjetController@update_action_projet')->name('action_projet.update');
Route::get('/actionprojetd/{action}/edit', 'ProjetController@edit_action_projet_dash')->name('action_projet_dash.edit');
Route::patch('/actionprojetd/{action}', 'ProjetController@update_action_projet_dash')->name('action_projet_dash.update');
Route::get('/actionprojetm/{action}/edit', 'ProjetController@edit_action_projet_mois')->name('action_projet_mois.edit');
Route::patch('/actionprojetm/{action}', 'ProjetController@update_action_projet_mois')->name('action_projet_mois.update');
Route::get('/actionuserproj/{id}/edit', 'ProjetController@edit_action_proj')->name('action_proj.edit');
Route::patch('/actionuserproj/{id}', 'ProjetController@update_action_proj')->name('action_proj.update');

//modifier action
Route::get('/actionuser/{id}/edit', 'ActionController@edit_action_user2')->name('action_user2.edit');
Route::patch('/actionuser/{id}', 'ActionController@update_action_user2')->name('action_user2.update');
Route::get('/actionuser_assignee/{id}/edit', 'ActionController@edit_action_assignee')->name('action_assignee.edit');
Route::patch('/actionuser_assignee/{id}', 'ActionController@update_action_assignee')->name('action_assignee.update');

//Feedback
Route::get('/envoimail', 'FeedbackController@envoimail');

Route::get('/feedback_parsource', 'FeedbackController@listfeedback_par_source');
Route::get('/feedback_parsource/{id}', 'FeedbackController@listfeedback_par_sourceA')->name('listfeedback_par_sourceA');
Route::get('/feedbackliste/{id}', 'FeedbackController@voir_listfeedback')->name('voir.feedback_source');
Route::get('/feedbackliste_groupe/{id}', 'FeedbackController@voir_listfeedback_groupe')->name('voir.voir_listfeedback_groupe');
Route::get('/feedbackliste/download/{id}', 'FeedbackController@telecharger_listfeedback')->name('telecharger.feedback_source');
Route::get('/feedbacklistePDF/downloadPDF/{id}', 'FeedbackController@telecharger_listfeedbackPDF')->name('telechargerPDF.feedback_sourcePDF');
Route::get('/feedbackliste_groupe/download/{id}', 'FeedbackController@telecharger_listfeedback_groupe')->name('telecharger.feedback_source_groupe');

Route::get('/agentsdownload', 'FeedbackController@agentsdownload')->name('agentsdownload');

Route::get('/feedback/donner', 'FeedbackController@feedbackDonner');
Route::post('/feedback/donner', 'FeedbackController@feedbackDonner_store');
Route::get('/lister/feedback/recu', 'FeedbackController@ListeFeedbackRecu');
Route::get('/feedbackrecu/{id}', 'FeedbackController@feedbackRecu')->name('voir.feedbacks');
Route::get('/appreciation/donner', 'FeedbackController@appreciationDonner');
Route::post('/appreciations/donner', 'FeedbackController@appreciationDonner_store');
Route::get('/appreciation/recu/{id}', 'FeedbackController@appreciationRecus')->name('voir.appreciations');
Route::get('/liste/appreciation/recu', 'FeedbackController@ListerAppreciationRecu');
Route::get('/appreciation/demander', 'FeedbackController@appreciationDemander');
Route::post('/appreciation/demander', 'FeedbackController@appreciationDemander_store');
Route::get('/feedback/recu/{id}', 'FeedbackController@feedbackRecu1')->name('voir.reponse');
Route::get('/feedback/rapport', 'FeedbackController@feedbackRapport');
Route::get('/diagramme_circulaire', 'FacilitateurController@diagramme_circulaire');
Route::get('/feedback/notation', 'FeedbackController@feedbackNotation');
//Route::get('/liste/feedback', 'FeedbackController@feedbackLister');
Route::get('/liste/feedback/recu', 'FeedbackController@ListerFeedbackRecu');
Route::get('/liste/appreciation/donner', 'FeedbackController@ListerAppreciationDonner');
Route::get('/suivi/byfeeding', 'FeedbackController@feedbackSuivi');
Route::post('/suivi/byfeeding', 'FeedbackController@feedbackSuivi_store');


//prospect feedback

Route::get('/feedback/demander', 'FeedbackController@feedbackDemander');
Route::post('/feedback/demander', 'FeedbackController@feedbackDemander_store');
Route::get('/liste/feedback/donner', 'FeedbackController@ListeFeedbackDonner');
Route::get('/feedback/donne/{id}', 'FeedbackController@donnerFeedback')->name('repondre.feedback');
Route::post('/feedback/donne/{id}', 'FeedbackController@donnerFeedback_store')->name('rep.feedback');
Route::get('/liste/feedback/recus', 'FeedbackController@ListeProspectFeedbackRecu');
Route::get('/feedback/recus/{id}', 'FeedbackController@prospectFeedbackRecu')->name('voir.feedback');

Route::get('/apprecier/demanders', 'FeedbackController@apprecierDemander');
Route::post('/apprecier/demanders', 'FeedbackController@apprecierDemander_store');
Route::get('/liste/apprecier/donner', 'FeedbackController@ListeapprecierDonner');
Route::get('/apprecier/donners/{id}', 'FeedbackController@apprecierDonners')->name('repondre.apprecier');
Route::post('/apprecier/donner/{id}', 'FeedbackController@apprecierDonner_store')->name('apprecier.Donner_store');
Route::get('/liste/apprecier/recu', 'FeedbackController@ListeapprecierRecu');
Route::get('/apprecier/recus/{id}', 'FeedbackController@ListeProspectapprecierRecu')->name('voir.apprecier');

Route::get('/action_pros/{action}/edit', 'ProspectController@edit_action_pros')->name('action_pros.editer');
Route::patch('/action_pros/{action}', 'ProspectController@update_action_pros')->name('action_pros.update');

// ajouter agent entreprise feedback
Route::get('/ajouter_agents', 'ProspectController@ajout_agent');
Route::post('/ajouter_agents', 'ProspectController@ajout_agent_store');

Route::get('/ajout_agents', 'FacilitateurController@ajout_agentFa');
Route::post('/ajout_agents', 'FacilitateurController@ajout_agentFa');
// enregistrer des actions
Route::get('/enregistrer_actions', 'ProspectController@enregistrer_actions');
Route::get('/voir_agents_assistance', 'ProspectController@voir_agents_assistance');
Route::get('/liste_utilisateurs', 'ProspectController@liste_utilisateurs');

Route::get('/liste_actions_utilisateurs/{id}', 'ProspectController@liste_actions_utilisateurs')->name('liste_actions.users');
Route::get('/liste_actions_agent/{id}', 'ProspectController@liste_actions_agent')->name('liste_actions_agent.users');
Route::get('/liste_actions_utilisateursA/{id}', 'ProspectController@liste_actions_utilisateursA')->name('liste_actionsA.users');
Route::get('/action_agent/{id}', 'ProspectController@action_agent')->name('action_agent.lister');
Route::get('/utilisateurs/{id}/edit', 'ProspectController@edit_utilisateurs')->name('utilisateurs.editer');
Route::patch('/utilisateurs/{id}', 'ProspectController@update_utilisateurs')->name('utilisateurs.update');
Route::get('/utilisateursenligne/{id}/edit', 'ProspectController@edit_utilisateurs_enligne')->name('utilisateursenligne.editer');
Route::patch('/utilisateursenligne/{id}', 'ProspectController@update_utilisateurs_enligne')->name('utilisateursenligne.update');

Route::DELETE('utilisateursdelete/{id}', 'ProspectController@utilisateurs_delete')->name('utilisateurs.destroy');
Route::post('/enregistrer_actions', 'ProspectController@enregistrer_actions_store');
Route::get('/enregistrer_actions_pros', 'ProspectController@enregistrer_actions_pros');
Route::post('/enregistrer_actions_pros', 'ProspectController@enregistrer_actions_store_pros');
Route::get('/voir_lesentreprises', 'ProspectController@voir_lesentreprises');
Route::get('/voir_lerapport/{id}', 'ProspectController@voir_lerapport_globale')->name('rapport_entreprise.globale');
Route::get('/voir_rapport_client/{id}', 'FacilitateurController@voir_rapport_client')->name('rapport_client.facilitateur');
Route::get('/voir_client/{id}', 'FacilitateurController@voir_client')->name('voir_client.facilitateur');
Route::get('/voir_detail_client/{id}', 'FacilitateurController@voir_detail_client')->name('voir_detail_client.facilitateur');
Route::get('/diagramme_circulaires/{id}', 'FacilitateurController@diagramme_circulaires')->name('diagramme_circulaire.facilitateur');
Route::get('/rapport_globale_responsable', 'FacilitateurController@rapport_globale_responsable');

Route::get('/ajouter_entreprise', 'FacilitateurController@create_entreprise');
Route::post('/ajouter_entreprise', 'FacilitateurController@store_entreprise');
Route::get('/ajouter_clients', 'FacilitateurController@create_client');
Route::post('/ajouter_clients', 'FacilitateurController@store_client');
Route::get('/ajouter_clientsFa', 'FacilitateurController@create_clientFa');
Route::post('/ajouter_clientsFa', 'FacilitateurController@store_clientFa');

Route::get('/lister_clients', 'FacilitateurController@lister_clients');
Route::get('/lister_clients_facilitateur', 'FacilitateurController@lister_clients_facilitateur');
Route::get('/liste_utilisateurs_client/{id}', 'FacilitateurController@liste_utilisateurs_client')->name('voir.liste_utilisateurs_client');
Route::get('/lister_entreprise_facilitateur', 'FacilitateurController@lister_entreprise_facilitateur');
Route::get('/clientFacilitateur/{id}/edit', 'FacilitateurController@edit_clientFacilitateur')->name('clientFacilitateur.edit');
Route::patch('/clientFacilitateur/{id}', 'FacilitateurController@update_clientFacilitateur')->name('clientFacilitateur.update');
Route::DELETE('clientFacilitateurs/{id}', 'FacilitateurController@destroy_clientFacilitateur')->name('clientFacilitateur.destroy');

Route::get('/actionprospectE/{id}/edit', 'ProspectController@edit_action_prospectE')->name('action__prospectE.edit');
Route::patch('/actionprospectE/{id}', 'ProspectController@update_action_prospectE')->name('action__prospectE.update');

Route::get('/assistances', 'ProspectController@besoin_assistances');
Route::get('/liste_actions', 'ProspectController@lister_actions');  

Route::get('/action_suivi/{id}/edit', 'ProspectController@edit_action_suivi')->name('action_suivi.editer');
Route::patch('/action_suivi/{id}', 'ProspectController@update_action_suivi')->name('action_suivi.update');

Route::post('/assistancesOui/{id}', 'ProspectController@besoin_assistances_storeOui')->name('assistances.oui');
Route::post('/assistancesNon/{id}', 'ProspectController@besoin_assistances_storeNon')->name('assistances.non');

Route::get('/dashboard/feedback', 'UserController@dashboardP');
Route::get('/dashboard/Prospect', 'UserController@dashboardProspect');
Route::post('/initialiser_feedback/{id}', 'FacilitateurController@initialiser_feedback')->name('initialiser.feedback');
Route::post('/cloturer_feedback/{id}', 'FacilitateurController@cloturer_feedback')->name('cloturer.feedback');
//Connexion prospect


// Route::post('/inscription_prospect', 'UserController@connexions');
// Route::get('/inscriptions_prospect', 'UserController@inscriptio');
// Route::post('/inscriptions_prospect','UserController@saveinscription')->name('SaveInscriprion');
// Route::get('/feedback/prospect', 'UserController@prosp');

// Route::get('/ajout_source', 'FeedbackController@create_source');
// Route::post('/ajout_source', 'FeedbackController@store_source');
//end prospect






Route::get('/dg_asktocreate', function () {
    return view('activite/v2.dg_asktocreate');
});

Route::get('/dg_list_modeles', function () {
    return view('activite/v2.dg_list_modeles');
});

Route::get('/create_dg', 'ActiviteController@create_dg');
Route::post('/store_dg', 'ActiviteController@store_dg')->name('activite.store_dg');

// PROJET
Route::get('/create_projet','ProjetController@create_projet');
Route::post('/create_projet','ProjetController@store_projet')->name('create.projet');
Route::get('/action_projet','ProjetController@action_projet');

Route::get('/create_projet_action','ProjetController@create_projet_action');
Route::post('/create_projet_action','ProjetController@store_projet_action')->name('create.projet_action');

Route::get('/mes_projets','ProjetController@lister_mes_projets');
Route::get('/mes_projets/{projet}/edit', 'ProjetController@edit_projet')->name('monprojet.editer');
Route::patch('/mes_projets/{projet}', 'ProjetController@update_projet')->name('monprojet.update');
Route::get('/les_bakup/{id}', 'ProjetController@lesbakup')->name('lesbakup.projet');
Route::get('/tous_projets','ProjetController@lister_tous_projets');
Route::get('/projets_ma_team','ProjetController@projets_ma_team');
Route::get('/mes_projets_user','ProjetController@mes_projets_user');
Route::post('/cloturer/{id}', 'ProjetController@status_cloturer')->name('visibiliter.cloturer');
Route::post('/clotureractionprojet/{id}', 'ProjetController@action_projet_cloturer')->name('visibiliteraction.cloturer');

Route::get('/modeles_activites', 'ActiviteController@modeles_activites');
Route::get('/categorie/{categorie}/edit', 'ActiviteController@edit_cat')->name('edit_categorie');
Route::patch('/update_categorie/{categorie}', 'ActiviteController@update_cat')->name('update_categorie');
Route::DELETE('destroy_cat/{categorie}', 'ActiviteController@destroy_cat')->name('destroy_cat');
Route::get('/modele/{modele}/edit', 'ActiviteController@modele_ajout')->name('ajout_modele');
Route::post('/add_modele', 'ActiviteController@modele_add')->name('add_modele');
Route::get('/modeles_live', 'Version3Controller@modeles_live');
Route::get('/search_echm/', 'Version3Controller@filterm')->name('search_echm');
Route::post('/faitm/{id}', 'Version3Controller@faitm')->name('faitm');
Route::post('/pasfaitm/{id}', 'Version3Controller@pasfaitm')->name('pasfaitm');
Route::post('/archiver/{id}', 'Version3Controller@archiver')->name('archiver');
Route::get('/ajout_cat', 'ActiviteController@ajout_cat');
Route::post('/add_cat', 'ActiviteController@add_cat')->name('add_cat');
Route::get('/all_activites', 'ActiviteController@all_activites');
Route::get('/search_dirac', 'ActiviteController@all_activites_filter');
Route::get('/voir_activite/{id}', 'ActiviteController@voir_activite')->name('voir_activite');
Route::get('/voir_modele/{id}', 'ActiviteController@voir_modele')->name('voir_modele');
Route::get('/strategiques', 'ActiviteController@strategiques');
Route::get('/activites_instance', 'Version3Controller@activites_instance');
Route::get('/activites_autre', 'Version3Controller@activites_autre');
Route::get('/activiter/{activiter}/edit', 'ActiviteController@active_edi')->name('active.modifier');
Route::patch('/activiter_update/{activiter}', 'ActiviteController@active_up')->name('active_update');

Route::get('preview', 'FacilitateurController@preview');
Route::get('downloadF', 'FacilitateurController@downloadF')->name('downloadF');

});

Route::get('/todolist', 'ListeController@todo');
Route::post('/todolist', 'ListeController@todolist')->name('todo.list');
Route::DELETE('/destroytache/{id}', 'ListeController@destroy')->name('liste.destroy');
Route::DELETE('/destroyactivite/{id}', 'ActiviteController@destroyac')->name('activite.destroyac');

Route::POST('/destroyactiviteta/{id}', 'ActiviteController@destroyta')->name('activite.destroyta');

Route::get('/activites_team', function () {
    
    $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
    return view('v3.activites_dg', compact('headers'));
});

Route::get('/todo-list_dg', function () {
    
    $headers = DB::table('agents')->select('agents.prenom', 'agents.nom','directions.nom_direction')
        ->where('user_id', Auth::user()->id)
        ->join('directions', 'directions.id', 'agents.direction_id')
        ->paginate(1);
    return view('v3.todo-list_dg', compact('headers'));
});
//Auth::routes();  

Route::get('/home', 'HomeController@index')->name('home');

//Connexion prospect

Route::post('/inscription', 'UserController@connexions');
Route::get('/inscriptions', 'UserController@inscriptio');
Route::post('/inscriptions','UserController@saveinscription')->name('SaveInscriprion');
Route::get('/feedback/prospect', 'UserController@prosp');



//Clear route cache:
 Route::get('/route-cache', function() {
     $exitCode = Artisan::call('route:cache');
     return 'Routes cache cleared';
 });

 //Clear config cache:
 Route::get('/config-cache', function() {
     $exitCode = Artisan::call('config:cache');
     return 'Config cache cleared';
 }); 
 
 //Clear config cache:
 Route::get('/config-clear', function() {
     $exitCode = Artisan::call('config:clear');
     return 'Config cache cleared';
 }); 

// Clear application cache:
 Route::get('/clear-cache', function() {
     $exitCode = Artisan::call('cache:clear');
     return 'Application cache cleared';
 });

 // Clear view cache:
 Route::get('/view-clear', function() {
     $exitCode = Artisan::call('view:clear');
     return 'View cache cleared';
 });
 
 Route::get('/word-day', function() {
     $exitCode = Artisan::call('word:day');
     echo ($exitCode);
 }); 

 Route::get('/week-day', function() {
     $exitCode = Artisan::call('week:day');
     echo ($exitCode);
 });
 
 Route::get('/PostTeambuilding-day', function() {
     $exitCode = Artisan::call('PostTeambuilding:day');
     echo ($exitCode);
 });
 Route::get('/semaine2day', function() {
     $exitCode = Artisan::call('PostSemaine2Actions:day');
     echo ($exitCode);
 });
 
 Route::get('/Dernier_Week', function() {
     $exitCode = Artisan::call('DernierWeek:day');
     echo ($exitCode);
 });
 
 Route::get('/link', function() {
     $exitCode = Artisan::call('storage:link');
     echo ($exitCode);
 });
 
 Route::get('/composer-update', function() {
     $exitCode = 'composer require maatwebsite/excel';
     echo ($exitCode);
 });
 
  Route::get('/key-generate', function() {
     $exitCode = Artisan::call('key:generate');
    return 'key generate';
 });
 
Route::get('file-import-export', 'AgentController@fileImportExport');
Route::post('file-import', 'AgentController@fileImport')->name('file-import');
Route::get('file-export', 'AgentController@fileExport')->name('file-export');
 
 Auth::routes();  


