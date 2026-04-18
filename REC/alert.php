
    <li>
        <?php
        include '../bdd/connexion_mysql.php';
        $result = mysql_query("SELECT COUNT(c.id_ch) as chr FROM  t_chambre c 
            WHERE c.reserve='oui' ORDER BY c.id_ch ASC") or die(mysql_error());
        while ($rows = mysql_fetch_assoc($result))
            $chr = $rows['chr'];
        ?>

        <a  href="rec_chambres_reserve.php">
            <div><span id="reserve"><?php echo $chr; ?></span>
 Chambre(s) reservée(s)
                <span class="pull-right text-muted small">Voir détails</span>
            </div>
        </a>
    </li>
    <li class="divider"></li>
    <li>
        <?php
        $result = mysql_query("SELECT COUNT(c.id_ch) as cho FROM  t_chambre c
            WHERE c.occupe='oui' ORDER BY c.id_ch ASC") or die(mysql_error());
        while ($rows = mysql_fetch_assoc($result))
            $cho = $rows['cho'];
        ?>
        <a  href="rec_chambres_occuper.php">
            <div>
<?php echo $cho; ?> Chambre(s) occupée(s)
                <span class="pull-right text-muted small">Voir détails</span>
            </div>
        </a>
    </li>
    <li class="divider"></li>
    <li>
        <?php
        $result = mysql_query("SELECT COUNT(c.id_ch) as chl FROM  t_chambre c
            WHERE c.libre='oui' ORDER BY c.id_ch ASC") or die(mysql_error());
        while ($rows = mysql_fetch_assoc($result))
            $chl = $rows['chl'];
        ?>
        <a  href="rec_chambres_libres.php">
            <div>
<?php echo $chl; ?> Chambre(s) libre(s)
                <span class="pull-right text-muted small">Voir détails</span>
            </div>
        </a>
    </li>

