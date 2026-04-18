<?php
if (!isset($_SESSION)) {
    session_start();
}
include '../../bdd/connexion.php';
include '../../../FUNCTION/hebergement.php';
include '../../../FUNCTION/restaurant.php';
include_once '../../../impression/mpdf60/mpdf.php';
$m_affiche = $_SESSION['m_affiche'];
if ($m_affiche == 'USD') {
    $m_affiche1 = 'CDF';
} else {
    $m_affiche1 = 'USD';
}
$requete_idhotel = $bdd->prepare("SELECT * FROM  t_hotel WHERE id_hotel=:id_hotel");
$requete_idhotel->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete_idhotel->execute();
while ($donnees = $requete_idhotel->fetch()) {
    $province_hotel = $donnees['province_hotel'];
    $ville_hotel = $donnees['ville_hotel'];
    $nom_c = $donnees['nom_hotel'];
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
/* Fin de la Recuperation des coordonnées de l'hotel */


// Initialisation des données


ob_start();
////    $total = 0;  $total_tva = 0; $i=1;
?>

<!--Insertion du CSS -->
<style type="text/css">
    table {
        width: 100%;
        color: #717375;
        font-family: helvetica;
        line-height: 5mm;
    }

    h2 {
        margin: 0;
        padding: 0;
    }

    p {
        margin: 25px;
        text-align: center;
    }

    .border th {
        border: 1px solid #000;
        color: white;
        background: #000;
        padding: 5px;
        font-weight: normal;
        font-size: 14px;
        text-align: center;
    }


    .border td {
        border: 1px solid #CFD1D2;
        padding: 5px 10px;
        text-align: center;
    }

    .no-border {
        border-right: 1px solid #CFD1D2;
        border-left: none;
        border-top: none;
        border-bottom: none;
    }

    .space {
        padding-top: 100px;
    }
</style>

<table style="margin-top: 50px;">

    <tr>
        <td class="100p" style="text-align: center;">
            <h1><u>FICHE TECHNIQUE </u></h1><br />
            <h3>(Resto: GAZEBO)</h3><br />
            <h4> Imprimé, le <?php echo $date = date('d/m/Y'); ?>
            </h4><br /><br />

        </td>
    </tr>
</table>
<table>
    <?php
    $impr_row = 1;
    $compt_row = 3;
    $fich_sfamid = $_GET['fich_sfamid'];
    $produits = ListePlat($bdd);
    if ($fich_sfamid > 0) {
        $produits = ListePlat2($bdd, $fich_sfamid);
    }
    foreach ($produits as $pr) {
        $idprod = $pr->idprod;
        $code = $pr->code;
        $plat = $pr->produit;
        $sous_famille = $pr->des;
    ?>
        <?php
        if ($impr_row == 1) {
            $impr_row = 0;
        ?>
            <tr>
            <?php }
        $impr = 0;
        $produits_plat = listeProduitIngredient($idprod, $_SESSION['id_hotel'], $bdd);
            ?>
            <td>

                <table style="border:1px solid #000;margin:5px;font-size:20px;">
                    <thead>
                        <tr>
                            <th style="text-align:center;" colspan="4">
                                <h3><?php echo $code; ?></h3>
                            </th>
                        </tr>
                        <tr>
                            <th style="height:5px;" colspan="4">

                            </th>
                        </tr>
                        <tr>
                            <th style="text-align:center;" colspan="4">
                                <h3><?php echo $plat; ?></h3>
                            </th>
                        </tr>
                        <tr>
                            <th style="height:5px;" colspan="4">

                            </th>
                        </tr>
                        <tr>
                            <th style="text-align:center;" colspan="4">
                                <h3><?php echo $sous_famille; ?></h3>
                            </th>
                        </tr>
                        <tr>
                            <th style="height:5px;" colspan="4">

                            </th>
                        </tr>
                        <tr>
                            <th style="border-top: 1px solid black;" colspan="4">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th> PROD</th>
                            <th>QTE</th>
                            <th>UNITE</th>
                            <th>CR(USD)</th>
                        </tr>
                        <tr>
                            <th style="border-top: 1px solid black;" colspan="4">
                            </th>
                        </tr>

                        <?php
                        $tot = 0;
                        foreach ($produits_plat as $pp) {
                            $prod = $pp->designation;
                            $qte = $pp->quantite;
                            $unite = $pp->unite;
                            $cr = $pp->prix;
                        ?>
                            <tr>
                                <td><?php echo ucfirst($prod); ?></td>
                                <td><?php echo $qte; ?></td>
                                <td><?php echo $unite; ?></td>
                                <td><?php echo $cr; ?></td>
                                <td></td>

                            </tr>
                        <?php
                            $tot = $tot + $cr;
                        }
                        ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="border-top: 1px solid black;" colspan="4">
                            </th>
                        </tr>
                        <tr>
                            <th style="text-align:center;" colspan="3">TOTAL</th>
                            <th style="text-align:left;"><?php echo $tot ?></th>
                        </tr>
                    </tfoot>

                </table>
            </td>
            <?php
            $compt_row--;
            if ($compt_row == 0) {
                $impr_row = 1;
                $compt_row = 3;
            }
            if ($impr_row == 1) {
                $impr_row = 1;
            ?>
            </tr>
        <?php
            }
        ?>
    <?php }
    ?>
</table>


<?php
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);

//Entete et pied de page
include './entete_pied_page.php';

$mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
//        $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list

$mpdf->WriteHTML($body);
$mpdf->Output("Fiche_technique.pdf", "I");
