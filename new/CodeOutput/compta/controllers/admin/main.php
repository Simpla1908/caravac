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
//module	
if (get('view') == 'module') {
	include(APP_FOLDER . '/controllers/admin/module.php');
	$v_souscription_controller = new module_controller();
	$v_souscription_controller->invoke_module();
}
//resconfig	
if (get('view') == 'resconfig') {
	include(APP_FOLDER . '/controllers/admin/resconfig.php');
	$v_souscription_controller = new resconfig_controller();
	$v_souscription_controller->invoke_resconfig();
}
//cptclasses	
if (get('view') == 'cptclasses') {
	include(APP_FOLDER . '/controllers/admin/cptclasses.php');
	$v_souscription_controller = new cptclasses_controller();
	$v_souscription_controller->invoke_cptclasses();
}
//cptcomptes	
if (get('view') == 'cptcomptes') {
	include(APP_FOLDER . '/controllers/admin/cptcomptes.php');
	$v_souscription_controller = new cptcomptes_controller();
	$v_souscription_controller->invoke_cptcomptes();
}
//cptcomptesites	
if (get('view') == 'cptcomptesites') {
	include(APP_FOLDER . '/controllers/admin/cptcomptesites.php');
	$v_souscription_controller = new cptcomptesites_controller();
	$v_souscription_controller->invoke_cptcomptesites();
}
//cptdetailsecritures	
if (get('view') == 'cptdetailsecritures') {
	include(APP_FOLDER . '/controllers/admin/cptdetailsecritures.php');
	$v_souscription_controller = new cptdetailsecritures_controller();
	$v_souscription_controller->invoke_cptdetailsecritures();
}
//cptecritures	
if (get('view') == 'cptecritures') {
	include(APP_FOLDER . '/controllers/admin/cptecritures.php');
	$v_souscription_controller = new cptecritures_controller();
	$v_souscription_controller->invoke_cptecritures();
}
//cptjournal	
if (get('view') == 'cptjournal') {
	include(APP_FOLDER . '/controllers/admin/cptjournal.php');
	$v_souscription_controller = new cptjournal_controller();
	$v_souscription_controller->invoke_cptjournal();
}
//cptjournal	

if (get('view') == 'cptprevision') {
	include(APP_FOLDER . '/controllers/admin/cptprevision.php');
	$v_souscription_controller = new cptprevision_controller();
	$v_souscription_controller->invoke_cptprevision();
}
//cptexercice	
if (get('view') == 'cptexercice') {
	include(APP_FOLDER . '/controllers/admin/cptexercice.php');
	$v_souscription_controller = new cptexercice_controller();
	$v_souscription_controller->invoke_cptexercice();
}
//tresorerie
if (get('view') == 'tresorerie') {
	include(APP_FOLDER . '/controllers/admin/tresorerie.php');
	$v_souscription_controller = new tresorerie_controller();
	$v_souscription_controller->invoke_tresorerie();
}
//impression
//Impression	
if (get('view') == 'impression') {
	include(APP_FOLDER . '/controllers/admin/impression.php');
}
