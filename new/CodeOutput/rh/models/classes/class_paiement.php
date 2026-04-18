
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        paiement
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		paiement
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class paiement
	{
	public $idpaie;
	public $montant; 
	public $montantusd; 
	public $montantcdf; 
	public $taux; 
	public $rendu; 
	public $remise; 
	public $justification; 
	public $id_mode_regl; 
	public $id_monnaie; 
	public $regl_id; 
	public $site_id; 
	public $company_id; 
	
	//Constructor
	public function __construct()
	{
	$this->idpaie = isset($idpaie);
	$this->montant = isset($montant);
	$this->montantusd = isset($montantusd);
	$this->montantcdf = isset($montantcdf);
	$this->taux = isset($taux);
	$this->rendu = isset($rendu);
	$this->remise = isset($remise);
	$this->justification = isset($justification);
	$this->id_mode_regl = isset($id_mode_regl);
	$this->id_monnaie = isset($id_monnaie);
	$this->regl_id = isset($regl_id);
	$this->site_id = isset($site_id);
	$this->company_id = isset($company_id);
	}
	}