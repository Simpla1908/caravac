
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_client_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_client
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_client.php');
	
	class t_client_model{
	
	// SELECT ALL
	public function SelectAll_ach($idsite){
            $type="fournisseur";
            $requete='SELECT * FROM  t_client  AS a WHERE a.id_hotel=:id AND a.type=:type ORDER BY a.nom_entreprise';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id',$idsite);
            $query->BindParam(':type',$type);
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
	return HDB::hus()->Hcount("t_client");
	}
	
	// SELECT ONE
	public function SelectOne_ach($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_client","id_client=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_client","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_client");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_client","id_client=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert_ach($nom_client,$adresse_provenance_client,$email_client,$telephone_client,$type,$id_hotel,$nom_entreprise)
	{
	
	$values = array(array( 'nom_client'=>$nom_client,'adresse_provenance_client'=>$adresse_provenance_client,'email_client'=>$email_client,'telephone_client'=>$telephone_client,'type'=>$type,'id_hotel'=>$id_hotel,'nom_entreprise'=>$nom_entreprise ));
	HDB::hus()->Hinsert('t_client', $values);
	}
	
	// UPDATE
	public function Update_ach($nom_client,$adresse_provenance_client,$email_client,$telephone_client,$id_hotel,$nom_entreprise,$id)
	{
	$sql = "  nom_client =:nom_client,adresse_provenance_client =:adresse_provenance_client,email_client=:email_client,telephone_client =:telephone_client,id_hotel =:id_hotel,nom_entreprise =:nom_entreprise WHERE id_client = :id ";
	$data = array(':nom_client'=>$nom_client,':adresse_provenance_client'=>$adresse_provenance_client,':email_client'=>$email_client,':telephone_client'=>$telephone_client,':id_hotel'=>$id_hotel,':nom_entreprise'=>$nom_entreprise,':id'=>$id);
	HDB::hus()->Hupdate('t_client',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	