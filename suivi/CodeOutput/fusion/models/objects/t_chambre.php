
<?php

/*
 * =======================================================================
 * CLASSNAME:        t_chambre_model
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_chambre
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include_once(APP_FOLDER . '/models/classes/class_t_chambre.php');

class t_chambre_model {

    // SELECT ALL
    public function SelectAll($idsite) {
        $requete = "SELECT c.id_ch,c.num_ch,c.monnaie,c.etat_ch,c.tarif_ch,k.lib_cat_cha,c.niveau,c.libre 
                    FROM  t_chambre c,categorie_chambre k
                     WHERE  k.id_cat_cha=c.categorie 
                            AND c.del=0 
                            AND c.id_hotel=:id
                            ORDER BY c.num_ch ASC";
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
    public function CountRow() {
        return HDB::hus()->Hcount("t_chambre");
    }

    // SELECT ONE
    public function SelectOne($id) {
        $bind = array(":id" => $id);
        return HDB::hus()->Hone("t_chambre", "id_ch=:id", $bind);
    }

    // QUICK SEARCH
    public function AutoSearch($qstring, $limit, $where) {
        $bind = array(":svalue" => "%$qstring%");
        return HDB::hus()->Hselect("t_chambre", "$where LIKE :svalue LIMIT $limit", $bind);
    }

    // TRUNCATE TABLE
    public function TruncateTable($redirect_to) {
        $sql = HDB::hus()->prepare("TRUNCATE t_chambre");
        $sql->execute();
        send_to($redirect_to);
    }

    // DELETE
    public function Delete($id, $redirect_to) {
        $del=1;
         $sql = "del =:del WHERE id_ch = :id ";
        $data = array(':del'=> $del, ':id' => $id);
        HDB::hus()->Hupdate('t_chambre', $sql, $data);
        send_to($redirect_to);
    }

    // INSERT
    public function Insert($num_ch, $etat_ch, $tarif_ch, $monnaie,$libre,$categorie,$id_hotel){
        $values = array(array('num_ch' => $num_ch,'etat_ch'=>$etat_ch,'tarif_ch'=>$tarif_ch,'monnaie'=>$monnaie,'libre' => $libre, 'categorie' => $categorie,'id_hotel' => $id_hotel));
        HDB::hus()->Hinsert('t_chambre', $values);
    }

    // UPDATE
    public function Update($num_ch, $etat_ch, $tarif_ch, $monnaie,$categorie,$id) {
        $sql = "  num_ch =:num_ch,etat_ch =:etat_ch,tarif_ch =:tarif_ch,monnaie =:monnaie,categorie =:categorie WHERE id_ch = :id ";
        $data = array(':num_ch' => $num_ch, ':etat_ch' => $etat_ch, ':tarif_ch' => $tarif_ch, ':monnaie'=>$monnaie,':categorie' => $categorie,':id'=> $id);
        HDB::hus()->Hupdate('t_chambre', $sql, $data);
    }

}

// end class
?>
	
