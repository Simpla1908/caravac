
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_utilisateur
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_utilisateur
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_utilisateur
	{
	public $id_user;
	public $nom_user; 
	public $prenom_user; 
	public $sexe_user; 
	public $telephone_user; 
	public $email_user; 
	public $mdp_user; 
	public $adresse_mail; 
	public $type; 
	public $actif; 
	public $id_hotel; 
	public $company_id; 
	public $id_droit; 
	public $fconnect; 
	public $connect; 
	
	//Constructor
	public function __construct()
	{
	$this->id_user = isset($id_user);
	$this->nom_user = isset($nom_user);
	$this->prenom_user = isset($prenom_user);
	$this->sexe_user = isset($sexe_user);
	$this->telephone_user = isset($telephone_user);
	$this->email_user = isset($email_user);
	$this->mdp_user = isset($mdp_user);
	$this->adresse_mail = isset($adresse_mail);
	$this->type = isset($type);
	$this->actif = isset($actif);
	$this->id_hotel = isset($id_hotel);
	$this->company_id = isset($company_id);
	$this->id_droit = isset($id_droit);
	$this->fconnect = isset($fconnect);
	$this->connect = isset($connect);
	}
	}