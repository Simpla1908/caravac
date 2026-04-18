
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_chambre
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_chambre
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_chambre
	{
	public $id_ch;
	public $num_ch; 
	public $etat_ch; 
	public $tarif_ch; 
	public $monnaie; 
	public $reserve; 
	public $occupe; 
	public $libre; 
	public $capacite_init; 
	public $capacite; 
	public $categorie; 
	public $niveau; 
	public $id_hotel; 
	public $del; 
	
	//Constructor
	public function __construct()
	{
	$this->id_ch = isset($id_ch);
	$this->num_ch = isset($num_ch);
	$this->etat_ch = isset($etat_ch);
	$this->tarif_ch = isset($tarif_ch);
	$this->monnaie = isset($monnaie);
	$this->reserve = isset($reserve);
	$this->occupe = isset($occupe);
	$this->libre = isset($libre);
	$this->capacite_init = isset($capacite_init);
	$this->capacite = isset($capacite);
	$this->categorie = isset($categorie);
	$this->niveau = isset($niveau);
	$this->id_hotel = isset($id_hotel);
	$this->del = isset($del);
	}
	}