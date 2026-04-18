<?php
/**
 * Created by PhpStorm.
 * User: KTG OPERATION
 * Date: 08/12/2017
 * Time: 04:34
 */
$json = array();
$json['date_sys'] =date('Y-m-d');
$json['heure_sys'] =date('H:i:s');
echo json_encode($json);