<?php
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);
session_start();
include '../bdd/connexion.php';
include './Panier.php';
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include '../../FUNCTION/hebergement.php';
include '../../FUNCTION/restaurant.php';
$remise_fact = 0;
$monnaie = $m_affiche;
$tauxdollar = $_SESSION['tauxdollar'];
$taux_op = $_SESSION['taux_resto'];
$tva_fact = 0;
$cmd_id = 0;
$id = 0;
$cl_tbl = '';
$id_fact = 0;
$id_fact_fus = 0;
$id_tbl_fus = 0;
$totaux=0;
$_SESSION['saveprod'] = array();
$_SESSION['saveprod']['id'] = array();
$_SESSION['saveprod']['qte'] = array();
$_SESSION['nbrcouvert'] = 0;
if (!empty($_GET['table_id'])) {
    $table_id = $_GET['table_id'];
    $id_tbl_fus = $table_id;
    $data = FusionIDs($table_id, $bdd);
    $nbre = count($data['ids']);
    //Compteur Panier
    $k = 0;
    for ($z= 0; $z < $nbre; $z++) {
        $id_client = $data['ids'][$z];
        $panier = new Panier();
        $panier->initialiser();
        $requete = $bdd->prepare("SELECT c.nbrcouvert,f.monnaie,f.taux_prix, f.montant_total,f.mont_tva,f.mont_ttc,f.date_edition,f.dte_time,f.mode,f.mont_ttc_remise,f.taux,f.tva,f.id_fact,f.num_fact,r.id_res,r.num_reserv,c.designation,c.id_client,c.nom_client,c.type
        FROM  t_reservation AS r,t_client AS c,t_facture AS f 
	 WHERE f.type='restaurant' AND f.etat_cmd='1' AND f.id_client=c.id_client
           AND r.id_res=f.id_res
		   AND r.id_hotel=:hotel_id
           AND f.id_client=:id_client
		   ORDER BY f.id_fact DESC
                   LIMIT 1");
        $requete->BindParam(':id_client', $id_client);
        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
        $requete->execute();
        $reservation_attente = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($reservation_attente as $ra) {
            $id = $ra->id_res;
            $id_fact = $ra->id_fact;
            $id_fact_fus = ReturnFusionID($id_fact, $bdd);
            $remise_fact = $ra->mont_ttc_remise;
            $mont_remise = $ra->tva;
            $tva_fact = $ra->tva;
            $mont_tva = $ra->mont_tva;
            $mont_ttc = $ra->mont_ttc;
            $id_cl = $ra->id_client;
            $cmd_num = $ra->num_reserv;
            $tbl = $ra->designation;
            $cl = $ra->nom_client;
            $taux_op = $ra->taux;
            $tauxdollar = $ra->taux_prix;
            $monnaie = $ra->monnaie;
            $num_fact= $ra->num_fact;
            $_SESSION['nom_client'] = $cl;
            $_SESSION['date_edition'] = $ra->date_edition;
            $_SESSION['date_edition2'] = $ra->dte_time;
            $date_edition = $ra->date_edition;
            $typ = $ra->type;
            if ($typ == 'client') {
                $cl_tbl = $cl;
            } else if ($typ == 'table') {
                $cl_tbl = $tbl;
            } else {
                $cl_tbl = 'Client occasionnel';
            }
            $_SESSION['num_commande'] = $ra->num_fact;
            $_SESSION['panier']['remise'] = $ra->mont_ttc_remise;
            $cmd_num = $id_fact;
            $cmd_id = $cmd_num;
            $_SESSION['nbrcouvert'] += $ra->nbrcouvert;
            $requete = $bdd->prepare("SELECT  p.idprod,l.*,p.designation,p.monnaie,p.repas FROM  lignes_commandes AS l,stk_produit As p WHERE l.produit_id=p.idprod AND l.commande_id=:cmd_id AND l.hotel_id=:hotel_id ORDER BY p.designation");
            $requete->BindParam(':cmd_id', $cmd_num);
            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
            $requete->execute();
            $reservation_l_attente = $requete->fetchAll(PDO::FETCH_OBJ);

            foreach ($reservation_l_attente as $r) {
                $qte = $r->qte;
                $prix = $r->prix;
                $prix2 = $r->prix2;
                $idprod = $r->idprod;
                $designation = $r->designation;
                $repas = $r->repas;
                $pa = $r->id;
                $qteoffert = $r->qteoffert;
                $des_plt = $r->accomp;
                $offre = 0;
                if ($prix2 > 0) {
                    $offre = 1;
                }
                array_push($_SESSION['panier']['id_article'], $idprod);
                array_push($_SESSION['panier']['nom'], $designation);
                array_push($_SESSION['panier']['qte'], $qte);
                array_push($_SESSION['panier']['prix'], $prix);
                array_push($_SESSION['panier']['repas'], $repas);
                array_push($_SESSION['panier']['cpt'], $k);
                array_push($_SESSION['panier']['qteoffert'], $qteoffert);
                array_push($_SESSION['panier']['pa'], $pa);
                array_push($_SESSION['panier']['prix2'], $prix2);
                array_push($_SESSION['panier']['offre'], $offre);
                array_push($_SESSION['panier']['genre'], $offre);
                array_push($_SESSION['panier']['description'], $des_plt);


                array_push($_SESSION['saveprod']['id'], $pa);
                $_SESSION['saveprod']['qte'][$pa] = $qte;

                $k++;
            }
            $_SESSION['cptpanier'] = $k;
  
        }
 
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <?php
    // Récuperation du TVA
    $panier = new Panier();
    $nbArticles = count($_SESSION['panier']['id_article']);
    $mont_ht = $panier->montant_panier();
    ?>
    <table class="table table-hover table-condensed" id="tab_commandes">
          <thead>
          <th colspan="5"><span style="margin-left:160px;">FACTURE N° <?php echo $num_fact?></span></th>
        </thead>
        <tbody>
        <tr>
            <th></th>
            <th><a href='#'></a></th>
            <th class='mailbox-attachment'>QTE</th>
            <th class='mailbox-subject'> DESIGNATION</th>
            <th class='mailbox-attachment'></th>
            <th class='mailbox-date text-right'>PRIX</th>
        </tr>
            <?php
            $monnaie_local = getsymbole_local();
            $des_plt = '';
            $kt = 0;
            for ($i = 0; $i <= $nbArticles - 1; $i++) {
                $des_plt = '';
                $tarif = $_SESSION['panier']['prix'][$i] * $_SESSION['panier']['qte'][$i];
                $tarif = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $tarif);
                $plat_idc = $_SESSION['panier']['id_article'][$i];
                $cpt_pan = $_SESSION['panier']['cpt'][$i];
                $des_plt = $_SESSION['panier']['description'][$i];

            ?>
            <tr class="clcprod" idp="<?php echo 'xx' . $_SESSION['panier']['cpt'][$i] ?>"
                idcpt="<?php echo $_SESSION['panier']['cpt'][$i] ?>"
                idart='<?php echo $_SESSION['panier']['id_article'][$i] ?>'>
                <td>
                    <input name="affichage_produit[]" type='checkbox'
                        class="affichage_produit <?php echo 'xx' . $_SESSION['panier']['cpt'][$i] ?>"
                        repas="<?php echo $_SESSION['panier']['repas'][$i] ?>"
                        id="<?php echo $_SESSION['panier']['cpt'][$i] ?>"
                        idp="<?php echo $_SESSION['panier']['id_article'][$i] ?>"
                        value="<?php echo $_SESSION['panier']['id_article'][$i] ?>">
                </td>
                <td><a href='#'></a></td>
                <td class='mailbox-attachment' id="<?php echo $_SESSION['panier']['id_article'][$i] ?>">
                    <?php echo $_SESSION['panier']['qte'][$i] ?></td>
                <td class='mailbox-subject' id="<?php echo 'libelle_repas' . $_SESSION['panier']['id_article'][$i] ?>">
                    <?php

                        echo $_SESSION['panier']['nom'][$i] . '</br>' . $des_plt;
                        ?>
                </td>
                <td class='mailbox-attachment'></td>
                <td class='mailbox-date text-right'><?php echo afficheMontant2($m_affiche, $tarif) ?></td>
            </tr>
            <?php };
            $total1 = $mont_ht;
            $total = total($total1, $tva_fact, $remise_fact);
            $mont_tva = tva($total, $tva_fact, $remise_fact);
            $mont_rmz = remise($total1, $tva_fact, $remise_fact);
            $mont_ht =  ht($total, $tva_fact, $remise_fact);
            $ttc =  ttc($mont_ht, $mont_tva, $mont_rmz);
            ?>
            <tr>
                <th class='mailbox-attachment' colspan="5">Montant HT</th>
                <th class="text-right">
                    <i>
                        <?php
                        echo afficheMontant2($m_affiche, montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $mont_ht));
                        ?>
                    </i>

                </th>
            </tr>
            <tr>
                <th class='mailbox-attachment' colspan="5">Remise(<?php echo round($remise_fact, 2) . ' %'; ?>)</th>
                <th class="text-right">
                    <i>
                        <?php
                        echo afficheMontant2($m_affiche, montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $mont_rmz));
                        ?>
                    </i>
                </th>
            </tr>
            <tr>
                <th class='mailbox-attachment' colspan="5">TVA(<?php echo $tva_fact . ' %'; ?>)</th>
                <th class="text-right">
                    <i>
                        <?php
                        echo afficheMontant2($m_affiche, montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $mont_tva));
                        ?>
                    </i>

                </th>
            </tr>
            <tr>
                <th class='mailbox-attachment' colspan="5">Montant TTC</th>
                <th class="text-right">
                    <i>
                        <?php
                        echo afficheMontant2($m_affiche, montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar, $ttc));
                        ?>
                    </i>
                </th>
            </tr>
        <?php
        $totaux=$totaux+$ttc;
          }
        ?>
        </tbody>
        <tfoot>
            <tr>
                <th class='mailbox-attachment' colspan="5">TOTAUX</th>
                <th class="text-right">
                    <i>
                        <?php
                        echo afficheMontant2($m_affiche, montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar, $totaux));
                        $mon_eq = getsymbole_devise();
                        $mont_tot_panier_devise = montant_equivalent_bdd(getsymbole_local(),  getsymbole_devise(), $_SESSION['taux_resto'], $totaux);
                        if ($m_affiche == getsymbole_devise()) {
                            $mon_eq = getsymbole_local();
                            $mont_tot_panier_devise_af = afficheMontant(getsymbole_local(), $totaux);
                        } else {
                            $mont_tot_panier_devise_af = afficheMontant(getsymbole_devise(), $mont_tot_panier_devise);
                        }
                        ?>
                    </i>
                </th>
            </tr>
        </tfoot>
    </table>
    <input type="hidden" name="mont_tot_panier_devise" id="mont_tot_panier_devise"
        value="<?php echo $mont_tot_panier_devise; ?> ">
    <input type="hidden" name="mont_tot_panier_devise_af" id="mont_tot_panier_devise_af"
        value="<?php echo $mont_tot_panier_devise_af; ?> ">
    <input type="hidden" name="mont_tot_panier" id="mont_tot_panier" value="<?php echo $mont_tot_panier_devise; ?> ">
    <input type="hidden" name="mont_tot_panier_af" id="mont_tot_panier_af"
        value="<?php echo afficheMontant2($m_affiche, montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $totaux)) ?> ">
    <input type="hidden" name="id1x" id="id1x" value="<?php echo $id; ?> ">
    <input type="hidden" name="id2x" id="id2x" value="<?php echo $cl_tbl; ?> ">
    <input type="hidden" name="id3x" id="id3x" value="<?php echo $id_cl; ?> ">
    <input type="hidden" name="id4x" id="id4x" value="<?php echo $cmd_id; ?> ">
    <input type="hidden" name="id5x" id="id5x" value="<?php echo $typ; ?> ">
    <input type="hidden" name="id6x" id="id6x" value="<?php echo $date_edition; ?> ">
    <input type="hidden" name="fusion_ticket" id="fusion_ticket" value="1">
    <input type="hidden" name="id_fact_fus_frm" id="id_fact_fus_frm" value="<?php echo $id_fact_fus; ?>">
    <input type="hidden" name="id_tbl_fus" id="id_tbl_fus" value="<?php echo $id_tbl_fus; ?>">
    <?php 
    }
    ?>
    <script src="../plugins/jQuery/jQuery-2.2.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#affiche_commandes").on('click', '.clcprod', function() {
            var idart = $(this).attr('idart');
            var idcpt = $(this).attr('idcpt');
            var prod_tr = $(this).attr('idp');
            var select_tr = '.' + prod_tr
            var repas = $('input[name="affichage_produit"]:checked').attr('repas');
            $("#qte_produit").attr('disabled', false);
            $("#btn_qte_produit").attr('disabled', false);
            $('#id_produit').val(idcpt);
            $('#id_produit2').val(idart);
            $("#btn_sup_produit").attr('disabled', false);
            $('#repas_resto').val(repas);
            $('#btn_offert').attr('disabled', false);
            $('#btn_update_price').attr('disabled', false);
            if ($(select_tr).is(":checked")) {
                $(select_tr).prop("checked", false);
            } else {
                $(select_tr).prop("checked", true);

            }

            return false;
        });
    });
    </script>

</body>

</html>