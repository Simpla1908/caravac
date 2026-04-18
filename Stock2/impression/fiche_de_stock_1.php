<?php
date_default_timezone_set('Africa/Kinshasa');
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
ini_set('memory_limit', '1024M');
include_once '../../impression/mpdf60/mpdf.php';
include '../bdd/connexion.php';
include_once '../../FUNCTION/hebergement.php';
session_start();
$company_id = $_SESSION['company_id'];

// requette pour la selection infos site
$requete_idhotel = $bdd->prepare("SELECT * FROM  t_hotel WHERE id_hotel=:id_hotel");
$requete_idhotel->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete_idhotel->execute();
while ($donnees = $requete_idhotel->fetch()) {
    $province_hotel = $donnees['province_hotel'];
    $ville_hotel = $donnees['ville_hotel'];
    $nom_c = $donnees['nom_hotel '];
    $adresse_c = $donnees['adresse_hotel'];
    $ville = $donnees['ville_hotel'];
    $logo = $donnees['image'];
    $idnat = $donnees['idnat'];
    $rccm = $donnees['rccm'];
    $num_impot = $donnees['num_impot'];
    $telephone = $donnees['phone'];
    $email_compagny = $donnees['mail'];
    $compte_bancaire = $donnees['cb'];
}
/* Fin de la Recuperation des coordonnées de l'sites */
ob_start();
?>
<div id="register" style="border:1px solid white">
    <div id="ticket">
        <table style="margin:auto; font-family: monospace; font-size: 14px;">
            <tbody id="entries">
                <tr>
                    <td colspan="5" align="center" style="border-bottom: 1px solid black;">
                        <b>FICHE DE STOCK <?php echo strtoupper($_SESSION['libelle_resto']) ?>
                            <br>
                            <?php echo  dateAffiche($_SESSION['fiche_dte1']) . ' - ' . dateAffiche($_SESSION['fiche_dte2']); ;  ?>
                            <br>
                        </b>
                    </td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                </tr>
                <tr>
                    <td><b>DES</b></td>
                    <td><b>I</b></td>
                    <td><b>E</b></td>
                    <td><b>S</b></td>
                    <td><b>D</b></td>
                </tr>
                <?php
            $i = 1;
            foreach ($_SESSION['articles'] as $art) {
                $q0 = 0;
                $qin = 0;
                $qout = 0;
                $qsolde = 0;
                $qte_declasse = 0;
                $idprod = $art->idprod;
                $des = $art->produit;
                    if (isset($_SESSION['fs']['q0'][$idprod])) {
                        $q0 = $_SESSION['fs']['q0'][$idprod];
                    } else {
                        $_SESSION['fs']['q0'][$idprod] = $q0;
                    }
                    if (isset($_SESSION['fs']['qin'][$idprod])) {
                        $qin = $_SESSION['fs']['qin'][$idprod];
                    } else {
                        $_SESSION['fs']['qin'][$idprod] = $qin;
                    }
                    if (isset($_SESSION['fs']['qout'][$idprod])) {
                        $qout = $_SESSION['fs']['qout'][$idprod];
                    } else {
                        $_SESSION['fs']['qout'][$idprod] = $qout;
                    }
                    if (isset($_SESSION['fs']['qavarie'][$idprod])) {
                        $qte_declasse = $_SESSION['fs']['qavarie'][$idprod];
                    } else {
                        $_SESSION['fs']['qavarie'][$idprod] = $qte_declasse;
                    }
                $qsolde = ($q0 + $qin) - ($qout + $qte_declasse);
                ?>
                <tr>
                    <td><b><?php echo $des; ?></b></td>
                    <td><b><?php echo  round($q0,2); ?></b></td>
                    <td><b><?php echo round($qin,2); ?></b></td>
                    <td><b><?php echo round($qout+$qte_declasse,2) ; ?></b></td>
                    <td><b><?php echo round($qsolde,2); ?></b></td>
                </tr>
                <?php
                $i++;
                };
                ?>
              <tr>
                    <td align="center" colspan="5" style="border-top: 1px solid black;"><b>
                            <?php echo 'Imprimé par '.$_SESSION['nom_user'].', le '.date('d/m/Y  à H:i:s'); ?>
                        </b></td>
                </tr>
            </tbody>

        </table>
    </div>
</div>

<?php
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);
$mpdf = new mPDF('c', array(82, 5000), 0, '', 0, 0, 0, 0, 0, 0);
$mpdf->WriteHTML($body);
$mpdf->Output("Fiche de stock.pdf", "I");