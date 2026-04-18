
<?php

/*
 * =======================================================================
 * CLASSNAME:        resrubrique_model
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		resrubrique
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include_once(APP_FOLDER . '/models/classes/class_resrubrique.php');

class resrubrique_model {

    // SELECT ALL
    public function SelectAll($idsite) {
        $requete = 'SELECT * FROM resrubrique AS a WHERE psedo=0 AND a.site_id=:id ORDER BY a.libelle';
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
        return HDB::hus()->Hcount("resrubrique");
    }

    // SELECT ONE
    public function SelectOne($id) {
        $bind = array(":id" =>$id);
	return HDB::hus()->Hone("resrubrique","id=:id",$bind);
    }
    public function SelectOne2($id) {
        $requete = 'SELECT *,b.id AS idrubcat FROM resrubrique AS a,resrubriquecateg AS b WHERE a.id=b.rubrique_id  AND a.id=:id';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':id', $id);
        try {
            $query->execute();
            return $query->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    // QUICK SEARCH
    public function AutoSearch($qstring, $limit, $where) {
        $bind = array(":svalue" => "%$qstring%");
        return HDB::hus()->Hselect("resrubrique", "$where LIKE :svalue LIMIT $limit", $bind);
    }

    // TRUNCATE TABLE
    public function TruncateTable($redirect_to) {
        $sql = HDB::hus()->prepare("TRUNCATE resrubrique");
        $sql->execute();
        send_to($redirect_to);
    }

    // DELETE
    public function Delete($id, $redirect_to) {
        $bind = array(":id" => $id);
        HDB::hus()->Hdelete("resrubrique", "id=:id", $bind);
        send_to($redirect_to);
    }

    // INSERT
    public function Insert($libelle, $type,$type2, $psedo, $site_id,$affiche,$sequence) {
        $values = array(array('libelle' => $libelle, 'type' => $type,'type2'=>$type2,'psedo' => $psedo, 'site_id' => $site_id, 'affiche' => $affiche, 'sequence' => $sequence));
        HDB::hus()->Hinsert('resrubrique', $values);
        return HDB::hus()->lastInsertId();
    }
    // UPDATE
    public function Update($libelle, $type,$type2 ,$psedo, $site_id,$affiche,$sequence,$id){
        $sql = "  libelle =:libelle,type =:type,type2 =:type2,psedo =:psedo,site_id =:site_id,affiche =:affiche,sequence =:sequence WHERE id = :id ";
        $data = array(':libelle' => $libelle, ':type' => $type,':type2' => $type2 ,':psedo' => $psedo, ':site_id' => $site_id,':affiche' => $affiche,':sequence' => $sequence,':id' => $id);
        HDB::hus()->Hupdate('resrubrique', $sql, $data);
    }

    //CATEGORIES RUBRIQUES
    public function Categories($id) {
        $categories= array();
        $categories['id'] =array();
        $requete = 'SELECT * FROM resrubriquecateg AS b WHERE  b.rubrique_id=:id';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':id', $id);
        try {
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_OBJ);
            foreach ($result as $r) {
                $categorie_id = $r->categorie_id;
                if (!in_array($categorie_id,$categories['id'])){
                    array_push($categories['id'],$categorie_id);
                }
            }
            return $categories;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    //TYPES RUBRIQUES
    public function GetType($id){
        $requete = 'SELECT DISTINCT a.type2 FROM resrubrique AS a WHERE  a.site_id=:id ORDER BY a.sequence';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':id',$id);
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
	
