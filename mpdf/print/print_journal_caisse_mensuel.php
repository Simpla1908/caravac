<?php
session_start();
include_once"../mpdf60/mpdf.php";


//   include '../../bdd/connexion.php';
//       
//$html = '
//
//<center><h3>TITLE</h3></center>
//<center>
//<table border="1">
//<tr>
//    <th>COLUMN 1</th><th>COLUMN 2</th>
//</tr>';
//   $taux = $bdd->prepare("SELECT * FROM t_client");
//				$taux->execute();
//	$html1='';			
//				while ($donnees = $taux->fetch())
//				{						
//					$id_client = $donnees['id_client'];
//                                        $nom_client = $donnees['nom_client'];
//				
//
//        $html1=$html1.'<tr><td>'.$id_client.'</td><td>'.$nom_client.'</td></tr>';
//                
//        
//                                }
//
//$html2='</table></center>';
//
//$html5 =$html.$html1.$html2;
session_start();
include '../../bdd/connexion.php';
include '../../Caisse/Traitement/impression_journal_caisse.php';


$html2='<style>
#titre
{
   margin-bottom:35px;
   margin-top:60px;
}
#table
{

    border:1px solid #dbd9d9;  
	border-collapse:collapse;

}
#table th
{
 background-color:#ccc;
 border:1px solid #000;
 height:20px;
 padding-left:5px;
 padding-right:5px;
}
#table td{
	_border:1px solid #adabab;
	height:20px;
	_width:80px;
}
#table tr:nth-child(even) {
  
   _background: rgb(240, 240, 240);
}


#pied
{
   border-top :1px solid #000;
   height:50px;
   width:100%;
   text-align:center;
   margin-top:560px;
}

h2 {	font-weight: bold; font-size: 12pt; color: #000066; 
			font-family: \'DejaVu Sans Condensed\'; margin-top: 6pt; margin-bottom: 6pt;
                        border-bottom: 0.03cm solid #000000; 
			text-align: ;  text-transform:uppercase; page-break-after:avoid; }
</style>';



$html2= $html2.'<div id="content">
    <br><br>
    <table width="100%" style="font-family: serif; font-size: 9pt; color: #000088;">
        <tr>
            <td width="33%" align="center">
                <h2>
                    JOURNAL DE CAISSE '. strtoupper($type_op).
            '(';
                 switch ($mois) {
        case 1 :
            $html2= $html2.'Janvier';
            break;
        case 2 :
           $html2= $html2.'Février';
            break;
        case 3 :
            $html2= $html2. 'Mars';
            break;
        case 4 :
            $html2= $html2. 'Avril';
            break;
        case 5 :
            $html2= $html2. 'Mai';
            break;
        case 6 :
            $html2= $html2. 'Juin';
            break;
        case 7 :
            $html2= $html2.'Juillet';
            break;
        case 8 :
            $html2= $html2. 'Août';
            break;
        case 9 :
            $html2= $html2. 'Septembre';
            break;
        case 10 :
            $html2= $html2. 'Octobre';
            break;
        case 11 :
            $html2= $html2. 'Novembre';
            break;
        case 12 :
            $html2= $html2.'Décembre';
            break;
    }
    $html2= $html2.')
                </h2>
                <br>
                <strong>(Situation en '; if ($monnaie == "usd&fc") {$html2= $html2. 'USD & CDF';}elseif ($monnaie == "usd") {$html2= $html2. 'USD';}  else {$html2= $html2. 'CDF';} $html2= $html2.')</strong>
            </td>
        </tr>
    </table>
    <br>
   <table width="100%" border="1" align="center" id="table">
        <thead>
            <tr>
                <th width="5%" align="center" valign="middle">N°</th>
                <th width="20%" align="center" valign="middle">Motif</th>
                <th width="21%" align="center" valign="middle">Libellé </th>
                <th width="27%" align="center" valign="middle">Entrées </th>
                <th width="27%" align="center" valign="middle">Sorties </th>          
            </tr>
        </thead>
        <tbody>';
          
                $i = 1;
                $j = 1;
                foreach ($journal_caisse_mensuels as $operation):
                    
                    $html2=$html2.'<tr> 	
                        <td valign="middle">&nbsp;&nbsp;'. $i.'</td>
                        <td  valign="middle">&nbsp;&nbsp;'. ucfirst($operation->designation).'</td>
                        <td  valign="middle">&nbsp;&nbsp;'.ucfirst($operation->libelle).'</td>
                        <td valign="middle">&nbsp;&nbsp;';
                                if ($operation->type=="entree") {
                                    if ($monnaie == "usd&fc") {
                                            $html2=$html2. number_format($operation->montantUSD, 0, '', '.') . ' $' . ' / ' . number_format($operation->montantFC, 0, '', '.') . ' FC';
                                    }elseif ($monnaie == "usd") {
                                            $html2=$html2. number_format($operation->montantUSD, 0, '', '.') . ' $';
                                    }  else {
                                            $html2=$html2. number_format($operation->montantFC, 0, '', '.')  . ' FC';
                                    }
                                } else {
                                    $j=0;
                                    $html2=$html2. ' ';
                                }
                        $html2=$html2.'</td>
                        <td valign="middle">&nbsp;&nbsp;';
                                if ($operation->type == "sortie") {
                                    if ($monnaie == "usd&fc") {
                                            $html2=$html2. number_format($operation->montantUSD , 0, '', '.'). ' $' . ' / ' . number_format($operation->montantFC, 0, '', '.') . ' FC';
                                    }elseif ($monnaie == "usd") {
                                            $html2=$html2. number_format($operation->montantUSD , 0, '', '.'). ' $';
                                    }  else {
                                            $html2=$html2. number_format($operation->montantFC, 0, '', '.') . ' FC';
                                    }
                                } else {
                                    $j=0;
                                    $html2=$html2. ' ';
                                }
                        $html2=$html2.'</td>
                        

                    </tr>';
                    $i++;
                  endforeach;
                
        $html2=$html2.'</tbody>
        <tfoot>
                <tr>
                    <td colspan="3" align="center" valign="middle"><strong>TOTAL&nbsp;:</strong></td>
                    <td align="center" valign="middle">
                        <strong>'; 
                               if ($j!=1) {
                                   if ($monnaie == "usd&fc") {
                                            $html2=$html2. number_format($montantUSD_entree_mois , 0, '', '.'). ' $' . ' / ' . number_format($montantFC_entree_mois, 0, '', '.') . ' FC';
                                    }elseif ($monnaie == "usd") {
                                            $html2=$html2. number_format($montantUSD_entree_mois, 0, '', '.') . ' $';
                                    }  else {
                                            $html2=$html2. number_format($montantFC_entree_mois , 0, '', '.'). ' FC';
                                    }           
                               }  else {
                                     if ($monnaie == "usd&fc") {
                                            $html2=$html2.  '0 $' . ' / '. '0 FC';
                                    }elseif ($monnaie == "usd") {
                                            $html2=$html2.  '0 $';
                                    }  else {
                                            $html2=$html2. '0 FC';
                                    }
                                }
                            
                            
                        $html2=$html2.'</strong>
                    </td>
                    <td align="center" valign="middle">
                        <strong>';
                               if ($j!=1) {
                                   if ($monnaie == "usd&fc") {
                                            $html2=$html2. number_format($montantUSD_sortie_mois, 0, '', '.') . ' $' . ' / ' . number_format($montantFC_sortie_mois, 0, '', '.') . ' FC';
                                    }elseif ($monnaie == "usd") {
                                            $html2=$html2. number_format($montantUSD_sortie_mois, 0, '', '.') . ' $';
                                    }  else {
                                            $html2=$html2. number_format($montantFC_sortie_mois, 0, '', '.') . ' FC';
                                    }
                                }  else {
                                     if ($monnaie == "usd&fc") {
                                            $html2=$html2.  '0 $' . ' / '. '0 FC';
                                    }elseif ($monnaie == "usd") {
                                            $html2=$html2.  '0 $';
                                    }  else {
                                            $html2=$html2. '0 FC';
                                    }
                                }
                            
                            
                        $html2=$html2.'</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="center" valign="middle"><strong>SOLDE&nbsp;:</strong></td>
                    <td colspan="2" align="center" valign="middle">
                        <strong>';
                            if ($monnaie == "usd&fc") {
                                $html2=$html2. number_format($balance_usd_mois, 0, '', '.'). ' $' . ' / ' .number_format($balance_fc_mois, 0, '', '.'). ' FC';
                            }elseif ($monnaie == "usd") {
                                    $html2=$html2. number_format($balance_usd_mois, 0, '', '.') . ' $';
                            }  else {
                                    $html2=$html2. number_format($balance_fc_mois, 0, '', '.'). ' FC';
                            }
                            
                        $html2=$html2.'</strong>
                    </td>
                </tr>
            </tfoot>
    </table>
 </div>';

$header = '
<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>
<td width="50%" align="left"><img src="../../img/logoKB1.png" /></td>
<td width="50%" align="right">Page <span style="font-size:14pt;">{PAGENO}</span></td>
</tr></table>
';

$footer = '<div align="center" style="color:blue;font-family:mono;font-size:18pt;font-weight:bold;font-style:italic;border-top: 0.03cm solid #000000;">{DATE j-m-Y} &raquo; '.$_SESSION['nom_hotel'].'</div>';

$mpdf=new mPDF('c','A4'); 
$mpdf->SetDisplayMode('fullpage');

$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);

$mpdf->WriteHTML($html2);
$mpdf->Output("Journal de caisse mensuel.pdf","I");
?>


