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
                 <img src="public/uploads/<?php echo $site->logo1;?>" height="70" width="80"/>
           </td>
                <td>
                    
                </td>
                <td colspan="2" align="right">
                    <div style="border: 1px solid #ffffff; width: 300px; padding: 3px; padding-left: 8px;">
                        <strong>   <?php echo strtoupper($site->nom_hotel);?>.</strong><br />
                        ID-Nat : <?php echo $site->idnat;?> -- RCCM : <?php echo $site->rccm;?> -- N° Impôt : <?php echo $site->num_impot;?>
                        <br />
                        Téléphone : <?php echo $site->telephone;?> -- Email : <?php echo $site->email_compagny;?>
                    </div>
                </td>

            </tr>
            <tr>
                <td height="50" colspan="4" align="center">
                    <u><h3><strong>PRET N°<?php echo ' '.$numero;?></strong></h3></u></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td align="center" bgcolor="#CCCCCC" width="150"><strong>
                    <?php echo afficheMontant($_SESSION['Paie_affiche'],$montant); ?>
                </strong></td>
            </tr>
            <tr>
                <td colspan="4" height="10">  </td>
            </tr>
            <tr>
                <td width="150">Employé(e):</td>
                <td colspan="3" style="border-bottom:1px solid #000; ">
                    <div id="nom" style="" align="left"><i><?php echo $noms;?></i></div>
                </td>
            </tr>
            <tr>
                <td colspan="4" height="10">  </td>
            </tr>
            <tr>
                <td width="150">Montant: </td>
                <td colspan="3" bgcolor="#CCCCCC" align="center">
                    <div id="lettre_usd" style="" align="center">
                        <i><?php
                            if($_SESSION['Paie_affiche']==getsymbole_devise()){
                               echo $lettre->toWords($montant) . ' ' . ' Dollar';
                         }else{
                                echo $lettre->toWords($montant) . ' ' . ' Franc Congolais';
                            }
                            ?>
                        </i>
                    </div>
              </td>
            </tr>
            <tr>
                <td colspan="4" height="50">  </td>
            </tr>
            <tr>
                <td colspan="4" height="20" align="center"> 
                <div id="pour" style="" align="left">DEPARTEMENT DES RESSOURCES HUMAINES</div>
                    </td>
            </tr>
            <tr>
                <td colspan="4" height="20">  </td>
            </tr>
            <tr>
                <td colspan="4" height="20">  </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span style="margin-left:100px"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Imprimé le <?php echo $date = date('d/m/Y');?></span> 
                </td>
                <td colspan="2" align="right">
                    <div id="date">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fait à <?php echo $site->ville_hotel; ?>, le  <?php echo dateAffiche($dte);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                </td>
            </tr>
        </table>
    </div>

<!--</page>-->