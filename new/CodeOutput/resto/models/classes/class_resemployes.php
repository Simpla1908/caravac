
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        resemployes
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		resemployes
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class resemployes
	{
	public $id;
	public $matricule; 
	public $noms; 
	public $sexe; 
	public $etatcivil; 
	public $nationalite; 
	public $lieunais; 
	public $datenais; 
	public $Adresse; 
	public $piece; 
	public $numpiece; 
	public $tel1; 
	public $tel2; 
	public $email; 
	public $nbrenf; 
	public $actif; 
	public $pseudo_supp; 
	public $fonction_id; 
	public $departement_id; 
	public $image; 
	public $id_hotel; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->matricule = isset($matricule);
	$this->noms = isset($noms);
	$this->sexe = isset($sexe);
	$this->etatcivil = isset($etatcivil);
	$this->nationalite = isset($nationalite);
	$this->lieunais = isset($lieunais);
	$this->datenais = isset($datenais);
	$this->Adresse = isset($Adresse);
	$this->piece = isset($piece);
	$this->numpiece = isset($numpiece);
	$this->tel1 = isset($tel1);
	$this->tel2 = isset($tel2);
	$this->email = isset($email);
	$this->nbrenf = isset($nbrenf);
	$this->actif = isset($actif);
	$this->pseudo_supp = isset($pseudo_supp);
	$this->fonction_id = isset($fonction_id);
	$this->departement_id = isset($departement_id);
	$this->image = isset($image);
	$this->id_hotel = isset($id_hotel);
	}
	}