
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_modulecompany
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_modulecompany
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_modulecompany
	{
	public $id;
	public $nbreuser; 
	public $nbre_user_maj; 
	public $etat_module; 
	public $paye; 
	public $montantmodule; 
	public $prix_id; 
	public $pack_id; 
	public $company_id; 
	public $module_id; 
	public $souscription_id; 
	public $date_sous; 
	public $date_activ; 
	public $date_echeance; 
	public $dte_blocage; 
	public $site_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->nbreuser = isset($nbreuser);
	$this->nbre_user_maj = isset($nbre_user_maj);
	$this->etat_module = isset($etat_module);
	$this->paye = isset($paye);
	$this->montantmodule = isset($montantmodule);
	$this->prix_id = isset($prix_id);
	$this->pack_id = isset($pack_id);
	$this->company_id = isset($company_id);
	$this->module_id = isset($module_id);
	$this->souscription_id = isset($souscription_id);
	$this->date_sous = isset($date_sous);
	$this->date_activ = isset($date_activ);
	$this->date_echeance = isset($date_echeance);
	$this->dte_blocage = isset($dte_blocage);
	$this->site_id = isset($site_id);
	}
	}