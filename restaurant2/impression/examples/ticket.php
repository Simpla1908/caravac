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
/* ================== INFOS HOTEL ================== */
$requete_idhotel = $bdd->prepare("SELECT * FROM t_hotel WHERE id_hotel=:id_hotel");
$requete_idhotel->bindParam(':id_hotel', $_SESSION['id_hotel']);
$requete_idhotel->execute();

$donnees = $requete_idhotel->fetch();

$nom_c = $donnees['nom_hotel'];
$adresse_c = $donnees['adresse_hotel'];
$ville_hotel = $donnees['ville_hotel'];
$logo = $donnees['image'];
$idnat = $donnees['idnat'];
$rccm = $donnees['rccm'];
$num_impot = $donnees['num_impot'];
$telephone = $donnees['phone'];
$email_compagny = $donnees['mail'];

/* ================== DONNEES COMMANDE ================== */

/* Fin de la Recuperation des coordonnées de l'hotel */
ReimprimerPOS($_SESSION['id_fact'], $bdd);
$nbArticles = count($_SESSION['panier1']['id_article']);
$image_url = './kembologo-clear.png';
?>
<?php
ob_start();
?>
<style>
@page { margin: 0; }

body {
    font-family: DejaVu Sans, monospace;
    font-size: 12px;
    margin: 0;
    padding: 0;
    width: 80mm;
}

#register {
    width: 100%;
    text-align: center;
    padding: 0 2mm; /* marge interne */
}

.ticket-table {
    width: 100%;
    border-collapse: collapse;
}

.ticket-header img {
    width: 110px;
    margin: 0 auto;
}

.ticket-company, .ticket-meta, .ticket-footer {
    text-align: center;
}

.ticket-company .name {
    font-size: 13px;
    font-weight: bold;
    text-transform: uppercase;
}

.ticket-company div,
.ticket-meta div {
    font-size: 11px;
}

.ticket-title {
    font-size: 15px;
    font-weight: bold;
}

hr {
    border: none;
    border-top: 1px dashed #000;
    margin: 6px 0;
}

.items-head td {
    font-weight: bold;
    font-size: 11px;
    border-bottom: 1px dashed #000;
}

.col-desc { width: 50%; text-align: left; }
.col-qty  { width: 15%; text-align: center; }
.col-amt  { width: 35%; text-align: right; }

.item-row td {
    padding: 3px 0;
    font-size: 11px;
}

.total-line td {
    border-top: 1px solid #000;
    font-weight: bold;
    font-size: 12px;
    padding-top: 5px;
}

.ticket-footer {
    font-size: 11px;
    margin-top: 8px;
}

@media print {
    body { margin: 0; }
}
</style>
<div id="register">
<table class="ticket-table">

    <!-- LOGO -->
    <tr class="ticket-header">
        <td colspan="3">
            <img src="<?php echo $image_url; ?>">
        </td>
    </tr>

    <!-- INFOS ENTREPRISE -->
    <tr>
        <td colspan="3" class="ticket-company">
            <div class="name" style="font-weight: bold;font-size: 20px;"><?php echo $nom_c; ?></div>
            <div>
                <?php echo $adresse_c . ', ' . $ville_hotel; ?><br>
                Tel : <?php echo $telephone; ?><br>
                <?php echo $email_compagny; ?>
            </div>
            <div style="font-size:11px;">
                ID.Nat : <?php echo $idnat; ?> |
                RCCM : <?php echo $rccm; ?> |
                ONEM : <?php echo $num_impot; ?>
            </div>
        </td>
    </tr>

    <tr><td colspan="3"><hr></td></tr>

    <!-- INFOS COMMANDE -->
    <tr>
        <td colspan="3" class="ticket-meta">
            <div class="ticket-title">
                FACTURE N°<?php echo $_SESSION['num_commande']; ?>
            </div>
            <div>
                <?php echo dateAfficheForHr($_SESSION['date_edition2']); ?><br>
                CLIENT : <?php echo $_SESSION['nom_client']; ?><br>
                AGENT : <?php echo $_SESSION['nom_user']; ?>
            </div>
        </td>
    </tr>

    <tr><td colspan="3"><hr></td></tr>


    <!-- ENTETE TABLE -->
    <tr class="items-head">
        <td class="col-desc">DESIGNATION</td>
        <td class="col-qty">QTE</td>
        <td class="col-amt">MONTANT</td>
    </tr>

    <!-- ARTICLES -->
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
                            <span class="item-name"><strong><?php echo $_SESSION['panier1']['nom'][$i]; ?><strong></span>
                            <?php if (!empty($des_plt)) { ?>
                                <br><span><strong><?php echo $des_plt; ?><strong></span>
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
                 <td class="col-amt"><?php echo $ttc; ?> CDF</td>
                  </tr>
                <?php 
                $ttc_cdf=montant_equivalent_bdd($monnaie_local, getsymbole_devise(), $tauxdollar, $ttc);
                ?>
               <tr class="total-line">
                    <td colspan="2" align="left">SOIT </td>
                    <td class="col-amt"><?php echo afficheMontant2('USD', $ttc_cdf); ?></td>
                </tr>
                
                <tr><td colspan="3"><hr></td></tr>

                <!-- FOOTER -->
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

/* ================== PDF ================== */
$mpdf = new mPDF('c', array(80, 3000), '', '', 4, 4, 2, 2, 0, 0);

$mpdf->WriteHTML($body);
$mpdf->SetJS('this.print();');
$mpdf->Output("Facture.pdf", "I");
