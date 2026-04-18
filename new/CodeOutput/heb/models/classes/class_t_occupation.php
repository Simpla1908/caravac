
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_occupation
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_occupation
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_occupation
	{
	public $id_occ;
	public $type_occ; 
	public $date_occ; 
	public $heure_occ; 
	public $id_ch; 
	public $id_client; 
	
	//Constructor
	public function __construct()
	{
	$this->id_occ = isset($id_occ);
	$this->type_occ = isset($type_occ);
	$this->date_occ = isset($date_occ);
	$this->heure_occ = isset($heure_occ);
	$this->id_ch = isset($id_ch);
	$this->id_client = isset($id_client);
	}
	}