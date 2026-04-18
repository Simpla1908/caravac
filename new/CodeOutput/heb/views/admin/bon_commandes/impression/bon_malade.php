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
    #cmu
    {
        position:relative; 
        top:150px; 
        /*left:460px;*/ 
        border:1px solid #000; 
        width:50px; 
        height: 50px;

    }
</style>
    <div id="content">
        <table id="tab_title" border="0" width="780" align="center">
            <tr>
                <td align="center">
                   <img src="public/uploads/logo_cmu.jpg" height="70" width="80"/> 
                </td>
                <td colspan="2" align="center">
                    <h1 style="background-color:#000000; color: white">&nbsp;&nbsp;&nbsp;<strong>CENTRE MEDICAL D'URGENCE</strong>&nbsp;&nbsp;&nbsp;</h1>
                </td>
                <td>
                <img src="public/uploads/logo_cmu.jpg" height="70" width="80"/>
                </td>
            </tr>
            <tr>
                <td colspan="4" align="center">
                    <u><h1><strong>(C.M.U)</strong></h1></u>
                </td>
            </tr>
            <tr>
                <td height="50" colspan="4" align="center">
                    <u><h2><strong>BON DES SOINS MEDICAUX N°<?php echo $id2 ?></strong></h2></u>
                </td>
            </tr>
            <tr>
                <td colspan="4" height="10">  </td>
            </tr>
            <tr>
                <td colspan="2" width="80">Nom de la socièté :</td>
                <td>
                    <div id="nom" style="" align="left"><i><?php echo $site->nom_hotel; ?></i></div>
                </td>
            </tr>
            <tr>
                <td colspan="4" height="10">  </td>
            </tr>
            <tr>
                <td colspan="2" width="100">Employé(e)/Epoux(se)/Enfant</td>
                <td>
                    <div id="nom" style="" align="center">
                        <i><?php echo $id1 ?></i>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">  </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div id="pour" style="" align="left"><i>Est autorisé(e) à se faire soigner dans le Centre Médical d'Urgence</i></div>
                </td>
            </tr>
            <tr>
                <td colspan="4" height="20">  </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span style="margin-left:100px; font-weight:bold;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature autorisée</span> 
                </td>
                <td colspan="2" align="center">
                    <div id="date">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fait à <?php echo $site->ville_hotel; ?>, le  <?php echo $date = date('d/m/Y');?>
                    </div>
                </td>
            </tr>
        </table>
        
    </div>
<!--</page>-->
