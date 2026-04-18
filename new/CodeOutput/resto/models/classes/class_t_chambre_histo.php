
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_chambre_histo
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_chambre_histo
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_chambre_histo
	{
	public $id;
	public $idres_ch; 
	public $idchambre; 
	public $statut; 
	public $date_occ; 
	public $date_lib; 
	public $tarif_ch; 
	public $monnaie; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->idres_ch = isset($idres_ch);
	$this->idchambre = isset($idchambre);
	$this->statut = isset($statut);
	$this->date_occ = isset($date_occ);
	$this->date_lib = isset($date_lib);
	$this->tarif_ch = isset($tarif_ch);
	$this->monnaie = isset($monnaie);
	}
	}