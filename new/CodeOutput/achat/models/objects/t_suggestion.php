
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_suggestion_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_suggestion
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_suggestion.php');
	
	class t_suggestion_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_suggestion LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_suggestion");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_suggestion");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_suggestion","id_sug=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_suggestion","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_suggestion");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_suggestion","id_sug=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($textsug,$datesug,$statut,$chambre_id,$hotel_id,$id_util)
	{
	
	$values = array(array( 'textsug'=>$textsug,'datesug'=>$datesug,'statut'=>$statut,'chambre_id'=>$chambre_id,'hotel_id'=>$hotel_id,'id_util'=>$id_util ));
	HDB::hus()->Hinsert('t_suggestion', $values);
	}
	
	// UPDATE
	public function Update($textsug,$datesug,$statut,$chambre_id,$hotel_id,$id_util,$id)
	{
	$sql = "  textsug =:textsug,datesug =:datesug,statut =:statut,chambre_id =:chambre_id,hotel_id =:hotel_id,id_util =:id_util WHERE id_sug = :id ";
	$data = array(':textsug'=>$textsug,':datesug'=>$datesug,':statut'=>$statut,':chambre_id'=>$chambre_id,':hotel_id'=>$hotel_id,':id_util'=>$id_util,':id'=>$id);
	HDB::hus()->Hupdate('t_suggestion',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	