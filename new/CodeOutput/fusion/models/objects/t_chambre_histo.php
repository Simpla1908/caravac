
<?php

/*
 * =======================================================================
 * CLASSNAME:        t_chambre_histo_model
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_chambre_histo
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include_once(APP_FOLDER . '/models/classes/class_t_chambre_histo.php');

class t_chambre_histo_model {

    // SELECT ALL
    public function SelectAll($bdd, $datedebut, $datefin){
            $requete = $bdd->prepare("SELECT a.libre,a.reserve,a.occupe,a.statut,e.num_ch,a.date_occ,a.date_lib,a.tarif_ch,a.monnaie,d.mode,a.paie,a.qte,a.hr_in,a.hr_out 
        FROM  t_chambre_histo AS a,t_chambre AS e,t_reserve_chambre AS b,t_facture AS d
        WHERE  a.idres_ch=b.id AND a.idchambre=e.id_ch AND b.idfact=d.id_fact AND d.id_hotel=:id_hotel AND e.libre='oui'
        AND a.statut!='reserve'  AND a.statut!='occupe'
        AND (a.date_occ BETWEEN :p_debut AND :p_fin 
        OR a.date_lib BETWEEN :p_debut AND :p_fin )
        ORDER BY e.num_ch,a.tarif_ch ASC");
            $requete->BindParam(':p_debut', $datedebut);
            $requete->BindParam(':p_fin', $datefin);
            $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_OBJ);
    }
    public function occupation($bdd) {
        if ($_SESSION['type_user'] == 1) {
            $requete = $bdd->prepare("SELECT a.libre,a.reserve,a.occupe,a.statut,e.num_ch,a.date_occ,a.date_lib,a.tarif_ch,a.monnaie,d.mode,a.paie,a.qte
        FROM  t_chambre_histo AS a,t_chambre AS e,t_reserve_chambre AS b,t_facture AS d
        WHERE  a.idres_ch=b.id AND a.idchambre=e.id_ch AND b.idfact=d.id_fact AND d.id_hotel=:id_hotel AND e.libre='oui'
        AND a.statut='occupe'
         ORDER BY e.num_ch,a.tarif_ch ASC");
            
            $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        } else {
            $requete = $bdd->prepare("SELECT a.libre,a.reserve,a.occupe,a.statut,e.num_ch,a.date_occ,a.date_lib,a.tarif_ch,a.monnaie,d.mode,a.paie,a.qte
        FROM  t_chambre_histo AS a,t_chambre AS e,t_reserve_chambre AS b,t_facture AS d
        WHERE  a.idres_ch=b.id AND a.idchambre=e.id_ch AND b.idfact=d.id_fact AND d.id_hotel=:id_hotel AND d.id_user=:id_user AND e.libre='oui'
        AND a.statut='occupe'
        ORDER BY e.num_ch,a.tarif_ch ASC");
            $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
            $requete->BindParam(':id_user', $_SESSION['id_user']);
        }
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_OBJ);
    }
    public function SelectAll2($bdd, $datedebut, $datefin) {
        if ($_SESSION['type_user'] == 1) {
            $requete = $bdd->prepare("SELECT a.libre,a.reserve,a.occupe,a.statut,e.num_ch,a.date_occ,a.date_lib,a.tarif_ch,a.monnaie,a.qte,d.mode
        FROM  t_chambre_histo AS a,t_chambre AS e,t_reserve_chambre AS b,t_facture AS d
        WHERE  a.idres_ch=b.id AND a.idchambre=e.id_ch AND b.idfact=d.id_fact AND d.id_hotel=:id_hotel AND e.libre='non'
        AND (a.date_occ BETWEEN :p_debut AND :p_fin 
        OR a.date_lib BETWEEN :p_debut AND :p_fin )
        ORDER BY e.num_ch,a.tarif_ch ASC");
            $requete->BindParam(':p_debut', $datedebut);
            $requete->BindParam(':p_fin', $datefin);
            $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        } else {
            $requete = $bdd->prepare("SELECT a.libre,a.reserve,a.occupe,a.statut,e.num_ch,a.date_occ,a.date_lib,a.tarif_ch,a.monnaie,a.qte,d.mode
        FROM  t_chambre_histo AS a,t_chambre AS e,t_reserve_chambre AS b,t_facture AS d
        WHERE  a.idres_ch=b.id AND a.idchambre=e.id_ch AND b.idfact=d.id_fact AND d.id_hotel=:id_hotel AND d.id_user=:id_user AND e.libre='non'
        AND (a.date_occ BETWEEN :p_debut AND :p_fin 
        OR a.date_lib BETWEEN :p_debut AND :p_fin )
        ORDER BY e.num_ch,a.tarif_ch ASC");
            $requete->BindParam(':p_debut', $datedebut);
            $requete->BindParam(':p_fin', $datefin);
            $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
            $requete->BindParam(':id_user', $_SESSION['id_user']);
        }
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_OBJ);
    }

    //Select Count for Pagination
    public function CountRow() {
        return HDB::hus()->Hcount("t_chambre_histo");
    }

    // SELECT ONE
    public function SelectOne($id) {
        $bind = array(":id" => $id);
        return HDB::hus()->Hone("t_chambre_histo", "id=:id", $bind);
    }

    // QUICK SEARCH
    public function AutoSearch($qstring, $limit, $where) {
        $bind = array(":svalue" => "%$qstring%");
        return HDB::hus()->Hselect("t_chambre_histo", "$where LIKE :svalue LIMIT $limit", $bind);
    }

    // TRUNCATE TABLE
    public function TruncateTable($redirect_to) {
        $sql = HDB::hus()->prepare("TRUNCATE t_chambre_histo");
        $sql->execute();
        send_to($redirect_to);
    }

    // DELETE
    public function Delete($id, $redirect_to) {
        $bind = array(":id" => $id);
        HDB::hus()->Hdelete("t_chambre_histo", "id=:id", $bind);
        send_to($redirect_to);
    }

    // INSERT
    public function Insert($idres_ch, $idchambre, $statut, $date_occ, $date_lib, $tarif_ch, $monnaie) {

        $values = array(array('idres_ch' => $idres_ch, 'idchambre' => $idchambre, 'statut' => $statut, 'date_occ' => $date_occ, 'date_lib' => $date_lib, 'tarif_ch' => $tarif_ch, 'monnaie' => $monnaie));
        HDB::hus()->Hinsert('t_chambre_histo', $values);
    }

    // UPDATE
    public function Update($idres_ch, $idchambre, $statut, $date_occ, $date_lib, $tarif_ch, $monnaie, $id) {
        $sql = "  idres_ch =:idres_ch,idchambre =:idchambre,statut =:statut,date_occ =:date_occ,date_lib =:date_lib,tarif_ch =:tarif_ch,monnaie =:monnaie WHERE id = :id ";
        $data = array(':idres_ch' => $idres_ch, ':idchambre' => $idchambre, ':statut' => $statut, ':date_occ' => $date_occ, ':date_lib' => $date_lib, ':tarif_ch' => $tarif_ch, ':monnaie' => $monnaie, ':id' => $id);
        HDB::hus()->Hupdate('t_chambre_histo', $sql, $data);
    }

}

// end class
?>
	
