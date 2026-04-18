
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
        font-family: helvetica;
    }

    #entete1 {
        margin-top: 10px;
        margin-right: 70px;
        text-align: center;
    }

</style>


<div id="content">
    <div id="entete">
        <h2><strong>RECETTES DU <?php echo dateAffiche($dte1); ?></strong></h2>
    </div>
   <table id="table">
        <thead>
        <tr>
            <th align="center">#</th>
            <th align="center">N° RECU</th>
            <th align="center">N° FACTURE</th>
            <th align="center">CLIENT</th>
            <th align="center">AGENT</th>
            <th align="center">SERVICE</th>
            <th align="center">MONTANT</th>
        </tr>
        </thead>
        <tbody>
             <?php
                $cashusd = 0;
                $cashcdf = 0;
                $donusd = 0;
                $doncdf = 0;
                $i = 1;
                foreach ($result as $rows){
                    $txpaie=$rows->taux;
                    $cdf1 =$rows->montantusd*$txpaie+ $rows->montantcdf;
                    $cdf= montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txpaie, $cdf1);
                    $cashcdf +=$cdf;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $rows->numero; ?></td>
                        <td><?php echo $rows->num_fact; ?></td>
                        <td><?php echo $rows->nom_client; ?></td>
                         <td><?php echo $rows->nom_user; ?></td>
                         <td><?php echo $rows->type; ?></td>
                        <td><?php echo afficheMontant($_SESSION['Paie_affiche'],$cdf); ?></td>
                    </tr>
                <?php $i++;} ?>
                <tr>
                    <td colspan="6"><b>Total</b></td>
<!--                    <td></td>
                    <td></td>
                    <td></td>
                     <td></td>
                     <td></td>-->
                    <td><b><?php echo afficheMontant(getsymbole_local(), $cashcdf); ?></b></td>
                </tr>
        </tbody>

    </table>
    <div id="entete1" align="center" style="margin-left:100px;">
        <span>Imprimé le <?php echo date('d/m/Y'); ?> par <?php echo strtoupper($_SESSION['nom_user'] . ' ' . $_SESSION['prenom_user']); ?></span> 
    </div>

</div>
