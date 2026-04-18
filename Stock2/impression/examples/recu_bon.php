<?php
session_start();
include '../../bdd/connexion.php';
include '../../Traitement/operation_motif_edit.php';
//include('../../ChiffresEnLettres.php');
//$lettre = new ChiffreEnLettre();
$be_id=$_GET['id'];
$operation_motifs=  getoperation_motif($be_id,$bdd);
foreach ($operation_motifs as $operation):
    $numBon= $operation->numBon;
    $montantFC=$operation->montantFC;
    $montantUSD=$operation->montantUSD;
    $beneficiaire= $operation->beneficiaire;
    $designation=$operation->designation;
endforeach;

?>
<style>
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
        width:720px;
        margin:auto;
        margin-top:20px;

    }
    #chiffre
    {
        position:relative; 
        top:-352px; 
        left:500px; 
        border:1px solid #000; 
        width:200px; 
        padding:2px; 
        font-weight:bold; 
        font-size:16px; 
        background-color:#CCC;

    }
    #nom
    {
        position:relative; 
        top:65px; 
        left:145px; 
        border-bottom:1px solid #000; 
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
        border:1px solid #000; 
        width:577px; 
        padding:2px; 
        padding-left:10px;
        font-weight:bold; 
        font-size:18px; 
        background-color:#CCC;

    }
    #lettre_fc
    {
        position:relative; 
        top:8px; 
        left:28px; 
        border:1px solid #000; 
        width:665px; 
        padding:2px; 
        padding-left:10px;
        font-weight:bold; 
        font-size:18px; 
        background-color:#CCC;

    }
    #pour
    {
        position:relative; 
        top:12px; 
        left:63px; 
        border-bottom:1px solid #000; 
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
<page format="105x200" orientation="L" backcolor="#fff" style="font: arial;">
    <div id="content">
        <table id="tab_title" border="0" width="700" align="center">
            <tr height="35">
                <td height="27" colspan="4" >

                </td>
            </tr>
            <tr>
                <td height="73" colspan="4" valign="top" align="center">
                <u><h3>
                    <strong>BON D'ENTREE STOCK N°<?php echo ' '.$numBon;?></strong>
                     
                </h3></u>
        </td>
            </tr>

            <tr>
                <td width="142" height="21">Reçu de Mr / Mme :</td>
                <td colspan="3"></td>

            </tr>
            <tr>
                <td colspan="4" height="10">  </td>

            </tr>
            <tr>
                <td height="21" style="width:120px;">La somme de: </td>
                <td width="171"  ></td>
                <td width="259" style="width:100px;"></td>
                <td width="110"></td>
            </tr>
            <tr>
                <td colspan="4" height="35">  </td>

            </tr>
            <tr>
                <td height="21">Pour:</td>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td height="14"></td>
                <td colspan="3">

                </td>
            </tr>
            <tr>

                <td colspan="4"></td>
            </tr>
            <tr>
                <td colspan="4" height="20">  </td>

            </tr>
            <tr>

                <td colspan="4">
                    <span style="margin-left:100px; font-weight:bold;"> La Direction</span> 
                    <span style="margin-left:280px; font-weight:bold;"> Le(la) Caissier(e)</span></td>
            </tr>
            <tr>

                <td height="14" colspan="4" style="height:40px;"></td>

            </tr>
            <tr>
                <td colspan="4" height="15">  </td>

            </tr>
        </table>
    </div>
    <div id="chiffre" style="" align="center">
        <?php
            if (!empty($montantUSD)&& !empty($montantFC)) {
                echo $montantUSD . ' $ / '.$montantFC.' Fc';
            }elseif (!empty($montantFC)) {
             echo $montantFC. ' Fc';
           }
            else {
                echo $montantUSD. ' $';
            }
        ?> 
    </div>
    <div id="nom" style="" align="left"><i><?php echo $beneficiaire;?></i></div>
    <div id="lettre_usd" style="" align="center">
        <i><?php
        if (empty($montantUSD)) {
            echo '  ';
        } else {
            echo $lettre->Conversion($montantUSD) . ' ' . ' Dollar';
        }
        ?></i>
    </div>
    <div id="lettre_fc" style="" align="center">
        <i>
            <?php
            if (!empty($montantFC)) {
                echo $lettre->Conversion($montantFC) . ' ' . ' Fc';
            } else if (!empty($montantFC)) {
                echo $lettre->Conversion($montantFC) . ' ' . ' Fc';
            } else {
                echo '  ';
            }
            ?>
        </i>
    </div>
    <div id="pour" style="" align="left"><i><?php echo $designation;?></i></div>
    <div id="date">
        Fait à Kinshasa, le  <?php echo $date = date('d/m/Y');
        unset($_SESSION['operation_last_id']);
            ?>
    </div>
</page>
<?php
$content = ob_get_clean();

// convert
require_once(dirname(__FILE__) . '/../html2pdf.class.php');
try {
    $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 0);
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('ticket.pdf');
} catch (HTML2PDF_exception $e) {
    echo $e;
    exit;
}

