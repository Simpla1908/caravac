
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        categorie_chambre
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		categorie_chambre
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class categorie_chambre
	{
	public $id_cat_cha;
	public $lib_cat_cha; 
	public $hotel_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id_cat_cha = isset($id_cat_cha);
	$this->lib_cat_cha = isset($lib_cat_cha);
	$this->hotel_id = isset($hotel_id);
	}
	}