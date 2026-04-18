<?php
if (!isset($_SESSION)) {
    session_start();
}
ini_set('memory_limit', '1024M');
include '../../bdd/connexion.php';
include '../../../FUNCTION/hebergement.php';
include '../../../FUNCTION/restaurant.php';
include_once '../../../impression/mpdf60/mpdf.php';
$m_affiche = $_SESSION['m_affiche'];
if ($m_affiche == 'USD') {
    $m_affiche1 = 'CDF';
} else {
    $num_impot = $donnees['num_impot'];
    $telephone = $donnees['phone'];
    $email_compagny = $donnees['mail'];
    $m_affiche1 = 'USD';
}
$requete_idhotel = $bdd->prepare("SELECT * FROM  t_hotel WHERE id_hotel=:id_hotel");
$requete_idhotel->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete_idhotel->execute();
while ($donnees = $requete_idhotel->fetch()) {
    $adresse_c = $donnees['adresse_hotel'];
    $ville_hotel = $donnees['ville_hotel'];
    $logo = $donnees['image'];
    $idnat = $donnees['idnat'];
    $rccm = $donnees['rccm'];
    $num_impot = $donnees['num_impot'];
    $phone = $donnees['phone'];
    $mail = $donnees['mail'];

}
/* Fin de la Recuperation des coordonnées de l'hotel */
ReimprimerPOS($_SESSION['id_fact'], $bdd);
$nbArticles = count($_SESSION['panier1']['id_article']);
$image_url = './kembologo-clear.png';
?>
<?php
ob_start();
?>
<style>
    body {
        font-family: DejaVu Sans, sans-serif;
        color: #111111;
        font-size: 15x;
    }
    #register {
        padding: 8px 6px;
    }
    .ticket-table {
        width: 100%;
        border-collapse: collapse;
    }
    .ticket-table td {
        padding: 4px 0;
        vertical-align: top;
    }
    .ticket-header,
    .ticket-company,
    .ticket-meta,
    .ticket-footer {
        text-align: center;
    }
    .ticket-header {
        border-bottom: 1px solid #000000;
        padding: 6px 0 12px 0;
    }
    .ticket-logo {
        width: 230px;
        max-height: 200px;
    }
    .ticket-company {
        border-bottom: 1px solid #000000;
        padding: 8px 0;
        line-height: 1.45;
    }
    .ticket-company .name {
        font-size: 14px;
        font-weight: bold;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
    .ticket-meta {
        border-bottom: 1px solid #000000;
        padding: 8px 0;
        line-height: 1.55;
    }
    .ticket-title {
        font-size: 15px;
        font-weight: bold;
        letter-spacing: 0.5px;
    }
    .section-gap td {
        padding-top: 8px;
    }
    .items-head td {
        font-size: 11px;
        font-weight: bold;
        text-transform: uppercase;
        border-bottom: 1px dashed #000000;
        padding-bottom: 6px;
    }
    .col-desc {
        width: 56%;
    }
    .col-qty {
        width: 14%;
        text-align: center;
    }
    .col-amt {
        width: 30%;
        text-align: right;
    }
    .item-row td {
        border-bottom: 1px dotted #999999;
        padding: 6px 0;
    }
    .item-name {
        font-weight: bold;
    }
    .totals-block td {
        padding-top: 8px;
    }
    .total-line td {
        border-top: 1px solid #000000;
        font-size: 15px;
        font-weight: bold;
        padding-top: 8px;
    }
    .ticket-footer {
        border-top: 1px solid #000000;
        padding-top: 10px;
        line-height: 1.5;
        font-size: 15px;
    }
</style>
<div id="register">
    <div id="ticket">
        <table class="ticket-table">
            <tbody id="entries">
                <tr>
                    <td colspan="3" class="ticket-header">
                        <img class="ticket-logo" src="<?php echo $image_url; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="ticket-company">
                        <div class="name"><?php echo $_SESSION['nom_hotel']; ?></div>
                        <?php echo $adresse_c;  ?>
                        <br>
                        <?php echo $ville_hotel;  ?>
                        <br>
                        Contact : <?php echo $phone;  ?>
                        <br>
                        <?php echo $mail;  ?>
                        <br>
                        ID.Nat : <?php echo $idnat; ?> | RCCM : <?php echo $rccm; ?>
                        <br>
                        ONEM : <?php echo $num_impot;  ?>
                    </td>
                </tr>

                <tr>
                    <td colspan="3" class="ticket-meta">
                        <div class="ticket-title">FACTURE N°<?php echo $_SESSION['num_commande']; ?></div>
                        <?php echo dateAfficheForHr($_SESSION['date_edition2']); ?>
                        <br>
                        Mode : <?php echo $_SESSION['mode_fact']; ?>
                        <br>
                        Client/Table : <?php echo $_SESSION['nom_client']; ?>
                        <br>
                        Agent : <?php echo $_SESSION['nom_caissier']; ?>
                         <br>
                        Devise : <?php echo $m_affiche; ?>
                    </td>
                </tr>
                <tr class="section-gap">
                    <td colspan="3"></td>
                </tr>
                <tr class="items-head">
                    <td class="col-desc">Designation</td>
                    <td class="col-qty">Qte</td>
                    <td class="col-amt">Montant</td>
                </tr>
                <?php
                $tauxdollar = $_SESSION['tauxdollar'];
                $monnaie_local = getsymbole_local();
                $mont_tva = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier1']['mont_tva']);
                $total_fact = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier1']['mont_ht']);
                $mont_remise = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier1']['mont_remise']);
                $netapayer = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier1']['netapayer']);
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                    $prix = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier1']['prix'][$i] * $_SESSION['panier1']['qte'][$i]);
                    $des_plt = $_SESSION['panier1']['description'][$i];
                ?>
                    <tr class="item-row">
                        <td class="col-desc">
                            <span class="item-name"><?php echo $_SESSION['panier1']['nom'][$i]; ?></span>
                            <?php if (!empty($des_plt)) { ?>
                                <br><span><?php echo $des_plt; ?></span>
                            <?php } ?>
                        </td>
                        <td class="col-qty"><?php echo $_SESSION['panier1']['qte'][$i]; ?></td>
                        <td class="col-amt"><?php echo afficheMontant2('', $prix); ?></td>
                    </tr>
                <?php };
                $ttc = ttc($total_fact, $mont_tva, $mont_remise);
                ?>
                <?php if ($mont_remise > 0) { ?>
                <tr>
                    <td colspan="2" align="right">Remise</td>
                    <td class="col-amt">-<?php echo afficheMontant2('', $mont_remise); ?></td>
                </tr>
                <?php } ?>
                <?php if ($mont_tva > 0) { ?>
                <tr>
                    <td colspan="2" align="right">TVA</td>
                    <td class="col-amt"><?php echo afficheMontant2('', $mont_tva); ?></td>
                </tr>
                <?php } ?>
                <tr class="total-line">
                    <td colspan="2" align="left">TOTAL</td>
                    <td class="col-amt"><?php echo afficheMontant2('', $ttc); ?> </td>
                </tr>
                <?php 
                $ttc_cdf=montant_equivalent_bdd($monnaie_local, getsymbole_devise(), $tauxdollar, $ttc);
                ?>
               <tr class="total-line">
                    <td colspan="2" align="left">Soit </td>
                    <td class="col-amt"><?php echo afficheMontant2('USD', $ttc_cdf); ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="ticket-footer">
                        <b><?php echo $_SESSION['mention']; ?></b>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
</div>
<?php
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);
$mpdf = new mPDF('c', array(80, 5000), 0, '', 0, 0, 0, 0, 0, 0);
$mpdf->WriteHTML($body);
//impression auto
$mpdf->setjs('this.print()');
$mpdf->Output("ticket.pdf", "I");
