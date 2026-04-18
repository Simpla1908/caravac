
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        resremboursement
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		resremboursement
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class resremboursement
	{
	public $id;
	public $employe_id; 
	public $salaire_id; 
	public $montant; 
	public $dte; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->employe_id = isset($employe_id);
	$this->salaire_id = isset($salaire_id);
	$this->montant = isset($montant);
	$this->dte = isset($dte);
	}
	}