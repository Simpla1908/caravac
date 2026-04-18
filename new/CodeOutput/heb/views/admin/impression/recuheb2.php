<style>
    * {
        margin: 0;
        padding: 0;
        /*font-family: Times New Roman;*/
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
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
        /*text-transform: uppercase;*/
        /*font-weight:bold;*/
    }

    #table td {
        border-right: 0.5px solid #000;
        border-bottom: 0.5px solid #000;
        padding: 1mm;
        text-align: center;
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

    #logodiv {
        /*border:1px solid black;*/
        float: right;
        height: 100px;
        width: 100px;
    }

    #adresse {
        /*border:1px solid black;*/
        margin-right: 400px;
        float: left;
        width: 500px;
        text-align: left;
    }

    #client {
        /*border:1px solid black;*/
        float: left;
        width: 400px;
        text-align: left;
    }

    #details {
        /*border:1px solid black;*/
        float: right;
        width: 300px;
        text-align: left;
    }

    .ttl-amts {
        text-align: right;
        /*margin-top: -10px;*/
        /*border:1px solid black;*/
        /*height: 10px;*/
    }

    .tot {
        /*border:1px solid black;*/
        margin-top: -5px;
        margin-bottom: 0px;
    }
</style>



<div id="entete">

    <div class="row pad-top-botm ">
        <div class="col-lg-6 col-md-6 col-sm-6" id="adresse">
            <strong><?php echo $nomcomp; ?></strong>
            <br />
            <i>Adresse :</i> <?php echo $adresse_c; ?>
            <br />
            Tél:<?php echo $telephone; ?> <br />
            ID.Nat: <?php echo $idnat; ?>,
            <br />
            RCCM:<?php echo $rccm; ?>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 " id="logodiv">
            <img src="public/uploads/<?php echo $logo; ?>" />
        </div>

    </div>
    <hr />

    <div class="row pad-top-botm client-info">
        <div class="col-lg-6 col-md-6 col-sm-6" id="client">
            <h4> <strong>Information Client</strong></h4>
            <strong> <span id='nomcl'><?php echo $nom_client; ?></span> </strong>
            <br />
            <?php // if ($nom_respo!='Prive'){ 
            ?>
            <b>Responsable :</b> <span id='nomsct'><?php echo $nom_respo; ?></span>
            <?php // } 
            ?>
            <br />
            <b>Tél :</b><span id='telcl'><?php echo $telcl; ?></span>
            <br />
            <b>E-mail :</b><span id='emailcl'><?php echo $emailcl; ?></span>
            <br />
            <b>Adresse :</b><span id='adrcl'><?php echo $adrcl; ?></span>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6" id="details">
            <h4> <strong>Détails paiement</strong></h4>
            <b>N° Facture: <?php echo $num_fact; ?> </b>
            <br />
            <b>N° Réçu: <?php echo $numero_recu; ?> </b>
            <br />
            <?php if (get('rmb') == 1) { ?>
                Motif: <?php echo 'Remboursement'; ?>
                <br />
            <?php } ?>
            Chambre: <span id='dte_edtsp'><?php echo $nom_ch; ?></span>
            <br />
            Agent: <span id='dte_echsp'><?php echo $agent2; ?></span>
        </div>
    </div>
    <hr />
    <h2> <strong>RECU HEBERGEMENT</strong></h2>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Mode</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  ?>
                        <tr>
                            <td><?php echo dateAffiche($dte_paie); ?></td>
                            <td><?php echo afficheMontant($_SESSION['Paie_affiche'], abs($montpaye)); ?></td>
                            <td><?php echo $libmode; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <table border="0" style="width: 100%;">
        <tr>
            <td align="left">
                <br><br>
                Signature Réception
            </td>
            <td align="right"><br><br>Signature Client</td>
        </tr>
    </table>

    <br><br><br><br>

    <table border="0" style="width: 100%;">
        <tr>
            <?php if ($dte_paie != date('Y-m-d')) { ?>
                <td align="left">
                    Imprimé le <?php echo date('d/m/Y'); ?>
                </td>
            <?php } ?>
            <td align="right">Fait à <?php echo ucfirst($ville_hotel); ?> , le <?php echo dateAffiche($dte_paie); ?></td>
        </tr>
    </table>
</div>