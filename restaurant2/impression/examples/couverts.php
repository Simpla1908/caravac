<?php
session_start();
include_once '../../../impression/mpdf60/mpdf.php';
include '../../bdd/connexion.php';
include_once '../../../FUNCTION/hebergement.php';
include '../../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';


$company_id = $_SESSION['company_id'];

$type=$_GET['mode'];

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
ob_start();
?>
<style>
    * {
        margin: 0;
        padding: 0;
        font-family: helvetica;
        font-size: 10pt;
        color: #000;
    }

    #titre {
        margin-bottom: 5px;
    }

    #table {
        width: 100%;
        border-left: 0.5px solid #000;
        border-top: 0.5px solid #000;
        border-spacing: 0;
        border-collapse: collapse;
        font-family: helvetica;

    }

    #table th {
        background: #eee;
        border: 0.5px solid #000;
        height: 10px;
        padding: 1mm;
        text-transform: uppercase;
        /*font-weight:bold;*/
    }

    #table td {
        border-right: 0.5px solid #000;
        border-bottom: 0.5px solid #000;
        padding: 1mm;
    }

    .page {
        height: 297mm;
        width: 210mm;
        page-break-after: always;
    }

    #entete {
        text-align: center;
        text-transform: uppercase;
        padding-top: 35px;
        padding-bottom: 15px;
        font-family: helvetica;
    }

    #entete1 {
        margin-top: 55px;
        margin-right: 70px;
    }
    
    #entete2 {
        text-align: center;
        padding-top: 485px;
        padding-bottom: 15px;
        font-family: helvetica;
    }
    #sign {
        margin-top: 55px;
    }
    #sign1 {
        margin-top: -35px;
    }
</style>
<div id="content">
    <div id="entete">
        <h3><u>LISTE DE COUVERTS <?php echo $type ?> <?php echo ' DU ' . $_SESSION['dte1']. ' AU ' . $_SESSION['dte2']; ?></u></h3><br>
       
    </div>
  <table width="444" border="1" align="center" id="table">
        <thead>
            <tr>
                <th>N°</th>
                <th>Date</th>
                <th>N° Facture</th>
                <th>Table</th>
                <th align="center">Nombre de couverts</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $nbArticles = count($_SESSION['couverts']['i']);
            for ($i = 0; $i <= $nbArticles - 1; $i++) {
            ?>
            <tr class="odd gradeX">
                <td><?php echo $_SESSION['couverts']['i'][$i] ?></td>
                <td><?php echo $_SESSION['couverts']['date_edition'][$i] ?></td>
                <td><?php echo $_SESSION['couverts']['num_fact'][$i] ?></td>
                <td><?php echo $_SESSION['couverts']['table'][$i] ?></td>
                <td align="center"><?php echo $_SESSION['couverts']['nbrcouvert'][$i] ?></td>
            </tr>
            <?php
             }
             ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" align="center">Total</th>
                <th align="center"><?php echo $_SESSION['tot_couverts']; ?></th>
            </tr>
        </tfoot>
    </table>
        <div id="entete25">
        <p align="center">
            <br><br><br><br><br><br><br><br>
        <span><i>Imprimé le  <?php echo date('d/m/Y'); ?> par </i></span>
        <b><?php echo strtoupper($_SESSION['nom_user'].' '.$_SESSION['prenom_user']); ?></b>
        </p>
    </div>
    <?php // }?>
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
$mpdf->WriteHTML($body);
$mpdf->Output("Couverts.pdf", "I");
