<?php
include '../../bdd/connexion.php';
if (isset($_GET['msg_id'])) {
    $requete = $bdd->prepare("SELECT * FROM accuse_reception WHERE id=:id ");
    $requete->BindParam(':id', $_GET['msg_id']);
    $requete->execute();
    $details= $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($details as $d) {
        $email=$d->email;
        $nom=$d->nom;
        $sujet=$d->sujet;
        $message=$d->message;
        $date=$d->date;
    }
}
?> 
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Lecture</h3>
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_content">
                    <div class="inbox-body">
                          <div class="mail_heading row">
                            <div class="col-md-4">
                              <div class="btn-group">
                                <a class="btn btn-sm btn-primary" href="?action=mailbox"><i class="fa fa-reply"></i> Retour</a>
                                <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
                                <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>
                              </div>
                            </div>
                            <div class="col-md-4">
                                <div id="msg" class="alert alert-success alert-dismissable"
                                    style=" text-align: center; display: none">
                                   <i class='fa fa-warning fa-fw'></i> <span id="msg_alert"></span>
                                </div>
                            </div>
                            <div class="col-md-4 text-right">
                                <form action="../traitement/envoie_mail.php" method="post" id="formsend">
                                    <input type="hidden" value="<?php echo $_GET['msg_id'];?>" name="id" id="id"/>
                                    <input type="hidden" value="<?php echo $email;?>" name="email" id="email"/>
                                    <input type="hidden" value="<?php echo $nom;?>" name="nom" id="nom"/>
                                    <input type="hidden" value="<?php echo $sujet;?>" name="sujet" id="sujet"/>
                                    <input type="hidden" value="<?php echo $message;?>" name="message" id="message"/>
                                    <button class="btn btn-sm btn-danger" id="btnsend" type="submit" ><i class="fa fa-send"></i> Renvoyer</button>
                                </form>
                            </div><br>
                            <h4></h4>  
                            <div class="col-md-12">
                                <h3><?php echo $sujet;?></h3>
                                <span>Pour: <?php echo $email;?></span>
                                <span class="pull-right"><?php echo date_formatee($date);?></span>
                                <h4></h4>
                            </div>
                          </div>
                          <div class="view-mail">
                            <p>Salut <?php echo $nom;?>,</p>

                            <p><?php echo $message;?></p>
                            <br/>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-sm btn-primary" href="?action=mailbox"><i class="fa fa-reply"></i> Retour</a>
                            <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
                            <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>
                          </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>


