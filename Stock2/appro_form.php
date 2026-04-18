<!DOCTYPE html>
<html lang="fr">

    <?php include('head.php'); ?>

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
                    <a class="navbar-brand" href="index.php"><img src="images/logoKB1.png"/></a>
                </div>
                <!-- /.navbar-header -->

                <?php include('navigation.php'); ?> 
                <?php include('menu.php'); ?>

                <?php include('Fonctions/fx_.php'); ?>
            </nav>
            <!-- /.navbar-top-links -->

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-6">
                            <h2 class="page-header">Famille</h2>
                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-6" align="right">
                            <h2 class="page-header"><a href="familles_view.php" title="Vue liste" class="btn btn-danger"><i class="fa fa-list"></i></a></h2>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div id="msg" class="alert alert-success alert-dismissable" style="display:none;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <span id="msg_alert">L'enrégistrement s'est effectué avec succès!</span>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>Enregistrement d'une famille</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <!--                            	<form role="form">-->
                                    <div class="col-lg-12">
                                        <form  id="form" method="post" action="Traitement/appro_insertion.php">
                                            <div class="table-responsive">
                                                <table width="874">
                                                    <tr height="15">
                                                        <td></td>
                                                    </tr>
                                                    <tr height="15">
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="128">Type&nbsp;&nbsp;</td>
                                                        <td width="13">
                                                          <td width="247"><input type="text" class="form-control" name="designation" id="designation" required></td>  
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr height="15">
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="128"></td>
                                                        <td width="233"></td>
                                                        <td width="93">&nbsp;</td>
                                                        <td width="121"></td>
                                                        <td width="247" align="right">
                                                            <button type="submit" class="btn btn-primary" id="save_appro">
                                                                <i class=" fa fa-save"></i>&nbsp;&nbsp;Enregistrer
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr height="15">
                                                        <td></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                                <!-- /.row (nested) -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                    <!--                </form>-->
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <?php include('footer.php'); ?>

    </body>

</html>
