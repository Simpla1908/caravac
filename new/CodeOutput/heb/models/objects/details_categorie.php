
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        details_categorie_model
	* DATE CREATED:  	25-11-2019
	* FOR TABLE:  		details_categorie
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_details_categorie.php');
	
	class details_categorie_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("details_categorie LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("details_categorie");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("details_categorie");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("details_categorie","id_detail_cat=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("details_categorie","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE details_categorie");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("details_categorie","id_detail_cat=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($categorie_id,$details_ch_id)
	{
	
	$values = array(array( 'categorie_id'=>$categorie_id,'details_ch_id'=>$details_ch_id ));
	HDB::hus()->Hinsert('details_categorie', $values);
	}
	
	// UPDATE
	public function Update($categorie_id,$details_ch_id,$id)
	{
	$sql = "  categorie_id =:categorie_id,details_ch_id =:details_ch_id WHERE id_detail_cat = :id ";
	$data = array(':categorie_id'=>$categorie_id,':details_ch_id'=>$details_ch_id,':id'=>$id);
	HDB::hus()->Hupdate('details_categorie',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	