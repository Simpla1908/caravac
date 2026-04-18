
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        cptclasses
	* DATE CREATED:  	18-04-2019
	* FOR TABLE:  		cptclasses
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class cptclasses
	{
	public $id;
	public $libelle; 
	public $libelle2; 
	public $numero; 
	public $etat; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->libelle = isset($libelle);
	$this->libelle2 = isset($libelle2);
	$this->numero = isset($numero);
	$this->etat = isset($etat);
	}
	}