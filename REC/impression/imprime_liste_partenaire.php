<?php
include_once '../../impression/mpdf60/mpdf.php';
include '../../bdd/connexion.php';
session_start();

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
    $email_compagny = $donnees['email_company'];
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
        /*page-break-after:always;*/
        /*page-break-after:avoid;*/

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
/*    #content
    {
        height:297mm;
        width:210mm;
        page-break-after:always;
        page-break-after:avoid;
    }*/
    #entete{
        text-align: center;
        text-transform: uppercase;
/*        padding-top: 25px;
        padding-bottom: 10px;*/
        font-family: helvetica;
    }

</style>

<div id="content">
    <div id="entete">
        <h3><u>Liste des partenaires</u></h3>
    </div>
    <table border="1" align="center" id="table">
        <thead>
            <tr>
                <th>N°</th>
                <th>Nom Entreprise</th>
                <th>Adresse</th>
                <th>Responsable</th>
                <th>contact</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            /* Recuperation des partenaires */
            $requete_hotel = $bdd->prepare("SELECT c.id_respo,c.nom_respo,c.telephone_respo,c.adresse_respo,c.entreprise FROM  t_responsable c WHERE c.entreprise!='prive' AND c.company_id=:company_id ORDER BY c.entreprise ASC");
            $requete_hotel->BindParam(':company_id', $company_id);
            $requete_hotel->execute();
            while ($donnees = $requete_hotel->fetch()) {
                $nom_respo = $donnees['nom_respo'];
                $telephone_respo = $donnees['telephone_respo'];
                $adresse_respo = $donnees['adresse_respo'];
                $entreprise = $donnees['entreprise'];
                
                if ($entreprise != $nom_respo) {   
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td valign="middle"><?php echo $entreprise; ?></td>
                    <td valign="middle"><?php echo $adresse_respo; ?></td>   
                    <td valign="middle"><?php echo $nom_respo; ?></td>
                    <td valign="middle"><?php echo $telephone_respo; ?></td>
                </tr>
                <?php
                $i++;
                }
                
            }/* Fin de la boucle while */
            ?>
        </tbody>
    </table>
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
$mpdf->Output("liste de partenaires.pdf", "I");