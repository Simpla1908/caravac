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
    #logodiv{
        /*border:1px solid black;*/
        float: left;
        height: 100px;
        width: 100px;
    }
    #adresse{
        /*border:1px solid black;*/
        float: right;
        width: 500px;
        text-align: right;
    }
    #client{
        /*border:1px solid black;*/
        float: left;
        width: 400px;
        text-align: left;
    }
    #details{
        /*border:1px solid black;*/
        float: right;
        width: 300px;
        text-align: left;
    }
    .ttl-amts{
        text-align: right;
        /*margin-top: -10px;*/
        /*border:1px solid black;*/
        /*height: 10px;*/
    }
    .tot{
        /*border:1px solid black;*/
        margin-top: -5px;
        margin-bottom: 0px;
    }
</style>



<div id="entete">

    <div class="row pad-top-botm " >
        <div class="col-lg-6 col-md-6 col-sm-6 " id="logodiv">
            <img src="public/uploads/<?php echo $logo; ?>" /> 
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6" id="adresse">
            <strong><?php echo $nomcomp; ?></strong>
            <br />
            <i>Adresse :</i> <?php echo $adresse_c; ?>
            <br />
            ID.Nat: <?php echo $idnat; ?>,
            <br />
            RCCM:<?php echo $rccm; ?>
        </div>
    </div>
    <div  class="row text-center contact-info">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <hr />
            <span>
                <strong>Email : </strong>  <?php echo $email_compagny; ?>
            </span>
            <span>
                <strong>Tél : </strong>  <?php echo $telephone; ?>
            </span>
<!--              <span>
                <strong>Fax : </strong>  +012340-908- 890 
            </span>-->
            <hr />
        </div>
    </div>
    <div  class="row pad-top-botm client-info">
        <div class="col-lg-6 col-md-6 col-sm-6" id="client">
            <h4>  <strong>Informations Client</strong></h4>
            <strong> <span id='nomcl'><?php echo $nomcl; ?></span> </strong>
            <?php if (!empty($societe)) { ?>
                <div>
                    <b>Socièté :</b> <span id='nomsct'><?php echo $societe; ?></span> 
                </div>
            <?php } ?>
            <br  />
            <b>Tél :</b><span id='telcl'><?php echo $tel; ?></span>
            <br />
            <b>E-mail :</b><span id='emailcl'><?php echo $emailcl; ?></span> 
            <br />
            <b>Adresse :</b><span id='adrcl'><?php echo $adr; ?></span>,
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6" id="details">
            <h4>  <strong>Période</strong></h4>
            Du <span id='dte_edtsp'><?php echo $dte1; ?></span> au <span id='dte_echsp'><?php echo $dte2; ?></span>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center;">
            <strong> <h3>EXTRAIT DE COMPTE</h3> </strong>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-condensed" id="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>N°Bon de commande</th>
                            <th data-hide="phone,tablet">N°Bon de paiement</th>
                            <th data-hide="phone,tablet">Débit</th>
                            <th data-hide="phone,tablet">Crédit</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php
                        $nbre = count($data['id']);
                        $j=1;
                        $tdebit = $tcredit = 0;
                        for ($i = 0; $i < $nbre; $i++) {
                            $dte = $data['date'][$i];
                            $numfact = $data['numfact'][$i];
                            $numrecu = $data['numrecu'][$i];
                            $debit = $data['debit'][$i];
                            $credit = $data['credit'][$i];
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo dateAffiche($dte); ?></td>
                                <td><?php echo $numfact; ?></td>
                                <td><?php echo $numrecu; ?></td>
                                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $debit); ?></td>
                                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $credit); ?></td>
                            </tr>
                            <?php
                            $tdebit+=$debit;
                            $tcredit+=$credit;
                            $j++;
                        }
                        $solde = $tcredit - $tdebit;
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4">Total</th>
                            <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $tdebit); ?></td>
                            <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $tcredit); ?></td>
                        </tr>
                        <tr>
                            <th colspan="4">Solde</th>
                            <td colspan="2" align="center">
                                <strong>
                                    <?php
                                    $solde = $tdebit - $tcredit;
                                    echo afficheMontant($_SESSION['Paie_affiche'], $solde);
                                    ?>
                                </strong>
                            </td>
                        </tr>
                    </tfoot>
                </table>              
            </div>
        </div>
    </div>

    <br>
    <div id="entete1" align="right">
        <span>Imprimé le <?php echo date('d/m/Y'); ?></span> <br>
    </div>
</div>




