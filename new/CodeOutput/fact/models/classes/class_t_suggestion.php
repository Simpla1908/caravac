
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_suggestion
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_suggestion
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_suggestion
	{
	public $id_sug;
	public $textsug; 
	public $datesug; 
	public $statut; 
	public $chambre_id; 
	public $hotel_id; 
	public $id_util; 
	
	//Constructor
	public function __construct()
	{
	$this->id_sug = isset($id_sug);
	$this->textsug = isset($textsug);
	$this->datesug = isset($datesug);
	$this->statut = isset($statut);
	$this->chambre_id = isset($chambre_id);
	$this->hotel_id = isset($hotel_id);
	$this->id_util = isset($id_util);
	}
	}