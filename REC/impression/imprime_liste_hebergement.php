<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../../impression/mpdf60/mpdf.php';
include '../../bdd/connexion.php';
require '../../FUNCTION/hebergement.php';

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
	

if (isset($_GET['service']) && isset($_GET['type_cl']) && isset($_GET['datedebut']) && isset($_GET['datefin'])) {
    $type=$_GET['service'];
    $type_cl=$_GET['type_cl'];
    $p_debut= $_GET['datedebut'];
    $p_fin= $_GET['datefin'];
    $type_cl=$_GET['type_cl'];
    $_SESSION['p_debut'] = $_GET['datedebut'];
    $_SESSION['p_fin'] = $_GET['datefin'];
    $type_cl = $_GET['type_cl'];
    $datedebut = dateToformatBdd($_SESSION['p_debut']);
    $datefin = dateToformatBdd($_SESSION['p_debut']);
    if($type_cl=='tout'){
        $requete = $bdd->prepare
        ("
        SELECT a.id_client, a.nom_client, b.id_res, b.num_reserv, b.type, b.dte,
        b.dte_a, b.dte_s, b.statut_res,b.etat AS etat_resv,c.entreprise AS nom_respo
        FROM t_client AS a, t_reservation AS b,t_responsable AS c
        WHERE a.id_client=b.id_client
        AND a.id_respo=c.id_respo
        AND b.type=:type
        AND b.dte BETWEEN :p_debut AND :p_fin
        AND a.type_cl IN('client partenaire','client occasionnel') 
        AND a.id_hotel=:id_hotel
       ");
        $requete->BindParam(':type', $type);
        $requete->BindParam(':p_debut', $datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->execute();
    }else{
        $requete = $bdd->prepare
        ("
        SELECT a.id_client, a.nom_client, b.id_res, b.num_reserv, b.type, b.dte,
        b.dte_a, b.dte_s, b.statut_res,b.etat AS etat_resv,c.entreprise AS nom_respo
        FROM t_client AS a, t_reservation AS b,t_responsable AS c
        WHERE a.id_client=b.id_client 
        AND a.id_respo=c.id_respo
        AND b.type=:type
        AND b.dte BETWEEN :p_debut AND :p_fin
        AND a.type_cl IN(:type_cl) 
        AND a.id_hotel=:id_hotel
    ");
        $requete->BindParam(':type', $type);
        $requete->BindParam(':p_debut', $datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->BindParam(':type_cl',$type_cl);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->execute();
    }

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
            padding-bottom: 35px;
            font-family: Times New Roman;
        }

        #entete1 {
            margin-top: 10px;
            margin-right: 70px;
        }

    </style>
 

<div id="content">
    <div id="entete1" align="right">
            <span>Date: </span><?php echo date('d/m/Y H:i:s'); ?>
    </div>
    <div id="entete">
        <h2><strong>LISTE DES <span style="text-transform: uppercase;"><?php echo $type; ?></span>S</strong></h2>
        <span>Type Client: </span>
            <?php
            if($type_cl=='tout'){
                echo 'All';
            } else {
                echo $type_cl;
            }
            ?>
        <br>
        <strong>(Période du <?php echo $p_debut; ?> au <?php echo $p_fin; ?>)
        </strong>
    </div>
   <table align="center" id="table">
        <thead>
            <tr>
                <th>N°</th>
                <th>N° Res</th>
                <th>Client</th>
                <th>Responsable</th>
                <th>Date</th>
                <th>Arrivee </th>
                <th>Sortie </th>
                <th>Etat</th>
            </tr>
        </thead>
        <tbody>
        <?php
$i = 1;
foreach ($result as $r) {
    $id_client = $r->id_client;
    $id_res = $r->id_res;
    $etat=$r->etat_resv;
    if($etat=='operationnel'){
        $etat='reservé';
    }elseif($etat=='execute'){
        $etat='occupé';
    }
    ?>
    <tr class="odd gradeX">
        <td><?php echo $i ?></td>
        <td><?php echo $r->num_reserv ?></td>
        <td><?php echo $r->nom_client ?></td>
        <td><?php echo $r->nom_respo ?></td>
        <td><?php echo dateAffiche($r->dte) ?></td>
        <td><?php echo dateAffiche($r->dte_a) ?></td>
        <td><?php echo dateAffiche($r->dte_s) ?></td>
        <td><?php echo  $etat?></td>
    </tr>
    <?php
    $i++;
}
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

$mpdf = new mPDF('c','A4','','',15,15,30,20,5,5);
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
//        $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list

$mpdf->WriteHTML($body);
$mpdf->Output("liste clients attendus.pdf", "I");