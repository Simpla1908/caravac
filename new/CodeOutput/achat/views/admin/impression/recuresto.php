
<div id="register" style="border:1px solid white">
    <div id="ticket" >
        <table  style="margin:auto; font-family: monospace; font-size: 14px;">
            <tbody id="entries">
                <tr>
                    <td  colspan="3" align="center" style="border-bottom: 1px solid black;">
                        <b><?php echo strtoupper($site->nom_hotel) ?>
                        </b> <br>
                        <?php echo strtoupper($site->adresse_hotel) ?>
                        <br>
                        <?php echo strtoupper($site->telephone) ?>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" height="10"></td>
                </tr>
                <tr>
                    <td align="center" colspan="3">
                        <b>RECU N°00234</b><br>
                    </td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;"></td>
                </tr>
                <tr>
                    <td colspan="3" height="30"></td>
                </tr>
                <tr>
                    <td><b>Agent</b></td>
                    <td colspan="2"> :<?php echo $_SESSION['nom_user']; ?></td>
                </tr>
                <tr>
                    <td><b>CLient</b></td>
                    <td colspan="2"> :<?php echo strtoupper($_SESSION['recu_nomclient']); ?></td>
                </tr>
                <tr>
                    <td><b>Motif</b></td>
                    <td colspan="2"> :<?php echo $_SESSION['recu_motif'] ?> </td>
                </tr>
                <tr>
                    <td><b>Montant payé</b></td>
                    <td colspan="2"> :<?php echo afficheMontant($_SESSION['symbl_monnaie_affichage'], $_SESSION['recu_montpaye']); ?></td>
                </tr>

                <tr>
                    <td colspan="3" height="30"></td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;">
                        <b>
                            Fait à Kinshasa, le  <?php echo $_SESSION['recu_dte']; ?><br>
                            Signature
                        </b>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>



