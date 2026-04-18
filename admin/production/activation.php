
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Activation/Désactivation</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Liste de packs/modules</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table id="datatable-responsive" class="table table-striped table-bordered table-condensed dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Site</th>
                                <th>Pack/Module</th>
                                <th>Etat</th>
                                <th>Date d'activation</th>
                                <th>Date de blocage</th>
                                <th style="width: 20%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tb_contenu">
                            <?php 
                               include './dataactivation.php';
                            ?> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>