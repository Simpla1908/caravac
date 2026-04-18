<!--Insertion du CSS -->
<style type="text/css">
    table { 
        width: 100%; 
        color: #717375; 
        font-family: helvetica; 
        line-height: 5mm; 
        border-collapse: collapse; 
    }
    h2 { margin: 0; padding: 0; }
    p { margin: 25px; text-align: center; }
 
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
    .space { padding-top: 100px; }
    .10p { width: 10%; } .15p { width: 15%; } 
    .25p { width: 25%; } .50p { width: 50%; } 
    .60p { width: 60%; } .75p { width: 75%; } .100p { width: 100%; }
</style>


    <table style="margin-top: 50px;">
        
        <tr>
            <td class="100p" style="text-align: center;">
                <h2><u>DETAILS VENTES</u></h2><br />
                Période :
                <small>(du <?php echo dateAffiche($_SESSION['datedebut2']); ?> au <?php echo dateAffiche($_SESSION['datefin2']); ?>)</small>
            </td>
        </tr>
       
    </table>
 
    <table style="margin-top: 30px; margin-left: 65px;" class="border">
        <tr>
            <td rowspan="2" style="text-align: center;">N°</td>
            <td colspan="2" style="text-align: center;">SERVICE</td>
            <td colspan="2" style="text-align: center;">CASH</td>
            <td colspan="2" style="text-align: center;">CREDIT</td>
            <td colspan="2" style="text-align: center;">DON</td>
        </tr>
        <tr>
            <th style="text-align: center;">Désignation</th> 
            <th style="text-align: center;">Prix</th> 
            <th style="text-align: center;">Quantité</th> 
            <th style="text-align: center;">Prix Total</th> 
            <th style="text-align: center;">Quantité</th> 
            <th style="text-align: center;">Prix Total</th> 
            <th style="text-align: center;">Quantité</th> 
            <th style="text-align: center;">Prix Total</th>
        </tr>
             <?php 
                $nbArticles = count($_SESSION['detailnuite2']['i']);
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                ?>
                <tr>
                <td><?php echo $_SESSION['detailnuite2']['i'][$i] ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['detailnuite2']['chambre'][$i] ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['detailnuite2']['tarif'][$i] ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['detailnuite2']['nuites_cash'][$i] ?></td>
                <td style="text-align: right;"><?php echo $_SESSION['detailnuite2']['prix_total_cash'][$i] ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['detailnuite2']['nuites_credit'][$i] ?></td>
                <td style="text-align: right;"><?php echo $_SESSION['detailnuite2']['prix_total_credit'][$i] ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['detailnuite2']['nuites_don'][$i] ?></td>
                <td style="text-align: right;"><?php echo $_SESSION['detailnuite2']['prix_total_don'][$i] ?></td>

                </tr>
                <?php
                 }
                 ?>
   
        <tr>
            <th colspan="4">Total</th> 
            <th style="text-align: right;"><?php echo $_SESSION['total_cash2'] ?></th>
            <th colspan="1"></th>
            <th style="text-align: right;"><?php echo $_SESSION['total_credit2'] ?></th>
            <th colspan="1"></th>
            <th style="text-align: right;"><?php echo $_SESSION['total_don2'] ?></th>
        </tr>

    </table>
    <div id="entete25">
        <p align="center">
            <br><br><br><br><br>
        <span>Imprimé le  <?php echo date('d/m/Y'); ?> par </span>
        <b><?php echo strtoupper($_SESSION['nom_user'].' '.$_SESSION['prenom_user']); ?></b>
        </p>
    </div>

</div>
