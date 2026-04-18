
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_chambre_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_chambre
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_chambre.php');
	
	class t_chambre_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_chambre LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_chambre");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_chambre");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_chambre","id_ch=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_chambre","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_chambre");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_chambre","id_ch=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($num_ch,$etat_ch,$tarif_ch,$monnaie,$reserve,$occupe,$libre,$capacite_init,$capacite,$categorie,$niveau,$id_hotel,$del)
	{
	
	$values = array(array( 'num_ch'=>$num_ch,'etat_ch'=>$etat_ch,'tarif_ch'=>$tarif_ch,'monnaie'=>$monnaie,'reserve'=>$reserve,'occupe'=>$occupe,'libre'=>$libre,'capacite_init'=>$capacite_init,'capacite'=>$capacite,'categorie'=>$categorie,'niveau'=>$niveau,'id_hotel'=>$id_hotel,'del'=>$del ));
	HDB::hus()->Hinsert('t_chambre', $values);
	}
	
	// UPDATE
	public function Update($num_ch,$etat_ch,$tarif_ch,$monnaie,$reserve,$occupe,$libre,$capacite_init,$capacite,$categorie,$niveau,$id_hotel,$del,$id)
	{
	$sql = "  num_ch =:num_ch,etat_ch =:etat_ch,tarif_ch =:tarif_ch,monnaie =:monnaie,reserve =:reserve,occupe =:occupe,libre =:libre,capacite_init =:capacite_init,capacite =:capacite,categorie =:categorie,niveau =:niveau,id_hotel =:id_hotel,del =:del WHERE id_ch = :id ";
	$data = array(':num_ch'=>$num_ch,':etat_ch'=>$etat_ch,':tarif_ch'=>$tarif_ch,':monnaie'=>$monnaie,':reserve'=>$reserve,':occupe'=>$occupe,':libre'=>$libre,':capacite_init'=>$capacite_init,':capacite'=>$capacite,':categorie'=>$categorie,':niveau'=>$niveau,':id_hotel'=>$id_hotel,':del'=>$del,':id'=>$id);
	HDB::hus()->Hupdate('t_chambre',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	