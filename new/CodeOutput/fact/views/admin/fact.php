<li class="treeview">
    <a href="#">
        <i class="fa fa-dashboard"></i> <span>Tableau de bord</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="active"><a href="<?php echo H_ADMIN; ?>&view=module&do=fact"><i class="fa fa-circle-o"></i> Facturation</a></li>
        <?php if ($_SESSION['type_user'] == 1) { ?>
            <li><a href="../../REC/tableaudebordRec.php"><i class="fa fa-circle-o"></i> Tableau de bord principal</a></li>
        <?php } ?>
    </ul>
</li>

<?php // if (in_array('FAFACTN', $_SESSION['actions']['code_actions'])||in_array('FAFACTP', $_SESSION['actions']['code_actions'])) { 
?>

<li class="treeview">
    <a href="#">
        <i class="fa fa-file-text-o"></i> <span>Facture</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <?php // if (in_array('FAFACTN', $_SESSION['actions']['code_actions'])) { 
        ?>
        <li><a href="<?php echo H_ADMIN; ?>&view=t_facture&do=viewall&f=1"><i class="fa fa-circle-o"></i> Normale</a></li>
        <?php //  } 
        ?>
        <?php // if (in_array('FAFACTP', $_SESSION['actions']['code_actions'])) { 
        ?>
        <li><a href="<?php echo H_ADMIN; ?>&view=t_facture&do=viewall&f=0"><i class="fa fa-circle-o"></i> Proforma</a></li>
        <?php //  } 
        ?>
        <?php // if (in_array('FAFACTP', $_SESSION['actions']['code_actions'])) { 
        ?>
        <li><a href="<?php echo H_ADMIN; ?>&view=t_facture&do=recurente&f=1"><i class="fa fa-circle-o"></i> Recurente</a></li>
        <?php //  } 
        ?>

    </ul>
</li>
<?php //  } 
?>
<?php if (in_array('FAPAIE', $_SESSION['actions']['code_actions']) || in_array('FALPAIE', $_SESSION['actions']['code_actions']) || in_array('FAXTVA', $_SESSION['actions']['code_actions']) || in_array('FAXCPT', $_SESSION['actions']['code_actions'])) { ?>
    <li><a href="<?php echo H_ADMIN; ?>&view=paiement&do=viewall"><i class="fa fa-money"></i>Paiements</a></li>
<?php } ?>
<li><a href="<?php echo H_ADMIN; ?>&view=paiement&do=detailsvente"><i class="fa fa-money"></i>Détails Vente</a></li>


<?php // if (in_array('FAXTVA', $_SESSION['actions']['code_actions'])) { 
?>
<!-- <li><a href="<?php echo H_ADMIN; ?>&view=paiement&do=extraittva"><i class="fa fa-table"></i> Extrait TVA</a></li> -->
<?php //  } 
?>
<?php // if (in_array('FAGCLT', $_SESSION['actions']['code_actions'])) { 
?>
<li><a href="<?php echo H_ADMIN; ?>&view=t_client&do=viewall"><i class="fa fa-table"></i> Clients</a></li>
<li><a href="<?php echo H_ADMIN; ?>&view=paiement&do=extraitcompte"><i class="fa fa-money"></i>Extrait de compte</a></li>

<!--   <li class="treeview">
    <a href="#">
        <i class="fa fa-users"></i> <span>Clients</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <?php // if (in_array('FAGCLT', $_SESSION['actions']['code_actions'])) { 
        ?>
        <li><a href="<?php echo H_ADMIN; ?>&view=t_client&do=viewall"><i class="fa fa-circle-o"></i> Liste Clients</a></li>
        <?php //  } 
        ?>
        <?php // if (in_array('FAXCPT', $_SESSION['actions']['code_actions'])) { 
        ?>
        <li><a href="<?php echo H_ADMIN; ?>&view=paiement&do=extraitcompte"><i class="fa fa-circle-o"></i>Extrait de compte</a></li>
        <?php //  } 
        ?>

    </ul>
</li>-->
<?php //  } 
?>
<?php // if (in_array('FAGART', $_SESSION['actions']['code_actions'])) { 
?>

<li><a href="<?php echo H_ADMIN; ?>&view=stk_produit&do=viewall"><i class="fa  fa-circle-o"></i>Services</a></li>
<li><a href="<?php echo H_ADMIN; ?>&view=stk_sous_famille&do=viewall"><i class="fa  fa-circle-o"></i>Catégories</a></li>

<?php //  } 
?>
<?php // if (in_array('FACONFIG', $_SESSION['actions']['code_actions'])) { 
?>
<li>
    <a href="<?php echo H_ADMIN; ?>&view=facconfig&id=178&do=details">
        <i class="fa fa-cogs"></i> <span>Configurations</span>
    </a>

</li>
<?php // }
?>
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