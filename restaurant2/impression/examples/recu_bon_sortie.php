<?php
// Initialisation des données
include_once '../../../impression/mpdf60/mpdf.php';
include '../../bdd/connexion.php';


if (!isset($_SESSION)) {
    session_start();
}
//Fusion horaire
date_default_timezone_set('Europe/Paris');

$company_id = $_SESSION['company_id'];

//Selection des company
$requete_company = $bdd->prepare("SELECT * FROM  t_company WHERE id_c=:company_id");
$requete_company->BindParam(':company_id', $company_id);
$requete_company->execute();
while ($donnees = $requete_company->fetch()) {

    $nom_c = $donnees['nom_c'];
    $adresse_c = $donnees['adresse_c'];
    $ville = $donnees['ville'];
    $logo = $donnees['logo'];
    $idnat = $donnees['idnat'];
    $rccm = $donnees['rccm'];
    $num_impot = $donnees['num_impot'];
    $telephone = $donnees['phone'];
    $email_compagny = $donnees['mail_company'];
    $compte_bancaire = $donnees['compte_bancaire'];
    $mention = $donnees['mention'];
}

// requette pour la selection des sites
$requete_idhotel = $bdd->prepare("SELECT adresse_hotel, province_hotel, ville_hotel FROM  t_hotel WHERE company_id=:company_id");
$requete_idhotel->BindParam(':company_id', $company_id);
$requete_idhotel->execute();
while ($donnees = $requete_idhotel->fetch()) {

    $adresse_hotel = $donnees['adresse_hotel'];
    $province_hotel = $donnees['province_hotel'];
    $ville_hotel = $donnees['ville_hotel'];
}
/* Fin de la Recuperation des coordonnées de l'hotel */


include '../../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include '../../../FUNCTION/hebergement.php';

if (isset($_GET['commande_id'])) {
    $commande_id = $_GET['commande_id'];
//    $_SESSION['id_hotel'] = 1;
    $requete = $bdd->prepare("SELECT e.*,f.*,b.qte,b.prix,c.designation,b.monnaie,a.date_res,a.num_reserv,a.remise,a.tva,a.taux,d.designation AS tabl,d.id_client,d.nom_client,d.type "
        . "FROM t_reservation AS a,lignes_commandes AS b,stk_produit AS c,t_client AS d, t_facture AS e, t_reglement AS f "
        . "WHERE a.id_res= b.commande_id AND b.produit_id=c.idprod AND a.id_client= d.id_client AND a.id_res=e.id_res AND e.id_fact=f.id_fact AND b.commande_id=:commande_id AND b.hotel_id=:hotel_id ");
    $requete->BindParam(':commande_id', $commande_id);
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();

    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($operations as $op) {
        $num_reserv=$op->num_reserv;
        $remise = $op->remise;
        $table = $op->tabl;
        $id_client = $op->id_client;
        $nom_client = $op->nom_client;
        $date = $op->date_res;
        $numfact = $op->num_reserv;
        $type = $op->type;
        $taux=$op->taux;
    }

    $total = 0;
    $tva = 0;
    ob_start();
}

?>
    <!--Insertion du CSS -->
    <style type="text/css">
        table {
            width: 100%;
            color: #717375;
            font-family: helvetica;
            line-height: 5mm;
            border-collapse: collapse;
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

        .10
        p {
            width: 10%;
        }

        .15
        p {
            width: 15%;
        }

        .25
        p {
            width: 25%;
        }

        .50
        p {
            width: 50%;
        }

        .60
        p {
            width: 60%;
        }

        .75
        p {
            width: 75%;
        }
    </style>

    <table style="margin-top: 50px;">
        <tr>
            <td class="50p"><h2>Facture n°<?php echo $numfact; ?></h2></td>
            <td class="50p" style="text-align: right;">
                <strong><?php if ($type == 'table') {
                        echo 'Table: ' . $table;
                    } else {
                        echo 'Client: ' . $nom_client;
                    } ?></strong><br/>
            </td>
        </tr>
        <!--        <tr>
            <td style="padding-top: 15px;" colspan="2"><strong>Objectif:</strong> <?php //echo $project['name']; ?></td>
        </tr>-->
    </table>

    <table style="margin-top: 30px;" class="border">
        <thead>
        <tr>
            <th class="60p">Description</th>
            <th class="10p">Quantité</th>
            <th class="15p">Prix Unitaire</th>
            <th class="15p">Montant</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $montpaye=0;

            foreach ($operations as $op):
                $montpaye= affiche_montant($m_affiche,$taux,$op->montant_fc ,$op->montant_dollar);
            if ($op->monnaie == $m_affiche) {
                $prix = round($op->prix, 2);
            } else {
                if ($op->monnaie = 'USD' && $m_affiche == 'CDF') {
                    $prix = round($op->prix * $tauxdollar, 2);

                } else {
                    $prix = round($op->prix * 1 / $tauxdollar, 2);
                }
            }
            ?>

            <tr>
                <td><?php echo $op->designation; ?></td>
                <td><?php echo $op->qte; ?></td>
                <td><?php echo $prix . ' ' . $m_affiche; ?></td>
                <td><?php
                    $price_tot = $prix * $op->qte;
                    echo $price_tot . ' ' . $m_affiche;
                    ?></td>

                <?php
                $total += $price_tot;
                $tva = $op->tva;
                ?>
            </tr>
        <?php endforeach;
        $mont_rmz = ($total * $remise) / 100;
        $mont_tva = ($total - $mont_rmz) * $tva / 100;
        $mont = $total - $mont_rmz;
        $mont_ttc = $mont + $mont_tva
        ?>

        <tr>
            <td class="space" style="height:50px;"></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td rowspan="5" class="no-border"></td>
            <td style="text-align: center;" rowspan="5"><strong>Total:</strong></td>
            <td colspan="2">HT : <?php echo $total . ' ' . $m_affiche; ?></td>
        </tr>
        <tr>
            <!--<td colspan="1" rowspan="5" class="no-border"></td>-->
            <td colspan="2">TVA : <?php
                echo $mont_tva . ' ' . $m_affiche; ?></td>
        </tr>
        <tr>
            <!--<td colspan="1" rowspan="5" class="no-border"></td>-->
            <td colspan="2">TTC : <?php echo $mont_ttc. ' ' . $m_affiche; ?></td>
        </tr>
        <tr>
            <!--<td colspan="1" class="no-border"></td>-->
            <?php if (!empty($_SESSION['panier']['remise'])) { ?>
                <td colspan="2">Rém : <?php echo $_SESSION['panier']['remise'] . '%'; ?></td>
            <?php } ?>
        </tr>
        <tr>
            <!--<td colspan="1" class="no-border"></td>-->
            <td colspan="2">
                Montant payé
                : <?php echo round($montpaye,2). ' ' . $m_affiche; ?>
                <?php if ($m_affiche != 'USD') { ?>
                    <br>Soit : <?php echo round($montpaye /$taux, 2); ?> USD
                <?php } ?>
            </td>
        </tr>
        </tbody>
    </table>

    <table style="margin-top: 50px;">
        <tr>
            < class="50p">
                Utilisateur <br>
                <?php echo $_SESSION['prenom_user'].' '.$_SESSION['nom_user']; ?>
            </td>
            <td class="50p" style="text-align: right;">Kinshasa le, <?php echo date('d/m/Y'); ?></td>
        </tr>
    </table>


<?php
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);

//Entete et pied de page
include './entete_pied_page.php';

$mpdf = new mPDF('c', 'A4', '', '', 15, 15, 30, 20, 5, 5);
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
//        $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list

$mpdf->WriteHTML($body);
$mpdf->Output("Facture.pdf", "I");
