
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
        <h2><strong>LISTE DES FACTURES <?php echo $_SESSION['mode']; ?>  DU <?php echo $_SESSION['datedebut_fact']; ?> AU <?php echo $_SESSION['datefin_fact']; ?></strong></h2>
    </div>
    <table align="center" id="table">
        <thead>
            <tr>
                <th>Numero</th>
                <th>Edition</th>
                <th>Echéance</th>
                <th>Client</th>
                <th>Montant total</th>
                <th>Montant payé</th>
                <th>Solde</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $n = count($_SESSION['liste_fact']['num_fact']);
            for ($i = 0; $i <= $n - 1; $i++) {
                ?>
                <tr class="odd gradeX">
                <td><?php echo $_SESSION['liste_fact']['num_fact'][$i]; ?></td>
                <td><?php echo $_SESSION['liste_fact']['date_edition'][$i];?></td>
                <td><?php echo $_SESSION['liste_fact']['date_echeance'][$i];?></td>
                <td><?php echo $_SESSION['liste_fact']['nom_client'][$i];?></td>
                <td><?php echo $_SESSION['liste_fact']['montantfact'][$i];?></td>
                <td><?php echo $_SESSION['liste_fact']['montant_paye'][$i];?></td>
                <td><?php echo $_SESSION['liste_fact']['solde'][$i];?></td>

                </tr>
                <?php
               }
                ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4">TOTAL</th>
                <th><?php echo $_SESSION['montant_tot'];?></th>
                <th><?php echo $_SESSION['montant_paie'];?></th>
                <th><?php echo $_SESSION['soldetot'];?></th>
            </tr>
        </tfoot>
    </table>
    <br>
    <div id="entete1" align="right">
        <span>Imprimé le <?php echo date('d/m/Y'); ?></span> <br>
    </div>
</div>
