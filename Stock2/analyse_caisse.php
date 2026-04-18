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

            </nav>
            <!-- /.navbar-top-links --> 

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">Analyse de la caisse</h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                <div class="col-lg-12">
                	<p>
                	<form id="formsearch" action="analyse_caisse.php" method="post">
                	<div class="row">
                    	<div class="col-lg-12">
                           <div class="col-lg-2">
                           	  <select name="annee" id="annee" class="form-control">
                               <option>Année</option>
                             <?php
                             for($a=date('Y');$a<=2050;$a++){ 
                             ?>
                               <option value="<?php echo $a;?>"><?php echo $a;?></option>
                            <?php }?>
                             </select>
                           </div>
                           <div class="col-lg-10">
                            	<input type="submit" id="valider" name="valider" value="valider" class="btn btn-primary" />
                           </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    </form>
                    </p>
                    <p>
                    <!--<div id="msg" class="alert alert-danger alert-dismissable" style="display:none; border-radius:5px;height:40px;padding:10px;">
                    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 		Veuillez selectionner l'année s.v.p!
  					</div>-->
                    <div id="msg" class="alert alert-danger alert-dismissable" style="display:none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Veuillez selectionner l'année s.v.p!.
                    </div>
                    </p>
                    <div class="panel panel-default" id="table_analyse">
                        
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
		
        
        
        <?php include('footer.php'); ?>

    </body>

</html>
