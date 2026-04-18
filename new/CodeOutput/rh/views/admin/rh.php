<?php if ($_SESSION['pointage'] == 1) { ?>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Tableau de bord</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="active"><a href="<?php echo H_ADMIN; ?>&view=module&do=rh"><i class="fa fa-circle-o"></i> GRH</a></li>
            <?php if ($_SESSION['type_user'] == 1) { ?>
                <li><a href="../../REC/tableaudebordRec.php"><i class="fa fa-circle-o"></i> Tableau de bord principal</a></li>
            <?php } ?>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Administration</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <?php if (in_array('RHFSI', $_SESSION['actions']['code_actions'])) { ?>
                <li><a href="<?php echo H_ADMIN; ?>&view=resemployes&do=add"><i class="fa fa-user"></i> Saisie information</a></li>
            <?php } ?>
            <?php if (in_array('RHLE', $_SESSION['actions']['code_actions']) || in_array('RHMIE', $_SESSION['actions']['code_actions'])) { ?>
                <li><a href="<?php echo H_ADMIN; ?>&view=resemployes&do=viewall"><i class="fa fa-users"></i>Employés</a></li>
            <?php } ?>
            <?php if (in_array('RHGS', $_SESSION['actions']['code_actions'])) { ?>
                <li><a href="<?php echo H_ADMIN; ?>&view=ressanction&do=listsanctemply"><i class="fa fa-crop"></i> Sanction</a></li>
            <?php } ?>
            <?php if (in_array('RHGC', $_SESSION['actions']['code_actions'])) { ?>
                <li><a href="<?php echo H_ADMIN; ?>&view=resconge&do=panelconge"><i class="fa fa-crop"></i> Congé</a></li>
            <?php } ?>
            <?php if (in_array('RHGR', $_SESSION['actions']['code_actions'])) { ?>
                <li><a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=resiliation"><i class="fa fa-external-link"></i> Résiliation</a></li>
            <?php } ?>
            <?php if (in_array('RHGBM', $_SESSION['actions']['code_actions'])) { ?>
                <li><a href="<?php echo H_ADMIN; ?>&view=resbonmalade&do=viewall"><i class="fa fa-ambulance"></i>Bons de malades</a></li>
            <?php } ?>
            <li><a href="<?php echo H_ADMIN; ?>&view=resdeclaration&do=view"><i class="fa fa-outdent"></i>Déclaration Fiscale</a></li>
        </ul>
    </li>
    <?php if (in_array('RHGPOINT', $_SESSION['actions']['code_actions'])) { ?>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-edit"></i> <span>Pointage</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo H_ADMIN; ?>&view=respointage&do=add2"><i class="fa fa-chain-broken"></i> mensuel</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=respointage&do=viewall2"><i class="fa fa-chain"></i> Présence</a></li>
            </ul>
        </li>
    <?php } ?>
    <?php if (in_array('RHGPAIE', $_SESSION['actions']['code_actions'])) { ?>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-tags"></i> <span>Paie</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=add"><i class="fa fa-star"></i> Payer</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=viewall"><i class="fa fa-star"></i> Bulletins</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=resemprunt&do=view_av"><i class="fa fa-th"></i> Avance</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=resemprunt&do=view_pr"><i class="fa fa-asterisk"></i> Prêt</a></li>
            </ul>
        </li>
    <?php } ?>
    <?php if (in_array('RHFCONF', $_SESSION['actions']['code_actions'])) { ?>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-cog"></i> <span>Configuration</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo H_ADMIN; ?>&view=resconfig&id=<?php echo $_SESSION['config_id']; ?>&do=details"><i class="fa fa-cog"></i>Configuration de base</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=rescategorie&do=viewall"><i class="fa fa-columns"></i> Catégorie</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=resfonction&do=viewall"><i class="fa fa-columns"></i> Fonction</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=resdepartement&do=viewall"><i class="fa fa-columns"></i> Département</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=resrubrique&do=viewall&type=1"><i class="fa fa-outdent"></i> Rubrique Paie</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=resrubrique&do=viewall&type=0"><i class="fa fa-outdent"></i> Rubrique Emprunt</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=resdeclaration&do=update"><i class="fa fa-outdent"></i> Rubrique Déclaration</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=reshoraire&do=viewall"><i class="fa fa-clock-o"></i>Horaire de Travail</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=ressanction&do=viewall"><i class="fa fa-crop"></i>Sanction</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=resconge&do=viewall"><i class="fa fa-clock-o"></i>Congé</a></li>
            </ul>
        </li>
    <?php } ?>
<?php } else { ?>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Tableau de bord</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="active"><a href="<?php echo H_ADMIN; ?>&view=module&do=rh"><i class="fa fa-circle-o"></i> GRH</a></li>
            <?php if ($_SESSION['type_user'] == 1) { ?>
                <li><a href="../../REC/tableaudebordRec.php"><i class="fa fa-circle-o"></i> Tableau de bord principal</a></li>
            <?php } ?>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Administration</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <?php if (in_array('RHFSI', $_SESSION['actions']['code_actions'])) { ?>
                <li><a href="<?php echo H_ADMIN; ?>&view=resemployes&do=add"><i class="fa fa-user"></i> Saisie information</a></li>
            <?php } ?>
            <?php if (in_array('RHLE', $_SESSION['actions']['code_actions']) || in_array('RHMIE', $_SESSION['actions']['code_actions'])) { ?>
                <li><a href="<?php echo H_ADMIN; ?>&view=resemployes&do=viewall"><i class="fa fa-users"></i>Employés</a></li>
            <?php } ?>
            <?php if (in_array('RHGS', $_SESSION['actions']['code_actions'])) { ?>
                <li><a href="<?php echo H_ADMIN; ?>&view=ressanction&do=listsanctemply"><i class="fa fa-crop"></i> Sanction</a></li>
            <?php } ?>
            <?php if (in_array('RHGC', $_SESSION['actions']['code_actions'])) { ?>
                <li><a href="<?php echo H_ADMIN; ?>&view=resconge&do=panelconge"><i class="fa fa-crop"></i> Congé</a></li>
            <?php } ?>
            <?php if (in_array('RHGR', $_SESSION['actions']['code_actions'])) { ?>
                <li><a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=resiliation"><i class="fa fa-external-link"></i> Résiliation</a></li>
            <?php } ?>
            <?php if (in_array('RHGBM', $_SESSION['actions']['code_actions'])) { ?>
                <li><a href="<?php echo H_ADMIN; ?>&view=resbonmalade&do=viewall"><i class="fa fa-ambulance"></i>Bons de malades</a></li>
            <?php } ?>
            <li><a href="<?php echo H_ADMIN; ?>&view=resdeclaration&do=view"><i class="fa fa-outdent"></i>Déclaration Fiscale</a></li>
        </ul>
    </li>
    <?php if (in_array('RHGPOINT', $_SESSION['actions']['code_actions'])) { ?>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-edit"></i> <span>Pointage</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo H_ADMIN; ?>&view=respointage&do=add"><i class="fa fa-chain-broken"></i> journalier</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=respointage&do=vld"><i class="fa fa-chain"></i> Validation</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=respointage&do=viewall"><i class="fa fa-chain"></i> Présence</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=respointage&do=permut"><i class="fa fa-chain"></i> Permutation</a></li>
            </ul>
        </li>
    <?php } ?>
    <?php if (in_array('RHGPAIE', $_SESSION['actions']['code_actions'])) { ?>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-tags"></i> <span>Paie</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=add"><i class="fa fa-star"></i> Payer</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=viewall"><i class="fa fa-star"></i> Bulletins</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=resemprunt&do=view_av"><i class="fa fa-th"></i> Avance</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=resemprunt&do=view_pr"><i class="fa fa-asterisk"></i> Prêt</a></li>
            </ul>
        </li>
    <?php } ?>
    <?php if (in_array('RHFCONF', $_SESSION['actions']['code_actions'])) { ?>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-cog"></i> <span>Configuration</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo H_ADMIN; ?>&view=resconfig&id=<?php echo $_SESSION['config_id']; ?>&do=details"><i class="fa fa-cog"></i>Configuration de base</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=rescategorie&do=viewall"><i class="fa fa-columns"></i> Catégorie</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=resfonction&do=viewall"><i class="fa fa-columns"></i> Fonction</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=resdepartement&do=viewall"><i class="fa fa-columns"></i> Département</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=resrubrique&do=viewall&type=1"><i class="fa fa-outdent"></i> Rubrique Paie</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=resrubrique&do=viewall&type=0"><i class="fa fa-outdent"></i> Rubrique Emprunt</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=resdeclaration&do=update"><i class="fa fa-outdent"></i> Rubrique Déclaration</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=reshoraire&do=viewall"><i class="fa fa-clock-o"></i>Horaire de Travail</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=ressanction&do=viewall"><i class="fa fa-crop"></i>Sanction</a></li>
                <li><a href="<?php echo H_ADMIN; ?>&view=resconge&do=viewall"><i class="fa fa-clock-o"></i>Congé</a></li>
            </ul>
        </li>
    <?php } ?>
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