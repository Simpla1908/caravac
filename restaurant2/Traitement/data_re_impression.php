<?php
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);
session_start();
include '../bdd/connexion.php';
include './Panier.php';
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include '../../FUNCTION/hebergement.php';
include '../../FUNCTION/restaurant.php';
$panier = new Panier();
$panier->initialiser();
$remise_fact = 0;
$monnaie = $m_affiche;
$tauxdollar = $_SESSION['tauxdollar'];
$taux_op = $_SESSION['taux_resto'];
$tva_fact = 0;
$cmd_id = 0;
$id = 0;
$cl_tbl = '';
$id_fact = 0;
$_SESSION['saveprod'] = array();
$_SESSION['saveprod']['id'] = array();
$_SESSION['saveprod']['qte'] = array();
$typ = '';
$id_cl = 0;
$date_edition = '';
    $id_client = $_GET['id_client'];
    $requete = $bdd->prepare("SELECT f.monnaie,f.taux_prix, f.montant_total,f.mont_tva,f.mont_ttc,f.date_edition,f.dte_time,f.mode,f.mont_ttc_remise,f.taux,f.tva,f.id_fact,f.num_fact,r.id_res,r.num_reserv,c.designation,c.id_client,c.nom_client,c.type
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
        $cmd_num = $id_fact;
        $cmd_id = $cmd_num;
        $_SESSION['panier']['remise'] = $ra->mont_ttc_remise;
        $requete = $bdd->prepare("SELECT  p.idprod,l.*,p.designation,p.monnaie,p.repas FROM  lignes_commandes AS l,stk_produit As p WHERE l.produit_id=p.idprod AND l.commande_id=:cmd_id AND l.hotel_id=:hotel_id");
        $requete->BindParam(':cmd_id', $cmd_num);
        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
        $requete->execute();
        $reservation_l_attente = $requete->fetchAll(PDO::FETCH_OBJ);
        $k = 0;
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
    <?php
    // Récuperation du TVA
    $panier = new Panier();
    $nbArticles = count($_SESSION['panier']['id_article']);
    $mont_ht = $panier->montant_panier();
    ?>
    <table class="table table-hover table-condensed table-responsive" id="tab_commandes_reimpression">
        <thead>
            <th></th>
            <th><a href='#'></a></th>
            <th class='mailbox-attachment'>QTE</th>
            <th class='mailbox-subject'> DESIGNATION </th>
            <th class='mailbox-attachment'></th>
            <th class='mailbox-date text-right'>PRIX</th>
        </thead>
        <tbody>
            <?php
            $monnaie_local = getsymbole_local();
            $kt = 0;
            for ($i = 0; $i <= $nbArticles - 1; $i++) {
                $des_plt = '';
                $tarif = $_SESSION['panier']['prix'][$i] * $_SESSION['panier']['qte'][$i];
                $tarif = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $tarif);
                $plat_idc = $_SESSION['panier']['id_article'][$i];
                $cpt_pan = $_SESSION['panier']['cpt'][$i];
                $des_plt = $_SESSION['panier']['description'][$i];

            ?>
            <tr class="clicktr" idp="<?php echo 'xx' . $_SESSION['panier']['cpt'][$i] ?>"
                idcpt="<?php echo $_SESSION['panier']['cpt'][$i] ?>"
                idart='<?php echo $_SESSION['panier']['id_article'][$i] ?>'
             >
                <td>
                    <input name="affichage_produit" type='checkbox'
                        class="affichage_produit <?php echo 'xx' . $_SESSION['panier']['cpt'][$i] ?>"
                        repas="<?php echo $_SESSION['panier']['repas'][$i] ?>"
                        id="cpt<?php echo $_SESSION['panier']['cpt'][$i] ?>"
                        idp="<?php echo $_SESSION['panier']['id_article'][$i] ?>"
                        value="<?php echo $_SESSION['panier']['id_article'][$i] ?>"
                        pn="<?php echo $_SESSION['panier']['nom'][$i] ?>"
                        pd="<?php echo $_SESSION['panier']['description'][$i] ?>"
                        pq="<?php echo $_SESSION['panier']['qte'][$i] ?>"
                        pt="<?php echo $tarif ?>"
                        cpt="<?php echo $_SESSION['panier']['cpt'][$i] ?>"
                        idlgcmd="<?php echo $_SESSION['panier']['pa'][$i] ?>"


                        >
                </td>
                <td><a href='#'></a></td>
                <td class='mailbox-attachment' id="<?php echo $_SESSION['panier']['id_article'][$i] ?>">
                <input type="text" class="form-control" name="designation" id="Q<?php echo $_SESSION['panier']['cpt'][$i] ?>" value="<?php echo $_SESSION['panier']['qte'][$i] ?>" style="width:50px;">
                </td>
                <td class='mailbox-subject' id="<?php echo 'libelle_repas' . $_SESSION['panier']['id_article'][$i] ?>">
                    <?php

                        echo $_SESSION['panier']['nom'][$i] . '</br>' . $des_plt;
                     ?>
                </td>
                <td class='mailbox-attachment'></td>
                <td class='mailbox-date text-right'><?php echo afficheMontant2($m_affiche, $tarif) ?></td>
            </tr>
            <?php };
           
            ?>
        </tbody>
    </table>
   
    <script src="../../plugins/jQuery/jQuery-2.2.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#tab_commandes_reimpression").on('click', '.clicktr', function() {
            var id= $(this).attr('idcpt');
            var select_a = '#cpt' + id;
            if ($(select_a).prop('checked')) {
            $(select_a).prop("checked", false);    
            }else{
            $(select_a).prop("checked", true);    
            }
            return false;
        });
        
    });
    </script>