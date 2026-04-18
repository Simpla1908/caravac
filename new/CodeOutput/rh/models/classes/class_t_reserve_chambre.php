
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_reserve_chambre
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_reserve_chambre
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_reserve_chambre
	{
	public $id;
	public $idreserv; 
	public $idchambre; 
	public $id_client; 
	public $id_accomp; 
	public $statut; 
	public $occupe; 
	public $date_occ; 
	public $date_lib; 
	public $annule; 
	public $est_responsable; 
	public $mont_paye_heb; 
	public $mont_paye_resto; 
	public $monnaie; 
	public $tarif_ch; 
	public $nom_accomp; 
	public $checkin; 
	public $checkout; 
	public $idfact; 
	public $id_hotel; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->idreserv = isset($idreserv);
	$this->idchambre = isset($idchambre);
	$this->id_client = isset($id_client);
	$this->id_accomp = isset($id_accomp);
	$this->statut = isset($statut);
	$this->occupe = isset($occupe);
	$this->date_occ = isset($date_occ);
	$this->date_lib = isset($date_lib);
	$this->annule = isset($annule);
	$this->est_responsable = isset($est_responsable);
	$this->mont_paye_heb = isset($mont_paye_heb);
	$this->mont_paye_resto = isset($mont_paye_resto);
	$this->monnaie = isset($monnaie);
	$this->tarif_ch = isset($tarif_ch);
	$this->nom_accomp = isset($nom_accomp);
	$this->checkin = isset($checkin);
	$this->checkout = isset($checkout);
	$this->idfact = isset($idfact);
	$this->id_hotel = isset($id_hotel);
	}
	}