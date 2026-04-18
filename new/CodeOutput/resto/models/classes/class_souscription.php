
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        souscription
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		souscription
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class souscription
	{
	public $id;
	public $compagny_id; 
	public $libelle; 
	public $date_sous; 
	public $date_activ; 
	public $mode_paie; 
	public $montant_tot_sous; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->compagny_id = isset($compagny_id);
	$this->libelle = isset($libelle);
	$this->date_sous = isset($date_sous);
	$this->date_activ = isset($date_activ);
	$this->mode_paie = isset($mode_paie);
	$this->montant_tot_sous = isset($montant_tot_sous);
	}
	}