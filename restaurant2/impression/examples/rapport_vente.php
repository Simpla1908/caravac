<?php
if (!isset($_SESSION)) {
    session_start();
}
//Fusion horaire
date_default_timezone_set('Europe/Paris');

include_once '../../../impression/mpdf60/mpdf.php';
include '../../bdd/connexion.php';
include '../../../FUNCTION/hebergement.php';
include '../../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';

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

if (isset($_GET['date_bd1'])&&isset($_GET['date_bd2'])&&isset($_GET['periode'])) {
    $date_bd1 = $_GET['date_bd1'];
    $date_bd2 = $_GET['date_bd2'];
    $periode=$_GET['periode'];
$_SESSION['produit']=  VenteJournaliere($_SESSION['id_hotel'], $date_bd1, $date_bd2, $tauxdollar, $m_affiche, $bdd);
    $nbre_rows = count($_SESSION['produit']['code']);
}  else {
    $date_bd1=$date_bd2=  date('Y-m-d');
$_SESSION['produit']=  VenteJournaliere($_SESSION['id_hotel'], $date_bd1, $date_bd2, $tauxdollar, $m_affiche, $bdd);
    $nbre_rows = count($_SESSION['produit']['code']);
}
// Initialisation des données

 
    ob_start();
    $total = 0;  $total_tva = 0; $i=1;
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
    h2 { margin: 0; padding: 0; }
    p { margin: 25px; text-align: center; }
 
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
    .space { padding-top: 100px; }
    .10p { width: 10%; } .15p { width: 15%; } 
    .25p { width: 25%; } .50p { width: 50%; } 
    .60p { width: 60%; } .75p { width: 75%; } .100p { width: 100%; }
</style>
 
    <table style="margin-top: 50px;">
        
        <?php if (isset($_GET['date_bd1'])&&isset($_GET['date_bd2'])&&isset($_GET['periode'])) { ?>
        <tr>
            <td class="100p" style="text-align: center;">
                <h2><u>RAPPORT DES VENTES</u></h2><br />
                Période :
                <small>(du <?php echo $periode; ?>)</small>
            </td>
        </tr>
        <?php }else {?>
        <tr>
            <td class="100p" style="text-align: center;">
                <h2><u>RAPPORT DES VENTES</u></h2><br />
                Période :
                <small>(Aujourd'hui <?php echo date("d/m/y"); ?>)</small>
            </td>
        </tr>
        <?php }?>
    </table>
 
    <table style="margin-top: 30px; margin-left: 65px;" class="border">
        <thead>
            <tr>
                <th class="10p">N°</th>
                <th class="10p">CODE</th>
                <th class="15p">DESIGNATION</th>
                <th class="15p">QUANTITE</th>
                <th class="15p">PRIX TOTAL</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $j = 1;
            $total = 0;
            for ($i = 0; $i <= $nbre_rows - 1; $i++) {
                $code=$_SESSION['produit']['code'][$i];
                $designation=$_SESSION['produit']['designation'][$i];
                $qte=$_SESSION['produit']['qte'][$i];
                $prix_tot=$_SESSION['produit']['pt'][$i];
                ?>
                <tr>
                    <td style="text-align: center;"><?php echo $j ?></td>
                    <td style="text-align: center;"><?php echo $code ?></td>
                    <td style="text-align: center;"><?php echo $designation ?> </td>
                    <td style="text-align: center;"><?php echo $qte ?></td>
                    <td style="text-align: center;"><?php echo afficheMontant($m_affiche, $prix_tot) ?></td>
                <?php
                $j++;
                $total += $prix_tot;
                }
                ?> 
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4">Total</th> 
                <th style="text-align: center;"><?php echo afficheMontant($m_affiche, $total) ?></th>
            </tr>
        </tfoot>
    </table>
 
<?php
$body = ob_get_clean();
$body = iconv("UTF-8","UTF-8//IGNORE",$body);

//Entete et pied de page
include './entete_pied_page.php';

$mpdf = new mPDF('c','A4','','',15,15,30,20,5,5);
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
//        $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list

$mpdf->WriteHTML($body);
$mpdf->Output("Rapport vente.pdf", "I");

