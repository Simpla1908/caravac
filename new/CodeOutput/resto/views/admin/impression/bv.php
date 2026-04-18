
<div id="register" style="border:1px solid white">
    <div id="ticket" >
        <table  style="margin:auto; font-family: monospace; font-size: 14px;">
            <tbody id="entries">
                <tr>
                    <td  colspan="3" align="center" style="border-bottom: 1px solid black;">
                        <b><?php echo strtoupper($site->nom_hotel)   ?>
                        </b> <br>
                        <?php echo strtoupper($site->adresse_hotel)  ?>
                        <br>
                        <?php echo strtoupper($site->telephone)  ?>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" height="10"></td>
                </tr>
                <tr>
                    <td align="center" colspan="3"><b>BON DE VERSEMENT CAISSE</b></td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;"></td>
                </tr>
                <tr>
                    <td colspan="3" height="30"></td>
                </tr>
              <tr>
                    <td><b>Agent</b></td>
                    <td colspan="2"> :<?php echo strtoupper($_SESSION['nom_user']); ?></td>
                </tr>
                <tr>
                    <td><b>Service</b></td>
                    <td colspan="2"> :<?php echo strtoupper($_SESSION['motif_vers']); ?></td>
                </tr>
                <tr>
                    <td><b>Montant en USD</b></td>
                    <td colspan="2"> :<?php echo afficheMontant(getsymbole_devise(),$_SESSION['montantusd']) ?> </td>
                </tr>
                <tr>
                    <td><b>Montant en CDF</b></td>
                    <td colspan="2"> :<?php echo afficheMontant(getsymbole_local(),$_SESSION['montantcdf']); ?></td>
                </tr>
                <tr>
                    <td colspan="3" height="30"></td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;">
                        <b>
                            Fait à Kinshasa, le  <?php echo dateAffiche($_SESSION['dte']); ?><br>
                            Signature
                        </b>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>



