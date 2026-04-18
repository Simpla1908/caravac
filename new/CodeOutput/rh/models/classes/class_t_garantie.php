
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_garantie
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_garantie
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class t_garantie
	{
	public $idgaran;
	public $montantcdf; 
	public $montantusd; 
	public $taux; 
	public $dategaran; 
	public $reserv_id; 
	
	//Constructor
	public function __construct()
	{
	$this->idgaran = isset($idgaran);
	$this->montantcdf = isset($montantcdf);
	$this->montantusd = isset($montantusd);
	$this->taux = isset($taux);
	$this->dategaran = isset($dategaran);
	$this->reserv_id = isset($reserv_id);
	}
	}