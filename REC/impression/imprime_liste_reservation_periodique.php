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
	
if (isset($_GET['reservation']) && isset($_GET['date_d']) && isset($_GET['date_f'])) {
    $reservation = $_GET['reservation'];
    $date_d = $_GET['date_d'];
    $date_f = $_GET['date_f'];

    $date_d1 = explode(' ', $date_d);
    $date_d_expl1 = explode('/', $date_d1[0]);

    $date_d_expl = $date_d_expl1[2] . '-' . $date_d_expl1[1] . '-' . $date_d_expl1[0];

    $date_f1 = explode(' ', $date_f);
    $date_f_expl1 = explode('/', $date_f1[0]);

    $date_f_expl = $date_f_expl1[2] . '-' . $date_f_expl1[1] . '-' . $date_f_expl1[0];
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
        <h3><u>Liste de réservations du <?php echo $date_d1[0].' '.'au'.' '.$date_f1[0]; ?> </u></h3>
    </div>
   <table border="1" align="center" id="table">
        <thead>
            <tr>
                <th align="center" valign="middle">N° Rés</th>
                <th align="center" valign="middle">Client</th>
                <th align="center" valign="middle">Date Rés </th>
                <th align="center" valign="middle">Date d'arrivée </th>
                <th align="center" valign="middle">Date de sortie </th>
                <th align="center" valign="middle">Etat</th>           
            </tr>
        </thead>
        <tbody>
        <?php 
        $type='reservation';
        
            /* Recuperation du paiement d'un client */
        $requete_reserv = $bdd->prepare("SELECT a.id_client, a.nom_client, b.id_res, b.num_reserv, b.date_res, b.date_occ, b.date_lib, b.statut_res FROM t_client AS a, t_reservation AS b WHERE a.id_client=b.id_client AND b.type=:type ORDER BY b.date_res");
        $requete_reserv->BindParam(':type', $type);
        $requete_reserv->execute();
        while ($donnees = $requete_reserv->fetch()) 
        {
            $id_client=$donnees['id_client'];
            $nom_client=$donnees['nom_client'];
            $id_res=$donnees['id_res'];
            $num_reserv=$donnees['num_reserv'];
            $date_res=$donnees['date_res'];
            $date_occ=$donnees['date_occ'];
            $date_lib=$donnees['date_lib'];
            $statut_res=$donnees['statut_res'];
            
            $date_res1=explode(' ',$date_res);
            $date_res_expl=$date_res1[0];
            
            $date_occ1=explode('-',$date_occ);
            $date_occ1_Heure=explode(' ',$date_occ1[2]);
        
            $date_occ_expl=$date_occ1_Heure[0].'/'.$date_occ1[1].'/'.$date_occ1[0].' '.$date_occ1_Heure[1]; 
            
            $date_lib1=explode('-',$date_lib);
            $date_lib1_Heure=explode(' ',$date_lib1[2]);
        
            $date_lib_expl=$date_lib1_Heure[0].'/'.$date_lib1[1].'/'.$date_lib1[0].' '.$date_lib1_Heure[1]; 
            
            $date_res1=explode('-',$date_res);
            $date_res1_Heure=explode(' ',$date_res1[2]);
        
            $date_res_explode=$date_res1_Heure[0].'/'.$date_res1[1].'/'.$date_res1[0].' '.$date_res1_Heure[1]; 
        ?>
        
          <?php 
            if((($date_res_expl>=$date_d_expl)&&($date_res_expl<=$date_f_expl))&&($reservation=='periodique')){
           ?>
           
           	<?php 
            //Récuperation seulement du date occ 
            $date_occ_test1=explode(' ',$date_occ);
            $date_occ_test=$date_occ_test1[0];
            
            if((date('Y-m-d H:i:s')<$date_occ)&&($statut_res=='operationnel')){
        ?>
                
            <tr>
                <td valign="middle"><?php echo $num_reserv;?></td>
                <td valign="middle"><?php echo $nom_client;?></td>
                <td valign="middle"><?php echo $date_res_explode;?></td>
                <td valign="middle"><?php echo $date_occ_expl;?></td>   
                <td valign="middle"><?php echo $date_lib_expl; ?></td>
                <td valign="middle"><?php echo 'Opérationnelle';?></td>
            </tr>
          <?php 
            }else if((date('Y-m-d H:i:s')<$date_occ)&&($statut_res=='annulee')){
          ?>
            
            <tr>
                <td valign="middle"><?php echo $num_reserv;?></td>
                <td valign="middle"><?php echo $nom_client;?></td>
                <td valign="middle"><?php echo $date_res_explode;?></td>
                <td valign="middle"><?php echo $date_occ_expl;?></td>   
                <td valign="middle"><?php echo $date_lib_expl; ?></td>
                <td><?php echo 'Annulée';?></td>
            </tr>
            <?php 
            }else if((date('Y-m-d H:i:s')<$date_occ)&&($statut_res=='effectuee')){
           ?>
           
                <tr>
                <td valign="middle"><?php echo $num_reserv;?></td>
                <td valign="middle"><?php echo $nom_client;?></td>
                <td valign="middle"><?php echo $date_res_explode;?></td>
                <td valign="middle"><?php echo $date_occ_expl;?></td>   
                <td valign="middle"><?php echo $date_lib_expl; ?></td>
                <td><?php echo 'Effectée';?></td>
            </tr>
           
           <?php 
            }//Fin du else if ...statut==effectuee
           ?>
           
           <?php 
            } //Fin du if ...reservation==periodique
           ?>
           
           <?php
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
$mpdf->Output("liste de réservation périodique.pdf", "I");