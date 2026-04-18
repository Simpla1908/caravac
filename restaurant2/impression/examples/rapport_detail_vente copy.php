<?php
if (!isset($_SESSION)) {
    session_start();
}
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
ini_set('memory_limit','1024M');
include '../../bdd/connexion.php';
include '../../../FUNCTION/hebergement.php';
include '../../../FUNCTION/restaurant.php';
include_once '../../../impression/mpdf60/mpdf.php';
$m_affiche = $_SESSION['m_affiche'];
if ($m_affiche == 'USD') {
    $m_affiche1 = 'CDF';
} else {
    $m_affiche1 = 'USD';
}
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
 $date_bd1=$date_bd2=  date('Y-m-d');
 $periode=date('d/m/Y');
if (isset($_GET['date_bd1'])&&isset($_GET['date_bd2'])&&isset($_GET['periode'])){
    $date_bd1 = $_GET['date_bd1'];
    $date_bd2 = $_GET['date_bd2'];
    $periode=$_GET['periode'];
    $periode= dateAffiche($date_bd1).'  - '. dateAffiche($date_bd2);
    $dte = date('Y-m-d');
    $hr_1='00:00:00';
    $hr_2='05:00:00';
    $hr_operation=date('H:i:s');
    //Ajustement pour des ventes tardives
    if($hr_operation>=$hr_1 && $hr_operation <=$hr_2){
        $dte1= ReduiceDaysToDate($dte,1) ;  
        $periode=$dte1;
    }
}
?>
<?php
ob_start();
?>
<div id="register" style="border:1px solid white">
    <div id="ticket" >
        <table  style="margin:auto; font-family: monospace; font-size: 14px;">
            <tbody id="entries">
                <tr>
                    <td  colspan="3" align="center" style="border-bottom: 1px solid black;">
                        <b><?php echo strtoupper($nom_c) ?>
                        </b> <br>
                        <b>(<?php echo strtoupper($_SESSION['libelle_resto']) ?>)</b><br>
                    </td>
                </tr>
                <tr>
                    <td  colspan="3" align="center" style="border-bottom: 1px solid black;">
                        <b> 
                            RAPPORT DE VENTE
                            <br>
                             (<?php echo $periode; ?>)
                             
                            <br>
                            Couverts:<?php echo $_SESSION['nbrcouvert']; ?>
                            <br>
                            Agent:<?php echo $_SESSION['prenom_user'].' '.$_SESSION['nom_user']; ?><br>
                            Imprimé le <?php echo date('d/m/Y H:i:s'); ?>
                           
                        </b>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td><b>DES</b></td>
                    <td><b>QTE</b></td>
                    <td><b>PT</b></td>
                </tr>
                <?php
                $boisson_cash=$_SESSION['boisson_cash'] ;
                $boisson_credit=$_SESSION['boisson_credit'];
                $boisson_don=$_SESSION['boisson_don'];
                $nouriture_cash=$_SESSION['nouriture_cash'];
                $nouriture_credit=$_SESSION['nouriture_credit'];
                $nouriture_don= $_SESSION['nouriture_don'];
                $extra_cash=$_SESSION['extra_cash'];
                $extra_credit=$_SESSION['extra_credit'];
                $extra_don=$_SESSION['extra_don'];
                $emporte_cash=$_SESSION['emporte_cash'];
                $emporte_credit=$_SESSION['emporte_credit'];
                $emporte_don=$_SESSION['emporte_don'];
                $totalpaiecreance=$_SESSION['totalpaiecreance'];
                $nbre_rows = count($_SESSION['prod']['id']);
                $j = 1;
                $total = 0;
                $total1 = 0;
                $total2 = 0;
                $tot_qte = 0;
                $tot_qte1 = 0;
                $tot_qte2 = 0;
                $qte_cash = 0;
                $qte_credit = 0;
                $qte_don = 0;
                $pt_cash = 0;
                $pt_credit = 0;
                $pt_don = 0;
                for ($i = 0; $i <= $nbre_rows - 1; $i++) {
                    $idprod = $_SESSION['prod']['id'][$i];
                    $designation = $_SESSION['prod']['des'][$i];
                    $qte=0;

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
                        $pt_don = 0;
                    }
                     $qte=$qte+ $qte_cash+$qte_credit+$qte_don;
                    ?>
                    <tr>
                        <td><b><?php echo $designation; ?></b></td>
                        <td ><b><?php echo $qte; ?></b></td>
                        <td ><b><?php echo afficheMontant2($m_affiche, $pt_cash) ?></b></td>
                    </tr>
                    <?php
                    $j++;
                    $total += $pt_cash;
                    $total1 += $pt_credit;
                    $total2 += $pt_don;
                    $tot_qte+=$qte_cash;
                    $tot_qte1+=$qte_credit;
                    $tot_qte2+=$qte_don;
                    $tot_general=$total+$total1+$tota2;
                    }
                    ?> 
                <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;">
                     <b> CASH</b>
                     </td>
                </tr>
                <tr>
                    <td align="right" colspan="3" style="border-top: 1px solid black;">
                     </td>
                </tr>
               <tr>
                        <td align="right" colspan="2"><b>BOISSON</b></td>
                        <td ><b> :<?php echo afficheMontant2($m_affiche, $boisson_cash); ?></b></td>
                </tr>
                <tr>
                        <td align="right" colspan="2"><b>NOURRITURE</b></td>
                        <td ><b> :<?php echo afficheMontant2($m_affiche, $nouriture_cash); ?></b></td>
                </tr>
                <tr>
                        <td align="right" colspan="2"><b>EXTRA</b></td>
                        <td ><b> :<?php echo afficheMontant2($m_affiche,$extra_cash); ?></b></td>
                </tr>
                <tr>
                        <td align="right" colspan="2"><b>EMPORTE</b></td>
                        <td ><b> :<?php echo afficheMontant2($m_affiche,$emporte_cash); ?></b></td>
                </tr>
                <tr>
                        <td align="right" colspan="2"><b>TOTAL CASH</b></td>
                        <td ><b> :<?php echo afficheMontant2($m_affiche,$total); ?></b></td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;">
                     <b> CREDIT</b>
                    </td>
                </tr>
                <tr>
                    <td align="right" colspan="3" style="border-top: 1px solid black;">
                     </td>
                </tr>
                
                <tr>
                        <td align="right" colspan="2"><b>BOISSON</b></td>
                        <td ><b> :<?php echo afficheMontant2($m_affiche, $boisson_credit); ?></b></td>
                </tr>
                <tr>
                        <td align="right" colspan="2"><b>NOURRITURE</b></td>
                        <td ><b> :<?php echo afficheMontant2($m_affiche, $nouriture_credit); ?></b></td>
                </tr>
                <tr>
                        <td align="right" colspan="2"><b>EXTRA</b></td>
                        <td ><b> :<?php echo afficheMontant2($m_affiche,$extra_credit); ?></b></td>
                </tr>
                <tr>
                        <td align="right" colspan="2"><b>EMPORTE</b></td>
                        <td ><b> :<?php echo afficheMontant2($m_affiche,$emporte_credit); ?></b></td>
                </tr>
                <tr>
                        <td align="right" colspan="2"><b>TOTAL CREDIT</b></td>
                        <td ><b> :<?php echo afficheMontant2($m_affiche,$total1); ?></b></td>
                </tr>
                <tr>
                        <td align="right" colspan="2"><b>PAIEMENT CREDIT</b></td>
                        <td ><b> :<?php echo afficheMontant2($m_affiche,$totalpaiecreance); ?></b></td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;">
                     <b> DON</b>
                    </td>
                </tr>
                <tr>
                    <td align="right" colspan="3" style="border-top: 1px solid black;">
                     </td>
                </tr>
                <tr>
                        <td align="right" colspan="2"><b>BOISSON</b></td>
                        <td ><b> :<?php echo afficheMontant2($m_affiche,$boisson_don); ?></b></td>
                </tr>
                <tr>
                        <td align="right" colspan="2"><b>NOURRITURE</b></td>
                        <td ><b> :<?php echo afficheMontant2($m_affiche,$nouriture_don); ?></b></td>
                </tr>
                <tr>
                        <td align="right" colspan="2"><b>EXTRA</b></td>
                        <td ><b> :<?php echo afficheMontant2($m_affiche,$extra_don); ?></b></td>
                </tr>
                <tr>
                        <td align="right" colspan="2"><b>EMPORTE</b></td>
                        <td ><b> :<?php echo afficheMontant2($m_affiche,$emporte_don); ?></b></td>
                </tr>
                <tr>
                        <td align="right" colspan="2"><b>TOTAL DON</b></td>
                        <td ><b> :<?php echo afficheMontant2($m_affiche,$total2); ?></b></td>
                </tr>
                <tr>
                    <td align="right" colspan="3" style="border-top: 1px solid black;">
                     </td>
                </tr>
                
                <tr>
                        <td align="right" colspan="2"><b>CHIFFRE D'AFFAIRE</b></td>
                        <td ><b> :<?php echo afficheMontant2($m_affiche,$total+$total1); ?></b></td>
                </tr>
                <tr>
                        <td align="right" colspan="2"><b>TOTAL PERCU</b></td>
                        <td ><b> :<?php echo afficheMontant2($m_affiche,$total+$totalpaiecreance); ?></b></td>
                </tr>
            </tbody>

        </table>
    </div>
</div>

<?php
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);
$mpdf = new mPDF('c', array(82,5000), 0, '', 0, 0, 0, 0, 0, 0);
$mpdf->WriteHTML($body);
$mpdf->Output("ticket.pdf", "I");
