 <?php
 //Mise en session pour impression
$_SESSION['BilanP'] = array();
$_SESSION['BilanP']['ref'] = array();
$_SESSION['BilanP']['passif'] = array();
$_SESSION['BilanP']['note'] = array();
$_SESSION['BilanP']['netn'] = array();
$_SESSION['BilanP']['netn1'] = array();
$_SESSION['BilanP']['afficher'] = array();
$netn=0;
$netn1=0;
$totalnetn=0;
$totalnetn1=0;
$totcapitauxn=0;
$totcapitauxn1=0;
$totdettesn=0;
$totdettesn1=0;
$totressourcesn=0;
$totressourcesn1=0;
$totpassifn=0;
$totpassifn1=0;
$tottresorerien=0;
$tottresorerien1=0;
$tecartconversionn=0;
$tecartconversionn1=0;
$totgeneraln=0;
$totgeneraln1=0;

//fin mise en session
foreach ($result as $rows) {

if($rows->typeligne==-1||$rows->typeligne==0||$rows->typeligne==1) {

if($rows->compte_id!='') {
//Important Treatment 
$_SESSION['totalbrut']=0;
$_SESSION['totalamort']=0;
$_SESSION['brut'] = array();
$_SESSION['brut']['id'] = array();
$_SESSION['saufbrut'] = array();
$_SESSION['saufbrut']['id'] = array();
$valeurn=0;
$valeurn1=0;
$compte_id=explode(',',$rows->compte_id);
foreach ($compte_id as $value) {
$value=intval($value);
array_push($_SESSION['brut']['id'],$value);
}
$saufbrut=explode(',',$rows->saufbrut);
foreach ($saufbrut as $value) {
$value=intval($value);
array_push($_SESSION['saufbrut']['id'],$value);
}
//calcul val brut
$nbre=count($_SESSION['brut']['id']);
for ($i = 0; $i <$nbre; $i++){
$format=(string)$_SESSION['brut']['id'][$i];
$format=strlen($format);
$compte_num=$_SESSION['brut']['id'][$i];
$compte_id=IDFromAccountNumber($_SESSION['brut']['id'][$i],$format,$bdd);
//echo "brut  ".$_SESSION['brut']['id'][$i];
//echo "compte_id  ".$compte_id;
$valeurn=$valeurn+CalculValeurBrut($devise,$compte_id,$compte_num,$format,$dte1n,$dte2n,$exercicesn,$site_id,$bdd);
$valeurn1=$valeurn1+CalculValeurBrut($devise,$compte_id,$compte_num,$format,$dte1n1,$dte2n1,$exercicesn1,$site_id,$bdd);
}

//End Important Treatment 


//Calcul total ecart de conversion actif
if ($rows->code=='ECP') {
$afficher=1;
$ECAnetn=$valeurn;
$ECAnetn1=$valeurn1;
//Mise en session
array_push($_SESSION['BilanP']['ref'],$rows->ref);
array_push($_SESSION['BilanP']['passif'],$rows->rubrique);
array_push($_SESSION['BilanP']['note'],$rows->note);
array_push($_SESSION['BilanP']['netn'],$ECAnetn);
array_push($_SESSION['BilanP']['netn1'],$ECAnetn1);
array_push($_SESSION['BilanP']['afficher'],$afficher);

//Mise en session
$totalnetn=0;
$totalnetn1=0;
}else{
//Calcul total ecart de conversion actif

$afficher=0;
$netn=$valeurn;
$netn1=$valeurn1;
//Mise en session
array_push($_SESSION['BilanP']['ref'],$rows->ref);
array_push($_SESSION['BilanP']['passif'],$rows->rubrique);
array_push($_SESSION['BilanP']['note'],$rows->note);
array_push($_SESSION['BilanP']['netn'],$netn);
array_push($_SESSION['BilanP']['netn1'],$netn1);
array_push($_SESSION['BilanP']['afficher'],$afficher);

//Mise en session
$totalnetn+=$netn;
$totalnetn1+=$netn1;
}
}

}elseif($rows->typeligne==2){
if ($rows->code=='TCPRA') {
$afficher=1;
$totcapitauxn=$totalnetn;
$totcapitauxn1=$totalnetn1;
//Mise en session
array_push($_SESSION['BilanP']['ref'],$rows->ref);
array_push($_SESSION['BilanP']['passif'],$rows->rubrique);
array_push($_SESSION['BilanP']['note'],$rows->note);
array_push($_SESSION['BilanP']['netn'],$totcapitauxn);
array_push($_SESSION['BilanP']['netn1'],$totcapitauxn1);
array_push($_SESSION['BilanP']['afficher'],$afficher);
//Mise en session
$totalnetn=0;
$totalnetn1=0;
}else if($rows->code=='TDFRA') {
$afficher=1;
$totdettesn=$totalnetn;
$totdettesn1=$totalnetn1;
//Mise en session
array_push($_SESSION['BilanP']['ref'],$rows->ref);
array_push($_SESSION['BilanP']['passif'],$rows->rubrique);
array_push($_SESSION['BilanP']['netn'],$totdettesn);
array_push($_SESSION['BilanP']['netn1'],$totdettesn1);
array_push($_SESSION['BilanP']['afficher'],$afficher);
//Mise en session  
$totalnetn=0;
$totalnetn1=0;
}else if($rows->code=='TPC') {
$afficher=1;
$totpassifn=$totalnetn;
$totpassifn1=$totalnetn1;
//Mise en session
array_push($_SESSION['BilanP']['ref'],$rows->ref);
array_push($_SESSION['BilanP']['passif'],$rows->rubrique);
array_push($_SESSION['BilanP']['note'],$rows->note);
array_push($_SESSION['BilanP']['netn'],$totpassifn);
array_push($_SESSION['BilanP']['netn1'],$totpassifn1);
array_push($_SESSION['BilanP']['afficher'],$afficher);
//Mise en session  
$totalnetn=0;
$totalnetn1=0;
}else if($rows->code=='TTP') {
$afficher=1;
$tottresorerien=$totalnetn;
$tottresorerien1=$totalnetn1;
//Mise en session
array_push($_SESSION['BilanP']['ref'],$rows->ref);
array_push($_SESSION['BilanP']['passif'],$rows->rubrique);
array_push($_SESSION['BilanP']['note'],$rows->note);
array_push($_SESSION['BilanP']['netn'],$totalnetn);
array_push($_SESSION['BilanP']['netn1'],$totalnetn1);
array_push($_SESSION['BilanP']['afficher'],$afficher);
//Mise en session  
$totalnetn=0;
$totalnetn1=0;
}else if($rows->code=='TGP') {
$afficher=1;
$totgeneraln=$totcapitauxn+$totdettesn+$totpassifn+$tottresorerien+$ECAnetn;
$totgeneraln1=$totcapitauxn1+$totdettesn1+$totpassifn1+$tottresorerien1+$ECAnetn1;
//Mise en session
array_push($_SESSION['BilanP']['ref'],$rows->ref);
array_push($_SESSION['BilanP']['passif'],$rows->rubrique);
array_push($_SESSION['BilanP']['note'],$rows->note);
array_push($_SESSION['BilanP']['netn'],$totgeneraln);
array_push($_SESSION['BilanP']['netn1'],$totgeneraln1);
array_push($_SESSION['BilanP']['afficher'],$afficher);

//Mise en session 
}


}


}
//var_dump($_SESSION['BilanA']);

  ?>
<div class="col-lg-12 table-responsive">
    <table data-page="false" class="table table-bordered table-hover table-striped table-condensed t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE;?>" data-page-previous-text="<?php echo LANG_PREVIOUS;?>" data-page-next-text="<?php echo LANG_NEXT;?>">
            <thead>
                <tr>
                    <th rowspan="2"  style="text-align: center;">REF</th>
                    <th rowspan="2"  style="text-align: center;">LIBELLES</th>
                    <th rowspan="2"  style="text-align: center;"></th>  
                    <th rowspan="2"  style="text-align: center;">NOTE</th>  
                    <th style="text-align: center;">EXERCICE AU N</th>
                    <th style="text-align: center;">EXERCICE AU N-1</th>
                </tr>
                <tr>
                    <th  style="text-align: center;">Net</th>
                    <th  style="text-align: center;">Net</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $nbArticles = count($_SESSION['BilanP']['ref']);
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                                      ?>
                <tr>
                    <td><?php echo $_SESSION['BilanP']['ref'][$i];?></td>
                    <td class="col-md-6"><?php echo $_SESSION['BilanP']['passif'][$i];?></td>
                    <td style="text-align: center;"><?php echo $_SESSION['BilanP']['note'][$i];?></td>
                    <td style="text-align: center;"><?php echo $_SESSION['BilanP']['note'][$i];?></td>
                    <td class="col-md-3"><?php if($_SESSION['BilanP']['netn'][$i]>0||$_SESSION['BilanP']['netn'][$i]<0||$_SESSION['BilanP']['afficher'][$i]==1){echo arrondir($_SESSION['BilanP']['netn'][$i]);}; ?></td>
                    <td class="col-md-3"><?php if($_SESSION['BilanP']['netn'][$i]>0||$_SESSION['BilanP']['netn'][$i]<0||$_SESSION['BilanP']['afficher'][$i]==1){echo arrondir($_SESSION['BilanP']['netn'][$i]);}; ?></td>
                </tr>
              <?php
                   }
                 ?>
            </tbody>
        </table>
</div>