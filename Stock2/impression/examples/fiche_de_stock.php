<?php
session_start();
include_once '../../bdd/connexion.php';

if (isset($_GET['famille_id']) && isset($_GET['date'])) {
    $famille_id = $_GET['famille_id'];
    $date = $_GET['date'];
    $qte_initial_save[0]=0;

    $requete = $bdd->prepare("SELECT designation FROM stk_famille WHERE idfamille=:idfamille AND hotel_id=:hotel_id");
    $requete->BindParam(':idfamille', $famille_id);
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $mouvements = $requete->fetchAll(PDO::FETCH_OBJ);

    /* Conversion date  */
    $transpostion_sortie = explode('-', $date);
    $annee1sor = $transpostion_sortie[0];
    $moisor = $transpostion_sortie[1];
    $jrsor = $transpostion_sortie[2];

    $date_heure_bon = $jrsor . '/' . $moisor . '/' . $annee1sor;

?>

<style>
    #titre
    {
        margin-bottom:35px;
        margin-top:10px;
    }
    #table
    {

        border:1px solid #dbd9d9;  
        border-collapse:collapse;
        margin-top:-20px;

    }
    #table th
    {
        background-color:#ccc;
        border:1px solid #000;
        height:20px;
        padding-left:5px;
        padding-right:5px;
    }
    #table td{
        _border:1px solid #adabab;
        height:20px;
        _width:80px;
    }
    #table tr:nth-child(even) {
        background: #cdd1d2;
        _background: rgb(240, 240, 240);
    }


    #pied
    {
        border-top :1px solid #000;
        height:50px;
        width:100%;
        text-align:center;
        margin-top:560px;
    }
    #entete
{
   margin-top: 55px;
   margin-right: 70px;
}
</style>

<page  orientation="P" backcolor="#fff" style="font:'Times New Roman', Times, serif;">

    <div id="content">
        <div id="entete" align="right">
            <span>Kinshasa, </span><?php echo $date_heure_bon; ?>
        </div>
        <div id="titre" align="center">

            <u><h3><strong>FICHE DE STOCK DES PRODUITS </strong></h3></u>
            <h4>(Catégorie: <?php  foreach ($mouvements as $ap): echo $ap->designation; endforeach;?>)</h4>
        </div>
        <table width="444" border="1" align="center" id="table">
            <thead>
                <tr>
                    <th width="26" align="center" valign="middle">N°</th>
                    <th width="181" align="center" valign="middle">Désignation</th>
                    <th width="70" align="center" valign="middle">Initial </th>
                    <th width="70" align="center" valign="middle">Entrées </th>
                    <th width="70" align="center" valign="middle">Sorties </th>
                    <th width="70" align="center" valign="middle">Solde </th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 1;
                $j = 1;
               
                 $requete = $bdd->prepare("SELECT sfam.famille,prod.famille_id,sfam.des,m.produit_id,prod.designation,dte_appro,qte_initial AS initial, SUM(qte_entree) AS entree,SUM(qte_sortie) AS sortie
                        FROM  stk_produit AS prod,stk_sous_famille AS sfam,stk_famille AS fam,stk__mouvement AS m  
                        WHERE prod.idprod=m.produit_id   
                        AND sfam.famille=fam.idfamille
                        AND prod.famille_id=sfam.id_s_fam
                        AND m.hotel_id=:hotel_id 
                        AND dte_appro=:date_rapport 
                        GROUP BY m.produit_id 
                        HAVING sfam.famille=:famille_id ORDER BY prod.designation");
                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                $requete->BindParam(':date_rapport', $date);
                $requete->BindParam(':famille_id', $famille_id);
                $requete->execute();
                $articles = $requete->fetchAll(PDO::FETCH_OBJ);
                
                foreach ($articles as $art):
                    ?>
                    <tr class="odd gradeX"> 	
                        <td align="left" valign="middle">&nbsp;&nbsp;<?php echo $i ?></td>
                        <td align="left" valign="middle">&nbsp;&nbsp;<?php echo $art->designation ?></td>
                        <td align="center" valign="middle">
                            <?php 
                                if ($date ==  date('Y-m-d')) {
                                    echo $art->initial;
                                }  else {
                                    $requete = $bdd->prepare("SELECT qte_initial_save
                                                            FROM  stk_report  
                                                            WHERE produit_id=:produit_id   
                                                            AND hotel_id=:hotel_id 
                                                            AND dte_report=:dte_report");
                                    $requete->BindParam(':produit_id', $art->produit_id);
                                    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                                    $requete->BindParam(':dte_report', $date);
                                    $requete->execute();
                                    $report = $requete->fetchAll(PDO::FETCH_OBJ);

                                    foreach ($report as $rpt):
                                        $qte_initial_save[$i]=$rpt->qte_initial_save;
                                        echo $rpt->qte_initial_save;
                                    endforeach;
                                }

                            ?>
                            </td>
                            <td align="center" valign="middle"><?php echo $art->entree ?></td>
                            <td align="center" valign="middle"><?php echo $art->sortie ?></td>
                            <td align="center" valign="middle">
                                <?php 
                                if ($date ==  date('Y-m-d')) {
                                        echo ($art->initial+$art->entree)-$art->sortie; 
                                    }  else {
                                        echo ($qte_initial_save[$i]+$art->entree)-$art->sortie; 
                                    }

                                ?>
                            </td>
                    </tr>
                    <?php 
                    $i++;
                  endforeach;
                ?>
            </tbody>
            
        </table>
    </div>

</page>

<?php
}
$content = ob_get_clean();

// convert
require_once(dirname(__FILE__) . '/../html2pdf.class.php');
try {
    $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 0);
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('ticket.pdf');
} catch (HTML2PDF_exception $e) {
    echo $e;
    exit;
}

