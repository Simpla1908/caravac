<?php
session_start();
include_once '../../impression/mpdf60/mpdf.php';
include '../bdd/connexion.php';
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
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
/* Fin de la Recuperation des coordonnées de l'sites */

//if (isset($_GET['famille_id']) && isset($_GET['date_rapport']) && isset($_GET['date_PF'])) {
$date_rapport = $_GET['date_rapport'];
$date_PF = $_GET['date_PF'];
$debut = $_GET['debut'];
$fin = $_GET['fin'];

$req2 = "SELECT prod.code,prod.qte_dispo,m.produit_id,prod.designation,prod.pa,prod.pv,prod.qte_initial,prod.monnaie,SUM(qte_entree) AS entree,SUM(qte_sortie) AS sortie, rep.qte_initial_save,rep.dte_report_time
                    FROM  stk_produit AS prod,stk_sous_famille AS sfam,stk__mouvement AS m,stk_report AS rep
                            WHERE prod.idprod=m.produit_id
                            AND prod.famille_id=sfam.id_s_fam 
                             AND m.idmvt=rep.idmvt
                            AND rep.dte_report BETWEEN :date_rapport AND :datefin
                            AND m.hotel_id=:hotel_id 
                            GROUP BY m.produit_id ORDER BY prod.designation";

$requete = $bdd->prepare($req2);
$requete->BindParam(':date_rapport', $date_rapport);
$requete->BindParam(':datefin', $date_PF);
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->execute();
$articles = $requete->fetchAll(PDO::FETCH_OBJ);

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
        <span>Kinshasa, </span><?php echo 'le '. date('d/m/Y'); ?>
    </div>
    <div id="entete">
        <h3><u> INVENTAIRE <?php echo 'DU '.$debut.' AU '.$fin; ?></u></h3>
    </div>
    <table  border="1" align="center" id="table">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Produit</th>
                    <th>Q.disponible</th>
                    <th>PAU</th>
                    <th>PVU</th>
                    <th>Marge</th>
                    <th>Valeur stock</th>
                </tr>
            </thead> 
              
            <tbody>
                <?php
                $i = 1;
                $valstock = 0;
                $ca = 0;
                foreach ($articles as $art) {
                    $qo = $art->qte_initial_save;
                    if ($art->monnaie == $m_affiche) {
                        $pv = $art->pv;
                        $pa = $art->pa;
                    } else {
                        if ($art->monnaie = 'USD' && $m_affiche == 'CDF') {
                            $pv = round($art->pv * $tauxdollar, 2);
                            $pa = round($art->pa * $tauxdollar, 2);
                        } else {
                            $pv = round($art->pv * 1 / $tauxdollar, 2);
                            $pa = round($art->pa * 1 / $tauxdollar, 2);
                        }
                    }
                    ?>
                <tr class="odd gradeX"> 	
                        <td><?php echo $i ?></td>
                        <td><?php echo $art->designation ?></td>
                        <td>
                            <?php
                               $solde=$art->entree-$art->sortie;
                            echo$solde
                            ?>
                        </td>
                    <td><?php echo $pa . ' ' . $m_affiche ?></td>
                    <td> <?php echo $pv . ' ' . $m_affiche ?> </td>
                        <td><?php $marge = $pv - $pa;
                            echo$marge . ' ' . $m_affiche
                            ?></td>
                        <td>
                            <?php $valstock1 = $pa * $solde;
                            echo $valstock1 . ' ' . $m_affiche
                            ?>
                        </td>
                    </tr>
                    <?php
                        $valstock+=$valstock1;
                        $i++;
                    };
                    ?>
                    <tr>
                         <td colspan="6">
                        </td>
                        <td>
                            <?php echo $valstock . ' ' . $m_affiche
                            ?>
                        </td>
                    </tr>
            </tbody>
            
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
$mpdf->Output("Inventaire.pdf",'I');
