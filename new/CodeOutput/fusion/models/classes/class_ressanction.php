
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        ressanction
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		ressanction
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class ressanction
	{
	public $id;
	public $libelle; 
	public $nbrjr; 
	public $retenue; 
	public $site_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->libelle = isset($libelle);
	$this->nbrjr = isset($nbrjr);
	$this->retenue = isset($retenue);
	$this->site_id = isset($site_id);
	}
	}