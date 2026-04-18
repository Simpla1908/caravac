
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        ach_produits_livres
	* DATE CREATED:  	09-07-2018
	* FOR TABLE:  		ach_produits_livres
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class ach_produits_livres
	{
	public $id_produit_liv;
	public $quantite_cmd; 
	public $quantite_liv; 
	public $observation; 
	public $produit_id; 
	public $livraison_id; 
	public $user_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id_produit_liv = isset($id_produit_liv);
	$this->quantite_cmd = isset($quantite_cmd);
	$this->quantite_liv = isset($quantite_liv);
	$this->observation = isset($observation);
	$this->produit_id = isset($produit_id);
	$this->livraison_id = isset($livraison_id);
	$this->user_id = isset($user_id);
	}
	}