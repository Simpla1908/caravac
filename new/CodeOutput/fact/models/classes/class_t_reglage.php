
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_reglage
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_reglage
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_reglage
	{
	public $id_regl;
	public $remise; 
	public $majoration; 
	public $date_regl; 
	public $dte_h; 
	public $temps_regl; 
	public $time_checkin; 
	public $m_insert; 
	public $m_affiche; 
	public $tauxdollar; 
	public $taux_op; 
	public $tva; 
	public $pourcentage_defaut; 
	public $pourcentage_24_heure; 
	public $pourcentage_48_heure; 
	public $pourcentage_72_heure; 
	public $pourcentage_sup_72_heure; 
	public $type_annul; 
	public $fcon_heberge; 
	public $user_id; 
	public $id_hotel; 
	public $company_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id_regl = isset($id_regl);
	$this->remise = isset($remise);
	$this->majoration = isset($majoration);
	$this->date_regl = isset($date_regl);
	$this->dte_h = isset($dte_h);
	$this->temps_regl = isset($temps_regl);
	$this->time_checkin = isset($time_checkin);
	$this->m_insert = isset($m_insert);
	$this->m_affiche = isset($m_affiche);
	$this->tauxdollar = isset($tauxdollar);
	$this->taux_op = isset($taux_op);
	$this->tva = isset($tva);
	$this->pourcentage_defaut = isset($pourcentage_defaut);
	$this->pourcentage_24_heure = isset($pourcentage_24_heure);
	$this->pourcentage_48_heure = isset($pourcentage_48_heure);
	$this->pourcentage_72_heure = isset($pourcentage_72_heure);
	$this->pourcentage_sup_72_heure = isset($pourcentage_sup_72_heure);
	$this->type_annul = isset($type_annul);
	$this->fcon_heberge = isset($fcon_heberge);
	$this->user_id = isset($user_id);
	$this->id_hotel = isset($id_hotel);
	$this->company_id = isset($company_id);
	}
	}