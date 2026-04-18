
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_commussionnaire
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_commussionnaire
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_commussionnaire
	{
	public $id_com;
	public $nomcom; 
	public $sxcom; 
	public $contact; 
	public $adr; 
	
	//Constructor
	public function __construct()
	{
	$this->id_com = isset($id_com);
	$this->nomcom = isset($nomcom);
	$this->sxcom = isset($sxcom);
	$this->contact = isset($contact);
	$this->adr = isset($adr);
	}
	}