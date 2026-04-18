<?php
/*
	* =======================================================================
	* FILE NAME:        main.php
	* DATE CREATED:  	30-10-2017
	* FOR TABLE:  		v_souscription
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
if (!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
$module_id = 26;
$site_id = $_SESSION['idsite'];
ConfigModule($module_id, $site_id);
date_default_timezone_set($_SESSION['fuseauhoraire']);
//accuse_reception	
if (get('view') == 'accuse_reception') {
	include(APP_FOLDER . '/controllers/admin/accuse_reception.php');
	$v_souscription_controller = new accuse_reception_controller();
	$v_souscription_controller->invoke_accuse_reception();
}
//actions	
if (get('view') == 'actions') {
	include(APP_FOLDER . '/controllers/admin/actions.php');
	$v_souscription_controller = new actions_controller();
	$v_souscription_controller->invoke_actions();
}
//actions_groupe	
if (get('view') == 'actions_groupe') {
	include(APP_FOLDER . '/controllers/admin/actions_groupe.php');
	$v_souscription_controller = new actions_groupe_controller();
	$v_souscription_controller->invoke_actions_groupe();
}
//bon_commandes	
if (get('view') == 'bon_commandes') {
	include(APP_FOLDER . '/controllers/admin/bon_commandes.php');
	$v_souscription_controller = new bon_commandes_controller();
	$v_souscription_controller->invoke_bon_commandes();
}
//categorie_chambre	
if (get('view') == 'categorie_chambre') {
	include(APP_FOLDER . '/controllers/admin/categorie_chambre.php');
	$v_souscription_controller = new categorie_chambre_controller();
	$v_souscription_controller->invoke_categorie_chambre();
}
//compteur	
if (get('view') == 'compteur') {
	include(APP_FOLDER . '/controllers/admin/compteur.php');
	$v_souscription_controller = new compteur_controller();
	$v_souscription_controller->invoke_compteur();
}
//connexion	
if (get('view') == 'connexion') {
	include(APP_FOLDER . '/controllers/admin/connexion.php');
	$v_souscription_controller = new connexion_controller();
	$v_souscription_controller->invoke_connexion();
}
//groupe	
if (get('view') == 'groupe') {
	include(APP_FOLDER . '/controllers/admin/groupe.php');
	$v_souscription_controller = new groupe_controller();
	$v_souscription_controller->invoke_groupe();
}
//lignes_commandes	
if (get('view') == 'lignes_commandes') {
	include(APP_FOLDER . '/controllers/admin/lignes_commandes.php');
	$v_souscription_controller = new lignes_commandes_controller();
	$v_souscription_controller->invoke_lignes_commandes();
}
//module	
if (get('view') == 'module') {
	include(APP_FOLDER . '/controllers/admin/module.php');
	$v_souscription_controller = new module_controller();
	$v_souscription_controller->invoke_module();
}
//monnaie	
if (get('view') == 'monnaie') {
	include(APP_FOLDER . '/controllers/admin/monnaie.php');
	$v_souscription_controller = new monnaie_controller();
	$v_souscription_controller->invoke_monnaie();
}
//niveau_chambre	
if (get('view') == 'niveau_chambre') {
	include(APP_FOLDER . '/controllers/admin/niveau_chambre.php');
	$v_souscription_controller = new niveau_chambre_controller();
	$v_souscription_controller->invoke_niveau_chambre();
}
//paiement	
if (get('view') == 'paiement') {
	include(APP_FOLDER . '/controllers/admin/paiement.php');
	$v_souscription_controller = new paiement_controller();
	$v_souscription_controller->invoke_paiement();
}
//parametrage	
if (get('view') == 'parametrage') {
	include(APP_FOLDER . '/controllers/admin/parametrage.php');
	$v_souscription_controller = new parametrage_controller();
	$v_souscription_controller->invoke_parametrage();
}
//partenaire_hotel	
if (get('view') == 'partenaire_hotel') {
	include(APP_FOLDER . '/controllers/admin/partenaire_hotel.php');
	$v_souscription_controller = new partenaire_hotel_controller();
	$v_souscription_controller->invoke_partenaire_hotel();
}
//prix	
if (get('view') == 'prix') {
	include(APP_FOLDER . '/controllers/admin/prix.php');
	$v_souscription_controller = new prix_controller();
	$v_souscription_controller->invoke_prix();
}
//reglage_systeme	
if (get('view') == 'reglage_systeme') {
	include(APP_FOLDER . '/controllers/admin/reglage_systeme.php');
	$v_souscription_controller = new reglage_systeme_controller();
	$v_souscription_controller->invoke_reglage_systeme();
}
//resaffectation	
if (get('view') == 'resaffectation') {
	include(APP_FOLDER . '/controllers/admin/resaffectation.php');
	$v_souscription_controller = new resaffectation_controller();
	$v_souscription_controller->invoke_resaffectation();
}
//rescategorie	
if (get('view') == 'rescategorie') {
	include(APP_FOLDER . '/controllers/admin/rescategorie.php');
	$v_souscription_controller = new rescategorie_controller();
	$v_souscription_controller->invoke_rescategorie();
}
//fidelite_programme	
if (get('view') == 'fidelite_programme') {
	include(APP_FOLDER . '/controllers/admin/fidelite_programme.php');
	$v_souscription_controller = new fidelite_programme_controller();
	$v_souscription_controller->invoke_fidelite_programme();
}
//resconge	
if (get('view') == 'resconge') {
	include(APP_FOLDER . '/controllers/admin/resconge.php');
	$v_souscription_controller = new resconge_controller();
	$v_souscription_controller->invoke_resconge();
}
//rescontrat	
if (get('view') == 'rescontrat') {
	include(APP_FOLDER . '/controllers/admin/rescontrat.php');
	$v_souscription_controller = new rescontrat_controller();
	$v_souscription_controller->invoke_rescontrat();
}
//resdepartement	
if (get('view') == 'resdepartement') {
	include(APP_FOLDER . '/controllers/admin/resdepartement.php');
	$v_souscription_controller = new resdepartement_controller();
	$v_souscription_controller->invoke_resdepartement();
}
//resempconge	
if (get('view') == 'resempconge') {
	include(APP_FOLDER . '/controllers/admin/resempconge.php');
	$v_souscription_controller = new resempconge_controller();
	$v_souscription_controller->invoke_resempconge();
}
//resemploycontr	
if (get('view') == 'resemploycontr') {
	include(APP_FOLDER . '/controllers/admin/resemploycontr.php');
	$v_souscription_controller = new resemploycontr_controller();
	$v_souscription_controller->invoke_resemploycontr();
}
//resemployefamille	
if (get('view') == 'resemployefamille') {
	include(APP_FOLDER . '/controllers/admin/resemployefamille.php');
	$v_souscription_controller = new resemployefamille_controller();
	$v_souscription_controller->invoke_resemployefamille();
}
//resemployehoraire	
if (get('view') == 'resemployehoraire') {
	include(APP_FOLDER . '/controllers/admin/resemployehoraire.php');
	$v_souscription_controller = new resemployehoraire_controller();
	$v_souscription_controller->invoke_resemployehoraire();
}
//resemployes	
if (get('view') == 'resemployes') {
	include(APP_FOLDER . '/controllers/admin/resemployes.php');
	$v_souscription_controller = new resemployes_controller();
	$v_souscription_controller->invoke_resemployes();
}
//resemprunt	
if (get('view') == 'resemprunt') {
	include(APP_FOLDER . '/controllers/admin/resemprunt.php');
	$v_souscription_controller = new resemprunt_controller();
	$v_souscription_controller->invoke_resemprunt();
}
//reservation_table	
if (get('view') == 'reservation_table') {
	include(APP_FOLDER . '/controllers/admin/reservation_table.php');
	$v_souscription_controller = new reservation_table_controller();
	$v_souscription_controller->invoke_reservation_table();
}
//resfonction	
if (get('view') == 'resfonction') {
	include(APP_FOLDER . '/controllers/admin/resfonction.php');
	$v_souscription_controller = new resfonction_controller();
	$v_souscription_controller->invoke_resfonction();
}
//reshoraire	
if (get('view') == 'reshoraire') {
	include(APP_FOLDER . '/controllers/admin/reshoraire.php');
	$v_souscription_controller = new reshoraire_controller();
	$v_souscription_controller->invoke_reshoraire();
}
//reshorairejours	
if (get('view') == 'reshorairejours') {
	include(APP_FOLDER . '/controllers/admin/reshorairejours.php');
	$v_souscription_controller = new reshorairejours_controller();
	$v_souscription_controller->invoke_reshorairejours();
}
//resjours	
if (get('view') == 'resjours') {
	include(APP_FOLDER . '/controllers/admin/resjours.php');
	$v_souscription_controller = new resjours_controller();
	$v_souscription_controller->invoke_resjours();
}
//respointage	
if (get('view') == 'respointage') {
	include(APP_FOLDER . '/controllers/admin/respointage.php');
	$v_souscription_controller = new respointage_controller();
	$v_souscription_controller->invoke_respointage();
}
//respointagehoraire	
if (get('view') == 'respointagehoraire') {
	include(APP_FOLDER . '/controllers/admin/respointagehoraire.php');
	$v_souscription_controller = new respointagehoraire_controller();
	$v_souscription_controller->invoke_respointagehoraire();
}
//resremboursement	
if (get('view') == 'resremboursement') {
	include(APP_FOLDER . '/controllers/admin/resremboursement.php');
	$v_souscription_controller = new resremboursement_controller();
	$v_souscription_controller->invoke_resremboursement();
}
//resrubrique	
if (get('view') == 'resrubrique') {
	include(APP_FOLDER . '/controllers/admin/resrubrique.php');
	$v_souscription_controller = new resrubrique_controller();
	$v_souscription_controller->invoke_resrubrique();
}
//resrubriquecateg	
if (get('view') == 'resrubriquecateg') {
	include(APP_FOLDER . '/controllers/admin/resrubriquecateg.php');
	$v_souscription_controller = new resrubriquecateg_controller();
	$v_souscription_controller->invoke_resrubriquecateg();
}
//resrubriquesal	
if (get('view') == 'resrubriquesal') {
	include(APP_FOLDER . '/controllers/admin/resrubriquesal.php');
	$v_souscription_controller = new resrubriquesal_controller();
	$v_souscription_controller->invoke_resrubriquesal();
}
//ressalaire	
if (get('view') == 'ressalaire') {
	include(APP_FOLDER . '/controllers/admin/ressalaire.php');
	$v_souscription_controller = new ressalaire_controller();
	$v_souscription_controller->invoke_ressalaire();
}
//ressanction	
if (get('view') == 'ressanction') {
	include(APP_FOLDER . '/controllers/admin/ressanction.php');
	$v_souscription_controller = new ressanction_controller();
	$v_souscription_controller->invoke_ressanction();
}
//ressanctionempl	
if (get('view') == 'ressanctionempl') {
	include(APP_FOLDER . '/controllers/admin/ressanctionempl.php');
	$v_souscription_controller = new ressanctionempl_controller();
	$v_souscription_controller->invoke_ressanctionempl();
}
//souscription	
if (get('view') == 'souscription') {
	include(APP_FOLDER . '/controllers/admin/souscription.php');
	$v_souscription_controller = new souscription_controller();
	$v_souscription_controller->invoke_souscription();
}
//stk__mouvement	
if (get('view') == 'stk__mouvement') {
	include(APP_FOLDER . '/controllers/admin/stk__mouvement.php');
	$v_souscription_controller = new stk__mouvement_controller();
	$v_souscription_controller->invoke_stk__mouvement();
}
//stk_famille	
if (get('view') == 'stk_famille') {
	include(APP_FOLDER . '/controllers/admin/stk_famille.php');
	$v_souscription_controller = new stk_famille_controller();
	$v_souscription_controller->invoke_stk_famille();
}
//stk_produit	
if (get('view') == 'stk_produit') {
	include(APP_FOLDER . '/controllers/admin/stk_produit.php');
	$v_souscription_controller = new stk_produit_controller();
	$v_souscription_controller->invoke_stk_produit();
}
//stk_report	
if (get('view') == 'stk_report') {
	include(APP_FOLDER . '/controllers/admin/stk_report.php');
	$v_souscription_controller = new stk_report_controller();
	$v_souscription_controller->invoke_stk_report();
}
//stk_situation_report	
if (get('view') == 'stk_situation_report') {
	include(APP_FOLDER . '/controllers/admin/stk_situation_report.php');
	$v_souscription_controller = new stk_situation_report_controller();
	$v_souscription_controller->invoke_stk_situation_report();
}
//stk_sous_famille	
if (get('view') == 'stk_sous_famille') {
	include(APP_FOLDER . '/controllers/admin/stk_sous_famille.php');
	$v_souscription_controller = new stk_sous_famille_controller();
	$v_souscription_controller->invoke_stk_sous_famille();
}
//system_users	
if (get('view') == 'system_users') {
	include(APP_FOLDER . '/controllers/admin/system_users.php');
	$v_souscription_controller = new system_users_controller();
	$v_souscription_controller->invoke_system_users();
}
//t_affectation_caisse	
if (get('view') == 't_affectation_caisse') {
	include(APP_FOLDER . '/controllers/admin/t_affectation_caisse.php');
	$v_souscription_controller = new t_affectation_caisse_controller();
	$v_souscription_controller->invoke_t_affectation_caisse();
}
//t_annule_reservation	
if (get('view') == 't_annule_reservation') {
	include(APP_FOLDER . '/controllers/admin/t_annule_reservation.php');
	$v_souscription_controller = new t_annule_reservation_controller();
	$v_souscription_controller->invoke_t_annule_reservation();
}
//t_caisse	
if (get('view') == 't_caisse') {
	include(APP_FOLDER . '/controllers/admin/t_caisse.php');
	$v_souscription_controller = new t_caisse_controller();
	$v_souscription_controller->invoke_t_caisse();
}
//t_chambre	
if (get('view') == 't_chambre') {
	include(APP_FOLDER . '/controllers/admin/t_chambre.php');
	$v_souscription_controller = new t_chambre_controller();
	$v_souscription_controller->invoke_t_chambre();
}
//t_chambre_histo	
if (get('view') == 't_chambre_histo') {
	include(APP_FOLDER . '/controllers/admin/t_chambre_histo.php');
	$v_souscription_controller = new t_chambre_histo_controller();
	$v_souscription_controller->invoke_t_chambre_histo();
}
//t_client	
if (get('view') == 't_client') {
	include(APP_FOLDER . '/controllers/admin/t_client.php');
	$v_souscription_controller = new t_client_controller();
	$v_souscription_controller->invoke_t_client();
}
//t_client_reserve	
if (get('view') == 't_client_reserve') {
	include(APP_FOLDER . '/controllers/admin/t_client_reserve.php');
	$v_souscription_controller = new t_client_reserve_controller();
	$v_souscription_controller->invoke_t_client_reserve();
}
//t_commussionnaire	
if (get('view') == 't_commussionnaire') {
	include(APP_FOLDER . '/controllers/admin/t_commussionnaire.php');
	$v_souscription_controller = new t_commussionnaire_controller();
	$v_souscription_controller->invoke_t_commussionnaire();
}
//t_company	
if (get('view') == 't_company') {
	include(APP_FOLDER . '/controllers/admin/t_company.php');
	$v_souscription_controller = new t_company_controller();
	$v_souscription_controller->invoke_t_company();
}
//t_droit	
if (get('view') == 't_droit') {
	include(APP_FOLDER . '/controllers/admin/t_droit.php');
	$v_souscription_controller = new t_droit_controller();
	$v_souscription_controller->invoke_t_droit();
}
//t_facture	
if (get('view') == 't_facture') {
	include(APP_FOLDER . '/controllers/admin/t_facture.php');
	$v_souscription_controller = new t_facture_controller();
	$v_souscription_controller->invoke_t_facture();
}
//t_garantie	
if (get('view') == 't_garantie') {
	include(APP_FOLDER . '/controllers/admin/t_garantie.php');
	$v_souscription_controller = new t_garantie_controller();
	$v_souscription_controller->invoke_t_garantie();
}
//t_histo_heberge	
if (get('view') == 't_histo_heberge') {
	include(APP_FOLDER . '/controllers/admin/t_histo_heberge.php');
	$v_souscription_controller = new t_histo_heberge_controller();
	$v_souscription_controller->invoke_t_histo_heberge();
}
//t_hotel	
if (get('view') == 't_hotel') {
	include(APP_FOLDER . '/controllers/admin/t_hotel.php');
	$v_souscription_controller = new t_hotel_controller();
	$v_souscription_controller->invoke_t_hotel();
}
//t_liberation	
if (get('view') == 't_liberation') {
	include(APP_FOLDER . '/controllers/admin/t_liberation.php');
	$v_souscription_controller = new t_liberation_controller();
	$v_souscription_controller->invoke_t_liberation();
}
//t_lignesfact_pack	
if (get('view') == 't_lignesfact_pack') {
	include(APP_FOLDER . '/controllers/admin/t_lignesfact_pack.php');
	$v_souscription_controller = new t_lignesfact_pack_controller();
	$v_souscription_controller->invoke_t_lignesfact_pack();
}
//t_mode_reglement	
if (get('view') == 't_mode_reglement') {
	include(APP_FOLDER . '/controllers/admin/t_mode_reglement.php');
	$v_souscription_controller = new t_mode_reglement_controller();
	$v_souscription_controller->invoke_t_mode_reglement();
}
//t_module_pack	
if (get('view') == 't_module_pack') {
	include(APP_FOLDER . '/controllers/admin/t_module_pack.php');
	$v_souscription_controller = new t_module_pack_controller();
	$v_souscription_controller->invoke_t_module_pack();
}
//t_modulecompany	
if (get('view') == 't_modulecompany') {
	include(APP_FOLDER . '/controllers/admin/t_modulecompany.php');
	$v_souscription_controller = new t_modulecompany_controller();
	$v_souscription_controller->invoke_t_modulecompany();
}
//t_motif	
if (get('view') == 't_motif') {
	include(APP_FOLDER . '/controllers/admin/t_motif.php');
	$v_souscription_controller = new t_motif_controller();
	$v_souscription_controller->invoke_t_motif();
}
//t_motif_type	
if (get('view') == 't_motif_type') {
	include(APP_FOLDER . '/controllers/admin/t_motif_type.php');
	$v_souscription_controller = new t_motif_type_controller();
	$v_souscription_controller->invoke_t_motif_type();
}
//t_occupation	
if (get('view') == 't_occupation') {
	include(APP_FOLDER . '/controllers/admin/t_occupation.php');
	$v_souscription_controller = new t_occupation_controller();
	$v_souscription_controller->invoke_t_occupation();
}
//t_occupation_direct	
if (get('view') == 't_occupation_direct') {
	include(APP_FOLDER . '/controllers/admin/t_occupation_direct.php');
	$v_souscription_controller = new t_occupation_direct_controller();
	$v_souscription_controller->invoke_t_occupation_direct();
}
//t_operation	
if (get('view') == 't_operation') {
	include(APP_FOLDER . '/controllers/admin/t_operation.php');
	$v_souscription_controller = new t_operation_controller();
	$v_souscription_controller->invoke_t_operation();
}
//t_pack	
if (get('view') == 't_pack') {
	include(APP_FOLDER . '/controllers/admin/t_pack.php');
	$v_souscription_controller = new t_pack_controller();
	$v_souscription_controller->invoke_t_pack();
}
//t_pack_company	
if (get('view') == 't_pack_company') {
	include(APP_FOLDER . '/controllers/admin/t_pack_company.php');
	$v_souscription_controller = new t_pack_company_controller();
	$v_souscription_controller->invoke_t_pack_company();
}
//t_reglage	
if (get('view') == 't_reglage') {
	include(APP_FOLDER . '/controllers/admin/t_reglage.php');
	$v_souscription_controller = new t_reglage_controller();
	$v_souscription_controller->invoke_t_reglage();
}
//t_reglement	
if (get('view') == 't_reglement') {
	include(APP_FOLDER . '/controllers/admin/t_reglement.php');
	$v_souscription_controller = new t_reglement_controller();
	$v_souscription_controller->invoke_t_reglement();
}
//t_reservation	
if (get('view') == 't_reservation') {
	include(APP_FOLDER . '/controllers/admin/t_reservation.php');
	$v_souscription_controller = new t_reservation_controller();
	$v_souscription_controller->invoke_t_reservation();
}
//t_reserve_chambre	
if (get('view') == 't_reserve_chambre') {
	include(APP_FOLDER . '/controllers/admin/t_reserve_chambre.php');
	$v_souscription_controller = new t_reserve_chambre_controller();
	$v_souscription_controller->invoke_t_reserve_chambre();
}
//t_responsable	
if (get('view') == 't_responsable') {
	include(APP_FOLDER . '/controllers/admin/t_responsable.php');
	$v_souscription_controller = new t_responsable_controller();
	$v_souscription_controller->invoke_t_responsable();
}
//t_session	
if (get('view') == 't_session') {
	include(APP_FOLDER . '/controllers/admin/t_session.php');
	$v_souscription_controller = new t_session_controller();
	$v_souscription_controller->invoke_t_session();
}
//t_suggestion	
if (get('view') == 't_suggestion') {
	include(APP_FOLDER . '/controllers/admin/t_suggestion.php');
	$v_souscription_controller = new t_suggestion_controller();
	$v_souscription_controller->invoke_t_suggestion();
}
//t_utilisateur	
if (get('view') == 't_utilisateur') {
	include(APP_FOLDER . '/controllers/admin/t_utilisateur.php');
	$v_souscription_controller = new t_utilisateur_controller();
	$v_souscription_controller->invoke_t_utilisateur();
}
//t_versement	
if (get('view') == 't_versement') {
	include(APP_FOLDER . '/controllers/admin/t_versement.php');
	$v_souscription_controller = new t_versement_controller();
	$v_souscription_controller->invoke_t_versement();
}
//users_groupes	
if (get('view') == 'users_groupes') {
	include(APP_FOLDER . '/controllers/admin/users_groupes.php');
	$v_souscription_controller = new users_groupes_controller();
	$v_souscription_controller->invoke_users_groupes();
}
//v_com_paiement	
if (get('view') == 'v_com_paiement') {
	include(APP_FOLDER . '/controllers/admin/v_com_paiement.php');
	$v_souscription_controller = new v_com_paiement_controller();
	$v_souscription_controller->invoke_v_com_paiement();
}
//v_commande	
if (get('view') == 'v_commande') {
	include(APP_FOLDER . '/controllers/admin/v_commande.php');
	$v_souscription_controller = new v_commande_controller();
	$v_souscription_controller->invoke_v_commande();
}
//v_factglobale	
if (get('view') == 'v_factglobale') {
	include(APP_FOLDER . '/controllers/admin/v_factglobale.php');
	$v_souscription_controller = new v_factglobale_controller();
	$v_souscription_controller->invoke_v_factglobale();
}
//v_factglobale_clioccas	
if (get('view') == 'v_factglobale_clioccas') {
	include(APP_FOLDER . '/controllers/admin/v_factglobale_clioccas.php');
	$v_souscription_controller = new v_factglobale_clioccas_controller();
	$v_souscription_controller->invoke_v_factglobale_clioccas();
}
//v_hebergement	
if (get('view') == 'v_hebergement') {
	include(APP_FOLDER . '/controllers/admin/v_hebergement.php');
	$v_souscription_controller = new v_hebergement_controller();
	$v_souscription_controller->invoke_v_hebergement();
}
//v_packs	
if (get('view') == 'v_packs') {
	include(APP_FOLDER . '/controllers/admin/v_packs.php');
	$v_souscription_controller = new v_packs_controller();
	$v_souscription_controller->invoke_v_packs();
}
//v_paiement	
if (get('view') == 'v_paiement') {
	include(APP_FOLDER . '/controllers/admin/v_paiement.php');
	$v_souscription_controller = new v_paiement_controller();
	$v_souscription_controller->invoke_v_paiement();
}
//v_reglement	
if (get('view') == 'v_reglement') {
	include(APP_FOLDER . '/controllers/admin/v_reglement.php');
	$v_souscription_controller = new v_reglement_controller();
	$v_souscription_controller->invoke_v_reglement();
}
//v_souscription	
if (get('view') == 'v_souscription') {
	include(APP_FOLDER . '/controllers/admin/v_souscription.php');
	$v_souscription_controller = new v_souscription_controller();
	$v_souscription_controller->invoke_v_souscription();
}
//resbonmalade	
if (get('view') == 'resbonmalade') {
	include(APP_FOLDER . '/controllers/admin/resbonmalade.php');
	$v_souscription_controller = new resbonmalade_controller();
	$v_souscription_controller->invoke_resbonmalade();
}
//resconfig	
if (get('view') == 'resconfig') {
	include(APP_FOLDER . '/controllers/admin/resconfig.php');
	$v_souscription_controller = new resconfig_controller();
	$v_souscription_controller->invoke_resconfig();
}
//resdeclaration
if (get('view') == 'resdeclaration') {
	include(APP_FOLDER . '/controllers/admin/resdeclaration.php');
	$v_souscription_controller = new resdeclaration_controller();
	$v_souscription_controller->invoke_resdeclaration();
}
//Impression	
if (get('view') == 'impression') {
	include(APP_FOLDER . '/controllers/admin/impression.php');
}
//FACTURATION

//Configuration	de base
if (get('view') == 'facconfig') {
	include(APP_FOLDER . '/controllers/admin/facconfig.php');
	$v_souscription_controller = new facconfig_controller();
	$v_souscription_controller->invoke_facconfig();
}
//Condition de paiement
if (get('view') == 'facconditionpaie') {
	include(APP_FOLDER . '/controllers/admin/facconditionpaie.php');
	$v_souscription_controller = new facconditionpaie_controller();
	$v_souscription_controller->invoke_facconditionpaie();
}
