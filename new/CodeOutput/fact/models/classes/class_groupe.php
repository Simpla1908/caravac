
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        groupe
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		groupe
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class groupe
	{
	public $id;
	public $libelle; 
	public $module_id; 
	public $user_id; 
	public $hotel_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->libelle = isset($libelle);
	$this->module_id = isset($module_id);
	$this->user_id = isset($user_id);
	$this->hotel_id = isset($hotel_id);
	}
	}