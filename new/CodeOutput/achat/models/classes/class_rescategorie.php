
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        rescategorie
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		rescategorie
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class rescategorie
	{
	public $id;
	public $libelle; 
	public $salbase; 
	public $devise; 
	public $psedo; 
	public $site_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->libelle = isset($libelle);
	$this->salbase = isset($salbase);
	$this->devise = isset($devise);
	$this->psedo = isset($psedo);
	$this->site_id = isset($site_id);
	}
	}