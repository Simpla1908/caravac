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
    #lettre
    {
        
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
                 <img src="public/uploads/<?php echo $site->logo1;?>" height="70" width="80"/>
           </td>
                <td>
                    
                </td>
                <td colspan="2" align="right">
                    <div style="border: 1px solid #ffffff; width: 300px; padding: 3px; padding-left: 8px;">
                        <strong>   <?php echo strtoupper($site->nom_hotel);?>.</strong><br />
                        ID-Nat : <?php echo $site->idnat;?> -- RCCM : <?php echo $site->rccm;?> -- N° Impôt : <?php echo $site->num_impot;?>
                        <br />
                        Téléphone : <?php echo $site->phone;?> -- Email : <?php echo $site->mail_company;?>
                    </div>
                </td>

            </tr>



         <tr>
                <td height="50" colspan="4" align="center">
                    <u><h3> <strong>RECU N°<?php echo ' '.$_SESSION['numero_recu'];?></strong></h3></u>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td align="center" bgcolor="#CCCCCC" width="200"><strong>
                    <?php
                        if (!empty($_SESSION['montantusd'])&& !empty($_SESSION['montantcdf'])) {
                            echo $_SESSION['montantusd'] . ' USD / '.$_SESSION['montantcdf'].' CDF';
                        }elseif (!empty($_SESSION['montantcdf'])) {
                         echo $_SESSION['montantcdf']. ' CDF';
                       }
                        else {
                            echo $_SESSION['montantusd']. ' USD';
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
                    <div id="nom" style="" align="left"><i><?php echo $_SESSION['nomclient'];?></i></div>
                </td>
            </tr>
            <tr>
                <td colspan="4" height="10">  </td>
            </tr>
            <tr>
                <td width="150">Mode de paiement:</td>
                <td colspan="3" style="border-bottom:1px solid #000; ">
                    <div id="pour" style="" align="left"><i>
                        <?php 
                        if($_SESSION['libmode']=='Credit'){
                        echo 'Acompte'; 
                        }else{
                        echo $_SESSION['libmode'];
                        }
                        ?>
                    </i></div>
                </td>
            </tr>
            <tr>
                <td colspan="4" height="10">  </td>
            </tr>
            <tr>
                <td width="100">La somme de: </td>
                <td colspan="3" bgcolor="#CCCCCC" align="left" id="lettre">
                <p id="lettre">
                    <i>
                    <?php
                        if (empty($_SESSION['montantusd'])) {
                            echo '  ';
                        } else {
                            echo $lettre->toWords($_SESSION['montantusd']) . ' ' . ' Dollar';
                        }
                            if (!empty($_SESSION['montantcdf']) && !empty($_SESSION['montantusd'])) {
                                echo ' et '.$lettre->toWords($_SESSION['montantcdf']) . ' ' . ' Franc Congolais';
                            } else if (!empty($_SESSION['montantcdf'])&& empty($_SESSION['montantusd'])){
                                echo $lettre->toWords($_SESSION['montantcdf']) . ' ' . ' Franc Congolais';
                            }else{
                                echo '  ';
                            }
                            ?>
                        </i>
                  </p>
                </td>
            </tr>
            <tr>
                <td colspan="4">  </td>

            </tr>
            <tr>
                <td>Pour:</td>
                <td colspan="3" style="border-bottom:1px solid #000; ">
                    <div id="pour" style="" align="left"><i>

                    <?php 
                    echo 'Paiement facture '.$_SESSION['numero_fact'].' ';
                    if($_SESSION['montant_a_paye1']<=0){
                    echo ' (Solde)';
                    }
                    ?>
                </i></div>
                </td>
            </tr>
            <tr>
                <td colspan="4" height="50">  </td>
            </tr>
            <tr>
                <td colspan="4" align="center">
                    <span style="font-weight:bold;"> Le(la) Caissier(e)</span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <span style="margin-left:100px; font-weight:bold;"> </span>
                    
                </td>
            </tr>
            <tr>
                <td colspan="4" align="center">
                    <span style="font-weight:bold;">  <?php echo strtoupper($_SESSION['nom_user'].' '.$_SESSION['prenom_user']);?></span>
                </td>
            </tr>
            <tr>
                <td colspan="4" height="15">  </td>
            </tr>
              <?php 
                $date = date('d/m/Y');
                if($_SESSION['first_print']!=1){ 
                    $date = $_SESSION['dte_paie'];
                }
                    ?>
            <tr>
                <td colspan="2" align="left"><?php if($_SESSION['first_print']!=1){;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Imprimé le <?php echo $date = date('d/m/Y');?> <?php };?></td>
                <td colspan="2" align="right"> 
                    <div id="date">
                        Fait à <?php echo ucfirst($site->ville_hotel);?>, le  <?php echo $date;
                            ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
<!--</page>-->