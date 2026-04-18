

<li class="treeview">
    <a href="#">
        <i class="fa fa-dashboard"></i> <span>Tableau de bord</span> 
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <!--<li class="active"><a href="<?php echo H_ADMIN;?>&view=module&do=fact"><i class="fa fa-circle-o"></i> GRH</a></li>-->
        <li><a href="../../REC/tableaudebordRec.php"><i class="fa fa-circle-o"></i> Accueil</a></li>
    </ul>
</li>
<?php // if (in_array('RHGPAIE', $_SESSION['actions']['code_actions'])) { ?>
<li class="treeview">
    <a href="#">
        <i class="fa fa-tags"></i> <span>Commandes</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=add"><i class="fa fa-star"></i> Créer</a></li>
        <li><a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=viewall"><i class="fa fa-star"></i> Liste</a></li>
    </ul>
</li>
<?php // } ?>


<?php // if (in_array('RHGPAIE', $_SESSION['actions']['code_actions'])) { ?>
<li class="treeview">
    <a href="#">
        <i class="fa fa-tags"></i> <span>Paiements</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=add"><i class="fa fa-star"></i> Enrégistrer</a></li>
        <li><a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=viewall"><i class="fa fa-star"></i> Liste</a></li>
    </ul>
</li>
<?php // } ?>
<?php // if (in_array('RHGPAIE', $_SESSION['actions']['code_actions'])) { ?>
<li class="treeview">
    <a href="#">
        <i class="fa fa-tags"></i> <span>Livraison</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=add"><i class="fa fa-star"></i> Enrégistrer</a></li>
        <li><a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=viewall"><i class="fa fa-star"></i> Liste</a></li>
    </ul>
</li>
<?php // } ?>
<?php // if (in_array('RHLE', $_SESSION['actions']['code_actions'])|| in_array('RHMIE', $_SESSION['actions']['code_actions'])) { ?>
            <li><a href="<?php // echo H_ADMIN; ?>&view=resemployes&do=viewall"><i class="fa fa-users"></i>Fournisseurs</a></li>
<?php // } ?>

<?php // if (in_array('RHFCONF', $_SESSION['actions']['code_actions'])) { ?>
 <li><a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=viewall"> <i class="fa fa-cog"></i> Configuration</a></li>
<?php // }?>
