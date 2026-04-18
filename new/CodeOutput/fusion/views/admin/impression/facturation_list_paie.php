
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
        <h2><strong>LISTE DE PAIEMENT DU <?php echo $_SESSION['datedebut_paiement']; ?> AU <?php echo $_SESSION['datefin_paiement']; ?></strong></h2>
    </div>
    <table align="center" id="table">
        <thead>
            <tr>
                <th>#</th>
                  <th>Client</th>
                  <th>N° Facture</th>
                  <th >N° Réçu</th>
                  <th >Date</th>
                  <th >Mode</th>
                  <th >Montant</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $n = count($_SESSION['rows_paiement']['i']);
            for ($i = 0; $i <= $n - 1; $i++) {
                ?>
                <tr class="odd gradeX">
                <td><?php echo $_SESSION['rows_paiement']['i'][$i]; ?></td>
                <td><?php echo $_SESSION['rows_paiement']['nom_client'][$i]; ?></td>
                <td><?php echo $_SESSION['rows_paiement']['num_fact'][$i];?></td>
                <td><?php echo $_SESSION['rows_paiement']['numero'][$i];?></td>
                <td><?php echo $_SESSION['rows_paiement']['dte'][$i];?></td>
                <td>
                     <?php
                    if($_SESSION['rows_paiement']['lib'][$i]=='Credit'){
                    echo 'Acompte'; 
                    }else{
                    echo $_SESSION['rows_paiement']['lib'][$i]; 
                    }
                    ?>
                </td>
                <td><?php echo $_SESSION['rows_paiement']['montant'][$i];?></td>


                </tr>
                <?php
               }
                ?>
        </tbody>
        <tfoot>
          <tr>
          <th colspan="6">Total Cash</th>
           <td><?php echo  $_SESSION['cash_paiement'];?></td>
          </tr>
          <tr>
          <th colspan="6">Total Acompte</th>
           <td><?php echo $_SESSION['credit_paiement'];?></td>
          </tr>
          <tr>
          <th colspan="6">Total Don</th>
           <td><?php echo $_SESSION['don_paiement'];?></td>
          </tr>
        </tfoot>
    </table>
    <br>
    <div id="entete1" align="right">
        <span>Imprimé le <?php echo date('d/m/Y'); ?></span> <br>
    </div>
</div>
