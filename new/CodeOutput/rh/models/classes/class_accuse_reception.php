
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        accuse_reception
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		accuse_reception
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* IMPORTANT:		
	* 'post()' is a defined function located @ libries/funtions.php
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	//Begin class
	
	class accuse_reception
	{
	public $id;
	public $email; 
	public $nom; 
	public $sujet; 
	public $message; 
	public $statut; 
	public $date; 
	
	//Constructor
	public function __construct()
	{
	$this->id = isset($id);
	$this->email = isset($email);
	$this->nom = isset($nom);
	$this->sujet = isset($sujet);
	$this->message = isset($message);
	$this->statut = isset($statut);
	$this->date = isset($date);
	}
	}