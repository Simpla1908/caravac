
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        ressanctionempl_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		ressanctionempl
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_ressanctionempl.php');
	
	class ressanctionempl_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("ressanctionempl LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("ressanctionempl");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("ressanctionempl");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("ressanctionempl","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("ressanctionempl","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE ressanctionempl");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("ressanctionempl","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($ref,$employe_id,$sanction_id,$dte,$dte1,$dte2,$nbre,$retenu,$comment,$doc,$site_id)
	{
	
	$values = array(array('ref'=>$ref,'employe_id'=>$employe_id,'sanction_id'=>$sanction_id,'dte'=>$dte,'dte1'=>$dte1,'dte2'=>$dte2,'nbre'=>$nbre,'retenu'=>$retenu,'comment'=>$comment,'doc'=>$doc,'site_id'=>$site_id));
	HDB::hus()->Hinsert('ressanctionempl', $values);
	return HDB::hus()->lastInsertId();
	}
	
	// UPDATE
	public function Update($employe_id,$sanction_id,$dte1,$dte2,$nbre,$id)
	{
	$sql = "  employe_id =:employe_id,sanction_id =:sanction_id,dte1 =:dte1,dte2 =:dte2,nbre =:nbre WHERE id = :id ";
	$data = array(':employe_id'=>$employe_id,':sanction_id'=>$sanction_id,':dte1'=>$dte1,':dte2'=>$dte2,':nbre'=>$nbre,':id'=>$id);
	HDB::hus()->Hupdate('ressanctionempl',$sql,$data);
	
	}
	
	// preparation insertion sanction
	public function preparinsertsanct($employe_id)
	{
	//verification s'il existe employe_id dans ressanction_employe
	$requete = 'SELECT * FROM  ressanctionempl WHERE employe_id=:employe_id';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':employe_id', $employe_id);
    try {
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
	//fin verification
	if (count($result) > 0) {
		$encours=0;
        $query = HDB::hus()->prepare("UPDATE ressanctionempl SET encours=:encours WHERE employe_id=:employe_id");
        $query->BindParam(':encours', $encours);
        $query->BindParam(':employe_id', $employe_id);
        $query->execute();
    }
	
	}



	} // end class
	
	?>
	
	