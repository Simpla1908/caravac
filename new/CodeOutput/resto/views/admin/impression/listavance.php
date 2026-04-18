
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
        <h2><strong>LISTE DES AVANCES SUR SALAIRE</strong></h2>
    </div>
    <table align="center" id="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Employe</th>
                <th >Montant total emprunte</th>
                <th >Montant total rembourse</th>
                <th >Reste</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $employe_id=0;
    $noms ='';
    $dte ='';
    $dte_deduct ='';
    $duree=0;
    $montant=0;
    $montrembourse =0;
    $reste=0;
  foreach($result as $rows)
     {
        $employe_id=$rows->employe_id;
        $noms=$rows->noms;
        $dte =$rows->dte;
        $dte_deduct =$rows->dte_deduct;
        $duree=$rows->duree;
        $montant=montant_equivalent_bdd($rows->monnaieresemprunt,$_SESSION['Paie_affiche'],$rows->tauxresemprunt,$rows->montant) ;
        $libelle=$rows->libelle;
        $site_id=$_SESSION['idsite'];
        $result2=MontantRembourse($employe_id,$libelle,$site_id);
        foreach($result2 as $rows2){
          $montrembourse += montant_equivalent_bdd($rows2->monnaierembourse,$_SESSION['Paie_affiche'],$rows2->tauxremourse,$rows2->montrembourse);         
        }
         $reste=$montant-$montrembourse;
        ?>
        <tr class="odd gradeX">
        <td><?php echo $i;?></td>
        <td><?php echo $noms;?></td>
        <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $montant);?></td>
        <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $montrembourse);?></td>
        <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $reste);?></td>
        </tr>
        <?php
        $i++;
        $montrembourse=0;
        $tot_montant+=$montant;
        $tot_montrembourse+=$montrembourse;
        $tot_reste=+$reste;
        }
        ?>
        </tbody>
        <tr>
        <td colspan="2" align="right">TOTAL</td>
        <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $tot_montant);?></td>
        <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $tot_montrembourse);?></td>
        <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $tot_reste);?></td>
        </tr>
    </table>
    <br>
    <div id="entete1" align="right">
        <span>Imprimé le <?php echo date('d/m/Y'); ?></span> <br>
    </div>
</div>
