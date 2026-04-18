
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        stk__mouvement
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		stk__mouvement
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class stk__mouvement
	{
	public $idmvt;
	public $indice_bs; 
	public $type; 
	public $motif; 
	public $num_bon; 
	public $qte_entree; 
	public $qte_sortie; 
	public $dte_appro; 
	public $dte_appro_heure; 
	public $depot; 
	public $produit_id; 
	public $user_id; 
	public $hotel_id; 
	
	//Constructor
	public function __construct()
	{
	$this->idmvt = isset($idmvt);
	$this->indice_bs = isset($indice_bs);
	$this->type = isset($type);
	$this->motif = isset($motif);
	$this->num_bon = isset($num_bon);
	$this->qte_entree = isset($qte_entree);
	$this->qte_sortie = isset($qte_sortie);
	$this->dte_appro = isset($dte_appro);
	$this->dte_appro_heure = isset($dte_appro_heure);
	$this->depot = isset($depot);
	$this->produit_id = isset($produit_id);
	$this->user_id = isset($user_id);
	$this->hotel_id = isset($hotel_id);
	}
	}