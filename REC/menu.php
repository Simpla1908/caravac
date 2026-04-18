<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

            <li>
                <a class="active" href="tableaudebordRec.php"><i class="fa fa-dashboard fa-fw"></i> Tableau de bord</a>
            </li>
            <?php if (in_array('ER', $_SESSION['actions']['code_actions'])
                || in_array('VR', $_SESSION['actions']['code_actions'])
                || in_array('ILR', $_SESSION['actions']['code_actions'])
                || in_array('MR', $_SESSION['actions']['code_actions'])
                || in_array('AR', $_SESSION['actions']['code_actions'])
            ) {
                ?>
                <li>
                    <a href="rec_reservation_multiple.php?hebergement=1"><i class="fa fa-calendar fa-fw"></i> Réservation</a>
                </li>
                
            <?php } ?>
            <?php if (in_array('VO', $_SESSION['actions']['code_actions'])
                || in_array('EO', $_SESSION['actions']['code_actions'])
                || in_array('ILO', $_SESSION['actions']['code_actions'])
            ) { ?>
                <li>
                    <a href="rec_reservation_multiple.php?hebergement=2"><i class="fa fa-sign-in fa-fw"></i> Occupation</a>
                </li>
              <?php } ?>
                <li>
                    <a href="rec_liste_reservation.php"><i class="fa fa-bed fa-fw"></i> Liste hébergement</a>
                </li>
                 <?php if (in_array('EO', $_SESSION['actions']['code_actions'])) { ?>
                <li>
                    <a href="rec_occupations_prevues.php">&nbsp;<i class="fa fa-users fa-fw"></i>Clients attendus</a>
                </li>
                <?php } ?>
                <?php if (in_array('SITCLL', $_SESSION['actions']['code_actions'])) { ?>
                <li>
                    <a href="rec_situation_clients_loges.php">&nbsp;<i class="fa fa-user fa-fw"></i>Clients logés</a>
                </li>
                 <?php } ?>
               
         
            
            <?php if (in_array('VLIB', $_SESSION['actions']['code_actions'])
                || in_array('EL', $_SESSION['actions']['code_actions'])
                || in_array('ILL', $_SESSION['actions']['code_actions'])
            ) { ?>
                <li>
                    <a href="rec_liste_liberation.php"><i class="fa fa-sign-out fa-fw"></i> Libérations</a>
                </li>
            <?php } ?>
            
            <li>
                <a href="paiement_cash.php">&nbsp;<i class="fa fa-money"></i> Paiements</a>
            </li>
            <?php if (in_array('ENRECL', $_SESSION['actions']['code_actions']) || in_array('LSTRECL', $_SESSION['actions']['code_actions'])) { ?>
                <li>
                    <a href="reclamation.php"><i class="fa fa-smile-o fa-fw"></i> Réclamations</a>
                </li>
            <?php } ?>
            <?php if (in_array('VLCLI', $_SESSION['actions']['code_actions'])
                || in_array('AJTCL', $_SESSION['actions']['code_actions'])
                || in_array('MINFCLI', $_SESSION['actions']['code_actions'])
                || in_array('SCLI', $_SESSION['actions']['code_actions'])
                || in_array('IMPRCLI', $_SESSION['actions']['code_actions'])
            ) {
                ?>
                <li>
                    <a href="rec_liste_clients.php"><i class="fa fa-users fa-fw"></i> Clients</a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>