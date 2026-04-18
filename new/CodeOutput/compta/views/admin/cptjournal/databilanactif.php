 <?php
 //Mise en session pour impression
$_SESSION['BilanType'] ='actif';
$_SESSION['BilanA'] = array();
$_SESSION['BilanA']['ref'] = array();
$_SESSION['BilanA']['actif'] = array();
$_SESSION['BilanA']['note'] = array();
$_SESSION['BilanA']['brut'] = array();
$_SESSION['BilanA']['amort'] = array();
$_SESSION['BilanA']['netn'] = array();
$_SESSION['BilanA']['netn1'] = array();
$_SESSION['BilanA']['afficher'] = array();

$brut=0;
$amort=0;
$netn=0;
$netn1=0;

$totalbrut=0;
$totalamort=0;
$totalnetn=0;
$totalnetn1=0;

$TAItotalbrut=0;
$TAItotalamort=0;
$TAItotalnetn=0;
$TAItotalnetn1=0;

$TACtotalbrut=0;
$TACtotalamort=0;
$TACtotalnetn=0;
$TACtotalnetn1=0;

$TTAtotalbrut=0;
$TTAtotalamort=0;
$TTAtotalnetn=0;
$TTAtotalnetn1=0;

$ECAbrut=0;
$ECAamort=0;
$ECAnetn=0;
$ECAnetn1=0;

$TGtotalbrut=0;
$TGtotalamort=0;
$TGtotalnetn=0;
$TGtotalnetn1=0;
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
$_SESSION['amortprov'] = array();
$_SESSION['amortprov']['id'] = array();
$_SESSION['saufamort'] = array();
$_SESSION['saufamort']['id'] = array();

$brutn=0;
$brutn1=0;
$amortn=0;
$amortn1=0;

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
$amortprov=explode(',',$rows->amortprov);
foreach ($amortprov as $value) {
$value=intval($value);
array_push($_SESSION['amortprov']['id'],$value);
}

$saufamort=explode(',',$rows->saufamort);
foreach ($saufamort as $value) {
$value=intval($value);
array_push($_SESSION['saufamort']['id'],$value);
}

//var_dump($_SESSION['brut']['id']);
//var_dump($_SESSION['saufbrut']['id']);


//calcul val brut
$nbre=count($_SESSION['brut']['id']);
for ($i = 0; $i <$nbre; $i++){
$format=(string)$_SESSION['brut']['id'][$i];
$format=strlen($format);
$compte_num=$_SESSION['brut']['id'][$i];
$compte_id=IDFromAccountNumber($_SESSION['brut']['id'][$i],$format,$bdd);
//echo "brut  ".$_SESSION['brut']['id'][$i];
//echo "compte_id  ".$compte_id;
$sld=$rows->solde;
$brutn=$brutn+CalculValeurBrut($devise,$compte_id,$compte_num,$format,$dte1n,$dte2n,$exercicesn,$site_id,$bdd,$sld);
$brutn1=$brutn1+CalculValeurBrut($devise,$compte_id,$compte_num,$format,$dte1n1,$dte2n1,$exercicesn1,$site_id,$bdd,$sld);


}
//calcul amort
$nbre=count($_SESSION['amortprov']['id']);
for ($i = 0; $i <$nbre; $i++){
$format=(string)$_SESSION['amortprov']['id'][$i];
$format=strlen($format);
$compte_num=$_SESSION['amortprov']['id'][$i];
$compte_id=IDFromAccountNumber($_SESSION['amortprov']['id'][$i],$format,$bdd);
$amortn=$amortn+CalculValeurAmort($devise,$compte_id,$compte_num,$format,$dte1n,$dte2n,$exercicesn,$site_id,$bdd);
$amortn1=$amortn1+CalculValeurAmort($devise,$compte_id,$compte_num,$format,$dte1n1,$dte2n1,$exercicesn1,$site_id,$bdd);

}
//End Important Treatment 


//Calcul total ecart de conversion actif
if ($rows->code=='ECA') {
$afficher=1;
$ECAbrut=$brutn;
$ECAamort=$amortn;
$ECAnetn=$brutn-$amortn;
$ECAnetn1=$brutn1-$amortn1;
//Mise en session
array_push($_SESSION['BilanA']['ref'],$rows->ref);
array_push($_SESSION['BilanA']['actif'],$rows->rubrique);
array_push($_SESSION['BilanA']['note'],$rows->note);
array_push($_SESSION['BilanA']['brut'],$ECAbrut);
array_push($_SESSION['BilanA']['amort'],$ECAamort);
array_push($_SESSION['BilanA']['netn'],$ECAnetn);
array_push($_SESSION['BilanA']['netn1'],$ECAnetn1);
array_push($_SESSION['BilanA']['afficher'],$afficher);

//Mise en session
$totalbrut=0;
$totalamort=0;
$totalnetn=0;
$totalnetn1=0;
}else{
//Calcul total ecart de conversion actif

$afficher=0;
$netn=$brutn-$amortn;
$netn1=$brutn1-$amortn1;
//Mise en session
array_push($_SESSION['BilanA']['ref'],$rows->ref);
array_push($_SESSION['BilanA']['actif'],$rows->rubrique);
array_push($_SESSION['BilanA']['note'],$rows->note);
array_push($_SESSION['BilanA']['brut'],$brutn);
array_push($_SESSION['BilanA']['amort'],$amortn);
array_push($_SESSION['BilanA']['netn'],$netn);
array_push($_SESSION['BilanA']['netn1'],$netn1);
array_push($_SESSION['BilanA']['afficher'],$afficher);

//Mise en session
$totalbrut+=$brut;
$totalamort+=$amort;
$totalnetn+=$netn;
$totalnetn1+=$netn1;
}
}

}elseif($rows->typeligne==2){
if ($rows->code=='TAI') {
$afficher=1;
$TAItotalbrut=$totalbrut;
$TAItotalamort=$totalamort;
$TAItotalnetn=$totalnetn;
$TAItotalnetn1=$totalnetn1;
//Mise en session
array_push($_SESSION['BilanA']['ref'],$rows->ref);
array_push($_SESSION['BilanA']['actif'],$rows->rubrique);
array_push($_SESSION['BilanA']['note'],$rows->note);
array_push($_SESSION['BilanA']['brut'],$TAItotalbrut);
array_push($_SESSION['BilanA']['amort'],$TAItotalamort);
array_push($_SESSION['BilanA']['netn'],$TAItotalnetn);
array_push($_SESSION['BilanA']['netn1'],$TAItotalnetn1);
array_push($_SESSION['BilanA']['afficher'],$afficher);

//Mise en session
$totalbrut=0;
$totalamort=0;
$totalnetn=0;
$totalnetn1=0;
}else if($rows->code=='TAC') {
$afficher=1;
$TACtotalbrut=$totalbrut;
$TACtotalamort=$totalamort;
$TACtotalnetn=$totalnetn;
$TACtotalnetn1=$totalnetn1;
//Mise en session
array_push($_SESSION['BilanA']['ref'],$rows->ref);
array_push($_SESSION['BilanA']['actif'],$rows->rubrique);
array_push($_SESSION['BilanA']['note'],$rows->note);
array_push($_SESSION['BilanA']['brut'],$TACtotalbrut);
array_push($_SESSION['BilanA']['amort'],$TACtotalamort);
array_push($_SESSION['BilanA']['netn'],$TACtotalnetn);
array_push($_SESSION['BilanA']['netn1'],$TACtotalnetn1);
array_push($_SESSION['BilanA']['afficher'],$afficher);

//Mise en session  
$totalbrut=0;
$totalamort=0;
$totalnetn=0;
$totalnetn1=0;
}else if($rows->code=='TTA') {
$afficher=1;
$TTAtotalbrut=$totalbrut;
$TTAtotalamort=$totalamort;
$TTAtotalnetn=$totalnetn;
$TTAtotalnetn1=$totalnetn1;
//Mise en session
array_push($_SESSION['BilanA']['ref'],$rows->ref);
array_push($_SESSION['BilanA']['actif'],$rows->rubrique);
array_push($_SESSION['BilanA']['note'],$rows->note);
array_push($_SESSION['BilanA']['brut'],$TTAtotalbrut);
array_push($_SESSION['BilanA']['amort'],$TTAtotalamort);
array_push($_SESSION['BilanA']['netn'],$TTAtotalnetn);
array_push($_SESSION['BilanA']['netn1'],$TTAtotalnetn1);
array_push($_SESSION['BilanA']['afficher'],$afficher);

//Mise en session  
$totalbrut=0;
$totalamort=0;
$totalnetn=0;
$totalnetn1=0;
}else if($rows->code=='TG') {
$afficher=1;
$TGtotalbrut=$TAItotalbrut+$TACtotalbrut+$TTAtotalbrut+$ECAbrut;
$TGtotalamort=$TAItotalamort+$TACtotalamort+$TTAtotalamort+$ECAamort;
$TGtotalnetn=$TAItotalnetn+$TACtotalnetn+$TTAtotalnetn+$ECAnetn;
$TGtotalnetn1=$TAItotalnetn1+$TACtotalnetn1+$TTAtotalnetn1+$ECAnetn1;
//Mise en session
array_push($_SESSION['BilanA']['ref'],$rows->ref);
array_push($_SESSION['BilanA']['actif'],$rows->rubrique);
array_push($_SESSION['BilanA']['note'],$rows->note);
array_push($_SESSION['BilanA']['brut'],$TGtotalbrut);
array_push($_SESSION['BilanA']['amort'],$TGtotalamort);
array_push($_SESSION['BilanA']['netn'],$TGtotalnetn);
array_push($_SESSION['BilanA']['netn1'],$TGtotalnetn1);
array_push($_SESSION['BilanA']['afficher'],$afficher);

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
                    <th rowspan="2"  style="text-align: center;">ACTIF</th>
                    <th rowspan="2"  style="text-align: center;">NOTE</th>  
                    <th colspan="3"  style="text-align: center;"><?php echo strtoupper($exercicesnlib);?></th>
                    <th style="text-align: center;"><?php echo strtoupper($exercicesn1lib);?></th>
                </tr>
                <tr>
                    <th  style="text-align: center;" >Brut</th>
                    <th  style="text-align: center;">Amort/Dépréc</th>
                    <th  style="text-align: center;" >Net</th>
                    <th  style="text-align: center;">Net</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $nbArticles = count($_SESSION['BilanA']['ref']);
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                ?>
                <tr>
                    <td style="text-align: center;"><?php echo $_SESSION['BilanA']['ref'][$i];?></td>
                    <td class="col-md-4"><?php echo $_SESSION['BilanA']['actif'][$i];?></td>
                    <td style="text-align: center;"><?php echo $_SESSION['BilanA']['note'][$i];?></td>
                    <td class="col-md-2"><?php if($_SESSION['BilanA']['brut'][$i]>0||$_SESSION['BilanA']['brut'][$i]<0||$_SESSION['BilanA']['afficher'][$i]==1){echo FormatChiffreCompta($_SESSION['BilanA']['brut'][$i]);}; ?></td>
                    <td class="col-md-2"><?php if($_SESSION['BilanA']['amort'][$i]>0||$_SESSION['BilanA']['amort'][$i]<0||$_SESSION['BilanA']['afficher'][$i]==1){echo FormatChiffreCompta($_SESSION['BilanA']['amort'][$i]);}; ?></td>
                    <td class="col-md-2"><?php if($_SESSION['BilanA']['netn'][$i]>0||$_SESSION['BilanA']['netn'][$i]<0||$_SESSION['BilanA']['afficher'][$i]==1){echo FormatChiffreCompta($_SESSION['BilanA']['netn'][$i]);}; ?></td>
                    <td class="col-md-6"><?php if($_SESSION['BilanA']['netn1'][$i]>0||$_SESSION['BilanA']['netn1'][$i]<0||$_SESSION['BilanA']['afficher'][$i]==1){echo FormatChiffreCompta($_SESSION['BilanA']['netn1'][$i]);}; ?></td>
                </tr>
              <?php
                   }
                 ?>
            </tbody>
        </table>
</div>