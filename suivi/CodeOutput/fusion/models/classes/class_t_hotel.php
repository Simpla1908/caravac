
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_hotel
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_hotel
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_hotel
	{
	public $id_hotel;
	public $nom_hotel; 
	public $adresse_hotel; 
	public $province_hotel; 
	public $ville_hotel; 
	public $etat; 
	public $default_site; 
	public $company_id; 
	public $statut_site; 
	
	//Constructor
	public function __construct()
	{
	$this->id_hotel = isset($id_hotel);
	$this->nom_hotel = isset($nom_hotel);
	$this->adresse_hotel = isset($adresse_hotel);
	$this->province_hotel = isset($province_hotel);
	$this->ville_hotel = isset($ville_hotel);
	$this->etat = isset($etat);
	$this->default_site = isset($default_site);
	$this->company_id = isset($company_id);
	$this->statut_site = isset($statut_site);
	}
	}