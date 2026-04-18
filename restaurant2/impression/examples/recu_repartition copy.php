<?php
if (!isset($_SESSION)) {
    session_start();
}
//ini_set('memory_limit', '500M');
include_once '../../../impression/mpdf60/mpdf.php';
include '../../bdd/connexion.php';
include '../../../FUNCTION/hebergement.php';
include '../../../FUNCTION/restaurant.php';
include '../../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';

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
    $email_compagny = $donnees['mail_company'];
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

$site = getInfosSite($_SESSION['id_hotel'], $bdd);
$nbArticles = count($_SESSION['panier1']['id_article']);
?>
<?php
ob_start();
?>
<div id="register" style="border:1px solid white">
    <div id="ticket">
        <!--<h1>Thank You!</h1>-->
        <table style="margin:auto; font-family: monospace; font-size: 14px;">
            <tbody id="entries">
                <tr>
                    <td colspan="3" align="center" style="border-bottom: 1px solid black;">
                        <b><?php echo strtoupper($site->nom_hotel) ?>
                        </b> <br>
                        <b>(<?php echo strtoupper($_SESSION['libelle_resto']) ?>)</b><br>
                        <?php echo strtoupper($adresse_c) ?>
                        <br>
                        <?php echo strtoupper($ville) ?>
                        <br>
                        <?php echo strtoupper($telephone) ?>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" height="10"></td>
                </tr>
                <tr>
                    <td align="center" colspan="3"><b>BON DE VERSEMENT CAISSE NO
                            <?php echo $_SESSION['numero_vers']; ?></b></td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;"></td>
                </tr>
                <tr>
                    <td colspan="3" height="30"></td>
                </tr>
                <tr>
                    <td><b>Agent</b></td>
                    <td colspan="2"> :<?php echo strtoupper($_SESSION['nom_user'] . ' ' . $_SESSION['prenom_user']); ?>
                    </td>
                </tr>
                <tr>
                    <td><b></b></td>
                    <td colspan="2"> </td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-bottom: 1px solid black;"><b>CAISSE PHYSIQUE</b></td>
                </tr>
                <tr>
                    <td></td>
                    <td><b>USD</b></td>
                    <td><b>CDF</b></td>
                </tr>
                <tr>
                    <td><b>F.D.C</b></td>
                    <td><?php echo afficheMontant2('USD', $_SESSION['fond_usd']); ?></td>
                    <td><?php echo afficheMontant2('CDF', $_SESSION['fond_cdf']); ?></td>

                </tr>
                <tr>
                    <td><b>MONTANT P.</b></td>
                    <td><?php echo afficheMontant2('USD', $_SESSION['percu_usd']-$_SESSION['rendu_usd']); ?></td>
                    <td><?php echo afficheMontant('CDF', $_SESSION['percu_cdf']-$_SESSION['rendu_cdf']); ?></td>

                </tr>
                <tr>
                    <td><b>DEPENSE</b></td>
                    <td><?php echo afficheMontant2('USD', $_SESSION['dep_usd']); ?></td>
                    <td><?php echo afficheMontant2('CDF', $_SESSION['dep_cdf']); ?></td>
                </tr>
                <tr>
                    <td><b>MONTANT D.</b></td>
                    <td><?php echo afficheMontant2('USD', $_SESSION['averser_usd']); ?></td>
                    <td><?php echo afficheMontant('CDF', $_SESSION['averser_cdf']); ?></td>

                </tr>

                <tr>
                    <td><b>MONTANT V.</b></td>
                    <td><?php echo afficheMontant2('USD', $_SESSION['tot_mont_devise']); ?></td>
                    <td><?php echo afficheMontant2('CDF', $_SESSION['tot_mont_locale']); ?></td>

                </tr>
                <tr>
                    <td><b>SOLDE</b></td>
                    <td><?php echo afficheMontant2('USD', $_SESSION['solde_devise']); ?></td>
                    <td><?php echo afficheMontant2('CDF', $_SESSION['solde_locale']); ?></td>
                </tr>
                <tr>
                    <td colspan="3" height="20"></td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-bottom: 1px solid black;"><b>CAISSE MOBILE MONEY</b></td>
                </tr>
                <tr>
                    <td></td>
                    <td><b>USD</b></td>
                    <td><b>CDF</b></td>
                </tr>
                <?php 
                    $dte1=date('Y-m-d');
                    $dte2=date('Y-m-d');
                   $recettes_mobiles= getMontantVersementMobileMoney($_SESSION['id_hotel'],$dte1,$dte2,$bdd);
                   $totmobileusd=0;
                   $totmobilecdf=0;
                   foreach ($recettes_mobiles as $r) {
                ?>

                <tr>
                    <td><b><?php echo $r->lib; ?></b></td>
                    <td><?php echo afficheMontant2('USD',$r->montantusd); ?></td>
                    <td><?php echo afficheMontant2('CDF',$r->montantcdf); ?></td>
                </tr>
                <?php  
                $totmobileusd+=$r->montantusd;
                $totmobilecdf+=$r->montantcdf;
                } 
                ?>
                <tr>
                    <td><b>TOTAL</b></td>
                    <td><?php echo afficheMontant2('USD', $totmobileusd ); ?></td>
                    <td><?php echo afficheMontant2('CDF',$totmobilecdf); ?></td>
                </tr>
                <tr>
                    <td colspan="3" height="20"></td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-bottom: 1px solid black;"><b>BILLETAGE</b></td>
                </tr>
                <tr>
                    <td colspan="3" height="15"></td>
                </tr>
                <tr>
                    <td colspan="3"><b>1. USD</b></td>
                </tr>
                <tr>
                    <td colspan="3" height="10"></td>
                </tr>
                <tr>
                    <td><b>Billets</b></td>
                    <td><b>Nbres</b></td>
                    <td><b>Tot.</b></td>
                </tr>
                <tr>
                    <td>100 USD</td>
                    <td><?php echo $_SESSION['100usd']; ?></td>
                    <td>
                        <?php
                        $tot100 = $_SESSION['100usd'] * 100;
                        echo afficheMontant('USD', $tot100);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>50 USD</td>
                    <td><?php echo $_SESSION['50usd']; ?></td>
                    <td>
                        <?php
                        $tot50 = $_SESSION['50usd'] * 50;
                        echo afficheMontant('USD', $tot50);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>20 USD</td>
                    <td><?php echo $_SESSION['20usd']; ?></td>
                    <td>
                        <?php
                        $tot20 = $_SESSION['20usd'] * 20;
                        echo afficheMontant('USD', $tot20);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>10 USD</td>
                    <td><?php echo $_SESSION['10usd']; ?></td>
                    <td>
                        <?php
                        $tot10 = $_SESSION['10usd'] * 10;
                        echo afficheMontant('USD', $tot10);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>5 USD</td>
                    <td><?php echo $_SESSION['5usd']; ?></td>
                    <td>
                        <?php
                        $tot5 = $_SESSION['5usd'] * 5;
                        echo afficheMontant('USD', $tot5);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>1 USD</td>
                    <td><?php echo $_SESSION['1usd']; ?></td>
                    <td>
                        <?php
                        $tot1 = $_SESSION['1usd'] * 1;
                        echo afficheMontant('USD', $tot1);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><b>TOTAL</b></td>
                    <td>
                        <b>
                            <?php
                            $totgen1 = $tot1 + $tot5 + $tot10 + $tot20 + $tot50 + $tot100;
                            echo afficheMontant('USD', $totgen1); ?>
                        </b>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" height="15"></td>
                </tr>
                <tr>
                    <td colspan="3"><b>2. CDF</b></td>
                </tr>
                <tr>
                    <td colspan="3" height="10"></td>
                </tr>
                <tr>
                    <td><b>Billets</b></td>
                    <td><b>Nbres</b></td>
                    <td><b>Tot.</b></td>
                </tr>
                <tr>
                    <td>20.000 CDF</td>
                    <td><?php echo $_SESSION['20000cdf']; ?></td>
                    <td>
                        <?php
                        $totcdf1 =  $_SESSION['20000cdf'] * 20000;
                        echo afficheMontant2('CDF', $totcdf1);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>10.000 CDF</td>
                    <td><?php echo $_SESSION['10000cdf']; ?></td>
                    <td>
                        <?php
                        $totcdf2 =  $_SESSION['10000cdf'] * 10000;
                        echo afficheMontant2('CDF', $totcdf2);
                        ?>
                    </td>
                </tr>
                <!-- <tr>
                    <td>5.000 CDF</td>
                    <td><?php //echo $_SESSION['5000cdf']; ?></td>
                    <td>
                        <?php
                       // $totcdf3 =  $_SESSION['5000cdf'] * 5000;
                      //  echo afficheMontant2('CDF', $totcdf3);
                        ?>
                    </td>
                </tr> -->
                <tr>
                    <td>1000 CDF</td>
                    <td><?php echo $_SESSION['1000cdf']; ?></td>
                    <td>
                        <?php
                        $totcdf4 =  $_SESSION['1000cdf'] * 1000;
                        echo afficheMontant2('CDF', $totcdf4);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>500 CDF</td>
                    <td><?php echo $_SESSION['500cdf']; ?></td>
                    <td>
                        <?php
                        $totcdf5 =  $_SESSION['500cdf'] * 500;
                        echo afficheMontant2('CDF', $totcdf5);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>200 CDF</td>
                    <td><?php echo $_SESSION['200cdf']; ?></td>
                    <td>
                        <?php
                        $totcdf6 =  $_SESSION['200cdf'] * 200;
                        echo afficheMontant2('CDF', $totcdf6);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>100 CDF</td>
                    <td><?php echo $_SESSION['100cdf']; ?></td>
                    <td>
                        <?php
                        $totcdf7 =  $_SESSION['100cdf'] * 100;
                        echo afficheMontant2('CDF', $totcdf7);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>50 CDF</td>
                    <td><?php echo $_SESSION['50cdf']; ?></td>
                    <td>
                        <?php
                        $totcdf8 =  $_SESSION['50cdf'] * 50;
                        echo afficheMontant2('CDF', $totcdf8);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><b>TOTAL</b></td>
                    <td>
                        <b>
                            <?php
                            $totgen2 = $totcdf8 + $totcdf7 + $totcdf6 + $totcdf5 + $totcdf4 + $totcdf3 + $totcdf2 + $totcdf1;
                            echo afficheMontant2('CDF', $totgen2);
                            ?>
                        </b>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" height="30"></td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;">
                        <b>
                            Fait à Kinshasa, le <?php echo $date = date('d/m/Y'); ?><br>
                            Signature
                        </b>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);

//Entete et pied de page
//include './blocfature.php';
//$stylesheet1 = file_get_contents('style.css'); // external css

$mpdf = new mPDF('c', array(82, 1000), 0, '', 0, 0, 0, 0, 0, 0);

$mpdf->WriteHTML($body);
$mpdf->Output("Bon de versement.pdf", "I");