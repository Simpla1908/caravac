
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        niveau_chambre
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		niveau_chambre
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class niveau_chambre
	{
	public $id_niv_cha;
	public $lib_niv_cha; 
	public $hotel_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id_niv_cha = isset($id_niv_cha);
	$this->lib_niv_cha = isset($lib_niv_cha);
	$this->hotel_id = isset($hotel_id);
	}
	}