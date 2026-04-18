
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        bon_commandes
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		bon_commandes
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class bon_commandes
	{
	public $id;
	public $commande_id; 
	public $produit_id; 
	public $nameprod; 
	public $statut; 
	public $quantite; 
	public $user_id; 
	public $hotel_id; 
	public $dte; 
	public $dte_h; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->commande_id = isset($commande_id);
	$this->produit_id = isset($produit_id);
	$this->nameprod = isset($nameprod);
	$this->statut = isset($statut);
	$this->quantite = isset($quantite);
	$this->user_id = isset($user_id);
	$this->hotel_id = isset($hotel_id);
	$this->dte = isset($dte);
	$this->dte_h = isset($dte_h);
	}
	}