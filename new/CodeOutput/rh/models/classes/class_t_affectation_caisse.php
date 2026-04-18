
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_affectation_caisse
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_affectation_caisse
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_affectation_caisse
	{
	public $id_affectation;
	public $id_user; 
	public $id_caisse; 
	public $date_affect; 
	
	//Constructor
	public function __construct()
	{
	$this->id_affectation = isset($id_affectation);
	$this->id_user = isset($id_user);
	$this->id_caisse = isset($id_caisse);
	$this->date_affect = isset($date_affect);
	}
	}