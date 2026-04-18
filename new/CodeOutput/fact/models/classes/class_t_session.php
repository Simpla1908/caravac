
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_session
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_session
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_session
	{
	public $idsession;
	public $date_ouverture; 
	public $date_fermeture; 
	public $statut; 
	public $dte_heure_ouvert; 
	public $dte_heure_ferm; 
	public $user_id; 
	public $caisse_id; 
	public $hotel_id; 
	
	//Constructor
	public function __construct()
	{
	$this->idsession = isset($idsession);
	$this->date_ouverture = isset($date_ouverture);
	$this->date_fermeture = isset($date_fermeture);
	$this->statut = isset($statut);
	$this->dte_heure_ouvert = isset($dte_heure_ouvert);
	$this->dte_heure_ferm = isset($dte_heure_ferm);
	$this->user_id = isset($user_id);
	$this->caisse_id = isset($caisse_id);
	$this->hotel_id = isset($hotel_id);
	}
	}