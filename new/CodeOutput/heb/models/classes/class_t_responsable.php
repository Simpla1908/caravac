
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_responsable
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_responsable
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_responsable
	{
	public $id_respo;
	public $nom_respo; 
	public $telephone_respo; 
	public $adresse_respo; 
	public $entreprise; 
	public $filtre; 
	public $company_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id_respo = isset($id_respo);
	$this->nom_respo = isset($nom_respo);
	$this->telephone_respo = isset($telephone_respo);
	$this->adresse_respo = isset($adresse_respo);
	$this->entreprise = isset($entreprise);
	$this->filtre = isset($filtre);
	$this->company_id = isset($company_id);
	}
	}