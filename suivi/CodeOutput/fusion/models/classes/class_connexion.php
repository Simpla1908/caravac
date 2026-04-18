
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        connexion
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		connexion
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class connexion
	{
	public $id_con;
	public $date_con; 
	public $date_decon; 
	public $id_user; 
	
	//Constructor
	public function __construct()
	{
	$this->id_con = isset($id_con);
	$this->date_con = isset($date_con);
	$this->date_decon = isset($date_decon);
	$this->id_user = isset($id_user);
	}
	}