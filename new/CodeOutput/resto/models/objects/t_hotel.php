
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_hotel_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_hotel
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_hotel.php');
	
	class t_hotel_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_hotel LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_hotel");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_hotel");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_hotel","id_hotel=:id",$bind);
	}
	// SELECT ONE
	public function Infos($id)
	{
//            $requete='SELECT *,c.logo AS logo1 FROM t_company AS a,t_hotel AS b,resconfig AS c
//                        WHERE a.id_c=b.company_id AND b.id_hotel=c.site_id  AND b.id_hotel=:id';
//            $query = HDB::hus()->prepare($requete);
//            $query->BindParam(':id',$id);
//            try {
//                $query->execute();
//                return $query->fetch(PDO::FETCH_OBJ);
//            } catch (PDOException $e) {
//                die($e->getMessage());
//            }
            $requete='SELECT *,c.logo AS lg FROM t_hotel AS b,resconfig AS c
                        WHERE  b.id_hotel=c.site_id 
                        AND b.id_hotel=:id';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id',$id);
            try{
                $query->execute();
                return $query->fetch(PDO::FETCH_OBJ);
            }catch (PDOException $e){
                die($e->getMessage());
            }
	}
        public function Infos2($id)
	{
            $requete='SELECT b.mail,b.phone,b.idnat,b.rccm ,a.* FROM resconfig AS a,t_hotel AS b WHERE b.id_hotel=a.site_id AND site_id=:id';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id',$id);
            try {
                $query->execute();
                return $query->fetch(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
	}
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_hotel","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_hotel");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_hotel","id_hotel=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($nom_hotel,$adresse_hotel,$province_hotel,$ville_hotel,$etat,$default_site,$company_id,$statut_site)
	{
	
	$values = array(array( 'nom_hotel'=>$nom_hotel,'adresse_hotel'=>$adresse_hotel,'province_hotel'=>$province_hotel,'ville_hotel'=>$ville_hotel,'etat'=>$etat,'default_site'=>$default_site,'company_id'=>$company_id,'statut_site'=>$statut_site ));
	HDB::hus()->Hinsert('t_hotel', $values);
	}
	
	// UPDATE
	public function Update($nom_hotel,$adresse_hotel,$province_hotel,$ville_hotel,$etat,$default_site,$company_id,$statut_site,$id)
	{
	$sql = "  nom_hotel =:nom_hotel,adresse_hotel =:adresse_hotel,province_hotel =:province_hotel,ville_hotel =:ville_hotel,etat =:etat,default_site =:default_site,company_id =:company_id,statut_site =:statut_site WHERE id_hotel = :id ";
	$data = array(':nom_hotel'=>$nom_hotel,':adresse_hotel'=>$adresse_hotel,':province_hotel'=>$province_hotel,':ville_hotel'=>$ville_hotel,':etat'=>$etat,':default_site'=>$default_site,':company_id'=>$company_id,':statut_site'=>$statut_site,':id'=>$id);
	HDB::hus()->Hupdate('t_hotel',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	