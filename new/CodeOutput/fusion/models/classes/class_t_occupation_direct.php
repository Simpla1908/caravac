
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_occupation_direct
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_occupation_direct
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_occupation_direct
	{
	public $id_occ_d;
	public $date_occ_d; 
	public $heure_occ_d; 
	public $id_ch; 
	public $id_client; 
	
	//Constructor
	public function __construct()
	{
	$this->id_occ_d = isset($id_occ_d);
	$this->date_occ_d = isset($date_occ_d);
	$this->heure_occ_d = isset($heure_occ_d);
	$this->id_ch = isset($id_ch);
	$this->id_client = isset($id_client);
	}
	}