
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        ach_livraison
	* DATE CREATED:  	09-07-2018
	* FOR TABLE:  		ach_livraison
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class ach_livraison
	{
	public $id_liv;
	public $numBon_liv; 
	public $numBon_cmd; 
	public $bcommande_id; 
	public $fournisseur_id; 
	public $user_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id_liv = isset($id_liv);
	$this->numBon_liv = isset($numBon_liv);
	$this->numBon_cmd = isset($numBon_cmd);
	$this->bcommande_id = isset($bcommande_id);
	$this->fournisseur_id = isset($fournisseur_id);
	$this->user_id = isset($user_id);
	}
	}