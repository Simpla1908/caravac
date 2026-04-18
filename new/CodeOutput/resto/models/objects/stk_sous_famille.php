
<?php

/*
 * =======================================================================
 * CLASSNAME:        stk_sous_famille_model
 * DATE CREATED:  	14-08-2017
 * FOR TABLE:  		stk_sous_famille
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include_once(APP_FOLDER . '/models/classes/class_stk_sous_famille.php');

class stk_sous_famille_model {
        
    // SELECT ALL
    public function SelectAll($idsite) {
       $requete='SELECT * FROM stk_sous_famille AS s_fam,stk_famille AS fam WHERE s_fam.famille=fam.idfamille AND s_fam.hotel_id=:id';
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
    public function CountRow() {
        return HDB::hus()->Hcount("stk_sous_famille");
    }

    // SELECT ONE
    public function SelectOne($id) {
        $bind = array(":id" => $id);
        return HDB::hus()->Hone("stk_sous_famille", "id_s_fam=:id", $bind);
    }

    // QUICK SEARCH
    public function AutoSearch($qstring, $limit, $where) {
        $bind = array(":svalue" => "%$qstring%");
        return HDB::hus()->Hselect("stk_sous_famille", "$where LIKE :svalue LIMIT $limit", $bind);
    }

    // TRUNCATE TABLE
    public function TruncateTable($redirect_to) {
        $sql = HDB::hus()->prepare("TRUNCATE stk_sous_famille");
        $sql->execute();
        send_to($redirect_to);
    }

    // DELETE
    public function Delete($id, $redirect_to) {
        $bind = array(":id" => $id);
        HDB::hus()->Hdelete("stk_sous_famille", "id_s_fam=:id", $bind);
        send_to($redirect_to);
    }

    // INSERT
    public function Insert($des, $famille, $hotel_id) {

        $values = array(array('des' => $des, 'famille' => $famille, 'hotel_id' => $hotel_id));
        HDB::hus()->Hinsert('stk_sous_famille', $values);
    }

    // UPDATE
    public function Update($des, $famille, $hotel_id, $id) {
        $sql = "  des =:des,famille =:famille,hotel_id =:hotel_id WHERE id_s_fam = :id ";
        $data = array(':des' => $des, ':famille' => $famille, ':hotel_id' => $hotel_id, ':id' => $id);
        HDB::hus()->Hupdate('stk_sous_famille', $sql, $data);
    }
    // SELECT SOUS - CATEGORIE BY SITE
    public function SelectAllBySite($idsite,$plat) {
        $requete = 'SELECT a.*,b.boisson,b.plat,b.affichage
                            FROM stk_sous_famille AS a,stk_famille AS b
                            WHERE a.famille=b.idfamille AND b.psedo=0 AND b.plat=:plat AND a.hotel_id=:id';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':plat',$plat);
        $query->BindParam(':id', $idsite);
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function Pos($idsite)
	{
            $requete='SELECT a.* 
                            FROM stk_sous_famille AS a,stk_famille AS b
                            WHERE a.famille=b.idfamille AND b.affichage=1 AND  b.hotel_id=:id';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id', $idsite);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            } 
       }
}

// end class
?>
	
