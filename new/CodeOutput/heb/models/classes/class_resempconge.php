
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        resempconge
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		resempconge
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class resempconge
	{
	public $id;
	public $employe_id; 
	public $conge_id; 
	public $dte1; 
	public $dte2; 
	public $nbre; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->employe_id = isset($employe_id);
	$this->conge_id = isset($conge_id);
	$this->dte1 = isset($dte1);
	$this->dte2 = isset($dte2);
	$this->nbre = isset($nbre);
	}
	}