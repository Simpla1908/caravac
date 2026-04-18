
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        images_chambre_model
	* DATE CREATED:  	25-11-2019
	* FOR TABLE:  		images_chambre
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_images_chambre.php');
	
	class images_chambre_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("images_chambre LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("images_chambre");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("images_chambre");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("images_chambre","id_img=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("images_chambre","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE images_chambre");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("images_chambre","id_img=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($libelle,$visible,$slide,$hotel_id)
	{
	
	$values = array(array( 'libelle'=>$libelle,'visible'=>$visible,'slide'=>$slide,'hotel_id'=>$hotel_id ));
	HDB::hus()->Hinsert('images_chambre', $values);
	}
	
	// UPDATE
	public function Update($libelle,$visible,$slide,$hotel_id,$id)
	{
	$sql = "  libelle =:libelle,visible =:visible,slide =:slide,hotel_id =:hotel_id WHERE id_img = :id ";
	$data = array(':libelle'=>$libelle,':visible'=>$visible,':slide'=>$slide,':hotel_id'=>$hotel_id,':id'=>$id);
	HDB::hus()->Hupdate('images_chambre',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	