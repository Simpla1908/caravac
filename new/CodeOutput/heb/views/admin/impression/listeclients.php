
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
        <h2><strong>LISTE DES CLIENTS</strong></h2>
    </div>
   <table id="table">
        <thead>
        <tr>
            <th align="center">N°</th>
            <th align="center">NOMS</th>
            <th align="center">TELEPHONE</th>
            <th align="center">EMAIL</th>
            <th align="center">SEXE</th>
            <th align="center">ADRESSE</th>
        </tr>
        </thead>
        <tbody>
             <?php 
                $nbArticles = count($_SESSION['client']['i']);
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                ?>
                <tr>
                    <td align="center"><?php echo $_SESSION['client']['i'][$i] ?></td>
                    <td align="center"><?php echo $_SESSION['client']['nom'][$i] ?></td>
                    <td align="center"><?php echo $_SESSION['client']['telephone'][$i] ?></td>
                    <td align="center"><?php echo $_SESSION['client']['email'][$i] ?></td>
                    <td align="center"><?php echo $_SESSION['client']['sexe'][$i] ?></td>
                    <td align="center"><?php echo $_SESSION['client']['adresse'][$i] ?></td>
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
