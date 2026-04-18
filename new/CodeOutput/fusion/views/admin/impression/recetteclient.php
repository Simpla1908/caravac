
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
        <h2><strong>RECETTES <?php echo$description; ?></strong></h2>
    </div>
    <table id="table">
    <thead>
        <tr>
            <th align="center">#</th>
            <th align="center">Noms</th>
            <th align="center">Chambre</th>
            <th align="center">Période</th>
            <th align="center">Nuitée</th>
            <th align="center">Tarif</th>
            <th align="center">Montant séjour</th>
            <th align="center">Montant Consommation</th>
        </tr>
    </thead>
    <tbody id="bloc_recette"> 
        <?php
        $i = 1;
        $totsej=0;
        $totconsommation=0;
        foreach ($recettes as $rows) {
            $date_occ=$rows->date_occ;
            $date_lib=$rows->date_lib;
            $st = $rows->statut;
            $paiech=$rows->paie;
            $dtecomp=$dte=date('Y-m-d');
            $nuite = NbJours($date_occ, $dtecomp);
            if ($rows->statut == 'reserve' || $rows->statut == 'change' || $rows->statut == 'libre') {
                $nuite = NbJours($rows->date_occ, $rows->date_lib);
                if ($st == 'change' || $st == 'libre') {
                    $nuite = $rows->nuitee;
                }
                $dte = $rows->date_lib;
                $dtecomp=$dte;
            }
            //Incrementation nuitée par rapport au checkin
            if (($rows->date_occ < $dte && $hrs_sys>$checkout)&&($rows->statut == 'occupe')) {
                $nuite++;
                $dtecomp=$dte;
            }
            $dte = $rows->idres_ch;
            $taux=$rows->taux;
            $tarif_ch=$rows->tarif_ch;
            $tarif_ch2=montant_equivalent_bdd(getsymbole_local(),$_SESSION['Paie_affiche'],$taux,$tarif_ch);
            if (isset($_SESSION['paiesej']['sejour'][$dte])) {
                $mpsej = $_SESSION['paiesej']['sejour'][$dte];
            } else {
                $mpsej = 0;
            }
            if (isset($_SESSION['paiesej']['consommation'][$dte])) {
                $mpcons = $_SESSION['paiesej']['consommation'][$dte];
            } else {
                $mpcons = 0;
            }
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $rows->nom_client; ?></td>
                <td><?php echo $rows->num_ch; ?></td>
                <td><?php echo dateAffiche($date_occ).' - '.dateAffiche($dtecomp); ?></td>
                <td><?php echo $nuite; ?></td>
                <td><?php echo afficheMontant($_SESSION['Paie_affiche'],$tarif_ch2); ?></td>
                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $mpsej); ?></td>
                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $mpcons); ?></td>
            </tr>
            <?php $i++;
            $totsej+=$mpsej;
            $totconsommation+=$mpcons;
            };
            ?>
            <tfoot>
                <tr>
                <th colspan="6">Total</th>
                <th><?php echo afficheMontant($_SESSION['Paie_affiche'],$totsej); ?></th>
                <th><?php echo afficheMontant($_SESSION['Paie_affiche'],$totconsommation); ?></th>
                </tr>
            </tfoot>
            
    </tbody>
</table>
</div>
