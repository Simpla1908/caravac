
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_garantie_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_garantie
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_garantie.php');
	
	class t_garantie_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_garantie LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_garantie");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_garantie");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_garantie","idgaran=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_garantie","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_garantie");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_garantie","idgaran=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($montantcdf,$montantusd,$taux,$dategaran,$reserv_id)
	{
	
	$values = array(array( 'montantcdf'=>$montantcdf,'montantusd'=>$montantusd,'taux'=>$taux,'dategaran'=>$dategaran,'reserv_id'=>$reserv_id ));
	HDB::hus()->Hinsert('t_garantie', $values);
	}
	
	// UPDATE
	public function Update($montantcdf,$montantusd,$taux,$dategaran,$reserv_id,$id)
	{
	$sql = "  montantcdf =:montantcdf,montantusd =:montantusd,taux =:taux,dategaran =:dategaran,reserv_id =:reserv_id WHERE idgaran = :id ";
	$data = array(':montantcdf'=>$montantcdf,':montantusd'=>$montantusd,':taux'=>$taux,':dategaran'=>$dategaran,':reserv_id'=>$reserv_id,':id'=>$id);
	HDB::hus()->Hupdate('t_garantie',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	