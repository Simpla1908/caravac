
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
        <h2><strong>FICHE CLIENT DU <?php echo dateAffiche($_SESSION['datedebut']); ?> AU <?php echo dateAffiche($_SESSION['datefin']); ?></strong></h2>
    </div>
   <table id="table">
        <thead>
        <tr>
            <th align="center">#</th>
            <th align="center">NOMS</th>
            <th align="center">SEXE</th>
            <th align="center">NATIONALITE</th>
            <th align="center">ETAT CIVIL</th>
            <th align="center">CARTE</th>
            <th align="center">N° CARTE</th>
            <th align="center">PROVENANCE</th>
        </tr>
        </thead>
        <tbody>
             <?php 
                $nbArticles = count($_SESSION['client']['n']);
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                ?>
                <tr>
                    <td align="center"><?php echo $_SESSION['client']['n'][$i] ?></td>
                    <td align="center"><?php echo $_SESSION['client']['Client'][$i] ?></td>
                    <td align="center"><?php echo $_SESSION['client']['sexe'][$i] ?></td>
                    <td align="center"><?php echo $_SESSION['client']['nationalite'][$i] ?></td>
                    <td align="center"><?php echo $_SESSION['client']['etat'][$i] ?></td>
                    <td align="center"><?php echo $_SESSION['client']['carte'][$i] ?></td>
                    <td align="center"><?php echo $_SESSION['client']['numcarte'][$i] ?></td>
                    <td align="center"><?php echo $_SESSION['client']['provenance'][$i] ?></td>
                </tr>
                <?php
                 }
                 ?>
        </tbody>

    </table>
    <div id="entete1" align="center" style="margin-left:100px;">
        <span>Imprimé le <?php echo date('d/m/Y'); ?> par <?php echo strtoupper($_SESSION['nom_user'] . ' ' . $_SESSION['prenom_user']); ?></span> 
    </div>

</div>
