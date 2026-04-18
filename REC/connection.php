<?php
$con = new mysqli("localhost","root","","kabe_hotel_db");

$result = $con->query("SELECT id_client,nom_client FROM t_client LIMIT 0,10");
    while ($row = $result->fetch_object()){
         $user_arr[] = $row->id_client;
         $user_arr2[] = $row->nom_client;
     }
     $result->close();
     echo json_encode($user_arr2);
