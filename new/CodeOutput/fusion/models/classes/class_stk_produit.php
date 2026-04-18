
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        stk_produit
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		stk_produit
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class stk_produit
	{
	public $idprod;
	public $code; 
	public $designation; 
	public $qte_min; 
	public $qte_initial; 
	public $qte_dispo; 
	public $pa; 
	public $pv; 
	public $monnaie; 
	public $repas; 
	public $statut; 
	public $pseudo_supp; 
	public $unite; 
	public $famille_id; 
	public $hotel_id; 
	
	//Constructor
	public function __construct()
	{
	$this->idprod = isset($idprod);
	$this->code = isset($code);
	$this->designation = isset($designation);
	$this->qte_min = isset($qte_min);
	$this->qte_initial = isset($qte_initial);
	$this->qte_dispo = isset($qte_dispo);
	$this->pa = isset($pa);
	$this->pv = isset($pv);
	$this->monnaie = isset($monnaie);
	$this->repas = isset($repas);
	$this->statut = isset($statut);
	$this->pseudo_supp = isset($pseudo_supp);
	$this->unite = isset($unite);
	$this->famille_id = isset($famille_id);
	$this->hotel_id = isset($hotel_id);
	}
	}