
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        resrubriquesal_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		resrubriquesal
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_resrubriquesal.php');
	
	class resrubriquesal_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("resrubriquesal LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("resrubriquesal");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("resrubriquesal");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("resrubriquesal","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("resrubriquesal","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE resrubriquesal");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("resrubriquesal","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($rubrique_id,$salaire_id,$valeur)
	{
	
	$values = array(array( 'rubrique_id'=>$rubrique_id,'salaire_id'=>$salaire_id,'valeur'=>$valeur ));
	HDB::hus()->Hinsert('resrubriquesal', $values);
	}
	
	// UPDATE
	public function Update($rubrique_id,$salaire_id,$valeur,$id)
	{
	$sql = "  rubrique_id =:rubrique_id,salaire_id =:salaire_id,valeur =:valeur WHERE id = :id ";
	$data = array(':rubrique_id'=>$rubrique_id,':salaire_id'=>$salaire_id,':valeur'=>$valeur,':id'=>$id);
	HDB::hus()->Hupdate('resrubriquesal',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	