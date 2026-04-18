<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
    <?php
    include('head.php');
    $mois = date('m');
    ?>
    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand1" href="index.php"><img src="images/logoKB1.png"/></a>
                </div>
                <!-- /.navbar-header -->

                <?php include('navigation.php'); ?> 
                <?php include('menu.php'); ?>
                <?php
                $id_hotel = $_SESSION['id_hotel'];
                $per_page = 24;
                include("../bdd/connexion_mysql.php");
                $sql = "select * from stk_produit where pseudo_supp=0 AND hotel_id='$id_hotel'";
                $rsd = mysql_query($sql);
                $count = mysql_num_rows($rsd);
                $pages = ceil($count / $per_page);
                ?>
            </nav>
            <!-- /.navbar-top-links --> 

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">Stock</h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12 text-center search-background">
                        <label><img src="pagination/loader.gif" alt="" /></label>
                    </div>
                    <div id="content">
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div id="paging_button" align="center">
                        <ul>
                            <?php
                            //Show page links
                            for ($i = 1; $i <= $pages; $i++) {
                                echo '<li id="' . $i . '">' . $i . '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->

        <?php include('footer.php'); ?>

    </body>

</html>
