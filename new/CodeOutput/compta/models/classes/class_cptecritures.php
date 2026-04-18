
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        cptecritures
	* DATE CREATED:  	18-04-2019
	* FOR TABLE:  		cptecritures
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class cptecritures
	{
	public $id;
	public $dte; 
	public $dtetime; 
	public $libelle; 
	public $journal_id; 
	public $psedo; 
	public $user_id; 
	public $site_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->dte = isset($dte);
	$this->dtetime = isset($dtetime);
	$this->libelle = isset($libelle);
	$this->journal_id = isset($journal_id);
	$this->psedo = isset($psedo);
	$this->user_id = isset($user_id);
	$this->site_id = isset($site_id);
	}
	}