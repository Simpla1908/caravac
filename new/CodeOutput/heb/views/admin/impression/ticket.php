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
                    <td  colspan="3" align="center" style="border-bottom: 1px solid black;">
                        N°FACTURE: <?php echo $_SESSION['num_commande'];  ?>
                        <br>
                        <?php echo dateAfficheForHr($_SESSION['date_edition2']);  ?>
                        <br>
                         CLIENT:<?php echo $_SESSION['nom_client'];  ?>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td><b>DES</b></td>
                    <td><b>QTE</b></td>
                    <td><b>PT</b></td>
                </tr>
                <?php
                $mont_tva = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier1']['mont_tva']);
                $total_fact = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier1']['mont_total']);
                $mont_remise = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier1']['mont_remise']);
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                    $prix = montant_equivalent_bdd($monnaie_local,$m_affiche,$tauxdollar,$_SESSION['panier1']['prix'][$i] * $_SESSION['panier1']['qte'][$i]);
                    ?>
                    <tr>
                        <td><?php echo ucfirst($_SESSION['panier1']['nom'][$i]); ?></td>
                        <td ><?php echo $_SESSION['panier1']['qte'][$i]; ?></td>
                        <td ><?php echo afficheMontant($m_affiche, $prix); ?></td>
                    </tr>
                <?php
                };
                $ttc = CalculMontTtc($total_fact,$mont_tva);
                ?>
                <tr>
                    <td align="right" colspan="3" style="border-top: 1px solid black;">
                    </td>
                </tr>
                <tr>
                    <td align="right" colspan="2"><b>HT</b></td>
                    <td > :<?php echo afficheMontant($m_affiche, $total_fact); ?></td>
                </tr>
                <tr>
                    <td align="right" colspan="2"><b>TVA</b></td>
                    <td> :<?php echo afficheMontant($m_affiche, $mont_tva); ?></td>
                </tr>
                <tr>
                    <td align="right" colspan="2"><b>Remise</b></td>
                    <td > :<?php echo afficheMontant($m_affiche, $mont_remise); ?></td>
                </tr>
                <tr>
                    <td align="right" colspan="2"><b>TTC</b></td>
                    <td > :<?php echo afficheMontant($m_affiche, $ttc); ?></td>
                </tr>
                <tr>
                    <td align="right" colspan="2"><b>Montant payé</b></td>
                    <td > :<?php echo afficheMontant($m_affiche, $ttc+$_SESSION['totrendu']); ?></td>
                </tr>
                <tr>
                    <td align="right" colspan="2"><b>Rendu</b></td>
                    <td > :<?php echo afficheMontant($m_affiche,$_SESSION['totrendu']); ?></td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;"><b>
                            Merci pour votre visite
                        </b></td>
                </tr>
            </tbody>

        </table>
    </div>
</div>

