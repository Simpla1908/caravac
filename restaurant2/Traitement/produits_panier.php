<?php
session_start();
include '../bdd/connexion.php';
include './Panier.php';
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include '../../FUNCTION/hebergement.php';
$panier = new Panier();
//$panier->vider_panier();
$panier->initialiser();
$panier = new Panier();
$remise_fact=0;
$monnaie=$m_affiche;
$tauxdollar=$_SESSION['tauxdollar'];
$taux_op = $_SESSION['taux_resto'];
if (isset($_POST['id1']) && !empty($_POST['id1'])) {
    $idcmd = $_POST['id1'];
    $requete = $bdd->prepare("SELECT f.monnaie,f.taux_prix, f.montant_total,f.mont_tva,f.mont_ttc,f.date_edition,f.dte_time,f.mode,f.mont_ttc_remise,f.taux,f.tva,f.id_fact,f.num_fact,r.id_res,r.num_reserv,c.designation,c.id_client,c.nom_client,c.type FROM  t_reservation AS r,t_client AS c,t_facture AS f WHERE f.type='restaurant' AND f.etat_cmd='1' AND f.id_client=c.id_client AND r.id_res=f.id_res AND r.id_hotel=:hotel_id AND f.id_fact=:cmd_id ORDER BY f.id_fact ASC");
    $requete->BindParam(':cmd_id', $idcmd);
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
        $taux_op=$ra->taux;
        $tauxdollar=$ra->taux_prix;
        $monnaie=$ra->monnaie;
        $_SESSION['nom_client']=$cl;
        $_SESSION['date_edition']=$ra->date_edition;
        $_SESSION['date_edition2']=$ra->dte_time;
        $typ = $ra->type;
        if ($typ == 'client'){
            $cl_tbl = $cl;
        }else if($typ == 'table'){
            $cl_tbl = $tbl;
        }else{
            $cl_tbl = 'Client occasionnel';
        }
        $_SESSION['num_commande']=$ra->num_fact;
        $cmd_num = $id_fact;
        $requete = $bdd->prepare("SELECT  p.idprod,l.*,p.designation,p.monnaie,p.repas FROM  lignes_commandes AS l,stk_produit As p WHERE l.produit_id=p.idprod AND l.commande_id=:cmd_id AND l.hotel_id=:hotel_id");
        $requete->BindParam(':cmd_id', $cmd_num);
        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
        $requete->execute();
        $reservation_l_attente = $requete->fetchAll(PDO::FETCH_OBJ);
        $k=0;
        foreach ($reservation_l_attente As $r){
            $qte = $r->qte;
            $prix =$r->prix;
            $prix2 =$r->prix2;
            $idprod = $r->idprod;
            $designation = $r->designation;
            $repas = $r->repas;
            $pa = $r->pa;
            $qteoffert=$r->qteoffert;
            $offre=0;
            if($prix2>0){
              $offre=1;  
            }
            array_push($_SESSION['panier']['id_article'], $idprod);
            array_push($_SESSION['panier']['nom'], $designation);
            array_push($_SESSION['panier']['qte'], $qte);
            array_push($_SESSION['panier']['prix'], $prix);
            array_push($_SESSION['panier']['repas'], $repas);
            array_push($_SESSION['panier']['cpt'],$k);
            array_push($_SESSION['panier']['qteoffert'],$qteoffert);
            array_push($_SESSION['panier']['pa'],$pa);
            array_push($_SESSION['panier']['prix2'],$prix2);
            array_push($_SESSION['panier']['offre'],$offre);
            $k++;
        }
    }
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
    <th></th>
    <th><a href='#'></a></th>
    <th class='mailbox-attachment'>Qté</th>
    <th class='mailbox-subject'> Désignation</th>
    <th class='mailbox-attachment'></th>
    <th class='mailbox-date text-right'>Prix</th>
    </thead>
    <tbody>
    <?php
    $monnaie_local=getsymbole_local();
    for ($i = 0; $i <= $nbArticles - 1; $i++){
        $tarif = montant_equivalent_bdd($monnaie_local,$m_affiche,$tauxdollar,$_SESSION['panier']['prix'][$i]) * $_SESSION['panier']['qte'][$i];
        ?>
        <tr>
            <td></td>
            <td><input type='checkbox' class="affichage_produit"
                       id="<?php echo $_SESSION['panier']['id_article'][$i] ?>"
                       value="<?php echo $_SESSION['panier']['id_article'][$i] ?>"></td>
            <td class='mailbox-attachment'
                id="<?php echo $_SESSION['panier']['id_article'][$i]?>"><?php echo $_SESSION['panier']['qte'][$i] ?></td>
            <td class='mailbox-subject'> <?php echo $_SESSION['panier']['nom'][$i] ?></td>
            <td class='mailbox-attachment'></td>
            <td class='mailbox-date text-right'><?php echo afficheMontant($m_affiche, $tarif) ?></td>
        </tr>
    <?php };
    $total1=$mont_ht;
    $total=total($total1,$tva_fact,$remise_fact);
    $mont_tva=tva($total,$tva_fact,$remise_fact);
    $mont_rmz=remise($total1,$tva_fact,$remise_fact);
    $mont_ht=  ht($total, $tva_fact,$remise_fact);
    $ttc=  ttc($mont_ht, $mont_tva,$mont_rmz);
    $_SESSION['panier']['mont_tva'] =$mont_tva;
    $_SESSION['panier']['mont_ttc'] =$mont_ht-$mont_rmz;
    $_SESSION['panier']['mont_remise'] =$mont_rmz;
    $_SESSION['panier']['mont_ht'] =$mont_ht;
    $_SESSION['panier']['mont_ttc_remise'] =$ttc;
    $mont_ttc=$ttc;
    ?>
    </tbody>
    <tfoot>
    <tr>
        <th class='mailbox-attachment' colspan="5">Montant HT</th>
        <th class="text-right">
            <i>
                <?php
                echo afficheMontant2($m_affiche, montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar,$mont_ht));
                ?>
            </i>

        </th>
    </tr>
    <tr>
        <th class='mailbox-attachment' colspan="5">Remise(<?php echo round($remise_fact, 2) . ' %'; ?>)</th>
        <th class="text-right">
            <i>
                <?php
                echo afficheMontant2($m_affiche, montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar,$mont_rmz));
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
                    echo afficheMontant2($m_affiche,montant_equivalent_bdd(getsymbole_local(),$m_affiche, $tauxdollar,$ttc));
                    $mon_eq=getsymbole_devise();
                    
                    $mont_tot_panier_devise=montant_equivalent_bdd(getsymbole_local(),  getsymbole_devise(),$_SESSION['taux_resto'],$ttc);
                    if($m_affiche==getsymbole_devise()){
                       $mon_eq=getsymbole_local(); 
                        $mont_tot_panier_devise_af= afficheMontant(getsymbole_local(),$ttc);
                    }  else {
                        $mont_tot_panier_devise_af= afficheMontant(getsymbole_devise(),$mont_tot_panier_devise);
                    }
                   
                ?>
            </i>
        </th>
    </tr>
    </tfoot>
</table>
<input type="hidden" name="mont_tot_panier_devise" id="mont_tot_panier_devise" value="<?php echo $mont_tot_panier_devise; ?> ">
<input type="hidden" name="mont_tot_panier_devise_af" id="mont_tot_panier_devise_af" value="<?php echo $mont_tot_panier_devise_af; ?> ">
<input type="hidden" name="mont_tot_panier" id="mont_tot_panier" value="<?php echo $mont_ttc; ?> ">
<input type="hidden" name="mont_tot_panier_af" id="mont_tot_panier_af" value="<?php echo afficheMontant2($m_affiche,montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar,$mont_ttc)) ?> ">
<script src="../plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.affichage_produit').click(function (e) {
            var idprod, affichage;
            if ($(this).is(":checked")) {
                idprod = $(this).attr('id');
//                        alert(idprod);
                $("#qte_produit").attr('disabled', false);
                $("#btn_qte_produit").attr('disabled', false);
                $('#id_produit').val(idprod);
                $("#btn_sup_produit").attr('disabled', false);
                $("#div_qte_produit").show();
                $("#div_remise").hide();
            } else {
                $('#id_produit').val(' ');
                $('#qte_produit').val(' ');
                $("#qte_produit").attr('disabled', true);
                $("#btn_qte_produit").attr('disabled', true);
                $("#btn_sup_produit").attr('disabled', true);
                $("#div_qte_produit").hide();
                $("#div_remise").show();

            }


        });


    });

</script>

</body>
</html>

       