
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
	public function SelectAll($idsite)
	{
         $requete="SELECT * FROM t_client WHERE id_hotel=:id AND type='client' AND pseudo_supp=0 ORDER BY nom_client";
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':id',$idsite);
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
	public function SelectOne($id)
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
//	$bind = array(":id" =>$id);
//	HDB::hus()->Hdelete("t_client","id_client=:id",$bind);
        $pseudo_supp =1;
        $sql = "pseudo_supp =:pseudo_supp WHERE id_client = :id ";
        $data = array(':pseudo_supp'=>$pseudo_supp,':id'=>$id);
        HDB::hus()->Hupdate('t_client',$sql,$data);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($code,$designation,$nom_client,$date_naiss_client,$sexe_client,$etat_civil_client,$nationalite_client,$provenance_client,$num_piece_identite_client,$num_passeport_client,$adresse_provenance_client,$email_client,$telephone_client,$num_pers_contacter_client,$statut,$pseudo_supp,$type,$type_cl,$id_respo,$id_hotel)
	{
	
	$values = array(array( 'code'=>$code,'designation'=>$designation,'nom_client'=>$nom_client,'date_naiss_client'=>$date_naiss_client,'sexe_client'=>$sexe_client,'etat_civil_client'=>$etat_civil_client,'nationalite_client'=>$nationalite_client,'provenance_client'=>$provenance_client,'num_piece_identite_client'=>$num_piece_identite_client,'num_passeport_client'=>$num_passeport_client,'adresse_provenance_client'=>$adresse_provenance_client,'email_client'=>$email_client,'telephone_client'=>$telephone_client,'num_pers_contacter_client'=>$num_pers_contacter_client,'statut'=>$statut,'pseudo_supp'=>$pseudo_supp,'type'=>$type,'type_cl'=>$type_cl,'id_respo'=>$id_respo,'id_hotel'=>$id_hotel ));
	HDB::hus()->Hinsert('t_client', $values);
	}
	// INSERT
	public function InsertFacturation($designation,$nom_client,$sexe_client,$adresse_provenance_client,$email_client,$telephone_client,$type,$id_hotel)
	{
            $values = array(array('designation'=>$designation,'nom_client'=>$nom_client,'sexe_client'=>$sexe_client,'adresse_provenance_client'=>$adresse_provenance_client,'email_client'=>$email_client,'telephone_client'=>$telephone_client,'type'=>$type,'id_hotel'=>$id_hotel ));
            HDB::hus()->Hinsert('t_client', $values);
            return HDB::hus()->lastInsertId();
	}
	// UPDATE
	public function UpdateFacturation($designation,$nom_client,$sexe_client,$adresse_provenance_client,$email_client,$telephone_client,$type,$id_hotel,$id)
	{
            $sql = "designation =:designation,nom_client =:nom_client,sexe_client =:sexe_client,adresse_provenance_client =:adresse_provenance_client,email_client =:email_client,telephone_client =:telephone_client,type =:type,id_hotel =:id_hotel WHERE id_client = :id ";
            $data = array(':designation'=>$designation,':nom_client'=>$nom_client,':sexe_client'=>$sexe_client,':adresse_provenance_client'=>$adresse_provenance_client,':email_client'=>$email_client,':telephone_client'=>$telephone_client,':type'=>$type,':id_hotel'=>$id_hotel,':id'=>$id);
            HDB::hus()->Hupdate('t_client',$sql,$data);
	}
	// UPDATE
	public function Update($code,$designation,$nom_client,$date_naiss_client,$sexe_client,$etat_civil_client,$nationalite_client,$provenance_client,$num_piece_identite_client,$num_passeport_client,$adresse_provenance_client,$email_client,$telephone_client,$num_pers_contacter_client,$statut,$pseudo_supp,$type,$type_cl,$id_respo,$id_hotel,$id)
	{
	$sql = "  code =:code,designation =:designation,nom_client =:nom_client,date_naiss_client =:date_naiss_client,sexe_client =:sexe_client,etat_civil_client =:etat_civil_client,nationalite_client =:nationalite_client,provenance_client =:provenance_client,num_piece_identite_client =:num_piece_identite_client,num_passeport_client =:num_passeport_client,adresse_provenance_client =:adresse_provenance_client,email_client =:email_client,telephone_client =:telephone_client,num_pers_contacter_client =:num_pers_contacter_client,statut =:statut,pseudo_supp =:pseudo_supp,type =:type,type_cl =:type_cl,id_respo =:id_respo,id_hotel =:id_hotel WHERE id_client = :id ";
	$data = array(':code'=>$code,':designation'=>$designation,':nom_client'=>$nom_client,':date_naiss_client'=>$date_naiss_client,':sexe_client'=>$sexe_client,':etat_civil_client'=>$etat_civil_client,':nationalite_client'=>$nationalite_client,':provenance_client'=>$provenance_client,':num_piece_identite_client'=>$num_piece_identite_client,':num_passeport_client'=>$num_passeport_client,':adresse_provenance_client'=>$adresse_provenance_client,':email_client'=>$email_client,':telephone_client'=>$telephone_client,':num_pers_contacter_client'=>$num_pers_contacter_client,':statut'=>$statut,':pseudo_supp'=>$pseudo_supp,':type'=>$type,':type_cl'=>$type_cl,':id_respo'=>$id_respo,':id_hotel'=>$id_hotel,':id'=>$id);
	HDB::hus()->Hupdate('t_client',$sql,$data);
	
	}
	public function SELECTALLCLIENTSITE($idsite)
	{
	$requete='SELECT DISTINCT a.id_client,a.nom_client
                    FROM  t_client  AS a, t_hotel AS b,t_facture AS c
                         WHERE a.id_hotel=b.id_hotel 
                         AND a.id_client=c.id_client
                         AND c.type="facturation"
                         AND c.etat=1
                         AND a.id_hotel=:id
                         ORDER BY a.nom_client ASC';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':id',$idsite);
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
	}
	} // end class
	
	?>
	
	