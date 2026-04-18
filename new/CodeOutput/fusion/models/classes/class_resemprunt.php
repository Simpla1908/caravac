
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        resemprunt
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		resemprunt
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class resemprunt
	{
	public $id;
	public $libelle; 
	public $type; 
	public $montant; 
	public $dte; 
	public $dte_deduct; 
	public $employe_id; 
	public $psedo; 
	public $site_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->libelle = isset($libelle);
	$this->type = isset($type);
	$this->montant = isset($montant);
	$this->dte = isset($dte);
	$this->dte_deduct = isset($dte_deduct);
	$this->employe_id = isset($employe_id);
	$this->psedo = isset($psedo);
	$this->site_id = isset($site_id);
	}
	}