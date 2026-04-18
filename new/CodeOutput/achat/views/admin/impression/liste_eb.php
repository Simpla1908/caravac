
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
    
    #entete23 {
        text-align: center;
        padding-top: 185px;
        padding-bottom: 15px;
        font-family: helvetica;
    }

</style>


<div id="content">
    <div id="entete">
            <?php if(isset($_SESSION['datedebut']) && isset($_SESSION['datedebut'])){
                $datedebut = dateAffiche($_SESSION['datedebut']);
                $datefin = dateAffiche($_SESSION['datefin']);
                $titre='DU '.$datedebut.' AU '.$datefin;
                $dte=$datedebut;
            } else {
                $titre='DU '.date('d/m/Y');
                $dte=date('d/m/Y');
            }
            ?>
            <h3><u>LISTE ETAT DE BESOINS</u></h3>
            <span><b><?php echo $titre; ?></b></span>
            
    </div>
    <table align="center" id="table">
        <thead>
            <tr>
                <th>#</th>
                <th>N° Bon cmd</th>
                <th data-hide="phone,tablet">Description</th>
                <th data-hide="phone,tablet">Date</th>
                <th data-hide="phone,tablet">Fournisseurs</th>
                <th data-hide="phone,tablet">Total</th>
                <th data-hide="phone,tablet">Devise</th>
                <th data-hide="phone,tablet">Statut</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $n = count($_SESSION['rows_bc']['i']);
            for ($i = 0; $i <= $n - 1; $i++) {
                ?>
                <tr>
                <td><?php echo $_SESSION['rows_bc']['i'][$i]; ?></td>
                <td><?php echo $_SESSION['rows_bc']['Bon_cmd'][$i]; ?></td>
                <td><?php echo $_SESSION['rows_bc']['Description'][$i]; ?></td>
                <td><?php echo $_SESSION['rows_bc']['date'][$i];?></td>
                <td><?php echo $_SESSION['rows_bc']['fsse'][$i];?></td>
                <td><?php echo $_SESSION['rows_bc']['Total'][$i];?></td>
                <td><?php echo $_SESSION['rows_bc']['Devise'][$i];?></td>
                <td><?php echo $_SESSION['rows_bc']['Statut'][$i];?></td>
                </tr>
                <?php
               }
                ?>
        </tbody>
    </table>
    <br>
    <div id="entete1" align="right">
        <?php echo strtoupper($_SESSION['nom_user'] . ' ' . $_SESSION['prenom_user']); ?>
    </div>
    
    
    <?php // if($dte !=  date('d/m/Y')){ ?>
    <div id="entete23">
        <span><i>Imprimé le  <?php echo date('d/m/Y'); ?> par </i></span>
        <b><?php echo strtoupper($_SESSION['nom_user'].' '.$_SESSION['prenom_user']); ?></b>
    </div>
    <?php // }?>
</div>
