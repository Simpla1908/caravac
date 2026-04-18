<?php
//Mise en session pour impression
$_SESSION['grandlivre'] = array();
$_SESSION['grandlivre']['numerocompte'] = array();
$_SESSION['grandlivre']['compte'] = array();
$_SESSION['grandlivre']['date'] = array();
$_SESSION['grandlivre']['reference'] = array();
$_SESSION['grandlivre']['libelle'] = array();
$_SESSION['grandlivre']['debitcdf'] = array();
$_SESSION['grandlivre']['creditcdf'] = array();
$_SESSION['grandlivre']['solde1'] = array();
$_SESSION['grandlivre']['devise'] = array();
$_SESSION['grandlivre']['cours'] = array();
$_SESSION['grandlivre']['debitusd'] = array();
$_SESSION['grandlivre']['creditusd'] = array();
$_SESSION['grandlivre']['solde2'] = array();
$_SESSION['grandlivre']['afficher'] = array();
//fin mise en session
 $devisecdf=getsymbole_local();
 $deviseusd=getsymbole_devise();
 $totdebitcdf=0;
 $totdebitusd=0;
 $totcreditcdf=0;
 $totcreditusd=0;
 $totsolde1=0;
 $totsolde2=0;
 $stotdebitcdf=0;
 $stotdebitusd=0;
 $stotcreditcdf=0;
 $stotcreditusd=0;
?>
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
        <h2><strong>GRAND LIVRE</strong></h2>
          <h4><?php echo strtoupper($_SESSION['exercice_lib']);?></h4>
         <h4>PERIODE : Du <?php echo $_SESSION['datedebut'];?> au <?php echo $_SESSION['datefin'];?></h4>
    </div>
    <table id="table">
                    <thead>
                        <tr>
                            <th align="center">DATE</th>
                            <th align="center">REF.</th>
                            <th align="center">LIBELLE</th>
                            <th align="center">DEBIT</th>  
                            <th align="center">CREDIT</th>
                            <th align="center">SOLDE</th>
                            <th align="center">DEVISE</th>
                            <th align="center">COURS</th>
                            <th align="center">DEBIT</th>
                            <th align="center">CREDIT</th>
                            <th align="center">SOLDE</th>

                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $exercice_id=$_SESSION['GL_exercice_id'];
                    $numerocompte=$_SESSION['GL_numerocompte'];
                    $d1=$_SESSION['GL_d1'];
                    $d2=$_SESSION['GL_d2'];
                    $site_id=$_SESSION['GL_site_id'];
                    $resultCGL=ComptesGrandLivre($exercice_id,$numerocompte,$d1,$d2,$site_id,$bdd);
                    foreach ($resultCGL as $rowsCGL) {
                    $dataCGL=INFOSFromAccountNumber($rowsCGL->compte_ecriture,$rowsCGL->long_compte,$bdd);
                    $libcompte=$dataCGL['lib'];
                    $numerocompteCGL=$rowsCGL->compte_ecriture;
                    if($numerocompteCGL!=131&&$numerocompteCGL!=139){
                    if (!in_array($numerocompteCGL,$_SESSION['grandlivre']['numerocompte'])) {
                    array_push($_SESSION['grandlivre']['numerocompte'],$numerocompteCGL);
                     $result=GenererGrandLivre($exercice_id,$numerocompteCGL,$d1,$d2,$site_id,$bdd);  
                     $cumuls=GenererGrandLivreCumuls($exercice_id,$numerocompteCGL,$d1,$d2,$site_id,$bdd);  
                     $debitcdf=$cumuls['debitcdf'];
                     $creditcdf=$cumuls['creditcdf'];
                     $debitusd=$cumuls['debitusd'];
                     $creditusd=$cumuls['creditusd'];
                     $debitcdfCML=$cumuls['debitcdf'];
                     $creditcdfCML=$cumuls['creditcdf'];
                     $debitusdCML=$cumuls['debitusd'];
                     $creditusdCML=$cumuls['creditusd'];
                     $solde1=$cumuls['solde1'];
                     $solde2=$cumuls['solde2'];
                     $stotsolde1=$solde1;
                     $stotsolde2=$solde2;
                  ?>
                    <tr>
                        <td colspan="11" align="center"><b><?php echo $numerocompteCGL.'  '.ucfirst($libcompte); ?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo "<b>Cumul antérieur</b>"; ?></td>
                        <td></td>
                        <td></td>
                        <td>
                        <?php 
                        if($debitcdf>0){
                        echo FormatChiffreCompta($debitcdf); 
                        }
                        ?>
                        </td>
                         <td>
                        <?php 
                        if($creditcdf>0){
                        echo FormatChiffreCompta($creditcdf);
                        }
                        ?>
                        </td> 
                          <td>
                        <?php
                       if($solde1>0){
                        echo FormatChiffreCompta($solde1);
                         }
                        ?>
                        </td> 
                        <td></td>
                        <td></td>
                        <td>
                        <?php
                         if($debitusd>0){
                        echo FormatChiffreCompta($debitusd);
                        }
                        ?>
                        </td>
                        <td>
                        <?php
                        if($creditusd>0){
                        echo FormatChiffreCompta($creditusd);
                        }

                        ?>
                        </td>
                         <td>
                        <?php 
                        if($solde1>0){
                        echo FormatChiffreCompta($solde1);
                        }

                        ?>
                        </td> 

                    </tr>
                <?php
                     foreach ($result as $rows) {
                      $data=INFOSFromAccountNumber($rows->compte_ecriture,$rows->long_compte,$bdd);
                      $libcompte=$data['lib'];
                      $numero=$rows->compte_ecriture;
                      $debitcdf=0;
                      if($rows->debit>0){
                      $debitcdf=arrondir(montant_equivalent_bdd($rows->devise,$devisecdf,$rows->taux,$rows->debit)); 
                      $stotdebitcdf=$stotdebitcdf+$debitcdf;
                      }
                      $creditcdf=0;
                      if($rows->credit>0){
                      $creditcdf=arrondir(montant_equivalent_bdd($rows->devise,$devisecdf,$rows->taux,$rows->credit));
                      $stotcreditcdf=$stotcreditcdf+$creditcdf; 
                       }
                        $debitusd=0;
                        if($rows->debit>0){
                        $debitusd=arrondir(montant_equivalent_bdd($rows->devise,$deviseusd,$rows->taux,$rows->debit)); 
                        $stotdebitusd=$stotdebitusd+$debitusd;
                        }
                        $creditusd=0;
                        if($rows->credit>0){
                        $creditusd=arrondir(montant_equivalent_bdd($rows->devise,$deviseusd,$rows->taux,$rows->credit));
                        $stotcreditusd=$stotcreditusd+$creditusd;  
                        }
                      $solde1=$debitcdf-$creditcdf;
                      $solde2=$debitusd-$creditusd;
                      $stotsolde1=$stotsolde1+$solde1;
                      $stotsolde2=$stotsolde2+$solde2;

                ?>

                    <tr>
                        <td><?php echo dateAffiche($rows->dte); ?></td>
                        <td><?php echo $rows->reference;?></td>
                        <td><?php echo ucfirst($rows->descriptjourn);?></td>
                        <td>
                        <?php 
                        if($debitcdf>0){
                        echo FormatChiffreCompta($debitcdf); 
                        }
                        ?>

                        </td>
                         <td>
                        <?php
                       if($creditcdf>0){ 
                        echo FormatChiffreCompta($creditcdf);
                         }
                        ?>
                        </td> 
                          <td>
                        <?php 
                        if($solde1>0){ 
                        echo FormatChiffreCompta($solde1);
                          }
                        ?>
                        </td> 
                        <td><?php echo $deviseusd; ?></td>
                        <td><?php echo $rows->taux; ?></td>
                        <td>
                        <?php
                        if($debitusd>0){ 
                        echo FormatChiffreCompta($debitusd);
                        }

                        ?>
                        </td>
                        <td>
                        <?php
                        if($creditusd>0){ 
                        echo FormatChiffreCompta($creditusd);
                        }

                        ?>
                        </td>
                         <td>
                        <?php
                       if($solde2>0){  
                        echo FormatChiffreCompta($solde2);
                        }

                        ?>
                        </td> 

                    </tr>
                    <?php
                     } 
                    ?>
                    <tr>
                        <td><?php echo '<b>Sous total</b>'; ?></td>
                        <td></td>
                        <td></td>
                        <td>
                        <?php 
                        if($stotdebitcdf>0){ 
                        echo FormatChiffreCompta($stotdebitcdf); 
                        } 
                        ?>
                        </td>
                         <td>
                        <?php 
                        if($stotcreditcdf>0){ 
                        echo FormatChiffreCompta($stotcreditcdf);
                       } 
                        ?>
                        </td> 
                          <td>
                        <?php 
                        if($stotsolde1>0){ 
                        echo FormatChiffreCompta($stotsolde1);
                        } 
                        ?>
                        </td> 
                        <td></td>
                        <td></td>
                        <td>
                        <?php
                        if($stotdebitusd>0){ 
                        echo FormatChiffreCompta($stotdebitusd);
                                                } 

                        ?>
                        </td>
                        <td>
                        <?php
                        if($stotcreditusd>0){ 
                        echo FormatChiffreCompta($stotcreditusd);
                        } 
                        ?>
                        </td>
                         <td>
                        <?php 
                        if($stotsolde2>0){ 
                        echo FormatChiffreCompta($stotsolde2);
                          } 
                        ?>
                        </td> 

                    </tr>
                    <?php
                    $totdebitcdf=$totdebitcdf+$stotdebitcdf+$debitcdfCML;
                    $totcreditcdf=$totcreditcdf+$stotcreditcdf+$creditcdfCML;
                    $totdebitusd=$totdebitusd+$stotdebitusd+$debitusdCML;
                    $totcreditusd=$totcreditusd+$stotcreditusd+$creditusdCML;
                    $totsolde1=$totsolde1+$stotsolde1;
                    $totsolde2=$totsolde2+$stotsolde2;
                    $stotdebitcdf=0;
                    $stotdebitusd=0;
                    $stotcreditcdf=0;
                    $stotcreditusd=0;
                    }
                     }
                    }
                     ?>
                    </tbody>
                    <tfoot>
                      <tr>
                      <th colspan="3">TOTAL</th>
                      <th >
                      <?php 
                      if($totdebitcdf>0){ 
                      echo FormatChiffreCompta($totdebitcdf);
                      }
                      ?></th>
                      <th ><?php 
                      if($totcreditcdf>0){ 
                      echo FormatChiffreCompta($totcreditcdf);
                      }
                      ?></th>
                      <th ><?php 
                      if($totsolde1>0){ 
                      echo FormatChiffreCompta($totsolde1);
                      }
                      ?></th>
                      <th colspan="2"></th>
                      <th >
                        <?php 
                          if($totdebitusd>0){ 
                        echo FormatChiffreCompta($totdebitusd);
                        }
                        ?></th>
                      <th ><?php
                       if($totcreditusd>0){ 
                       echo FormatChiffreCompta($totcreditusd);
                        }
                       ?></th>
                      <th ><?php 
                         if($totsolde2>0){ 
                      echo FormatChiffreCompta($totsolde2);
                      }

                      ?></th>
                      </tr>
                    </tfoot>
                </table>
     <div id="entete25">
        <p align="center">
            <br>
        <span>Imprimé le  <?php echo date('d/m/Y'); ?> par </span>
        <b><?php echo strtoupper($_SESSION['nom_user'].' '.$_SESSION['prenom_user']); ?></b>
        </p>
    </div>
</div>
