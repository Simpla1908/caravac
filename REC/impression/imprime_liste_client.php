<?php
include_once '../../impression/mpdf60/mpdf.php';
include '../../bdd/connexion.php';
session_start();

$company_id = $_SESSION['company_id'];
$id_hotel=$_SESSION['id_hotel'];


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
    
    #entete1 {
        margin-top: 10px;
        margin-right: 70px;
    }

</style>
 
<div id="content">
    <div id="entete">
	<h3><u>Liste des clients</u></h3>
    </div>
   <table border="1" align="center" id="table">
        <thead>
            <tr>
                <th>N°</th>
                <th valign="middle">Clients</th>
                <th valign="middle">Responsable</th>
                <th valign="middle">Sexe</th>
                <th valign="middle">Etat civil</th>
                <th valign="middle">Adresse</th>
                <th valign="middle">Tél</th>
                <th valign="middle">Email</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $i=1;
		$type='reservation';
		
			/* Recuperation du paiement d'un client */
		$requete_client = $bdd->prepare("SELECT * FROM  t_client c, t_responsable r WHERE c.id_hotel=:id_hotel AND c.id_respo=r.id_respo ORDER BY c.id_client ASC");
		$requete_client->BindParam(':id_hotel', $id_hotel);
		$requete_client->execute();
		while ($donnees = $requete_client->fetch()) 
		{
			$id_client=$donnees['id_client'];
			$nom_client=$donnees['nom_client'];
			$entreprise=$donnees['entreprise'];
			$sexe_client=$donnees['sexe_client'];
			$etat_civil_client=$donnees['etat_civil_client'];
			$adresse_provenance_client=$donnees['adresse_provenance_client'];
			$telephone_client=$donnees['telephone_client'];
			$email_client=$donnees['email_client'];
	
        ?>
                
            <tr>
                <td><?php echo $i;?></td>
                <td valign="middle"><?php echo $nom_client;?></td>
                <td valign="middle"><?php echo $entreprise;?></td>   
                <td valign="middle" align="center">
                    <?php 
                    if($sexe_client=='Masculin'){
                        echo 'M'; 
                    }  else {
                        echo 'F';
                    }
                    ?>
                </td>
                <td valign="middle"><?php echo $etat_civil_client;?></td>
                <td valign="middle"><?php echo $adresse_provenance_client;?></td>
                <td valign="middle"><?php echo $telephone_client;?></td>   
                <td valign="middle"><?php echo $email_client; ?></td>
            </tr>
           
           <?php
             $i++;   }/* Fin de la boucle while */
            ?>
        </tbody>
    </table>
    <br>
        <div id="entete1" align="right">
            <span>Imprimé par: </span><?php echo strtoupper($_SESSION['nom_user'].' '.$_SESSION['prenom_user']); ?>
        </div>
 </div>

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
$mpdf->Output("liste de clients.pdf", "I");