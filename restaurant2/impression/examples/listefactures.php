<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../../../impression/mpdf60/mpdf.php';
include '../../bdd/connexion.php';
include_once '../../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include_once '../../../FUNCTION/hebergement.php';


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
        <tr>
            <td class="100p" style="text-align: center;">
                <h2><u>EXTRAIT DE COMPTE</u></h2><br/>
                <b>(Resto: <?php echo strtoupper($_SESSION['libelle_resto'])?>)</b><br>
            </td>
        </tr>
    </table>
    <table style="margin-top:45px;" class="border">
            <thead>
                <tr>
                <th>#</th>
                <th>Utilisateur</th>
                <th>Date</th>
                <th>Montant versé USD</th>
                <th>Montant versé CDF</th>
                <th>Solde USD</th>
                <th>Solde CDF</th>
                <th>Etat</th>
                </tr>
            </thead>
            <tbody>
           <?php
            $nbArticles = count($_SESSION['versement']['n']);
            for ($i = 0; $i <= $nbArticles - 1; $i++) {
             ?>
            <tr>
                <td style="text-align: center;"><?php echo $_SESSION['versement']['n'][$i] ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['versement']['util'][$i] ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['versement']['dte'][$i] ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['versement']['musd'][$i] ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['versement']['mcdf'][$i] ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['versement']['susd'][$i] ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['versement']['scdf'][$i] ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['versement']['etat'][$i] ?></td>
            </tr>
            <?php
            }
          ?>
        </tbody>
          <tfoot>
        <tr>
            <td colspan="3"><b>Total</b></td>
            <td><b><?php echo $_SESSION['totusd1'] ?></b></td>
            <td><b><?php echo $_SESSION['totcdf1'] ?></b></td>
            <td><b><?php echo $_SESSION['totusd'] ?></b></td>
            <td><b><?php echo $_SESSION['totcdf'] ?></b></td>
            <td> </td>
        </tr>
    </tfoot>
        </table>
 
<?php
$body = ob_get_clean();
$body = iconv("UTF-8","UTF-8//IGNORE",$body);

//Entete et pied de page
include './entete_pied_page.php';

$mpdf = new mPDF('c','A4-L','','',15,15,30,20,5,5);
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
//        $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list

$mpdf->WriteHTML($body);
$mpdf->Output("ExtraitDeCompte.pdf", "I");



