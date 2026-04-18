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

</style>
 

<div id="content">
    <div id="entete">
        <h3><u><strong>Liste de libération historique</strong></u></h3>
    </div>
    <table border="1" align="center" id="table">
        <thead>
            <tr>
            <tr>
                <th>N°</th>
                <th>Client</th>
                <th>Chambre </th>
                <th>Date </th> 
                <th>Nbr jr </th> 
            </tr>
            </tr>
        </thead>
        <tbody id="liberation">
            <?php
            $i = 1;


            /* Recuperation du paiement d'un client */
            $requete_lib = $bdd->prepare("SELECT r.id_res,c.id_client,c.nom_client,ch.id_ch,ch.num_ch,l.id_lib,l.date_lib,l.dte_lib,r.dte_a
                                                        FROM t_liberation AS l,t_client AS c, t_chambre AS ch,t_reservation AS r
                                                        WHERE l.id_client=c.id_client
                                                        AND l.id_ch=ch.id_ch
                                                        AND l.id_res=r.id_res
                                                        AND l.id_hotel=:id_hotel 
                                                        ORDER BY l.dte_lib ");
            $requete_lib->BindParam(':id_hotel', $_SESSION['id_hotel']);
            $requete_lib->execute();
            while ($donnees = $requete_lib->fetch()) {
                $id_lib = $donnees['id_lib'];
                $id_client = $donnees['id_client'];
                $nom_client = $donnees['nom_client'];
                $id_ch = $donnees['id_ch'];
                $num_ch = $donnees['num_ch'];
                $date_lib = $donnees['date_lib'];
                $dte_lib = $donnees['dte_lib'];
                $dte_a = $donnees['dte_a'];
                $id_res = $donnees['id_res'];

                /* Nombre de jour */
                $Nombres_jours = NbJours($dte_a, $dte_lib);
                $nb_jrs = $Nombres_jours;
                $nb_jr = $nb_jrs - 1;
                if ($nb_jr == 0) {
                    $nb_jr++;
                }
                $nbre_jr = $nb_jr;
                /* Fin Nombre de jour */

                $date_lib1 = explode('-', $date_lib);
                $date_lib1_Heure = explode(' ', $date_lib1[2]);

                $date_lib_expl = $date_lib1_Heure[0] . '/' . $date_lib1[1] . '/' . $date_lib1[0] . ' ' . $date_lib1_Heure[1];
                ?>

                <?php
                if ($dte_lib < date('Y-m-d')) {
                    ?>
                    <?php
                    ?>
                    <tr valign="middle" id="<?php echo $id_client; ?>" id2="<?php echo $id_res; ?>">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $nom_client; ?></td>
                        <td><?php echo 'Ch' . $num_ch; ?></td>
                        <td><?php echo $date_lib_expl; ?></td>
                        <td><?php echo $nbre_jr; ?></td>
                    </tr>
                    <?php
                    $i++;
                }
                /* Fin de la Recuperation du paiement d'un client */
                ?>

                <?php
            }
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
$mpdf->Output("liste de liberation historique.pdf", "I");