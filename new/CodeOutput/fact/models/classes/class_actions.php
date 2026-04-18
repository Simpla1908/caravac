
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        actions
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		actions
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class actions
	{
	public $id_act;
	public $code_act; 
	public $lib_act; 
	public $visible; 
	public $module_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id_act = isset($id_act);
	$this->code_act = isset($code_act);
	$this->lib_act = isset($lib_act);
	$this->visible = isset($visible);
	$this->module_id = isset($module_id);
	}
	}