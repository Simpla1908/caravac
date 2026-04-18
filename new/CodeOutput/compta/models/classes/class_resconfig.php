
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        resconfig
	* DATE CREATED:  	18-04-2019
	* FOR TABLE:  		resconfig
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class resconfig
	{
	public $id;
	public $nomcomp; 
	public $adrcomp; 
	public $m_insert; 
	public $m_affich; 
	public $taux; 
	public $age; 
	public $penalite; 
	public $hopital; 
	public $fuseauhoraire; 
	public $prefsanct; 
	public $prefconge; 
	public $tva; 
	public $echeance; 
	public $liestock; 
	public $infofact; 
	public $sujetmail; 
	public $msgmail; 
	public $logo; 
	public $module_id; 
	public $site_id; 
	public $checkin; 
	public $checkout; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->nomcomp = isset($nomcomp);
	$this->adrcomp = isset($adrcomp);
	$this->m_insert = isset($m_insert);
	$this->m_affich = isset($m_affich);
	$this->taux = isset($taux);
	$this->age = isset($age);
	$this->penalite = isset($penalite);
	$this->hopital = isset($hopital);
	$this->fuseauhoraire = isset($fuseauhoraire);
	$this->prefsanct = isset($prefsanct);
	$this->prefconge = isset($prefconge);
	$this->tva = isset($tva);
	$this->echeance = isset($echeance);
	$this->liestock = isset($liestock);
	$this->infofact = isset($infofact);
	$this->sujetmail = isset($sujetmail);
	$this->msgmail = isset($msgmail);
	$this->logo = isset($logo);
	$this->module_id = isset($module_id);
	$this->site_id = isset($site_id);
	$this->checkin = isset($checkin);
	$this->checkout = isset($checkout);
	}
	}