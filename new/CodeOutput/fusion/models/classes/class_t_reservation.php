
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_reservation
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_reservation
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_reservation
	{
	public $id_res;
	public $num_reserv; 
	public $garantie; 
	public $num_bc; 
	public $num_occ; 
	public $num_com; 
	public $type; 
	public $tva; 
	public $taux; 
	public $remise; 
	public $majoration; 
	public $mont_nuite; 
	public $mont_total_res; 
	public $mont_par_chambre; 
	public $monnaie; 
	public $nbr_ch; 
	public $etat; 
	public $etat_credit; 
	public $dte; 
	public $date_res; 
	public $date_occ; 
	public $date_lib; 
	public $statut_res; 
	public $statut_occ; 
	public $statut_sorti; 
	public $id_client; 
	public $chambr_id; 
	public $id_hotel; 
	public $dte_a; 
	public $dte_s; 
	public $occ_indirect; 
	public $respo_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id_res = isset($id_res);
	$this->num_reserv = isset($num_reserv);
	$this->garantie = isset($garantie);
	$this->num_bc = isset($num_bc);
	$this->num_occ = isset($num_occ);
	$this->num_com = isset($num_com);
	$this->type = isset($type);
	$this->tva = isset($tva);
	$this->taux = isset($taux);
	$this->remise = isset($remise);
	$this->majoration = isset($majoration);
	$this->mont_nuite = isset($mont_nuite);
	$this->mont_total_res = isset($mont_total_res);
	$this->mont_par_chambre = isset($mont_par_chambre);
	$this->monnaie = isset($monnaie);
	$this->nbr_ch = isset($nbr_ch);
	$this->etat = isset($etat);
	$this->etat_credit = isset($etat_credit);
	$this->dte = isset($dte);
	$this->date_res = isset($date_res);
	$this->date_occ = isset($date_occ);
	$this->date_lib = isset($date_lib);
	$this->statut_res = isset($statut_res);
	$this->statut_occ = isset($statut_occ);
	$this->statut_sorti = isset($statut_sorti);
	$this->id_client = isset($id_client);
	$this->chambr_id = isset($chambr_id);
	$this->id_hotel = isset($id_hotel);
	$this->dte_a = isset($dte_a);
	$this->dte_s = isset($dte_s);
	$this->occ_indirect = isset($occ_indirect);
	$this->respo_id = isset($respo_id);
	}
	}