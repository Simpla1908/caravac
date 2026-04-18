
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        resrubrique
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		resrubrique
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class resrubrique
	{
	public $id;
	public $libelle; 
	public $type; 
	public $psedo; 
	public $site_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->libelle = isset($libelle);
	$this->type = isset($type);
	$this->psedo = isset($psedo);
	$this->site_id = isset($site_id);
	}
	}