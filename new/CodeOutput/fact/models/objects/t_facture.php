
<?php

/*
 * =======================================================================
 * CLASSNAME:        t_facture_model
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_facture
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include_once(APP_FOLDER . '/models/classes/class_t_facture.php');

class t_facture_model
{

    // SELECT ALL
    public function SelectAll($limit = NULL)
    {
        if ($limit) {
            $startpg = pageparam($limit);
            return HDB::hus()->Hselect("t_facture LIMIT {$startpg} , {$limit}");
        } else {
            return HDB::hus()->Hselect("t_facture");
        }
    }

    //Select Count for Pagination
    public function CountRow()
    {
        return HDB::hus()->Hcount("t_facture");
    }

    // SELECT ONE
    public function SelectOne($id)
    {
        //	$bind = array(":id" =>$id);
        //	return HDB::hus()->Hone("t_facture","id_fact=:id",$bind);
        $requete = 'SELECT a.id_client,a.designation,a.nom_client,a.email_client,a.telephone_client,a.adresse_provenance_client,b.*
                    FROM  t_client  AS a, t_facture AS b
                         WHERE a.id_client=b.id_client 
                         AND b.id_fact=:id';
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
    public function AutoSearch($qstring, $limit, $where)
    {
        $bind = array(":svalue" => "%$qstring%");
        return HDB::hus()->Hselect("t_facture", "$where LIKE :svalue LIMIT $limit", $bind);
    }

    // TRUNCATE TABLE
    public function TruncateTable($redirect_to)
    {
        $sql = HDB::hus()->prepare("TRUNCATE t_facture");
        $sql->execute();
        send_to($redirect_to);
    }

    // DELETE
    public function Delete($id, $redirect_to)
    {
        $bind = array(":id" => $id);
        HDB::hus()->Hdelete("t_facture", "id_fact=:id", $bind);
        send_to($redirect_to);
    }

    // INSERT
    public function Insert($num_fact, $type, $i_souscription, $etat, $etat_cmd, $date_echeance_old, $date_edition, $dte_blocage, $date_echeance, $date_desactivation, $montant_total, $mont_tva, $mont_ttc, $mont_ttc_remise, $taux, $taux_prix, $tva, $monnaie, $remise, $majoration, $justification, $id_res, $res_ch_id, $modulecompagny, $id_hotel, $company_id, $id_user, $id_client, $fact1)
    {

        $values = array(array('num_fact' => $num_fact, 'type' => $type, 'i_souscription' => $i_souscription, 'etat' => $etat, 'etat_cmd' => $etat_cmd, 'date_echeance_old' => $date_echeance_old, 'date_edition' => $date_edition, 'dte_blocage' => $dte_blocage, 'date_echeance' => $date_echeance, 'date_desactivation' => $date_desactivation, 'montant_total' => $montant_total, 'mont_tva' => $mont_tva, 'mont_ttc' => $mont_ttc, 'mont_ttc_remise' => $mont_ttc_remise, 'taux' => $taux, 'taux_prix' => $taux_prix, 'tva' => $tva, 'monnaie' => $monnaie, 'remise' => $remise, 'majoration' => $majoration, 'justification' => $justification, 'id_res' => $id_res, 'res_ch_id' => $res_ch_id, 'modulecompagny' => $modulecompagny, 'id_hotel' => $id_hotel, 'company_id' => $company_id, 'id_user' => $id_user, 'id_client' => $id_client, 'fact1' => $fact1));
        HDB::hus()->Hinsert('t_facture', $values);
    }

    // INSERT
    public function InsertFact($num_fact, $type, $etat, $etat_cmd, $etat_sousresto, $date_echeance_old, $date_edition, $date_echeance, $montant_total, $mont_tva, $mont_ttc, $mont_ttc_remise, $taux, $tva, $monnaie, $remise, $majoration, $justification, $id_hotel, $company_id, $id_user, $id_client, $mode, $compte1, $compte2)
    {
        $values = array(array('num_fact' => $num_fact, 'type' => $type, 'etat' => $etat, 'etat_cmd' => $etat_cmd, 'etat_sousresto' => $etat_sousresto, 'date_echeance_old' => $date_echeance_old, 'date_edition' => $date_edition, 'date_echeance' => $date_echeance, 'montant_total' => $montant_total, 'mont_tva' => $mont_tva, 'mont_ttc' => $mont_ttc, 'mont_ttc_remise' => $mont_ttc_remise, 'taux' => $taux, 'tva' => $tva, 'monnaie' => $monnaie, 'remise' => $remise, 'majoration' => $majoration, 'justification' => $justification, 'id_hotel' => $id_hotel, 'company_id' => $company_id, 'id_user' => $id_user, 'id_client' => $id_client, 'mode' => $mode, 'compte1' => $compte1, 'compte2' => $compte2));
        HDB::hus()->Hinsert('t_facture', $values);
        return HDB::hus()->lastInsertId();
    }

    // UPDATE
    public function Update($num_fact, $type, $i_souscription, $etat, $etat_cmd, $date_echeance_old, $date_edition, $dte_blocage, $date_echeance, $date_desactivation, $montant_total, $mont_tva, $mont_ttc, $mont_ttc_remise, $taux, $taux_prix, $tva, $monnaie, $remise, $majoration, $justification, $id_res, $res_ch_id, $modulecompagny, $id_hotel, $company_id, $id_user, $id_client, $fact1, $id)
    {
        $sql = "  num_fact =:num_fact,type =:type,i_souscription =:i_souscription,etat =:etat,etat_cmd =:etat_cmd,date_echeance_old =:date_echeance_old,date_edition =:date_edition,dte_blocage =:dte_blocage,date_echeance =:date_echeance,date_desactivation =:date_desactivation,montant_total =:montant_total,mont_tva =:mont_tva,mont_ttc =:mont_ttc,mont_ttc_remise =:mont_ttc_remise,taux =:taux,taux_prix =:taux_prix,tva =:tva,monnaie =:monnaie,remise =:remise,majoration =:majoration,justification =:justification,id_res =:id_res,res_ch_id =:res_ch_id,modulecompagny =:modulecompagny,id_hotel =:id_hotel,company_id =:company_id,id_user =:id_user,id_client =:id_client,fact1 =:fact1 WHERE id_fact = :id ";
        $data = array(':num_fact' => $num_fact, ':type' => $type, ':i_souscription' => $i_souscription, ':etat' => $etat, ':etat_cmd' => $etat_cmd, ':date_echeance_old' => $date_echeance_old, ':date_edition' => $date_edition, ':dte_blocage' => $dte_blocage, ':date_echeance' => $date_echeance, ':date_desactivation' => $date_desactivation, ':montant_total' => $montant_total, ':mont_tva' => $mont_tva, ':mont_ttc' => $mont_ttc, ':mont_ttc_remise' => $mont_ttc_remise, ':taux' => $taux, ':taux_prix' => $taux_prix, ':tva' => $tva, ':monnaie' => $monnaie, ':remise' => $remise, ':majoration' => $majoration, ':justification' => $justification, ':id_res' => $id_res, ':res_ch_id' => $res_ch_id, ':modulecompagny' => $modulecompagny, ':id_hotel' => $id_hotel, ':company_id' => $company_id, ':id_user' => $id_user, ':id_client' => $id_client, ':fact1' => $fact1, ':id' => $id);
        HDB::hus()->Hupdate('t_facture', $sql, $data);
    }

    public function All($idsite, $type, $dte1, $dte2)
    {
        $requete = "SELECT a.*,b.nom_client,b.designation,c.nom_user
                    FROM t_facture AS a,t_client AS b,t_utilisateur AS c
                    WHERE a.id_client=b.id_client AND a.id_user=c.id_user
                          AND a.etat_cmd=0 AND a.type=:type
                          AND a.id_hotel=:id 
                          AND a.date_edition BETWEEN :dte1 AND :dte2 ORDER BY a.id_fact";
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':type', $type);
        $query->BindParam(':id', $idsite);
        $query->BindParam(':dte1', $dte1);
        $query->BindParam(':dte2', $dte2);
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function Allrecurente($idsite, $type, $dte1, $dte2, $bdd)
    {
        $requete = "SELECT a.*,b.nom_client,b.designation,c.nom_user
                    FROM t_facture AS a,t_client AS b,t_utilisateur AS c
                    WHERE a.id_client=b.id_client AND a.id_user=c.id_user
                    AND a.etat_cmd=1 AND a.type=:type
                    AND a.id_hotel=:id 
                    AND a.date_edition BETWEEN :dte1 AND :dte2 ORDER BY a.id_fact";
        $query = $bdd->prepare($requete);
        $query->BindParam(':type', $type);
        $query->BindParam(':id', $idsite);
        $query->BindParam(':dte1', $dte1);
        $query->BindParam(':dte2', $dte2);
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function AllrecurenteInsert($idsite, $type, $bdd)
    {
        $requete = "SELECT a.*,b.nom_client,b.designation,c.nom_user
                    FROM t_facture AS a,t_client AS b,t_utilisateur AS c
                    WHERE a.id_client=b.id_client AND a.id_user=c.id_user
                    AND a.etat_sousresto<>0 AND a.type=:type
                    AND a.id_hotel=:id 
                     ORDER BY a.id_fact";
        $query = $bdd->prepare($requete);
        $query->BindParam(':type', $type);
        $query->BindParam(':id', $idsite);
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function VerificationFact($date_recurente, $type, $id_hotel)
    {
        $requete = "SELECT f.date_edition FROM t_facture AS f 
                    WHERE f.date_edition=:date_recurente AND f.type=:type
                    AND f.id_hotel=:id_hotel";
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':date_recurente', $date_recurente);
        $query->BindParam(':type', $type);
        $query->BindParam(':id_hotel', $id_hotel);
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // LIGNES FACTURES ALL
    public function lignesAllBySite($id)
    {
        $requete = "SELECT  l.lib AS designation,l.produit_id,l.qte,l.prix,l.commande_id,l.mont_tva 
                        FROM  lignes_commandes AS l,stk_produit As p 
                        WHERE l.produit_id=p.idprod AND l.commande_id=:id ";
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':id', $id);
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function totalMontantPaye($id_fact)
    {
        $bdd = HDB::hus();
        $total = 0;
        $req = "
        SELECT SUM(e.montantusd*e.taux+e.montantcdf-e.rendu) AS montant_paye
        FROM  t_facture AS b, t_reglement AS d, paiement AS e
        WHERE b.id_fact=d.id_fact 
        AND d.id_regl=e.regl_id 
        AND b.id_fact=:id";
        $requete = $bdd->prepare($req);
        $requete->BindParam(':id', $id_fact);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $op) {
            $total = $op->montant_paye;
        }
        return $total;
    }

    public function SelectAllInvoice($id_fact)
    {
        $requete = 'SELECT * FROM  t_facture AS a,t_client AS b
               WHERE  a.id_client=b.id_client AND a.type="facturation" AND a.etat=1 AND a.id_fact=:id ';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':id', $id_fact);
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function InsertFactrecurente($numfact, $type, $etat, $fact_recurente, $nbrejour, $dte_genfact, $dte_edit, $dte_ech, $monttotal_ht, $mont_tva, $mont_ttc, $mont_ttc_remise, $taux, $tva, $monnaie, $remise, $majoration, $justification, $id_hotel, $company_id, $id_user, $id_client, $mode, $bdd)
    {
        //        $bdd = HDB::hus();
        $query = $bdd->prepare("INSERT t_facture (num_fact,type,etat,etat_cmd,etat_sousresto,date_echeance_old,date_edition,date_echeance,montant_total,mont_tva,mont_ttc,mont_ttc_remise,taux,tva,monnaie,remise,majoration,justification,id_hotel,company_id,id_user,id_client,mode)
                                VALUES(:num_fact,:type,:etat,:etat_cmd,:etat_sousresto,:date_echeance_old,:date_edition,:date_echeance,:montant_total,:mont_tva,:mont_ttc,:mont_ttc_remise,:taux,:tva,:monnaie,:remise,:majoration,:justification,:id_hotel,:company_id,:id_user,:id_client,:mode)");

        $query->BindParam(':num_fact', $numfact);
        $query->BindParam(':type', $type);
        $query->BindParam(':etat', $etat);
        $query->BindParam(':etat_cmd', $fact_recurente);
        $query->BindParam(':etat_sousresto', $nbrejour);
        $query->BindParam(':date_echeance_old', $dte_genfact);
        $query->BindParam(':date_edition', $dte_edit);
        $query->BindParam(':date_echeance', $dte_ech);
        $query->BindParam(':montant_total', $monttotal_ht);
        $query->BindParam(':mont_tva', $mont_tva);
        $query->BindParam(':mont_ttc', $mont_ttc);
        $query->BindParam(':mont_ttc_remise', $mont_ttc_remise);
        $query->BindParam(':taux', $taux);
        $query->BindParam(':tva', $tva);
        $query->BindParam(':monnaie', $monnaie);
        $query->BindParam(':remise', $remise);
        $query->BindParam(':majoration', $majoration);
        $query->BindParam(':justification', $justification);
        $query->BindParam(':id_hotel', $id_hotel);
        $query->BindParam(':company_id', $company_id);
        $query->BindParam(':id_user', $id_user);
        $query->BindParam(':id_client', $id_client);
        $query->BindParam(':mode', $mode);
        $query->execute();
    }
}

// end class
?>
	
