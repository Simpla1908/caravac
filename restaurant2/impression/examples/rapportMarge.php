<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../../../impression/mpdf60/mpdf.php';
include '../../bdd/connexion.php';
include_once '../../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include_once '../../../FUNCTION/hebergement.php';

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
//var_dump($requete);
ob_start();
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

    h2 {
        margin: 0;
        padding: 0;
    }

    p {
        margin: 25px;
        text-align: center;
    }

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

    .space {
        padding-top: 100px;
    }

    .10p {
        width: 10%;
    }

    .15p {
        width: 15%;
    }

    .25p {
        width: 25%;
    }

    .50p {
        width: 50%;
    }

    .60p {
        width: 60%;
    }

    .75p {
        width: 75%;
    }

    .100p {
        width: 100%;
    }
</style>

<table style="margin-top: 50px;">
    <tr>
        <td class="100p" style="text-align: center;">
            <h2><u>DETAILS BENEFICES DU <?php echo $_SESSION['dte1']  ?> AU <?php echo $_SESSION['dte2']  ?></u></h2><br />
            <b>(<?php echo strtoupper($_SESSION['libelle_resto']) ?>)</b><br>
        </td>
    </tr>
</table>
<table style="margin-top:45px;" class="border">
    <thead>
        <tr>
            <th style="text-align: center;">N°</th>
            <th style="text-align: center;">DESIGNATION</th>
            <th style="text-align: center;">QTE</th>
            <th style="text-align: center;">PA</th>
            <th style="text-align: center;">PV</th>
            <th style="text-align: center;">VALEUR ACHAT</th>
            <th style="text-align: center;">VALEUR VENTE</th>
            <th style="text-align: center;">BENEFICE</th>
        </tr>
    </thead>
    <tbody>
        <?php
         $margeVente= $_SESSION['margeVente'];
        $j = 1;

        $totvalpa = 0;
        $totvalpv = 0;
        $totbenefice = 0;
        foreach ($margeVente as $r) {
            $designation = $r->designation;
            $tauxdollar1 = $r->taux_prix;
            $tx_remise = $r->mont_ttc_remise;
            $qte = $r->qte;
            $pa = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar1, $r->pa);
            $pv = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar1, $r->prixremise);
            $valpa = $qte * $pa;
            $valpv = $qte * $pv;
            $benefice = $valpv - $valpa;
          
        ?>
            <tr>
                <td  style="text-align: center;"><?php echo $j ?></td>
                <td  style="text-align: center;"><?php echo $designation ?></td>
                <td  style="text-align: center;"><?php echo $qte ?></td>
                <td  style="text-align: center;"><?php echo afficheMontant2('', $pa) ?></td>
                <td  style="text-align: center;"><?php echo afficheMontant2('', $pv) ?></td>
                <td  style="text-align: center;"><?php echo afficheMontant2('', $valpa) ?> </td>
                <td  style="text-align: center;"> <?php echo afficheMontant2('', $valpv) ?> </td>
                <td  style="text-align: center;"><?php echo afficheMontant2('', $benefice) ?> </td>
            </tr>
        <?php
            $totvalpa += $valpa;
            $totvalpv += $valpv;
            $totbenefice += $benefice;
        
            $j++;
         
        }
        ?>  
    </tbody>
    <tfoot>
        <tr> 
            <th colspan="5">TOTAL<?php echo '('.$m_affiche.')' ?></th>
            <th style="text-align: center;"><?php echo afficheMontant2('',$totvalpa) ?></th>
            <th style="text-align: center;"><?php echo afficheMontant2('',$totvalpv) ?></th>
            <th style="text-align: center;"><?php echo afficheMontant2('',$totbenefice) ?> </th>
        </tr>
    </tfoot>
</table>

<?php
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);

//Entete et pied de page
include './entete_pied_page.php';

$mpdf = new mPDF('c', 'A4-L', '', '', 15, 15, 30, 20, 5, 5);
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
//        $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list

$mpdf->WriteHTML($body);
$mpdf->Output("Liste marges.pdf", "I");
