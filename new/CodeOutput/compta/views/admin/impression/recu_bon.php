<?php
if (!isset($_SESSION)) {
    session_start();
}
$lettre = new Numbers_Words();
$requete = $bdd->prepare("SELECT * FROM t_operation AS op WHERE op.hotel_id=:hotel_id AND op.idoperation=:idoperation");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':idoperation',$idoperation);
$requete->execute();
$operation_motifs = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($operation_motifs as $operation):
    $numBon= $operation->numBon;
    $montantFC=round($operation->montantFC,2);
    $montantUSD=round($operation->montantUSD,2);
    $beneficiaire= $operation->beneficiaire;
    $designation=$operation->libelle;
    $datebon=$operation->date_bon;
    $compte_id=$operation->motif_id;
    $format=$operation->format;

endforeach;
$data=INFOSFromAccountNumber($compte_id,$format,$bdd);
$libcompte=$data['lib'];
$tmp = explode("-",$datebon);
$date_iso = $tmp[2] . "/" . $tmp[1] . "/" . $tmp[0];
$src='public/uploads/'.$logo
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
        height:400px;
        width:720px;
        margin:auto;
        margin-top:20px;
        padding: 10px;

    }
    #chiffre
    {
/*        position:relative; 
        top:-352px; 
        left:500px; */
        border:1px solid #000; 
        width:350px; 
        padding:10px; 
        font-weight:bold; 
        font-size:16px; 
        background-color:#CCC;

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
<!--<page format="130x200" orientation="L" backcolor="#fff" style="font: arial;">-->
    <div id="content">
        <table id="tab_title" border="0" width="780" align="center">
            <tr>
                <td>
                    <img src="<?php echo $src;?>" height="70" width="80"/>
                    
                </td>
                <td>
                    
                </td>
                <td colspan="2" align="right">
                    <div style="border: 1px solid #ffffff; width: 300px; padding: 3px; padding-left: 8px;">
                        <strong>   <?php echo strtoupper($nomcomp);?>.</strong><br />
                        ID-Nat : <?php echo $idnat;?> -- RCCM : <?php echo $rccm;?>
                        <br />
                        Téléphone : <?php echo $telephone;?> -- Email : <?php echo $email_compagny;?>
                    </div>
<!--                    <div style="border: 1px solid #ffffff; width: 200px; margin-top: -80px; margin-left: 305px; padding: 3px;">
                        <strong>   <?php echo strtoupper($nom_hotel);?>.</strong>
                        <br /><br />
                        Adresse : <?php echo $adresse_hotel;?>
                        <br />
                        Ville : <?php echo $ville_hotel;?>
                        <br />
                        Province : <?php echo $province_hotel;?>
                    </div>-->
                </td>
<!--                <td>
                    <div id="chiffre" style="" align="center">
                        
                    </div>
                </td>-->
            </tr>
            <tr>
                <td height="50" colspan="4" align="center">
                    <u><h3> <strong>BON D'ENTREE CAISSE N°<?php echo ' '.$numBon;?></strong></h3></u>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td align="center" bgcolor="#CCCCCC" width="100"><strong>
                    <?php
                        if (!empty($montantUSD)&& !empty($montantFC)) {
                            echo $montantUSD . ' USD / '.$montantFC.' CDF';
                        }elseif (!empty($montantFC)) {
                         echo $montantFC. ' CDF';
                       }
                        else {
                            echo $montantUSD. ' USD';
                        }
                    ?> 
                </strong></td>
            </tr>
            <tr>
                <td colspan="4" height="10">  </td>
            </tr>
            <tr>
                <td width="80">Reçu de :</td>
                <td colspan="3" style="border-bottom:1px solid #000; ">
                    <div id="nom" style="" align="left"><i><?php echo strtolower($libcompte);?></i></div>
                </td>
            </tr>
            <tr>
                <td colspan="4" height="10">  </td>
            </tr>
            <tr>
                <td width="100">La somme de: </td>
                <td colspan="3" bgcolor="#CCCCCC" align="center">
                    <div id="lettre_usd" style="" align="center">
                        <i><?php
                        if (empty($montantUSD)) {
                            echo '  ';
                        } else {
                            echo $lettre->toWords($montantUSD) . ' ' . ' Dollar';
                        }
                        ?></i>
                    </div>
                    <div id="lettre_fc" style="" align="center">
                        <i>
                            <?php
                            if (!empty($montantFC) && !empty($montantUSD)) {
                                echo 'et '.$lettre->toWords($montantFC) . ' ' . ' Franc Congolais';
                            } else if (!empty($montantFC)&& empty($montantUSD)){
                                echo $lettre->toWords($montantFC) . ' ' . ' Franc Congolais';
                            }else{
                                echo '  ';
                            }
                            ?>
                        </i>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">  </td>

            </tr>
            <tr>
                <td>Pour:</td>
                <td colspan="3" style="border-bottom:1px solid #000; ">
                    <div id="pour" style="" align="left"><i><?php echo $designation;?></i></div>
                </td>
            </tr>
            <tr>
                <td colspan="4" height="50">  </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span style="margin-left:100px; font-weight:bold;"> La Direction</span> 
                </td>
                <td colspan="2">
                    <span style="margin-left:280px; font-weight:bold;"> Le(la) Caissier(e)</span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <span style="margin-left:100px; font-weight:bold;"> </span>
                    
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2">
                    <span style="margin-left:330px; font-weight:bold;"> <?php echo strtoupper($_SESSION['nom_user'].' '.$_SESSION['prenom_user']);?></span>
                </td>
            </tr>
            <tr>
                <td colspan="4" height="15">  </td>
            </tr>
            <tr>
                <td colspan="2" align="left">Imprimé le  <?php echo $date = date('d/m/Y');?></td>
                <td colspan="2" align="right"> 
                    <div id="date">
                        Fait à <?php echo ucfirst($ville_hotel);?>, le  <?php echo $date_iso;
                            ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
<!--</page>-->
