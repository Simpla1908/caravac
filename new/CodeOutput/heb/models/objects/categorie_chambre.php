
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        categorie_chambre_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		categorie_chambre
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_categorie_chambre.php');
	
	class categorie_chambre_model{
	
	// SELECT ALL
	 public function SelectAll($idsite) {
            $requete = "SELECT * FROM categorie_chambre k WHERE k.del=0 AND k.hotel_id=:id ORDER BY k.lib_cat_cha  ASC";
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id', $idsite);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        
        public function SelectAll_details($idsite) {
            $requete = "SELECT * FROM details_chambre k WHERE k.hotel_id=:id ORDER BY k.designation  ASC";
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id', $idsite);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function SelectAll_detailsCat($categorie_id) {
            $requete = "SELECT k.details_ch_id FROM details_categorie k WHERE k.categorie_id=:id ";
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id', $categorie_id);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function SelectAll_images($idsite) {
            $requete = "SELECT * FROM images_chambre k WHERE k.hotel_id=:id ORDER BY k.id_img  ASC";
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id', $idsite);
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
	return HDB::hus()->Hcount("categorie_chambre");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("categorie_chambre","id_cat_cha=:id",$bind);
	}
        
        public function SelectOneDetails($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("details_chambre","id_detail=:id",$bind);
	}
        
        public function SelectOneImage($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("images_chambre","id_img=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("categorie_chambre","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE categorie_chambre");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("categorie_chambre","id_cat_cha=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($lib_cat_cha,$tarif,$monnaie,$hotel_id)
	{
	$values = array(array( 'lib_cat_cha'=>$lib_cat_cha, 'tarif'=>$tarif, 'monnaie'=>$monnaie, 'hotel_id'=>$hotel_id ));
	HDB::hus()->Hinsert('categorie_chambre', $values);
        return HDB::hus()->lastInsertId();
	}
	public function InsertImage($lib_cat_cha,$tarif,$monnaie,$hotel_id) {
            $newupload = new UploadControl;
            $uploadname = $newupload->ImageUplaodResize('image', THUMB_IMAGE_WIDTH, BIG_IMAGE_WIDTH, UPLOAD_PATH, THUMB_PATH, 90);
            $values = array(array( 'lib_cat_cha'=>$lib_cat_cha, 'tarif'=>$tarif, 'monnaie'=>$monnaie, 'path_image'=>$uploadname,'hotel_id'=>$hotel_id ));
            HDB::hus()->Hinsert('categorie_chambre', $values);
            return HDB::hus()->lastInsertId();
        }
        
        public function InsertDetails($icon, $designation, $hotel_id) {
            $requete = HDB::hus()->prepare("INSERT INTO details_chambre (icon,designation,hotel_id)
                                       VALUES(:icon,:designation,:hotel_id)");
            $requete->BindParam(':icon', $icon);
            $requete->BindParam(':designation', $designation);
            $requete->BindParam(':hotel_id', $hotel_id);
            $requete->execute();
        }
        
        public function InsertImageSlide($description,$visible,$slide, $hotel_id) {
            $newupload = new UploadControl;
            $uploadname = $newupload->ImageUplaodResize('image', THUMB_IMAGE_WIDTH, BIG_IMAGE_WIDTH, UPLOAD_PATH, THUMB_PATH, 90);
            
            $requete = HDB::hus()->prepare("INSERT INTO images_chambre (libelle,description,visible,slide,hotel_id)
                                       VALUES(:libelle,:description,:visible,:slide,:hotel_id)");
            $requete->BindParam(':libelle', $uploadname);
            $requete->BindParam(':description', $description);
            $requete->BindParam(':visible', $visible);
            $requete->BindParam(':slide', $slide);
            $requete->BindParam(':hotel_id', $hotel_id);
            $requete->execute();
        }
        
        public function InsertDetailsCat($categorie_id, $details_ch_id) {
            $requete = HDB::hus()->prepare("INSERT INTO details_categorie (categorie_id,details_ch_id)
                                       VALUES(:categorie_id,:details_ch_id)");
            $requete->BindParam(':categorie_id', $categorie_id);
            $requete->BindParam(':details_ch_id', $details_ch_id);
            $requete->execute();
        }
        
	// UPDATE
	public function Update($lib_cat_cha,$hotel_id,$tarif,$id)
	{
	$sql = "  lib_cat_cha =:lib_cat_cha,hotel_id =:hotel_id,tarif =:tarif WHERE id_cat_cha = :id ";
	$data = array(':lib_cat_cha'=>$lib_cat_cha,':hotel_id'=>$hotel_id,':tarif'=>$tarif,':id'=>$id);
	HDB::hus()->Hupdate('categorie_chambre',$sql,$data);
	
	}
        
        public function UpdateDetailsCh($icon,$designation,$id)
	{
	$sql = "  icon =:icon,designation =:designation WHERE id_detail = :id ";
	$data = array(':icon'=>$icon,':designation'=>$designation,':id'=>$id);
	HDB::hus()->Hupdate('details_chambre',$sql,$data);
	
	}
        
        public function UpdateImage($lib_cat_cha,$hotel_id,$tarif,$id) {
            $newupload = new UploadControl;
            $uploadname = $newupload->ImageUplaodResize('image', THUMB_IMAGE_WIDTH, BIG_IMAGE_WIDTH, UPLOAD_PATH, THUMB_PATH, 90);
            $sql = "  lib_cat_cha =:lib_cat_cha,hotel_id =:hotel_id,tarif =:tarif,path_image =:path_image WHERE id_cat_cha = :id ";
            $data = array(':lib_cat_cha'=>$lib_cat_cha,':hotel_id'=>$hotel_id,':tarif'=>$tarif,':path_image'=>$uploadname,':id'=>$id);
            HDB::hus()->Hupdate('categorie_chambre',$sql,$data);
        }
        
        public function UpdateDetailsCat($categorie_id){
            $bdd = HDB::hus();
                 $requete = "DELETE FROM details_categorie WHERE categorie_id=:categorie_id";
                 $query = $bdd->prepare($requete);
                 $query->BindParam(':categorie_id',$categorie_id);
                 $query->execute();
        }
        
        public function UpdateImageSlider($description,$visible,$hotel_id,$id)
	{
            $sql = "  description =:description,visible =:visible,hotel_id =:hotel_id WHERE id_img = :id ";
            $data = array(':description'=>$description,':visible'=>$visible,':hotel_id'=>$hotel_id,':id'=>$id);
            HDB::hus()->Hupdate('images_chambre',$sql,$data);
	}
	public function UpdateImageSlider1($description,$visible,$hotel_id,$id) {
            $newupload = new UploadControl;
            $uploadname = $newupload->ImageUplaodResize('image', THUMB_IMAGE_WIDTH, BIG_IMAGE_WIDTH, UPLOAD_PATH, THUMB_PATH, 90);
            $sql = "  libelle =:libelle,description =:description,visible =:visible,hotel_id =:hotel_id WHERE id_img = :id ";
            $data = array(':libelle'=>$uploadname,':description'=>$description,':visible'=>$visible,':hotel_id'=>$hotel_id,':id'=>$id);
            HDB::hus()->Hupdate('images_chambre',$sql,$data);
        }
	
	} // end class
	
	?>
	
	