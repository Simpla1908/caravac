
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_operation_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_operation
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_operation.php');
	
	class t_operation_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_operation LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_operation");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_operation");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_operation","idoperation=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_operation","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_operation");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_operation","idoperation=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($type,$libelle,$date_bon,$date_heure_bon,$beneficiaire,$provenance,$montantFC,$montantUSD,$numBon,$indice_be,$indice_bs,$numBordereau,$mode_operation,$session_id,$motif_id,$user_vers,$user_id,$hotel_id)
	{
	
	$values = array(array( 'type'=>$type,'libelle'=>$libelle,'date_bon'=>$date_bon,'date_heure_bon'=>$date_heure_bon,'beneficiaire'=>$beneficiaire,'provenance'=>$provenance,'montantFC'=>$montantFC,'montantUSD'=>$montantUSD,'numBon'=>$numBon,'indice_be'=>$indice_be,'indice_bs'=>$indice_bs,'numBordereau'=>$numBordereau,'mode_operation'=>$mode_operation,'session_id'=>$session_id,'motif_id'=>$motif_id,'user_vers'=>$user_vers,'user_id'=>$user_id,'hotel_id'=>$hotel_id ));
	HDB::hus()->Hinsert('t_operation', $values);
	}
	
	// UPDATE
	public function Update($type,$libelle,$date_bon,$date_heure_bon,$beneficiaire,$provenance,$montantFC,$montantUSD,$numBon,$indice_be,$indice_bs,$numBordereau,$mode_operation,$session_id,$motif_id,$user_vers,$user_id,$hotel_id,$id)
	{
	$sql = "  type =:type,libelle =:libelle,date_bon =:date_bon,date_heure_bon =:date_heure_bon,beneficiaire =:beneficiaire,provenance =:provenance,montantFC =:montantFC,montantUSD =:montantUSD,numBon =:numBon,indice_be =:indice_be,indice_bs =:indice_bs,numBordereau =:numBordereau,mode_operation =:mode_operation,session_id =:session_id,motif_id =:motif_id,user_vers =:user_vers,user_id =:user_id,hotel_id =:hotel_id WHERE idoperation = :id ";
	$data = array(':type'=>$type,':libelle'=>$libelle,':date_bon'=>$date_bon,':date_heure_bon'=>$date_heure_bon,':beneficiaire'=>$beneficiaire,':provenance'=>$provenance,':montantFC'=>$montantFC,':montantUSD'=>$montantUSD,':numBon'=>$numBon,':indice_be'=>$indice_be,':indice_bs'=>$indice_bs,':numBordereau'=>$numBordereau,':mode_operation'=>$mode_operation,':session_id'=>$session_id,':motif_id'=>$motif_id,':user_vers'=>$user_vers,':user_id'=>$user_id,':hotel_id'=>$hotel_id,':id'=>$id);
	HDB::hus()->Hupdate('t_operation',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	