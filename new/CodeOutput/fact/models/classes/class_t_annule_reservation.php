
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_annule_reservation
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_annule_reservation
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_annule_reservation
	{
	public $id_annule;
	public $id_res; 
	public $id_ch; 
	public $id_user; 
	public $id_regl; 
	public $Montant_retirer; 
	public $monnaie; 
	public $poucentage; 
	public $mont_remb; 
	public $date_annule_res; 
	public $date_annule; 
	
	//Constructor
	public function __construct()
	{
	$this->id_annule = isset($id_annule);
	$this->id_res = isset($id_res);
	$this->id_ch = isset($id_ch);
	$this->id_user = isset($id_user);
	$this->id_regl = isset($id_regl);
	$this->Montant_retirer = isset($Montant_retirer);
	$this->monnaie = isset($monnaie);
	$this->poucentage = isset($poucentage);
	$this->mont_remb = isset($mont_remb);
	$this->date_annule_res = isset($date_annule_res);
	$this->date_annule = isset($date_annule);
	}
	}