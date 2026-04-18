
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        details_categorie
	* DATE CREATED:  	25-11-2019
	* FOR TABLE:  		details_categorie
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class details_categorie
	{
	public $id_detail_cat;
	public $categorie_id; 
	public $details_ch_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id_detail_cat = isset($id_detail_cat);
	$this->categorie_id = isset($categorie_id);
	$this->details_ch_id = isset($details_ch_id);
	}
	}