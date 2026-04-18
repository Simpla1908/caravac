
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
        <h2><strong>JOURNAL</strong></h2>
    </div>
   <table id="table">
        <thead>
        <tr>
            <th align="center">TYPE JOURNAL</th>
            <th align="center">REFERENCE</th>
            <th align="center">DATE</th>
            <th align="center">COMPTE</th>
            <th align="center">DESCRIPTION</th>
            <th align="center">DEBIT</th>
            <th align="center">CREDIT</th>
            <th align="center">INTITULE COMPTE</th>

        </tr>
        </thead>
        <tbody>
             <?php 
                $nbArticles = count($_SESSION['journal']['n']);
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                ?>
                <tr>
                    <td align="center"><?php echo $_SESSION['journal']['typejournal'][$i] ?></td>
                    <td align="center"><?php echo $_SESSION['journal']['reference'][$i] ?></td>
                    <td align="center"><?php echo $_SESSION['journal']['date'][$i] ?></td>
                    <td align="center"><?php echo $_SESSION['journal']['compte'][$i] ?></td>
                    <td align="center"><?php echo $_SESSION['journal']['description'][$i] ?></td>
                    <td align="center"><?php echo $_SESSION['journal']['debit'][$i] ?></td>
                    <td align="center"><?php echo $_SESSION['journal']['credit'][$i] ?></td>
                    <td align="center"><?php echo $_SESSION['journal']['intitule'][$i] ?></td>
                </tr>
                <?php
                 }
                 ?>
        </tbody>

    </table>
    <br>
   

</div>
