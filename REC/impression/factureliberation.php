<?php
session_start();
include_once '../../impression/mpdf60/mpdf.php';
include '../../bdd/connexion.php';
include '../Amelioration/reglage/recuperer_valeurs_reglages.php';
include '../../FUNCTION/hebergement.php';
$company_id = $_SESSION['company_id'];
$id_hotel = $_SESSION['id_hotel'];
//Selection des company
$requete_company = $bdd->prepare("SELECT * FROM t_company As a, t_hotel AS b "
    . "                      WHERE a.id_c=b.company_id AND b.id_hotel=:id_hotel");
$requete_company->BindParam(':id_hotel', $id_hotel);
$requete_company->execute();
while ($donnees = $requete_company->fetch()) {

    $nom_hotel = $donnees['nom_hotel'];
    $adresse_hotel = $donnees['adresse_hotel'];
    $province_hotel = $donnees['province_hotel'];
    $logo = $donnees['logo'];
    $idnat = $donnees['idnat'];
    $rccm = $donnees['rccm'];
    $num_impot = $donnees['num_impot'];
    $telephone = $donnees['phone'];
    $email_compagny = $donnees['email_company'];
    $compte_bancaire = $donnees['compte_bancaire'];
    $mention = $donnees['mention'];
}
?>
<?php
$id_res = 0;
$idres_ch=0;
if (isset($_GET['id_res'])&& isset($_GET['id'])) {
    $id_res = $_GET['id_res'];
    $idres_ch = $_GET['id'];
}
$temps_actuel = date('H:i:s');
$today = date('Y-m-d');
$_SESSION['chambre'] = array();
$_SESSION['chambre']['id'] = array();
$_SESSION['chambre']['num_ch'] = array();
$_SESSION['chambre']['nuite'] = array();
$_SESSION['chambre']['tarif'] = array();
$_SESSION['chambre']['montant'] = array();
$_SESSION['chambre']['date_occ'] = array();
$_SESSION['chambre']['date_lib'] = array();
$_SESSION['chambre']['ht'] =0;
$_SESSION['chambre']['remise']=0;
$_SESSION['chambre']['tva']=0;
$_SESSION['chambre']['ttc']=0;
$_SESSION['chambre']['monnaie']='';
$_SESSION['chambre']['type']='hebergement';
$_SESSION['chambre']['taux']=0;
$result=getMontantPrestation($id_res,$bdd);
foreach ($result as $r) {
    $montant_total = 0;
    $montant_paye = 0;
    $taux_fact = $r->taux;
    $type = $r->type;
    $id = $r->id_fact;
    $dte = $r->date_edition;
    $numero = $r->num_fact;
    $montant_total = $r->mont_ttc;
    $montant_paye =getMontantPaye($taux_fact,$r->montantusd,$r->montantcdf);
    $monnaie=$if->monnaie;
    if ($type == 'hebergement') {
        $montant_paye_heb =getMontantPaye($taux_fact,$r->montantusd,$r->montantcdf);
        $monttot_heb = 0;
        $mont_tva = 0;
        $mont_remise = 0;
        $infosFactures = getInfosFacture($id_res, $bdd);
        foreach ($infosFactures as $if) {
            if($if->idres_ch==$idres_ch){
                $num_reserv=$if->num_reserv;
                $nom_client=$if->nom_client;
                $nom_respo=$if->nom_respo;
                $id_ch=$if->id_ch_histo;
                $num_ch=$if->num_ch;
                $statut = $if->statut_histo;
                $date_occ = $if->date_occ_histo;
                $date_lib = $if->date_lib_histo;
                $tva = $if->tva;
                $tauxremise = $if->tauxremise;
                $mont_tva = $if->mont_tva;
                $mont_remise = $if->mont_remise;
                $tarif_ch = $if->tarif_histo;
                if ( $statut == 'occupe') {
                    if($today > $date_occ && $temps_actuel > $temps_sortie) {
                        $date_lib = date('Y-m-d', time() + 86400);
                    } else {
                        $date_lib = $today;
                    }
                }else{
                    $date_lib = $date_lib;
                }
                $qte = NbJours($date_occ, $date_lib);
                $montant_ch=($tarif_ch * $qte);
                $monttot_heb+=$montant_ch;
                array_push($_SESSION['chambre']['id'],$id_ch);
                array_push($_SESSION['chambre']['num_ch'],$num_ch);
                array_push($_SESSION['chambre']['nuite'],$qte);
                array_push($_SESSION['chambre']['tarif'],$tarif_ch);
                array_push($_SESSION['chambre']['montant'],$montant_ch);
                array_push($_SESSION['chambre']['date_occ'],$date_occ);
                array_push($_SESSION['chambre']['date_lib'],$date_lib);
            }

        }
        $monttot_heb_rem=  remise($monttot_heb, $tva, $tauxremise);
        $total=total($monttot_heb,$tva,$tauxremise);
        $mont_ht=  ht($total,$tva,$tauxremise);
        $montant_tva =tva($total,$tva,$tauxremise);
        $ttc=ttc($mont_ht,$montant_tva,$tauxremise);
        $montant_total += $ttc;
       
        $_SESSION['chambre']['ht']=$mont_ht;
        $_SESSION['chambre']['remise']=$monttot_heb_rem;
        $_SESSION['chambre']['tva']=$montant_tva;
        $_SESSION['chambre']['ttc']=$ttc;
        $_SESSION['chambre']['monnaie']=$monnaie;
        $_SESSION['chambre']['taux'] =$taux_fact;

    }
}
$nbre_heb = count($_SESSION['chambre']['id']);

?>
<?php
ob_start();
?>

    <header class="clearfix">
        <div id="logo">
            <img src="../images/logo_entreprise/<?php echo $logo; ?>" width="70" height="70">
        </div>
        <div id="company">
            <h2 class="name"><?php echo $nom_hotel; ?></h2>
            <div><?php echo $nom_hotel; ?></div>
            <div>(+243) <?php echo $telephone; ?></div>
            <div><a href="mailto:<?php echo $nom_hotel; ?>"><?php echo $email_compagny; ?></a></div>
        </div>
        </div>
    </header>
    <main>
        <div id="details" class="clearfix">
            <div id="client">
                <div class="to">Client:<?php echo ' '.strtoupper($nom_client); ?></div>
                <h2 class="name"></h2>
                <div class="address"></div>
                <div class="email"><a href="mailto:john@example.com">Responsable:<?php echo ' '.strtoupper($nom_respo); ?></a></div>
            </div>
            <div id="invoice">
                <div class="date">HEBERGEMENT N°<?php echo $num_reserv; ?></div>
            </div>
        </div>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <th class="no"><h3>#</h3></th>
                <th class="desc"><h3>CHAMBRE</h3></th>
                <th class="unit"><h3>TARIF</h3></th>
                <th class="desc"><h3>PERIODE</h3></th>
                <th class="unit"><h3>NUITE</h3></th>
                <th class="total"><h3>MONTANT</h3></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $j = 1;
            $som = 0;
            for ($i = 0; $i <= $nbre_heb - 1; $i++) {
                $num_ch=$_SESSION['chambre']['num_ch'][$i];
                $qte=$_SESSION['chambre']['nuite'][$i];
                $tarif_ch=$_SESSION['chambre']['tarif'][$i];
                $tauxdollar =getTauxFacture($_SESSION['chambre']['type'],$_SESSION['chambre']['monnaie'],$tauxdollar,$taux_op,$_SESSION['chambre']['taux']);
                $tarif_ch=montant_equivalent_bdd(getsymbole_local(),$m_affiche,$tauxdollar,$tarif_ch);
                $montant=montant_equivalent_bdd(getsymbole_local(),$m_affiche,$tauxdollar,$_SESSION['chambre']['montant'][$i]);
                $date_occ=$_SESSION['chambre']['date_occ'][$i];
                $date_lib=$_SESSION['chambre']['date_lib'][$i];
                ?>
                <tr>
                    <td class="no"><?php echo $j; ?></td>
                    <td class="desc"><h3> <?php echo $num_ch; ?></h3></td>
                    <td class="unit"> <?php echo afficheMontant($m_affiche,$tarif_ch); ?></td>
                    <td class="desc"><?php echo dateAffiche($date_occ) . '-' . dateAffiche($date_lib) ?></td>
                    <td class="unit"> <?php echo $qte; ?></td>
                    <td class="total"><?php echo afficheMontant($m_affiche,$montant); ?></td>
                </tr>
                <?php
                $j+=1;
            }
            $som=$_SESSION['chambre']['ht'];
            $remise=$_SESSION['chambre']['remise'];
            $montant_tva=$_SESSION['chambre']['tva'];
            $montant_tot=$_SESSION['chambre']['ttc'];
            ?>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3"></td>
                <td colspan="2">HT</td>
                <td>
                    <?php
                    $som= montant_equivalent_bdd(getsymbole_local(),$m_affiche,$tauxdollar,$som);
                    echo afficheMontant($m_affiche,$som);
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td colspan="2">REMISE</td>
                <td>
                    <?php
                    $montant_rem=montant_equivalent_bdd(getsymbole_local(),$m_affiche,$tauxdollar,$remise);
                    echo afficheMontant($m_affiche,$montant_rem);
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td colspan="2">TVA</td>
                <td>
                    <?php
                    $montant_tva=montant_equivalent_bdd(getsymbole_local(),$m_affiche,$tauxdollar,$montant_tva);
                    echo afficheMontant($m_affiche,$montant_tva);
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td colspan="2">TTC</td>
                <td>
                    <?php
                    $montant_heberge=montant_equivalent_bdd(getsymbole_local(),$m_affiche,$tauxdollar,$montant_tot);
                    echo afficheMontant($m_affiche,$montant_heberge);
                    ?>
                </td>
            </tr>
            <?php
             $montant_autre=0;
             $som_montant_pay=0;
             $taux_heb=getTauxFacture('hebergement',$_SESSION["monnaie_heb"],$tauxdollar,$taux_op,$_SESSION["taux_heb"]);
             $_SESSION['service']=MontantServiceone($id_res,$idres_ch,$tauxdollar,$taux_op,$m_affiche,$bdd);
            $nbre_heb = count($_SESSION['service']['libelle']);
             for ($i = 0; $i <= $nbre_heb - 1; $i++) {
                 $type=$_SESSION['service']['libelle'][$i];
                 $montant_service=$_SESSION['service']['montant_tot'][$i];
                 $montant_autre+=$montant_service;
                ?>
                        <tr>
                          <td colspan="3"></td>
                          <td colspan="2"><span class="pull-right"><?php echo strtoupper($type) ?></span></td>
                           <td>
                               <?php
                               echo afficheMontant($m_affiche, $montant_autre);
                               ?>
                           </td>
                       </tr>
               <?php 
               $som_montant_pay+=$_SESSION['service']['montant_pay'][$i];
               }
               $mont_paye_heb=getTotalMontPayeSejour($bdd,$id_res);
               ?>
            <tr>
                <td colspan="3"></td>
                <td colspan="2">TOTAUX</td>
                <td>
                    <?php
                    $montant_total_af=$montant_heberge+$montant_autre;
                    echo afficheMontant($m_affiche,$montant_total_af);
                    ?>
                </td>
            </tr>

            <tr>
                <td colspan="3"></td>
                <td colspan="2">MONTANT PAYE</td>
                <td>
                    <?php
                    $tarif=getTarifChambre($bdd,$idres_ch);
                    $mont_paie=getTotalMontPayeSejour($bdd,$id_res);
                    $total_nuite=  getTotalNuite($bdd, $id_res);
                    $nbre_ch=  getNbrChambre($id_res, $bdd);
                    $montant_paid_ch=getMontantPaye_ch($tarif,$mont_paie,$total_nuite, $nbre_ch);
                    $montant_paye_af=$montant_paid_ch+$som_montant_pay;
                    echo afficheMontant($m_affiche,montant_equivalent_bdd(getsymbole_local(),$m_affiche,$tauxdollar,$montant_paye_af));
                    ?>
                </td>
            </tr>
            </tfoot>
        </table>
        <div id="thanks">La Réception,</div>
        <div id="notices">
            <!--        <div>NOTICE:</div>-->
            <div class="notice">Créee le <?php echo dateAffiche($dte); ?> par <?php echo ' ' . strtoupper($nom_user); ?> / Imprimée le <?php echo date('d/m/Y H:i'); ?> par <?php echo strtoupper($_SESSION['prenom_user'] . ' ' . $_SESSION['nom_user']); ?>.</div>
        </div>
    </main>
    <footer>
        <?php echo 'Tél.; ' . $telephone . ' -- Email: ' . $email_compagny . ' -- RCCM: ' . $rccm . ' -- Id-Nat: ' . $idnat; ?>.
    </footer>
<?php
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);

//Entete et pied de page
include './blocfature.php';
$stylesheet1 = file_get_contents('style.css'); // external css
$mpdf = new mPDF('c', 'A4');
$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($stylesheet1, 1);
$mpdf->WriteHTML($body);
$mpdf->Output("Facture.pdf", "I");
