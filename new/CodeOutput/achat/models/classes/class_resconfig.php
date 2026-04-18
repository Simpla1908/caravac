
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        resconfig
	* DATE CREATED:  	08-02-2018
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
	public $m_insert; 
	public $m_affich; 
	public $taux; 
	public $age; 
	public $fuseauhoraire; 
	public $logo; 
	public $module_id; 
	public $site_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->m_insert = isset($m_insert);
	$this->m_affich = isset($m_affich);
	$this->taux = isset($taux);
	$this->age = isset($age);
	$this->fuseauhoraire = isset($fuseauhoraire);
	$this->logo = isset($logo);
	$this->module_id = isset($module_id);
	$this->site_id = isset($site_id);
	}
	}