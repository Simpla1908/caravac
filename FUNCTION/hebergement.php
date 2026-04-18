<?php
function NbJours($dte_a, $dte_now)
{
    $tDeb = explode("-", $dte_a);
    $tFin = explode("-", $dte_now);
    $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) -
        mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);
    $nb_jrs = (($diff / 86400) + 1);
    $nb_jr = $nb_jrs - 1;
    if ($nb_jr == 0) {
        $nb_jr++;
    }
    return $nb_jr;
}
function getMonnaie_id($m_affiche, $bdd)
{
    $requete = $bdd->prepare("SELECT  * FROM ` monnaie` AS m WHERE m.id_hotel=:id_hotel AND m.lib_monnaie=:lib_monnaie ");
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete->BindParam(':lib_monnaie', $m_affiche);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $op) {
        $id_monnaie = $op->id_monnaie;
    }
    return $id_monnaie;
}
function montant_equivalent($m_affiche1, $tauxdollar1, $montant1)
{
    if ($m_affiche1 == 'USD') {
        $monnaie1 = 'CDF';
        $mont = $montant1 * $tauxdollar1;
        return format_chiffre(round($mont, 2)) . ' ' . $monnaie1;
    } else {
        $monnaie1 = 'USD';
        $mont = $montant1 / $tauxdollar1;
        return format_chiffre(round($mont, 2)) . ' ' . $monnaie1;
    }
}
function montant_equivalent_bdd($m1, $m2, $tauxdollar1, $montant1)
{
    if ($m1 == $m2) {
        $mont = $montant1;
    } else {
        if ($m1 == 'USD' && $m2 == 'CDF') {
            $mont = $montant1 * $tauxdollar1;
        } else {
            $mont = $montant1 / $tauxdollar1;
        }
    }
    return $mont;
}
function afficheMontant($maffiche, $montant1)
{
    $montant1 = format_chiffre(round($montant1, 2));
    return $montant1 . ' ' . $maffiche;
}
function afficheMontant2($maffiche, $montant1)
{
    $montant1 = format_chiffre2($montant1);
    return $montant1 . ' ' . $maffiche;
}
function afficheMontant3($maffiche, $montant1)
{
    $montant1 = format_chiffre2(round($montant1, 2));
    return $montant1 . ' ' . $maffiche;
}
function affiche_montant($m_affiche1, $tauxdollar1, $mont_fc, $mont_usd)
{
    if ($m_affiche1 == 'USD') {
        $mont = $mont_usd + ($mont_fc / $tauxdollar1);
    } else {
        $mont = $mont_fc + ($mont_usd * $tauxdollar1);
    }
    $mont = format_chiffre(round($mont, 2));
    return $mont;
}
function afficheTarif($maffiche, $montant1, $tva)
{
    //    $mont_tva=montant_tva($montant1, 0, $tva);
    $mont_tva = 0;
    $montant1 = format_chiffre(round($montant1 + $mont_tva, 2));
    return $montant1 . ' ' . $maffiche;
}


function montant_tva($total, $montant_rem, $tva)
{
    $montant_tva = ($tva * ($total - $montant_rem)) / 100;
    return round($montant_tva, 2);
}
function montant_remise($montant1, $remise)
{
    $montant_remise = ($montant1 * $remise) / 100;
    return round($montant_remise, 2);
}
function montant_ttc($total, $montant_tva, $montant_remise)
{
    $ttc = ($total + $montant_tva) - $montant_remise;
    return round($ttc, 2);
}
function tva($total, $tva, $remise)
{
    //    if($remise==0){
    //        $total=$total;
    //    }  else {
    //        $total=ht($total,$tva,$remise);
    //    }
    //    $montant_tva=($tva * ($total))/100;
    $montant_tva = ($tva * ($total)) / 100;
    return $montant_tva;
}
function remise($total, $tva, $remise)
{
    //     $ht1=$total-($total*$tva)/100;
    //     $ht2=($ht1*$remise)/100;
    $ht2 = ($total * $remise) / 100;
    return $ht2;
}
function total($total, $tva, $remise)
{

    // $ht2 = $total - ($total * $remise) / 100;
    $ht2 = $total;
    return $ht2;
}
function ht($total, $tva, $remise)
{
    $ht2 = $total - ($total * $tva) / 100;
    // $ht2 = $total;
    return $ht2;
}
function ttc($ht, $mont_tva, $mont_remise)
{
    return $ht + $mont_tva;
}
function dateInsertBdd($dte)
{
    $transpostion = explode('/', $dte);
    $jrar = $transpostion[0];
    $moisar = $transpostion[1];
    $annee1ar = $transpostion[2];
    $transpostion1 = explode(' ', $annee1ar);
    $anneear = $transpostion1[0];
    $heurear = $transpostion1[1] . ':00';
    $dte_a = $anneear . '-' . $moisar . '-' . $jrar;
    return $dte_a;
}
//DATE
function dateToformatBdd($stringdate)
{
    if ($stringdate != '') {
        $stringdate = trim($stringdate);
        $tmp = explode("/", $stringdate);
        $date_iso = $tmp[2] . "-" . $tmp[1] . "-" . $tmp[0];
        return $date_iso;
    }
}
function dateAffiche($stringdate)
{
    if ($stringdate != '') {
        $stringdate = trim($stringdate);
        $tmp = explode("-", $stringdate);
        $date_iso = $tmp[2] . "/" . $tmp[1] . "/" . $tmp[0];
        return $date_iso;
    }
}
//DATETIME
/* ça une chaine de format datetime et retourne une date au format désiré */
function format_stringdateTodatetime($format1, $stringdate, $format2)
{
    if ($stringdate != '') {
        $date = DateTime::createFromFormat($format1, $stringdate);
        return $date->format($format2);
    } else {
        return "00-00-0000";
    }
}
function getInfosFacture($id_res, $bdd)
{
    //Details des factures
    $requete = $bdd->prepare("
        SELECT a.*,a.mont_ttc_remise AS tauxremise
        FROM v_hebergement a
        WHERE a.id_res=:id_res GROUP BY a.id_ch_histo");
    $requete->BindParam(':id_res', $id_res);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function getInfosFactureOne($idres_ch, $bdd)
{
    //Details des factures
    $requete = $bdd->prepare("
        SELECT a.*,a.mont_ttc_remise AS tauxremise
        FROM v_hebergement a
        WHERE a.idres_ch_histo=:id GROUP BY a.id_ch_histo");
    $requete->BindParam(':id', $idres_ch);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function getMontantPrestation($id_res, $bdd)
{
    $requete = $bdd->prepare("SELECT *,SUM(montant_paye) AS mont_paye,SUM(c.montant_usd*taux_paie-rendu) AS montantusd,SUM(c.montant_cdf) AS montantcdf FROM v_paiement AS c WHERE c.id_res=:id_res GROUP BY c.id_fact");
    $requete->BindParam(':id_res', $id_res);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function getMontantPrestation1($id_res, $bdd)
{
    //retourne aussi la garantie
    $requete = $bdd->prepare("SELECT c.*,SUM(montant_paye) AS mont_paye,d.garantie FROM v_paiement AS c,t_reservation AS d WHERE c.id_res=d.id_res AND c.id_res=:id_res GROUP BY c.id_fact");
    $requete->BindParam(':id_res', $id_res);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function getPrestationClient($id_res, $bdd)
{
    $requete = $bdd->prepare("SELECT DISTINCT c.type FROM v_paiement AS c WHERE c.id_res=:id_res");
    $requete->BindParam(':id_res', $id_res);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function getMontantFactureGlobalBytype($id_res, $bdd)
{
    $requete = $bdd->prepare("SELECT *,SUM(c.mont_ttc) AS montant_fact,SUM(c.montant_paye) AS mont_paye FROM v_paiement AS c WHERE c.id_res=:id_res GROUP BY c.type");
    $requete->BindParam(':id_res', $id_res);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function ougmentationGarantie($id_res, $montant, $bdd)
{
    $requete = $bdd->prepare("UPDATE t_reservation  SET garantie=garantie+:garantie WHERE id_res=:id_res");
    $requete->BindParam(':garantie', $montant);
    $requete->BindParam(':id_res', $id_res);
    $requete->execute();
}
function dimunitionGarantie($id_res, $montant_tot, $bdd)
{
    $requete = $bdd->prepare("UPDATE t_reservation  SET garantie=garantie-:garantie WHERE id_res=:id_res");
    $requete->BindParam(':garantie', $montant_tot);
    $requete->BindParam(':id_res', $id_res);
    $requete->execute();
}
function getchambreIndisponibles($id_hotel, $dte_a, $dte_s, $checkin, $checkout, $hrs_sys, $bdd)
{
    $data['chambres'] = array();
    $data['chambres']['id'] = array();
    $requete = $bdd->prepare("SELECT * FROM t_reserve_chambre AS rc WHERE rc.statut!='libre' AND rc.id_hotel=:id");
    $requete->BindParam(':id', $id_hotel);
    $requete->execute();
    $chambres = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($chambres as $ch) {
        $idch = $ch->idchambre;
        // Avant la date d'occupation       
        if (($dte_a <= $ch->date_occ) && ($dte_s <= $ch->date_occ)) {
            if (($hrs_sys > $ch->checkin)) {
                array_push($data['chambres']['id'], $idch);
            }
        }
        // Après la date de libération
        elseif (($dte_a >= $ch->date_lib) && ($dte_s >= $ch->date_lib)) {
            if ($hrs_sys < $ch->checkout) {
                array_push($data['chambres']['id'], $idch);
            }
        }
        // Pendant
        elseif (($dte_a >= $ch->date_occ) && ($dte_s <= $ch->date_lib)) {
            array_push($data['chambres']['id'], $idch);
        }
    }
    return $data;
}
function augmentemontantVersement($montant, $user_vers, $type_vers, $id_hotel, $bdd)
{
    $requete = $bdd->prepare("UPDATE t_versement  SET montant_vers=montant_vers+:montant_vers WHERE user_vers=:user_vers AND type_vers=:type_vers AND id_hotel=:id_hotel");
    $requete->BindParam(':montant_vers', $montant);
    $requete->BindParam(':user_vers', $user_vers);
    $requete->BindParam(':type_vers', $type_vers);
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->execute();
}
function dimunumontantVersement($montant, $user_vers, $type_vers, $id_hotel, $bdd)
{
    $requete = $bdd->prepare("UPDATE t_versement  SET montant_vers=montant_vers-:montant_vers WHERE user_vers=:user_vers AND type_vers=:type_vers AND id_hotel=:id_hotel");
    $requete->BindParam(':montant_vers', $montant);
    $requete->BindParam(':user_vers', $user_vers);
    $requete->BindParam(':type_vers', $type_vers);
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->execute();
}
function insertmontantVersement($user_vers, $date_vers, $montant_vers, $montantusd, $monaie_vers, $type_vers, $taux, $motif, $paie_id, $id_hotel, $id_sousresto, $num,$fdcl_usd,$fdcl_cdf,$bdd)
{
    $requete = $bdd->prepare("INSERT INTO  t_versement (user_vers,date_vers,montant_vers,montantusd,monaie_vers,type_vers,taux,motif,id_sousresto,id_hotel,num,fdcl_usd,fdcl_cdf)
                VALUES(:user_vers,:date_vers,:montant_vers,:montantusd,:monaie_vers,:type_vers,:taux,:motif,:id_sousresto,:id_hotel,:num,:fdcl_usd,:fdcl_cdf)");
    /* monnaie Mis pour les besoins de la cause */
    $requete->BindParam(':user_vers', $user_vers);
    $requete->BindParam(':date_vers', $date_vers);
    $requete->BindParam(':montant_vers', $montant_vers);
    $requete->BindParam(':montantusd', $montantusd);
    $requete->BindParam(':monaie_vers', $monaie_vers);
    $requete->BindParam(':type_vers', $type_vers);
    $requete->BindParam(':taux', $taux);
    $requete->BindParam(':motif', $motif);
    $requete->BindParam(':id_sousresto', $id_sousresto);
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->BindParam(':num', $num);
    $requete->BindParam(':fdcl_usd', $fdcl_usd);
    $requete->BindParam(':fdcl_cdf', $fdcl_cdf);
    $requete->execute();
}
function insertmontantVersementResto($user_vers, $date_vers, $montant_vers, $monaie_vers, $type_vers, $taux, $motif, $paie_id, $id_hotel, $bdd)
{
    $requete = $bdd->prepare("INSERT INTO  t_versement (user_vers,date_vers,montant_vers,monaie_vers,type_vers,taux,motif,paie_id,id_hotel)
                VALUES(:user_vers,:date_vers,:montant_vers,:monaie_vers,:type_vers,:taux,:motif,:paie_id,:id_hotel)");
    /* monnaie Mis pour les besoins de la cause */
    $requete->BindParam(':user_vers', $user_vers);
    $requete->BindParam(':date_vers', $date_vers);
    $requete->BindParam(':montant_vers', $montant_vers);
    $requete->BindParam(':monaie_vers', $monaie_vers);
    $requete->BindParam(':type_vers', $type_vers);
    $requete->BindParam(':taux', $taux);
    $requete->BindParam(':motif', $motif);
    $requete->BindParam(':paie_id', $paie_id);
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->execute();
}
function existeuserVersement($user_vers, $type_vers, $id_hotel, $bdd)
{
    $nb = 0;
    $bool = 0;
    $requete = $bdd->prepare("SELECT COUNT(*) AS nb_lg FROM t_versement WHERE user_vers=:user_vers AND type_vers=:type_vers AND id_hotel=:id_hotel");
    /* monnaie Mis pour les besoins de la cause */
    $requete->BindParam(':user_vers', $user_vers);
    $requete->BindParam(':type_vers', $type_vers);
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($operations as $op) :
        $nb = $op->nb_lg;
    endforeach;
    if ($nb > 0) $bool = 1;
    return $bool;
}
function meme_monnaie($mon, $tau, $cdf, $usd)
{
    if ($mon == 'USD') {
        $cdfusd = $cdf * 1 / $tau;
        $val = $usd + $cdfusd;
    } else if ($mon == 'CDF') {
        $usdcdf = $usd * $tau;
        $val = $cdf + $usdcdf;
    }
    return $val;
}
function getsymbole_devise()
{
    return 'USD';
}
function getsymbole_local()
{
    return 'CDF';
}
function format_chiffre($mon)
{
    return number_format($mon, 0, ',', '');
}
function format_chiffre2($mon)
{
    return number_format($mon, 2, ',', '');
}
function arrondir($montant)
{
    return round($montant, 2);
}
function verifCompteurSite($site_id, $libelle, $bdd)
{
    $nb = 0;
    $bool = 0;
    $requete = $bdd->prepare("SELECT COUNT(*) AS nb_lg FROM compteur WHERE libelle=:libelle  AND site_id=:id_hotel");
    /* monnaie Mis pour les besoins de la cause */
    $requete->BindParam(':libelle', $libelle);
    $requete->BindParam(':id_hotel', $site_id);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($operations as $op) :
        $nb = $op->nb_lg;
    endforeach;
    if ($nb > 0) $bool = 1;
    return $bool;
}
function insertCompteurSite($site_id, $libelle, $numero, $bdd)
{
    $requete = $bdd->prepare("INSERT INTO compteur (libelle,numero,site_id)
                VALUES(:libelle,:numero,:site_id)");
    $requete->BindParam(':libelle', $libelle);
    $requete->BindParam(':numero', $numero);
    $requete->BindParam(':site_id', $site_id);
    $requete->execute();
}

function selectCompteurSite($site_id, $libelle, $bdd)
{
    $numero = 0;
    $requete = $bdd->prepare("SELECT numero FROM compteur WHERE libelle=:libelle  AND site_id=:id_hotel");
    $requete->BindParam(':libelle', $libelle);
    $requete->BindParam(':id_hotel', $site_id);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($operations as $op) :
        $numero = $op->numero;
    endforeach;
    return $numero;
}
function getnumerotation($site_id, $libelle, $bdd)
{
    $num_cmd = 1;
    $bool = verifCompteurSite($site_id, $libelle, $bdd);
    if ($bool == 1) {
        $num_cmd =  selectCompteurSite($site_id, $libelle, $bdd);
    } else {
        insertCompteurSite($site_id, $libelle, $num_cmd, $bdd);
    }
    return $num_cmd;
}
function setnumerotation($site_id, $libelle, $numero, $bdd)
{
    $requete = $bdd->prepare("UPDATE compteur SET numero=:numero WHERE libelle=:libelle AND site_id=:site_id");
    $requete->BindParam(':numero', $numero);
    $requete->BindParam(':libelle', $libelle);
    $requete->BindParam(':site_id', $site_id);
    $requete->execute();
}

function format_numero($numero)
{
    return str_pad($numero, 5, "0", STR_PAD_LEFT); //00001;
}
function getNumerotationStock($id_hotel, $bdd)
{
    //   $indice_bs=512;
    $requete = $bdd->prepare("SELECT indice_bs FROM stk__mouvement WHERE  hotel_id=:hotel_id ORDER BY idmvt  DESC LIMIT 1");
    $requete->BindParam(':hotel_id', $id_hotel);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($operations as $op) {
        $indice_bs = $op->indice_bs;
    }
    return $indice_bs;
}
function setNumerotationStock($idmvt, $numero, $bdd)
{
    $numero = $numero + 1;
    $requete = $bdd->prepare("UPDATE stk__mouvement SET indice_bs =:indice_bs WHERE idmvt=:idmvt");
    $requete->BindParam(':indice_bs', $numero);
    $requete->BindParam(':idmvt', $idmvt);
    $requete->execute();
}
function format_numeroStock($numero, $date_com)
{
    $numBon = 'BS/' . $date_com . '/' . str_pad($numero, 4, "0", STR_PAD_LEFT); //0001;
    return $numBon;
}
function mouvementStock($numbon, $type, $quantite, $date_com, $date_h_com, $produit_id, $id_user, $id_hotel, $motif, $bdd)
{
    $requete = $bdd->prepare("INSERT stk__mouvement (type,num_bon,qte_entree,qte_sortie,dte_appro,
                               dte_appro_heure,produit_id,user_id,hotel_id,motif)
                              VALUES(:type,:num_bon,:qte_entree,:qte_sortie,:dte_appro
                            ,:dte_appro_heure,:produit_id,:user_id,:hotel_id,:motif)");
    if ($type == 'sortie') {
        $qte_in = 0;
        $qte_out = $quantite;
    } elseif ($type == 'entree') {
        $qte_in = $quantite;
        $qte_out = 0;
    }

    $requete->BindParam(':type', $type);
    $requete->BindParam(':num_bon', $numbon);
    $requete->BindParam(':qte_entree', $qte_in);
    $requete->BindParam(':qte_sortie', $qte_out);
    $requete->BindParam(':dte_appro', $date_com);
    $requete->BindParam(':dte_appro_heure', $date_h_com);
    $requete->BindParam(':produit_id', $produit_id);
    $requete->BindParam(':user_id', $id_user);
    $requete->BindParam(':hotel_id', $id_hotel);
    $requete->BindParam(':motif', $motif);
    $requete->execute();
    $idmvt = $bdd->lastInsertId();
    //A vérifier la pertinence de cette update  
    $statut = 1;
    $requete = $bdd->prepare("UPDATE stk_produit SET statut =:statut WHERE idprod=:idprod");
    $requete->BindParam(':statut', $statut);
    $requete->BindParam(':idprod', $produit_id);
    $requete->execute();
    return $idmvt;
}
function changeStatutTable($id_table, $statut, $bdd)
{
    $requete = $bdd->prepare("UPDATE  t_client  SET statut =:statut WHERE id_client=:id_client");
    $requete->BindParam(':statut', $statut);
    $requete->BindParam(':id_client', $id_table);
    $requete->execute();
}

function getFactureGlobale($id_hotel, $type, $bdd)
{
    $req = "SELECT a.*,a.mont_ttc_remise AS tauxremise,a.etat AS etat_fact,
                 SUM(a.montant_paye) AS mont_paye,b.nom_client,c.nom_user
          FROM v_com_paiement a, t_client AS b,t_utilisateur AS c
           WHERE a.id_client=b.id_client AND a.id_user=c.id_user
                 AND a.id_hotel=:id  AND a.type=:type
        GROUP BY a.id_fact";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id_hotel);
    $requete->BindParam(':type', $type);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function getFactureGlobaleByUser($id_hotel, $id_user, $type, $bdd)
{
    //Affiche toutes les factures enregistrées par les utilisateurs
    $req = "SELECT a.*,a.mont_ttc_remise AS tauxremise,a.etat AS etat_fact,
                 SUM(a.montant_paye) AS mont_paye,b.nom_client,c.nom_user
          FROM v_com_paiement a, t_client AS b,t_utilisateur AS c
           WHERE a.id_client=b.id_client AND a.id_user=c.id_user
                 AND a.id_hotel=:id AND a.id_user=:id_user AND a.type=:type
        GROUP BY a.id_fact";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id_hotel);
    $requete->BindParam(':id_user', $id_user);
    $requete->BindParam(':type', $type);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function enteteFacture($id_fact, $bdd)
{
    $req = "
        SELECT a.id_sousresto,a.mode,a.id_res,a.id_fact,a.num_fact,a.mont_ttc_remise AS tauxremise,a.etat AS etat_fact,a.id_client,a.taux,a.monnaie,a.type,
                b.nom_client,b.designation AS tbl,b.type AS typecl,b.adresse_provenance_client AS adresse_client,a.date_edition,
                b.telephone_client AS tel_client,a.mont_ttc,a.tva,a.remise AS mont_remise,a.mont_tva, 
                c.nom_user,d.nom_hotel,d.adresse_hotel,e.logo
    FROM t_facture AS a,t_client AS b,t_utilisateur AS c,t_hotel AS d,t_company AS e
    WHERE a.id_client=b.id_client AND a.id_user=c.id_user
              AND a.id_hotel=d.id_hotel AND a.company_id=e.id_c
              AND a.id_fact=:id";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id_fact);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    return $result;
}
function ligneFactureResto($id_fact, $bdd)
{
    $req = "
        SELECT a.taux_prix,a.monnaie, b.idprod,b.code,b.designation,c.prix,c.qte
        FROM t_facture AS a, stk_produit AS b,lignes_commandes AS c
        WHERE a.id_fact=c.commande_id 
        AND c.produit_id=b.idprod
        AND c.commande_id=:id";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id_fact);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function totalMontantPayeFacture($id_fact, $bdd)
{
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
function getInfosSite($id_hotel, $bdd)
{
    $total = 0;
    $req = "SELECT b.*,a.logo
            FROM  t_company AS a,t_hotel AS b 
            WHERE a.id_c=b.company_id 
                  AND b.id_hotel=:id";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id_hotel);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    return $result;
}
function getEtatCommande($valeur)
{
    if ($valeur == 2) {
        return 'Payé';
    } elseif ($valeur == 1) {
        return 'Ouvert';
    } else {
        return 'non payé';
    }
}
function getMvtFinancierGlobale($id_hotel, $type, $date_bd1, $date_bd2, $bdd)
{
    $req = "SELECT a.id_fact, a.date_edition, e.lib,SUM(((c.montantusd*c.taux) + c.montantcdf) - c.rendu) AS mont_paie, SUM(a.mont_ttc) AS mont_ttc, d.nom_user
FROM t_facture AS a, t_reglement As b, paiement AS c, t_utilisateur AS d, t_mode_reglement AS e
WHERE a.id_fact=b.id_fact AND c.id_mode_regl=e.id_mode_regl
AND b.id_regl=c.regl_id AND a.id_user=d.id_user AND b.rejete=1 AND a.id_sousresto IS NULL
AND a.type=:type AND a.id_hotel=:id AND b.dte BETWEEN :dte_bd1 AND :dte_bd2
GROUP BY a.date_edition, e.lib
ORDER BY a.date_edition";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':type', $type);
    $requete->BindParam(':id', $id_hotel);
    $requete->BindParam(':dte_bd1', $date_bd1);
    $requete->BindParam(':dte_bd2', $date_bd2);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function getMvtFinancierGlobaleSresto($id_hotel, $id_sousresto, $type, $date_bd1, $date_bd2, $bdd)
{
    if ($id_sousresto == 0) {
        $req = "SELECT a.id_fact, a.date_edition, e.lib,SUM(((c.montantusd*c.taux) + c.montantcdf) - c.rendu) AS mont_paie, SUM(a.mont_ttc) AS mont_ttc, d.nom_user
        FROM t_facture AS a, t_reglement As b, paiement AS c, t_utilisateur AS d, t_mode_reglement AS e, t_sousresto AS f
        WHERE a.id_fact=b.id_fact AND c.id_mode_regl=e.id_mode_regl AND a.id_sousresto=f.id_sousresto
        AND b.id_regl=c.regl_id AND a.id_user=d.id_user AND b.rejete=1
        AND a.type=:type AND a.id_hotel=:id AND b.dte BETWEEN :dte_bd1 AND :dte_bd2
        GROUP BY a.date_edition, e.lib
        ORDER BY a.date_edition";
        $requete = $bdd->prepare($req);
        $requete->BindParam(':type', $type);
        $requete->BindParam(':id', $id_hotel);
        $requete->BindParam(':dte_bd1', $date_bd1);
        $requete->BindParam(':dte_bd2', $date_bd2);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
    } else {
        $req = "SELECT a.id_fact, a.date_edition, e.lib,SUM(((c.montantusd*c.taux) + c.montantcdf) - c.rendu) AS mont_paie, SUM(a.mont_ttc) AS mont_ttc, d.nom_user
        FROM t_facture AS a, t_reglement As b, paiement AS c, t_utilisateur AS d, t_mode_reglement AS e, t_sousresto AS f
        WHERE a.id_fact=b.id_fact AND c.id_mode_regl=e.id_mode_regl AND a.id_sousresto=f.id_sousresto
        AND b.id_regl=c.regl_id AND a.id_user=d.id_user AND b.rejete=1
        AND a.type=:type AND a.id_hotel=:id AND a.id_sousresto=:id_sousresto AND b.dte BETWEEN :dte_bd1 AND :dte_bd2
        GROUP BY a.date_edition, e.lib
        ORDER BY a.date_edition";
        $requete = $bdd->prepare($req);
        $requete->BindParam(':type', $type);
        $requete->BindParam(':id', $id_hotel);
        $requete->BindParam(':id_sousresto', $id_sousresto);
        $requete->BindParam(':dte_bd1', $date_bd1);
        $requete->BindParam(':dte_bd2', $date_bd2);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
    }
    return $result;
}

function getMvtFinancierGlobaleA($id_hotel, $type, $date_bd1, $date_bd2, $bdd)
{
    $req = "SELECT a.id_fact, a.date_edition, e.lib,SUM(((c.montantusd*c.taux) + c.montantcdf) - c.rendu) AS mont_paie, SUM(a.mont_ttc) AS mont_ttc, d.nom_user
FROM t_facture AS a, t_reglement As b, paiement AS c, t_utilisateur AS d, t_mode_reglement AS e
WHERE a.id_fact=b.id_fact AND c.id_mode_regl=e.id_mode_regl
AND b.id_regl=c.regl_id AND a.id_user=d.id_user AND a.id_sousresto IS NULL
AND a.type=:type AND a.id_hotel=:id AND b.dte BETWEEN :dte_bd1 AND :dte_bd2
GROUP BY a.date_edition, e.lib
ORDER BY a.date_edition";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':type', $type);
    $requete->BindParam(':id', $id_hotel);
    $requete->BindParam(':dte_bd1', $date_bd1);
    $requete->BindParam(':dte_bd2', $date_bd2);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function getMvtFinancierGlobaleAsresto($id_hotel, $id_sousresto, $type, $date_bd1, $date_bd2, $bdd)
{
    if ($id_sousresto == 0) {
        $req = "SELECT a.id_fact, a.date_edition, e.lib,SUM(((c.montantusd*c.taux) + c.montantcdf) - c.rendu) AS mont_paie, SUM(a.mont_ttc) AS mont_ttc, d.nom_user
        FROM t_facture AS a, t_reglement As b, paiement AS c, t_utilisateur AS d, t_mode_reglement AS e, t_sousresto AS f
        WHERE a.id_fact=b.id_fact AND c.id_mode_regl=e.id_mode_regl AND a.id_sousresto=f.id_sousresto
        AND b.id_regl=c.regl_id AND a.id_user=d.id_user 
        AND a.type=:type AND a.id_hotel=:id AND b.dte BETWEEN :dte_bd1 AND :dte_bd2
        GROUP BY a.date_edition, e.lib
        ORDER BY a.date_edition";
        $requete = $bdd->prepare($req);
        $requete->BindParam(':type', $type);
        $requete->BindParam(':id', $id_hotel);
        $requete->BindParam(':dte_bd1', $date_bd1);
        $requete->BindParam(':dte_bd2', $date_bd2);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
    } else {
        $req = "SELECT a.id_fact, a.date_edition, e.lib,SUM(((c.montantusd*c.taux) + c.montantcdf) - c.rendu) AS mont_paie, SUM(a.mont_ttc) AS mont_ttc, d.nom_user
        FROM t_facture AS a, t_reglement As b, paiement AS c, t_utilisateur AS d, t_mode_reglement AS e, t_sousresto AS f
        WHERE a.id_fact=b.id_fact AND c.id_mode_regl=e.id_mode_regl AND a.id_sousresto=f.id_sousresto
        AND b.id_regl=c.regl_id AND a.id_user=d.id_user 
        AND a.type=:type AND a.id_hotel=:id AND a.id_sousresto=:id_sousresto AND b.dte BETWEEN :dte_bd1 AND :dte_bd2
        GROUP BY a.date_edition, e.lib
        ORDER BY a.date_edition";
        $requete = $bdd->prepare($req);
        $requete->BindParam(':type', $type);
        $requete->BindParam(':id', $id_hotel);
        $requete->BindParam(':id_sousresto', $id_sousresto);
        $requete->BindParam(':dte_bd1', $date_bd1);
        $requete->BindParam(':dte_bd2', $date_bd2);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
    }
    return $result;
}

function getMvtFinancierByUserA($id_hotel, $id_user, $type, $date_bd1, $date_bd2, $bdd)
{
    //Affichage par utilisateur
    $req = "SELECT a.id_fact, a.date_edition, e.lib,SUM(((c.montantusd*c.taux) + c.montantcdf) - c.rendu) AS mont_paie, SUM(a.mont_ttc) AS mont_ttc, d.nom_user
FROM t_facture AS a, t_reglement As b, paiement AS c, t_utilisateur AS d, t_mode_reglement AS e
WHERE a.id_fact=b.id_fact AND c.id_mode_regl=e.id_mode_regl
AND b.id_regl=c.regl_id AND a.id_user=d.id_user AND a.id_sousresto IS NULL
AND a.type=:type AND a.id_user=:id_user AND a.id_hotel=:id AND b.dte BETWEEN :dte_bd1 AND :dte_bd2
GROUP BY a.date_edition, e.lib
ORDER BY a.date_edition";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':type', $type);
    $requete->BindParam(':id_user', $id_user);
    $requete->BindParam(':id', $id_hotel);
    $requete->BindParam(':dte_bd1', $date_bd1);
    $requete->BindParam(':dte_bd2', $date_bd2);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function getMvtFinancierByUserAsresto($id_hotel, $id_sousresto, $id_user, $type, $date_bd1, $date_bd2, $bdd)
{
    //Affichage par utilisateur
    if ($id_sousresto == 0) {
        $req = "SELECT a.id_fact, a.date_edition, e.lib,SUM(((c.montantusd*c.taux) + c.montantcdf) - c.rendu) AS mont_paie, SUM(a.mont_ttc) AS mont_ttc, d.nom_user
        FROM t_facture AS a, t_reglement As b, paiement AS c, t_utilisateur AS d, t_mode_reglement AS e, t_sousresto AS f
        WHERE a.id_fact=b.id_fact AND c.id_mode_regl=e.id_mode_regl AND a.id_sousresto=f.id_sousresto
        AND b.id_regl=c.regl_id AND a.id_user=d.id_user 
        AND a.type=:type AND a.id_user=:id_user AND a.id_hotel=:id AND b.dte BETWEEN :dte_bd1 AND :dte_bd2
        GROUP BY a.date_edition, e.lib
        ORDER BY a.date_edition";
        $requete = $bdd->prepare($req);
        $requete->BindParam(':type', $type);
        $requete->BindParam(':id_user', $id_user);
        $requete->BindParam(':id', $id_hotel);
        $requete->BindParam(':dte_bd1', $date_bd1);
        $requete->BindParam(':dte_bd2', $date_bd2);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
    } else {
        $req = "SELECT a.id_fact, a.date_edition, e.lib,SUM(((c.montantusd*c.taux) + c.montantcdf) - c.rendu) AS mont_paie, SUM(a.mont_ttc) AS mont_ttc, d.nom_user
        FROM t_facture AS a, t_reglement As b, paiement AS c, t_utilisateur AS d, t_mode_reglement AS e, t_sousresto AS f
        WHERE a.id_fact=b.id_fact AND c.id_mode_regl=e.id_mode_regl AND a.id_sousresto=f.id_sousresto
        AND b.id_regl=c.regl_id AND a.id_user=d.id_user 
        AND a.type=:type AND a.id_user=:id_user AND a.id_hotel=:id AND a.id_sousresto=:id_sousresto AND b.dte BETWEEN :dte_bd1 AND :dte_bd2
        GROUP BY a.date_edition, e.lib
        ORDER BY a.date_edition";
        $requete = $bdd->prepare($req);
        $requete->BindParam(':type', $type);
        $requete->BindParam(':id_user', $id_user);
        $requete->BindParam(':id', $id_hotel);
        $requete->BindParam(':id_sousresto', $id_sousresto);
        $requete->BindParam(':dte_bd1', $date_bd1);
        $requete->BindParam(':dte_bd2', $date_bd2);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
    }
    return $result;
}

function getMvtFinancierByUser($id_hotel, $id_user, $type, $date_bd1, $date_bd2, $bdd)
{
    //Affichage par utilisateur
    $req = "SELECT a.id_fact, a.date_edition, e.lib,SUM(((c.montantusd*c.taux) + c.montantcdf) - c.rendu) AS mont_paie, SUM(a.mont_ttc) AS mont_ttc, d.nom_user
FROM t_facture AS a, t_reglement As b, paiement AS c, t_utilisateur AS d, t_mode_reglement AS e
WHERE a.id_fact=b.id_fact AND c.id_mode_regl=e.id_mode_regl
AND b.id_regl=c.regl_id AND a.id_user=d.id_user AND b.rejete=1 AND a.id_sousresto IS NULL
AND a.type=:type AND a.id_user=:id_user AND a.id_hotel=:id AND b.dte BETWEEN :dte_bd1 AND :dte_bd2
GROUP BY a.date_edition, e.lib
ORDER BY a.date_edition";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':type', $type);
    $requete->BindParam(':id_user', $id_user);
    $requete->BindParam(':id', $id_hotel);
    $requete->BindParam(':dte_bd1', $date_bd1);
    $requete->BindParam(':dte_bd2', $date_bd2);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function getMvtFinancierByUserSresto($id_hotel, $id_sousresto, $id_user, $type, $date_bd1, $date_bd2, $bdd)
{
    //Affichage par utilisateur
    if ($id_sousresto == 0) {
        $req = "SELECT a.id_fact, a.date_edition, e.lib,SUM(((c.montantusd*c.taux) + c.montantcdf) - c.rendu) AS mont_paie, SUM(a.mont_ttc) AS mont_ttc, d.nom_user
        FROM t_facture AS a, t_reglement As b, paiement AS c, t_utilisateur AS d, t_mode_reglement AS e, t_sousresto AS f
        WHERE a.id_fact=b.id_fact AND c.id_mode_regl=e.id_mode_regl AND a.id_sousresto=f.id_sousresto
        AND b.id_regl=c.regl_id AND a.id_user=d.id_user AND b.rejete=1
        AND a.type=:type AND a.id_user=:id_user AND a.id_hotel=:id AND b.dte BETWEEN :dte_bd1 AND :dte_bd2
        GROUP BY a.date_edition, e.lib
        ORDER BY a.date_edition";
        $requete = $bdd->prepare($req);
        $requete->BindParam(':type', $type);
        $requete->BindParam(':id_user', $id_user);
        $requete->BindParam(':id', $id_hotel);
        $requete->BindParam(':dte_bd1', $date_bd1);
        $requete->BindParam(':dte_bd2', $date_bd2);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
    } else {
        $req = "SELECT a.id_fact, a.date_edition, e.lib,SUM(((c.montantusd*c.taux) + c.montantcdf) - c.rendu) AS mont_paie, SUM(a.mont_ttc) AS mont_ttc, d.nom_user
        FROM t_facture AS a, t_reglement As b, paiement AS c, t_utilisateur AS d, t_mode_reglement AS e, t_sousresto AS f
        WHERE a.id_fact=b.id_fact AND c.id_mode_regl=e.id_mode_regl AND a.id_sousresto=f.id_sousresto
        AND b.id_regl=c.regl_id AND a.id_user=d.id_user AND b.rejete=1
        AND a.type=:type AND a.id_user=:id_user AND a.id_hotel=:id AND a.id_sousresto=:id_sousresto AND b.dte BETWEEN :dte_bd1 AND :dte_bd2
        GROUP BY a.date_edition, e.lib
        ORDER BY a.date_edition";
        $requete = $bdd->prepare($req);
        $requete->BindParam(':type', $type);
        $requete->BindParam(':id_user', $id_user);
        $requete->BindParam(':id', $id_hotel);
        $requete->BindParam(':id_sousresto', $id_sousresto);
        $requete->BindParam(':dte_bd1', $date_bd1);
        $requete->BindParam(':dte_bd2', $date_bd2);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
    }
    return $result;
}

function getlistpaiementGlobal($id_hotel, $t1, $t2, $m_affiche, $temps_sortie, $statut, $bdd)
{
    if ($statut == 'non') {
        $requete = $bdd->prepare("
        SELECT  a.id_res,a.num_reserv,b.nom_client,b.type_cl,c.nom_respo,c.entreprise 
        FROM t_reservation AS a,t_client AS b,t_responsable AS c
        WHERE  a.id_client=b.id_client AND b.id_respo=c.id_respo 
           AND a.etat='execute' 
           AND a.id_hotel=:id_hotel ORDER BY a.num_reserv");
        $requete->BindParam(':id_hotel', $id_hotel);
        $requete->execute();
        $reservations = $requete->fetchAll(PDO::FETCH_OBJ);
    } else {
        $requete = $bdd->prepare("
        SELECT  a.id_res,a.num_reserv,b.nom_client,b.type_cl,c.nom_respo,c.entreprise 
        FROM t_reservation AS a,t_client AS b,t_responsable AS c,t_reserve_chambre AS d,t_chambre_histo AS e
        WHERE  a.id_client=b.id_client AND b.id_respo=c.id_respo AND a.id_res=d.idreserv AND d.id=e.idres_ch
           AND a.etat='execute' AND e.statut=:statut
           AND a.id_hotel=:id_hotel ORDER BY a.num_reserv");
        $requete->BindParam(':statut', $statut);
        $requete->BindParam(':id_hotel', $id_hotel);
        $requete->execute();
        $reservations = $requete->fetchAll(PDO::FETCH_OBJ);
    }
    $temps_actuel = date('H:i:s');
    $today = date('Y-m-d');
    $_SESSION['services'] = array();
    $_SESSION['services']['id_res'] = array();
    $_SESSION['services']['num_reserv'] = array();
    $_SESSION['services']['nom_client'] = array();
    $_SESSION['services']['type_cl'] = array();
    $_SESSION['services']['nom_respo'] = array();
    $_SESSION['services']['montant_total'] = array();
    $_SESSION['services']['montant_paye'] = array();
    $tauxremise = 0;
    $devise = getsymbole_local();
    foreach ($reservations as $rs) {

        $montant_total = 0;
        $montant_paye = 0;
        $type = '';
        $id_res = $rs->id_res;
        $num_reserv = $rs->num_reserv;
        $nom_client = $rs->nom_client;
        $type_cl = $rs->type_cl;
        $nom_respo = $rs->entreprise;
        $result = getMontantPrestation($id_res, $bdd);
        foreach ($result as $r) {
            $type = $r->type;
            $taux_fact = getTauxFacture($type, $r->monnaie, $t1, $t2, $r->taux);
            $montant_paye += getMontantPaye($r->taux_paie, $r->montantusd, $r->montantcdf);
            $montant_total += montant_equivalent_bdd($devise, $m_affiche, $taux_fact, $r->mont_ttc);
            if ($type == 'hebergement') {
                $monttot_heb = 0;
                $mont_tva = 0;
                $mont_remise = 0;
                $infosFactures = getInfosFacture($id_res, $bdd);
                foreach ($infosFactures as $if) {
                    $statut = $if->statut_histo;
                    $date_occ = $if->date_occ_histo;
                    $date_lib = $if->date_lib_histo;
                    $tva = $if->tva;
                    $tauxremise = $if->tauxremise;
                    $mont_tva = $if->mont_tva;
                    $mont_remise = $if->mont_remise;
                    $tarif_ch = $if->tarif_histo;
                    if ($statut == 'occupe') {
                        if ($today > $date_occ && $temps_actuel > $temps_sortie) {
                            $date_lib = date('Y-m-d', time() + 86400);
                        } else {
                            $date_lib = $today;
                        }
                    } else {
                        $date_lib = $date_lib;
                    }
                    $qte = NbJours($date_occ, $date_lib);
                    $monttot_heb += ($tarif_ch * $qte);
                }
                $total = total($monttot_heb, $tva, $tauxremise);
                $mont_ht =  ht($total, $tva, $tauxremise);
                $montant_tva = tva($total, $tva, $tauxremise);
                $monttot_heb = ttc($mont_ht, $montant_tva, $tauxremise);
                $montant_total += montant_equivalent_bdd(getsymbole_local(), $m_affiche, $taux_fact, $monttot_heb);
            }
        }
        $montant_paye = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $taux_fact, $montant_paye);
        array_push($_SESSION['services']['id_res'], $id_res);
        array_push($_SESSION['services']['num_reserv'], $num_reserv);
        array_push($_SESSION['services']['nom_client'], $nom_client);
        array_push($_SESSION['services']['type_cl'], $type_cl);
        array_push($_SESSION['services']['nom_respo'], $nom_respo);
        array_push($_SESSION['services']['montant_total'], $montant_total);
        array_push($_SESSION['services']['montant_paye'], $montant_paye);
    }
    return $_SESSION['services'];
}

function getlistpaiementDetails($id_res, $t1, $t2, $m_affiche, $temps_sortie, $bdd)
{
    $temps_actuel = date('H:i:s');
    $today = date('Y-m-d');
    $_SESSION['data'] = array();
    $_SESSION['data']['id'] = array();
    $_SESSION['data']['dte'] = array();
    $_SESSION['data']['numero'] = array();
    $_SESSION['data']['type'] = array();
    $_SESSION['data']['montant_total'] = array();
    $_SESSION['data']['montant_paye'] = array();
    $_SESSION['data']['taux'] = array();
    $result = getMontantPrestation($id_res, $bdd);
    foreach ($result as $r) {
        $montant_total = 0;
        $montant_paye = 0;
        $type = $r->type;
        $taux_fact = getTauxFacture($type, $r->monnaie, $t1, $t2, $r->taux);
        $id = $r->id_fact;
        $dte = $r->date_edition;
        $numero = $r->num_fact;
        $montant_total = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $taux_fact, $r->mont_ttc);
        if ($type == 'hebergement') {
            $monttot_heb = 0;
            $mont_tva = 0;
            $mont_remise = 0;
            $infosFactures = getInfosFacture($id_res, $bdd);
            foreach ($infosFactures as $if) {
                $statut = $if->statut_histo;
                $date_occ = $if->date_occ_histo;
                $date_lib = $if->date_lib_histo;
                $tva = $if->tva;
                $tauxremise = $if->tauxremise;
                $mont_tva = $if->mont_tva;
                $mont_tva = $if->mont_tva;
                $mont_remise = $if->mont_remise;
                $tarif_ch = $if->tarif_histo;
                if ($statut == 'occupe') {
                    if ($today > $date_occ && $temps_actuel > $temps_sortie) {
                        $date_lib = date('Y-m-d', time() + 86400);
                    } else {
                        $date_lib = $today;
                    }
                } elseif ($statut == 'change') {
                    $date_lib = $date_lib;
                }
                $qte = NbJours($date_occ, $date_lib);
                $monttot_heb += ($tarif_ch * $qte);
            }
            $total = total($monttot_heb, $tva, $tauxremise);
            $mont_ht =  ht($total, $tva, $tauxremise);
            $montant_tva = tva($total, $tva, $tauxremise);
            $monttot_heb = ttc($mont_ht, $montant_tva, $tauxremise);
            $montant_total += $monttot_heb;
        }
        $montant_paye = getMontantPaye($taux_fact, $r->montantusd, $r->montantcdf);
        array_push($_SESSION['data']['id'], $id);
        array_push($_SESSION['data']['dte'], $dte);
        array_push($_SESSION['data']['numero'], $numero);
        array_push($_SESSION['data']['type'], $type);
        array_push($_SESSION['data']['montant_total'], $montant_total);
        array_push($_SESSION['data']['montant_paye'], $montant_paye);
        array_push($_SESSION['data']['taux'], $taux_fact);
    }
    return $_SESSION['data'];
}
function getTauxFacture($service, $monnaie_fact, $tauxdollar, $taux_op, $taux_fact)
{
    if ($monnaie_fact == getsymbole_devise()) {
        if ($service == 'hebergement') {
            //           $taux_fact = $tauxdollar;
            $taux_fact = $taux_fact;
        } else {
            $taux_fact = $taux_op;
        }
    } else {
        $taux_fact = $taux_fact;
    }
    return $taux_fact;
}
function getTauxPrixFact($monnaie_fact, $tauxdollar, $taux_prix)
{
    if ($monnaie_fact == getsymbole_local()) {
        $taux_fact = $taux_prix;
    } else {
        $taux_fact = $tauxdollar;
    }
    return $taux_fact;
}
function MontantServiceone($id_res, $idres_ch, $tauxdollar, $taux_op, $m_affiche, $bdd)
{
    $_SESSION['service'] = array();
    $_SESSION['service']['libelle'] = array();
    $_SESSION['service']['montant_tot'] = array();
    $_SESSION['service']['montant_pay'] = array();
    $result = getMontantPrestation($id_res, $bdd);
    $montant_total = 0;
    $mont_paye = 0;
    foreach ($result as $r) {
        if ($idres_ch == $r->res_ch_id) {
            $type = $r->type;
            $tauxdollar = getTauxFacture($type, $r->monnaie, $tauxdollar, $taux_op, $r->taux);
            $montant_total = montant_equivalent_bdd($r->monnaie, $m_affiche, $tauxdollar, $r->mont_ttc);
            $mont_paye =  getMontantPaye($r->taux_paie, $r->montantusd, $r->montantcdf);
            if (!in_array($type, $_SESSION['service']['libelle'])) {
                array_push($_SESSION['service']['libelle'], $type);
                array_push($_SESSION['service']['montant_tot'], $montant_total);
                array_push($_SESSION['service']['montant_pay'], $mont_paye);
            } else {
                $nbre_heb = count($_SESSION['service']['libelle']);
                for ($i = 0; $i <= $nbre_heb - 1; $i++) {
                    if ($type == $_SESSION['service']['libelle'][$i]) {
                        $_SESSION['service']['montant_tot'][$i] += $montant_total;
                        $_SESSION['service']['montant_pay'][$i] += $mont_paye;
                    }
                }
            }
        }
    }

    return $_SESSION['service'];
}

function MontantServiceglobal($id_res, $tauxdollar, $taux_op, $m_affiche, $bdd)
{
    $_SESSION['service'] = array();
    $_SESSION['service']['libelle'] = array();
    $_SESSION['service']['montant_tot'] = array();
    $_SESSION['service']['montant_pay'] = array();
    $result = getMontantPrestation($id_res, $bdd);
    $montant_total = 0;
    $mont_paye = 0;
    foreach ($result as $r) {
        $type = $r->type;
        // if($type!='hebergement'){
        $tauxdollar = getTauxFacture($type, $r->monnaie, $tauxdollar, $taux_op, $r->taux);
        $montant_total = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar, $r->mont_ttc);
        //            $mont_paye=montant_equivalent_bdd(getsymbole_devise(),$m_affiche, $tauxdollar,$r->mont_paye);
        $mont_paye = getMontantPaye($r->taux_paie, $r->montantusd, $r->montantcdf);
        if (!in_array($type, $_SESSION['service']['libelle'])) {
            array_push($_SESSION['service']['libelle'], $type);
            array_push($_SESSION['service']['montant_tot'], $montant_total);
            array_push($_SESSION['service']['montant_pay'], $mont_paye);
        } else {
            $nbre_heb = count($_SESSION['service']['libelle']);
            for ($i = 0; $i <= $nbre_heb - 1; $i++) {
                if ($type == $_SESSION['service']['libelle'][$i]) {
                    $_SESSION['service']['montant_tot'][$i] += $montant_total;
                    $_SESSION['service']['montant_pay'][$i] += $mont_paye;
                }
            }
        }

        //}
    }

    return $_SESSION['service'];
}
function MontantVersement($user_vers, $type_vers, $tauxdollar, $taux_op, $m_affiche, $bdd)
{
    $requete = $bdd->prepare("SELECT * FROM t_versement WHERE user_vers=:user_vers AND type_vers=:type_vers");
    $requete->BindParam(':user_vers', $user_vers);
    $requete->BindParam(':type_vers', $type_vers);
    $requete->execute();
    $data = array();
    $data['montant_tot'] = 0;
    $data['paie_id'] = 0;
    $data_vers = $requete->fetchAll(PDO::FETCH_OBJ);
    $montant_tot = 0;
    foreach ($data_vers as $r) :
        $paie_id = $r->paie_id;
        $taux_fact = getTauxFacture($r->motif, $r->monaie_vers, $tauxdollar, $taux_op, $r->taux);
        $montant = montant_equivalent_bdd(getsymbole_devise(), $m_affiche, $taux_fact, $r->montant_vers);
        $montant_tot += $montant;
    endforeach;
    $data['paie_id'] = $paie_id;
    $data['montant_tot'] = $montant_tot;
    return $data;
}

function ModulesPack($idpack, $bdd)
{
    $requete = $bdd->prepare("SELECT * FROM v_packs WHERE idpack=:idpack");
    $requete->BindParam(':idpack', $idpack);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function ComparePacks($idpack1, $idpack2, $bdd)
{
    //bool initialisé à zero les deux packs n'ont pas de module commun
    $bool = 0;
    $nbre_mod_com = 0;
    $tmodules_pack1 = array();
    $tmodules_pack2 = array();
    $tmodules_com = array();
    //recuperation modules pack1 & pack2
    $tmodules_pack1 = ModulesPack($idpack1, $bdd);
    $tmodules_pack2 = ModulesPack($idpack2, $bdd);
    $tmodules_com = Array_intersect($tmodules_pack1, $tmodules_pack2);
    $nbre_mod_com = count($tmodules_com);
    if ($nbre_mod_com > 0) $bool = 1;
    return $bool;
}
function StatutChambre($idchambre, $bdd)
{
    $statut = '';
    $requete = $bdd->prepare("SELECT statut FROM t_reserve_chambre WHERE idchambre=:idchambre");
    $requete->BindParam(':idchambre', $idchambre);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) :
        $statut = $r->statut;
    endforeach;
    return $statut;
}
function PrixPack($module, $licence, $bdd)
{
    $data = array();
    $data['id'] = 0;
    $data['prix_user'] = 0;
    $data['prix_par_user'] = 0;
    $requete = $bdd->prepare("SELECT id,prix_user,prix_par_user FROM  prix WHERE module_id=:module  AND souscription=:souscription");
    $requete->BindParam(':module', $module);
    $requete->BindParam(':souscription', $licence);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) :
        $data['id'] = $r->id;
        $data['prix_user'] = $r->prix_user;
        $data['prix_par_user'] = $r->prix_par_user;
    endforeach;
    return $data;
}
function getIdSystem($bdd)
{
    $id = 0;
    $requete = $bdd->prepare("SELECT id_hotel FROM t_hotel WHERE nom_hotel='ntc_2014'");
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($operations as $op) :
        $id = $op->id_hotel;
    endforeach;
    return $id;
}

function insertAccusseReception($email, $nom, $sujet, $message, $statut, $date, $companie_id, $bdd)
{
    $requete = $bdd->prepare("INSERT INTO  accuse_reception (email,nom,sujet,message,statut,date,company_id)
                VALUES(:email,:nom,:sujet,:message,:statut,:date,:company_id)");
    /* monnaie Mis pour les besoins de la cause */
    $requete->BindParam(':email', $email);
    $requete->BindParam(':nom', $nom);
    $requete->BindParam(':sujet', $sujet);
    $requete->BindParam(':message', $message);
    $requete->BindParam(':statut', $statut);
    $requete->BindParam(':date', $date);
    $requete->BindParam(':company_id', $companie_id);
    $requete->execute();
}
function VenteJournaliere($hotel_id, $date_bd1, $date_bd2, $tauxdollar, $m_affiche, $bdd)
{
    $_SESSION['produit'] = array();
    $_SESSION['produit']['code'] = array();
    $_SESSION['produit']['designation'] = array();
    $_SESSION['produit']['qte'] = array();
    $_SESSION['produit']['pt'] = array();

    $requete = $bdd->prepare("SELECT a.taux_prix,a.monnaie,c.code, c.designation, b.qte AS qte, b.prix AS pu, b.dte_h
                            FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a
                            WHERE b.produit_id = c.idprod AND a.id_fact=b.commande_id
                            AND b.dte BETWEEN :date_bd1 AND :date_bd2
                            AND b.hotel_id =:hotel_id ");
    $requete->BindParam(':date_bd1', $date_bd1);
    $requete->BindParam(':date_bd2', $date_bd2);
    $requete->BindParam(':hotel_id', $hotel_id);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($operations as $op) {
        $code = $op->code;
        $designation = $op->designation;
        $qte = $op->qte;
        $tauxdollar1 = getTauxPrixFact($op->monnaie, $tauxdollar, $op->taux_prix);
        $prix_u = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar1, $op->pu);
        $prix_tot = $prix_u * $qte;

        if (!in_array($code, $_SESSION['produit']['code'])) {
            array_push($_SESSION['produit']['code'], $code);
            array_push($_SESSION['produit']['designation'], $designation);
            array_push($_SESSION['produit']['qte'], $qte);
            array_push($_SESSION['produit']['pt'], $prix_tot);
        } else {
            $nbre_heb = count($_SESSION['produit']['code']);
            for ($i = 0; $i <= $nbre_heb - 1; $i++) {
                if ($code == $_SESSION['produit']['code'][$i]) {
                    $_SESSION['produit']['qte'][$i] += $qte;
                    $_SESSION['produit']['pt'][$i] += $prix_tot;
                }
            }
        }
    }

    return $_SESSION['produit'];
}
function getMontantPaye($tauxdollar1, $montantusd, $montantcdf)
{
    $montant = $montantcdf + $montantusd;
    return $montant;
}
function getMontantPaye2($tauxdollar1, $montantusd, $montantcdf)
{
    $montant = $montantcdf + $montantusd * $tauxdollar1;
    return $montant;
}
function CompareMontants($montantusd, $montantcdf, $montanttotusd, $taux)
{
    $montanttotcdf = $montanttotusd * $taux;
    $montants = array();
    $montants['montantusd'] = 0;
    $montants['montantcdf'] = 0;
    $sommemontant = $montantcdf + $montantusd * $taux;
    if ($sommemontant >= $montanttotcdf) {
        if ($montantusd >= $montanttotusd) {
            $montantusd = $montanttotusd;
            $montantcdf = 0;
        } else if ($montantcdf >= $montanttotcdf) {
            $montantcdf = $montanttotcdf;
            $montantusd = 0;
        } else {
            $montantcdf = ($montanttotusd - $montantusd) * $taux;
        }
    }

    $montants['montantusd'] = $montantusd;
    $montants['montantcdf'] = $montantcdf;
    return $montants;
}
function getlistpaiementAcompte($id_hotel, $bdd, $m_affiche, $tauxdollar)
{
    $requete = $bdd->prepare("
        SELECT  a.id_res,a.num_reserv,a.mont_nuite,a.mont_total_res,a.monnaie,b.nom_client,b.type_cl,c.nom_respo,c.entreprise 
        FROM t_reservation AS a,t_client AS b,t_responsable AS c
        WHERE  a.id_client=b.id_client AND b.id_respo=c.id_respo 
           AND a.etat='operationnel' AND a.etat_credit='Cash' AND a.type='reservation'
           AND a.id_hotel=:id_hotel ORDER BY a.num_reserv");
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->execute();
    $reservations = $requete->fetchAll(PDO::FETCH_OBJ);
    $_SESSION['acompte'] = array();
    $_SESSION['acompte']['id_res'] = array();
    $_SESSION['acompte']['num_reserv'] = array();
    $_SESSION['acompte']['nom_client'] = array();
    $_SESSION['acompte']['type_cl'] = array();
    $_SESSION['acompte']['nom_respo'] = array();
    $_SESSION['acompte']['montant_total'] = array();
    $_SESSION['acompte']['montant_paye'] = array();
    $tauxremise = 0;
    foreach ($reservations as $rs) {
        $montant_total = montant_equivalent_bdd($rs->monnaie, $m_affiche, $tauxdollar, $rs->mont_total_res);
        $montant_paye = montant_equivalent_bdd($rs->monnaie, $m_affiche, $tauxdollar, $rs->mont_nuite);
        $id_res = $rs->id_res;
        $num_reserv = $rs->num_reserv;
        $nom_client = $rs->nom_client;
        $type_cl = $rs->type_cl;
        $nom_respo = $rs->entreprise;
        array_push($_SESSION['acompte']['id_res'], $id_res);
        array_push($_SESSION['acompte']['num_reserv'], $num_reserv);
        array_push($_SESSION['acompte']['nom_client'], $nom_client);
        array_push($_SESSION['acompte']['type_cl'], $type_cl);
        array_push($_SESSION['acompte']['nom_respo'], $nom_respo);
        array_push($_SESSION['acompte']['montant_total'], $montant_total);
        array_push($_SESSION['acompte']['montant_paye'], $montant_paye);
    }
    return $_SESSION['acompte'];
}

function MontantVersementheb($user_vers, $type_vers, $tauxdollar, $taux_op, $m_affiche, $bdd)
{
    $requete = $bdd->prepare("SELECT * FROM t_versement WHERE user_vers=:user_vers AND type_vers=:type_vers");
    $requete->BindParam(':user_vers', $user_vers);
    $requete->BindParam(':type_vers', $type_vers);
    $requete->execute();
    $data = array();
    $data['montant_tot'] = 0;
    $data['paie_id'] = 0;
    $data_vers = $requete->fetchAll(PDO::FETCH_OBJ);
    $montant_tot_sys = 0;
    $montant_tot_cdf = 0;
    $montant_tot_usd = 0;
    foreach ($data_vers as $r) :
        $paie_id = $r->paie_id;
        $montant_tot_cdf += ($r->montant_vers + $r->montantusd * $r->taux);
        $montant_tot_usd += ($r->montantusd + $r->montant_vers / $r->taux);
    endforeach;
    if ($m_affiche == getsymbole_devise()) {
        $montant_tot_sys = $montant_tot_usd;
    } else {
        $montant_tot_sys = $montant_tot_cdf;
    }
    $data['paie_id'] = $paie_id;
    $data['montant_tot'] = $montant_tot_sys;
    $data['montant_tot_calc'] = $montant_tot_cdf;
    return $data;
}
function getNbrChambre($id_res, $bdd)
{
    $requete = $bdd->prepare("SELECT COUNT(idchambre) AS nbr_ch FROM t_reserve_chambre WHERE idreserv=:id_res");
    $requete->BindParam(':id_res', $id_res);
    $requete->execute();
    $nombre = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($nombre as $nbr) {
        $nbrCh = $nbr->nbr_ch;
    }
    return $nbrCh;
}
function getTarifChambre($bdd, $idres_ch)
{
    $requete = $bdd->prepare("SELECT idres_ch,SUM(tarif_ch) AS tarif FROM t_chambre_histo WHERE idres_ch=:idres_ch GROUP BY idres_ch");
    $requete->BindParam(':idres_ch', $idres_ch);
    $requete->execute();
    $total = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($total as $tot) {
        $som_tarir_ch = $tot->tarif;
    }
    return $som_tarir_ch;
}
function getTotalNuite($bdd, $id_res)
{
    $requete = $bdd->prepare("SELECT SUM(a.tarif_ch) AS total_nuite FROM t_chambre_histo AS a, t_reserve_chambre AS b WHERE a.idres_ch=b.id AND b.idreserv=:id_res GROUP BY b.idreserv");
    $requete->BindParam(':id_res', $id_res);
    $requete->execute();
    $total_nuite = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($total_nuite as $tot) {
        $total_nuite = $tot->total_nuite;
    }
    return $total_nuite;
}

function getMontantPaye_ch($tarif, $mont_paie, $total_nuite, $nbre_ch)
{
    $montant_paye = $tarif + ($mont_paie - $total_nuite) / $nbre_ch;

    return $montant_paye;
}
function getTotalMontPayeSejour($bdd, $id_res)
{
    $requete = $bdd->prepare("SELECT SUM(c.montantusd*c.taux+c.montantcdf-c.rendu) AS montantpaye
                                FROM t_facture AS a, t_reglement AS b, paiement AS c
                                WHERE a.id_fact=b.id_fact AND b.id_regl=c.regl_id AND a.type='hebergement' AND a.id_res=:id_res");
    $requete->BindParam(':id_res', $id_res);
    $requete->execute();
    $montantpaye = $requete->fetch(PDO::FETCH_OBJ);
    return $montantpaye->montantpaye;
}

function getDataDetailPaiement($id_res, $t1, $t2, $m_affiche, $temps_sortie, $bdd)
{
    $temps_actuel = date('H:i:s');
    $today = date('Y-m-d');
    $montant_paye = 0;
    $_SESSION['data'] = array();
    $_SESSION['data']['id'] = array();
    $_SESSION['data']['dte'] = array();
    $_SESSION['data']['dtet'] = array();
    $_SESSION['data']['numero'] = array();
    $_SESSION['data']['type'] = array();
    $_SESSION['data']['montant_paye'] = array();
    $_SESSION['data']['taux'] = array();
    $_SESSION['data']['client'] = array();
    $_SESSION['data']['mode'] = array();
    $_SESSION['data']['num_recu'] = array();
    $result = getDataFactureClient($id_res, $bdd);
    foreach ($result as $r) {
        $id_regl = $r->id_regl;
        $type = $r->type_fact;
        $taux_fact = $r->txpaie;
        $dte = $r->dte;
        $dtet = $r->date_regl;
        $numero = $r->num_fact;
        $montant_paye = $r->montantusd * $taux_fact + $r->montantcdf - $r->rendu;
        $montant_paye = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $taux_fact, $montant_paye);
        $nom_cl = $r->nom_client;
        $mode_paie = $r->lib_mode;
        $numero_recu = $r->numero_recu;
        array_push($_SESSION['data']['id'], $id_regl);
        array_push($_SESSION['data']['dte'], $dte);
        array_push($_SESSION['data']['dtet'], $dtet);
        array_push($_SESSION['data']['numero'], $numero);
        array_push($_SESSION['data']['type'], $type);
        array_push($_SESSION['data']['montant_paye'], $montant_paye);
        array_push($_SESSION['data']['taux'], $taux_fact);
        array_push($_SESSION['data']['client'], $nom_cl);
        array_push($_SESSION['data']['mode'], $mode_paie);
        array_push($_SESSION['data']['num_recu'], $numero_recu);
    }
    return $_SESSION['data'];
}
function getDataFactureClient($id_res, $bdd)
{
    $requete = $bdd->prepare("SELECT  *,b.numero AS numero_recu,d.lib AS lib_mode,a.type AS type_fact ,c.taux AS txpaie
                                FROM v_paiement AS a,t_reglement AS b,paiement AS c,t_mode_reglement AS d,t_client AS e 
                            WHERE a.id_fact=b.id_fact AND b.id_regl=c.regl_id 
                            AND c.id_mode_regl=d.id_mode_regl 
                            AND a.id_client=e.id_client 
                            AND id_res=:id_res GROUP BY b.id_regl");
    $requete->BindParam(':id_res', $id_res);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function dateAfficheForHr($stringdate)
{
    if ($stringdate != '') {
        $stringdate = trim($stringdate);
        $tmp = explode(" ", $stringdate);
        $date_iso = dateAffiche($tmp[0]) . " " . $tmp[1];
        return $date_iso;
    }
}
function getFactureGlobaleByDte($id_hotel, $type, $dte1, $dte2, $filtre, $bdd)
{
    if ($filtre == 1) {
        $req = "SELECT a.*,a.mont_ttc_remise AS tauxremise,a.etat AS etat_fact,
                 SUM(a.montant_paye) AS mont_paye,b.nom_client,b.designation,c.nom_user
          FROM v_com_paiement a, t_client AS b,t_utilisateur AS c
           WHERE a.id_client=b.id_client AND a.id_user=c.id_user AND a.id_sousresto IS NULL
                 AND a.id_hotel=:id  AND a.type=:type
                 AND a.date_edition BETWEEN :dte1 AND :dte2
        GROUP BY a.id_fact";
    } else {
        $req = "SELECT a.*,b.nom_client,b.designation,c.nom_user
          FROM t_facture AS a, t_client AS b,t_utilisateur AS c
           WHERE a.id_client=b.id_client AND a.id_user=c.id_user AND a.id_sousresto IS NULL
                 AND a.id_hotel=:id  AND a.type=:type AND a.etat_cmd=3
                 AND a.date_edition BETWEEN :dte1 AND :dte2
        GROUP BY a.id_fact";
    }
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id_hotel);
    $requete->BindParam(':type', $type);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function getFactureGlobaleByDteSresto($id_hotel, $id_sousresto, $type, $dte1, $dte2, $filtre, $bdd)
{
    if ($filtre == 1) {
        if ($id_sousresto == 0) {
            $req = "SELECT a.*,a.mont_ttc_remise AS tauxremise,a.etat AS etat_fact,
            SUM(a.montant_paye) AS mont_paye,b.nom_client,b.designation,c.nom_user
            FROM v_com_paiement_sresto a, t_client AS b,t_utilisateur AS c
            WHERE a.id_client=b.id_client AND a.id_user=c.id_user
            AND a.id_hotel=:id  AND a.type=:type
            AND a.date_edition BETWEEN :dte1 AND :dte2
            GROUP BY a.id_fact";
            $requete = $bdd->prepare($req);
            $requete->BindParam(':id', $id_hotel);
            $requete->BindParam(':type', $type);
            $requete->BindParam(':dte1', $dte1);
            $requete->BindParam(':dte2', $dte2);
            $requete->execute();
            $result = $requete->fetchAll(PDO::FETCH_OBJ);
        } else {
            $req = "SELECT a.*,a.mont_ttc_remise AS tauxremise,a.etat AS etat_fact,
            SUM(a.montant_paye) AS mont_paye,b.nom_client,b.designation,c.nom_user
            FROM v_com_paiement_sresto a, t_client AS b,t_utilisateur AS c
            WHERE a.id_client=b.id_client AND a.id_user=c.id_user
            AND a.id_hotel=:id AND a.id_sousresto=:id_sousresto AND a.type=:type
            AND a.date_edition BETWEEN :dte1 AND :dte2
            GROUP BY a.id_fact";
            $requete = $bdd->prepare($req);
            $requete->BindParam(':id', $id_hotel);
            $requete->BindParam(':id_sousresto', $id_sousresto);
            $requete->BindParam(':type', $type);
            $requete->BindParam(':dte1', $dte1);
            $requete->BindParam(':dte2', $dte2);
            $requete->execute();
            $result = $requete->fetchAll(PDO::FETCH_OBJ);
        }
    } else {
        if ($id_sousresto == 0) {
            $req = "SELECT a.*,b.nom_client,b.designation,c.nom_user, d.libelle AS resto
            FROM t_facture AS a, t_client AS b,t_utilisateur AS c,t_sousresto AS d
            WHERE a.id_client=b.id_client AND a.id_user=c.id_user AND a.id_sousresto=d.id_sousresto
            AND a.id_hotel=:id  AND a.type=:type AND a.etat_cmd=3
            AND a.date_edition BETWEEN :dte1 AND :dte2
            GROUP BY a.id_fact";
            $requete = $bdd->prepare($req);
            $requete->BindParam(':id', $id_hotel);
            $requete->BindParam(':type', $type);
            $requete->BindParam(':dte1', $dte1);
            $requete->BindParam(':dte2', $dte2);
            $requete->execute();
            $result = $requete->fetchAll(PDO::FETCH_OBJ);
        } else {
            $req = "SELECT a.*,b.nom_client,b.designation,c.nom_user, d.libelle AS resto
            FROM t_facture AS a, t_client AS b,t_utilisateur AS c,t_sousresto AS d
            WHERE a.id_client=b.id_client AND a.id_user=c.id_user AND a.id_sousresto=d.id_sousresto
            AND a.id_hotel=:id AND a.id_sousresto=:id_sousresto AND a.type=:type AND a.etat_cmd=3
            AND a.date_edition BETWEEN :dte1 AND :dte2
            GROUP BY a.id_fact";
            $requete = $bdd->prepare($req);
            $requete->BindParam(':id', $id_hotel);
            $requete->BindParam(':id_sousresto', $id_sousresto);
            $requete->BindParam(':type', $type);
            $requete->BindParam(':dte1', $dte1);
            $requete->BindParam(':dte2', $dte2);
            $requete->execute();
            $result = $requete->fetchAll(PDO::FETCH_OBJ);
        }
    }
    return $result;
}

function getFactureGlobaleByUserByDte($id_hotel, $id_user, $type, $dte1, $dte2, $filtre, $bdd)
{
    //Affiche toutes les factures enregistrées par les utilisateurs
    if ($filtre == 1) {
        $req = "SELECT a.*,a.mont_ttc_remise AS tauxremise,a.etat AS etat_fact,
                 SUM(a.montant_paye) AS mont_paye,b.nom_client,b.designation,c.nom_user
          FROM v_com_paiement a, t_client AS b,t_utilisateur AS c
           WHERE a.id_client=b.id_client AND a.id_user=c.id_user AND a.id_sousresto IS NULL
                 AND a.id_hotel=:id AND a.id_user=:id_user AND a.type=:type  
                 AND a.date_edition BETWEEN :dte1 AND :dte2
        GROUP BY a.id_fact";
    } else {
        $req = "SELECT a.*,b.nom_client,b.designation,c.nom_user
          FROM t_facture AS a, t_client AS b,t_utilisateur AS c
           WHERE a.id_client=b.id_client AND a.id_user=c.id_user AND a.id_sousresto IS NULL
                 AND a.id_hotel=:id AND a.id_user=:id_user AND a.type=:type AND a.etat_cmd=3
                 AND a.date_edition BETWEEN :dte1 AND :dte2
        GROUP BY a.id_fact";
    }
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id_hotel);
    $requete->BindParam(':id_user', $id_user);
    $requete->BindParam(':type', $type);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function getFactureGlobaleByUserByDteSresto($id_hotel, $id_sousresto, $id_user, $type, $dte1, $dte2, $filtre, $bdd)
{
    //Affiche toutes les factures enregistrées par les utilisateurs
    if ($filtre == 1) {
        if ($id_sousresto == 0) {
            $req = "SELECT a.*,a.mont_ttc_remise AS tauxremise,a.etat AS etat_fact,
            SUM(a.montant_paye) AS mont_paye,b.nom_client,b.designation,c.nom_user
            FROM v_com_paiement_sresto a, t_client AS b,t_utilisateur AS c
            WHERE a.id_client=b.id_client AND a.id_user=c.id_user
            AND a.id_hotel=:id AND a.id_user=:id_user AND a.type=:type  
            AND a.date_edition BETWEEN :dte1 AND :dte2
            GROUP BY a.id_fact";
            $requete = $bdd->prepare($req);
            $requete->BindParam(':id', $id_hotel);
            $requete->BindParam(':id_user', $id_user);
            $requete->BindParam(':type', $type);
            $requete->BindParam(':dte1', $dte1);
            $requete->BindParam(':dte2', $dte2);
            $requete->execute();
            $result = $requete->fetchAll(PDO::FETCH_OBJ);
        } else {
            $req = "SELECT a.*,a.mont_ttc_remise AS tauxremise,a.etat AS etat_fact,
            SUM(a.montant_paye) AS mont_paye,b.nom_client,b.designation,c.nom_user
            FROM v_com_paiement_sresto a, t_client AS b,t_utilisateur AS c
            WHERE a.id_client=b.id_client AND a.id_user=c.id_user
            AND a.id_hotel=:id AND a.id_sousresto=:id_sousresto AND a.id_user=:id_user AND a.type=:type  
            AND a.date_edition BETWEEN :dte1 AND :dte2
            GROUP BY a.id_fact";
            $requete = $bdd->prepare($req);
            $requete->BindParam(':id', $id_hotel);
            $requete->BindParam(':id_sousresto', $id_sousresto);
            $requete->BindParam(':id_user', $id_user);
            $requete->BindParam(':type', $type);
            $requete->BindParam(':dte1', $dte1);
            $requete->BindParam(':dte2', $dte2);
            $requete->execute();
            $result = $requete->fetchAll(PDO::FETCH_OBJ);
        }
    } else {
        if ($id_sousresto == 0) {
            $req = "SELECT a.*,b.nom_client,b.designation,c.nom_user,d.libelle AS resto
            FROM t_facture AS a, t_client AS b,t_utilisateur AS c,t_sousresto AS d
            WHERE a.id_client=b.id_client AND a.id_user=c.id_user AND a.id_sousresto=d.id_sousresto
            AND a.id_hotel=:id AND a.id_user=:id_user AND a.type=:type AND a.etat_cmd=3
            AND a.date_edition BETWEEN :dte1 AND :dte2
            GROUP BY a.id_fact";
            $requete = $bdd->prepare($req);
            $requete->BindParam(':id', $id_hotel);
            $requete->BindParam(':id_user', $id_user);
            $requete->BindParam(':type', $type);
            $requete->BindParam(':dte1', $dte1);
            $requete->BindParam(':dte2', $dte2);
            $requete->execute();
            $result = $requete->fetchAll(PDO::FETCH_OBJ);
        } else {
            $req = "SELECT a.*,b.nom_client,b.designation,c.nom_user,d.libelle AS resto
            FROM t_facture AS a, t_client AS b,t_utilisateur AS c,t_sousresto AS d
            WHERE a.id_client=b.id_client AND a.id_user=c.id_user AND a.id_sousresto=d.id_sousresto
            AND a.id_hotel=:id AND a.id_sousresto=:id_sousresto AND a.id_user=:id_user AND a.type=:type AND a.etat_cmd=3
            AND a.date_edition BETWEEN :dte1 AND :dte2
            GROUP BY a.id_fact";
            $requete = $bdd->prepare($req);
            $requete->BindParam(':id', $id_hotel);
            $requete->BindParam(':id_sousresto', $id_sousresto);
            $requete->BindParam(':id_user', $id_user);
            $requete->BindParam(':type', $type);
            $requete->BindParam(':dte1', $dte1);
            $requete->BindParam(':dte2', $dte2);
            $requete->execute();
            $result = $requete->fetchAll(PDO::FETCH_OBJ);
        }
    }
    return $result;
}


function affiche_montant2($m_affiche1, $tauxdollar1, $mont_fc, $mont_usd)
{
    if ($m_affiche1 == 'USD') {
        $mont = $mont_usd + ($mont_fc / $tauxdollar1);
        return $mont;
    } else {
        $mont = $mont_fc + ($mont_usd * $tauxdollar1);
        return $mont;
    }
}
function getLibelleVersement($bdd, $sorte, $hotel_id, $user_id)
{
    $date_jour = date('Y-m-d');
    $requete = $bdd->prepare("SELECT * FROM t_motif AS a, t_motif_type AS b
                            WHERE  a.type_id=b.idmotiftype AND a.sorte=:sorte 
                            AND b.type='Entree' 
                            AND a.hotel_id=:hotel_id AND a.idmotif NOT IN (
                            SELECT c.motif_id
                            FROM t_motif AS a, t_operation AS c
                            WHERE a.idmotif=c.motif_id
                            AND c.date_bon=:date_jour
                            AND c.user_vers=:user_id
                            )");
    $requete->BindParam(':sorte', $sorte);
    $requete->BindParam(':hotel_id', $hotel_id);
    $requete->BindParam(':date_jour', $date_jour);
    $requete->BindParam(':user_id', $user_id);
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_OBJ);
}


function listeAffect_sresto($id_hotel, $bdd)
{
    //Affiche toutes les factures enregistrées par les utilisateurs
    $req = "SELECT * FROM t_sousresto AS a,affectation_sousresto AS b, t_utilisateur AS c
                    WHERE b.sousresto_id=a.id_sousresto AND b.user_id=c.id_user AND a.hotel_id=:id_hotel
                    ORDER BY b.id_affect DESC";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function getNameSresto($resto_id, $bdd)
{
    $total = 0;
    $requete = $bdd->prepare("SELECT libelle FROM t_sousresto WHERE id_sousresto=:id_sousresto");
    $requete->BindParam(':id_sousresto', $resto_id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function listeProduitIngredient($plat_id, $id_hotel, $bdd)
{
    //$plat_id=8;
    $req = "SELECT * FROM t_ingredient AS a
            WHERE a.plat_id=:plat_id AND a.hotel_id=:id_hotel";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':plat_id', $plat_id);
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function listeSousresto($id_hotel, $bdd)
{
    //
    $req = "SELECT a.id_depot,a.libelle,b.id_sousresto,b.libelle AS resto FROM t_depot AS a, t_sousresto AS b
                    WHERE a.id_depot=b.depot_id AND a.hotel_id=:id_hotel";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function setDepotIDmvtStock($idmvt, $depot_id, $bdd)
{
    $requete = $bdd->prepare("UPDATE stk__mouvement SET depot_id =:depot_id WHERE idmvt=:idmvt");
    $requete->BindParam(':depot_id', $depot_id);
    $requete->BindParam(':idmvt', $idmvt);
    $requete->execute();
}

function getNbreUser($id_hotel, $bdd)
{
    $requete = $bdd->prepare("SELECT nbre_user,nbre_user_add,state_paie_user FROM t_hotel WHERE id_hotel=:id_hotel");
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function getNbreUser_bdd($id_hotel, $bdd)
{
    $requete = $bdd->prepare("SELECT nbre_user FROM t_hotel WHERE id_hotel=:id_hotel");
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $op) {
        $nbre_user = $op->nbre_user;
    }
    return $nbre_user;
}

function setNbreUser($nbre_user, $nbre_user_add, $id_hotel, $bdd)
{
    $requete = $bdd->prepare("UPDATE t_hotel SET nbre_user=:nbre_user,nbre_user_add=:nbre_user_add WHERE id_hotel=:id_hotel");
    $requete->BindParam(':nbre_user', $nbre_user);
    $requete->BindParam(':nbre_user_add', $nbre_user_add);
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->execute();
}
//NUMEROTATION POUR VERSEMENT
function verifCompteurSite2($site_id, $libelle, $bdd)
{
    $nb = 0;
    $bool = 0;
    $requete = $bdd->prepare("SELECT COUNT(*) AS nb_lg FROM compteur WHERE libelle=:libelle  AND id_sousresto=:id_hotel");
    /* monnaie Mis pour les besoins de la cause */
    $requete->BindParam(':libelle', $libelle);
    $requete->BindParam(':id_hotel', $site_id);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($operations as $op) :
        $nb = $op->nb_lg;
    endforeach;
    if ($nb > 0) $bool = 1;
    return $bool;
}
function insertCompteurSite2($site_id, $libelle, $numero, $bdd)
{
    $requete = $bdd->prepare("INSERT INTO compteur (libelle,numero,id_sousresto)
                VALUES(:libelle,:numero,:site_id)");
    $requete->BindParam(':libelle', $libelle);
    $requete->BindParam(':numero', $numero);
    $requete->BindParam(':site_id', $site_id);
    $requete->execute();
}

function selectCompteurSite2($site_id, $libelle, $bdd)
{
    $numero = 0;
    $requete = $bdd->prepare("SELECT numero FROM compteur WHERE libelle=:libelle  AND id_sousresto=:id_hotel");
    $requete->BindParam(':libelle', $libelle);
    $requete->BindParam(':id_hotel', $site_id);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($operations as $op) :
        $numero = $op->numero;
    endforeach;
    return $numero;
}
function getnumerotation2($site_id, $libelle, $bdd)
{
    $num_cmd = 1;
    $bool = verifCompteurSite2($site_id, $libelle, $bdd);
    if ($bool == 1) {
        $num_cmd =  selectCompteurSite2($site_id, $libelle, $bdd);
    } else {
        insertCompteurSite2($site_id, $libelle, $num_cmd, $bdd);
    }
    return $num_cmd;
}
function setnumerotation2($site_id, $libelle, $numero, $bdd)
{
    $requete = $bdd->prepare("UPDATE compteur SET numero=:numero WHERE libelle=:libelle AND id_sousresto=:site_id");
    $requete->BindParam(':numero', $numero);
    $requete->BindParam(':libelle', $libelle);
    $requete->BindParam(':site_id', $site_id);
    $requete->execute();
}
//FIN NUMEROTATION
function MontantsFacture($facture_id, $bdd)
{
    $_SESSION['datas_exist'] = 0;
    $_SESSION['montant_total'] = 0;
    $_SESSION['montant_paye'] = 0;
    $_SESSION['montant_a_paye'] = 0;
    $req = "
        SELECT b.id_fact,mont_ttc AS montant_total,SUM(e.montantusd+e.montantcdf) AS montant_paye
            FROM  t_facture AS b, t_reglement AS d, paiement AS e
            WHERE b.id_fact=d.id_fact 
                  AND d.id_regl=e.regl_id
                  AND b.id_fact=:facture_id 
                  AND b.type='achat'
                  GROUP BY b.id_fact
                ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':facture_id', $facture_id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $op) {
        $_SESSION['datas_exist'] = 1;
        $_SESSION['montant_total'] = $op->montant_total;
        $_SESSION['montant_paye'] = $op->montant_paye;
        $_SESSION['montant_a_paye'] = $op->montant_total - $op->montant_paye;
    }
}
function ListAccompagnements($plat_id, $id_hotel, $sousresto_id, $bdd)
{
    $accpgmt = 0;
    $plats = array();
    array_push($plats, 33);
    array_push($plats, 34);
    array_push($plats, 35);
    array_push($plats, 36);
    array_push($plats, 37);
    array_push($plats, 41);
    $req = "SELECT famille_id FROM stk_produit AS a WHERE a.idprod=:plat_id";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':plat_id', $plat_id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $op) {
        $famille_id = $op->famille_id;
        if (in_array($famille_id, $plats)) {
            $accpgmt = 1;
        }
    }
    return $accpgmt;
}

//KING 29/06
function dateAffiche2($stringdate)
{
    if ($stringdate != '') {
        $stringdate = trim($stringdate);
        $tmp = explode("-", $stringdate);
        $tmp0 = substr($tmp[0], 2);
        $date_iso = $tmp[2] . "/" . $tmp[1] . "/" . $tmp0;
        return $date_iso;
    }
}
