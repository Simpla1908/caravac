
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        cptcomptes
	* DATE CREATED:  	18-04-2019
	* FOR TABLE:  		cptcomptes
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class cptcomptes
	{
	public $id;
	public $libelle; 
	public $numero; 
	public $niveau; 
	public $psedo; 
	public $classe_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->libelle = isset($libelle);
	$this->numero = isset($numero);
	$this->niveau = isset($niveau);
	$this->psedo = isset($psedo);
	$this->classe_id = isset($classe_id);
	}
	}