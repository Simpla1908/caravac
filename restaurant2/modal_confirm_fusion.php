<?php

if (!isset($_SESSION)) {
    session_start();
}
global $table;
global $nom_table;
$_SESSION['tbl']['msg'] = array();
$_SESSION['tbl']['msg2'] = array();
$_SESSION['tbl']['tble_auth']= array();
;
//$table="n";
$nbre_r = $_SESSION['fusion']['id_client'];

for ($i = 0; $i < count($nbre_r); $i++) {

    array_push($_SESSION['tbl']['msg'], $_SESSION['fusion']['id_client'][$i]);
    array_push($_SESSION['tble']['tble_auth'], $_SESSION['fusion']['id_client'][$i]);
    if (($i === count($nbre_r) - 1)) {
        $table = $_SESSION['fusion']['id_client'][$i];
        array_push($_SESSION['tbl']['msg2'],$table);
        $nom_table=$_SESSION['tbl']['msg2'];
    }
}

?>

<div id="modal_confirm_fusion" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" <h5 class="modal-title"><strong>Confirmation</strong></h5>
            </div>
            <div class="modal-body">

                <span>Voulez-vous fusionner ces tables¨? </span>
                <span> <?php echo $nom_table; ?></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn_modal btn-lg" id="btn_fusion_confirm_no">ANNULER</button>
                <button type="submit" class="btn btn-primary btn_modal btn-lg" id="btn_fusion_confirm_yes">VALIDER</button>

            </div>

        </div>
    </div>
</div>
</div>