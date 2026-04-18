<?php
session_start();
include_once '../../impression/mpdf60/mpdf.php';
include '../../FUNCTION/hebergement.php';
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

$requete = $bdd->prepare("SELECT numero FROM fiche_transfert WHERE  hotel_id=:hotel_id ORDER BY id_fiche DESC LIMIT 1");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($operations as $op) {
    $numero = $op->numero;
}

$requete = $bdd->prepare("SELECT libelle FROM t_depot WHERE  id_depot=:id_depot ");
$requete->BindParam(':id_depot', $_SESSION['id_depot']);
$requete->execute();
$operations1 = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($operations1 as $op1) {
    $nom_depot = $op1->libelle;
}

//$tab_prod['produit'] = array();
//$tab_prod['produit']['id'] = array();
//$tab_prod['produit']['qte'] = array();
//$s_famille_id = $_GET['s_famille_id'];
//$date_rapport= $_GET['date_rapport'];
//$date_rapport_f= format_stringdateTodatetime('Y-m-d', $date_rapport,"d/m/Y");
//if($s_famille_id==0){
//$req1 = "SELECT prod.idprod,prod.code,prod.designation AS produit,prod.pa,prod.pv,prod.qte_initial,prod.qte_min,prod.unite,prod.monnaie,s_fam.des,fam.designation FROM stk_produit AS prod,stk_sous_famille AS s_fam ,stk_famille AS fam WHERE  prod.famille_id=s_fam.id_s_fam AND prod.hotel_id=:hotel_id AND s_fam.famille=fam.idfamille AND prod.pseudo_supp=0 AND fam.plat=0 ORDER BY prod.designation ";
//        $requete = $bdd->prepare($req1);
//$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
//$requete->execute();
//$articles = $requete->fetchAll(PDO::FETCH_OBJ);
//}else{
//    $req1 = "SELECT prod.idprod,prod.code,prod.designation AS produit,prod.pa,prod.pv,prod.qte_initial,prod.qte_min,prod.unite,prod.monnaie,s_fam.des,fam.designation FROM stk_produit AS prod,stk_sous_famille AS s_fam ,stk_famille AS fam WHERE  prod.famille_id=s_fam.id_s_fam AND prod.hotel_id=:hotel_id AND s_fam.famille=fam.idfamille AND fam.idfamille=:idfamille AND prod.pseudo_supp=0 AND fam.plat=0 ORDER BY prod.designation ";
//    $requete = $bdd->prepare($req1);
//    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
//    $requete->BindParam(':idfamille',$s_famille_id);
//    $requete->execute();
//    $articles = $requete->fetchAll(PDO::FETCH_OBJ);
//}
//
//$req2 = "SELECT m.produit_id, (SUM(qte_entree)-SUM(qte_sortie)) AS qte_dispo 
//       FROM stk__mouvement AS m, stk_produit AS p
//       WHERE m.produit_id=p.idprod
//       AND m.dte_appro<=:date 
//       AND m.hotel_id=:hotel_id 
//       GROUP BY m.produit_id";
//$requete = $bdd->prepare($req2);
//$requete->BindParam(':date', $date_rapport);
//$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
//$requete->execute();
//$articles2 = $requete->fetchAll(PDO::FETCH_OBJ);
//
//foreach ($articles2 as $art2) {
//    array_push($tab_prod['produit']['id'], $art2->produit_id);
//    $tab_prod['produit']['qte'][$art2->produit_id]= $art2->qte_dispo;
//}

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
        /*text-transform: uppercase;*/
        padding-top: 35px;
        padding-bottom: 15px;
        font-family: helvetica;
    }
    #entete1{
        margin-top: 50px;
            margin-right: 70px;
    }
    #entete2 {
        height: 8px;
        margin-top: 80px;
    }
    #objet1 {
        margin-top: 60px;
        width: 250px;
        /*margin-right: 70px;*/
    }
    #titleobj {
/*        border-bottom: 1px solid #000000; 
        vertical-align: bottom; */
        font-weight: bold; 
        /*font-size: 12pt;*/
    }
    #destinateur1 {
        /*border: 1px solid #000000;*/ 
        margin-top: -40px;
        margin-left: 450px;
        width: 300px;

    }
    
</style>

<div id="content">
    <div id="entete2" align="right"></div>
    
    <div id="entete">
        <h3><u> FICHE DE TRANSFERT N° <?php echo $numero; ?></u></h3>
        <strong>(Depot: <?php echo $nom_depot; ?>)
        </strong>
    </div>
    <table  border="1" align="center" id="table">
        <thead>
            <tr>
                <th>N°</th>
                <th>Désignation</th>
                <th>Quantité</th>
                <th>Unité</th>
           </tr>
       </thead>
       <tbody>
           <?php 
            $j=1;
            $qte_tot=0;
            $nbArticles = count($_SESSION['fiche']['produit_id']);
            for ($i = 0; $i <= $nbArticles - 1; $i++) {
            ?>
        <tr>
            <td><?php echo $j ?></td>
            <td><?php echo $_SESSION['fiche']['designation'][$i] ?></td>
            <td align="center">
                <?php echo $_SESSION['fiche']['qte'][$i] ?>
            </td>
            <td><?php echo $_SESSION['fiche']['code'][$i] ?></td>
        </tr>
        <?php 
        $j++; 
        $qte_tot+=$_SESSION['fiche']['qte'][$i];
        }; 
        ?>
       </tbody>
       <tfoot>
           <tr>
                <th colspan="3">Total</th>
                <th><?php echo  $qte_tot ?></th>
            </tr>
       </tfoot>  
    </table>
    <div id="objet1" align="center">
            <span style="font-weight: bold;">Chargé Stock / Economat</span><br><br>
            <span id="titleobj"><?php // echo 'Elila WELA MARCELINE'; ?></span>
        </div>
        <div id="destinateur1" align="center">
            <span style="font-weight: bold;">Bénéficiaire</span><br><br>
            <span id="titleobj"><?php echo 'Marcel KAMWANYA KONGOLO'; ?></span>
        </div>
        <div id="entete1" align="right">
            <span>Kinshasa, </span><?php echo 'le '. date('d/m/Y'); ?>
        </div>
        
        <div id="entete2" align="center">
            <span>Imprimé, le <?php echo date('d/m/Y'); ?> par: </span><?php echo strtoupper($_SESSION['nom_user'].' '.$_SESSION['prenom_user']); ?>
        </div>
</div>


<?php
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);

//Entete et pied de page
include './entete_pied_page.php';

$mpdf = new mPDF('c', 'A4', '', '', 15, 15, 15, 20, 5, 5);
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
//        $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list

$mpdf->WriteHTML($body);
$mpdf->Output("Fiche de transfert.pdf",'I');
