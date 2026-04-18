
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        stk_report
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		stk_report
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class stk_report
	{
	public $id;
	public $qte_initial_save; 
	public $dte_report; 
	public $dte_report_time; 
	public $produit_id; 
	public $idmvt; 
	public $hotel_id; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->qte_initial_save = isset($qte_initial_save);
	$this->dte_report = isset($dte_report);
	$this->dte_report_time = isset($dte_report_time);
	$this->produit_id = isset($produit_id);
	$this->idmvt = isset($idmvt);
	$this->hotel_id = isset($hotel_id);
	}
	}