
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        resrubriquecateg_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		resrubriquecateg
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_resrubriquecateg.php');
	
	class resrubriquecateg_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("resrubriquecateg LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("resrubriquecateg");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("resrubriquecateg");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("resrubriquecateg","rubrique_id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("resrubriquecateg","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE resrubriquecateg");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("resrubriquecateg","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($rubrique_id,$categorie_id,$salbase,$nbrenf,$salbrut,$manuel,$pourcentage,$imposable,$valeur,$monnaie,$jrp,$hrsup,$valeur2)
	{
	
	$values = array(array( 'rubrique_id'=>$rubrique_id,'categorie_id'=>$categorie_id,'salbase'=>$salbase,'nbrenf'=>$nbrenf,'salbrut'=>$salbrut,'manuel'=>$manuel,'pourcentage'=>$pourcentage,'imposable'=>$imposable,'valeur'=>$valeur,'monnaie'=>$monnaie,'jrp'=>$jrp,'hrsup'=>$hrsup,'valeur2'=>$valeur2));
	HDB::hus()->Hinsert('resrubriquecateg', $values);
	}
	
	// UPDATE
	public function Update($rubrique_id,$categorie_id,$salbase,$nbrenf,$salbrut,$manuel,$pourcentage,$imposable,$valeur,$jrp,$hrsup,$valeur2,$id)
	{
            $sql = "  rubrique_id =:rubrique_id,categorie_id =:categorie_id,salbase =:salbase,nbrenf =:nbrenf,salbrut =:salbrut,manuel =:manuel,pourcentage =:pourcentage,imposable =:imposable,valeur =:valeur,valeur2=:valeur2 WHERE id = :id ";
            $data = array(':rubrique_id'=>$rubrique_id,':categorie_id'=>$categorie_id,':salbase'=>$salbase,':nbrenf'=>$nbrenf,':salbrut'=>$salbrut,':manuel'=>$manuel,':pourcentage'=>$pourcentage,':imposable'=>$imposable,':valeur'=>$valeur,':jrp'=>$jrp,':hrsup'=>$hrsup,':valeur2'=>$valeur2,':id'=>$id);
            HDB::hus()->Hupdate('resrubriquecateg',$sql,$data);
	
	}
	// DELETE
	public function DeleteByRubriqueID($id)
	{
            $bind = array(":id" =>$id);
            HDB::hus()->Hdelete("resrubriquecateg","rubrique_id=:id",$bind);
	}
	
	} // end class
	
	?>
	
	