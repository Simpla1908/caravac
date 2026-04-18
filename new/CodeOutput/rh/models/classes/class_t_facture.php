
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_facture
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_facture
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_facture
	{
	public $id_fact;
	public $num_fact; 
	public $type; 
	public $i_souscription; 
	public $etat; 
	public $etat_cmd; 
	public $date_echeance_old; 
	public $date_edition; 
	public $dte_blocage; 
	public $date_echeance; 
	public $date_desactivation; 
	public $montant_total; 
	public $mont_tva; 
	public $mont_ttc; 
	public $mont_ttc_remise; 
	public $taux; 
	public $taux_prix; 
	public $tva; 
	public $monnaie; 
	public $remise; 
	public $majoration; 
	public $justification; 
	public $id_res; 
	public $res_ch_id; 
	public $modulecompagny; 
	public $id_hotel; 
	public $company_id; 
	public $id_user; 
	public $id_client; 
	public $fact1; 
	
	//Constructor
	public function __construct()
	{
	$this->id_fact = isset($id_fact);
	$this->num_fact = isset($num_fact);
	$this->type = isset($type);
	$this->i_souscription = isset($i_souscription);
	$this->etat = isset($etat);
	$this->etat_cmd = isset($etat_cmd);
	$this->date_echeance_old = isset($date_echeance_old);
	$this->date_edition = isset($date_edition);
	$this->dte_blocage = isset($dte_blocage);
	$this->date_echeance = isset($date_echeance);
	$this->date_desactivation = isset($date_desactivation);
	$this->montant_total = isset($montant_total);
	$this->mont_tva = isset($mont_tva);
	$this->mont_ttc = isset($mont_ttc);
	$this->mont_ttc_remise = isset($mont_ttc_remise);
	$this->taux = isset($taux);
	$this->taux_prix = isset($taux_prix);
	$this->tva = isset($tva);
	$this->monnaie = isset($monnaie);
	$this->remise = isset($remise);
	$this->majoration = isset($majoration);
	$this->justification = isset($justification);
	$this->id_res = isset($id_res);
	$this->res_ch_id = isset($res_ch_id);
	$this->modulecompagny = isset($modulecompagny);
	$this->id_hotel = isset($id_hotel);
	$this->company_id = isset($company_id);
	$this->id_user = isset($id_user);
	$this->id_client = isset($id_client);
	$this->fact1 = isset($fact1);
	}
	}