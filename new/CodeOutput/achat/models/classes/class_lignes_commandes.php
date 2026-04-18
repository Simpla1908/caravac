
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        lignes_commandes
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		lignes_commandes
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class lignes_commandes
	{
	public $id;
	public $qte; 
	public $prix; 
	public $repas; 
	public $monnaie; 
	public $dte; 
	public $dte_h; 
	public $commande_id; 
	public $produit_id; 
	public $user_id; 
	public $hotel_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->qte = isset($qte);
	$this->prix = isset($prix);
	$this->repas = isset($repas);
	$this->monnaie = isset($monnaie);
	$this->dte = isset($dte);
	$this->dte_h = isset($dte_h);
	$this->commande_id = isset($commande_id);
	$this->produit_id = isset($produit_id);
	$this->user_id = isset($user_id);
	$this->hotel_id = isset($hotel_id);
	}
	}