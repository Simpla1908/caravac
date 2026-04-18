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
    
    #entete23 {
        text-align: center;
        /*text-transform: uppercase;*/
    }

    #entete1 {
        margin-top: 10px;
        margin-right: 70px;
        text-align: center;
    }

</style>
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
<!--<page format="130x200" orientation="L" backcolor="#fff" style="font: arial;">-->
    <div id="content">
        <div id="entete">
            <h3><u>BON DE LIVRAISON N° : <?php echo $_SESSION['num_bon_liv']; ?></u></h3>
            <span><b><?php echo $titre; ?></b></span>
        </div>
        <div id="entete">
            <strong>Fournisseur : </strong> <?php echo strtoupper($_SESSION['fournisseur']); ?><br>
            <strong>Bon de commande :</strong> <?php echo $_SESSION['num_bon']; ?>
            
        </div>
        <table align="center" id="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Articles</th>
                <th>Quantité attendue</th>
                <th>Quantité livrée</th>
                <th>Observation</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i=1;
            foreach ($result as $r) {
                $solde = $r->quantite_cmd - $r->quantite_liv;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $r->designation; ?></td>
                <!--<td><?php // echo $r->quantite; ?></td>-->
                <td><?php echo $r->quantite_cmd; ?></td>
                <td><?php echo $r->quantite_liv; ?></td>
                <!--<td><?php // echo $solde; ?></td>-->
                <td><?php echo $r->observation; ?></td>
            </tr>
           <?php $i++; } ?>
        </tbody>
    </table>
        
        <br>
        <div id="entete1" align="right">
            <?php echo strtoupper($_SESSION['nom_user'] . ' ' . $_SESSION['prenom_user']); ?>
        </div>
        
        <?php if($_SESSION['first'] ==  0){ ?>
        <div id="entete23">
            <span><i>Imprimé le  <?php echo date('d/m/Y'); ?> par </i></span>
            <b><?php echo strtoupper($_SESSION['nom_user'].' '.$_SESSION['prenom_user']); ?></b>
        </div>
        <?php }?>
    </div>

<!--</page>-->