<?php
session_start();
include_once '../../impression/mpdf60/mpdf.php';
include '../../bdd/connexion.php';
include '../Amelioration/reglage/recuperer_valeurs_reglages.php';
$company_id = $_SESSION['company_id'];
$id_hotel = $_SESSION['id_hotel'];
//Selection des company
$requete_company = $bdd->prepare("SELECT * FROM t_company As a, t_hotel AS b "
        . "                      WHERE a.id_c=b.company_id AND b.id_hotel=:id_hotel");
$requete_company->BindParam(':id_hotel', $id_hotel);
$requete_company->execute();
while ($donnees = $requete_company->fetch()) {

    $nom_hotel = $donnees['nom_hotel'];
    $adresse_hotel = $donnees['adresse_hotel'];
    $province_hotel = $donnees['province_hotel'];
    $logo = $donnees['logo'];
    $idnat = $donnees['idnat'];
    $rccm = $donnees['rccm'];
    $num_impot = $donnees['num_impot'];
    $telephone = $donnees['phone'];
    $email_compagny = $donnees['email_company'];
    $compte_bancaire = $donnees['compte_bancaire'];
    $mention = $donnees['mention'];
}
/* calcul du nombre du jour */
$tempsdujr = gmstrftime("%H:%M");
?>
<?php
ob_start();
?>
<header class="clearfix">
    <div id="logo">
        <img src="../images/logo_entreprise/<?php echo $logo; ?>" width="70" height="70">
    </div>
    <div id="company">
        <h2 class="name"><?php echo $nom_hotel; ?></h2>
        <div><?php echo $nom_hotel; ?></div>
        <div>(+243) <?php echo $telephone; ?></div>
        <div><a href="mailto:<?php echo $email_compagny; ?>"><?php echo $email_compagny; ?></a></div>
    </div>
</div>
</header>
<main>
    <div id="details" class="clearfix">
        <div id="client">
            <div class="to">CLIENT:</div>
            <h2 class="name"></h2>
            <div class="address"></div>
            <div class="address"></div>
        </div>
        <div id="invoice" style="display:block">
            <h1>RESERVATION N° <?php // echo $num_reserv;    ?></h1>
            <div class="date">Date de réservation: <?php // echo $date_res_expl;    ?></div>
            <div class="date">Date d'arrivée: <?php // echo $date_occ_expl;    ?></div>
            <div class="date">Date de départ: <?php // echo $date_lib_expl;    ?></div>
        </div>
    </div>
    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th class="no"><h3>#</h3></th>
        <th class="desc"><h3>CHAMBRE</h3></th>
        <th class="unit"><h3>TARIF</h3></th>
        <th class="qty"><h3>NOMBRE NUITE</h3></th>
        <th class="total"><h3>TOTAL</h3></th>
        </tr>
        </thead>
        <br>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
        <br>
        <tfoot>
            <tr>
                <td colspan="2"></td>
                <td colspan="2">SOUS TOTAL</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2">RESTAURATION</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2">MONTANT TOTAL</td>
                <td>

                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2">MONTANT PAYE</td>
                <td></td>
            </tr>

            <tr>
                <td colspan="2"></td>
                <td colspan="2">RENDU</td>
                <td></td>
            </tr>

            <tr>
                <td colspan="2"></td>
                <td colspan="2">NET A PAYER</td>
                <td></td>
            </tr>

        </tfoot>
    </table>
    <div id="thanks">La Réception,</div>
    <div id="notices">
        <!--        <div>NOTICE:</div>-->
        <div class="notice">Créee le <?php echo $date_edition; ?> par <?php echo strtoupper($prenom_user) . ' ' . strtoupper($nom_user); ?> / Imprimée le <?php echo date('d/m/Y H:i'); ?> par <?php echo strtoupper($_SESSION['prenom_user'] . ' ' . $_SESSION['nom_user']); ?>.</div>
    </div>
</main>
<footer>
    <?php echo 'Tél.; ' . $telephone . ' -- Email: ' . $email_compagny . ' -- RCCM: ' . $rccm . ' -- Id-Nat: ' . $idnat; ?>.
</footer>
<?php
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);

//Entete et pied de page
//include './blocfature.php';
$stylesheet1 = file_get_contents('style.css'); // external css
$mpdf = new mPDF('c', 'A4');
$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($stylesheet1, 1);
$mpdf->WriteHTML($body);
$mpdf->Output("Facture.pdf", "I");
