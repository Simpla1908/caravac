
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_lignesfact_pack
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_lignesfact_pack
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_lignesfact_pack
	{
	public $id;
	public $montant; 
	public $mont_paye; 
	public $active; 
	public $pack_company_id; 
	public $pack_id; 
	public $fact_id; 
	public $type; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->montant = isset($montant);
	$this->mont_paye = isset($mont_paye);
	$this->active = isset($active);
	$this->pack_company_id = isset($pack_company_id);
	$this->pack_id = isset($pack_id);
	$this->fact_id = isset($fact_id);
	$this->type = isset($type);
	}
	}