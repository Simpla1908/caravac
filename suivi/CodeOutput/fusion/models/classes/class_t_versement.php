
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_versement
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_versement
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_versement
	{
	public $id;
	public $user_vers; 
	public $date_vers; 
	public $montant_vers; 
	public $montantusd; 
	public $monaie_vers; 
	public $taux; 
	public $motif; 
	public $type_vers; 
	public $paie_id; 
	public $id_hotel; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->user_vers = isset($user_vers);
	$this->date_vers = isset($date_vers);
	$this->montant_vers = isset($montant_vers);
	$this->montantusd = isset($montantusd);
	$this->monaie_vers = isset($monaie_vers);
	$this->taux = isset($taux);
	$this->motif = isset($motif);
	$this->type_vers = isset($type_vers);
	$this->paie_id = isset($paie_id);
	$this->id_hotel = isset($id_hotel);
	}
	}