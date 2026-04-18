
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        cptdetailsecritures
	* DATE CREATED:  	18-04-2019
	* FOR TABLE:  		cptdetailsecritures
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class cptdetailsecritures
	{
	public $id;
	public $compte_id; 
	public $debit; 
	public $credit; 
	public $libelle; 
	public $numdoc; 
	public $ecriture_id; 
	public $site_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->compte_id = isset($compte_id);
	$this->debit = isset($debit);
	$this->credit = isset($credit);
	$this->libelle = isset($libelle);
	$this->numdoc = isset($numdoc);
	$this->ecriture_id = isset($ecriture_id);
	$this->site_id = isset($site_id);
	}
	}