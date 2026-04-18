
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        monnaie
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		monnaie
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class monnaie
	{
	public $id_monnaie;
	public $monnaie; 
	public $lib_monnaie; 
	public $symbole; 
	public $choix; 
	public $taux; 
	public $tva; 
	public $id_hotel; 
	public $company_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id_monnaie = isset($id_monnaie);
	$this->monnaie = isset($monnaie);
	$this->lib_monnaie = isset($lib_monnaie);
	$this->symbole = isset($symbole);
	$this->choix = isset($choix);
	$this->taux = isset($taux);
	$this->tva = isset($tva);
	$this->id_hotel = isset($id_hotel);
	$this->company_id = isset($company_id);
	}
	}