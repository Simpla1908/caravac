
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_pack_company
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_pack_company
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_pack_company
	{
	public $id;
	public $pack_id; 
	public $company_id; 
	public $etat; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->pack_id = isset($pack_id);
	$this->company_id = isset($company_id);
	$this->etat = isset($etat);
	}
	}