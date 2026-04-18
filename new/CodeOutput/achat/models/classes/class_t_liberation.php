
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_liberation
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_liberation
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_liberation
	{
	public $id_lib;
	public $date_lib; 
	public $heure_lib; 
	public $id_ch; 
	public $id_client; 
	public $id_hotel; 
	public $id_res; 
	public $id_reser_cham; 
	public $id_user; 
	public $dte_lib; 
	
	//Constructor
	public function __construct()
	{
	$this->id_lib = isset($id_lib);
	$this->date_lib = isset($date_lib);
	$this->heure_lib = isset($heure_lib);
	$this->id_ch = isset($id_ch);
	$this->id_client = isset($id_client);
	$this->id_hotel = isset($id_hotel);
	$this->id_res = isset($id_res);
	$this->id_reser_cham = isset($id_reser_cham);
	$this->id_user = isset($id_user);
	$this->dte_lib = isset($dte_lib);
	}
	}