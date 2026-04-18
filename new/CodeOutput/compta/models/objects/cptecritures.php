
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        cptecritures_model
	* DATE CREATED:  	18-04-2019
	* FOR TABLE:  		cptecritures
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_cptecritures.php');
	
	class cptecritures_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("cptecritures LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("cptecritures");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("cptecritures");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("cptecritures","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("cptecritures","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE cptecritures");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("cptecritures","id=:id",$bind);
	//send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($dte,$dteaff,$dtetime,$libelle,$reference,$journal_id,$psedo,$exercice_id,$user_id,$site_id,$devise)
	{
	
	$values = array(array( 'dte'=>$dte,'dteaff'=>$dteaff,'dtetime'=>$dtetime,'libelle'=>$libelle,'reference'=>$reference,'journal_id'=>$journal_id,'psedo'=>$psedo,'exercice_id'=>$exercice_id,'user_id'=>$user_id,'site_id'=>$site_id,'devise'=>$devise));
	HDB::hus()->Hinsert('cptecritures', $values);
    $id= HDB::hus()->lastInsertId();
    return $id;
	}
	
	// UPDATE
	public function Update($dte,$dtetime,$libelle,$reference,$journal_id,$psedo,$exercice_id,$user_id,$site_id,$devise,$id)
	{
	$sql = "dte =:dte,dtetime =:dtetime,libelle =:libelle,reference =:reference,journal_id =:journal_id,psedo =:psedo,exercice_id =:exercice_id,user_id =:user_id,site_id =:site_id,devise=:devise WHERE id = :id ";
	$data = array(':dte'=>$dte,':dtetime'=>$dtetime,':libelle'=>$libelle,':reference'=>$reference,':journal_id'=>$journal_id,':psedo'=>$psedo,':exercice_id'=>$exercice_id,':user_id'=>$user_id,':site_id'=>$site_id,':devise'=>$devise,':id'=>$id);
	HDB::hus()->Hupdate('cptecritures',$sql,$data);
	
	}
    public function Updatetot($total,$id)
	{
	$sql = "  total =:total WHERE id = :id ";
	$data = array(':total'=>$total,':id'=>$id);
	HDB::hus()->Hupdate('cptecritures',$sql,$data);
	
	}
	 public function Updatepsedo($psedo,$id)
	{
	$sql = "  psedo =:psedo WHERE id = :id ";
	$data = array(':psedo'=>$psedo,':id'=>$id);
	HDB::hus()->Hupdate('cptecritures',$sql,$data);
	
	}
	 public function DeleteDetailsEcriture($ecriture_id)
	{
	$query = HDB::hus()->prepare("DELETE FROM cptdetailsecritures WHERE ecriture_id=:ecriture_id");
    $query->BindParam(':ecriture_id', $ecriture_id);
    $query->execute();
	
	}
	public function DeleteRapportJournaux($ecriture_id)
	{
	$query = HDB::hus()->prepare("DELETE FROM cptrapportjournal WHERE ecriture_id=:ecriture_id");
    $query->BindParam(':ecriture_id', $ecriture_id);
    $query->execute();
	
	}
	 
	public function lettrer($lettrer,$id)
	{
	$sql = "  lettrer =:lettrer WHERE id = :id ";
	$data = array(':lettrer'=>$lettrer,':id'=>$id);
	HDB::hus()->Hupdate('cptecritures',$sql,$data);
	
	}


	} // end class
	
	?>
	
	