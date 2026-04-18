
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_validation_model
	* DATE CREATED:  	29-11-2018
	* FOR TABLE:  		t_validation
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_validation.php');
	
	class t_validation_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_validation LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_validation");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_validation");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_validation","id_validation=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_validation","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_validation");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_validation","id_validation=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($qte_envoye,$qte_verif,$motif_id,$produit_id,$fiche_id,$hotel_id)
	{
	
	$values = array(array( 'qte_envoye'=>$qte_envoye,'qte_verif'=>$qte_verif,'motif_id'=>$motif_id,'produit_id'=>$produit_id,'fiche_id'=>$fiche_id,'hotel_id'=>$hotel_id ));
	HDB::hus()->Hinsert('t_validation', $values);
	}
	
	// UPDATE
	public function Update($qte_envoye,$qte_verif,$motif_id,$produit_id,$fiche_id,$hotel_id,$id)
	{
	$sql = "  qte_envoye =:qte_envoye,qte_verif =:qte_verif,motif_id =:motif_id,produit_id =:produit_id,fiche_id =:fiche_id,hotel_id =:hotel_id WHERE id_validation = :id ";
	$data = array(':qte_envoye'=>$qte_envoye,':qte_verif'=>$qte_verif,':motif_id'=>$motif_id,':produit_id'=>$produit_id,':fiche_id'=>$fiche_id,':hotel_id'=>$hotel_id,':id'=>$id);
	HDB::hus()->Hupdate('t_validation',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	