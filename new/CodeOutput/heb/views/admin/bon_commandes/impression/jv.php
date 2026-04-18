
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
    .5p { width: 5%; }
    .10p { width: 10%; } .15p { width: 15%; } 
    .25p { width: 25%; } .50p { width: 50%; } 
    .60p { width: 60%; } .75p { width: 75%; } .100p { width: 100%; }
</style>

<table style="margin-top: 50px;">
    <tr>
        <td class="100p" style="text-align: center;">
            <h2><u>RAPPORT DES VENTES</u></h2><br />
            Période :
            <small>( <?php  echo $periode; ?>)</small>
        </td>
    </tr>
</table>

<table style="margin-top: 30px; margin-left: 65px;" class="border">
    <thead>
        <tr>
            <th class="5p" rowspan="2" style="text-align: center;">N°</th>
            <th class="10p" valign="midle" colspan="2" rowspan="2" style="text-align: center;">DESIGNATION</th>
            <th class="10p" colspan="2" style="text-align: center;">CASH</th>
            <th class="10p" colspan="2" style="text-align: center;">CREDIT</th>
            <th class="10p" colspan="2" style="text-align: center;">DON</th>
        </tr>
        <tr>
            <th class="5p" style="text-align: center;">QTE</th> 
            <th class="15p" style="text-align: center;">PT</th> 
            <th class="5p" style="text-align: center;">QTE</th> 
            <th class="15p" style="text-align: center;">PT</th> 
            <th class="5p" style="text-align: center;">QTE</th> 
            <th class="15p" style="text-align: center;">PT</th>
        </tr>
    </thead>
    <tbody id="viewdata">
        <?php include(APP_FOLDER . '/views/admin/lignes_commandes/data.php'); ?>
    </tbody>
</table>




