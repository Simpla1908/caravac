<?php
session_start();
include_once '../../impression/mpdf60/mpdf.php';
include_once '../../bdd/connexion.php';
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
ob_start();
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
                <h2>FICHE DE STOCK "<?php echo $_SESSION['designation_produit'];?>"</h2><br />
                Dépôt :
                <small><?php echo $_SESSION['libelle_depot']; ?></small><br />
                Période :
                <small><?php echo $_SESSION['periode_fiche']; ?></small>
            </td>
        </tr>
       
    </table>
 
    <table style="margin-top: 30px; margin-left: 65px;" class="border">
        <tr>
            <td style="text-align: center;">N°</td>
            <td style="text-align: center;">Date</td>
            <td style="text-align: center;">Initiale</td>
            <td style="text-align: center;">Entrée</td>
            <td style="text-align: center;">Sortie</td>
            <td style="text-align: center;">Avarie</td>
            <td style="text-align: center;">Solde</td>
        </tr>
             <?php 
                $nbArticles = count($_SESSION['fichestk']['i']);
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                ?>
                <tr>
                <td><?php echo $_SESSION['fichestk']['i'][$i] ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['fichestk']['Date'][$i] ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['fichestk']['Initiale'][$i] ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['fichestk']['Entree'][$i] ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['fichestk']['Sortie'][$i] ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['fichestk']['Avarie'][$i] ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['fichestk']['Solde'][$i] ?></td>
                </tr>
                <?php
                 }
                 ?>
    </table>
    <div id="entete25">
        <p align="center">
            <br><br><br><br><br>
        <span>Imprimé le  <?php echo date('d/m/Y'); ?> par </span>
        <?php echo strtoupper($_SESSION['nom_user'].' '.$_SESSION['prenom_user']); ?>
        </p>
    </div>

</div>
<?php
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);
//Entete et pied de page
include './entete_pied_page.php';
$mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
$mpdf->WriteHTML($body);
$mpdf->Output("detailsfichestock.pdf", "I");
?>