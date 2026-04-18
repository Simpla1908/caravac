
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        resemployehoraire_model
	* DATE CREATED:  	30-10-2017
	* FOR TABLE:  		resemployehoraire
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_resemployehoraire.php');
	
	class resemployehoraire_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("resemployehoraire LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("resemployehoraire");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("resemployehoraire");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("resemployehoraire","id=:id",$bind);
	}
	// SELECT ONE
	public function detailsAffectation($id)
	{
            $requete='SELECT * FROM resemployes AS a,resemployehoraire AS b
                        WHERE a.id=b.employe_id AND b.horaire_id=:id ';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id',$id);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
	}
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("resemployehoraire","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE resemployehoraire");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("resemployehoraire","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($employe_id,$horaire_id,$default,$nbrjrs,$nbrjrsmaj,$seq,$seqjrsmaj,$site_id)
	{   
            $values = array(array( 'employe_id'=>$employe_id,'horaire_id'=>$horaire_id,'defaul'=>$default,'nbrjrs'=>$nbrjrs,'nbrjrsmaj'=>$nbrjrsmaj,'seq'=>$seq,'seqjrsmaj'=>$seqjrsmaj,'site_id'=>$site_id));
            HDB::hus()->Hinsert('resemployehoraire', $values);
	}
	
	// UPDATE
	public function Update($employe_id,$horaire_id,$affectation_id,$default,$nbrjrs,$nbrjrsmaj,$seq,$seqjrsmaj,$id)
	{
	$sql = "  employe_id =:employe_id,horaire_id =:horaire_id,affectation_id =:affectation_id,default =:default,nbrjrs =:nbrjrs,nbrjrsmaj =:nbrjrsmaj,seq =:seq,seqjrsmaj =:seqjrsmaj WHERE id = :id ";
	$data = array(':employe_id'=>$employe_id,':horaire_id'=>$horaire_id,':affectation_id'=>$affectation_id,':default'=>$default,':nbrjrs'=>$nbrjrs,':nbrjrsmaj'=>$nbrjrsmaj,':seq'=>$seq,':seqjrsmaj'=>$seqjrsmaj,':id'=>$id);
	HDB::hus()->Hupdate('resemployehoraire',$sql,$data);
	
	}
	
	// INSERT
	public function NbrEmployeByHoraire($idsite)
	{
                $requete='SELECT b.horaire_id,COUNT(b.employe_id) AS nbremp
                        FROM resemployehoraire b
                       WHERE b.site_id=:id
                       GROUP BY b.horaire_id';
                $query = HDB::hus()->prepare($requete);
                $query->BindParam(':id',$idsite);
                try {
                    $query->execute();
                    return $query->fetchAll(PDO::FETCH_OBJ);
                } catch (PDOException $e){
                    die($e->getMessage());
                }
    	}
	
	} // end class
	
	?>
	
	