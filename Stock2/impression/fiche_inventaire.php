<?php
session_start();
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
ini_set('memory_limit', '1024M');
include_once '../../impression/mpdf60/mpdf.php';
include '../../FUNCTION/hebergement.php';
include '../bdd/connexion.php';
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';

$company_id = $_SESSION['company_id'];
// requette pour la selection des sites
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
$s_famille_id = $_GET['s_famille_id'];
$date_rapport = $_GET['date_rapport'];
$date_rapport_f = format_stringdateTodatetime('Y-m-d', $date_rapport, "d/m/Y");

ob_start();
?>

<style>
    *
    {
        margin:0;
        padding:0;
        font-family:helvetica;
        font-size:10pt;
        color:#000; 
    }
    #titre
    {
        margin-bottom:5px;
    }
    #table
    {
        width:100%;
        border-left: 0.5px solid #000;
        border-top: 0.5px solid #000;
        border-spacing:0;
        border-collapse: collapse; 
        font-family: helvetica; 

    }
    #table th
    {
        background:#eee;
        border:0.5px solid #000;
        height:10px;
        padding: 1mm;
        text-transform: uppercase;
        /*font-weight:bold;*/
    }
    #table td{
        border-right: 0.5px solid #000;
        border-bottom: 0.5px solid #000;
        padding: 1mm;
    }
    .page
    {
        height:297mm;
        width:210mm;
        page-break-after:always;
    }
    #entete{
        text-align: center;
        text-transform: uppercase;
        padding-top: 35px;
        padding-bottom: 15px;
        font-family: helvetica;
    }
    #entete1{
        margin-top: 55px;
        margin-right: 70px;
    }
</style>

<div id="content">
    <div id="entete1" align="right">
        <span>Kinshasa, </span><?php echo 'le ' . date('d/m/Y'); ?>
    </div>
    <div id="entete">
        <h3><u> INVENTAIRE <?php echo 'DU ' . $date_rapport_f; ?></u></h3>
    </div>
    <table  border="1" align="center" id="table">
        <thead>
            <tr>
                <th>N°</th>
                <th>DESIGNATION</th>
                <th>QTE</th>
                <!--<th>UNITE</th>-->
                <th>PAU</th>
                <th>PVU</th>
                <th>VALEUR ACHAT</th>
                <th>VALEUR VENTE</th>
                <th>MARGE</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $articles = $_SESSION['articles'];
            $tab_prod['produit']['id2'] = $_SESSION['produit_id2'];
            $tab_prod['produit']['id'] = $_SESSION['produit_id'];
            $tab_prod['produit']['qte'] = $_SESSION['produit_qte'];
            $tab_prod['produit']['pv'] = $_SESSION['produit_pv'];
            $valstock = 0;
            $valmarge = 0;
            $totmarge = 0;
            $ca = 0;

            foreach ($articles as $art) {
                $valmarge1 = 0;
                $valmarge2 = 0;
                $pv1 = $art->pv;
                $tx = $tauxdollar;
               /*  if (in_array($art->idprod, $tab_prod['produit']['id2'])) {
                    $pv1 = $tab_prod['produit']['pv'][$art->idprod];
                    $tx = $taux_resto;
                } */
                $pv = montant_equivalent_bdd($art->monnaie, $m_insert, $tauxdollar, $pv1);
                $pa = montant_equivalent_bdd($art->monnaie, $m_insert, $tauxdollar, $art->pa);

                if (in_array($art->idprod, $tab_prod['produit']['id'])) {
                    $solde = $tab_prod['produit']['qte'][$art->idprod];
                } else {
                    $solde = 0;
                }
                $valstock1 = $pa * $solde;
                if ($pv== 0) {
                    $valmarge1 = 0;
                    $valmarge2 = 0;
                } else {
                    $valmarge1 = ($pv * $solde);
                    $valmarge2 = $valmarge1 - $valstock1;
                }
                ?>
                <tr class="odd gradeX">     
                    <td><?php echo $i ?></td>
                    <td><?php echo $art->produit ?></td>
                    <td>
                        <?php echo $solde ?>
                    </td>
                    <!--<td><?php // echo $art->unite ?></td>-->
                    <td><?php echo afficheMontant($m_insert, $pa) ?></td>
                    <td> <?php echo afficheMontant($m_insert, $pv) ?> </td>

                    <td>
                        <?php
                        echo afficheMontant($m_insert, $valstock1)
                        ?>
                    </td>
                    <td>
                        <?php
                        echo afficheMontant($m_insert, $valmarge1)
                        ?>
                    </td>
                    <td>
                        <?php
                        echo afficheMontant($m_insert, $valmarge2);
                        ?>
                    </td>
                </tr>
                <?php
                $valmarge+=$valmarge1;
                $valstock+=$valstock1;
                $totmarge+=$valmarge2;
                $i++;
            }
            ?>
        </tbody>
         <tfoot>
             <tr>
                 <th colspan="5">Total</th>
                 <th><?php echo afficheMontant($m_insert, $valstock) ?></th>
                 <th><?php echo afficheMontant($m_insert, $valmarge) ?></th>
                 <th><?php echo afficheMontant($m_insert, $totmarge) ?></th> 
             </tr>
       </tfoot>
    </table>
</div>


<?php
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);

//Entete et pied de page
include './entete_pied_page.php';

$mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 15, 20, 5, 5);
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
//        $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list

$mpdf->WriteHTML($body);
$mpdf->Output("Inventaire.pdf", 'I');
