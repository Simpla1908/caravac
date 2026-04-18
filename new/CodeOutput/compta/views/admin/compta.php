<li class="treeview">
    <a href="#">
        <i class="fa fa-dashboard"></i> <span>Tableau de bord</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo H_ADMIN; ?>&view=module&do=compta"><i class="fa fa-circle-o"></i> Compta</a></li>
        <?php if ($_SESSION['type_user'] == 1) { ?>
            <li><a href="../../REC/tableaudebordRec.php"><i class="fa fa-circle-o"></i> Tableau de bord principal</a></li>
        <?php } ?>

    </ul>
</li>
<?php if (in_array('CPTTRESOR', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-usd"></i> <b>Trésorerie ( <?php echo $_SESSION['nbre_notification']; ?> )</b>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li>
                <a href="<?php echo H_ADMIN; ?>&view=tresorerie&do=listencaissement">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Encaissement</a>
            </li>
            <li>
                <a href="<?php echo H_ADMIN; ?>&view=tresorerie&do=listdecaissement">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Decaissement</a>
            </li>
            <li>
                <a href="<?php echo H_ADMIN; ?>&view=tresorerie&do=demandepaiement">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Demande de paiement</a>
            </li>
            <li>
                <a href="<?php echo H_ADMIN; ?>&view=tresorerie&do=synthesecaisse">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Synthèse Tresorerie</a>
            </li>

        </ul>
    </li>
<?php } ?>
<?php if (in_array('CPTTRESOR', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-money"></i> <b>Gestion budgetaire</b>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li>
                <a href="<?php echo H_ADMIN; ?>&view=cptprevision&do=viewall">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Prévision</a>
            </li>
            <li>
                <a href="#">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Suivi compte</a>
            </li>
            <li>
                <a href="<?php echo H_ADMIN; ?>&view=cptprevision&do=realisation">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Réalisation</a>
            </li>


        </ul>
    </li>
<?php } ?>
<?php if (in_array('CPTACCESSCOMPTA', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
    <li class="treeview">
        <a href="<?php echo H_ADMIN; ?>&view=cptjournal&do=viewall">
            <i class="fa fa-file-text"></i> <span>Journalisation</span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-folder-open-o"></i> <b>Rapports</b>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li>
                <a href="<?php echo H_ADMIN; ?>&view=cptjournal&do=journal">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Journal</a>
            </li>
            <li>
                <a href="<?php echo H_ADMIN; ?>&view=cptjournal&do=grandlivre">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Grand livre</a>
            </li>
            <li>
                <a href="<?php echo H_ADMIN; ?>&view=cptjournal&do=balance">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Balance</a>
            </li>
            <li>
                <a href="<?php echo H_ADMIN; ?>&view=cptjournal&do=resultat">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i>Compte de Resultat</a>
            </li>
            <li>
                <a href="<?php echo H_ADMIN; ?>&view=cptjournal&do=bilan">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Bilan</a>
            </li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-cogs"></i> <b>Configuration</b>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li>
            <li><a href="<?php echo H_ADMIN; ?>&view=resconfig&id=<?php echo $_SESSION['config_id']; ?>&do=details"><i class="fa fa-cog"></i> Configuration de base</a></li>
    </li>
    <li>
        <a href="<?php echo H_ADMIN; ?>&view=cptexercice&do=viewall"><i class="fa fa-cog"></i> Exercices</a>
    </li>
    <li>
        <a href="<?php echo H_ADMIN; ?>&view=cptjournal&do=viewalltj"><i class="fa fa-cog"></i> Type de journal</a>
    </li>
    <li>
        <a href="<?php echo H_ADMIN; ?>&view=cptcomptes&do=viewall"><i class="fa fa-cog"></i> Comptes</a>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-cog"></i>Paramètres comptes
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li>
                <?php // if (in_array('VMFACT', $_SESSION['actions']['code_actions'])) {
                ?>
            <li><a href="<?php echo H_ADMIN; ?>&view=resconfig&do=confresto"><i class="fa fa-dot-circle-o"></i>Facturation</a></li>
            <?php // }  
            ?>

            <?php //if (in_array('VMH', $_SESSION['actions']['code_actions'])) {
            ?>
            <li><a href="<?php echo H_ADMIN; ?>&view=resconfig&do=confheberge"><i class="fa fa-dot-circle-o"></i>RH</a></li>
            <?php //} 
            ?>

    </li>
    </ul>
    </li>

    <li>
        <a href="../../REC/importcompta.php"><i class="fa fa-cog"></i> Importer</a>
    </li>

    </ul>
    </li>
<?php } ?>
<li class="treeview">
    <a href="#">
        <i class="fa fa-th fa-fw"></i> <b>Modules</b>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <?php if (in_array('VMC', $_SESSION['actions']['code_actions'])) { ?>
            <li>
                <a href="<?php echo H_ADMIN; ?>&view=module&do=compta">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Comptabilité</a>
            </li>
        <?php } ?>
        <?php if (in_array('VMS', $_SESSION['actions']['code_actions'])) { ?>
            <li>
                <a href="../../Stock2/index.php">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Stock</a>
            </li>
        <?php } ?>
        <?php if (in_array('VMH', $_SESSION['actions']['code_actions'])) { ?>
            <li>
                <a href="<?php echo H_ADMIN; ?>&view=module&do=heb2">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Hebergement</a>
            </li>
        <?php } ?>
        <?php if (in_array('VRH', $_SESSION['actions']['code_actions'])) { ?>
            <li>
                <a href="<?php echo H_ADMIN; ?>&view=module&do=rh">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Ress. Humaines</a>
            </li>
        <?php } ?>
        <?php if (in_array('VMACH', $_SESSION['actions']['code_actions'])) { ?>
            <li>
                <a href="<?php echo H_ADMIN; ?>&view=module&do=achat">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Achat</a>
            </li>
        <?php } ?>
        <?php if (in_array('VMFACT', $_SESSION['actions']['code_actions'])) { ?>
            <li>
                <a href="<?php echo H_ADMIN; ?>&view=module&do=fact">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Facturation</a>
            </li>
        <?php } ?>
        <?php if (in_array('VMR', $_SESSION['actions']['code_actions'])) { ?>
            <li>
                <a href="../../restaurant2/index.php">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> Restaurant</a>
            </li>
        <?php } ?>
        <?php if (in_array('VMPOS', $_SESSION['actions']['code_actions'])) { ?>
            <li>
                <a href="../../pos/index.php">&nbsp;<i class="fa fa-dot-circle-o fa-fw"></i> POS</a>
            </li>
        <?php } ?>
    </ul>
</li>