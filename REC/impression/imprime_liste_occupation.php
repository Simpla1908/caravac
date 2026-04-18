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
        <h3><u><strong>Liste d'occupations du jour (<?php echo date('d/m/Y'); ?>)</strong></u></h3>
    </div>
   <table border="1" align="center" id="table">
        <thead>
            <tr>
                <th>N°</th>
                <th>Client</th>
                <th>Chambre </th>
                <th>Date d'entrée </th> 
                <th>Date de sortie </th> 
                <th>Type</th>           
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;


            /* Recuperation du paiement d'un client */
            $requete_reserv = $bdd->prepare("SELECT a.id_client,a.nom_client,b.id_res,b.num_reserv,b.type,d.id_ch,d.num_ch,b.dte_a,b.dte_s,b.statut_occ,b.statut_sorti
                                                            FROM t_client AS a, t_reservation AS b, t_reserve_chambre AS c, t_chambre AS d
                                                            WHERE a.id_client=c.id_client
                                                            AND b.id_res=c.idreserv
                                                            AND c.idchambre= d.id_ch
                                                            AND b.id_hotel=:id_hotel
                                                            AND  d.occupe='oui'
                                                            AND c.statut='occupe' ORDER BY a.nom_client ");
            $requete_reserv->BindParam(':id_hotel', $_SESSION['id_hotel']);
            $requete_reserv->execute();
            while ($donnees = $requete_reserv->fetch()) {


                $id_res = $donnees['id_res'];
                $id_client = $donnees['id_client'];
                $num_reserv = $donnees['num_reserv'];
                $nom_client = $donnees['nom_client'];
                $type = $donnees['type'];
                $id_ch = $donnees['id_ch'];
                $num_ch = $donnees['num_ch'];
                $dte_a = $donnees['dte_a'];
                $dte_s = $donnees['dte_s'];
                $statut_occ = $donnees['statut_occ'];
                $statut_sorti = $donnees['statut_sorti'];
                $dte_now = date('Y-m-d');

                $date_occ1 = explode('-', $dte_a);
                $date_occ_expl = $date_occ1[2] . '/' . $date_occ1[1] . '/' . $date_occ1[0];

                $date_lib1 = explode('-', $dte_s);
                $date_lib_expl = $date_lib1[2] . '/' . $date_lib1[1] . '/' . $date_lib1[0];
                /* Nombre de jour */
                $Nombres_jours = NbJours($dte_a, $dte_now);
                $nb_jrs = $Nombres_jours;
                $nb_jr = $nb_jrs - 1;
                if ($nb_jr == 0) {
                    $nb_jr++;
                }
                $nbre_jr = $nb_jr;
                /* Fin Nombre de jour */
                ?>
        
                <?php
                if ($dte_a == date('Y-m-d')) {
                    ?>
                    <?php
                    /* Ouverture IF statut_occ */
                    //if($statut_occ=='loge'){
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td align='left'><?php echo $nom_client; ?></td>
                        <td><?php echo 'Ch' . $num_ch; ?></td>
                        <td><?php echo $date_occ_expl; ?></td>
                        <td><?php echo $date_lib_expl; ?></td>
                        <!--<td><?php // echo $nbre_jr;  ?></td>-->
                        <td>
                            <?php
                            if ($type == 'reservation') {
                                echo '<span class="label label-info">Indirecte</span>';
                            } else {
                                echo '<span class="label label-warning">Directe</span>';
                            }
                            ?>
                        </td>
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
$mpdf->Output("liste d'occupation du jour.pdf", "I");