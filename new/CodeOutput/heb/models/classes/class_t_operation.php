
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_operation
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_operation
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_operation
	{
	public $idoperation;
	public $type; 
	public $libelle; 
	public $date_bon; 
	public $date_heure_bon; 
	public $beneficiaire; 
	public $provenance; 
	public $montantFC; 
	public $montantUSD; 
	public $numBon; 
	public $indice_be; 
	public $indice_bs; 
	public $numBordereau; 
	public $mode_operation; 
	public $session_id; 
	public $motif_id; 
	public $user_vers; 
	public $user_id; 
	public $hotel_id; 
	
	//Constructor
	public function __construct()
	{
	$this->idoperation = isset($idoperation);
	$this->type = isset($type);
	$this->libelle = isset($libelle);
	$this->date_bon = isset($date_bon);
	$this->date_heure_bon = isset($date_heure_bon);
	$this->beneficiaire = isset($beneficiaire);
	$this->provenance = isset($provenance);
	$this->montantFC = isset($montantFC);
	$this->montantUSD = isset($montantUSD);
	$this->numBon = isset($numBon);
	$this->indice_be = isset($indice_be);
	$this->indice_bs = isset($indice_bs);
	$this->numBordereau = isset($numBordereau);
	$this->mode_operation = isset($mode_operation);
	$this->session_id = isset($session_id);
	$this->motif_id = isset($motif_id);
	$this->user_vers = isset($user_vers);
	$this->user_id = isset($user_id);
	$this->hotel_id = isset($hotel_id);
	}
	}