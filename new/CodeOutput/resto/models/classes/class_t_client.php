
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_client
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_client
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_client
	{
	public $id_client;
	public $code; 
	public $designation; 
	public $nom_client; 
	public $date_naiss_client; 
	public $sexe_client; 
	public $etat_civil_client; 
	public $nationalite_client; 
	public $provenance_client; 
	public $num_piece_identite_client; 
	public $num_passeport_client; 
	public $adresse_provenance_client; 
	public $email_client; 
	public $telephone_client; 
	public $num_pers_contacter_client; 
	public $statut; 
	public $pseudo_supp; 
	public $type; 
	public $type_cl; 
	public $id_respo; 
	public $id_hotel; 
	
	//Constructor
	public function __construct()
	{
	$this->id_client = isset($id_client);
	$this->code = isset($code);
	$this->designation = isset($designation);
	$this->nom_client = isset($nom_client);
	$this->date_naiss_client = isset($date_naiss_client);
	$this->sexe_client = isset($sexe_client);
	$this->etat_civil_client = isset($etat_civil_client);
	$this->nationalite_client = isset($nationalite_client);
	$this->provenance_client = isset($provenance_client);
	$this->num_piece_identite_client = isset($num_piece_identite_client);
	$this->num_passeport_client = isset($num_passeport_client);
	$this->adresse_provenance_client = isset($adresse_provenance_client);
	$this->email_client = isset($email_client);
	$this->telephone_client = isset($telephone_client);
	$this->num_pers_contacter_client = isset($num_pers_contacter_client);
	$this->statut = isset($statut);
	$this->pseudo_supp = isset($pseudo_supp);
	$this->type = isset($type);
	$this->type_cl = isset($type_cl);
	$this->id_respo = isset($id_respo);
	$this->id_hotel = isset($id_hotel);
	}
	}