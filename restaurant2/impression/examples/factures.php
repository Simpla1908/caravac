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
<!--    <div id="entete1" align="right">
        <span>Kinshasa, </span><?php // echo 'le ' . date('d/m/Y'); ?>
    </div>-->
    <div id="entete">
        <h3><u>FACTURES <?php echo $type ?> <?php echo ' DU ' . dateAffiche($_SESSION['dte1']) . ' AU ' . dateAffiche($_SESSION['dte2']); ?></u></h3><br>
       
    </div>
<?php  if($type=='cash'){?>
    <table width="444" border="1" align="center" id="table">
        <thead>
            <tr>
                <th>N°</th>
                <th>N° Facture</th>
                <th>Client</th>
                <th>Vendeur</th>
                <th>Date</th>
                <th>Mode</th>
                <th>Montant total</th>
                <th>Montant Payé</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $nbArticles = count($_SESSION['facture']['id']);
            $j=1;
            $tot1 = 0;
            $tot2 = 0;
            for ($i = 0; $i <= $nbArticles - 1; $i++) {
            ?>
            <tr class="odd gradeX">
                <td align="center"><?php echo $j ?></td>
                <td><?php echo $_SESSION['facture']['num'][$i] ?></td>
                <td><?php echo $_SESSION['facture']['client'][$i] ?></td>
                <td><?php echo $_SESSION['facture']['vendeur'][$i] ?></td>
                <td><?php echo dateAffiche($_SESSION['facture']['date'][$i]) ?></td>
                <td><?php echo $_SESSION['facture']['mode'][$i] ?></td>
                <td align="center"><?php echo afficheMontant2($m_affiche,$_SESSION['facture']['mont_tot'][$i]) ?></td>
                <td align="center"><?php echo afficheMontant2($m_affiche,$_SESSION['facture']['mont_paye'][$i]) ?></td>

            </tr>
            <?php
            $tot1+=$_SESSION['facture']['mont_tot'][$i];
            $tot2+=$_SESSION['facture']['mont_paye'][$i];
             $j++;
             }
             ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6"><span class="pull-right">Total</span></th>
                <th><?php echo afficheMontant2($m_affiche, $tot1); ?></th>
                <th><?php echo afficheMontant2($m_affiche, $tot2); ?></th>
            </tr>
        </tfoot>
    </table>
<?php  }elseif($type=='credit'){?>
    <table width="444" border="1" align="center" id="table">
        <thead>
            <tr>
                <th>N°</th>
                <th>N° Facture</th>
                <th>Client</th>
                <th>Vendeur</th>
                <th>Date</th>
                <!--<th>Mode</th>-->
                <th>Montant total</th>
                <th>Montant Payé</th>
                <th>Solde</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $nbArticles = count($_SESSION['facture1']['id']);
            $j=1;
            $tot1 = 0;
            $tot2 = 0;
            for ($i = 0; $i <= $nbArticles - 1; $i++) {
                $solde = $_SESSION['facture1']['mont_tot'][$i] - $_SESSION['facture1']['mont_paye'][$i];
            ?>
            <tr class="odd gradeX">
                <td align="center"><?php echo $j ?></td>
                <td><?php echo $_SESSION['facture1']['num'][$i] ?></td>
                <td><?php echo $_SESSION['facture1']['client'][$i] ?></td>
                <td><?php echo $_SESSION['facture1']['vendeur'][$i] ?></td>
                <td><?php echo dateAffiche($_SESSION['facture1']['date'][$i]) ?></td>
                <!--<td><?php // echo $_SESSION['facture']['mode'][$i] ?></td>-->
                <td align="center"><?php echo afficheMontant2($m_affiche,$_SESSION['facture1']['mont_tot'][$i]) ?></td>
                <td align="center"><?php echo afficheMontant2($m_affiche,$_SESSION['facture1']['mont_paye'][$i]) ?></td>
                <td align="center"><?php echo afficheMontant2($m_affiche,$solde) ?></td>
            </tr>
            <?php
            $tot1+=$_SESSION['facture1']['mont_tot'][$i];
            $tot2+=$_SESSION['facture1']['mont_paye'][$i];
             $j++;
             }
             $totsolde = $tot1 - $tot2;
             ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5"><span class="pull-right">Total</span></th>
                <th><?php echo afficheMontant2($m_affiche, $tot1); ?></th>
                <th><?php echo afficheMontant2($m_affiche, $tot2); ?></th>
                <th><?php echo afficheMontant2($m_affiche, $totsolde); ?></th>
            </tr>
        </tfoot>
    </table>
<?php  }elseif($type=='don'){?>
    <table width="444" border="1" align="center" id="table">
        <thead>
            <tr>
                <th>N°</th>
                <th>N° Facture</th>
                <th>Client</th>
                <th>Vendeur</th>
                <th>Date</th>
                <!--<th>Mode</th>-->
                <th>Montant total</th>
                <th>Montant Payé</th>
                <th>Solde</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $nbArticles = count($_SESSION['facture2']['id']);
            $j=1;
            $tot1 = 0;
            $tot2 = 0;
            for ($i = 0; $i <= $nbArticles - 1; $i++) {
                $solde = $_SESSION['facture2']['mont_tot'][$i] - $_SESSION['facture2']['mont_paye'][$i];
            ?>
            <tr class="odd gradeX">
                <td align="center"><?php echo $j ?></td>
                <td><?php echo $_SESSION['facture2']['num'][$i] ?></td>
                <td><?php echo $_SESSION['facture2']['client'][$i] ?></td>
                <td><?php echo $_SESSION['facture2']['vendeur'][$i] ?></td>
                <td><?php echo dateAffiche($_SESSION['facture2']['date'][$i]) ?></td>
                <!--<td><?php // echo $_SESSION['facture']['mode'][$i] ?></td>-->
                <td align="center"><?php echo afficheMontant2($m_affiche,$_SESSION['facture2']['mont_tot'][$i]) ?></td>
                <td align="center"><?php echo afficheMontant2($m_affiche,$_SESSION['facture2']['mont_paye'][$i]) ?></td>
                <td align="center"><?php echo afficheMontant2($m_affiche,$solde) ?></td>
            </tr>
            <?php
            $tot1+=$_SESSION['facture2']['mont_tot'][$i];
            $tot2+=$_SESSION['facture2']['mont_paye'][$i];
             $j++;
             }
             $totsolde = $tot1 - $tot2;
             ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5"><span class="pull-right">Total</span></th>
                <th><?php echo afficheMontant2($m_affiche, $tot1); ?></th>
                <th><?php echo afficheMontant2($m_affiche, $tot2); ?></th>
                <th><?php echo afficheMontant2($m_affiche, $totsolde); ?></th>
            </tr>
        </tfoot>
    </table>
<?php  }elseif($type=='annuelees'){?>
    <table width="444" border="1" align="center" id="table">
        <thead>
            <tr>
                <th>N°</th>
                <th>N° Facture</th>
                <th>Client</th>
                <th>Vendeur</th>
                <th>Date</th>
                <!--<th>Mode</th>-->
                <th>Montant total</th>
<!--                <th>Montant Payé</th>
                <th>Solde</th>-->
            </tr>
        </thead>
        <tbody>
            <?php 
            $nbArticles = count($_SESSION['facture3']['id']);
            $j=1;
            $tot1 = 0;
            $tot2 = 0;
            for ($i = 0; $i <= $nbArticles - 1; $i++) {
                $solde = $_SESSION['facture3']['mont_tot'][$i] - $_SESSION['facture3']['mont_paye'][$i];
            ?>
            <tr class="odd gradeX">
                <td align="center"><?php echo $j ?></td>
                <td><?php echo $_SESSION['facture3']['num'][$i] ?></td>
                <td><?php echo $_SESSION['facture3']['client'][$i] ?></td>
                <td><?php echo $_SESSION['facture3']['vendeur'][$i] ?></td>
                <td><?php echo dateAffiche($_SESSION['facture3']['date'][$i]) ?></td>
                <!--<td><?php // echo $_SESSION['facture']['mode'][$i] ?></td>-->
                <td align="center"><?php echo afficheMontant2($m_affiche,$_SESSION['facture3']['mont_tot'][$i]) ?></td>
            </tr>
            <?php
            $tot1+=$_SESSION['facture3']['mont_tot'][$i];
             $j++;
             }
             ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5"><span class="pull-right">Total</span></th>
                <th><?php echo afficheMontant2($m_affiche, $tot1); ?></th>
            </tr>
        </tfoot>
    </table>
<?php  }elseif($type=='fusion'){?>
    <table width="444" border="1" align="center" id="table">
        <thead>
            <tr>
                <th>N°</th>
                <th>N° Facture</th>
                <th>Créée par</th>
                <th>Date</th>
                <th>Montant total</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $nbArticles = count($_SESSION['facture4']['id']);
            $j=1;
            $tot1 = 0;
            $tot2 = 0;
            for ($i = 0; $i <= $nbArticles - 1; $i++) {
            ?>
            <tr class="odd gradeX">
                <td align="center"><?php echo $j ?></td>
                <td><?php echo $_SESSION['facture4']['num'][$i] ?></td>
                <td><?php echo $_SESSION['facture4']['creeepar'][$i] ?></td>
                <td><?php echo dateAffiche($_SESSION['facture4']['date'][$i]) ?></td>
                <td align="center"><?php echo afficheMontant2($m_affiche,$_SESSION['facture4']['mont_tot'][$i]) ?></td>
            </tr>
            <?php
            $tot1+=$_SESSION['facture4']['mont_tot'][$i];
             $j++;
             }
             ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4"><span class="pull-right">Total</span></th>
                <th><?php echo afficheMontant2($m_affiche, $tot1); ?></th>
            </tr>
        </tfoot>
    </table>
<?php  }?>
<div>
<!--        <div id="sign" align="left">
            <span>Bénéficiaire</span><br>
        <b><?php echo strtoupper($_SESSION['benef']); ?></b>
        </div>-->
        <div align="right">
            <!--<span>Chargé de Stock</span><br>-->
            <p align="right">
                <br><br>
                <b><?php echo strtoupper($_SESSION['user']); ?></b>
            </p>
        
        </div>
    </div>
    
    <?php // if($_SESSION['date']==  date('d/m/Y')){ ?>
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
$mpdf->Output("Facture.pdf", "I");
