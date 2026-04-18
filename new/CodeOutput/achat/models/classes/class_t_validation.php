
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_validation
	* DATE CREATED:  	29-11-2018
	* FOR TABLE:  		t_validation
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_validation
	{
	public $id_validation;
	public $qte_envoye; 
	public $qte_verif; 
	public $motif_id; 
	public $produit_id; 
	public $fiche_id; 
	public $hotel_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id_validation = isset($id_validation);
	$this->qte_envoye = isset($qte_envoye);
	$this->qte_verif = isset($qte_verif);
	$this->motif_id = isset($motif_id);
	$this->produit_id = isset($produit_id);
	$this->fiche_id = isset($fiche_id);
	$this->hotel_id = isset($hotel_id);
	}
	}