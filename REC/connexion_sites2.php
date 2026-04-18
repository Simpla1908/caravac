<?php
if ($_SESSION['type_user']==1){//Pour le superadmin
?>
<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="Voir sites">
        <i class="fa fa-bank fa-fw"></i>  <i class="fa fa-caret-down"></i>
    </a>

    <ul class="dropdown-menu dropdown-alerts">
        <?php 

        $company_id = $_SESSION['company_id'] ;
        $requete = $bdd->prepare("SELECT h.id_hotel,h.nom_hotel,h.default_site FROM  t_hotel h WHERE h.company_id=:company_id");
        $requete->BindParam(':company_id', $company_id);
        $requete->execute();
        $sites = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($sites as $s){
        $id_site=$s->id_hotel;
        $nom_site=$s->nom_hotel;
        $default_site=$s->default_site;
//                        $_SESSION['id_hotel'] =$id_site;
//                        $_SESSION['nom_hotel'] =$nom_site;

        ?>
        <li>
            <a href="../REC/tableaudebordRec.php?id_site=<?php echo $id_site; ?>">
                <div>
                    <i class="fa fa-bank fa-fw"></i> <?php echo strtoupper($nom_site); ?>
                    <?php
                    if ($id_site==$_SESSION['id_hotel']){//Pour le site par defaut
                    ?>
                    <span class="pull-right text-muted small"><span class="fa arrow"></span></span>
                    <?php
                    }
                    ?>
                </div>
            </a>
        </li>
        <li class="divider"></li>
        <?php
        }
        ?>
    </ul>
    <!-- /.dropdown-alerts -->
</li>
<!-- /.dropdown -->
<?php
}else{//Pour le utilisateur simple
?>
<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="Voir sites">
        <i class="fa fa-bank fa-fw"></i>  <i class="fa fa-caret-down"></i>
    </a>

    <ul class="dropdown-menu dropdown-alerts">
        <?php 

        $company_id = $_SESSION['company_id'] ;
        $requete = $bdd->prepare("SELECT DISTINCT a.id_hotel, a.nom_hotel,a.default_site FROM t_hotel AS a, users_groupes AS b WHERE a.id_hotel=b.hotel_id AND a.company_id=:company_id");
        $requete->BindParam(':company_id', $company_id);
        $requete->execute();
        $sites = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($sites as $s){
        $id_site=$s->id_hotel;
        $nom_site=$s->nom_hotel;
        $default_site=$s->default_site;
//                        $_SESSION['id_hotel'] =$id_site;
//                        $_SESSION['nom_hotel'] =$nom_site;

        ?>
        <li>
            <a href="../REC/tableaudebordRec.php?id_site=<?php echo $id_site; ?>">
                <div>
                    <i class="fa fa-bank fa-fw"></i> <?php echo strtoupper($nom_site); ?>
                    <?php
                    if ($id_site==$_SESSION['id_hotel']){//Pour le site par defaut
                    ?>
                    <span class="pull-right text-muted small"><span class="fa arrow"></span></span>
                    <?php
                    }
                    ?>
                </div>
            </a>
        </li>
        <li class="divider"></li>
        <?php
        }
        ?>
    </ul>
    <!-- /.dropdown-alerts -->
</li>
<!-- /.dropdown -->
<?php
}
?>