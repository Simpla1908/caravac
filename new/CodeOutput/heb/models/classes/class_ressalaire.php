
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        ressalaire
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		ressalaire
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class ressalaire
	{
	public $id;
	public $libelle; 
	public $nbjrpreste; 
	public $nbjrconge; 
	public $type; 
	public $montant; 
	public $dte; 
	public $employe_id; 
	public $psedo; 
	public $site_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->libelle = isset($libelle);
	$this->nbjrpreste = isset($nbjrpreste);
	$this->nbjrconge = isset($nbjrconge);
	$this->type = isset($type);
	$this->montant = isset($montant);
	$this->dte = isset($dte);
	$this->employe_id = isset($employe_id);
	$this->psedo = isset($psedo);
	$this->site_id = isset($site_id);
	}
	}