<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../../../impression/mpdf60/mpdf.php';
include '../../bdd/connexion.php';
include '../../../FUNCTION/hebergement.php';
include '../../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';

$company_id = $_SESSION['company_id'];
$tab_prod['produit1'] = array();
//$tab_prod['produit']['id'] = array();
$tab_prod['produit1']['prod'] = array();
$tab_prod['produit1']['q1'] = array();
$tab_prod['produit1']['q2'] = array();
$tab_prod['produit1']['q2'] = array();
$tab_prod['produit1']['p1'] = array();
$tab_prod['produit1']['p2'] = array();
$tab_prod['produit1']['p3'] = array();

$_SESSION['detail'] = array();
$_SESSION['detail']['id'] = array();
$_SESSION['detail']['code'] = array();
$_SESSION['detail']['designation'] = array();
$_SESSION['detail']['qte_cash'] =array();
$_SESSION['detail']['qte_credit'] =array();
$_SESSION['detail']['qte_don'] =array();
$_SESSION['detail']['pt_cash'] =array();
$_SESSION['detail']['pt_credit'] =array();
$_SESSION['detail']['pt_don'] =array();
$_SESSION['detail']['mode'] =array();

$_SESSION['donnee'] = array();
$_SESSION['donnee']['des'] = array();
$_SESSION['donnee']['qte1'] = array();
$_SESSION['donnee']['qte2'] = array();
$_SESSION['donnee']['qte3'] = array();
$_SESSION['donnee']['pt1'] = array();
$_SESSION['donnee']['pt2'] = array();
$_SESSION['donnee']['pt3'] = array();

//Selection des company
$company_id = $_SESSION['company_id'];
$requete_idhotel = $bdd->prepare("SELECT * FROM  t_hotel WHERE id_hotel=:id_hotel");
$requete_idhotel->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete_idhotel->execute();
while ($donnees = $requete_idhotel->fetch()) {
    $province_hotel = $donnees['province_hotel'];
    $ville_hotel = $donnees['ville_hotel'];
    $nom_c = $donnees['nom_hotel'];
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
/* Fin de la Recuperation des coordonnées de l'hotel */
if (isset($_GET['date_bd1'])&&isset($_GET['date_bd2'])&&isset($_GET['periode'])){
    $date_bd1 = $_GET['date_bd1'];
    $date_bd2 = $_GET['date_bd2'];
    $periode=$_GET['periode'];
    $dte = date('Y-m-d');
    $hr_1='00:00:00';
    $hr_2='05:00:00';
    $hr_operation=date('H:i:s');
    //Ajustement pour des ventes tardives
    if($hr_operation>=$hr_1 && $hr_operation <=$hr_2){
        $dte1= ReduiceDaysToDate($dte,1) ;  
        $periode=$dte1;
    }
}  else {
        $date_bd1=$date_bd2=  date('Y-m-d');
}
    $boisson_cash=$_SESSION['boisson_cash'] ;
    $boisson_credit=$_SESSION['boisson_credit'];
    $boisson_don=$_SESSION['boisson_don'];
    $nouriture_cash=$_SESSION['nouriture_cash'];
    $nouriture_credit=$_SESSION['nouriture_credit'];
    $nouriture_don= $_SESSION['nouriture_don'];
$nbre_rows = count($_SESSION['prod']['id']);
// Initialisation des données
    ob_start();
    $total = 0;  $total_tva = 0; $i=1;
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
     .5p { width: 5%; }
    .10p { width: 10%; } .15p { width: 15%; } 
    .25p { width: 25%; } .50p { width: 50%; } 
    .60p { width: 60%; } .75p { width: 75%; } .100p { width: 100%; }
</style>
 
    <table style="margin-top: 50px;">
        
        <?php if (isset($_GET['date_bd1'])&&isset($_GET['date_bd2'])&&isset($_GET['periode'])) { ?>
        <tr>
            <td class="100p" style="text-align: center;">
                <h2><u>RAPPORT DES VENTES</u></h2><br />
                    <?php if((($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions'])))&& $_SESSION['sousresto_id']!=0){  ?>
                    <b>(Resto: <?php echo strtoupper($_SESSION['libelle_resto'])?>)</b><br>
                    <?php } ?>
                Période :
                <small>(<?php echo $periode; ?>)</small></h2>
            </td>
        </tr>
        <tr>
            <td class="100p" style="text-align: center;">
              <br />
                <h3> Nombre couverts: <?php echo $_SESSION['nbrcouvert']; ?>
            </h3>
            <br />
            <h3> Caissiere :<?php echo $_SESSION['prenom_user'].' '.$_SESSION['nom_user']; ?></h3>
              </td>
        </tr>
        <?php }else {?>
        <tr>
            <td class="100p" style="text-align: center;">
                <h2>RAPPORT VENTES DU <?php echo date("d/m/y H:i:s"); ?></h2><br />
            </td>
        </tr>
        
        <tr>
            <td class="100p" style="text-align: center;">
              <br />
                <h3> Nombre couverts: <?php echo $_SESSION['nbrcouvert']; ?>
            </h3>
            <br />
            <h3> Caissiere :<?php echo $_SESSION['prenom_user'].' '.$_SESSION['nom_user']; ?></h3>
              </td>
        </tr>
        
        <?php }?>
    </table>
 
    <table style="margin-top: 30px; margin-left: 65px;" class="border">
        <thead>
            <tr>
                <th class="5p" rowspan="2" style="text-align: center;">N°</th>
                <th class="10p" valign="midle" colspan="2" rowspan="2" style="text-align: center;">DESIGNATION</th>
                <th class="10p" colspan="2" style="text-align: center;">CASH</th>
                <th class="10p" colspan="2" style="text-align: center;">CREDIT</th>
                <th class="10p" colspan="2" style="text-align: center;">DON</th>
            </tr>
            <tr>
                <th class="5p" style="text-align: center;">Qte</th> 
                <th class="15p" style="text-align: center;">PT</th> 
                <th class="5p" style="text-align: center;">Qte</th> 
                <th class="15p" style="text-align: center;">PT</th> 
                <th class="5p" style="text-align: center;">Qte</th> 
                <th class="15p" style="text-align: center;">PT</th>
            </tr>
        </thead>
        <?php
            $j = 1;
            $total = 0;
            $total1 = 0;
            $total2 = 0;
            $tot_qte=0;
            $tot_qte1=0;
            $tot_qte2=0;
            $qte_cash=0;
            $qte_credit=0;
            $qte_don=0;
            $pt_cash=0;
            $pt_credit=0;
            $pt_don=0;
            for ($i = 0; $i <= $nbre_rows - 1; $i++) {
               $idprod = $_SESSION['prod']['id'][$i];
                $designation = $_SESSION['prod']['des'][$i];
                
                if (isset($_SESSION['cash']['qte'][$idprod])) {
                    $qte_cash = $_SESSION['cash']['qte'][$idprod];
                    $pt_cash = $_SESSION['cash']['pt'][$idprod];
                } else {
                    $qte_cash = 0;
                    $pt_cash = 0;
                }
                if (isset($_SESSION['credit']['qte'][$idprod])) {
                    $qte_credit = $_SESSION['credit']['qte'][$idprod];
                    $pt_credit = $_SESSION['credit']['pt'][$idprod];
                } else {
                    $qte_credit = 0;
                    $pt_credit = 0;
                }
                
                if (isset($_SESSION['don']['qte'][$idprod])) {
                    $qte_don = $_SESSION['don']['qte'][$idprod];
                    $pt_don = $_SESSION['don']['pt'][$idprod];
                } else {
                    $qte_don = 0;
                    $pt_don= 0;
                }
            

            ?>
            <tr>
                <td><?php echo $j ?></td>
                <td colspan="2"><?php echo $designation ?></td>
                <td style="text-align: center;"><?php echo $qte_cash ?></td>
                <td style="text-align: right;"><?php echo afficheMontant2($m_affiche, $pt_cash) ?></td>
                <td style="text-align: center;"><?php echo $qte_credit ?></td>
                <td style="text-align: right;"><?php echo afficheMontant2($m_affiche, $pt_credit) ?></td>
                <td style="text-align: center;"><?php echo $qte_don ?></td>
                <td style="text-align: right;"><?php echo afficheMontant2($m_affiche, $pt_don) ?></td>
            </tr>
            <?php
            $j++;
            $total += $pt_cash;
            $total1 += $pt_credit;
            $total2 += $pt_don;
            $tot_qte+=$qte_cash;
            $tot_qte1+=$qte_credit;
            $tot_qte2+=$qte_don;
            }
            ?> 
            <tr>
                <th colspan="3">TOTAL BOISSON</th> 
                <th style="text-align: center;"><?php //echo $tot_qte ?></th>
                <th style="text-align: right;"><?php echo afficheMontant2($m_affiche, $boisson_cash) ?></th>
                <th style="text-align: center;"><?php //echo $tot_qte1 ?></th>
                <th style="text-align: right;"><?php echo afficheMontant2($m_affiche, $boisson_credit) ?></th>
                <th style="text-align: center;"><?php //echo $tot_qte2 ?></th>
                <th style="text-align: right;"><?php echo afficheMontant2($m_affiche, $boisson_don) ?></th>
            </tr>
            <tr>
                <th colspan="3">TOTAL NOURRITURE</th> 
                <th style="text-align: center;"><?php //echo $tot_qte ?></th>
                <th style="text-align: right;"><?php echo afficheMontant2($m_affiche, $nouriture_cash) ?></th>
                <th style="text-align: center;"><?php //echo $tot_qte1 ?></th>
                <th style="text-align: right;"><?php echo afficheMontant2($m_affiche, $nouriture_credit) ?></th>
                <th style="text-align: center;"><?php //echo $tot_qte2 ?></th>
                <th style="text-align: right;"><?php echo afficheMontant2($m_affiche, $nouriture_don) ?></th>
            </tr>
            <tr>
                <th colspan="3">TOTAL GENERAL</th> 
                <th style="text-align: center;"><?php //echo $tot_qte ?></th>
                <th style="text-align: right;"><?php echo afficheMontant2($m_affiche, $total) ?></th>
                <th style="text-align: center;"><?php //echo $tot_qte1 ?></th>
                <th style="text-align: right;"><?php echo afficheMontant2($m_affiche, $total1) ?></th>
                <th style="text-align: center;"><?php //echo $tot_qte2 ?></th>
                <th style="text-align: right;"><?php echo afficheMontant2($m_affiche, $total2) ?></th>
            </tr>
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
$mpdf->Output("Rapport vente.pdf", "I");

