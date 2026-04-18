<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../../impression/mpdf60/mpdf.php';
include '../../bdd/connexion.php';
require '../../FUNCTION/hebergement.php';
include '../Amelioration/reglage/recuperer_valeurs_reglages.php';

$company_id = $_SESSION['company_id'];
$id_hotel = $_SESSION['id_hotel'];

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
$type_cl = $_GET['type_cl'];
if ($_GET['etat_print']==1) {
    $p_debut = $_GET['datedebut'];
    $p_fin = $_GET['datefin'];
    $type_cl = $_GET['type_cl'];
    $datedebut = dateToformatBdd($p_debut);
    $datefin = dateToformatBdd($p_fin);
    if ($type_cl == 'tout') {
        $requete = $bdd->prepare
                ("
        SELECT g.entreprise,c.id,a.id_res,a.num_reserv,c.idchambre,d.num_ch,b.id_client,e.nom_client,c.date_occ,c.date_lib
        FROM t_reservation AS a, t_facture AS b, t_reserve_chambre AS c,t_chambre AS d,t_client AS e,t_responsable g
        WHERE a.id_res=b.id_res AND b.id_fact=c.idfact AND b.id_client=e.id_client AND e.id_respo=g.id_respo
              AND c.idchambre=d.id_ch AND c.date_lib BETWEEN :p_debut AND :p_fin
              AND e.type_cl IN('client partenaire','client occasionnel') AND c.statut='libre' AND a.id_hotel=:id_hotel
       ");
        $requete->BindParam(':p_debut', $datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->execute();
    } else {
        $requete = $bdd->prepare
                ("
        SELECT g.entreprise,c.id,a.id_res,a.num_reserv,c.idchambre,d.num_ch,b.id_client,e.nom_client,c.date_occ,c.date_lib
        FROM t_reservation AS a, t_facture AS b, t_reserve_chambre AS c,t_chambre AS d,t_client AS e,t_responsable g
        WHERE a.id_res=b.id_res AND b.id_fact=c.idfact AND b.id_client=e.id_client AND e.id_respo=g.id_respo
              AND c.idchambre=d.id_ch AND c.date_lib BETWEEN :p_debut AND :p_fin
              AND e.type_cl IN(:type_cl) AND c.statut='libre' AND a.id_hotel=:id_hotel
    ");
        $requete->BindParam(':p_debut', $datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->BindParam(':type_cl', $type_cl);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->execute();
    }
} else {
    $requete = $bdd->prepare
            ("
        SELECT g.entreprise,c.id,a.id_res,a.num_reserv,c.idchambre,d.num_ch,b.id_client,e.nom_client,c.date_occ,c.date_lib
        FROM t_reservation AS a, t_facture AS b, t_reserve_chambre AS c,t_chambre AS d,t_client AS e,t_responsable g
        WHERE a.id_res=b.id_res AND b.id_fact=c.idfact AND b.id_client=e.id_client AND e.id_respo=g.id_respo
              AND c.idchambre=d.id_ch AND c.statut='libre' AND a.id_hotel=:id_hotel
       ");
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete->execute();
}
$result = $requete->fetchAll(PDO::FETCH_OBJ);

ob_start();
?>

<style>
        * {
            margin: 0;
            padding: 0;
            font-family: Times New Roman;
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
            /*text-transform: uppercase;*/
            padding-top: 10px;
            padding-bottom: 20px;
            font-family: Times New Roman;
        }

        #entete1 {
            margin-top: 10px;
            margin-right: 70px;
            text-align: center;
            font-family: Times New Roman;
        }

    </style>
 

<div id="content">
    <div id="entete">
        <h2><strong>LISTE DES LIBERATIONS </strong></h2>
        <span>Type Client: </span>
            <?php
            if($type_cl=='tout'){
                echo 'All';
            } else {
                echo $type_cl;
            }
            ?>
        <br>
        <strong>
            <?php if ($_GET['etat_print']==1) { ?>
            (Période du <?php echo $p_debut; ?> au <?php echo $p_fin; ?>)
            <?php } ?>
        </strong>
        <br>
    </div>
   <table align="center" id="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Client</th>
                <th>Responsable</th>
                <th>Chambre</th>
                <th>Date de sortie</th>
                <th>Nuité(s)</th>
            </tr>
        </thead>
        <tbody>
        <?php
$i = 1;
foreach ($result as $r) {
    $id= $r->id;
    $id_client = $r->id_client;
    $idchambre = $r->idchambre;
    $id_res = $r->id_res;
    ?>
    <tr class="odd gradeX">
        <td><?php echo $i ?></td>
        <td><?php echo $r->nom_client ?></td>
        <td><?php echo $r->entreprise ?></td>
        <td><?php echo $r->num_ch ?></td>
        <td><?php echo dateAffiche($r->date_lib) ?></td>
        <td><?php echo NbJours($r->date_occ, $r->date_lib) ?></td>   
    </tr>
    <?php
    $i++;
    } 
 ?>
         
        </tbody>
    </table>
    <br>
        <div id="entete1" align="right">
            <br>
            <span>Fait à <?php echo ucfirst($_SESSION['ville_hotel']); ?>, le  <?php echo date('d/m/Y'); ?></span> <br><br>
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
$mpdf->Output("liste des liberations.pdf", "I");