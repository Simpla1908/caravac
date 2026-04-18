
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        resrubriquecateg
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		resrubriquecateg
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class resrubriquecateg
	{
	public $id;
	public $rubrique_id; 
	public $categorie_id; 
	public $salbase; 
	public $nbrenf; 
	public $salbrut; 
	public $manuel; 
	public $pourcentage; 
	public $imposable; 
	public $valeur; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->rubrique_id = isset($rubrique_id);
	$this->categorie_id = isset($categorie_id);
	$this->salbase = isset($salbase);
	$this->nbrenf = isset($nbrenf);
	$this->salbrut = isset($salbrut);
	$this->manuel = isset($manuel);
	$this->pourcentage = isset($pourcentage);
	$this->imposable = isset($imposable);
	$this->valeur = isset($valeur);
	}
	}