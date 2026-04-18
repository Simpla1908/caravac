<ul class="nav navbar-top-links navbar-right">
    <li class="dropdown pull-right">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="#"><i class="fa fa-user fa-fw"></i>&nbsp;<?php echo $_SESSION['nom_user'] . ' ' . $_SESSION['prenom_user']; ?></a>
            </li>
            <li><a href="#"><i class="fa fa-bank fa-fw"></i>
                    <?php
                    if ($_SESSION['type_user'] == 1) {
                        echo strtoupper($_SESSION['company_name']);
                    } else {
                        echo strtoupper($_SESSION['nom_hotel']);
                    }
                    ?>
                </a>
            </li>
            <?php
            if ($_SESSION['type_user'] != 1) {
                ?>
                <li><a href="../REC2/detail_utilisateur.php?id_user=<?php echo $_SESSION['id_user']?>&prfl=1"><i class="fa fa-gear fa-fw"></i> MON PROFIL</a>
                </li>
                <?php
            }
            ?>
            <li class="divider"></li>
            <li><a href="../Authentification/logout.php"><i class="fa fa-sign-out fa-fw"></i> Déconnexion</a>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
    <li>
      <?php 
      if (isset($_SESSION['etat_session']) && isset($_SESSION['etat_caisse'])){
     if( $_SESSION['etat_session']=='actif' && $_SESSION['etat_caisse']=='ouvert'){?>
        <a   href="votre_session.php" title="Fermer la caisse">
      <strong>Fermer</strong>
      </a>
        
     <?php $_SESSION['etat_session']='actif'; $_SESSION['etat_caisse']='ferme';  }}?>
    </li>
    <!-- /.dropdown -->
</ul>