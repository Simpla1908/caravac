
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_company
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_company
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_company
	{
	public $id_c;
	public $nom_c; 
	public $etat; 
	public $adresse_c; 
	public $logo; 
	public $idnat; 
	public $rccm; 
	public $mail_company; 
	public $ville; 
	public $phone; 
	public $num_impot; 
	public $cb; 
	public $mention; 
	
	//Constructor
	public function __construct()
	{
	$this->id_c = isset($id_c);
	$this->nom_c = isset($nom_c);
	$this->etat = isset($etat);
	$this->adresse_c = isset($adresse_c);
	$this->logo = isset($logo);
	$this->idnat = isset($idnat);
	$this->rccm = isset($rccm);
	$this->mail_company = isset($mail_company);
	$this->ville = isset($ville);
	$this->phone = isset($phone);
	$this->num_impot = isset($num_impot);
	$this->cb = isset($cb);
	$this->mention = isset($mention);
	}
	}