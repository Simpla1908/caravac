
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        respointage
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		respointage
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class respointage
	{
	public $id;
	public $employe_id; 
	public $dte_in; 
	public $dte_out; 
	public $hr_in; 
	public $hr_out; 
	public $motif; 
	public $justification; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->employe_id = isset($employe_id);
	$this->dte_in = isset($dte_in);
	$this->dte_out = isset($dte_out);
	$this->hr_in = isset($hr_in);
	$this->hr_out = isset($hr_out);
	$this->motif = isset($motif);
	$this->justification = isset($justification);
	}
	}