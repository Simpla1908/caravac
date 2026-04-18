
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_reglement
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_reglement
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_reglement
	{
	public $id_regl;
	public $numero; 
	public $montant_dollar; 
	public $montant_fc; 
	public $reste; 
	public $id_mode_regl; 
	public $date_regl; 
	public $dte; 
	public $rejete; 
	public $id_fact; 
	public $id_monnaie; 
	public $id_user; 
	public $id_hotel; 
	
	//Constructor
	public function __construct()
	{
	$this->id_regl = isset($id_regl);
	$this->numero = isset($numero);
	$this->montant_dollar = isset($montant_dollar);
	$this->montant_fc = isset($montant_fc);
	$this->reste = isset($reste);
	$this->id_mode_regl = isset($id_mode_regl);
	$this->date_regl = isset($date_regl);
	$this->dte = isset($dte);
	$this->rejete = isset($rejete);
	$this->id_fact = isset($id_fact);
	$this->id_monnaie = isset($id_monnaie);
	$this->id_user = isset($id_user);
	$this->id_hotel = isset($id_hotel);
	}
	}