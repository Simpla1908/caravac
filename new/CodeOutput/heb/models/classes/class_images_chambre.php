
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        images_chambre
	* DATE CREATED:  	25-11-2019
	* FOR TABLE:  		images_chambre
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class images_chambre
	{
	public $id_img;
	public $libelle; 
	public $visible; 
	public $slide; 
	public $hotel_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id_img = isset($id_img);
	$this->libelle = isset($libelle);
	$this->visible = isset($visible);
	$this->slide = isset($slide);
	$this->hotel_id = isset($hotel_id);
	}
	}