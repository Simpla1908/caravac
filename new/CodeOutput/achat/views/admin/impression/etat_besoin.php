
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
    
    #entete2 {
        /*text-align: center;*/
        /*text-transform: uppercase;*/
        padding-top: 0px;
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

<div id="content">
    <div id="entete">
        <h3><u>ETAT DE BESOINS N° : <?php echo $rows->num_fact;?></u></h3>
        <span><b><?php // echo $titre; ?></b></span>
    </div>
    
    <div id="entete2">
        <strong>Fournisseur : </strong> <?php echo $rows->nom_entreprise;?><br>
        <strong>Description :</strong> <?php echo $rows->justification;?><br>
        <strong>Devise :</strong> <?php echo $rows->monnaie;?><br>
        <strong>Date de commande :</strong> <?php echo dateAffiche($rows->date_edition);?>
    </div>
    
    <table align="center" id="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Désignation</th>
                <th>Quantité</th>
                <th>Unité</th>
                <th>Prix unitaite</th>
                <th>Sous-total</th>
            </tr>
        </thead>
        <tbody id="produit_list">
            <?php
            $i=1;
            $total=0;
            foreach ($lignes_cmd as $r) {
                $sous_tot= $r->qte * $r->prix;
            ?>
            <tr>
                <td align="center"><?php echo $i; ?></td>
                <td align="center"><?php echo $r->designation; ?></td>
                <td align="center"><?php echo $r->qte; ?></td>
                 <td align="center"><?php echo $r->unite; ?></td>
                <td align="center"><?php echo format_chiffre($r->prix); ?></td>
                <td align="center"><?php echo format_chiffre($sous_tot); ?></td>
            </tr>
           <?php $i++; $total=$total + $sous_tot;} ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" align="right">Total</th>
                <th><?php echo format_chiffre($total); ?></th>
            </tr>
        </tfoot>
    </table>
    <br>
    <div id="entete1" align="right">
        <?php echo strtoupper($rows->nom_user. ' ' .$rows->prenom_user); ?>
    </div>
    
    <?php if($rows->i_souscription==0){ ?>
    <div id="entete23">
        <span><i>Imprimé le  <?php echo date('d/m/Y'); ?> par </i></span>
        <b><?php echo strtoupper($_SESSION['nom_user'].' '.$_SESSION['prenom_user']); ?></b>
    </div>
    <?php }?>
</div>
