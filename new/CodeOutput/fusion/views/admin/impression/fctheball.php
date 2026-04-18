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
            Tél:<?php echo $telephone; ?> <br />
            ID.Nat: <?php echo $idnat; ?>,
            <br />
            RCCM:<?php echo $rccm; ?>

        </div>
    </div>
    <hr />

    <div  class="row pad-top-botm client-info">
        <div class="col-lg-6 col-md-6 col-sm-6" id="client">
            <h4>  <strong>Information Client</strong></h4>
            <strong> <span id='nomcl'><?php echo $nom_client; ?></span> </strong>
            <br  />
            <?php // if ($nom_respo!='Prive'){ ?>
              <b>Responsable :<span id='nomsct'><?php echo $nom_respo; ?></span> </b> 
            <?php // } ?>
            <br  />
           Tél :<span id='telcl'><?php echo $telcl; ?></span>
            <br />
            E-mail :<span id='emailcl'><?php echo $emailcl; ?></span> 
            <br />
            Adresse :<span id='adrcl'><?php echo $adrcl; ?></span>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6" id="details">
            <h4>  <strong>Détails facture</strong></h4>
            <b>Numéro: <?php echo $num_fact; ?> </b><br />
             Mode: <?php echo $mode; ?> 
            <br />
            Date d'édition: <span id='dte_edtsp'><?php echo dateAffiche($date_edition); ?></span>
            <br />
            Agent: <span id='dte_echsp'><?php echo $agent; ?></span> <br />
        </div>
    </div>
    <hr />
    <h2>  <strong>
            <?php if($do2==4){
                echo 'RESERVATION';
            }else{
               echo 'HEBERGEMENT';  
            }
            ?>
            
            
        </strong></h2>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="table">
                    <thead>
                        <tr>
                            <th>Chambre</th>
                            <th>Période</th>
                            <th>Prix</th>
                            <th>Nuitée</th>
                            <th>Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i <= $nbArticles - 1; $i++) {
                            $id_ch = $_SESSION['panier']['id_article'][$i];
                            $repas = $_SESSION['panier']['repas'][$i];
                            $dte_in=$_SESSION['panier']['dte_a'][$i];
                            $dte_out=$_SESSION['panier']['dte_s'][$i];
                            if($repas=='0'){
                            $nom_ch = $_SESSION['panier']['nom'][$i];
                            $qte = $_SESSION['panier']['qte'][$i];
                            $monttva = $_SESSION['panier']['monttva'][$i];
                            $tarif_ch2 = $_SESSION['panier']['prix'][$i];
                            $cout_ch = prixHebergement($tarif_ch2, $monttva) * $qte;
                            ?> 
                            <tr>
                                <td><?php echo AfficheNomChambre($nom_ch); ?></td>
                                <td><?php echo dateAffiche($dte_in) . ' - ' . dateAffiche($dte_out); ?></td>
                                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $tarif_ch2); ?></td>
                                 <td><?php echo $qte; ?></td>
                                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $cout_ch); ?></td>
                            </tr>
                        <?php }}; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php if($bool_serv){ ?>
     <h4>  <strong>AUTRES SERVICES</strong></h4>
     <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Désignation</th>
                            <th>QTE</th>
                            <th>Prix</th>
                            <th>Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                   <?php
                    for ($i = 0; $i <= $nbArticles - 1; $i++) {
                        $id_ch = $_SESSION['panier']['id_article'][$i];
                        $repas = $_SESSION['panier']['repas'][$i];
                        $dte_a=$_SESSION['panier']['dte_a'][$i];
                        if($repas==1){
                        $nom_ch = $_SESSION['panier']['nom'][$i];
                        $qte = $_SESSION['panier']['qte'][$i];
                        $monttva = $_SESSION['panier']['monttva'][$i];
                        $tarif_ch2 = $_SESSION['panier']['prix'][$i];
                        $cout_ch = prixHebergement($tarif_ch2, $monttva) * $qte;
                        ?> 
                        <tr>
                            <td><?php echo dateAffiche($dte_a); ?></td>
                            <td><?php echo AfficheNomChambre($nom_ch); ?></td>
                            <td><?php echo $qte; ?></td>
                            <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $tarif_ch2); ?></td>
                            <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $cout_ch); ?></td>
                        </tr>
                    <?php }}; ?>
                    <?php
                    $nbre2=count($service['id']);
                   for ($k = 0; $k <= $nbre2 - 1; $k++) {
                        $tp=$service['type'][$k];
                        if($tp=='restaurant'){
                        $dte_a=$service['dte'][$k];;
                        $nom_ch =$service['des'][$k];
                        $qte ='-';
                        $tarif_ch2 ='-';
                        $ttc1=$service['ttc'][$k];
                        $tva1=$service['tva'][$k];
                        $ht1=$service['ht'][$k];
                        $cout_ch =$ttc1;
                        ?> 
                        <tr>
                            <td><?php echo dateAffiche($dte_a); ?></td>
                            <td><?php echo AfficheNomChambre($nom_ch); ?></td>
                            <td><?php echo $qte; ?></td>
                            <td><?php echo $tarif_ch2; ?></td>
                            <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $cout_ch); ?></td>
                        </tr>
                    <?php 
                    $ttcresto+=$ttc1;
                    $tvaresto+=$tva1;
                    $htresto+=$ht1;
                     }}; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
     <?php }
        $valtva=$tottva+$tvaresto;
        $valht=$ht+$htresto;
        $valttc=$ttc+$ttcresto;
        $solde =$valttc - $totpaye;
        if($assujetti==0){
           $valht+=$valtva;
           $valtva=0; 
        }
     ?>
         <?php if($assujetti!=0){ ?>   
            <hr />
           <div class="ttl-amts">
                <h4 class="tot">  HT : <?php echo afficheMontant($_SESSION['Paie_affiche'],$valht); ?> </h4>
            </div>
            <hr />
            <div class="ttl-amts">
                <h4 class="tot">  TVA : <?php echo afficheMontant($_SESSION['Paie_affiche'],$valtva); ?>  </h4>
            </div>
           <?php } ?>
            <hr />
            <div class="ttl-amts">
                <h4 class="tot"> <strong>TTC : <?php echo afficheMontant($_SESSION['Paie_affiche'],$valttc); ?></strong> </h4>
            </div>
            
           <?php //  if($mode=='Cash'){ ?>
            <hr />
            <div class="ttl-amts">
                <h4 class="tot"> <strong>TOTAL PAYE : <?php echo afficheMontant($_SESSION['Paie_affiche'],$totpaye); ?></strong> </h4>
            </div>
             <?php 
             if($solde >0){ ?>
                <hr />
                <div class="ttl-amts">
                    <h4 class="tot"> <strong>RESTE: <?php echo afficheMontant($_SESSION['Paie_affiche'],$solde); ?></strong> </h4>
                </div>
            <?php } ?>
      <?php // } ?>
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
            <?php if($date_edition != date('Y-m-d')){?>
                <td align="left">
                    Imprimé  le  <?php echo date('d/m/Y').' par '.$_SESSION['nom_user'].' '.$_SESSION['prenom_user']; ?>
                </td>
            <?php } ?>
            <td align="right">Fait à  <?php echo ucfirst($ville_hotel); ?> , le  <?php echo dateAffiche($date_edition); ?></td>
        </tr>
    </table>
</div>




