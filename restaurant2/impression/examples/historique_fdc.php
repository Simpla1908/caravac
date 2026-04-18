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
    $datedebut=$_SESSION['datedebut'];
    $datefin=$_SESSION['datefin'];
   if ($_SESSION['type_user'] == 1) {
       $requete = $bdd->prepare("SELECT a.id,a.cdf AS fond_cdf,a.usd AS fond_usd,b.id_user,b.nom_user,b.prenom_user,a.dte,a.hr
        FROM fondscaisse AS a,t_utilisateur AS b
        WHERE a.dte BETWEEN :p_debut AND :p_fin 
        AND a.user_id=b.id_user AND a.sousresto_id=:id_sousresto ORDER BY a.dte DESC");
        $requete->BindParam(':p_debut', $datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
        }else{
        $requete = $bdd->prepare("SELECT a.id,a.cdf AS fond_cdf,a.usd AS fond_usd,b.id_user,b.nom_user,b.prenom_user,a.dte,a.hr
        FROM fondscaisse AS a,t_utilisateur AS b
        WHERE a.dte BETWEEN :p_debut AND :p_fin 
        AND a.user_id=b.id_user AND a.sousresto_id=:id_sousresto  AND b.id_user=:id_user ORDER BY a.dte DESC");
        $requete->BindParam(':p_debut', $datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
        $requete->BindParam(':id_user',$_SESSION['id_user']);

        }
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ); 
     ob_start();
;
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
                <h2><u>LISTE DES FONDS DE CAISSE</u></h2><br />
                Période :
                <small>(du <?php echo dateAffiche($_SESSION['datedebut']); ?> au <?php echo dateAffiche($_SESSION['datefin']); ?>)</small>
            </td>
        </tr>
       
    </table>
 
    <table style="margin-top: 30px; margin-left: 65px;" class="border">
        <thead>
            <tr>
                <th class="10p">N°</th>
                <th class="10p">DATE</th>
                <th class="15p">UTILISATEUR</th>
                <th class="15p">FOND USD</th>
                <th class="15p">FOND CDF</th>
            </tr>
        </thead>
        <tbody>
           <?php
            $i=1;
            $musd = getsymbole_devise();
            $mcdf = getsymbole_local();
            $totusd=0;
            $totcdf=0;
            foreach ($result as $r) {
                $id=$r->id;
                $id_user=$r->id_user;
                $dte=$r->dte;
                $hr=$r->hr;
                $mont_cdf = $r->fond_cdf;
                $mont_usd = $r->fond_usd;
                $noms_user = $r->prenom_user . ' ' . $r->nom_user;
                $totusd=$totusd+$mont_usd;
                $totcdf=$totcdf+$mont_cdf;
                ?>
                <tr>
                    <td style="text-align: center;"><?php echo $i ?></td>
                    <td style="text-align: center;"><?php echo dateAffiche($dte).' '.$hr ?></td>
                    <td style="text-align: center;"><?php echo $noms_user ?> </td>
                    <td style="text-align: center;"><?php echo afficheMontant($musd,$mont_usd) ?></td>
                    <td style="text-align: center;"><?php echo afficheMontant($musd,$mont_cdf) ?></td>
                <?php
                $i++;
                }
                ?> 
            </tr>
        </tbody>
        <tfoot>
            <tr>
                     <th colspan="3">Total</th>
                    <th style="text-align: center;"><?php echo afficheMontant($musd,$totusd) ?></th>
                     <th style="text-align: center;"><?php echo afficheMontant($mcdf,$totcdf) ?></th>
            </tr>
        </tfoot>
    </table>
   <div id="entete25">
        <p align="center">
            <br><br><br><br><br>
        <span>Imprimé le  <?php echo date('d/m/Y'); ?> par </span>
        <b><?php echo strtoupper($_SESSION['nom_user'].' '.$_SESSION['prenom_user']); ?></b>
        </p>
    </div>
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
$mpdf->Output("Liste des fonds caisse.pdf", "I");

