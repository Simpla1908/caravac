
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_histo_heberge
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_histo_heberge
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_histo_heberge
	{
	public $id;
	public $idreserv; 
	public $idchambre; 
	public $statut; 
	public $date_occ; 
	public $date_lib; 
	public $monnaie; 
	public $tarif_ch; 
	public $idfact; 
	public $id_hotel; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->idreserv = isset($idreserv);
	$this->idchambre = isset($idchambre);
	$this->statut = isset($statut);
	$this->date_occ = isset($date_occ);
	$this->date_lib = isset($date_lib);
	$this->monnaie = isset($monnaie);
	$this->tarif_ch = isset($tarif_ch);
	$this->idfact = isset($idfact);
	$this->id_hotel = isset($id_hotel);
	}
	}