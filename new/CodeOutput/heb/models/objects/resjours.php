
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        resjours_model
	* DATE CREATED:  	20-10-2017
	* FOR TABLE:  		resjours
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_resjours.php');
	
	class resjours_model{
	
	// SELECT ALL
	public function SelectAll()
	{
	return HDB::hus()->Hselect("resjours");	
		}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("resjours");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("resjours","idjrs=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("resjours","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE resjours");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("resjours","idjrs=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($codejrs,$codejrsphp,$libjrs)
	{
	
	$values = array(array( 'codejrs'=>$codejrs,'codejrsphp'=>$codejrsphp,'libjrs'=>$libjrs ));
	HDB::hus()->Hinsert('resjours', $values);
	}
	
	// UPDATE
	public function Update($codejrs,$codejrsphp,$libjrs,$id)
	{
	$sql = "  codejrs =:codejrs,codejrsphp =:codejrsphp,libjrs =:libjrs WHERE idjrs = :id ";
	$data = array(':codejrs'=>$codejrs,':codejrsphp'=>$codejrsphp,':libjrs'=>$libjrs,':id'=>$id);
	HDB::hus()->Hupdate('resjours',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	