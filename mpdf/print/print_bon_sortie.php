<?php
include_once"../mpdf60/mpdf.php";
session_start();
include '../../bdd/connexion.php';
include '../../Caisse/Traitement/operation_motif_edit.php';
include("Numbers/Words.php");
$nw = new Numbers_Words();
$be_id=$_GET['id'];
$operation_motifs=  getoperation_motif($be_id,$bdd);
foreach ($operation_motifs as $operation):
    $numBon= $operation->numBon;
    $montantFC=$operation->montantFC;
    $montantUSD=$operation->montantUSD;
    $beneficiaire= $operation->beneficiaire;
    $designation=$operation->designation;
endforeach;
echo $numBon.'_'.$montantFC.'_'.$montantUSD.'_'.$beneficiaire.'_'.$designation;
echo 'bonjour';
?>
<?php
$html='<style>
    #tab_title
    {

        /*font-weight:bold;*/
        _font-family:Segoe UI Light;
    }
    #label
    {
        _position:absolute;
        _z-index:1;
        margin-top:20px;
        margin-left:530px;
        /*font-weight:bold;*/
    }
    #content
    {
        border:1px solid #000;
        height:330px;
        width:800px;
        margin:auto;
        margin-top:20px;
        padding:8px;

    }
    #chiffre
    {
        position:relative; 
        top:-352px; 
        left:500px; 
        width:500px; 
        padding:15px; 
        font-weight:bold; 
        font-size:16px; 
        background-color:#CCCCCC;

    }
    #nom
    {
        position:relative; 
        top:65px; 
        left:145px; 
        width:538px; 
        padding:2px; 
        padding-left:20px;
        font-weight:bold; 
        font-size:18px; 
        /*background-color:#CCC;*/

    }
    #lettre_usd
    {
        position:relative; 
        top:20px; 
        left:115px; 
        width:577px; 
        font-weight:bold; 
        font-size:18px; 

    }
    #lettre_fc
    {
        position:relative; 
        top:8px; 
        left:28px;  
        width:665px; 
        padding:2px; 
        padding-left:10px;
        font-weight:bold; 
        font-size:18px; 

    }
    #pour
    {
        position:relative; 
        top:12px; 
        left:63px; 
        width:555px; 
        padding:2px; 
        padding-left:80px;
        font-weight:bold; 
        font-size:18px; 
        /*background-color:#CCC;*/

    }
    #date
    {
        position:relative; 
        top:30px; 
        left:460px; 
        /*border:1px solid #000; */
        width:200px; 
        padding:2px; 

    }
</style>
    <div id="content">
        <table id="tab_title" border="0" width="700" align="center">
            <tr height="35">
            <td height="27" colspan="2"><img src="../../img/logoKB1.png" /></td>
            <td height="27"></td>
                <td height="27" width="70" align="right">
                    <div id="chiffre" style="" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    if (!empty($montantUSD)&& !empty($montantFC)) {
              $html=$html.number_format($montantUSD, 0, '', '.') . ' $ '.number_format($montantFC, 0, '', '.').' Fc';
            }elseif (!empty($montantFC)) {
            $html=$html.number_format($montantFC, 0, '', '.'). ' Fc';
           }
            else {
            $html=$html.number_format($montantUSD, 0, '', '.').' $';
            }
            $html=$html.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                </td>
            </tr>
            <tr>
                <td height="52" colspan="4" align="center">
                <u><h3>
                    <strong>BON DE SORTIE CAISSE N°'.$numBon.'</strong>
                     
                </h3></u>
        </td>
            </tr>

            <tr>
                <td width="142" height="11">Reçu de Mr / Mme :</td>
                <td colspan="3" width="550" style="border-bottom:1px solid #000;">
                    <div id="nom" style="" align="left"><i>'.  ucwords($beneficiaire).'</i></div>
                </td>

            </tr>
            <tr>
                <td colspan="4" height="10">  </td>

            </tr>
            <tr>
                <td height="21" style="width:120px;">La somme de: </td>
                <td colspan="3" width="550" bgcolor="#CCCCCC" bordercolor="#000000" align="center">
                    <div id="lettre_usd" style="" align="center"><i>';
                    if (empty($montantUSD)) {
                        $html=$html.' ';
                     } else {
                        $html=$html.ucfirst($nw->toWords($montantUSD)) . ' ' . ' Dollar';
                     }
            $html=$html.'</i></div>
                </td>
            </tr>
            <tr bgcolor="#CCCCCC">
                <td colspan="4" height="25" align="center"> 
                    <div id="lettre_fc" style="" align="center">
                        <i>';
                            if (!empty($montantFC)) {
                                $html=$html.ucfirst($nw->toWords($montantFC)) . ' ' . ' Fc';
                           } else if (!empty($montantFC)) {
                                $html=$html.ucfirst($nw->toWords($montantFC)) . ' ' . ' Fc';
                           } else {
                               $html=$html.' ';
                           }

                      $html=$html.' </i>
                   </div>
                </td>
            </tr>
            <tr height="6">
                <td height="6"></td>
                <td colspan="3">

                </td>
            </tr>
            <tr>
                <td height="21" width="25">Motif de depense:</td>
                <td colspan="3" width="550" style="border-bottom:1px solid #000;">
                    <div id="pour" style="" align="left"><i>'
                    .ucfirst($designation).'</i></div>
                </td>
            </tr>
            <tr>
                <td height="10"></td>
                <td colspan="3">

                </td>
            </tr>
            <tr>
                <td colspan="4" height="15" align="right"> 
                    <div id="date">
                        Fait à Kinshasa, le'.date('d/m/Y').'

                    </div>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <span style="margin-left:100px; font-weight:bold;"> La Direction</span> 
                </td>
                <td align="center">
                    <span style="margin-left:100px; font-weight:bold;"> Visa de la Direction</span> 
                </td>
                <td colspan="2" align="center">
                    <span style="margin-left:280px; font-weight:bold;"> Le(la) Caissier(e)</span>
                </td>
            </tr>
            
        </table>
    </div>';
     unset($_SESSION['operation_last_id']);    
    
   $mpdf=new mPDF('utf-8', array(200,105)); 
$mpdf->SetDisplayMode('fullpage');

$mpdf->WriteHTML($html);


$mpdf->Output("Bon_Sortie_Caisse.pdf","I");
?>


