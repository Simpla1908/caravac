
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
        <h2><strong>LISTE DE PERMUTATION </strong></h2>
    </div>
    <table align="center" id="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Numero</th>
                <th>Debut</th>
                <th>Fin</th>
                <th>Horaire</th>
                <th>Titulaire</th>
                <th>Remplaçant</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach($result as $rows)
                {
                ?>
                <tr class="odd gradeX">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $rows->num; ?></td>
                    <td><?php echo dateAffiche($rows->dte); ?></td>
                    <td><?php echo dateAffiche($rows->dtefin); ?></td>
                    <td><?php echo $rows->libhoraire; ?></td>
                    <td><?php echo $rows->nomsagent1; ?></td>
                    <td><?php echo $rows->nomsagent2; ?></td>
                    <td><?php echo $rows->type_lib; ?></td>
                </tr>
                <?php
                $i++;}
                ?>
        </tbody>
    </table>
    <br>
    <div id="entete1" align="right">
        <span>Imprimé le <?php echo date('d/m/Y'); ?></span> <br>
    </div>
</div>
