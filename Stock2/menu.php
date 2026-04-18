<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
            </li>

            <li>
                <a class="active" href="../REC/tableaudebordRec.php"><i class="fa fa-dashboard fa-fw"></i> Tableau de
                    bord</a>
            </li>
            <?php if (in_array('TBS', $_SESSION['actions']['code_actions'])) { ?>
                <li>
                    <a href="index.php">&nbsp;&nbsp;&nbsp;<i class="fa fa-database fa-fw"></i> Stock</a>
                </li>
            <?php } ?>
            <?php if (in_array('APPRL', $_SESSION['actions']['code_actions']) || in_array('APPRA', $_SESSION['actions']['code_actions'])) { ?>
                <li>
                    <a href="approvisionnement_liste.php">&nbsp;&nbsp;&nbsp;<i class="fa fa-sign-in fa-fw"></i>
                        Approvisionnements</a>
                </li>
            <?php } ?>
            <?php if (in_array('SORL', $_SESSION['actions']['code_actions']) || in_array('SORA', $_SESSION['actions']['code_actions'])) { ?>
                <li>
                    <a href="approvisionnement_view.php?operation=sortie">&nbsp;&nbsp;&nbsp;<i class="fa fa-sign-out fa-fw"></i> Sorties</a>
                </li>
            <?php } ?>

            <?php if (in_array('RFA', $_SESSION['actions']['code_actions'])) { ?>
                <li>
                    <a href="fiche_stock_view.php">&nbsp;&nbsp; <i class="fa fa-table fa-fw"></i> Fiche stock</a>
                </li>
            <?php } ?>
            <?php if (in_array('RFA', $_SESSION['actions']['code_actions'])) { ?>
                <li>
                    <a href="produit_famille_view.php">&nbsp;&nbsp; <i class="fa fa-files-o fa-fw"></i> Inventaire</a>
                </li>
            <?php } ?>
            
            <?php if (in_array('PARART', $_SESSION['actions']['code_actions'])) { ?>
                <li>
                    <a href="produit_view.php">&nbsp;&nbsp;&nbsp;<i class="fa fa-photo fa-fw"></i> Produits</a>
                </li>
            <?php } ?>
            <?php if (in_array('PARART', $_SESSION['actions']['code_actions'])) { ?>
            <li>
                <a href="#"><i class="fa fa-wrench"></i> <b>Parametrage</b><span class="fa arrow"></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="familles_view.php">&nbsp;&nbsp;&nbsp;<i class="fa fa-star fa-fw"></i> Famille</a>
                    </li>
                    <li>
                        <a href="sous_familles_view.php">&nbsp;&nbsp;&nbsp;<i class="fa fa-star fa-fw"></i>
                            Sous-famille</a>
                    </li>
                </ul>
            </li>
            <?php } ?>
            <li>
                <a href="#"><i class="fa fa-th fa-fw"></i> <b>Modules</b><span class="fa arrow"></a>
                <ul class="nav nav-second-level">
                    <?php if (in_array('VMS', $_SESSION['actions']['code_actions'])) { ?>
                        <li>
                            <a href="../Stock2/index.php">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Stock</a>
                        </li>
                    <?php } ?>


                    <?php if (in_array('VMR', $_SESSION['actions']['code_actions'])) { ?>
                        <li>
                            <a href="../restaurant2/index.php">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Restaurant</a>
                        </li>
                    <?php } ?>
                </ul>
            </li>


            <!-- Menu parametrage-->


        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
<?php include('Rapport/liste_produit_famille.php'); ?>