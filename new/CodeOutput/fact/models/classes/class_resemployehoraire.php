
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        resemployehoraire
	* DATE CREATED:  	30-10-2017
	* FOR TABLE:  		resemployehoraire
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class resemployehoraire
	{
	public $id;
	public $employe_id; 
	public $horaire_id; 
	public $affectation_id; 
	public $default; 
	public $nbrjrs; 
	public $nbrjrsmaj; 
	public $seq; 
	public $seqjrsmaj; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->employe_id = isset($employe_id);
	$this->horaire_id = isset($horaire_id);
	$this->affectation_id = isset($affectation_id);
	$this->default = isset($default);
	$this->nbrjrs = isset($nbrjrs);
	$this->nbrjrsmaj = isset($nbrjrsmaj);
	$this->seq = isset($seq);
	$this->seqjrsmaj = isset($seqjrsmaj);
	}
	}