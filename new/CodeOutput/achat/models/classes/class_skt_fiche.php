
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        skt_fiche
	* DATE CREATED:  	29-11-2018
	* FOR TABLE:  		skt_fiche
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class skt_fiche
	{
	public $id_fiche;
	public $numero; 
	public $type; 
	public $motif; 
	public $beneficiere; 
	public $nbrprod; 
	public $dte; 
	public $dte_time; 
	public $approuve; 
	public $depot_id; 
	public $user_id; 
	public $hotel_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id_fiche = isset($id_fiche);
	$this->numero = isset($numero);
	$this->type = isset($type);
	$this->motif = isset($motif);
	$this->beneficiere = isset($beneficiere);
	$this->nbrprod = isset($nbrprod);
	$this->dte = isset($dte);
	$this->dte_time = isset($dte_time);
	$this->approuve = isset($approuve);
	$this->depot_id = isset($depot_id);
	$this->user_id = isset($user_id);
	$this->hotel_id = isset($hotel_id);
	}
	}