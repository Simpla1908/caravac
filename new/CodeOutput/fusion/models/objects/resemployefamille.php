
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        resemployefamille_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		resemployefamille
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_resemployefamille.php');
	
	class resemployefamille_model{
		// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("resemployefamille LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("resemployefamille");	
	}
	}
	
	// SELECT ALL
	public function SelectAllMemEmply($employe_id)
	{
	$requete='SELECT * FROM  resemployefamille WHERE employe_id=:id ORDER BY type ASC';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id',$employe_id);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            } 
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("resemployefamille");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("resemployefamille","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("resemployefamille","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE resemployefamille");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("resemployefamille","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($nom,$datenais,$type,$employe_id)
	{
            $values = array(array('nom'=>$nom,'datenais'=>$datenais,'type'=>$type,'employe_id'=>$employe_id ));
            HDB::hus()->Hinsert('resemployefamille', $values);
	}
	// INSERT
	public function Insert2($nom,$datenais,$type,$employe_id)
	{
	$newupload = new UploadControl;
	$uploadname=$newupload->ImageUplaodResize('image',THUMB_IMAGE_WIDTH,BIG_IMAGE_WIDTH,UPLOAD_PATH,THUMB_PATH,90);
	if($uploadname==''){
	$values = array(array( 'nom'=>$nom,'datenais'=>$datenais,'type'=>$type,'employe_id'=>$employe_id ));
	}else{
	$values = array(array( 'image'=>$uploadname,'nom'=>$nom,'datenais'=>$datenais,'type'=>$type,'employe_id'=>$employe_id ));
	}
	HDB::hus()->Hinsert('resemployefamille', $values);
	}
	// UPDATE
	public function Update($nom,$datenais,$type,$employe_id,$id)
	{
	$newupload = new UploadControl;
	$uploadname=$newupload->ImageUplaodResize('image',THUMB_IMAGE_WIDTH,BIG_IMAGE_WIDTH,UPLOAD_PATH,THUMB_PATH,90);
	if($uploadname==''){
	$sql = "  nom =:nom,datenais =:datenais,type =:type,employe_id =:employe_id WHERE id = :id ";
	$data = array(':nom'=>$nom,':datenais'=>$datenais,':type'=>$type,':employe_id'=>$employe_id,':id'=>$id);
	}else{
	$sql = "  image=:image,nom =:nom,datenais =:datenais,type =:type,employe_id =:employe_id WHERE id = :id ";
	$data = array(':image'=>$uploadname,':nom'=>$nom,':datenais'=>$datenais,':type'=>$type,':employe_id'=>$employe_id,':id'=>$id);
	}
	HDB::hus()->Hupdate('resemployefamille',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	